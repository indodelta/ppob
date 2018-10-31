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
                <strong>Pesan Tiket Bus Travel</strong>
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
                <i class="fa fa-bus" style="font-size:1em;margin-right:10px;color: <?php echo $warna_lembaga ?>;"></i>
                <span style="color: <?php echo $warna_lembaga ?>">Pesan Tiket Bus Travel</span>
            </h2>
            <div class="widget white-bg p-lg">

                <form id="formpesantiket" method="post" action="bus/viewjadwalbus" autocomplete="off">

                    <div class="form-group">
                        <label><i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga ?>;padding-right:5px;"></i>Tempat Asal</label>
                        <input id="st_from" name="st_from" type="text" class="st_from form-control" onclick="clearstfrom()" required>
<!--                                               --><?php //echo $this->session->userdata('tokenft') ?>
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
                        <label><i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga ?>;padding-right:5px;"></i> Tempat Tujuan</label>
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
                        <label> Jumlah Orang </label>
                        <select class="form-control" name="jmldewasa" required>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-danger" type="submit" style="display: block; width: 100%;">Cari Jadwal</button>
                    </div>

                </form>

            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>

</div>

<!-- /content -->


</div>
