<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Data Master Produk
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
         <div class="panel panel-default">
            <div class="panel-heading clearfix">
              <h3 class="panel-title pull-left">Data Produk</h3>
              <div class="pull-right">
                <a href="<?php echo site_url('back/Produk/tambahProduk')?>" class="btn btn-success">
                  <i class="fa fa-plus"></i> Tambah Produk
                </a>
              </div>
            </div>
            <div class="col-md-6">
            </div>
            <div class="panel-body">
               <?php $this->load->view('back/include/notification') ?>
               <div class="table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                           <th width="10">No</th>
                           <th width="100">Nama Produk</th>
                           <th width="250">Keterangan Produk</th>
                           <th width="50">Harga Produk</th>
                           <th width="10">Stok</th>
                           <th width="100">Image</th>
                           <th width="150">Kategori Produk</th>
                           <th width="100">Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($rs_id as $data) : ?>
                        <tr>
                           <th scope="row"><?php echo $no++; ?></th>
                           <td><?php echo $data['nama_produk']; ?></td>
                           <td><?php echo $data['ket_produk']; ?></td>
                           <td><?php echo "Rp." . number_format($data['harga'],2,',','.'); ?></td>
                           <td><?php echo $data['stok']; ?></td>
                           <td>
                             <img width="100px" src="<?=base_url()?>uploads/<?php echo $data['url_image']; ?>?tmp=<?php echo rand(100, 0) ?>" class="img-thumbnail">
                            </td>
                           <td><?php echo $data['nama_kategori']; ?></td>
                           <td>
                              <a href="<?=base_url()?>back/Produk/ubahProduk/<?php echo $data['id_produk']; ?>"><button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                              <a href="<?=base_url()?>back/Produk/hapusProduk/<?php echo $data['id_produk']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data <?php echo $data['nama_produk']; ?>?')"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                           </td>
                        </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>

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