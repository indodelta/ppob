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
            <li class="active">
                <strong>PPOB</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->

<div class="wrapper wrapper-content animated fadeInRight article" style="margin-top: 10px;">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">

            <h2>
                <i class="fa fa-file-text-o" style="font-size:1.5em;margin-right:8px;color: <?php echo $warna_lembaga ?>;"></i>
                <span style="color: <?php echo $warna_lembaga ?>">PPOB Online</span>
            </h2>
            <div class="ibox float-e-margins" >
                <div class="ibox-content">

                    <input type="hidden" id="txbtambahdataberhasil" value="<?php echo $this->session->flashdata('tambahdataberhasil') ?>">

                    <?php
                    if($this->session->flashdata('tambahdataberhasil')){
                        $textsession = $this->session->flashdata('tambahdataberhasil');
                        $split = explode(',', $textsession);
                        $jenistagihan = $split[0];
                        $idtrans = $split[1];
                        $nopelanggan = $split[2];
                        $namaproduk = $split[3];
                        $iddepo = $split[4];
                        ?>

                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Berhasil, Anda telah melakukan transaksi <?php echo $namaproduk?> untuk nomor pelanggan <?php echo $nopelanggan;?>,
                            Anda dapat melihat transaksi di laporan transaksi dengan id <?php echo $idtrans; ?> dan mutasi deposit di laporan mutasi deposit dengan id <?php echo $iddepo; ?><br/>
                            <?php
                                if($tab=="4"){
                                    echo '<b>Serial Number Voucher Game akan dikirim via SMS ke NO HP yang telah dimasukkan.</b>';
                                }

                                if($jenistagihan=="TOKENPLN"){
                                    $sntoken = $split[5];
                                    echo '<b>Serial Number Tokennya adalah '.$sntoken.'</b>';
                                }
                            ?>
                        </div>

                    <?php } ?>

                    <input type="hidden" id="warnalembaga" value="<?php echo $warna_lembaga?>">
                    <?php
                    if($this->session->userdata('user_level') == 0){
                        $saldo = $datasaldo->saldo;
                    }else{
                        $saldo = $datasaldo[0]->saldo;
                    }
                    ?>
                    <input type="hidden" id="saldosekarang" value="<?php echo $saldo ?>">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="<?php if ($tab=="1") { echo " active"; } ?>" id="liTab1">
                                <a data-toggle="tab" href="#tab-1" class="text-center">
                                    <i class="fa fa-mobile-phone" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                    <br/> <span style="color: <?php echo $warna_lembaga; ?>">Pasca Bayar</span>
                                </a>
                            </li>
                            <li class="<?php if ($tab=="2") { echo " active"; } ?>" id="liTab2">
                                <a data-toggle="tab" href="#tab-2" class="text-center">
                                    <i class="fa fa-lightbulb-o" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                    <br/> <span style="color: <?php echo $warna_lembaga; ?>">Listrik PLN</span>
                                </a>
                            </li>
                            <li class="<?php if ($tab=="3") { echo " active"; } ?>" id="liTab3">
                                <a data-toggle="tab" href="#tab-3" class="text-center">
                                    <i class="fa fa-tint" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                    <br/> <span style="color: <?php echo $warna_lembaga; ?>">Air PDAM</span>
                                </a>
                            </li>
                            <li class="<?php if ($tab=="4") { echo " active"; } ?>" id="liTab4">
                                <a data-toggle="tab" href="#tab-4" class="text-center">
                                    <i class="fa fa-gamepad" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                    <br/> <span style="color: <?php echo $warna_lembaga; ?>">Vou. Game</span>
                                </a>
                            </li>
                            <li class="<?php if ($tab=="5") { echo " active"; } ?>" id="liTab5">
                                <a data-toggle="tab" href="#tab-5" class="text-center">
                                    <i class="fa fa-phone" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                    <br/> <span style="color: <?php echo $warna_lembaga; ?>">TELKOM</span>
                                </a>
                            </li>
                            <li class="<?php if ($tab=="6") { echo " active"; } ?>" id="liTab6">
                                <a data-toggle="tab" href="#tab-6" class="text-center">
                                    <i class="fa fa-fire" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                    <br/> <span style="color: <?php echo $warna_lembaga; ?>">Gas PGN</span>
                                </a>
                            </li>
                            <li class="<?php if ($tab=="7") { echo " active"; } ?>" id="liTab7">
                                <a data-toggle="tab" href="#tab-7" class="text-center">
                                    <i class="fa fa-video-camera" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                    <br/> <span style="color: <?php echo $warna_lembaga; ?>">TV Kabel</span>
                                </a>
                            </li>
                            <li class="<?php if ($tab=="8") { echo " active"; } ?>">
                                <a data-toggle="tab" href="#tab-8" class="text-center" id="liTab8">
                                    <i class="fa fa-money" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                    <br/> <span style="color: <?php echo $warna_lembaga; ?>">Asuransi & Fin</span>
                                </a>
                            </li>
                            <li class="<?php if ($tab>="9") { echo " active"; } ?>" id="liTabakhir">
                                <a data-toggle="tab" href="#tab-9" class="text-center">
                                    <?php
                                        if($tab =="10"){
                                            ?>
                                            <i class="fa fa-handshake-o fa-3x" id="iconTabakhir" style="color: <?php echo $warna_lembaga; ?>;"></i>
                                            <br/>
                                            <span id="textTabakhir" class="textTabakhir" style="color: <?php echo $warna_lembaga; ?>">
                                                Zakat
                                            </span>
                                            <?php
                                        }
                                        else if($tab =="9"){
                                            ?>
                                            <i class="fa fa-cc fa-3x" id="iconTabakhir" style="color: <?php echo $warna_lembaga; ?>;"></i>
                                            <br/>
                                            <span id="textTabakhir" class="textTabakhir" style="color: <?php echo $warna_lembaga; ?>">
                                                Kartu Kredit
                                            </span>
                                            <?php
                                        }else{
                                            ?>
                                            <i class="fa fa-road fa-3x" id="iconTabakhir" style="color: <?php echo $warna_lembaga; ?>;"></i>
                                            <br/>
                                            <span id="textTabakhir" class="textTabakhir" style="color: <?php echo $warna_lembaga; ?>">
                                                E-Money & Toll
                                            </span>
                                            <?php
                                        }
                                    ?>
                                </a>
                            </li>
                            <li class="<?php if ($tab=="10") { echo " active"; } ?>">
                                <a data-toggle="modal" href="#modal-lainnya" class="text-center" style="background-color: <?php echo $warna_lembaga;?>">
                                    <i class="fa fa-ellipsis-v fa-3x" style="color: white;"></i>
                                    <br/> <span style="color: white">Lainnya</span>
                                </a>
                            </li>
                        </ul>

                        <div class="modal modal-lainnya" id="modal-lainnya" tabindex="-1" role="dialog"  aria-hidden="true">

                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header text-center">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h2>Produk Lainnya</h2>
                                    </div>
                                    <div class="modal-body">

                                        <form class="form-horizontal">

                                            <div class="table-responsive">

                                                <table class="table no-borders">

                                                    <tr class="no-borders no-padding no-margins">
                                                        <td class="no-borders no-padding no-margins" >
                                                            <button type="button" id="btnzakat" class="btn btn-outline btn-danger" style="width: 100px;" onclick="pilihemoney()">
                                                                <i class="fa fa-road fa-3x"></i>
                                                                <br/>
                                                                <span>
                                                                E-Money
                                                            </span>
                                                            </button>
                                                            <button type="button" id="btnkartukredit" class="btn btn-outline btn-danger" style="width: 100px;" onclick="pilihkartukredit()">
                                                                <i class="fa fa-cc fa-3x"></i>
                                                                <br/>
                                                                <span>
                                                                Kartu Kredit
                                                            </span>
                                                            </button>
                                                            <button type="button" id="btnzakat" class="btn btn-outline btn-danger" style="width: 100px;" onclick="pilihzakat()">
                                                                <i class="fa fa-handshake-o fa-3x"></i>
                                                                <br/>
                                                                <span>
                                                                Zakat
                                                            </span>
                                                            </button>
                                                        </td>
                                                    </tr>

                                                </table>

                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-content">

                            <div id="tab-1" class="tab-pane<?php if ($tab=="1") { echo " active"; } ?>">
                                <div class="panel-body">
                                    <h3 style="color: <?php echo $warna_lembaga;?>">Tagihan Pasca Bayar</h3>
                                    <hr>
                                    <div id="formPascabayar">

                                    </div>

                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane<?php if ($tab=="2") { echo " active"; } ?>">
                                <div class="panel-body">
                                    <h3 style="color: <?php echo $warna_lembaga;?>">Beli Token atau Bayar Tagihan Listrik</h3>
                                    <hr>
                                    <div id="formPLN">

                                    </div>
                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane<?php if ($tab=="3") { echo " active"; } ?>">
                                <div class="panel-body">
                                    <h3 style="color: <?php echo $warna_lembaga;?>">Bayar Tagihan Air</h3>
                                    <hr>
                                    <div id="formPDAM">
                                    </div>

                                </div>
                            </div>
                            <div id="tab-4" class="tab-pane<?php if ($tab=="4") { echo " active"; } ?>">
                                <div class="panel-body">
                                    <h3 style="color: <?php echo $warna_lembaga;?>">Beli Voucher Game</h3>
                                    <hr>
                                    <div id="formGameOnline">
                                    </div>

                                </div>
                            </div>
                            <div id="tab-5" class="tab-pane<?php if ($tab=="5") { echo " active"; } ?>">
                                <div class="panel-body">
                                    <h3 style="color: <?php echo $warna_lembaga;?>">Bayar Tagihan TELKOM</h3>
                                    <hr>
                                    <div id="formTELKOM">
                                    </div>

                                </div>
                            </div>
                            <div id="tab-6" class="tab-pane<?php if ($tab=="6") { echo " active"; } ?>">
                                <div class="panel-body">
                                    <h3 style="color: <?php echo $warna_lembaga;?>">Bayar Tagihan GAS</h3>
                                    <hr>
                                    <div id="formPGN">
                                    </div>

                                </div>
                            </div>
                            <div id="tab-7" class="tab-pane<?php if ($tab=="7") { echo " active"; } ?>">
                                <div class="panel-body">
                                    <h3 style="color: <?php echo $warna_lembaga;?>">Bayar Tagihan TV Kabel</h3>
                                    <hr>
                                    <div id="formTVKabel">
                                    </div>

                                </div>
                            </div>
                            <div id="tab-8" class="tab-pane<?php if ($tab=="8") { echo " active"; } ?>">
                                <div class="panel-body">
                                    <h3 style="color: <?php echo $warna_lembaga;?>">Bayar Asuransi / Finance</h3>
                                    <hr>
                                    <div id="formAngsKredit">
                                    </div>

                                </div>
                            </div>
                            <div id="tab-9" class="tab-pane<?php if ($tab>="9") { echo " active"; } ?>">
                                <div class="panel-body">
                                    <h3 id="h3Tabakhir" class="h3Tabakhir" style="color: <?php echo $warna_lembaga; ?>">
                                        <?php
                                        if($tab =="10"){
                                            ?>
                                            Bayar Zakat
                                            <?php
                                        }
                                        elseif($tab =="9"){
                                            ?>
                                            Bayar Kartu Kredit
                                            <?php
                                        }else{
                                            ?>
                                            Bayar E-Money
                                            <?php
                                        }
                                        ?>
                                    </h3>
                                    <hr>

                                    <?php
                                    if($tab =="10"){
                                        ?>
                                        <div id="formZakat">formzakat</div>
                                        <div id="formKartuKredit" style="display: none;">formkartukredit</div>
                                        <div id="formEMoney" style="display: none;"></div>
                                        <?php
                                    }
                                    else if($tab =="9"){
                                        ?>
                                        <div id="formKartuKredit">formkartukredit</div>
                                        <div id="formZakat" style="display: none;">formzakat</div>
                                        <div id="formEMoney" style="display: none;"></div>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <div id="formEMoney"></div>
                                        <div id="formZakat" style="display: none;">formzakat</div>
                                        <div id="formKartuKredit" style="display: none;">formkartukredit</div>
                                        <?php
                                    }
                                    ?>


                                </div>
                            </div>


                        </div>
                    </div>


                </div>
            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>
</div>

<!-- /content -->


</div>
