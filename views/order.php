
<?php
	if(isset($_GET['request'])&& $_GET['request']=='order'){
		$getcart = cart::getcart();
		if(!isset($getcart)||$getcart==null){
			echo "<script>window.location = '?request=products'</script>";
		}
	}
?>
<div class="content">
	<div class="content_top search-price">
		<div class="hding">
			<h3 style="font-size: 22px;font-weight: 500;color: #6c6c6c">TRANG ĐẶT HÀNG</h3>
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
		</table>
		<div  class="bphai">
			<div class="tongtien" style="width: 100%">
				<table style="width: 100%">
					<tr>
						<th>Tổng tiền: </th>
						<th><?=number_format($tongtien)?> VNĐ</th>
					</tr>
					<tr>
						<td colspan="2"><a href="?request=cart">Quay lại giỏ hàng</a></td>
					</tr>
				</table>
			</div>
			<div style="width: 100%;padding: 30px 0px;">
				<h1 style="text-align: center;font-size: 22px; font-weight: bold;">CHỌN PHƯƠNG THỨC THANH TOÁN</h1> <hr>
				<div class="fmpay">
					<div class="pay">
						<form class="pthuc" action="?request=paymentoff" method="post">
							<div>
								<input type="submit" name="thanhtoanoff" value="Thanh toán khi nhận hàng" style="background-color: burlywood;">
							</div>		
						</form>	
						<form class="pthuc" action="?request=payment_vnpay" method="post">
							<div>
								<input type="hidden" name="tongtien" value="<?=$tongtien?>">
								<input type="submit" name="redirect" id="redirect" value="Thanh toán bằng VNPAY">
							</div>		
						</form>						
					</div>

					<div class="pay">
						<form class="pthuc" action="?request=payment_momo" method="post">
							<div>
								<input type="hidden" name="tongtien" value="<?=$tongtien?>">
								<input type="submit" name="btnmomo" id="btnmomo" value="Thanh toán bằng QR MOMO" style="background-color: yellowgreen;">
							</div>		
						</form>	
						<form class="pthuc" action="?request=payment_momoatm" method="post">
							<div>
								<input type="hidden" name="tongtien" value="<?=$tongtien?>">
								<input type="submit" name="btn_momo_atm" id="btn_momo_atm" value="Thanh toán bằng MOMO ATM" style="background-color:darkcyan">
							</div>		
						</form>
					</div>
				</div>
			</div>
				
		</div>
		<?php
			else: echo "<script>window.location = '?request=products'</script>"; 
			endif;
		?>
		
	</div>
</div>


<style>
	.fmpay{
		width: 100%;
	}
	.pay{
		width: 50%;
		float: left;
	}
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
    width: 60%;
    text-align: center;
}

.bphai {
    margin-top: 20px;
    width: 35%;
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
	display: flex;
	justify-content: center;
}

.pthuc h4 {
    padding: 7px;
    font-weight: bold;
}

.pthuc hr {
    width: 90%;
}

.pthuc label {
    width: 95%;
    margin-left: 5%;
}

.pthuc div {
    padding: 10px 0px;
    display: flex;
    justify-content: center;
}

.pthuc input[type=submit] {
    display: block;
    padding: 20px 0px;
    background-color: orangered;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    color: white;
	width: 200px;
	text-align: center;
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