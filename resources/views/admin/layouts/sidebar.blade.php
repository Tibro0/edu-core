<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">St</a>
        </div>
        <ul class="sidebar-menu">

            <li class="active"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="far fa-square"></i>
                    <span>Dashboard</span></a></li>

            <li class="active"><a class="nav-link" href="{{ route('admin.instructor-request.index') }}"><i
                        class="far fa-square"></i>
                    <span>Instructor Request</span></a></li>


            <li class="dropdown">
                <a href="javascript:;" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Course
                        Management</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.course-category.index') }}">Course Categories</a></li>
                    <li><a class="nav-link" href="{{ route('admin.course-language.index') }}">Course Languages</a></li>
                    <li><a class="nav-link" href="{{ route('admin.course-level.index') }}">Course Levels</a></li>
                </ul>
            </li>

            {{-- <li class="dropdown">
                <a href="javascript:;" class="nav-link has-dropdown"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                    <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                </ul>
            </li> --}}

            {{-- <li class="active"><a class="nav-link" href="blank.html"><i class="far fa-square"></i>
                    <span>Blank Page</span></a></li> --}}

        </ul>
    </aside>
</div>
