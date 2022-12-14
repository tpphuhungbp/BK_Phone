<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	include"../model/muser.php";
?>
<?php
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$del_prod = user::del_user($id);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách tài khoản</h2>
		<div class="block">        
			<table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Họ tên</th>
					<th>Email</th>
					<th>Password</th>
					<th>Phone</th>
					<th>Address</th>
					<th>Quyền</th>
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$getuser = user::getuser();
				if($getuser):
					$i = 0;
					while($ketqua = $getuser->fetch_assoc()):
						$i++;
			?>
			
				<tr class="gradeX odd">
					<td><?=$i?></td>
					<td><?=$ketqua['name']?></td>
					<td><?=$ketqua['email']?></td>
					<td><?=$ketqua['password']?></td>
					<td><?=$ketqua['phone']?></td>
					<td><?=$ketqua['address']?></td>
					<td>
						<?php
							if($ketqua['role']==1){
								echo "Quản trị viên";
							}else{
								echo "Người dùng";
							}
						?>
					</td>	
					<td>
						<?php
							echo $ketqua['role']==1 ? '' : '<a onclick="return confirm("Bạn có muốn loại tài khoản này không?")" href="?delid=' . $ketqua['id'] . '">Xóa</a>';
						?>
					</td>			
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
