
<!--banner-->
<div class="banner-top">
	<div class="container">
		<h1>Daftar</h1>
		<em></em>
		<h2><a href="<?php echo site_url() ?>">Beranda</a><label>/</label>Daftar</a></h2>
	</div>
</div>
<!--login-->
<div class="container">
	<div class="login">
            <form action="<?php echo site_url() . 'front/main/register_process' ?>" method="post" class="form-horizontal">
            <div class="col-md-offset-3 col-md-6 login-do">
      		<?php $this->load->view('back/include/notification') ?>
            	<div class="form-group">
            		<label class="control-label col-sm-4">Nama Lengkap</label>
            		<div class="col-sm-8">
            			<div class="login-mail" style="margin-bottom: 0">
	            			<input type="text" name="nama_lengkap" value="<?php echo $this->session->flashdata('temp_result')['nama_lengkap'] ?>" maxlength="30" required="required">
            			</div>
            			<small style="font-size: 11px" class="text-danger">* Wajib Diisi!</small>
            		</div>
            	</div>
            	<div class="form-group">
            		<label class="control-label col-sm-4">Alamat Email</label>
            		<div class="col-sm-8">
            			<div class="login-mail" style="margin-bottom: 0">
	            			<input type="text" name="email" value="<?php echo $this->session->flashdata('temp_result')['email'] ?>" required="required">
            			</div>
                              <small style="font-size: 11px" class="text-danger">* Wajib Diisi!</small>
            		</div>
            	</div>
                  
                  <div class="form-group">
                        <label class="control-label col-sm-4">Password</label>
                        <div class="col-sm-8">
                              <div class="login-mail" style="margin-bottom: 0">
                                    <input type="password" name="password" required="required">
                              </div>
                              <small style="font-size: 11px" class="text-danger">* Wajib Diisi!</small>
                        </div>
                  </div>
            	
            	<div class="form-group">
            		<label class="control-label col-sm-4">Ulangi Password</label>
            		<div class="col-sm-8">
            			<div class="login-mail" style="margin-bottom: 0">
	            			<input type="password" name="ulang_password" required="required">
            			</div>
                              <small style="font-size: 11px" class="text-danger">* Wajib Diisi!</small>
            		</div>
            	</div>
            	<div class="form-group">
            		<label class="control-label col-sm-4">Jenis Kelamin</label>
            		<div class="col-sm-8">
            			<div class="radio">
            				<label class="radio">
            					<input type="radio" name="jenis_kelamin" value="Perempuan" <?php if ($this->session->flashdata('temp_result')['jenis_kelamin'] == "Perempuan"): ?>
            						checked
            					<?php endif ?> required="required"> Perempuan
            				</label>
            				<label class="radio">
            					<input type="radio" name="jenis_kelamin" value="Laki-laki" <?php if ($this->session->flashdata('temp_result')['jenis_kelamin'] == "Laki-laki"): ?>
            						checked
            					<?php endif ?> required="required"> Laki-laki
            				</label>
            			</div>
                              <small style="font-size: 11px" class="text-danger">* Wajib Dipilih!</small>
            		</div>
            	</div>
            	<div class="form-group">
            		<label class="control-label col-sm-4">Tanggal Lahir</label>
            		<div class="col-sm-8">
            			<input type="date" name="tgl_lahir" value="<?php echo $this->session->flashdata('temp_result')['tgl_lahir'] ?>" required="required">
                              <small style="font-size: 11px" class="text-danger">* Wajib Diisi!</small>
            		</div>
            	</div>
                  <div class="form-group">
                        <label class="control-label col-sm-4">No. Handphone</label>
                        <div class="col-sm-8">
                              <div class="login-mail" style="margin-bottom: 0">
                                    <input type="text" name="no_hp" value="<?php echo $this->session->flashdata('temp_result')['no_hp'] ?>" maxlength="12" required="required">
                              </div>
                              <small style="font-size: 11px" class="text-danger">* Wajib Diisi!</small>
                        </div>
                  </div>
	            <div style="height: 30px"></div>
            	<div class="form-group">
            		<div class="col-sm-offset-4 col-sm-8">
		                <label class="hvr-skew-backward">
			                <input type="submit" value="Daftar Sekarang">
		                </label>
            		</div>
            	</div>
            </div>
            <div class="clearfix"> </div>
            <div style="height: 80px"></div>
        </form>
	</div>
</div>