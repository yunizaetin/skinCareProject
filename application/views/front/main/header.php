<!DOCTYPE html>
<html>
	<head>
		<title>Orvala Beauty</title>
		<link href="<?php echo base_url(); ?>assets/front/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<!-- Custom Theme files -->
		<!--theme-style-->
		<link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet" type="text/css" media="all" />
		<!--//theme-style-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Shopin Responsive web template, Bootstrap Web Templates, Flat Web Templates, AndroId Compatible web template, 
			Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!--theme-style-->
		<link href="<?php echo base_url(); ?>assets/front/css/style4.css" rel="stylesheet" type="text/css" media="all" />
		<!--//theme-style-->
		<script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>
		<!--- start-rate---->
		<script src="<?php echo base_url(); ?>assets/front/js/jstarbox.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/jstarbox.css" type="text/css" media="screen" charset="utf-8" />
		<script type="text/javascript">
			jQuery(function() {
			jQuery('.starbox').each(function() {
				var starbox = jQuery(this);
					starbox.starbox({
					average: starbox.attr('data-start-value'),
					changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
					ghosting: starbox.hasClass('ghosting'),
					autoUpdateAverage: starbox.hasClass('autoupdate'),
					buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
					stars: starbox.attr('data-star-count') || 5
					}).bind('starbox-value-changed', function(event, value) {
					if(starbox.hasClass('random')) {
					var val = Math.random();
					starbox.next().text(' '+val);
					return val;
					} 
				})
			});
			});
		</script>
		<!---//End-rate---->
		<style type="text/css">
			table.default {
				font-size: 12px;
			}
			table.default td {
				color: #333 !important
			}
			table.custom td {
				color: #333 !important
			}
			/*.panel-heading {
				padding: 20px
			}*/
			label.control-label {
				font-size: 14px
			}
			.panel {
				border-radius: 0px
			}
			.panel.panel-default .panel-heading {
				background-color: #fff
			}
			.panel.panel-default .panel-footer {
				background-color: #fff
			}
			.panel.panel-default .panel-heading .panel-title {
				font-weight: bold;
			}
			.nav-custom li.active {
				background-color: #F57777
			}
			.nav-custom li.active a {
				color: #fff
			}

		    /*.footer {
		      position: fixed; bottom: 0; width: 100%
		    }*/
		    .content {
		    	min-height: 500px
		    }
		    .link_header {
		    	color: #333;
	    	    background-color: #fff;
	    	    padding: 3px 12px;
	    	    border-radius: 8px;
		    }
		    .link_header:hover {
		    	color: #f67777;
		    	opacity: .8
		    }
		    /*
		     * Component: alert
		     * ----------------
		     */
		    .alert {
		      border-radius: 3px !important;
		    }
		    .alert h4 {
		      font-weight: 600 !important;
		    }
		    .alert .icon {
		      margin-right: 10px !important;
		    }
		    .alert .close {
		      color: #000 !important;
		      opacity: 0.2 !important;
		      filter: alpha(opacity=20) !important;
		    }
		    .alert .close:hover {
		      opacity: 0.5 !important;
		      filter: alpha(opacity=50) !important;
		    }
		    .alert a {
		      color: #fff !important;
		      text-decoration: underline !important;
		    }
		    .alert-success {
		      border-color: #008d4c !important;
		    }
		    .alert-danger,
		    .alert-error {
		      border-color: #d73925 !important;
		    }
		    .alert-warning {
		      border-color: #e08e0b !important;
		    }
		    .alert-info {
		      border-color: #00acd6 !important;
		    }

		    .alert {
		    	border-radius: 0 !important
		    }
		    .alert-danger {
		        background-color: #f0685e !important;
		        border-color: transparent !important;
		        border-left: 3px solid #cf1c0f !important;
		        color: #fff !important;
		    }
		    .alert-success {
		        background-color: #9cc56c !important;
		        border-color: transparent !important;
		        border-left: 3px solid #648e33 !important;
		        color: #fff !important;
		    }
		    .alert-warning {
		        background-color: #f7bb2b !important;
		        border-color: transparent !important;
		        border-left: 3px solid #b07c03 !important;
		        color: #fff !important;
		    }
		    .alert-info {
		        background-color: #37aee3 !important;
		        border-color: transparent !important;
		        border-left: 3px solid #116f99 !important;
		        color: #fff !important;
		    }
		    .alert-primary {
		        background-color: #34597e !important;
		        border-color: transparent !important;
		        border-left: 3px solid #122130 !important;
		        color: #fff !important;
		    }
		    .header-top {
		        background-color: #2E2E2E;
		        padding: 0.6em 0;
		    }
		    .cart.box_1:hover p, .cart.box_1 a:hover h3 {
		    	color: #f67777;
		    }
		    .jml_barang {
		    	font-size: 12px; color: grey;
		    }
		</style>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.css" type="text/css" charset="utf-8" />
	</head>
	<body>
		<!--header-->
		<div class="header">
			<div class="container">
				<div class="head">
					<div class="logo">
						<a href="<?php echo site_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/images/orvala1.png" alt=""></a>	
					</div>
				</div>
			</div>
			<div class="header-top">
				<div class="container">
					<div class="col-sm-10 col-md-offset-2  header-login">
						<?php if ( $this->session->userdata('user_orvala') ): ?>
							<div class="clearfix">
								<div class="pull-left">
									<small style="color: #fff">Halooo sis <strong><?php echo $this->session->userdata( 'user_orvala' )['nama_lengkap']; ?></strong>, selamat berbelanja di Orvala Beauty</small>
								</div>
								<div class="pull-right">
									<a href="<?php echo site_url('front/dashboard')?>" class="link_header">Belanjaan-Ku</a>
									<a href="<?php echo site_url('front/main/logout_process')?>" class="link_header"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Keluar</a>
								</div>
							</div>
						<?php else: ?>
							<ul >
								<li><a href="<?php echo site_url('front/main/login')?>">Masuk</a></li>
								<li><a href="<?php echo site_url('front/main/register')?>">Daftar</a></li>
							</ul>
						<?php endif ?>
					</div>
					
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="container">
				<div class="head-top">
					<div class="col-sm-8 col-md-offset-2 h_menu4">
						<nav class="navbar nav_bottom" role="navigation">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header nav_2">
								<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								</button>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
								<ul class="nav navbar-nav nav_1 nav-custom">
									<?php
										$link = explode("/", uri_string());
									?>
									<?php foreach ($rs_menubar as $menubar): ?>
									<li class="<?php if(isset($link[3]) && $link[3] == $menubar['id_menu']) echo 'active'; ?>"><a class="color" href="<?php echo site_url() . "front/produk/index/" . $menubar['id_menu'] ?>"><?php echo $menubar['nama_kategori'] ?></a></li>
									<?php endforeach ?>
									<li class="<?php if(isset($link[2]) && $link[2] == 'about') echo 'active'; ?>"><a class="color" href="<?php echo site_url() . "front/main/about" ?>">Tentang</a></li>
									<li class="<?php if(isset($link[2]) && $link[2] == 'help') echo 'active'; ?>"><a class="color" href="<?php echo site_url() . "front/main/help" ?>">Bantuan</a></li>
								</ul>
							</div>
							<!-- /.navbar-collapse -->
						</nav>
					</div>
					<div class="col-sm-2 search-right">
						<div class="cart box_1">
							<?php if ( $this->session->userdata('user_orvala') ): ?>
							<a href="<?php echo site_url() . "front/dashboard" ?>">
								<h3>
									<div class="total">
										<?php if ($this->session->userdata('cart')): ?>
											<?php echo $this->session->userdata('cart')['price'] ?>
										<?php else: ?>
											-
										<?php endif ?>
									</div>
									<i class="fa fa-shopping-cart fa-2x"></i>
								</h3>
							</a>
							<?php else: ?>
							<a href="<?php echo site_url() . "front/main/login" ?>" onclick="alert('Silahkan login atau daftar dulu ya sis sebelum checkout!')">
								<h3>
									<div class="total">
										<?php if ($this->session->userdata('cart')): ?>
											<?php echo $this->session->userdata('cart')['price'] ?>
										<?php else: ?>
											-
										<?php endif ?>
									</div>
									<i class="fa fa-shopping-cart fa-2x"></i>
								</h3>
							</a>
							<?php endif; ?>
							<p class="text-right jml_barang">
								<?php if ($this->session->userdata('cart')): ?>
									<?php echo $this->session->userdata('cart')['count'] ?> Barang
								<?php else: ?>
									Kosong
								<?php endif ?>
							</p>
						</div>
						<div class="clearfix"> </div>
						<!----->
						<!---pop-up-box---->					  
						<link href="<?php echo base_url(); ?>assets/front/css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
						<script src="<?php echo base_url(); ?>assets/front/js/jquery.magnific-popup.js" type="text/javascript"></script>
						<!---//pop-up-box---->
						<div id="small-dialog" class="mfp-hide">
							<div class="search-top">
								<div class="login-search">
									<input type="submit" value="">
									<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}">		
								</div>
								<p>Orvala</p>
							</div>
						</div>
						<script>
							$(document).ready(function() {
							$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
							});
																										
							});
						</script>		
						<!----->
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>