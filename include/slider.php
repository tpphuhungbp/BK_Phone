<?php
	include_once"./model/mslider.php";
?>
<div class="header_bottom">
		<div class="header_bottom_left">
			<img id="anh" src="https://www.chili.vn/blogs/wp-content/uploads/2018/04/14-chieu-khuyen-mai-giup-ban-bung-no-doanh-so-03-e1523256143314.jpg" alt="">
			<style>
				#anh{
					width: 100%;
					height: 310px;
					margin-top: 9px;
				}
			</style>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php 
							$slider = slider::get_slider_show();
							if($slider):
								while($kq = $slider->fetch_assoc()):
						?>
						<li><img src="<?=$kq['image']?>" alt=""/></li>
						<?php endwhile; endif; ?>
				    </ul>
					<style>
						.slides img{
							width: 100%;
							height: 310px;
						}
					</style>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>