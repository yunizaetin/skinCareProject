<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" type="text/css" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css" type="text/css" charset="utf-8" />
<script src="<?php echo base_url(); ?>assets/plugins/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.owl-carousel').owlCarousel({
		    loop:true,
		    margin:10,
		    responsiveClass:true,
		    autoplay: true,
		    rewind: true,
		    responsive:{
		        0:{
		            items:1,
		            nav:false
		        },
		        600:{
		            items:2,
		        },
		        1000:{
		            items:3,
		        }
		    }
		});

		//
		// $('.owl-carousel .item').hover(function() {
		// 	console.log($(this).find('h4').html())
		// 	$(this).find('.desc').show('medium');
		// }, function() {
		// 	console.log('y')
		// 	$(this).find('.desc').hide('medium');
		// });
	});
</script>
<!--content-->
<div class="content">
	<div class="container">
	<!--products-->
	<div class="content-mid">
		<div class="owl-carousel owl-theme">
			<?php foreach ($rs_banner as $index => $produk): ?>
			    <div class="item" style="position: relative;">
			    	<img src="<?= base_url() . $produk['url'] ?>" class="img-responsive">
			    	<h4 class="desc" style="background-color: rgba(0,0,0,.2); color: #fff; padding: 30px; text-align: center; position: absolute; bottom: 0; width: 100%"><?= $produk['keterangan'] ?></h4>
			    </div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="content-mid">
		<h3>Produk Terpopuler</h3>
		<label class="line"></label>
		   <div class="mid-popular">
		      <div class="row">
	            <div class="row">
		      	<?php foreach ($rs_populer as $index => $produk): ?>
		      		<div class="col-md-3 item-grid1 simpleCart_shelfItem">
		      		   <div class=" mid-pop">
		      		      <div class="pro-img">
		      		         <img src="<?php echo base_url() . $produk['image'] ?>" class="img-responsive" alt="">
		      		         <div class="zoom-icon ">
		      		            <!-- <a class="picture" href="images/pc.jpg" rel="title" class="b-link-stripe b-animate-go  thickbox"><i class="glyphicon glyphicon-search icon "></i></a> -->
		      		            <a href="<?php echo site_url() . 'front/produk/detail/' . $produk['id_produk'] ?>"><i class="glyphicon glyphicon-menu-right icon"></i></a>
		      		         </div>
		      		      </div>
		      		      <div class="mid-1">
		      		         <div class="women">
		      		            <div class="women-top">
		      		               <small><span><?php echo $produk['nama_kategori'] ?></span></small>
		      		               <h6>
		      		               	<a href="<?php echo site_url() . 'front/produk/detail/' . $produk['id_produk'] ?>">
		      		               		<?php echo $produk['nama_produk'] ?>
		      		               	</a>
		      		               	</h6>
		      		            </div>
		      		         	<div class="img item_add">
		      		         	   <a href="#"><img src="images/ca.png" alt=""></a>
		      		         	</div>
		      		         	<div class="clearfix"></div>
		      		         </div>
		      		         <div class="mid-2 clearfix">
		      		            <p ><em class="item_price">Rp <?php echo $produk['harga'] ?></em></p>
		      		         </div>
		      		      </div>
		      		   </div>
		      		</div>
	               <?php if (($index+1) % 4 == 0): ?>
	               </div>
	               <div class="row">
	               <?php endif ?>
		            <?php endforeach ?>
	               </div>
		      </div>
		   </div>
	</div>

	<div class="content-mid">
		<h3>Produk Terbaru</h3>
		<label class="line"></label>
		   <div class="mid-popular">
		      <div class="row">
	            <div class="row">
		      	<?php foreach ($rs_new as $index => $produk): ?>
		      		<div class="col-md-3 item-grid1 simpleCart_shelfItem">
		      		   <div class=" mid-pop">
		      		      <div class="pro-img">
		      		         <img src="<?php echo base_url() . $produk['image'] ?>" class="img-responsive" alt="">
		      		         <div class="zoom-icon ">
		      		            <!-- <a class="picture" href="images/pc.jpg" rel="title" class="b-link-stripe b-animate-go  thickbox"><i class="glyphicon glyphicon-search icon "></i></a> -->
		      		            <a href="<?php echo site_url() . 'front/produk/detail/' . $produk['id_produk'] ?>"><i class="glyphicon glyphicon-menu-right icon"></i></a>
		      		         </div>
		      		      </div>
		      		      <div class="mid-1">
		      		         <div class="women">
		      		            <div class="women-top">
		      		               <small><span><?php echo $produk['nama_kategori'] ?></span></small>
		      		               <h6>
		      		               	<a href="<?php echo site_url() . 'front/produk/detail/' . $produk['id_produk'] ?>">
		      		               		<?php echo $produk['nama_produk'] ?>
		      		               	</a>
		      		               	</h6>
		      		            </div>
		      		         	<div class="img item_add">
		      		         	   <a href="#"><img src="images/ca.png" alt=""></a>
		      		         	</div>
		      		         	<div class="clearfix"></div>
		      		         </div>
		      		         <div class="mid-2 clearfix">
		      		            <p ><em class="item_price">Rp <?php echo $produk['harga'] ?></em></p>
		      		         </div>
		      		      </div>
		      		   </div>
		      		</div>
	               <?php if (($index+1) % 4 == 0): ?>
	               </div>
	               <div class="row">
	               <?php endif ?>
		            <?php endforeach ?>
	               </div>
		      </div>
		   </div>
	</div>
	</div>
</div>