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

<div class="row wrapper border-bottom white-bg page-heading"
     style="position: fixed; z-index: 1; width: 100%">
    <div class="col-lg-10">
        <ol class="breadcrumb" style="padding-top: 60px;">
            <li>
                <a href="<?php echo base_url('dashboard')?>">Home</a>
            </li>
            <li>
                <a href="<?php echo base_url('pelni')?>">Pesan Tiket PELNI</a>
            </li>
            <li class="active">
                <strong>Info Jadwal</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<?php
$this->load->view('func_custom');

$cekpp = $this->input->post('cekpp');
$tglpergi = $this->input->post('tglpergi',true);
$tglpulang = $this->input->post('tglpulang',true);
$pria = $this->input->post('jmlpria',true);
$wanita = $this->input->post('jmlwanita',true);
$bayi = $this->input->post('jmlbayi',true);

$origin = $this->input->post('origin',true);
$exporigin = explode('-', $origin);
$origincode = str_replace(' ', '', $exporigin[0]);
$originname = $exporigin[1];

$destination = $this->input->post('destination',true);
$expdest = explode('-', $destination);
$destcode = str_replace(' ', '', $expdest[0]);
$destname = $expdest[1];

$exptglpergi = explode('/', $tglpergi);
$bulantglpergi = bulan($exptglpergi[1]);
$tglpergiindo = $exptglpergi[0] . ' ' . $bulantglpergi . ' ' .$exptglpergi[2];
$tglpergidb = $exptglpergi[2] . '-' . $exptglpergi[1] . '-' .$exptglpergi[0];

$exptglpulang = explode('/', $tglpulang);
$bulantglpulang = bulan($exptglpulang[1]);
$tglpulangindo = $exptglpulang[0].' '.$bulantglpulang.' '.$exptglpulang[2];
$tglpulangdb = $exptglpulang[2].'-'.$exptglpulang[1].'-'.$exptglpulang[0];

if($cekpp == 'on'){
    $tanggalpulang = hari($tglpulangdb).', '.$tglpulangindo;
    $pp = '(PP)';
}else{
    $tanggalpulang = '';
    $pp = '';
}
?>

<!-- Content -->

<div class="wrapper wrapper-content  animated fadeInRight article" style="margin-top: 100px;">

    <?php
    $shipnumberpergi = $this->input->post('shipnumberpergi',true);
    $shipnamapergi = $this->input->post('shipnamapergi',true);

    $depdatepergi = $this->input->post('departuredatepergi',true);
    $newdepdatepergi = date('Y-m-d',strtotime($depdatepergi));
    $expnewdepdatepergi = explode('-', $newdepdatepergi);
    $newdepdateindopergi = hari($newdepdatepergi).', '.$expnewdepdatepergi[2] . ' ' . bulan($expnewdepdatepergi[1]) . ' ' .$expnewdepdatepergi[0];
    $deptimepergi = $this->input->post('departuretimepergi',true);

    $arvdatepergi = $this->input->post('arrivaldatepergi',true);
    $newarvdatepergi = date('Y-m-d',strtotime($arvdatepergi));
    $expnewarvdatepergi = explode('-', $newarvdatepergi);
    $newarvdateindopergi = hari($newarvdatepergi).', '.$expnewarvdatepergi[2] . ' ' . bulan($expnewarvdatepergi[1]) . ' ' .$expnewarvdatepergi[0];
    $arvtimepergi = $this->input->post('arrivaltimepergi',true);

    $kelaspergi = $this->input->post('kelaspergi',true);
    $expkelaspergi = explode('/', $kelaspergi);
    $kelaspergi = $expkelaspergi[1];
    $subkelaspergi = $expkelaspergi[2];

    $rutepergi = $this->input->post('rutepergi',true);

    $subtotaltiketdewasapergi = $this->input->post('subtotaltiketdewasapergi',true);
    $subtotaltiketbayipergi = $this->input->post('subtotaltiketbayipergi',true);
    $tiketdewasapergi = ($pria + $wanita) * $subtotaltiketdewasapergi;
    $tiketbayipergi = $bayi * $subtotaltiketbayipergi;

    $totalhargapergi = $tiketdewasapergi + $tiketbayipergi;

    $origincallpergi = $this->input->post('origincallpergi',true);
    $destinationcallpergi = $this->input->post('destinationcallpergi',true);

    ?>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">

            <h2>
                <i class="fa fa-ship" style="font-size:1em;margin-right:10px;color: <?php echo $warna_lembaga; ?>"></i>
                <span style="color: <?php echo $warna_lembaga; ?>">Informasi Reservasi Kapal Laut Pelni</span>
            </h2>

            <div class="ibox float-e-margins" style="outline: none; border-color: #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">

                <div class="ibox-content">

                    <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">

                    <form class="form-horizontal">

                        <div class="form-group">

                            <div class="col-lg-2 col-xs-3">
                                <img alt="image" src="<?php echo base_url();?>assets/img/logo-pelni.png" style="height: 40px; width: 80px;" />
                                <i class="fa fa-arrow-circle-right" style="font-size:2em; color: #DA251D; margin-left: 20px;"></i>
                            </div>
                            <div class="col-lg-10 col-xs-9">
                                <h2>
                                    <span style="color: <?php echo $warna_lembaga; ?>">PERJALANAN PERGI</span>
                                    - <span><?php echo $shipnamapergi; ?> (<?php echo $shipnumberpergi; ?>)</span>
                                </h2>
                                <text style="font-size: 16px;">
                                    <?php echo $originname; ?> > <?php echo $destname; ?>
                                </text>
                            </div>

                        </div>

                        <div class="form-group" style="margin-bottom: 0px;">

                            <div class="table-responsive">

                                <table class="table table-bordered bg-danger text-center">
                                    <tbody>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <text style="font-size: 14px;">Berangkat : </text><br/>
                                            <text style="font-size: 16px;">
                                                <?php echo $newdepdateindopergi.' ('.$deptimepergi.')';?>
                                            </text>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <text style="font-size: 14px;">Tiba : </text><br/>
                                            <text style="font-size: 16px;">
                                                <?php echo $newarvdateindopergi.' ('.$arvtimepergi.')';?>
                                            </text>
                                        </td>
                                        <td style="vertical-align: middle; width: 30%">
                                            <h2><?php echo $kelaspergi; ?></h2>
                                            <h3>Subclass <?php echo $subkelaspergi; ?></h3>
                                            <text style="font-size: 12px;">
                                                Tiket Dewasa : <?php echo nominalcomma($subtotaltiketdewasapergi); ?>, Tiket Bayi : <?php echo nominalcomma($subtotaltiketbayipergi); ?>
                                            </text>
                                        </td>

                                        <td style="vertical-align: middle;">
                                            <h2><?php echo rupiah($totalhargapergi); ?></h2>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                        <div class="form-group" style="margin-top: 0px;">

                            <span>
                                <i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>; margin-left: 10px;"></i>
                                &nbsp; <?php echo $rutepergi; ?> <br/><br/>
                                <i class="fa fa-user" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>; margin-left: 10px;"></i>
                                <?php
                                if ($pria > 0){
                                    echo '| '.$pria.' Pria';
                                }
                                if ($wanita > 0){
                                    echo '| '.$wanita.' Wanita';
                                }
                                if ($bayi > 0){
                                    echo '| '.$bayi.' Bayi';
                                }
                                ?>
                            </span>

                        </div>

                        <hr style="border: solid 1px <?php echo $warna_lembaga; ?>"/>

                    </form>

                </div>
                
                <?php
                
                if($cekpp == 'on'){

                    $shipnumberpulang = $this->input->post('shipnumberpulang',true);
                    $shipnamapulang = $this->input->post('shipnamapulang',true);

                    $depdatepulang = $this->input->post('departuredatepulang',true);
                    $newdepdatepulang = date('Y-m-d',strtotime($depdatepulang));
                    $expnewdepdatepulang = explode('-', $newdepdatepulang);
                    $newdepdateindopulang = hari($newdepdatepulang).', '.$expnewdepdatepulang[2] . ' ' . bulan($expnewdepdatepulang[1]) . ' ' .$expnewdepdatepulang[0];
                    $deptimepulang = $this->input->post('departuretimepulang',true);

                    $arvdatepulang = $this->input->post('arrivaldatepulang',true);
                    $newarvdatepulang = date('Y-m-d',strtotime($arvdatepulang));
                    $expnewarvdatepulang = explode('-', $newarvdatepulang);
                    $newarvdateindopulang = hari($newarvdatepulang).', '.$expnewarvdatepulang[2] . ' ' . bulan($expnewarvdatepulang[1]) . ' ' .$expnewarvdatepulang[0];
                    $arvtimepulang = $this->input->post('arrivaltimepulang',true);

                    $kelaspulang = $this->input->post('kelaspulang',true);
                    $expkelaspulang = explode('/', $kelaspulang);
                    $kelaspulang = $expkelaspulang[1];
                    $subkelaspulang = $expkelaspulang[2];

                    $rutepulang = $this->input->post('rutepulang',true);

                    $subtotaltiketdewasapulang = $this->input->post('subtotaltiketdewasapulang',true);
                    $subtotaltiketbayipulang = $this->input->post('subtotaltiketbayipulang',true);
                    $tiketdewasapulang = ($pria + $wanita) * $subtotaltiketdewasapulang;
                    $tiketbayipulang = $bayi * $subtotaltiketbayipulang;

                    $totalhargapulang = $tiketdewasapulang + $tiketbayipulang;

                    $origincallpulang = $this->input->post('origincallpulang',true);
                    $destinationcallpulang = $this->input->post('destinationcallpulang',true);
                    
                    ?>

                    <div class="ibox-content">

                        <form class="form-horizontal">

                            <div class="form-group">

                                <div class="col-lg-2 col-xs-3">
                                    <img alt="image" src="<?php echo base_url();?>assets/img/logo-pelni.png" style="height: 40px; width: 80px;" />
                                    <i class="fa fa-arrow-circle-left" style="font-size:2em; color: #DA251D; margin-left: 20px;"></i>
                                </div>
                                <div class="col-lg-10 col-xs-9">
                                    <h2>
                                        <span style="color: <?php echo $warna_lembaga; ?>">PERJALANAN PULANG</span>
                                        - <span><?php echo $shipnamapulang; ?> (<?php echo $shipnumberpulang; ?>)</span>
                                    </h2>
                                    <text style="font-size: 16px;">
                                        <?php echo $destname  ?> > <?php echo $originname; ?>
                                    </text>
                                </div>

                            </div>

                            <div class="form-group" style="margin-bottom: 0px;">

                                <div class="table-responsive">

                                    <table class="table table-bordered bg-danger text-center">
                                        <tbody>
                                        <tr>
                                            <td style="vertical-align: middle;">
                                                <text style="font-size: 14px;">Berangkat : </text><br/>
                                                <text style="font-size: 16px;">
                                                    <?php echo $newdepdateindopulang.' ('.$deptimepulang.')';?>
                                                </text>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <text style="font-size: 14px;">Tiba : </text><br/>
                                                <text style="font-size: 16px;">
                                                    <?php echo $newarvdateindopulang.' ('.$arvtimepulang.')';?>
                                                </text>
                                            </td>
                                            <td style="vertical-align: middle; width: 30%">
                                                <h2><?php echo $kelaspulang; ?></h2>
                                                <h3>Subclass <?php echo $subkelaspulang; ?></h3>
                                                <text style="font-size: 12px;">
                                                    Tiket Dewasa : <?php echo nominalcomma($subtotaltiketdewasapulang); ?>, Tiket Bayi : <?php echo nominalcomma($subtotaltiketbayipulang); ?>
                                                </text>
                                            </td>

                                            <td style="vertical-align: middle;">
                                                <h2><?php echo rupiah($totalhargapulang); ?></h2>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                            <div class="form-group" style="margin-top: 0;">

                            <span>
                                <i class="fa fa-map-marker" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>; margin-left: 10px;"></i>
                                &nbsp; <?php echo $rutepulang; ?> <br/><br/>
                                <i class="fa fa-user" style="font-size: 1.2em;color:<?php echo $warna_lembaga; ?>; margin-left: 10px;"></i>
                                <?php
                                if ($pria > 0){
                                    echo '| '.$pria.' Pria';
                                }
                                if ($wanita > 0){
                                    echo '| '.$wanita.' Wanita';
                                }
                                if ($bayi > 0){
                                    echo '| '.$bayi.' Bayi';
                                }
                                ?>
                            </span>

                            </div>

                            <hr style="border: solid 1px <?php echo $warna_lembaga; ?>"/>

                        </form>

                    </div>
                    
                    <?php
                }
                
                ?>

                <form id="formbookingpelni" method="post" action="booking" class="form-horizontal" autocomplete="off" target="_blank" onsubmit="return confirm('Apakah data sudah terisi dengan benar?');">

                    <div class="ibox-content red-bg" style="padding: 10px;">

                        <h3>INFORMASI KONTAK YANG DAPAT DIHUBUNGI</h3>

                    </div>

                    <div class="ibox-content" style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">


                        <div class="form-group">

                            <div class="col-lg-4">
                                <label class="control-label" style="margin-bottom: 10px;">Nama Kontak <span style="color:#ed5565">*</span></label>
                                <input type="text" class="form-control" id="namakontak" name="txbnamekontak" placeholder="Nama Kontak" required>
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label" style="margin-bottom: 10px;">Email <span style="color:#ed5565">*</span></label>
                                <input type="email" class="form-control" id="emailkontak" name="txbemailkontak" placeholder="Email" required>
                                <span class="help-block m-b-none">E-ticket akan dikirimkan ke alamat email ini</span>
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label" style="margin-bottom: 10px;">No Telepon <span style="color:#ed5565">*</span></label>
                                <input type="text" class="form-control" id="noteleponkontak" name="txbnotelpkontak" placeholder="No Telp : 08xxxx" required>
                                <span class="help-block m-b-none">Contoh: 081xxxxxx, tanpa spasi, '+' atapun '( )'</span>
                            </div>

                        </div>


                    </div>

                    <div class="ibox-content red-bg" style="padding: 10px;">

                        <h3>DATA PENUMPANG DEWASA</h3>

                    </div>

                    <div class="ibox-content" style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">

                        <?php
                        for ($x = 1; $x <= ($pria+$wanita); $x++) {
                            ?>


                            <div class="form-group">

                                <div class="col-lg-4">

                                    <label class="control-label" style="margin-bottom: 10px;">Nama <span style="color:#ed5565">*</span></label>
                                    <input type="text" id="txbnamedewasa<?php echo $x ?>" name="txbnamedewasa<?php echo $x ?>" class="form-control" placeholder="Nama Penumpang Dewasa <?php echo $x ?>" required>

                                </div>
                                <div class="col-lg-4">

                                    <label class="control-label" style="margin-bottom: 10px; margin-top: 10px;">ID Card KTP /SIM /PASSPORT <span style="color:#ed5565">*</span></label>
                                    <input type="text" class="form-control" id="txbiddewasa<?php echo $x ?>" name="txbiddewasa<?php echo $x ?>" placeholder="ID CARD KTP / SIM / Passport" required>
                                    <span class="help-block m-b-none">< 17 tahun jika tidak memiliki ID diisi dengan tanggal lahir format hhbbtttt. Contoh: 01011993</span>

                                </div>
                                <div id="tgllahirdewasa" class="col-lg-2">

                                    <label class="control-label" style="margin-bottom: 10px;">Tanggal Lahir <span style="color:#ed5565">*</span></label>
                                    <div class="input-group date">
                                        <?php $today = date("d/m/Y"); ?>
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" id="txbtgllahirdewasa<?php echo $x ?>" name="txbtgllahirdewasa<?php echo $x ?>" class="form-control" value="<?php echo $today?>" required>
                                    </div>

                                </div>
                                <div class="col-lg-2">

                                    <label class="control-label" style="margin-bottom: 10px;">Gender <span style="color:#ed5565">*</span></label>
                                    <select class="form-control" name="slgenderdewasa<?php echo $x ?>">
                                        <option value="M">PRIA</option>
                                        <option value="F">WANITA</option>
                                    </select>

                                </div>

                            </div>

                            <hr style="border: solid 1px <?php echo $warna_lembaga; ?>"/>

                            <?php
                        }
                        ?>


                    </div>

                    <?php
                    if($bayi > 0) {

                        ?>

                        <div class="ibox-content red-bg" style="padding: 10px;">

                            <h3>DATA PENUMPANG BAYI</h3>

                        </div>

                        <div class="ibox-content"
                             style="padding-top: 20px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">

                            <?php
                            for ($x = 1; $x <= $bayi; $x++) {
                                ?>

                                <div class="form-group">

                                    <div class="col-lg-4">

                                        <label class="control-label" style="margin-bottom: 10px;">Nama <span
                                                    style="color:#ed5565">*</span></label>
                                        <input type="text" id="txbnamebayi<?php echo $x ?>" name="txbnamebayi<?php echo $x ?>" class="form-control"
                                               placeholder="Nama Penumpang Bayi <?php echo $x ?>" required>

                                    </div>
                                    <div id="tgllahirbayi" class="col-lg-4">

                                        <label class="control-label" style="margin-bottom: 10px;">Tanggal Lahir <span
                                                    style="color:#ed5565">*</span></label>
                                        <div class="input-group date">
                                            <?php $today = date("d/m/Y"); ?>
                                            <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                            <input type="text" id="txbtgllahirbayi<?php echo $x ?>" name="txbtgllahirbayi<?php echo $x ?>"
                                                   class="form-control"
                                                   value="<?php echo $today ?>" required>
                                        </div>

                                    </div>
                                    <div class="col-lg-4">

                                        <label class="control-label" style="margin-bottom: 10px;">Gender <span
                                                    style="color:#ed5565">*</span></label>
                                        <select class="form-control" name="slgenderdbayi<?php echo $x ?>">
                                            <option value="M">PRIA</option>
                                            <option value="F">WANITA</option>
                                        </select>

                                    </div>

                                </div>

                                <hr style="border: solid 1px <?php echo $warna_lembaga; ?>"/>

                                <?php
                            }
                            ?>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="i-checks">
                                        <label>
                                            <input type="checkbox" class="isfamily" id="isfamily" name="isfamily">
                                            <i></i>Silahkan centang, apabila semua penumpang adalah satu keluarga.
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <?php
                    }
                    ?>

                    <div class="ibox-footer" style="padding-top: 20px; padding-left: 50px; padding-right: 50px;">

                        <input type="hidden" name="cekpp" value="<?= $cekpp;?>">
                        <input type="hidden" name="tglpergi" value="<?= $tglpergi;?>">
                        <input type="hidden" name="tglpulang" value="<?= $tglpulang;?>">
                        <input type="hidden" id="jmlpria" name="jmlpria" value="<?= $pria;?>">
                        <input type="hidden" id="jmlwanita" name="jmlwanita" value="<?= $wanita;?>">
                        <input type="hidden" id="jmlbayi" name="jmlbayi" value="<?= $bayi;?>">
                        <input type="hidden" name="origin" value="<?= $origin;?>">
                        <input type="hidden" name="destination" value="<?= $destination;?>">

                        <input type="hidden" id="txborigincallpergi" name="origincallpergi" value="<?= $origincallpergi;?>">
                        <input type="hidden" id="txbdestinationcallpergi" name="destinationcallpergi" value="<?= $destinationcallpergi;?>">
                        <input type="hidden" id="txbdeparturedatepergi" name="departuredatepergi" value="<?= $depdatepergi;?>">
                        <input type="hidden" id="txbdeparturetimepergi" name="departuretimepergi" value="<?= $deptimepergi;?>">
                        <input type="hidden" id="txbarrivaldatepergi" name="arrivaldatepergi" value="<?= $arvdatepergi;?>">
                        <input type="hidden" id="txbarrivaltimepergi" name="arrivaltimepergi" value="<?= $arvtimepergi;?>">
                        <input type="hidden" id="txbshipnumberpergi" name="shipnumberpergi" value="<?= $shipnumberpergi;?>">
                        <input type="hidden" id="txbshipnamapergi" name="shipnamapergi" value="<?= $shipnamapergi;?>">
                        <input type="hidden" id="txbrutepergi" name="rutepergi" value="<?= $rutepergi;?>">
                        <input type="hidden" id="txbkelaspergi" name="kelaspergi" value="<?= $kelaspergi;?>">

                        <input type="hidden" id="txbsubtotaltiketdewasapergi" name="subtotaltiketdewasapergi" value="<?= $subtotaltiketdewasapergi;?>">
                        <input type="hidden" id="txbsubtotaltiketbayipergi" name="subtotaltiketbayipergi" value="<?= $subtotaltiketbayipergi;?>">

                        <?php
                        if($cekpp == 'on'){
                            ?>

                            <input type="hidden" id="txborigincallpulang" name="origincallpulang" value="<?= $origincallpulang;?>">
                            <input type="hidden" id="txbdestinationcallpulang" name="destinationcallpulang" value="<?= $destinationcallpulang;?>">
                            <input type="hidden" id="txbdeparturedatepulang" name="departuredatepulang" value="<?= $depdatepulang;?>">
                            <input type="hidden" id="txbdeparturetimepulang" name="departuretimepulang" value="<?= $deptimepulang;?>">
                            <input type="hidden" id="txbarrivaldatepulang" name="arrivaldatepulang" value="<?= $arvdatepulang;?>">
                            <input type="hidden" id="txbarrivaltimepulang" name="arrivaltimepulang" value="<?= $arvtimepulang;?>">
                            <input type="hidden" id="txbshipnumberpulang" name="shipnumberpulang" value="<?= $shipnumberpulang;?>">
                            <input type="hidden" id="txbshipnamapulang" name="shipnamapulang" value="<?= $shipnamapulang;?>">
                            <input type="hidden" id="txbrutepulang" name="rutepulang" value="<?= $rutepulang;?>">
                            <input type="hidden" id="txbkelaspulang" name="kelaspulang" value="<?= $kelaspulang;?>">

                            <input type="hidden" id="txbsubtotaltiketdewasapulang" name="subtotaltiketdewasapulang" value="<?= $subtotaltiketdewasapulang;?>">
                            <input type="hidden" id="txbsubtotaltiketbayipulang" name="subtotaltiketbayipulang" value="<?= $subtotaltiketbayipulang;?>">

                            <?php
                        }
                        ?>

                        <div class="row">
                            <div class="col-lg-9 col-xs-8">
                            </div>
                            <div class="col-lg-3 col-xs-4">
                                <a href="<?php echo base_url('pelni')?>" style="margin-left: 50px;"><button type="button" class="btn btn-warning">CANCEL</button></a>
                                <button type="submit" id="btnsubmit" class="btn btn-danger">BOOK NOW</button>
                            </div>
                        </div>

                    </div>

                </form>

            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>

</div>

<!-- /content -->

