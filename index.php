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
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		var_dump($_FILES);

		$post = new Post();
		$id = $_SESSION['socialsite_userid'];
		$result = $post->create_post($id,$_POST,$_FILES);

		if($result == "")
		{
			header("Location: index.php");
				die;
		
		}else
		{
			echo "<div style='text-align: center;font-size:12px; color: : white; background-color: grey;'>";
			echo "The following errors occured:<br><br>";
			echo $result;
			
			echo "</div>";
		}
	
	}
	?>
<!DOCTYPE html>
	<html>
	<head>
		<title>
			Timeline - social
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
			cursor: pointer;
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
		
			<!--below cover Area-->
			<div style="display: flex;">
				<!--friends area -->
					<div style=  "min-height: 400px; flex: 1;">
						<div id="friends_bar">
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
					<img id = "profile_pic" src="<?php echo $image ?>">
					<br/>
							<a href="profile.php" style="text-decoration: none;">
							<?php echo $user_data['first_name'] . "<br>" . $user_data['last_name']?>
						</a>
						</div>
					</div>
					<!--post area -->
					<div style="min-height: 400px; flex: 2.5; padding: 20px; padding-right: 0px;">
						<div style="border: solid thin #aaa; padding: 10px; background-color: white;">
									<form method="post" enctype="multipart/form-data">

							<textarea name="post" placeholder="Whats on your mind?"></textarea>
							<input type="file" name="file">
							<input id="post_button" type="submit" value="Post">
							<br>
						</form>
							
							<br>
						</div>

						<!--Posts-->
						<div id="post_bar">

							<?php
							$page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
							$page_number =( $page_number<1) ? 1 :  $page_number;
								
							

							
								$limit = 10;
								$offset = ($page_number-1)* $limit;

								$DB = new Database();
								$user_class = new User();
								$image_class = new Image();
								$followers = $user_class->get_following($_SESSION['socialsite_userid'],"user");
								$follower_ids = false;
								if(is_array($followers)){
									$follower_ids = array_column($followers,"userid");
									$follower_ids = implode("','",$follower_ids);
								}
								
								if($follower_ids){
									$myuserid = $_SESSION['socialsite_userid'];

								$sql = "select * from posts where parent = '0' and (userid = '$myuserid' ||   userid in('" . $follower_ids. "')) order by id desc limit $limit offset $offset";
								

							$posts = $DB->read($sql);
							}						 
							if(isset($posts) && $posts)
								{
									foreach ($posts as $ROW) {
										# code...
										$user = new User();

										$ROW_USER = $user->get_user($ROW['userid']);
										include ("post.php");
									}
								}
								
								//get url
							$pg = pagination_link();
							

							?>
							<a href="<?= $pg['next_page'] ?>">
							<input id="post_button" type="button" value="Next page" style="float: right; width: 150px; ">
							</a>
							<a href="<?= $pg['prev_page'] ?>">
							<input id="post_button" type="button" value="Prev page" style="float: left;width: 150px; ">
							</a>
						</div>
					</div>
			</div>
		</div>

	</body>
</html>