<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(CourseCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.course.course-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.course-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'icon' => ['required', 'max:255'],
            'name' => ['required', 'string', 'max:255', 'unique:course_categories,name'],
            'show_at_trending' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        $imagePath = $this->uploadFile($request->file('image'));

        $category = new CourseCategory();
        $category->image = $imagePath;
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug  = Str::slug($request->name);
        $category->show_at_trending  =  $request->show_at_trending === '1' ? 1 : 0;
        $category->status  =  $request->status === '1' ? 1 : 0;
        $category->save();

        toastr()->success('Created Successfully!');
        return redirect()->route('admin.course-category.index');
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
        $category = CourseCategory::findOrFail($id);
        return view('admin.course.course-category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'icon' => ['required', 'max:255'],
            'name' => ['required', 'string', 'max:255', 'unique:course_categories,name,' . $id],
            'show_at_trending' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        $category = CourseCategory::findOrFail($id);

        if ($request->file('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $this->deleteFile($category->image);
            $category->image = $imagePath;
        }

        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug  = Str::slug($request->name);
        $category->show_at_trending  = $request->show_at_trending === '1' ? 1 : 0;
        $category->status  = $request->status === '1' ? 1 : 0;
        $category->save();

        toastr()->success('Updated Successfully!');
        return redirect()->route('admin.course-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CourseCategory::findOrFail($id);
        $this->deleteFile($category->image);
        $category->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
