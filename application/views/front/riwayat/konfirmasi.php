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
					<form action="<?php echo site_url() . "front/riwayat/update_konfirmasi_process" ?>" role="form" data-toggle="validator" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<div class="panel-body">
							<?php $this->load->view('back/include/notification') ?>
							<!-- SmartWizard html -->
							<div class="tabbable">
							  <ul class="nav nav-tabs wizard">
							    <li class="active completed"><a data-toggle="tab" aria-expanded="false"><span class="nmbr">1</span>Pilih Produk</a></li>
							    <li class="active completed"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">2</span>Alamat Kirim</a></li>
							    <li class="active focus"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">3</span>Konfirmasi Bayar</a></li>
							    <li class="active"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">4</span>Monitoring Pengiriman</a></li>
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
							<div class="panel panel-danger">
								<div class="panel-heading">
									<h3 class="panel-title">Silahkan Transfer ke Rekening berikut</h3>
								</div>
								<div class="panel-body">
									<div class="form-group row">
										<label class="control-label col-md-3">No. Rekening Tansfer</label>
										<div class="col-md-9">
											<?php echo $transfer_rekening ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="control-label col-md-3">Atas Nama</label>
										<div class="col-md-9">
											<?php echo $transfer_an ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="control-label col-md-3">Total Pembayaran</label>
										<div class="col-md-9">
											<?= "Rp " . number_format($detail['total_bayar'], 0, ',', '.') ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="control-label col-md-3">Batas Pembayaran</label>
										<div class="col-md-9">
											<?= $this->dtm->get_full_date($detail['expire']) ?>
										</div>
									</div>
									
								</div>
							</div>
							<br>
							<p>
								Isikan bukti pembayaran di bawah ini untuk memudahkan staff kami mengonfirmasi pembayaran :
							</p>
							<br>
					        <div class="form-horizontal">
	        			        <input type="hidden" name="id_pembelian" value="<?= $detail['id_pembelian'] ?>" />
	        			        <input type="hidden" name="id_konfirmasi" value="<?= $detail['id_konfirmasi'] ?>" />
	        	                <div class="form-group row">
	        	                	<label class="control-label col-md-3">No. Rekening</label>
	        	                	<div class="col-md-5">
	        	                		<input type="text" name="no_rek" class="form-control" value="<?php echo $this->session->flashdata('temp_result') ? $this->session->flashdata('temp_result')['no_rek'] : $detail['no_rek'] ?>" maxlength="100">
	        	                		<small class="text-danger">*Wajib Diisi!</small>
	        	                	</div>
	        	                </div>
	        	                <div class="form-group row">
	        	                	<label class="control-label col-md-3">Atas Nama</label>
	        	                	<div class="col-md-5">
	        	                		<input type="text" name="atas_nama" class="form-control" value="<?php echo $this->session->flashdata('temp_result') ? $this->session->flashdata('temp_result')['atas_nama'] : $detail['atas_nama'] ?>" maxlength="30">
	        	                		<small class="text-danger">*Wajib Diisi!</small>
	        	                	</div>
	        	                </div>
	        	                <div class="form-group row">
	        	                	<label class="control-label col-md-3">Jumlah Transfer</label>
	        	                	<div class="col-md-3">
		        	                	<div class="input-group">
		        	                	  <span class="input-group-addon">Rp </span>
		        	                	  <input type="number" name="jml_bayar" class="form-control" value="<?php echo $this->session->flashdata('temp_result') ? $this->session->flashdata('temp_result')['jml_bayar'] : $detail['jml_bayar'] ?>">
		        	                	</div>
	        	                		<small class="text-danger">*Wajib Diisi!</small>
	        	                	</div>
	        	                </div>
	        	                <div class="form-group row">
	        	                	<label class="control-label col-md-3">Bank Tujuan</label>
	        	                	<div class="col-md-4">
	        	                		<select name="bank_tujuan" class="form-control">
	        	                			<option value="" >
	        	                				-- Pilih BANK --
	        	                			</option>
	        	                			<option value="MANDIRI" <?php if ( (isset($this->session->flashdata('temp_result')['bank_tujuan']) && $this->session->flashdata('temp_result')['bank_tujuan'] == "MANDIRI") || ($detail['bank_tujuan'] == "MANDIRI") ): ?>
	        	                				selected
	        	                			<?php endif ?>>
	        	                				MANDIRI
	        	                			</option>
	        	                			<option value="BNI" <?php if ((isset($this->session->flashdata('temp_result')['bank_tujuan']) && $this->session->flashdata('temp_result')['bank_tujuan'] == "BNI") || ($detail['bank_tujuan'] == "BNI")): ?>
	        	                				selected
	        	                			<?php endif ?>>
	        	                				BNI
	        	                			</option>
	        	                			<option value="BCA" <?php if ((isset($this->session->flashdata('temp_result')['bank_tujuan']) && $this->session->flashdata('temp_result')['bank_tujuan'] == "BCA") || ($detail['bank_tujuan'] == "BCA")): ?>
	        	                				selected
	        	                			<?php endif ?>>
	        	                				BCA
	        	                			</option>
	        	                			<option value="BRI" <?php if ((isset($this->session->flashdata('temp_result')['bank_tujuan']) && $this->session->flashdata('temp_result')['bank_tujuan'] == "BRI") || ($detail['bank_tujuan'] == "BRI")): ?>
	        	                				selected
	        	                			<?php endif ?>>
	        	                				BRI
	        	                			</option>
	        	                		</select>
	        	                		<small class="text-danger">*Wajib Diisi!</small>
	        	                	</div>
	        	                </div>
	        	                <div class="form-group row">
	        	                	<label class="control-label col-md-3">Tanggal Transfer</label>
	        	                	<div class="col-md-3">
	        	                		<input type="date" name="tgl_bayar" class="form-control" value="<?php echo $this->session->flashdata('temp_result') ? $this->session->flashdata('temp_result')['tgl_bayar'] : $detail['tgl_bayar'] ?>" >
	        	                		<small class="text-danger">*Wajib Diisi!</small>
	        	                	</div>
	        	                </div>
	        	                <div class="form-group row">
	        	                	<label class="control-label col-md-3">Upload Bukti Transfer</label>
	        	                	<div class="col-md-6">
	        	                		<input type="file" name="url_konfirmasi" class="form-control" accept="image/*">
	        	                		<small class="text-danger">*Wajib Diupload!</small>
	        	                	</div>
	        	                	<?php if ($detail['url_konfirmasi']): ?>
	        	                		<div class="col-md-2">
	        	                			<a href="<?= base_url() . $detail['url_konfirmasi'] ?>" class="btn btn-success" target="_BLANK">
	        	                				<i class="fa fa-download"></i>
	        	                			</a>
	        	                			<a href="<?= site_url() . "front/riwayat/delete_bukti_process/" . $detail['id_konfirmasi'] ?>" class="btn btn-danger" onclick="return confirm('Yakin menghapus bukti transfer?')">
	        	                				<i class="fa fa-trash"></i>
	        	                			</a>
	        	                		</div>
	        	                	<?php endif ?>
	        	                </div>
	        	                <div class="form-group row">
	        	                	<label class="control-label col-md-3">Keterangan Tambahan</label>
	        	                	<div class="col-md-9">
	        	                		<textarea name="keterangan" class="form-control" rows="5"><?php echo $this->session->flashdata('temp_result') ? $this->session->flashdata('temp_result')['keterangan'] : $detail['keterangan'] ?></textarea>
	        	                		<small class="text-warning">Optional!</small>
	        	                	</div>
	        	                </div>
					        </div>
						</div>
						<div class="panel-footer">
							<div class="clearfix">
								<div class="pull-right">
									<a href="<?php echo site_url() . 'front/riwayat/alamat/' . $detail['id_pembelian'] ?>" class="btn btn-primary">
										Sebelumnya
									</a>
									<button type="submit" class="btn btn-success">
										Simpan
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