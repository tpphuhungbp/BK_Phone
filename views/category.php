<div class="content">
	<?php
		$get_cate = category::get_category();
		if($get_cate):
			while($ketqua=$get_cate->fetch_assoc()):
	?>
		<div class="content_top">
			<div class="heading">
				<h3> <a href="?request=productbycat&catid=<?=$ketqua['id']?>&page=1"><?=$ketqua['cate_name']?></a></h3>
			</div>
		</div>
		<div class="section group">
			<?php
				$get_prod_byid = product::getprodbycatid_limit($ketqua['id']);
				if($get_prod_byid):
					while($kq=$get_prod_byid->fetch_assoc()):
			?>
			<div class="grid_1_of_4 images_1_of_4">
				<a><img title="<?=$kq['product_name']?>" src="<?=$kq['image']?>" alt="" /></a>
				<h2 class="prodname"><a><?=$kq['product_name']?></a></h2>
				<p><?=$kq['description']?></p>
				<p><span class="price"><?=number_format($kq['price'])?> VNĐ</span></p>
				<p><i class="fa-solid fa-eye"></i> <?=$kq['view']?></p>
				<form action="?request=details&prodid=<?=$kq['id']?>" method="post">
					<input type="hidden" name="updateview_id" value="<?=$kq['id']?>">
					<div class="button"><span><input name="update_view" type="submit" value="Detail"></span></div>
				</form>
			</div>
			<?php endwhile; endif; ?>
		</div>
	<?php endwhile; endif; ?>
</div>

<style>
	.content_top{
		padding: 15px 20px;
		border: 1px solid #EBE8E8;
		border-radius: 3px;
		min-height: 40px;
	}
	.heading a:hover{
		color: orangered
	}
</style>