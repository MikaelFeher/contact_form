<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Contact Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

	<style rel="stylesheet" type="text/css" media="screen">

		#successMessage {
			display: none;
		}
		#erMsg {
			display: none;
		}
		.error {
			color: red;
		}

	</style>
  </head>
  <body>
	<?php
		// Form validation using PHP.
		$emailErr = $subjectErr = $messageErr = '';
		$email = $subject = $message = '';

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			if (empty($_POST['email'])) {
				$emailErr = 'A valid email address is required';
			} else {
				$email = test_input($_POST['email']);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$emailErr = "Invalid email format";
				}
			}

			if (empty($_POST['subject'])) {
				$subjectErr = "Subject line can't be empty";
			} else {
				$subject = test_input($_POST['subject']);
			}

			if (empty($_POST['messageBody'])) {
				$messageErr = "Please write a message. We aren't mindreaders :)";
			} else {
				$message = test_input($_post['messageBody']);
			}

		}

		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

	 ?>
	<div class="container">
		<h1>Get in touch!</h1>

		<div class="alert alert-success" role="alert" id="successMessage">
			<strong>Your message was sent successfully! We'll get back to you as soon as possible!</strong>
		</div>

		<div class="alert alert-danger" role="alert" id="erMsg">

		</div>

		<p class="error">* required field.</p>

		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<div class="form-group">
				<label for="email">Email address <span class="error">* <?php echo $emailErr; ?></label>
				<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" value='<?php echo $email; ?>'></span><small id="emailHelp" class="form-text text-muted"></small>
			</div>
			<div class="form-group">
				<label for="subject">Subject <span class="error">* <?php echo $subjectErr; ?></span></label>
				<input type="text" class="form-control" name="subject" id="subject" aria-describedby="subject" value='<?php echo $subject; ?>'>
			</div>
			<div class="form-group">
				<label for="messageBody">What would you like to ask us? <span class="error">* <?php echo $messageErr; ?></span></label>
				<textarea class="form-control" name="messageBody" id="messageBody" rows="5"><?php echo $message; ?></textarea>
			</div>
			<button type="submit" class="btn btn-primary" id="submitButton">Submit</button>

		</form>
	</div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

	<script type="text/javascript">
		function isEmail(email) {
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			return regex.test(email);
		}

		$('#submitButton').click(function () {
			var errorMessage = '';
			var fieldsMissing = '';

			if ($('#email').val() === '') {
				fieldsMissing += '<br />Email';
			} else {
				if (!isEmail($('#email').val())) {
					errorMessage += '<p>Your <em>email address</em> is not valid</p>';
				}
			}
			if ($('#messageBody').val() === '') {
				fieldsMissing += '<br />Subject';
			}
			if ($('#messageBody').val() === '') {
				fieldsMissing += '<br />Message';
			}

			if (fieldsMissing !== '') {
				errorMessage += '<p><strong>The following field(s) are missing: </strong>' + fieldsMissing + '</p>';
			}

			if ($('#password').val() !== $('#passwordConfirm').val()) {
				errorMessage += '<p>Your <em>passwords</em> do not match</p>'
			}

			if (errorMessage !== '') {
				$('#erMsg').html(errorMessage);
				$('#erMsg').show();
			} else {
				$('#successMessage').show();
				$('#erMsg').hide();
				$.post('index.php');
			}

			return false;

		});

	</script>
  </body>
</html>
