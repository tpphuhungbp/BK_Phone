<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	include"../model/mcategory.php";
?>
<?php
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$del_cate = category::del_category($id);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách loại sản phẩm </h2>
		<div class="block">        
			<table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên loại sản phẩm</th>
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$get_category = category::get_category();
				if($get_category):
					$i = 0;
					while($ketqua = $get_category->fetch_assoc()):
						$i++;
			?>
			
				<tr class="gradeX odd">
					<td><?=$i?></td>
					<td><?=$ketqua['cate_name']?></td>
					<td><a href="catedit.php?catid=<?=$ketqua['id']?>">Chỉnh sửa</a> || <a onclick="return confirm('Bạn có muốn loại sản phẩm này không?')" href="?delid=<?=$ketqua['id']?>">Xóa</a></td> 
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

