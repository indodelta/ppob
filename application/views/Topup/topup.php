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
        <div class="col-lg-3"></div>
        <div class="col-lg-6">

            <?php $this->load->view('func_custom'); ?>

            <h2>
                <i class="fa fa-download" style="font-size:1.5em;margin-right:8px;color: <?php echo $warna_lembaga ?>;"></i>
                <span style="color: <?php echo $warna_lembaga ?>">Top Up Saldo</span>
            </h2>
            <div class="ibox float-e-margins" >

                <div class="ibox-content">

                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active" id="liTab1">
                                <a data-toggle="tab" href="#tab-1" class="text-center">
                                    <i class="fa fa-cc" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                    <span style="color: <?php echo $warna_lembaga; ?>">Kartu Kredit</span>
                                </a>
                            </li>
                            <li id="liTab2">
                                <a data-toggle="tab" href="#tab-2" class="text-center">
                                    <i class="fa fa-bank" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                    <span style="color: <?php echo $warna_lembaga; ?>">Bank</span>
                                </a>
                            </li>
                            <li id="liTab3">
                                <a data-toggle="tab" href="#tab-3" class="text-center">
                                    <i class="fa fa-building" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                    <span style="color: <?php echo $warna_lembaga; ?>">Convenience Store</span>
                                </a>
                            </li>
                            <li id="liTab4">
                                <a data-toggle="tab" href="#tab-4" class="text-center">
                                    <i class="fa fa-money" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                    <span style="color: <?php echo $warna_lembaga; ?>">ClickPay</span>
                                </a>
                            </li>
                            <li id="liTab5">
                                <a data-toggle="tab" href="#tab-5" class="text-center">
                                    <i class="fa fa-google-wallet" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                    <span style="color: <?php echo $warna_lembaga; ?>">E-Wallet</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">

                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">

                                <form class="form-horizontal" id="formtopupcc" method="post" action="Topup/topupcc" autocomplete="off">

                                    <div class="form-group">

                                        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>">Nominal
                                            Topup </label>
                                        <div class="col-lg-9">
                                            <input type="text"
                                                   id="txbnominaltopup"
                                                   name="txbnominaltopup"
                                                   class="form-control"
                                                   placeholder="EX: 50000"
                                                   style="font-size: 16px; border: none; border-bottom: solid 1px darkslategray;"
                                                   onkeyup="formatangka()"
                                                   required/>
                                            <input type="hidden" id="txbnominal" name="txbnominal">

                                        </div>

                                    </div>

                                    <div class="form-group" style="margin-top: 40px;">
                                        <?php
                                        $user_data = $this->session->userdata;
                                        $fullname = $user_data['fullname'];
                                        ?>
                                        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>">Nama
                                            Pengirim </label>
                                        <div class="col-lg-9">
                                            <input type="text"
                                                   id="txbnamapengirim"
                                                   name="txbnamapengirim"
                                                   class="form-control"
                                                   placeholder="<?php echo $fullname ?>"
                                                   style="font-size: 16px; border: none; border-bottom: solid 1px darkslategray;"
                                                   required/>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <button
                                            class="btn btn-danger"
                                            type="submit"
                                            style="display: block; width: 100%;">Lanjutkan
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">

                                <div id="formPascabayar">

                                </div>

                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane">
                            <div class="panel-body">

                                <div id="formPascabayar">

                                </div>

                            </div>
                        </div>
                        <div id="tab-4" class="tab-pane">
                            <div class="panel-body">

                                <div id="formPascabayar">

                                </div>

                            </div>
                        </div>
                        <div id="tab-5" class="tab-pane">
                            <div class="panel-body">

                                <div id="formPascabayar">

                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="col-lg-3"></div>
    </div>
</div>

<!-- /content -->


</div>
