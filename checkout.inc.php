<?php
error_reporting(0);
?>

<?php
/*****************************************

	This is an example of the advanced Checkout Form.  Part 2.

	This form will send Credit Card information to PayPal.
	This form will display the PayPal transaction result.

	This page must have session_start() at the beginning of the page so it can get the cart information.

	You must update the correct variable below in order for this page to work correctly.
	
	NOTE:  This page will display all Error Message at the top of the checkout form.
	
******************************************/
session_start();

$PAYPAL_USERNAME = "student99-facilitator_api1.imed2309.com";
$PAYPAL_PASSWORD = "1391804727";
$PAYPAL_SIGNATURE = "Am.1cx2jzIo5QBQaABccw3Pq6iGxA.zbmiwv7p.qvoXcouAKZa6T6mBN";

// Variables for PayPal
$bIsPaid = false;
$transactionid = "";
$errormessage = "";
$paypal_ack = "";
$paypal_amt = "";

// This is needed for the PayPal functions
require("paypal.inc.php");



// Set up our variables
$firstname = "";
$lastname = "";

$email = "";
$billaddress = "";
$billcity = "";
$billstate = "";
$billpostalcode = "";
$cc_cardnumber = "";
$cc_cardtype = "";
$cc_cvv2code = "";
$cc_expmonth = "";
$cc_expyear = "";


$token = "";

$token = $_POST["token"];

// Calculate Total
if (isset($_SESSION["product"]))
{
	$total = 0;
	$subtotal = 0;
	
	foreach($_SESSION["product"] as $i => $values)
	{
		$productqty = $_SESSION["product"][$i]["qty"];
		$productprice = $_SESSION["product"][$i]["price"];
		$subtotal = ($productqty * $productprice);
		$total += $subtotal;
	}
} else {
	echo "Error: No Cart Information found";
	exit;
}

if($token == "checkout")
{
	// get form elements from POST
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$email = $_POST["email"];
	$billaddress = $_POST["billaddress"];
	$billcity = $_POST["billcity"];
	$billstate = $_POST["billstate"];
	$billpostalcode = $_POST["billpostalcode"];
	$cc_cardnumber = $_POST["cc_cardnumber"];
	$cc_cvv2code = $_POST["cc_cvv2code"];
	$cc_expmonth = $_POST["cc_expmonth"];
	$cc_expyear = $_POST["cc_expyear"];

	// validate form elements
	$bValid = true;

	// You would validate your fields here
	if(strlen($firstname) == 0)
	{
		$errormessage .= "<br>First Name is required.";
		$bValid = false;
	}
	
	if(strlen($lastname) == 0)
	{
		$errormessage .= "<br>Last Name is required.";
		$bValid = false;
	}
	
	if(strlen($email) == 0)
	{
		$errormessage .= "<br>Email is required.";
		$bValid = false;
	}
	
	// validate the email for the correct format (email@email.com)
	if(strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL) == false)
	{
		$errormessage .= "<br>Email is invalid.";
		$bValid = false;
	}
	
	if(strlen($billaddress) == 0)
	{
		$errormessage .= "<br>Address is required.";
		$bValid = false;
	}
	
	if(strlen($cc_cardnumber) == 0)
	{
		$errormessage .= "<br>Credit Card Number is required.";
		$bValid = false;
	}
	
	
	// All is valid, Send
	if($bValid == true)
	{
		// remove any HTML tags from the form fields
		$firstname = strip_tags($firstname);
		$lastname = strip_tags($lastname);
		$email = strip_tags($email);
		
		$billaddress = strip_tags($billaddress);
		$billcity = strip_tags($billcity);
		$billstate = strip_tags($billstate);
		$billpostalcode = strip_tags($billpostalcode);
		
		$cc_cardnumber = strip_tags($cc_cardnumber);
		$cc_expmonth = strip_tags($cc_expmonth);
		$cc_expyear = strip_tags($cc_expyear);
		$cc_cvv2code = strip_tags($cc_cvv2code);

		
		// Send transaction to PayPal
		// Set request-specific fields.
		// All values must be URL encoded. This will preserve any special characters used.
		$paymentType = urlencode('Sale');				// or 'Sale'
		$firstName = urlencode($firstname);
		$lastName = urlencode($lastname);
		$cust_email = urlencode($email);
		$creditCardType = urlencode($cc_cardtype);
		$creditCardNumber = urlencode($cc_cardnumber);
		$expDateMonth = $cc_expmonth;
		// Month must be padded with leading zero
		$padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));
		
		$expDateYear = urlencode($cc_expyear);
		$cvv2Number = urlencode($cc_cvv2code);
		$address1 = urlencode($billaddress);
		$address2 = urlencode('');
		$city = urlencode($billcity);
		$state = urlencode($billstate);
		$zip = urlencode($billpostalcode);
		$country = urlencode('US');				// US or other valid country code
		$amount = urlencode($total);
		$currencyID = urlencode('USD');			// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
		
		// Add request-specific fields to the request string.
		// This is the set of values that will be sent to PayPal
		$nvpStr =	"&PAYMENTACTION=$paymentType" . 
			"&AMT=$amount" . 
			"&CREDITCARDTYPE=$creditCardType" . 
			"&ACCT=$creditCardNumber" .
			"&EXPDATE=$padDateMonth$expDateYear" . 
			"&CVV2=$cvv2Number" . 
			"&FIRSTNAME=$firstName" . 
			"&LASTNAME=$lastName" .
			"&EMAIL=$cust_email" . 
			"&STREET=$address1" . 
			"&CITY=$city" . 
			"&STATE=$state" . 
			"&ZIP=$zip" . 
			"&COUNTRYCODE=$country" . 
			"&CURRENCYCODE=$currencyID";
		echo $nvpStr;
		// Execute the API operation; see the PPHttpPost function above.
		//$httpParsedResponseAr = PPHttpPost('DoDirectPayment', $nvpStr);
		
		// display success or failure message
		// PayPal sends back a set of values to your web site as an Array.
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
			$bIsPaid = true;
			$transactionid = $httpParsedResponseAr["TRANSACTIONID"];
			$paypal_ack = $httpParsedResponseAr["ACK"];
			$paypal_amt = $httpParsedResponseAr["AMT"];
			echo('<br>Payment Submitted Successfully: ' . '<pre>' . urldecode(print_r($httpParsedResponseAr, true)) . '</pre>');
		} else  {
			$bIsPaid = false;
			$bValid = false;
			$errormessage .= "<br>" . '<br>Payment failed: ' . '<pre>' . urldecode(print_r($httpParsedResponseAr, true)) . '</pre>';
			echo($errormessage);
			exit;
			echo('<br>Payment failed (click back to try again): ' . '<pre>' . urldecode(print_r($httpParsedResponseAr, true)) . '</pre>');
			exit;
		}

		// This is where you would send the email
		// The email has been omitted for testing purposes to focus on saving data.
		if ($bIsPaid == true)
		{
		
			// Build the headers for From:, Reply-To, Mailer, can also add CC or BCC on separate lines.
			$headers = "From: megrenewilson@gmail.com" . "\r\n";		// TODO:  Replace with your email address
			$headers .= "X-Mailer: PHP/" . phpversion();
			
			$to = "megrenewilson@gmail.com";		// TODO:  replace with your email address
			$subject = "You have Money in your Inbox";
			$body = "";
			
			// Build the body
			$body = "You have a new order from you website!\n\n";
			$body .= "Name: $firstname $lastname\n";
			$body .= "Email: $email\n";
			$body .= "Address: $billaddress\n";
			$body .= "City: $billcity\n";
			$body .= "State: $billstate\n";
			$body .= "Postal Code: $billpostalcode\n";
			$body .= "Total: $total\n";

			// Send the Email
			mail($to, $subject, $body, $headers);

			// Empty the Cart
			unset($_SESSION["product"]);
			
			$_SESSION["TRANSACTIONID"] = $transactionid;
			
			header("Location: thankyou.php");
			
			exit;
		}

	}
}
?>