<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once"../model/mcategory.php"; ?>
<?php
	if(!isset($_GET['catid'])|| $_GET['catid']==null){
		echo "<script>window.location='catlist.php'</script>";
	}else{
		$id = $_GET['catid'];
	}
	if($_SERVER['REQUEST_METHOD']==="POST"){
		$cate_name = $_POST['cate_name'];

        $update_cate = category::update_cate($id,$cate_name);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa loại sản phẩm</h2>
        <div class="block copyblock"> 
			<?php 
				$get_cate_name = category::getcatebyId($id);
				if($get_cate_name):
					while($result = $get_cate_name->fetch_assoc()):
			?>
            <form action="" method="post">
            <?php
                if(isset($update_cate)){
                    echo $update_cate;
                } else{
                    echo '';
                }
            ?>
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="cate_name" placeholder="Tên loại sản phẩm mới..." class="medium" required value="<?php if(isset($cate_name)){ echo $cate_name;} else {echo $result['cate_name'];} ?>"/>
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Chỉnh sửa" />&emsp;<a href="catlist.php" style=" background-color: pink;padding: 5px 20px;" href="">Danh sách loại sản phẩm</a>
                    </td>
                </tr>
            </table>
            </form>
			<?php endwhile; endif; ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>