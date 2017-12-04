<?php 
		session_start(); 
		include_once '../connection.php';
		$CID = $_SESSION['customers'];
		if(!isset($CID))
		{
			header("Location: ../home/index.php");
		}
		$CFName = $_SESSION['customerFirstName'];
		
?>

<?php

		$query = "SELECT * FROM scents ORDER BY scentName ASC";
		$result = mysqli_query($conn,$query);
		$options ="";
		while ($row = mysqli_fetch_array($result))
		{
			$options = $options."<option value = ".$row['scentID'].">".$row['scentName']."</option>";
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
        <link rel="stylesheet" href="../css/cssTemplate.css">
        <style>
            body, html {
                height: 100%;
                font-family: "Inconsolata", sans-serif;
            }
            .bgimg {
                background-position: center;
                background-size: cover;
                background-image: url("/w3images/coffeehouse.jpg");
                min-height: 75%;
            }       
            .menu {
                display: none;
            }
        </style>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#scent').on('change',function(){
					var scentID = $(this).val();
					if(scentID){
						$.ajax({
							type:'POST',
							url:'../customer/ajaxDataBuildSP.php',
							data:'scentID='+ scentID,
							success:function(html){
							$('#perfume').html(html); 
							}
						}); 
					}else{
						$('#perfume').html('<option value="">select scent first</option>');
					}
				});
			});

		</script>
	</head>

	<div class="w3-sand w3-grayscale w3-large">

	<body>
        <!-- Header with image -->
            <div id="wrapperHeader">
                <div id="header">
                    <img src="../images/img2.jpg" alt="img" />
                </div> 
            </div>
			<br></br>
            
        <h3 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">Welcome, <?php echo $CFName ; ?></span></h3>
			<div class="w3-panel w3-leftbar w3-light-grey">
				<form method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="scent"><b> Please Select a Scent: </b> </label>
					<br></br>
						<select name="scent" id="scent">
							<option value="">choose scent</option>
							<?php echo $options; ?>
						</select>
					<br></br>
						<label for="perfume"><b> Please Select a perfume: </b> </label>
					<br></br>
						<select name="perfume" id="perfume">
							<option selected disabled>select scent first</option>
						</select>
					<br></br>
					<input class="w3-button w3-black" type="submit" name="submit" value="Submit"> 
				    <a  class="w3-button w3-black" href='../customer/customer.php'> Back </a>		<br></br>
				</form>
	
		
<?php

  if(isset($_POST['perfume']))
	{
      //initialize variable
      $scent = mysql_real_escape_string($_REQUEST['scent']);	
      $perfume = mysql_real_escape_string($_REQUEST['perfume']);

	       //select statements 
            //select scent and perfume 
        	$query1= " SELECT *
					  FROM perfumes p, scentInPerfume sip, products pro
					  WHERE p.perfumeID = sip.perfumeID AND
                            p.perfumeID = pro.perfumeID AND
							p.perfumeID = '$perfume' AND
                            sip.scentID = '$scent'
                            LIMIT 1"; 
      
            $query2= " SELECT *
					  FROM perfumes p, scentInPerfume sip, products pro
					  WHERE p.perfumeID = sip.perfumeID AND
                            p.perfumeID = pro.perfumeID AND
							p.perfumeID = '$perfume' AND
                            sip.scentID = '$scent'
                            ";
			
			$result1 = mysqli_query($conn,$query1);
            $result2 = mysqli_query($conn,$query2);
			
			$rowCount1 = $result1->num_rows;
            $rowCount2 = $result2->num_rows;

			if ($rowCount1 === 0 || $rowCount2 === 0)
			{
				echo "<p class='errors'>This perfume is not avilable!</p>";
				echo "<br></br>";
			}
			else
			{
    	
?>

			<br></br>
			<h1>Your Search Result is:</h1>
			<table>
				<tr>
					<th><b>Perfune Name</b></th>
					<th><b>Brand Name</b></th>
					<th><b>Family Name</b></th>
					<th><b>Description</b></th>
				</tr>
				
		<?php
			
				while ($row = mysqli_fetch_array($result1)) {
					echo '<tr>';
						echo '<td>' . $row['perfumeName'] . '</td>';
						echo '<td>' . $row['brandName'] . '</td>';
						echo '<td>' . $row['familyName'] . '</td>';
						echo '<td>' . $row['description'] . '</td>';
					echo '</tr>';
                }
        ?>
                <tr>
					<th><b>Bottle Size</b></th>
					<th><b>Price per Unit</b></th>
                </tr>   
        <?php
                while ($row = mysqli_fetch_array($result2)) {
                    echo '<tr>';
						echo '<td>' . $row['bottleSize'] . '</td>';
						echo '<td>' . $row['pricePerUnit'] . '</td>';
                        echo '<td><a class="w3-button w3-black" href="../cart.php">add to cart</a></td>'; 
					echo '</tr>';
                }
				
			echo'</table>';
            }
            
	   }
	
		?>
			
		</div>

	</body>	

<!-- Close Connection -->
<?php mysqli_close($conn); ?>
		
	<footer>
		<small>
			<b>� Copyright 2017</b>
		</small>
	</footer>
	
	</div>
</html>