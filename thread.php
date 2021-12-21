<?php
	$color = '#eee';

	if(check_seen_thread($MESSAGE['msgid']) >0)
	{
		$color = '#f7e5e5';
	}
?>
	<div id="message_thread" style="background-color: <?=$color?>; position: relative;">
		
	<div>
		<?php
			$image_class = new Image();
			$image = "img/user_male.jpg";
			if($ROW_USER['gender'] == 'Female')
			{
				$image  = "img/user_female.jpg";
			}
			if(file_exists($ROW_USER['profile_image']))
			{
				$image  = $image_class->get_thumb_profile($ROW_USER['profile_image']);
			}



		?>
		<img  src="<?php echo $image ?>" style="width: 50px; height: 50px;margin-top: 8px;  margin-right: 4px; border-radius: 50%;">
	</div>
	<div style="width:100%; margin-left: 6px;">
		<div style="font-weight: bold;color: #405d9b; width:100%; ">
			<?php 
				echo  "<a style='text-decoration: none;'' href='profile.php?id=$MESSAGE[msgid]'>";
				echo htmlspecialchars( $ROW_USER['first_name']) . " " . htmlspecialchars( $ROW_USER['last_name'] );
				echo "</a>";
				?>
				
		</div>
		<br>

		<?php echo check_tags($MESSAGE['message']) ?>

	
		<!-- <?php 
			// if(file_exists($MESSAGE['file']))
			// {
			// 	$post_image = $image_class->get_thumb_post($MESSAGE['file']);
			// 	echo "<img src='$post_image' style = 'width: 80%;' />";
			//}
		?> -->
		<br>
		<br>
		 <span style="color: #999" >

			<?php  
			$Time = new Time();
			echo $Time->get_time($MESSAGE['date']);
			?>
		</span>
		<!-- <?php 

			// if(file_exists($MESSAGE['file'])){
			// 	echo "<a href='image_view.php?id=$MESSAGE[msgid]' >";
			// 	echo ". View Full Image . ";
			// 	echo "</a>";
			// }

		?> -->
		
		
	</div>
	<a href="messages.php?id=<?=$myid?>&read">
	<div style="cursor: pointer; border-top-right-radius: 50%; border-bottom-right-radius: 50%; height: 90%; width: 50px;position: absolute;right: 10px;top: 4px; ">

		<svg fill = "#aaa" style="position: absolute; left: 50%;top: 50%; transform: translate(-50%,-50%);" width="40" height="40" viewBox="0 0 24 24"><path d="M22 12l-20 12 5-12-5-12z"/></svg>
	</div>
	</a>
</div>
