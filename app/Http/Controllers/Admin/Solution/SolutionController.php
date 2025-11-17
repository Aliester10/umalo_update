<?php

namespace App\Http\Controllers\Admin\Solution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solution;
use App\Models\SolutionFeature;
use App\Models\SolutionMetric;
use App\Models\SolutionTag;
use App\Models\SolutionMedia;
use Illuminate\Support\Str;

class SolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solutions = Solution::orderBy('order')->get();
        return view('admin.solution.index', compact('solutions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.solution.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate basic fields
        $request->validate([
            'title' => 'required|string|max:255',
            'slug'  => 'nullable|string|max:255|unique:solutions,slug',
        ]);

        // AUTO SLUG IF EMPTY
        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        // Upload files
        $thumbnail = $this->uploadFile($request, 'thumbnail', 'uploads/solutions/thumbnail');
        $cover_image = $this->uploadFile($request, 'cover_image', 'uploads/solutions/cover');
        $brochure = $this->uploadFile($request, 'brochure_file', 'uploads/solutions/brochure');

        // Create solution
        $solution = Solution::create([
            'title'             => $request->title,
            'slug'              => $slug,
            'short_description' => $request->short_description,
            'long_description'  => $request->long_description,
            'order'             => $request->order ?? 0,
            'thumbnail'         => $thumbnail,
            'cover_image'       => $cover_image,
            'brochure_file'     => $brochure,
        ]);

        // Save features
        if ($request->features) {
            foreach ($request->features as $f) {
                if (!empty($f['feature'])) {
                    SolutionFeature::create([
                        'solution_id' => $solution->id,
                        'icon'        => $f['icon'] ?? null,
                        'feature'     => $f['feature'],
                    ]);
                }
            }
        }

        // Save metrics
        if ($request->metrics) {
            foreach ($request->metrics as $m) {
                if (!empty($m['label']) && !empty($m['value'])) {
                    SolutionMetric::create([
                        'solution_id' => $solution->id,
                        'label'       => $m['label'],
                        'value'       => $m['value'],
                    ]);
                }
            }
        }

        // Save tags
        if ($request->tags) {
            foreach ($request->tags as $t) {
                if (!empty($t['tag'])) {
                    SolutionTag::create([
                        'solution_id' => $solution->id,
                        'tag'         => $t['tag'],
                    ]);
                }
            }
        }

        // Save media
        if ($request->media) {
            foreach ($request->media as $md) {
                if (!empty($md['url'])) {
                    SolutionMedia::create([
                        'solution_id' => $solution->id,
                        'type'        => $md['type'] ?? 'image',
                        'url'         => $md['url'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.solution.index')
                ->with('success', 'Solusi berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $solution = Solution::with(['features', 'metrics', 'tags', 'media'])->findOrFail($id);
        return view('admin.solution.edit', compact('solution'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $solution = Solution::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'slug'  => 'nullable|string|max:255|unique:solutions,slug,' . $solution->id,
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        // Upload new files if updated
        $thumbnail = $solution->thumbnail;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $this->uploadFile($request, 'thumbnail', 'uploads/solutions/thumbnail');
        }

        $cover_image = $solution->cover_image;
        if ($request->hasFile('cover_image')) {
            $cover_image = $this->uploadFile($request, 'cover_image', 'uploads/solutions/cover');
        }

        $brochure = $solution->brochure_file;
        if ($request->hasFile('brochure_file')) {
            $brochure = $this->uploadFile($request, 'brochure_file', 'uploads/solutions/brochure');
        }

        // Update main solution
        $solution->update([
            'title'             => $request->title,
            'slug'              => $slug,
            'short_description' => $request->short_description,
            'long_description'  => $request->long_description,
            'order'             => $request->order ?? 0,
            'thumbnail'         => $thumbnail,
            'cover_image'       => $cover_image,
            'brochure_file'     => $brochure,
        ]);

        /**
         * HANDLE EXISTING DELETES
         */
        if ($request->delete_features) {
            SolutionFeature::whereIn('id', $request->delete_features)->delete();
        }
        if ($request->delete_metrics) {
            SolutionMetric::whereIn('id', $request->delete_metrics)->delete();
        }
        if ($request->delete_tags) {
            SolutionTag::whereIn('id', $request->delete_tags)->delete();
        }
        if ($request->delete_media) {
            SolutionMedia::whereIn('id', $request->delete_media)->delete();
        }

        /**
         * UPDATE EXISTING
         */
        if ($request->features_existing) {
            foreach ($request->features_existing as $id => $f) {
                SolutionFeature::where('id', $id)->update([
                    'icon'    => $f['icon'],
                    'feature' => $f['feature'],
                ]);
            }
        }

        if ($request->metrics_existing) {
            foreach ($request->metrics_existing as $id => $m) {
                SolutionMetric::where('id', $id)->update([
                    'label' => $m['label'],
                    'value' => $m['value'],
                ]);
            }
        }

        if ($request->tags_existing) {
            foreach ($request->tags_existing as $id => $t) {
                SolutionTag::where('id', $id)->update([
                    'tag' => $t['tag'],
                ]);
            }
        }

        if ($request->media_existing) {
            foreach ($request->media_existing as $id => $md) {
                SolutionMedia::where('id', $id)->update([
                    'type' => $md['type'],
                    'url'  => $md['url'],
                ]);
            }
        }

        /**
         * ADD NEW (features, metrics, tags, media)
         */
        if ($request->features) {
            foreach ($request->features as $f) {
                if (!empty($f['feature'])) {
                    SolutionFeature::create([
                        'solution_id' => $solution->id,
                        'icon'        => $f['icon'],
                        'feature'     => $f['feature']
                    ]);
                }
            }
        }

        if ($request->metrics) {
            foreach ($request->metrics as $m) {
                if (!empty($m['label']) && !empty($m['value'])) {
                    SolutionMetric::create([
                        'solution_id' => $solution->id,
                        'label' => $m['label'],
                        'value' => $m['value'],
                    ]);
                }
            }
        }

        if ($request->tags) {
            foreach ($request->tags as $t) {
                if (!empty($t['tag'])) {
                    SolutionTag::create([
                        'solution_id' => $solution->id,
                        'tag' => $t['tag'],
                    ]);
                }
            }
        }

        if ($request->media) {
            foreach ($request->media as $md) {
                if (!empty($md['url'])) {
                    SolutionMedia::create([
                        'solution_id' => $solution->id,
                        'type' => $md['type'],
                        'url' => $md['url'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.solution.index')->with('success', 'Solusi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Solution::findOrFail($id)->delete();

        return redirect()->route('admin.solution.index')
                         ->with('success', 'Solusi berhasil dihapus!');
    }



    /**
     * Helper function for file uploads
     */
    private function uploadFile($request, $field, $path)
    {
        if (!$request->hasFile($field)) return null;

        $file = $request->file($field);
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        return $file->storeAs($path, $fileName, 'public');
    }
}
