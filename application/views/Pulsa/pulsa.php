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
        <h2>Basic Form</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url('dashboard')?>">Home</a>
            </li>
            <li class="active">
                <strong>Beli Pulsa</strong>
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

            <h2>
                <i class="fa fa-mobile-phone" style="font-size:1.5em;margin-right:8px;color: <?php echo $warna_lembaga; ?>;"></i>
                <span style="color: <?php echo $warna_lembaga; ?>">Isi Pulsa Dan Data</span>
            </h2>

            <div class="ibox float-e-margins" >
                <div class="ibox-content">

                    <input type="hidden" id="txbtambahpulsaberhasil" value="<?php echo $this->session->flashdata('tambahpulsaberhasil') ?>">
                    <input type="hidden" id="txbtambahdataberhasil" value="<?php echo $this->session->flashdata('tambahdataberhasil') ?>">

                    <?php
                    if($this->session->flashdata('tambahpulsaberhasil')){
                        $textsession = $this->session->flashdata('tambahpulsaberhasil');
                        $split = explode(',', $textsession);
                        $idtrans = $split[0];
                        $nopelanggan = $split[1];
                        $namaproduk = $split[2];
                        $iddepo = $split[3];
                        ?>

                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Berhasil, Anda telah menambahkan pulsa ke no <?php echo $nopelanggan; ?> dengan produk <?php echo $namaproduk ?>.<br/>
                            Anda dapat melihat transaksi di laporan transaksi dengan id <?php echo $idtrans; ?> dan mutasi deposit di laporan mutasi deposit dengan id <?php echo $iddepo; ?>
                        </div>

                    <?php } ?>

                    <?php
                    if($this->session->flashdata('tambahdataberhasil')){
                        $textsession = $this->session->flashdata('tambahdataberhasil');
                        $split = explode(',', $textsession);
                        $idtrans = $split[0];
                        $nopelanggan = $split[1];
                        $namaproduk = $split[2];
                        $iddepo = $split[3];
                        ?>

                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Berhasil, Anda telah menambahkan data ke no <?php echo $nopelanggan; ?> dengan produk <?php echo $namaproduk ?>.<br/>
                            Anda dapat melihat transaksi di laporan transaksi dengan id <?php echo $idtrans; ?> dan mutasi deposit di laporan mutasi deposit dengan id <?php echo $iddepo; ?>
                        </div>

                    <?php } ?>


                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> <i class="fa fa-money" style="color: <?php echo $warna_lembaga; ?>;font-size:1.5em;"></i> </a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2"> <i class="fa fa-tablet" style="color: <?php echo $warna_lembaga; ?>;font-size:1.5em;"></i> </a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">

                                    <h3 style="color: <?php echo $warna_lembaga; ?>">ISI PULSA</h3>
                                    <hr>
                                    <form class="form-horizontal" id="formpulsa" method="post" autocomplete="off">

                                        <?php
                                        $jumlahdataoperator = count($data_produk['datapulsa']->operator);

                                        ?>

                                        <input type="hidden" class="form-control" name="txbjenistagihan" value="PULSA">
                                        <input type="hidden" class="form-control" id="txbwarnalembaga" name="txbwarnalembaga" value="<?php echo $warna_lembaga; ?>">

                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <label class="control-label" style="color: <?php echo $warna_lembaga;?>">- Pilih Operator -</label>
                                                <select class="form-control m-b" id="operatorpulsa" name="operatorpulsa" onchange="pilihoperator()" required>
                                                    <option></option>
                                                    <?php
                                                    for ($i = 0; $i < $jumlahdataoperator; $i++) {
                                                        ?>
                                                        <option value="<?php echo $data_produk['datapulsa']->operator[$i]->opr_id;?>"><?php echo $data_produk['datapulsa']->operator[$i]->opr_nama;?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <label class="control-label" style="color: <?php echo $warna_lembaga;?>">- Pilih Nominal Pulsa -</label>
                                                <select class="form-control m-b" name="nominalpulsa" id="nominalpulsa" required>
                                                    <option></option>
                                                    <option> Anda belum memilih operator</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control" name="txbnomorpelanggan" id="nomorpelanggan" placeholder="Nomor HP Tujuan. Contoh: 0812345678" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <button class="btn btn-danger" type="button" style="width: 100%;" onclick="beliPulsa()">BELI PULSA</button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">

                                    <h3 style="color: <?php echo $warna_lembaga; ?>">ISI DATA</h3>
                                    <hr>
                                    <form class="form-horizontal" id="formdata" method="post" autocomplete="off">
                                        <input type="hidden" class="form-control" name="txbjenistagihan" value="DATA">

                                        <?php
                                        $jumlahdataoperator = count($data_produk['datadata']->operator);

                                        ?>

                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <label class="control-label" style="color: <?php echo $warna_lembaga;?>">- Pilih Operator -</label>
                                                <select class="form-control m-b" id="operatordata" name="operatordata" onchange="pilihoperatordata()">
                                                    <option></option>
                                                    <?php
                                                    for ($i = 0; $i < $jumlahdataoperator; $i++) {
                                                        ?>
                                                        <option value="<?php echo $data_produk['datadata']->operator[$i]->opr_id;?>"><?php echo $data_produk['datadata']->operator[$i]->opr_nama;?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <label class="control-label" style="color: <?php echo $warna_lembaga;?>">- Pilih Nominal Data -</label>
                                                <select class="form-control m-b" name="nominaldata" id="nominaldata">
                                                    <option></option>
                                                    <option> Anda belum memilih operator</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control" name="txbnomorpelanggan" id="nomorpelanggandata" placeholder="Nomor HP Tujuan. Contoh: 081234567890">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <button class="btn btn-danger" type="button" style="display: block; width: 100%;" onclick="beliData()">BELI PAKET DATA</button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <div class="col-lg-4"></div>
    </div>
</div>

<!-- /content -->


</div>
