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
              <h3 class="panel-title pull-left">Ubah Data Kategori</h3>
              <div class="pull-right">
                <a href="<?php echo site_url('back/Kategori')?>" class="btn btn-sm btn-default">
                  <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali
                </a>
              </div>
            </div>
    <div class="panel-body">
      <?php $this->load->view('back/include/notification') ?>
        <form action="<?php echo site_url('back/Kategori/ubahKategoriProcess/')?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
          <input type="hidden" name="id_menu" value="<?php echo $kategori['id_menu']; ?>">
          <!-- type hidden tidak kelihatan, tapi ada -->
          <div class="form-group">
            <label class="control-label col-md-2" for="exampleFormControlInput1">Nama Kategori</label>
            <div class="col-md-4">
            <input type="text" class="form-control" name="nama_kategori" value="<?php echo $kategori['nama_kategori']; ?>" placeholder="Masukkan nama kategori">
            <small class="text-help text-danger">Wajib Diisi!</small>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
          <button class="btn btn-danger">Cancel</button>
        </form>
    </div>
  </div>
</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 