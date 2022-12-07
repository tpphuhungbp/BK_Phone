<?php
	$url = $_SERVER['REQUEST_URI'];
	if (strlen(strstr($url,"admin")) > 0) {
		include_once"../lib/database.php";
	}else{
		include_once"./lib/database.php";
	}
?>


<?php
	class contact{
		private $name;
		private $email;
		private $phone;
		private $content;

		public function __construct($name,$email,$phone,$content)
		{	
			$this->name = $name;
			$this->email = $email;
			$this->phone = $phone;
			$this->content = $content;
		}
		public function insert_contact(){
			$db = new Database();
			
			$query = "INSERT INTO contact(name,email,phone,content) values('$this->name','$this->email','$this->phone','$this->content')";
			$ketqua = $db->insert($query);
			if($ketqua==true){
				$alert = "<script>alert('Cảm ơn bạn đã liên hệ với chúng tôi!')</script>";
				return $alert;
			}else{
				$alert = "<script>alert('Gửi liên hệ thất bại!')</script>";
				return $alert;
			}
		}
		public static function get_contact(){
			$db = new Database();
			$query = "select * from contact order by time desc";
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function capnhattrangthai($id,$tt){
			$db = new Database();

			$sql = "update contact set status = $tt where id = $id";
			$ketqua = $db->update($sql);
			return $ketqua;
		}
	}
	
?>