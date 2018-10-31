<?php
$nama_lembaga = $this->config->item("nama_lembaga"); $logo_lembaga = $this->config->item("logo_lembaga");
$css_lembaga = $this->config->item("css_lembaga"); $warna_lembaga = $this->config->item("warna_lembaga");
if (sizeof($data_lembaga)>0) {
    $nama_lembaga = $data_lembaga[0]["nama"];
    $logo_lembaga = $data_lembaga[0]["logo"];
    $css_lembaga = $data_lembaga[0]["css"];
    $warna_lembaga = $data_lembaga[0]["warna"];
}
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb" style="padding-top: 60px;">
            <li>
                <a href="<?php echo base_url('dashboard')?>">Home</a>
            </li>
            <li class="active">
                <strong>Pesan Tiket Kereta Api</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->


<div class="wrapper wrapper-content  animated fadeInRight article">

    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">

            <?php
            $datalasttrans = $this->session->flashdata('messageberhasil');
            if($this->session->flashdata('messageberhasil')){ ?>
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    Anda telah berhasil melakukan pembelian tiket kereta dengan rincian : <br/>
                    <?php
                    echo $datalasttrans;
                    ?>
                    <br/>
                    <a href="#">Lihat Transaksi</a>
                </div>
            <?php } ?>

            <?php if($this->session->flashdata('messagecancel')){ ?>
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    Anda telah berhasil membatalkan Transaksi Kereta.
                </div>itu
            <?php } ?>

            <?php
            $messagegagalpayment = $this->session->flashdata('messagegagalpayment');
            if($this->session->flashdata('messagegagalpayment')){ ?>
                <div class="alert alert-warning alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    Terjadi kesalahan API pada proses payment dengan rincian sebagai berikut : <br/>
                    <?php
                    echo $messagegagalpayment;
                    ?>
                </div>
            <?php } ?>

            <?php
            $messagegagalpaymentpergi = $this->session->flashdata('messagegagalpaymentpergi');
            if($this->session->flashdata('messagegagalpaymentpergi')){ ?>
                <div class="alert alert-warning alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    Terjadi kesalahan API pada proses payment untuk tiket pergi anda, sehingga kami mengcancel tiket pulang anda dengan rincian error sebagai berikut : <br/>
                    <?php
                    echo $messagegagalpaymentpergi;
                    ?>
                </div>
            <?php } ?>

            <?php
            $messagegagalpaymentpulang = $this->session->flashdata('messagegagalpaymentpulang');
            if($this->session->flashdata('messagegagalpaymentpulang')){ ?>
                <div class="alert alert-warning alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    Terjadi kesalahan API pada proses payment untuk tiket pulang anda, sehingga kami mengcancel tiket pergi anda dengan rincian error sebagai berikut : <br/>
                    <?php
                    echo $messagegagalpaymentpulang;
                    ?>
                </div>
            <?php } ?>

            <div id="alertapistasiun" class="alert alert-warning alert-dismissable" style="display: none;">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                Terjadi kesalahan API pada proses pemanggilan nama stasiun pada kolom tempat stasiun asal dan stasiun tujuan<br/>
                Pemesanan tidak dapat dilanjutkan <br/>
                Silahkan reload kembali halaman ini sampai API terkoneksi kembali.
            </div>

            <div id="loading" class="alert alert-info">
                Sedang Mengambil data Stasiun, Mohon untuk menunggu beberapa saat <span class="loading"></span>
            </div>

            <h2>
                <i class="fa fa-train" style="font-size:1em;margin-right:10px;color: <?php echo $warna_lembaga ?>;"></i>
                <span style="color: <?php echo $warna_lembaga ?>">Pesan Tiket Kereta Api</span>
            </h2>
            <div class="widget white-bg p-lg">

                <form id="formpesantiket" method="post" action="kereta/viewjadwalkereta" autocomplete="off">

                    <div class="form-group">
                        <label><i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga ?>;padding-right:5px;"></i> Stasiun Asal</label>
                        <input id="st_from" name="st_from" type="text" class="st_from form-control" onclick="clearstfrom()" required>
                       <?php echo $this->session->userdata('tokenft') ?>
                    </div>

                    <div class="row">
                        <div class="tukar" style="position: relative; cursor:pointer; margin-top: 7px;" onclick="tukar()">
                            <span class="fa-stack fa-lg" style="position:absolute;bottom:-20px;right:16px;width:55px;">
                            <i class="fa fa-circle fa-stack-2x" style="color:#ED5565;"></i>
                            <i class="fa fa-exchange fa-stack-1x fa-inverse fa-rotate-90"></i>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga ?>;padding-right:5px;"></i> Stasiun Tujuan</label>
                        <input id="st_to" name="st_to" type="text" class="st_to form-control" onclick="clearstto()" required>
                    </div>

                    <div class="form-group" id="tanggalpergi">
                        <label> Tanggal Pergi</label>
                        <div class="input-group date">
                            <?php $today = date("d/m/Y"); ?>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="tglpergi" class="form-control" value="<?php echo $today?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="i-checks" style="float: right">
                            <label> <input type="checkbox" class="cekpp" id="cekpp" name="cekpp"> <i></i> Pulang Pergi</label>
                        </div>
                    </div>

                    <div class="form-group" id="tanggalpulang" style="display: none; margin-top: 28px">
                        <label> Tanggal Pulang</label>
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="tglpulang" class="form-control" value="<?php echo $today?>" required>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 30px;">
                            <label> Dewasa (>= 3 thn) </label>
                            <select class="form-control" name="jmldewasa" required>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                    </div>

                    <div class="form-group">
                            <label> Bayi (< 3 thn) </label>
                            <select class="form-control" name="jmlbayi" required>
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>

                    </div>

                    <div class="form-group">
                        <button id="btnsubmit" class="btn btn-danger" type="submit" style="display: block; width: 100%;" disabled>Cari Jadwal</button>
                    </div>

                </form>

            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>

</div>

<!-- /content -->


</div>
