<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once"../model/mcategory.php"; ?>
<?php include_once"../model/mproduct.php" ?>
<?php
	if(!isset($_GET['prodid'])|| $_GET['prodid']==null){
		echo "<script>window.location='productlist.php'</script>";
	}else{
		$productid = $_GET['prodid'];
	}
	if($_SERVER['REQUEST_METHOD']==="POST"){
		$id = $_POST['prod_id'];
		$name = $_POST['prod_name'];
		$cateid = $_POST['id_category'];
		$price = $_POST['prod_price'];
		$image = $_POST['prod_image'];
		$des = $_POST['prod_description'];
		$status = $_POST['prod_status'];
        $update_prod = product::update_prod($id,$cateid,$name,$price,$image,$des,$status);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block copyblock"> 
			<?php 
				$get_prod_name = product::getprodbyId($productid);
				if($get_prod_name):
					while($result = $get_prod_name->fetch_assoc()):
			?>
            <form action="" method="post">
            <table class="form">
				<tr>
					<td>
						<input type="hidden" name="pro_id" value="<?=$id?>">
					</td>
				</tr>					
				<tr>
					<td>
						<label>Tên</label>
					</td>
					<td>
						<input name="pro_name" type="text" placeholder="Nhập tên sản phẩm..." class="medium" required value="<?=$result['product_name']?>" />
					</td>
				</tr>
				<tr>
					<td>
						<label>Loại sản phẩm</label>
					</td>
					<td>
						<select id="select" name="id_category">
							<?php
								$catelist = category::get_category();
								if($catelist):
									while($ketqua = $catelist->fetch_assoc()):
							?>
								<option <?php if($ketqua['id']==$result['id_category']){echo "selected";} ?> value="<?=$ketqua['id']?>"><?=$ketqua['cate_name']?></option>
							<?php endwhile; endif; ?>
						</select>
					</td>
				</tr>						
				<tr>
				<td style="vertical-align: top; padding-top: 9px;">
					<label>Mô tả</label>
				</td>
				<td>
					<textarea name="pro_description" required rows="10" placeholder="Nhập mô tả sản phẩm..."><?=$result['description']?></textarea>
				</td>
				</tr>
				<tr>
					<td>
						<label>Giá</label>
					</td>
					<td>
						<input type="text" name="pro_price" placeholder="Nhập giá sản phẩm..." class="medium" required value="<?=$result['price']?>"/>
					</td>
				</tr>
			
				<tr>
					<td>
						<label>Chọn ảnh</label>
					</td>
					<td>
						<input type="text" class="medium" name="pro_image" placeholder="Nhập đường dẫn tới hình ảnh..." required value="<?=$result['image']?>"/>
					</td>
				</tr>
					
				<tr>
					<td>
						<label>Trạng thái</label>
					</td>
					<td>
						<select id="select" name="pro_status">
							<option value="1" <?php if($result['status']==1){echo "selected";} ?>>Còn hàng</option>
							<option value="0" <?php if($result['status']==0){echo "selected";} ?>>Hết hàng</option>
						</select>
					</td>
				</tr>                
				<tr> 
					<td></td>
					<td>
						<input type="submit" name="submit" Value="Chỉnh sửa" />
						&emsp;&emsp;&emsp;
						<a href="productlist.php" style=" background-color: pink;padding: 5px 20px;" href="">Danh sách sản phẩm</a>
					</td>
				</tr>
				<tr>
					<td><label for="">Kết quả trả về:</label></td>
					<td><?php if(isset($update_prod)){echo $update_prod;} else{echo '';
                }
            ?></td>
				</tr>
            </table>
            </form>
			<?php endwhile; endif; ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>

<style>
	.block form {
		width: 100%;
	}
	.block td input[type=text],textarea{
		width: 90%;
	}
</style>