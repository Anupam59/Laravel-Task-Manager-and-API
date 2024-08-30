<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user admin (optional) -->
        <div class="user-admin mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
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
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Site Information
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/admin/') }}/site-data" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Site Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/') }}/site-info" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Site Info</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/') }}/site-social-media" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Site Media</p>
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="nav-item">
                    <a href="{{ url('/admin/') }}/common-page-list" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Common Page</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admin/') }}/event-list" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Event</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admin/') }}/gallery-list" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Gallery</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admin/') }}/testimonial-list" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Testimonial</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admin/') }}/chef-list" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Chef</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admin/') }}/menu-list" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Menu</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admin/') }}/menu-item-list" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>MenuItem</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admin/') }}/platter-list" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Platter</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
