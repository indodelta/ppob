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
                <a href="<?php echo base_url('pesawat')?>">Pesan Tiket</a>
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

$departure = $this->input->post('air_from',true);
$arrival = $this->input->post('air_to',true);
$departureDate = $this->input->post('tglpergi',true);
$returnDate = $this->input->post('tglpulang',true);
$adult = $this->input->post('jml_adult',true);
$child = $this->input->post('jml_child',true);
$infant = $this->input->post('jml_infant',true);
$txbairlinename = $this->input->post('airlineName',true);
$txbairlineicon = $this->input->post('airlineIcon',true);
$txbairlinecode = $this->input->post('airline',true);

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
        <input type="hidden" id="page" value="cari_jadwal">

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

<?php

if($cekreturn == 'on'){
    $margintop = '400px';
    ?>

    <!-- Form Pilih Pulang pergi -->
    <div class="row" style="position: fixed; z-index: 1; margin-top: 203px; width: 100%;">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="row">

                <div class="ibox-content" style="padding-top: 20px; padding-left: 50px;">

                    <div class="row">

                        <form method="post" id="formpilihpulangpergi" target="_blank">

                        <div class="col-xs-10">

                            <div class="row" id="formsebelumpilihpergi" style="display: block;">
                                <h3>Jadwal Pesawat Pergi belum dipilih</h3>
                            </div>

                            <div class="row" id="formpilihpergi" style="display: none;">

                                <div class="col-xs-1"><img id="iconpilihpergi" class="img-md"></div>
                                <div class="col-xs-3 text-center">
                                    <text id="transitpilihpergi" style="font-size: 14px; font-weight: bold; color: #ED5565;"></text><br/>
                                    <text id="detailtransitpilihpergi" style="font-size: 12px; color: lightgrey;"></text>

                                </div>
                                <div class="col-xs-4">

                                    <text style="font-size: 14px;">
                                        <span style="font-weight: bold;">Pergi: </span><?php echo $depname.' ke '.$arrname;?>
                                    </text>
                                    <br/>
                                    <text style="font-size: 14px;"><?php echo hari($departureDatedb).', '.$departureDateindo;?></text>
                                    <br/>
                                    <text id="flightcodepilihpergi" style="font-size: 12px; color: lightgrey;"></text>

                                </div>
                                <div class="col-xs-2">
                                    <text id="jampergipilihpergi" style="font-size: 18px; font-weight: bold"></text><br/>
                                    <text style="font-size: 12px; color: lightgrey;"><?php echo $depname;?></text>
                                </div>
                                <div class="col-xs-2">
                                    <text id="jamtibapilihpergi" style="font-size: 18px; font-weight: bold"></text><br/>
                                    <text style="font-size: 12px; color: lightgrey;"><?php echo $arrname;?></text>
                                </div>

                            </div>

                            <hr/>

                            <div class="row" id="formsebelumpilihpulang" style="display: block;">
                                <h3>Jadwal Pesawat Pulang belum dipilih</h3>
                            </div>

                            <div class="row" id="formpilihpulang" style="display: none;">

                                <div class="col-xs-1"><img id="iconpilihpulang" class="img-md"></div>
                                <div class="col-xs-3 text-center">
                                    <text id="transitpilihpulang" style="font-size: 14px; font-weight: bold; color: #ED5565;"></text><br/>
                                    <text id="detailtransitpilihpulang" style="font-size: 12px; color: lightgrey;"></text>

                                </div>
                                <div class="col-xs-4">

                                    <text style="font-size: 14px;">
                                        <span style="font-weight: bold;">Pulang: </span><?php echo $arrname.' ke '.$depname;?>
                                    </text>
                                    <br/>
                                    <text style="font-size: 14px;"><?php echo $tanggalpulang;?></text>
                                    <br/>
                                    <text id="flightcodepilihpulang" style="font-size: 12px; color: lightgrey;"></text>

                                </div>
                                <div class="col-xs-2">
                                    <text id="jampergipilihpulang" style="font-size: 18px; font-weight: bold"></text><br/>
                                    <text style="font-size: 12px; color: lightgrey;"><?php echo $arrname;?></text>
                                </div>
                                <div class="col-xs-2">
                                    <text id="jamtibapilihpulang" style="font-size: 18px; font-weight: bold"></text><br/>
                                    <text style="font-size: 12px; color: lightgrey;"><?php echo $depname;?></text>
                                </div>

                            </div>

                        </div>
                        <div class="col-xs-2" id="forminputpilihpergi">

                            <!--pesawat pergi-->
                            <div id="rowinputpilihpergi">

                                <input type="hidden" id="txbjumlahpesawatpergi" name="jumlahpesawatpergi">
                                <input type="hidden" id="txbjumlahclassespergi" name="jumlahclassespergi">
                                <input type="hidden" id="txbistransitpergi" name="istransitpergi">
                                <input type="hidden" id="txbairlinecodepergi" name="airlinecodepergi">
                                <input type="hidden" id="txbjampergipergi" name="jampergipergi">
                                <input type="hidden" id="txbjamtibapergi" name="jamtibapergi">

                            </div>

                            <!--pesawat pulang-->
                            <div id="rowinputpilihpulang">

                                <input type="hidden" id="txbjumlahpesawatpulang" name="jumlahpesawatpulang">
                                <input type="hidden" id="txbjumlahclassespulang" name="jumlahclassespulang">
                                <input type="hidden" id="txbistransitpulang" name="istransitpulang">
                                <input type="hidden" id="txbairlinecodepulang" name="airlinecodepulang">
                                <input type="hidden" id="txbjampergipulang" name="jampergipulang">
                                <input type="hidden" id="txbjamtibapulang" name="jamtibapulang">

                            </div>

                            <div class="row text-center"
                                 style="border-left: solid 1px grey; height: 150px; padding-top: 30px;">
                                <h2 id="flighttotalhargapp" style="color: #ED5565">Rp 0</h2>
                                <input type="hidden" id="flighthargapergi" value="0">
                                <input type="hidden" id="flighthargapulang" value="0">

                                <input type="hidden" name="pulangpergi" value="<?php echo $cekreturn;?>">
                                <input type="hidden" name="air_from" value="<?php echo $departure;?>">
                                <input type="hidden" name="air_to" value="<?php echo $arrival;?>">
                                <input type="hidden" name="departuredate" value="<?php echo $departureDate;?>">
                                <input type="hidden" name="returndate" value="<?php echo $returnDate;?>">
                                <input type="hidden" name="adult" value="<?php echo $adult;?>">
                                <input type="hidden" name="child" value="<?php echo $child;?>">
                                <input type="hidden" name="infant" value="<?php echo $infant;?>">


                                <button type="button" class="btn btn-danger" id="btnsubmitpulangpergi" onclick="submitpulangpergi()"> PESAN SEKARANG
                                </button>
                            </div>

                        </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>

    <?php
}else{
    $margintop = '220px';
}
?>

<!-- Content -->

<div class="wrapper wrapper-content animated fadeInRight article" style="margin-top: <?php echo $margintop;?>;">

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">

            <div class="ibox float-e-margins" >

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
                                <label class="control-label" style="color: <?php echo $warna_lembaga; ?>;">
                                    Pilih Maskapai
                                </label>
                                <br/>
                                <br/>
                                <?php

                                $disabled = '';
                                if ($config != null){

                                    $jmlairline = count($config->data->settings);

                                    for ($i = 0; $i < $jmlairline; $i++) {
                                        if($config->data->settings[$i]->isActive == 1) {
                                            $cnfairlineCode = $config->data->settings[$i]->airline;
                                            $cnfairlineName = $config->data->settings[$i]->airlineName;
                                            $cnfairlineIcon = $config->data->settings[$i]->icon;

                                            if (get_http_response_code($cnfairlineIcon) != "200") {
                                                $cnfairlineIcon = base_url('assets/img/No_Image_Available.png');
                                            }

                                            ?>

                                            <div class="i-checks-airline" style="float: left; margin-right: 20px;">
                                                <input type="radio"
                                                       value="<?php echo $cnfairlineCode ?>"
                                                       name="airline"
                                                       class="airline"
                                                       data-airlineicon="<?php echo $cnfairlineIcon;?>"
                                                       data-airlinename="<?php echo $cnfairlineName;?>"
                                                    <?php if($txbairlinecode==$cnfairlineCode) echo 'checked';?>>
                                                <img class="img-sm" src="<?php echo $cnfairlineIcon; ?>" style="width: 70px;">
                                                <?php echo $cnfairlineName;?>
                                            </div>

                                            <?php
                                        }
                                    }

                                }else{

                                    $disabled = 'disabled';
                                    ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        Terjadi kesalahan API pada proses pemanggilan data airline.<br/>
                                        Mohon maaf, karena ini anda tidak bisa melakukan booking pesawat
                                    </div>
                                    <?php

                                }
                                ?>
                                <input type="hidden" id="airlineName" name="airlineName" value="<?php echo $txbairlinename; ?>">
                                <input type="hidden" id="airlineIcon" name="airlineIcon" value="<?php echo $txbairlineicon; ?>">
                            </div>
                            <div class="col-xs-4">
                                <button class="ladda-button btn btn-danger" type="submit" data-style="zoom-in" style="display: block; width: 100%;">Cari Jadwal</button>
                            </div>
                        </div>

                    </form>

                </div>

                <?php

                if($cekreturn == 'on'){

                    $jumlahairlinepergi = count($jadwal->pergi);
                    $jumlahairlinepulang = count($jadwal->pulang);

                    ?>

                    <text style="font-size: 12px; margin-top: 10px;">* Bila Harga yang tertera masih 0, harga akan ditampilkan di halaman selanjutnya.</text><br/>
                    <text style="font-size: 12px;">* Harga Sewaktu-waktu bisa berubah dan Belum termasuk biaya administrasi</text><br/>
                    <br/>

                    <!-- Form Pilih Jadwal-->

                    <div class="ibox-content" style="padding-left: 20px; padding-right: 20px;">

                        <div class="row">

                            <!-- Jadwal Pergi-->
                            <div class="col-lg-6">

                                <div class="row center-block" style="background-color:<?php echo $warna_lembaga ?>; color: white; width: 100%;">
                                    <h3 style="margin-left: 5px;">Pergi : <br/><?php echo $departurename;?> >>> <?php echo $arrivalname; ?></h3>
                                    <span style="margin-left: 5px;"><?php echo hari($departureDatedb).', '.$departureDateindo;?></span>
                                </div>

                                <?php
                                if($jumlahairlinepergi > 0){

                                    for ($per = 0; $per < $jumlahairlinepergi; $per++) {

                                        $aircodepergi = $jadwal->pergi[$per]->data[0]->airlineCode;
                                        $airnamepergi = $jadwal->pergi[$per]->data[0]->airlineName;
                                        $airiconpergi = $jadwal->pergi[$per]->data[0]->airlineIcon;

                                        if (get_http_response_code($airiconpergi) != "200") {
                                            $airicon = base_url('assets/img/No_Image_Available.png');
                                        }

                                        ?>

                                        <div class="ibox <?php if($per!=0){ echo 'collapsed';} ?>" style="margin-top: 0px;">

                                            <div class="ibox-title red-bg" style="padding-top: 15px;">

                                                <div class="row">
                                                    <div class="col-xs-3 text-right">
                                                        <img class="img-md" src="<?php echo $airiconpergi; ?>" style="width: 100px;">
                                                    </div>
                                                    <div class="col-xs-7" style="padding-left: 0px;">
                                                        <h2 style="margin-top: 20px;"><?php echo $airnamepergi; ?></h2>
                                                        <input type="hidden" id="aircode" value="<?php echo $aircodepergi; ?>">
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <div class="ibox-tools">
                                                            <a class="collapse-link">
                                                                <i class="fa fa-chevron-up fa-2x" style="color: white;"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="ibox-content" style="padding-left: 10px; padding-right: 10px;">

                                                <div class="table-responsive tooltip-demo">
                                                    <table class="table table-bordered table-hover datajadwalpesawatpergi"
                                                           style="font-size: 12px;">
                                                        <thead>
                                                        <tr class="text-center">
                                                            <th class="text-center">Pilih</th>
                                                            <th class="text-center">Pesawat</th>
                                                            <th class="text-center">Pergi</th>
                                                            <th class="text-center">Tiba</th>
                                                            <th class="text-center">Transit</th>
                                                            <th class="text-center">Harga</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $jumlahjadwalpergi = count($jadwal->pergi[$per]->data);

                                                        for ($x = 0; $x < $jumlahjadwalpergi; $x++) {
                                                            $jumlahpesawatpergi = count($jadwal->pergi[$per]->data[$x]->detailTitle);
                                                            $jumlahclassespergi = count($jadwal->pergi[$per]->data[$x]->classes);
                                                            $airlinecodepergi = $jadwal->pergi[$per]->data[$x]->airlineCode;
                                                            $jampergipergi = $jadwal->pergi[$per]->data[$x]->detailTitle[0]->depart;
                                                            $jamtibapergi = $jadwal->pergi[$per]->data[$x]->detailTitle[0]->arrival;
                                                            $istransitpergi = $jadwal->pergi[$per]->data[$x]->isTransit;
                                                            $transitpergi = 'Langsung';
                                                            $detailtransitpergi='';

                                                            if ($istransitpergi == true) {
                                                                $keytibapergi = $jumlahpesawatpergi - 1;
                                                                $jamtibapergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$keytibapergi]->arrival;
                                                                $transitpergi = $keytibapergi . ' Transit';
                                                                for ($b = 0; $b < $jumlahpesawatpergi; $b++) {
                                                                    $originpergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$b]->origin;
                                                                    $destinationpergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$b]->destination;
                                                                    $departpergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$b]->depart;
                                                                    $arrivpergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$b]->arrival;
                                                                    $dettransitpergi= $originpergi . ' - ' . $destinationpergi . ' ( ' . $departpergi . ' - ' . $arrivpergi . ' ), ';
                                                                    $detailtransitpergi= $detailtransitpergi.''.$dettransitpergi;
                                                                }
                                                            } else {
                                                                $detailtransitpergi = $departurecode . ' - ' . $arrivalcode . ' ( ' . $jampergipergi . ' - ' . $jamtibapergi . ' )';
                                                            }
                                                            $idpergi = 'PERGI'.$aircodepergi.''.$x;

                                                            $flightcdpergi='';
                                                            for ($a = 0; $a < $jumlahpesawatpergi; $a++) {
                                                                $flightcodepergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$a]->flightCode. '/';
                                                                $flightcdpergi = $flightcdpergi.''.$flightcodepergi;
                                                            }

                                                            $hargapergi = 0;
                                                            for ($c = 0; $c < $jumlahclassespergi; $c++) {
                                                                $pricepergi = $jadwal->pergi[$per]->data[$x]->classes[$c][0]->price;
                                                                $hargapergi = $hargapergi + $pricepergi;
                                                            }
                                                            ?>

                                                            <tr class="text-center">

                                                                <td style="vertical-align: middle;">

                                                                    <div class="i-checks-pergi">
                                                                        <input type="radio"
                                                                               id="pilihpergi"
                                                                               value="dipilih"
                                                                               class="pilihpergi"
                                                                               name="pilihpergi"
                                                                               data-airlineicon="<?php echo $airiconpergi;?>"
                                                                               data-transit="<?php echo $transitpergi;?>"
                                                                               data-flightcode="<?php echo $flightcdpergi; ?>"
                                                                               data-jampergi="<?php echo $jampergipergi; ?>"
                                                                               data-jamtiba="<?php echo $jamtibapergi; ?>"
                                                                               data-harga="<?php echo $hargapergi; ?>"
                                                                               data-jumlahpesawatpergi="<?php echo $jumlahpesawatpergi; ?>"
                                                                               data-jumlahclassespergi="<?php echo $jumlahclassespergi; ?>"
                                                                               data-istransitpergi="<?php echo $istransitpergi; ?>"
                                                                               data-airlinecodepergi="<?php echo $airlinecodepergi; ?>"
                                                                            <?php $dettransitpergi = str_replace(",","<br/>",$detailtransitpergi);?>
                                                                               data-detailtransit="<?php echo $dettransitpergi; ?>"
                                                                            <?php
                                                                                for ($jppi = 0; $jppi < $jumlahpesawatpergi; $jppi++) {
                                                                                    $flightcodeper = $jadwal->pergi[$per]->data[$x]->detailTitle[$jppi]->flightCode;
                                                                                    $transitTimeper = $jadwal->pergi[$per]->data[$x]->detailTitle[$jppi]->transitTime;
                                                                                    $flightIconper = $jadwal->pergi[$per]->data[$x]->detailTitle[$jppi]->flightIcon;
                                                                                    $flightNameper = $jadwal->pergi[$per]->data[$x]->detailTitle[$jppi]->flightName;
                                                                                    $classper = $jadwal->pergi[$per]->data[$x]->classes[0][0]->class;
                                                                                    $seatper = $jadwal->pergi[$per]->data[$x]->classes[0][0]->seat;
                                                                                    if($jumlahpesawatpergi == $jumlahclassespergi){
                                                                                        $classper = $jadwal->pergi[$per]->data[$x]->classes[$jppi][0]->class;
                                                                                        $seatper = $jadwal->pergi[$per]->data[$x]->classes[$jppi][0]->seat;
                                                                                    }
                                                                                    $departper = $jadwal->pergi[$per]->data[$x]->detailTitle[$jppi]->depart;
                                                                                    $originper = $jadwal->pergi[$per]->data[$x]->detailTitle[$jppi]->origin;
                                                                                    $originNameper = $jadwal->pergi[$per]->data[$x]->detailTitle[$jppi]->originName;
                                                                                    $transitName1per = $originNameper . ' ( ' . $originper . ' )';
                                                                                    $arrivper = $jadwal->pergi[$per]->data[$x]->detailTitle[$jppi]->arrival;
                                                                                    $destinationper = $jadwal->pergi[$per]->data[$x]->detailTitle[$jppi]->destination;
                                                                                    $destinationNameper = $jadwal->pergi[$per]->data[$x]->detailTitle[$jppi]->destinationName;
                                                                                    $transitName2per = $destinationNameper . ' ( ' . $destinationper . ' )';

                                                                                    ?>
                                                                                    data-flightcodepergi<?php echo $jppi;?>="<?php echo $flightcodeper; ?>"
                                                                                    data-transittimepergi<?php echo $jppi;?>="<?php echo $transitTimeper; ?>"
                                                                                    data-flighticonpergi<?php echo $jppi;?>="<?php echo $flightIconper; ?>"
                                                                                    data-flightnamepergi<?php echo $jppi;?>="<?php echo $flightNameper; ?>"
                                                                                    data-flightclasspergi<?php echo $jppi;?>="<?php echo $classper; ?>"
                                                                                    data-seatspergi<?php echo $jppi;?>="<?php echo $seatper; ?>"
                                                                                    data-departtimepergi<?php echo $jppi;?>="<?php echo $departper; ?>"
                                                                                    data-transitname1pergi<?php echo $jppi;?>="<?php echo $transitName1per; ?>"
                                                                                    data-arrivaltimepergi<?php echo $jppi;?>="<?php echo $arrivper; ?>"
                                                                                    data-transitname2pergi<?php echo $jppi;?>="<?php echo $transitName2per; ?>"
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                        >
                                                                    </div>

                                                                </td>

                                                                <td style="vertical-align: middle;">
                                                                    <?php
                                                                    $flightcdpergi = str_replace("/","<br/>",$flightcdpergi);
                                                                    echo $flightcdpergi.'<br/>';
                                                                    ?>
                                                                </td>
                                                                <td style="vertical-align: middle;">
                                                                    <?php
                                                                    echo '<text style="font-size: 18px; font-weight: bold">' . $jampergipergi . '</text><br/>' . $depname;
                                                                    ?>
                                                                </td>
                                                                <td style="vertical-align: middle;">
                                                                    <?php
                                                                    echo '<text style="font-size: 18px; font-weight: bold">' . $jamtibapergi . '</text><br/>' . $arrname;
                                                                    ?>
                                                                </td>
                                                                <td style="vertical-align: middle;">
                                                                    <text data-toggle="tooltip"
                                                                          data-placement="top"
                                                                          title="<?php echo $detailtransitpergi;?>"
                                                                          style="cursor: pointer; color: #ed5565;">
                                                                          <?php
                                                                            if($istransitpergi == true){
                                                                                ?>
                                                                                <a data-toggle="collapse" data-target="#<?php echo $idpergi;?>">
                                                                                    <text style="color: #ED5565;"><?php echo $transitpergi; ?></text>
                                                                                    <i class="fa fa-eye" style="color: #ED5565;"></i>
                                                                                </a>
                                                                                <?php
                                                                            }else{
                                                                                echo $transitpergi;
                                                                            }
                                                                          ?>
                                                                    </text>
                                                                </td>
                                                                <td style="vertical-align: middle;">
                                                                    <text style="font-size: 18px; font-weight: bold; color: #ED5565;">
                                                                        <?php echo rupiah($hargapergi); ?>
                                                                    </text>
                                                                </td>

                                                            </tr>
                                                            <tr id="<?php echo $idpergi; ?>" class="collapse">
                                                                <td colspan="6">

                                                                    <table class="table no-borders" style="font-size: 12px;">

                                                                        <?php
                                                                        if ($istransitpergi == true) {
                                                                            for ($d = 0; $d < $jumlahpesawatpergi; $d++) {

                                                                                $flightIconpergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$d]->flightIcon;
                                                                                $flightNamepergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$d]->flightName;
                                                                                $flightCodepergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$d]->flightCode;
                                                                                $departpergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$d]->depart;
                                                                                $originpergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$d]->origin;
                                                                                $originNamepergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$d]->originName;
                                                                                $transitName1pergi = $originNamepergi . ' ( ' . $originpergi . ' )';
                                                                                $arrivpergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$d]->arrival;
                                                                                $destinationpergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$d]->destination;
                                                                                $destinationNamepergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$d]->destinationName;
                                                                                $transitName2pergi = $destinationNamepergi . ' ( ' . $destinationpergi . ' )';
                                                                                $transitTimepergi = $jadwal->pergi[$per]->data[$x]->detailTitle[$d]->transitTime;


                                                                                if (get_http_response_code($flightIconpergi) != "200") {
                                                                                    $flightIconpergi = base_url('assets/img/No_Image_Available.png');
                                                                                }

                                                                                if($transitTimepergi != '0j0m'){
                                                                                    $transitTimepergi = str_replace("m"," Menit ",$transitTimepergi);
                                                                                    $transitTimepergi = str_replace("j"," Jam ",$transitTimepergi);
                                                                                    $txbtransitpergi = 'Transit di '.$transitName1pergi.' selama '.$transitTimepergi;
                                                                                    ?>

                                                                                    <tr class="text-center" style="background-color:#F4F4F5; padding: 0px;">
                                                                                        <td colspan="4" style="vertical-align: middle; padding: 0px;">
                                                                                            <input type="text" class="text-center" value="<?php echo $txbtransitpergi;?>" style="width: 100%; font-size: 14px; border: none; background-color: white; color: black;" readonly>
                                                                                        </td>
                                                                                    </tr>

                                                                                    <?php
                                                                                }
                                                                                ?>

                                                                                <tr class="text-center" style="background-color:#F4F4F5;">
                                                                                    <td style="border-right: none;vertical-align: middle;">
                                                                                        <?php echo $originpergi . ' > ' . $destinationpergi; ?>
                                                                                    </td>
                                                                                    <td style="border-right: none; border-left: none;vertical-align: middle;">
                                                                                        <img class="img-sm" src="<?php echo $flightIconpergi; ?>"
                                                                                             style="width: 50px;"><br/>
                                                                                        <?php echo $flightNamepergi; ?><br/>
                                                                                        <?php echo $flightCodepergi; ?>
                                                                                    </td>
                                                                                    <td style="border-right: none; border-left: none;vertical-align: middle;">
                                                                                        <?php
                                                                                        echo '<text style="font-size: 18px; font-weight: bold">' . $departpergi . '</text><br/>' . $transitName1pergi;
                                                                                        ?>
                                                                                    </td>
                                                                                    <td style="border-right: none;vertical-align: middle;">
                                                                                        <?php
                                                                                        echo '<text style="font-size: 18px; font-weight: bold">' . $arrivpergi . '</text><br/>' . $transitName2pergi;
                                                                                        ?>
                                                                                    </td>
                                                                                </tr>

                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>

                                                                    </table>

                                                                </td>
                                                            </tr>

                                                            <?php
                                                        }
                                                        ?>

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                        </div>

                                        <?php
                                    }

                                    ?>

                                    <?php
                                }else{
                                    ?>

                                    <div class="row text-center">

                                        <h2>
                                            JADWAL PENERBANGAN PERGI UNTUK MASKAPAI<br/>
                                            <img class="img-md" src="<?php echo $txbairlineicon; ?>" style="width: 120px;">
                                            <?php echo $txbairlinename;?><br/>
                                            TIDAK DITEMUKAN
                                        </h2><br/>
                                        <h2>Lakukan Pencarian Jadwal Pesawat Kembali</h2><br/>
                                        <button class="btn btn-danger" onclick="closeWin()">Kembali ke form pencarian</button>

                                    </div>

                                    <?php
                                }
                                ?>

                            </div>

                            <!-- Jadwal Pulang-->
                            <div class="col-lg-6">

                                <div class="row center-block" style="background-color:<?php echo $warna_lembaga ?>; color: white; width: 100%;">
                                    <h3 style="margin-left: 5px;">Pulang : <br/><?php echo $arrivalname;?> >>> <?php echo $departurename; ?></h3>
                                    <span style="margin-left: 5px;"><?php echo $tanggalpulang;?></span>
                                </div>

                                <?php
                                if($jumlahairlinepulang > 0){

                                    for ($pul = 0; $pul < $jumlahairlinepulang; $pul++) {

                                        $aircodepulang = $jadwal->pulang[$pul]->data[0]->airlineCode;
                                        $airnamepulang = $jadwal->pulang[$pul]->data[0]->airlineName;
                                        $airiconpulang = $jadwal->pulang[$pul]->data[0]->airlineIcon;

                                        ?>

                                        <div class="ibox <?php if($pul!=0){ echo 'collapsed';} ?>" style="margin-top: 0px;">

                                            <div class="ibox-title red-bg" style="padding-top: 15px;">

                                                <div class="row">
                                                    <div class="col-xs-3 text-right">
                                                        <img class="img-md" src="<?php echo $airiconpulang; ?>" style="width: 100px;">
                                                    </div>
                                                    <div class="col-xs-7" style="padding-left: 0px;">
                                                        <h2 style="margin-top: 20px;"><?php echo $airnamepulang; ?></h2>
                                                        <input type="hidden" id="aircode" value="<?php echo $aircodepulang; ?>">
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <div class="ibox-tools">
                                                            <a class="collapse-link">
                                                                <i class="fa fa-chevron-up fa-2x" style="color: white;"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="ibox-content" style="padding-left: 10px; padding-right: 10px;">

                                                <div class="table-responsive tooltip-demo">
                                                    <table class="table table-bordered table-hover datajadwalpesawatpulang"
                                                           style="font-size: 12px;">
                                                        <thead>
                                                        <tr class="text-center">
                                                            <th class="text-center">Pilih</th>
                                                            <th class="text-center">Pesawat</th>
                                                            <th class="text-center">Pergi</th>
                                                            <th class="text-center">Tiba</th>
                                                            <th class="text-center">Transit</th>
                                                            <th class="text-center">Harga</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $jumlahjadwalpulang = count($jadwal->pulang[$pul]->data);

                                                        for ($x = 0; $x < $jumlahjadwalpulang; $x++) {
                                                            $jumlahpesawatpulang = count($jadwal->pulang[$pul]->data[$x]->detailTitle);
                                                            $jumlahclassespulang = count($jadwal->pulang[$pul]->data[$x]->classes);
                                                            $airlinecodepulang = $jadwal->pulang[$pul]->data[$x]->airlineCode;
                                                            $jampergipulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[0]->depart;
                                                            $jamtibapulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[0]->arrival;
                                                            $istransitpulang = $jadwal->pulang[$pul]->data[$x]->isTransit;
                                                            $transitpulang = 'Langsung';
                                                            $detailtransitpulang='';

                                                            if ($istransitpulang == true) {
                                                                $keytibapulang = $jumlahpesawatpulang - 1;
                                                                $jamtibapulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$keytibapulang]->arrival;
                                                                $transitpulang = $keytibapulang . ' Transit';
                                                                for ($b = 0; $b < $jumlahpesawatpulang; $b++) {
                                                                    $originpulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$b]->origin;
                                                                    $destinationpulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$b]->destination;
                                                                    $departpulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$b]->depart;
                                                                    $arrivpulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$b]->arrival;
                                                                    $dettransitpulang= $originpulang . ' - ' . $destinationpulang . ' ( ' . $departpulang . ' - ' . $arrivpulang . ' ), ';
                                                                    $detailtransitpulang= $detailtransitpulang.''.$dettransitpulang;
                                                                }
                                                            } else {
                                                                $detailtransitpulang = $departurecode . ' - ' . $arrivalcode . ' ( ' . $jampergipulang . ' - ' . $jamtibapulang . ' )';
                                                            }
                                                            $idpulang = 'pulang'.$aircodepulang.''.$x;

                                                            $flightcdpulang='';
                                                            for ($a = 0; $a < $jumlahpesawatpulang; $a++) {
                                                                $flightcodepulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$a]->flightCode. '/';
                                                                $flightcdpulang = $flightcdpulang.''.$flightcodepulang;
                                                            }

                                                            $hargapulang = 0;
                                                            for ($c = 0; $c < $jumlahclassespulang; $c++) {
                                                                $pricepulang = $jadwal->pulang[$pul]->data[$x]->classes[$c][0]->price;
                                                                $hargapulang = $hargapulang + $pricepulang;
                                                            }
                                                            ?>

                                                            <tr class="text-center">

                                                                <td style="vertical-align: middle;">

                                                                    <div class="i-checks-pulang">
                                                                        <input type="radio"
                                                                               id="pilihpulang"
                                                                               value="dipilih"
                                                                               class="pilihpulang"
                                                                               name="pilihpulang"
                                                                               data-airlineicon="<?php echo $airiconpulang;?>"
                                                                               data-transit="<?php echo $transitpulang;?>"
                                                                               data-flightcode="<?php echo $flightcdpulang; ?>"
                                                                               data-jampergi="<?php echo $jampergipulang; ?>"
                                                                               data-jamtiba="<?php echo $jamtibapulang; ?>"
                                                                               data-harga="<?php echo $hargapulang; ?>"
                                                                               data-jumlahpesawatpulang="<?php echo $jumlahpesawatpulang; ?>"
                                                                               data-jumlahclassespulang="<?php echo $jumlahclassespulang; ?>"
                                                                               data-istransitpulang="<?php echo $istransitpulang; ?>"
                                                                               data-airlinecodepulang="<?php echo $airlinecodepulang; ?>"
                                                                            <?php $dettransitpulang = str_replace(",","<br/>",$detailtransitpulang);?>
                                                                               data-detailtransit="<?php echo $dettransitpulang; ?>"
                                                                            <?php
                                                                            for ($jppg = 0; $jppg < $jumlahpesawatpulang; $jppg++) {
                                                                                $flightcodepul = $jadwal->pulang[$pul]->data[$x]->detailTitle[$jppg]->flightCode;
                                                                                $transitTimepul = $jadwal->pulang[$pul]->data[$x]->detailTitle[$jppg]->transitTime;
                                                                                $flightIconpul = $jadwal->pulang[$pul]->data[$x]->detailTitle[$jppg]->flightIcon;
                                                                                $flightNamepul = $jadwal->pulang[$pul]->data[$x]->detailTitle[$jppg]->flightName;
                                                                                $classpul = $jadwal->pulang[$pul]->data[$x]->classes[0][0]->class;
                                                                                $seatpul = $jadwal->pulang[$pul]->data[$x]->classes[0][0]->seat;
                                                                                if($jumlahpesawatpulang == $jumlahclassespulang){
                                                                                    $classpul = $jadwal->pulang[$pul]->data[$x]->classes[$jppg][0]->class;
                                                                                    $seatpul = $jadwal->pulang[$pul]->data[$x]->classes[$jppg][0]->seat;
                                                                                }
                                                                                $departpul = $jadwal->pulang[$pul]->data[$x]->detailTitle[$jppg]->depart;
                                                                                $originpul = $jadwal->pulang[$pul]->data[$x]->detailTitle[$jppg]->origin;
                                                                                $originNamepul = $jadwal->pulang[$pul]->data[$x]->detailTitle[$jppg]->originName;
                                                                                $transitName1pul = $originNamepul . ' ( ' . $originpul . ' )';
                                                                                $arrivpul = $jadwal->pulang[$pul]->data[$x]->detailTitle[$jppg]->arrival;
                                                                                $destinationpul = $jadwal->pulang[$pul]->data[$x]->detailTitle[$jppg]->destination;
                                                                                $destinationNamepul = $jadwal->pulang[$pul]->data[$x]->detailTitle[$jppg]->destinationName;
                                                                                $transitName2pul = $destinationNamepul . ' ( ' . $destinationpul . ' )';

                                                                                ?>
                                                                                data-flightcodepulang<?php echo $jppg;?>="<?php echo $flightcodepul; ?>"
                                                                                data-transittimepulang<?php echo $jppg;?>="<?php echo $transitTimepul; ?>"
                                                                                data-flighticonpulang<?php echo $jppg;?>="<?php echo $flightIconpul; ?>"
                                                                                data-flightnamepulang<?php echo $jppg;?>="<?php echo $flightNamepul; ?>"
                                                                                data-flightclasspulang<?php echo $jppg;?>="<?php echo $classpul; ?>"
                                                                                data-seatspulang<?php echo $jppg;?>="<?php echo $seatpul; ?>"
                                                                                data-departtimepulang<?php echo $jppg;?>="<?php echo $departpul; ?>"
                                                                                data-transitname1pulang<?php echo $jppg;?>="<?php echo $transitName1pul; ?>"
                                                                                data-arrivaltimepulang<?php echo $jppg;?>="<?php echo $arrivpul; ?>"
                                                                                data-transitname2pulang<?php echo $jppg;?>="<?php echo $transitName2pul; ?>"
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        >
                                                                    </div>

                                                                </td>

                                                                <td style="vertical-align: middle;">
                                                                    <?php
                                                                    $flightcdpulang = str_replace("/","<br/>",$flightcdpulang);
                                                                    echo $flightcdpulang.'<br/>';
                                                                    ?>
                                                                </td>
                                                                <td style="vertical-align: middle;">
                                                                    <?php
                                                                    echo '<text style="font-size: 18px; font-weight: bold">' . $jampergipulang . '</text><br/>' . $arrname;
                                                                    ?>
                                                                </td>
                                                                <td style="vertical-align: middle;">
                                                                    <?php
                                                                    echo '<text style="font-size: 18px; font-weight: bold">' . $jamtibapulang . '</text><br/>' . $depname;
                                                                    ?>
                                                                </td>
                                                                <td style="vertical-align: middle;">
                                                                    <text data-toggle="tooltip"
                                                                          data-placement="top"
                                                                          title="<?php echo $detailtransitpulang;?>"
                                                                          style="cursor: pointer; color: #ed5565;">
                                                                        <?php
                                                                        if($istransitpulang == true){
                                                                            ?>
                                                                            <a data-toggle="collapse" data-target="#<?php echo $idpulang;?>">
                                                                                <text style="color: #ED5565;"><?php echo $transitpulang; ?></text>
                                                                                <i class="fa fa-eye" style="color: #ED5565;"></i>
                                                                            </a>
                                                                            <?php
                                                                        }else{
                                                                            echo $transitpulang;
                                                                        }
                                                                        ?>
                                                                    </text>
                                                                </td>
                                                                <td style="vertical-align: middle;">
                                                                    <text style="font-size: 18px; font-weight: bold; color: #ED5565;">
                                                                        <?php echo rupiah($hargapulang); ?>
                                                                    </text>
                                                                </td>

                                                            </tr>
                                                            <tr id="<?php echo $idpulang; ?>" class="collapse">
                                                                <td colspan="6">

                                                                    <table class="table no-borders" style="font-size: 12px;">

                                                                        <?php
                                                                        if ($istransitpulang == true) {
                                                                            for ($d = 0; $d < $jumlahpesawatpulang; $d++) {

                                                                                $flightIconpulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$d]->flightIcon;
                                                                                $flightNamepulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$d]->flightName;
                                                                                $flightCodepulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$d]->flightCode;
                                                                                $departpulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$d]->depart;
                                                                                $originpulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$d]->origin;
                                                                                $originNamepulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$d]->originName;
                                                                                $transitName1pulang = $originNamepulang . ' ( ' . $originpulang . ' )';
                                                                                $arrivpulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$d]->arrival;
                                                                                $destinationpulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$d]->destination;
                                                                                $destinationNamepulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$d]->destinationName;
                                                                                $transitName2pulang = $destinationNamepulang . ' ( ' . $destinationpulang . ' )';
                                                                                $transitTimepulang = $jadwal->pulang[$pul]->data[$x]->detailTitle[$d]->transitTime;

                                                                                if (get_http_response_code($flightIconpulang) != "200") {
                                                                                    $flightIconpulang = base_url('assets/img/No_Image_Available.png');
                                                                                }

                                                                                if($transitTimepulang != '0j0m'){
                                                                                    $transitTimepulang = str_replace("m"," Menit ",$transitTimepulang);
                                                                                    $transitTimepulang = str_replace("j"," Jam ",$transitTimepulang);
                                                                                    $txbtransitpulang = 'Transit di '.$transitName1pulang.' selama '.$transitTimepulang;
                                                                                    ?>
                                                                                    <tr class="text-center" style="background-color:#F4F4F5; padding: 0px;">
                                                                                        <td colspan="4" style="vertical-align: middle; padding: 0px;">
                                                                                            <input type="text" class="text-center" value="<?php echo $txbtransitpulang;?>" style="width: 100%; font-size: 14px; border: none; background-color: white; color: black;" readonly>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                                ?>

                                                                                <tr class="text-center" style="background-color:#F4F4F5;">
                                                                                    <td style="border-left: none;vertical-align: middle;">
                                                                                        <?php echo $originpulang . ' > ' . $destinationpulang; ?>
                                                                                    </td>
                                                                                    <td style="border-right: none; border-left: none;vertical-align: middle;">
                                                                                        <img class="img-sm" src="<?php echo $flightIconpulang; ?>"
                                                                                             style="width: 50px;"><br/>
                                                                                        <?php echo $flightNamepulang; ?><br/>
                                                                                        <?php echo $flightCodepulang; ?>
                                                                                    </td>
                                                                                    <td style="border-right: none; border-left: none;vertical-align: middle;">
                                                                                        <?php
                                                                                        echo '<text style="font-size: 18px; font-weight: bold">' . $departpulang . '</text><br/>' . $transitName1pulang;
                                                                                        ?>
                                                                                    </td>
                                                                                    <td style="border-right: none;vertical-align: middle;">
                                                                                        <?php
                                                                                        echo '<text style="font-size: 18px; font-weight: bold">' . $arrivpulang . '</text><br/>' . $transitName2pulang;
                                                                                        ?>
                                                                                    </td>
                                                                                </tr>

                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>

                                                                    </table>

                                                                </td>
                                                            </tr>

                                                            <?php
                                                        }
                                                        ?>

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                        </div>

                                        <?php
                                    }

                                    ?>

                                    <?php
                                }else{
                                    ?>

                                    <div class="row text-center">

                                        <h2>
                                            JADWAL PENERBANGAN PULANG UNTUK MASKAPAI<br/>
                                            <img class="img-md" src="<?php echo $txbairlineicon; ?>" style="width: 120px;">
                                            <?php echo $txbairlinename;?><br/>
                                            TIDAK DITEMUKAN
                                        </h2><br/>
                                        <h2>Lakukan Pencarian Jadwal Pesawat Kembali</h2><br/>
                                        <button class="btn btn-danger" onclick="closeWin()">Kembali ke form pencarian</button>

                                    </div>

                                    <?php
                                }
                                ?>

                            </div>

                        </div>

                    </div>



                    <?php
                }else{

                    $jumlahairline = count($jadwal);

                    if($jumlahairline == 0){

                        ?>

                        <div class="ibox-content">

                            <div class="row text-center">

                                <h1>
                                    JADWAL PENERBANGAN UNTUK MASKAPAI<br/>
                                    <img class="img-md" src="<?php echo $txbairlineicon; ?>" style="width: 120px;">
                                    <?php echo $txbairlinename;?><br/>
                                    TIDAK DITEMUKAN
                                </h1><br/>
                                <h2>Lakukan Pencarian Jadwal Pesawat Kembali</h2><br/>
                                <button class="btn btn-danger" onclick="closeWin()">Kembali ke form pencarian</button>

                            </div>

                        </div>

                        <?php
                    }else {

                        ?>

                        <input type="hidden" id="jumlahairline" value="<?php echo $jumlahairline; ?>">
                        <input type="hidden" id="departurecode" value="<?php echo $departurecode; ?>">
                        <input type="hidden" id="arrivalcode" value="<?php echo $arrivalcode; ?>">
                        <input type="hidden" id="departuredate" value="<?php echo $departureDatedb; ?>">
                        <input type="hidden" id="returndate" value="<?php echo $returnDatedb; ?>">
                        <input type="hidden" id="adult" value="<?php echo $adult; ?>">
                        <input type="hidden" id="child" value="<?php echo $child; ?>">
                        <input type="hidden" id="infant" value="<?php echo $infant; ?>">

                        <text style="font-size: 12px; margin-top: 10px;">* Bila Harga yang tertera masih 0, harga akan ditampilkan di halaman selanjutnya.</text><br/>
                        <text style="font-size: 12px;">* Harga Sewaktu-waktu bisa berubah dan Belum termasuk biaya administrasi</text><br/><br/>

                        <?php

                        for ($x = 0; $x < $jumlahairline; $x++) {

                            $aircode = $jadwal[$x]->data[0]->airlineCode;
                            $airname = $jadwal[$x]->data[0]->airlineName;
                            $airicon = $jadwal[$x]->data[0]->airlineIcon;

                            if (get_http_response_code($airicon) != "200") {
                                $airicon = base_url('assets/img/No_Image_Available.png');
                            }

                            ?>

                            <div class="ibox <?php if($x!=0){ echo 'collapsed';} ?>">

                                <div class="ibox-title red-bg" style="padding-top: 15px;">

                                    <div class="row">
                                        <div class="col-xs-2 text-right">
                                            <img class="img-md" src="<?php echo $airicon; ?>" style="width: 100px;">
                                        </div>
                                        <div class="col-xs-8" style="padding-left: 0px;">
                                            <h2 style="margin-top: 20px;"><?php echo $airname; ?></h2>
                                            <input type="hidden" id="aircode" value="<?php echo $aircode; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <div class="ibox-tools">
                                                <a class="collapse-link">
                                                    <i class="fa fa-chevron-up fa-2x" style="color: white;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="ibox-content">

                                    <?php $jumlahjadwal = count($jadwal[$x]->data); ?>

                                    <text style="font-size: 14px; font-weight: bold;">
                                        Jadwal Penerbangan ada : <span
                                                style="color: #ED5565;"><?php echo $jumlahjadwal; ?></span> Rute Penerbangan
                                    </text>

                                    <div class="table-responsive tooltip-demo">
                                        <table class="table table-bordered table-hover datajadwalpesawat"
                                               style="font-size: 12px;">
                                            <thead>
                                            <tr class="text-center">
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Pesawat</th>
                                                <th class="text-center">Pergi</th>
                                                <th class="text-center">Tiba</th>
                                                <th class="text-center">Transit</th>
                                                <th class="text-center">Harga</th>
                                                <th class="text-center"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $no = 1;
                                            for ($y = 0; $y < $jumlahjadwal; $y++) {
                                                $jumlahpesawat = count($jadwal[$x]->data[$y]->detailTitle);
                                                $jmlclasses = count($jadwal[$x]->data[$y]->classes);
                                                $airlinecode = $jadwal[$x]->data[$y]->airlineCode;
                                                $istransit = $jadwal[$x]->data[$y]->isTransit;
                                                $pergi = $jadwal[$x]->data[$y]->detailTitle[0]->depart;
                                                if ($istransit == true) {
                                                    $keytiba = $jumlahpesawat - 1;
                                                    $tiba = $jadwal[$x]->data[$y]->detailTitle[$keytiba]->arrival;
                                                    $transit = $keytiba . ' Transit';
                                                } else {
                                                    $tiba = $jadwal[$x]->data[$y]->detailTitle[0]->arrival;
                                                    $transit = 'Langsung';
                                                }
                                                $id = $aircode.''.$y;


                                                $namaform = 'formpilihpergi'.$x.''.$y;

                                                ?>

                                                <!--form pilih penerbangan-->

                                                <form id="<?php echo $namaform; ?>" method="post" target="_blank">

                                                <tr class="text-center">
                                                    <td style="vertical-align: middle;"><?php echo $no++; ?></td>
                                                    <td style="vertical-align: middle;">
                                                        <?php
                                                        for ($b = 0; $b < $jumlahpesawat; $b++) {

                                                            $flightIcon = $jadwal[$x]->data[$y]->detailTitle[$b]->flightIcon;
                                                            $flightName = $jadwal[$x]->data[$y]->detailTitle[$b]->flightName;
                                                            $flightCode = $jadwal[$x]->data[$y]->detailTitle[$b]->flightCode;
                                                            $depart = $jadwal[$x]->data[$y]->detailTitle[$b]->depart;
                                                            $origin = $jadwal[$x]->data[$y]->detailTitle[$b]->origin;
                                                            $originName = $jadwal[$x]->data[$y]->detailTitle[$b]->originName;
                                                            $transitName1 = $originName . ' ( ' . $origin . ' )';
                                                            $arriv = $jadwal[$x]->data[$y]->detailTitle[$b]->arrival;
                                                            $destination = $jadwal[$x]->data[$y]->detailTitle[$b]->destination;
                                                            $destinationName = $jadwal[$x]->data[$y]->detailTitle[$b]->destinationName;
                                                            $transitName2 = $destinationName . ' ( ' . $destination . ' )';
                                                            $transitTime = $jadwal[$x]->data[$y]->detailTitle[$b]->transitTime;
                                                            $class = $jadwal[$x]->data[$y]->classes[0][0]->class;
                                                            $seat = $jadwal[$x]->data[$y]->classes[0][0]->seat;
                                                            if($jumlahpesawat == $jmlclasses){
                                                                $class = $jadwal[$x]->data[$y]->classes[$b][0]->class;
                                                                $seat = $jadwal[$x]->data[$y]->classes[$b][0]->seat;
                                                            }

                                                            $txbtransittimeperginame = 'transittimepergi'.$b;
                                                            $txbflightcodeperginame = 'flightcodepergi'.$b;
                                                            $txbflightnameperginame = 'flightnamepergi'.$b;
                                                            $txbflighticonperginame = 'flighticonpergi'.$b;
                                                            $txbflightclassperginame = 'flightclasspergi'.$b;
                                                            $txbdeparttimeperginame = 'departtimepergi'.$b;
                                                            $txbarrivaltimeperginame = 'arrivaltimepergi'.$b;
                                                            $txbtransitname1perginame = 'transitname1pergi'.$b;
                                                            $txbtransitname2perginame = 'transitname2pergi'.$b;
                                                            $txbseatperginame = 'seatspergi'.$b;
                                                            ?>
                                                            <input type="text" class="text-center" name="<?php echo $txbflightcodeperginame;?>" value="<?php echo $flightCode;?>" style="border: none;background-color: transparent; max-width: 50px;"><br/>

                                                            <input type="hidden" class="text-center" name="<?php echo $txbtransittimeperginame;?>" value="<?php echo $transitTime;?>">
                                                            <input type="hidden" class="text-center" name="<?php echo $txbflighticonperginame;?>" value="<?php echo $flightIcon;?>">
                                                            <input type="hidden" class="text-center" name="<?php echo $txbflightnameperginame;?>" value="<?php echo $flightName;?>">
                                                            <input type="hidden" class="text-center" name="<?php echo $txbflightclassperginame;?>" value="<?php echo $class;?>">
                                                            <input type="hidden" class="text-center" name="<?php echo $txbdeparttimeperginame;?>" value="<?php echo $depart;?>">
                                                            <input type="hidden" class="text-center" name="<?php echo $txbarrivaltimeperginame;?>" value="<?php echo $arriv;?>">
                                                            <input type="hidden" class="text-center" name="<?php echo $txbtransitname1perginame;?>" value="<?php echo $transitName1;?>">
                                                            <input type="hidden" class="text-center" name="<?php echo $txbtransitname2perginame;?>" value="<?php echo $transitName2;?>">
                                                            <input type="hidden" class="text-center" name="<?php echo $txbseatperginame;?>" value="<?php echo $seat;?>">
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <?php
                                                        echo '<text style="font-size: 18px; font-weight: bold">' . $pergi . '</text><br/>' . $depname;
                                                        ?>
                                                        <input type="hidden" class="text-center" name="jampergipergi" value="<?php echo $pergi;?>">
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <?php
                                                        echo '<text style="font-size: 18px; font-weight: bold">' . $tiba . '</text><br/>' . $arrname;
                                                        ?>
                                                        <input type="hidden" class="text-center" name="jamtibapergi" value="<?php echo $tiba;?>">
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <text data-toggle="tooltip"
                                                              data-placement="top"
                                                              data-aircode="<?php echo $aircode ?>"
                                                              data-number="<?php echo $y ?>"
                                                              title="<?php
                                                              if ($istransit == true) {
                                                                  for ($a = 0; $a < $jumlahpesawat; $a++) {
                                                                      $origin = $jadwal[$x]->data[$y]->detailTitle[$a]->origin;
                                                                      $destination = $jadwal[$x]->data[$y]->detailTitle[$a]->destination;
                                                                      $depart = $jadwal[$x]->data[$y]->detailTitle[$a]->depart;
                                                                      $arriv = $jadwal[$x]->data[$y]->detailTitle[$a]->arrival;
                                                                      echo $origin . ' - ' . $destination . ' ( ' . $depart . ' - ' . $arriv . ' ), ';
                                                                  }
                                                              } else {
                                                                  echo $departurecode . ' - ' . $arrivalcode . ' ( ' . $pergi . ' - ' . $tiba . ' )';
                                                              }
                                                              ?>"
                                                              style="cursor: pointer; color: #ed5565;">
                                                            <?php
                                                            if($istransit == true){
                                                               ?>
                                                                <a data-toggle="collapse" data-target="#<?php echo $id;?>">
                                                                    <text style="color: #ED5565;"><?php echo $transit;?></text>
                                                                    <i class="fa fa-eye" style="color: #ED5565;"></i>
                                                                </a>
                                                                <?php
                                                            }else{
                                                                echo $transit;
                                                            }
                                                            ?>
                                                        </text>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <?php
                                                        $harga = 0;
                                                        for ($d = 0; $d < $jmlclasses; $d++) {
                                                            $price = $jadwal[$x]->data[$y]->classes[$d][0]->price;
                                                            $harga = $harga + $price;
                                                        }
                                                        ?>
                                                        <text style="font-size: 18px; font-weight: bold; color: #ED5565;">
                                                            <?php echo rupiah($harga); ?>
                                                            <input type="hidden" class="text-center" name="hargapergi" value="<?php echo $harga;?>">
                                                        </text>
                                                    </td>

                                                    <td style="vertical-align: middle;">
                                                        <?php
                                                        for ($e = 0; $e < $jmlclasses; $e++) {
                                                            $availability = $jadwal[$x]->data[$y]->classes[$e][0]->availability;
                                                        }
                                                        ?>

                                                            <input type="hidden" name="pulangpergi" value="<?php echo $cekreturn;?>">
                                                            <input type="hidden" name="air_from" value="<?php echo $departure;?>">
                                                            <input type="hidden" name="air_to" value="<?php echo $arrival;?>">
                                                            <input type="hidden" name="departuredate" value="<?php echo $departureDate;?>">
                                                            <input type="hidden" name="returndate" value="<?php echo $returnDate;?>">
                                                            <input type="hidden" name="adult" value="<?php echo $adult;?>">
                                                            <input type="hidden" name="child" value="<?php echo $child;?>">
                                                            <input type="hidden" name="infant" value="<?php echo $infant;?>">
                                                            <input type="hidden" name="jumlahpesawatpergi" value="<?php echo $jumlahpesawat;?>">
                                                            <input type="hidden" name="jumlahclassespergi" value="<?php echo $jmlclasses;?>">
                                                            <input type="hidden" name="istransitpergi" value="<?php echo $istransit;?>">
                                                            <input type="hidden" name="airlinecodepergi" value="<?php echo $airlinecode;?>">

                                                            <button type="button"
                                                                    class="btn btn-danger"
                                                                    data-noairline="<?php echo $x;?>"
                                                                    data-nojadwal="<?php echo $y;?>"
                                                                    data-airlinename="<?php echo $airname;?>"
                                                                <?php
                                                                if ($istransit == false) {
                                                                    ?>
                                                                    data-toggle="tooltip"
                                                                    data-placement="right"
                                                                    title="<?php
                                                                    for ($e = 0; $e < $jmlclasses; $e++) {
                                                                        $availability = $jadwal[$x]->data[$y]->classes[$e][0]->availability;
                                                                        echo 'Sisa Kursi = ' . $availability;
                                                                    } ?>"
                                                                    <?php
                                                                }
                                                                ?>
                                                                    onclick="submitpergi(this)">
                                                                Pesan Sekarang
                                                            </button>

                                                    </td>
                                                </tr>
                                                <tr id="<?php echo $id; ?>" class="collapse">
                                                    <td colspan="7">

                                                        <table class="table no-borders" style="font-size: 12px;">

                                                            <?php
                                                            if ($istransit == true) {
                                                                for ($c = 0; $c < $jumlahpesawat; $c++) {

                                                                    $flightIcon = $jadwal[$x]->data[$y]->detailTitle[$c]->flightIcon;
                                                                    $flightName = $jadwal[$x]->data[$y]->detailTitle[$c]->flightName;
                                                                    $flightCode = $jadwal[$x]->data[$y]->detailTitle[$c]->flightCode;
                                                                    $depart = $jadwal[$x]->data[$y]->detailTitle[$c]->depart;
                                                                    $origin = $jadwal[$x]->data[$y]->detailTitle[$c]->origin;
                                                                    $originName = $jadwal[$x]->data[$y]->detailTitle[$c]->originName;
                                                                    $transitName1 = $originName . ' ( ' . $origin . ' )';
                                                                    $arriv = $jadwal[$x]->data[$y]->detailTitle[$c]->arrival;
                                                                    $destination = $jadwal[$x]->data[$y]->detailTitle[$c]->destination;
                                                                    $destinationName = $jadwal[$x]->data[$y]->detailTitle[$c]->destinationName;
                                                                    $transitName2 = $destinationName . ' ( ' . $destination . ' )';
                                                                    if ($jumlahpesawat == $jmlclasses) {
                                                                        $availability = $jadwal[$x]->data[$y]->classes[$c][0]->availability;
                                                                    } else {
                                                                        $availability = $jadwal[$x]->data[$y]->classes[0][0]->availability;
                                                                    }

                                                                    $transitTime = $jadwal[$x]->data[$y]->detailTitle[$c]->transitTime;

                                                                    if($transitTime != '0j0m'){
                                                                        $transitTime = str_replace("m"," Menit ",$transitTime);
                                                                        $transitTime = str_replace("j"," Jam ",$transitTime);
                                                                        $txbtransit = 'Transit di '.$transitName1.' selama '.$transitTime;
                                                                        ?>
                                                                        <tr class="text-center" style="background-color:#F4F4F5; padding: 0px;">
                                                                            <td colspan="7" style="vertical-align: middle; padding: 0px;">
                                                                                <input type="text" class="text-center" value="<?php echo $txbtransit;?>" style="width: 100%; font-size: 14px; border: none; background-color: white; color: black;" readonly>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }

                                                                    ?>

                                                                    <tr class="text-center" style="background-color:#F4F4F5;">
                                                                        <td style="border-right: none;vertical-align: middle;">

                                                                        </td>
                                                                        <td style="border-right: none;border-left: none;vertical-align: middle;">
                                                                            <?php echo $origin . ' > ' . $destination; ?>
                                                                        </td>
                                                                        <td style="border-right: none; border-left: none;vertical-align: middle;">
                                                                            <img class="img-sm" src="<?php echo $flightIcon; ?>"
                                                                                 style="width: 50px;"><br/>
                                                                            <?php echo $flightName; ?><br/>
                                                                            <?php echo $flightCode; ?>
                                                                        </td>
                                                                        <td style="border-right: none; border-left: none;vertical-align: middle;">
                                                                            <?php
                                                                            echo '<text style="font-size: 18px; font-weight: bold">' . $depart . '</text><br/>' . $transitName1;
                                                                            ?>
                                                                        </td>
                                                                        <td style="border-right: none; border-left: none;vertical-align: middle;">
                                                                            <?php
                                                                            echo '<text style="font-size: 18px; font-weight: bold">' . $arriv . '</text><br/>' . $transitName2;
                                                                            ?>
                                                                        </td>
                                                                        <td style="border-right: none; border-left: none;vertical-align: middle;"></td>
                                                                        <td style="border-left: none; vertical-align: middle;">
                                                                            <?php
                                                                            echo '<text style="color: #ED5565;">Sisa Kursi = ' . $availability . '</text>';
                                                                            ?>
                                                                        </td>
                                                                    </tr>

                                                                    <?php
                                                                }
                                                            }
                                                            ?>

                                                        </table>

                                                    </td>
                                                </tr>

                                                </form>

                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>

                            <?php

                        }

                    }

                }

                ?>

            </div>

        </div>

        <div class="col-lg-2">

        </div>

    </div>

</div>

<!-- /content -->

