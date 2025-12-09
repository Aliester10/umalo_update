<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Activity;
use App\Models\Meta;
use App\Models\Product;
use Illuminate\Support\Facades\File;

// Intervention Image v3
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }

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

public function store(Request $request)
{
    $request->validate([
        'image_url' => 'required|image',
        'image_mobile' => 'nullable|image',
        'title' => 'nullable|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'button_text' => 'nullable|string|max:255',
        'button_url' => 'nullable|string',
    ]);

    $manager = new ImageManager(new Driver());

    // ✅ PASTIKAN FOLDER ADA
    $folder = public_path('uploads/banner');
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    /* ===============================
       DESKTOP IMAGE (WAJIB)
    =============================== */
    $imageDesktop = $request->file('image_url');
    $desktopName = time() . '_desktop.webp';
    $desktopPath = 'uploads/banner/' . $desktopName;

    $imgDesktop = $manager->read($imageDesktop->getRealPath());
    $imgDesktop->scale(width: 1920);
    $imgDesktop->toWebp(75)->save(public_path($desktopPath));

    /* ===============================
       MOBILE IMAGE (OPTIONAL)
    =============================== */
    $mobilePath = null;

    if ($request->hasFile('image_mobile')) {
        $imageMobile = $request->file('image_mobile');
        $mobileName = time() . '_mobile.webp';
        $mobilePath = 'uploads/banner/' . $mobileName;

        $imgMobile = $manager->read($imageMobile->getRealPath());
        $imgMobile->scale(width: 768);
        $imgMobile->toWebp(75)->save(public_path($mobilePath));
    }

    /* ===============================
       BUTTON URL LOGIC
    =============================== */
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

    Banner::create([
        'image_url' => $desktopPath,
        'image_mobile' => $mobilePath,
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'description' => $request->description,
        'button_text' => $request->button_text,
        'button_url' => $buttonUrl,
    ]);

    return redirect()->route('admin.banner.index')
        ->with('success', 'Banner created successfully.');
}


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

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'image_url' => 'nullable|image',
            'image_mobile' => 'nullable|image',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string',
        ]);

        $manager = new ImageManager(new Driver());

        $desktopPath = $banner->image_url;
        $mobilePath  = $banner->image_mobile;

        /* ===============================
           UPDATE DESKTOP IMAGE
        =============================== */
        if ($request->hasFile('image_url')) {

            if ($banner->image_url && File::exists(public_path($banner->image_url))) {
                File::delete(public_path($banner->image_url));
            }

            $desktopName = time() . '_desktop.webp';
            $desktopPath = 'uploads/banner/' . $desktopName;

            $imgDesktop = $manager->read($request->file('image_url')->getRealPath());
            $imgDesktop->scale(width: 1920);
            $imgDesktop->encode(new WebpEncoder(75))
                ->save(public_path($desktopPath));
        }

        /* ===============================
           UPDATE MOBILE IMAGE
        =============================== */
        if ($request->hasFile('image_mobile')) {

            if ($banner->image_mobile && File::exists(public_path($banner->image_mobile))) {
                File::delete(public_path($banner->image_mobile));
            }

            $mobileName = time() . '_mobile.webp';
            $mobilePath = 'uploads/banner/' . $mobileName;

            $imgMobile = $manager->read($request->file('image_mobile')->getRealPath());
            $imgMobile->scale(width: 768);
            $imgMobile->encode(new WebpEncoder(75))
                ->save(public_path($mobilePath));
        }

        /* ===============================
           BUTTON URL LOGIC
        =============================== */
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

        $banner->update([
            'image_url' => $desktopPath,
            'image_mobile' => $mobilePath,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_url' => $buttonUrl,
        ]);

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->image_url && File::exists(public_path($banner->image_url))) {
            File::delete(public_path($banner->image_url));
        }

        if ($banner->image_mobile && File::exists(public_path($banner->image_mobile))) {
            File::delete(public_path($banner->image_mobile));
        }

        $banner->delete();

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner deleted successfully.');
    }
}
