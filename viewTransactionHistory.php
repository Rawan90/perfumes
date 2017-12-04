<?php 
		session_start(); 
		include_once 'connection.php';
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
		
		<h1>Transaction History</h1>
		<h3>Below is the current list of the store's full transaction history</h3>
    

	</body>
</html>

<?php
// Get a connection for the database
//require_once('connection.php');

// Create a query for the database
$query = "SELECT transactionID, transactionDate, customerID, employeeID FROM transactions";

// Get a response from the database by sending the connection
// and the query
$response = @mysqli_query($conn, $query);

// If the query executed properly proceed
if($response){

echo '<table align="left"
cellspacing="5" cellpadding="8">

<tr><td align="left"><b>Transaction ID</b></td>
<td align="left"><b>Transaction Date</b></td>
<td align="left"><b>Cusotmer ID</b></td>
<td align="left"><b>Employee ID</b></td></tr>';

// mysqli_fetch_array will return a row of data from the query
// until no further data is available
while($row = mysqli_fetch_array($response)){

echo '<tr><td align="left">' . 
$row['transactionID'] . '</td><td align="left">' . 
$row['transactionDate'] . '</td><td align="left">' .
$row['customerID'] . '</td><td align="left">'.
$row['transactionDate'] . '</td><td align="left">' ;

echo '</tr>';
}

echo '</table>';

} else {

echo "Couldn't issue database query<br />";

echo mysqli_error($conn);

}

// Close connection to the database
mysqli_close($conn);

?>