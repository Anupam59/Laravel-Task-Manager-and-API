@extends('auth.Layout.AuthLayout')
@section('AuthContent')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <P>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</P>
                </div>


                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success">
                        <p>A new verification link has been sent to the email address you provided during registration.</p>
                    </div>
                @endif


                <div class="mt-4 d-flex justify-content-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <button type="submit" class="btn btn-sm btn-primary">
                                Resend Verification Email
                            </button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-sm btn-danger">
                            Log Out
                        </button>
                    </form>
                </div>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
@section('AuthScript')
    <script>

    </script>
@endsection
