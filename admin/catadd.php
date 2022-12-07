<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include"../model/mcategory.php"; ?>
<?php
	if($_SERVER['REQUEST_METHOD']==="POST"){
		$cate_name = new category($_POST['cate_name']);
        $insertCat = $cate_name->insert_cate($cate_name);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm loại sản phẩm mới</h2>
        <div class="block copyblock"> 
            <form action="catadd.php" method="post">
            <?php
                if(isset($insertCat)){
                    echo $insertCat;
                } else{
                    echo '';
                }
            ?>
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="cate_name" placeholder="Tên loại sản phẩm mới..." class="medium" required value="<?php
                        if(isset($_POST['cate_name'])){
                            echo $_POST['cate_name'];
                        } else{
                            echo '';
                        }
                    ?>"/>
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Thêm" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>