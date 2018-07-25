<script type="text/javascript">
  jQuery(document).ready(function($) {
    function readURL(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#img-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#imgInp").change(function() {
      readURL(this);
    });
  });
</script>
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
                <a href="<?php echo site_url('back/Produk')?>" class="btn btn-sm btn-default">
                  <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali
                </a>
              </div>
            </div>
             <form action="<?php echo site_url('back/Produk/tambahProdukProcess')?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <div class="panel-body">
               <?php $this->load->view('back/include/notification') ?>
                  <div class="form-group">
                     <label class="control-label col-md-2" for="exampleFormControlInput1">Nama Produk</label>
                     <div class="col-md-4">
                     <input type="text" class="form-control" name="nama_produk" placeholder="Masukkan nama produk" value="<?php echo $this->session->flashdata('temp_result')['nama_produk'] ?>">
                     <small class="text-help text-danger">Wajib Diisi!</small>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2" for="exampleFormControlInput1">Keterangan Produk</label>
                     <div class="col-md-4">
                     <!-- <input type="text"  value="">  -->
                     <textarea class="form-control" name="ket_produk" placeholder="Masukkan keterangan produk"><?php echo $this->session->flashdata('temp_result')['ket_produk'] ?></textarea>
                     <small class="text-help text-danger">Wajib Diisi!</small>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2" for="exampleFormControlInput1">Harga Produk</label>
                     <div class="col-md-4">
                     <input type="number" class="form-control" name="harga" placeholder="Masukkan harga produk" value="<?php echo $this->session->flashdata('temp_result')['harga'] ?>">
                     <small class="text-help text-danger">Wajib Diisi!</small>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2" for="exampleFormControlInput1">Stok</label>
                     <div class="col-md-4">
                     <input type="number" class="form-control" name="stok" placeholder="Masukkan stok" value="<?php echo $this->session->flashdata('temp_result')['stok'] ?>">
                     <small class="text-help text-danger">Wajib Diisi!</small>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2" for="exampleFormControlInput1">Kategori Produk</label>
                     <div class="col-md-4">
                     <select class="form-control" name="id_menu">
                        <option value="">---Pilih Kategori Produk---</option>
                        <?php foreach ($kategori as $key) :?>
                        <option value="<?php echo $key['id_menu']?>" <?php if($key['id_menu'] == $this->session->flashdata('temp_result')['id_menu']){echo "selected";} ?>><?php echo $key['nama_kategori']?></option>
                        <?php endforeach;?>
                     </select>
                     <small class="text-help text-danger">Wajib Diisi!</small>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2" for="exampleInputFile">Upload Gambar</label>
                     <div class="col-md-4">
                     <input type="file" id="imgInp" accept="image/*" name="gambar">
                     <small class="text-help text-danger">Wajib Diisi!</small>
                     </div>
                  </div>
                  <!--
                  <div class="form-group">
                     <img src="#" class="img-thumbnail" id="img-preview">
                  </div>
                  -->
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