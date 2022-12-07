<?php include'inc/header.php';?>
<?php include'inc/sidebar.php';?>
<?php
	include_once"../model/mproduct.php";
?>
<?php
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$del_prod = product::del_prod($id);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách sản phẩm </h2>
		<div class="block">        
			<table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên sản phẩm</th>
					<th>Mã loại</th>
					<th>Giá cả</th>
					<th>Hình ảnh</th>
					<th>Mô tả</th>
					<th>Lượt xem</th>
					<th>Trạng thái</th>
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$get_product = product::get_prod();
				if($get_product):
					$i = 0;
					while($ketqua = $get_product->fetch_assoc()):
						$i++;
			?>
			
				<tr class="gradeX odd">
					<td><?=$i?></td>
					<td><?=$ketqua['product_name']?></td>
					<td><?=$ketqua['cate_name']?></td>
					<td><?=number_format($ketqua['price'])?>VNĐ</td>
					<td><img style="padding: 5px;" src="<?=$ketqua['image']?>" alt="" width="120px"></td>
					<td><?=$ketqua['description']?></td>
					<td><?=$ketqua['view']?></td>
					<td>
						<?php 
							if($ketqua['status']==1){
								echo "Còn hàng";
							}else{
								echo "Hết hàng";
							}
						?>
					</td>
					<td><a href="productedit.php?prodid=<?=$ketqua['id']?>">Chỉnh sửa</a> || <a onclick="return confirm('Bạn có muốn loại sản phẩm này không?')" href="?delid=<?=$ketqua['id']?>">Xóa</a></td> 
				</tr>			
			<?php endwhile; endif; ?>	
			</tbody>
		</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

