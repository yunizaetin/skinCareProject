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
					<form action="<?=site_url()?>front/riwayat/delete_process" method="post" onsubmit="return confirm('Transaksi yang sudah dihapus tidak dapat dikembalikan lagi. Hapus transaksi ini?')">
						<div class="panel-body">
							<?php $this->load->view('back/include/notification') ?>
							<p class="text-danger">
								* Transaksi yang sudah dihapus tidak dapat dikembalikan lagi. Yakin mau hapus transaksi ini?
							</p>
							<input type="hidden" name="id_pembelian" value="<?= $detail['id_pembelian'] ?>">
							<table width='100%' style="font-size:11px;" class="custom">
	    					    <tr>
	    					        <td width='25%'>
	    					            <b>No. Resi</b>
	    					        </td>
	    					        <td width='3%'>:</td>
	    					        <td width='72%'><?php if($detail['status_pembelian'] == "Sedang diproses") echo $detail['status_pembelian']; echo $detail['no_resi'] ?></td>
	    					    </tr>
	    					    <tr>
	    					        <td width='25%'>
	    					            <b>Tanggal Kirim</b>
	    					        </td>
	    					        <td width='3%'>:</td>
	    					        <td width='72%'><?php if($detail['status_pembelian'] == "Sedang diproses") echo $detail['status_pembelian']; echo $detail['tgl_kirim'] ?></td>
	    					    </tr>
	    					    <tr>
	    					        <td width='25%'>
	    					            <b>Keterangan Pengiriman</b>
	    					        </td>
	    					        <td width='3%'>:</td>
	    					        <td width='72%'><?php if($detail['status_pembelian'] == "Sedang diproses") echo $detail['status_pembelian']; echo $detail['ket_kirim'] ?></td>
	    					    </tr>
	    					</table>
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
							            <b>Daftar Produk</b>
							        </td>
							        <td width='3%'>:</td>
							        <td width='72%'>
			        		        	<?php foreach ($detail['detail'] as $i => $cart): ?>
			        		        		<?= $cart['nama_produk'] ?> (<?= $cart['jumlah'] ?>) <br>
			        	        		<?php endforeach ?>
							        </td>
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
							    <tr>
							        <td width='100%' colspan="3">&nbsp;</td>
							    </tr>
							    <tr>
							        <td width='25%'>
							            <b>Nama Pemilik</b>
							        </td>
							        <td width='3%'>:</td>
							        <td width='72%'><?= $detail['nama'] ?></td>
							    </tr>
							    <tr>
							        <td width='25%'>
							            <b>No. Handphone</b>
							        </td>
							        <td width='3%'>:</td>
							        <td width='72%'><?= $detail['no_hp'] ?></td>
							    </tr>
							    <tr>
							        <td width='25%'>
							            <b>Detail Alamat</b>
							        </td>
							        <td width='3%'>:</td>
							        <td width='72%'><?= $detail['detail_alamat'] ?></td>
							    </tr>
							    <tr>
							        <td width='100%' colspan="3">&nbsp;</td>
							    </tr>
							    <tr>
							        <td width='25%'>
							            <b>No. Rekening</b>
							        </td>
							        <td width='3%'>:</td>
							        <td width='72%'><?= $detail['no_rek'] ?></td>
							    </tr>
							    <tr>
							        <td width='25%'>
							            <b>Atas Nama</b>
							        </td>
							        <td width='3%'>:</td>
							        <td width='72%'><?= $detail['atas_nama'] ?></td>
							    </tr>
							    <tr>
							        <td width='25%'>
							            <b>Jumlah Transfer</b>
							        </td>
							        <td width='3%'>:</td>
							        <td width='72%'><?= "Rp " . number_format($detail['jml_bayar'], 0, ',', '.') ?></td>
							    </tr>
							    <tr>
							        <td width='25%'>
							            <b>Nama Bank</b>
							        </td>
							        <td width='3%'>:</td>
							        <td width='72%'><?= $detail['bank_tujuan'] ?></td>
							    </tr>
							    <tr>
							        <td width='25%'>
							            <b>Tanggal Transfer</b>
							        </td>
							        <td width='3%'>:</td>
							        <td width='72%'><?= $this->dtm->get_full_date($detail['tgl_bayar']) ?></td>
							    </tr>
							    <tr>
							        <td width='25%'>
							            <b>Keterangan</b>
							        </td>
							        <td width='3%'>:</td>
							        <td width='72%'><?= $detail['keterangan'] ?></td>
							    </tr>
							</table>
						</div>
						<div class="panel-footer clearfix">
							<div class="pull-right">
								<button type="submit" class="btn btn-danger">
									<i class="fa fa-trash"></i> Hapus Transaksi
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>