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
						<div class="pull-left">
							<h2 class="panel-title" style="padding: 10px 0">Daftar Riwayat Transaksi yang Sudah Dilakukan</h2>
						</div>
						<div class="pull-right">
							
						</div>
					</div>
					<div class="panel-body">
						<?php $this->load->view('back/include/notification') ?>
						<div class="table-responsive">
						   <table class="table table-bordered table-striped table-condensed table-heading simpleCart_shelfItem default">
						      <thead>
						         <tr>
						            <th width="5%" class="text-center">No</th>
						            <th width="20%" class="text-center">Tanggal Transaksi</th>
						            <th width="20%" class="text-center">Total Bayar</th>
						            <th width="17.5%" class="text-center">Status Beli</th>
						            <th width="17.5%" class="text-center">Status Bayar</th>
						            <th width="15%" class="text-center"></th>
						         </tr>
						      </thead>
						      <tbody>
						         <?php foreach ($rs_id as $data) : ?>
						         <tr>
						            <th class="text-center"><?php echo $no++; ?></th>
						            <td class="text-center"><?php echo strtoupper($this->dtm->get_date_short_only($data['tgl_pembelian'])); ?></td>
						            <td class="text-right"><?php echo "Rp " . number_format($data['total_bayar'],0,',','.'); ?></td>
						            <td class="text-center"><?php echo strtoupper($data['status_pembelian']); ?></td>
						            <td class="text-center"><?php echo strtoupper($data['status_bayar']); ?></td>
						            <td class="text-center">
						               <?php if ($data['id_konfirmasi']): ?>
						            	<a href="<?=site_url()?>front/riwayat/monitoring/<?php echo $data['id_pembelian']; ?>"><button class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>
						               <?php elseif ($data['id_kab']): ?>
						            	<a href="<?=site_url()?>front/riwayat/konfirmasi/<?php echo $data['id_pembelian']; ?>"><button class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>
						               <?php elseif (!$data['id_kab']): ?>
						            	<a href="<?=site_url()?>front/riwayat/alamat/<?php echo $data['id_pembelian']; ?>"><button class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>
						               <?php else: ?>
						               	<a href="<?=site_url()?>front/riwayat/detail/<?php echo $data['id_pembelian']; ?>"><button class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>
						               <?php endif ?>
						               <a href="<?=site_url()?>front/riwayat/delete/<?php echo $data['id_pembelian']; ?>"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>
						            </td>
						         </tr>
						         <?php endforeach; ?>
						      </tbody>
						   </table>
						</div>
						<div class="row">
						    <div class="col-md-6">
						        <small>Menampilkan <?php echo $pagination['start'] ?> - <?php echo $pagination['end'] ?> dari total <?php echo $pagination['total'] ?> data</small>
						    </div>
						    <div class="col-md-6 clearfix">
						        <ul class="pagination pagination-sm pull-right">
						            <?php echo $pagination['data']; ?>
						        </ul>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>