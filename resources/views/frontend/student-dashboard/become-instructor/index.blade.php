@extends('frontend.layouts.master')

@push('frontend-css')
    <title>EduCore | Become Instructor</title>
@endpush

@section('frontend-content')
    <!--===========================BREADCRUMB START============================-->
    <section class="wsus__breadcrumb" style="background: url({{ asset('frontend/images/breadcrumb_bg.jpg') }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Become Instructor</h1>
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li>Become Instructor</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================BREADCRUMB END============================-->


    <!--===========================DASHBOARD OVERVIEW START============================-->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">

                @include('frontend.student-dashboard.sidebar')

                <div class="col-xl-9 col-md-8">

                    <div class="text-end">
                        <a href="{{ route('student.dashboard') }}" class="common_btn mb-3">Back</a>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Become a Instructor
                        </div>
                        <div class="card-body">
                            <form action="{{ route('student.become-instructor.update') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Document</label>
                                    <input type="file" name="document" class="form-control">
                                    @error('document')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="common_btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================DASHBOARD OVERVIEW END============================-->
@endsection
