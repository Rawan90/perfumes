<!-- index -->
<?php
session_start();
include_once '../connection.php';


if(isset($_SESSION['user'])!="")
{
    //logout
	header("Location: home/logout.php?logout");
}

if(isset($_POST['login']))
{
        /////////////////login////////////////

	$UName = mysqli_real_escape_string($conn, $_POST['UName']);
	$UPass = mysqli_real_escape_string($conn, $_POST['UPass']);
	$UName = trim($UName);
	$UPass = trim($UPass);
    //store uname in $Uname variable
	$Name = $_POST['UName'];
    
    
       //////////////////find user in database//////////////

	$query = "SELECT * FROM login WHERE userID = '$Name'";
	$result = mysqli_query($conn,$query);
	print($Name);
    
    if (!$result) 
	{
    printf("Error: %s\n", mysqli_error($conn));
    exit();
	}
    
	$row=mysqli_fetch_array($result);
    //make sure only one user is fetched for security purposes(dont open another customers page)
	$count = mysqli_num_rows($result);
    //now check all data is correct to proceed to home page
    
           //////////////////redirect to customer//////////////

	if($count == 1 && $row['password']==$UPass && $row['role']=="c")
	{
		$CID = $Name;
        //ses sql = store customer info here
		$ses_sql=mysqli_query($conn,"select * from customers where userID='$CID'");
		$row_sql=mysqli_fetch_array($ses_sql);
        //return number of rows if 1 start session
		$count_sql = mysqli_num_rows($ses_sql);
        //start session
		if($count_sql == 1)
		{
			$_SESSION['customerFirstName'] = $row_sql['customerFirstName'];
		}
	
		$_SESSION['customers'] = $CID;
		header("Location: ../customer/customer.php");
	}
        /////////////////redirect to employee///////////////////
    
	else if($count == 1 && $row['password']==$UPass && $row['role']=="e")
	{
		$EID = $Name;
        //ses sql = store employee info here
		$ses_sql=mysqli_query($conn,"select * from employees where userID='$EID'");
		$row_sql=mysqli_fetch_array($ses_sql);
        //return number of rows if 1 start session
		$count_sql = mysqli_num_rows($ses_sql);
		if($count_sql == 1)
		{
			$_SESSION['empFirstName'] = $row_sql['empFirstName'];
		}
	
		$_SESSION['employees'] = $EID;
		header("Location: ../employee.php");
	}
    //wrong password
	else
	{
		?>
			<script>alert('Username or Password is incorrect!');</script>
        <?php
	}

}


    /////////////////////signup//////////////////////////

if(isset($_POST['signup']))
{
    header("Location: ../customer/signup.php");

}

    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<head>
	<!--<html xmlns="http://www.w3.org/1999/xhtml">-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/cssTemplate.css"> 
</head>
<div class = "pagediv">

	<body>
	
			<br><br/>
			<h1>Welcome to Perfumes shop</h1>
			<div class= "formdiv">
				<form method="post">
					<fieldset><legend></legend>
						<label for = "UName"><b> Username </b></label>
							<input type="text" id= "UName" name="UName" required>
						<br><br/>
						<label for = "UPass"><b> Password </b></label>
							<input type="password" id= "UPass" name="UPass" required>
						<br><br/>
						<button type="submit" name="login"> Login </button>
                        <button type="submit" name="signup"> Signup </button>
					</fieldset>
				</form> 
			</div>
	</body>

</div>
</html>