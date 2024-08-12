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
    <div class="modal fade" id="popUp" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content" id="modalean">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Modal title
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Body</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <header>
        <nav class="navbar navbar-brand border-bottom mb-3">
            <div class="container text-uppercase fw-bold">
                <a class="navbar-brand" href="#"><img src="{{ asset('favicon.ico') }}" alt="logo"
                        width="48" height="48">
                    {{ config('app.name') }}
                </a>
            </div>
        </nav>
    </header>
    <div class="row m-0">
        <div class="col" id="google-map">
            {{-- Google Map API --}}
            <div class="container card vh-100" id="map">
            </div>
            {{-- <iframe id="psp"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2312.645973820296!2d106.75949785261639!3d-6.393582888097098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e8da91695879%3A0xc01092d7a22eb1e1!2sLapangan%20Bola%20PSP!5e0!3m2!1sen!2sid!4v1722992158410!5m2!1sen!2sid"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
        </div>
        <div class="col-12 col-md" id="search-bar">
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
                <button class="btn btn-primary" onclick="" id="search-btn"><i class="fa fa-search"
                        aria-hidden="true"></i></button>
            </div>
            <div class="container-lg" id="search-list">
                {{-- Restaurant Container --}}
            </div>
        </div>
    </div>
</body>
@include('script')

</html>
