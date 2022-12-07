<?php
	include_once"../lib/session.php";
	Session::checkLogin();
	include_once"../lib/database.php";
	include_once"../helper/format.php";
?>

<?php
	class adminlogin{
		private $db;
		private $format;
		public function __construct()
		{	
			//tạo biến Database trong lib/database.php
			$this->db = new Database();
			//tạo biến Database trong helper/format.php
			$this->format = new Format();
		}
		public function loginadmin($user,$pass){
			//kiem tra format cua username va password
			$user = $this->format->validation($user);
			$pass = $this->format->validation($pass);
			//ket noi csdl
			$user = mysqli_real_escape_string($this->db->link,$user);
			$pass = mysqli_real_escape_string($this->db->link,$pass);

			//ma hoa mat khau
			$pass = md5($pass);

			$query = "select * from users where email= '$user' and password = '$pass' and role=1";
			$ketqua = $this->db->select($query);
			if($ketqua!=false ){
				$value = $ketqua->fetch_assoc();

				Session::set('adminlogin',true);

				Session::set('id',$value['id']);
				Session::set('email',$value['email']);
				Session::set('password',$value['password']);Session::set('name',$value['name']);
				header("Location:index.php");
			}else{
				$alert = 'Username or password incorrect!';
				return $alert;
			}
		}
	}
	
?>