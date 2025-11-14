<?php

namespace App\Http\Controllers\Guest\Activity;

use App\Helpers\TranslateHelper;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityGuestController extends Controller
{
    /**
     * Halaman daftar activity
     */
    public function activity(Request $request)
    {
        $sort = $request->get('sort', 'newest');
        $locale = app()->getLocale();

        // Sorting
        if ($sort === 'latest') {
            $activities = Activity::orderBy('start_date', 'asc')->paginate(8);
        } else {
            $activities = Activity::orderBy('start_date', 'desc')->paginate(8);
        }

        // Translate
        foreach ($activities as $activ) {
            $activ->title = TranslateHelper::translate($activ->title, $locale);
            $activ->description = TranslateHelper::translate($activ->description, $locale);
        }

        return view('guest.activity.activity', compact('activities', 'sort'));
    }

    /**
     * Halaman detail activity (menggunakan slug)
     */
public function show($slug)
{
    $activity = Activity::where('slug', $slug)->firstOrFail();

    // translate
    $locale = app()->getLocale(); 
    $activity->title = TranslateHelper::translate($activity->title, $locale);
    $activity->description = TranslateHelper::translate($activity->description, $locale);

    // ADD THIS
    $activities = Activity::paginate(8);

    return view('guest.activity.detail-act', compact('activity','activities'));
}


}
