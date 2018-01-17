<?php require("checkout.inc.php"); ?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Checkout - Megan Wilson Prints</title>
  <meta name="description" content="">
  <meta name="author" content="">
	<!-- Stylesheet -->
  <link rel="stylesheet" href="css/styles.css">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
<?php include "header.php";?>
	<!-- Main Content -->
		<div class="main-content checkout row">
			<div class="col">
        <h2>Checkout</h2>
          <h3>You will be charged: $<?php echo $total; ?></h3>
  
          <p><span style="color: red;"><?php echo $errormessage; ?></span></p>
          
          <form action="checkout.php" method="post">

          First name: <input type="text" name="firstname" value="<?php echo $firstname; ?>"><br>
          Last name:  <input type="text" name="lastname" value="<?php echo $lastname; ?>"><br>
          Email: <input type="text" name="email" value="<?php echo $email; ?>"><br>

          <h2>Billing Address</h2>
          Address: <input type="text" name="billaddress" value="<?php echo $billaddress; ?>"><br>
          City: <input type="text" name="billcity" value="<?php echo $billcity; ?>"><br>
          State: <input type="text" name="billstate" value="<?php echo $billstate; ?>"><br>
          Zip Code: <input type="text" name="billpostalcode" value="<?php echo $billpostalcode; ?>"><br>

          <h2>Payment Information</h2>

          Card Number: <input type="text" name="cc_cardnumber" value=""><img src="cards_accepted.gif" height="50" /><br>
          CVV2 Code: <input type="text" name="cc_cvv2code" value="" size="4"><br>
          Expiration Date: <input type="text" name="cc_expmonth" value="" size="2" maxlength="2">/<input type="text" name="cc_expyear" value="" size="4" maxlength="4">
                <small>(MM/YYYY)</small>
            
          <p></p>
          
          <input type="hidden" name="token" value="checkout" />
          <input type="submit" value="Purchase">

          </form>
		  </div>
		</div>
<?php include "footer.php";?>
</div>
</body>
</html>