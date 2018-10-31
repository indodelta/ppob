<?php
$nama_lembaga = $this->config->item("nama_lembaga"); $logo_lembaga = $this->config->item("logo_lembaga");
$css_lembaga = $this->config->item("css_lembaga"); $warna_lembaga = $this->config->item("warna_lembaga");
if (sizeof($data_lembaga)>0) {
    $nama_lembaga = $data_lembaga[0]["nama"];
    $logo_lembaga = $data_lembaga[0]["logo"];
    $css_lembaga = $data_lembaga[0]["css"];
    $warna_lembaga = $data_lembaga[0]["warna"];
}

$this->load->view('func_custom');
?>

<div class="row wrapper border-bottom white-bg page-heading"
     style="position: fixed; z-index: 1; width: 100%">
    <div class="col-lg-10">
        <ol class="breadcrumb" style="padding-top: 60px;">
            <li>
                <a href="<?php echo base_url('dashboard')?>">Home</a>
            </li>
            <li class="active">
                <strong>Pesan Tiket Pesawat</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<!-- Content -->

<div class="wrapper wrapper-content  animated fadeInRight article" style="margin-top: 100px;">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <h2>
                <i class="fa fa-plane" style="font-size:1em;margin-right:10px;color: <?php echo $warna_lembaga; ?>;"></i>
                <span style="color: <?php echo $warna_lembaga; ?>">Booking Pesawat</span>
            </h2>
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <!--                        --><?php //echo $this->session->userdata('tokenft') ?>
                    <form id="formpesantiket" class="form-horizontal" method="post" action="flight/cari_jadwal" target="_blank" autocomplete="off">
                        <div class="form-group">
                            <div class="col-lg-2">
                                <div class="i-checks-pesawat">
                                    <label> <input type="checkbox" name="cekreturn" class="cekreturn" id="cekreturn"> <i></i> <span style="color: <?php echo $warna_lembaga; ?>;">Pulang Pergi</span></label>
                                </div>
                                <input type="hidden" id="page" value="pesawat">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-lg-4">
                                <label><i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;padding-right:5px;"></i> <span style="color: <?php echo $warna_lembaga; ?>;">FROM</span></label>
                                <input
                                    id="air_from"
                                    name="air_from"
                                    type="text"
                                    placeholder="Airport..."
                                    class="form-control air_from"
                                    onclick="clearairfrom()"
                                    required/>
                                <br/>
                                <div class="tukar_airport" style="position: relative; cursor:pointer; margin-top: 7px;" onclick="tukar_airport()">
                                        <span class="fa-stack fa-lg" style="position:absolute;bottom:-20px;right:16px;width:55px;">
                                        <i class="fa fa-circle fa-stack-2x" style="color:<?php echo $warna_lembaga; ?>;"></i>
                                        <i class="fa fa-exchange fa-stack-1x fa-inverse fa-rotate-90"></i>
                                        </span>
                                </div>
                                <br>
                                <label><i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>;padding-right:5px;"></i> <span style="color: <?php echo $warna_lembaga; ?>;">TO</span></label>
                                <input id="air_to" name="air_to" type="text" placeholder="Airport..." class="form-control air_to" onclick="clearairto()" required/>
                            </div>

                            <div class="col-lg-4">
                                <div id="tanggalpergi">
                                    <label style="color: <?php echo $warna_lembaga; ?>;"> Pergi</label>
                                    <div class="input-group date">
                                        <?php $today = date("d/m/Y"); ?>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input id="dppergi" name="tglpergi" type="text" class="form-control" value="<?php echo $today?>" onchange="ubahtglpergi()" required>
                                    </div>
                                </div>
                                <br/><br/>
                                <div id="tanggalpulang" style="margin-top: 7px; display: none;">
                                    <label style="color: <?php echo $warna_lembaga; ?>;"> Pulang</label>
                                    <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        <input id="dppulangenable" name="tglpulang" type="text" class="form-control" value="<?php echo $today?>" required>
                                    </div>
                                </div>
                                <div id="tanggalpulangdisable" style="margin-top: 7px;">
                                    <label style="color: <?php echo $warna_lembaga; ?>;"> Pulang</label>
                                    <div class="input-group date">
                                            <span class="input-group-addon"style="cursor: not-allowed; color: #c2c2c2 !important;">
                                                <i class="fa fa-calendar" style="cursor: not-allowed;"></i>
                                            </span>
                                        <input id="dppulangdisable" name="tglpulang" type="text" class="form-control" value="<?php echo $today?>" disabled required>
                                    </div>
                                </div>
                            </div>

                            <label class="col-lg-2 control-label" style="color: <?php echo $warna_lembaga; ?>; margin-top: 20px;">ADULT ( > 12 Years)</label>
                            <div class="col-lg-2">
                                <input id="jml_adult" name="jml_adult" type="number" class="form-control text-right" value="1" min="1" style="margin-top: 20px;" required/>
                            </div>
                            <label class="col-lg-2 control-label" style="color: <?php echo $warna_lembaga; ?>; margin-top: 20px;">CHILD ( 2 -12 Years)</label>
                            <div class="col-lg-2">
                                <input id="jml_child" name="jml_child" type="number" class="form-control text-right" value="0" min="0" style="margin-top: 20px;" required/>
                            </div>
                            <label class="col-lg-2 control-label" style="color: <?php echo $warna_lembaga; ?>; margin-top: 15px;">INFANT (0 - 2 Years)</label>
                            <div class="col-lg-2">
                                <input id="jml_infant" name="jml_infant" type="number" class="form-control text-right" value="0" min="0" style="margin-top: 15px;" required/>
                            </div>

                        </div>

                        <div class="form-group" style="margin-top: 50px;">
                            <div class="col-xs-8">
                                <label class="control-label" style="color: <?php echo $warna_lembaga;?>">Pilih Maskapai (Pencarian bisa lebih dari satu) :</label>
                                <?php
                                $disabled = '';

                                if ($airline != null){

                                    $jmlairline = count($airline->data->settings);

                                    ?>

                                    <table class="table no-borders">
                                        <tr class="no-borders">
                                            <?php
                                            $j=1;
                                            for ($i = 0; $i < $jmlairline; $i++) {
                                                if($airline->data->settings[$i]->isActive == 1) {
                                                    $airlineCode = $airline->data->settings[$i]->airline;
                                                    $airlineName = $airline->data->settings[$i]->airlineName;
                                                    $airlineIcon = $airline->data->settings[$i]->icon;

                                                    if (get_http_response_code($airlineIcon) != "200") {
                                                        $airlineIcon = base_url('assets/img/No_Image_Available.png');
                                                    }

                                                    ?>

                                                    <td class="no-borders">
                                                        <div class="i-checks-airline">
                                                            <input type="checkbox"
                                                                   name="airline[]"
                                                                   value="<?php echo $airlineCode ?>"
                                                                   class="airline"
                                                                <?php if($i==0) echo 'checked';?>>
                                                            <img class="img-sm" src="<?php echo $airlineIcon; ?>" style="width: 70px;"><br/>
                                                            <span style="margin-left: 25px;"><?php echo $airlineName;?></span>
                                                        </div>
                                                    </td>

                                                    <?php

                                                    if (($j % 4) == 0){echo "</tr><tr class='no-borders'>";};
                                                    $j++;
                                                }
                                            }
                                            ?>
                                    </table>
                                    <?php
                                }else{
                                    $disabled = 'disabled';
                                    ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        Terjadi kesalahan API pada proses pemanggilan data airline.<br/>
                                        Mohon maaf, karena ini anda tidak bisa melakukan booking pesawat
                                    </div>
                                    <?php
                                }

                                ?>

                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-danger" type="submit" style="display: block; width: 100%;" <?php echo $disabled;?>>Cari Jadwal</button>
                            </div>
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
