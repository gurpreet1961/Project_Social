<div id="message_left" style="background-color: #eee; ">
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
				<span style="float: right; 
				 " >
			<?php
			$post = new Post();

			
				echo "<a href='delete.php?id=$MESSAGE[msgid] ' 'style = 'text-decoration: none;'  >";
				echo'	<svg fill="red" width="15" height="17" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z"/></svg>';
				echo "</a>";
			

				
				?>
		</span>
		</div>
		<br>

		<?php echo check_tags($MESSAGE['message']) ?>

	
		<?php 
			if(file_exists($MESSAGE['file']))
			{
				$post_image = $image_class->get_thumb_post($MESSAGE['image']);
				echo "<img src='$post_image' style = 'width: 80%;' />";
			}
		?>
		<br>
		<br>
		 <span style="color: #999" >

			<?php  
			$Time = new Time();
			echo $Time->get_time($MESSAGE['date']);
			?>
		</span>
		<?php 

			if(file_exists($MESSAGE['file'])){
				echo "<a href='image_view.php?id=$MESSAGE[msgid]' >";
				echo ". View Full Image . ";
				echo "</a>";
			}

		?>
		
		
	</div>
</div>