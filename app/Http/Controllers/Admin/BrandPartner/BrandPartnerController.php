<?php
namespace App\Http\Controllers\Admin\BrandPartner;

use App\Http\Controllers\Controller;
use App\Models\BrandPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('gambar')->store('brandpartner', 'public');

        BrandPartner::create([
            'nama' => $request->nama,
            'type' => $request->type,
            'url' => $request->url,
            'gambar' => $path,
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
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if (File::exists(public_path('storage/' . $brand->gambar))) {
                File::delete(public_path('storage/' . $brand->gambar));
            }
            $data['gambar'] = $request->file('gambar')->store('brandpartner', 'public');
        }

        $brand->update($data);
        return redirect()->route('admin.brand-partner.index')->with('success', 'Brand berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $brand = BrandPartner::findOrFail($id);

        if (File::exists(public_path('storage/' . $brand->gambar))) {
            File::delete(public_path('storage/' . $brand->gambar));
        }

        $brand->delete();

        return redirect()->route('admin.brand-partner.index')->with('success', 'Brand berhasil dihapus.');
    }
}
