<?php



session_start();


	include("classes/connect.php");
	include("classes/login.php");
	
	$email = "";
	$password = "";
	

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$login = new Login();
		$result = $login->evaluate($_POST);

		

		if($result != "")
		{
			echo "<div style='text-align: center;font-size:12px; color: : white; background-color: grey;'>";
			echo "The following errors occured:<br><br>";
			echo $result;
			
			echo "</div>";
			
		}else
		{
			header("Location: profile.php");
			die;
		}

		$email = $_POST['email'];
		$password = $_POST['password'];
	}
	
	


?>
<!doctype html>
<html>
<head>
    <title> login-social </title>
	<meta charset="utf-8">
	
	<style type="text/css">
	    
	    body{
			background-image: url(img/1.jpeg);
			background-size: cover;
			background-attachment: fixed;
		}
		img{
		    margin:auto;
			margin-top: 20px;
			margin-left: 30px;
			border-radius: 60%;
			
		}
		#box{
		    margin: auto;
			/*margin-top: 95px;
			margin-left: 750px;*/
			background-color: rgb(250,250,250);
			width: 28%;
			height: 700px;
			padding: 10px;
			padding-top: 3px;
			border-radius: 10px;
			text-align: center;
		}
		p{
		    font-family: cooper black;
			font-size: 50px;
			color: black;
			text-align: center;
		    
		}
		#text{
		    width: 58%;
			height: 40px;
		    border-radius: 10px;
			border: solid 2px black;
			font-family: cambria-math;
			font-size: 20px;
			padding: 5px;
		}
		#button{
		    margin: auto;
			margin-left: 30px;
		    width: 25%;
			height: 45px;
		    border-radius: 15px;
	        border: rgb(59,89,152);
			background-color: rgb(59,89,152);
		    color: white;
			font-family: cambria-math;
			font-size: 20px;
			padding: 5px;
		}
		#button1{
		    width: 56%;
			height: 45px;
		    border-radius: 10px;
			border: solid 2px green;
			background-color: green;
			font-family: cambria-math;
			font-size: 20px;
			color: white;
			padding: 5px;
		}
		
	</style>
<head>

<body>
   <!-- <a href="#"><img src="img/2.jpeg" width="15%" height="100px" cellspacing="5" cellpadding="5"></a> -->
    <div id="box1">
	
	</div><br>
	<div id="box">
		<form method="POST">
	        <img src="img/3.jpeg" width="80%" height="160" cellspacing="2" cellpadding="2">
			<p><strong>LOG IN </strong></p>
			
			<input name="email" value = "<?php echo $email ?>" type="text" id="text" placeholder=" Email" ><br><br>
			<input name="password" value = "<?php echo $email ?>" type="password" id="text" placeholder=" Password " ><br>
			<a href="#"><font face="cambria-math" size="5" color="blue" cellspacing="3" cellpadding="3">forgot password</font></a><br><br>
			<input type="submit" id="button" value="Log in" ><br><br>
			
	
		
		</form>
		<form action="signup.php">
			<font face="cambra-math" size="4" color="black" >Create new Account</font><br>
				<input type="submit" id="button1" value="Sign up">
			</form>
	</div>	
</body>
</html>