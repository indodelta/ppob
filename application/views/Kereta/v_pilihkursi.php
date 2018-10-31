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
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Pesan Tiket Kereta Api</a>
            </li>
            <li class="active">
                <strong>Info Penumpang dan Tempat Duduk</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->

<div class="wrapper wrapper-content animated fadeInRight article">

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">

            <h2>
                <i class="fa fa-train" style="font-size:1em;margin-right:10px;color: <?php echo $warna_lembaga; ?>"></i>
                <span style="color: <?php echo $warna_lembaga; ?>">Informasi Penumpang dan Tempat Duduk</span>
            </h2>

            <div class="ibox float-e-margins">

                <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">

                <?php
                if($bookingkereta->bookingpergi->rc != '00') {
                    ?>

                        <div class="ibox-content">

                            <div class="alert alert-warning">
                                Warning API : <?php echo $bookingkereta->bookingpergi->rd ?> <a class="alert-link" href="<?php echo base_url('kereta') ?>">Kembali Ke Pesan Tiket</a>.
                            </div>

                        </div>

                        <?php
                }
                else {
                ?>

                        <form class="form-horizontal" id="formpilihkursi" method="post">

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

                            $komisipergi = $bookingkereta->bookingpergi->data->komisi;
                            $normalsalespergi = $bookingkereta->bookingpergi->data->normalSales;
                            $extrafeepergi =  $bookingkereta->bookingpergi->data->extraFee;
                            $biayaadminpergi = $bookingkereta->bookingpergi->data->nominalAdmin;
                            $bookbalancepergi = $bookingkereta->bookingpergi->data->bookBalance;
                            $discountpergi = $bookingkereta->bookingpergi->data->discount;

                            $trainnamepulang = $this->input->post('txbtrainnamepulang');
                            $trainnumberpulang = $this->input->post('txbtrainnumberpulang');
                            $tglpulang = $this->input->post('txbtanggalpulang');

                            if ($trainnamepulang != '') {

                                $splitpulang = explode('/', $tglpulang);
                                $bulanpulang = bulan($splitpulang[1]);
                                $tanggalpulang = $splitpulang[0] . ' ' . $bulanpulang . ' ' . $splitpulang[2];

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

                            <div class="ibox-content"
                                 style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">

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

                                    $komisipulang = $bookingkereta->bookingpulang->data->komisi;
                                    $normalsalespulang = $bookingkereta->bookingpulang->data->normalSales;
                                    $extrafeepulang =  $bookingkereta->bookingpulang->data->extraFee;
                                    $biayaadminpulang = $bookingkereta->bookingpulang->data->nominalAdmin;
                                    $bookbalancepulang = $bookingkereta->bookingpulang->data->bookBalance;
                                    $discountpulang = $bookingkereta->bookingpulang->data->discount;

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
                                                        $subtotalpulang = $extrafeepulang + $biayaadminpulang + $bookbalancepulang;
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
                                                <td style="vertical-align: middle;"><h2
                                                            style="color: white"><?php echo rupiah($total); ?></h2></td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                            <div class="ibox-content red-bg" style="padding: 10px;">

                                <h3>DATA PENUMPANG DAN TEMPAT DUDUK</h3>

                            </div>

                            <div class="ibox-content" style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">

                                <h3>PERJALANAN PERGI</h3>
                                <hr/>

                                <div class="form-group">
                                    <input type="hidden" id="txbcodebookingpergi" name="txbcodebookingpergi" value="<?php echo $bookingkereta->bookingpergi->data->bookingCode ?>">
                                    <input type="hidden" id="txbtransactionidbookingpergi" name="txbtransactionidbookingpergi" value="<?php echo $bookingkereta->bookingpergi->data->transactionId ?>">
                                    <input type="hidden" id="txbkomisipergi" name="txbkomisipergi" value="<?php echo $komisipergi ?>">
                                    <input type="hidden" id="txbnormalsalespergi" name="txbnormalsalespergi" value="<?php echo $normalsalespergi ?>">
                                    <input type="hidden" id="txbextrafeepergi" name="txbextrafeepergi" value="<?php echo $extrafeepergi?>">
                                    <input type="hidden" id="txbnominaladminpergi" name="txbnominaladminpergi" value="<?php echo $biayaadminpergi?>">
                                    <input type="hidden" id="txbbookbalancepergi" name="txbbookbalancepergi" value="<?php echo $bookbalancepergi?>">
                                    <input type="hidden" id="txbdiscountpergi" name="txbdiscountpergi" value="<?php echo $discountpergi?>">
                                    <input type="hidden" id="txbtimelimitpergi" name="txbtimelimitpergi" value="<?php echo $bookingkereta->bookingpergi->data->timeLimit?>">
                                </div>

                                <div class="form-group text-center" style="margin-bottom: 0px;">

                                    <div class="col-lg-1 col-xs-1">
                                        <label class="control-label" style="margin-bottom: 10px;">Tipe</label>
                                    </div>
                                    <div class="col-lg-3 col-xs-3">
                                        <label class="control-label" style="margin-bottom: 10px;">Nama
                                            Penumpang </label>
                                    </div>
                                    <div class="col-lg-2 col-xs-2">
                                        <label class="control-label" style="margin-bottom: 10px;">No Identitas</label>
                                    </div>
                                    <div class="col-lg-3 col-xs-3">
                                        <label class="control-label" style="margin-bottom: 10px;">No Kursi</label>
                                    </div>
                                    <div class="col-lg-3 col-xs-3">
                                        <label class="control-label" style="margin-bottom: 10px;">No Kursi Baru</label>
                                    </div>

                                </div>

                                <?php

                                for ($x = 0; $x < $jmldewasa; $x++) {

                                    $a = $x+1;
                                    $txbnamedewasa = 'txbnamedewasa' . $a;
                                    $txbiddewasa = 'txbiddewasa' . $a;
                                    $txbtgllahirdewasa = 'txbtgllahirdewasa' . $a;
                                    $txbnotelpdewasa = 'txbnotelpdewasa' . $a;
                                    $namapenumpang = $this->input->post($txbnamedewasa);
                                    $idpenumpang = $this->input->post($txbiddewasa);
                                    $tgllahirpenumpang = $this->input->post($txbtgllahirdewasa);
                                    $splitpen = explode('/', $tgllahirpenumpang);
                                    $tgllahirpen = $splitpen[2] . '-' . $splitpen[1] . '-' . $splitpen[0];
                                    $notelppenumpang = $this->input->post($txbnotelpdewasa);

                                    $bookinggrade = $bookingkereta->bookingpergi->data->seats[$x][0];
                                    $bookingwagon = $bookingkereta->bookingpergi->data->seats[$x][1];
                                    $bookingrow = $bookingkereta->bookingpergi->data->seats[$x][2];
                                    $bookingcolumn = $bookingkereta->bookingpergi->data->seats[$x][3];

                                    $tempatdudukpenumpang = $bookinggrade . '-' . $bookingwagon . ', ' . $bookingrow . '' . $bookingcolumn;

                                    $wagoncode = $bookinggrade;
                                    $jumlahdatawagon = count($seatlayout->seatlayoutpergi->data);

                                    ?>


                                    <!-- Input data penumpang -->

                                    <div class="form-group" style="margin-bottom: 0px;">

                                        <div class="col-lg-1 col-xs-1">
                                            <input type="text" class="form-control text-center" value="D"
                                                   style="border: none; background-color: transparent;" readonly>
                                        </div>
                                        <div class="col-lg-3 col-xs-3">
                                            <input type="text"
                                                   class="form-control text-center"
                                                   name="txbnamadewasa<?php echo $a?>"
                                                   value="<?php echo $namapenumpang;?>"
                                                   style="border: none; background-color: transparent;"
                                                   readonly>
                                        </div>
                                        <div class="col-lg-2 col-xs-2">
                                            <input type="text"
                                                   class="form-control text-center"
                                                   name="txbiddewasa<?php echo $a?>"
                                                   value="<?php echo $idpenumpang;?>"
                                                   style="border: none; background-color: transparent;"
                                                   readonly>
                                        </div>
                                            <input type="hidden"
                                                   class="form-control text-center"
                                                   name="txbtgllahirdewasa<?php echo $a?>"
                                                   value="<?php echo $tgllahirpen;?>"
                                                   style="border: none; background-color: transparent;"
                                                   readonly>
                                            <input type="hidden"
                                                   class="form-control text-center"
                                                   name="txbnotelpdewasa<?php echo $a?>"
                                                   value="<?php echo $notelppenumpang;?>"
                                                   style="border: none; background-color: transparent;"
                                                   readonly>

                                        <!-- Input data no seat pergi -->
                                        <div class="col-lg-2 col-xs-2">
                                            <input type="text" id="txbnoseatasalpenumpangpergi<?php echo $a?>" name="txbnoseatasalpenumpangpergi<?php echo $a?>" class="form-control text-right" style="border: none; background-color: transparent;" value="<?php echo $tempatdudukpenumpang; ?>" readonly>
                                        </div>
                                        <div class="col-lg-1 col-xs-1">
                                            <button type="button" class="btn btn-danger btn-xs" style="margin-top: 5px; float: right;" id="btnpindahkursipergi<?php echo $a;?>" onclick="pindahkursipergi(this.id)">Pindah</button>
                                        </div>
                                        <div class="col-lg-2 col-xs-2">
                                            <input type="text" id="txbnoseatbarupenumpangpergi<?php echo $a?>" name="txbnoseatbarupenumpangpergi<?php echo $a?>" class="form-control text-right" style="border: none; background-color: transparent;" value="-" readonly>
                                            <input type="hidden" id="txbwagoncodepenumpangpergi" name="txbwagoncodepenumpangpergi<?php echo $a?>" class="form-control text-right" value="<?php echo $bookinggrade;?>" readonly>
                                            <input type="hidden" id="txbwagonnumberpenumpangpergi<?php echo $a?>" name="txbwagonnumberpenumpangpergi<?php echo $a?>" class="form-control text-right" value="<?php echo $bookingwagon;?>" readonly>
                                            <input type="hidden" id="txbrowpenumpangpergi<?php echo $a?>" name="txbrowpenumpangpergi<?php echo $a?>" class="form-control text-right" value="<?php echo $bookingrow;?>" readonly>
                                            <input type="hidden" id="txbcolumnpenumpangpergi<?php echo $a?>" name="txbcolumnpenumpangpergi<?php echo $a?>" class="form-control text-right" value="<?php echo $bookingcolumn;?>" readonly>

                                        </div>
                                        <div class="col-lg-1 col-xs-1">
                                            <button type="button"
                                                    class="btn btn-info btn-xs"
                                                    style="margin-top: 5px; float: right; display: none;"
                                                    id="btnhapuskursipergi<?php echo $a;?>"
                                                    data-wagonnumber="<?php echo $bookingwagon ?>"
                                                    data-wagonrow="<?php echo $bookingrow ?>"
                                                    data-wagoncolumn="<?php echo $bookingcolumn ?>"
                                                    data-nopenumpang="<?php echo $a ?>"
                                                    onclick="hapuskursipergi(this)">Hapus</button>
                                        </div>

                                    </div>

                                    <div class="form-group" id="formlayoutkeretapergi<?php echo $a;?>" style="margin-top: 25px; margin-left: 30px; margin-right: 30px; margin-bottom: 20px; display: none;">

                                        <h3>Tampilan Tempat duduk</h3>
                                        <hr>
                                        <div class="table-responsive" style="margin-bottom: 0px;">

                                            <table class="table table-responsive" style="border: none;" id="tabeldatawagonpergi">
                                                <tbody>

                                                <tr class="text-center" style="border: none;">
                                                    <?php

                                                    for ($jdw = 0; $jdw < $jumlahdatawagon; $jdw++) {

                                                        $wagoncodes = $seatlayout->seatlayoutpergi->data[$jdw]->wagonCode;
                                                        if ($wagoncodes == 'EKS') {
                                                            $wagonname = 'Eksekutif';
                                                        } else if ($wagoncodes == 'BIS') {
                                                            $wagonname = 'Bisnis';
                                                        } else {
                                                            $wagonname = 'Ekonomi';
                                                        }
                                                        $wagonnumber = $seatlayout->seatlayoutpergi->data[$jdw]->wagonNumber;

                                                        if($wagoncodes == $wagoncode){
                                                            ?>
                                                            <td style="border: none;">
                                                                <button
                                                                        type="button"
                                                                        data-nopenumpang="<?php echo $a; ?>"
                                                                        data-wagoncode="<?php echo $wagoncodes; ?>"
                                                                        data-wagonnumber="<?php echo $wagonnumber; ?>"
                                                                        data-jumlahwagon="<?php echo $jumlahdatawagon; ?>"
                                                                        style="border: none; background-color: transparent;"
                                                                        id="<?php echo $wagonname.' '.$wagonnumber;?>"
                                                                        onclick="pilihlayoutgerbongpergi(this)"
                                                                >
                                                                    <i class="fa fa-train" style="font-size:3em;margin-right:10px;color: darkorange;"></i><br/>
                                                                    <?php echo $wagonname.' '.$wagonnumber?>
                                                                </button>
                                                            </td>

                                                            <?php
                                                        }

                                                    };
                                                    ?>
                                                </tr>
                                                </tbody>

                                            </table>

                                        </div>

                                        <?php

                                        for ($jdw = 0; $jdw < $jumlahdatawagon; $jdw++) {

                                            $wagoncodes = $seatlayout->seatlayoutpergi->data[$jdw]->wagonCode;
                                            if ($wagoncodes == 'EKS') {
                                                $wagonname = 'Eksekutif';
                                            } else if ($wagoncodes == 'BIS') {
                                                $wagonname = 'Bisnis';
                                            } else {
                                                $wagonname = 'Ekonomi';
                                            }
                                            $wagonnumber = $seatlayout->seatlayoutpergi->data[$jdw]->wagonNumber;

                                            if($wagoncodes == $wagoncode){
                                                ?>

                                                <div
                                                        class="tooltip-demo"
                                                        id="DWPERGI<?php echo $a.''.$wagoncodes.''.$wagonnumber?>"
                                                        style="margin-bottom: 0px;
                                                               margin-top: 0px;
                                                               display: none;">

                                                    <div class="row">
                                                        <?php echo $wagonname.' '.$wagonnumber?><br/>
                                                    </div>

                                                    <?php

                                                    $jmllayout = sizeof($seatlayout->seatlayoutpergi->data[$jdw]->layout);
                                                    $jmllay = $jmllayout - 1;


                                                    $rowakhir = $seatlayout->seatlayoutpergi->data[$jdw]->layout[$jmllay]->row; //17

                                                    $arrcol = array();
                                                    for($rc = 1 ; $rc <=$rowakhir; $rc++){
                                                        $colname = $seatlayout->seatlayoutpergi->data[$jdw]->layout[$rc]->column;
                                                        array_push($arrcol,$colname);
                                                    }

                                                    $colakhir = max($arrcol);

                                                    ?>

                                                    <div class="table-responsive" style="width: 100%;overflow: scroll;overflow-y: hidden;" >

                                                        <table class="table">
                                                            <tbody>
                                                            <?php for ($col = 'A'; $col <= $colakhir; $col++) { ?>
                                                                <tr>
                                                                    <td style="border: none"><?php echo $col; ?></td>

                                                                    <?php
                                                                    for ($row = 1; $row <=$rowakhir; $row++){
                                                                        $cell = $row.''.$col;
                                                                        ?>

                                                                        <td style="border: none">

                                                                            <?php

                                                                            for ($layoutrow = 0; $layoutrow <=$jmllay; $layoutrow++){

                                                                                $rowdata = $seatlayout->seatlayoutpergi->data[$jdw]->layout[$layoutrow]->row;
                                                                                $coldata = $seatlayout->seatlayoutpergi->data[$jdw]->layout[$layoutrow]->column;
                                                                                $celldata = $rowdata.''.$coldata;

                                                                                if($celldata == $cell){

                                                                                    if($bookinggrade == $wagoncodes && $bookingwagon == $wagonnumber && $bookingrow == $rowdata && $bookingcolumn == $coldata){
                                                                                        ?>

                                                                                        <button
                                                                                                type="button"
                                                                                                class="btn btn-info btn-xs"
                                                                                                style="cursor: not-allowed;"
                                                                                                id="btn<?php echo $a.''.$wagoncodes.''.$wagonnumber.''.$cell;?>"
                                                                                                data-toggle="tooltip"
                                                                                                data-placement="right"
                                                                                                title="Tempat duduk anda"
                                                                                                readonly>
                                                                                            <?php echo $cell;?>
                                                                                        </button>

                                                                                        <?php

                                                                                    }else{

                                                                                        if($seatlayout->seatlayoutpergi->data[$jdw]->layout[$layoutrow]->isFilled == 1){
                                                                                            ?>

                                                                                            <button
                                                                                                    type="button"
                                                                                                    class="btn btn-danger btn-xs"
                                                                                                    style="cursor: not-allowed;"
                                                                                                    id="btn<?php echo $a.''.$wagoncodes.''.$wagonnumber.''.$cell;?>"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="right"
                                                                                                    title="Tempat duduk yang sudah ditempati"
                                                                                                    readonly>
                                                                                                <?php echo $cell;?>
                                                                                            </button>

                                                                                            <?php
                                                                                        }else{
                                                                                            ?>

                                                                                            <button
                                                                                                    type="button"
                                                                                                    class="btn btn-xs"
                                                                                                    id="btn<?php echo $a.''.$wagoncodes.''.$wagonnumber.''.$cell;?>"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="right"
                                                                                                    data-wagoncode="<?php echo $wagoncodes ?>"
                                                                                                    data-wagonnumber="<?php echo $wagonnumber ?>"
                                                                                                    data-wagonrow="<?php echo $rowdata ?>"
                                                                                                    data-wagoncolumn="<?php echo $coldata ?>"
                                                                                                    data-nopenumpang="<?php echo $a ?>"
                                                                                                    onclick="kursipergiyangdipilih(this)"
                                                                                                    title="Tempat duduk yang boleh ditempati">
                                                                                                <?php echo $cell;?>
                                                                                            </button>

                                                                                            <?php
                                                                                        }

                                                                                        ?>


                                                                                        <?php
                                                                                    }

                                                                                }

                                                                            }

                                                                            ?>

                                                                        </td>

                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </tr>
                                                            <?php } ?>
                                                            <tr>
                                                                <td style="border: none"></td>
                                                                <?php for ($row = 1; $row <=$rowakhir; $row++){ ?>
                                                                    <td style="border: none"><?php echo $row; ?></td>
                                                                <?php } ?>
                                                            </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>

                                                </div>

                                                <?php
                                            }

                                        };
                                        ?>


                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-lg-10">
                                                <span style="color: <?php echo $warna_lembaga; ?>">* Untuk pindah kursi, Silahkan klik pada kursi yang masih kosong</span>
                                            </div>
                                            <div class="col-lg-2 text-right">
                                                <button type="button" class="btn btn-info btn-xs" id="btntutuplayoutpergi<?php echo $a;?>" onclick="tutuplayoutpergi(this.id)">Tutup</button>
                                            </div>
                                        </div>


                                    </div>



                                <?php

                                }

                                if ($jmlbayi > 0) {

                                    for ($y = 1; $y <= $jmlbayi; $y++) {

                                        $txbnamebayi = 'txbnamebayi' . $y;
                                        $txbtgllahirbayi = 'txbtgllahirbayi' . $y;
                                        $namabayi = $this->input->post($txbnamebayi);
                                        $tanggallahirbayi = $this->input->post($txbtgllahirbayi);
                                        $splitbayi = explode('/', $tanggallahirbayi);
                                        $tgllahirbayi = $splitbayi[2] . '-' . $splitbayi[1] . '-' . $splitbayi[0];

                                        ?>

                                        <div class="form-group" style="margin-bottom: 0px;">

                                            <div class="col-lg-1 col-xs-1">
                                                <input type="text" class="form-control text-center" value="B"
                                                       style="border: none;">
                                            </div>
                                            <div class="col-lg-3 col-xs-3">
                                                <input type="text" class="form-control text-center" name="txbnamabayi<?php echo $y?>" value="<?php echo $namabayi; ?>" style="border: none;">
                                                <input type="hidden" class="form-control text-center" name="txbtgllahirbayi<?php echo $y?>" value="<?php echo $tgllahirbayi; ?>" style="border: none;">
                                            </div>
                                            <div class="col-lg-8 col-xs-8">
                                                <input type="text" class="form-control text-center"
                                                       value=" - " style="border: none;">
                                            </div>

                                        </div>

                                        <?php
                                    }
                                }
                                ?>

                            </div>


                            <?php
                            if ($trainnamepulang != '') {

                                ?>

                                <div class="ibox-content" style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">

                                    <h3>PERJALANAN PULANG</h3>
                                    <hr/>

                                    <div class="form-group">
                                        <input type="hidden" id="txbcodebookingpulang" name="txbcodebookingpulang" value="<?php echo $bookingkereta->bookingpulang->data->bookingCode ?>">
                                        <input type="hidden" id="txbtransactionidbookingpulang" name="txbtransactionidbookingpulang" value="<?php echo $bookingkereta->bookingpulang->data->transactionId ?>">
                                        <input type="hidden" id="txbkomisipulang" name="txbkomisipulang" value="<?php echo $komisipulang?>">
                                        <input type="hidden" id="txbnormalsalespulang" name="txbnormalsalespulang" value="<?php echo $normalsalespulang?>">
                                        <input type="hidden" id="txbextrafeepulang" name="txbextrafeepulang" value="<?php echo $extrafeepulang?>">
                                        <input type="hidden" id="txbnominaladminpulang" name="txbnominaladminpulang" value="<?php echo $biayaadminpulang?>">
                                        <input type="hidden" id="txbbookbalancepulang" name="txbbookbalancepulang" value="<?php echo $bookbalancepulang?>">
                                        <input type="hidden" id="txbdiscountpulang" name="txbdiscountpulang" value="<?php echo $discountpulang?>">
                                        <input type="hidden" id="txbtimelimitpulang" name="txbtimelimitpulang" value="<?php echo $bookingkereta->bookingpulang->data->timeLimit?>">
                                    </div>


                                    <div class="form-group text-center" style="margin-bottom: 0px;">

                                        <div class="col-lg-1 col-xs-1">
                                            <label class="control-label" style="margin-bottom: 10px;">Tipe</label>
                                        </div>
                                        <div class="col-lg-3 col-xs-3">
                                            <label class="control-label" style="margin-bottom: 10px;">Nama
                                                Penumpang </label>
                                        </div>
                                        <div class="col-lg-2 col-xs-2">
                                            <label class="control-label" style="margin-bottom: 10px;">No Identitas</label>
                                        </div>
                                        <div class="col-lg-3 col-xs-3">
                                            <label class="control-label" style="margin-bottom: 10px;">No Kursi</label>
                                        </div>
                                        <div class="col-lg-3 col-xs-3">
                                            <label class="control-label" style="margin-bottom: 10px;">No Kursi Baru</label>
                                        </div>

                                    </div>

                                    <?php

                                    for ($x = 0; $x < $jmldewasa; $x++) {

                                        $a = $x+1;
                                        $txbnamedewasa = 'txbnamedewasa' . $a;
                                        $txbiddewasa = 'txbiddewasa' . $a;
                                        $namapenumpang = $this->input->post($txbnamedewasa);
                                        $idpenumpang = $this->input->post($txbiddewasa);

                                        $bookinggrade = $bookingkereta->bookingpulang->data->seats[$x][0];
                                        $bookingwagon = $bookingkereta->bookingpulang->data->seats[$x][1];
                                        $bookingrow = $bookingkereta->bookingpulang->data->seats[$x][2];
                                        $bookingcolumn = $bookingkereta->bookingpulang->data->seats[$x][3];

                                        $tempatdudukpenumpang = $bookinggrade . '-' . $bookingwagon . ', ' . $bookingrow . '' . $bookingcolumn;

                                        $wagoncode = $bookinggrade;
                                        $jumlahdatawagon = count($seatlayout->seatlayoutpulang->data);

                                        ?>

                                        <div class="form-group" style="margin-bottom: 0px;">

                                            <div class="col-lg-1 col-xs-1">
                                                <input type="text" class="form-control text-center" value="D"
                                                       style="border: none; background-color: transparent;" readonly>
                                            </div>
                                            <div class="col-lg-3 col-xs-3">
                                                <input type="text" class="form-control text-center"
                                                       value="<?php echo $namapenumpang;?>" style="border: none; background-color: transparent;" readonly>
                                            </div>
                                            <div class="col-lg-2 col-xs-2">
                                                <input type="text" class="form-control text-center"
                                                       value="<?php echo $idpenumpang;?>" style="border: none; background-color: transparent;" readonly>
                                            </div>
                                            <!-- Input data no seat pulang -->
                                            <div class="col-lg-2 col-xs-2">
                                                <input type="text" id="txbnoseatasalpenumpangpulang<?php echo $a?>" name="txbnoseatasalpenumpangpulang<?php echo $a?>" class="form-control text-right" style="border: none; background-color: transparent;" value="<?php echo $tempatdudukpenumpang; ?>" readonly>
                                            </div>
                                            <div class="col-lg-1 col-xs-1">
                                                <button type="button" class="btn btn-danger btn-xs" style="margin-top: 5px; float: right;" id="btnpindahkursipulang<?php echo $a;?>" onclick="pindahkursipulang(this.id)">Pindah</button>
                                            </div>
                                            <div class="col-lg-2 col-xs-2">
                                                <input type="text" id="txbnoseatbarupenumpangpulang<?php echo $a?>" name="txbnoseatbarupenumpangpulang<?php echo $a?>" class="form-control text-right" style="border: none; background-color: transparent;" value="-" readonly>
                                                <input type="hidden" id="txbwagoncodepenumpangpulang" name="txbwagoncodepenumpangpulang<?php echo $a?>" class="form-control text-right" value="<?php echo $bookinggrade;?>" readonly>
                                                <input type="hidden" id="txbwagonnumberpenumpangpulang<?php echo $a?>" name="txbwagonnumberpenumpangpulang<?php echo $a?>" class="form-control text-right" value="<?php echo $bookingwagon;?>" readonly>
                                                <input type="hidden" id="txbrowpenumpangpulang<?php echo $a?>" name="txbrowpenumpangpulang<?php echo $a?>" class="form-control text-right" value="<?php echo $bookingrow;?>" readonly>
                                                <input type="hidden" id="txbcolumnpenumpangpulang<?php echo $a?>" name="txbcolumnpenumpangpulang<?php echo $a?>" class="form-control text-right" value="<?php echo $bookingcolumn;?>" readonly>
                                            </div>
                                            <div class="col-lg-1 col-xs-1">
                                                <button type="button"
                                                        class="btn btn-info btn-xs"
                                                        style="margin-top: 5px; float: right; display: none;"
                                                        id="btnhapuskursipulang<?php echo $a;?>"
                                                        data-wagonnumber="<?php echo $bookingwagon ?>"
                                                        data-wagonrow="<?php echo $bookingrow ?>"
                                                        data-wagoncolumn="<?php echo $bookingcolumn ?>"
                                                        data-nopenumpang="<?php echo $a ?>"
                                                        onclick="hapuskursipulang(this)">Hapus</button>
                                            </div>


                                        </div>


                                        <div class="form-group" id="formlayoutkeretapulang<?php echo $a;?>" style="margin-top: 25px; margin-left: 30px; margin-right: 30px; margin-bottom: 20px; display: none;">

                                            <h3>Tampilan Tempat duduk</h3>
                                            <hr>
                                            <div class="table-responsive" style="margin-bottom: 0px;">

                                                <table class="table table-responsive" style="border: none;" id="tabeldatawagonpulang">
                                                    <tbody>

                                                    <tr class="text-center" style="border: none;">
                                                        <?php

                                                        for ($jdw = 0; $jdw < $jumlahdatawagon; $jdw++) {

                                                            $wagoncodes = $seatlayout->seatlayoutpulang->data[$jdw]->wagonCode;
                                                            if ($wagoncodes == 'EKS') {
                                                                $wagonname = 'Eksekutif';
                                                            } else if ($wagoncodes == 'BIS') {
                                                                $wagonname = 'Bisnis';
                                                            } else {
                                                                $wagonname = 'Ekonomi';
                                                            }
                                                            $wagonnumber = $seatlayout->seatlayoutpulang->data[$jdw]->wagonNumber;

                                                            if($wagoncodes == $wagoncode){
                                                                ?>
                                                                <td style="border: none;">
                                                                    <button
                                                                            type="button"
                                                                            data-nopenumpang="<?php echo $a; ?>"
                                                                            data-wagoncode="<?php echo $wagoncodes; ?>"
                                                                            data-wagonnumber="<?php echo $wagonnumber; ?>"
                                                                            data-jumlahwagon="<?php echo $jumlahdatawagon; ?>"
                                                                            style="border: none; background-color: transparent;"
                                                                            id="<?php echo $wagonname.' '.$wagonnumber;?>"
                                                                            onclick="pilihlayoutgerbongpulang(this)"
                                                                    >
                                                                        <i class="fa fa-train" style="font-size:3em;margin-right:10px;color: darkorange;"></i><br/>
                                                                        <?php echo $wagonname.' '.$wagonnumber?>
                                                                    </button>
                                                                </td>

                                                                <?php
                                                            }

                                                        };
                                                        ?>
                                                    </tr>
                                                    </tbody>

                                                </table>

                                            </div>

                                            <?php

                                            for ($jdw = 0; $jdw < $jumlahdatawagon; $jdw++) {

                                                $wagoncodes = $seatlayout->seatlayoutpulang->data[$jdw]->wagonCode;
                                                if ($wagoncodes == 'EKS') {
                                                    $wagonname = 'Eksekutif';
                                                } else if ($wagoncodes == 'BIS') {
                                                    $wagonname = 'Bisnis';
                                                } else {
                                                    $wagonname = 'Ekonomi';
                                                }
                                                $wagonnumber = $seatlayout->seatlayoutpulang->data[$jdw]->wagonNumber;

                                                if($wagoncodes == $wagoncode){
                                                    ?>

                                                    <div
                                                            class="tooltip-demo"
                                                            id="DWPULANG<?php echo $a.''.$wagoncodes.''.$wagonnumber?>"
                                                            style="margin-bottom: 0px;
                                                               margin-top: 0px;
                                                               display: none;">

                                                        <div class="row">
                                                            <?php echo $wagonname.' '.$wagonnumber?><br/>
                                                        </div>

                                                        <?php

                                                        $jmllayout = sizeof($seatlayout->seatlayoutpulang->data[$jdw]->layout);
                                                        $jmllay = $jmllayout - 1;


                                                        $rowakhir = $seatlayout->seatlayoutpulang->data[$jdw]->layout[$jmllay]->row; //17
                                                        $arrcol = array();
                                                        for($rc = 1 ; $rc <=$rowakhir; $rc++){
                                                            $colname = $seatlayout->seatlayoutpulang->data[$jdw]->layout[$rc]->column;
                                                            array_push($arrcol,$colname);
                                                        }

                                                        $colakhir = max($arrcol);

                                                        ?>

                                                        <div class="table-responsive" style="width: 100%;overflow: scroll;overflow-y: hidden;" >

                                                            <table class="table">
                                                                <tbody>
                                                                <?php for ($col = 'A'; $col <= $colakhir; $col++) { ?>
                                                                    <tr>
                                                                        <td style="border: none"><?php echo $col; ?></td>

                                                                        <?php
                                                                        for ($row = 1; $row <=$rowakhir; $row++){
                                                                            $cell = $row.''.$col;
                                                                            ?>

                                                                            <td style="border: none">

                                                                                <?php

                                                                                for ($layoutrow = 0; $layoutrow <=$jmllay; $layoutrow++){

                                                                                    $rowdata = $seatlayout->seatlayoutpulang->data[$jdw]->layout[$layoutrow]->row;
                                                                                    $coldata = $seatlayout->seatlayoutpulang->data[$jdw]->layout[$layoutrow]->column;
                                                                                    $celldata = $rowdata.''.$coldata;

                                                                                    if($celldata == $cell){

                                                                                        if($bookinggrade == $wagoncodes && $bookingwagon == $wagonnumber && $bookingrow == $rowdata && $bookingcolumn == $coldata){
                                                                                            ?>

                                                                                            <button
                                                                                                    type="button"
                                                                                                    class="btn btn-info btn-xs"
                                                                                                    style="cursor: not-allowed;"
                                                                                                    id="<?php echo $wagoncodes.''.$wagonnumber.''.$cell;?>"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="right"
                                                                                                    title="Tempat duduk anda"
                                                                                                    readonly>
                                                                                                <?php echo $cell;?>
                                                                                            </button>

                                                                                            <?php

                                                                                        }else{

                                                                                            if($seatlayout->seatlayoutpulang->data[$jdw]->layout[$layoutrow]->isFilled == 1){
                                                                                                ?>

                                                                                                <button
                                                                                                        type="button"
                                                                                                        class="btn btn-danger btn-xs"
                                                                                                        style="cursor: not-allowed;"
                                                                                                        id="<?php echo $wagoncodes.''.$wagonnumber.''.$cell;?>"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="right"
                                                                                                        title="Tempat duduk yang sudah ditempati"
                                                                                                        readonly>
                                                                                                    <?php echo $cell;?>
                                                                                                </button>

                                                                                                <?php
                                                                                            }else{
                                                                                                ?>

                                                                                                <button
                                                                                                        type="button"
                                                                                                        class="btn btn-xs"
                                                                                                        id="btn<?php echo $a.''.$wagoncodes.''.$wagonnumber.''.$cell;?>"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="right"
                                                                                                        data-wagoncode="<?php echo $wagoncodes ?>"
                                                                                                        data-wagonnumber="<?php echo $wagonnumber ?>"
                                                                                                        data-wagonrow="<?php echo $rowdata ?>"
                                                                                                        data-wagoncolumn="<?php echo $coldata ?>"
                                                                                                        data-nopenumpang="<?php echo $a ?>"
                                                                                                        onclick="kursipulangyangdipilih(this)"
                                                                                                        title="Tempat duduk yang boleh ditempati">
                                                                                                    <?php echo $cell;?>
                                                                                                </button>

                                                                                                <?php
                                                                                            }

                                                                                            ?>


                                                                                            <?php
                                                                                        }

                                                                                    }

                                                                                }

                                                                                ?>

                                                                            </td>

                                                                            <?php
                                                                        }
                                                                        ?>

                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="border: none"></td>
                                                                    <?php for ($row = 1; $row <=$rowakhir; $row++){ ?>
                                                                        <td style="border: none"><?php echo $row; ?></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                </tbody>
                                                            </table>

                                                        </div>

                                                    </div>

                                                    <?php
                                                }

                                            };
                                            ?>

                                            <div class="row" style="margin-top: 10px;">
                                                <div class="col-lg-10">
                                                    <span style="color: <?php echo $warna_lembaga; ?>">* Untuk pindah kursi, Silahkan klik pada kursi yang masih kosong</span>
                                                </div>
                                                <div class="col-lg-2 text-right">
                                                    <button type="button" class="btn btn-info btn-xs" id="btntutuplayoutpulang<?php echo $a;?>" onclick="tutuplayoutpulang(this.id)">Tutup</button>
                                                </div>
                                            </div>


                                        </div>



                                        <?php

                                    }

                                    if ($jmlbayi > 0) {

                                        for ($y = 1; $y <= $jmlbayi; $y++) {

                                            $txbnamebayi = 'txbnamebayi' . $y;
                                            $namabayi = $this->input->post($txbnamebayi);

                                            ?>

                                            <div class="form-group" style="margin-bottom: 0px;">

                                                <div class="col-lg-1 col-xs-1">
                                                    <input type="text" class="form-control text-center" value="B"
                                                           style="border: none;">
                                                </div>
                                                <div class="col-lg-3 col-xs-3">
                                                    <input type="text" class="form-control text-center"
                                                           value="<?php echo $namabayi; ?>" style="border: none;">
                                                </div>
                                                <div class="col-lg-8 col-xs-8">
                                                    <input type="text" class="form-control text-center"
                                                           value=" - " style="border: none;">
                                                </div>

                                            </div>

                                            <?php
                                        }
                                    }
                                    ?>

                                </div>

                                <?php
                            }
                            ?>

                            <div class="ibox-content">

                                <!-- Input data perjalanan serta harga -->

                                <input type="hidden" id="txbnmstfrom" name="txbnmstfrom" value="<?php echo $nmstfrom ?>">
                                <input type="hidden" id="txbkdstfrom" name="txbkdstfrom" value="<?php echo $kdstfrom ?>">
                                <input type="hidden" id="txbnmstto" name="txbnmstto" value="<?php echo $nmstto ?>">
                                <input type="hidden" id="txbkdstto" name="txbkdstto" value="<?php echo $kdstto ?>">
                                <input type="hidden" id="txbjmlbayi" name="txbjmlbayi" value="<?php echo $jmlbayi ?>">
                                <input type="hidden" id="txbjmldewasa" name="txbjmldewasa" value="<?php echo $jmldewasa ?>">

                                <input type="hidden" id="txbtrainnamepergi" name="txbtrainnamepergi" value="<?php echo $trainnamepergi ?>">
                                <input type="hidden" id="txbtrainnumberpergi" name="txbtrainnumberpergi" value="<?php echo $trainnumberpergi ?>">
                                <input type="hidden" id="txbtanggalpergi" name="txbtanggalpergi" value="<?php echo $tglpergi ?>">
                                <input type="hidden" id="txbdeparturetimepergi" name="txbdeparturetimepergi" value="<?php echo $departuretimepergi ?>">
                                <input type="hidden" id="txbarrivaltimepergi" name="txbarrivaltimepergi" value="<?php echo $arrivaltimepergi ?>">
                                <input type="hidden" id="txbgradepergi" name="txbgradepergi" value="<?php echo $gradeprgi ?>">
                                <input type="hidden" id="txbsubclasspergi" name="txbsubclasspergi" value="<?php echo $subclasspergi ?>">
                                <input type="hidden" id="txbpriceadultpergi" name="txbpriceadultpergi" value="<?php echo $priceadultpergi ?>">

                                <input type="hidden" id="txbtrainnamepulang" name="txbtrainnamepulang" value="<?php echo $trainnamepulang ?>">
                                <input type="hidden" id="txbtrainnumberpulang" name="txbtrainnumberpulang" value="<?php echo $trainnumberpulang ?>">
                                <input type="hidden" id="txbtanggalpulang" name="txbtanggalpulang" value="<?php echo $tglpulang ?>">
                                <input type="hidden" id="txbdeparturetimepulang" name="txbdeparturetimepulang" value="<?php echo $departuretimepulang ?>">
                                <input type="hidden" id="txbarrivaltimepulang" name="txbarrivaltimepulang" value="<?php echo $arrivaltimepulang ?>">
                                <input type="hidden" id="txbgradepulang" name="txbgradepulang" value="<?php echo $gradeplang ?>">
                                <input type="hidden" id="txbsubclasspulang" name="txbsubclasspulang" value="<?php echo $subclasspulang ?>">
                                <input type="hidden" id="txbpriceadultpulang" name="txbpriceadultpulang" value="<?php echo $priceadultpulang ?>">


                                <!-- Input data kontak -->

                                <?php
                                    $namakontak= $this->input->post('txbnamekontak');
                                    $emailkontak = $this->input->post('txbemailkontak');
                                    $notelpkontak = $this->input->post('txbnotelpkontak');
                                    $alamatkontak = $this->input->post('txbalamatkontak');
                                ?>

                                <input type="hidden" id="txbnamekontak" name="txbnamekontak" value="<?php echo $namakontak ?>">
                                <input type="hidden" id="txbemailkontak" name="txbemailkontak" value="<?php echo $emailkontak ?>">
                                <input type="hidden" id="txbnotelpkontak" name="txbnotelpkontak" value="<?php echo $notelpkontak ?>">
                                <input type="hidden" id="txbalamatkontak" name="txbalamatkontak" value="<?php echo $alamatkontak ?>">

                            </div>

                            <div class="ibox-footer" style="padding-top: 20px;">

                                <div class="row">
                                    <div class="col-lg-3">
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalCancel">CANCEL</button>
                                    </div>
                                    <div class="col-lg-6"></div>
                                    <div class="col-lg-3 text-right">
                                        <button type="button" class="btn btn-danger" id="btnsubmitfixduduk" onclick="submitfixduduk()" >NEXT</button>
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
                                                <input type="hidden" name="txbcancelcodebookingpergi" value="<?php echo $bookingkereta->bookingpergi->data->bookingCode ?>">
                                                <input type="hidden" name="txbcanceltransactionidbookingpergi" value="<?php echo $bookingkereta->bookingpergi->data->transactionId ?>">
                                                <input type="hidden" name="txbcanceltanggalpulang" value="<?php echo $tglpulang ?>">
                                                <?php
                                                    if ($trainnamepulang != '') {
                                                        ?>
                                                            <input type="hidden" name="txbcancelcodebookingpulang" value="<?php echo $bookingkereta->bookingpulang->data->bookingCode ?>">
                                                            <input type="hidden" name="txbcanceltransactionidbookingpulang" value="<?php echo $bookingkereta->bookingpulang->data->transactionId ?>">
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

                    <?php
                    }
                ?>
                

            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>

</div>

<!-- /content -->


</div>
