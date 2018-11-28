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
        <h2>&nbsp;</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url('dashboard')?>">Home</a>
            </li>
            <li>
                <a href="#">PPOB</a>
            </li>
            <li>
                <a href="#">Checkout</a>
            </li>
            <li class="active">
                <strong>Pembayaran</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<!-- Content -->

<div class="wrapper wrapper-content animated fadeInRight article" style="margin-top: 10px;">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">

            <?php $this->load->view('func_custom'); ?>

            <h2>
                <span style="color: <?php echo $warna_lembaga ?>">
                    <?php
                    if($txbjenistagihan == "PULSA") {
                        echo 'Pembayaran Pembelian Pulsa';
                    }else if($txbjenistagihan == "DATA") {
                        echo 'Pembayaran Pembelian Data';
                    }else if($txbjenistagihan == "PASCABAYAR") {
                        echo 'Pembayaran '.$dataproduk['namaproduk'];
                    }else if($txbjenistagihan == "PLNPASCABAYAR") {
                        echo 'Pembayaran Tagihan PLN';
                    }else if($txbjenistagihan == "TOKENPLN") {
                        echo 'Pembayaran Token PLN';
                    }else if($txbjenistagihan == "VOUCHERGAME") {
                        echo 'Pembayaran Voucher Game Online';
                    }else if($txbjenistagihan == "INDIHOME") {
                        echo 'Pembayaran Tagihan INDIHOME';
                    }else if($txbjenistagihan == "TELEPON") {
                        echo 'Pembayaran Tagihan TELEPON';
                    }else if($txbjenistagihan == "PGN") {
                        echo 'Pembayaran Tagihan Gas PGN';
                    }else if($txbjenistagihan == "PDAM") {
                        echo 'Pembayaran Tagihan '.$dataproduk['namaproduk'];
                    }else if($txbjenistagihan == "TVKABEL") {
                        echo 'Pembayaran Tagihan '.$dataproduk['namaproduk'];
                    }else if($txbjenistagihan == "ANGSKREDIT") {
                        echo 'Pembayaran Tagihan '.$dataproduk['namaproduk'];
                    }else if($txbjenistagihan == "EMONEY") {
                        echo 'Pembayaran '.$dataproduk['namaproduk'];
                    }
                    ?>
                </span>
            </h2>
            <div class="ibox float-e-margins" >

                <?php

                $errcode = $data_bayar->errorCode;

                    if($errcode <> '0'){
                    ?>

                    <div class="ibox-content" style="padding-bottom: 5px; padding-top: 15px;">

                        <div class="alert alert-warning alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?php echo $data_bayar->errorMsg;?>
                            <?php
                            if($data_bayar->errorMsg == ''){
                                echo 'Error, Ada kesalahan pada API';
                            }else{
                                echo 'Error, '.$data_bayar->errorMsg;
                            }

                            if ($txbjenistagihan == "PULSA" or $txbjenistagihan == "DATA") {
                                ?>
                                <a href="<?php echo base_url('Pulsa') ?>">Back to Pulsa dan Data</a>
                                <?php
                            }else{
                                ?>
                                <a href="<?php echo base_url('ppob') ?>">Back to PPOB</a>
                                <?php
                            }
                            ?>
                        </div>

                    </div>

                    <?php
                    }else{
                    ?>

                    <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">

                        <form class="form-horizontal" id="formpembayaran" method="post" action="bayar_tagihan">

                            <div class="ibox-content" style="padding-bottom: 5px; padding-top: 15px;">

                                <div class="form-group">

                                    <div class="col-lg-3 text-right" style="padding-top: 30px;">
                                        <?php
                                        if ($txbjenistagihan == "PASCABAYAR") {
                                            ?>
                                            <i class="fa fa-mobile-phone"
                                               style="color: <?php echo $warna_lembaga; ?>;font-size:4em; vertical-align: middle;"></i>
                                            <?php
                                        } else if ($txbjenistagihan == "PLNPASCABAYAR" or $txbjenistagihan == "TOKENPLN") {
                                            ?>
                                            <img alt="image" src="<?php echo base_url(); ?>assets/img/LOGOPLN.png"
                                                 style="height: 60px; width: 50px;"/>
                                            <?php
                                        } else if ($txbjenistagihan == "INDIHOME") {
                                            ?>
                                            <img alt="image" id="imgindihome"
                                                 src="<?php echo base_url(); ?>assets/img/logoindihome.png"
                                                 style="height: 70px; width: 90px;"/>
                                            <?php
                                        } else if ($txbjenistagihan == "TELEPON") {
                                            ?>
                                            <img alt="image" id="imgindihome"
                                                 src="<?php echo base_url(); ?>assets/img/logotelkom.png"
                                                 style="height: 70px; width: 90px;"/>
                                            <?php
                                        } else if($txbjenistagihan == "VOUCHERGAME") {
                                            ?>
                                            <i class="fa fa-gamepad"
                                               style="color: <?php echo $warna_lembaga; ?>;font-size:4em; vertical-align: middle;"></i>
                                            <?php
                                        } else if ($txbjenistagihan == "PDAM") {
                                            ?>
                                            <img alt="image" id="imgindihome"
                                                 src="<?php echo base_url(); ?>assets/img/logopdam.png"
                                                 style="height: 70px; width: 90px;"/>
                                            <?php
                                        } else if ($txbjenistagihan == "PGN") {
                                            ?>
                                            <img alt="image" id="imgindihome"
                                                 src="<?php echo base_url(); ?>assets/img/logopgn.png"
                                                 style="height: 70px; width: 90px;"/>
                                            <?php
                                        } else if ($txbjenistagihan == "TVKABEL") {
                                            ?>
                                            <i class="fa fa-video-camera"
                                               style="color: <?php echo $warna_lembaga; ?>;font-size:4em; vertical-align: middle;"></i>
                                            <?php
                                        }else if ($txbjenistagihan == "ANGSKREDIT") {
                                            ?>
                                            <i class="fa fa-money"
                                               style="color: <?php echo $warna_lembaga; ?>;font-size:4em; vertical-align: middle;"></i>
                                            <?php
                                        }else if ($txbjenistagihan == "PULSA" or $txbjenistagihan == "DATA") {
                                            ?>
                                            <i class="fa fa-mobile-phone"
                                               style="color: <?php echo $warna_lembaga; ?>;font-size:4em; vertical-align: middle;"></i>
                                            <?php
                                        }else if ($txbjenistagihan == "EMONEY") {
                                            ?>
                                            <i class="fa fa-road"
                                               style="color: <?php echo $warna_lembaga; ?>;font-size:4em; vertical-align: middle;"></i>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-8">

                                        <div class="row">
                                            <text class="col-lg-2 control-label">Nomor</text>
                                            <h2 class="col-lg-10">
                                                <?php
                                                $nopelanggan = $param['notelp'];
                                                echo $nopelanggan;
                                                ?>
                                            </h2>
                                        </div>
                                        <div class="row">
                                            <text class="col-lg-2 control-label">
                                                <?php if($txbjenistagihan == "VOUCHERGAME" or $txbjenistagihan == "EMONEY"){
                                                    echo 'Produk';
                                                }else{
                                                    echo 'Nama';
                                                }
                                                ?>
                                            </text>
                                            <h2 class="col-lg-10">
                                                <?php
                                                $kodeproduk = $dataproduk['produk'];
                                                $namaproduk = $dataproduk['namaproduk'];
                                                if ($txbjenistagihan == "PULSA" or $txbjenistagihan == "DATA" or $txbjenistagihan == "VOUCHERGAME" or $txbjenistagihan == "EMONEY"){

                                                    $namapelanggan = '';
                                                    echo $namaproduk;

                                                }else{

                                                    $namapelanggan = $data_bayar->data->nama;

                                                    echo $namapelanggan;
                                                }
                                                ?>
                                            </h2>
                                        </div>
                                        <?php if ( $txbjenistagihan == "TOKENPLN") { ?>
                                            <div class="row">
                                                <text class="col-lg-2 control-label">Token</text>
                                                <h2 class="col-lg-10">
                                                    <?php
                                                    $nominaltoken = number_format($param['nominal'], 0, ',', '.');
                                                    echo $nominaltoken;
                                                    ?>
                                                </h2>
                                            </div>
                                        <?php }?>
                                        <div class="row">
                                            <text class="col-lg-2 control-label">
                                                Total
                                            </text>
                                            <h2 class="col-lg-10">
                                                <?php
                                                if ($txbjenistagihan == "PULSA" or $txbjenistagihan == "DATA" or $txbjenistagihan == "VOUCHERGAME"){
                                                    $nominal = $data_bayar->nilai;
                                                    $sn = $data_bayar->sn;
                                                    $ref = $data_bayar->reqid;
                                                    echo rupiah($nominal);
                                                }elseif ($txbjenistagihan == "TOKENPLN"){
                                                    $tagihan = $data_bayar->data->nominal;
                                                    $biayaadmin = $data_bayar->data->admin;
                                                    $nominal = $tagihan + $biayaadmin;
                                                    $sn = $data_bayar->data->token;
                                                    $ref = $data_bayar->reqid;
                                                    echo rupiah($nominal);
                                                }
                                                else{
                                                    $tagihan = $data_bayar->data->nominal;
                                                    $biayaadmin = $data_bayar->data->admin;
                                                    $nominal = $tagihan + $biayaadmin;
                                                    $sn = '';
                                                    $ref = $data_bayar->reqid;
                                                    echo rupiah($nominal);
                                                }
                                                ?>
                                            </h2>
                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-lg-12">
                                        <input type="hidden" value="<?php echo $txbjenistagihan ?>" name="txbjenistagihan" id="txbjenistagihan">
                                        <input type="hidden" value="<?php echo $kodeproduk ?>" name="txbkodeproduk" id="txbkodeproduk">
                                        <input type="hidden" value="<?php echo $namaproduk ?>" name="txbnamaproduk" id="txbnamaproduk">
                                        <input type="hidden" value="<?php echo $nopelanggan ?>" name="txbnopelanggan" id="txbnopelanggan">
                                        <input type="hidden" value="<?php echo $namapelanggan ?>" name="txbnamapelanggan" id="txbnamapelanggan">
                                        <input type="hidden" value="<?php echo $nominal ?>" name="txbnominal" id="txbnominal">
                                        <?php
                                            $user_data = $this->session->userdata;
                                            if ($user_data['user_level'] == 0) {
                                                $saldo = $datasaldo->saldo;
                                            }else{
                                                $saldo = $datasaldo[0]->saldo;
                                            }
                                        ?>
                                        <input type="hidden" value="<?php echo $saldo ?>" name="txbsaldosekarang" id="txbsaldosekarang">
                                        <input type="hidden" value="<?php echo $sn ?>" name="txbsn" id="txbsn">
                                        <input type="hidden" value="<?php echo $ref ?>" name="txbref" id="txbref">
                                        <input type="hidden" value="<?php echo $tab ?>" name="txbtab" id="txbtab">
                                        <button type="submit" class="btn btn-danger" style="width: 100%; margin-top: 30px;">SELESAI</button>
                                    </div>

                                </div>


                            </div>

                        </form>

                    <?php
                }
                ?>

            </div>

        </div>
        <div class="col-lg-4"></div>
    </div>
</div>

<!-- /content -->


</div>