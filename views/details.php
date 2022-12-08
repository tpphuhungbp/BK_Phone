<?php
	if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['addtocart']) && $_POST['addtocart']){
        $amount = (int)$_POST['amount'];
		$id = (int)$_POST['product_id'];
		//thêm vào giỏ hàng
		$addtocart = cart::addtocart($id,$amount);
		$_SESSION['tongsp'] = cart::get_amount();
		echo "<meta http-equiv='refresh' content='0'>";
	}else if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['update_view'])){
		$id = $_POST['updateview_id'];
		$updateview = product::update_view($id);
	}
?>
<div class="content" style="height:150vh">
	<div class="section group">
		<div class="cont-desc span_1_of_2">
			<?php
				if(isset($_GET['request'])=="details" && isset($_GET['prodid'])):
					$id = $_GET['prodid'];
					$getprod = product::getprodbyid($id);
					if($getprod && $getprod!=null):
						while($ketqua = $getprod->fetch_assoc()):
			?>
			<div class="grid images_3_of_2">
				<img src="<?=$ketqua['image']?>" alt="" />
			</div>
			<div class="desc span_3_of_2">
				<h2><?=$ketqua['product_name']?></h2>
				<p><?=$ketqua['description']?></p>					
				<div class="price">
					<p>Giá: <span><?=number_format($ketqua['price'])?> VNĐ</span></p>
					<?php
						$getcatname = category::getcatebyId($ketqua['id_category']);
						if(isset($getcatname)):
							while($kq = $getcatname->fetch_assoc()):
					?>
					<p>Loại sản phẩm: <span><?=$kq['cate_name']?></span></p>
					<?php endwhile; endif; ?>
				</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="hidden" name="product_id" value="<?=$ketqua['id']?>">
						<input type="number" class="buyfield" name="amount" value="1" min="1" max="99" /> <br> <br>
						<?php
							if($ketqua['status']==1):
						?>
						<input type="submit" class="buysubmit" name="addtocart" value="Thêm vào giỏ hàng"/>
						<p style='color: green;font-size: 18px;padding: 10px 0px;'><?php if(isset($addtocart)){echo $addtocart;}?></p>
						<?php else: ?>
						<label for="">Hết hàng</label>
						<?php endif; ?>
					</form>				
				</div>
			</div>
			<?php endwhile; else: echo "<script>window.location = './'</script>";?>
			<?php endif; endif; ?>	
		</div>
		<div class="rightsidebar span_3_of_1">
			<h2>PHÂN LOẠI SẢN PHẨM:</h2>
			<ul>
				<?php 
					$get_cate = category::get_category();
               		if($get_cate):
                    while($ketqua=$get_cate->fetch_assoc()):
				?>
					<li><a href="?request=productbycat&catid=<?=$ketqua['id']?>&page=1"><?=$ketqua['cate_name']?></a></li>
				<?php endwhile; endif; ?>
			</ul>
		</div>
	</div>
	<div class = "comment_div">
		<h2>Bình luận</h2>
		<br>
		<?php
			if(isset($_SESSION['user_login']) && $_SESSION['user_login']==true):
				$cur_user_id = $_SESSION['user_id'];
				$getcuruserbyid = user::getuserbyid($cur_user_id);
				$kq_cur_user = $getcuruserbyid->fetch_assoc();
		?>
		<div class="comment-items">
			<div class="comment-item-left">
				<img src="images/login.png" alt="" width='50%'>
			</div>
			<div class="comment-item-right">
				<p class="comment-user"> <?= $kq_cur_user['name'] ?></p>
				<form id='createComment'  method="post">

					<input id="nameForm" type="hidden" value="<?= $kq_cur_user['name'] ?>">
					<input id="useridForm" type="hidden" value="<?= $cur_user_id ?>">
					
					<label for="comment-score">Score: </label>
					<input type="number" id="comment-score" min="1" max="5">
					<br>
					<label for="comment-comment">Comment: </label>
					<input type="text" id="comment-comment">
					<br>
					<input class="btn btn-primary btn-md" type="submit" value="Submit"></input>
				</form>
			</div>
		</div>
		<div id="newComment">
	</div>
	<?php endif; ?>
		


		<?php
			$getcommentbyuserid = comment::get_comment_byPid($id);
			if(isset($getcommentbyuserid)&&$getcommentbyuserid!=null):
				while($kq = $getcommentbyuserid->fetch_assoc()):
					$getuserbyid = user::getuserbyid($kq['user_id']);
					$kq_user = $getuserbyid->fetch_assoc();
		?>
		<div class="comment-items">
			<div class="comment-item-left">
				<img src="images/login.png" alt="" width='50%'>
			</div>
			<div class="comment-item-right">
				<p class="comment-user"> <?= $kq_user['name'] ?></p>
				<p class="comment-user"> <?php for( $i=0; $i<$kq['score']; $i++) echo '⭐'  ?></p>

				<p class="comment-time"> <?= $kq['time'] ?></p>
				<p class="comment-comment"> <?= $kq['comment'] ?></p>
			</div>
		</div>
		<hr class="comment-hr">
		<?php endwhile; endif; ?>
	</div>
</div>


<style>
	.newComment{
		width: 100%;
	}
	.hidden{
		display: none;
	}
	.comment-items{
		display:flex;
		flex-direction:row;
		flex-wrap:wrap;
		margin-bottom:2%;
	}
	.comment-item-left{
		flex-basis:5%
	}
	.comment-item-left img{
		border:1px solid black;
		border-radius: 20px;
	}

	.comment-item-right{
		flex-basis:90%
	}
	.comment-user{
		font-weight:700;
	}
	.comment-time{
		margin-top:1%;
		margin-bottom:1%;
		font-weight:100;
		color:gray;
		font-size:14px;
	}
	.comment-comment{
		font-weight:500;
	}
	.comment-hr{
		width:90%;
		margin-bottom:1.5%;
	}

	.images_3_of_2{
            overflow: hidden; /** DÒNG BẮT BUỘC CÓ **/
		    position: relative;
            display: block;
        }
        .images_3_of_2 img {
		height: 100%;
		width: 100%;
		transition: all 1s;
	}
        .images_3_of_2:hover img {
            -webkit-transform: scale(1.3);
                    transform: scale(1.3);
        }
</style>



<!-- --------------------------------------- ajax ----------------------------------------- -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#createComment').submit(function(e) {
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: 'ajax/comment.php',
				data:{
					score: $('#comment-score').val(),
					comment:$('#comment-comment').val(),
					time:'current time',
					name: $('#nameForm').val(),
					user_id: $('#useridForm').val()
				},
				success: function(response)
				{
					$('#newComment').html(response);
					$('#comment-score').val("");
					$('#comment-comment').val("");
				}
			});
		});
	});
</script>
