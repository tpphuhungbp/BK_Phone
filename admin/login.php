<?php include"../model/madminlogin.php"; ?>
<?php
	if($_SERVER['REQUEST_METHOD']==="POST"){
		$admin_user = $_POST['admin_user'];
		$admin_pass = $_POST['admin_pass'];
		$login = new adminlogin($admin_user,$admin_pass);
		$login_check = $login->loginadmin();
	}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<h4 style="padding-bottom: 10px;color: red;"><?php if(isset($login_check)){
				echo $login_check;
			} ?>
			</h4>
			<div>
				<input type="text" placeholder="Username" required name="admin_user" />
			</div>
			<div>
				<input type="password" placeholder="Password" required name="admin_pass" />
			</div>
			<div>
				<input type="submit" value="Log in"/>
			</div>
		</form><!-- form -->
		<div class="button">
			<h4>Welcome to admin page!</h4>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>