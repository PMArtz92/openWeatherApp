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
</head>
<body>

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
                            <input placeholder="Longitude" type="text" name="longitude" id="longitude" class="form-control">
                        </div>
                        <div class="form-group">
                            <input placeholder="Latitude"  type="text" name="latitude" id="latitude" class="form-control">
                        </div>
                        <input type="button" value="Submit" id="submitButton" class="btn btn-md btn-success">
                    </form>


                </div>

            </div>
            <div class="weather-display col-lg-12">
                <div id="map" class="col-lg-7"></div>
                <div id="results" class="col-lg-5">
                    <div class="row results-name">
                        <div class="results-icon col-lg-5">
                            <div class="icon thunder-storm" id="thunder-storm">
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
                            <label id="r-city-name">Pasan</label>
                        </div>
                    </div>

                    <div class="result-table">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>

                            <tr><td>Description</td><td id="description">Gentle Breeze 4.1 m/s</td></tr>
                            <tr><td>Cloudiness</td><td id="cloudiness">broken clouds</td></tr>
                            <tr><td>Pressure<br></td><td id="pressure">1020 hpa</td></tr>
                            <tr><td>Humidity</td><td id="humidity">93 %</td></tr>
                            <tr><td>Rain</td><td id="rain">0.25</td></tr>
                            <tr><td>Sunrise</td><td id="sunrise">9:19</td></tr>
                            <tr><td>Sunset</td><td id="sunset">1:39</td></tr>
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
        ajaxSend(longitude,latitude);
    });


    function ajaxSend(longitude,latitude){
        $.ajax({
            type: "POST",
            url: "http://pmartz:8280/services/pmartz?lat=" + latitude + "&lon=" + longitude,
            data : {
                longitude: longitude,
                latitude: latitude
            },
            dataType: "json",
            success: function(response){
                alert(response['city']);
            },
            error: function(xhr, status, error){
                console.log(xhr);
                console.log(status,error);
            }

        });

    }

</script>

