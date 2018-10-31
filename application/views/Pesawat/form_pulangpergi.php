<?php
$nama_lembaga = $this->config->item("nama_lembaga"); $logo_lembaga = $this->config->item("logo_lembaga");
$css_lembaga = $this->config->item("css_lembaga"); $warna_lembaga = $this->config->item("warna_lembaga");
if (sizeof($data_lembaga)>0) {
    $nama_lembaga = $data_lembaga[0]["nama"];
    $logo_lembaga = $data_lembaga[0]["logo"];
    $css_lembaga = $data_lembaga[0]["css"];
    $warna_lembaga = $data_lembaga[0]["warna"];
}

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

$jumlahairlinepergi = count($jadwal[0]);
$jumlahairlinepulang = count($jadwal[1]);

?>

<!-- Form Hasil Pilihan -->

<div class="ibox-content" style="width: 100%; padding-top: 20px; padding-left: 50px; padding-bottom: 0px;">

    <div class="row">

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

            <form method="post" id="formpilihpulangpergi" target="_blank">

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
                    <h2 id="flighttotalhargapp" style="color: <?php echo $warna_lembaga?>">Rp 0</h2>
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

            </form>

        </div>

    </div>

    <div class="row" style="padding-top: 10px; padding-bottom: 0px;">
        <div class="col-lg-12">
            <?php
            if($jumlahairlinepergi > 0 or $jumlahairlinepulang > 0){
                ?>

                <text style="font-size: 12px; margin-top: 10px;">* Bila Harga yang tertera masih 0, harga akan ditampilkan di halaman selanjutnya.</text><br/>
                <text style="font-size: 12px;">* Harga Sewaktu-waktu bisa berubah dan Belum termasuk biaya administrasi</text><br/><br/>

                <?php
            }
            ?>
        </div>
    </div>

</div>

<!-- Form Pilih Pulang pergi -->

<div class="ibox-content" style="padding-top: 10px; padding-left: 20px; padding-right: 20px; max-height: 450px; overflow-y: scroll; overflow-x: hidden;">

    <div class="row">

        <!-- Jadwal Pergi-->
        <div class="col-lg-6">

            <div class="row center-block" style="background-color:<?php echo $warna_lembaga ?>; color: white; width: 100%;">
                <h3 style="margin-left: 5px;">Pergi : <br/><?php echo $departurename;?> >>> <?php echo $arrivalname; ?></h3>
                <span style="margin-left: 5px;"><?php echo hari($departureDatedb).', '.$departureDateindo;?></span>
            </div>

            <?php
            if($jumlahairlinepergi > 0) {

                $rc00pergi = 0;

                for ($per = 0; $per < $jumlahairlinepergi; $per++) {

                    if($jadwal[0][$per][0] != null){

                        $rcpergi = $jadwal[0][$per][0]['rc'];

                        if($rcpergi == '00'){
                            $rc00pergi += 1;
                        }

                    }

                }

                if($rc00pergi > 0){

                    for ($per = 0; $per < $jumlahairlinepergi; $per++) {

                        if($jadwal[0][$per][0] != null) {

                            $rcpergi = $jadwal[0][$per][0]['rc'];

                            if ($rcpergi == '00') {

                                $aircodepergi = $jadwal[0][$per][0]['data'][0]['airlineCode'];
                                $airnamepergi = $jadwal[0][$per][0]['data'][0]['airlineName'];
                                $airiconpergi = $jadwal[0][$per][0]['data'][0]['airlineIcon'];

                                if (get_http_response_code($airiconpergi) != "200") {
                                    $airicon = base_url('assets/img/No_Image_Available.png');
                                }

                                $idpergi = 'PERGI' . $aircodepergi;

                                $jumlahjadwalpergi = count($jadwal[0][$per][0]['data']);
                                for ($x = 0; $x < $jumlahjadwalpergi; $x++) {
                                    $idtransitpergi = 'PERGI' . $aircodepergi . '' . $x;

                                    $jumlahpesawatpergi = count($jadwal[0][$per][0]['data'][$x]['detailTitle']);
                                    $jumlahclassespergi = count($jadwal[0][$per][0]['data'][$x]['classes']);
                                    $istransitpergi = $jadwal[0][$per][0]['data'][$x]['isTransit'];
                                    if ($istransitpergi == 'true') {
                                        ?>

                                        <div class="modal inmodal fade" id="<?php echo $idtransitpergi ?>" tabindex="-1"
                                             role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2>Detail Transit</h2>
                                                        <button type="button" class="close" data-dismiss="modal"><span
                                                                    aria-hidden="true">&times;</span><span
                                                                    class="sr-only">Close</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <table class="table no-borders" style="font-size: 12px;">

                                                            <?php
                                                            for ($d = 0; $d < $jumlahpesawatpergi; $d++) {

                                                                $flightIconpergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$d]['flightIcon'];
                                                                $flightNamepergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$d]['flightName'];
                                                                $flightCodepergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$d]['flightCode'];
                                                                $departpergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$d]['depart'];
                                                                $originpergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$d]['origin'];
                                                                $originNamepergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$d]['originName'];
                                                                $transitName1pergi = $originNamepergi . ' ( ' . $originpergi . ' )';
                                                                $arrivpergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$d]['arrival'];
                                                                $destinationpergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$d]['destination'];
                                                                $destinationNamepergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$d]['destinationName'];
                                                                $transitName2pergi = $destinationNamepergi . ' ( ' . $destinationpergi . ' )';
                                                                $transitTimepergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$d]['transitTime'];


                                                                if (get_http_response_code($flightIconpergi) != "200") {
                                                                    $flightIconpergi = base_url('assets/img/No_Image_Available.png');
                                                                }

                                                                if ($jumlahpesawatpergi == $jumlahclassespergi) {
                                                                    $availabilitypergi = $jadwal[0][$per][0]['data'][$x]['classes'][$d][0]['availability'];
                                                                } else {
                                                                    $availabilitypergi = $jadwal[0][$per][0]['data'][$x]['classes'][0][0]['availability'];
                                                                }

                                                                if ($transitTimepergi != '0j0m') {
                                                                    $transitTimepergi = str_replace("m", " Menit ", $transitTimepergi);
                                                                    $transitTimepergi = str_replace("j", " Jam ", $transitTimepergi);
                                                                    $txbtransitpergi = 'Transit di ' . $transitName1pergi . ' selama ' . $transitTimepergi;
                                                                    ?>

                                                                    <tr class="text-center"
                                                                        style="background-color:#F4F4F5; padding: 0px;">
                                                                        <td colspan="4"
                                                                            style="vertical-align: middle; padding: 0px;">
                                                                            <input type="text" class="text-center"
                                                                                   value="<?php echo $txbtransitpergi; ?>"
                                                                                   style="width: 100%; font-size: 14px; border: none; background-color: white; color: black;"
                                                                                   readonly>
                                                                        </td>
                                                                    </tr>

                                                                    <?php
                                                                }
                                                                ?>

                                                                <tr class="text-center"
                                                                    style="background-color:#F4F4F5;">
                                                                    <td style="border-right: none;vertical-align: middle;">
                                                                        <?php echo $originpergi . ' > ' . $destinationpergi; ?>
                                                                        <br/>
                                                                        <text style="font-size: 12px; color: <?php echo $warna_lembaga; ?>"> <?php echo 'Sisa Kursi = ' . $availabilitypergi; ?></text>
                                                                    </td>
                                                                    <td style="border-right: none; border-left: none;vertical-align: middle;">
                                                                        <img class="img-sm"
                                                                             src="<?php echo $flightIconpergi; ?>"
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
                                                            ?>

                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <?php
                                    }

                                }

                                ?>

                                <div class="ibox" style="margin-top: 0px;">

                                    <div class="ibox-title red-bg" style="padding-top: 15px;">

                                        <div class="row">
                                            <div class="col-xs-3 text-right">
                                                <img class="img-md" src="<?php echo $airiconpergi; ?>"
                                                     style="width: 100px;">
                                            </div>
                                            <div class="col-xs-7" style="padding-left: 0px;">
                                                <h2 style="margin-top: 20px;"><?php echo $airnamepergi; ?></h2>
                                                <input type="hidden" id="aircode" value="<?php echo $aircodepergi; ?>">
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="ibox-tools">
                                                    <a data-toggle="collapse" data-target="#<?php echo $idpergi; ?>"
                                                       class="collapse-link">
                                                        <i class="fa fa-chevron-down fa-2x" style="color: white;"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div id="<?php echo $idpergi ?>" class="ibox-content <?php if ($per != 0) {
                                        echo 'collapse';
                                    } ?>" style="padding-left: 10px; padding-right: 10px;">

                                        <div class="table-responsive tooltip-demo">
                                            <table class="table table-bordered table-hover datajadwalpesawat"
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
                                                $jumlahjadwalpergi = count($jadwal[0][$per][0]['data']);
                                                for ($x = 0; $x < $jumlahjadwalpergi; $x++) {
                                                    $idtransitpergi = 'PERGI' . $aircodepergi . '' . $x;

                                                    $jumlahpesawatpergi = count($jadwal[0][$per][0]['data'][$x]['detailTitle']);
                                                    $jumlahclassespergi = count($jadwal[0][$per][0]['data'][$x]['classes']);
                                                    $airlinecodepergi = $jadwal[0][$per][0]['data'][$x]['airlineCode'];
                                                    $jampergipergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][0]['depart'];
                                                    $jamtibapergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][0]['arrival'];
                                                    $istransitpergi = $jadwal[0][$per][0]['data'][$x]['isTransit'];
                                                    $transitpergi = 'Langsung';
                                                    $detailtransitpergi = '';

                                                    $flightcdpergi = '';
                                                    for ($a = 0; $a < $jumlahpesawatpergi; $a++) {
                                                        $flightcodepergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$a]['flightCode'] . '/';
                                                        $flightcdpergi = $flightcdpergi . '' . $flightcodepergi;
                                                    }

                                                    if ($istransitpergi == 'true') {
                                                        $keytibapergi = $jumlahpesawatpergi - 1;
                                                        $jamtibapergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$keytibapergi]['arrival'];
                                                        $transitpergi = $keytibapergi . ' Transit';
                                                        for ($b = 0; $b < $jumlahpesawatpergi; $b++) {
                                                            $originpergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$b]['origin'];
                                                            $destinationpergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$b]['destination'];
                                                            $departpergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$b]['depart'];
                                                            $arrivpergi = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$b]['arrival'];
                                                            $dettransitpergi = $originpergi . ' - ' . $destinationpergi . ' ( ' . $departpergi . ' - ' . $arrivpergi . ' ), ';
                                                            $detailtransitpergi = $detailtransitpergi . '' . $dettransitpergi;
                                                        }
                                                    } else {
                                                        $detailtransitpergi = $departurecode . ' - ' . $arrivalcode . ' ( ' . $jampergipergi . ' - ' . $jamtibapergi . ' )';
                                                    }

                                                    $hargapergi = 0;
                                                    for ($c = 0; $c < $jumlahclassespergi; $c++) {
                                                        $pricepergi = $jadwal[0][$per][0]['data'][$x]['classes'][$c][0]['price'];
                                                        $hargapergi = $hargapergi + $pricepergi;
                                                        $availabilitypergi = $jadwal[0][$per][0]['data'][$x]['classes'][$c][0]['availability'];
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
                                                                       data-airlineicon="<?php echo $airiconpergi; ?>"
                                                                       data-transit="<?php echo $transitpergi; ?>"
                                                                       data-flightcode="<?php echo $flightcdpergi; ?>"
                                                                       data-jampergi="<?php echo $jampergipergi; ?>"
                                                                       data-jamtiba="<?php echo $jamtibapergi; ?>"
                                                                       data-harga="<?php echo $hargapergi; ?>"
                                                                       data-jumlahpesawatpergi="<?php echo $jumlahpesawatpergi; ?>"
                                                                       data-jumlahclassespergi="<?php echo $jumlahclassespergi; ?>"
                                                                       data-istransitpergi="<?php echo $istransitpergi; ?>"
                                                                       data-airlinecodepergi="<?php echo $airlinecodepergi; ?>"
                                                                    <?php $dettransitpergi = str_replace(",", "<br/>", $detailtransitpergi); ?>
                                                                       data-detailtransit="<?php echo $dettransitpergi; ?>"
                                                                    <?php
                                                                    for ($jppi = 0; $jppi < $jumlahpesawatpergi; $jppi++) {
                                                                        $flightcodeper = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$jppi]['flightCode'];
                                                                        $transitTimeper = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$jppi]['transitTime'];
                                                                        $flightIconper = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$jppi]['flightIcon'];
                                                                        $flightNameper = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$jppi]['flightName'];
                                                                        $classper = $jadwal[0][$per][0]['data'][$x]['classes'][0][0]['class'];
                                                                        $seatper = $jadwal[0][$per][0]['data'][$x]['classes'][0][0]['seat'];
                                                                        if ($jumlahpesawatpergi == $jumlahclassespergi) {
                                                                            $classper = $jadwal[0][$per][0]['data'][$x]['classes'][$jppi][0]['class'];
                                                                            $seatper = $jadwal[0][$per][0]['data'][$x]['classes'][$jppi][0]['seat'];
                                                                        }
                                                                        $departper = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$jppi]['depart'];
                                                                        $originper = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$jppi]['origin'];
                                                                        $originNameper = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$jppi]['originName'];
                                                                        $transitName1per = $originNameper . ' ( ' . $originper . ' )';
                                                                        $arrivper = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$jppi]['arrival'];
                                                                        $destinationper = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$jppi]['destination'];
                                                                        $destinationNameper = $jadwal[0][$per][0]['data'][$x]['detailTitle'][$jppi]['destinationName'];
                                                                        $transitName2per = $destinationNameper . ' ( ' . $destinationper . ' )';

                                                                        ?>
                                                                        data-flightcodepergi<?php echo $jppi; ?>="<?php echo $flightcodeper; ?>"
                                                                        data-transittimepergi<?php echo $jppi; ?>="<?php echo $transitTimeper; ?>"
                                                                        data-flighticonpergi<?php echo $jppi; ?>="<?php echo $flightIconper; ?>"
                                                                        data-flightnamepergi<?php echo $jppi; ?>="<?php echo $flightNameper; ?>"
                                                                        data-flightclasspergi<?php echo $jppi; ?>="<?php echo $classper; ?>"
                                                                        data-seatspergi<?php echo $jppi; ?>="<?php echo $seatper; ?>"
                                                                        data-departtimepergi<?php echo $jppi; ?>="<?php echo $departper; ?>"
                                                                        data-transitname1pergi<?php echo $jppi; ?>="<?php echo $transitName1per; ?>"
                                                                        data-arrivaltimepergi<?php echo $jppi; ?>="<?php echo $arrivper; ?>"
                                                                        data-transitname2pergi<?php echo $jppi; ?>="<?php echo $transitName2per; ?>"
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                >
                                                            </div>
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <?php
                                                            $flightcdpergi = str_replace("/", "<br/>", $flightcdpergi);
                                                            echo $flightcdpergi;

                                                            if ($istransitpergi == 'false') {
                                                                ?>
                                                                <text style="font-size: 12px; color: <?php echo $warna_lembaga; ?>"> <?php echo 'Sisa Kursi = ' . $availabilitypergi; ?></text>
                                                                <?php
                                                            }
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
                                                                  title="<?php echo $detailtransitpergi; ?>"
                                                                  style="cursor: pointer; color: #ed5565;">
                                                                <?php
                                                                if ($istransitpergi == 'true') {
                                                                    ?>
                                                                    <a data-toggle="modal"
                                                                       data-target="#<?php echo $idtransitpergi; ?>">
                                                                        <text style="color: #ED5565;"><?php echo $transitpergi; ?></text>
                                                                        <i class="fa fa-eye"
                                                                           style="color: #ED5565;"></i>
                                                                    </a>
                                                                    <?php
                                                                } else {
                                                                    echo $transitpergi;
                                                                }
                                                                ?>
                                                            </text>
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <input type="hidden" value="<?php echo $hargapergi; ?>">
                                                            <text style="font-size: 18px; font-weight: bold; color: <?php echo $warna_lembaga ?>;">
                                                                <?php echo nominalcomma($hargapergi); ?>
                                                            </text>
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

                        }

                    }

                }else{

                    ?>

                    <div class="row text-center">

                        <h2>
                            JADWAL PENERBANGAN PERGI TIDAK DITEMUKAN
                        </h2><br/>
                        <h2>Lakukan Pencarian Jadwal Pesawat Kembali</h2><br/>
                        <button class="btn btn-danger" onclick="closeWin()">Kembali ke form pencarian</button>

                    </div>

                    <?php
                    
                }

            }else{
                ?>

                <div class="row text-center">

                    <h2>
                        JADWAL PENERBANGAN PERGI TIDAK DITEMUKAN
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
            if($jumlahairlinepulang > 0) {

                $rc00pulang = 0;
    
                for ($pul = 0; $pul < $jumlahairlinepulang; $pul++) {

                    if($jadwal[0][$pul][0] != null){

                        $rcpulang = $jadwal[0][$pul][0]['rc'];

                        if($rcpulang == '00'){
                            $rc00pulang += 1;
                        }

                    }
    
                }
    
                if($rc00pulang > 0){

                    for ($pul = 0; $pul < $jumlahairlinepulang; $pul++) {

                        if($jadwal[0][$pul][0] != null) {

                            $rcpulang = $jadwal[0][$pul][0]['rc'];

                            if ($rcpulang == '00') {

                                $aircodepulang = $jadwal[1][$pul][0]['data'][0]['airlineCode'];
                                $airnamepulang = $jadwal[1][$pul][0]['data'][0]['airlineName'];
                                $airiconpulang = $jadwal[1][$pul][0]['data'][0]['airlineIcon'];

                                if (get_http_response_code($airiconpulang) != "200") {
                                    $airicon = base_url('assets/img/No_Image_Available.png');
                                }

                                $idpulang = 'PULANG' . $aircodepulang;

                                $jumlahjadwalpulang = count($jadwal[1][$pul][0]['data']);

                                for ($x = 0; $x < $jumlahjadwalpulang; $x++) {
                                    $idtransitpulang = 'PULANG' . $aircodepulang . '' . $x;

                                    $jumlahpesawatpulang = count($jadwal[1][$pul][0]['data'][$x]['detailTitle']);
                                    $jumlahclassespulang = count($jadwal[1][$pul][0]['data'][$x]['classes']);
                                    $istransitpulang = $jadwal[1][$pul][0]['data'][$x]['isTransit'];

                                    if ($istransitpulang == 'true') {
                                        ?>

                                        <div class="modal inmodal fade" id="<?php echo $idtransitpulang ?>"
                                             tabindex="-1"
                                             role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2>Detail Transit</h2>
                                                        <button type="button" class="close" data-dismiss="modal"><span
                                                                    aria-hidden="true">&times;</span><span
                                                                    class="sr-only">Close</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <table class="table no-borders" style="font-size: 12px;">

                                                            <?php
                                                            for ($d = 0; $d < $jumlahpesawatpulang; $d++) {

                                                                $flightIconpulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$d]['flightIcon'];
                                                                $flightNamepulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$d]['flightName'];
                                                                $flightCodepulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$d]['flightCode'];
                                                                $departpulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$d]['depart'];
                                                                $originpulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$d]['origin'];
                                                                $originNamepulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$d]['originName'];
                                                                $transitName1pulang = $originNamepulang . ' ( ' . $originpulang . ' )';
                                                                $arrivpulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$d]['arrival'];
                                                                $destinationpulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$d]['destination'];
                                                                $destinationNamepulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$d]['destinationName'];
                                                                $transitName2pulang = $destinationNamepulang . ' ( ' . $destinationpulang . ' )';
                                                                $transitTimepulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$d]['transitTime'];

                                                                if (get_http_response_code($flightIconpulang) != "200") {
                                                                    $flightIconpulang = base_url('assets/img/No_Image_Available.png');
                                                                }

                                                                if ($jumlahpesawatpulang == $jumlahclassespulang) {
                                                                    $availabilitypulang = $jadwal[1][$pul][0]['data'][$x]['classes'][$d][0]['availability'];
                                                                } else {
                                                                    $availabilitypulang = $jadwal[1][$pul][0]['data'][$x]['classes'][0][0]['availability'];
                                                                }

                                                                if ($transitTimepulang != '0j0m') {
                                                                    $transitTimepulang = str_replace("m", " Menit ", $transitTimepulang);
                                                                    $transitTimepulang = str_replace("j", " Jam ", $transitTimepulang);
                                                                    $txbtransitpulang = 'Transit di ' . $transitName1pulang . ' selama ' . $transitTimepulang;
                                                                    ?>

                                                                    <tr class="text-center"
                                                                        style="background-color:#F4F4F5; padding: 0px;">
                                                                        <td colspan="4"
                                                                            style="vertical-align: middle; padding: 0px;">
                                                                            <input type="text" class="text-center"
                                                                                   value="<?php echo $txbtransitpulang; ?>"
                                                                                   style="width: 100%; font-size: 14px; border: none; background-color: white; color: black;"
                                                                                   readonly>
                                                                        </td>
                                                                    </tr>

                                                                    <?php
                                                                }
                                                                ?>

                                                                <tr class="text-center"
                                                                    style="background-color:#F4F4F5;">
                                                                    <td style="border-right: none;vertical-align: middle;">
                                                                        <?php echo $originpulang . ' > ' . $destinationpulang; ?>
                                                                        <br/>
                                                                        <text style="font-size: 12px; color: <?php echo $warna_lembaga; ?>"> <?php echo 'Sisa Kursi = ' . $availabilitypulang; ?></text>
                                                                    </td>
                                                                    <td style="border-right: none; border-left: none;vertical-align: middle;">
                                                                        <img class="img-sm"
                                                                             src="<?php echo $flightIconpulang; ?>"
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
                                                            ?>

                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <?php
                                    }

                                }

                                ?>

                                <div class="ibox" style="margin-top: 0px;">

                                    <div class="ibox-title red-bg" style="padding-top: 15px;">

                                        <div class="row">
                                            <div class="col-xs-3 text-right">
                                                <img class="img-md" src="<?php echo $airiconpulang; ?>"
                                                     style="width: 100px;">
                                            </div>
                                            <div class="col-xs-7" style="padding-left: 0px;">
                                                <h2 style="margin-top: 20px;"><?php echo $airnamepulang; ?></h2>
                                                <input type="hidden" id="aircode" value="<?php echo $aircodepulang; ?>">
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="ibox-tools">
                                                    <a data-toggle="collapse" data-target="#<?php echo $idpulang; ?>"
                                                       class="collapse-link">
                                                        <i class="fa fa-chevron-down fa-2x" style="color: white;"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div id="<?php echo $idpulang ?>" class="ibox-content <?php if ($pul != 0) {
                                        echo 'collapse';
                                    } ?>" style="padding-left: 10px; padding-right: 10px;">

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
                                                $jumlahjadwalpulang = count($jadwal[1][$pul][0]['data']);
                                                for ($x = 0; $x < $jumlahjadwalpulang; $x++) {
                                                    $idtransitpulang = 'PULANG' . $aircodepulang . '' . $x;

                                                    $jumlahpesawatpulang = count($jadwal[1][$pul][0]['data'][$x]['detailTitle']);
                                                    $jumlahclassespulang = count($jadwal[1][$pul][0]['data'][$x]['classes']);
                                                    $airlinecodepulang = $jadwal[1][$pul][0]['data'][$x]['airlineCode'];
                                                    $jampergipulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][0]['depart'];
                                                    $jamtibapulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][0]['arrival'];
                                                    $istransitpulang = $jadwal[1][$pul][0]['data'][$x]['isTransit'];
                                                    $transitpulang = 'Langsung';
                                                    $detailtransitpulang = '';

                                                    $flightcdpulang = '';
                                                    for ($a = 0; $a < $jumlahpesawatpulang; $a++) {
                                                        $flightcodepulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$a]['flightCode'] . '/';
                                                        $flightcdpulang = $flightcdpulang . '' . $flightcodepulang;
                                                    }

                                                    if ($istransitpulang == 'true') {
                                                        $keytibapulang = $jumlahpesawatpulang - 1;
                                                        $jamtibapulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$keytibapulang]['arrival'];
                                                        $transitpulang = $keytibapulang . ' Transit';
                                                        for ($b = 0; $b < $jumlahpesawatpulang; $b++) {
                                                            $originpulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$b]['origin'];
                                                            $destinationpulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$b]['destination'];
                                                            $departpulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$b]['depart'];
                                                            $arrivpulang = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$b]['arrival'];
                                                            $dettransitpulang = $originpulang . ' - ' . $destinationpulang . ' ( ' . $departpulang . ' - ' . $arrivpulang . ' ), ';
                                                            $detailtransitpulang = $detailtransitpulang . '' . $dettransitpulang;
                                                        }
                                                    } else {
                                                        $detailtransitpulang = $departurecode . ' - ' . $arrivalcode . ' ( ' . $jampergipulang . ' - ' . $jamtibapulang . ' )';
                                                    }

                                                    $hargapulang = 0;
                                                    for ($c = 0; $c < $jumlahclassespulang; $c++) {
                                                        $pricepulang = $jadwal[1][$pul][0]['data'][$x]['classes'][$c][0]['price'];
                                                        $hargapulang = $hargapulang + $pricepulang;
                                                        $availabilitypulang = $jadwal[1][$pul][0]['data'][$x]['classes'][$c][0]['availability'];
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
                                                                       data-airlineicon="<?php echo $airiconpulang; ?>"
                                                                       data-transit="<?php echo $transitpulang; ?>"
                                                                       data-flightcode="<?php echo $flightcdpulang; ?>"
                                                                       data-jampergi="<?php echo $jampergipulang; ?>"
                                                                       data-jamtiba="<?php echo $jamtibapulang; ?>"
                                                                       data-harga="<?php echo $hargapulang; ?>"
                                                                       data-jumlahpesawatpulang="<?php echo $jumlahpesawatpulang; ?>"
                                                                       data-jumlahclassespulang="<?php echo $jumlahclassespulang; ?>"
                                                                       data-istransitpulang="<?php echo $istransitpulang; ?>"
                                                                       data-airlinecodepulang="<?php echo $airlinecodepulang; ?>"
                                                                    <?php $dettransitpulang = str_replace(",", "<br/>", $detailtransitpulang); ?>
                                                                       data-detailtransit="<?php echo $dettransitpulang; ?>"
                                                                    <?php
                                                                    for ($jppg = 0; $jppg < $jumlahpesawatpulang; $jppg++) {
                                                                        $flightcodepul = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$jppg]['flightCode'];
                                                                        $transitTimepul = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$jppg]['transitTime'];
                                                                        $flightIconpul = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$jppg]['flightIcon'];
                                                                        $flightNamepul = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$jppg]['flightName'];
                                                                        $classpul = $jadwal[1][$pul][0]['data'][$x]['classes'][0][0]['class'];
                                                                        $seatpul = $jadwal[1][$pul][0]['data'][$x]['classes'][0][0]['seat'];
                                                                        if ($jumlahpesawatpulang == $jumlahclassespulang) {
                                                                            $classpul = $jadwal[1][$pul][0]['data'][$x]['classes'][$jppg][0]['class'];
                                                                            $seatpul = $jadwal[1][$pul][0]['data'][$x]['classes'][$jppg][0]['seat'];
                                                                        }
                                                                        $departpul = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$jppg]['depart'];
                                                                        $originpul = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$jppg]['origin'];
                                                                        $originNamepul = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$jppg]['originName'];
                                                                        $transitName1pul = $originNamepul . ' ( ' . $originpul . ' )';
                                                                        $arrivpul = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$jppg]['arrival'];
                                                                        $destinationpul = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$jppg]['destination'];
                                                                        $destinationNamepul = $jadwal[1][$pul][0]['data'][$x]['detailTitle'][$jppg]['destinationName'];
                                                                        $transitName2pul = $destinationNamepul . ' ( ' . $destinationpul . ' )';

                                                                        ?>
                                                                        data-flightcodepulang<?php echo $jppg; ?>="<?php echo $flightcodepul; ?>"
                                                                        data-transittimepulang<?php echo $jppg; ?>="<?php echo $transitTimepul; ?>"
                                                                        data-flighticonpulang<?php echo $jppg; ?>="<?php echo $flightIconpul; ?>"
                                                                        data-flightnamepulang<?php echo $jppg; ?>="<?php echo $flightNamepul; ?>"
                                                                        data-flightclasspulang<?php echo $jppg; ?>="<?php echo $classpul; ?>"
                                                                        data-seatspulang<?php echo $jppg; ?>="<?php echo $seatpul; ?>"
                                                                        data-departtimepulang<?php echo $jppg; ?>="<?php echo $departpul; ?>"
                                                                        data-transitname1pulang<?php echo $jppg; ?>="<?php echo $transitName1pul; ?>"
                                                                        data-arrivaltimepulang<?php echo $jppg; ?>="<?php echo $arrivpul; ?>"
                                                                        data-transitname2pulang<?php echo $jppg; ?>="<?php echo $transitName2pul; ?>"
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                >
                                                            </div>

                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <?php
                                                            $flightcdpulang = str_replace("/", "<br/>", $flightcdpulang);
                                                            echo $flightcdpulang;
                                                            if ($istransitpulang == 'false') {
                                                                ?>
                                                                <text style="font-size: 12px; color: <?php echo $warna_lembaga; ?>"> <?php echo 'Sisa Kursi = ' . $availabilitypulang; ?></text>
                                                                <?php
                                                            }
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
                                                                  title="<?php echo $detailtransitpulang; ?>"
                                                                  style="cursor: pointer; color: #ed5565;">
                                                                <?php
                                                                if ($istransitpulang == 'true') {
                                                                    ?>
                                                                    <a data-toggle="modal"
                                                                       data-target="#<?php echo $idtransitpulang; ?>">
                                                                        <text style="color: #ED5565;"><?php echo $transitpulang; ?></text>
                                                                        <i class="fa fa-eye"
                                                                           style="color: #ED5565;"></i>
                                                                    </a>
                                                                    <?php
                                                                } else {
                                                                    echo $transitpulang;
                                                                }
                                                                ?>
                                                            </text>
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <text style="font-size: 18px; font-weight: bold; color: <?php echo $warna_lembaga ?>;">
                                                                <?php echo nominalcomma($hargapulang); ?>
                                                            </text>
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

                        }

                    }
                    
                }else{
                    ?>

                    <div class="row text-center">

                        <h2>
                            JADWAL PENERBANGAN PULANG TIDAK DITEMUKAN
                        </h2><br/>
                        <h2>Lakukan Pencarian Jadwal Pesawat Kembali</h2><br/>
                        <button class="btn btn-danger" onclick="closeWin()">Kembali ke form pencarian</button>

                    </div>

                    <?php                    
                }

            }else{
                ?>

                <div class="row text-center">

                    <h2>
                        JADWAL PENERBANGAN PULANG TIDAK DITEMUKAN
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

<script src="<?php echo base_url(); ?>assets/js/<?=$jspesawat_to_load;?>"></script>

<script src="<?php echo base_url();?>assets/js/plugins/iCheck/icheck.min.js"></script>