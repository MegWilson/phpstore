<?php
error_reporting(E_ALL ^ E_DEPRECATED);

/*
Page Name:  pagelist.php

This is a sample page used to display all product record from the 'products' table

TODO:  Update the variables on lines 15-18 with your DB host information, username/password and database name.
Make sure the spelling and case of your 'products' table matches that in your database table.
Verify the column names 'name', 'price' and 'thumbimage' match the spelling and case of those in your products table.


*/
session_start();

// Create Connection
$conn = mysqli_connect("localhost", "student", "student2017", "student_store") or die ("Some error occurred during connection " . mysqli_error($conn));

$search = "";
if(isset ($_GET["search"]))
{
	$search = $_GET["search"];
}

// Write Query
$SQL = "SELECT * FROM products";
$SQL .= " WHERE name LIKE '%$search%' ";

// Execute Query
$result = mysqli_query($conn, $SQL);

mysqli_close($conn);

?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Product Search - Megan Wilson Prints</title>
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

	<div class="main-content">
		<div class="row">
			<form method="GET" action="productsearch.php" class="col">
			Search: <input type="text" name="search" value="<?= $search ?>">
			<input type="submit" value="Go">
			</form>

			<table border="1" cellpadding="2" cellspacing="2" class="col">
			<tr>
				<th>Name</th>
				<th>Price</th>
				<th>Featured</th>
				<th>Thumb Image</th>
			</tr>
			<?php
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
			?>
				<tr>
					<td><a href="product1.php?ID=<?=$row["productid"]?>"><?= $row["name"] ?></a></td>
					<td><?= $row["price"] ?></td>
					<td><?= $row["featured"] ?></td>
					<td><a href="product1.php?ID=<?=$row["thumbimage"]?>"><img src="images/<?= $row["thumbimage"] ?>" height="80" /></a></td>
				</tr>
			<?php
			}
			?>
			</table>
		</div>
	</div>
<?php include "footer.php";?>
</body>
</html>
