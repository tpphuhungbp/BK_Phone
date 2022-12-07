<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include"../model/mslider.php"; ?>
<?php
	if($_SERVER['REQUEST_METHOD']==="POST" && $_POST['add_slider']){
        $name = $_POST['sl_name'];
        $img = $_POST['sl_image'];
        $st = $_POST['sl_status'];

        $them = new slider($name,$img,$st);
        $ketqua = $them->add_slider();
        if($ketqua){
            echo $ketqua;
        }
	}
?>
<div class="grid_10">
    <div class="box round first grid add_pro">
        <h2>Thêm sản phẩm mới</h2>
        <div class="block">               
         <form action="" method="post">
            <table class="form">
                <tr>
                    <td>
                        <label>Tên</label>
                    </td>
                    <td>
                        <input name="sl_name" type="text" placeholder="Nhập tên sản phẩm..." class="medium" required />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Chọn ảnh</label>
                    </td>
                    <td>
                        <input id="image" type="text" class="medium" name="sl_image" placeholder="Nhập đường dẫn tới hình ảnh..." required oninput="previewFile()"/>
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
                        <select id="select" name="sl_status">
                            <option value="0">Ẩn slider</option>
                            <option value="1">Hiển thị slider</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td style="padding-top: 10px">
                        <input type="submit" name="add_slider" Value="Thêm sản phẩm" style="padding: 5px 10px;background-color: yellow;"/>
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


