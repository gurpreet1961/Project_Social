<div id="post">
	<div>
		<?php

			$image = "img/user_male.jpg";
			if($ROW_USER['gender'] == 'Female')
			{
				$image  = "img/user_female.jpg";
			}

			$image_class = new image();
			if(file_exists($ROW_USER['profile_image']))
			{
				$image  = $image_class->get_thumb_profile($ROW_USER['profile_image']);
			}



		?>
		<img src="<?php echo $image ?>" style="width: 50px; height: 50px;  margin-right: 4px; border-radius: 50%;">
	</div>
	<div style="width:100%; ">
		<div style="font-weight: bold;color: #405d9b; width:100%; ">
			<?php 

				echo htmlspecialchars( $ROW_USER['first_name']) . " " . htmlspecialchars( $ROW_USER['last_name'] );
				if($ROW['is_profile_image'])
				{
					$pronoun = "his";

					if($ROW_USER['gender'] == 'Female')
					{
						$pronoun = "her";
					}
				echo "<span style='font-weight: normal; color: #aaa;'> updated $pronoun profile image</span>";
			}
			if($ROW['is_cover_image'])
				{
					$pronoun = "his";

					if($ROW_USER['gender'] == 'Female')
					{
						$pronoun = "her";
					}
				echo "<span style='font-weight: normal; color: #aaa;'> updated $pronoun cover image</span>";
				}?><br><br>
				<span style="font-weight: normal; color: #aaa;"><?php  
			echo  $ROW['date']
			?></span><br><br>
			
			
			


		</div>
		<?php echo htmlspecialchars($ROW['post']) ?>

		<br><br>
		<?php 
			if(file_exists($ROW['image']))
			{
				$post_image = $image_class->get_thumb_post($ROW['image']);
				echo "<img src='$post_image' style = 'width: 80%;' />";
			}
		?>
	</div>
</div>