<?php
session_start();

$token = "";
$total = 0;
$subtotal = 0;

$productname = "";
$productid = "";
$productqty = "";
$productprice = "";

// Add to Cart
$token = $_POST["token"];

if($token == "add")
{
	$productname = $_POST["productname"];
	$productid = $_POST["productid"];
	$productqty = $_POST["productqty"];
	$productprice = $_POST["productprice"];
	
	$_SESSION["product"][$productid]["id"] = $productid;
	$_SESSION["product"][$productid]["name"] = $productname;
	$_SESSION["product"][$productid]["qty"] = $productqty;
	$_SESSION["product"][$productid]["price"] = $productprice;
}

$token = "";

$token = $_GET["token"];

if($token == "empty")
{
	unset ($_SESSION["product"]);
}

if($token == "remove")
{
	$productid = "";
	$productid = $_GET["productid"];
	
	unset($_SESSION["product"][$productid]);
	
}
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Cart - Megan Wilson Prints</title>
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
	<div class="main-content row">
      <div class="col">
      <table border="1">
		<tr>
			<td>Product ID</td><td>Product Name</td><td>Quantity</td><td>Price</td><td>Subtotal</td><td>Action</td>
		</tr>

		<?php
		if(isset($_SESSION["product"]))
		{
			foreach($_SESSION["product"] as $i => $values)
			{
				$productid = $_SESSION["product"][$i]["id"];
				$productname = $_SESSION["product"][$i]["name"];
				$productqty = $_SESSION["product"][$i]["qty"];
				$productprice = $_SESSION["product"][$i]["price"];
				
				$subtotal = ($productqty * $productprice);
				
				$total += $subtotal;
		?>
		    <tr>
		    	<td><?= $productid?></td>
		    	<td><?= $productname?></td>
		        <td><?= $productqty?></td>
		        <td><?= $productprice?></td>
				<td><?= $subtotal?></td>
			
		        <td><a href="cart.php?token=remove&productid=<?=$productid?>">Remove</a></td>
		    </tr>
		<?php
			}
		} else {
		?>

			<tr>
				<td align="center" colspan="6">No items in cart</td>
			</tr>
		<?php
		}
		?>
		    <tr>
				<td align="right" colspan="4">Total</td><td align="right"><?php echo $total; ?></td><td>&nbsp;</td>
			</tr>
		</table>

    <br />
    <p align="center">

    <a href="index.php">Continue Shopping</a>
    <br />

    <a href="checkout.php">Checkout</a>

    <br />
    <a href="cart.php?token=empty">Empty Cart</a>
    </p>
	</div>
</div>
<?php include "footer.php";?>
</body>
</html>