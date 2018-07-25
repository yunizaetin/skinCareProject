<!-- Include SmartWizard CSS -->
<link href="<?php echo base_url() . "assets/plugins" ?>/wizard.css" rel="stylesheet" type="text/css" />
<!--content-->
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<?php $this->load->view('front/dashboard/sidebar'); ?>
			</div>
			<div class="col-sm-9">
				<h1 style="margin: 30px 0">Daftar Keranjang Belanja</h1>
				<div class="panel panel-default">
					<form action="<?php echo site_url() . "front/dashboard/add_pembelian_process" ?>" role="form" data-toggle="validator" method="post" accept-charset="utf-8" onsubmit="return confirm('Yakin sis ngga mau nambah lagi ?')">
						<div class="panel-body">
							<?php $this->load->view('back/include/notification') ?>
							<?php if ( $this->session->userdata('cart') ): ?>
								<div class="tabbable">
								  <ul class="nav nav-tabs wizard">
								    <li class="active focus"><a data-toggle="tab" aria-expanded="false"><span class="nmbr">1</span>Pilih Produk</a></li>
								    <li class="active"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">2</span>Alamat Kirim</a></li>
								    <li class="active"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">3</span>Konfirmasi Bayar</a></li>
								    <li class="active"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">4</span>Monitoring Pengiriman</a></li>
								  </ul>
								</div>
								<table class="table-heading simpleCart_shelfItem default">
									<tr>
										<th width="5%">No</th>
										<th width="50%" class="table-grid">Nama Produk</th>
										<th width="15%">Harga</th>
										<th width="10%">Jumlah </th>
										<th width="15%">Subtotal</th>
										<th width="5%"></th>
									</tr>
									<?php if ($this->session->userdata('cart')): ?>
										<?php foreach ($this->session->userdata('cart')['data'] as $i => $cart): ?>
											<tr>
												<td class="text-center"><?= $i+1 ?></td>
												<td>
													<div class="sed" style="float: none;">
														<h5><a href="<?php echo site_url() . 'front/produk/detail/' . $cart['id'] ?>"><?= $cart['name'] ?></a></h5>
													</div>
													<div class="clearfix"> </div>
												</td>
												<td class="text-right"><?= "Rp " . number_format($cart['price'], 0, ',', '.') ?></td>
												<td class="text-center"><?= $cart['qty'] ?></td>
												<td class="text-right"><?= "Rp " . number_format($cart['price'] * $cart['qty'], 0, ',', '.') ?></td>
												<td class="text-center">
													<a class="btn btn-danger btn-xs" href="<?php echo site_url() . 'front/produk/remove_cart_process/' . $cart['id'] ?>">
														X
													</a>
												</td>
											</tr>
										<?php endforeach ?>
									<?php endif ?>
									<tr>
										<td colspan="3" class="text-center">Jumlah</td>
										<td class="text-center"><?= $this->session->userdata('cart')['count'] ?></td>
										<td class="text-right"><?= $this->session->userdata('cart')['price'] ?></td>
									</tr>
								</table>
							<?php else: ?>
								<div class="text-center">
									<i class="fa fa-shopping-cart fa-5x"></i> <br> <br>
									<h4>Cukup hati jomblo aja yang kosong, keranjangmu jangan, happy shopping sistaaa!</h4>
								</div>
							<?php endif ?>
						</div>
						<div class="panel-footer">
							<div class="clearfix">
								<div class="pull-right">
									<button type="submit" class="btn btn-primary btn">
										Proses Pembelian
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>