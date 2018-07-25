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
              <h3 class="panel-title pull-left">Ubah Data Produk</h3>
              <div class="pull-right">
                <a href="<?php echo site_url('back/Produk')?>" class="btn btn-sm btn-default">
                  <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali
                </a>
              </div>
            </div>
    <div class="panel-body">
      <?php $this->load->view('back/include/notification') ?>
        <form action="<?php echo site_url('back/Produk/ubahProdukProcess/')?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
          <input type="hidden" name="id_produk" value="<?php echo $produk['id_produk']; ?>">
          <!-- type hidden tidak kelihatan, tapi ada -->
          <div class="form-group">
            <label class="control-label col-md-2" for="exampleFormControlInput1">Nama Produk</label>
            <div class="col-md-4">
            <input type="text" class="form-control" name="nama_produk" value="<?php echo $produk['nama_produk']; ?>" placeholder="Masukkan nama produk">
            <small class="text-help text-danger">Wajib Diisi!</small>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2" for="exampleFormControlInput1">Keterangan Produk</label>
            <div class="col-md-4">
            <textarea class="form-control" name="ket_produk" placeholder="Masukkan keterangan produk"><?php echo $produk['ket_produk']; ?></textarea>
            <small class="text-help text-danger">Wajib Diisi!</small>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2" for="exampleFormControlInput1">Harga Produk</label>
            <div class="col-md-4">
            <input type="number" class="form-control" name="harga" value="<?php echo $produk['harga']; ?>" placeholder="Masukkan harga produk">
            <small class="text-help text-danger">Wajib Diisi!</small>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2" for="exampleFormControlInput1">Stok</label>
            <div class="col-md-4">
            <input type="number" class="form-control" name="stok" value="<?php echo $produk['stok']; ?>" placeholder="Masukkan stok">
            <small class="text-help text-danger">Wajib Diisi!</small>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2" for="exampleFormControlInput1">Kategori produk</label>
            <div class="col-md-4">
           <select class="form-control" name="id_menu">
           <option>---Pilih Kategori Produk---</option>
             <?php 

             foreach ($kategori as $key) {
             ?>
             <option value="<?php echo $key['id_menu']?>" <?php if($key['id_menu'] == $produk['id_menu']){echo "selected";} ?>><?php echo $key['nama_kategori']?></option>
             <?php }?>

           </select>
           <small class="text-help text-danger">Wajib Diisi!</small>
           </div>
          </div>
          <div class="form-group">
                     <label class="control-label col-md-2" for="exampleInputFile">Upload Gambar</label>
                     <div class="col-md-4">
                     <input type="file" id="exampleInputFile" accept="image/*" name="gambar">
                     <img src="<?php echo base_url().'uploads/'.$produk['url_image']?>" class="img-responsive">
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

 