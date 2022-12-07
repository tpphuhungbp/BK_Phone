<?php
	$url = $_SERVER['REQUEST_URI'];
	if (strlen(strstr($url,"admin")) > 0) {
		include_once"../lib/database.php";
	}else{
		include_once"./lib/database.php";
	}
?>

<?php
	class order{
			private $userid;
			private $sessionid;
			private $name;
			private $phone;
			private $email;
			private $address;
			private $prodid;
			private $prodname;
			private $price;
			private $amount;
			private $total;
		public function __construct($userid=null,$sessionid=null,$name,$phone,$email,$address,$prodid,$prodname,$price,$amount,$total)
		{	
			$this->userid =$userid;
			$this->sessionid = $sessionid;
			$this->name = $name;
			$this->phone = $phone;
			$this->email = $email;
			$this->address = $address;
			$this->prodid = $prodid;
			$this->prodname = $prodname;
			$this->price = $price;
			$this->amount = $amount;
			$this->total = $total;
		}	
		public static function getall_order(){
			$db = new Database();
			$query = "select * from orders order by id";		
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function get_order(){
			$db = new Database();
			$ss_id = session_id();
			if(isset($_SESSION['user_login'])&&$_SESSION['user_login']==true){
				$id = $_SESSION['user_id'];
				$query = "select * from orders where user_id = $id order by id";		
			}else{
				$query = "select * from orders where session_id = '$ss_id' order by id";		
			}			
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public function add_order(){
			$db = new Database();
			if(isset($_SESSION['user_login'])&&$_SESSION['user_login']==true){
				$this->userid = $_SESSION['user_id'];
				$query = "select * from cart where user_id = $this->userid";
				$getcart = $db->select($query);
				if($getcart){
					while($kq = $getcart->fetch_assoc()){
						$this->prodid = $kq['product_id'];
						$this->prodname = $kq['product_name'];
						$this->price = $kq['price'];
						$this->amount = $kq['amount'];
						$this->total = $this->price*$this->amount;
						
						$query1 = "insert into orders(user_id,name,phone,email,address,product_id,product_name,price,amount,total) values($this->userid,'$this->name','$this->phone','$this->email','$this->address',$this->prodid,'$this->prodname',$this->price,$this->amount,$this->total)";
						$ketqua = $db->insert($query1);
						if($ketqua!=false){
							$query2 = "delete from cart where user_id = $this->userid";
							$ketqua2 = $db->delete($query2);
							header("Location: ?request=ordersuccess");
						}else{
							$alert = "<script>alert('Đặt hàng thất bại!')</script>";
							return $alert;
						}
					}
				}
			}else{
				$this->sessionid = session_id();
				$query = "select * from cart where session_id = '$this->sessionid' ";
				$getcart = $db->select($query);
				if($getcart){
					while($kq = $getcart->fetch_assoc()){
						$this->prodid = $kq['product_id'];
						$this->prodname = $kq['product_name'];
						$this->price = $kq['price'];
						$this->amount = $kq['amount'];
						$this->total = $this->price*$this->amount;
						
						$query1 = "insert into orders(session_id,name,phone,email,address,product_id,product_name,price,amount,total) values('$this->sessionid','$this->name','$this->phone','$this->email','$this->address',$this->prodid,'$this->prodname',$this->price,$this->amount,$this->total)";
						$ketqua = $db->insert($query1);
						if($ketqua!=false){
							$query2 = "delete from cart where session_id = '$this->sessionid'";
							$ketqua2 = $db->delete($query2);
							header("Location: ?request=ordersuccess");
						}else{
							$alert = "<script>alert('Đặt hàng thất bại!')</script>";
							return $alert;
						}
					}
				}
			}
			
		}
		public static function capnhattrangthai($id,$tt){
			$db = new Database();

			$sql = "update orders set status = $tt where id = $id";
			$ketqua = $db->update($sql);
			return $ketqua;
		}
	}
?>