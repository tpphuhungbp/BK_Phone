<?php
	$url = $_SERVER['REQUEST_URI'];
	if (strlen(strstr($url,"admin")) > 0) {
		include_once"../lib/database.php";
		include_once"../helper/format.php";
		include_once"../classes/category.php";
	}else{
		include_once"./lib/database.php";
		include_once"./helper/format.php";
		include_once"./classes/category.php";
	}
	
?>

<?php
	class product{
		private $db;
		private $format;
		public function __construct()
		{	
			//tạo biến Database trong lib/database.php
			$this->db = new Database();
			//tạo biến Database trong helper/format.php
			$this->format = new Format();
		}
		public function insert_prod($data){
			//ket noi csdl
			$pro_name = mysqli_real_escape_string($this->db->link,$data['pro_name']);
			$id_category = mysqli_real_escape_string($this->db->link,$data['id_category']);
			$pro_description = mysqli_real_escape_string($this->db->link,$data['pro_description']);
			$pro_price = mysqli_real_escape_string($this->db->link,$data['pro_price']);
			$pro_image = mysqli_real_escape_string($this->db->link,$data['pro_image']);
			$pro_status = mysqli_real_escape_string($this->db->link,$data['pro_status']);

			$query = "select * from product where product_name = '$pro_name'";
			$ketqua = $this->db->select($query);
			if($ketqua == true){
				$alert = "<h5 style='color: red;padding: 5px;'>Loại sản phẩm đã tồn tại!</h5>";
				return $alert;
			}else{
				$query1 = "INSERT INTO product(id_category,product_name,price,image,description,status) values($id_category,'$pro_name',$pro_price,'$pro_image','$pro_description',$pro_status)";
				$ketqua1 = $this->db->insert($query1);
				if($ketqua1==true){
					$alert = "<h5 style='color: green;padding: 5px;'>Thêm sản phẩm mới thành công!</h5>";
					return $alert;
				}
			}
		}
		public function get_prod(){
			$query = "select product.*,category.cate_name from product inner join category where product.id_category = category.id order by id";
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		public function getprodbyId($id){
			$query = "select * from product where id = $id";
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		public function getprodbycatid($id){
			$query = "select * from product where id_category = $id order by view desc";
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		public function getprodbycatid_limit($id){
			$query = "select * from product where id_category = $id order by view desc LIMIT 4";
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		public function getprodbysearch($name){
			$query = "select * from product where product_name like '%$name%'";
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		public function getprodbyprice($price){
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
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		public function update_prod($data){
			$pro_id = mysqli_real_escape_string($this->db->link,$data['pro_id']);
			$id_category = mysqli_real_escape_string($this->db->link,$data['id_category']);
			$pro_name = mysqli_real_escape_string($this->db->link,$data['pro_name']);
			$pro_description = mysqli_real_escape_string($this->db->link,$data['pro_description']);
			$pro_price = mysqli_real_escape_string($this->db->link,$data['pro_price']);
			$pro_image = mysqli_real_escape_string($this->db->link,$data['pro_image']);
			$pro_status = mysqli_real_escape_string($this->db->link,$data['pro_status']);

			$query = "select * from product where product_name = '$pro_name' and id != $pro_id";
			$ketqua = $this->db->select($query);
			if($ketqua == true){
				$alert = "<h5 style='color: red;padding: 5px;'>Tên sản phẩm đã tồn tại!</h5>";
				return $alert;
			}else{
				$query1 = "UPDATE product SET id_category = $id_category, product_name = '$pro_name', price = $pro_price, image = '$pro_image', description = '$pro_description', status = $pro_status  WHERE id = $pro_id";
				$ketqua1 = $this->db->update($query1);
				if($ketqua1==true){
					$alert = "<h5 style='color: green;padding: 5px;'>Sửa sản phẩm thành công!</h5>";
					return $alert;
				}
			}
		}
		public function del_prod($id){
			$query1 = "select * from product where id=$id";
			$ketqua1 = $this->db->select($query1);
			if($ketqua1){
				$query = "delete from product where id = $id";
				$ketqua = $this->db->delete($query);
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
		public function get_prod_feature(){
			$query = "select * from product order by view desc LIMIT 4";
			$ketqua = $this->db->select($query);
			return $ketqua;
		}

		public function get_prod_new(){
			$query = "select * from product order by id desc LIMIT 4";
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		//cập nhật view
		public function update_view($id){
			$query = "select * from product where id = $id";
			$ketqua = $this->db->select($query)->fetch_assoc();
			$old_view = $ketqua['view'];
			$new_view = $old_view+=1;
			$query1 = "update product set view = $new_view where id = $id";
			$ketqua1 = $this->db->update($query1);
			return $ketqua1;
		}
	}
	
?>

