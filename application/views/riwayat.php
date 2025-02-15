<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.all.min.js"></script>
<?php if ($this->session->flashdata('message')) : ?>
<script type="text/javascript">
swal({
    title: "BERHASIL !!!",
    text: "<?php echo $this->session->flashdata('message'); ?>",
    showConfirmButton: true,
    type: 'success'
});
</script>
<?php endif; ?>
<?php if ($this->session->flashdata('abort')) : ?>
<script type="text/javascript">
swal({
    title: "ERROR !!!",
    text: "<?php echo $this->session->flashdata('abort'); ?>",
    showConfirmButton: true,
    type: 'error'
});
</script>
<?php endif; ?>

<style>
@media screen and (max-width: 576px) {
    .hp {
        height: 250px !important;
        width: 310px !important;
    }
}
#white-space{
        
        width: 100%;
        height: 200px;
        
      
  }
</style>

<!-- Start Breadcrumb 
    ============================================= -->
<div class="breadcrumb-area shadow dark text-center bg-fixed text-light"
    style="background-image: url(<?= base_url(); ?>/assets/User/images/alquran.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Riwayat Kelas</h1>
                <ul class="breadcrumb">
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#">Page</a></li>
                    <li class="active">Contact</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb -->





<!-- Start Blog
============================================= -->
<div class="blog-area full-blog standard single-blog full-blog">
    
        
            <div class="blog-items" >
                <div class="blog-content col-md-10 col-md-offset-1" >
                    <div class="item-box">
                        <div class="item">

                            <div class="info">
                                <center><h3 style= "font-size:30px; margin-bottom:50px;">
                                Tabel Pembayaran
                                </h3></center>
                                

                                <p style="text-align: left !important;"><span style="color: #10403a; font-weight: bold;">“Total biaya pembayaran sudah termasuk biaya pendaftaran dan biaya bimbel pada bulan pertama” <br> “Tata cara pembayaran : <br>
									1. Isi form lalu pilih kelas yang ingin didaftarkan. <br>
									2. Transfer berdasarkan nominal tabel dibawah ke nomor rekening BRI <i>4521-221-332-111</i> a.n admin. <br>
									3. Upload bukti pembayaran dengan format jpg/png dengan maksimal ukuran 800kb ke kelas yang diambil pada tabel dibawah. <br>
									4. Tunggu konfirmasi dari admin yang bersangkutan, apabila sudah di informasi oleh admin anda bisa mendownload bukti pembayaran(invoice) sebagai syarat untuk daftar ulang ke Saung Ngaji Tahsinul Qur'an.”</span></p>
                               


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    
</div>
<!-- End Blog -->

<div class="container">

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>

                <th>Kelas</th>
                <th>Jadwal</th>
                <th>Jam</th>
                <th>Status</th>
                <th>Total Bayaran</th>
                <th>Harga</th>
                <th>Bukti Pembayaran</th>
                <th>Invoice</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1;
								foreach ($riwayat as $riw) : ?>
            <tr>
                <td><?= $i++; ?></td>

                <td><?= get_nama_kelas($riw['id_kelas']) ?></td>
                <td><?= $riw['jadwal_kelas'] ?></td>
                <td><?= $riw['waktu_kelas'] ?></td>
                <td><?php
											echo ($riw['status'] == 1) ? 'Aktif' : 'Tidak Aktif'; ?></td>
                <td>Rp. <?= number_format($riw['harga_kelas'] + $riw['biaya_pendaftaran']) ?>
                </td>
                <td><?php
											echo ($riw['status_pembayaran'] == 1) ? 'Berhasil' : (($riw['status_pembayaran'] == 2) ? 'Menunggu Persetujuan' : 'Belum Bayar'); ?>
                </td>
                <td><a href="#" data-toggle="modal" data-target="#myModalfoto<?= $riw['id_pendaftaran'] ?>"><img
                            src="<?= base_url('assets/upload/bukti_pembayaran/') . $riw['bukti_pembayaran'] ?>" alt=""
                            height="60px" width="70px"></a></td>
                <td>
                    <?php if ($riw['status_pembayaran'] == '1') : ?>
                    <a href=" <?= base_url('siswa/invoice/' . $riw['id_pendaftaran']) ?>" target="_blank">Donwload Bukti
                        Pembayaran</a>
                </td>
                <?php elseif ($riw['status_pembayaran'] == '2') : ?>
                <a href="#">Menunggu Konfirmasi Admin</a></td>
                <?php else : ?>
                <a href="#">Upload bukti pembayaran</a>
                <?php endif; ?>
                <td>
                    <?php if ($riw['status_pembayaran'] == '1') : ?>
                    <button type="button" class="btn btn-info" style="color: #555c61;cursor:not-allowed;color:white"
                        disabled><i class="fas fa-file"></i> Selesai</button>
                </td>
                <?php else : ?>
                <button type="button" class="btn btn-warning" style="color: #555c61;" data-toggle="modal"
                    data-target="#myModal<?= $riw['id_pendaftaran'] ?>"><i class="fas fa-file"></i> Upload</button></td>
                <?php endif; ?>


            </tr>

            <!-- The Modal -->
            <div class="modal fade" id="myModal<?= $riw['id_pendaftaran'] ?>">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border: 0px solid rgba(0, 0, 0, 0.2);">

                        <!-- Modal Header -->
                        <div class="modal-header" style="background-color: #fda638;">
                            <b>
                                <h4 class="modal-title" style="color: white;">Upload Bukti Bayar
                                </h4>
                            </b>
                            <button type="button" class="close" data-dismiss="modal"
                                style="color: white;">&times;</button>
                        </div>
                        <?php $attributes = array('method' => 'post'); ?>

                        <?php echo form_open_multipart('siswa/riwayat/' . $riw['id_pendaftaran'], $attributes); ?>
                        <!-- Modal body -->
                        <div class="modal-body" style="padding-top: 20px;">

                            <input type="hidden" name="id_pendaftaran" value="<?= $riw['id_pendaftaran'] ?>">
                            <input type="file" name="file" class="form-control" onchange="cekJpg(this)"
                                accept="image/jpeg,image/png,image/jpg">
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <input type="submit" name="submit" class="btn btn-secondary" value="Simpan">
                            <!-- <button type="button" class="btn btn-secondary">Simpan</button> -->

                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- The Modal Foto-->
            <div class="modal fade" id="myModalfoto<?= $riw['id_pendaftaran'] ?>">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border: 0px solid rgba(0, 0, 0, 0.2);">

                        <!-- Modal Header -->
                        <div class="modal-header" style="background-color: #4f575f;">
                            <img src="<?= base_url('assets/upload/bukti_pembayaran/') . $riw['bukti_pembayaran'] ?>"
                                alt="" class="hp" style="width:500px;height:400px">
                            <!-- <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button> -->
                        </div>

                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </tbody>
        <tfoot>

        </tfoot>
    </table>

</div>
<div id="white-space">

    </div>