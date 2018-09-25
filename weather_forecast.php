<!doctype html>

<html lang="en">

  	<head>
    
	    <meta charset="utf-8">

	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	    <style type="text/css">
	    	
	    	body {

	    		height: 100vh;
	    		background: url("img/max-saeling-1070806-unsplash.jpg");
	    		background-size: cover;

	    	}

	    	.jumbotron {

	    		margin-top: 10vh;
	    		background: rgba(255,255,255, 0.6);
	    		color: #000;
	    		padding: 20vh;
	    	}

	    	.jumbotron h1 {

	    		font-weight: 400;

	    	}

	    	.jumbotron p {

	    		font-weight: 400;

	    	}

	    	#inputCity {

	    		border: 1px solid #3a3b34;

	    	}

	    	#alertMessage {

	    		margin-top: 2vh;

	    	}

	    </style>

	    <title>Weather Forecast with PHP</title>

	    <?php

	    	$error = "";

			$city = "";

			$weatherForecast = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {

				if (empty($_POST["inputCity"])) {

				    $error = "<script>$('#alertMessage').removeClass('alert-success'); $('#alertMessage').addClass('alert-danger');</script>City is required!";

				} else {

				    $city = test_input($_POST["inputCity"]);

				    // check if name only contains letters and whitespace

				    if (!preg_match("/^[a-zA-Z ]*$/",$city)) {

				      $error = "<script>$('#alertMessage').removeClass('alert-success'); $('#alertMessage').addClass('alert-danger');</script>Only letters and white space allowed!"; 

				    } else {

				    	$weatherForecast = file_get_contents("https://www.weather-forecast.com/locations/$city/forecasts/latest");

				    	$start = strpos($weatherForecast, '<span class="phrase">');

						$end = strpos($weatherForecast, '</span>', $start);

						$paragraph = substr($weatherForecast, $start, $end-$start+4);

	    				$error = $paragraph;

				    }

				}

			}

			function test_input($data) {

				$data = trim($data);

				$data = stripslashes($data);

				$data = htmlspecialchars($data);

				return $data;

			}

	    	

	    ?>

  	</head>

  	<body>

  		<div class="container">

	  		<div class="jumbotron text-center">

			  	<h1 class="display-4">What's The Weather?</h1>

				<p class="lead">Enter the name of a city.</p>

				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

				  	<div class="form-group">
					    
					    <input type="text" class="form-control" name="inputCity" id="inputCity" aria-describedby="emailHelp" placeholder="Enter a city" value="<?php echo $city ?>">

					</div>

				  <input type="submit" class="btn btn-primary" value="Submit">

				</form>

				<div class="alert alert-success" role="alert" id="alertMessage">
				 	<?php echo $error; ?>
				</div>

			</div>

		</div>

	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  	</body>

</html>