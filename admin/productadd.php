<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include"../model/mcategory.php"; ?>
<?php include"../model/mproduct.php"; ?>
<?php
	if($_SERVER['REQUEST_METHOD']==="POST" && $_POST['add_pro']){
        $cateid = $_POST['id_category'];
        $name = $_POST['pro_name'];
        $price = $_POST['pro_price'];
        $image = $_POST['pro_image'];
        $description = $_POST['pro_description'];
        $status = $_POST['pro_status'];
        $insertPro = new product($cateid,$name,$price,$image,$description,$status);

        $ketqua = $insertPro->insert_prod();
        if($ketqua){
            echo $ketqua;
        }

	}
?>
<div class="grid_10">
    <div class="box round first grid add_pro">
        <h2>Thêm sản phẩm mới</h2>
        <div class="block">               
         <form action="productadd.php" method="post">
            <table class="form">
                <tr>
                    <td>
                        <label>Tên</label>
                    </td>
                    <td>
                        <input name="pro_name" type="text" placeholder="Nhập tên sản phẩm..." class="medium" required />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Loại sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="id_category">
                            <?php
                                $catelist = category::get_category();
                                if($catelist):
                                    while($ketqua = $catelist->fetch_assoc()):
                            ?>
                                <option value="<?=$ketqua['id']?>"><?=$ketqua['cate_name']?></option>
                            <?php endwhile; endif; ?>
                        </select>
                    </td>
                </tr>						
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <textarea name="pro_description" required rows="10" placeholder="Nhập mô tả sản phẩm...">Tất cả dòng điện thoại</textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="text" name="pro_price" placeholder="Nhập giá sản phẩm..." class="medium" required/>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Chọn ảnh</label>
                    </td>
                    <td>
                        <input id="image" type="text" class="medium" name="pro_image" placeholder="Nhập đường dẫn tới hình ảnh..." required onchange="previewFile()"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><img id="blah" src="" alt="" width=200px></td>
                </tr>
				
				<tr>
                    <td>
                        <label>Trạng thái</label>
                    </td>
                    <td>
                        <select id="select" name="pro_status">
                            <option value="1">Còn hàng</option>
                            <option value="0">Hết hàng</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td style="padding-top: 10px">
                        <input type="submit" name="add_pro" Value="Thêm sản phẩm" style="padding: 5px 10px;background-color: yellow;"/>
                    </td>
                </tr>
                
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script>
    function previewFile() {
        link = document.getElementById("image").value;
        document.getElementById("blah").src = link;
    }
</script>
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>
<style>
    .add_pro input[type=text], textarea, select{
        width: 60%;
        padding: 12px;
        font-family: Arial, Helvetica, sans-serif;
    }
    .add_pro input[type=submit]:hover{
        opacity: 0.6;
    }
</style>


