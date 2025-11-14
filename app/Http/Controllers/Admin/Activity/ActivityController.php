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
            'description'   => 'required|string',
            'start_date'    => 'nullable|date',
            'end_date'      => 'nullable|date',
            'location'      => 'nullable|string',
            'participants'  => 'nullable|string',
            'duration'      => 'nullable|string',
            'category'      => 'nullable|string',
            'status'        => 'nullable|in:ongoing,completed,upcoming',
            'tags'          => 'nullable|string',
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

        // Create Activity
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
            'status'        => $request->status ?? 'ongoing',
            'tags'          => $request->tags
        ]);

        // Insert Highlights (array)
        if ($request->highlights) {
            foreach ($request->highlights as $highlight) {
                if (!empty(trim($highlight))) {
                    ActivityHighlight::create([
                        'activity_id' => $activity->id,
                        'highlight' => $highlight
                    ]);
                }
            }
        }

        // Insert Gallery Images (multiple)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $gFile) {
                $gName = time().'_'.$gFile->getClientOriginalName();
                $gFile->move('uploads/activities/gallery/', $gName);

                ActivityGallery::create([
                    'activity_id' => $activity->id,
                    'image' => 'uploads/activities/gallery/'.$gName
                ]);
            }
        }

        // Insert Schedules
        if ($request->schedule_day && $request->schedule_content) {
            foreach ($request->schedule_day as $key => $day) {
                ActivitySchedule::create([
                    'activity_id' => $activity->id,
                    'day_title' => $day,
                    'schedule_content' => $request->schedule_content[$key]
                ]);
            }
        }

        return redirect()->route('Admin.Activity.index')
                         ->with('success', 'Activity created successfully.');
    }

    public function edit(Activity $activity)
    {
        $activity->load(['galleries', 'highlights', 'schedules']);
        return view('Admin.Activity.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'images'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cover_image'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'start_date'    => 'nullable|date',
            'end_date'      => 'nullable|date',
            'location'      => 'nullable|string',
            'participants'  => 'nullable|string',
            'duration'      => 'nullable|string',
            'category'      => 'nullable|string',
            'status'        => 'nullable|in:ongoing,completed,upcoming',
            'tags'          => 'nullable|string',
        ]);

        // Update main image
        if ($request->hasFile('images')) {
            if ($activity->images && file_exists(public_path($activity->images))) {
                unlink(public_path($activity->images));
            }

            $file = $request->file('images');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move('uploads/activities/images/', $filename);
            $activity->images = 'uploads/activities/images/'.$filename;
        }

        // Update cover image
        if ($request->hasFile('cover_image')) {
            if ($activity->cover_image && file_exists(public_path($activity->cover_image))) {
                unlink(public_path($activity->cover_image));
            }

            $file = $request->file('cover_image');
            $filename = 'cover_'.time().'_'.$file->getClientOriginalName();
            $file->move('uploads/activities/images/', $filename);
            $activity->cover_image = 'uploads/activities/images/'.$filename;
        }

        // Update main fields - PERBAIKAN: tambahkan images dan cover_image
        $activity->update([
            'images'        => $activity->images,
            'cover_image'   => $activity->cover_image,
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'description'   => $request->description,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'location'      => $request->location,
            'participants'  => $request->participants,
            'duration'      => $request->duration,
            'category'      => $request->category,
            'status'        => $request->status ?? 'ongoing',
            'tags'          => $request->tags
        ]);

        return redirect()->route('Admin.Activity.index')
                         ->with('success', 'Activity updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        if ($activity->images && file_exists(public_path($activity->images))) {
            unlink(public_path($activity->images));
        }

        if ($activity->cover_image && file_exists(public_path($activity->cover_image))) {
            unlink(public_path($activity->cover_image));
        }

        // delete gallery images
        foreach ($activity->galleries as $gallery) {
            if (file_exists(public_path($gallery->image))) {
                unlink(public_path($gallery->image));
            }
            $gallery->delete();
        }

        // delete highlight & schedule
        $activity->highlights()->delete();
        $activity->schedules()->delete();

        // delete activity
        $activity->delete();

        return redirect()->route('Admin.Activity.index')
                         ->with('success', 'Activity deleted successfully.');
    }
}