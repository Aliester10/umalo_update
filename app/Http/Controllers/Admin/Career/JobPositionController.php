<?php

namespace App\Http\Controllers\Admin\Career;

use App\Http\Controllers\Controller;
use App\Models\JobPosition;
use Illuminate\Http\Request;
use Str;

class JobPositionController extends Controller
{
    public function index()
    {
        $positions = JobPosition::latest()->paginate(10);

        return view('admin.career.positions.index', compact('positions'));
    }

    public function create()
    {
        return view('admin.career.positions.create');
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'employment_type' => 'required|string',
        'tags' => 'nullable|string',
        'description' => 'nullable|string',
        'requirements' => 'nullable|string',
    ]);

    // Convert tags
    $validated['tags'] = $request->tags
        ? array_map('trim', explode(',', $request->tags))
        : [];

    // Checkbox
    $validated['is_active'] = $request->has('is_active');

    JobPosition::create($validated);

    return redirect()
        ->route('admin.career.positions.index')
        ->with('success', 'Job position created successfully.');
}


    public function edit($id)
    {
        $position = JobPosition::findOrFail($id);

        return view('admin.career.positions.edit', compact('position'));
    }

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'employment_type' => 'required|string',
        'tags' => 'nullable|string',
        'description' => 'nullable|string',
        'requirements' => 'nullable|string',
    ]);

    $validated['tags'] = $request->tags
        ? array_map('trim', explode(',', $request->tags))
        : [];

    $validated['is_active'] = $request->has('is_active');

    JobPosition::findOrFail($id)->update($validated);

    return redirect()
        ->route('admin.career.positions.index')
        ->with('success', 'Job position updated successfully.');
}


    public function destroy($id)
    {
        $position = JobPosition::findOrFail($id);
        $position->delete();

        return redirect()->route('admin.career.positions.index')
            ->with('success', 'Job position deleted successfully.');
    }
}
