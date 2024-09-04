@extends('Admin.Layout.AdminLayout')
@section('title', 'Task')
@section('AdminContent')
    <?php
    date_default_timezone_set("Asia/Dhaka");
    ?>
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
                            <div class="col-md-5">
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

                            <div class="col-md-2">
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
                                <input style="width: 70px" class="btn btn-default" id="resetID" value="Reset">
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
                                <th style="width: 55%">
                                    Title
                                </th>
                                <th style="width: 10%">
                                    Creator
                                </th>
                                <th style="width: 15%" class="text-center">
                                    Date
                                </th>
                                <th style="width: 9%" class="text-center">
                                    Status
                                </th>
                                <th style="width: 10%" class="text-center">
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
                                    <td class="text-center">
                                        <a>{{ date('d M Y h:i a', strtotime($TaskItem->created_date)) }}</a>
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
                                    <td class="project-actions text-center">
                                        <a class="btn btn-primary btn-sm" href="{{ url('/admin/') }}/task-edit/{{ $TaskItem->task_id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm taskDeleteBtn" data-id="{{ $TaskItem->task_id }}">
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




    <div class="modal fade" id="deleteTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('admin/task-delete')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-3 text-center">
                        <h5 class="mt-4">Do You Want To Delete?</h5>
                        <input id="TaskDeleteId" type="hidden" name="task_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                        <button  id="TaskDeleteConfirmBtn" type="submit" class="btn  btn-sm  btn-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('AdminScript')
    <script>
        //Date range picker
        $('#reservation').daterangepicker({
            timePicker: true,
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD hh:mm A',
                cancelLabel: 'Clear'
            }
        });

        $('#reservation').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD hh:mm A') + ' - ' + picker.endDate.format('YYYY-MM-DD hh:mm A'));
        });

        $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('#resetID').click(function(){
            $('#reservation').val('');
            $('#task_status').val('');
        });


        $('.taskDeleteBtn').click(function(){
            var id= $(this).data('id');
            $('#TaskDeleteId').val(id);
            $('#deleteTaskModal').modal('show');
        })

    </script>
@endsection
