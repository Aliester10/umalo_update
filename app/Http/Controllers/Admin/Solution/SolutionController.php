<?php

namespace App\Http\Controllers\Admin\Solution;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use App\Models\SolutionFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SolutionController extends Controller
{
    public function index()
    {
        $solutions = Solution::with('features')
            ->orderBy('order', 'asc')
            ->get();
            
        return view('admin.solution.index', compact('solutions'));
    }

    public function create()
    {
        return view('admin.solution.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:solutions,title',
            'short_description' => 'nullable|max:500',
            'overview_title' => 'nullable|max:255',
            'overview_description' => 'nullable',
            'benefits' => 'nullable',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'brochure_file' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'status' => 'required|in:draft,published', // ✅ SESUAIKAN
            'order' => 'nullable|integer'
        ]);

        $data = $request->except(['banner_image', 'brochure_file', 'features']);
        $data['slug'] = Str::slug($request->title);

        // Upload banner image
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/solutions'), $filename);
            $data['banner_image'] = 'uploads/solutions/' . $filename;
        }

        // Upload brochure
        if ($request->hasFile('brochure_file')) {
            $file = $request->file('brochure_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/solutions/brochures'), $filename);
            $data['brochure_file'] = 'uploads/solutions/brochures/' . $filename;
        }

        $solution = Solution::create($data);

        // Save features
        if ($request->has('features')) {
            foreach ($request->features as $feature) {
                if (!empty($feature['title'])) {
                    SolutionFeature::create([
                        'solution_id' => $solution->id,
                        'feature_title' => $feature['title'],
                        'feature_icon' => $feature['icon'] ?? 'check'
                    ]);
                }
            }
        }

        return redirect()->route('admin.solution.index')
            ->with('success', 'Solution created successfully');
    }

    public function edit(Solution $solution)
    {
        $solution->load('features');
        return view('admin.solution.edit', compact('solution'));
    }

    public function update(Request $request, Solution $solution)
    {
        $request->validate([
            'title' => 'required|max:255|unique:solutions,title,' . $solution->id,
            'short_description' => 'nullable|max:500',
            'overview_title' => 'nullable|max:255',
            'overview_description' => 'nullable',
            'benefits' => 'nullable',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'brochure_file' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'status' => 'required|in:draft,published', // ✅ SESUAIKAN
            'order' => 'nullable|integer'
        ]);

        $data = $request->except(['banner_image', 'brochure_file', 'features']);

        if ($request->title !== $solution->title) {
            $data['slug'] = Str::slug($request->title);
        }

        // Update banner image
        if ($request->hasFile('banner_image')) {
            if ($solution->banner_image && File::exists(public_path($solution->banner_image))) {
                File::delete(public_path($solution->banner_image));
            }

            $file = $request->file('banner_image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/solutions'), $filename);
            $data['banner_image'] = 'uploads/solutions/' . $filename;
        }

        // Update brochure
        if ($request->hasFile('brochure_file')) {
            if ($solution->brochure_file && File::exists(public_path($solution->brochure_file))) {
                File::delete(public_path($solution->brochure_file));
            }

            $file = $request->file('brochure_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/solutions/brochures'), $filename);
            $data['brochure_file'] = 'uploads/solutions/brochures/' . $filename;
        }

        $solution->update($data);

        // Replace features
        SolutionFeature::where('solution_id', $solution->id)->delete();

        if ($request->has('features')) {
            foreach ($request->features as $feature) {
                if (!empty($feature['title'])) {
                    SolutionFeature::create([
                        'solution_id' => $solution->id,
                        'feature_title' => $feature['title'],
                        'feature_icon' => $feature['icon'] ?? 'check'
                    ]);
                }
            }
        }

        return redirect()->route('admin.solution.index')
            ->with('success', 'Solution updated successfully');
    }

    public function destroy(Solution $solution)
    {
        if ($solution->banner_image && File::exists(public_path($solution->banner_image))) {
            File::delete(public_path($solution->banner_image));
        }

        if ($solution->brochure_file && File::exists(public_path($solution->brochure_file))) {
            File::delete(public_path($solution->brochure_file));
        }

        $solution->features()->delete();
        $solution->delete();

        return back()->with('success', 'Solution deleted successfully');
    }
}