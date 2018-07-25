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
              <h3 class="panel-title pull-left">Ubah Data pengguna</h3>
              <div class="pull-right">
                <a href="<?php echo site_url('back/Pengguna')?>" class="btn btn-sm btn-default">
                  <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali
                </a>
              </div>
            </div>
    <div class="panel-body">
      <?php $this->load->view('back/include/notification') ?>
        <form action="<?php echo site_url('back/Pengguna/ubahPenggunaProcess/')?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
          <input type="hidden" name="id_user" value="<?php echo $pengguna['id_user']; ?>">
          <!-- type hidden tidak kelihatan, tapi ada -->
          <div class="form-group">
            <label class="control-label col-md-2" for="exampleFormControlInput1">Email</label>
            <div class="col-md-4">
            <input type="text" class="form-control" name="email" value="<?php echo $pengguna['email']; ?>" placeholder="Masukkan email">
            <small class="text-help text-danger">Wajib Diisi!</small>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2" for="exampleFormControlInput1">Password</label>
            <div class="col-md-4">
            <input type="text" class="form-control" name="password" value="<?php echo $pengguna['password']; ?>" placeholder="Masukkan password">
            <small class="text-help text-danger">Wajib Diisi!</small>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2" for="exampleFormControlInput1">Level</label>
            <div class="col-md-4">
            <select class="form-control" name="level">
                <option value="">---Pilih Level---</option>
                <option value="1" <?php if ($this->session->flashdata('temp_result')['level'] == "1" || $pengguna['level'] == "1") echo "selected"; ?>>Admin</option>
                <option value="0" <?php if ($this->session->flashdata('temp_result')['level'] == "0" || $pengguna['level'] == "0") echo "selected"; ?>>User</option>
            </select>
            <small class="text-help text-danger">Wajib Diisi!</small>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2" for="exampleFormControlInput1">Nama Lengkap</label>
            <div class="col-md-4">
            <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $pengguna['nama_lengkap']; ?>" placeholder="Masukkan nama lengkap">
            <small class="text-help text-danger">Wajib Diisi!</small>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2" for="exampleFormControlInput1">Tanggal Lahir</label>
            <div class="col-md-4">
            <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $pengguna['tgl_lahir']; ?>" placeholder="Masukkan tanggal lahir">
            <small class="text-help text-danger">Wajib Diisi!</small>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2" for="exampleFormControlInput1">Jenis Kelamin</label>
            <div class="col-md-4">
            <select class="form-control" name="jenis_kelamin">
                     <option value="">---Pilih Jenis Kelamin---</option>
                     <option value="Laki-laki" <?php if ($this->session->flashdata('temp_result')['jenis_kelamin'] == "Laki-laki" || $pengguna['jenis_kelamin'] == "Laki-laki") echo "selected"; ?>>Laki-laki</option>
                     <option value="Perempuan" <?php if ($this->session->flashdata('temp_result')['jenis_kelamin'] == "Perempuan" || $pengguna['jenis_kelamin'] == "Perempuan") echo "selected"; ?>>Perempuan</option>
                  </select>
            <small class="text-help text-danger">Wajib Diisi!</small>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2" for="exampleFormControlInput1">Nomor HP</label>
            <div class="col-md-4">
            <input type="number" class="form-control" name="no_hp" value="<?php echo $pengguna['no_hp']; ?>" placeholder="Masukkan nomor HP">
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

 