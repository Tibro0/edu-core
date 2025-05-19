@extends('frontend.layouts.master')

@push('frontend-css')
    <title>EduCore | Student Dashboard</title>
@endpush

@section('frontend-content')
    <!--===========================BREADCRUMB START============================-->
    <section class="wsus__breadcrumb" style="background: url({{ asset('frontend/images/breadcrumb_bg.jpg') }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Student Dashboard</h1>
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li>Student Dashboard</li>
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
                    @if (auth()->user()->approve_status === 'pending')
                        <div class="alert alert-danger text-center" role="alert">
                            Hi, {{ auth()->user()->name }} your Instructor request is currently Pending. We will Send a
                            Mail to your Email when it will be approved.
                        </div>
                    @endif

                    <div class="text-end">
                        <a href="{{ route('student.become-instructor') }}" class="btn btn-primary">Become a Instructor</a>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>REVENUE</h6>
                                <h3>$2456.34</h3>
                                <p>Earning this month</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>STUDENTS ENROLLMENTS</h6>
                                <h3>16,450</h3>
                                <p>Progress this month</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>COURSES RATING</h6>
                                <h3>4.70</h3>
                                <p>Rating this month</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--===========================DASHBOARD OVERVIEW END============================-->
@endsection
