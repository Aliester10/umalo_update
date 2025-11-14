<?php

namespace App\Http\Controllers\Admin\Career;

use App\Http\Controllers\Controller;
use App\Models\JobDepartment;
use Illuminate\Http\Request;
use Str;

class JobDepartmentController extends Controller
{
    public function index()
    {
        $departments = JobDepartment::latest()->get();
        return view('admin.career.departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        JobDepartment::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return back()->with('success','Department created');
    }

    public function update(Request $request, $id)
    {
        $department = JobDepartment::findOrFail($id);

        $department->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return back()->with('success','Department updated');
    }

    public function destroy($id)
    {
        JobDepartment::findOrFail($id)->delete();
        return back()->with('success','Department deleted');
    }
}
