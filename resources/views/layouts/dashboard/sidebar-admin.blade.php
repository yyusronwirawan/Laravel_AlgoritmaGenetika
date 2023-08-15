<aside class="main-sidebar main-sidebar-custom sidebar-dark-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link bg-lightblue text-center">
        <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-bold" style="color: #111111;">{{ config('app.name', 'Jadwal KBM with PSO') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('') }}images/thumbnail/user.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        @if (auth()->user()->hasRole('admin'))
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat nav-legacy"
                data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.data_times.index') }}" class="nav-link {{ Request::is('admin/data_times*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Data Time</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.data_days.index') }}" class="nav-link {{ Request::is('admin/data_days*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Data Day</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.data_rooms.index') }}" class="nav-link {{ Request::is('admin/data_rooms*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Data Room</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.data_classrooms.index') }}" class="nav-link {{ Request::is('admin/data_classrooms*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Data Classroom</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.data_courses.index') }}" class="nav-link {{ Request::is('admin/data_courses*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Data Course</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.data_teachers.index') }}" class="nav-link {{ Request::is('admin/data_teachers*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Data Teacher</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.data_schedules.index') }}" class="nav-link {{ Request::is('admin/data_schedules*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Data Schecule</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        @else
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat nav-legacy"
                data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('teacher.dashboard') }}" class="nav-link {{ Request::is('teacher/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.data_schedules.index') }}" class="nav-link {{ Request::is('teacher/data_schedules*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Data Schecule</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        @endif
    </div>
    <!-- /.sidebar -->
    <div class="sidebar-custom accent-lightblue">
        <!-- <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a> -->

        <!-- Logout Start -->
        <a href="index.html" class="btn btn-danger hide-on-collapse btn-block"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
        </form>
        <!-- Logout End -->
    </div>
    <!-- /.sidebar-custom -->
</aside>
