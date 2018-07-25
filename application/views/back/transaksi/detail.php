<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Transaksi
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
         <div class="box box-default">
            <div class="box-header with-border clearfix">
              <h3 class="box-title">Detail Transaksi</h3>
              <div class="box-tools pull-right">
                <a href="<?=site_url()?>back/transaksi" class="btn btn-default btn-box-tool">
                  <i class="fa fa-arrow-left"></i> Kembali
                </a>
              </div>
            </div>
            <form action="<?=site_url()?>back/transaksi/update_pengiriman_process" method="post" class="form-horizontal" onsubmit="return confirm('Lanjutkan Pengiriman?')">
              <div class="box-body">
                 <?php $this->load->view('back/include/notification') ?>
                <table width='100%' style="font-size:14px;" class="custom">
                    <tr>
                        <td width='25%'>
                            <b>Tanggal Transaksi</b>
                        </td>
                        <td width='3%'>:</td>
                        <td width='72%'><?= $this->dtm->get_full_date($detail['tgl_pembelian']) ?></td>
                    </tr>
                    <tr>
                        <td width='25%'>
                            <b>Total Biaya</b>
                        </td>
                        <td width='3%'>:</td>
                        <td width='72%'><?= "Rp " . number_format($detail['total_bayar'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td width='25%'>
                            <b>Daftar Produk</b>
                        </td>
                        <td width='3%'>:</td>
                        <td width='72%'>
                              <?php foreach ($detail['detail'] as $i => $cart): ?>
                                <?= $cart['nama_produk'] ?> (<?= $cart['jumlah'] ?>) <br>
                              <?php endforeach ?>
                        </td>
                    </tr>
                    <tr>
                        <td width='100%' colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='25%'>
                            <b>Nama Pemilik</b>
                        </td>
                        <td width='3%'>:</td>
                        <td width='72%'><?= $detail['nama'] ?></td>
                    </tr>
                    <tr>
                        <td width='25%'>
                            <b>No. Handphone</b>
                        </td>
                        <td width='3%'>:</td>
                        <td width='72%'><?= $detail['no_hp'] ?></td>
                    </tr>
                    <tr>
                        <td width='25%'>
                            <b>Detail Alamat</b>
                        </td>
                        <td width='3%'>:</td>
                        <td width='72%'><?= $detail['detail_alamat'] ?></td>
                    </tr>
                    <tr>
                        <td width='100%' colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='25%'>
                            <b>No. Rekening</b>
                        </td>
                        <td width='3%'>:</td>
                        <td width='72%'><?= $detail['no_rek'] ?></td>
                    </tr>
                    <tr>
                        <td width='25%'>
                            <b>Atas Nama</b>
                        </td>
                        <td width='3%'>:</td>
                        <td width='72%'><?= $detail['atas_nama'] ?></td>
                    </tr>
                    <tr>
                        <td width='25%'>
                            <b>Jumlah Transfer</b>
                        </td>
                        <td width='3%'>:</td>
                        <td width='72%'><?= "Rp " . number_format($detail['jml_bayar'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td width='25%'>
                            <b>Nama Bank</b>
                        </td>
                        <td width='3%'>:</td>
                        <td width='72%'><?= $detail['bank_tujuan'] ?></td>
                    </tr>
                    <tr>
                        <td width='25%'>
                            <b>Tanggal Transfer</b>
                        </td>
                        <td width='3%'>:</td>
                        <td width='72%'><?= $this->dtm->get_full_date($detail['tgl_bayar']) ?></td>
                    </tr>
                    <tr>
                        <td width='25%'>
                            <b>Keterangan</b>
                        </td>
                        <td width='3%'>:</td>
                        <td width='72%'><?= $detail['keterangan'] ?></td>
                    </tr>
                    <tr>
                        <td width='25%'>
                            <b>Bukti Transfer</b>
                        </td>
                        <td width='3%'>:</td>
                        <td width='72%'>
                          <!-- <img src="<?php //echo base_url().'uploads/'.$detail['url_konfirmasi']?>" class="img-responsive"> -->
                          <img src="<?php echo base_url()?><?php echo $detail['url_konfirmasi'];?>" class="img-responsive">
                        </td>
                    </tr>
                </table>
                <hr>
                <input type="hidden" name="id_pembelian" value="<?php echo $detail['id_pembelian'] ?>">
                <div class="form-group">
                   <label class="control-label col-md-3">Status Pembayaran</label>
                   <div class="col-md-4">
                      <select class="form-control" name="status_bayar">
                         <option value="Belum bayar" <?php if($detail['status_bayar'] == "Belum bayar"){echo "selected";} ?>>Belum Bayar</option>
                         <option value="Menunggu Konfirmasi" <?php if($detail['status_bayar'] == "Menunggu Konfirmasi"){echo "selected";} ?>>Menunggu Konfirmasi</option>
                         <option value="Tidak Valid" <?php if($detail['status_bayar'] == "Tidak Valid"){echo "selected";} ?>>Tidak Valid</option>
                         <option value="Sudah bayar" <?php if($detail['status_bayar'] == "Sudah bayar"){echo "selected";} ?>>Sudah Bayar</option>
                      </select>
                      <small class="text-help text-danger">Wajib Diisi!</small>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Status Pembelian</label>
                   <div class="col-md-4">
                      <select class="form-control" name="status_pembelian">
                         <option value="Sedang diproses" <?php if($detail['status_pembelian'] == "Sedang diproses"){echo "selected";} ?>>Sedang Diproses</option>
                         <option value="Sudah dikirim" <?php if($detail['status_pembelian'] == "Sudah dikirim"){echo "selected";} ?>>Sudah Dikirim</option>
                         <option value="Belum dikirim" <?php if($detail['status_pembelian'] == "Belum dikirim"){echo "selected";} ?>>Belum Dikirim</option>
                         <option value="Selesai" <?php if($detail['status_pembelian'] == "Selesai"){echo "selected";} ?>>Selesai</option>
                      </select>
                      <small class="text-help text-danger">Wajib Diisi!</small>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">No. Resi</label>
                   <div class="col-md-4">
                   <input type="text" class="form-control" name="no_resi" placeholder="" value="<?php echo $this->session->flashdata('temp_result') ? $this->session->flashdata('temp_result')['no_resi'] : $detail['no_resi'] ?>" maxlength="15">
                   <small class="text-help text-danger">*Wajib Diisi!</small>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Tanggal Kirim</label>
                   <div class="col-md-2">
                   <input type="date" class="form-control" name="tgl_kirim" placeholder="" value="<?php echo $this->session->flashdata('temp_result') ? $this->session->flashdata('temp_result')['tgl_kirim'] : $detail['tgl_kirim'] ?>">
                   <small class="text-help text-danger">*Wajib Diisi!</small>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Keterangan Pengiriman</label>
                   <div class="col-md-9">
                     <textarea rows="5" class="form-control" name="ket_kirim"><?php echo $this->session->flashdata('temp_result') ? $this->session->flashdata('temp_result')['ket_kirim'] : $detail['ket_kirim'] ?></textarea>
                     <small class="text-help text-warning">Opsional!</small>
                   </div>
                </div>
              </div>
              <div class="box-footer clearfix">
                <div class="pull-right">
                  <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Konfirmasi Transaksi
                  </button>
                </div>
              </div>
            </form>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->