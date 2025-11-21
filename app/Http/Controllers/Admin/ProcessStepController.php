<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProcessStep;
use Illuminate\Http\Request;

class ProcessStepController extends Controller
{
    public function index()
    {
        $steps = ProcessStep::orderBy('step_number', 'asc')->get();
        return view('admin.process_steps.index', compact('steps'));
    }

    public function create()
    {
        return view('admin.process_steps.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'step_number' => 'required|integer',
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'image'       => 'nullable|image',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/process'), $imageName);
        }

        ProcessStep::create([
            'step_number' => $request->step_number,
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imageName,
        ]);

        return redirect()->route('admin.process.index')->with('success', 'Process step berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $step = ProcessStep::findOrFail($id);
        return view('admin.process_steps.edit', compact('step'));
    }

    public function update(Request $request, $id)
    {
        $step = ProcessStep::findOrFail($id);

        $request->validate([
            'step_number' => 'required|integer',
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'image'       => 'nullable|image',
        ]);

        $imageName = $step->image;
        if ($request->hasFile('image')) {
            if ($step->image && file_exists(public_path('uploads/process/' . $step->image))) {
                unlink(public_path('uploads/process/' . $step->image));
            }

            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/process'), $imageName);
        }

        $step->update([
            'step_number' => $request->step_number,
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imageName,
        ]);

        return redirect()->route('admin.process.index')->with('success', 'Process step berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $step = ProcessStep::findOrFail($id);

        if ($step->image && file_exists(public_path('uploads/process/' . $step->image))) {
            unlink(public_path('uploads/process/' . $step->image));
        }

        $step->delete();

        return redirect()->route('admin.process.index')->with('success', 'Process step berhasil dihapus!');
    }
}
