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
            <li>
                <a href="#">Pesan Tiket Kereta Api</a>
            </li>
            <li class="active">
                <strong>Info Pembayaran</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->

<div class="wrapper wrapper-content animated fadeInRight article">

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">

            <h2>
                <i class="fa fa-train" style="font-size:1em;margin-right:10px;color: <?php echo $warna_lembaga; ?>"></i>
                <span style="color: <?php echo $warna_lembaga; ?>">Konfirmasi dan Pembayaran</span>
            </h2>

            <div class="ibox float-e-margins">

                <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">

                <form class="form-horizontal" id="formtranskereta" method="post">

                    <?php
                    $this->load->view('func_custom');

                    $nmstfrom = $this->input->post('txbnmstfrom');
                    $kdstfrom = $this->input->post('txbkdstfrom');
                    $nmstto = $this->input->post('txbnmstto');
                    $kdstto = $this->input->post('txbkdstto');
                    $jmldewasa = $this->input->post('txbjmldewasa');
                    $jmlbayi = $this->input->post('txbjmlbayi');

                    $trainnamepergi = $this->input->post('txbtrainnamepergi');
                    $trainnumberpergi = $this->input->post('txbtrainnumberpergi');
                    $tglpergi = $this->input->post('txbtanggalpergi');
                    $split = explode('/', $tglpergi);
                    $bulan = bulan($split[1]);
                    $tanggalpergi = $split[0] . ' ' . $bulan . ' ' . $split[2];
                    $tangpergi = $split[2] . '-' . $split[1] . '-' . $split[0];
                    $departuretimepergi = $this->input->post('txbdeparturetimepergi');
                    $arrivaltimepergi = $this->input->post('txbarrivaltimepergi');
                    $gradeprgi = $this->input->post('txbgradepergi');
                    if ($gradeprgi == 'E') {
                        $gradepergi = 'Eksekutif';
                    } else if ($gradeprgi == 'B') {
                        $gradepergi = 'Bisnis';
                    } else {
                        $gradepergi = 'Ekonomi';
                    }
                    $subclasspergi = $this->input->post('txbsubclasspergi');
                    $priceadultpergi = $this->input->post('txbpriceadultpergi');

                    $komisipergi = $this->input->post('txbkomisipergi');
                    $normalsalespergi = $this->input->post('txbnormalsalespergi');
                    $extrafeepergi = $this->input->post('txbextrafeepergi');
                    $biayaadminpergi = $this->input->post('txbnominaladminpergi');
                    $bookbalancepergi = $this->input->post('txbbookbalancepergi');
                    $discountpergi = $this->input->post('txbdiscountpergi');

                    $trainnamepulang = $this->input->post('txbtrainnamepulang');
                    $trainnumberpulang = $this->input->post('txbtrainnumberpulang');
                    $tglpulang = $this->input->post('txbtanggalpulang');

                    if ($trainnamepulang != '') {

                        $splitpulang = explode('/', $tglpulang);
                        $bulanpulang = bulan($splitpulang[1]);
                        $tanggalpulang = $splitpulang[0] . ' ' . $bulanpulang . ' ' . $splitpulang[2];
                        $tangpulang = $splitpulang[2] . '-' . $splitpulang[1] . '-' . $splitpulang[0];

                    }else{
                        $tangpulang = '';
                    }

                    $departuretimepulang = $this->input->post('txbdeparturetimepulang');
                    $arrivaltimepulang = $this->input->post('txbarrivaltimepulang');
                    $gradeplang = $this->input->post('txbgradepulang');
                    if ($gradeplang == 'E') {
                        $gradepulang = 'Eksekutif';
                    } else if ($gradeplang == 'B') {
                        $gradepulang = 'Bisnis';
                    } else {
                        $gradepulang = 'Ekonomi';
                    }
                    $subclasspulang = $this->input->post('txbsubclasspulang');
                    $priceadultpulang = $this->input->post('txbpriceadultpulang');

                    ?>

                    <div class="ibox-content" style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">

                        <?php
                        $level = $this->session->userdata('user_level');

                        if ($level == 0) {
                            $saldo = $datasaldo->saldo;
                        }else{
                            $saldo = $datasaldo[0]->saldo;
                        }
                        ?>

                        <input type="hidden" value="<?php echo $saldo ?>" name="txbsaldosekarang" id="txbsaldosekarang">

                        <div class="form-group">

                            <div class="col-lg-3">
                                <img alt="image" src="<?php echo base_url(); ?>assets/img/logo kereta api.png"
                                     style="height: 40px; width: 80px;"/>
                                <i class="fa fa-arrow-circle-right"
                                   style="font-size:2em; color: darkorange; margin-left: 20px;"></i>
                            </div>
                            <div class="col-lg-9">
                                <h3>
                                    <span style="color: <?php echo $warna_lembaga; ?>">PERJALANAN PERGI</span>
                                    - <span><?php echo $trainnamepergi; ?> (<?php echo $trainnumberpergi; ?>)</span>
                                    - <span><?php echo $tanggalpergi; ?></span>
                                </h3>
                            </div>

                        </div>

                        <div class="form-group" style="margin-bottom: 0px;">

                            <div class="table-responsive">

                                <table class="table table-bordered bg-warning text-center">
                                    <tbody>
                                    <tr>
                                        <td style="vertical-align: middle;"><h2><?php echo $kdstfrom; ?>
                                                > <?php echo $kdstto; ?></h2></td>
                                        <td style="vertical-align: middle;">
                                            <h2><?php echo $departuretimepergi; ?>
                                                - <?php echo $arrivaltimepergi; ?></h2></td>
                                        <td style="vertical-align: middle;">
                                            <h2><?php echo $gradepergi; ?></h2>
                                            <h3>Subclass <?php echo $subclasspergi; ?></h3>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <?php
                                            $subtotalpergi = $extrafeepergi + $biayaadminpergi + $bookbalancepergi;
                                            ?>
                                            <h2><?php echo rupiah($subtotalpergi); ?></h2>
                                            <h3>Subtotal</h3>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <div class="form-group" style="margin-top: 0px;">

                            <div class="table-responsive">
                                <table class="table no-borders" style="margin-bottom: 0px;">
                                    <tr class="no-borders">
                                        <td class="no-borders text-center" style="width: 5px;">
                                            <i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;"></i>
                                        </td>
                                        <td class="no-borders">
                                            <?php echo $nmstfrom; ?> (<?php echo $kdstfrom; ?>) <i class="fa fa-arrow-right" style="font-size: 1em;color:<?php echo $warna_lembaga; ?>"></i> <?php echo $nmstto; ?> (<?php echo $kdstto; ?>)
                                        </td>
                                    </tr>
                                    <tr class="no-borders">
                                        <td class="no-borders text-center" style="width: 5px;">
                                            <i class="fa fa-user" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;"></i>
                                        </td>
                                        <td class="no-borders">
                                            <?php echo $jmldewasa; ?> Dewasa x <?php echo rupiah($priceadultpergi).' = '.rupiah($normalsalespergi) ?><br/>
                                            <?php
                                            if ($jmlbayi > 0) {
                                                ?>
                                                <?php echo $jmlbayi; ?> Bayi x Rp 0
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr class="no-borders">
                                        <td class="no-borders text-center" style="width: 5px;">
                                            <i class="fa fa-desktop" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;"></i>
                                        </td>
                                        <td class="no-borders">
                                            Biaya Administrasi = <?php echo rupiah($biayaadminpergi)?>
                                        </td>
                                    </tr>
                                    <tr class="no-borders">
                                        <td class="no-borders text-center" style="width: 5px;">
                                            <i class="fa fa-dollar" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;"></i>
                                        </td>
                                        <td class="no-borders">
                                            Discount = <?php echo rupiah($discountpergi)?>
                                        </td>
                                    </tr>
                                    <?php if($extrafeepergi>0){ ?>
                                        <tr class="no-borders">
                                            <td class="no-borders text-center" style="width: 5px;">
                                                <i class="fa fa-plus" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;"></i>
                                            </td>
                                            <td class="no-borders">
                                                Biaya Tambahan = <?php echo rupiah($extrafeepergi)?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>

                        </div>

                        <hr style="border: solid 1px <?php echo $warna_lembaga; ?>"/>

                        <?php
                        if ($trainnamepulang != '') {

                            $komisipulang = $this->input->post('txbkomisipulang');
                            $normalsalespulang = $this->input->post('txbnormalsalespulang');
                            $extrafeepulang = $this->input->post('txbextrafeepulang');
                            $biayaadminpulang = $this->input->post('txbnominaladminpulang');
                            $bookbalancepulang = $this->input->post('txbbookbalancepulang');
                            $discountpulang = $this->input->post('txbdiscountpulang');

                            ?>

                            <div class="form-group">

                                <div class="col-lg-3">
                                    <img alt="image"
                                         src="<?php echo base_url(); ?>assets/img/logo kereta api.png"
                                         style="height: 40px; width: 80px;"/>
                                    <i class="fa fa-arrow-circle-left"
                                       style="font-size:2em; color: darkorange; margin-left: 20px;"></i>
                                </div>
                                <div class="col-lg-9">
                                    <h3>
                                        <span style="color: <?php echo $warna_lembaga; ?>">PERJALANAN PULANG</span>
                                        - <span><?php echo $trainnamepulang; ?>
                                            (<?php echo $trainnumberpulang; ?>)</span>
                                        - <span><?php echo $tanggalpulang; ?></span>
                                    </h3>
                                </div>

                            </div>

                            <div class="form-group" style="margin-bottom: 0px;">

                                <div class="table-responsive">

                                    <table class="table table-bordered bg-warning text-center">
                                        <tbody>
                                        <tr>
                                            <td style="vertical-align: middle;"><h2><?php echo $kdstto; ?>
                                                    > <?php echo $kdstfrom; ?></h2></td>
                                            <td style="vertical-align: middle;">
                                                <h2><?php echo $departuretimepulang; ?>
                                                    - <?php echo $arrivaltimepulang; ?></h2></td>
                                            <td style="vertical-align: middle;">
                                                <h2><?php echo $gradepulang; ?></h2>
                                                <h3>Subclass <?php echo $subclasspulang; ?></h3>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <?php
                                                $subtotalpulang = $extrafeepulang + $biayaadminpulang +$bookbalancepulang;
                                                ?>
                                                <h2><?php echo rupiah($subtotalpulang); ?></h2>
                                                <h3>Subtotal</h3>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                            <div class="form-group" style="margin-top: 0px;">

                                <div class="table-responsive">
                                    <table class="table no-borders">
                                        <tr class="no-borders">
                                            <td class="no-borders text-center" style="width: 5px;">
                                                <i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;"></i>
                                            </td>
                                            <td class="no-borders">
                                                <?php echo $nmstto; ?> (<?php echo $kdstto; ?>) <i class="fa fa-arrow-right" style="font-size: 1em;color:<?php echo $warna_lembaga; ?>"></i> <?php echo $nmstfrom; ?> (<?php echo $kdstfrom; ?>)
                                            </td>
                                        </tr>
                                        <tr class="no-borders">
                                            <td class="no-borders text-center" style="width: 5px;">
                                                <i class="fa fa-user" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;"></i>
                                            </td>
                                            <td class="no-borders">
                                                <?php echo $jmldewasa; ?> Dewasa x <?php echo rupiah($priceadultpulang).' = '.rupiah($normalsalespulang) ?><br/>
                                                <?php
                                                if ($jmlbayi > 0) {
                                                    ?>
                                                    <?php echo $jmlbayi; ?> Bayi x Rp 0
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr class="no-borders">
                                            <td class="no-borders text-center" style="width: 5px;">
                                                <i class="fa fa-desktop" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;"></i>
                                            </td>
                                            <td class="no-borders">
                                                Biaya Administrasi = <?php echo rupiah($biayaadminpulang)?>
                                            </td>
                                        </tr>
                                        <tr class="no-borders">
                                            <td class="no-borders text-center" style="width: 5px;">
                                                <i class="fa fa-dollar" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;"></i>
                                            </td>
                                            <td class="no-borders">
                                                Discount = <?php echo rupiah($discountpulang)?>
                                            </td>
                                        </tr>
                                        <?php if($extrafeepulang>0){ ?>
                                            <tr class="no-borders">
                                                <td class="no-borders text-center" style="width: 5px;">
                                                    <i class="fa fa-plus" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;"></i>
                                                </td>
                                                <td class="no-borders">
                                                    Biaya Tambahan = <?php echo rupiah($extrafeepulang)?>
                                                </td>
                                            </tr>

                                        <?php } ?>
                                    </table>
                                </div>

                            </div>

                            <?php
                        }
                        ?>

                        <div class="form-group">

                            <div class="table-responsive">

                                <table class="table table-bordered text-center"
                                       style="background-color: darkred; margin-bottom: 0px;">
                                    <tbody>
                                    <tr>
                                        <td style="vertical-align: middle;"><h2 style="color: white">TOTAL</h2>
                                        </td>
                                        <?php
                                        if ($trainnamepulang != '') {
                                            $subtotaldatang = $subtotalpulang;
                                        } else {
                                            $subtotaldatang = 0;
                                        }

                                        $total = $subtotalpergi + $subtotaldatang;
                                        ?>
                                        <input type="hidden" name="txbtotalharga" id="txbtotalharga" value="<?php echo $total?>">
                                        <td style="vertical-align: middle;"><h2 style="color: white"><?php echo rupiah($total); ?></h2></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>

                    <div class="ibox-content red-bg" style="padding: 10px;">

                        <h3>KODE PEMESANAN</h3>

                    </div>

                    <div class="ibox-content" style="padding: 10px;">

                        <div class="form-group text-center" style="margin-bottom: 0px;">
                            <div class="col-lg-3 col-xs-3">
                                <label class="control-label" style="margin-bottom: 10px;">Tipe Perjalanan </label>
                            </div>
                            <div class="col-lg-3 col-xs-3">
                                <label class="control-label" style="margin-bottom: 10px;">Kode Booking </label>
                            </div>
                            <div class="col-lg-3 col-xs-3">
                                <label class="control-label" style="margin-bottom: 10px;">Kode Pembayaran </label>
                            </div>
                            <div class="col-lg-3 col-xs-3">
                                <label class="control-label" style="margin-bottom: 10px;">Batas Waktu Pembayaran</label>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 0px;">
                            <?php

                            if(count($datachangeseatpergi) > 0){

                                if($datachangeseatpergi->rc == '00'){
                                    $idtransaction = $datachangeseatpergi->transactionId;
                                }else{
                                    $idtransaction = $this->input->post('txbtransactionidbookingpergi');
                                }

                            }else{
                                $idtransaction = $this->input->post('txbtransactionidbookingpergi');
                            }

                            $txbtimelimit = $this->input->post('txbtimelimitpergi');
                            $splittimelimit = explode(' ', $txbtimelimit);
                            $tgltimelimit = $splittimelimit[0];
                            $waktutimelimit = $splittimelimit[1];
                            $splittgltimelimit = explode('-', $tgltimelimit);
                            $bulantgltimelimit = bulan($splittgltimelimit[1]);
                            $tanggaltimelimit = $splittgltimelimit[2] . ' ' . $bulantgltimelimit . ' ' . $splittgltimelimit[0];
                            $timelimit = $tanggaltimelimit.' '.$waktutimelimit;
                            $bookingcodepergi = $this->input->post('txbcodebookingpergi');
                            ?>
                            <div class="col-lg-3 col-xs-3">
                                <input type="text"
                                       class="form-control text-center"
                                       value="Pergi"
                                       style="border: none; background-color: transparent;"
                                       readonly>
                            </div>
                            <div class="col-lg-3 col-xs-3">
                                <input type="text"
                                       name="txbbookingcodepergi"
                                       class="form-control text-center"
                                       style="border: none; background-color: transparent;"
                                       value="<?php echo $bookingcodepergi;?>"
                                       readonly>
                            </div>
                            <div class="col-lg-3 col-xs-3">
                                <input type="text"
                                       name="txbidtransactionpergi"
                                       class="form-control text-center"
                                       value="<?php echo $idtransaction;?>"
                                       style="border: none; background-color: transparent;"
                                       readonly>
                            </div>
                            <div class="col-lg-3 col-xs-3">
                                <input type="text"
                                       name="txbtimelimitpergi"
                                       class="form-control text-center"
                                       value="<?php echo $timelimit; ?>"
                                       style="border: none; background-color: transparent; color: red;"
                                       readonly>
                                <input type="hidden" id="txbkomisipergi" name="txbkomisipergi" value="<?php echo $komisipergi ?>">
                                <input type="hidden" id="txbnormalsalespergi" name="txbnormalsalespergi" value="<?php echo $normalsalespergi ?>">
                                <input type="hidden" id="txbextrafeepergi" name="txbextrafeepergi" value="<?php echo $extrafeepergi?>">
                                <input type="hidden" id="txbnominaladminpergi" name="txbnominaladminpergi" value="<?php echo $biayaadminpergi?>">
                                <input type="hidden" id="txbbookbalancepergi" name="txbbookbalancepergi" value="<?php echo $bookbalancepergi?>">
                                <input type="hidden" id="txbdiscountpergi" name="txbdiscountpergi" value="<?php echo $discountpergi?>">

                            </div>
                        </div>

                        <?php
                        if ($trainnamepulang != '') {

                            if(count($datachangeseatpulang) > 0){

                                if($datachangeseatpulang->rc == '00'){
                                    $idtransactionpulang = $datachangeseatpulang->transactionId;
                                }else{
                                    $idtransactionpulang = $this->input->post('txbtransactionidbookingpulang');
                                }

                            }else{
                                $idtransactionpulang = $this->input->post('txbtransactionidbookingpulang');
                            }

                            $txbtimelimitpulang = $this->input->post('txbtimelimitpulang');
                            $splittimelimitpulang = explode(' ', $txbtimelimitpulang);
                            $tgltimelimitpulang = $splittimelimitpulang[0];
                            $waktutimelimitpulang = $splittimelimitpulang[1];
                            $splittgltimelimitpulang = explode('-', $tgltimelimitpulang);
                            $bulantgltimelimitpulang = bulan($splittgltimelimitpulang[1]);
                            $tanggaltimelimitpulang = $splittgltimelimitpulang[2] . ' ' . $bulantgltimelimitpulang . ' ' . $splittgltimelimitpulang[0];
                            $timelimitpulang = $tanggaltimelimitpulang.' '.$waktutimelimitpulang;
                            $bookingcodepulang = $this->input->post('txbcodebookingpulang');

                            ?>

                                <div class="form-group" style="margin-bottom: 0px;">

                                    <div class="col-lg-3 col-xs-3">
                                        <input type="text"
                                               class="form-control text-center"
                                               value="Pulang"
                                               style="border: none; background-color: transparent;"
                                               readonly>
                                    </div>
                                    <div class="col-lg-3 col-xs-3">
                                        <input type="text"
                                               name="txbbookingcodepulang"
                                               class="form-control text-center"
                                               value="<?php echo $bookingcodepulang;?>"
                                               style="border: none; background-color: transparent;"
                                               readonly>
                                    </div>
                                    <div class="col-lg-3 col-xs-3">
                                        <input type="text"
                                               name="txbidtransactionpulang"
                                               class="form-control text-center"
                                               value="<?php echo $idtransactionpulang;?>"
                                               style="border: none; background-color: transparent;"
                                               readonly>
                                    </div>
                                    <div class="col-lg-3 col-xs-3">
                                        <input type="text"
                                               name="txbtimelimitpulang"
                                               class="form-control text-center"
                                               value="<?php echo $timelimitpulang; ?>"
                                               style="border: none; background-color: transparent; color: red;"
                                               readonly>
                                        <input type="hidden" id="txbkomisipulang" name="txbkomisipulang" value="<?php echo $komisipulang?>">
                                        <input type="hidden" id="txbnormalsalespulang" name="txbnormalsalespulang" value="<?php echo $normalsalespulang?>">
                                        <input type="hidden" id="txbextrafeepulang" name="txbextrafeepulang" value="<?php echo $extrafeepulang?>">
                                        <input type="hidden" id="txbnominaladminpulang" name="txbnominaladminpulang" value="<?php echo $biayaadminpulang?>">
                                        <input type="hidden" id="txbbookbalancepulang" name="txbbookbalancepulang" value="<?php echo $bookbalancepulang?>">
                                        <input type="hidden" id="txbdiscountpulang" name="txbdiscountpulang" value="<?php echo $discountpulang?>">
                                    </div>

                                </div>

                            <?php
                        }
                        ?>

                    </div>

                    <div class="ibox-content red-bg" style="padding: 10px;">

                        <h3>INFO DATA PENUMPANG</h3>

                    </div>

                    <div class="ibox-content" style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">

                        <h3>PERJALANAN PERGI</h3>
                        <hr/>

                        <?php
                            if (count($datachangeseatpergi)>0 && $datachangeseatpergi->rc != '00') {
                                ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×
                                    </button>
                                    Warning API : <?php echo $datachangeseatpergi->rd ?>, Sehingga anda tidak bisa
                                    pindah tempat duduk dan kembali ke tempat duduk asal.
                                </div>
                                <?php
                            }
                        ?>

                        <div class="form-group text-center" style="margin-bottom: 0px;">

                            <div class="col-lg-5 col-xs-5">
                                <label class="control-label" style="margin-bottom: 10px;">Nama
                                    Penumpang </label>
                            </div>
                            <div class="col-lg-3 col-xs-3">
                                <label class="control-label" style="margin-bottom: 10px;">No Identitas</label>
                            </div>
                            <div class="col-lg-4 col-xs-4">
                                <label class="control-label" style="margin-bottom: 10px;">No Kursi</label>
                            </div>

                        </div>

                        <div class="form-group" style="margin-bottom: 20px;">

                            <?php 

                            for ($x = 0; $x < $jmldewasa; $x++) { 

                                $a = $x+1;

                                $txbnamadewasa = 'txbnamadewasa'.$a;
                                $txbiddewasa = 'txbiddewasa'.$a;
                                $txbtgllahirdewasa = 'txbtgllahirdewasa'.$a;
                                $txbnotelpdewasa = 'txbnotelpdewasa'.$a;
                                $txbnoseatasalpenumpangpergi = 'txbnoseatasalpenumpangpergi'.$a;
                                $txbnoseatbarupenumpangpergi = 'txbnoseatbarupenumpangpergi'.$a;

                                $namapenumpang = $this->input->post($txbnamadewasa);
                                $idpenumpang = $this->input->post($txbiddewasa);
                                $tgllahirpenumpang = $this->input->post($txbtgllahirdewasa);
                                $notelppenumpang = $this->input->post($txbnotelpdewasa);
                                $noseatasalpenumpangpergi = $this->input->post($txbnoseatasalpenumpangpergi);
                                $noseatbarupenumpangpergi = $this->input->post($txbnoseatbarupenumpangpergi);

                                if($noseatbarupenumpangpergi == '-'){
                                    $noseatpenumpang = $noseatasalpenumpangpergi;
                                }else{

                                    if($datachangeseatpergi->rc == '00'){

                                        $txbwagoncodepenumpangpergi = 'txbwagoncodepenumpangpergi'.$a;
                                        $txbwagonnumberpenumpangpergi = 'txbwagonnumberpenumpangpergi'.$a;

                                        $wagoncodepenumpangpergi = $this->input->post($txbwagoncodepenumpangpergi);
                                        $wagonnumberpenumpangpergi = $this->input->post($txbwagonnumberpenumpangpergi);
                                        $wagonrowpenumpangpergi = $datachangeseatpergi->seats[$x]->row;
                                        $wagoncolpenumpangpergi = $datachangeseatpergi->seats[$x]->column;

                                        $noseatpenumpang = $wagoncodepenumpangpergi . '-' . $wagonnumberpenumpangpergi . ', ' . $wagonrowpenumpangpergi . '' . $wagoncolpenumpangpergi;
                                    }else{

                                        $noseatpenumpang = $noseatasalpenumpangpergi;
                                    }


                                }

                                ?>

                                <div class="col-lg-5 col-xs-5">
                                    <input type="text" 
                                           class="form-control text-center"
                                           name="txbnamadewasa<?php echo $a?>"
                                           value="<?php echo $namapenumpang;?>" 
                                           style="border: none; background-color: transparent;" 
                                           readonly>
                                </div>
                                <div class="col-lg-3 col-xs-3">
                                    <input type="text" 
                                           class="form-control text-center"
                                           name="txbiddewasa<?php echo $a?>"
                                           value="<?php echo $idpenumpang;?>" 
                                           style="border: none; background-color: transparent;" 
                                           readonly>
                                    <input type="hidden"
                                           class="form-control text-center"
                                           name="txbtgllahirdewasa<?php echo $a?>"
                                           value="<?php echo $tgllahirpenumpang;?>"
                                           style="border: none; background-color: transparent;"
                                           readonly>
                                    <input type="hidden"
                                           class="form-control text-center"
                                           name="txbnotelpdewasa<?php echo $a?>"
                                           value="<?php echo $notelppenumpang;?>"
                                           style="border: none; background-color: transparent;"
                                           readonly>
                                </div>

                                <div class="col-lg-4 col-xs-4">
                                    <input type="text" id="txbnoseatpenumpangpergi<?php echo $a?>" name="txbnoseatpenumpangpergi<?php echo $a?>" class="form-control text-center" style="border: none; background-color: transparent;" value="<?php echo $noseatpenumpang ?>" readonly>
                                </div>

                            <?php 
                            } 

                            if ($jmlbayi > 0) {

                                for ($y = 1; $y <= $jmlbayi; $y++) {

                                    $txbnamabayi = 'txbnamabayi'.$y;
                                    $txbtgllahirbayi = 'txbtgllahirbayi'.$y;

                                    $namabayi = $this->input->post($txbnamabayi);
                                    $tgllahirbayi = $this->input->post($txbtgllahirbayi);

                            ?>

                                <div class="col-lg-5 col-xs-5">
                                    <input type="text" 
                                           class="form-control text-center"
                                           name="txbnamabayi<?php echo $y?>"
                                           value="<?php echo $namabayi;?>" 
                                           style="border: none; background-color: transparent;" 
                                           readonly>
                                    <input type="hidden" 
                                           class="form-control text-center"
                                           name="txbtgllahirbayi<?php echo $y?>"
                                           value="<?php echo $tgllahirbayi;?>" 
                                           style="border: none; background-color: transparent;" 
                                           readonly>
                                </div>
                                <div class="col-lg-3 col-xs-3">
                                    <input type="text" 
                                           class="form-control text-center"
                                           value="-" 
                                           style="border: none; background-color: transparent;" 
                                           readonly>
                                </div>
                                <div class="col-lg-4 col-xs-4">
                                    <input type="text" class="form-control text-center" style="border: none; background-color: transparent;" value="-" readonly>
                                </div>

                            <?php

                                }

                            }

                            ?>

                        </div>

                    </div>

                    <?php
                    if ($trainnamepulang != '') {

                        ?>
    
                        <div class="ibox-content" style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">
    
                            <h3>PERJALANAN PULANG</h3>
                            
                        </div>

                        <?php
                            if (count($datachangeseatpulang)>0 && $datachangeseatpulang->rc != '00') {
                                ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×
                                    </button>
                                    Warning API : <?php echo $datachangeseatpergi->rd ?>, Sehingga anda tidak bisa
                                    pindah tempat duduk dan kembali ke tempat duduk asal.
                                </div>
                                <?php
                            }
                        ?>

                        <div class="ibox-content" style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">
                            <div class="form-group text-center" style="margin-bottom: 0px;">

                                <div class="col-lg-5 col-xs-5">
                                    <label class="control-label" style="margin-bottom: 10px;">Nama
                                        Penumpang </label>
                                </div>
                                <div class="col-lg-3 col-xs-3">
                                    <label class="control-label" style="margin-bottom: 10px;">No Identitas</label>
                                </div>
                                <div class="col-lg-4 col-xs-4">
                                    <label class="control-label" style="margin-bottom: 10px;">No Kursi</label>
                                </div>

                            </div>

                            <div class="form-group" style="margin-bottom: 20px;">

                                <?php

                                for ($x = 0; $x < $jmldewasa; $x++) {

                                    $a = $x+1;

                                    $txbnamadewasa = 'txbnamadewasa'.$a;
                                    $txbiddewasa = 'txbiddewasa'.$a;
                                    $txbnoseatasalpenumpangpulang = 'txbnoseatasalpenumpangpulang'.$a;
                                    $txbnoseatbarupenumpangpulang = 'txbnoseatbarupenumpangpulang'.$a;

                                    $namapenumpang = $this->input->post($txbnamadewasa);
                                    $idpenumpang = $this->input->post($txbiddewasa);
                                    $noseatasalpenumpangpulang = $this->input->post($txbnoseatasalpenumpangpulang);
                                    $noseatbarupenumpangpulang = $this->input->post($txbnoseatbarupenumpangpulang);

                                    if($noseatbarupenumpangpulang == '-'){
                                        $noseatpenumpang = $noseatasalpenumpangpulang;
                                    }else{

                                        if($datachangeseatpulang->rc == '00'){

                                            $txbwagoncodepenumpangpulang = 'txbwagoncodepenumpangpulang'.$a;
                                            $txbwagonnumberpenumpangpulang = 'txbwagonnumberpenumpangpulang'.$a;

                                            $wagoncodepenumpangpulang = $this->input->post($txbwagoncodepenumpangpulang);
                                            $wagonnumberpenumpangpulang = $this->input->post($txbwagonnumberpenumpangpulang);
                                            $wagonrowpenumpangpulang = $datachangeseatpulang->seats[$x]->row;
                                            $wagoncolpenumpangpulang = $datachangeseatpulang->seats[$x]->column;

                                            $noseatpenumpang = $wagoncodepenumpangpulang . '-' . $wagonnumberpenumpangpulang . ', ' . $wagonrowpenumpangpulang . '' . $wagoncolpenumpangpulang;

                                        }else{
                                            $noseatpenumpang = $noseatasalpenumpangpulang;
                                        }

                                    }

                                    ?>

                                    <div class="col-lg-5 col-xs-5">
                                        <input type="text"
                                               class="form-control text-center"
                                               name="txbnamadewasa<?php echo $a?>"
                                               value="<?php echo $namapenumpang;?>"
                                               style="border: none; background-color: transparent;"
                                               readonly>
                                    </div>
                                    <div class="col-lg-3 col-xs-3">
                                        <input type="text"
                                               class="form-control text-center"
                                               name="txbiddewasa<?php echo $a?>"
                                               value="<?php echo $idpenumpang;?>"
                                               style="border: none; background-color: transparent;"
                                               readonly>
                                    </div>

                                    <div class="col-lg-4 col-xs-4">
                                        <input type="text" id="txbnoseatpenumpangpulang<?php echo $a?>" name="txbnoseatpenumpangpulang<?php echo $a?>" class="form-control text-center" style="border: none; background-color: transparent;" value="<?php echo $noseatpenumpang ?>" readonly>
                                    </div>

                                    <?php
                                }

                                if ($jmlbayi > 0) {

                                    for ($y = 1; $y <= $jmlbayi; $y++) {

                                        $txbnamabayi = 'txbnamabayi'.$y;
                                        $txbtgllahirbayi = 'txbtgllahirbayi'.$y;

                                        $namabayi = $this->input->post($txbnamabayi);
                                        $tgllahirbayi = $this->input->post($txbtgllahirbayi);

                                        ?>

                                        <div class="col-lg-5 col-xs-5">
                                            <input type="text"
                                                   class="form-control text-center"
                                                   value="<?php echo $namabayi;?>"
                                                   style="border: none; background-color: transparent;"
                                                   readonly>
                                            <input type="hidden"
                                                   class="form-control text-center"
                                                   value="<?php echo $tgllahirbayi;?>"
                                                   style="border: none; background-color: transparent;"
                                                   readonly>
                                        </div>
                                        <div class="col-lg-3 col-xs-3">
                                            <input type="text"
                                                   class="form-control text-center"
                                                   value="-"
                                                   style="border: none; background-color: transparent;"
                                                   readonly>
                                        </div>

                                        <div class="col-lg-4 col-xs-4">
                                            <input type="text" class="form-control text-center" style="border: none; background-color: transparent;" value="-" readonly>
                                        </div>

                                        <?php

                                    }

                                }

                                ?>

                            </div>
                        </div>

                        <?php
                    }
                    ?>

                    <div class="ibox-content red-bg" style="padding: 10px;">

                        <h3>INFO KONTAK YANG DAPAT DIHUBUNGI</h3>

                    </div>
                    <div class="ibox-content" style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">
                        <?php
                        $namakontak= $this->input->post('txbnamekontak');
                        $emailkontak = $this->input->post('txbemailkontak');
                        $notelpkontak = $this->input->post('txbnotelpkontak');
                        $alamatkontak = $this->input->post('txbalamatkontak');
                        ?>

                        <div class="form-group">
                            <div class="col-lg-2 col-xs-2">
                                <label style="margin-top: 10px;">Nama</label>
                            </div>
                            <div class="col-lg-1 col-xs-1">
                                <label style="margin-top: 10px;">:</label>
                            </div>
                            <div class="col-lg-9 col-xs-9">
                                <input type="text"
                                       class="form-control"
                                       name="txbnamekontak"
                                       value="<?php echo $namakontak?>"
                                       style="border: none; background-color: transparent;"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-2 col-xs-2">
                                <label style="margin-top: 10px;">Email</label>
                            </div>
                            <div class="col-lg-1 col-xs-1">
                                <label style="margin-top: 10px;">:</label>
                            </div>
                            <div class="col-lg-9 col-xs-9">
                                <input type="text"
                                       class="form-control"
                                       name="txbemailkontak"
                                       value="<?php echo $emailkontak?>"
                                       style="border: none; background-color: transparent;"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-2 col-xs-2">
                                <label style="margin-top: 10px;">No Telepon</label>
                            </div>
                            <div class="col-lg-1 col-xs-1">
                                <label style="margin-top: 10px;">:</label>
                            </div>
                            <div class="col-lg-9 col-xs-9">
                                <input type="text"
                                       class="form-control"
                                       name="txbnotelpkontak"
                                       value="<?php echo $notelpkontak?>"
                                       style="border: none; background-color: transparent;"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-2 col-xs-2">
                                <label style="margin-top: 10px;">Alamat</label>
                            </div>
                            <div class="col-lg-1 col-xs-1">
                                <label style="margin-top: 10px;">:</label>
                            </div>
                            <div class="col-lg-9 col-xs-9">
                                <input type="text"
                                       class="form-control"
                                       name="txbalamatkontak"
                                       value="<?php echo $alamatkontak?>"
                                       style="border: none; background-color: transparent;"
                                       readonly>
                            </div>
                        </div>

                        <!-- Input data perjalanan serta harga -->

                        <?php
                        if($trainnamepulang != ''){
                            $cekpp = 1;
                        }else{
                            $cekpp = 0;
                        }

                        ?>

                        <input type="hidden" id="txbcekpp" name="txbcekpp" value="<?php echo $cekpp ?>">

                        <input type="hidden" id="txbnmstfrom" name="txbnmstfrom" value="<?php echo $nmstfrom ?>">
                        <input type="hidden" id="txbkdstfrom" name="txbkdstfrom" value="<?php echo $kdstfrom ?>">
                        <input type="hidden" id="txbnmstto" name="txbnmstto" value="<?php echo $nmstto ?>">
                        <input type="hidden" id="txbkdstto" name="txbkdstto" value="<?php echo $kdstto ?>">
                        <input type="hidden" id="txbjmlbayi" name="txbjmlbayi" value="<?php echo $jmlbayi ?>">
                        <input type="hidden" id="txbjmldewasa" name="txbjmldewasa" value="<?php echo $jmldewasa ?>">

                        <input type="hidden" id="txbtrainnamepergi" name="txbtrainnamepergi" value="<?php echo $trainnamepergi ?>">
                        <input type="hidden" id="txbtrainnumberpergi" name="txbtrainnumberpergi" value="<?php echo $trainnumberpergi ?>">
                        <input type="hidden" id="txbtanggalpergi" name="txbtanggalpergi" value="<?php echo $tangpergi ?>">
                        <input type="hidden" id="txbdeparturetimepergi" name="txbdeparturetimepergi" value="<?php echo $departuretimepergi ?>">
                        <input type="hidden" id="txbarrivaltimepergi" name="txbarrivaltimepergi" value="<?php echo $arrivaltimepergi ?>">
                        <input type="hidden" id="txbgradepergi" name="txbgradepergi" value="<?php echo $gradeprgi ?>">
                        <input type="hidden" id="txbsubclasspergi" name="txbsubclasspergi" value="<?php echo $subclasspergi ?>">
                        <input type="hidden" id="txbpriceadultpergi" name="txbpriceadultpergi" value="<?php echo $priceadultpergi ?>">

                        <input type="hidden" id="txbtrainnamepulang" name="txbtrainnamepulang" value="<?php echo $trainnamepulang ?>">
                        <input type="hidden" id="txbtrainnumberpulang" name="txbtrainnumberpulang" value="<?php echo $trainnumberpulang ?>">
                        <input type="hidden" id="txbtanggalpulang" name="txbtanggalpulang" value="<?php echo $tangpulang ?>">
                        <input type="hidden" id="txbdeparturetimepulang" name="txbdeparturetimepulang" value="<?php echo $departuretimepulang ?>">
                        <input type="hidden" id="txbarrivaltimepulang" name="txbarrivaltimepulang" value="<?php echo $arrivaltimepulang ?>">
                        <input type="hidden" id="txbgradepulang" name="txbgradepulang" value="<?php echo $gradeplang ?>">
                        <input type="hidden" id="txbsubclasspulang" name="txbsubclasspulang" value="<?php echo $subclasspulang ?>">
                        <input type="hidden" id="txbpriceadultpulang" name="txbpriceadultpulang" value="<?php echo $priceadultpulang ?>">

                    </div>

                    <div class="ibox-footer" style="padding-top: 20px;">

                        <div class="row">
                            <div class="col-lg-3">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalCancel">CANCEL</button>
                            </div>
                            <div class="col-lg-6"></div>
                            <div class="col-lg-3 text-right">
                                <button type="button" class="btn btn-danger" onclick="submittranskereta()">SELESAI</button>
                            </div>
                        </div>

                    </div>


                </form>

                <div class="modal inmodal" id="modalCancel" tabindex="-1" role="dialog"  aria-hidden="true">
                    <form method="post" action="cancelbook" id="formcancelbooking">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <i class="fa fa-warning modal-icon"></i>
                                    <h4 class="modal-title">Cancel Book</h4>
                                    <small>Anda akan melakukan cancel booking tiket ?.</small>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="control-label">ALASAN ANDA <span style="color:#ed5565">*</span></label>
                                        <textarea rows="4" class="form-control" name="txacancel" required></textarea>
                                        <input type="hidden" name="txbcancelcodebookingpergi" value="<?php echo $bookingcodepergi?>">
                                        <input type="hidden" name="txbcanceltransactionidbookingpergi" value="<?php echo $idtransaction ?>">
                                        <input type="hidden" name="txbcanceltanggalpulang" value="<?php echo $tglpulang ?>">
                                        <?php
                                        if ($trainnamepulang != '') {
                                            ?>
                                            <input type="hidden" name="txbcancelcodebookingpulang" value="<?php echo $bookingcodepulang?>">
                                            <input type="hidden" name="txbcanceltransactionidbookingpulang" value="<?php echo $idtransactionpulang?>">
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">DO IT</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <div class="col-lg-3"></div>
    </div>

</div>

<!-- /content -->


</div>
