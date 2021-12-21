<!-- nav bar start -->
<?php

	$corner_image = "img/user_male.jpg";
	
	if(isset($USER))
	{
		 if(file_exists($USER['profile_image']))
	{
		$image_class = new Image();
		$corner_image = $image_class->get_thumb_profile($USER['profile_image']);
	}else{
	if($USER['gender'] == 'Female')
	{
		$corner_image = "img/user_female.jpg";
	}
}

}

?>
<div id="blue_bar" style="margin-top: -32px; " class="container">
	<form method="get" action="search.php">
			<div style="width: 800px; margin: auto;  font-size: 35px;">
				<a href="index.php" style="color: white;text-decoration: none;"> Cu-Chat</a>
				
				 &nbsp &nbsp &nbsp <input type="text" id="search_box" name = "find" placeholder="Search for people">
				<?php if(isset($USER)): ?>

				<a href="profile.php"><img src="<?php echo $corner_image ?>" style="width: 42px; float: right;  border-radius: 50%; border: solid 1px white;">

					</a> 

				<a href="logout.php">
				<span style="font-size: 11px; float: right; margin: 10px; color: white">Logout</span>

</a>
	<a href="notifications.php">
<span style="display: inline-block;position: relative;">
	<img src="notif.svg" style="width: 25px;float: right;margin-top: 10px;">
	<?php

	$notif = check_notification();

	?>
<?php if($notif >0): ?>
	<div style="background-color: red; color: white; position: absolute;right:-15px;width: 14px; height: 14px;border-radius: 50%;padding: 4px;text-align: center;font-size: 13px; "><?=$notif ?></div>
<?php endif;?>
</span>
</a>

<a href="messages.php">
<span style="display: inline-block;position: relative;  ">
	
	<svg fill = "orange" style="margin-left:10px; width: 25px;float: right;margin-top: 10px;" width="25" height="25" viewBox="0 0 24 24"><path d="M12 12.713l-11.985-9.713h23.971l-11.986 9.713zm-5.425-1.822l-6.575-5.329v12.501l6.575-7.172zm10.85 0l6.575 7.172v-12.501l-6.575 5.329zm-1.557 1.261l-3.868 3.135-3.868-3.135-8.11 8.848h23.956l-8.11-8.848z"/></svg>
	<?php

	$notif = check_messages();

	?>
<?php if($notif >0): ?>
	<div style="background-color: red; color: white; position: absolute;right:-15px;width: 14px; height: 14px;border-radius: 50%;padding: 4px;text-align: center;font-size: 13px; "><?=$notif ?></div>
<?php endif;?>
</span>
</a>


<?php else: ?>
	<a href="login.php">
				<span style="font-size: 15px; float: right; margin: 10px; color: white">login</span>
<?php endif; ?>
			</div>
				</form>
		</div>
		
		<!-- nav bar end -->