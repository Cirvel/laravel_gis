<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

<script type="text/javascript">
    function relocate(lat, lng) {
        // alert("latitude : " + lat + ", longitude : " + lng);
        moveToLocation(lat, lng)
    }

    function search() {
        $.ajax({ // Ajax script
            url: "{{ route('restaurants.search') }}", // Route
            type: "GET", // Method
            data: {
                'search': $('#search-text').val(),
                'filter': $('#filter').val(),
            },
            success: function(data) { // If process has no error..
                // alert(data); 
                $('#search-list').html(data); // Replace row display for data table
            },
            error: function(message, error) {
                alert("Error code : ".message.status);
            }
        })
    }

    function popUp(id) {
        $.ajax({ // Ajax script
            url: "{{ route('restaurants.popup') }}", // Route
            type: "GET", // Method
            data: {
                'id': id,
            },
            success: function(data) { // If process has no error..
                // alert(data); 
                $('#psp').html(data); // Replace row display for data table
                $('#modalean').html(data); // Replace row display for data table
            },
            error: function(message, error) {
                alert("Error code : ".message.status);
            }
        })
    }

    $('#search-btn').on('click', function() {
        search();
    });

    let map;

    async function initMap(latitude, longitude) {
        const {
            Map
        } = await google.maps.importLibrary("maps");
        // const {
        //     AdvancedMarkerElement
        // } = await google.maps.importLibrary("marker");

        map = new Map(document.getElementById("map"), {
            center: {
                lat: latitude,
                lng: longitude
            },
            zoom: 36,
        });

        // The marker, positioned at Uluru
        // const marker = new AdvancedMarkerElement({
        //     map: map,
        //     position: {
        //         lat: latitude,
        //         lng: longitude
        //     },
        //     title: "Uluru",
        // });
    }

    function moveToLocation(lat, lng) {
        const center = new google.maps.LatLng(lat, lng);
        // using global variable:
        map.panTo(center);
    }

    initMap(0, 0);
    window.onload = search();
</script>
