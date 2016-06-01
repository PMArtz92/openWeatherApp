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
            <div class="weather-form col-lg-4">
                <div class="login-container">
                    <form id="loginForm">
                        <legend>
                            Enter Location
                        </legend>

                        <div id="respond"></div>

                        <input placeholder="Longitude" type="text" name="longitude" id="longitude" class="form-control">
                        <input placeholder="Latitude"  type="text" name="latitude" id="latitude" class="form-control">

                        <input type="button" value="Submit" id="submitButton" class="btn btn-md btn-success">

                    </form>
                </div>

            </div>
            <div class="weather-display col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">
                            <div class="icon thunder-storm">
                                <div class="cloud"></div>
                                <div class="lightning">
                                    <div class="bolt"></div>
                                    <div class="bolt"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="icon cloudy">
                                <div class="cloud"></div>
                                <div class="cloud"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="icon flurries">
                                <div class="cloud"></div>
                                <div class="snow">
                                    <div class="flake"></div>
                                    <div class="flake"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">
                            <div class="icon sunny">
                                <div class="sun">
                                    <div class="rays"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="icon rainy">
                                <div class="cloud"></div>
                                <div class="rain"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="icon sun-shower">
                                <div class="cloud"></div>
                                <div class="sun">
                                    <div class="rays"></div>
                                </div>
                                <div class="rain"></div>
                            </div>
                        </div>

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

