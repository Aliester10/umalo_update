<?php

namespace App\Http\Controllers\Admin\Career;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with('position')->latest()->paginate(20);
        return view('admin.career.applications.index', compact('applications'));
    }

    public function show($id)
    {
        $application = JobApplication::with('position')->findOrFail($id);
        return view('admin.career.applications.show', compact('application'));
    }

    public function destroy($id)
    {
        JobApplication::findOrFail($id)->delete();
        return back()->with('success','Application deleted');
    }
}
