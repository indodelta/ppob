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

            <h2>
                <i class="fa fa-building" style="font-size:1.5em;margin-right:8px;color: <?php echo $warna_lembaga ?>;"></i>
                <span style="color: <?php echo $warna_lembaga ?>">Tambah Lembaga</span>
            </h2>
            <div class="ibox float-e-margins" >
                <div class="ibox-content">

                    <form class="form-horizontal" method="post" autocomplete="off" id="formsaveuser">

                        <input type="hidden" class="form-control" id="txbwarnalembaga" value="<?php echo $warna_lembaga?>">

                        <div class="form-group">

                            <h3 class="col-lg-12" style="margin-bottom: 10px;">DATA LEMBAGA</h3>
                            <hr style="border: solid 1px;"/>

                            <label class="control-label col-lg-3" style="margin-bottom: 10px;">Nama Lembaga <span style="color:#ed5565">*</span></label>

                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="txbnamalembaga" name="txbnamalembaga" required>
                            </div>

                        </div>
                        <div class="form-group">

                            <label class="control-label col-lg-3" style="margin-bottom: 10px;">URL Lembaga <span style="color:#ed5565">*</span></label>

                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="txburllembaga" name="txburllembaga" required>
                                <span class="help-block m-b-none">Contoh: klik.365pay.id</span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3" style="margin-bottom: 10px;">Logo <span style="color:#ed5565">*</span></label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                            Browse… <input type="file" name="imgInp" id="imgInp" class="imgInp">
                                        </span>
                                    </span>
                                    <input type="text" class="form-control" id="txbNameimg" name="txbNameimg" readonly>
                                </div>
                                <span class="help-block m-b-none">
                                    Max Size 1000kb/1mb, Files => .jpg .png .gif
                                </span>
                            </div>
                            <img id='img-upload'/>
                        </div>
                        <div class="form-group">

                            <h3 class="col-lg-12" style="margin-bottom: 10px;">DATA API</h3>
                            <hr style="border: solid 1px;"/>

                            <label class="control-label col-lg-3" style="margin-bottom: 10px;">API Userkey <span style="color:#ed5565">*</span></label>

                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="txbapiuserkey" name="txbapiuserkey" required>
                            </div>

                        </div>
                        <div class="form-group">

                            <label class="control-label col-lg-3" style="margin-bottom: 10px;">API Passkey <span style="color:#ed5565">*</span></label>

                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="txbapipasskey" name="txbapipasskey" required>
                            </div>

                        </div>

                        <div class="form-group">

                            <h3 class="col-lg-12" style="margin-bottom: 10px;">SETTING APLIKASI</h3>
                            <hr style="border: solid 1px;"/>

                        </div>


                        <div class="form-group">
                            <button type="button" class="btn btn-danger pull-right" onclick="saveUser()"><i class="fa fa-save"> </i> SAVE</button>
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
