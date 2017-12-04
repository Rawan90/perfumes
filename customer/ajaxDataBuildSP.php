<?php
//Include database configuration file
include_once('../connection.php');

if(isset($_POST["scentID"]) && !empty($_POST["scentID"])){
    //Get all courses data
    $query = $conn->query("SELECT * FROM scents s, perfumes p, scentInPerfume sip 
                            WHERE p.perfumeID = sip.perfumeID AND
                                  s.scentID = sip.scentID AND
                                  s.scentID ='".$_POST['scentID']."' 
                            ORDER BY perfumeName ASC");
    
	//Count total number of rows
    $rowCount = $query->num_rows;

    
    //Display courses list
    if($rowCount > 0)
	{
        echo "<option value=''>Select a perfume</option>";
        while($row = $query->fetch_assoc())
		{ 
            echo "<option value='".$row['perfumeID']."'>".$row['perfumeName']." </option>";
		}
    }
	else
	{
        echo '<option value="">perfume is not Available</option>';
    }
}
?>