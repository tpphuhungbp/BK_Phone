
<div class="content">
	<?php
		if(isset($_GET['request'])=="productbycat" && isset($_GET['catid'])):
			$get_cate_name = category::getcatebyId($_GET['catid']);
			if($get_cate_name):
				while($ketqua = $get_cate_name->fetch_assoc()):
	?>
	<div class="content_top">
		<div class="heading">
		<h3><?=$ketqua['cate_name']?></h3>
		</div>
		<div class="clear"></div>
	</div>
	<?php endwhile; endif; endif; ?>
	<div class="section group">
		<?php
			if(isset($_GET['request'])=="productbycat" && isset($_GET['catid'])):
				$get_prod_bycatid = product::getprodbycatid($_GET['catid']);
				if($get_prod_bycatid):
					while($ketqua = $get_prod_bycatid->fetch_assoc()):
		?>
		<div class="grid_1_of_4 images_1_of_4">
			<a><img title="<?=$ketqua['product_name']?>" src="<?=$ketqua['image']?>" alt="" /></a>
			<h2 class="prodname"><a><?=$ketqua['product_name']?></a></h2>
			<p><?=$ketqua['description']?></p>
			<p><span class="price"><?=number_format($ketqua['price'])?> VNĐ</span></p>
			<p><i class="fa-solid fa-eye"></i> <?=$ketqua['view']?></p>
			<form action="?request=details&prodid=<?=$ketqua['id']?>" method="post">
				<input type="hidden" name="updateview_id" value="<?=$ketqua['id']?>">
				<div class="button"><span><input name="update_view" type="submit" value="Detail"></span></div>
			</form>
		</div>
		<?php endwhile; ?>
		<div class="pt">
			<?php
				$prod = product::getbycatid($_GET['catid']);
				$count = mysqli_num_rows($prod);
				$btnphantrang = $count/8;
				$link = "?request=productbycat&catid=".$_GET['catid']."&page=";
				$tranght = $_GET['page'];
				$sotrang = ceil($btnphantrang);
				if($sotrang >2){
					if($tranght==1){
						for($i=1;$i<=3;$i++){
							$link = "?request=productbycat&catid=".$_GET['catid']."&page="."".$i;
							echo "<a id='phantrang$i' href='$link'>$i</a>";
						}
					}elseif($tranght==$sotrang){	
						for($i=$sotrang-2;$i<=$sotrang;$i++){
							$link = "?request=productbycat&catid=".$_GET['catid']."&page="."".$i;
							echo "<a id='phantrang$i' href='$link'>$i</a>";
						}
					}else{
						for($i=($tranght-1);$i<=($tranght+1);$i++){
							$link = "?request=productbycat&catid=".$_GET['catid']."&page="."".$i;
							echo "<a id='phantrang$i' href='$link'>$i</a>";
						}
					}
				}else{
					for($i=1;$i<=$sotrang;$i++){
						$link = "?request=productbycat&catid=".$_GET['catid']."&page="."".$i;
						echo "<a id='phantrang$i' href='$link'>$i</a>";
					}
				}	
			?>
			<script>
				<?php if(isset($_GET['page'])):
						$vt = $_GET['page'];
				?>
					document.getElementById("phantrang<?=$vt?>").style.backgroundColor = '#808080';
				<?php endif; ?>
			</script>
		</div>
		<?php else:?>		
			<h2 style="width: 100%; text-align:center;padding: 20px 0px;">Sản phẩm tạm hết hàng!</h2>
			<div class='hethang'>
				<a href="?request=category">See other products</a>
			</div>
		<?php endif; endif;?>
	</div>
</div>

<style>
	.hethang{
		width: 100%;
		display: flex;
        align-items: center;
        justify-content: center;
	}
	.hethang a{
		text-align: center;
		display: block;
		width: 200px;
		padding: 10px 30px;
		background-color: lightskyblue;
		border: none;
		border-radius: 5px;
	}
	.hethang a:hover{
		opacity: 0.6;
	}
	.pt{
		width: 100%;
		float: left;
		display: flex;
		justify-content: center;
	}
	.pt a{
		display: block;
		text-align: center;
		width: 30px;
		padding: 10px;
		background-color: #000080;
		margin:0px 20px;
		border: none;
		border-radius: 5px;
		font-weight: bold;
		color: white;
	}
	.pt a:hover{
		opacity: 0.6;
	}
</style>


