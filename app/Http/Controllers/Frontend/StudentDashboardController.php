<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    use FileUpload;
    public function index()
    {
        return view('frontend.student-dashboard.index');
    }

    public function becomeInstructor()
    {
        if (Auth::user()->role === 'instructor') {
            return redirect()->route('instructor.dashboard');
        } else if (Auth::user()->role === 'student'){
            return view('frontend.student-dashboard.become-instructor.index');
        }
    }

    public function becomeInstructorUpdate(Request $request)
    {
        $request->validate(['document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:12000']]);
        $filePath = $this->uploadFile($request->file('document'));

        $user = Auth::user();
        $user->document = $filePath;
        $user->approve_status = 'pending';
        $user->save();

        return redirect()->route('student.dashboard');
    }
}
