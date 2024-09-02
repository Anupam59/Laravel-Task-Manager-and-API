@extends('Admin.Layout.AdminLayout')
@section('title', 'Task')
@section('AdminContent')

    <div class="content-wrapper" style="min-height: 1604.08px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Task</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Task</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

        @if(!$Task->isEmpty())

                <div class="card pt-2">
                    <form action="{{ url('admin/task-list') }}" method="get" class="formDiv">
                        <div class="row gy-4 justify-content-center">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date Range</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="date_range" class="form-control float-right" id="reservation"
                                               value="@if(request()->query('date_range')){{ request()->query('date_range') }}@endif">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="task_status" name="status">
                                        <option value="" selected="selected">Select One</option>
                                        <option value="1" @if(request()->query('status') == "1") {{ 'selected' }} @endif>Pending</option>
                                        <option value="2" @if(request()->query('status') == "2") {{ 'selected' }} @endif>Progress</option>
                                        <option value="3" @if(request()->query('status') == "3") {{ 'selected' }} @endif>Completed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="invisible d-block">Search</label>
                                <input class="btn btn-default" type="reset" value="Reset">
                                <input class="btn btn-default" type="submit" value="Search">
                            </div>
                        </div>
                    </form>
                </div>

            <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin/') }}/task-create">
                            Add <i class="fas fa-plus"></i>
                        </a>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th style="width: 1%">
                                    SL
                                </th>
                                <th style="width: 60%">
                                    Title
                                </th>
                                <th style="width: 20%">
                                    Creator
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th style="width: 20%" class="text-right">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($Task as $key=>$TaskItem)

                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <a>{{ $TaskItem->task_title }}</a>
                                    </td>
                                    <td>
                                        <a>{{ $TaskItem->creator_by }}</a>
                                    </td>
                                    <td class="project-state">
                                        @if($TaskItem->status == 1)
                                            <span class="badge badge-primary">Pending</span>
                                        @elseif($TaskItem->status == 2)
                                            <span class="badge badge-info">Progress</span>
                                        @elseif($TaskItem->status == 3)
                                            <span class="badge badge-success">Completed</span>
                                        @endif
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ url('/admin/') }}/task-edit/{{ $TaskItem->task_id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="#">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center">
                        {{ $Task->onEachSide(3)->links('Admin.Common.Paginate') }}
                    </div>
                </div>

            @else
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin/') }}/task-create">
                            Add <i class="fas fa-plus"></i>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @include('Admin.Common.DataNotFound')
            @endif

        </section>
        <!-- /.content -->
    </div>

@endsection

@section('AdminScript')
    <script>
        //Date range picker
        $('#reservation').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD',
                cancelLabel: 'Clear'
            }
        });

        $('#reservation').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

    </script>
@endsection
