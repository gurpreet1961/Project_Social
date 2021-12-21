<?php
	
	

	include("classes/autoload.php");


	$ERROR ="";
	$login = new Login();
	$user_data = $login->check_login($_SESSION['socialsite_userid']);

	$USER = $user_data;
	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
			$profile = new Profile();
		$profile_data = $profile->get_profile($_GET['id']);

	if(is_array($profile_data))
	{
	$user_data = $profile_data[0];
	}
	
}

$msg_class = new Messages();


$page = explode('&',$_SERVER['REQUEST_URI']);
	$url = explode('?id=',$page[0]);

//new message //check if thread already exists
	if(isset($page[1]) && $page[1] == "new" ) 
	{

		$old_thread = $msg_class->read($url[1]);
		if(is_array($old_thread))
		{

			//redirect the user
			header("Location: ".'messages.php?id=' . $url[1] . "&read");
			die;

		}
}

	
					
				
				
	//if a message was posted
	if($ERROR =="" && $_SERVER['REQUEST_METHOD'] == "POST" )
	{


		$user_class = new User();
		
		if(is_array($user_class->get_user($url[1])))
		{

			
		$ERROR = $msg_class->send($_POST,$_FILES);
		print_r($ERROR);


		header("Location: ".'messages.php?id=' . $url[1] . "&read");
		die;

		}else
		{
			$ERROR = "The requested user could not be found!";
		}
		
	}
	?>
<!DOCTYPE html>
	<html>
	<head>
		<title>
			Messages - social
		</title>
	</head>
	<style type="text/css">
		#blue_bar{
			height: 50px;
			background-color:#4c3c3c; 
			color:#ffffff;
		}
		#search_box{
			width: 400px;
			height: 20px;
			border-radius: 5px;
			border: none;
			padding: 4px;
			font-size: 14px;
			background-image: url(img/search.png);
			background-repeat: no-repeat;
			background-position: right;

		}
		#profile_pic{
			width: 150px;
			border-radius: 50%;
			border: solid 2px white;
		}
		#menu_buttons{
			width: 100px;
			display: inline-block;
			margin: 2px;

		}
		#friends_img{
			width: 75px;
			float: left;
			border-radius: 50%;
			margin: 8px;

		}
		#friends_bar{
	
			min-height: 400px;
			margin-top: 20px;
			color: #405d9b;
			padding: 8px;
			text-align: center;
			font-size: 20px;


		}
		#friends{
			clear: both;

		}

		textarea{
			width: 100%;
			border: none;
			background-color: transparent;
   			resize: none;
    		outline: none;
			font-family: tahoma;
			font-size: 14px;
			height: 60px;
		}
		#post_button{
			float: right;
			background-color: #405d9b;
			border: none;

			color: white;
			padding: 4px;
			font-size: 14px;
			border-radius: 2px;
			width: 50px;

		}
		#post_bar{
			margin-top: 20px;
			background-color: white;
			padding: 10px;
		}
		#post{
			padding: 4px;
			font-size: 13px;
			display: flex;
			margin-bottom: 20px;
		}
		#message_left{
			padding: 4px;
			font-size: 13px;
			display: flex;
			margin: 8px;
			width: 60%;
			float: left;
			border-radius: 10px;

		}
		#message_thread{
			padding: 4px;
			font-size: 13px;
			display: flex;
			margin: 8px;
			border-radius: 10px;

		}
		#message_rigth{
			padding: 4px;
			font-size: 13px;
			display: flex;
			margin: 8px;
			width: 60%;
			float: right;
			border-radius: 10px;

		}
	</style>
	<body style="font-family: tahoma; background-color: #d0d8e4;">
		<!-- nav bar -->
		<br>
		<?php 
			include ("header.php");
		?>
		<!-- nav bar end -->
		<div style="width: 800px; margin: auto; min-height: 400px;">
			
		
			<!--below cover Area-->
			<div style="display: flex;">
				
					<!--post area -->
					<div style="min-height: 400px; flex: 2.5; padding: 20px; padding-right: 0px;">
						<div style="border: solid thin #aaa; padding: 10px; background-color: white;">

						
							<form method="post" enctype="multipart/form-data">
								
								<br>

								<?php 


									if($ERROR != "")
									{
										echo $ERROR;
									}
									else
								{
									// if(isset($_SERVER['REQUEST_URI'])  && (strpos($_SERVER['REQUEST_URI'], 'new') != false)){

									

									// if(isset($url[1])   && (strpos($_SERVER['REQUEST_URI'], 'read') != false)) {

									// }else
									// 	if(isset($url[1]) &&  is_numeric($url[1]))
									$page = explode('&',$_SERVER['REQUEST_URI']);
									$url = explode('?id=',$page[0]);
									if(isset($page[1]) && $page[1] == "read"){
										echo "Chatting with:<br><br>";
										if(isset($url[1]) && is_numeric($url[1])){

										$data = $msg_class->read($url[1]);
										$user = new User();
										$FRIEND_ROW = $user->get_user($url[1]);
										include "user.php";
										echo '

										<div>';
										$User = new User();
										foreach ($data as $MESSAGE) {
											# code...
											// echo "<pre>";
											// print_r($MESSAGE);
											// echo "</pre>";
											
											$ROW_USER = $User->get_user($MESSAGE['sender']);
											if(i_own_content($MESSAGE)){

											include "message_right.php";
										}else{
											include "message_left.php";
										}
										}
										echo'
										</div>';

										echo '
										<div style="border: solid thin #aaa; padding: 10px; background-color: white;">
										
										<textarea name="message" placeholder="Write Your message here"></textarea>
										<input type="file" name="file">

										<input id="post_button" type="submit" value="Send">
										<br>
										</div>';
									}else{
									echo "That user could not be found";
								}

									}else
									if(isset($page[1]) && $page[1] == "new" ) {

										echo "Start New Messages with:<br><br>";
										if(isset($url[1]) && is_numeric($url[1])){
										$user = new User();
										$FRIEND_ROW = $user->get_user($url[1]);
										include "user.php";
										echo '<div style="border: solid thin #aaa; padding: 10px; background-color: white;">
										
										<textarea name="message" placeholder="Write Your message here"></textarea>
										<input type="file" name="file">
										<input id="post_button" type="submit" value="Send">
										<br>
										</div>';
									}else{
									echo "That user could not be found";
								}
							
							}else{
								echo "Messages<br><br>";
								$data =  $msg_class->read_threads();
									$user = new User();
									$me = esc($_SESSION['socialsite_userid']);
									if(is_array($data)){
								foreach ($data as $MESSAGE) {
									# code...
									$myid = $MESSAGE['sender'] == $me ? $MESSAGE['receiver'] : $MESSAGE['sender'] ;

									$ROW_USER = $user->get_user($myid);
									include ("thread.php");
								}
							}else{



								echo "You have no message!";
							}
							echo "<br style='clear:both;'>";

								}
								
							}

								?>


							</form>

							<br>
						</div>

						
					</div>
			</div>
		</div>

	</body>
</html>