<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>My Store - Thank You - PayPal Pro</title>
</head>

<div id="content">
	<h1>Thank You!</h1>

	<p>Thank you for your order.</p>
	
	<p>Payment Submitted Successfully</p>
	
	<p>Your Order ID: <?= $_SESSION["TRANSACTIONID"]; ?><p>

	<p><a href="index.php">Home</a></p>
</div>

</body>
</html>
