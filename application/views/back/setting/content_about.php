<script src="<?php echo base_url('assets/plugins/ckeditor')?>/ckeditor.js"></script>
<script>
    jQuery(document).ready(function($) {
      
         CKEDITOR.replace( 'editor' );
    });
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Tentang Kami</h1>
    
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
        <form action="<?php echo site_url('back/setting/about_process')?>" method="post">
          <div class="box-body">
              <?php $this->load->view('back/include/notification') ?>
              <input type="hidden" name="id" value="<?= $rs_about['id'] ?>">
              <div class="form-group">
                <textarea name="value" id="editor" class="form-control"><?= $rs_about['value'] ?></textarea>
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