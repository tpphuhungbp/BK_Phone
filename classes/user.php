<?php
	include_once"./lib/database.php";
	include_once"./helper/format.php";
?>

<?php
	class user{
		private $db;
		private $format;
		public function __construct()
		{	
			//tạo biến Database trong lib/database.php
			$this->db = new Database();
			//tạo biến Database trong helper/format.php
			$this->format = new Format();
		}
		public function getuser(){
			$query ="select * from users";
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		public function getuserbyid($id){
			$query ="select * from users where id = $id";
			$ketqua = $this->db->select($query);
			return $ketqua;
		}	
		public function insert_user($data){
			$name = mysqli_real_escape_string($this->db->link,$data['rg_name']);
			$email = mysqli_real_escape_string($this->db->link,$data['rg_email']);
			$pass = mysqli_real_escape_string($this->db->link,$data['rg_pass1']);
			$address = mysqli_real_escape_string($this->db->link,$data['rg_address']);
			$phone = mysqli_real_escape_string($this->db->link,$data['rg_phone']);

			$mh_pass = md5($pass);

			$query = "select * from users where email = '$email'";
			$ketqua = $this->db->select($query);
			if($ketqua != false){
				$alert = "<script>alert('Email đã tồn tại!')</script>";
				return $alert;
			}else{
				$query1 = "INSERT INTO users(name,email,password,phone,address) values('$name','$email','$mh_pass','$phone','$address')";
				$ketqua1 = $this->db->insert($query1);
				if($ketqua1!=false){
					$alert = "<script>alert('Đăng ký tài khoản thành công!')</script>";
					return $alert;
				}else{
					$alert = "<script>alert('Đăng ký tài khoản thất bại!')</script>";
					return $alert;
				}
			}

		}	
		public function update_user($data){
			$id = mysqli_real_escape_string($this->db->link,$data['user_id']);
			$name = mysqli_real_escape_string($this->db->link,$data['name']);
			$email = mysqli_real_escape_string($this->db->link,$data['email']);
			$address = mysqli_real_escape_string($this->db->link,$data['address']);
			$phone = mysqli_real_escape_string($this->db->link,$data['phone']);

			$query = "update users set name='$name' , email ='$email' , address ='$address' , phone ='$phone' where id = $id";
			$ketqua = $this->db->update($query);
			if($ketqua != false){
				$rs = $this->getuserbyid($id)->fetch_assoc();
				Session::set('user_name',$rs['name']);
				$alert = "<script>alert('Sửa thông tin thành công!')</script>";
				return $alert;
			}else{
				$alert = "<script>alert('Sửa thông tin thất bại!')</script>";
				return $alert;
			}
		}
		public function update_password($data){
			$id = mysqli_real_escape_string($this->db->link,$data['user_id']);
			$oldpass = mysqli_real_escape_string($this->db->link,$data['oldpassword']);
			$newpass = mysqli_real_escape_string($this->db->link,$data['newpassword']);
			$newpass2 = mysqli_real_escape_string($this->db->link,$data['re-newpassword']);

			$query ="select * from users where id = $id";
			$ketqua = $this->db->select($query)->fetch_assoc();
			$oldpass = md5($oldpass);
			if($ketqua['password']==$oldpass){				
				if($newpass==$newpass2){
					$newpass = md5($newpass);
					$query1 ="update users set password = '$newpass' where id = $id";
					$ketqua1 = $this->db->update($query1);
					if($ketqua1!=false){
						return "<script>alert('Đổi mật khẩu thành công!')</script>";
					}else{
						return "<script>alert('Đổi mật khẩu thất bại!')</script>";
					}
					
				}else{
					return "<script>alert('Xác nhận mật khẩu mới không chính xác!')</script>";
				}
			}else{
				return "<script>alert('Mật khẩu hiện tại không chính xác!')</script>";
			}

		}
		public function login_user($data){
			$username = mysqli_real_escape_string($this->db->link,$data['username']);
			$pass = mysqli_real_escape_string($this->db->link,$data['password']);
			$pass = md5($pass);
			$query = "select * from users where email = '$username' and password = '$pass' limit 1";
			$ketqua = $this->db->select($query);
			if($ketqua!=false){
				$rs = $ketqua->fetch_assoc();
				Session::set('user_login',true);
				Session::set('user_id',$rs['id']);
				Session::set('user_name',$rs['name']);
				$cart = new cart();
				$_SESSION['tongsp'] = $cart->get_amount();				
				header("Location:?request=home");
			}else{
				return "<script>alert('Tài khoản hoặc mật khẩu không chính xác!')</script>";
			}
		}
	}
	
?>
