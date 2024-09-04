@extends('Admin.Layout.AdminLayout')
@section('title', 'Profile')
@section('AdminContent')
    <?php
    $user = auth()->user();
    ?>
    <div class="content-wrapper" style="min-height: 1604.08px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-default btn-sm add_btn" href="#">
                            Your Profile Details
                        </a>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body pb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5 text-center">
                                    <h4><b>Name:</b> {{$user->name}}</h4>
                                    <h4><b>Email:</b> {{$user->email}}</h4>
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <a href="{{ url('/admin/') }}/profile-edit/{{ $user->id }}" class="btn btn-primary">Update Profile</a>
                            </div>

                            <div class="col-md-12 text-center mt-2">
                                <a href="{{ url('/admin/') }}/profile-password-update" class="btn btn-info">Update Password</a>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
        </section>
        <!-- /.content -->
    </div>

@endsection

@section('AdminScript')
    <script>

    </script>
@endsection
