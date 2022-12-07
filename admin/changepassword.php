<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include"../model/muser.php" ?>

<?php
    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['submit'])){
        if($_SESSION['adminlogin']==true){
            $id = $_SESSION['id'];
            $pass = $_POST['newpass'];
            $doimk = user::update_password($id,$pass);
        }
    }   
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">               
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Mật khẩu cũ..." id="oldpass"  name="oldpass" class="medium" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Mật khẩu mới..." id="newpass" name="newpass" class="medium" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Xác nhận mật khẩu..." id="newpass2" name="newpass2" class="medium" required oninput="checkPass()" /> <br>
                        <span id="checkPass" style="color: red"></span> <br>
                    </td>
                    <script>
                        function checkPass(){
                            var pass1 = document.getElementById('newpass').value
                            var pass2 = document.getElementById('newpass2').value
                            var oldpass = document.getElementById('oldpass').value
                            if(pass1!= pass2){
                                document.getElementById("checkPass").innerHTML = "Xác nhận mật khẩu sai"
                                document.getElementById("submit").style.display = 'none';
                            }else if(pass1==oldpass){
                                document.getElementById("checkPass").innerHTML = "Mật khẩu mới phải khác mật khẩu cũ!"
                                document.getElementById("submit").style.display = 'none';
                            }else{
                                document.getElementById("checkPass").innerHTML = "";
                                document.getElementById("submit").style.display = 'block';
                            }
                        }
                    </script>
                </tr>
				
				<tr>
                    <td></td>
                    <td>
                        <?php
                            if(isset($doimk) && $doimk){
                                echo $doimk;
                            }
                        ?>
                    </td>
                </tr>
				 <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" id="submit" Value="Xác nhận" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>