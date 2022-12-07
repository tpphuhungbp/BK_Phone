<div class="content">
	<div class="section group">
		<?php
			if(isset($_POST['search'])&& isset($_POST['txtsearch'])):
				$txtsearch = $_POST['txtsearch'];
				$getprodbysearch = product::getbysearch($txtsearch);
				if(isset($getprodbysearch)&&$getprodbysearch!=null):
					while($ketqua = $getprodbysearch->fetch_assoc()):
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
		<?php endwhile; else: ?>
		<h2 style="text-align: center">Không có sản phẩm cần tìm</h2>
		<div class='hethang'>
				<a href="?request=category">See other products</a>
			</div>
		<?php endif; endif; ?>
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
		margin: 20px 0px;
		text-align: center;
		display: block;
		width: 200px;
		padding: 10px 30px;
		background-color: #000080;
		border: none;
		border-radius: 5px;
		color: white;
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
		margin-right: 20px;
		border: none;
		border-radius: 5px;
		font-weight: bold;
		color: white;
	}
	.pt a:hover{
		opacity: 0.6;
	}
</style>
