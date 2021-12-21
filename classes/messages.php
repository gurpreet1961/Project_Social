<?php

Class Messages
{
	private $error = "";
	public function send($data,$files)
	{

		if(!empty($data['message']) || !empty($files['file']['name']))

		{

			$myimage = "";
			$has_image = 0;
			
				if (!empty($files['file']['name'])) {
					# code...
				$userid = $_SESSION['socialsite_userid'];
					$folder = "uploads/" . $userid ."/";

						//create folder
						if(!file_exists($folder))
						{
							mkdir($folder,0777,true);
							file_put_contents($folder, "index.php", "");
						}
						$allowed[] = "image/jpeg";
						$allowed[] = "application/pdf";
						if(in_array($files['file']['type'],$allowed)){
						$image_class = new Image();
						$myimage = $folder . $image_class->generate_filename(15) . ".jpg";
						move_uploaded_file($files['file']['tmp_name'], $myimage);

						$image_class->resize_image($myimage,$myimage,1500,1500);

						$has_image = 1;
					}else
					{
						$this->error .= "The selected image is not a valid type. only jpegs allowed!<br>";
					}

			}
		
			$message = "";
			if(isset($data['message'])){

				$message = esc($data['message']);
			}
			//add tagged users
			$tags = array();
			$tags = get_tags($message);
			$tags = json_encode($tags);
			if(trim($message) == "" && $has_image == 0){
				$this->error .= "Please type something to send!<br>";
			}

			if($this-> error ==""){
			$page = explode('&',$_SERVER['REQUEST_URI']);
					$url = explode('?id=',$page[0]);
			$msgid = $this->create_msgid(60);
			$sender = esc($_SESSION['socialsite_userid']);
			$receiver =esc($url[1]);

			//check if thead exists
			$query = "select * from messages where (sender = '$sender' && receiver = '$receiver') || (receiver = '$sender' &&  sender = '$receiver') limit 1";
			$DB = new Database();
			$data = $DB->read($query);

			if(is_array($data))
			{
				$msgid = $data[0]['msgid'];
			}
			
			$file = esc($myimage);

			$query = "insert into messages (sender,msgid,receiver,message,file,tags) values ('$sender','$msgid','$receiver','$message','$file','$tags')";
			$DB->save($query);

		//notify those were tagged 
		// tag($msgid);
		}
		}else

			
		{
			$this->error .= "Please type something to send!<br>";
		}
		return $this->error;
	}

	public function read($userid)
	{
		
			$page = explode('&',$_SERVER['REQUEST_URI']);
			$url = explode('?id=',$page[0]);
			$DB = new Database();
			$me = esc($_SESSION['socialsite_userid']);
			$userid = esc($userid);
			$query = "select * from messages where (sender = '$me' && receiver = '$userid') || (receiver = '$me' &&  sender = '$userid') order by id  desc limit 20";
			
			$data = $DB->read($query);

			if(is_array($data)){
				//set seen to 1
				
					$msgid = $data[0]['msgid'];
					$query = "update messages set seen = 1 where  receiver = '$me' && msgid = '$msgid' limit 1";
					$DB->save($query);
				
				sort($data);
			}


			return $data;
	}
	public function read_threads()
	{
		
			$page = explode('&',$_SERVER['REQUEST_URI']);
			$url = explode('?id=',$page[0]);
			$DB = new Database();
			$me = esc($_SESSION['socialsite_userid']);
			//$query = "select * from messages where (sender = '$me' || receiver = '$me') group by msgid order by id  desc limit 20";
			$query = "select t1.* from messages t1 join (select id,msgid,max(date) mydate from messages where (sender = '$me' || receiver = '$me') group by msgid) t2 on t1.msgid = t2.msgid and t2.mydate = t1.date group by msgid";
			
			$data = $DB->read($query);
			if(is_array($data))
				{
					rsort($data);
}
			return $data;
	}
	
	public function read_one($id)
	{
		
			$page = explode('&',$_SERVER['REQUEST_URI']);
			$url = explode('?id=',$page[0]);
			$DB = new Database();
			$me = esc($_SESSION['socialsite_userid']);
			$query = "select * from messages where (sender = '$me' && receiver = '$userid') || (receiver = '$me' &&  sender = '$userid') order by id  desc limit 20";
			
			$data = $DB->read($query);
			sort($data);
			return $data;
	}
	

	private function create_msgid($length){
		$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','-','_');
		$text = "";
		$length = rand(4,$length);
		for($i= 0 ; $i<$length;$i++){
			$random = rand(0,63);
			$text .= $array[$random];
		}

		return $text;

	}


}