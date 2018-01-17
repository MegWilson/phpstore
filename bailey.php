<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Bailey Art Print - Megan Wilson Prints</title>
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
				<h2>"Bailey" Art Print</h2>
			</div>
		
		<div class="product-page">
			<div class="row">
				<div class="col product-image">
					<img src="./images/print2.png" alt="Bailey Art Print">
				
				<div class="col">
					<p><h4>Price:</h4> $24.99</p>
					<p><h4>Description:</h4> Lorem ipsum dolor sit amet consect etuer adipi scing elit sed diam nonummy nibh euismod tinunt ut laoreet dolore magna aliquam erat volut. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>

					<form method="post" action="cart.php">

					Qty: <input type="text" name="productqty" value="1" size="3" maxlength="3">

					<input type="hidden" name="productname" value="bailey">

					<input type="hidden" name="productid" value="2">

					<input type="hidden" name="productprice" value="24.99">

					<input type="hidden" name="token" value="add">

					<input type="submit" value="Add to Cart">

					</form>
				</div>
			</div>
			</div>
		</div>
	</div>
<?php include "footer.php";?>
</body>
</html>