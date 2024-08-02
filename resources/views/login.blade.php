
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container w-50">
        @if (session('message'))
            <div class="alert alert-success ">
                {{ session('message') }}
            </div>
        @endif
        @if (session('errorLogin'))
        <div class="alert alert-danger ">
            {{ session('errorLogin') }}
        </div>
    @endif
    @auth
        <span>Xin chào {{ Auth::user()->fullname }} </span>
        <a href="{{route('show',Auth::user()->id)}}">Thông tin tài khoản</a>
        <a href="{{route('change_password')}}" class="btn btn-primary"> Đổi mật khẩu</a>

        <a href="{{route('logout') }}">Đăng Xuất</a>

    @endauth
        <h1>Login</h1>
        <form action="{{ route('postLogin') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" name="email" id="" class="form-control">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" id="" class="form-control">
            </div>
            <div class="mb-3  d-flex gap-2">
                <button type="submit" class="btn btn-success">Login</button>
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            </div>
            
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>


</html>
