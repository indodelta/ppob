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

<div class="row wrapper border-bottom white-bg page-heading"
     style="position: fixed; z-index: 1; width: 100%">
    <div class="col-lg-10">
        <ol class="breadcrumb" style="padding-top: 60px;">
            <li>
                <a href="<?php echo base_url('dashboard')?>">Home</a>
            </li>
            <li>
                <a href="<?php echo base_url('penerbangan')?>">Pesan Tiket</a>
            </li>
            <li class="active">
                <strong>Info Jadwal Penerbangan</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<?php
$this->load->view('func_custom');

$cekreturn = $this->input->post('cekreturn');
$airline = $this->input->post('airline',true);

$departure = $this->input->post('air_from',true);
$arrival = $this->input->post('air_to',true);
$departureDate = $this->input->post('tglpergi',true);
$returnDate = $this->input->post('tglpulang',true);
$adult = $this->input->post('jml_adult',true);
$child = $this->input->post('jml_child',true);
$infant = $this->input->post('jml_infant',true);

$expdeparture = explode('-', $departure);
$departurecode = $expdeparture[0];
$departurename = $expdeparture[1];
$expdeparturename = explode('|', $departurename);
$depname = str_replace(" ","",$expdeparturename[0]);

$exparrival = explode('-', $arrival);
$arrivalcode = $exparrival[0];
$arrivalname = $exparrival[1];
$exparrivalname = explode('|', $arrivalname);
$arrname = str_replace(" ","",$exparrivalname[0]);

$expdepartureDate = explode('/', $departureDate);
$bulandepartureDate = bulan($expdepartureDate[1]);
$departureDateindo = $expdepartureDate[0] . ' ' . $bulandepartureDate . ' ' .$expdepartureDate[2];
$departureDatedb = $expdepartureDate[2] . '-' . $expdepartureDate[1] . '-' .$expdepartureDate[0];

$expreturnDate = explode('/', $returnDate);
$bulanreturnDate = bulan($expreturnDate[1]);
$returnDateindo = $expreturnDate[0].' '.$bulanreturnDate.' '.$expreturnDate[2];
$returnDatedb = $expreturnDate[2].'-'.$expreturnDate[1].'-'.$expreturnDate[0];

if($cekreturn == 'on'){
    $tanggalpulang = hari($returnDatedb).', '.$returnDateindo;
    $displaydppulangenable = 'block';
    $displaydppulangdisable = 'none';
    $checked = 'checked';
    $pp = '(PP)';
}else{
    $tanggalpulang = '';
    $displaydppulangenable = 'none';
    $displaydppulangdisable = 'block';
    $checked = '';
    $pp = '';
}
?>


<!-- Judul Pergi dan Tujuan -->

<div class="row" style="position: fixed; z-index: 1;margin-top: 99px; width: 100%">

    <div class="ibox-content red-bg">

        <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="col-lg-10">
                    <h2><?php echo $departurename;?> ke <?php echo $arrivalname; ?> <?php echo $pp; ?></h2>
                    <h3>
                        <i class="fa fa-calendar"></i>
                        <?php echo hari($departureDatedb).', '.$departureDateindo; ?> - <?php echo $tanggalpulang; ?>
                        | <i class="fa fa-user"></i> <?php echo $adult; ?> Adult
                        <?php
                        if($child>0){ echo ' | '.$child.' Child';}
                        if($infant>0){ echo ' | '.$infant.' Infant';}
                        ?>
                    </h3>
                </div>
                <div class="col-lg-2">
                    <a href="#" onclick="showubahcari()" style="color: white" id="btnubahcari"><h3>Ubah Pencarian</h3></a>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>

    </div>

</div>

<!-- Content -->

<div class="wrapper wrapper-content animated fadeInRight article" style="margin-top: 190px;">

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">

            <div class="ibox float-e-margins">

                <!-- Form Pencarian -->

                <div class="ibox-content formubahcari" id="formubahcari" style="display: none;">

                    <form id="formpesantiket" class="form-horizontal" method="post" action="cari_jadwal" autocomplete="off">
                        <div class="form-group">
                            <div class="col-lg-2">
                                <div class="i-checks-pesawat">
                                    <label> <input type="checkbox" class="cekreturn" name="cekreturn" id="cekreturn" <?php echo $checked;?>> <i></i> <span style="color: <?php echo $warna_lembaga; ?>;">Pulang Pergi</span></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-lg-4">
                                <label><i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;padding-right:5px;"></i> <span style="color: <?php echo $warna_lembaga; ?>;">FROM</span></label>
                                <input
                                        id="air_from"
                                        name="air_from"
                                        type="text"
                                        placeholder="Airport..."
                                        class="form-control air_from"
                                        onclick="clearairfrom()"
                                        value="<?php echo $departure;?>"
                                        required/>
                                <br/>
                                <div class="tukar_airport" style="position: relative; cursor:pointer; margin-top: 7px;" onclick="tukar_airport()">
                                        <span class="fa-stack fa-lg" style="position:absolute;bottom:-20px;right:16px;width:55px;">
                                        <i class="fa fa-circle fa-stack-2x" style="color:<?php echo $warna_lembaga; ?>;"></i>
                                        <i class="fa fa-exchange fa-stack-1x fa-inverse fa-rotate-90"></i>
                                        </span>
                                </div>
                                <br>
                                <label><i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;padding-right:5px;"></i> <span style="color: <?php echo $warna_lembaga; ?>;">TO</span></label>
                                <input id="air_to" name="air_to" type="text" placeholder="Airport..." class="form-control air_to" onclick="clearairto()" value="<?php echo $arrival;?>" required/>
                            </div>

                            <div class="col-lg-4">
                                <div id="tanggalpergi">
                                    <label style="color: <?php echo $warna_lembaga; ?>;"> Pergi</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input id="dppergi" name="tglpergi" type="text" class="form-control" value="<?php echo $departureDate?>" onchange="ubahtglpergi()" required>
                                    </div>
                                </div>
                                <br/><br/>
                                <div id="tanggalpulang" style="margin-top: 7px; display: <?php echo $displaydppulangenable;?>;">
                                    <label style="color: <?php echo $warna_lembaga; ?>;"> Pulang</label>
                                    <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        <input id="dppulangenable" name="tglpulang" type="text" class="form-control" value="<?php echo $returnDate?>" required>
                                    </div>
                                </div>
                                <div id="tanggalpulangdisable" style="margin-top: 7px; display: <?php echo $displaydppulangdisable;?>;">
                                    <label style="color: <?php echo $warna_lembaga; ?>;"> Pulang</label>
                                    <div class="input-group date">
                                            <span class="input-group-addon"style="cursor: not-allowed; color: #c2c2c2 !important;">
                                                <i class="fa fa-calendar" style="cursor: not-allowed;"></i>
                                            </span>
                                        <input id="dppulangdisable" name="tglpulang" type="text" class="form-control" value="<?php echo $returnDate?>" disabled required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">

                                <div class="form-group">

                                    <label class="col-lg-6 control-label" style="color: <?php echo $warna_lembaga; ?>; margin-top: 20px;">ADULT ( > 12 Years)</label>
                                    <div class="col-lg-6">
                                        <input id="jml_adult" name="jml_adult" type="number" class="form-control text-right" min="1" style="margin-top: 20px;" value="<?php echo $adult?>" required/>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-lg-6 control-label" style="color: <?php echo $warna_lembaga; ?>; margin-top: 20px;">CHILD ( 2 -12 Years)</label>
                                    <div class="col-lg-6">
                                        <input id="jml_child" name="jml_child" type="number" class="form-control text-right" min="0" style="margin-top: 20px;" value="<?php echo $child?>" required/>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-lg-6 control-label" style="color: <?php echo $warna_lembaga; ?>; margin-top: 15px;">INFANT (0 - 2 Years)</label>
                                    <div class="col-lg-6">
                                        <input id="jml_infant" name="jml_infant" type="number" class="form-control text-right" min="0" style="margin-top: 15px;" value="<?php echo $infant?>" required/>
                                    </div>
                                </div>


                            </div>

                        </div>

                        <div class="form-group" style="margin-top: 50px;">
                            <div class="col-xs-8">

                                <?php

                                $jmlairline = 0;

                                if ($airline != null){

                                    $jmlairline = count($airline);

                                    for ($i = 0; $i < $jmlairline; $i++) {
                                        $idtxbairline = 'airline'.$i;
                                        ?>
                                        <input type="hidden" id="<?= $idtxbairline;?>" name="airline[]" value="<?php echo $airline[$i] ?>">
                                        <?php
                                    }
                                }else{
                                    $jmlairline = 0;
                                    ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        Terjadi kesalahan API pada proses pemanggilan data airline dan data airport.<br/>
                                        Pemesanan tidak dapat dilanjutkan <br/>
                                        Silahkan reload kembali halaman ini sampai API terkoneksi kembali.
                                    </div>
                                    <?php
                                }

                                ?>

                                <div id="errorapiairport" class="alert alert-warning alert-dismissable" style="display: none;">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    Terjadi kesalahan API pada proses pemanggilan data airport.<br/>
                                    Pemesanan tidak dapat dilanjutkan <br/>
                                    Silahkan reload kembali halaman ini sampai API terkoneksi kembali.
                                </div>

                            </div>
                            <div class="col-xs-4">
                                <button id="btnsubmit" class="ladda-button btn btn-danger" type="submit" data-style="zoom-in" style="display: block; width: 100%;">Cari Jadwal</button>
                            </div>
                        </div>

                    </form>

                </div>

                <input type="hidden" name="cekreturn" id="cekpp" value="<?php echo $cekreturn;?>">
                <input type="hidden" id="jumlahairline" value="<?php echo $jmlairline;?>">
                <input type="hidden" name="air_from" id="air_from" value="<?php echo $departure;?>">
                <input type="hidden" name="air_to" id="air_to" value="<?php echo $arrival;?>">
                <input type="hidden" name="tglpergi" id="tgl_pergi" value="<?php echo $departureDate;?>">
                <input type="hidden" name="tglpulang" id="tgl_pulang" value="<?php echo $returnDate;?>">
                <input type="hidden" name="jml_adult" id="adult" value="<?php echo $adult;?>">
                <input type="hidden" name="jml_child" id="child" value="<?php echo $child;?>">
                <input type="hidden" name="jml_infant" id="infant" value="<?php echo $infant;?>">

            </div>

            <div id="loading" class="alert alert-info col-lg-12">
                Sedang Mencari Jadwal Penerbangan, Mohon untuk menunggu beberapa saat <span class="loading"></span>
            </div>

            <div id="divjadwal"></div>



        </div>

        <div class="col-lg-2">

        </div>

    </div>


</div>

<!-- /content -->
