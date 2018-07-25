<!-- Include SmartWizard CSS -->
<link href="<?php echo base_url() . "assets/plugins" ?>/wizard.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	jQuery(document).ready(function($) {
		// change provinsi
		$('[name="id_prov"]').change(function(event) {
			var val = $(this).val();
			$.ajax({
				url: '<?php echo site_url() . "front/riwayat/ajax_change_provinsi" ?>',
				type: 'GET',
				data: {id_prov: val},
				success: function( result ) {
					$('[name="id_kab"]').html( result );
				},
				beforeSend: function() {
					$('[name="id_kab"]').html('');
					$('[name="id_kec"]').html('');
				}
			});
			
		});
		// change kabupaten
		$('[name="id_kab"]').change(function(event) {
			var val = $(this).val();
			$.ajax({
				url: '<?php echo site_url() . "front/riwayat/ajax_change_kabupaten" ?>',
				type: 'GET',
				data: {id_kab: val},
				success: function( result ) {
					$('[name="id_kec"]').html( result );
				},
				beforeSend: function() {
					$('[name="id_kec"]').html('');
				}
			});
			
		});
		// change kecamatan
		$('[name="id_kec"]').change(function(event) {
			$('[name="nama_kec"]').val( $(this).find('option:selected').html() );
		});
	});
</script>
<!--content-->
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<?php $this->load->view('front/dashboard/sidebar'); ?>
			</div>
			<div class="col-sm-9">
				<h1 style="margin: 30px 0">Riwayat Transaksi</h1>
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<div class="pull-right">
							<a href="<?=site_url()?>front/riwayat" class="btn btn-default">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</div>
					</div>
					<form action="<?php echo site_url() . "front/riwayat/update_alamat_process" ?>" role="form" data-toggle="validator" method="post" accept-charset="utf-8">
						<div class="panel-body">
							<?php $this->load->view('back/include/notification') ?>
							<!-- SmartWizard html -->
							<div class="tabbable">
							  <ul class="nav nav-tabs wizard">
							    <li class="active completed"><a data-toggle="tab" aria-expanded="false"><span class="nmbr">1</span>Pilih Produk</a></li>
							    <li class="active focus"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">2</span>Alamat Kirim</a></li>
							    <li class="active"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">3</span>Konfirmasi Bayar</a></li>
							    <li class="active"><a data-toggle="tab" aria-expanded="false"><span class="nmbr" role="tab">4</span>Monitoring Pengiriman</a></li>
							  </ul>
							</div>
							<div class="panel panel-primary">
								<div class="panel-body">
									<p>
										Klik tombol di bawah ini ya untuk liat detail transaksi Sista<br>
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
					        <div class="form-horizontal">
	        			        <input type="hidden" name="id_pembelian" value="<?= $detail['id_pembelian'] ?>" />
	        			        <input type="hidden" name="id_alamat" value="<?= $detail['id_alamat'] ?>" />
	        	                <div class="form-group row">
	        	                	<label class="control-label col-md-3">Nama Pemilik</label>
	        	                	<div class="col-md-6">
	        	                		<input type="text" name="nama" class="form-control" value="<?php echo $this->session->flashdata('temp_result') ? $this->session->flashdata('temp_result')['nama'] : $detail['nama'] ?>" maxlength="30">
	        	                		<small class="text-danger">*Wajib Diisi!</small>
	        	                	</div>
	        	                </div>
	        	                <div class="form-group row">
	        	                	<label class="control-label col-md-3">No. Handphone</label>
	        	                	<div class="col-md-4">
	        	                		<input type="text" name="no_hp" class="form-control" value="<?php echo $this->session->flashdata('temp_result') ? $this->session->flashdata('temp_result')['no_hp'] : $detail['no_hp'] ?>" maxlength="12">
	        	                		<small class="text-danger">*Wajib Diisi!</small>
	        	                	</div>
	        	                </div>
	        	                <div class="form-group row">
	        	                	<label class="control-label col-md-3">Provinsi</label>
	        	                	<div class="col-md-4">
	        	                		<select name="id_prov" class="form-control">
	        	                			<option value="">-- Pilih Provinsi --</option>
	        	                			<?php foreach ($rs_provinsi as $provinsi): ?>
	        	                				<option value="<?= $provinsi['id_prov'] ?>" <?php if( $provinsi['id_prov']  == $detail['id_prov']  ) echo 'selected'; ?>><?= $provinsi['nama_prov'] ?></option>
	        	                			<?php endforeach; ?>
	        	                		</select>
	        	                		<small class="text-danger">*Wajib Diisi!</small>
	        	                	</div>
	        	                </div>
	        	                <div class="form-group row">
	        	                	<label class="control-label col-md-3">Kabupaten</label>
	        	                	<div class="col-md-4">
	        	                		<select name="id_kab" class="form-control">
	        	                			<option value="">-- Pilih Kabupaten --</option>
	        	                			<?php foreach ($rs_kabupaten as $kabupaten): ?>
	        	                				<option value="<?= $kabupaten['id_kab'] ?>" <?php if( $kabupaten['id_kab']  == $detail['id_kab']  ) echo 'selected'; ?>><?= $kabupaten['nama_kab'] ?></option>
	        	                			<?php endforeach; ?>
	        	                		</select>
	        	                		<small class="text-danger">*Wajib Diisi!</small>
	        	                	</div>
	        	                </div>
	        	                <div class="form-group row">
	        	                	<label class="control-label col-md-3">Kecamatan</label>
	        	                	<div class="col-md-4">
	        	                		<select name="id_kec" class="form-control">
	        	                			<option value="" data-kecamatan="">-- Pilih Kecamatan --</option>
	        	                			<?php foreach ($rs_kecamatan as $kecamatan): ?>
	        	                				<option value="<?= $kecamatan['id_kec'] ?>" <?php if( $kecamatan['id_kec']  == $detail['id_kec']  ) echo 'selected'; ?>><?= $kecamatan['nama_kec'] ?></option>
	        	                			<?php endforeach; ?>
	        	                		</select>
	        	                		<small class="text-warning">Opsional, jika belum ada isi manual!</small>
	        	                	</div>
	        	                	<div class="col-md-5">
	        	                		<input type="text" name="nama_kec" class="form-control" value="<?php echo $this->session->flashdata('temp_result') ? $this->session->flashdata('temp_result')['nama_kec'] : $detail['nama_kec'] ?>" placeholder="Jika kecamatan belum ada">
	        	                	</div>
	        	                </div>
	        	                <div class="form-group row">
	        	                	<label class="control-label col-md-3">Detail Alamat</label>
	        	                	<div class="col-md-9">
	        	                		<textarea rows="5" class="form-control" name="detail_alamat"><?php echo $this->session->flashdata('temp_result') ? $this->session->flashdata('temp_result')['detail_alamat'] : $detail['detail_alamat'] ?></textarea>
	        	                		<small class="text-danger">*Wajib Diisi!</small>
	        	                	</div>
	        	                </div>
					        </div>
						</div>
						<div class="panel-footer">
							<div class="clearfix">
								<div class="pull-right">
									<a href="<?php echo site_url() . 'front/riwayat/detail/' . $detail['id_pembelian'] ?>" class="btn btn-primary">
										Sebelumnya
									</a>
									<button type="submit" class="btn btn-primary">
										Selanjutnya
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