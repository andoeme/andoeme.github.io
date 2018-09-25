<!doctype html>

<html lang="en">

	<head>

	    <!-- Required meta tags -->
	    <meta charset="utf-8">

	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	    <style type="text/css">
	    	
	    	#missingInput {

	    		display: none;

	    	}

	    </style>

	    <title>PHP Contact Form Using jQuery And Bootstrap</title>

	</head>

	<body>

	  	<?php

		// define variables and set to empty values
		$email = $subject = $question = "";
		$errors = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if (empty($_POST["inputEmail"])) {

			    $errors += "<p>Email is required.</p>";

			} else {

			    $email = test_input($_POST["inputEmail"]);

			    // check if name only contains letters and whitespace

			    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

	      			$errors = "<p>Invalid email format.</p>"; 

	    		}
			}

			if (empty($_POST["inputSubject"])) {

			    $errors = "<p>Subject is required.</p>";

			 } else {

			    $subject = test_input($_POST["inputSubject"]);

			 }

			if (empty($_POST["inputQuestion"])) {

			    $errors = "<p>Question is required.</p>";

			 } else {

			    $question = test_input($_POST["inputQuestion"]);

			 }

			 if ($errors == "") {

			 	// Send email

	    		$emailTo = "";

	    		$emailSubject = $subject;

	    		$body = $question;

	    		$headers = "From: ".$email;

	    		if (mail($emailTo, $emailSubject, $body, $headers)) {

	    			echo "The email was sent successfully.";

	    		} else {

	    			echo "<div class='alert alert-danger' role='alert'>The email could not be sent.</div>";

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

	  	<main class="container">

	    	<h1>Get in touch!</h1>

	    	<div class="alert alert-danger" id="missingInput" role="alert">
			  	
			</div>

		    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="form-group row">
				    <label for="inputEmail" class="col-sm-2 col-form-label">Email Address</label>
				    <div class="col-sm-10">
				      	<input required type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email Address" value="<?php echo $email;?>">
				    </div>
				</div>

				<div class="form-group row">
				    <label for="inputSubject" class="col-sm-2 col-form-label">Subject</label>
				    <div class="col-sm-10">
				      	<input required type="text" class="form-control" name="inputSubject" id="inputSubject" placeholder="Subject" value="<?php echo $subject;?>">
				    </div>
				</div>

				<div class="form-group row">
				    <label for="inputQuestion" class="col-sm-2 col-form-label">What would you like to ask us?</label>
				    <div class="col-sm-10">
				      	<input required type="textarea" class="form-control" name="inputQuestion" id="inputQuestion" placeholder="Your Question" value="<?php echo $question;?>">
				    </div>
				</div>
				  
				<div class="form-group row">
				    <div class="col-sm-10">
				      	<input id="submit" type="submit" class="btn btn-primary" value="Submit">
				    </div>
				</div>
			</form>

		</main>

	    
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	    <script type="text/javascript">
	    	
	    	// Verification of the form

	    	var errorMessage = "";

	    	$( "#submit" ).click(function(e) {


	  			if ($("#inputEmail").val() == "") {

	    			errorMessage += "Please insert your email address.<br>";

	    		}

	    		if ($("#inputSubject").val() == "") {

	    			errorMessage += "Please insert the subject of your question.<br>";

	    		}

	    		if ($("#inputQuestion").val() == "") {

	    			errorMessage += "Please insert your question.<br>";

	    		}

	    		if (errorMessage!="") {

	    			e.preventDefault();

	    			$("#missingInput").css("display", "inline-block");

	    			$("#missingInput").html(errorMessage);

	    			errorMessage = "";

	    		} else {

	    			$("#missingInput").css("display", "none");

	    			$("form").unbind("#submit").submit();

	    		}
			});
	    	
	    </script>

	</body>

</html>
