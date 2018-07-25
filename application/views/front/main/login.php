<div class="banner-top">
	<div class="container">
		<h1>Masuk</h1>
		<em></em>
		<h2><a href="index.html">Beranda</a><label>/</label>Masuk</a></h2>
	</div>
</div>
<!--login-->
<div class="container">
	<div class="login">
		<form method="POST" action="<?php echo base_url() ?>front/main/login_process">
			<div class="col-md-offset-3 col-md-6 login-do" style="float: center;">
				<?php $this->load->view('back/include/notification') ?>
				<div class="login-mail">
					<input type="text" placeholder="Email" required="" name="username">
					<i  class="glyphicon glyphicon-envelope"></i>
				</div>
				<div class="login-mail">
					<input type="password" placeholder="Password" required="" name="password">
					<i class="glyphicon glyphicon-lock"></i>
				</div>
				<label class="hvr-skew-backward">
					<input type="submit" value="Masuk">
				</label>
			</div>
			<div class="clearfix"> </div>
		</form>
	</div>
	<div style="height: 100px"></div>
</div>
<!--//login-->