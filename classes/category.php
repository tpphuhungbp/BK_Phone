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
	class categor{
		private $db;
		private $format;
		public function __construct()
		{	
			//tạo biến Database trong lib/database.php
			$this->db = new Database();
			//tạo biến Database trong helper/format.php
			$this->format = new Format();
		}
		public function insert_cate($cate_name){
			//kiem tra format cua username va password
			$cate_name = $this->format->validation($cate_name);
			//ket noi csdl
			$cate_name = mysqli_real_escape_string($this->db->link,$cate_name);

			$query = "select * from category where cate_name = '$cate_name'";
			$ketqua = $this->db->select($query);
			if($ketqua == true){
				$alert = "<h5 style='color: red;padding: 5px;'>Loại sản phẩm đã tồn tại!</h5>";
				return $alert;
			}else{
				$query1 = "INSERT INTO category(cate_name) values('$cate_name')";
				$ketqua1 = $this->db->insert($query1);
				if($ketqua1==true){
					$alert = "<h5 style='color: green;padding: 5px;'>Thêm loại sản phẩm mới thành công!</h5>";
					return $alert;
				}
			}
		}
		public function get_category(){
			$query = "select * from category order by id";
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		public function getcatebyId($id){
			$query = "select * from category where id = $id";
			$ketqua = $this->db->select($query);
			return $ketqua;
		}
		public function update_cate($cate_id,$cate_name){
			$cate_name = $this->format->validation($cate_name);
			$cate_id = mysqli_real_escape_string($this->db->link,$cate_id);
			$cate_name = mysqli_real_escape_string($this->db->link,$cate_name);

			$query = "select * from category where cate_name = '$cate_name' and id != $cate_id";
			$ketqua = $this->db->select($query);
			if($ketqua == true){
				$alert = "<h5 style='color: red;padding: 5px;'>Loại sản phẩm đã tồn tại!</h5>";
				return $alert;
			}else{
				$query1 = "UPDATE category SET cate_name = '$cate_name' WHERE id = $cate_id";
				$ketqua1 = $this->db->update($query1);
				if($ketqua1==true){
					$alert = "<h5 style='color: green;padding: 5px;'>Sửa loại sản phẩm mới thành công!</h5>";
					return $alert;
				}
			}
		}
		public function del_category($id){
			$query1 = "select * from category where id=$id";
			$ketqua1 = $this->db->select($query1);
			if($ketqua1){
				$query = "delete from category where id = $id";
				$ketqua = $this->db->delete($query);
				if($ketqua){
					echo "<script> alert('Đã xóa thành công loại phẩm') </script>";
				}else{
					echo "<script> alert('Xóa loại sản phẩm thất bại') </script>";
					echo "<script> window.location='catlist.php' </script>";
				}
			}else{
				echo "<script> alert('Xóa loại sản phẩm thất bại') </script>";
				echo "<script> window.location='catlist.php' </script>";
			}
		}
	}
	
?>

