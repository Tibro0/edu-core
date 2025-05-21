@extends('admin.layouts.master')

@push('admin-css')
    <title>Admin | Create Course Category</title>
@endpush

@section('admin-content')
    <section class="section">
        <div class="section-header">
            <h1>Create Course Category</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Create Course Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.course-category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                        @if ($errors->has('image'))
                            <div class="text-danger mt-2">{{ $errors->first('image') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Icon</label>
                        <input type="text" name="icon" value="{{ old('icon') }}" class="form-control">
                        @if ($errors->has('icon'))
                            <div class="text-danger mt-2">{{ $errors->first('icon') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        @if ($errors->has('name'))
                            <div class="text-danger mt-2">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Show At Trending</label><br>
                                <label class="custom-switch">
                                    <input type="checkbox" name="show_at_trending" value="1"
                                        class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status</label><br>
                                <label class="custom-switch">
                                    <input type="checkbox" name="status" value="1" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('admin-js')
    <!-- image-preview js -->
    <script src="{{ asset('admin/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script>
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
    </script>
@endpush
