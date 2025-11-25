<?php

namespace App\Http\Controllers\Admin\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityGallery;
use App\Models\ActivityHighlight;
use App\Models\ActivitySchedule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

// Intervention Image v3
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->get();
        return view('Admin.Activity.index', compact('activities'));
    }

    public function show(Activity $activity)
    {
        return view('Admin.Activity.show', compact('activity'));
    }

    public function create()
    {
        return view('Admin.Activity.create');
    }

    // =====================================================
    //                        STORE
    // =====================================================
    public function store(Request $request)
    {
        $request->validate([
            'images'        => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'cover_image'   => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'title'         => 'required|string|max:255',
            'description'   => 'required|string'
        ]);

        $manager = new ImageManager(new Driver());

        // ===========================
        // MAIN IMAGE COMPRESS
        // ===========================
        $mainImagePath = null;

        if ($request->hasFile('images')) {

            $file = $request->file('images');
            $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

            $imageName = time() . '_main_' . $slug . '.webp';
            $imagePath = 'uploads/activities/images/' . $imageName;

            $fullPath = public_path($imagePath);

            $img = $manager->read($file->getRealPath());
            $img->scale(width: 1920);
            $img->encode(new WebpEncoder(75))->save($fullPath);

            $mainImagePath = $imagePath;
        }

        // ===========================
        // COVER IMAGE COMPRESS
        // ===========================
        $coverImagePath = null;

        if ($request->hasFile('cover_image')) {

            $file = $request->file('cover_image');
            $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

            $imageName = time() . '_cover_' . $slug . '.webp';
            $imagePath = 'uploads/activities/images/' . $imageName;

            $fullPath = public_path($imagePath);

            $img = $manager->read($file->getRealPath());
            $img->scale(width: 1920);
            $img->encode(new WebpEncoder(75))->save($fullPath);

            $coverImagePath = $imagePath;
        }

        // ===========================
        // SAVE ACTIVITY
        // ===========================
        $activity = Activity::create([
            'images'        => $mainImagePath,
            'cover_image'   => $coverImagePath,
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'description'   => $request->description,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'location'      => $request->location,
            'participants'  => $request->participants,
            'duration'      => $request->duration,
            'category'      => $request->category,
            'status'        => $request->status,
            'tags'          => $request->tags,
        ]);

        // ===========================
        // HIGHLIGHTS
        // ===========================
        if ($request->highlights) {
            foreach ($request->highlights as $h) {
                if (!empty(trim($h))) {
                    ActivityHighlight::create([
                        'activity_id' => $activity->id,
                        'highlight'   => $h
                    ]);
                }
            }
        }

        // ===========================
        // GALLERY (COMPRESS)
        // ===========================
        if ($request->hasFile('gallery')) {

            foreach ($request->file('gallery') as $file) {

                $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

                $imageName = time() . '_gallery_' . $slug . '.webp';
                $imagePath = 'uploads/activities/gallery/' . $imageName;

                $fullPath = public_path($imagePath);

                $img = $manager->read($file->getRealPath());
                $img->scale(width: 1920);
                $img->encode(new WebpEncoder(75))->save($fullPath);

                ActivityGallery::create([
                    'activity_id' => $activity->id,
                    'image'       => $imagePath
                ]);
            }
        }

        // ===========================
        // SCHEDULE
        // ===========================
        if ($request->schedule_day && $request->schedule_content) {
            foreach ($request->schedule_day as $i => $day) {
                ActivitySchedule::create([
                    'activity_id' => $activity->id,
                    'day_title' => $day,
                    'schedule_content' => $request->schedule_content[$i]
                ]);
            }
        }

        return redirect()->route('Admin.Activity.index')
            ->with('success', 'Activity created successfully.');
    }



    // =====================================================
    //                        EDIT
    // =====================================================
    public function edit(Activity $activity)
    {
        $activity->load(['highlights', 'galleries', 'schedules']);
        return view('Admin.Activity.edit', compact('activity'));
    }


    // =====================================================
    //                        UPDATE
    // =====================================================
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'images'        => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'cover_image'   => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'title'         => 'required|string|max:255',
            'description'   => 'required|string'
        ]);

        $manager = new ImageManager(new Driver());

        // ===========================
        // UPDATE MAIN IMAGE
        // ===========================
        if ($request->hasFile('images')) {

            if ($activity->images && file_exists(public_path($activity->images))) {
                unlink(public_path($activity->images));
            }

            $file = $request->file('images');
            $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

            $imageName = time() . '_main_' . $slug . '.webp';
            $imagePath = 'uploads/activities/images/' . $imageName;

            $img = $manager->read($file->getRealPath());
            $img->scale(width: 1920);
            $img->encode(new WebpEncoder(75))->save(public_path($imagePath));

            $activity->images = $imagePath;
        }

        // ===========================
        // UPDATE COVER IMAGE
        // ===========================
        if ($request->hasFile('cover_image')) {

            if ($activity->cover_image && file_exists(public_path($activity->cover_image))) {
                unlink(public_path($activity->cover_image));
            }

            $file = $request->file('cover_image');
            $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

            $imageName = time() . '_cover_' . $slug . '.webp';
            $imagePath = 'uploads/activities/images/' . $imageName;

            $img = $manager->read($file->getRealPath());
            $img->scale(width: 1920);
            $img->encode(new WebpEncoder(75))->save(public_path($imagePath));

            $activity->cover_image = $imagePath;
        }

        // ===========================
        // UPDATE BASIC FIELDS
        // ===========================
        $activity->title        = $request->title;
        $activity->slug         = Str::slug($request->title);
        $activity->description  = $request->description;
        $activity->start_date   = $request->start_date;
        $activity->end_date     = $request->end_date;
        $activity->location     = $request->location;
        $activity->duration     = $request->duration;
        $activity->participants = $request->participants;
        $activity->category     = $request->category;
        $activity->status       = $request->status;
        $activity->tags         = $request->tags;
        $activity->save();

        // ===========================
        // HIGHLIGHTS
        // ===========================

        if ($request->delete_highlight) {
            foreach ($request->delete_highlight as $id) {
                ActivityHighlight::where('id', $id)->delete();
            }
        }

        if ($request->highlight_ids) {
            foreach ($request->highlight_ids as $i => $id) {
                ActivityHighlight::where('id', $id)->update([
                    'highlight' => $request->highlights_old[$i]
                ]);
            }
        }

        if ($request->highlights) {
            foreach ($request->highlights as $h) {
                if (!empty(trim($h))) {
                    ActivityHighlight::create([
                        'activity_id' => $activity->id,
                        'highlight'   => $h
                    ]);
                }
            }
        }

        // ===========================
        // GALLERY UPDATE
        // ===========================
        if ($request->delete_gallery) {
            foreach ($request->delete_gallery as $id) {
                $g = ActivityGallery::find($id);
                if ($g) {
                    if (file_exists(public_path($g->image))) {
                        unlink(public_path($g->image));
                    }
                    $g->delete();
                }
            }
        }

        if ($request->hasFile('gallery')) {

            foreach ($request->file('gallery') as $file) {

                $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

                $imageName = time() . '_gallery_' . $slug . '.webp';
                $imagePath = 'uploads/activities/gallery/' . $imageName;

                $img = $manager->read($file->getRealPath());
                $img->scale(width: 1920);
                $img->encode(new WebpEncoder(75))->save(public_path($imagePath));

                ActivityGallery::create([
                    'activity_id' => $activity->id,
                    'image'       => $imagePath
                ]);
            }
        }

        // ===========================
        // SCHEDULE
        // ===========================
        if ($request->delete_schedule) {
            foreach ($request->delete_schedule as $id) {
                ActivitySchedule::where('id', $id)->delete();
            }
        }

        if ($request->schedule_ids) {
            foreach ($request->schedule_ids as $i => $id) {
                ActivitySchedule::where('id', $id)->update([
                    'day_title'        => $request->schedule_old_day[$i],
                    'schedule_content' => $request->schedule_old_content[$i],
                ]);
            }
        }

        if ($request->schedule_day) {
            foreach ($request->schedule_day as $i => $day) {
                ActivitySchedule::create([
                    'activity_id'      => $activity->id,
                    'day_title'        => $day,
                    'schedule_content' => $request->schedule_content[$i]
                ]);
            }
        }

        return redirect()->route('Admin.Activity.index')
            ->with('success', 'Activity updated successfully.');
    }


    // =====================================================
    //                        DESTROY
    // =====================================================
    public function destroy(Activity $activity)
    {
        foreach ($activity->galleries as $gallery) {
            if (file_exists(public_path($gallery->image))) {
                unlink(public_path($gallery->image));
            }
            $gallery->delete();
        }

        $activity->highlights()->delete();
        $activity->schedules()->delete();

        if ($activity->cover_image && file_exists(public_path($activity->cover_image))) {
            unlink(public_path($activity->cover_image));
        }

        if ($activity->images && file_exists(public_path($activity->images))) {
            unlink(public_path($activity->images));
        }

        $activity->delete();

        return redirect()->route('Admin.Activity.index')
            ->with('success', 'Aktivitas berhasil dihapus.');
    }
}

