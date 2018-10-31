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
                <a href="<?php echo base_url('kereta')?>">Pesan Tiket</a>
            </li>
            <li class="active">
                <strong>Info Jadwal Kereta Api</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->

<div class="wrapper wrapper-content animated fadeInRight article">

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">

            <?php
            $this->load->view('func_custom');

            $st_from = $this->input->post('st_from');
            $stfr = explode(" ", $st_from);
            $kdstfrom = $stfr[0];
            $nmstfrom = rtrim($stfr[2],", ");
            if(substr($stfr[2], -1) != ","){
                $nmstfrom = $stfr[2].' '.rtrim($stfr[3],", ");
            }else{
                $nmstfrom = rtrim($stfr[2],", ");
            }

            $st_to = $this->input->post('st_to');
            $stto = explode(" ", $st_to);
            $kdstto = $stto[0];
            $nmstto = rtrim($stto[2],", ");
            if(substr($stto[2], -1) != ","){
                $nmstto = $stto[2].' '.rtrim($stto[3],", ");
            }else{
                $nmstto = rtrim($stto[2],", ");
            }

            $tglpergi = $this->input->post('tglpergi');
            $split 	 = explode('/', $tglpergi);
            $bulan = bulan($split[1]);
            $tanggalpergi = $split[0] . ' ' . $bulan . ' ' .$split[2];
            $tanggalpergidb = $split[2] . '-' . $split[1] . '-' .$split[0];

            $d=strtotime("tomorrow");
            $today = date("d/m/Y");
            $tomorrow = date("d/m/Y", $d);

            $cekpp = $this->input->post('cekpp');

            $tglpulang = $this->input->post('tglpulang');
            $splitpul 	 = explode('/', $tglpulang);
            $bulanpul = bulan($splitpul[1]);

            if($cekpp == 'on'){
                $tanggalpulangdb = $splitpul[2] . '-' . $splitpul[1] . '-' .$splitpul[0];
                $tanggalpulang = hari($tanggalpulangdb).', '.$splitpul[0] . ' ' . $bulanpul . ' ' .$splitpul[2];
                $valtanggalpulang = $tglpulang;
                $display = 'block';
                $checked = 'checked';
                $pp = '(PP)';
            }else{
                $tanggalpulang = '';
                $valtanggalpulang = $today;
                $display = 'none';
                $checked = '';
                $pp = '';
            }

            $jmldewasa = $this->input->post('jmldewasa');
            $jmlbayi = $this->input->post('jmlbayi');
            ?>

            <!-- Form Pilih Kereta dan jadwal -->

            <div class="ibox float-e-margins" >

                <!-- Judul Pergi dan Tujuan -->

                <div class="ibox-content red-bg">

                    <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">

                    <div class="row">
                        <div class="col-lg-10">
                            <h2><?php echo $nmstfrom; ?> (<?php echo $kdstfrom; ?>) ke <?php echo $nmstto; ?> (<?php echo $kdstto; ?>) <?php echo $pp; ?></h2>
                            <h3>
                                <i class="fa fa-calendar"></i>
                                <?php echo hari($tanggalpergidb).', '.$tanggalpergi; ?>
                                - <?php echo $tanggalpulang; ?>
                                | <i class="fa fa-user"></i> <?php echo $jmldewasa; ?> Dewasa
                                <?php
                                    if($jmlbayi>0){ echo ' , '.$jmlbayi.' Bayi';}
                                ?>
                            </h3>
                        </div>
                        <div class="col-lg-2">
                            <a href="#" onclick="showubahcari()" style="color: white" id="btnubahcari"><h3>Ubah Pencarian</h3></a>
                        </div>
                    </div>

                </div>

                <!-- Form Pencarian -->

                <div class="ibox-content formubahcari" id="formubahcari" style="display: none;">

                    <form class="form-horizontal" method="post" action="viewjadwalkereta" autocomplete="off">

                        <div class="form-group">
                            <div class="i-checks-ubah">
                                <label> <input type="checkbox" class="cekppubah" id="cekppubah" name="cekpp" <?php echo $checked;?>> <i></i> Pulang Pergi</label>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-lg-4">

                                <label><i class="fa fa-map-marker" style="font-size: 1.2em;color:#ED5565;padding-right:5px;"></i> Stasiun Asal</label>
                                <input id="st_from_ubah" name="st_from" type="text" class="st_from_ubah form-control" value="<?php echo $st_from ?>" onclick="clearstfromubah()">

                                <div class="tukar" style="position: relative; cursor:pointer; margin-top: 7px;" onclick="tukarubah()">
                                <span class="fa-stack fa-lg" style="position:absolute;bottom:-20px;right:16px;width:55px;">
                                <i class="fa fa-circle fa-stack-2x" style="color:#ED5565;"></i>
                                <i class="fa fa-exchange fa-stack-1x fa-inverse fa-rotate-90"></i>
                                </span>
                                </div>

                                <label><i class="fa fa-map-marker" style="font-size: 1.2em;color:#ED5565;padding-right:5px;"></i> Stasiun Tujuan</label>
                                <input id="st_to_ubah" name="st_to" type="text" class="st_to_ubah form-control" value="<?php echo $st_to ?>" onclick="clearsttoubah()">

                            </div>

                            <div class="col-lg-4">

                                <div id="tanggalpergiubah">
                                    <label> Tanggal Pergi</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="tglpergi" class="form-control" value="<?php echo $tglpergi?>" required>
                                    </div>
                                </div>

                                <div id="tanggalpulangubah" style="margin-top: 8px; display:<?php echo $display;?>;">
                                    <label> Tanggal Pulang</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="tglpulang" class="form-control" value="<?php echo $valtanggalpulang?>">
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-4">
                                <label> Dewasa (>= 3 thn) </label>
                                <select class="form-control" name="jmldewasa" required>
                                    <option><?php echo $jmldewasa ?></option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                                <label> Bayi (< 3 thn) </label>
                                <select class="form-control" name="jmlbayi" required>
                                    <option><?php echo $jmlbayi ?></option>
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <button class="btn btn-danger" type="submit" style="float: right">Cari Jadwal >></button>
                            </div>
                        </div>

                    </form>

                </div>

                <!-- Form Pilih Pulang pergi -->
                <?php

                if($cekpp == 'on') {


                    if($jadwalkereta->datapergi->rc != '00') {
                        ?>

                        <div class="ibox-content">

                            <div class="alert alert-warning">
                                Warning API : <?php echo $jadwalkereta->datapergi->rc.' - '.$jadwalkereta->datapergi->rd ?>
                            </div>

                        </div>

                        <?php
                    }
                    else {
                        ?>


                        <div class="ibox-content" style="padding-top: 20px;">

                            <div class="row">

                                <div class="col-lg-10">

                                    <input type="hidden" id="jmldewasa" name="jmldewasa"
                                           value="<?php echo $jmldewasa; ?>">
                                    <input type="hidden" id="jmlbayi" name="jmlbayi" value="<?php echo $jmlbayi; ?>">

                                    <div class="row" id="formsebelumpilihpergi" style="display: block;">
                                        <h3>Jadwal Kereta Pergi belum dipilih</h3>
                                    </div>

                                    <div class="row" id="formpilihpergi" style="display: none;">

                                        <div class="col-lg-2">

                                            <h3>Pergi</h3>
                                            <span style="color: grey"><?php echo hari($tanggalpergidb) . ', ' . $tanggalpergi; ?></span>

                                        </div>
                                        <div class="col-lg-6">

                                            <h3 id="trainnamepergi"></h3>
                                            <span id="traingradepergi"></span>

                                        </div>
                                        <div class="col-lg-2">

                                            <h3 id="traindeparturetimepergi"></h3>
                                            <span style="color: grey"><?php echo $nmstfrom; ?> (<?php echo $kdstfrom; ?>)</span>

                                        </div>
                                        <div class="col-lg-2">

                                            <h3 id="trainarrivaltimepergi"></h3>
                                            <span style="color: grey"><?php echo $nmstto; ?> (<?php echo $kdstto; ?>)</span>

                                        </div>

                                    </div>

                                    <hr/>

                                    <div class="row" id="formsebelumpilihpulang" style="display: block;">
                                        <h3>Jadwal Kereta Pulang belum dipilih</h3>
                                    </div>

                                    <div class="row" id="formpilihpulang" style="display: none;">

                                        <div class="col-lg-2">

                                            <h3>Pulang</h3>
                                            <span style="color: grey"><?php echo $tanggalpulang; ?></span>

                                        </div>
                                        <div class="col-lg-6">

                                            <h3 id="trainnamepulang"></h3>
                                            <span id="traingradepulang"></span>

                                        </div>
                                        <div class="col-lg-2">

                                            <h3 id="traindeparturetimepulang"></h3>
                                            <span style="color: grey"><?php echo $nmstto; ?> (<?php echo $kdstto; ?>)</span>

                                        </div>
                                        <div class="col-lg-2">

                                            <h3 id="trainarrivaltimepulang"></h3>
                                            <span style="color: grey"><?php echo $nmstfrom; ?> (<?php echo $kdstfrom; ?>)</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-2">

                                    <div class="row text-center"
                                         style="border-left: solid 1px grey; height: 150px; padding-top: 30px;">

                                        <h2 id="trainpptotalharga" style="color: #ed5565;">Rp 0</h2>
                                        <input type="hidden" id="trainhargapergi" value="0">
                                        <input type="hidden" id="trainhargapulang" value="0">

                                        <form method="post" id="formpilihpulangpergi">

                                            <input type="hidden" id="txbnmstfrom" name="txbnmstfrom"
                                                   value="<?php echo $nmstfrom ?>">
                                            <input type="hidden" id="txbkdstfrom" name="txbkdstfrom"
                                                   value="<?php echo $kdstfrom ?>">
                                            <input type="hidden" id="txbnmstto" name="txbnmstto"
                                                   value="<?php echo $nmstto ?>">
                                            <input type="hidden" id="txbkdstto" name="txbkdstto"
                                                   value="<?php echo $kdstto ?>">
                                            <input type="hidden" id="txbjmlbayi" name="txbjmlbayi"
                                                   value="<?php echo $jmlbayi ?>">
                                            <input type="hidden" id="txbjmldewasa" name="txbjmldewasa"
                                                   value="<?php echo $jmldewasa ?>">

                                            <input type="hidden" id="txbtrainnamepergi" name="txbtrainnamepergi">
                                            <input type="hidden" id="txbtrainnumberpergi" name="txbtrainnumberpergi">
                                            <input type="hidden" id="txbtanggalpergi" name="txbtanggalpergi">
                                            <input type="hidden" id="txbdeparturetimepergi"
                                                   name="txbdeparturetimepergi">
                                            <input type="hidden" id="txbarrivaltimepergi" name="txbarrivaltimepergi">
                                            <input type="hidden" id="txbgradepergi" name="txbgradepergi">
                                            <input type="hidden" id="txbsubclasspergi" name="txbsubclasspergi">
                                            <input type="hidden" id="txbpriceadultpergi" name="txbpriceadultpergi">

                                            <input type="hidden" id="txbtrainnamepulang" name="txbtrainnamepulang">
                                            <input type="hidden" id="txbtrainnumberpulang" name="txbtrainnumberpulang">
                                            <input type="hidden" id="txbtanggalpulang" name="txbtanggalpulang">
                                            <input type="hidden" id="txbdeparturetimepulang"
                                                   name="txbdeparturetimepulang">
                                            <input type="hidden" id="txbarrivaltimepulang" name="txbarrivaltimepulang">
                                            <input type="hidden" id="txbgradepulang" name="txbgradepulang">
                                            <input type="hidden" id="txbsubclasspulang" name="txbsubclasspulang">
                                            <input type="hidden" id="txbpriceadultpulang" name="txbpriceadultpulang">

                                            <button type="button" class="btn btn-danger" id="btnsubmitpulangpergi"
                                                    onclick="submitpulangpergi()"> PESAN SEKARANG
                                            </button>

                                        </form>


                                    </div>

                                </div>

                            </div>

                        </div>

                        <?php
                    }
                }
                ?>

                <!-- Form Pilih Jadwal Kereta -->

                <div class="ibox-content">

                    <?php

                    if($cekpp == 'on'){

                        if($jadwalkereta->datapergi->rc != '00') {
                            ?>

                                <div class="row text-center">

                                    <h1>DATA TIDAK DITEMUKAN</h1><br/>
                                    <h2>Ada masalah pada API, Lakukan Pencarian Jadwal Kereta Kembali</h2><br/>
                                    <a href="<?php echo base_url('kereta') ?>">
                                        <button class="btn btn-danger">Kembali ke form pencarian</button>
                                    </a>

                                </div>

                            <?php
                        }
                        else {

                            $lengthdatapergi = count($jadwalkereta->datapergi->data);
                            $lengthdatapulang = count($jadwalkereta->datapulang->data);
                            ?>


                            <text style="font-size: 12px;">* Harga Sewaktu-waktu bisa berubah dan Belum termasuk biaya administrasi</text><br/><br/>

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="row center-block" style="background-color: #ed5565; color: white; width: 90%;">
                                        <h3 style="margin-left: 5px;">Pergi : <?php echo $nmstfrom; ?> (<?php echo $kdstfrom; ?>) >>> <?php echo $nmstto; ?> (<?php echo $kdstto; ?>)</h3>
                                        <span style="margin-left: 5px;"><?php echo hari($tanggalpergidb).', '.$tanggalpergi; ?></span>
                                    </div>

                                    <?php
                                    if ($lengthdatapergi > 0) {
                                        ?>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover datajadwalkeretapergi">
                                                <thead>
                                                <tr style="font-size: 14px;">
                                                    <th>KERETA API</th>
                                                    <th>BERANGKAT</th>
                                                    <th>DATANG</th>
                                                    <th>HARGA</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                                for ($i = 0; $i < $lengthdatapergi; $i++) {

                                                    $seats = $jadwalkereta->datapergi->data[$i]->seats;
                                                    $jmlkelas = count($seats);

                                                    for ($j = 0; $j < $jmlkelas; $j++) {

                                                        if ($seats[$j]->grade == 'E') {
                                                            $grade = 'Eksekutif';
                                                        } else if ($seats[$j]->grade == 'B') {
                                                            $grade = 'Bisnis';
                                                        } else {
                                                            $grade = 'Ekonomi';
                                                        }
                                                        ?>
                                                        <tr style="font-size: 11px;">

                                                            <td>
                                                                <div class="col-lg-2">

                                                                    <?php
                                                                    if ($seats[$j]->availability > 0) {

                                                                        ?>

                                                                        <div class="i-checks-pergi">
                                                                            <input type="radio"
                                                                                   id="pilihpergi"
                                                                                   value="dipilih"
                                                                                   class="pilihpergi"
                                                                                   name="pilihpergi"
                                                                                   data-trainnumber="<?php echo $jadwalkereta->datapergi->data[$i]->trainNumber ?>"
                                                                                   data-trainname="<?php echo $jadwalkereta->datapergi->data[$i]->trainName ?>"
                                                                                   data-grade="<?php echo $grade ?>"
                                                                                   data-grd="<?php echo $seats[$j]->grade ?>"
                                                                                   data-class="<?php echo $seats[$j]->class ?>"
                                                                                   data-departuretime="<?php echo $jadwalkereta->datapergi->data[$i]->departureTime; ?>"
                                                                                   data-arrivaltime="<?php echo $jadwalkereta->datapergi->data[$i]->arrivalTime; ?>"
                                                                                   data-harga="<?php echo $seats[$j]->priceAdult; ?>"
                                                                                   data-tglpergi="<?php echo $tglpergi; ?>"
                                                                            >
                                                                        </div>

                                                                        <?php
                                                                    } else {
                                                                        ?>

                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <label style="color: #ed5565"><?php echo $jadwalkereta->datapergi->data[$i]->trainName; ?></label>
                                                                    (<?php echo $jadwalkereta->datapergi->data[$i]->trainNumber; ?>
                                                                    )<br/>
                                                                    <b><?php echo $grade; ?></b> (
                                                                    Subclass <?php echo $seats[$j]->class ?> )<br/>
                                                                    <span>Sisa : <?php echo $seats[$j]->availability ?>
                                                                        Kursi</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?php echo $jadwalkereta->datapergi->data[$i]->departureTime; ?>
                                                                <br/>
                                                                <?php echo $nmstfrom; ?> (<?php echo $kdstfrom; ?>)
                                                            </td>
                                                            <td>
                                                                <?php echo $jadwalkereta->datapergi->data[$i]->arrivalTime; ?>
                                                                <br/>
                                                                <?php echo $nmstto; ?> (<?php echo $kdstto; ?>)
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($seats[$j]->availability > 0) {

                                                                    ?>
                                                                    <label style="color: #ed5565"><?php echo rupiah($seats[$j]->priceAdult) ?></label>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <span><label
                                                                                style="color: #ed5565">Kursi Habis</label></span>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                                </tbody>
                                            </table>
                                        </div>

                                        <?php
                                    } else {
                                        ?>

                                        <div class="row text-center">

                                            <h1>DATA TIDAK DITEMUKAN</h1><br/>
                                            <h2>Lakukan Pencarian Jadwal Kereta Kembali</h2><br/>
                                            <a href="<?php echo base_url('kereta') ?>">
                                                <button class="btn btn-danger">Kembali ke form pencarian</button>
                                            </a>

                                        </div>

                                        <?php
                                    }
                                    ?>

                                </div>

                                <div class="col-lg-6">
                                    <div class="row center-block" style="background-color: #ed5565; color: white; width: 90%;">

                                        <h3 style="margin-left: 5px;">Pulang : <?php echo $nmstto; ?> (<?php echo $kdstto; ?>)
                                            >>> <?php echo $nmstfrom; ?> (<?php echo $kdstfrom; ?>)</h3>
                                        <span style="margin-left: 5px;"><?php echo $tanggalpulang ?></span>

                                    </div>

                                    <?php
                                    if ($lengthdatapulang > 0){
                                    ?>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover datajadwalkeretapergi">
                                            <thead>
                                            <tr style="font-size: 14px;">
                                                <th>
                                    </div>
                                    KERETA API</th>
                                    <th>BERANGKAT</th>
                                    <th>DATANG</th>
                                    <th>HARGA</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    for ($i = 0; $i < $lengthdatapulang; $i++) {

                                        $seats = $jadwalkereta->datapulang->data[$i]->seats;
                                        $jmlkelas = count($seats);

                                        for ($j = 0; $j < $jmlkelas; $j++) {

                                            if ($seats[$j]->grade == 'E') {
                                                $grade = 'Eksekutif';
                                            } else if ($seats[$j]->grade == 'B') {
                                                $grade = 'Bisnis';
                                            } else {
                                                $grade = 'Ekonomi';
                                            }
                                            ?>
                                            <tr style="font-size: 11px;">

                                                <td>
                                                    <div class="col-lg-2">

                                                        <?php
                                                        if ($seats[$j]->availability > 0) {

                                                            ?>

                                                            <div class="i-checks-pulang">
                                                                <input type="radio"
                                                                       id="pilihpulang"
                                                                       value="dipilih"
                                                                       class="pilihpulang"
                                                                       name="pilihpulang"
                                                                       data-trainnumber="<?php echo $jadwalkereta->datapulang->data[$i]->trainNumber ?>"
                                                                       data-trainname="<?php echo $jadwalkereta->datapulang->data[$i]->trainName ?>"
                                                                       data-grade="<?php echo $grade ?>"
                                                                       data-grd="<?php echo $seats[$j]->grade ?>"
                                                                       data-class="<?php echo $seats[$j]->class ?>"
                                                                       data-departuretime="<?php echo $jadwalkereta->datapulang->data[$i]->departureTime; ?>"
                                                                       data-arrivaltime="<?php echo $jadwalkereta->datapulang->data[$i]->arrivalTime; ?>"
                                                                       data-harga="<?php echo $seats[$j]->priceAdult; ?>"
                                                                       data-tglpulang="<?php echo $tglpulang; ?>"
                                                                >
                                                            </div>

                                                            <?php
                                                        } else {
                                                            ?>

                                                            <?php
                                                        }
                                                        ?>

                                                    </div>
                                                    <div class="col-lg-10">
                                                        <label style="color: #ed5565"><?php echo $jadwalkereta->datapulang->data[$i]->trainName; ?></label>
                                                        (<?php echo $jadwalkereta->datapulang->data[$i]->trainNumber; ?>)<br/>
                                                        <b><?php echo $grade; ?></b> ( Subclass <?php echo $seats[$j]->class ?>)<br/>
                                                        <span>Sisa : <?php echo $seats[$j]->availability ?> Kursi</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo $jadwalkereta->datapulang->data[$i]->departureTime; ?><br/>
                                                    <?php echo $nmstto; ?> (<?php echo $kdstto; ?>)
                                                </td>
                                                <td>
                                                    <?php echo $jadwalkereta->datapulang->data[$i]->arrivalTime; ?><br/>
                                                    <?php echo $nmstfrom; ?> (<?php echo $kdstfrom; ?>)
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($seats[$j]->availability > 0) {

                                                        ?>
                                                        <label style="color: #ed5565"><?php echo rupiah($seats[$j]->priceAdult) ?></label>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span><label style="color: #ed5565">Kursi Habis</label></span>
                                                        <?php
                                                    }
                                                    ?>

                                                </td>

                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                    </tbody>
                                    </table>
                                </div>

                                <?php
                                } else {
                                    ?>

                                    <div class="row text-center">

                                        <h1>DATA TIDAK DITEMUKAN</h1><br/>
                                        <h2>Lakukan Pencarian Jadwal Kereta Kembali</h2><br/>
                                        <a href="<?php echo base_url('kereta') ?>">
                                            <button class="btn btn-danger">Kembali ke form pencarian</button>
                                        </a>

                                    </div>

                                    <?php
                                }
                                ?>

                            </div>

                        </div>

                        <?php
                        }

                    }
                    else {

                        if($jadwalkereta->rc != '00') {
                            ?>

                            <div class="ibox-content">

                                <div class="alert alert-warning">
                                    Warning API : <?php echo $jadwalkereta->rc.' - '.$jadwalkereta->rd ?>
                                </div>

                                <div class="row text-center">

                                    <h1>DATA TIDAK DITEMUKAN</h1><br/>
                                    <h2>Ada masalah pada API,Lakukan Pencarian Jadwal Kereta Kembali</h2><br/>
                                    <a href="<?php echo base_url('kereta') ?>">
                                        <button class="btn btn-danger">Kembali ke form pencarian</button>
                                    </a>

                                </div>

                            </div>

                            <?php
                        }
                        else {


                            $lengthdata = count($jadwalkereta->data);

                            if ($lengthdata > 0) {

                                ?>

                                <text style="font-size: 12px;">* Harga Sewaktu-waktu bisa berubah dan Belum termasuk biaya administrasi</text><br/><br/>

                                <div class="table-responsive tooltip-demo">
                                    <table class="table table-bordered table-hover datajadwalkereta"
                                           style="font-size: 14px;">
                                        <thead>
                                        <tr>
                                            <th>KERETA API</th>
                                            <th>BERANGKAT</th>
                                            <th>DATANG</th>
                                            <th>DURASI</th>
                                            <th>HARGA</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        for ($i = 0; $i < $lengthdata; $i++) {

                                            $seats = $jadwalkereta->data[$i]->seats;
                                            $jmlkelas = count($seats);

                                            for ($j = 0; $j < $jmlkelas; $j++) {

                                                if ($seats[$j]->grade == 'E') {
                                                    $grade = 'Eksekutif';
                                                } else if ($seats[$j]->grade == 'B') {
                                                    $grade = 'Bisnis';
                                                } else {
                                                    $grade = 'Ekonomi';
                                                }

                                                ?>

                                                <tr>
                                                    <td>
                                                        <label style="color: #ed5565"><?php echo $jadwalkereta->data[$i]->trainName; ?></label>
                                                        (<?php echo $jadwalkereta->data[$i]->trainNumber; ?>)<br/>
                                                        <b><?php echo $grade; ?></b>
                                                        (Subclass <?php echo $seats[$j]->class ?>)
                                                    </td>
                                                    <td><?php echo $jadwalkereta->data[$i]->departureTime; ?></td>
                                                    <td><?php echo $jadwalkereta->data[$i]->arrivalTime; ?></td>
                                                    <td><?php echo $jadwalkereta->data[$i]->duration; ?></td>
                                                    <td>
                                                        <label style="color: #ed5565"><?php echo rupiah($seats[$j]->priceAdult) ?></label><br/>
                                                    </td>
                                                    <td>

                                                        <?php
                                                        if ($seats[$j]->availability > 0) {

                                                            if ($seats[$j]->availability < $jmldewasa) {
                                                                ?>

                                                                <span><label
                                                                            style="color: #ed5565">Sisa Tempat Duduk = <?php echo $seats[$j]->availability ?></label></span>

                                                                <?php

                                                            } else {

                                                                ?>

                                                                <form id="formpilihpergi<?php echo $i?>" method="post">

                                                                    <input type="hidden" name="txbnmstfrom"
                                                                           value="<?php echo $nmstfrom; ?>">
                                                                    <input type="hidden" name="txbkdstfrom"
                                                                           value="<?php echo $kdstfrom; ?>">
                                                                    <input type="hidden" name="txbnmstto"
                                                                           value="<?php echo $nmstto; ?>">
                                                                    <input type="hidden" name="txbkdstto"
                                                                           value="<?php echo $kdstto; ?>">
                                                                    <input type="hidden" name="txbjmlbayi"
                                                                           value="<?php echo $jmlbayi; ?>">
                                                                    <input type="hidden" name="txbjmldewasa"
                                                                           value="<?php echo $jmldewasa; ?>">


                                                                    <input type="hidden" name="txbtrainnamepergi"
                                                                           value="<?php echo $jadwalkereta->data[$i]->trainName; ?>">
                                                                    <input type="hidden" name="txbtrainnumberpergi"
                                                                           value="<?php echo $jadwalkereta->data[$i]->trainNumber; ?>">
                                                                    <input type="hidden" name="txbtanggalpergi"
                                                                           value="<?php echo $tglpergi; ?>">
                                                                    <input type="hidden" name="txbdeparturetimepergi"
                                                                           value="<?php echo $jadwalkereta->data[$i]->departureTime; ?>">
                                                                    <input type="hidden" name="txbarrivaltimepergi"
                                                                           value="<?php echo $jadwalkereta->data[$i]->arrivalTime; ?>">
                                                                    <input type="hidden" name="txbgradepergi"
                                                                           value="<?php echo $seats[$j]->grade; ?>">
                                                                    <input type="hidden" name="txbsubclasspergi"
                                                                           value="<?php echo $seats[$j]->class; ?>">
                                                                    <input type="hidden" name="txbpriceadultpergi"
                                                                           value="<?php echo $seats[$j]->priceAdult; ?>">

                                                                    <button type="button"
                                                                            class="btn btn-danger"
                                                                            data-toggle="tooltip"
                                                                            data-placement="right"
                                                                            data-id="<?php echo $i?>"
                                                                            data-trname="<?php echo $jadwalkereta->data[$i]->trainName; ?>"
                                                                            data-trnumber="<?php echo $jadwalkereta->data[$i]->trainNumber; ?>"
                                                                            data-trgrade="<?php echo $grade; ?>"
                                                                            data-trclass="<?php echo $seats[$j]->class; ?>"
                                                                            data-trdep="<?php echo $jadwalkereta->data[$i]->departureTime; ?>"
                                                                            data-trarr="<?php echo $jadwalkereta->data[$i]->arrivalTime; ?>"
                                                                            title="Sisa Tempat Duduk = <?php echo $seats[$j]->availability ?> "
                                                                            onclick="submitpergi(this)">
                                                                        Pesan Sekarang
                                                                    </button>

                                                                </form>

                                                                <?php
                                                            }

                                                        } else {

                                                            ?>

                                                            <span><label
                                                                        style="color: #ed5565">Kursi Habis</label></span>

                                                            <?php
                                                        }
                                                        ?>

                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                            ?>
                                            <?php
                                        }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>

                                <?php
                            } else {
                                ?>

                                <div class="row text-center">

                                    <h1>DATA TIDAK DITEMUKAN</h1><br/>
                                    <h2>Lakukan Pencarian Jadwal Kereta Kembali</h2><br/>
                                    <a href="<?php echo base_url('kereta') ?>">
                                        <button class="btn btn-danger">Kembali ke form pencarian</button>
                                    </a>

                                </div>

                                <?php
                            }

                        }

                    }
                        ?>

                </div>

            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>

</div>

<!-- /content -->


</div>
