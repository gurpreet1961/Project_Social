<?php
	


	include("classes/connect.php");
	include("classes/signup.php");

	$first_name = "";
	$last_name = "";
	$gender = "";
	$email = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$signup = new Signup();
		$result = $signup->evaluate($_POST);

		

		if($result != "")
		{
			echo "<div style='text-align: center;font-size:12px; color: : white; background-color: grey;'>";
			echo "The following errors occured:<br><br>";
			echo $result;
			
			echo "</div>";
			
		}else
		{
			header("Location: login.php");
			die;
		}

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];
	}
	
	


?>


<!doctype html>
<html>
<head>
    <title> sign up-social </title>
	<meta charset="utf-8">
	
	<style type="text/css">
	    
	    body{
			background-image: url(img/1.jpeg);
			background-size: cover;
			background-attachment: fixed;
			font-family: cambria-math;
			font-size: 25px;
		}
		img{
		    margin:auto;
			margin-top: 15px;
			margin-left: 29px;
			border-radius: 60%;
			
		}
		#txt{
		    font-family: cambria-math;
			font-size: 50px;
			color: black;
			text-align: center;
		    
		}
		#box{
		    margin: auto;
			margin-top: auto;
			margin-left: 550px;
			background-color: rgb(250,250,250);
			width: 40%;
			height: 900px;
			padding: 10px;
			padding-top: 3px;
			border-radius: 10px;
			text-align: center;
		}
		#text{
		    width: 24%;
			height: 40px;
		    border-radius: 10px;
			border: solid 2px black;
			color: black;
			font-family: cambria-math;
			font-size: 22px;
			padding: 5px;
		}
		#button{
		    margin: auto;
		    width: 20%;
			height: 45px;
		    border-radius: 15px;
			background-color: green;
		    border: green;
			color: white;
			font-family: cambria-math;
			font-size: 22px;
			padding: 5px;
		}
		#text1{
		    width: 50%;
			height: 40px;
		    border-radius: 10px;
			border: solid 2px black;
			font-family: cambria-math;
			font-size: 22px;
			padding: 5px;
		}
		#button1{
		    width: 56%;
			height: 45px;
		    border-radius: 10px;
			border: rgb(59,89,152);
			background-color: rgb(59,89,152);
			font-family: cambria-math;
			font-size: 20px;
			color: white;
			padding: 5px;
		}
		
	</style>
<head>

<body>
   <!-- <img src="img/2.jpeg" width="15%" height="100px" cellspacing="5" cellpadding="5"> -->
    <div id="box1">
	
	</div><br>
	<div id="box">
        <img src="img/4s.jpeg" width="55%" height="200px" cellspacing="2" cellpadding="2">
		<div id="txt" ><strong>Sign up</strong></div> <br>
		<form method="post" action="">
		<input value="<?php echo $first_name ?>" name= "first_name" type="text" id="text" placeholder="  First name " >
		<input value="<?php echo $last_name ?>" name="last_name" type="text" id="text" placeholder="  Last name "><br><br>
		
		<span style="font-weight: normal;">Gender:</span><br>
		<select id="text" name="gender">
			<option><?php echo $gender ?></option>
			<option>Male</option>
			<option>Female</option>
		</select>
		<br><br>
		
		<input value="<?php echo $email ?>"  name="email" type="text" id="text1" placeholder=" Email address" ><br><br>
		
		<input  name="password" type="password" id="text1" placeholder="  Create a Password " ><br><br>
		<input name="password2" type="password" id="text1" placeholder="  Conform Password " ><br><br>
		
		<input type="submit" id="button" value="Sign Up" >
	</form>
		</form>
		<form action="login.php">
			<br>
			Already have an account<br>

				<input type="submit" id="button1" value="login">
			</form>
	</div>	
</body>
</html>