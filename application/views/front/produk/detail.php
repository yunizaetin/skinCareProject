<script type="text/javascript">
	jQuery(document).ready(function($) {
		var stok = <?= $produk['stok']?:0 ?>;
		$('.value-plus').on('click', function(){
			var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
			if (newVal <= stok) divUpd.text(newVal);
		});
		
		$('.value-minus').on('click', function(){
			var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
			if(newVal>=0) divUpd.text(newVal);
		});

		$('.item_add').click(function(event) {
			if ( $('.quantity-select').find('div.entry.value').text() == "0" ) alert( "Eitsss pilih dulu sis produk yang mau dibeli!" );
			else window.location = $(this).attr('data-url') + '/' + $('.quantity-select').find('div.entry.value').text();
		});
	});
</script>
<!--banner-->
<div class="banner-top">
   <div class="container">
      <h1><?php echo $produk['nama_produk'] ?></h1>
      <em></em>
      <h2><a href="<?php echo site_url() ?>">Beranda</a><label>/</label><a href="<?php echo site_url('front/produk/index/'.$produk['id_menu']) ?>">Produk</a><label>/</label><?php echo $produk['nama_produk'] ?></h2>
   </div>
</div>
<div class="single">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="col-md-5 grid">
					<img src="<?php echo base_url().'uploads/'.$produk['url_image'] ?>" class="img-responsive">
				</div>
				<div class="col-md-7 single-top-in">
					<div class="span_2_of_a1 simpleCart_shelfItem">
						<h3><?php echo $produk['nama_produk'] ?></h3>
						<div class="price_single">
							<span class="reducedfrom item_price">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></span>
							<div class="clearfix"></div>
						</div>
						<!-- <h4 class="quick">Quick Overview:</h4> -->
						<p class="quick_desc">
							<?php echo $produk['ket_produk'] ?>
						</p>
						<!--
						<div class="row">
							<div class="col-xs-6 text-left">
								Berat
							</div>
							<div class="col-xs-6 text-right">
								<?= $produk['berat']?:'-' ?>
							</div>
						</div>
						-->
						<div class="row">
							<div class="col-xs-3 text-left">
								Stok Barang
							</div>
							<div class="col-xs-2 text-right">
								<?= $produk['stok']?:'<span class="text-danger">Habis</span>' ?>
							</div>
						</div>
						<div class="quantity">
							<div class="quantity-select">
								<div class="entry value-minus">&nbsp;</div>
								<div class="entry value" style="background-color: #fff; color: #000">0</div>
								<div class="entry value-plus active">&nbsp;</div>
							</div>
						</div>
						<?php if ( $produk['stok'] ): ?>
							<button data-url="<?php echo site_url() . 'front/produk/add_cart/' . $produk['id_produk'] ?>" class="add-to item_add hvr-skew-backward">Add to cart</button>
						<?php endif ?>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"> </div>
				<br>
			</div>
		</div>
	</div>
	</div>
</div>