<?php 
		session_start(); 
		include_once 'connection.php';
		$CID = $_SESSION['customers'];
		if(!isset($CID))
		{
			header("Location: ../home/index.php");
		}
		$CFName = $_SESSION['customerFirstName'];
		
?>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Perfume Store</title>
	<meta name="description" content="PerfumeStore">

	<!-- <link rel="stylesheet" href="css/styles.css?v=1.0"> -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
<![endif]-->

<style>
.heading {
	color: black;
	/*text-align: center;*/
	font-size: 30px;
}

.heading2 {
	font-size: 20px;
}

.container {
	width: 98%;
}
</style>
</head>

<body>
	<div class="container" style="margin-top: 40px;">
		<div class="heading text-center" style="height: 50px; border-bottom: 2px solid grey; z-index: 999">PERFUME STORE</div> 
		<?php 
		// Create a query for the database
		//require_once('../connection.php');
		$query1 = "SELECT c.customerFirstName as customerFirstName
		FROM customers c, login l
		WHERE l.userID = c.userID AND
		l.userID = 9001";

		$response1 = @mysqli_query($conn, $query1);

		if($response1) {
		$customerObj = mysqli_fetch_array($response1);
	}

	?>
	<div class="heading2 text-left" style="margin-bottom: 50px;">
		WELCOME	<?php echo $customerObj['customerFirstName'] ?>
	</div>
	<div class="heading2 text-left" style="margin-bottom: 20px;">Shopping Cart</div>

	<?php 
	// Create a query for the database
	//require_once('../connection.php');
	$query = "SELECT perfumes.perfumeName as perfumeName, products.bottleSize AS perfumeSize, products.pricePerUnit AS perfumePrice,perfumes.description as Discription,transactiondetails.quantityOrdered AS Quantity, (transactiondetails.quantityOrdered*products.pricePerUnit) as Total
	FROM perfumes ,products ,transactiondetails,customers,transactions  
	WHERE perfumes.perfumeID=products.perfumeID AND
	perfumes.perfumeID = transactiondetails.perfumeID AND
	transactions.transactionID = transactiondetails.transactionID AND
	customers.customerID = transactions.customerID AND
	products.bottleSize = transactiondetails.bottleSize AND
	customers.customerID = transactions.customerID AND
	transactions.transactionID = 50001";

	// Get a response from the database by sending the connection
	// and the query
	$response = @mysqli_query($conn, $query);
	?>

	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">Product</th>
				<th scope="col">Size</th>
				<th scope="col">Description</th>
				<th scope="col">Price/Product</th>
				<th scope="col">Quantity</th>
				<th scope="col">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$allTotal = 0; 
			while ($row = mysqli_fetch_array($response)) {
			?>

			<tr>
				<td scope="row"><?php echo $row['perfumeName'] ?></td>
				<td><?php echo $row['perfumeSize'] ?></td>
				<td><?php echo $row['Discription'] ?></td>
				<td>$<?php echo $row['perfumePrice'] ?></td>
				<td><?php echo $row['Quantity'] ?></td>
				<td>$<?php $total = $row['perfumePrice'] * $row['Quantity']; echo $total ?></td>
				<?php $allTotal += $total ?>
			</tr>
			<?php }  ?>
		</tbody>
	</table>
	<div class="heading2 text-right" style="font-weight: bold">
		Total $<?php echo $allTotal ?>				
	</div>
	<div class="text-center">
		<a href='customer/customer.php' class="btn btn-primary">Continue Shopping</a>
		<a href='orderplaced.php' class="btn btn-success">Place Order</a>
	</div>
</div>
<footer style="bottom: 0; height: 50px; width: 100%; position: fixed">
	<div class="text-center">
		<a>Help</a>&nbsp;|&nbsp; 
		<a>Contact Us</a>
	</div>
	<div class="text-left">
		Copyright 2017
	</div>
</footer>
</body>

</html>
