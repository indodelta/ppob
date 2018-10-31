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
                <strong>Pesan Tiket PELNI</strong>
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

            <h2>
                <i class="fa fa-ship" style="font-size:1.5em;margin-right:8px;color: <?php echo $warna_lembaga; ?>;"></i>
                <span style="color: <?php echo $warna_lembaga ?>">Pesan Tiket PELNI</span>
            </h2>
            <div class="widget white-bg p-lg">

                <div id="alertapiasal" class="alert alert-warning alert-dismissable" style="display: none;">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    Terjadi kesalahan API pada proses pemanggilan nama pelabuhan pada kolom tempat asal<br/>
                    Pemesanan tidak dapat dilanjutkan <br/>
                    Silahkan reload kembali halaman ini sampai API terkoneksi kembali.
                </div>

                <div id="alertapitujuan" class="alert alert-warning alert-dismissable" style="display: none;">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    Terjadi kesalahan API pada proses pemanggilan nama pelabuhan pada kolom tempat tujuan<br/>
                    Pemesanan tidak dapat dilanjutkan <br/>
                    Silahkan reload kembali halaman ini sampai API terkoneksi kembali.
                </div>

                <div id="loading" class="alert alert-info">
                    Sedang Mengambil data Pelabuhan, Mohon untuk menunggu beberapa saat <span class="loading"></span>
                </div>

                <form id="formpesantiket" method="post" autocomplete="off" target="_blank">

                    <input type="hidden" id="txbwarnalembaga" value="<?php echo $warna_lembaga;?>">

                    <div class="form-group">
                        <div class="i-checks">
                            <label> <input type="checkbox" class="cekpp" id="cekpp" name="cekpp"> <i></i> Pulang Pergi</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga ?>;padding-right:5px;"></i>Tempat Asal</label>
                        <input id="origin" name="origin" type="text" class="origin form-control" onclick="clearori()" required>
                    </div>

                    <div class="row">
                        <div class="tukar" style="position: relative; cursor:pointer; margin-top: 7px;" onclick="tukar()">
                            <span class="fa-stack fa-lg" style="position:absolute;bottom:-20px;right:16px;width:55px;">
                            <i class="fa fa-circle fa-stack-2x" style="color:<?php echo $warna_lembaga; ?>"></i>
                            <i class="fa fa-exchange fa-stack-1x fa-inverse fa-rotate-90"></i>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga ?>;padding-right:5px;"></i> Tempat Tujuan</label>
                        <input id="destination" name="destination" type="text" class="destination form-control" onclick="cleardest()" required>
                    </div>

                    <div class="form-group" id="tanggalpergi">
                        <label> Tanggal Pergi</label>
                        <div class="input-group date">
                            <?php $today = date("d/m/Y"); ?>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input id="dppergi" type="text" name="tglpergi" class="form-control" value="<?php echo $today?>" onchange="ubahtglpergi()" required>
                        </div>
                    </div>

                    <div class="form-group" id="tanggalpulang" style="display:none;margin-top: 28px">
                        <label> Tanggal Pulang</label>
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input id="dppulang" type="text" name="tglpulang" class="form-control" value="<?php echo $today?>" required>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 30px;">
                        <div class="col-sm-8" style="border-right: solid 1px;">
                            <label> Dewasa (>= 3 thn) :  </label><br/>
                            <div class="col-sm-6">
                                <label> Pria </label><br/>
                                <select class="form-control" name="jmlpria" id="jmlpria" required>
                                    <?php
                                    for($i=0; $i<=10; $i++){
                                        echo '<option>'.$i.'</option>';
                                    }
                                    ?>
                                </select><br/>
                            </div>
                            <div class="col-sm-6">
                                <label> Wanita </label><br/>
                                <select class="form-control" name="jmlwanita" id="jmlwanita" required>
                                    <?php
                                    for($i=0; $i<=10; $i++){
                                        echo '<option>'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label> Bayi (< 3 thn) : </label>
                            <select class="form-control" name="jmlbayi" id="jmlbayi" style="margin-top: 20px;" required>
                                <?php
                                for($i=0; $i<=10; $i++){
                                    echo '<option>'.$i.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding-top: 150px;">
                        <button id="btnsubmit" class="btn btn-danger" onclick="submittiket()" style="display: block; width: 100%;" disabled>Cari Jadwal</button>
                    </div>

                </form>

            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>

</div>

<!-- /content -->


</div>
