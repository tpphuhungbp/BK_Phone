<?php
	$url = $_SERVER['REQUEST_URI'];
	if (strlen(strstr($url,"admin")) > 0) {
		include_once"../lib/database.php";
		include_once"../model/mcategory.php";
	}else{
		include_once"./lib/database.php";
		include_once"./model/mcategory.php";
	}
	
?>

<?php
	class product{
		private $cateid;
		private $name;
		private $price;
		private $image;
		private $des;
		private $status;
		public function __construct($cateid,$name,$price,$image,$des,$status)
		{	
			$this->cateid = $cateid;
			$this->name = $name;
			$this->price = $price;
			$this->image = $image;
			$this->des = $des;
			$this->status = $status;
		}
		public function insert_prod(){
			$db = new Database();

			$query = "select * from product where product_name = '$this->name'";
			$ketqua = $db->select($query);
			if($ketqua == true){
				$alert = "<script>alert('Tên sản phẩm đã tồn tại!')</script>";
				return $alert;
			}else{
				$query1 = "insert into product(id_category,product_name,price,image,description,status) values($this->cateid,'$this->name','$this->price','$this->image','$this->des',$this->status)";
				$ketqua1 = $db->insert($query1);
				if($ketqua1==true){
					$alert = "<script>alert('Thêm sản phẩm mới thành công!')</script>";
					return $alert;
				}else{
					$alert = "<script>alert('Thêm sản phẩm mới thất bại!')</script>";
					return $alert;
				}
			}
		}
		public static function getallprod(){
			$db = new Database();
			$sql = "select * from product";
			$ketqua = $db->select($sql);
			return $ketqua;
		}
		public static function get_prod(){
			$db = new Database();

			$sp_moitrang = 8;
			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}
			$tung_trang = ($page-1)*$sp_moitrang;
			$query = "select product.*,category.cate_name from product inner join category where product.id_category = category.id order by id limit $tung_trang,$sp_moitrang";
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function getprodbyId($id){
			$db = new Database();
			$query = "select * from product where id = $id";
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function getprodbycatid($id){
			$db = new Database();
			$sp_moitrang = 8;
			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}
			$tung_trang = ($page-1)*$sp_moitrang;
			$query = "select * from product where id_category = $id order by view desc limit $tung_trang,$sp_moitrang";
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function getbycatid($id){
			$db = new Database();
			
			$query = "select * from product where id_category = $id order by view desc";
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function getprodbycatid_limit($id){
			$db = new Database();
			$query = "select * from product where id_category = $id order by view desc LIMIT 4";
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function getprodbysearch($name){
			$db = new Database();
			$sp_moitrang = 8;
			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}
			$tung_trang = ($page-1)*$sp_moitrang;
			$query = "select * from product where product_name like '%$name%' limit $tung_trang,$sp_moitrang";
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function getbysearch($name){
			$db = new Database();
			$query = "select * from product where product_name like '%$name%'";
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function getbyprice($price){
			$db = new Database();
			switch($price){
				case 'the-price-goes-up':
					$query = "select * from product order by price"; break;
				case 'price-descending':
					$query = "select * from product order by price desc"; break;
				case 'left50k': 
					$query = "select * from product where price <= 50000"; break;
				case '50kto150k': 
					$query = "select * from product where price between 50000 and 150000"; break;
				case '151kto300k': 
					$query = "select * from product where price between 151000 and 300000"; break;
				case 'right300k': 
					$query = "select * from product where price > 300000"; break;
			}
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function getprodbyprice($price){
			$db = new Database();
			$sp_moitrang = 8;
			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}
			$tung_trang = ($page-1)*$sp_moitrang;
			switch($price){
				case 'the-price-goes-up':
					$query = "select * from product order by price"; break;
				case 'price-descending':
					$query = "select * from product order by price desc"; break;
				case 'left50k': 
					$query = "select * from product where price <= 50000"; break;
				case '50kto150k': 
					$query = "select * from product where price between 50000 and 150000"; break;
				case '151kto300k': 
					$query = "select * from product where price between 151000 and 300000"; break;
				case 'right300k': 
					$query = "select * from product where price > 300000"; break;
			}
			$query = $query." limit $tung_trang,$sp_moitrang";
			$ketqua = $db->select($query);
			return $ketqua;
		}
		public static function update_prod($id,$cateid,$name,$price,$image,$des,$status){
			$db = new Database();

			$query = "select * from product where product_name = '$name' and id != $id";
			$ketqua = $db->select($query);
			if($ketqua == true){
				echo "<script> alert('Tên sản phẩm đã tồn tại') </script>";
			}else{
				$query1 = "UPDATE product SET id_category = $cateid, product_name = '$name', price = $price, image = '$image', description = '$des', status = $status  WHERE id = $id";
				$ketqua1 = $db->update($query1);
				if($ketqua1==true){
					echo "<script> alert('Sửa sản phẩm thành công') </script>";
				}
			}
		}
		public static function del_prod($id){
			$db = new Database();
			$query1 = "select * from product where id=$id";
			$ketqua1 = $db->select($query1);
			if($ketqua1){
				$query = "delete from product where id = $id";
				$ketqua = $db->delete($query);
				if($ketqua){
					echo "<script> alert('Đã xóa thành công sản phẩm') </script>";
					echo "<script> window.location='productlist.php' </script>";
				}else{
					echo "<script> alert('Xóa sản phẩm thất bại') </script>";
					echo "<script> window.location='productlist.php' </script>";
				}
			}else{
				echo "<script> alert('Xóa sản phẩm thất bại') </script>";
				echo "<script> window.location='productlist.php' </script>";
			}
		}
		// lấy sản phẩm được quan tâm nhiều nhất
		public static function get_prod_feature(){
			$db = new Database();
			$query = "select * from product order by view desc LIMIT 4";
			$ketqua = $db->select($query);
			return $ketqua;
		}

		public static function get_prod_new(){
			$db = new Database();
			$query = "select * from product order by id desc LIMIT 4";
			$ketqua = $db->select($query);
			return $ketqua;
		}
		//cập nhật view
		public static function update_view($id){
			$db = new Database();
			$query = "select * from product where id = $id";
			$ketqua = $db->select($query)->fetch_assoc();
			$old_view = $ketqua['view'];
			$new_view = $old_view+=1;
			$query1 = "update product set view = $new_view where id = $id";
			$ketqua1 = $db->update($query1);
			return $ketqua1;
		}
	}
	
?>

