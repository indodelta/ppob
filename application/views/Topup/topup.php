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
                <strong>Top Up Saldo</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->

<div class="wrapper wrapper-content animated fadeInRight article" style="margin-top: 10px;">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">

            <?php $this->load->view('func_custom'); ?>

            <h2>
                <i class="fa fa-download" style="font-size:1.5em;margin-right:8px;color: <?php echo $warna_lembaga ?>;"></i>
                <span style="color: <?php echo $warna_lembaga ?>">Top Up Saldo</span>
            </h2>
            <div class="ibox float-e-margins" >

                <?php
                if($this->session->flashdata('error')){
                    $error = $this->session->flashdata('error');
                    ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        Terjadi kesalahan pada topup anda dengan rincian : <br/>
                        <?php echo $error; ?><br/>
                        Silahkan ulangi kembali proses topup anda.
                    </div>
                <?php } ?>

                <div class="ibox-content">

                    <form class="form-horizontal" id="formtopup" method="post" action="Topup/topup" autocomplete="off" onsubmit="return confirm('Apakah data sudah terisi dengan benar?');">

                        <div class="form-group">
                            <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>">
                                Metode Top Up
                            </label>
                            <div class="col-lg-9">
                                <select class="form-control" name="slmetode" style="font-size: 16px;">
                                    <option value="02">Virtual Account Bank</option>
                                    <option value="01">Kartu Kredit</option>
                                    <option value="03">Convencience Store</option>
                                    <option value="04">ClickPay</option>
                                    <option value="05">E-Wallet</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>">Nominal
                                Topup </label>
                            <div class="col-lg-9">
                                <select class="form-control" name="slnominal" style="font-size: 16px;">
                                    <option value="10000">10.000</option>
                                    <option value="20000">20.000</option>
                                    <option value="50000">50.000</option>
                                    <option value="100000">100.000</option>
                                    <option value="500000">500.000</option>
                                    <option value="1000000">1.000.000</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <button
                                    class="ladda-button btn btn-danger"
                                    type="submit"
                                    data-style="zoom-in"
                                    style="display: block; width: 100%;">Lanjutkan
                            </button>
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
