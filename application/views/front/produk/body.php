<!--banner-->
<div class="banner-top">
   <div class="container">
      <h1><?php echo $kategori['nama_kategori'] ?></h1>
      <em></em>
      <h2><a href="<?php echo site_url() ?>">Beranda</a><label>/</label><?php echo $kategori['nama_kategori'] ?></a></h2>
   </div>
</div>

<!--content-->
<div class="product">
   <div class="container">
      <div class="row">
      	<div class="col-md-12">
      	   <div class="mid-popular">
      	      <div class="row">
                  <div class="row">
      	      	<?php foreach ($rs_produk as $index => $produk): ?>
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
   <!--products-->
   <!--//products-->
</div>
