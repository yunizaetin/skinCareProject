<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Data Master Kategori Produk
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
         <div class="panel panel-default">
            <div class="panel-heading clearfix">
              <h3 class="panel-title pull-left">Data Kategori</h3>
              <div class="pull-right">
                <a href="<?php echo site_url('back/Kategori')?>" class="btn btn-sm btn-default">
                  <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali
                </a>
              </div>
            </div>
             <form action="<?php echo site_url('back/Kategori/tambahKategoriProcess')?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <div class="panel-body">
               <?php $this->load->view('back/include/notification') ?>
                  <div class="form-group">
                     <label class="control-label col-md-2" for="exampleFormControlInput1">Nama Kategori</label>
            <div class="col-md-4">
                     <input type="text" class="form-control" name="nama_kategori" placeholder="Masukkan nama kategori" value="<?php echo $this->session->flashdata('temp_result')['nama_kategori'] ?>">
                     <small class="text-help text-danger">Wajib Diisi!</small>
                     </div>
                  </div>
            </div>
            <div class="panel-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
              <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
            </div>
         </div>
         </form>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->