<?php
	if($_SERVER['REQUEST_METHOD']==="POST"){
		if(isset($_POST['xoa_cart'])){
			$id = $_POST['deleteid'];
			$xoa_cart = cart::delete($id);
		}elseif(isset($_POST['updatecart'])){
			$amount = $_POST['number'];
			$id = $_POST['updateid'];
			$update_cart = cart::updatecart($id,$amount);
		}
		$_SESSION['tongsp'] = cart::get_amount();	
	}
?>
<div class="content">
	<div class="cartoption">		
		<div class="cartpage">
			<h2 style="width: 50%">GIỎ HÀNG &emsp;&emsp; <a href="?request=orderdetail">Chi tiết đơn đặt hàng</a></h2>
			<table class="tblone">
				<?php
					if(isset($_SESSION['user_login']) && $_SESSION['user_login']==true):
						$id = $_SESSION['user_id'];
						$getcartbyuserid = cart::getcartbyuserid($id);
						if(isset($getcartbyuserid)&&$getcartbyuserid!=null):
				?>
				<tr>
					<th width="">STT</th>
					<th width="20%">Tên sản phẩm</th>
					<th width="25%">Hình ảnh</th>
					<th width="15%">Giá</th>
					<th width="15%">Số lượng</th>
					<th width="15%">Thành tiền</th>
					<th width="10%"></th>
				</tr>
				<?php	
						$tongtien = 0;
						$i=0;
						while($kq = $getcartbyuserid->fetch_assoc()):
							$i++;
							$tongtien += $kq['price']*$kq['amount'];
				?>
				<tr>
					<td><?=$i?></td>
					<td><?=$kq['product_name']?></td>
					<td><img src="<?=$kq['image']?>" alt="" style="width:30%;height: auto;" /></td>
					<td><?=number_format($kq['price'])?> VNĐ</td>
					<td>
						<form action="" method="post">
							<input type="hidden" name='updateid' value="<?=$kq['id']?>">
							<input style="padding: 5px;" type="number" name="number" value="<?=$kq['amount']?>" min="1" max="99"/>
							<input type="submit" name="updatecart" value="Cập nhật"/>
						</form>
					</td>
					<td><?=number_format(($kq['price']*$kq['amount']))?> VNĐ</td>
					<td>
						<form action="" method="post">
							<input type="hidden" name='deleteid' value="<?=$kq['id']?>">
							<input type="submit" onclick="return confirm('Bạn có muốn xóa sản phẩm này khỏi giỏ hàng!')" name="xoa_cart" value="Xóa">
						</form>
					</td>
				</tr>
				<?php endwhile; ?>
				<table class="total">
					<tr>
						<th>Tổng tiền : </th>
						<th><?php if(isset($tongtien)) echo number_format($tongtien); ?> VNĐ</th>
					</tr>						
				</table>
				<?php else: ?>
				<div>
					<p style="text-align: center; font-size: 18px;font-weight: bold;">Giỏ hàng của bạn rỗng!</p>
					<div id="giohang_rong">
						<a href="?request=products&page=1">Xem sản phẩm</a>
					</div>
				</div>
				<?php
					endif;
					else:
						$getcart = cart::getcart();
						if(isset($getcart)&&$getcart!=null): 
				?>
				<tr>
					<th>STT</th>
					<th width="20%">Sản phẩm</th>
					<th width="25%">Hình ảnh</th>
					<th width="15%">Giá</th>
					<th width="15%">Số lượng</th>
					<th width="15%">Thành tiền</th>
					<th width="10%"></th>
				</tr>
				<?php
						$tongtien = 0;
						$i =0;
						while($ketqua = $getcart->fetch_assoc()):
							$i++;
							$tongtien += $ketqua['price']*$ketqua['amount'];

				?>
				<tr>
					<td><?=$i?></td>
					<td><?=$ketqua['product_name']?></td>
					<td><img src="<?=$ketqua['image']?>" alt="" style="width: 30%;height: auto;" /></td>
					<td><?=number_format($ketqua['price'])?> VNĐ</td>
					<td>
						<form action="" method="post">
							<input type="hidden" name='updateid' value="<?=$ketqua['id']?>">
							<input style="padding: 5px;" type="number" name="number" value="<?=$ketqua['amount']?>" min="1" max="99"/>
							<input type="submit" name="updatecart" value="Cập nhật"/>
						</form>
					</td>
					<td><?=number_format(($ketqua['price']*$ketqua['amount']))?> VNĐ</td>
					<td>
						<form action="" method="post">
							<input type="hidden" name='deleteid' value="<?=$ketqua['id']?>">
							<input type="submit" onclick="return confirm('Bạn có muốn xóa sản phẩm này khỏi giỏ hàng!')" name="xoa_cart" value="Xóa">
						</form>
					</td>
				</tr>
				<?php endwhile; ?>
				<table class="total">
					<tr>
						<th>Tổng tiền : </th>
						<th><?php if(isset($tongtien)) echo number_format($tongtien); ?> VNĐ</th>
					</tr>						
				</table>
				<?php else:?>
					<div>
						<p style="text-align: center; font-size: 18px;font-weight: bold;">Giỏ hàng của bạn rỗng!</p>
						<div id="giohang_rong">
							<a href="?request=products&page=1">Xem sản phẩm</a>
						</div>
					</div>
				<?php endif; endif;?>
			</table>
			<div class="shopping">
				<?php if(isset($getcart)&&$getcart!=null || isset($getcartbyuserid) && $getcartbyuserid!=null):?>
					<div class="shopleft">
					<a href="?request=products"><i class="fa-solid fa-angles-left"></i> Tiếp tục mua sắm</a>
				</div>
				<div class="shopright">
					<a href="?request=order">Tiến hàng đặt hàng <i class="fa-solid fa-angles-right"></i></a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>  	
</div>
<style>
	.total{
		float:right;
		text-align:left;
		margin: 20px 0px;
		font-size: 18px;
		font-weight: bold;
		width: 40%
	}
	.total th{
		padding: 10px;
		text-align: center;
	}
	.tblone{
		width: 100%;
		border: 1px solid black;
	}
	table,td,th{
		border: 1px solid black;
	}
#giohang_rong{
	margin: 10px 0px;
	width: 100%;
	display: flex;
	align-items: center;
	justify-content: center;
}
#giohang_rong a{
	text-align: center;
	display: block;
	width: 200px;
	padding: 10px 30px;
	background-color: lightskyblue;
	border: none;
	border-radius: 5px;
}
#giohang_rong a:hover{
	opacity: 0.6;
}
</style>