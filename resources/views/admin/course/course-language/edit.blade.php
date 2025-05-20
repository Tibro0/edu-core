@extends('admin.layouts.master')

@push('admin-css')
    <title>Admin | Update Language</title>
@endpush

@section('admin-content')
    <section class="section">
        <div class="section-header">
            <h1>Update Language</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Language</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.course-language.update', $language->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $language->name }}" class="form-control">
                        @if ($errors->has('name'))
                            <div class="text-danger mt-2">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
