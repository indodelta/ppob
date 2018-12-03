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
                <a href="<?php echo base_url('admin/lembaga')?>">Lembaga</a>
            </li>
            <li class="active">
                <strong>Tambah</strong>
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

            <?php
            if($this->session->flashdata('error')){ ?>

                <div class="alert alert-warning alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>

            <?php } ?>

            <h2>
                <i class="fa fa-building" style="font-size:1.5em;margin-right:8px;color: <?php echo $warna_lembaga ?>;"></i>
                <span style="color: <?php echo $warna_lembaga ?>">Tambah Lembaga</span>
            </h2>
            <div class="ibox float-e-margins" >
                <div class="ibox-content">

                    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="simpan" autocomplete="off" id="formtambahlembaga" onsubmit="return confirm('Apakah data sudah terisi dengan benar?');">

                        <input type="hidden" class="form-control" id="txbwarnalembaga" value="<?php echo $warna_lembaga?>">

                        <h3 class="col-lg-12" style="margin-bottom: 10px;">DATA LEMBAGA</h3>
                        <hr style="border: solid 1px;"/>

                        <div class="form-group">

                            <label class="control-label col-lg-3" style="margin-bottom: 10px;">Nama Lembaga <span style="color:#ed5565">*</span></label>

                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="txbnamalembaga" name="txbnamalembaga" required>
                            </div>

                        </div>
                        <div class="form-group">

                            <label class="control-label col-lg-3 col-sm-2" style="margin-bottom: 10px;">URL Lembaga <span style="color:#ed5565">*</span></label>

                            <div class="col-lg-3 col-sm-4">
                                <input type="text" class="form-control" id="txburllembaga" name="txburllembaga" required>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <select class="form-control" name="sldomainlembaga" required>
                                    <?php
                                    for ($x = 0; $x < count($data_domain); $x++) {
                                        $domain = $data_domain[$x]->domain;
                                        ?>
                                        <option value="<?php echo $domain; ?>">.<?php echo $domain; ?></option>
                                        <?php
                                    };
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3" style="margin-bottom: 10px;">Logo <span style="color:#ed5565">*</span></label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                            Browse… <input type="file" name="imgInp" id="imgInp" class="imgInp" required>
                                        </span>
                                    </span>
                                    <input type="text" class="form-control" id="txbNameimg" name="txbNameimg" readonly>
                                </div>
                                <span class="help-block m-b-none">
                                    Max Size 1000kb/1mb, Files => .jpg .png .gif
                                </span>
                                <img id='img-upload' style="max-height: 100px; max-width: 100px;"/>
                            </div>
                        </div>

<!--                        <h3 class="col-lg-12" style="margin-bottom: 10px;">DATA API</h3>-->
<!--                        <hr style="border: solid 1px;"/>-->
<!---->
<!--                        <div class="form-group">-->
<!---->
<!--                            <label class="control-label col-lg-3" style="margin-bottom: 10px;">API Userkey <span style="color:#ed5565">*</span></label>-->
<!---->
<!--                            <div class="col-lg-9">-->
<!--                                <input type="text" class="form-control" id="txbapiuserkey" name="txbapiuserkey" required>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!---->
<!--                            <label class="control-label col-lg-3" style="margin-bottom: 10px;">API Passkey <span style="color:#ed5565">*</span></label>-->
<!---->
<!--                            <div class="col-lg-9">-->
<!--                                <input type="text" class="form-control" id="txbapipasskey" name="txbapipasskey" required>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->

                        <h3 class="col-lg-12" style="margin-bottom: 10px;">SETTING APLIKASI</h3>
                        <hr style="border: solid 1px;"/>

                        <div class="form-group">
                            <div class="i-checks" style="margin-left: 10px;">
                                <label>
                                    <input type="radio" value="tampilan1" name="tampilan" id="icheckstampilan" checked> <i></i> Tampilan 1
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <img alt="Tampilan Login Red" src="<?php echo base_url('assets/img/template/red.png');?>" style="width: 100%; height: 30%;" />
                            </div>
                            <div class="col-sm-6">
                                <img alt="Tampilan Dashboard Red" src="<?php echo base_url('assets/img/template/red2.png');?>" style="width: 100%; height: 30%;" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="i-checks" style="margin-left: 10px;">
                                <label>
                                    <input type="radio" value="tampilan2" name="tampilan" id="icheckstampilan"> <i></i> Tampilan 2
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <img alt="Tampilan Login Blue" src="<?php echo base_url('assets/img/template/blue.png');?>" style="width: 100%; height: 30%;" />
                            </div>
                            <div class="col-sm-6">
                                <img alt="Tampilan Dashboard Blue" src="<?php echo base_url('assets/img/template/blue2.png');?>" style="width: 100%; height: 30%;" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="i-checks" style="margin-left: 10px;">
                                <label>
                                    <input type="radio" value="tampilan3" name="tampilan" id="icheckstampilan"> <i></i> Tampilan 3
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <img alt="Tampilan Login Yellow Green" src="<?php echo base_url('assets/img/template/yellow.png');?>" style="width: 100%; height: 30%;" />
                            </div>
                            <div class="col-sm-6">
                                <img alt="Tampilan Dashboard Yellow Green" src="<?php echo base_url('assets/img/template/yellowgreen.png');?>" style="width: 100%; height: 30%;" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="i-checks" style="margin-left: 10px;">
                                <label>
                                    <input type="radio" value="tampilan4" name="tampilan" id="icheckstampilan"> <i></i> Tampilan 4
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <img alt="Tampilan Login Yellow Purple" src="<?php echo base_url('assets/img/template/yellow2.png');?>" style="width: 100%; height: 30%;" />
                            </div>
                            <div class="col-sm-6">
                                <img alt="Tampilan Dashboard Yellow Purple" src="<?php echo base_url('assets/img/template/yellowpurple.png');?>" style="width: 100%; height: 30%;" />
                            </div>
                        </div>

                        <hr style="border: solid 1px;"/>

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-save"> </i> Tambah Data Lembaga</button>
                        </div>

                    </form>

                </div>
            </div>


        </div>
        <div class="col-lg-2"></div>
    </div>
</div>

<!-- /content -->


</div>
