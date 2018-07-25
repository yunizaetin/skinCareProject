<!--banner-->
<div class="banner-top">
    <div class="container">
        <h1>Bantuan</h1>
        <em></em>
    </div>
</div>
<!--content-->
<div class="contact">
    <div class="contact-form">
        <div class="container">
            <div class="col-md-6 contact-left">
                <h3>ORVALA BEAUTY</h3>
                <div class="address">
                    <div class=" address-grid">
                        <i class="glyphicon glyphicon-map-marker"></i>
                        <div class="address1">
                            <h3>
                            Alamat
                            </h3>
                            <p><?= $rs_alamat ?></p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class=" address-grid ">
                        <i class="glyphicon glyphicon-phone"></i>
                        <div class="address1">
                            <h3>
                            Whatsapp
                            <h3>
                            <p><?= $rs_telepon ?></p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class=" address-grid ">
                        <i class="glyphicon glyphicon-envelope"></i>
                        <div class="address1">
                            <h3>Line</h3>
                            <p><a href="<?= $rs_line ?>"><?= $rs_line ?></a></p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class=" address-grid ">
                        <i class="glyphicon glyphicon-bell"></i>
                        <div class="address1">
                            <h3>Waktu Pelayanan</h3>
                            <p><?= $rs_waktu ?></p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div>
                    
                </div>
            </div>
            <div class="col-md-6 contact-top">
                <h3>Terdapat Masalah dalam Pembelian?</h3>
                <?php $this->load->view('back/include/notification') ?>
                <form action="<?php echo site_url() . 'front/main/send_message' ?>" method="post">
                    <div>
                        <span>Nama </span>     
                        <input type="text" name="kirim_nama" value="<?php echo $this->session->flashdata('temp_result')['kirim_nama'] ?>">                       
                    </div>
                    <div>
                        <span>Email </span>        
                        <input type="text" name="kirim_email" value="<?php echo $this->session->flashdata('temp_result')['kirim_email'] ?>">                       
                    </div>
                    <div>
                        <span>Perihal</span>        
                        <input type="text" name="kirim_subjek" value="<?php echo $this->session->flashdata('temp_result')['kirim_subjek'] ?>">   
                    </div>
                    <div>
                        <span>Pesan</span>       
                        <textarea name="kirim_pesan"><?php echo $this->session->flashdata('temp_result')['kirim_pesan'] ?></textarea>  
                    </div>
                    <label class="hvr-skew-backward">
                    <input type="submit" value="Kirim" >
                    </label>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="map">
        <iframe src="<?= $rs_maps ?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>