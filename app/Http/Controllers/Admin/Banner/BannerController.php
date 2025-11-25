<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Activity;
use App\Models\Meta;
use App\Models\Product;
use Illuminate\Support\Facades\File;

// Intervention Image v3 (Wajib)
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class BannerController extends Controller
{
    /**
     * Show all banners
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Create page
     */
    public function create()
    {
        $activities = Activity::all();
        $routes = [
            'home' => route('home'),
            'about' => route('about'),
        ];

        $metas = Meta::where('start_date', '<=', today())
                     ->where('end_date', '>=', today())
                     ->get();

        $products = Product::all();

        return view('admin.banner.create', compact('activities', 'routes', 'metas', 'products'));
    }

    /**
     * Store banner with compression
     */
    public function store(Request $request)
    {
        $request->validate([
            'image_url' => 'required|image',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string',
        ]);

        // ===============================
        // IMAGE PROCESS (Intervention v3)
        // ===============================
        $manager = new ImageManager(new Driver());

        $image = $request->file('image_url');
        $imageName = time() . '.webp';
        $imagePath = 'uploads/banner/' . $imageName;
        $fullPath = public_path($imagePath);

        // Read & scale
        $img = $manager->read($image->getRealPath());
        $img->scale(width: 1920);

        // Encode to WEBP
        $img->encode(new WebpEncoder(75))->save($fullPath);

        // ===============================
        // DYNAMIC BUTTON URL
        // ===============================
        if ($request->filled('activity_id')) {
            $buttonUrl = route('activity.show', $request->activity_id);
        } elseif ($request->filled('meta_slug')) {
            $meta = Meta::where('slug', $request->meta_slug)->firstOrFail();
            $buttonUrl = route('member.meta.show', $meta->slug);
        } elseif ($request->filled('product_id')) {
            $product = Product::findOrFail($request->product_id);
            $buttonUrl = route('product.show', $product->slug);
        } else {
            $buttonUrl = $request->button_url;
        }

        // Save banner
        Banner::create([
            'image_url' => $imagePath,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_url' => $buttonUrl,
        ]);

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner created successfully.');
    }

    /**
     * Edit page
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        $activities = Activity::all();

        $routes = [
            'home' => route('home'),
            'about' => route('about'),
        ];

        $metas = Meta::where('start_date', '<=', today())
                     ->where('end_date', '>=', today())
                     ->get();

        $products = Product::all();

        return view('admin.banner.edit', compact('banner', 'activities', 'routes', 'metas', 'products'));
    }

    /**
     * Update banner with compression
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'image_url' => 'nullable|image',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string',
        ]);

        // Default image (jika tidak diganti)
        $imagePath = $banner->image_url;

        // ===============================
        // IF NEW IMAGE
        // ===============================
        if ($request->hasFile('image_url')) {

            // Delete old image
            if ($banner->image_url && File::exists(public_path($banner->image_url))) {
                File::delete(public_path($banner->image_url));
            }

            $manager = new ImageManager(new Driver());

            $image = $request->file('image_url');
            $imageName = time() . '.webp';
            $imagePath = 'uploads/banner/' . $imageName;
            $fullPath = public_path($imagePath);

            $img = $manager->read($image->getRealPath());
            $img->scale(width: 1920);
            $img->encode(new WebpEncoder(75))->save($fullPath);
        }

        // ===============================
        // BUTTON URL LOGIC
        // ===============================
        if ($request->filled('activity_id')) {
            $buttonUrl = route('activity.show', $request->activity_id);
        } elseif ($request->filled('meta_slug')) {
            $meta = Meta::where('slug', $request->meta_slug)->firstOrFail();
            $buttonUrl = route('member.meta.show', $meta->slug);
        } elseif ($request->filled('product_id')) {
            $product = Product::findOrFail($request->product_id);
            $buttonUrl = route('product.show', $product->slug);
        } else {
            $buttonUrl = $request->button_url;
        }

        // Update DB
        $banner->update([
            'image_url' => $imagePath,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_url' => $buttonUrl,
        ]);

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner updated successfully.');
    }

    /**
     * Delete banner
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if (File::exists(public_path($banner->image_url))) {
            File::delete(public_path($banner->image_url));
        }

        $banner->delete();

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner deleted successfully.');
    }
}
