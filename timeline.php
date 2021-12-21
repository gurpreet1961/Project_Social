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
		<div id="blue_bar">
			<div style="width: 800px; margin: auto;  font-size: 35px;">
				Cu-Chat &nbsp &nbsp &nbsp <input type="text" id="search_box" placeholder="Search for people">
				<img src="img/selfiess.jpg" style="width: 42px; float: right; border-radius: 50%; border: solid 1px white;">


			</div>

		</div>
		<div>
			
		</div>
		<!-- nav bar end -->
		
			<!--below cover Area-->
			<div style="display: flex;">
				<!--friends area -->
					<div style=  "min-height: 400px; flex: 1;">
						<div id="friends_bar">
							<img src="img/selfiess.jpg" id="profile_pic"><br>
							Gurpreet Singh
						</div>
					</div>
					<!--post area -->
					<div style="min-height: 400px; flex: 2.5; padding: 20px; padding-right: 0px;">
						<div style="border: solid thin #aaa; padding: 10px; background-color: white;">
							<textarea placeholder="Whats on your mind?">
							</textarea>
							<input id="post_button" type="submit" value="Post">
							
							<br>
						</div>

						<!--Posts-->
						<div id="post_bar">

							<!--Post 1-->
							<div id="post">
								<div>
									<img src="img/users.jpg" style="width: 75px;margin-right: 4px;">
								</div>
								<div>
									<div style="font-weight: bold;color: #405d9b; ">First User</div>
									Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
									<br/><br/>
									<a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999" >Feb 28 2020</span>
								</div>
							</div>
<!--Post 4-->
							<div id="post">
								<div>
									<img src="img/users.jpg" style="width: 75px;margin-right: 4px;">
								</div>
								<div>
									<div style="font-weight: bold;color: #405d9b; ">4th User</div>
									Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
									<br/><br/>
									<a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999" >Feb 28 2020</span>
								</div>
							</div>						</div>
					</div>
			</div>
		</div>

	</body>
</html>