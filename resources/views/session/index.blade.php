<!DOCTYPE html>

<html data-bs-theme="dark">

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="justify-content-center align-content-center vh-100">
        <form action="{{ route('auth') }}" method="post" class="container-sm card border-0 form-body">
            @csrf
            @method("post")
            <div class="border-bottom fw-bold text-uppercase mb-3">Login Admin</div>
            <input type="text" name="name" placeholder="Username" class="form-control mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control mb-3">
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success text-uppercase">
                    <i class="fa fa-sign-in" aria-hidden="true"></i>
                    <span class="d-none d-md-inline">
                        Login
                    </span>
                </button>
            </div>
        </form>
    </div>
</body>

</html>
