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
        <ol class="breadcrumb" style="padding-top: 60px;">
            <li>
                <a href="<?php echo base_url('dashboard')?>">Home</a>
            </li>
            <li>
                <a href="<?php echo base_url('kereta')?>">Pesan Tiket Kereta Api</a>
            </li>
            <li class="active">
                <strong>Info Reservasi</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->

<div class="wrapper wrapper-content animated fadeInRight article">

    <?php
    $this->load->view('func_custom');

    $nmstfrom = $this->input->post('txbnmstfrom');
    $kdstfrom = $this->input->post('txbkdstfrom');
    $nmstto = $this->input->post('txbnmstto');
    $kdstto = $this->input->post('txbkdstto');
    $jmldewasa = $this->input->post('txbjmldewasa');
    $jmlbayi = $this->input->post('txbjmlbayi');

    $trainnamepergi = $this->input->post('txbtrainnamepergi');
    $trainnumberpergi = $this->input->post('txbtrainnumberpergi');
    $tglpergi = $this->input->post('txbtanggalpergi');
    $split 	 = explode('/', $tglpergi);
    $bulan = bulan($split[1]);
    $tanggalpergi = $split[0] . ' ' . $bulan . ' ' .$split[2];
    $departuretimepergi = $this->input->post('txbdeparturetimepergi');
    $arrivaltimepergi = $this->input->post('txbarrivaltimepergi');
    $gradeprgi = $this->input->post('txbgradepergi');
    if ($gradeprgi == 'E') {
        $gradepergi = 'Eksekutif';
    } else if ($gradeprgi == 'B') {
        $gradepergi = 'Bisnis';
    } else {
        $gradepergi = 'Ekonomi';
    }
    $subclasspergi = $this->input->post('txbsubclasspergi');
    $priceadultpergi = $this->input->post('txbpriceadultpergi');

    $trainnamepulang = $this->input->post('txbtrainnamepulang');
    $trainnumberpulang = $this->input->post('txbtrainnumberpulang');
    $tglpulang = $this->input->post('txbtanggalpulang');

    if($trainnamepulang != '') {

        $splitpulang = explode('/', $tglpulang);
        $bulanpulang = bulan($splitpulang[1]);
        $tanggalpulang = $splitpulang[0] . ' ' . $bulanpulang . ' ' . $splitpulang[2];

    }

    $departuretimepulang = $this->input->post('txbdeparturetimepulang');
    $arrivaltimepulang = $this->input->post('txbarrivaltimepulang');
    $gradeplang = $this->input->post('txbgradepulang');
    if ($gradeplang == 'E') {
        $gradepulang = 'Eksekutif';
    } else if ($gradeplang == 'B') {
        $gradepulang = 'Bisnis';
    } else {
        $gradepulang = 'Ekonomi';
    }
    $subclasspulang = $this->input->post('txbsubclasspulang');
    $priceadultpulang = $this->input->post('txbpriceadultpulang');

    ?>

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">

            <h2>
                <i class="fa fa-train" style="font-size:1em;margin-right:10px;color: <?php echo $warna_lembaga; ?>"></i>
                <span style="color: <?php echo $warna_lembaga; ?>">Informasi Reservasi Kereta Api</span>
            </h2>

            <div class="ibox float-e-margins">

                <div class="ibox-content" style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">

                    <form class="form-horizontal">

                        <div class="form-group">

                            <div class="col-lg-3">
                                <img alt="image" src="<?php echo base_url();?>assets/img/logo kereta api.png" style="height: 40px; width: 80px;" />
                                <i class="fa fa-arrow-circle-right" style="font-size:2em; color: darkorange; margin-left: 20px;"></i>
                            </div>
                            <div class="col-lg-9">
                                <h3>
                                    <span style="color: <?php echo $warna_lembaga; ?>">PERJALANAN PERGI</span>
                                    - <span><?php echo $trainnamepergi; ?> (<?php echo $trainnumberpergi; ?>)</span>
                                    - <span><?php echo $tanggalpergi; ?></span>
                                </h3>
                            </div>

                        </div>

                        <div class="form-group" style="margin-bottom: 0px;">

                            <div class="table-responsive">

                                <table class="table table-bordered bg-warning text-center">
                                    <tbody>
                                        <tr>
                                            <td style="vertical-align: middle;"><h2><?php echo $kdstfrom; ?> > <?php echo $kdstto; ?></h2></td>
                                            <td style="vertical-align: middle;"><h2><?php echo $departuretimepergi; ?> - <?php echo $arrivaltimepergi; ?></h2></td>
                                            <td style="vertical-align: middle;">
                                                <h2><?php echo $gradepergi; ?></h2>
                                                <h3>Subclass <?php echo $subclasspergi; ?></h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <div class="form-group" style="margin-top: 0px;">

                            <span>
                                <i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>; margin-left: 10px;"></i>
                                &nbsp; <?php echo $nmstfrom; ?> (<?php echo $kdstfrom; ?>) <i class="fa fa-arrow-right" style="font-size: 1em;color:<?php echo $warna_lembaga; ?>;"></i> <?php echo $nmstto; ?> (<?php echo $kdstto; ?>)<br/><br/>
                                <i class="fa fa-user" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>; margin-left: 10px;"></i>
                                &nbsp; <?php echo $jmldewasa; ?> Dewasa
                                <?php
                                if ($jmlbayi > 0){
                                    echo ', '.$jmlbayi; ?> Bayi
                                <?php
                                }
                                ?>
                            </span>

                        </div>

                        <hr style="border: solid 1px <?php echo $warna_lembaga; ?>"/>

                        <?php
                        if($trainnamepulang != '') {

                            ?>

                            <div class="form-group">

                                <div class="col-lg-3">
                                    <img alt="image" src="<?php echo base_url();?>assets/img/logo kereta api.png" style="height: 40px; width: 80px;" />
                                    <i class="fa fa-arrow-circle-left" style="font-size:2em; color: darkorange; margin-left: 20px;"></i>
                                </div>
                                <div class="col-lg-9">
                                    <h3>
                                        <span style="color: <?php echo $warna_lembaga; ?>">PERJALANAN PULANG</span>
                                        - <span><?php echo $trainnamepulang; ?> (<?php echo $trainnumberpulang; ?>)</span>
                                        - <span><?php echo $tanggalpulang; ?></span>
                                    </h3>
                                </div>

                            </div>

                            <div class="form-group" style="margin-bottom: 0px;">

                                <div class="table-responsive">

                                    <table class="table table-bordered bg-warning text-center">
                                        <tbody>
                                        <tr>
                                            <td style="vertical-align: middle;"><h2><?php echo $kdstto; ?> > <?php echo $kdstfrom; ?></h2></td>
                                            <td style="vertical-align: middle;"><h2><?php echo $departuretimepulang; ?> - <?php echo $arrivaltimepulang; ?></h2></td>
                                            <td style="vertical-align: middle;">
                                                <h2><?php echo $gradepulang; ?></h2>
                                                <h3>Subclass <?php echo $subclasspulang; ?></h3>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                            <div class="form-group" style="margin-top: 0px;">

                                <span>
                                    <i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>; margin-left: 10px;"></i>
                                    &nbsp; <?php echo $nmstto; ?> (<?php echo $kdstto; ?>) <i class="fa fa-arrow-right" style="font-size: 1em;color:<?php echo $warna_lembaga; ?>"></i> <?php echo $nmstfrom; ?> (<?php echo $kdstfrom; ?>)<br/><br/>
                                    <i class="fa fa-user" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>; margin-left: 10px;"></i>
                                    &nbsp; <?php echo $jmldewasa; ?> Dewasa
                                    <?php
                                    if ($jmlbayi > 0){
                                        echo ', '.$jmlbayi; ?> Bayi
                                        <?php
                                    }
                                    ?>
                                </span>

                            </div>

                            <?php
                        }
                        ?>

                    </form>

                </div>


                <form class="form-horizontal" method="post" action="viewpilihkursi" id="forminputdatapenumpang" autocomplete="off" onsubmit="return confirm('Apakah data sudah terisi dengan benar?');">

                    <input type="hidden" id="txbnmstfrom" name="txbnmstfrom" value="<?php echo $nmstfrom ?>">
                    <input type="hidden" id="txbkdstfrom" name="txbkdstfrom" value="<?php echo $kdstfrom ?>">
                    <input type="hidden" id="txbnmstto" name="txbnmstto" value="<?php echo $nmstto ?>">
                    <input type="hidden" id="txbkdstto" name="txbkdstto" value="<?php echo $kdstto ?>">
                    <input type="hidden" id="txbjmlbayi" name="txbjmlbayi" value="<?php echo $jmlbayi ?>">
                    <input type="hidden" id="txbjmldewasa" name="txbjmldewasa" value="<?php echo $jmldewasa ?>">

                    <input type="hidden" id="txbtrainnamepergi" name="txbtrainnamepergi" value="<?php echo $trainnamepergi ?>">
                    <input type="hidden" id="txbtrainnumberpergi" name="txbtrainnumberpergi" value="<?php echo $trainnumberpergi ?>">
                    <input type="hidden" id="txbtanggalpergi" name="txbtanggalpergi" value="<?php echo $tglpergi ?>">
                    <input type="hidden" id="txbdeparturetimepergi" name="txbdeparturetimepergi" value="<?php echo $departuretimepergi ?>">
                    <input type="hidden" id="txbarrivaltimepergi" name="txbarrivaltimepergi" value="<?php echo $arrivaltimepergi ?>">
                    <input type="hidden" id="txbgradepergi" name="txbgradepergi" value="<?php echo $gradeprgi ?>">
                    <input type="hidden" id="txbsubclasspergi" name="txbsubclasspergi" value="<?php echo $subclasspergi ?>">
                    <input type="hidden" id="txbpriceadultpergi" name="txbpriceadultpergi" value="<?php echo $priceadultpergi ?>">

                    <input type="hidden" id="txbtrainnamepulang" name="txbtrainnamepulang" value="<?php echo $trainnamepulang ?>">
                    <input type="hidden" id="txbtrainnumberpulang" name="txbtrainnumberpulang" value="<?php echo $trainnumberpulang ?>">
                    <input type="hidden" id="txbtanggalpulang" name="txbtanggalpulang" value="<?php echo $tglpulang ?>">
                    <input type="hidden" id="txbdeparturetimepulang" name="txbdeparturetimepulang" value="<?php echo $departuretimepulang ?>">
                    <input type="hidden" id="txbarrivaltimepulang" name="txbarrivaltimepulang" value="<?php echo $arrivaltimepulang ?>">
                    <input type="hidden" id="txbgradepulang" name="txbgradepulang" value="<?php echo $gradeplang ?>">
                    <input type="hidden" id="txbsubclasspulang" name="txbsubclasspulang" value="<?php echo $subclasspulang ?>">
                    <input type="hidden" id="txbpriceadultpulang" name="txbpriceadultpulang" value="<?php echo $priceadultpulang ?>">

                    <div class="ibox-content red-bg" style="padding: 10px;">

                        <h3>DATA PENUMPANG DEWASA</h3>

                    </div>

                    <div class="ibox-content" style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">

                        <?php
                        for ($x = 1; $x <= $jmldewasa; $x++) {
                            ?>

                            <div class="form-group">

                                <div class="col-lg-6">

                                    <label class="control-label" style="margin-bottom: 10px;">Nama <span style="color:#ed5565">*</span></label>
                                    <input type="text" name="txbnamedewasa<?php echo $x ?>" class="form-control" placeholder="Nama Penumpang Dewasa <?php echo $x ?>" required>

                                    <label class="control-label" style="margin-bottom: 10px; margin-top: 10px;">ID Card KTP /SIM /PASSPORT <span style="color:#ed5565">*</span></label>
                                    <input type="text" class="form-control" name="txbiddewasa<?php echo $x ?>" placeholder="ID CARD KTP / SIM / Passport" required>
                                    <span class="help-block m-b-none">< 17 tahun jika tidak memiliki ID diisi dengan tanggal lahir format hhbbtttt. Contoh: 01011993</span>

                                </div>
                                <div class="col-lg-6">

                                    <div id="tgllahirdewasa">
                                        <label class="control-label" style="margin-bottom: 10px;">Tanggal Lahir <span style="color:#ed5565">*</span></label>
                                        <div class="input-group date">
                                            <?php $today = date("d/m/Y"); ?>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" name="txbtgllahirdewasa<?php echo $x ?>" class="form-control" value="<?php echo $today?>" required>
                                        </div>
                                    </div>

                                    <label class="control-label" style="margin-bottom: 10px; margin-top: 10px;">No Telepon <span style="color:#ed5565">*</span></label>
                                    <input type="text" class="form-control" id="notelepondewasa<?php echo $x ?>" name="txbnotelpdewasa<?php echo $x ?>" placeholder="No Telp : 08xxxx" required>
                                    <span class="help-block m-b-none">
                                        Contoh: 081xxxxxx, tanpa spasi, '+' atapun '( )' <br/>
                                        Jika tidak memiliki, isikan angka 0
                                    </span>
                                </div>

                            </div>

                            <hr style="border: solid 1px <?php echo $warna_lembaga; ?>"/>

                            <?php
                        }
                        ?>

                    </div>

                    <?php
                    if($jmlbayi > 0) {
                        ?>

                        <div class="ibox-content red-bg" style="padding: 10px;">

                            <h3>DATA PENUMPANG BAYI</h3>

                        </div>

                        <div class="ibox-content" style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">


                                <?php
                                for ($x = 1; $x <= $jmlbayi; $x++) {
                                    ?>

                                    <div class="form-group">

                                        <div class="col-lg-8">
                                            <label class="control-label" style="margin-bottom: 10px;">Nama <span style="color:#ed5565">*</span></label>
                                            <input type="text" class="form-control" name="txbnamebayi<?php echo $x ?>" placeholder="Nama Penumpang Bayi <?php echo $x ?>" required>
                                        </div>

                                        <div id="tgllahirbayi" class="col-lg-4">
                                            <label class="control-label" style="margin-bottom: 10px;">Tanggal Lahir <span style="color:#ed5565">*</span></label>
                                            <div class="input-group date">
                                                <?php $today = date("d/m/Y"); ?>
                                                <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                                <input type="text" name="txbtgllahirbayi<?php echo $x ?>" class="form-control" value="<?php echo $today?>" required>
                                            </div>
                                        </div>

                                    </div>

                                    <hr style="border: solid 1px <?php echo $warna_lembaga; ?>"/>

                                    <?php

                                }
                                ?>


                        </div>

                        <?php
                    }
                    ?>

                    <div class="ibox-content red-bg" style="padding: 10px;">

                        <h3>INFORMASI KONTAK YANG DAPAT DIHUBUNGI</h3>

                    </div>

                    <div class="ibox-content" style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">


                        <div class="form-group">

                            <div class="col-lg-4">
                                <label class="control-label" style="margin-bottom: 10px;">Nama Kontak <span style="color:#ed5565">*</span></label>
                                <input type="text" class="form-control" name="txbnamekontak" placeholder="Nama Kontak" required>
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label" style="margin-bottom: 10px;">Email <span style="color:#ed5565">*</span></label>
                                <input type="email" class="form-control" name="txbemailkontak" placeholder="Email" required>
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label" style="margin-bottom: 10px;">No Telepon <span style="color:#ed5565">*</span></label>
                                <input type="text" id="noteleponkontak" class="form-control" name="txbnotelpkontak" placeholder="No Telp : 08xxxx" required>
                                <span class="help-block m-b-none">Contoh: 081xxxxxx, <br/>tanpa spasi, '+' atapun '( )'</span>
                            </div>


                            <div class="col-lg-12">
                                <label class="control-label" style="margin-bottom: 10px;">Alamat <span style="color:#ed5565">*</span></label>
                                <textarea class="form-control" placeholder="Alamat" name="txbalamatkontak" required></textarea>
                            </div>

                        </div>


                    </div>

                    <div class="ibox-footer" style="padding-top: 20px; padding-left: 50px; padding-right: 50px;">

                        <div class="row">
                            <div class="col-lg-8"></div>
                            <div class="col-lg-4">
                                <a href="<?php echo base_url('kereta')?>" style="margin-left: 50px;"><button type="button" class="btn btn-warning">CANCEL</button></a>
                                <button type="submit" class="btn btn-danger">BOOK NOW</button>
                            </div>
                        </div>

                    </div>

                </form>

            </div>

        </div>
        <div class="col-lg-3"></div>
    </div>

</div>

<!-- /content -->


</div>
