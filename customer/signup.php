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

<!DOCTYPE HTML>
<html> 
    <head> 
        <title>Sign-Up</title> 
    </head>
    
    <body id="body-color">
        <br></br>
			<h1>Registration</h1>
			<div class= "formdiv">
				<form action="../customer/signup2.php" method="post"  enctype="multipart/form-data" >  
					<br></br>
						<label for="cid"><b> Customer ID: </b> </label>
						<input type="text" name="cid" id="cid" maxlength="10" placeholder="10001">
					<br></br>
						<label for="cfn"><b>  First Name: </b> </label>
						<input type="text" name="cfn" id="cfn" maxlength="30">
					<br></br>
						<label for="cln"><b> Last Name: </b></label>
						<input type="text" name="cln" id="cln" maxlength="30">
					<br></br>
						<label for="pnum"><b>  Phone Number: </b></label>
						<input type="text" name="pnum" id="pnum" placeholder="0000000000" maxlength="10">
					<br></br>
						<label for="cadd"><b>  Address: </b></label>
						<input type="text" name="cadd" id="cadd"  placeholder = "5600 City Ave">
					<br></br>
                        <label for="state"><b>  State: </b></label>
						<select name="state" id="state">
							<option selected disabled>Choose a state</option>
                            <option>PA</option>


                            <!-- For later it should take the list of all states -->
						</select>
                    <br></br>
                        <label for="city"><b>  City: </b></label>
						<select name="city" id="city">
							<option selected disabled>Choose a city</option>
                            <option>Philadelphia</option>
                            <option>Allentown</option>
                            <option>Pittsburgh</option>
                            <option>Harrisburg</option>
                             <option>Erie</option>
                             <option>Lancaster</option>
                             <option>Scranton</option>
                             <option>West Chester</option>
                             <option>New Hope</option>
                             <option>Pottstown</option>
                             <option>Bala Cynwyd</option>
                             <option>Lehigh</option>
                             <option>Blair</option>


                            <!-- For later it should take the list of cities based on the chosen state -->
						</select>
					<br></br>
                        <label for="pcode"><b>  Postal Code: </b></label>
						<input type="text" name="pcode" id="pcode"  placeholder = "19131">
					<br></br>
						<label for="gender"><b>  Gender: </b></label>
							<input type="radio" name="gender" value="F" checked> Female<t></t>
							<input type="radio" name="gender" value="M" checked> Male<br>
                    <br></br>
						<label for="email"><b>  Email: </b></label>
						<input type="email" name="email" id="email" placeholder="example@example.com">
						<label id="emailError"> </label>
                    <br></br>
					<label for="pass"><b>  Password: </b></label>
						<input type="password" name="pass" id="pass">
						<small><label> Password should be between 5-15 characters</label></small>
					<br></br>					
					<input type="submit" name="submit" value="Submit">  
					<br></br>
				</form>
			</div>
        </body>
</html>
        
        <!-----------------------
        <div id="Sign-Up"> 
            <fieldset style="width:30%">
                <legend>Registration Form</legend>
                <table border="0"> 
                <tr> 
                    <form method="POST" action="connectivity-sign-up.php">
                    </tr> 
                    <tr> <td>Cutomer ID</td><td> <input type="text" name="customerID"></td> </tr> 
                    <tr> <td>First Name</td><td> <input type="text" name="fname"></td> </tr> 
                    <tr> <td>Last Name</td><td> <input type="text" name="lname"></td> </tr> 
                    <tr> <td>Phone Number</td><td> <input type="text" name="phone"></td> </tr> 
                    <tr> <td>Address</td><td> <input type="text" name="add"></td> </tr> 
                    <tr> <td>City</td><td> <input type="text" name="city"></td> </tr> 
                    <tr> <td>State</td><td> <input type="text" name="state"></td> </tr>
                    <tr> <td>Postal Code</td><td> <input type="text" name="pcode"></td> </tr> 
                    <tr> <td>Country</td><td> <input type="text" name="country"></td> </tr> 

                    <td>Gender:</td>
                        <input type="radio" name="gender" value="male" checked> Male<br>
                        <input type="radio" name="gender" value="female"> Female<br>
                        <input type="radio" name="gender" value="other"> Other
                    <tr> <td>Email</td>
                    <td> <input type="text" name="email"></td> </tr> 

                     
                    <tr> <td>Password</td><td> <input type="password" name="pass"></td> </tr> 
                    <tr> <td>Confirm Password </td><td><input type="password" name="cpass"></td> </tr> 
                    <tr> <td><input id="button" type="submit" name="submit" value="Sign-Up"></td> </tr> 

            ----------------------------->

<!-- http://mrbool.com/how-to-create-a-sign-up-form-registration-with-php-and-mysql/28675 -->