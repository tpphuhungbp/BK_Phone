<?php
	$url = $_SERVER['REQUEST_URI'];
	if (strlen(strstr($url,"admin")) > 0) {
		include_once"../lib/database.php";
		include_once"../helper/format.php";
	}else{
		include_once"./lib/database.php";
		include_once"./helper/format.php";
	}
?>

<?php
	class order{
		private $db;
		private $format;
		public function __construct()
		{	
			//tạo biến Database trong lib/database.php
			$this->db = new Database();
			//tạo biến Database trong helper/format.php
			$this->format = new Format();
		}	
		public function getall_order(){
			$query = "select * from orders order by id";		
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		public function get_order(){
			$ss_id = session_id();
			if(isset($_SESSION['user_login'])&&$_SESSION['user_login']==true){
				$id = $_SESSION['user_id'];
				$query = "select * from orders where user_id = $id order by id";		
			}else{
				$query = "select * from orders where session_id = '$ss_id' order by id";		
			}			
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		public function add_order($data){
			$name = mysqli_real_escape_string($this->db->link,$data['user_name']);
			$phone = mysqli_real_escape_string($this->db->link,$data['user_phone']);
			$email = mysqli_real_escape_string($this->db->link,$data['user_email']);
			$address = mysqli_real_escape_string($this->db->link,$data['user_address']);
			if(isset($_SESSION['user_login'])&&$_SESSION['user_login']==true){
				$user_id = $_SESSION['user_id'];
				$query = "select * from cart where user_id = $user_id";
				$getcart = $this->db->select($query);
				if($getcart){
					while($kq = $getcart->fetch_assoc()){
						$product_id = $kq['product_id'];
						$product_name = $kq['product_name'];
						$price = $kq['price'];
						$amount = $kq['amount'];
						$total = $price*$amount;
						
						$query1 = "insert into orders(user_id,name,phone,email,address,product_id,product_name,price,amount,total) values($user_id,'$name','$phone','$email','$address',$product_id,'$product_name',$price,$amount,$total)";
						$ketqua = $this->db->insert($query1);
						if($ketqua!=false){
							$query2 = "delete from cart where user_id = $user_id";
							$ketqua2 = $this->db->delete($query2);
							header("Location: ?request=ordersuccess");
						}else{
							$alert = "<script>alert('Đặt hàng thất bại!')</script>";
							return $alert;
						}
					}
				}
			}else{
				$ss_id = session_id();
				$query = "select * from cart where session_id = '$ss_id' ";
				$getcart = $this->db->select($query);
				if($getcart){
					while($kq = $getcart->fetch_assoc()){
						$product_id = $kq['product_id'];
						$product_name = $kq['product_name'];
						$price = $kq['price'];
						$amount = $kq['amount'];
						$total = $price*$amount;
						
						$query1 = "insert into orders(session_id,name,phone,email,address,product_id,product_name,price,amount,total) values('$ss_id','$name','$phone','$email','$address',$product_id,'$product_name',$price,$amount,$total)";
						$ketqua = $this->db->insert($query1);
						if($ketqua!=false){
							$query2 = "delete from cart where session_id = '$ss_id'";
							$alert = "<script>alert('Đặt hàng thành công!')</script>";
							return $alert;
						}else{
							$alert = "<script>alert('Đặt hàng thất bại!')</script>";
							return $alert;
						}
					}
				}
			}
			
		}
	}
?>