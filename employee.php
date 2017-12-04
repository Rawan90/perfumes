<?php 
		session_start(); 
		include_once 'connection.php';
		$EID = $_SESSION['employees'];
		if(!isset($EID))
		{
			header("Location: ../home/index.php");
		}
		$EmpFName = $_SESSION['empFirstName'];
		
?>


<head>
	<!--<link rel="stylesheet" type="text/css" href="../css/style.css">-->
</head>

<html>
<div class = "pagediv">

	<body>
		
		<h1>Employee Page </h1>
		<h3>Welcome, <?php echo $EmpFName ; ?>. </h3>

		<h3>Using this page, you have the option to add a new perfume, update a perfume's description, view the store's transaction history, or cancel a customer's transaction.</h3>
    
	</body>
	
</div>
</html>

<html> 
    <head> 
        <title>Sign-Up</title>
    </head>
    
    <body id="body-color">
        <br></br>
			<h1>Add New Perfume</h1>
			<div class= "formdiv">
				<form action="../employee/addPerfume2.php" method="post"  enctype="multipart/form-data" >  
						<label for="pid"><b> Perfume ID: </b> </label>
						<input type="text" name="pid" id="pid" maxlength="5" placeholder="5001">
					<br></br>
						<label for="pn"><b>  Perfume Name: </b> </label>
						<input type="text" name="pn" id="pn" maxlength="50">
					<br></br>
						<label for="pbn"><b> Brand Name: </b></label>
						<input type="text" name="pbn" id="pbn" maxlength="50">
					<br></br>
						<label for="pfn"><b> Family Name: </b></label>
						<input type="text" name="pfn" id="pfn" maxlength="50">
					<br></br>
						<label for="pd"><b> Description: </b></label>
						<input type="text" name="pd" id="pd">
                    <br></br>			
					<input type="submit" name="submit" value="Submit">  
					<br></br>
				</form>
			</div>
        </body>
</html>



<html> 
    <head> 
        <title>Sign-Up</title>
    </head>
    
    <body id="body-color">
        <br></br>
			<h1>Update Perfume Description</h1>
			<div class= "formdiv">
				<form action="../employee/updatePerfume2.php" method="post"  enctype="multipart/form-data" >  
						<label for="pid"><b> Perfume ID: </b> </label>
						<input type="text" name="pid" id="pid" maxlength="5" placeholder="5001">
					<br></br>
						<label for="pd"><b> Description: </b></label>
						<input type="text" name="pd" id="pd">
                    <br></br>			
					<input type="submit" name="submit" value="Submit">  
					<br></br>
				</form>
			</div>
        </body>
</html>

<html>     
    <body id="body-color">
        <br></br>
			<h1>View Transaction History</h1>
			<div class= "formdiv">
				<form action="../employee/viewTransactionHistory.php" method="post"  enctype="multipart/form-data" >  			
					<input type="submit" name="viewTransactionHistory" value="View Transaction History">  
					<br></br>
				</form>
			</div>
        </body>
</html>

<html>  
    <body id="body-color">
        <br></br>
			<h1>Cancel Transaction</h1>
			<div class= "formdiv">
				<form action="../employee/deleteTransaction.php" method="post"  enctype="multipart/form-data" >  
						<label for="tid"><b> Transaction ID: </b> </label>
						<input type="text" name="tid" id="tid">
                    <br></br>			
					<input type="submit" name="submit" value="Cancel Transaction">  
					<br></br>
				</form>
			</div>
        </body>


    <footer>
		<small>
			<b>© Copyright 2017</b>
		</small>
	</footer>
</html>