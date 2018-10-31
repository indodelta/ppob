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
        <div class="col-lg-4"></div>
        <div class="col-lg-4">

            <?php $this->load->view('func_custom'); ?>

            <h2>
                <i class="fa fa-money" style="font-size:1.5em;margin-right:8px;color: <?php echo $warna_lembaga ?>;"></i>
                <span style="color: <?php echo $warna_lembaga ?>">Top Up Saldo</span>
            </h2>
            <div class="ibox float-e-margins" >

                <form class="form-horizontal" id="formtopupsaldo" method="post" autocomplete="off">

                    <input type="hidden" class="form-control" id="txbwarnalembaga" value="<?php echo $warna_lembaga?>">

                    <div class="ibox-content" style="padding-bottom: 5px; padding-top: 15px;">

                        <div class="form-group">

                            <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">Sisa
                                Saldo </label>
                            <h2 class="col-lg-9">
                                <?php
                                if($this->session->userdata('user_level') == 0){
                                    $saldo = $datasaldo->saldo;
                                }else{
                                    $saldo = $datasaldo[0]->saldo;
                                }
                                $rupiah = "Rp " . number_format($saldo, 0, ',', '.');
                                echo $rupiah;
                                ?>
                            </h2>

                        </div>
                        <div class="form-group">

                            <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">Metode
                                Top Up </label>
                            <div class="col-lg-9">
                                <select id="metodepopup" class="form-control m-b" name="metodetopup" required
                                        onchange="pilihmetode()">
                                    <option value="-">- Pilih Metode Top Up -</option>
                                    <option value="transferbanka">Transfer ke Bank A</option>
                                    <option value="transferbankb">Transfer ke Bank B</option>
                                    <option value="transferbankc">Transfer ke Bank C</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group" id="norekeningtujuanbanka" style="display: none;">

                            <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">Rek.
                                Tujuan </label>
                            <h3 class="col-lg-9">A-11111111-11 a/n Head Bank A</h3>

                        </div>
                        <div class="form-group" id="norekeningtujuanbankb" style="display: none;">

                            <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">Rek.
                                Tujuan </label>
                            <h3 class="col-lg-9">B-11111111-11 a/n Head Bank B</h3>

                        </div>
                        <div class="form-group" id="norekeningtujuanbankc" style="display: none;">

                            <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">Rek.
                                Tujuan </label>
                            <h3 class="col-lg-9">C-11111111-11 a/n Head Bank C</h3>

                        </div>

                        <input type="hidden" id="txbbankrekeningtujuan" name="txbbankrekeningtujuan">
                        <input type="hidden" id="txbnorekeningtujuan" name="txbnorekeningtujuan">
                        <input type="hidden" id="txbanrekeningtujuan" name="txbanrekeningtujuan">

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
                                    type="button"
                                    style="display: block; width: 100%;"
                                    onclick="btntopupsaldo()">Lanjutkan
                            </button>
                        </div>

                    </div>

                </form>

            </div>

        </div>
        <div class="col-lg-4"></div>
    </div>
</div>

<!-- /content -->


</div>
