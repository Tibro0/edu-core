<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\InstructorRequestDataTable;
use App\Http\Controllers\Controller;
use App\Mail\InstructorRequestApprovedMail;
use App\Mail\InstructorRequestRejectMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InstructorRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(InstructorRequestDataTable $dataTable)
    {
        return $dataTable->render('admin.instructor-request.index');
    }

    public function download(User $user)
    {
        return response()->download(public_path($user->document));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $instructorRequest = User::findOrFail($id);
        return view('admin.instructor-request.edit', compact('instructorRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $instructor_request)
    {
        $request->validate(['status' => ['required', 'in:approved,rejected,pending']]);
        $instructor_request->approve_status = $request->status;
        $request->status == 'approved' ? $instructor_request->role = 'instructor' : "";
        $instructor_request->save();

        switch ($instructor_request->approve_status) {
            case 'approved':
                if (config('mail_queue.is_queue')) {
                    Mail::to($instructor_request->email)->queue(new InstructorRequestApprovedMail());
                } else {
                    Mail::to($instructor_request->email)->send(new InstructorRequestApprovedMail());
                }
                break;
            case 'rejected':
                if (config('mail_queue.is_queue')) {
                    Mail::to($instructor_request->email)->queue(new InstructorRequestRejectMail());
                } else {
                    Mail::to($instructor_request->email)->send(new InstructorRequestRejectMail());
                }
        }

        return redirect()->route('admin.instructor-request.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
