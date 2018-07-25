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
						<!-- SmartWizard html -->
						<div class="tabbable">
						  <ul class="nav nav-tabs wizard">
						    <li class="active completed"><a data-toggle="tab" aria-expanded="false"><span class="nmbr">1</span>Pilih Produk</a></li>
						    <li class="active completed"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">2</span>Alamat Kirim</a></li>
						    <li class="active completed"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">3</span>Konfirmasi Bayar</a></li>
						    <li class="active focus"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">4</span>Monitoring Pengiriman</a></li>
						  </ul>
						</div>
						<div class="panel panel-primary">
							<div class="panel-body">
								<p>
									Untuk melihat detail transaksi klik tombol di bawah ini <br>
									<div class="clearfix">
										<div class="pull-right">
											<!-- Button trigger modal -->
											<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#detail-modal">
											  Detail Transaksi
											</button>
										</div>
									</div>
								</p>

								<!-- Modal -->
								<div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="detail-modalLabel">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="detail-modalLabel">Riwayat Transaksi</h4>
								      </div>
								      <div class="modal-body">
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
								      <div class="modal-footer">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								      </div>
								    </div>
								  </div>
								</div>
								
							</div>
						</div>
						<h4 class="text-center">Monitoring</h4>
						<table width='100%' style="font-size:11px;" class="custom">
    					    <tr>
    					        <td width='25%'>
    					            <b>No. Resi</b>
    					        </td>
    					        <td width='3%'>:</td>
    					        <td width='72%'><?php if($detail['status_pembelian'] == "Sedang diproses") echo $detail['status_pembelian']; else echo $detail['no_resi'] ?></td>
    					    </tr>
    					    <tr>
    					        <td width='25%'>
    					            <b>Tanggal Kirim</b>
    					        </td>
    					        <td width='3%'>:</td>
    					        <td width='72%'><?php if($detail['status_pembelian'] == "Sedang diproses") echo $detail['status_pembelian']; else echo ($detail['tgl_kirim'] ? $this->dtm->get_full_date($detail['tgl_kirim']) : '') ?></td>
    					    </tr>
    					    <tr>
    					        <td width='25%'>
    					            <b>Keterangan Pengiriman</b>
    					        </td>
    					        <td width='3%'>:</td>
    					        <td width='72%'><?php if($detail['status_pembelian'] == "Sedang diproses") echo $detail['status_pembelian']; else echo $detail['ket_kirim'] ?></td>
    					    </tr>
    					</table>
					</div>
					<?php if ( $detail['status_pembelian'] != "Sudah dikirim" && $detail['status_pembelian'] != "Selesai" ): ?>
						<div class="panel-footer">
							<div class="clearfix">
								<div class="pull-right">
									<a href="<?php echo site_url() . 'front/riwayat/Konfirmasi/' . $detail['id_pembelian'] ?>" class="btn btn-primary">
										Sebelumnya
									</a>
								</div>
							</div>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>