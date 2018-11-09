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
                <a href="<?php echo base_url('pesawat')?>">Pesan Tiket Pesawat</a>
            </li>
            <li class="active">
                <strong>Booking</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<!-- Content -->

<?php
$this->load->view('func_custom');

$pulangpergi = $this->input->post('pulangpergi',true);

$airfrom = $this->input->post('air_from',true);
$expairfrom = explode('-', $airfrom);
$airfromcode = $expairfrom[0];
$airfromname = $expairfrom[1];

$airto = $this->input->post('air_to',true);
$expairto = explode('-', $airto);
$airtocode = $expairto[0];
$airtoname = $expairto[1];

$adult = $this->input->post('adult',true);
$child = $this->input->post('child',true);
$infant = $this->input->post('infant',true);

$departuredate= $this->input->post('departuredate',true);
$expdepartureDate = explode('/', $departuredate);
$bulandepartureDate = bulan($expdepartureDate[1]);
$departureDateindo = $expdepartureDate[0] . ' ' . $bulandepartureDate . ' ' .$expdepartureDate[2];
$departureDatedb = $expdepartureDate[2] . '-' . $expdepartureDate[1] . '-' .$expdepartureDate[0];

$returndate = $this->input->post('returndate',true);
$expreturnDate = explode('/', $returndate);
$bulanreturnDate = bulan($expreturnDate[1]);
$returnDateindo = $expreturnDate[0].' '.$bulanreturnDate.' '.$expreturnDate[2];
$returnDatedb = $expreturnDate[2].'-'.$expreturnDate[1].'-'.$expreturnDate[0];

$jumlahpesawatpergi = $this->input->post('jumlahpesawatpergi',true);
$jumlahclassespergi = $this->input->post('jumlahclassespergi',true);
$airlinecodepergi = $this->input->post('airlinecodepergi',true);
$flightcodepergi = $this->input->post('flightcodepergi0',true);
$flightnamepergi = $this->input->post('flightnamepergi0',true);
$flighticonpergi = $this->input->post('flighticonpergi0',true);
$flightclasspergi = $this->input->post('flightclasspergi0',true);

$jampergipergi = $this->input->post('jampergipergi',true);
$jamtibapergi = $this->input->post('jamtibapergi',true);

$istransitpergi = $this->input->post('istransitpergi',true);

if($pulangpergi == 'on'){

    $jumlahpesawatpulang = $this->input->post('jumlahpesawatpulang',true);
    $jumlahclassespulang = $this->input->post('jumlahclassespulang',true);
    $airlinecodepulang = $this->input->post('airlinecodepulang',true);
    $flightcodepulang = $this->input->post('flightcodepulang0',true);
    $flightnamepulang = $this->input->post('flightnamepulang0',true);
    $flighticonpulang = $this->input->post('flighticonpulang0',true);
    $flightclasspulang = $this->input->post('flightclasspulang0',true);

    $jampergipulang = $this->input->post('jampergipulang',true);
    $jamtibapulang = $this->input->post('jamtibapulang',true);

    $istransitpulang = $this->input->post('istransitpulang',true);

}

$disabledbuttonsubmit = '';

?>

<form id="formbookpesawat" class="form-horizontal" method="post" action="booking" autocomplete="off" onsubmit="return confirm('Apakah data sudah terisi dengan benar?');">

<div class="wrapper wrapper-content animated fadeInRight article" style="margin-top: 80px;">

    <div class="row">
        <div class="col-lg-6 col-lg-offset-2 col-xs-8">

            <h2>
                <i class="fa fa-plane" style="margin-right:10px;color: <?php echo $warna_lembaga; ?>"></i>
                <span style="color: <?php echo $warna_lembaga; ?>">Informasi Booking Penerbangan</span>
            </h2>

            <div class="ibox">

                <div class="ibox-title red-bg" style="padding-top: 20px; height: 60px;">
                    <h3 class="col-xs-10">
                        TINJAU PESANAN ANDA
                    </h3>

                    <div class="col-xs-2">
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up fa-2x" style="color: white;"></i>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="ibox-content" style="padding-top: 0px; padding-left: 20px; padding-right: 20px;">

                    <?php
                    if($pulangpergi == 'on'){
                        $iconfa = 'fa-exchange';
                    }else{
                        $iconfa = 'fa-arrow-right';
                    }

                    $bagasipergi = 0;

                    if($fare['pergi'][0] != null){
                        $bagasipergi = $fare['pergi'][0]->data->baggage;
                    }else{
                        $bagasipergi = 20;
                    }

                    ?>

                    <h2>
                        <i class="fa fa-plane fa-2x" style="margin-right:10px;"></i>
                        <?php echo $airfromname; ?> <i class="fa <?php echo $iconfa;?>" style="margin-right:20px; margin-left: 20px;"></i>  <?php echo $airtoname; ?>
                    </h2>
                    <hr/>
                    <!-- table pergi-->
                    <div class="table-responsive">
                        <table class="table no-borders">
                            <tr class="no-borders">
                                <td class="no-borders" colspan="2">Maskapai</td>
                                <td class="no-borders">Jadwal Penerbangan</td>
                                <td class="no-borders">Transit</td>
                            </tr>
                            <tr class="no-borders">
                                <td style="width: 100px;" class="no-borders">
                                    <img class="img-md" src="<?php echo $flighticonpergi;?>">
                                    <i class="fa fa-suitcase"></i><text style="font-size: 10px;"> Bagasi <?php echo $bagasipergi;?> Kg</text>
                                </td>
                                <td class="no-borders" style="vertical-align: middle;">
                                    <text style="font-size: 16px;"> <?php echo $flightnamepergi ?></text>
                                    <br/>
                                    <text style="font-size: 14px;"> <?php echo $flightcodepergi;?> (Subclass <?php echo $flightclasspergi;?>)</text>
                                </td>
                                <td class="no-borders" style="vertical-align: middle;">
                                    <text style="font-size: 16px;"> Pergi:</text>
                                    <br/>
                                    <text style="font-size: 16px;"> <?php echo hari($departureDatedb).', '.$departureDateindo;?></text>
                                    <br/>
                                    <text style="font-size: 14px;"> <?php echo $jampergipergi;?> - <?php echo $jamtibapergi;?></text>
                                </td>
                                <td class="no-borders" style="vertical-align: middle;">

                                    <?php
                                    if($istransitpergi == 'true'){
                                        ?>
                                        <a data-toggle="collapse" data-target="#trtransitpergi">
                                            <text style="font-size: 12px; color:#ED5565;"> <?php echo $jumlahpesawatpergi - 1;?> Transit</text>
                                            <i class="fa fa-eye" style="color:#ED5565;"></i>
                                        </a>
                                        <?php
                                    }else{
                                        ?>
                                        <text style="font-size: 12px; color:#ED5565;">Langsung</text>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr id="trtransitpergi" class="collapse">

                                <td colspan="4">

                                    <table class="table no-borders" style="font-size: 12px;">

                                        <?php
                                        for ($a = 0; $a < $jumlahpesawatpergi; $a++) {

                                            $txbtransittimeperginame = 'transittimepergi'.$a;
                                            $txbflightcodetransitperginame = 'flightcodepergi'.$a;
                                            $txbflightnametransitperginame = 'flightnamepergi'.$a;
                                            $txbflighticontransitperginame = 'flighticonpergi'.$a;
                                            $txbflightclasstransitperginame = 'flightclasspergi'.$a;
                                            $txbdeparttimetransitperginame = 'departtimepergi'.$a;
                                            $txbarrivaltimetransitperginame = 'arrivaltimepergi'.$a;
                                            $txbtransitname1perginame = 'transitname1pergi'.$a;
                                            $txbtransitname2perginame = 'transitname2pergi'.$a;

                                            $transittimepergi = $this->input->post($txbtransittimeperginame,true);
                                            $transitName1pergi = $this->input->post($txbtransitname1perginame,true);
                                            $transitName2pergi = $this->input->post($txbtransitname2perginame,true);
                                            $flightcodetransitpergi = $this->input->post($txbflightcodetransitperginame,true);
                                            $flightnametransitpergi = $this->input->post($txbflightnametransitperginame,true);
                                            $flighticontransitpergi = $this->input->post($txbflighticontransitperginame,true);
                                            $flightclasstransitpergi = $this->input->post($txbflightclasstransitperginame,true);
                                            $departtimetransitpergi = $this->input->post($txbdeparttimetransitperginame,true);
                                            $arrivaltimetransitpergi = $this->input->post($txbarrivaltimetransitperginame,true);

                                            if($transittimepergi != '0j0m') {
                                                $transittimepergi = str_replace("m"," Menit ",$transittimepergi);
                                                $transittimepergi = str_replace("j"," Jam ",$transittimepergi);
                                                $txbtransitpergi = 'Transit di '.$transitName1pergi.' selama '.$transittimepergi;
                                                ?>

                                                <tr class="text-center" style="background-color:#F4F4F5; padding: 0px;">
                                                    <td colspan="4" style="vertical-align: middle; padding: 0px;">
                                                        <input type="text" class="text-center"
                                                               value="<?php echo $txbtransitpergi;?>"
                                                               style="width: 100%; font-size: 14px; border: none; background-color: white; color: black;"
                                                               readonly>
                                                    </td>
                                                </tr>

                                                <?php
                                            }

                                            $txbseatperginame = 'seatspergi'.$a;
                                            $seattransitpergi = $this->input->post($txbseatperginame,true);

                                            if($fare['pergi'][$a] != null){
                                                $bagasipergi = $fare['pergi'][$a]->data->baggage;
                                            }else{
                                                $bagasipergi = 20;
                                            }


                                            ?>
                                            <tr class="no-borders" style="background-color: #F4F4F5;">
                                                <td class="no-borders">
                                                    <img class="img-md" src="<?php echo $flighticontransitpergi;?>">
                                                </td>
                                                <td class="no-borders" style="vertical-align: middle;">
                                                    <text style="font-size: 14px;"> <?php echo $flightnametransitpergi ?></text>
                                                    <br/>
                                                    <text style="font-size: 12px;"> <?php echo $flightcodetransitpergi ?> (Subclass <?php echo $flightclasstransitpergi;?>)</text>
                                                </td>
                                                <td class="no-borders" style="vertical-align: middle;">
                                                    <div class="col-xs-5">
                                                        <text style="font-size: 12px;"><?php echo $transitName1pergi ?></text><br/>
                                                        <?php echo $departtimetransitpergi;?>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <i class="fa fa-arrow-right" style="margin-right:20px; margin-left: 20px;"></i>
                                                    </div>
                                                    <div class="col-xs-5">
                                                        <text style="font-size: 12px;"><?php echo $transitName2pergi ?></text><br/>
                                                        <?php echo $arrivaltimetransitpergi;?>
                                                    </div>
                                                </td>
                                                <td class="no-borders" style="vertical-align: middle;">
                                                    <i class="fa fa-suitcase"></i><text style="font-size: 10px;"> Bagasi <?php echo $bagasipergi;?> Kg</text>
                                                </td>
                                            </tr>
                                        
                                            <?php
                                        }
                                        ?>

                                    </table>

                                </td>
                            </tr>
                            <?php
                            if($pulangpergi=='on'){

                                $bagasipulang = 0;
                                if($fare['pulang'][0] != null){
                                    $bagasipulang = $fare['pulang'][0]->data->baggage;
                                }else{
                                    $bagasipulang = 20;
                                }
                                ?>

                                <tr class="no-borders">
                                    <td style="width: 100px;" class="no-borders">
                                        <img class="img-md" src="<?php echo $flighticonpulang;?>">
                                        <i class="fa fa-suitcase"></i><text style="font-size: 10px;"> Bagasi <?php echo $bagasipulang;?> Kg</text>
                                    </td>
                                    <td class="no-borders" style="vertical-align: middle;">
                                        <text style="font-size: 16px;"> <?php echo $flightnamepulang ?></text>
                                        <br/>
                                        <text style="font-size: 14px;"> <?php echo $flightcodepulang;?> (Subclass <?php echo $flightclasspulang;?>)</text>
                                    </td>
                                    <td class="no-borders" style="vertical-align: middle;">
                                        <text style="font-size: 16px;"> Pulang:</text>
                                        <br/>
                                        <text style="font-size: 16px;"> <?php echo hari($returnDatedb).', '.$returnDateindo;?></text>
                                        <br/>
                                        <text style="font-size: 14px;"> <?php echo $jampergipulang;?> - <?php echo $jamtibapulang;?></text>
                                    </td>
                                    <td class="no-borders" style="vertical-align: middle;">
                                        <?php
                                        if($istransitpulang == 'true'){
                                            ?>
                                            <a data-toggle="collapse" data-target="#trtransitpulang">
                                                <text style="font-size: 12px; color:#ED5565;"> <?php echo $jumlahpesawatpulang - 1;?> Transit</text>
                                                <i class="fa fa-eye" style="color:#ED5565;"></i>
                                            </a>
                                            <?php
                                        }else{
                                            ?>
                                            <text style="font-size: 12px; color:#ED5565;">Langsung</text>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr id="trtransitpulang" class="collapse">

                                    <td colspan="4">

                                        <table class="table no-borders" style="font-size: 12px;">

                                            <?php
                                            for ($a = 0; $a < $jumlahpesawatpulang; $a++) {

                                                $txbtransittimepulangname = 'transittimepulang'.$a;
                                                $txbflightcodetransitpulangname = 'flightcodepulang'.$a;
                                                $txbflightnametransitpulangname = 'flightnamepulang'.$a;
                                                $txbflighticontransitpulangname = 'flighticonpulang'.$a;
                                                $txbflightclasstransitpulangname = 'flightclasspulang'.$a;
                                                $txbdeparttimetransitpulangname = 'departtimepulang'.$a;
                                                $txbarrivaltimetransitpulangname = 'arrivaltimepulang'.$a;
                                                $txbtransitname1pulangname = 'transitname1pulang'.$a;
                                                $txbtransitname2pulangname = 'transitname2pulang'.$a;

                                                $transittimepulang = $this->input->post($txbtransittimepulangname,true);
                                                $transitName1pulang = $this->input->post($txbtransitname1pulangname,true);
                                                $transitName2pulang = $this->input->post($txbtransitname2pulangname,true);
                                                $flightcodetransitpulang = $this->input->post($txbflightcodetransitpulangname,true);
                                                $flightnametransitpulang = $this->input->post($txbflightnametransitpulangname,true);
                                                $flighticontransitpulang = $this->input->post($txbflighticontransitpulangname,true);
                                                $flightclasstransitpulang = $this->input->post($txbflightclasstransitpulangname,true);
                                                $departtimetransitpulang = $this->input->post($txbdeparttimetransitpulangname,true);
                                                $arrivaltimetransitpulang = $this->input->post($txbarrivaltimetransitpulangname,true);

                                                if($transittimepulang != '0j0m') {
                                                    $txbtransitpulang = 'Transit di '.$transitName1pulang.' selama '.$transittimepulang;
                                                    ?>

                                                    <tr class="text-center" style="background-color:#F4F4F5; padding: 0px;">
                                                        <td colspan="4" style="vertical-align: middle; padding: 0px;">
                                                            <input type="text" class="text-center"
                                                                   value="<?php echo $txbtransitpulang;?>"
                                                                   style="width: 100%; font-size: 14px; border: none; background-color: white; color: black;"
                                                                   readonly>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }

                                                $txbseatpulangname = 'seatspulang'.$a;
                                                $seattransitpulang = $this->input->post($txbseatpulangname,true);

                                                if($fare['pulang'][$a] != null){
                                                    $bagasipulang = $fare['pulang'][$a]->data->baggage;
                                                }else{
                                                    $bagasipulang = 20;
                                                }

                                                ?>
                                                <tr class="no-borders" style="background-color: #F4F4F5;">
                                                    <td class="no-borders">
                                                        <img class="img-md" src="<?php echo $flighticontransitpulang;?>">
                                                    </td>
                                                    <td class="no-borders" style="vertical-align: middle;">
                                                        <text style="font-size: 14px;"> <?php echo $flightnametransitpulang ?></text>
                                                        <br/>
                                                        <text style="font-size: 12px;"> <?php echo $flightcodetransitpulang ?> (Subclass <?php echo $flightclasstransitpulang;?>)</text>
                                                    </td>
                                                    <td class="no-borders" style="vertical-align: middle;">
                                                        <div class="col-xs-5">
                                                            <text style="font-size: 12px;"><?php echo $transitName1pulang ?></text><br/>
                                                            <?php echo $departtimetransitpulang;?>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <i class="fa fa-arrow-right" style="margin-right:20px; margin-left: 20px;"></i>
                                                        </div>
                                                        <div class="col-xs-5">
                                                            <text style="font-size: 12px;"><?php echo $transitName2pulang ?></text><br/>
                                                            <?php echo $arrivaltimetransitpulang;?>
                                                        </div>
                                                    </td>
                                                    <td class="no-borders" style="vertical-align: middle;">
                                                        <i class="fa fa-suitcase"></i><text style="font-size: 10px;"> Bagasi <?php echo $bagasipulang;?> Kg</text>
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                            ?>

                                        </table>

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
        <div class="col-lg-3 col-xs-4">

            <h2>&nbsp;</h2>

            <div class="ibox">

                <div class="ibox-title red-bg" style="padding-top: 20px; height: 60px;">
                    <h3 class="col-xs-10">
                        DETAIL HARGA
                    </h3>

                    <div class="col-xs-2">
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up fa-2x" style="color: white;"></i>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="ibox-content" style="padding-top:15px; padding-left: 20px; padding-right: 20px;">
                    <text style="font-size: 12px; margin-top: 10px;">* Bila Harga yang tertera masih 0, harga akan ditampilkan di halaman selanjutnya.</text><br/><br/>
                    <?php
                    if($pulangpergi == 'on'){
                        ?>

                        <div class="row bg-info" style="padding-top: 0px; padding-bottom: 0px;">
                            <div class="col-lg-12" style="padding-top: 0px; padding-bottom: 0px;">
                                Perjalanan Pergi
                            </div>
                        </div>
                        <hr style="margin-top:10px;"/>

                        <?php
                    }
                    ?>

                    <?php
                    $totalbayar = 0;

                    for ($b = 0; $b < $jumlahpesawatpergi; $b++) {
                        $txbflightnametransitperginame = 'flightnamepergi'.$b;
                        $txbtransitname1perginame = 'transitname1pergi'.$b;
                        $txbtransitname2perginame = 'transitname2pergi'.$b;

                        $flightnametransitpergi = $this->input->post($txbflightnametransitperginame,true);
                        $transitName1pergi = $this->input->post($txbtransitname1perginame,true);
                        $transitName2pergi = $this->input->post($txbtransitname2perginame,true);

                        $exptransitName1pergi = explode('(', $transitName1pergi);
                        $transitName1pergi = $exptransitName1pergi[1];
                        $transitName1pergi = str_replace(")","",$transitName1pergi);

                        $exptransitName2pergi = explode('(', $transitName2pergi);
                        $transitName2pergi = $exptransitName2pergi[1];
                        $transitName2pergi = str_replace(")","",$transitName2pergi);


                        $class= 'rowpergi'.$b;

                        $harga = 0;
                        $hargaindo = 0;
                        $customadmin = 0;
                        $customadminindo = 0;
                        $totalharga = 0;

                        $bagasitransit = 20;

                        if($fare['pergi'][$b] != null){

                            $harga = $fare['pergi'][$b]->data->price;
                            $hargaindo = rupiah($harga);

                            $jumlahsettingspergi = count($fare['pergi'][$b]->data->settings);
                            if($jumlahsettingspergi > 1){
                                $customadmin = $fare['pergi'][$b]->data->settings->$airlinecodepergi->customAdmin;
                                $customadminindo = rupiah($customadmin);
                            }

                            $totalharga = $harga + $customadmin;

                            $bagasi = $fare['pergi'][$b]->data->baggage;
                        }

                        $totalhargaindo = rupiah($totalharga);

                        $totalbayar = $totalbayar + $totalharga;

                        $txbflightfareperginame = 'flightfarepergi'.$b;
                        $txbflightadminperginame = 'flightbiayaadminpergi'.$b;

                        ?>
                        <div class="row">
                            <div class="col-lg-8">
                                <text style="font-size: 16px;"> <?php echo $flightnametransitpergi ?> (<?php echo $transitName1pergi;?> <i class="fa fa-arrow-right"></i> <?php echo $transitName2pergi;?>)</text><br/>
                            </div>
                            <div class="col-lg-4 text-right">
                                <input type="hidden" name="<?php echo $txbflightfareperginame;?>" value="<?php echo $harga;?>">
                                <input type="hidden" name="<?php echo $txbflightadminperginame;?>" value="<?php echo $customadmin;?>">
                                <text style="font-size: 14px;"> <?php echo $totalhargaindo;?></text>
                                <a data-toggle="collapse" data-target=".<?php echo $class;?>">
                                    <i class="fa fa-caret-down"></i>
                                </a>
                            </div>
                            <?php
                            if($fare['pergi'][$b] == null){
                                ?>
                                <div class="col-lg-12">
                                    <div class="alert alert-warning alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        Terjadi kesalahan API pada proses pemanggilan data harga.<br/>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <hr/>
                        <div class="row collapse <?php echo $class;?>">

                            <div class="col-xs-6">
                                <text style="font-size: 14px;"> Harga Tiket :</text><br/>
                                <text style="font-size: 12px;"> Adult x <?php echo $adult;?></text><br/>
                                <?php
                                if($child > 0){
                                    ?>
                                    <text style="font-size: 12px;"> Child x <?php echo $child;?> </text><br/>
                                    <?php
                                }

                                if ($infant > 0){
                                    ?>
                                    <text style="font-size: 12px;"> Infant x <?php echo $infant;?></text><br/>
                                    <?php
                                }
                                ?>
                                <br/>
                                <text style="font-size: 14px;"> Biaya Admin :</text><br/>

                            </div>
                            <div class="col-xs-6 text-right">

                                <text style="font-size: 14px;"> <?php echo $hargaindo;?></text><br/><br/>
                                <?php
                                if($child > 0){
                                    ?>
                                    <br/>
                                    <?php
                                }

                                if ($infant > 0){
                                    ?>
                                    <br/>
                                    <?php
                                }
                                ?>
                                <br/>
                                <text style="font-size: 14px;"> <?php echo $customadminindo;?></text>

                            </div>

                        </div>

                        <hr class="collapse <?php echo $class;?>"/>

                        <?php
                    }

                    if($jumlahpesawatpergi != $jumlahclassespergi){
                        $hargaawal = $fare['pergi'][0]->data->price;
                        $jmlkelebihanclass = $jumlahpesawatpergi - 1;
                        $totalbayar = $totalbayar - ($jmlkelebihanclass * $hargaawal);
                    }

                    $totalbayarindo = rupiah($totalbayar);
                    ?>

                    <?php
                    if($pulangpergi == 'on'){
                        ?>

                        <div class="row bg-info" style="padding-top: 0px; padding-bottom: 0px;">
                            <div class="col-lg-12" style="padding-top: 0px; padding-bottom: 0px;">
                                Perjalanan Pulang
                            </div>
                        </div>
                        <hr style="margin-top:10px;"/>

                        <?php

                        for ($c = 0; $c < $jumlahpesawatpulang; $c++) {
                            $txbflightnametransitpulangname = 'flightnamepulang'.$c;
                            $txbtransitname1pulangname = 'transitname1pulang'.$c;
                            $txbtransitname2pulangname = 'transitname2pulang'.$c;

                            $flightnametransitpulang = $this->input->post($txbflightnametransitpulangname,true);
                            $transitName1pulang = $this->input->post($txbtransitname1pulangname,true);
                            $transitName2pulang = $this->input->post($txbtransitname2pulangname,true);

                            $exptransitName1pulang = explode('(', $transitName1pulang);
                            $transitName1pulang = $exptransitName1pulang[1];
                            $transitName1pulang = str_replace(")","",$transitName1pulang);

                            $exptransitName2pulang = explode('(', $transitName2pulang);
                            $transitName2pulang = $exptransitName2pulang[1];
                            $transitName2pulang = str_replace(")","",$transitName2pulang);


                            $class= 'rowpulang'.$c;

                            $harga = 0;
                            $hargaindo = 0;
                            $customadmin = 0;
                            $customadminindo = 0;
                            $totalharga = 0;

                            $bagasitransit = 20;

                            if($fare['pulang'][$c] != null){

                                $harga = $fare['pulang'][$c]->data->price;
                                $hargaindo = rupiah($harga);

                                $jumlahsettingspulang = count($fare['pulang'][$c]->data->settings);
                                if($jumlahsettingspulang > 1) {
                                    $customadmin = $fare['pulang'][$c]->data->settings->$airlinecodepulang->customAdmin;
                                    $customadminindo = rupiah($customadmin);
                                }

                                $totalharga = $harga + $customadmin;

                                $bagasi = $fare['pulang'][$c]->data->baggage;
                            }

                            $totalhargaindo = rupiah($totalharga);

                            $totalbayar = $totalbayar + $totalharga;
                            
                            $txbflightfarepulangname = 'flightfarepulang'.$c;
                            $txbflightadminpulangname = 'flightbiayaadminpulang'.$c;

                            ?>
                            <div class="row">
                                <div class="col-lg-8">
                                    <text style="font-size: 16px;"> <?php echo $flightnametransitpulang ?> (<?php echo $transitName1pulang;?> <i class="fa fa-arrow-right"></i> <?php echo $transitName2pulang;?>)</text><br/>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <input type="hidden" name="<?php echo $txbflightfarepulangname;?>" value="<?php echo $harga;?>">
                                    <input type="hidden" name="<?php echo $txbflightadminpulangname;?>" value="<?php echo $customadmin;?>">
                                    <text style="font-size: 14px;"> <?php echo $totalhargaindo;?></text>
                                    <a data-toggle="collapse" data-target=".<?php echo $class;?>">
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                </div>
                                <?php
                                if($fare['pulang'][$c] == null){
                                    ?>
                                    <div class="col-lg-12">
                                        <div class="alert alert-warning alert-dismissable">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            Terjadi kesalahan API pada proses pemanggilan data harga.<br/>
                                            Mohon untuk direfresh kembali atau dimulai dari pencarian tiket kembali.
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <hr/>
                            <div class="row collapse <?php echo $class;?>">

                                <div class="col-xs-6">
                                    <text style="font-size: 14px;"> Harga Tiket :</text><br/>
                                    <text style="font-size: 12px;"> Adult x <?php echo $adult;?></text><br/>
                                    <?php
                                    if($child > 0){
                                        ?>
                                        <text style="font-size: 12px;"> Child x <?php echo $child;?> </text><br/>
                                        <?php
                                    }
                                    if ($infant > 0){
                                        ?>
                                        <text style="font-size: 12px;"> Infant x <?php echo $infant;?></text><br/>
                                        <?php
                                    }
                                    ?>
                                    <br/>
                                    <text style="font-size: 14px;"> Biaya Admin :</text><br/>

                                </div>
                                <div class="col-xs-6 text-right">

                                    <text style="font-size: 14px;"> <?php echo $hargaindo;?></text><br/><br/>
                                    <?php
                                    if($child > 0){
                                        ?>
                                        <br/>
                                        <?php
                                    }elseif ($infant > 0){
                                        ?>
                                        <br/>
                                        <?php
                                    }
                                    ?>
                                    <br/>
                                    <text style="font-size: 14px;"> <?php echo $customadminindo;?></text>

                                </div>

                            </div>

                            <hr class="collapse <?php echo $class;?>"/>

                            <?php
                        }

                        if($jumlahpesawatpulang != $jumlahclassespulang){
                            $hargaawal = $fare['pulang'][0]->data->price;
                            $jmlkelebihanclass = $jumlahpesawatpulang - 1;
                            $totalbayar = $totalbayar - ($jmlkelebihanclass * $hargaawal);
                        }

                        $totalbayarindo = rupiah($totalbayar);

                    }
                    ?>

                    <br/>
                    <div class="row">
                        <div class="col-xs-6">
                            <text style="font-size: 14px; font-weight: bold;"> Total Pembayaran</text>
                        </div>
                        <div class="col-xs-6 text-right">
                            <text style="font-size: 14px; font-weight: bold;"> <?php echo $totalbayarindo;?></text>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <div class="col-lg-1"></div>
    </div>

    <div class="row">
        <div class="col-lg-9 col-lg-offset-2 col-xs-12">

            <div class="ibox">

                <div class="ibox-title red-bg" style="padding-top: 20px; height: 60px;">
                    <h3 class="col-xs-10">
                        DATA KONTAK YANG DAPAT DIHUBUNGI
                    </h3>

                    <div class="col-xs-2">
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up fa-2x" style="color: white;"></i>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="ibox-content" style=" padding-top: 10px; padding-left: 20px; padding-right: 20px;">

                    <div class="form-group">

                        <div class="col-lg-1">
                            <label class="control-label" style="margin-bottom: 10px;">Titel <span style="color:#ed5565">*</span></label>
                            <select class="form-control" name="txbtitelkontak" required>
                                <option value="Tuan"> Tuan </option>
                                <option value="Nyonya"> Nyonya </option>
                                <option value="Nona"> Nona </option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label class="control-label" style="margin-bottom: 10px;">Nama Lengkap <span style="color:#ed5565">*</span></label>
                            <input type="text" name="txbnamakontak" class="form-control" placeholder="Contoh. Budi Saja" required>
                            <span class="help-block m-b-none">Isi sesuai KTP/Paspor/SIM (tanpa tanda baca dan gelar)</span>
                        </div>
                        <div class="col-lg-3">
                            <label class="control-label" style="margin-bottom: 10px;">No Telepon <span style="color:#ed5565">*</span></label>
                            <input type="text" id="noteleponkontak" name="txbnoteleponkontak" class="form-control" placeholder="Contoh. 08123456789" maxlength="15" required>
                        </div>
                        <div class="col-lg-4">
                            <label class="control-label" style="margin-bottom: 10px;">Email <span style="color:#ed5565">*</span></label>
                            <input type="email" name="txbemailkontak" class="form-control" placeholder="Contoh. youremail@example.com" required>
                            <span class="help-block m-b-none">E-ticket akan dikirimkan ke alamat email ini</span>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-9 col-lg-offset-2 col-xs-12">

            <div class="ibox">

                <input type="hidden" id="txbjumlahdewasa" name="txbjumlahdewasa" value="<?php echo $adult;?>">
                <input type="hidden" id="txbjumlahanak" name="txbjumlahanak" value="<?php echo $child;?>">
                <input type="hidden" id="txbjumlahbayi" name="txbjumlahbayi" value="<?php echo $infant;?>">

                <div class="ibox-title red-bg" style="padding-top: 20px; height: 60px;">
                    <h3 class="col-xs-10">
                        DATA PENUMPANG
                    </h3>

                    <div class="col-xs-2">
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up fa-2x" style="color: white;"></i>
                            </a>
                        </div>
                    </div>

                </div>

                <?php
                for ($d = 1; $d <= $adult; $d++) {
                    ?>

                    <div class="ibox-content" style="padding-top: 10px; padding-left: 20px; padding-right: 20px; border-top: solid 1px <?php echo $warna_lembaga;?>">
                        <div class="form-group">
                            <div class="col-xs-7"><text style="font-size: 18px;">Penumpang <?php echo $d;?>: Dewasa (Adult)</text></div>
                            <label class="col-xs-3 control-label" style="margin-bottom: 10px;">Kewarganegaraan <span style="color:#ed5565">*</span></label>
                            <div class="col-xs-2">
                                <select class="form-control select-country" name="slkewarganegaraan<?php echo $d;?>" required>
                                    <option value="id">Indonesia</option>
                                    <?php
                                    $lengthdatacountry = count($country);
                                    for ($i = 0; $i < $lengthdatacountry; $i++) {
                                        $countryCode = $country[$i]['alpha2'];
                                        $countryName = $country[$i]['name'];
                                        if($countryName != 'Indonesia'){
                                            ?>
                                            <option value="<?php echo $countryCode;?>"><?php echo $countryName;?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">

                            <div class="col-lg-1">
                                <label class="control-label" style="margin-bottom: 10px;">Titel <span style="color:#ed5565">*</span></label>
                                <select class="form-control" name="txbtiteldewasa<?php echo $d;?>" required>
                                    <option value="Tuan"> Tuan </option>
                                    <option value="Nyonya"> Nyonya </option>
                                    <option value="Nona"> Nona </option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label" style="margin-bottom: 10px;">Nama Depan & Nama Tengah <span style="color:#ed5565">*</span></label>
                                <input type="text" name="txbnamadepandewasa<?php echo $d;?>" class="form-control" placeholder="Contoh. Budi Tengah" required>
                                <span class="help-block m-b-none">Isi sesuai KTP/Paspor/SIM (tanpa tanda baca dan gelar)</span>
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label" style="margin-bottom: 10px;">Nama Keluarga / Nama Belakang <span style="color:#ed5565">*</span></label>
                                <input type="text" name="txbnamabelakangdewasa<?php echo $d;?>" class="form-control" placeholder="Contoh. Saja" required>
                                <span class="help-block m-b-none">Isi sesuai KTP/Paspor/SIM (tanpa tanda baca dan gelar)</span>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" style="margin-bottom: 10px;">Email <span style="color:#ed5565">*</span></label>
                                <input type="email" name="txbemaildewasa<?php echo $d;?>" class="form-control" placeholder="Contoh. youremail@example.com" required>
                                <span class="help-block m-b-none">Jika tidak mempunyai email, isi dengan alamat email kontak yang dapat dihubungi </span>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label" style="margin-bottom: 10px;">No Telepon </label>
                                <input type="text" id="notelepondewasa<?php echo $d;?>" name="txbnotelepondewasa<?php echo $d;?>" class="form-control notelepondewasa" placeholder="Contoh. 022123456789" maxlength="15">
                                <span class="help-block m-b-none">Ditambahkan kode area, seperti: 021,022,0265,... , Jika tidak ada atau sama ketikkan angka 0</span>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" style="margin-bottom: 10px;">No Handphone </label>
                                <input type="text" id="nohandphonedewasa<?php echo $d;?>" name="txbnohandphonedewasa<?php echo $d;?>" class="form-control nohandphonedewasa" placeholder="Contoh. 081123456789" maxlength="15">
                                <span class="help-block m-b-none">Jika tidak ada atau sama ketikkan angka 0</span>
                            </div>
                            <div id="tgllahirdewasa<?php echo $d;?>" class="col-lg-2 tgllahir">
                                <label class="control-label" style="margin-bottom: 10px;">Tanggal Lahir <span style="color:#ed5565">*</span> </label>
                                <div class="input-group date">
                                    <?php $today = date("d/m/Y"); ?>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="txbtgllahirdewasa<?php echo $d;?>" class="form-control" value="<?php echo $today?>" required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label" style="margin-bottom: 10px;">ID Card <span style="color:#ed5565">*</span></label>
                                <select class="form-control" name="txbjenisidcardewasa<?php echo $d;?>" required>
                                    <option value="KTP"> KTP </option>
                                    <option value="SIM"> SIM </option>
                                    <option value="Passpor"> Passpor </option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label" style="margin-bottom: 10px;">No. Id Card <span style="color:#ed5565">*</span> </label>
                                <input type="text" name="txbnoidentitydewasa<?php echo $d;?>" class="form-control" placeholder="Contoh. 1234567890" required>
                                <span class="help-block m-b-none">< 17 tahun jika tidak memiliki ID diisi dengan tanggal lahir format hhbbtttt. Contoh: 01011993</span>
                            </div>
                        </div>
                    </div>

                    <?php
                }

                if($child > 0){

                    for ($e = 1; $e <= $child; $e++) {

                        ?>

                        <div class="ibox-content" style="padding-top: 10px; padding-left: 20px; padding-right: 20px; border-top: solid 1px <?php echo $warna_lembaga;?>">
                            <div class="form-group">
                                <div class="col-xs-7"><text style="font-size: 18px;">Penumpang <?php echo $e;?>: Anak-anak (Child)</text></div>
                            </div>
                            <hr/>
                            <div class="form-group">

                                <div class="col-lg-1">
                                    <label class="control-label" style="margin-bottom: 10px;">Titel <span style="color:#ed5565">*</span></label>
                                    <select class="form-control" name="txbtitelanak<?php echo $e;?>" required>
                                        <option value="Tuan"> Tuan </option>
                                        <option value="Nona"> Nona </option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label" style="margin-bottom: 10px;">Nama Depan & Nama Tengah <span style="color:#ed5565">*</span></label>
                                    <input type="text" name="txbnamadepananak<?php echo $e;?>" class="form-control" placeholder="Contoh. Budi Tengah" required>
                                    <span class="help-block m-b-none">Isi sesuai KTP/Paspor/SIM (tanpa tanda baca dan gelar)</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label" style="margin-bottom: 10px;">Nama Keluarga / Nama Belakang <span style="color:#ed5565">*</span></label>
                                    <input type="text" name="txbnamabelakanganak<?php echo $e;?>" class="form-control" placeholder="Contoh. Saja" required>
                                    <span class="help-block m-b-none">Isi sesuai KTP/Paspor/SIM (tanpa tanda baca dan gelar)</span>
                                </div>
                                <div class="col-lg-3 tgllahir">
                                    <label class="control-label" style="margin-bottom: 10px;">Tanggal Lahir <span style="color:#ed5565">*</span></label>
                                    <div class="input-group date">
                                        <?php $today = date("d/m/Y"); ?>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="txbtgllahiranak<?php echo $e;?>" class="form-control" value="<?php echo $today?>" required>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php
                    }

                }

                if($infant > 0){

                    for ($f = 1; $f <= $infant; $f++) {

                        ?>

                        <div class="ibox-content" style="padding-top: 10px; padding-left: 20px; padding-right: 20px; border-top: solid 1px <?php echo $warna_lembaga;?>">
                            <div class="form-group">
                                <div class="col-xs-7"><text style="font-size: 18px;">Penumpang <?php echo $f;?>: Bayi (Infant)</text></div>
                            </div>
                            <hr/>
                            <div class="form-group">

                                <div class="col-lg-1">
                                    <label class="control-label" style="margin-bottom: 10px;">Titel <span style="color:#ed5565">*</span></label>
                                    <select class="form-control" name="txbtitelbayi<?php echo $f;?>" required>
                                        <option>- Pilih -</option>
                                        <option value="Tuan"> Tuan </option>
                                        <option value="Nona"> Nona </option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label" style="margin-bottom: 10px;">Nama Depan & Nama Tengah <span style="color:#ed5565">*</span></label>
                                    <input type="text" name="txbnamadepanbayi<?php echo $f;?>" class="form-control" placeholder="Contoh. Budi Tengah" required>
                                    <span class="help-block m-b-none">Isi sesuai KTP/Paspor/SIM (tanpa tanda baca dan gelar)</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label" style="margin-bottom: 10px;">Nama Keluarga / Nama Belakang <span style="color:#ed5565">*</span></label>
                                    <input type="text" name="txbnamabelakangbayi<?php echo $f;?>" class="form-control" placeholder="Contoh. Saja" required>
                                    <span class="help-block m-b-none">Isi sesuai KTP/Paspor/SIM (tanpa tanda baca dan gelar)</span>
                                </div>
                                <div id="tgllahiranak<?php echo $f;?>" class="col-lg-3 tgllahir">
                                    <label class="control-label" style="margin-bottom: 10px;">Tanggal Lahir <span style="color:#ed5565">*</span> </label>
                                    <div class="input-group date">
                                        <?php $today = date("d/m/Y"); ?>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="txbtgllahirbayi<?php echo $f;?>" class="form-control" value="<?php echo $today?>" required>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php
                    }

                }
                ?>

                <div class="ibox-content" style="border-top: solid 1px <?php echo $warna_lembaga;?>">

                    <input type="hidden" name="pulangpergi" value="<?php echo $pulangpergi;?>">
                    <input type="hidden" name="air_from" value="<?php echo $airfrom;?>">
                    <input type="hidden" name="air_to" value="<?php echo $airto;?>">
                    <input type="hidden" name="departuredate" value="<?php echo $departuredate;?>">
                    <input type="hidden" name="returndate" value="<?php echo $returndate;?>">
                    <input type="hidden" name="adult" value="<?php echo $adult;?>">
                    <input type="hidden" name="child" value="<?php echo $child;?>">
                    <input type="hidden" name="infant" value="<?php echo $infant;?>">

                    <!--input pergi-->
                    <input type="hidden" name="jumlahpesawatpergi" value="<?php echo $jumlahpesawatpergi;?>">
                    <input type="hidden" name="jumlahclassespergi" value="<?php echo $jumlahclassespergi;?>">
                    <input type="hidden" name="istransitpergi" value="<?php echo $istransitpergi;?>">
                    <input type="hidden" name="airlinecodepergi" value="<?php echo $airlinecodepergi;?>">
                    <input type="hidden" name="jampergipergi" value="<?php echo $jampergipergi;?>">
                    <input type="hidden" name="jamtibapergi" value="<?php echo $jamtibapergi;?>">

                    <?php
                    for ($a = 0; $a < $jumlahpesawatpergi; $a++) {

                        $txbtransittimeperginame = 'transittimepergi'.$a;
                        $txbflightcodetransitperginame = 'flightcodepergi'.$a;
                        $txbflightnametransitperginame = 'flightnamepergi'.$a;
                        $txbflighticontransitperginame = 'flighticonpergi'.$a;
                        $txbflightclasstransitperginame = 'flightclasspergi'.$a;
                        $txbdeparttimetransitperginame = 'departtimepergi'.$a;
                        $txbarrivaltimetransitperginame = 'arrivaltimepergi'.$a;
                        $txbtransitname1perginame = 'transitname1pergi'.$a;
                        $txbtransitname2perginame = 'transitname2pergi'.$a;

                        $transittimepergi = $this->input->post($txbtransittimeperginame,true);
                        $transitName1pergi = $this->input->post($txbtransitname1perginame,true);
                        $transitName2pergi = $this->input->post($txbtransitname2perginame,true);
                        $flightcodetransitpergi = $this->input->post($txbflightcodetransitperginame,true);
                        $flightnametransitpergi = $this->input->post($txbflightnametransitperginame,true);
                        $flighticontransitpergi = $this->input->post($txbflighticontransitperginame,true);
                        $flightclasstransitpergi = $this->input->post($txbflightclasstransitperginame,true);
                        $departtimetransitpergi = $this->input->post($txbdeparttimetransitperginame,true);
                        $arrivaltimetransitpergi = $this->input->post($txbarrivaltimetransitperginame,true);

                        $txbbagasiperginame = 'bagasipergi'.$a;
                        if($fare['pergi'][$a] != null){
                            $bagasipergi = $fare['pergi'][$a]->data->baggage;
                        }else{
                            $bagasipergi = 20;
//                            $disabledbuttonsubmit = 'disabled';
                        }

                        $txbseatperginame = 'seatspergi'.$a;
                        $seattransitpergi = $this->input->post($txbseatperginame,true);

                        ?>

                        <input type="hidden" name="<?php echo $txbflightcodetransitperginame;?>" value="<?php echo $flightcodetransitpergi;?>">
                        <input type="hidden" name="<?php echo $txbtransittimeperginame;?>" value="<?php echo $transittimepergi;?>">
                        <input type="hidden" name="<?php echo $txbflighticontransitperginame;?>" value="<?php echo $flighticontransitpergi;?>">
                        <input type="hidden" name="<?php echo $txbflightnametransitperginame;?>" value="<?php echo $flightnametransitpergi;?>">
                        <input type="hidden" name="<?php echo $txbflightclasstransitperginame;?>" value="<?php echo $flightclasstransitpergi;?>">
                        <input type="hidden" name="<?php echo $txbdeparttimetransitperginame;?>" value="<?php echo $departtimetransitpergi;?>">
                        <input type="hidden" name="<?php echo $txbarrivaltimetransitperginame;?>" value="<?php echo $arrivaltimetransitpergi;?>">
                        <input type="hidden" name="<?php echo $txbtransitname1perginame;?>" value="<?php echo $transitName1pergi;?>">
                        <input type="hidden" name="<?php echo $txbtransitname2perginame;?>" value="<?php echo $transitName2pergi;?>">
                        <input type="hidden" name="<?php echo $txbseatperginame;?>" value="<?php echo $seattransitpergi;?>">
                        <input type="hidden" name="<?php echo $txbbagasiperginame;?>" value="<?php echo $bagasipergi;?>">

                        <?php
                    }

                    if($pulangpergi == 'on'){

                        ?>

                        <!--input pulang-->

                        <input type="hidden" name="jumlahpesawatpulang" value="<?php echo $jumlahpesawatpulang;?>">
                        <input type="hidden" name="jumlahclassespulang" value="<?php echo $jumlahclassespulang;?>">
                        <input type="hidden" name="istransitpulang" value="<?php echo $istransitpulang;?>">
                        <input type="hidden" name="airlinecodepulang" value="<?php echo $airlinecodepulang;?>">
                        <input type="hidden" name="jampergipulang" value="<?php echo $jampergipulang;?>">
                        <input type="hidden" name="jamtibapulang" value="<?php echo $jamtibapulang;?>">

                        <?php
                        for ($a = 0; $a < $jumlahpesawatpulang; $a++) {

                            $txbtransittimepulangname = 'transittimepulang'.$a;
                            $txbflightcodetransitpulangname = 'flightcodepulang'.$a;
                            $txbflightnametransitpulangname = 'flightnamepulang'.$a;
                            $txbflighticontransitpulangname = 'flighticonpulang'.$a;
                            $txbflightclasstransitpulangname = 'flightclasspulang'.$a;
                            $txbdeparttimetransitpulangname = 'departtimepulang'.$a;
                            $txbarrivaltimetransitpulangname = 'arrivaltimepulang'.$a;
                            $txbtransitname1pulangname = 'transitname1pulang'.$a;
                            $txbtransitname2pulangname = 'transitname2pulang'.$a;

                            $transittimepulang = $this->input->post($txbtransittimepulangname,true);
                            $transitName1pulang = $this->input->post($txbtransitname1pulangname,true);
                            $transitName2pulang = $this->input->post($txbtransitname2pulangname,true);
                            $flightcodetransitpulang = $this->input->post($txbflightcodetransitpulangname,true);
                            $flightnametransitpulang = $this->input->post($txbflightnametransitpulangname,true);
                            $flighticontransitpulang = $this->input->post($txbflighticontransitpulangname,true);
                            $flightclasstransitpulang = $this->input->post($txbflightclasstransitpulangname,true);
                            $departtimetransitpulang = $this->input->post($txbdeparttimetransitpulangname,true);
                            $arrivaltimetransitpulang = $this->input->post($txbarrivaltimetransitpulangname,true);


                            $txbseatpulangname = 'seatspulang'.$a;
                            $seattransitpulang = $this->input->post($txbseatpulangname,true);

                            $txbbagasipulangname = 'bagasipulang'.$a;
                            if($fare['pulang'][$a] != null){
                                $bagasipulang = $fare['pulang'][$a]->data->baggage;
                            }else{
                                $bagasipulang = 20;
//                                $disabledbuttonsubmit = 'disabled';
                            }

                            ?>

                            <input type="hidden" name="<?php echo $txbflightcodetransitpulangname;?>" value="<?php echo $flightcodetransitpulang;?>">
                            <input type="hidden" name="<?php echo $txbtransittimepulangname;?>" value="<?php echo $transittimepulang;?>">
                            <input type="hidden" name="<?php echo $txbflighticontransitpulangname;?>" value="<?php echo $flighticontransitpulang;?>">
                            <input type="hidden" name="<?php echo $txbflightnametransitpulangname;?>" value="<?php echo $flightnametransitpulang;?>">
                            <input type="hidden" name="<?php echo $txbflightclasstransitpulangname;?>" value="<?php echo $flightclasstransitpulang;?>">
                            <input type="hidden" name="<?php echo $txbdeparttimetransitpulangname;?>" value="<?php echo $departtimetransitpulang;?>">
                            <input type="hidden" name="<?php echo $txbarrivaltimetransitpulangname;?>" value="<?php echo $arrivaltimetransitpulang;?>">
                            <input type="hidden" name="<?php echo $txbtransitname1pulangname;?>" value="<?php echo $transitName1pulang;?>">
                            <input type="hidden" name="<?php echo $txbtransitname2pulangname;?>" value="<?php echo $transitName2pulang;?>">
                            <input type="hidden" name="<?php echo $txbseatpulangname;?>" value="<?php echo $seattransitpulang;?>">
                            <input type="hidden" name="<?php echo $txbbagasipulangname;?>" value="<?php echo $bagasipulang;?>">


                            <?php
                        }

                    }
                    ?>

                    <div class="form-group">
                        <div class="col-xs-2 col-xs-offset-10">

                            <button type="submit" class="btn btn-danger" style="width: 100%;" <?php echo $disabledbuttonsubmit;?>>Lanjutkan Pembayaran</button>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

</form>

<!-- /content -->