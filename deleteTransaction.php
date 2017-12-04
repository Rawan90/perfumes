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
        <h1>Cancel Transaction</h1>
        <?php

				if (isset($_POST['submit']))
				{
					echo "<h3>System Response:</h3>";
                    //set these 3 variables to true 
					$ok = true;
					$test = true;
					
					if(!isset($_POST['tid']) || $_POST['tid'] === '')
					{
                        //transation ID not empty check
						echo "<p class='errors'>*  transaction ID can't be empty!</p>";
						$ok = false;
						$test =false;
					}

                    //ok is true proceed
					if ($ok)
					{			
						$TID = mysqli_real_escape_string($conn, $_POST['tid']);	
                        
                        //delete transaction from the database
                        //Note: if we do a cascade, we won't need to have two delete statements
						$query = "DELETE from transactionDetails WHERE transactionID = '$TID';
						DELETE from transactions WHERE transactionID = '$TID';";
						
						
						
						if(mysqli_multi_query($conn, $query))
						{
							echo "The transaction was successfully deleted from the database!";
							$test = true;
						}	 
						else //this should be changed for the update function
						{
							//should say this transationID can't be found, so the delete can't go through/delete isn't necessary
							echo "<p class='errors'>* This transaction ID is already exists, please try anothor perfume ID</p>"; 
							$test = false;
						}
						
					}
					////////////////// redirect to home page //////////////////
                    
                    if ($test == true)
                    { 
                         header("Refresh: 2;Location: ../perfume/viewTransactionHistory.php");
                    }
                    
					//close connection
					mysqli_close($conn);
				}
				
            ?>
    </body>
</html>
