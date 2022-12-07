<?php
	if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['update_user'])){
		$update_user = user::update_user($_POST);
		echo "<meta http-equiv='refresh' content='0'>";
	}else if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['update_password'])){
		$update_pass = user::update_password($_POST);
		echo "<meta http-equiv='refresh' content='0'>";
	}
?>
<div class="content">
	<div class="content_top">
		<div class="heading">
		<h3>PERSONAL INFORMATION</h3>
		</div>
		<div class="clear"></div>
	</div>
	<div class="section group">
		<?php
			if(isset($_GET['user_id'])&& isset($_SESSION['user_id']) && $_GET['user_id']==$_SESSION['user_id']):
				$ngdung = user::getuserbyid($_SESSION['user_id']);
				if(isset($ngdung)):
					while($ketqua = $ngdung->fetch_assoc()):
		?>
		<div class="user_detail">
			<div class="contai">
				<div class="contai-trai">
					<form action="" method="post">
						<p>UPDATE INFORMATION</p>
						<?php if(isset($update_user)){echo $update_user;} ?>
						<hr>
						<input type="hidden" name="user_id" value="<?=$ketqua['id']?>">
						<label for="name"><b>Full Name (*)</b></label>
						<input type="text" placeholder="Enter Your Full Name" name="name" id="name" required value="<?=$ketqua['name']?>">

						<label for="phone"><b>Phone (*)</b></label>
						<input type="tel" placeholder="Enter Your Phone" name="phone" id="phone" required pattern="\d{10}" title="Số điện thoại phải đủ 10 số" value="<?=$ketqua['phone']?>">

						<label for="email"><b>Email (*)</b></label>
						<input type="email" placeholder="Enter Email" name="email" id="email" required pattern=".+@.+(\.[a-z]{2,3}){1,2}" value="<?=$ketqua['email']?>">
						<label for="address"><b>Specific Address (*)</b></label>
						<textarea placeholder="Enter Your Address" name="address" id="address" required rows="3" style="resize: none;"><?=$ketqua['address']?></textarea> <br> <br>

						<input type="submit" name="update_user" value="Save" class="user_detailbtn">
					</form>				
				</div>
				<div class="contai-phai">
					<form action="" method="post">
						<p>CHANGE PASSWORD</p>
						<?php if(isset($update_pass)){echo $update_pass;} ?>
						<hr>
						<input type="hidden" name="user_id" value="<?=$ketqua['id']?>">
						<label for="oldpassword"><b>Old Password (*) </b></label>
						<input type="password" placeholder="Enter Password" name="oldpassword" id="oldpassword" required pattern=".{6,}" title="Mật khẩu phải từ 8-16 ký tự">
						<label for="newpassword"><b>New Password (*)</b></label>
						<input type="password" placeholder="Enter Password" name="newpassword" id="newpassword" required pattern=".{6,}" title="Mật khẩu phải từ 8-16 ký tự">

						<label for="re-newpassword"><b>Confirm New Password (*)</b></label>
						<input type="password" placeholder="Confirm Password" name="re-newpassword" id="re-newpassword" required title="Mật khẩu phải từ 8-16 ký tự" oninput="checkPass()">
						<span id="checkPass" style="color: red"></span> <br> <br>
						<script>
							function checkPass(){
								var pass1 = document.getElementById('newpassword').value
								var pass2 = document.getElementById('re-newpassword').value
								if(pass1!= pass2){
									document.getElementById("checkPass").innerHTML = "Confirm password incorrect!"
								}else{
									document.getElementById("checkPass").innerHTML = ""
								}
							}
						</script>
						<input type="submit" id="update_password" name="update_password" value="Change password" class="user_detailbtn">
					</form>					
				</div>
			</div>				
		</div>

		<?php endwhile; endif; else: echo "<script>window.location = '?request=home' </script>"; endif;?>
	</div>
</div>

<style>
	.frm {
		width: 100%;
		display: flex;
		justify-content: center;
	}
	.user_detail{
	width: 100%;
	box-sizing: border-box;
	margin-top: 10px;
}
.user_detail h1,p{
	text-align: center;
}
.user_detail form{
	width: 100%;
	margin: auto;
}
.contai {
	padding: 16px;
	background-color: white;
	display: flex;
}
.contai p{
	font-size: 18px;
	font-weight: bold;
	padding: 8px 0px;
}
.contai-trai{
	width: 45%;
}	
.contai-trai form {
	border: 3px solid #f1f1f1;
	padding: 10px
}
.contai-phai{
	width: 45%;
	margin-left: 5%;
}
.contai-phai form{
	border: 3px solid #f1f1f1;
	padding: 10px
}

.user_detail input[type=text], input[type=password],input[type=tel],input[type=email],textarea {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  font-family: Arial, Helvetica, sans-serif;
}
.user_detail input[type=submit]{
	width: 40%;
	margin-left: 30%;
	
}
.user_detail input[type=submit]:hover{
	opacity: 0.7;
}

/* Overwrite default styles of hr */
.user_detail hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.user_detailbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.user_detail:hover {
  opacity: 1;
}

/* Add a blue text color to links */
.user_detail a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>