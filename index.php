<!DOCTYPE html>
<html>
<head>
	<title>Open Weather App</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
	<link href="css/weatherapp.css" rel="stylesheet" type="text/css">
	<link href="css/weathericons.css" rel="stylesheet" type="text/css">

	<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
</head>
<body>
<script type="text/javascript">
    var geocoder = new google.maps.Geocoder();

    function geocodePosition(pos) {
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                updateMarkerAddress(responses[0].formatted_address);
            } else {
                updateMarkerAddress('Cannot determine address at this location.');
            }
        });
    }

    function updateMarkerStatus(str) {
        //document.getElementById('markerStatus').innerHTML = str;
    }

    function updateMarkerPosition(latLng) {
       /* document.getElementById('latitude').innerHTML = [
            latLng.lat(),
            latLng.lng()
        ].join(', ');*/
        console.log(latLng.lat());
        $("#latitude").val(latLng.lat());
        $("#longitude").val(latLng.lng());
    }

    function updateMarkerAddress(str) {
        //document.getElementById('address').innerHTML = str;
    }

    function initialize() {
        var latLng = new google.maps.LatLng(-34.397, 150.644);
        var map = new google.maps.Map(document.getElementById('mapCanvas'), {
            zoom: 8,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var marker = new google.maps.Marker({
            position: latLng,
            title: 'Point A',
            map: map,
            draggable: true
        });

        // Update current position info.
        updateMarkerPosition(latLng);
        geocodePosition(latLng);

        // Add dragging event listeners.
        google.maps.event.addListener(marker, 'dragstart', function() {
            updateMarkerAddress('Dragging...');
        });

        google.maps.event.addListener(marker, 'drag', function() {
            updateMarkerStatus('Dragging...');
            updateMarkerPosition(marker.getPosition());
        });

        google.maps.event.addListener(marker, 'dragend', function() {
            updateMarkerStatus('Drag ended');
            geocodePosition(marker.getPosition());
        });
    }

    // Onload handler to fire off the app.
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div class="container-fluid ">
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            <h1> Welcome to OpenWeather App</h1>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="weather-form col-lg-12">
                <div class="login-container">
                    <form class="form-inline">
                        <div class="form-group">
                            <label>Latitude:</label>
                            <input placeholder="Latitude"  type="text" name="latitude" id="latitude" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Longitude:</label>
                            <input placeholder="Longitude" type="text" name="longitude" id="longitude" class="form-control">

                        </div>
                        <input type="button" value="Submit" id="submitButton" class="btn btn-md btn-success">
                    </form>


                </div>

            </div>
            <div class="weather-display col-lg-12">
                <div id="map" class="col-lg-7">
                    <div id="mapCanvas"></div>
                </div>
                <div id="results" class="col-lg-5">
                    <div class="row results-name">
                        <div class="results-icon col-lg-5">
                            <div class="icon thunder-storm hidden" id="thunder-storm">
                                <div class="cloud"></div>
                                <div class="lightning">
                                    <div class="bolt"></div>
                                    <div class="bolt"></div>
                                </div>
                            </div>

                            <div class="icon cloudy hidden" id="cloudy">
                                <div class="cloud"></div>
                                <div class="cloud"></div>
                            </div>

                            <div class="icon flurries hidden" id="flurries">
                                <div class="cloud"></div>
                                <div class="snow">
                                    <div class="flake"></div>
                                    <div class="flake"></div>
                                </div>
                            </div>

                            <div class="icon sunny hidden" id="sunny">
                                <div class="sun">
                                    <div class="rays"></div>
                                </div>
                            </div>

                            <div class="icon rainy hidden" id="rainy">
                                <div class="cloud"></div>
                                <div class="rain"></div>
                            </div>

                            <div class="icon sun-shower hidden" id="sun-shower">
                                <div class="cloud"></div>
                                <div class="sun">
                                    <div class="rays"></div>
                                </div>
                                <div class="rain"></div>
                            </div>
                        </div>
                        <div class="results-city col-lg-7">
                            <label id="r-city-name"></label>
                        </div>
                    </div>

                    <div class="result-table" id="result-table">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                            <tr><td>Type</td><td id="type"></td></tr>
                            <tr><td>Description</td><td id="description"></td></tr>
                            <tr><td>Pressure<br></td><td id="pressure"></td></tr>
                            <tr><td>Humidity</td><td id="humidity"></td></tr>
                            <tr><td>Windspeed</td><td id="windspeed"></td></tr>
                            <tr><td>Sunrise</td><td id="sunrise"></td></tr>
                            <tr><td>Sunset</td><td id="sunset"></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>




</div>


</body>
</html>

<script type="text/javascript">
    $('#submitButton').click(function(){
        var longitude = $('#longitude').val();
        var latitude = $('#latitude').val();
        console.log(longitude);
        ajaxSend(longitude,latitude);
    });


    function ajaxSend(longitude,latitude){
        $.ajax({
            type: "POST",
            url: "http://PMArtz:8280/services/pmartz?lat=" + latitude + "&lon=" + longitude, // Replace "http://PMArtz:8280/services/pmartz" with your endpoint
            dataType: "json",
            success: function(response){
                var name = response['name'];
                var type = response['main'];
                var description = response['description'];
                var pressure = response['pressure'];
                var humidity = response['humidity'];
                var windspeed = response['windspeed'];
                var sunrise = response['sunrise'];
                var sunset = response['sunset'];
                var icon = response['icon'];
                console.log(icon);
                $('#r-city-name, #description,#type,#pressure,#humidity,#windspeed,#sunrise,#sunset').fadeOut(500,function(){
                    $('#r-city-name, #description,#type,#pressure,#humidity,#windspeed,#sunrise,#sunset').empty();
                    document.getElementById("r-city-name").innerHTML = name;
                    document.getElementById("description").innerHTML = description;
                    document.getElementById("type").innerHTML = type;
                    document.getElementById("pressure").innerHTML = pressure;
                    document.getElementById("humidity").innerHTML = humidity;
                    document.getElementById("windspeed").innerHTML = windspeed;
                    document.getElementById("sunrise").innerHTML = sunrise;
                    document.getElementById("sunset").innerHTML = sunset;
                    $('#r-city-name, #description,#type,#pressure,#humidity,#windspeed,#sunrise,#sunset').fadeIn(500);
                });

                if(icon == '01d' || icon == '01n'){
                    $('#thunder-storm,#cloudy,#flurries,#rainy,#sun-shower,#sunny').addClass('hidden');
                    $('#sunny').removeClass('hidden');
                }
                else if(icon == '02d' ||  icon == '02n' ||  icon == '03d' ||  icon == '03n' ||  icon == '04d' ||  icon == '04n'){
                    $('#thunder-storm,#cloudy,#flurries,#rainy,#sun-shower,#sunny').addClass('hidden');
                    $('#cloudy').removeClass('hidden');
                }
                else if(icon == '10d'){
                    $('#thunder-storm,#cloudy,#flurries,#rainy,#sun-shower,#sunny').addClass('hidden');
                    $('#sun-shower').removeClass('hidden');

                }
                else if(icon == '09d' || icon == '09n' || icon == '10n'){
                    $('#thunder-storm,#cloudy,#flurries,#rainy,#sun-shower,#sunny').addClass('hidden');
                    $('#rainy').removeClass('hidden');
                }
                else if(icon = '11d' || icon == '11n'){
                    $('#thunder-storm,#cloudy,#flurries,#rainy,#sun-shower,#sunny').addClass('hidden');
                    $('#thunder-storm').removeClass('hidden');

                }
                else if(icon == '13d' || icon == '13n'){
                    $('#thunder-storm,#cloudy,#flurries,#rainy,#sun-shower,#sunny').addClass('hidden');
                    $('#flurries').removeClass('hidden');

                }


            },
            error: function(xhr, status, error){
                console.log(xhr);
                console.log(status,error);
            },
            fail:function(response){
                alert('failed');
            }

        });

    }

    function addData(name,type,description,pressure,humidity,windspeed,sunrise,sunset){
        console.log(name);
        //$('#r-city-name, #description,#cloudiness,#pressure,#humidity,#rain,#sunrise,#sunset').empty();
        $('#r-city-name, #description,#type,#pressure,#humidity,#windspeed,#sunrise,#sunset').fadeOut(500,function(){
            $('#r-city-name, #description,#cloudiness,#pressure,#humidity,#rain,#sunrise,#sunset').empty();

        });
    }

</script>

