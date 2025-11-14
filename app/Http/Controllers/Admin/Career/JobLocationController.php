<?php

namespace App\Http\Controllers\Admin\Career;

use App\Http\Controllers\Controller;
use App\Models\JobLocation;
use Illuminate\Http\Request;
use Str;

class JobLocationController extends Controller
{
    public function index()
    {
        $locations = JobLocation::latest()->get();
        return view('admin.career.locations.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        JobLocation::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return back()->with('success','Location created');
    }

    public function update(Request $request, $id)
    {
        $location = JobLocation::findOrFail($id);

        $location->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return back()->with('success','Location updated');
    }

    public function destroy($id)
    {
        JobLocation::findOrFail($id)->delete();
        return back()->with('success','Location deleted');
    }
}
