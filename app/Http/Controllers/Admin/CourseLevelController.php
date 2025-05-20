<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseLevelDataTable;
use App\Http\Controllers\Controller;
use App\Models\CourseLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CourseLevelDataTable $dataTable)
    {
        return $dataTable->render('admin.course.course-level.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.course-level.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:course_levels,name'],
        ]);

        $level = new CourseLevel();
        $level->name = $request->name;
        $level->slug = Str::slug($request->name);
        $level->save();

        toastr()->success('Created Successfully!');
        return redirect()->route('admin.course-level.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $level = CourseLevel::findOrFail($id);
        return view('admin.course.course-level.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:course_levels,name,' . $id],
        ]);

        $level = CourseLevel::findOrFail($id);
        $level->name = $request->name;
        $level->slug = Str::slug($request->name);
        $level->save();

        toastr()->success('Updated Successfully!');
        return redirect()->route('admin.course-level.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CourseLevel::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
