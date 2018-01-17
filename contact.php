<?php
$name = "";
$message = "";
$email = "";
$token = "";
$valid = true;
$error = "";

$token = $_POST["token"];

if ($token == "ok")
{
	$name = $_POST["name"];
	$message = $_POST["message"];
	$email = $_POST["email"];

	if (strlen($name) == 0)
	{
		$error .= "<br>Name missing!";
		$valid = false;
	}

	if (strlen($message) == 0)
	{
		$error .= "<br>Message missing!";
		$valid = false;
	}
	
	if (strlen($email) == 0)
	{
		$error .= "<br>E-mail missing!";
		$valid = false;
	}
	
	if($valid == true)
	{
		// Send Email
		$headers = "From: student@imed2309.com" . "\r\n";
		$headers .= "Reply-To: megrenewilson@gmail.com" . "\r\n";
		$headers .= "CC: douglas.roberts@hccs.edu" . "\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion();
		
		$name = strip_tags($name);
		$message = strip_tags($message);
		
		$subject = "Megan Wilson Prints Inquiry";
		
		$body = "New Contact message\n";
		$body .= "Name: $name\n";
		$body .= "Message: $message\n";
		
		$to = "megrenewilson@gmail.com";
		
		mail($to, $subject, $body, $headers);
		
		echo("Thank you!");
		exit();
	}
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Contact - Megan Wilson Prints</title>
  <meta name="description" content="">
  <meta name="author" content="">
	<!-- Stylesheet -->
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/contact.css">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
<?php include "header.php";?>
	<!-- Main Content -->
		<div class="main-content row">
			<div class="col"><h2>CONTACT<h2></div>
			<div class="col">
			<span class="error-message"><?= $error ?></span>
				<form method="POST" action="contact.php" id="form">
				    Name:<br>
				    <input type="text" name="name" value="<?= $name ?>" class="field-divided" >

					 E-mail:<br>
				    <input type="e-mail" name="email" value="<?= $name ?>" class="field-divided">
				    Message:<br>
				    	<textarea name="message" rows="5" cols="20" value="" class="field-long field-textarea"><?= $message ?></textarea>
				    <input type="submit" value="Send" id="submit" />
					<input type="hidden" name="token" value="ok" />
				</form>
			</div>
		</div>
	<?php include "footer.php";?>
</div>
</body>
</html>