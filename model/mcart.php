<?php
	include_once"./lib/database.php";
?>

<?php
	class cart{
		private $prodid;
		private $userid;
		private $sessionid;
		private $prodname;
		private $image;
		private $price;
		private $amount;
		public function __construct($prodid,$userid=0,$sessionid=null,$prodname,$image,$price,$amount)
		{	
			$this->prodid = $prodid;
			$this->userid = $userid;
			$this->sessionid = $sessionid;
			$this->prodname = $prodname;
			$this->image = $image;
			$this->price = $price;
			$this->amount = $amount;
		}
		public function __destruct()
		{
			$this->get_amount();
		}	
		public static function getcart(){
			$db = new Database();

			$ss_id = session_id();
			if(isset($_SESSION['user_login'])&&$_SESSION['user_login']==true){
				$userid = $_SESSION['user_id'];
				$query = "select * from cart where user_id = $userid";
			}else{
				$query = "select * from cart where session_id = '$ss_id'";
			}			
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function getcartbyuserid($id){
			$db = new Database(); 
			$query = "select * from cart where user_id = $id";
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function get_amount(){
			$db = new Database();
			$ss_id = session_id();
			if(isset($_SESSION['user_login'])&& $_SESSION['user_login']==true){
				$id = $_SESSION['user_id'];
				$query = "select sum(amount) as tongsp from cart where user_id = $id";
			}else{
				$query = "select sum(amount) as tongsp from cart where session_id = '$ss_id'";
			}			
			$ketqua = $db->select($query)->fetch_assoc();
			return $ketqua['tongsp'];
		}
		public static function addtocart($id,$amount){
			$db = new Database();
			$query = "select * from product where id = $id";
			$ketqua = $db->select($query)->fetch_assoc();

			$name = $ketqua['product_name'];
			$hinhanh = $ketqua['image'];
			$gia = $ketqua['price'];

			if(isset($_SESSION['user_login'])&& $_SESSION['user_login']==true){
				$db = new Database();
				$user_id = $_SESSION['user_id'];
				$query2 = "select * from cart where product_id = $id and user_id = $user_id";
				$ketqua2 = $db->select($query2);
				if($ketqua2==null){
					$query1 = "INSERT INTO cart(product_id,user_id,product_name,image,price,amount) values($id,$user_id,'$name','$hinhanh',$gia,$amount)";								
					$ketqua1 = $db->insert($query1);
				}else{
					$kq = $ketqua2->fetch_assoc();
					$new_amount = $kq['amount'] + $amount;
					$query3 = "update cart set amount = $new_amount where product_id = $id and user_id = $user_id";
					$ketqua3 = $db->update($query3);
				}
			}else{
				$ss_id = session_id();
				$query2 = "select * from cart where product_id = $id and session_id = '$ss_id'";
				$ketqua2 = $db->select($query2);
				if($ketqua2==null){
					$query1 = "INSERT INTO cart(product_id,session_id,product_name,image,price,amount) values($id,'$ss_id','$name','$hinhanh',$gia,$amount)";								
					$ketqua1 = $db->insert($query1);
				}else{
					$kq = $ketqua2->fetch_assoc();
					$new_amount = $kq['amount'] + $amount;
					$query3 = "update cart set amount = $new_amount where product_id = $id and session_id = '$ss_id' ";
					$ketqua3 = $db->update($query3);
				}
			}

			
		}
		public static function delete($id){
			$db = new Database();
			$query = "delete from cart where id=$id";
			$ketqua = $db->delete($query);
			header("Location: ?request=cart");
		}
		public static function deleteAll(){
			$db = new Database();
			$ssid = session_id();
			$query = "delete from cart where session_id = '$ssid' ";
			$ketqua = $db->delete($query);
			header("Location: ?request=cart");
		}
		public static function updatecart($id,$amount){
			$db = new Database();
			$query = "update cart set amount = $amount where id = $id";
			$ketqua = $db->update($query);
			header("Location: ?request=cart");
		}
	}
	
?>

