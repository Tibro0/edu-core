<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseLanguageDataTable;
use App\Http\Controllers\Controller;
use App\Models\CourseLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CourseLanguageDataTable $dataTable)
    {
        return $dataTable->render('admin.course.course-language.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.course-language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:course_languages,name'],
        ]);

        $language = new CourseLanguage();
        $language->name = $request->name;
        $language->slug = Str::slug($request->name);
        $language->save();

        toastr()->success('Created Successfully!');
        return redirect()->route('admin.course-language.index');
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
        $language = CourseLanguage::findOrFail($id);
        return view('admin.course.course-language.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:course_languages,name,'.$id],
        ]);

        $language = CourseLanguage::findOrFail($id);
        $language->name = $request->name;
        $language->slug = Str::slug($request->name);
        $language->save();

        toastr()->success('Updated Successfully!');
        return redirect()->route('admin.course-language.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CourseLanguage::findOrFail($id)->delete();

         return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
