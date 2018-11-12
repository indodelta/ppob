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
                <strong>Selesai</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<?php
$this->load->view('func_custom');

$trans_id = $this->input->post('transid',true);
$bookingcodepergi0 = $this->input->post('bookingcodepergi0',true);

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
$bagasipergi = $this->input->post('bagasipergi0',true);

$jampergipergi = $this->input->post('jampergipergi',true);
$jamtibapergi = $this->input->post('jamtibapergi',true);

$istransitpergi = $this->input->post('istransitpergi',true);

if($pulangpergi == 'on'){

    $bookingcodepulang0 = $this->input->post('bookingcodepulang0',true);

    $jumlahpesawatpulang = $this->input->post('jumlahpesawatpulang',true);
    $jumlahclassespulang = $this->input->post('jumlahclassespulang',true);
    $airlinecodepulang = $this->input->post('airlinecodepulang',true);
    $flightcodepulang = $this->input->post('flightcodepulang0',true);
    $flightnamepulang = $this->input->post('flightnamepulang0',true);
    $flighticonpulang = $this->input->post('flighticonpulang0',true);
    $flightclasspulang = $this->input->post('flightclasspulang0',true);
    $flightclasspulang = $this->input->post('flightclasspulang0',true);
    $bagasipulang = $this->input->post('bagasipulang0',true);

    $jampergipulang = $this->input->post('jampergipulang',true);
    $jamtibapulang = $this->input->post('jamtibapulang',true);

    $istransitpulang = $this->input->post('istransitpulang',true);

}

?>

<div class="wrapper wrapper-content animated fadeInRight article" style="margin-top: 80px;">

    <?php
    $urlstruk = 'http://api.fastravel.co.id/app/generate_struk?id_transaksi=795763739';
    $urletiket = 'http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739';
    ?>

    <div class="row" style="margin-top: 10px;">
        <div class="col-lg-9 col-lg-offset-2">
            <div class="ibox">
                <div class="ibox-content">
                    <h1 style="color: green;">SELAMAT</h1>
                    <h2>Anda telah melakukan transaksi Pesawat, dengan rincian sebagai berikut:</h2><br/>
                    <?php
                    if($pulangpergi == 'on'){
                        ?>
                        <h3>Perjalanan Pergi : </h3><br/>
                        <?php
                    }
                    ?>

                    <?php
                    for ($a = 0; $a < $jumlahpesawatpergi; $a++) {
                        $txbbookingcodeperginame = 'bookingcodepergi'.$a;
                        $txbidtransaksiperginame = 'transactionidpergi'.$a;
                        $txbtransitname1perginame = 'transitname1pergi'.$a;
                        $txbtransitname2perginame = 'transitname2pergi'.$a;
                        $bookingcodepergi = $this->input->post($txbbookingcodeperginame,true);
                        $idtransaksipergi = $this->input->post($txbidtransaksiperginame,true);

                        $transitName1pergi = $this->input->post($txbtransitname1perginame,true);
                        $exptransitName1pergi = explode('(', $transitName1pergi);
                        $transitName1pergi = $exptransitName1pergi[1];
                        $transitName1pergi = str_replace(")","",$transitName1pergi);

                        $transitName2pergi = $this->input->post($txbtransitname2perginame,true);
                        $exptransitName2pergi = explode('(', $transitName2pergi);
                        $transitName2pergi = $exptransitName2pergi[1];
                        $transitName2pergi = str_replace(")","",$transitName2pergi);

                        $b = $a + 1;
                    ?>

                        <div class="form-group">
                            <div class="col-xs-2">
                                <label><?php echo $b; ?></label>.
                                <?php echo $transitName1pergi; ?> <i class="fa fa-arrow-right"></i>  <?php echo $transitName2pergi; ?>
                            </div>
                            <div class="col-lg-2 col-xs-3">
                                <label>ID Transaksi : </label> <?php echo $idtransaksipergi; ?>
                            </div>
                            <div class="col-lg-2 col-xs-3"><label>Booking Code : </label> <?php echo $bookingcodepergi; ?></div>
                        </div><br/>

                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-2">
                                <label>URL E-Struk</label>
                            </div>
                            <div class="col-xs-8">
                                <a href="<?php echo $urlstruk; ?>"><?php echo $urlstruk; ?></a>
                            </div>
                        </div><br/>
                        <div class="form-group">
                            <div class="col-xs-2 col-xs-offset-2">
                                <label>URL E-Tiket</label>
                            </div>
                            <div class="col-xs-8">
                                <a href="<?php echo $urletiket; ?>"><?php echo $urletiket; ?></a>
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="col-lg-1">
    </div>

    <div class="row">
        <div class="col-lg-6 col-lg-offset-2 col-xs-8">

            <h2>
                <i class="fa fa-plane" style="margin-right:10px;color: <?php echo $warna_lembaga; ?>"></i>
                <span style="color: <?php echo $warna_lembaga; ?>">Informasi Penerbangan</span>
            </h2>

            <div class="ibox">

                <div class="ibox-title red-bg" style="padding-top: 20px; height: 60px;">
                    <h3 class="col-xs-10">
                        PESANAN ANDA
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

                    ?>

                    <h2>
                        <i class="fa fa-plane fa-2x" style="margin-right:10px;"></i>
                        <?php echo $airfromname; ?> <i class="fa <?php echo $iconfa;?>" style="margin-right:20px; margin-left: 20px;"></i>  <?php echo $airtoname; ?>
                    </h2>
                    <hr/>
                    <div class="table-responsive">
                        <table class="table no-borders">
                            <tr class="no-borders">
                                <td colspan="2" class="no-borders">
                                    <text style="font-size: 16px;"> Transaction ID: <span style="font-weight: bold"><?php echo $trans_id ?></span></text>
                                </td>
                                <td colspan="2" class="no-borders text-right"></td>
                            </tr>

                            <!-- table pergi-->

                            <tr class="no-borders">
                                <td class="no-borders" style="vertical-align: middle; padding-bottom: 30px;">
                                    <text style="font-size: 16px;"> <?php echo $bookingcodepergi0 ?></text>
                                </td>
                                <td style="width: 100px; padding-bottom: 30px;" class="no-borders">
                                    <img class="img-md" src="<?php echo $flighticonpergi;?>">
                                    <i class="fa fa-suitcase"></i><text style="font-size: 10px;"> Bagasi <?php echo $bagasipergi;?> Kg</text>
                                </td>
                                <td class="no-borders" style="vertical-align: middle; padding-bottom: 30px;">
                                    <text style="font-size: 16px;"> <?php echo $flightnamepergi ?></text>
                                    <br/>
                                    <text style="font-size: 14px;"> <?php echo $flightcodepergi;?> (Subclass <?php echo $flightclasspergi;?>)</text>
                                </td>
                                <td class="no-borders" style="vertical-align: middle; padding-bottom: 30px;">
                                    <text style="font-size: 16px;"> Pergi:</text>
                                    <br/>
                                    <text style="font-size: 16px;"> <?php echo hari($departureDatedb).', '.$departureDateindo;?></text>
                                    <br/>
                                    <text style="font-size: 14px;"> <?php echo $jampergipergi;?> - <?php echo $jamtibapergi;?></text>
                                </td>
                                <td class="no-borders" style="vertical-align: middle; padding-bottom: 30px;">

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

                                            $txbbookingcodeperginame = 'bookingcodepergi'.$a;
                                            $txbtransittimeperginame = 'transittimepergi'.$a;
                                            $txbflightcodetransitperginame = 'flightcodepergi'.$a;
                                            $txbflightnametransitperginame = 'flightnamepergi'.$a;
                                            $txbflighticontransitperginame = 'flighticonpergi'.$a;
                                            $txbflightclasstransitperginame = 'flightclasspergi'.$a;
                                            $txbdeparttimetransitperginame = 'departtimepergi'.$a;
                                            $txbarrivaltimetransitperginame = 'arrivaltimepergi'.$a;
                                            $txbtransitname1perginame = 'transitname1pergi'.$a;
                                            $txbtransitname2perginame = 'transitname2pergi'.$a;

                                            $bookingcodepergi = $this->input->post($txbbookingcodeperginame,true);
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

                                            $txbbagasiperginame = 'bagasipergi'.$a;
                                            $bagasitransitpergi = $this->input->post($txbbagasiperginame,true);


                                            ?>
                                            <tr class="no-borders" style="background-color: #F4F4F5;">
                                                <td class="no-borders">
                                                    <img class="img-md" src="<?php echo $flighticontransitpergi;?>">
                                                    <br/>
                                                    <text style="font-size: 12px;"> <?php echo $bookingcodepergi ?></text>
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
                                                    <input type="hidden" name="<?php echo $txbbagasiperginame;?>" value="<?php echo $bagasitransitpergi;?>">
                                                    <i class="fa fa-suitcase"></i><text style="font-size: 10px;"> Bagasi <?php echo $bagasitransitpergi;?> Kg</text>
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                        ?>

                                    </table>

                                </td>
                            </tr>

                            <!-- table pulang-->
                            <?php
                            if($pulangpergi=='on'){

                                ?>

                                <tr class="no-borders">
                                    <td class="no-borders" style="vertical-align: middle; padding-bottom: 30px;">
                                        <text style="font-size: 16px;"> <?php echo $bookingcodepulang0 ?></text>
                                    </td>
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

                                                $txbbookingcodepulangname = 'bookingcodepulang'.$a;
                                                $txbtransittimepulangname = 'transittimepulang'.$a;
                                                $txbflightcodetransitpulangname = 'flightcodepulang'.$a;
                                                $txbflightnametransitpulangname = 'flightnamepulang'.$a;
                                                $txbflighticontransitpulangname = 'flighticonpulang'.$a;
                                                $txbflightclasstransitpulangname = 'flightclasspulang'.$a;
                                                $txbdeparttimetransitpulangname = 'departtimepulang'.$a;
                                                $txbarrivaltimetransitpulangname = 'arrivaltimepulang'.$a;
                                                $txbtransitname1pulangname = 'transitname1pulang'.$a;
                                                $txbtransitname2pulangname = 'transitname2pulang'.$a;

                                                $bookingcodepulang = $this->input->post($txbbookingcodepulangname,true);
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

                                                $txbbagasipulangname = 'bagasipulang'.$a;
                                                $bagasitransitpulang = $this->input->post($txbbagasipulangname,true);

                                                ?>
                                                <tr class="no-borders" style="background-color: #F4F4F5;">
                                                    <td class="no-borders">
                                                        <img class="img-md" src="<?php echo $flighticontransitpulang;?>">
                                                        <br/>
                                                        <text style="font-size: 12px;"> <?php echo $bookingcodepulang ?></text>
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
                                                        <input type="hidden" name="<?php echo $txbbagasipulangname;?>" value="<?php echo $bagasitransitpulang;?>">
                                                        <i class="fa fa-suitcase"></i><text style="font-size: 10px;"> Bagasi <?php echo $bagasitransitpulang;?> Kg</text>
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

                    <text style="font-size: 16px;"> Transaction ID: <span style="font-weight: bold"><?php echo $trans_id ?></span></text>
                    <hr style="margin-top:10px;"/>

                    <?php
                    if($pulangpergi == 'on'){
                        ?>

                        <div class="row bg-info" style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 10px;">
                            <div class="col-lg-12" style="padding-top: 0px; padding-bottom: 0px;">
                                Perjalanan Pergi
                            </div>
                        </div>

                        <?php
                    }

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

                        $txbflightfareperginame = 'flightfarepergi'.$b;
                        $txbflightadminperginame = 'flightbiayaadminpergi'.$b;
                        $harga = $this->input->post($txbflightfareperginame,true);
                        $customadmin = $this->input->post($txbflightadminperginame,true);

                        $hargaindo = rupiah($harga);
                        $customadminindo = rupiah($customadmin);

                        $totalharga = $harga + $customadmin;

                        $totalhargaindo = rupiah($totalharga);

                        $totalbayar = $totalbayar + $totalharga;

                        ?>
                        <div class="row">
                            <div class="col-lg-8">
                                <text style="font-size: 16px;"> <?php echo $flightnametransitpergi ?> (<?php echo $transitName1pergi;?> <i class="fa fa-arrow-right"></i> <?php echo $transitName2pergi;?>)</text><br/>
                            </div>
                            <div class="col-lg-4 text-right">
                                <text style="font-size: 14px;"> <?php echo $totalhargaindo;?></text>
                                <a data-toggle="collapse" data-target=".<?php echo $class;?>">
                                    <i class="fa fa-caret-down"></i>
                                </a>
                            </div>
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

                    $totalbayarindo = rupiah($totalbayar);
                    ?>

                    <?php
                    if($pulangpergi == 'on'){
                        ?>

                        <div class="row bg-info" style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 20px;">
                            <div class="col-lg-12" style="padding-top: 0px; padding-bottom: 0px;">
                                Perjalanan Pulang
                            </div>
                        </div>

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

                            $txbflightfarepulangname = 'flightfarepulang'.$b;
                            $txbflightadminpulangname = 'flightbiayaadminpulang'.$b;
                            $harga = $this->input->post($txbflightfarepulangname,true);
                            $customadmin = $this->input->post($txbflightadminpulangname,true);

                            $hargaindo = rupiah($harga);
                            $customadminindo = rupiah($customadmin);

                            $totalharga = $harga + $customadmin;

                            $totalhargaindo = rupiah($totalharga);

                            $totalbayar = $totalbayar + $totalharga;

                            ?>
                            <div class="row">
                                <div class="col-lg-8">
                                    <text style="font-size: 16px;"> <?php echo $flightnametransitpulang ?> (<?php echo $transitName1pulang;?> <i class="fa fa-arrow-right"></i> <?php echo $transitName2pulang;?>)</text><br/>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <text style="font-size: 14px;"> <?php echo $totalhargaindo;?></text>
                                    <a data-toggle="collapse" data-target=".<?php echo $class;?>">
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                </div>
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
        <div class="col-lg-6 col-lg-offset-2 col-xs-8">

            <div class="ibox">

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

                <div class="ibox-content" style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">

                    <?php
                    $no = 1;
                    for ($d = 1; $d <= $adult; $d++) {

                        $txbtiteldewasa = 'txbtiteldewasa'.$d;
                        $txbnamadepandewasa = 'txbnamadepandewasa'.$d;
                        $txbnamabelakangdewasa = 'txbnamabelakangdewasa'.$d;
                        $txbnoidentitydewasa = 'txbnoidentitydewasa'.$d;

                        $titel = $this->input->post($txbtiteldewasa,true);
                        $namadepan = $this->input->post($txbnamadepandewasa,true);
                        $namabelakang = $this->input->post($txbnamabelakangdewasa,true);
                        $noidentity = $this->input->post($txbnoidentitydewasa,true);

                        $namapenumpang = $titel.'. '.$namadepan.' '.$namabelakang;

                        ?>

                        <div class="row">
                            <div class="col-xs-1 text-center">
                                <text style="font-size: 14px; font-weight: bold;"><?php echo $no++;?>.</text>
                            </div>
                            <div class="col-xs-5">
                                <text style="font-size: 14px;"> <?php echo $namapenumpang;?></text>
                            </div>
                            <div class="col-xs-3">
                                <text style="font-size: 14px;"> <?php echo $noidentity;?></text>
                            </div>
                            <div class="col-xs-3">
                                <text style="font-size: 14px;"> Dewasa</text>
                            </div>
                        </div>

                        <?php
                    }

                    if($child > 0) {

                        for ($e = 1; $e <= $child; $e++) {

                            $txbtitelanak = 'txbtitelanak' . $e;
                            $txbnamadepananak = 'txbnamadepananak' . $e;
                            $txbnamabelakanganak = 'txbnamabelakanganak' . $e;

                            $titel = $this->input->post($txbtitelanak, true);
                            $namadepan = $this->input->post($txbnamadepananak, true);
                            $namabelakang = $this->input->post($txbnamabelakanganak, true);

                            $namapenumpang = $titel . '. ' . $namadepan . ' ' . $namabelakang;

                            ?>

                            <div class="row">
                                <div class="col-xs-1 text-center">
                                    <text style="font-size: 14px; font-weight: bold;"><?php echo $no++; ?>.</text>
                                </div>
                                <div class="col-xs-5">
                                    <text style="font-size: 14px;"> <?php echo $namapenumpang; ?></text>
                                </div>
                                <div class="col-xs-3"></div>
                                <div class="col-xs-3">
                                    <text style="font-size: 14px;"> Anak-anak</text>
                                </div>
                            </div>

                            <?php
                        }

                    }

                    if($infant > 0) {

                        for ($f = 1; $f <= $infant; $f++) {

                            $txbtitelbayi = 'txbtitelbayi' . $f;
                            $txbnamadepanbayi = 'txbnamadepanbayi' . $f;
                            $txbnamabelakangbayi = 'txbnamabelakangbayi' . $f;

                            $titel = $this->input->post($txbtitelbayi, true);
                            $namadepan = $this->input->post($txbnamadepanbayi, true);
                            $namabelakang = $this->input->post($txbnamabelakangbayi, true);

                            $namapenumpang = $titel . '. ' . $namadepan . ' ' . $namabelakang;

                            ?>

                            <div class="row">
                                <div class="col-xs-1 text-center">
                                    <text style="font-size: 14px; font-weight: bold;"><?php echo $no++; ?>.</text>
                                </div>
                                <div class="col-xs-5">
                                    <text style="font-size: 14px;"> <?php echo $namapenumpang; ?></text>
                                </div>
                                <div class="col-xs-3"></div>
                                <div class="col-xs-3">
                                    <text style="font-size: 14px;"> Bayi</text>
                                </div>
                            </div>

                            <?php
                        }

                    }

                    ?>

                </div>

            </div>

        </div>
        <div class="col-lg-3 col-xs-4">

            <div class="ibox">

                <div class="ibox-title red-bg" style="padding-top: 20px; height: 60px;">
                    <h3 class="col-xs-10">
                        DATA KONTAK
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

                    <?php
                    $titelkontak = $this->input->post('txbtitelkontak',true);
                    $namakontak = $this->input->post('txbnamakontak',true);
                    $noteleponkontak = $this->input->post('txbnoteleponkontak',true);
                    $emailkontak= $this->input->post('txbemailkontak',true);
                    ?>

                    <div class="row">
                        <div class="col-xs-5 text-right">
                            <text style="font-size: 14px; font-weight: bold;">Nama Kontak :</text>
                        </div>
                        <div class="col-xs-7">
                            <text style="font-size: 14px;"> <?php echo $titelkontak.' '.$namakontak; ?></text>
                            <input type="hidden" name="txbtitelkontak" value="<?php echo $titelkontak;?>">
                            <input type="hidden" name="txbnamakontak" value="<?php echo $namakontak;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5 text-right">
                            <text style="font-size: 14px; font-weight: bold;">No Telp. Kontak :</text>
                        </div>
                        <div class="col-xs-7">
                            <text style="font-size: 14px;"> <?php echo $noteleponkontak; ?></text>
                            <input type="hidden" name="txbnoteleponkontak" value="<?php echo $noteleponkontak;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5 text-right">
                            <text style="font-size: 14px; font-weight: bold;">Email Kontak :</text>
                        </div>
                        <div class="col-xs-7">
                            <text style="font-size: 14px;"> <?php echo $emailkontak; ?></text>
                            <input type="hidden" name="txbemailkontak" value="<?php echo $emailkontak;?>">
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <div class="col-lg-1"></div>
    </div>

    <div class="row">
        <div class="col-lg-9 col-lg-offset-2 text-center">
            <a href="<?php echo base_url('pesawat') ?>">
                <button type="button" class="btn btn-danger" style="width: 80%;">Selesai </button>
            </a>
        </div>
    </div>

</div>

<!-- /content -->