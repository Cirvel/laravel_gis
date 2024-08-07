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
    <header>
        <ul class="nav justify-content-between">
            <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('crud') }}">Return</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-success" href="{{ route('restaurants.create') }}">New Restaurant</a>
            </li>
        </ul>
    </header>
    <div class="justify-content-center align-content-center m-3">
        <table>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 4ch">#</th>
                            <th scope="col" style="width: 128px">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Address</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">Latitude</th>
                            <th scope="col" style="width: 6ch">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr class="table-row">
                                <td>{{ $item->id }}</td>
                                <td>
                                    <img src="/assets/images/{{ $item->image }}" alt="{{ $item->image }}"
                                        width="128">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->menu }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->latitude }}</td>
                                <td>{{ $item->longitude }}</td>
                                <td>
                                    <a class="btn btn-warning" title="Edit this item"
                                        href="{{ route('restaurants.edit', $item->id) }}"><i class="fa fa-edit"
                                            aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </table>
    </div>
</body>

@include('script')

</html>
