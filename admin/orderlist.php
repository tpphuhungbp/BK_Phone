<?php include'inc/header.php';?>
<?php include'inc/sidebar.php';?>
<?php
	include_once"../model/morder.php";
?>
<?php
	if(isset($_GET['capnhat'])){
		$id = $_GET['id'];
		$tt = $_GET['trangthai'];
		$capnhat = order::capnhattrangthai($id,$tt);
		if($capnhat){
			header("Location: ./orderlist.php");
		}
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách đơn đặt hàng</h2>
		<div class="block">        
			<table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên KH</th>
					<th>SĐT</th>
					<th>Email</th>
					<th>Địa chỉ</th>
					<th>Mã SP</th>
					<th>Tên SP</th>
					<th>Giá</th>
					<th>SLg </th>
					<th>Tổng</th>
					<th>Thời gian</th>
					<th>TT</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$get_order = order::getall_order();
				if($get_order):
					$i = 0;
					while($ketqua = $get_order->fetch_assoc()):
						$i++;
			?>
			
				<tr class="gradeX odd">
					<td><?=$i?></td>
					<td><?=$ketqua['name']?></td>
					<td><?=$ketqua['phone']?></td>
					<td><?=$ketqua['email']?></td>
					<td><?=$ketqua['address']?></td>
					<td><?=$ketqua['product_id']?></td>
					<td><?=$ketqua['product_name']?></td>
					<td><?=number_format($ketqua['price'])?></td>
					<td><?=$ketqua['amount']?></td>
					<td><?=number_format($ketqua['total'])?></td>
					<td><?=$ketqua['thoigian']?></td>
					<form action="" method="get">
					<td>
						<select name="trangthai" id="trangthai">
							<option value="0" <?php if($ketqua['status']==0) echo "selected"; ?> >Chưa xác nhận</option>
							<option value="1" <?php if($ketqua['status']==1) echo "selected"; ?>>Đã xác nhận</option>
							<option value="2" <?php if($ketqua['status']==2) echo "selected"; ?>>Đã giao hàng</option>
						</select>						
					</td>	
					<td> 
						<input type="hidden" name="id" value="<?=$ketqua['id']?>">
						<input type="submit" value="Cập nhật" name="capnhat" id="capnhat">
					</td>
					</form>
					
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

<style>
	#capnhat{
		cursor: pointer;
		background-color: green;
		border: none;
		padding: 3px 10px;
		border-radius: 4px;
		color: white;
	}
	#capnhat:hover{
		opacity: 0.6;
	}
</style>

