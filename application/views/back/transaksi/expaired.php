<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Transaksi Expaired
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
         <div class="box box-default">
            <div class="box-header with-border clearfix">
              <h3 class="box-title">Daftar Transaksi</h3>
            </div>
            <div class="box-body">
               <?php $this->load->view('back/include/notification') ?>
               <div class="table-responsive">
                  <table class="table table-bordered table-striped table-condensed">
                     <thead>
                        <tr>
                           <th width="5%" class="text-center">No</th>
                           <th width="20%" class="text-center">Nama Pengguna</th>
                           <th width="15%" class="text-center">Tanggal Transaksi</th>
                           <th width="15%" class="text-center">Tanggal Expaired</th>
                           <th width="15%" class="text-center">Total Bayar</th>
                           <th width="10%" class="text-center">Kembalikan Stok</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($rs_id as $data) : ?>
                        <tr>
                           <td class="text-center"><?php echo $no++; ?></td>
                           <td><?php echo $data['nama_lengkap']; ?></td>
                           <td class="text-center"><?php echo strtoupper($this->dtm->get_date_short_only($data['tgl_pembelian'])); ?></td>
                           <td class="text-center"><?php echo strtoupper($this->dtm->get_date_short_only($data['expire'])); ?></td>
                           <td class="text-right"><?php echo "Rp " . number_format($data['total_bayar'],0,',','.'); ?></td>
                           <td class="text-center">
                              <a href="<?=site_url()?>back/transaksi/restock_process/<?php echo $data['id_pembelian']; ?>" class="btn btn-sm btn-info" onclick="return confirm('Kembalikan stok barang?')"><i class="fa fa-refresh"></i></a>
                           </td>
                        </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
                </div>
            </div>
            <div class="box-footer">
              <div class="row">
                  <div class="col-md-6">
                      <ul class="pagination pagination-sm">
                          <li>Menampilkan <?php echo $pagination['start'] ?> - <?php echo $pagination['end'] ?> dari total <?php echo $pagination['total'] ?> data</li>
                      </ul>
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
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->