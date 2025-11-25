<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Brosur;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVideo;
use App\Models\UserManual;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

// Intervention Image v3
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('name') && $request->name !== null) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        $products = $query->paginate(10);
        $category = Category::all();

        return view('admin.product.index', compact('products', 'category'));
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'usage' => 'required',
            'category_id' => 'required|exists:t_category,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:15000',
            'video.*' => 'nullable|file|mimes:mp4,avi,mkv|max:50000',
            'ekatalog' => 'nullable',
            'file_usermanual.*' => 'nullable|file|mimes:pdf,doc,docx|max:20000',
            'file.*' => 'nullable|mimes:pdf,jpeg,png,jpg,gif|max:20000',
        ]);

        $product = new Product;
        $product->fill($request->all());
        $product->slug = Str::slug($product->name, '-');
        $product->save();

        // ========================
        // USER MANUAL UPLOAD
        // ========================
        if ($request->hasFile('file_usermanual')) {
            foreach ($request->file('file_usermanual') as $file) {

                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '.' . $file->getClientOriginalExtension();

                $filePath = 'uploads/product/usermanual/' . $fileName;

                $file->move(public_path('uploads/product/usermanual'), $fileName);

                UserManual::create([
                    'product_id' => $product->id,
                    'file' => $filePath,
                ]);
            }
        }

        // ========================
        // VIDEO UPLOAD
        // ========================
        if ($request->hasFile('video')) {
            foreach ($request->file('video') as $videoFile) {

                $slug = Str::slug(pathinfo($videoFile->getClientOriginalName(), PATHINFO_FILENAME));
                $newVideoName = time() . '_' . $slug . '.' . $videoFile->getClientOriginalExtension();

                $videoFile->move('uploads/product/videos/', $newVideoName);

                ProductVideo::create([
                    'product_id' => $product->id,
                    'video' => 'uploads/product/videos/' . $newVideoName,
                ]);
            }
        }

        // ========================
        // COMPRESSED IMAGE UPLOAD
        // ========================
        if ($request->hasFile('images')) {

            $manager = new ImageManager(new Driver());

            foreach ($request->file('images') as $imgproduct) {

                $slug = Str::slug(pathinfo($imgproduct->getClientOriginalName(), PATHINFO_FILENAME));
                $imageName = time() . '_' . $slug . '.webp';

                $imagePath = 'uploads/product/' . $imageName;
                $fullPath = public_path($imagePath);

                $img = $manager->read($imgproduct->getRealPath());
                $img->scale(width: 1920);
                $img->encode(new WebpEncoder(75))->save($fullPath);

                ProductImage::create([
                    'product_id' => $product->id,
                    'images' => $imagePath,
                ]);
            }
        }

        // ========================
        // BROSUR (PDF / IMAGE)
        // ========================
        if ($request->hasFile('file')) {

            foreach ($request->file('file') as $file) {

                $extension = $file->getClientOriginalExtension();

                // Jika brosur berupa PDF → langsung simpan
                if ($extension === 'pdf') {

                    $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.pdf';
                    $file->move('uploads/product/brosur/', $fileName);

                    $fileToStore = 'uploads/product/brosur/' . $fileName;
                    $type = 'pdf';

                } else {

                    // Jika brosur berupa IMAGE → compress WEBP
                    $manager = new ImageManager(new Driver());

                    $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                    $imageName = time() . '_' . $slug . '.webp';

                    $imagePath = 'uploads/product/brosur/' . $imageName;
                    $fullPath = public_path($imagePath);

                    $img = $manager->read($file->getRealPath());
                    $img->scale(width: 1920);
                    $img->encode(new WebpEncoder(75))->save($fullPath);

                    $fileToStore = $imagePath;
                    $type = 'image';
                }

                Brosur::create([
                    'product_id' => $product->id,
                    'file' => $fileToStore,
                    'type' => $type
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'product created successfully.');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('admin.product.edit', compact('product', 'category'));
    }

    public function show($id)
    {
        $products = Product::with('images', 'videos', 'documentCertificationsProduct', 'brosur')->findOrFail($id);
        return view('admin.product.show', compact('products'));
    }


    /**
     * Update resource
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'usage' => 'required',
            'category_id' => 'required|exists:t_category,id',
            'ekatalog' => 'nullable',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15000',
            'video.*' => 'nullable|file|mimes:mp4,avi,mkv|max:50000',
            'file_usermanual.*' => 'nullable|file|mimes:pdf,doc,docx|max:20000',
            'file.*' => 'nullable|mimes:pdf,jpeg,png,jpg,gif|max:20000',
        ]);

        $product = Product::findOrFail($id);
        $product->fill($request->all());
        $product->slug = Str::slug($request->name, '-');
        $product->save();

        // DELETE SELECTED IMAGES
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {

                $image = ProductImage::find($imageId);

                if ($image) {
                    if (file_exists(public_path($image->images))) {
                        unlink(public_path($image->images));
                    }
                    $image->delete();
                }
            }
        }

        // ========================
        // USER MANUAL UPDATE
        // ========================
        if ($request->hasFile('file_usermanual')) {

            $existing = UserManual::where('product_id', $product->id)->get();

            foreach ($existing as $manual) {
                if (file_exists(public_path($manual->file))) {
                    unlink(public_path($manual->file));
                }
                $manual->delete();
            }

            foreach ($request->file('file_usermanual') as $file) {

                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '.' . $file->getClientOriginalExtension();

                $filePath = 'uploads/product/usermanual/' . $fileName;

                $file->move(public_path('uploads/product/usermanual'), $fileName);

                UserManual::create([
                    'product_id' => $product->id,
                    'file' => $filePath,
                ]);
            }
        }

        // ========================
        // VIDEO UPDATE
        // ========================
        if ($request->hasFile('video')) {
            foreach ($request->file('video') as $videoFile) {

                $slug = Str::slug(pathinfo($videoFile->getClientOriginalName(), PATHINFO_FILENAME));
                $newVideoName = time() . '_' . $slug . '.' . $videoFile->getClientOriginalExtension();

                $videoFile->move('uploads/product/videos/', $newVideoName);

                ProductVideo::create([
                    'product_id' => $product->id,
                    'video' => 'uploads/product/videos/' . $newVideoName
                ]);
            }
        }

        // ========================
        // COMPRESSED IMAGE UPDATE
        // ========================
        if ($request->hasFile('images')) {

            $manager = new ImageManager(new Driver());

            foreach ($request->file('images') as $imgproduct) {

                $slug = Str::slug(pathinfo($imgproduct->getClientOriginalName(), PATHINFO_FILENAME));
                $imageName = time() . '_' . $slug . '.webp';

                $imagePath = 'uploads/product/' . $imageName;
                $fullPath = public_path($imagePath);

                $img = $manager->read($imgproduct->getRealPath());
                $img->scale(width: 1920);
                $img->encode(new WebpEncoder(75))->save($fullPath);

                ProductImage::create([
                    'product_id' => $product->id,
                    'images' => $imagePath,
                ]);
            }
        }

        // ========================
        // BROSUR UPDATE (PDF / IMAGE)
        // ========================
        if ($request->hasFile('file')) {

            $oldBrosur = Brosur::where('product_id', $product->id)->get();

            foreach ($oldBrosur as $brosur) {
                if (file_exists(public_path($brosur->file))) {
                    unlink(public_path($brosur->file));
                }
                $brosur->delete();
            }

            foreach ($request->file('file') as $file) {

                $extension = $file->getClientOriginalExtension();

                if ($extension === 'pdf') {

                    $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.pdf';
                    $file->move('uploads/product/brosur/', $fileName);

                    $fileToStore = 'uploads/product/brosur/' . $fileName;
                    $type = 'pdf';

                } else {

                    $manager = new ImageManager(new Driver());

                    $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                    $imageName = time() . '_' . $slug . '.webp';

                    $imagePath = 'uploads/product/brosur/' . $imageName;
                    $fullPath = public_path($imagePath);

                    $img = $manager->read($file->getRealPath());
                    $img->scale(width: 1920);
                    $img->encode(new WebpEncoder(75))->save($fullPath);

                    $fileToStore = $imagePath;
                    $type = 'image';
                }

                Brosur::create([
                    'product_id' => $product->id,
                    'file' => $fileToStore,
                    'type' => $type
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'product updated successfully.');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // delete product images
        foreach ($product->images as $image) {
            if (file_exists(public_path($image->images))) {
                unlink(public_path($image->images));
            }
            $image->delete();
        }

        // delete videos
        foreach ($product->videos as $video) {
            if (file_exists(public_path($video->video))) {
                unlink(public_path($video->video));
            }
            $video->delete();
        }

        // delete brosur
        foreach ($product->brosur as $brosur) {
            if (file_exists(public_path($brosur->file))) {
                unlink(public_path($brosur->file));
            }
            $brosur->delete();
        }

        // delete usermanual
        foreach ($product->usermanual as $manual) {
            if (file_exists(public_path($manual->file))) {
                unlink(public_path($manual->file));
            }
            $manual->delete();
        }

        // delete product
        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'product deleted successfully.');
    }
}
