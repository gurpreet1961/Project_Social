<?php
	
	

	include("classes/autoload.php");



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
		$Post = new Post();
		$User = new User();
		$image_class = new Image();
		
	?>
<!DOCTYPE html>
	<html>
	<head>
		<title>
			Notifications - social
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
		#notification{
			height: 50px;
			background-color:#eee; 
			color:#666;
			border: 1px solid #aaa;
			margin: 6px;
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
								$DB = new Database();
								$id = esc($_SESSION['socialsite_userid']);
								$follow = array();

								//check content i follow
								$sql = "select * from content_i_follow where disabled = 0 && userid = '$id' limit 100";
								$i_follow = $DB->read($sql);

								if(is_array($i_follow)){
									$follow = array_column($i_follow,"contentid");

								}
							if(count($follow)>0){
								$str = "'" .  implode("','",$follow) . "'";
								$query = "select * from notifications where (userid != '$id' && content_owner = '$id') || (userid != '$id' && contentid in ($str)) order by id desc limit 30";
							}
							else
							{
								$query = "select * from notifications where userid != '$id' && content_owner = '$id' order by id desc limit 30";
							}
								
								
								$data = $DB->read($query);
							?>
							<?php
							if(is_array($data)): ?>
								<?php foreach ($data as $notif_row):
								include("single_notification.php");
				endforeach; ?>
				<?php else: ?>
						No notification found
					<?php endif; ?>
						
						</div>

						
					</div>
			</div>
		</div>

	</body>
</html>