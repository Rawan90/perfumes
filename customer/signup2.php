<?php 
		session_start(); 
		include_once '../connection.php';
		$CID = $_SESSION['customers'];
		if(!isset($CID))
		{
			header("Location: ../home/index.php");
		}
		$CFName = $_SESSION['customerFirstName'];

///////////////////redirect to home page//////////////////
?>
<html>
    <body>
        <h1>Registration</h1>
        <?php

				if (isset($_POST['submit']))
				{
					echo "<h3>System Response:</h3>";
                    //set these 3 variables to true 
					$ok = true;
					$test = true;
					$pass = trim($_POST['pass']);
                    //check password not empty
					if(!isset($_POST['pass']) || $_POST['pass'] === '')
					{
						echo "<p class='errors'>* Password cannot be empty!</p>";
						$ok = false;
						$test =false;
					}
                    //pass length
					if((strlen($pass)) < 5 || (strlen($pass) > 15))
					{
                        //check password from 6 to 16 chars
						echo "<p class='errors'>* Password should be between 5-15 charactures</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['cid']) || $_POST['cid'] === '')
					{
                        //customer ID not empty check
						echo "<p class='errors'>*  customer ID can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['cfn']) || $_POST['cfn'] === '')
					{
                        //first name not empty
						echo "<p class='errors'>* Customer First Name can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['cln']) || $_POST['cln'] === '')
					{
                        //customer last name not empty
						echo "<p class='errors'>* Customer Last Name can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['pnum']) || $_POST['pnum'] === '')
					{
                        //customer phone number not empty
						echo "<p class='errors'>* Phone Number can't be empty!</p>";
						$ok = false;
						$test =false;
					}
                    if(!isset($_POST['cadd']) || $_POST['cadd'] === '')
					{
                        //customer phone number not empty
						echo "<p class='errors'>* Address can't be empty!</p>";
						$ok = false;
						$test =false;
					}
                    if(!isset($_POST['pcode']) || $_POST['pcode'] === '')
					{
                        //address not empty
						echo "<p class='errors'>* Postal Code field can't be empty!</p>";
						$ok = false;
						$test =false;
					}
                    if(!isset($_POST['email']) || $_POST['email'] === '')
					{
                        //email not empty
						echo "<p class='errors'>* Email field cannot't be empty!</p>";
						$ok = false;
						$test =false;
                    }
                        
                    //ok is true proceed
					if ($ok)
					{			
						$PASS = mysqli_real_escape_string($conn, $_POST['pass']);
						$CID = mysqli_real_escape_string($conn, $_POST['cid']);
						$CFN = mysqli_real_escape_string($conn, $_POST['cfn']);
						$CLN = mysqli_real_escape_string($conn, $_POST['cln']);
						$PNUM = mysqli_real_escape_string($conn, $_POST['pnum']);
						$EMAIL = mysqli_real_escape_string($conn, $_POST['email']);
						$CADD = mysqli_real_escape_string($conn, $_POST['cadd']);
                        $STATE = mysqli_real_escape_string($conn, $_POST['state']);
                        $CITY = mysqli_real_escape_string($conn, $_POST['city']);
                        $PCODE = mysqli_real_escape_string($conn, $_POST['pcode']);
                        $gender = mysqli_real_escape_string($conn, $_POST['gender']);

						
				        //name next to table should be the one in the database coloumns in php my admin 
                        //after values: the variables.
                        
                        //insert into tables
						$query = "INSERT INTO login (userID, role, password) 
                        VALUES ('$CID', 'c', '$PASS');
                        INSERT INTO customers (customerID, customerLastName, customerFirstName, phone,addressLine1, city, state,postalCode, country, gender, email, userID)
                        VALUES ('$CID', '$CLN', '$CFN', '$PNUM', '$CADD', '$CITY', '$STATE', '$PCODE','United States', '$gender', '$EMAIL', '$CID');";
						
						
						
						if(mysqli_multi_query($conn, $query))
						{
							echo "Successfully Registered!";
							$test = true;
						}	 
						else
						{
							echo "<p class='errors'>* This user ID is already exists, please try anothor user ID</p>";
							$test = false;
						}
						
					}
					////////////////// redirect to home page //////////////////
                    
                    if ($test == true)
                    { 
                         header("Location: ../customer/home.php");
                    }
                    
                   //back and add to cart buttons. 
			/*		if ($test === true)
					{
						echo "<br></br>";
						echo "<a class='singlelink2' href='../employee/employee.php'><b>Back</b></a>";
						echo "  ";
						echo "<a class='singlelink2' href='../employee/new_student.php'><b>Add Another Student</b></a>";
					}
					else if ($test === false)
					{
						echo "<br></br>";
						echo "<a  class='singlelink2' href='../employee/new_student.php'> Back </a>";
					}
                    
               */
					//close connection
					mysqli_close($conn);
				}
				
            ?>
    </body>
</html>