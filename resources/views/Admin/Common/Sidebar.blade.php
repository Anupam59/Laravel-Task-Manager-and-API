<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin/') }}/dashboard" class="brand-link">
        <img src="{{ asset('Admin/dist/img/logo.jpg') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Task Management System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user admin (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('Admin/dist/img/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ url('/admin/') }}/profile" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('/admin/') }}/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ url('/admin/') }}/task-list" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Task</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admin/') }}/profile" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Profile</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admin/') }}/profile-password-update" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Update Password</p>
                    </a>
                </li>

                <li class="nav-item">
                    <form class="nav-link" action="{{ route('logout') }}" method="post">
                        @csrf
                        <i class="far fa-circle nav-icon"></i>
                        <button type="submit" class="d-inline LLutton w-100">Logout</button>
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
