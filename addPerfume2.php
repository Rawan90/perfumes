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
        <h1>Add New Perfume</h1>
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
					if(!isset($_POST['pn']) || $_POST['pn'] === '')
					{
                        //perfume name not empty
						echo "<p class='errors'>* Perfume Name can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['pbn']) || $_POST['pbn'] === '')
					{
                        //brand name not empty
						echo "<p class='errors'>* Brand Name can't be empty!</p>";
						$ok = false;
						$test =false;
					}
					if(!isset($_POST['pfn']) || $_POST['pfn'] === '')
					{
                        //family name not empty
						echo "<p class='errors'>* Family Name can't be empty!</p>";
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
						$PN = mysqli_real_escape_string($conn, $_POST['pn']);
						$PBN = mysqli_real_escape_string($conn, $_POST['pbn']);					
						$PFN = mysqli_real_escape_string($conn, $_POST['pfn']);						
						$PD = mysqli_real_escape_string($conn, $_POST['pd']);

						
				        //name next to table should be the one in the database columns in php my admin 
                        //after values: the variables.
                        
                        //insert into tables
						$query = "INSERT INTO perfumes (perfumeID, perfumeName, brandName, familyName, description) 
                        VALUES ('$PID', '$PN', '$PBN', '$PFN', '$PD');";
						
						
						
						if(mysqli_multi_query($conn, $query))
						{
							echo "New perfume successfully added to database!";
							$test = true;
						}	 
						else
						{
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
