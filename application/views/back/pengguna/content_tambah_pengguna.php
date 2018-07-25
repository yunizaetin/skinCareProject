<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Data Master Pengguna
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="panel panel-default">
         <div class="panel-heading clearfix">
           <h3 class="panel-title pull-left">Data Pengguna</h3>
           <div class="pull-right">
             <a href="<?php echo site_url('back/Pengguna')?>" class="btn btn-sm btn-default">
               <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali
             </a>
           </div>
         </div>
          <form action="<?php echo site_url('back/Pengguna/tambahPenggunaProcess')?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
         <div class="panel-body">
            <?php $this->load->view('back/include/notification') ?>
               <div class="form-group">
                  <label class="control-label col-md-2" for="exampleFormControlInput1">Email</label>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="email" placeholder="Masukkan email" value="<?php echo $this->session->flashdata('temp_result')['email'] ?>">
                    <small class="text-help text-danger">Wajib Diisi!</small>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-2" for="exampleFormControlInput1">Password</label>
                  <div class="col-md-4">
                  <input type="text" class="form-control" name="password" placeholder="Masukkan password" value="<?php echo $this->session->flashdata('temp_result')['password'] ?>"> 
                  <small class="text-help text-danger">Wajib Diisi!</small>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-2" for="exampleFormControlInput1">Level</label>
                  <div class="col-md-4">
                  <select class="form-control" name="level">
                     <option value="">Pilih Level Pengguna</option>
                     <option value="1" <?php if ($this->session->flashdata('temp_result')['level'] == "1") echo "selected"; ?>>Admin</option>
                     <option value="0" <?php if ($this->session->flashdata('temp_result')['level'] == "0") echo "selected"; ?>>User</option>
                  </select>
                  <small class="text-help text-danger">Wajib Diisi!</small>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-2" for="exampleFormControlInput1">Nama Lengkap</label>
                  <div class="col-md-4">
                  <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan nama lengkap" value="<?php echo $this->session->flashdata('temp_result')['nama_lengkap'] ?>">
                  <small class="text-help text-danger">Wajib Diisi!</small>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-2" for="exampleFormControlInput1">Tanggal Lahir</label>
                  <div class="col-md-4">
                  <input type="date" class="form-control" name="tgl_lahir" placeholder="Masukkan tanggal lahir" value="<?php echo $this->session->flashdata('temp_result')['tgl_lahir'] ?>">
                  <small class="text-help text-danger">Wajib Diisi!</small>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-2" for="exampleFormControlInput1">Jenis Kelamin</label>
                  <div class="col-md-4">
                  <select class="form-control" name="jenis_kelamin">
                     <option value="">Pilih Jenis Kelamin</option>
                     <option value="Laki-laki" <?php if ($this->session->flashdata('temp_result')['jenis_kelamin'] == "l") echo "selected"; ?>>Laki-laki</option>
                     <option value="Perempuan" <?php if ($this->session->flashdata('temp_result')['jenis_kelamin'] == "p") echo "selected"; ?>>Perempuan</option>
                  </select>
                  <small class="text-help text-danger">Wajib Diisi!</small>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-2" for="exampleFormControlInput1">Nomor HP</label>
                  <div class="col-md-4">
                  <input type="number" class="form-control" name="no_hp" placeholder="Masukkan nomor hp" value="<?php echo $this->session->flashdata('temp_result')['no_hp'] ?>">
                  <small class="text-help text-danger">Wajib Diisi!</small>
                  </div>
               </div>
         </div>
         <div class="panel-footer">
           <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
           <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
         </div>
      </form>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->