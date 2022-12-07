<?php
	include_once"./lib/database.php";
	include_once"./helper/format.php";
?>

<?php
	class cart{
		private $db;
		private $format;
		public function __construct()
		{	
			//tạo biến Database trong lib/database.php
			$this->db = new Database();
			//tạo biến Database trong helper/format.php
			$this->format = new Format();
		}
		public function __destruct()
		{
			$this->get_amount();
		}	
		public function getcart(){
			$ss_id = session_id();
			if(isset($_SESSION['user_login'])&&$_SESSION['user_login']==true){
				$userid = $_SESSION['user_id'];
				$query = "select * from cart where user_id = $userid";
			}else{
				$query = "select * from cart where session_id = '$ss_id'";
			}			
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		public function getcartbyuserid($id){
			$query = "select * from cart where user_id = $id";
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		public function get_amount(){
			$ss_id = session_id();
			if(isset($_SESSION['user_login'])&& $_SESSION['user_login']==true){
				$id = $_SESSION['user_id'];
				$query = "select sum(amount) as tongsp from cart where user_id = $id";
			}else{
				$query = "select sum(amount) as tongsp from cart where session_id = '$ss_id'";
			}			
			$ketqua = $this->db->select($query)->fetch_assoc();
			return $ketqua['tongsp'];
		}
		public function addtocart($id,$amount){
			$query = "select * from product where id = $id";
			$ketqua = $this->db->select($query)->fetch_assoc();

			$name = $ketqua['product_name'];
			$hinhanh = $ketqua['image'];
			$gia = $ketqua['price'];

			if(isset($_SESSION['user_login'])&& $_SESSION['user_login']==true){
				$user_id = $_SESSION['user_id'];
				$query2 = "select * from cart where product_id = $id and user_id = $user_id";
				$ketqua2 = $this->db->select($query2);
				if($ketqua2==null){
					$query1 = "INSERT INTO cart(product_id,user_id,product_name,image,price,amount) values($id,$user_id,'$name','$hinhanh',$gia,$amount)";								
					$ketqua1 = $this->db->insert($query1);
				}else{
					$kq = $ketqua2->fetch_assoc();
					$new_amount = $kq['amount'] + $amount;
					$query3 = "update cart set amount = $new_amount where product_id = $id and user_id = $user_id";
					$ketqua3 = $this->db->update($query3);
				}
			}else{
				$ss_id = session_id();
				$query2 = "select * from cart where product_id = $id and session_id = '$ss_id'";
				$ketqua2 = $this->db->select($query2);
				if($ketqua2==null){
					$query1 = "INSERT INTO cart(product_id,session_id,product_name,image,price,amount) values($id,'$ss_id','$name','$hinhanh',$gia,$amount)";								
					$ketqua1 = $this->db->insert($query1);
				}else{
					$kq = $ketqua2->fetch_assoc();
					$new_amount = $kq['amount'] + $amount;
					$query3 = "update cart set amount = $new_amount where product_id = $id and session_id = '$ss_id' ";
					$ketqua3 = $this->db->update($query3);
				}
			}

			
		}
		public function delete($id){
			$query = "delete from cart where id=$id";
			$ketqua = $this->db->delete($query);
			header("Location: ?request=cart");
		}
		public function deleteAll(){
			$ssid = session_id();
			$query = "delete from cart where session_id = '$ssid' ";
			$ketqua = $this->db->delete($query);
			header("Location: ?request=cart");
		}
		public function updatecart($id,$amount){
			$query = "update cart set amount = $amount where id = $id";
			$ketqua = $this->db->update($query);
			header("Location: ?request=cart");
		}
	}
	
?>

