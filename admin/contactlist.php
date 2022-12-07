<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	include"../model/mcontact.php";
?>
<?php
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$del_cate = category::del_category($id);
	}
?>
<?php
	if(isset($_GET['capnhatct'])){
		$id = $_GET['id'];
		$tt = $_GET['trangthai'];
		$capnhat = contact::capnhattrangthai($id,$tt);
		if($capnhat){
			header("Location: ./contactlist.php");
		}
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách liên hệ </h2>
		<div class="block">        
			<table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Họ tên</th>
					<th>Email</th>
					<th>Số điện thoại</th>
					<th>Nội dung</th>
					<th>Thời gian</th>
					<th>Trạng thái</th>
					<th>Cập nhật</th>
					<th>Gọi điện</th>
					<th>Trả lời mail</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$get_contact = contact::get_contact();
				if($get_contact):
					$i = 0;
					while($ketqua = $get_contact->fetch_assoc()):
						$i++;
			?>
			
				<tr class="gradeX odd">
					<td><?=$i?></td>
					<td><?=$ketqua['name']?></td>
					<td><?=$ketqua['email']?></td>
					<td><?=$ketqua['phone']?></td>
					<td><?=$ketqua['content']?></td>
					<td><?=$ketqua['time']?></td>
					<form action="" method="get">
					<td>
						<select name="trangthai" id="trangthai">
							<option value="0" <?php if($ketqua['status']==0) echo "selected"; ?> >Chưa liên hệ</option>
							<option value="1" <?php if($ketqua['status']==1) echo "selected"; ?>>Đã liên hệ</option>
						</select>						
					</td>	
					<td> 
						<input type="hidden" name="id" value="<?=$ketqua['id']?>">
						<input type="submit" value="Cập nhật" name="capnhatct" id="capnhatct">
					</td>
					</form>
					<td><a href="callto:<?=$ketqua['phone']?>">Điện thoại</a></td>
					<td><a href="mailto:<?=$ketqua['email']?>">Trả lời mail</a></td>				
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
	#capnhatct{
		cursor: pointer;
		background-color: green;
		border: none;
		padding: 3px 10px;
		border-radius: 4px;
		color: white
	}
	#capnhatct:hover{
		opacity: 0.6;
	}
</style>

