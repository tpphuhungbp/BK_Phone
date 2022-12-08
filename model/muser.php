<?php
	$url = $_SERVER['REQUEST_URI'];
	if (strlen(strstr($url,"admin")) > 0) {
		include_once"../lib/database.php";
	}else{
		include_once"./lib/database.php";
	}
?>

<?php
	class user{
		private $name;
		private $email;
		private $password;
		private $phone;
		private $address;
		public function __construct($name,$email,$password,$phone,$address)
		{	
			$this->name = $name;
			$this->email = $email;
			$this->password = md5($password);
			$this->phone= $phone;
			$this->address = $address;
		}
		public static function getuser(){
			$db = new Database();
			$query ="select * from users";
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function getuserbyid($id){
			$db = new Database();
			$query ="select * from users where id = $id";
			$ketqua = $db->select($query);
			return $ketqua;
		}	
		public function insert_user(){
			$db = new Database();
			$query = "select * from users where email = '$this->email'";
			$ketqua = $db->select($query);
			if($ketqua != false){
				$alert = "<script>alert('Email đã tồn tại!')</script>";
				return $alert;
			}else{
				$query1 = "INSERT INTO users(name,email,password,phone,address) values('$this->name','$this->email','$this->password','$this->phone','$this->address')";
				$ketqua1 = $db->insert($query1);
				if($ketqua1!=false){
					$alert = "<script>alert('Đăng ký tài khoản thành công!')</script>";
					return $alert;
				}else{
					$alert = "<script>alert('Đăng ký tài khoản thất bại!')</script>";
					return $alert;
				}
			}

		}	
		public static function update_user($data){
			$db = new Database();
			$id = mysqli_real_escape_string($db->link,$data['user_id']);
			$name = mysqli_real_escape_string($db->link,$data['name']);
			$email = mysqli_real_escape_string($db->link,$data['email']);
			$address = mysqli_real_escape_string($db->link,$data['address']);
			$phone = mysqli_real_escape_string($db->link,$data['phone']);

			$query = "update users set name='$name' , email ='$email' , address ='$address' , phone ='$phone' where id = $id";
			$ketqua = $db->update($query);
			if($ketqua != false){
				$rs = user::getuserbyid($id)->fetch_assoc();
				Session::set('user_name',$rs['name']);
				$alert = "<script>alert('Sửa thông tin thành công!')</script>";
				return $alert;
			}else{
				$alert = "<script>alert('Sửa thông tin thất bại!')</script>";
				return $alert;
			}
		}
		public static function update_password($id,$mk){
			$db = new Database();
			$mhmk = md5($mk);
			$sql = "update users set password = '$mhmk' where id = $id ";
			if($sql){
				return "<script>alert('Đổi mật khẩu thành công!')</script>";
			}else{
				return "<script>alert('Đổi mật khẩu thất bại!')</script>";
			}
		}
		public static function del_user($id){
			$db = new Database();
			$query1 = "select * from users where id=$id";
			$ketqua1 = $db->select($query1);
			if($ketqua1){
				$query = "delete from users where id = $id";
				$ketqua = $db->delete($query);
				if($ketqua){
					echo "<script> alert('Đã xóa thành công tài khoản') </script>";
					echo "<script> window.location='userlist.php' </script>";
				}else{
					echo "<script> alert('Xóa tài khoản thất bại') </script>";
					echo "<script> window.location='userlist.php' </script>";
				}
			}else{
				echo "<script> alert('Xóa tài khoản thất bại') </script>";
				echo "<script> window.location='userlist.php' </script>";
			}
		}
		public static function login_user($tk,$mk){
			$db = new Database();
			$mk2 = "";
			$mk2 = md5($mk);
			$query = "select * from users where email = '$tk' and password = '$mk2' limit 1";
			$ketqua = $db->select($query);
			if($ketqua){
				$rs = $ketqua->fetch_assoc();
				Session::set('user_login',true);
				Session::set('user_id',$rs['id']);
				Session::set('user_name',$rs['name']);
				$_SESSION['tongsp'] = cart::get_amount();
				header("Location:?request=home");
			}else{
				return "<script>alert('Tài khoản hoặc mật khẩu không chính xác!')</script>";
			}
		}
	}
	
?>
