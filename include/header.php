<?php
include "./lib/session.php";
Session::init();
?>
<?php
include_once "./lib/database.php";
include_once "./helper/format.php";


//hàm tự lấy class tương ứng khi chuyển trang
// spl_autoload_register(function($classname){
// 	include"./classes/".$classname.".php";
// });

spl_autoload_register(function ($classname) {
	include "./model/m" . $classname . ".php";
});

//include các class đã tạo
// $db = new Database();
// $fm = new Format();
// $cart = new cart();
// $user = new user();
// $category = new category();
// $product = new product();
// $order = new order();
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>

<head>
	<title>
		<?php
		if (isset($_GET['request'])) {
			switch ($_GET['request']) {
				case 'userdetails':
					echo 'Thông tin cá nhân';
					break;
				case 'order':
					echo 'Đặt hàng';
					break;
				case 'home':
					echo 'Trang chủ';
					break;
				case "contact":
					echo 'Liên hệ';
					break;
				case "about":
					echo 'Giới thiệu';
					break;
				case 'cart':
					echo 'Giỏ hàng';
					break;
				case 'details':
					echo 'Chi tiết sản phẩm';
					break;
				case 'products':
					echo 'Sản phẩm';
					break;
				case 'productbycat':
					echo 'Sản phẩm';
					break;
				case 'productbysearch':
					echo 'Sản phẩm';
					break;
				case 'category':
					echo 'Phân loại';
					break;
				case 'login':
					echo 'Đăng nhập';
					break;
				case 'register':
					echo 'Đăng ký';
					break;
			}
		} else {
			echo 'Trang chủ';
		}
		?>
	</title>
	<link rel="shortcut icon" type="image/png" href="https://thuthuatvui.com/wp-content/uploads.old/tong-hop-icon-mat-cuoi-chat-nhat-8.png" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script type="text/javascript">
		$(document).ready(function($) {
			$('#dc_mega-menu-orange').dcMegaMenu({
				rowItems: '4',
				speed: 'fast',
				effect: 'fade'
			});
		});
	</script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<div class="wrap">
		<div class="header_top">
			<div class="logo" style="text-align: center">
				<a href="./"><img src="images/BKPHONE_icon.png" alt="" width="70%" height="100px" /></a>
			</div>
			<div class="header_top_right">
				<div class="search_box">
					<form action="?request=productbysearch" method="post">
						<input type="text" id="txtsearch" name="txtsearch" placeholder="Tìm kiếm sản phẩm...">
						<input type="submit" name="search" id="search" value="Tìm kiếm">
					</form>
				</div>
				<div class="shopping_cart">
					<div class="cart">
						<a style="width: 100%; display: block;" href="?request=cart">
							<i class="fa-solid fa-cart-shopping"></i> Giỏ hàng ( <?php if (isset($_SESSION['tongsp'])) {
																						echo $_SESSION['tongsp'];
																					} else echo 0; ?> )
						</a>
					</div>
				</div>
				<?php
				if (isset($_GET['userid'])) {
					// $deleteAll = $cart->deleteAll();
					session_destroy();
					session_start();
					$_SESSION['tongsp'] = cart::get_amount();
					header("Location:?request=home");
				}
				?>
				<div class="login">
					<div class="dropdown">
						<button class="dropbtn"><i class="fa-solid fa-circle-user"></i> Tài khoản</button>
						<div class="dropdown-content">
							<?php if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) : ?>
								<a href="?request=userdetails&user_id=<?= $_SESSION['user_id'] ?>" style="font-weight: bold;"><?= $_SESSION['user_name'] ?></a>
								<a href="?userid=<?= $_SESSION['user_id'] ?>">Đăng xuất</a>
							<?php else : ?>
								<a href="?request=login">Đăng nhập</a>
								<a href="?request=login">Đăng ký</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<style>
					#btnlogin:hover {
						opacity: 0.6;
					}

					#logout {
						border: none;
						width: 100%;
						height: 100%;
						cursor: pointer;
					}

					.search_box {
						width: 40%;
					}

					.shopping_cart {
						width: 30%;
					}

					.dropdown {
						width: 100%;
					}

					.dropbtn {
						width: 100%;
					}

					.login {
						width: 20%;
					}
				</style>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item" ><a class="nav-link" href="./"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
					<li class="nav-item" ><a class="nav-link" href="?request=products&page=1"><i class="fa-brands fa-product-hunt"></i> Sản phẩm</a> </li>
					<li class="nav-item"> <a class="nav-link" href="?request=category"><i class="fa-solid fa-copyright"></i> Phân loại</a></li>
					<li class="nav-item"> <a class="nav-link" href="?request=about"><i class="fa-solid fa-circle-info"></i> Giới thiệu</a> </li>
					<li class="nav-item"> <a class="nav-link" href="?request=contact"><i class="fa-solid fa-address-book"></i> Liên hệ</a> </li>
					<li class="nav-item"> <a class="nav-link" href="?request=cart"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng</a></li>
				</ul>
			</div>
		</nav>