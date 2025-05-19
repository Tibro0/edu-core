@extends('admin.layouts.master')

@push('admin-css')
    <title>Admin | Update Instructor Request</title>
@endpush

@section('admin-content')
    <section class="section">
        <div class="section-header">
            <h1>Update Instructor Request</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Instructor Request</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.instructor-request.update', $instructorRequest->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $instructorRequest->name }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $instructorRequest->email }}"
                            readonly>
                    </div>


                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option @selected($instructorRequest->approve_status === 'pending') value="pending">Pending</option>
                            <option @selected($instructorRequest->approve_status === 'approved') value="approved">Approved</option>
                            <option @selected($instructorRequest->approve_status === 'rejected') value="rejected">Rejected</option>
                        </select>
                        @if ($errors->has('status'))
                            <div class="text-danger mt-2">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection
