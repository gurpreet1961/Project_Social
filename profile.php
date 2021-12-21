<?php
	
	

	include("classes/autoload.php");


	$login = new Login();
	$_SESSION['socialsite_userid'] = isset($_SESSION['socialsite_userid']) ? $_SESSION['socialsite_userid'] : 0;
	$user_data = $login->check_login($_SESSION['socialsite_userid'],false);

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


//posting start here

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		
		include ("change_image.php");
		if(isset($_POST['first_name'])){
			$settings_class = new Settings();
			$settings_class->save_settings($_POST,$_SESSION['socialsite_userid']);
		}else
		{
			$post = new Post();
			$id = $_SESSION['socialsite_userid'];
			$result = $post->create_post($id,$_POST,$_FILES);

			if($result == "")
			{
				header("Location: profile.php");
					die;
			
			}else
			{
				echo "<div style='text-align: center;font-size:12px; color: : white; background-color: grey;'>";
				echo "The following errors occured:<br><br>";
				echo $result;
				
				echo "</div>";
			}
		}
		
	
	}

 	//collect posts

		$post = new Post();
		if(isset($user_data)){
			$id =$user_data['userid'];
		
	
		$posts = $post->get_posts($id);


	//collect friends
		$user = new User();
		

		$friends = $user->get_following($user_data['userid'],"user");

		$image_class = new Image();

//check if this is from a notification
	if(isset($_GET['notif'])){
	notification_seen($_GET['notif']);
					}
				}
				else{
					header("Location: login.php");
				}
?>

<!DOCTYPE html>
	<html>
	<head>
		<title>
			Profile-social
		</title>
	</head>
	<style type="text/css">
		#blue_bar{
			height: 50px;
			background-color:#333; 
			color:#ffffff;
			width:100%;


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
		#textbox{
			width: 100%;
			height: 20px;
			border-radius: 5px;
			border: none;
			padding: 4px;
			font-size: 14px;
			border: solid thin grey;
			margin: 10px;
			

		}
		#profile_pic{
			width: 150px;
			margin-top: -200px; 
			border-radius: 11160%;
			border: solid 2px white;
		}
		#menu_buttons{
			width: 100px;
			/*background-color: black;*/
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
			background-color: white;
			min-height: 400px;
			margin-top: 20px;
			color: #405d9b;
			padding: 8px;

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
			min-width: 50px;
			cursor: pointer;

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
		<!--change profile image area-->
		<div id = "change_profile_image" style="display:none;position: absolute;width: 100%; height: 100%;background-color: #000000aa;">
			<div style="max-width:600px; margin: auto;min-height: 400px; flex: 2.5; padding: 20px; padding-right: 0px;">
						<form method="post" action="profile.php?change=profile"  enctype="multipart/form-data">
							<div style="border: solid thin #aaa; padding: 10px; background-color: white;">
								<input type="file" name="file">


								<input id="post_button" type="submit" value="Change"style="width: 120px;">
								<br>
								<br>
								<div style="text-align: center;">			
								<?php

	
						
										echo "<img src='$user_data[profile_image]' style='max-width:500px'>";
								

					

							
								?>
								</div>

							</div>
						</form>
						
					</div>
		</div>
		<!-- change cover image -->
		<div id = "change_cover_image" style="display:none;position: absolute;width: 100%; height: 100%;background-color: #000000aa;">
			<div style="max-width:600px; margin: auto;min-height: 400px; flex: 2.5; padding: 20px; padding-right: 0px;">
						<form method="post" action="profile.php?change=cover"  enctype="multipart/form-data">
							<div style="border: solid thin #aaa; padding: 10px; background-color: white;">
								<input type="file" name="file">


								<input id="post_button" type="submit" value="Change"style="width: 120px;">
								<br>
								<br>
								<div style="text-align: center;">			
								<?php

	
						
								echo "<img src='$user_data[cover_image]' style='max-width:500px'>";
								

					

							
								?>
								</div>

							</div>
						</form>
						
					</div>
		</div>
		<!--cover Area-->
		<div style="width: 800px; margin: auto; min-height: 400px; ">
			<div style="background-color: white; text-align: center;color: #405d9b">
				<?php

						$image = "img/cover_images.jpg";
						if(file_exists($user_data['cover_image']))
						{
							$image = $image_class->get_thumb_cover($user_data['cover_image']) ;
						}
					  ?>
				<img src="<?php echo $image ?>" style="width: 100%;">

				
				<span style="font-size: 12px;">
					<?php

						$image = "img/user_male.jpg";
						if($user_data['gender'] == "Female")
						{
							$image = "img/user_female.jpg";
						}
						if(file_exists($user_data['profile_image']))
						{
							$image = $image_class->get_thumb_profile($user_data['profile_image']);
						}
					  ?>
					<img src="<?php echo $image ?>" style="width: 25%;" id="profile_pic">
					<br/>
					<?php if(i_own_content($user_data)):  ?>
					<a onclick="show_change_profile_image(event)" href="change_profile_image.php?change=profile" style="text-decoration: none; color: #f0f"> Change Profile Image </a> |
					<a onclick="show_change_cover_image(event)" href="change_profile_image.php?change=cover" style="text-decoration: none; color: #f0f"> Change Cover </a>
				<?php endif; ?>
					</span>
					<br>
				<div style="font-size: 25px;">
					<a style="text-decoration: none;" href="profile.php?id=<?php echo $user_data['userid']?>">
					<?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?>
					<br><span style="font-size: 18px;"><?="@" . $user_data['tag_name']?></span>
					</a>
					<?php

					$mylikes = "";

					if($user_data['likes'] > 0)
					{
						$mylikes  =  "(" . $user_data['likes'] . " Followers)";
					}
				?>
				<br>

				<a href="like.php?type=user&id=<?php echo $user_data['userid']?>">
				<input id = "post_button" type="button" value="Follow <?php echo $mylikes ?>" style=" background-color: #9b409a;width: auto;display: inline;margin-right: 10px;">
				</a>
				
				<?php if($user_data['userid'] == $_SESSION['socialsite_userid']):?>
				<a href="messages.php">
				<input id = "post_button" type="button" value="Messages" style=" background-color: #04afae;width: auto;display: inline;margin-right: 10px;">
				</a>
			<?php else: ?>
				<a href="messages.php?id=<?=$user_data['userid'] ?>&new">
				<input id = "post_button" type="button" value="Message" style=" background-color: #04afae;width: auto;display: inline;margin-right: 10px;">
			<?php endif; ?>

				</div>
				<br>
				<br>



				<a href="index.php"><div id="menu_buttons">
				Timeline</div></a>
				<a href="profile.php?section=about&id=<?php echo $user_data['userid']?>"><div id="menu_buttons">About</div></a>
				 <a href="profile.php?section=followers&id=<?php echo $user_data['userid']?>"><div id="menu_buttons">Followers</div></a>
				 <a href="profile.php?section=following&id=<?php echo $user_data['userid']?>"><div id="menu_buttons">Following</div></a>
				 <a href="profile.php?section=photos&id=<?php echo $user_data['userid']?>"> <div id="menu_buttons">Photos</div></a>
				 <?php
				 if($user_data['userid'] == $_SESSION['socialsite_userid']){

				 echo '<a href="profile.php?section=settings&id=' . $user_data['userid'].'"> <div id="menu_buttons"> Settings</div></a>';
				}
				 ?>

			</div>

			<!--below cover Area-->
			<?php
			$section = "default";
			if(isset($_GET['section'])){

				$section = $_GET['section'];

			}
			if($section == "default")
			{

				include ("profile_content_default.php");
			}elseif($section == "following"){
				include ("profile_content_following.php");
			}
			elseif($section == "followers"){
				include ("profile_content_followers.php");
			}
			elseif($section == "about")
			{
				include ("profile_content_about.php");
			}

			elseif($section == "settings")
			{
				include ("profile_content_settings.php");
			}

			elseif($section == "photos")
			{
				include ("profile_content_photos.php");
			}

			?>
		</div>

	</body>
</html>
<script type="text/javascript">
	
	function show_change_profile_image(event) {
		// body...
		event.preventDefault();
		var profile_image = document.getElementById("change_profile_image");
		profile_image.style.display = "block";

	}
	function hide_change_profile_image() {
		// body...

		var profile_image = document.getElementById("change_profile_image");
		profile_image.style.display = "none";

		
	}
	function show_change_cover_image(event) {
		// body...
		event.preventDefault();
		var cover_image = document.getElementById("change_cover_image");
		cover_image.style.display = "block";

	}
	function hide_change_cover_image() {
		// body...

		var cover_image = document.getElementById("change_cover_image");
		cover_image.style.display = "none";
		
	}
	window.onkeydown = function(key){
		if(key.keyCode == 27)
{

	//esc key press
	hide_change_profile_image()
	hide_change_cover_image()
	}
	}
</script>