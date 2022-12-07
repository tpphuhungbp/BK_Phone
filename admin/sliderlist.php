<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once"../model/mslider.php"; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách slider</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tiêu đề</th>
					<th>Hình ảnh</th>
					<th>Trạng thái</th>
					<th>Sửa slider</th>
					<th>Xóa slider</th>
				</tr>
			</thead>
			<?php
				$getslider = slider::get_slider();
				if($getslider):
					$i = 0;
					while($ketqua = $getslider->fetch_assoc()):
						$i++;
			?>
			<tbody>
				<tr class="odd gradeX">
					<td><?=$ketqua['id']?></td>
					<td><?=$ketqua['name']?></td>
					<td style="padding: 5px;"><img src="<?=$ketqua['image']?>" height="200px" width="300px"/></td>		
					<td><?=$ketqua['status']?></td>		
					<td>
						<a href="./slideredit.php">Sửa</a>						
					</td> 
					<td>
						<a onclick="return confirm('Bạn có muốn xóa slider này!');" href="./sliderlist.php&sliderid=<?=$ketqua['id']?>" >Xóa</a>
					</td>
				</tr>	
			</tbody>
			<?php endwhile; endif; ?>
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
