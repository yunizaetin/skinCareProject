<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Bantuan</h1>
    
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <div class="box">
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <form action="<?php echo site_url('back/setting/help_process')?>" method="post">
          <div class="box-body">
            <?php $this->load->view('back/include/notification') ?>
            <div class="form-group row">
              <label class="control-label col-md-3">No. Telepon</label>
              <div class="col-md-9">
                <input type="hidden" name="telepon_id" value="<?= $rs_telepon['id'] ?>">
                <input type="text" name="telepon_value" value="<?= $rs_telepon['value'] ?>" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3">Line</label>
              <div class="col-md-9">
                <input type="hidden" name="line_id" value="<?= $rs_line['id'] ?>">
                <input type="text" name="line_value" value="<?= $rs_line['value'] ?>" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3">Waktu Pelayanan</label>
              <div class="col-md-9">
                <input type="hidden" name="layanan_id" value="<?= $rs_layanan['id'] ?>">
                <input type="text" name="layanan_value" value="<?= $rs_layanan['value'] ?>" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3">Alamat Kami</label>
              <div class="col-md-9">
                <input type="hidden" name="alamat_id" value="<?= $rs_alamat['id'] ?>">
                <textarea name="alamat_value" class="form-control" rows="3"><?= $rs_alamat['value'] ?></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3">Maps</label>
              <div class="col-md-9">
                <input type="hidden" name="maps_id" value="<?= $rs_maps['id'] ?>">
                <textarea name="maps_value" class="form-control" rows="3"><?= $rs_maps['value'] ?></textarea>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </form>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->