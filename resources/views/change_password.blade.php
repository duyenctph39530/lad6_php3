<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đổi mật khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    @if (session('mes'))
        <div class="alert alert-success">
            {{session('mes')}}
        </div>
    @endif
    <a href="{{route('login')}}" class="btn btn-primary">Back</a>

    <form action="{{ route('updatePassword') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Mật khẩu cũ</label>
            <input type="password" name="old_password" id="" class="form-control" required >

        </div>
        <div class="mb-3">
            <label for="" class="form-label">Mật khẩu mới</label>
            <input type="password" name="new_password" id="" class="form-control" required >

        </div>
        <div class="mb-3">
            <label for="" class="form-label">Xác nhận lại mật khẩu</label>
            <input type="password" name="new_password_confirmation" id="" required class="form-control">

        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</body>

</html>
