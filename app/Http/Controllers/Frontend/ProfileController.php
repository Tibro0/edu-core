<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use FileUpload;
    public function index()
    {
        return view('frontend.student-dashboard.profile.index');
    }

    public function instructorIndex()
    {
        return view('frontend.instructor-dashboard.profile.index');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'headline' => ['nullable', 'max:255', 'string'],
            'email' => ['required', 'max:255', 'string', 'unique:users,email,' . Auth::user()->id],
            'gender' => ['nullable', 'max:255', 'string', 'in:male,female'],
            'about_me' => ['nullable', 'max:6000', 'string'],
            'avatar' => ['nullable', 'image', 'max:3000'],
        ]);

        $user = Auth::user();
        if ($request->hasFile('avatar')) {
            $avatarPath = $this->uploadFile($request->file('avatar'));
            $this->deleteFile($user->image);
            $user->image = $avatarPath;
        }

        $user->name = $request->name;
        $user->headline = $request->headline;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->bio = $request->about_me;
        $user->save();

        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:5', 'confirmed']
        ], [
            'current_password.current_password' => 'Current Password is invalid!',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back();
    }

    public function updateSocial(Request $request)
    {
        $request->validate([
            'facebook' => ['nullable', 'url', 'max:255'],
            'x' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
        ]);

        $user = Auth::user();
        $user->facebook = $request->facebook;
        $user->x = $request->x;
        $user->linkedin = $request->linkedin;
        $user->website = $request->website;
        $user->save();

        return redirect()->back();
    }
}
