<?php
	$link = explode("/", uri_string());
?>
<ul class="nav nav-pills nav-stacked">
  
  <li class="<?php if($link[1] == "dashboard") echo 'active'; ?>" role="presentation">
  	<a href="<?php echo site_url() . "front/dashboard" ?>" class="clearfix">
  		<span class="pull-left">Keranjang Belanja</span>
  		<span class="pull-right"><i class="fa fa-shopping-cart"></i></span>
  	</a>
  </li>
  <li class="<?php if($link[1] == "riwayat") echo 'active'; ?>" role="presentation">
    <a href="<?php echo site_url() . "front/riwayat" ?>" class="clearfix">
      <span class="pull-left">Riwayat Transaksi</span>
      <span class="pull-right"><i class="fa fa-list-alt"></i></span>
    </a>
  </li>
  <!--
  <li class="<?php if($link[1] == "profil") echo 'active'; ?>" role="presentation">
    <a href="<?php echo site_url() . "front/profil" ?>" class="clearfix">
      <span class="pull-left">Profil</span>
      <span class="pull-right"><i class="fa fa-shopping-cart"></i></span>
    </a>
  </li>

  <li role="presentation">
  	<a href="<?php echo site_url() . "front/main/logout_process" ?>" class="clearfix">
  		<span class="pull-left">Logout</span>
  		<span class="pull-right"><i class="fa fa-sign-out"></i></span>
  	</a>
  </li>
  -->
</ul>