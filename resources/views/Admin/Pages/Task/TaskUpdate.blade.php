@extends('Admin.Layout.AdminLayout')
@section('title', 'Task Update')
@section('AdminContent')
    <div class="content-wrapper" style="min-height: 1604.08px;" data-select2-id="31">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Task Update</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Task Update</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>



        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card card-default">

                    <div class="card-header">

                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin/') }}/task-list">
                            All Data
                        </a>


                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>



                    <div class="card-body">


                        @if ($errors->any())
                            <div class="alert alert-default-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        @if (session('success_message'))
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('success_message') }}
                            </div>
                        @elseif (session('error_message'))
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('error_message') }}
                            </div>
                        @else

                        @endif

                        <form action="{{ url('admin/task-update/'.$Task->task_id)}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{ $Task->task_title }}" name="task_title" placeholder="Title">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" id="task_description" name="task_description" placeholder="Description ...">{{ $Task->task_description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>File: maximum size 1 mb</label>
                                        <input type="file" class="form-control" name="task_file">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="invisible">Have a</label>
                                        @if($Task->task_file)
                                        <p>Have a File->
                                            <button type="button" class="btn btn-sm btn-default" id="HaveFileId">
                                                Show File
                                            </button>
                                        </p>
                                        @endif

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date Range</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="date_range" class="form-control float-right" id="reservation" value="{{ $Task->start_date }} - {{ $Task->end_date }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>To User</label>
                                        <select class="form-control select2" id="to_user_id" name="to_user_id" required>
                                            <option value="" selected="selected">Select One</option>
                                            @if($AllUser)
                                                @foreach($AllUser as $User)
                                                    <option value="{{ $User->id }}" @if($User->id == $Task->to_user_id) {{ 'selected' }} @endif > {{ $User->name }}</option>
                                                @endforeach
                                            @else

                                            @endif
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" id="task_status" name="status">
                                            <option value="" selected="selected">Select One</option>
                                            <option value="1" @if($Task->status == "1") {{ 'selected' }} @endif>Pending</option>
                                            <option value="2" @if($Task->status == "2") {{ 'selected' }} @endif>Progress</option>
                                            <option value="3" @if($Task->status == "3") {{ 'selected' }} @endif>Completed</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>




    <div class="modal fade" id="FileLoadModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">File Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    @if($Extension)
                        @if($Extension == 'pdf')
                            <div class="row justify-content-center">
                                <div class="col-md-10 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                                    <iframe src="{{asset($Task->task_file)}}" style="width:100%; height:500px;" frameborder="0"></iframe>
                                </div>
                            </div>
                        @endif
                    @endif


                    @if($Extension)
                        @if($Extension != 'pdf')
                            <div class="row justify-content-center">
                                <div class="col-md-8 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                                    <img src="{{asset($Task->task_file)}}" class="img-fluid" alt="">
                                </div>
                            </div>
                        @endif
                    @endif

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>










@endsection

@section('AdminScript')
    <script>
        $('#to_user_id').select2();
        $('#task_status').select2();
        $('#task_description').summernote({
            placeholder: 'News Description',
            height: 120,
        });

        //Date range picker
        $('#reservation').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            }
        });


        $('#HaveFileId').click(function(){
            $('#FileLoadModal').modal('show');
        });
    </script>
@endsection
