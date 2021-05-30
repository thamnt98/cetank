<!DOCTYPE html>
<html lang="en">

<head>
    <title>Forgot Password</title>


    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/style.css') }}">
</head>
<body class="fix-menu">

<section class="login p-fixed d-flex text-center bg-primary common-img-bg">

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="login-card card-block auth-body mr-auto ml-auto">
                    <form class="md-float-material" action="{{ route('admin.password.update') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="text-center">
                            <img src="{{ asset('images/logo.png') }}" alt="logo.png">
                        </div>
                        <div class="auth-box">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center txt-primary">Forgot Password</h3>
                                </div>
                            </div>
                            <hr />
                            @if ($message = Session::get('success'))
                                <div class="alert alert-warning alert-dismissable background-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{ $message }}
                                </div>
                            @endif
                            @if($errors->any())
                                @foreach ($errors->all() as $error)

                                    <div class="alert alert-danger alert-dismissable background-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {!!  $error !!}
                                    </div>
                                @endforeach
                            @endif
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="input-group m-t-25">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="password" placeholder="New Password">
                                <span class="md-line"></span>
                            </div>
                            <div class="input-group m-t-25">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="password_confirmation" placeholder="Confirm Password">
                                <span class="md-line"></span>
                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-12">
                                    <div class="forgot-phone text-right f-right">
                                        <a href="{{ route('admin.login') }}" class="text-right">Login here</a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row m-t-25">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Reset password</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

</section>


<script src="{{ asset('admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
</body>

</html>
