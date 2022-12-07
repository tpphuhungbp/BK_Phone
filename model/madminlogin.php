<?php
	include_once"../lib/session.php";
	Session::checkLogin();
	include_once"../lib/database.php";
	include_once"../helper/format.php";
?>

<?php
	class adminlogin{
		private $username;
		private $password;
		public function __construct($username,$password)
		{	
			$this->username = $username;
			$this->password = md5($password);
		}
		public function loginadmin(){
			$db = new Database();

			$query = "select * from users where email= '$this->username' and password = '$this->password' and role=1";
			$ketqua = $db->select($query);
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