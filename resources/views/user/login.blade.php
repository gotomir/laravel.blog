<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Авторизация</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">

</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <p><h2> <b>Авторизация</b></h2></p>
        </div>
        <div class="card-body">
            {{--            Место под выведение валидации--}}
            @include('admin.layouts.error')
            <form action="{{ route('login') }}" method="post">
                @csrf


                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email"  placeholder="Email" value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Войти</button>
                    </div>
                </div>
            </form>

            <a href="{{ route('register.create') }}" class="text-center">Регистрация</a><br>
            <a href="{{ route('home') }}" class="text-center">Главная</a>
        </div>

    </div>
</div>


<script src="{{ asset('assets/admin/js/admin.js') }}"></script>
</body>
</html>
