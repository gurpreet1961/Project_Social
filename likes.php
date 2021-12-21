<?php
	
	

	include("classes/autoload.php");



	$login = new Login();
	$user_data = $login->check_login($_SESSION['socialsite_userid']);

	$USER = $user_data;
	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
			$profile = new Profile();
		$profile_data = $profile->get_profile($_GET['id']);

	if(is_array($profile_data)&&isset($profile_data))
	{
	$user_data = $profile_data[0];
	}
	
}
	
	$Post = new Post();
	$likes = false;
	$ERROR = "";
	if(isset($_GET['id']) && isset(($_GET['type'])))
	{
	
	$likes = $Post->get_likes($_GET['id'],$_GET['type']);

		
	}else
	{
		$ERROR = "No Information found!";
	}
	
	?>
<!DOCTYPE html>
	<html>
	<head>
		<title>
			People who like - social
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

						<?php 

							$User = new User();
							$image_class = new Image();
							if(is_array($likes))
							{
								foreach ($likes as $row) {
									# code..
									$FRIEND_ROW = $User->get_user($row['userid']);
									include ("user.php");

								}
							}

						 ?>
						 <br style="clear: both; ">


							</div>

						
					</div>
			</div>
		</div>

	</body>
</html>