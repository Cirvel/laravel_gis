<!DOCTYPE html>

<html data-bs-theme="dark">

<head>
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    <script src="{{ asset('leaflet/leaflet.js') }}"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}" />
</head>

<div class="modal fade" id="popUp" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content" id="modalean">
            <button class="btn btn-secondary" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            </button>
        </div>
    </div>
</div>

<header>
    <nav class="navbar navbar-brand border-bottom mb-3">
        <div class="container text-uppercase fw-bold">
            <a class="navbar-brand" href="#"><img src="{{ asset('favicon.ico') }}" alt="logo" width="48"
                    height="48">
                {{ config('app.name') }}
            </a>
            <button class="btn btn-outline-primary" id="get-loc" title="Get current location" onclick="getLocation()">
                <i class="fa fa-map-pin" aria-hidden="true"></i>
                <span class="fw-bold">
                    Get Location
                </span>
            </button>
        </div>
    </nav>
</header>

<body>
    <div class="row m-0">
        <div class="col-12 col-md-6 container mb-2">
            <div class="d-flex justify-content-center align-items-center card" id="map">
                <div class="spinner-border text-primary spinner-border-lg" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6" id="search-bar">
            {{-- Search Bar --}}
            <div class="input-group d-md-flex mb-3">
                <div class="input-group-text">
                    <i class="fa fa-filter me-2" aria-hidden="true"></i>
                    <select class="form-control" name="filter" id="filter">
                        <option value="name">Name</option>
                        <option value="location">Location</option>
                        <option value="menu">Menu</option>
                        <option value="description">Description</option>
                    </select>
                </div>
                <input class="form-control" type="text" name="search" id="search-text" placeholder="Search">
                <button class="btn btn-primary" onclick="search()" id="search-btn"><i class="fa fa-search"
                        aria-hidden="true"></i></button>
            </div>
            <div class="vh-75 overflow-y-auto" id="search-list">
                {{-- Restaurant Container --}}
            </div>
        </div>
    </div>
</body>

@include('script')
<script src="{{ asset('leaflet/leaflet.js') }}"></script>
<script type="text/javascript">
    var map = L.map('map');
    var self_latitude = "{{ Location::get('182.2.165.212')->latitude }}";
    var self_longitude = "{{ Location::get('182.2.165.212')->longitude }}";

    function search() {
        initMap();
        $.ajax({ // Ajax script
            url: "{{ route('restaurants.search') }}", // Route
            type: "GET", // Method
            data: {
                'search': $('#search-text').val(),
                'filter': $('#filter').val(),
                'latitude': self_latitude,
                'longitude': self_longitude,
            },
            success: function(res) { // If process has no error..
                $('#search-list').html('');

                res.forEach(function(value, index, array) {
                    addMarker(
                        value.latitude,
                        value.longitude,
                        `
                        <img src="/assets/images/${value.image}" style="object-fit: cover; height: 128px; width: 100%;">
                        <hr>
                        <b>${value.name}</b><br>
                        ${value.address}
                        `
                    );

                    $('#search-list').append(`
                    <div class="card mb-3">
                        <div class="card-header d-flex">
                            <div class="card-title me-1"> ${value.name} </div>
                            <div class="ms-auto">
                                <button class="btn btn-info" onclick="popUp( ${value.id} )" id="popBtn" data-bs-toggle="modal" data-bs-target="#popUp">
                                    <i class="fa fa-chart-bar" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-text float">
                                <div class="img-fluid p-3 float-end">
                                    <img class="border border-secondary rounded-3" src="/assets/images/${value.image}" width="128"
                                        height="128" alt="${value.image}" style="object-fit: cover;">
                                </div>
                                <span>
                                    ${value.description}
                                </span>
                            </div>
                        </div>
                        <div class="card-footer d-flex">
                            <div class="card-text text-truncate me-1">
                            ${value.address}
                            </div>
                            <div class="ms-auto">
                                <a href="#map" onclick="panMap(${value.latitude},${value.longitude})" class="btn btn-success" title="Pinpoint location on map">
                                    <i class="fa fa-map-marked" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    `); // Replace row display for data table
                });
            },
            error: function(message, error) {
                alert("Error code : ".message.status);
            }
        })
    }

    function initMap() {
        map.remove();
        map = L.map('map')
            // .setView([0, 0], 10);
            .setView([self_latitude, self_longitude], 10);
        // alert('InitMap');

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png?key=HfiQgsMsSnorjEs2Sxek', {
            maxZoom: 15,
            attribution: '<a href="https://www.maptiler.com/license/maps/" target="_blank">'
        }).addTo(map);
        L.marker(
                [self_latitude, self_longitude], {
                    icon: greenIcon
                }
            )
            .addTo(map)
            .bindPopup("Your location.");
    }

    function panMap(lat, lng) {
        map.setView([lat, lng], 14);
    }

    function addMarker(lat, lng, description) {
        var marker = L.marker([lat, lng])
            .addTo(map)
            .bindPopup(description);
        // .openPopup();
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        self_latitude = position.coords.latitude;
        self_longitude = position.coords.longitude;

        $('#get-loc').addClass('btn-success');
        $('#get-loc span').html(self_latitude + ", " + self_longitude);
        $('#get-loc').removeClass('btn-outline-primary');

        search();
    }

    function popUp(id) {
        $('#modalean').html(`
            <button class="btn btn-secondary" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            </button>
        `);
        $.ajax({ // Ajax script
            url: "{{ route('restaurants.popup') }}", // Route
            type: "GET", // Method
            data: {
                'id': id,
            },
            success: function(data) { // If process has no error..
                // alert(data); 
                $('#modalean').html(`
                    <div class="modal-content" id="modalean">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                ${data.name}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">${data.menu}</div>
                        <div class="modal-footer">
                            <div>
                                ${data.address}
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                `);
            },
            error: function(message, error) {
                alert("Error code : ".message.status);
            }
        })
    }
    // getLocation();
    window.onload = search();
</script>

</html>
