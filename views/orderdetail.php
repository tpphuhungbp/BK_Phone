<div class="content">
	<div class="cartoption">
		<div class="cartpage">
			<h2 style="width: 40%">CHI TIẾT ĐƠN ĐẶT HÀNG</h2>
			<?php
				$chitiet = order::get_order();
				if($chitiet): ?>
			<table class="tblone">
				<tr>
					<th style="width: 5%">STT</th>
					<th style="width: 25%">Tên sản phẩm</th>
					<th style="width: 16%">Giá</th>
					<th style="width: 15%">Số lượng</th>
					<th style="width: 20%">Thành tiền</th>
					<th style="width: 7%;">Thời gian</th>
					<th style="width: 12%"></th>
				</tr>	
			<?php
				$i = 0;
				$tongtien = 0;
				while($ketqua = $chitiet->fetch_assoc()):
					$i++;
					$tongtien += $ketqua['price']*$ketqua['amount'];
			?>
				<tr>
					<td class='hang'><?=$i?></td>
					<td class='hang'><?=$ketqua['product_name']?></td>
					<td class='hang'><?=number_format($ketqua['price'])?> VNĐ</td>
					<td class='hang'><?=$ketqua['amount']?></td>
					<td class='hang'><?=number_format($ketqua['price']*$ketqua['amount'])?> VNĐ</td>
					<td class='hang'><?=$ketqua['thoigian']?></td>
					<td class='hang'><a href="?request=details&prodid=<?=$ketqua['product_id']?>">Xem sản phẩm</a></td>			
				</tr>
			<?php endwhile;?>
				<tr style="font-weight: bold;font-size: 20px;">
					<td colspan="3">Tổng tiền</td>
					<td colspan="4"><?=number_format($tongtien)?> VNĐ</td>
				</tr>
			</table>
			<?php else: ?>
				<div class="or">
					<p>CHƯA CÓ ĐƠN ĐẶT HÀNG</p>
					<div class="see">
						<a href="?request=products&page=1">Xem sản phẩm </a>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<style>
	.or p{
		width: 100%;
		text-align: center;
		font-size: 24px;
		font-weight: bold;
		padding: 30px 0px;
	}
	.see{
		width: 100%;
		display: flex;
		justify-content: center;
	}
	.see a{
		display: block;
		width: 200px;
		padding: 10px 0px;
		background-color: orangered;
		text-align: center;
		color: white;
		border: none;
		border-radius: 5px;
	}
	.see a:hover{
		opacity: 0.6;
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
.order table{
	width: 100%;
}
</style>