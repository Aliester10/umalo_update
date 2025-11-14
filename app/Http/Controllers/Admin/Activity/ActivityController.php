<?php

namespace App\Http\Controllers\Admin\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityGallery;
use App\Models\ActivityHighlight;
use App\Models\ActivitySchedule;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        $request->validate([
            'images'        => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'cover_image'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title'         => 'required|string|max:255',
            'description'   => 'required|string'
        ]);

        // Upload main image
        $imagePath = null;
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move('uploads/activities/images/', $filename);
            $imagePath = 'uploads/activities/images/'.$filename;
        }

        // Upload cover image
        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = 'cover_'.time().'_'.$file->getClientOriginalName();
            $file->move('uploads/activities/images/', $filename);
            $coverPath = 'uploads/activities/images/'.$filename;
        }

        $activity = Activity::create([
            'images'        => $imagePath,
            'cover_image'   => $coverPath,
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

        // Highlights
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

        // Gallery
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $name = time().'_'.$file->getClientOriginalName();
                $file->move('uploads/activities/gallery/', $name);

                ActivityGallery::create([
                    'activity_id' => $activity->id,
                    'image'       => 'uploads/activities/gallery/'.$name
                ]);
            }
        }

        // Schedules
        if ($request->schedule_day && $request->schedule_content) {
            foreach ($request->schedule_day as $i => $day) {
                ActivitySchedule::create([
                    'activity_id' => $activity->id,
                    'day_title' => $day,
                    'schedule_content' => $request->schedule_content[$i]
                ]);
            }
        }

        return redirect()->route('Admin.Activity.index')->with('success', 'Activity created successfully.');
    }


    public function edit(Activity $activity)
    {
        $activity->load(['highlights', 'galleries', 'schedules']);
        return view('Admin.Activity.edit', compact('activity'));
    }


    // ================================================================
    //                          UPDATE SECTION
    // ================================================================
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'images'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cover_image'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title'         => 'required|string|max:255',
            'description'   => 'required|string'
        ]);

        // ================== UPDATE MAIN IMAGE ==================
        if ($request->hasFile('images')) {
            if ($activity->images && file_exists(public_path($activity->images))) {
                unlink(public_path($activity->images));
            }

            $file = $request->file('images');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move('uploads/activities/images/', $filename);
            $activity->images = 'uploads/activities/images/'.$filename;
        }

        // ================= UPDATE COVER IMAGE ===================
        if ($request->hasFile('cover_image')) {
            if ($activity->cover_image && file_exists(public_path($activity->cover_image))) {
                unlink(public_path($activity->cover_image));
            }

            $file = $request->file('cover_image');
            $filename = 'cover_'.time().'_'.$file->getClientOriginalName();
            $file->move('uploads/activities/images/', $filename);
            $activity->cover_image = 'uploads/activities/images/'.$filename;
        }

        // ================== UPDATE BASIC FIELDS ==================
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


        // ======================================================
        //                      HIGHLIGHTS
        // ======================================================

        // HAPUS highlight lama
        if ($request->delete_highlight) {
            foreach ($request->delete_highlight as $id) {
                ActivityHighlight::where('id', $id)->delete();
            }
        }

        // UPDATE highlight lama
        if ($request->highlight_ids) {
            foreach ($request->highlight_ids as $i => $id) {
                ActivityHighlight::where('id', $id)->update([
                    'highlight' => $request->highlights_old[$i]
                ]);
            }
        }

        // TAMBAH highlight baru
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


        // ======================================================
        //                        GALLERY
        // ======================================================

        // HAPUS foto gallery
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

        // TAMBAH gallery baru
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move('uploads/activities/gallery/', $filename);

                ActivityGallery::create([
                    'activity_id' => $activity->id,
                    'image'       => 'uploads/activities/gallery/'.$filename
                ]);
            }
        }


        // ======================================================
        //                     SCHEDULE (JADWAL)
        // ======================================================

        // HAPUS schedule lama
        if ($request->delete_schedule) {
            foreach ($request->delete_schedule as $id) {
                ActivitySchedule::where('id', $id)->delete();
            }
        }

        // UPDATE schedule lama
        if ($request->schedule_ids) {
            foreach ($request->schedule_ids as $i => $id) {
                ActivitySchedule::where('id', $id)->update([
                    'day_title'        => $request->schedule_old_day[$i],
                    'schedule_content' => $request->schedule_old_content[$i],
                ]);
            }
        }

        // TAMBAH schedule baru
        if ($request->schedule_day) {
            foreach ($request->schedule_day as $i => $day) {
                if (!empty(trim($day))) {
                    ActivitySchedule::create([
                        'activity_id'      => $activity->id,
                        'day_title'        => $day,
                        'schedule_content' => $request->schedule_content[$i]
                    ]);
                }
            }
        }


        return redirect()->route('Admin.Activity.index')
            ->with('success', 'Activity updated successfully.');
    }


    // ======================================================
    //                      DESTROY
    // ======================================================
    public function destroy(Activity $activity)
    {
        // hapus gallery
        foreach ($activity->galleries as $gallery) {
            if (file_exists(public_path($gallery->image))) {
                unlink(public_path($gallery->image));
            }
            $gallery->delete();
        }

        // hapus highlight
        $activity->highlights()->delete();

        // hapus schedule
        $activity->schedules()->delete();

        // hapus cover image
        if ($activity->cover_image && file_exists(public_path($activity->cover_image))) {
            unlink(public_path($activity->cover_image));
        }

        // hapus main image
        if ($activity->images && file_exists(public_path($activity->images))) {
            unlink(public_path($activity->images));
        }

        $activity->delete();

        return redirect()->route('Admin.Activity.index')
            ->with('success', 'Aktivitas berhasil dihapus.');
    }
}
