<?php
	if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['addtocart']) && $_POST['addtocart']){
        $amount = (int)$_POST['amount'];
		$id = (int)$_POST['product_id'];
		//thêm vào giỏ hàng
		$addtocart = cart::addtocart($id,$amount);
		$_SESSION['tongsp'] = cart::get_amount();
		echo "<meta http-equiv='refresh' content='0'>";
	}else if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['update_view'])){
		$id = $_POST['updateview_id'];
		$updateview = product::update_view($id);
	}
?>
<div class="content">
	<div class="section group">
		<div class="cont-desc span_1_of_2">
			<?php
				if(isset($_GET['request'])=="details" && isset($_GET['prodid'])):
					$id = $_GET['prodid'];
					$getprod = product::getprodbyid($id);
					if($getprod && $getprod!=null):
						while($ketqua = $getprod->fetch_assoc()):
			?>
			<div class="grid images_3_of_2">
				<img src="<?=$ketqua['image']?>" alt="" />
			</div>
			<div class="desc span_3_of_2">
				<h2><?=$ketqua['product_name']?></h2>
				<p><?=$ketqua['description']?></p>					
				<div class="price">
					<p>Giá: <span><?=number_format($ketqua['price'])?> VNĐ</span></p>
					<?php
						$getcatname = category::getcatebyId($ketqua['id_category']);
						if(isset($getcatname)):
							while($kq = $getcatname->fetch_assoc()):
					?>
					<p>Loại sản phẩm: <span><?=$kq['cate_name']?></span></p>
					<?php endwhile; endif; ?>
				</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="hidden" name="product_id" value="<?=$ketqua['id']?>">
						<input type="number" class="buyfield" name="amount" value="1" min="1" max="99" /> <br> <br>
						<?php
							if($ketqua['status']==1):
						?>
						<input type="submit" class="buysubmit" name="addtocart" value="Thêm vào giỏ hàng"/>
						<p style='color: green;font-size: 18px;padding: 10px 0px;'><?php if(isset($addtocart)){echo $addtocart;}?></p>
						<?php else: ?>
						<label for="">Hết hàng</label>
						<?php endif; ?>
					</form>				
				</div>
			</div>
			<?php endwhile; else: echo "<script>window.location = './'</script>";?>
			<?php endif; endif; ?>	
		</div>
		<div class="rightsidebar span_3_of_1">
			<h2>PHÂN LOẠI SẢN PHẨM:</h2>
			<ul>
				<?php 
					$get_cate = category::get_category();
               		if($get_cate):
                    while($ketqua=$get_cate->fetch_assoc()):
				?>
					<li><a href="?request=productbycat&catid=<?=$ketqua['id']?>&page=1"><?=$ketqua['cate_name']?></a></li>
				<?php endwhile; endif; ?>
			</ul>
		</div>
	</div>
</div>


<style>
	.images_3_of_2{
            overflow: hidden; /** DÒNG BẮT BUỘC CÓ **/
		    position: relative;
            display: block;
        }
        .images_3_of_2 img {
		height: 100%;
		width: 100%;
		transition: all 1s;
	}
        .images_3_of_2:hover img {
            -webkit-transform: scale(1.3);
                    transform: scale(1.3);
        }
</style>
