  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Dashboard</h1>  
      <h2>Selamat datang di administrator</h2>

      <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php foreach($data_penjualan as $data){
                if($data['jumlah'] !==null){
                  echo $data['jumlah'];
                }else{
                  echo '0';
                }
                }?></h3>

              <p>Penjualan Produk Hari Ini</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php foreach($data_pendapatan as $data){
                if($data['total_bayar'] !==null){
                  echo 'Rp'.$data['total_bayar'];
                }else{
                  echo '0';
                }
                }?><sup style="font-size: 20px"></sup></h3>

              <p>Pendapatan Hari Ini</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $data_expired;?></h3>

              <p>Transaksi Expired</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo site_url('back/transaksi/expaired')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php foreach($data_nonvalidasi as $data){
                if($data['jumlah'] !==null){
                  echo $data['jumlah'];
                }else{
                  echo '0';
                }
                }?></h3>

              <p>Pembayaran Masuk</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->


<!-- test  percobaan git -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
