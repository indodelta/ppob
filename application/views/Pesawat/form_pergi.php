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

$jumlahairline = count($jadwal);

if($jumlahairline == 0){


    ?>

    <div class="ibox-content">

        <div class="row text-center">

            <h1>
                JADWAL PENERBANGAN TIDAK DITEMUKAN
            </h1><br/>
            <h2>Lakukan Pencarian Jadwal Pesawat Kembali</h2><br/>
            <button class="btn btn-danger" onclick="closeWin()">Kembali ke form pencarian</button>

        </div>

    </div>

    <?php

}else{

    $rc00 = 0;

    for ($x = 0; $x < $jumlahairline; $x++) {

        if($jadwal[$x][0] != null){

            $rc = $jadwal[$x][0]['rc'];

            if($rc == '00'){
                $rc00 += 1;
            }

        }

    }

    if($rc00 == 0){

        ?>

        <div class="ibox-content">

            <div class="row text-center">

                <h1>
                    JADWAL PENERBANGAN TIDAK DITEMUKAN
                </h1><br/>
                <h2>Lakukan Pencarian Jadwal Pesawat Kembali</h2><br/>
                <button class="btn btn-danger" onclick="closeWin()">Kembali ke form pencarian</button>

            </div>

        </div>

        <?php


    }else {

        for ($x = 0; $x < $jumlahairline; $x++) {

            if($jadwal[$x][0] != null){

                $rc = $jadwal[$x][0]['rc'];

                if ($rc == '00') {

                    $aircode = $jadwal[$x][0]['data'][0]['airlineCode'];
                    $airname = $jadwal[$x][0]['data'][0]['airlineName'];
                    $airicon = $jadwal[$x][0]['data'][0]['airlineIcon'];

                    $jumlahjadwal = count($jadwal[$x][0]['data']);

                    $idibox = 'iboxcontent' . $x;

                    for ($y = 0; $y < $jumlahjadwal; $y++) {
                        $jumlahpesawat = count($jadwal[$x][0]['data'][$y]['detailTitle']);
                        $jmlclasses = count($jadwal[$x][0]['data'][$y]['classes']);

                        $idtransit = $aircode . '' . $y;

                        ?>

                        <div class="modal inmodal fade" id="<?php echo $idtransit ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2>Detail Transit</h2>
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                    aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <table class="table no-borders" style="font-size: 12px;">

                                            <?php
                                                for ($c = 0; $c < $jumlahpesawat; $c++) {

                                                    $flightIcon = $jadwal[$x][0]['data'][$y]['detailTitle'][$c]['flightIcon'];
                                                    $flightName = $jadwal[$x][0]['data'][$y]['detailTitle'][$c]['flightName'];
                                                    $flightCode = $jadwal[$x][0]['data'][$y]['detailTitle'][$c]['flightCode'];
                                                    $depart = $jadwal[$x][0]['data'][$y]['detailTitle'][$c]['depart'];
                                                    $origin = $jadwal[$x][0]['data'][$y]['detailTitle'][$c]['origin'];
                                                    $originName = $jadwal[$x][0]['data'][$y]['detailTitle'][$c]['originName'];
                                                    $transitName1 = $originName . ' ( ' . $origin . ' )';
                                                    $arriv = $jadwal[$x][0]['data'][$y]['detailTitle'][$c]['arrival'];
                                                    $destination = $jadwal[$x][0]['data'][$y]['detailTitle'][$c]['destination'];
                                                    $destinationName = $jadwal[$x][0]['data'][$y]['detailTitle'][$c]['destinationName'];
                                                    $transitName2 = $destinationName . ' ( ' . $destination . ' )';
                                                    if ($jumlahpesawat == $jmlclasses) {
                                                        $availability = $jadwal[$x][0]['data'][$y]['classes'][$c][0]['availability'];
                                                    } else {
                                                        $availability = $jadwal[$x][0]['data'][$y]['classes'][0][0]['availability'];
                                                    }

                                                    $transitTime = $jadwal[$x][0]['data'][$y]['detailTitle'][$c]['transitTime'];

                                                    if ($transitTime != '0j0m') {
                                                        $transitTime = str_replace("m", " Menit ", $transitTime);
                                                        $transitTime = str_replace("j", " Jam ", $transitTime);
                                                        $txbtransit = 'Transit di ' . $transitName1 . ' selama ' . $transitTime;
                                                        ?>
                                                        <tr class="text-center"
                                                            style="background-color:#F4F4F5; padding: 0px;">
                                                            <td colspan="7"
                                                                style="vertical-align: middle; padding: 0px;">
                                                                <input type="text" class="text-center"
                                                                       value="<?php echo $txbtransit; ?>"
                                                                       style="width: 100%; font-size: 14px; border: none; background-color: white; color: black;"
                                                                       readonly>
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
                                            ?>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>

                    <div class="ibox">

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
                                        <a data-toggle="collapse" data-target="#<?php echo $idibox; ?>"
                                           class="collapse-link">
                                            <i class="fa fa-chevron-down fa-2x" style="color: white;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="<?php echo $idibox; ?>" class="ibox-content <?php if ($x != 0) {
                            echo 'collapse';
                        } ?>">

                            <div class="table-responsive tooltip-demo">
                                <table id="datajadwalpesawat" class="table table-stripped table-hover datajadwalpesawat"
                                       style="font-size: 12px;">
                                    <thead>
                                    <tr class="text-center">
                                        <th data-toggle="true" class="text-center">No.</th>
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
                                        $jumlahpesawat = count($jadwal[$x][0]['data'][$y]['detailTitle']);
                                        $jmlclasses = count($jadwal[$x][0]['data'][$y]['classes']);
                                        $airlinecode = $jadwal[$x][0]['data'][$y]['airlineCode'];
                                        $istransit = $jadwal[$x][0]['data'][$y]['isTransit'];
                                        $pergi = $jadwal[$x][0]['data'][$y]['detailTitle'][0]['depart'];
                                        $transit = '';
                                        if ($istransit == 'true') {
                                            $keytiba = $jumlahpesawat - 1;
                                            $tiba = $jadwal[$x][0]['data'][$y]['detailTitle'][$keytiba]['arrival'];
                                            $transit = $keytiba . ' Transit';
                                        } else {
                                            $tiba = $jadwal[$x][0]['data'][$y]['detailTitle'][0]['arrival'];
                                            $transit = 'Langsung';
                                        };

                                        $idtransit = $aircode . '' . $y;

                                        $namaform = 'formpilihpergi' . $x . '' . $y;

                                        ?>

                                        <!--form pilih penerbangan-->

                                        <tr class="text-center">
                                            <td style="vertical-align: middle;"><?php echo $no++; ?></td>
                                            <td style="vertical-align: middle;">
                                                <?php
                                                for ($a = 0; $a < $jumlahpesawat; $a++) {
                                                    $flightCode = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['flightCode'];
                                                    ?>
                                                    <input type="text" class="text-center"
                                                           value="<?php echo $flightCode; ?>"
                                                           style="border: none;background-color: transparent; max-width: 50px;">
                                                    <br/>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <?php
                                                echo '<text style="font-size: 18px; font-weight: bold">' . $pergi . '</text><br/>' . $depname;
                                                ?>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <?php
                                                echo '<text style="font-size: 18px; font-weight: bold">' . $tiba . '</text><br/>' . $arrname;
                                                ?>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <text data-toggle="tooltip"
                                                      data-aircode="<?php echo $aircode ?>"
                                                      data-number="<?php echo $y ?>"
                                                      title="<?php
                                                      if ($istransit == 'true') {
                                                          for ($a = 0; $a < $jumlahpesawat; $a++) {
                                                              $origin = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['origin'];
                                                              $destination = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['destination'];
                                                              $depart = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['depart'];
                                                              $arriv = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['arrival'];
                                                              echo $origin . ' - ' . $destination . ' ( ' . $depart . ' - ' . $arriv . ' ), ';
                                                          }
                                                      } else {
                                                          echo $departurecode . ' - ' . $arrivalcode . ' ( ' . $pergi . ' - ' . $tiba . ' )';
                                                      }
                                                      ?>"
                                                      style="cursor: pointer; color: #ed5565;">
                                                    <?php
                                                    if ($istransit == 'true') {
                                                        ?>
                                                        <a data-toggle="modal"
                                                           data-target="#<?php echo $idtransit; ?>">
                                                            <text style="color: #ED5565;"><?php echo $transit; ?></text>
                                                            <i class="fa fa-eye" style="color: #ED5565;"></i>
                                                        </a>
                                                        <?php
                                                    } else {
                                                        echo $transit;
                                                    }
                                                    ?>
                                                </text>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <?php
                                                $harga = 0;
                                                for ($a = 0; $a < $jmlclasses; $a++) {
                                                    $price = $jadwal[$x][0]['data'][$y]['classes'][$a][0]['price'];
                                                    $harga = $harga + $price;
                                                }
                                                ?>
                                                <text style="font-size: 18px; font-weight: bold; color: <?php echo $warna_lembaga ?>;">
                                                    <?php echo nominalcomma($harga); ?>
                                                    <input type="hidden" class="text-center" name="hargapergi"
                                                           value="<?php echo $harga; ?>">
                                                </text>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <?php
                                                for ($a = 0; $a < $jmlclasses; $a++) {
                                                    $availability = $jadwal[$x][0]['data'][$y]['classes'][$a][0]['availability'];
                                                }
                                                ?>
                                                <form id="<?php echo $namaform; ?>" method="post" target="_blank">

                                                    <?php
                                                    for ($a = 0; $a < $jumlahpesawat; $a++) {

                                                        $flightIcon = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['flightIcon'];
                                                        $flightName = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['flightName'];
                                                        $flightCode = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['flightCode'];
                                                        $depart = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['depart'];
                                                        $origin = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['origin'];
                                                        $originName = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['originName'];
                                                        $transitName1 = $originName . ' ( ' . $origin . ' )';
                                                        $arriv = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['arrival'];
                                                        $destination = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['destination'];
                                                        $destinationName = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['destinationName'];
                                                        $transitName2 = $destinationName . ' ( ' . $destination . ' )';
                                                        $transitTime = $jadwal[$x][0]['data'][$y]['detailTitle'][$a]['transitTime'];
                                                        $class = $jadwal[$x][0]['data'][$y]['classes'][0][0]['class'];
                                                        $seat = $jadwal[$x][0]['data'][$y]['classes'][0][0]['seat'];
                                                        if ($jumlahpesawat == $jmlclasses) {
                                                            $class = $jadwal[$x][0]['data'][$y]['classes'][$a][0]['class'];
                                                            $seat = $jadwal[$x][0]['data'][$y]['classes'][$a][0]['seat'];
                                                        }

                                                        $txbtransittimeperginame = 'transittimepergi' . $a;
                                                        $txbflightcodeperginame = 'flightcodepergi' . $a;
                                                        $txbflightnameperginame = 'flightnamepergi' . $a;
                                                        $txbflighticonperginame = 'flighticonpergi' . $a;
                                                        $txbflightclassperginame = 'flightclasspergi' . $a;
                                                        $txbdeparttimeperginame = 'departtimepergi' . $a;
                                                        $txbarrivaltimeperginame = 'arrivaltimepergi' . $a;
                                                        $txbtransitname1perginame = 'transitname1pergi' . $a;
                                                        $txbtransitname2perginame = 'transitname2pergi' . $a;
                                                        $txbseatperginame = 'seatspergi' . $a;
                                                        ?>
                                                        <input type="hidden" class="text-center"
                                                               name="<?php echo $txbflightcodeperginame; ?>"
                                                               value="<?php echo $flightCode; ?>">
                                                        <input type="hidden" class="text-center"
                                                               name="<?php echo $txbtransittimeperginame; ?>"
                                                               value="<?php echo $transitTime; ?>">
                                                        <input type="hidden" class="text-center"
                                                               name="<?php echo $txbflighticonperginame; ?>"
                                                               value="<?php echo $flightIcon; ?>">
                                                        <input type="hidden" class="text-center"
                                                               name="<?php echo $txbflightnameperginame; ?>"
                                                               value="<?php echo $flightName; ?>">
                                                        <input type="hidden" class="text-center"
                                                               name="<?php echo $txbflightclassperginame; ?>"
                                                               value="<?php echo $class; ?>">
                                                        <input type="hidden" class="text-center"
                                                               name="<?php echo $txbdeparttimeperginame; ?>"
                                                               value="<?php echo $depart; ?>">
                                                        <input type="hidden" class="text-center"
                                                               name="<?php echo $txbarrivaltimeperginame; ?>"
                                                               value="<?php echo $arriv; ?>">
                                                        <input type="hidden" class="text-center"
                                                               name="<?php echo $txbtransitname1perginame; ?>"
                                                               value="<?php echo $transitName1; ?>">
                                                        <input type="hidden" class="text-center"
                                                               name="<?php echo $txbtransitname2perginame; ?>"
                                                               value="<?php echo $transitName2; ?>">
                                                        <input type="hidden" class="text-center"
                                                               name="<?php echo $txbseatperginame; ?>"
                                                               value="<?php echo $seat; ?>">
                                                        <?php
                                                    }
                                                    ?>

                                                    <input type="hidden" name="pulangpergi"
                                                           value="<?php echo $cekreturn; ?>">
                                                    <input type="hidden" name="air_from"
                                                           value="<?php echo $departure; ?>">
                                                    <input type="hidden" name="air_to" value="<?php echo $arrival; ?>">
                                                    <input type="hidden" name="departuredate"
                                                           value="<?php echo $departureDate; ?>">
                                                    <input type="hidden" name="returndate"
                                                           value="<?php echo $returnDate; ?>">
                                                    <input type="hidden" name="adult" value="<?php echo $adult; ?>">
                                                    <input type="hidden" name="child" value="<?php echo $child; ?>">
                                                    <input type="hidden" name="infant" value="<?php echo $infant; ?>">
                                                    <input type="hidden" name="jumlahpesawatpergi"
                                                           value="<?php echo $jumlahpesawat; ?>">
                                                    <input type="hidden" name="jumlahclassespergi"
                                                           value="<?php echo $jmlclasses; ?>">
                                                    <input type="hidden" name="istransitpergi"
                                                           value="<?php echo $istransit; ?>">
                                                    <input type="hidden" name="airlinecodepergi"
                                                           value="<?php echo $airlinecode; ?>">

                                                    <input type="hidden" class="text-center" name="jampergipergi"
                                                           value="<?php echo $pergi; ?>">
                                                    <input type="hidden" class="text-center" name="jamtibapergi"
                                                           value="<?php echo $tiba; ?>">

                                                    <button type="button"
                                                            class="btn btn-danger"
                                                            data-noairline="<?php echo $x; ?>"
                                                            data-nojadwal="<?php echo $y; ?>"
                                                            data-airlinename="<?php echo $airname; ?>"
                                                            style="margin-bottom: 0px;"
                                                            onclick="submitpergi(this)">
                                                        Pesan Sekarang
                                                    </button>

                                                </form>
                                                <?php
                                                if ($istransit == 'false') {
                                                    ?>
                                                    <text style="font-size: 12px; color: <?php echo $warna_lembaga; ?>; margin-top: 0px"> <?php echo 'Sisa Kursi = ' . $availability; ?></text>
                                                    <?php
                                                }
                                                ?>

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

    }

}

?>

<script src="<?php echo base_url(); ?>assets/js/<?=$jspesawat_to_load;?>"></script>



