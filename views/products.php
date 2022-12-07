<div class="content">
	<div class="content_top searchprice">
		<div class="heading">
		<h3>SẮP XẾP :</h3>
		</div>
		<?php
			if(isset($_GET['price'])){
				$value = $_GET['price'];
			}else{
				$value = "";
			}
		?>
		<div class="clear">
			<select id="price_key" onchange="genderChanged()">
				<option <?php if($value=="the-price-goes-up"){echo "selected";} ?>  value="the-price-goes-up">Giá tăng dần</option>
				<option <?php if($value=="price-descending"){echo "selected";} ?>  value="price-descending">Giá giảm dần</option>
				<option <?php if($value=="left50k"){echo "selected";} ?>  value="left50k">Giá: < 50.000Đ </option>
				<option <?php if($value=="50kto150k"){echo "selected";} ?>  value="50kto150k">Giá: 50.000Đ - 150.000Đ</option>
				<option <?php if($value=="151kto300k"){echo "selected";} ?>  value="151kto300k">Giá: 150.000Đ - 300.000Đ</option>
				<option <?php if($value=="right300k"){echo "selected";} ?>  value="right300k">Giá: > 300.000Đ</option>
			</select>
			<script>
				function genderChanged(){
					let giatri = document.getElementById('price_key').value
					location.href = '?request=products&price='+giatri+"&page=1"
				}
			</script>
		</div>
	</div>
	<div class="section group">
		<?php
			if(isset($_GET['price'])):	
				$price = $_GET['price'];
				$getprod = product::getprodbyprice($price);
				if(isset($getprod)&&$getprod!=null):
					while($ketqua = $getprod->fetch_assoc()):
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
				$prod = product::getbyprice($price);
				$count = mysqli_num_rows($prod);
				$btnphantrang = $count/8;
				$sotrang = ceil($btnphantrang);
				$link = "?request=products&price=".$price."&page=";
				$tranght = $_GET['page'];
				if($sotrang >2){
					if($tranght==1){
						for($i=1;$i<=3;$i++){
							$link = "?request=products&price=".$price."&page="."".$i;
							echo "<a id='ptrang$i' href='$link'>$i</a>";
						}
					}elseif($tranght==$sotrang){	
						for($i=$sotrang-2;$i<=$sotrang;$i++){
							$link = "?request=products&price=".$price."&page="."".$i;
							echo "<a id='ptrang$i' href='$link'>$i</a>";
						}
					}else{
						for($i=($tranght-1);$i<=($tranght+1);$i++){
							$link = "?request=products&price=".$price."&page="."".$i;
							echo "<a id='ptrang$i' href='$link'>$i</a>";
						}
					}
				}else{
					for($i=1;$i<=$sotrang;$i++){
						$link = "?request=products&price=".$price."&page="."".$i;
						echo "<a id='ptrang$i' href='$link'>$i</a>";
					}
				}				
			?>
			<script>
				<?php if(isset($_GET['page'])):
						$vt = $_GET['page'];
				?>
					document.getElementById("ptrang<?=$vt?>").style.backgroundColor = '#808080';
				<?php endif; ?>
			</script>
		</div>
		<?php else: ?>
			<div class="khongcosp">
				<h2>Không có sản phẩm cần tìm</h2>
			</div>
			<style>
				.khongcosp{
					width: 100%;
					height: 60px;
					line-height: 60px;
				}
				.khongcosp h2{
					text-align: center;
				}
			</style>
		<?php endif;
			else: 
				$getprod = product::get_prod();
				if(isset($getprod)&&$getprod!=null):
					while($ketqua = $getprod->fetch_assoc()):
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
				$prod = product::getallprod();
				$count = mysqli_num_rows($prod);
				$btnphantrang = $count/8;				
				$sotrang = ceil($btnphantrang);
				$tranght = (int)$_GET['page'];
				if($sotrang >2){
					if($tranght==1){
						for($i=1;$i<=3;$i++){
							$link = "?request=products&page="."".$i;
							echo "<a id='phtrang$i' href='$link'>$i</a>";
						}
					}elseif($tranght==$sotrang){
						for($i=$sotrang-2;$i<=$sotrang;$i++){
							$link = "?request=products&page="."".$i;
							echo "<a id='phtrang$i' href='$link'>$i</a>";
						}
					}elseif($tranght!=1 && $tranght != $sotrang){
						for($i=$tranght-1;$i<=$tranght+1;$i++){
							$link = "?request=products&page="."".$i;
							echo "<a id='phtrang$i' href='$link'>$i</a>";
						}
					}
				}else{
					for($i=1;$i<=$sotrang;$i++){
						$link = "?request=products&page="."".$i;
						echo "<a id='phtrang$i' href='$link'>$i</a>";
					}
				}	
			?>
			<script>
				<?php if(isset($_GET['page'])):
						$vt = $_GET['page'];
				?>
					document.getElementById("phtrang<?=$vt?>").style.backgroundColor = '#808080';
				<?php endif; ?>
			</script>
		</div>
		<?php endif; endif; ?>
	</div>
</div>

<style>
	.searchprice {
		display: flex;
		width: 97%;
	}
	.header, .clear{
		width: 50%;
	}
	.clear select{
		width: 40%;
		padding: 10px;
		font-size: 20px;
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
		margin: 20px;
		border: none;
		border-radius: 5px;
		font-weight: bold;
		color: white;
	}
	.pt a:hover{
		opacity: 0.6;
	}
</style>