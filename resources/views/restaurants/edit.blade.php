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

        <div class="container-sm card border-0 form-body">

            <form action="{{ route('restaurants.destroy', $data->id) }}" class="d-flex">
                <button type="submit" class="btn btn-danger text-uppercase ms-auto mb-3">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    <span class="d-none d-md-inline">
                        Delete
                    </span>
                </button>
            </form>

            <form action="{{ route('restaurants.update', $data->id) }}" method="post" class=""
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="border-bottom fw-bold text-uppercase mb-3">Edit Restaurant</div>
                <input type="hidden" name="id" id="id" value="{{ $data->id }}" readonly>
                <input type="text" name="name" placeholder="Name" class="form-control mb-3"
                    value="{{ $data->name }}" required>
                <label for="image" class="form-label">Leave blank to keep image</label>
                <input type="file" name="image" placeholder="Image" class="form-control mb-3" accept="image/*">
                <textarea name="description" placeholder="Description" cols="30" rows="10" style="resize: none"
                    class="form-control resize-none mb-3" required>{{ $data->description }}</textarea>
                <textarea name="menu" placeholder="Menu" cols="30" rows="5" style="resize: none"
                    class="form-control resize-none mb-3" required>{{ $data->menu }}</textarea>
                <textarea name="address" placeholder="Address" cols="30" rows="5" style="resize: none"
                    class="form-control resize-none mb-3" required>{{ $data->address }}</textarea>
                <input type="text" name="latitude" placeholder="Latitude" class="form-control mb-3"
                    value="{{ $data->latitude }}" required>
                <input type="text" name="longitude" placeholder="Longitude" class="form-control mb-3"
                    value="{{ $data->longitude }}" required>
                {{-- <textarea name="embed" placeholder="Embed" cols="10" rows="3" style="resize: none"
                    class="resize-none form-control mb-3" required>{{ $data->embed }}</textarea> --}}
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
    </div>
</body>

</html>
