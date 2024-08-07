<!DOCTYPE html>

<html data-bs-theme="dark">

<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <header>
        <ul class="nav justify-content-center  ">
            <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('logout') }}">Logout</a>
            </li>
        </ul>
    </header>
    <div class="justify-content-center align-content-center vh-100">
        <div action="backend/try_login.php" method="post" class="container-sm card border-0 form-body">
            <div class="border-bottom mb-3">
                <div class="h3">
                    Dashboard
                </div>
            </div>
            <a class="btn btn-light fw-bold" href="{{ route('restaurants.index') }}">Restaurant</a>
        </div>
    </div>
</body>

</html>
