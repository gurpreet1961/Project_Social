<div id="friends" style="display: inline-block; background-color: #eee; width: 200px;margin-bottom: 10px; ">
	<?php
	$image_class = new Image();
	$image = "img/user_male.jpg";
		if($FRIEND_ROW['gender'] == 'Female')
		{
			$image  = "img/user_female.jpg";
		}

		if(file_exists($FRIEND_ROW['profile_image']))
			{
				$image  = $image_class->get_thumb_profile($FRIEND_ROW['profile_image']);
			}


?>
	<a style="text-decoration:none;" href="profile.php?id=<?php echo  $FRIEND_ROW['userid']; ?>">
	<img id = "friends_img"src="<?php echo  $image ?>">
		<br>
		<div style="font-size: 70%; text-align: center;text-decoration: none; ">
	<?php echo $FRIEND_ROW['first_name'] . " " .  $FRIEND_ROW['last_name'] ?>
	<br>
	<?php
	$online = "Last seen: <br> Unknown";

		if($FRIEND_ROW['online']>0)
		
		{	
			$online = $FRIEND_ROW['online'];
			$currrnt_time = time();
			$threshold = 60 * 2; //2min


			if(($currrnt_time - $online) < $threshold)
			{
				$online = "<span style='color: green;'>Online</span>";
			}else{
			
				$Time = new Time();
				$online =  "Last seen: <br>" . $Time->get_time(date("Y-m-d H:i:s",$online));
			
		}
	}
	?>
	<span style="color: grey; font-size: 11px; font-weight: normal;"><?php echo $online?></span>
	</div>
	</a>
	</div>

