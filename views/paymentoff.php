
<?php
	if(!isset($_SESSION['tongsp']) || $_SESSION['tongsp']==0){
		header("Location: ?request=cart");
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['dathang'])){
		$dathang = new order(null,null,$_POST['user_name'],$_POST['user_phone'],$_POST['user_email'],$_POST['user_address'],0,'',0,0,0);
		$ketqua = $dathang->add_order();

		$_SESSION['tongsp'] = cart::get_amount();	
	}
?>
<div class="content">
	<div class="content_top search-price">
		<div class="hding">
			<h3 style="font-size: 22px;font-weight: 500;color: #6c6c6c">TRANG THANH TOÁN KHI NHẬN HÀNG</h3>
		</div>
	</div>
	<div class="section group order">
		<?php
			$getcart = cart::getcart();
			if(isset($getcart)||$getcart!=null): ?>
		<table class="bang">
			<tr>
				<th style="width: 5%">STT</th>
				<th style="width: 40%">Tên sản phẩm</th>
				<th style="width: 20%">Giá</th>
				<th style="width: 15%">Số lượng</th>
				<th style="width: 20%">Thành tiền</th>
			</tr>	
		<?php
				$tongtien = 0;
				$i =0;
				while($ketqua = $getcart->fetch_assoc()):
					$tongtien += $ketqua['price']*$ketqua['amount'];
					$i++;
		?>
			<tr>
				<td class='hang'><?=$i?></td>
				<td class='hang'><?=$ketqua['product_name']?></td>
				<td class='hang'><?=number_format($ketqua['price'])?> VNĐ</td>
				<td class='hang'><?=$ketqua['amount']?></td>
				<td class='hang'><?=number_format($ketqua['price']*$ketqua['amount'])?> VNĐ</td>			
			</tr>
		<?php endwhile; ?>
			<tr style="font-size: 20px;font-weight: bold;">
				<td class='hang' colspan="2">Tổng tiền:</td>
				<td class='hang' colspan="3"><?=number_format($tongtien)?> VNĐ</td>
			</tr>
		</table>
		<div class="bphai">
			<?php
				if(isset($_SESSION['user_login'])&&$_SESSION['user_login']==true):
					$id = $_SESSION['user_id'];
					$ngdung = user::getuserbyid($id);
					while($ketqua = $ngdung->fetch_assoc()):
			?>
			<form class="pthuc" action="" method="post">
				<h4>Xác nhận thông tin khách hàng</h4> <hr>
				<div>
					<label for="user_name">Họ và tên:</label>
					<input type="text" name="user_name" id="user_name" value="<?=$ketqua['name']?>" placeholder="Họ và tên..." required>			
				</div>
				<div>
					<label for="user_phone">SĐT:</label>
					<input type="text" name="user_phone" id="user_phone" value="<?=$ketqua['phone']?>" placeholder="Số điện thoại..." required>
				</div>
				<div>
					<label for="user_email">Email:</label>
					<input type="mail" name="user_email" id="user_email" value="<?=$ketqua['email']?>" placeholder="Email..." required>
				</div>
				<div>
					<label for="user_address">Address:</label>
					<textarea name="user_address" id="user_address" cols="62" rows="6" required placeholder="Nhập địa chỉ cụ thể"><?=$ketqua['address']?></textarea>
				</div>	
				<hr>
				<div>
					<input type="submit" name="dathang" value="ĐẶT HÀNG">
				</div>	
			</form>	
			<?php endwhile; else: ?>
			<form class="pthuc" action="" method="post">
				<h4>Xác nhận thông tin khách hàng</h4> <hr>
				<div>
					<label for="user_name">Họ và tên:</label>
					<input type="text" name="user_name" id="user_name" value="" placeholder="Họ và tên..." required>			
				</div>
				<div>
					<label for="user_phone">SĐT:</label>
					<input type="text" name="user_phone" id="user_phone" value="" placeholder="Số điện thoại..." required>
				</div>
				<div>
					<label for="user_email">Email:</label>
					<input type="mail" name="user_email" id="user_email" value="" placeholder="Email..." required>
				</div>
				<div>
					<label for="user_address">Address:</label>
					<textarea name="user_address" id="user_address" cols="62" rows="6" required placeholder="Nhập địa chỉ cụ thể"></textarea>
				</div>
				<hr>
				<div>
					<input type="submit" name="dathang" value="ĐẶT HÀNG">
				</div>		
			</form>	
		<?php endif; ?>
		</div>
		<?php
			else: echo "<script>window.location = '?request=products'</script>"; 
			endif;
		?>
		
	</div>
</div>


<style>
	.order {
    width: 100%;
    display: flex;
}

.order table,
th,
td {
    border: 1px solid black;
}

.bang {
    margin-top: 20px;
    width: 50%;
    text-align: center;
}

.bphai {
    margin-top: 20px;
    width: 55%;
    margin-left: 3%;
}

.bang th {
    padding: 5px 5px;
}

.hang {
    padding: 10px;
}

.pthuc {
    float: left;
    width: 100%;
    border: 1px solid black;
}

.pthuc h4 {
    padding: 10px 0px;
    font-weight: bold;
	text-align: center;
}

.pthuc hr {
    width: 90%;
}

.pthuc input[type=text],input[type=mail],textarea {
    width: 60%;
	padding: 8px 10px;
	font-family: Arial, Helvetica, sans-serif;
}

.pthuc label {
    width: 25%;
}

.pthuc div {
    padding: 10px 0px;
    display: flex;
    justify-content: center;
}

.pthuc input[type=submit] {
    display: block;
    padding: 10px 20px;
    background-color: orangered;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    color: white
}

.pthuc input[type=submit]:hover {
    opacity: 0.6;
    transition: 0.4s;
}

.tongtien th {
    padding: 10px;
    font-weight: bold;
}

.tongtien a {
    margin: 10px 20%;
    padding: 10px;
    text-align: center;
    display: block;
    background-color: pink;
    border: none;
    border-radius: 5px;
    color: black;
    font-weight: bold;
}

.tongtien a:hover {
    opacity: 0.6;
    transition: 0.5s;
}
</style>