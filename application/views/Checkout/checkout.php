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
                <a href="<?php echo base_url('ppob')?>">PPOB</a>
            </li>
            <li class="active">
                <strong>Checkout</strong>
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
                <a href="<?php echo base_url('ppob?tab='.$txbtab);?>">
                    <i class="fa fa-arrow-left" style="font-size:1.5em;margin-right:8px;color: <?php echo $warna_lembaga ?>;"></i>
                </a>
                <span style="color: <?php echo $warna_lembaga ?>">
                    <?php
                    $arrProdukPasca = array("Tagihan HALO - Telkomsel Pascabayar",
                        "Tagihan MATRIX - Indosat Pascabayar",
                        "Tagihan Xplor - XL Pascabayar",
                        "Tagihan ESIA - Esia Pascabayar",
                        "Tagihan SMARTFREN - Smartfren Pascabayar",
                        "Tagihan THREE - Three Pascabayar");

                    if($txbjenistagihan == "PASCABAYAR") {
                         echo $arrProdukPasca[$jenistagihan];
                    }else if($txbjenistagihan == "TOKENPLN") {
                         echo 'Pembelian Token PLN';
                    }else if($txbjenistagihan == "PLNPASCABAYAR") {
                        echo 'Tagihan PLN PASCABAYAR';
                    }else if($txbjenistagihan == "VOUCHERGAME") {
                        echo 'Beli Voucher Game Online';
                    }else if($txbjenistagihan == "INDIHOME") {
                        echo 'Tagihan TELKOM INDIHOME';
                    }else if($txbjenistagihan == "TELEPON") {
                        echo 'Tagihan Telepon TELKOM';
                    }else if($txbjenistagihan == "PDAM") {
                        echo 'Tagihan '.$namapdam;
                    }else if($txbjenistagihan == "PGN") {
                        echo 'Tagihan Gas PGN';
                    }else if($txbjenistagihan == "TVKABEL") {
                        echo 'Tagihan '.$namatvkabel;
                    }else if($txbjenistagihan == "ANGSKREDIT") {
                        echo 'Tagihan '.$namaangskredit;
                    }

                    ?>
                </span>
            </h2>
            <div class="ibox float-e-margins" >

                <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">


                <?php
                if ($data_tagihan->errorCode == 0) {

                        ?>

                        <form class="form-horizontal" id="formCheckoutPPOB" method="post">

                            <div class="ibox-content" style="padding-bottom: 5px; padding-top: 15px;">

                                <div class="form-group">

                                    <div class="col-lg-3 text-right" style="padding-top: 30px;">
                                        <?php
                                        if ($txbjenistagihan == "PASCABAYAR") {
                                            ?>
                                            <i class="fa fa-mobile-phone"
                                               style="color: <?php echo $warna_lembaga; ?>;font-size:4em; vertical-align: middle;"></i>
                                            <input type="hidden" value="<?php echo $arrProdukPasca[$jenistagihan] ?>" name="txbnamaproduk" id="txbnamaproduk">
                                            <?php
                                        } else if ($txbjenistagihan == "TOKENPLN") {
                                            ?>
                                            <img alt="image" src="<?php echo base_url(); ?>assets/img/LOGOPLN.png"
                                                 style="height: 60px; width: 50px;"/>
                                            <input type="hidden" value="TOKEN PLN" name="txbnamaproduk" id="txbnamaproduk">
                                            <?php
                                        } else if ($txbjenistagihan == "PLNPASCABAYAR") {
                                            ?>
                                            <img alt="image" src="<?php echo base_url(); ?>assets/img/LOGOPLN.png"
                                                 style="height: 60px; width: 50px;"/>
                                            <input type="hidden" value="PLN Pasca Bayar" name="txbnamaproduk" id="txbnamaproduk">
                                            <?php
                                        } else if ($txbjenistagihan == "INDIHOME") {
                                            ?>
                                            <img alt="image" id="imgindihome"
                                                 src="<?php echo base_url(); ?>assets/img/logoindihome.png"
                                                 style="height: 70px; width: 90px;"/>
                                            <input type="hidden" value="TELKOM Indihome" name="txbnamaproduk" id="txbnamaproduk">
                                            <?php
                                        } else if ($txbjenistagihan == "TELEPON") {
                                            ?>
                                            <img alt="image" id="imgindihome"
                                                 src="<?php echo base_url(); ?>assets/img/logotelkom.png"
                                                 style="height: 70px; width: 90px;"/>
                                            <input type="hidden" value="TELKOM Telepon" name="txbnamaproduk" id="txbnamaproduk">
                                            <?php
                                        } else if ($txbjenistagihan == "PDAM") {
                                            ?>
                                            <img alt="image" id="imgindihome"
                                                 src="<?php echo base_url(); ?>assets/img/logopdam.png"
                                                 style="height: 70px; width: 90px;"/>
                                            <input type="hidden" value="<?php echo $namapdam;?>" name="txbnamaproduk" id="txbnamaproduk">
                                            <?php
                                        } else if ($txbjenistagihan == "PGN") {
                                            ?>
                                            <img alt="image" id="imgindihome"
                                                 src="<?php echo base_url(); ?>assets/img/logopgn.png"
                                                 style="height: 70px; width: 90px;"/>
                                            <input type="hidden" value="Gas PGN" name="txbnamaproduk" id="txbnamaproduk">
                                            <?php
                                        } else if ($txbjenistagihan == "TVKABEL") {
                                            ?>
                                            <i class="fa fa-video-camera"
                                               style="color: <?php echo $warna_lembaga; ?>;font-size:4em; vertical-align: middle;"></i>
                                            <input type="hidden" value="<?php echo $namatvkabel;?>" name="txbnamaproduk" id="txbnamaproduk">
                                            <?php
                                        }else if ($txbjenistagihan == "ANGSKREDIT") {
                                            ?>
                                            <i class="fa fa-money"
                                               style="color: <?php echo $warna_lembaga; ?>;font-size:4em; vertical-align: middle;"></i>
                                            <input type="hidden" value="<?php echo $namaangskredit;?>" name="txbnamaproduk" id="txbnamaproduk">
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-8">

                                        <div class="row">
                                            <text class="col-lg-2 control-label">Nomor</text>
                                            <h2 class="col-lg-10">
                                                <?php echo $nomorpelanggan ?>
                                            </h2>
                                        </div>
                                        <div class="row">
                                            <text class="col-lg-2 control-label">Nama</text>
                                            <h2 class="col-lg-10">
                                                <?php

                                                if ($data_tagihan->data->nama == '') {
                                                    echo $data_tagihan->errorMsg;
                                                } else {
                                                    echo $data_tagihan->data->nama;
                                                }

                                                ?>
                                            </h2>
                                        </div>
                                        <?php
                                        if ($txbjenistagihan != "TOKENPLN") {
                                            ?>
                                            <div class="row">
                                                <text class="col-lg-2 control-label">Total</text>
                                                <h2 class="col-lg-10">
                                                    <?php
                                                    $tagihan = $data_tagihan->data->nominal;
                                                    $biayaadmin = $data_tagihan->data->admin;
                                                    echo rupiah($tagihan + $biayaadmin);
                                                    ?>
                                                </h2>
                                            </div>
                                            <?php
                                        }else{
                                            ?>
                                            <div class="row">
                                                <text class="col-lg-2 control-label">Token</text>
                                                <h2 class="col-lg-10">
                                                    <?php
                                                    $totalharga = $nominaltoken;
                                                    echo number_format($nominaltoken,0,',','.');
                                                    ?>
                                                </h2>
                                                <input type="hidden" id="txbnominaltoken" name="txbnominaltoken" value="<?php echo $nominaltoken;?>">
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>

                                </div>

                            </div>

                            <?php
                            if ($txbjenistagihan != "TOKENPLN") {
                                ?>

                                <div class="ibox-content"
                                     style="margin-top: 20px; padding-top: 10px; padding-bottom: 10px;">
                                    <h2>DETAIL TAGIHAN</h2>
                                </div>

                                <?php
                            }
                            ?>

                            <div class="ibox-content">

                                <?php
                                $user_data = $this->session->userdata;
                                if ($user_data['user_level'] == 0) {
                                    $saldo = $datasaldo->saldo;
                                }else{
                                    $saldo = $datasaldo[0]->saldo;
                                }
                                ?>

                                <input type="hidden" value="<?php echo $saldo ?>" name="txbsaldosekarang" id="txbsaldosekarang">

                                <?php
                                if ($txbjenistagihan != "TOKENPLN") {
                                    ?>

                                    <div class="form-group">

                                        <div class="col-lg-9">
                                            <label>PERIODE</label>
                                        </div>
                                        <div class="col-lg-3 text-right">
                                            <h3>
                                                <?php
                                                $periode = $data_tagihan->data->periode;
                                                $bulan = bulan(substr($periode, -2));
                                                $tahun = substr($periode, 0, 4);
                                                echo $bulan . ' ' . $tahun;
                                                ?>
                                            </h3>
                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-lg-9">
                                            <label>TAGIHAN</label>
                                        </div>
                                        <div class="col-lg-3 text-right">
                                            <h3><?php echo rupiah($tagihan); ?></h3>
                                        </div>

                                    </div>


                                    <div class="form-group">

                                        <div class="col-lg-9">
                                            <label>BIAYA ADMIN</label>
                                        </div>
                                        <div class="col-lg-3 text-right">
                                            <h3><?php echo rupiah($biayaadmin); ?></h3>
                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-lg-9">
                                            <label>TOTAL PEMBAYARAN</label>
                                        </div>
                                        <div class="col-lg-3 text-right">
                                            <h3 style="color: #ed5565">
                                                <?php
                                                $totalharga = $tagihan + $biayaadmin;
                                                echo rupiah($totalharga);
                                                ?>
                                            </h3>
                                        </div>

                                    </div>

                                    <?php
                                }
                                ?>

                                <input type="hidden" value="<?php echo $totalharga ?>" name="txbnominal"
                                       id="txbnominal">


                                <div class="form-group">

                                    <input type="hidden" value="<?php echo $txbjenistagihan ?>" name="txbjenistagihan" id="txbjenistagihan">
                                    <input type="hidden" value="<?php echo $txbtab ?>" name="txbtab" id="txbtab">
                                    <input type="hidden" value="<?php echo $nomorpelanggan ?>" name="txbnomorpelanggan" id="txbnomorpelanggan">
                                    <input type="hidden" value="<?php echo $param['produk'] ?>" name="txbproduk" id="txbproduk">

                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-danger" style="width: 100%; margin-top: 30px;"
                                                onclick="checkoutppob()">BAYAR
                                        </button>
                                    </div>

                                </div>

                            </div>

                        </form>

                        <?php

                }else{
                    ?>

                    <div class="ibox-content" style="padding-bottom: 5px; padding-top: 15px;">

                        <div class="row">
                            <text class="col-lg-2 control-label">Nomor</text>
                            <h2 class="col-lg-10">
                                <?php echo $nomorpelanggan ?>
                            </h2>
                        </div>
                        <div class="alert alert-warning alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?php
                            if($data_tagihan->errorMsg == ''){
                                echo 'Error, Ada kesalahan pada API';
                            }else{
                                echo $data_tagihan->errorMsg;
                            }
                            ?>
                        </div>

                    </div>

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
