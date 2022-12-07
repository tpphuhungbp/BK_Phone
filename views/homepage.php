<?php
    include"./include/slider.php";
?>
<div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Sản phẩm được quan tâm </h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
                $get_prod_feature = product::get_prod_feature();
                if($get_prod_feature):
                    while($ketqua=$get_prod_feature->fetch_assoc()):
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
            <?php endwhile; endif; ?>
        </div>
        <div class="content_bottom">
            <div class="heading">
                <h3>Sản phẩm mới</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
                $get_prod_new = product::get_prod_new();
                if($get_prod_new):
                    while($ketqua=$get_prod_new->fetch_assoc()):
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
            <?php endwhile; endif; ?>
        </div>
    </div>

