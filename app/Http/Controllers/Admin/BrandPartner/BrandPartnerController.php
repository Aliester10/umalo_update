<?php

namespace App\Http\Controllers\Admin\BrandPartner;

use App\Http\Controllers\Controller;
use App\Models\BrandPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

// Intervention v3
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class BrandPartnerController extends Controller
{
    public function index()
    {
        $brands = BrandPartner::orderBy('id', 'asc')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'type' => 'required|string',
            'url'  => 'nullable|url',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // ================
        // COMPRESS IMAGE
        // ================
        $manager = new ImageManager(new Driver());

        $image = $request->file('gambar');
        $slug = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $slug = Str::slug($slug);

        $fileName = time() . '_' . $slug . '.webp';

        $imagePath = 'brandpartner/' . $fileName;
        $fullPath = storage_path('app/public/' . $imagePath);

        // Resize + Encode
        $img = $manager->read($image->getRealPath());
        $img->scale(width: 600); // brand icon tidak perlu resolusi besar
        $img->encode(new WebpEncoder(80))->save($fullPath);

        BrandPartner::create([
            'nama' => $request->nama,
            'type' => $request->type,
            'url' => $request->url,
            'gambar' => $imagePath,
        ]);

        return redirect()->route('admin.brand-partner.index')->with('success', 'Brand berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $brand = BrandPartner::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $brand = BrandPartner::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'type' => 'required|string',
            'url'  => 'nullable|url',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // ========================
        // CHECK IF NEW IMAGE EXIST
        // ========================
        if ($request->hasFile('gambar')) {

            // Delete old file
            if (File::exists(storage_path('app/public/' . $brand->gambar))) {
                File::delete(storage_path('app/public/' . $brand->gambar));
            }

            $manager = new ImageManager(new Driver());

            $image = $request->file('gambar');
            $slug = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $slug = Str::slug($slug);

            $fileName = time() . '_' . $slug . '.webp';

            $imagePath = 'brandpartner/' . $fileName;
            $fullPath = storage_path('app/public/' . $imagePath);

            // Compress + Resize
            $img = $manager->read($image->getRealPath());
            $img->scale(width: 600);
            $img->encode(new WebpEncoder(80))->save($fullPath);

            $data['gambar'] = $imagePath;
        }

        $brand->update($data);

        return redirect()->route('admin.brand-partner.index')->with('success', 'Brand berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $brand = BrandPartner::findOrFail($id);

        // Delete image file
        if (File::exists(storage_path('app/public/' . $brand->gambar))) {
            File::delete(storage_path('app/public/' . $brand->gambar));
        }

        $brand->delete();

        return redirect()->route('admin.brand-partner.index')->with('success', 'Brand berhasil dihapus.');
    }
}
