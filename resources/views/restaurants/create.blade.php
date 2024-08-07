<!DOCTYPE html>

<html data-bs-theme="dark">

<head>
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="justify-content-center align-content-center vh-100">
        <a href="{{ route('restaurants.index') }}" class="btn btn-danger m-3"><i class="fa fa-x"
                aria-hidden="true"></i><span class="d-none d-md-inline"> Return</span></a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('restaurants.store') }}" method="post" class="container-sm card border-0 form-body"
            enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="border-bottom fw-bold text-uppercase mb-3">Create Restaurant</div>
            <input type="text" name="name" placeholder="Name" class="form-control mb-3" required>
            <input type="file" name="image" placeholder="Image" class="form-control mb-3" accept="image/*"
                required>
            <textarea name="description" placeholder="Description" style="resize: none" cols="30" rows="5"
                class="form-control resize-none mb-3" required></textarea>
            <textarea name="menu" placeholder="Menu" cols="30" rows="5" style="resize: none" class="form-control resize-none mb-3"
                required></textarea>
            <textarea name="address" placeholder="Address" cols="30" rows="3" style="resize: none" class="form-control mb-3"
                required></textarea>
            <input type="text" name="latitude" placeholder="Latitude" class="form-control mb-3" required>
            <input type="text" name="longitude" placeholder="Longitude" class="form-control mb-3" required>
            {{-- <textarea name="embed" placeholder="Embed" cols="30" rows="3" style="resize: none" class="form-control mb-3"
                required></textarea> --}}
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success text-uppercase">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    <span class="d-none d-md-inline">
                        Confirm 
                    </span>
                </button>
            </div>
        </form>
    </div>
</body>

</html>
