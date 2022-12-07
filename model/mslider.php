<?php
	$url = $_SERVER['REQUEST_URI'];
	if (strlen(strstr($url,"admin")) > 0) {
		include_once"../lib/database.php";
	}else{
		include_once"./lib/database.php";
	}
?>


<?php
	class slider{
		private $name;
		private $image;
		private $status;

		public function __construct($name,$image,$status)
		{	
			$this->name = $name;
			$this->image = $image;
			$this->status = $status;
		}
		public function add_slider(){
			$db = new Database();
			//ket noi csdl
			$query = "select * from slider where name = '$this->name'";
			$ketqua = $db->select($query);
			if($ketqua == true){
				$alert = "<h5 style='color: red;padding: 5px;'>Tên slider đã tồn tại!</h5>";
				return $alert;
			}else{
				$query1 = "INSERT INTO slider(name,image,status) values('$this->name','$this->image',$this->status)";
				$ketqua1 = $db->insert($query1);
				if($ketqua1==true){
					$alert = "<h5 style='color: green;padding: 5px;'>Thêm slider mới thành công!</h5>";
					return $alert;
				}
			}
		}
		public static function get_slider(){
			$db = new Database();
			$sql = "SELECT * FROM slider ORDER BY id";
			$ketqua = $db->select($sql);
			return $ketqua;
		}
		public static function get_slider_show(){
			$db = new Database();
			$sql = "select * from slider where status = 1 order by id desc ";
			$ketqua = $db->select($sql);
			return $ketqua;
		}
		public static function get_slider_byid($id){
			$db = new Database();
			$sql = "select * from slider where id = $id ";
			$ketqua = $db->select($sql);
			if(!$ketqua){
				header("Location: sliderlist.php");
			}else{
				return $ketqua;
			}
		}
	}
	
?>