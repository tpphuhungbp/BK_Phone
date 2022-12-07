<?php
    session_start();
	include_once"./include/header.php";
?>
<div class="main">
    <?php
        if(isset($_GET['request'])){
            switch($_GET['request']){
                case 'userdetails':
                    include"./views/userdetails.php";break;
                case 'order':
                    include"./views/order.php";break;
                case 'home':
                    include"./views/homepage.php";break;
                case "contact":
                    include"./views/contact.php";break;
                case "about":
                    include"./views/about.php";break;
                case 'cart':
                    include"./views/cart.php";break;
                case 'details':
                    include"./views/details.php";break;
                case 'products':
                    include"./views/products.php";break;
                case 'productbycat':
                    include"./views/productbycat.php";break;
                case 'productbysearch':
                    include"./views/productbysearch.php";break;
                case 'category':
                    include"./views/category.php";break;
                case 'login':
                    include"./views/login.php";break;
                case 'register':
                    include"./views/login.php";break;
                case 'paymentoff':
                    include"./views/paymentoff.php";break;
                case 'payment_vnpay':
                    include"./views/payment_vnpay.php";break;
                case 'payment_momo':
                    include"./views/payment_momo.php";break;
                case 'payment_momoatm':
                    include"./views/payment_momoatm.php";break;
                case 'ordersuccess':
                    include"./views/ordersuccess.php";break;
                case 'orderdetail':
                    include"./views/orderdetail.php";break;
                default: 
                    header("Location: ./"); break;
            }
        }else{
            include"./views/homepage.php";
        }
    ?>
</div>
<style>
        .grid_1_of_4 > h1 > a {
            display: block;
            padding: 10px 0px;
        }
        .grid_1_of_4 h2 {
            padding: 10px 0px;
            font-weight: 600;
        }
        .grid_1_of_4 span{
            color: red
        }
        .grid_1_of_4 a{
            overflow: hidden; /** DÒNG BẮT BUỘC CÓ **/
		    position: relative;
            display: block;
            height: 100%;
            width: 100%;
        }
        .grid_1_of_4 input[type=submit]{
            padding: 8px 30px;
            cursor: pointer;
            background-color: orange;
            border: none;
            border-radius: 3px;
        }
        .grid_1_of_4 input[type=submit]:hover{
            opacity: 0.6;
        }
        .grid_1_of_4 img {
		height: 100%;
		width: 100%;
		transition: all 1s;
	}
        .grid_1_of_4:hover img {
            -webkit-transform: scale(1.3);
                    transform: scale(1.3);
        }
	.group{
		width: 100%;
	}
	.grid_1_of_4{
		width: 20%;
		float: left;
	}
    .prodname > a{
        text-align: center;
		-webkit-line-clamp: 1;
		-webkit-box-orient: vertical;
		overflow: hidden;
		display: -webkit-box;
    }
</style>
<?php
	include"./include/footer.php";
?>