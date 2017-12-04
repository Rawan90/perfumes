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

<html>
    <body>
        <h1>Update Perfume Description</h1>
        <?php

				if (isset($_POST['submit']))
				{
					echo "<h3>System Response:</h3>";
                    //set these 3 variables to true 
					$ok = true;
					$test = true;
					
					if(!isset($_POST['pid']) || $_POST['pid'] === '')
					{
                        //perfume ID not empty check
						echo "<p class='errors'>*  perfume ID can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['pd']) || $_POST['pd'] === '')
					{
                        //description not empty
						echo "<p class='errors'>* Description can't be empty!</p>";
						$ok = false;
						$test =false;
					}
                        
                    //ok is true proceed
					if ($ok)
					{			
						$PID = mysqli_real_escape_string($conn, $_POST['pid']);						
						$PD = mysqli_real_escape_string($conn, $_POST['pd']);

                        
                        //update perfume description
						$query = "UPDATE perfumes SET description = '$PD' WHERE perfumeID = '$PID';";
						
						
						
						if(mysqli_multi_query($conn, $query))
						{
							echo "Perfume description successfully updated in the database!";
							$test = true;
						}	 
						else //this should be changed for the update function
						{
							//should say this perfumeID can't be found, so the update can't go through
							echo "<p class='errors'>* This perfume ID is already exists, please try anothor perfume ID</p>"; 
							$test = false;
						}
						
					}
					////////////////// redirect to home page //////////////////
                    
                    if ($test == true)
                    { 
                         header("Refresh: 2;Location: ../perfume/employee.php");
                    }
                    
					//close connection
					mysqli_close($conn);
				}
				
            ?>
    </body>
</html>
