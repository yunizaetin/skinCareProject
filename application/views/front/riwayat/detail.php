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
				<!-- <h1 style="margin: 30px 0">Riwayat Transaksi</h1> -->
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<div class="pull-right">
							<a href="<?=site_url()?>front/riwayat" class="btn btn-default">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</div>
					</div>
					<div class="panel-body">
						<?php $this->load->view('back/include/notification') ?>
						<div class="tabbable">
						  <ul class="nav nav-tabs wizard">
						    <li class="active focus"><a data-toggle="tab" aria-expanded="false"><span class="nmbr">1</span>Pilih Produk</a></li>
						    <li class="active"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">2</span>Alamat Kirim</a></li>
						    <li class="active"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">3</span>Konfirmasi Bayar</a></li>
						    <li class="active"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">4</span>Monitoring Pengiriman</a></li>
						  </ul>
						</div>
						<div class="panel panel-primary">
							<div class="panel-body">
								<table width='100%' style="font-size:11px;" class="custom">
								    <tr>
								        <td width='25%'>
								            <b>Tanggal Transaksi</b>
								        </td>
								        <td width='3%'>:</td>
								        <td width='72%'><?= $this->dtm->get_full_date($detail['tgl_pembelian']) ?></td>
								    </tr>
								    <tr>
								        <td width='25%'>
								            <b>Total Biaya</b>
								        </td>
								        <td width='3%'>:</td>
								        <td width='72%'><?= "Rp " . number_format($detail['total_bayar'], 0, ',', '.') ?></td>
								    </tr>
								    <tr>
								        <td width='25%'>
								            <b>Status Pembayaran</b>
								        </td>
								        <td width='3%'>:</td>
								        <td width='72%'><?= $detail['status_bayar'] ?></td>
								    </tr>
								    <tr>
								        <td width='25%'>
								            <b>Status Pembelian</b>
								        </td>
								        <td width='3%'>:</td>
								        <td width='72%'><?= $detail['status_pembelian'] ?></td>
								    </tr>
								</table>
							</div>
						</div>
						<table class="table-condensed table-heading simpleCart_shelfItem default">
							<tr>
								<th width="5%">No</th>
								<th width="55%">Nama Produk</th>
								<th width="15%">Harga</th>
								<th width="10%">Jumlah </th>
								<th width="15%">Subtotal</th>
							</tr>
							<?php foreach ($detail['detail'] as $i => $cart): ?>
								<tr>
									<td class="text-center"><?= $i+1 ?></td>
									<td>
										<div class="sed" style="float: none;">
											<h5><a href="<?php echo site_url() . 'front/produk/detail/' . $cart['id_produk'] ?>"><?= $cart['nama_produk'] ?></a></h5>
										</div>
										<div class="clearfix"> </div>
									</td>
									<td class="text-right"><?= "Rp " . number_format($cart['harga'], 0, ',', '.') ?></td>
									<td class="text-center"><?= $cart['jumlah'] ?></td>
									<td class="text-right"><?= "Rp " . number_format($cart['harga'] * $cart['jumlah'], 0, ',', '.') ?></td>
								</tr>
							<?php endforeach ?>
							<tr>
								<td colspan="4" class="text-center">Jumlah</td>	
								<td colspan="4" class="text-right">Rp <?= number_format($detail['total_bayar'], 0, ',', '.') ?></td>	
							</tr>
						</table>
					</div>
					<div class="panel-footer">
						<div class="clearfix">
							<div class="pull-right">
								<a href="<?php echo site_url() . 'front/riwayat/alamat/' . $detail['id_pembelian'] ?>" class="btn btn-primary">
									Selanjutnya
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>