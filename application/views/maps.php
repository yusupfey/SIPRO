<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Tutorial Google Map - Petani Kode</title>

    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_sMB0q1gO4gFqH8rVHiWCJ1QHoxUWmD8" async defer></script>
    <script>
        function initialize() {
            var propertiPeta = {
                center: new google.maps.LatLng(-8.5830695, 116.3202515),
                zoom: 9,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

            // membuat Marker
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(-8.5830695, 116.3202515),
                map: peta,
                animation: google.maps.Animation.BOUNCE
            });

        }

        // event jendela di-load
        google.maps.event.addDomListener(window, 'load', initialize);
    </script> -->

</head>

<body>

    <div class="container" id="dvMap" style="width: 1000px; height: 550px"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_sMB0q1gO4gFqH8rVHiWCJ1QHoxUWmD8&libraries=places" async defer></script>
    <script type="text/javascript">
        var markers = [{
                "lat": '<?php echo $lokasi['lat']; ?>',
                "long": '<?php echo $lokasi['long']; ?>',
                "alamat": '<?php echo $lokasi['alamat']; ?>'
            },

        ];
        console.log(markers)
    </script>
    <script type="text/javascript">
        window.onload = function() {
            var mapOptions = {
                center: new google.maps.LatLng(-2.2459632, 116.2409634),
                zoom: 6,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var infoWindow = new google.maps.InfoWindow();
            var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
            for (i = 0; i < markers.length; i++) {
                var data = markers[i];
                var latnya = data.lat;
                var longnya = data.long;

                var myLatlng = new google.maps.LatLng(latnya, longnya);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: data.alamat
                });
                (function(marker, data) {
                    google.maps.event.addListener(marker, "click", function(e) {
                        infoWindow.setContent('<b>Lokasi</b> :' + data.alamat + '<br>');
                        infoWindow.open(map, marker);
                    });
                })(marker, data);
            }
        }
    </script>
</body>

</html>