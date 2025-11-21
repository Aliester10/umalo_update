<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoreValue;
use Illuminate\Http\Request;

class CoreValueController extends Controller
{
    public function index()
    {
        $values = CoreValue::orderBy('order', 'asc')->get();
        return view('admin.core_values.index', compact('values'));
    }

    public function create()
    {
        return view('admin.core_values.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon'        => 'nullable|string',
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer'
        ]);

        CoreValue::create($request->all());

        return redirect()->route('admin.core.index')->with('success', 'Core Value berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $value = CoreValue::findOrFail($id);
        return view('admin.core_values.edit', compact('value'));
    }

    public function update(Request $request, $id)
    {
        $value = CoreValue::findOrFail($id);

        $request->validate([
            'icon'        => 'nullable|string',
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer'
        ]);

        $value->update($request->all());

        return redirect()->route('admin.core.index')->with('success', 'Core Value berhasil diperbarui!');
    }

    public function destroy($id)
    {
        CoreValue::findOrFail($id)->delete();
        return redirect()->route('admin.core.index')->with('success', 'Core Value berhasil dihapus!');
    }
}
