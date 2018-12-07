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

<div class="row wrapper border-bottom white-bg page-heading" style="position: fixed; z-index: 1; width: 100%">
    <div class="col-lg-10">
        <ol class="breadcrumb" style="padding-top: 60px;">
            <li>
                <a href="<?php echo base_url('dashboard')?>">Home</a>
            </li>
            <li>
                <a href="<?php echo base_url('wisata')?>">Wisata</a>
            </li>
            <li class="active">
                <strong>Hasil Pencarian</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<!-- Content -->

<div class="row" style="position: fixed; z-index: 1; width: 100%; margin-top: 80px;">

        <div class="col-lg-8 col-lg-offset-2">

            <div class="search-form">
                <form action="cari" method="get" autocomplete="off">
                    <div class="input-group">
                        <input type="text"
                               name="key"
                               id="txbkey"
                               value="<?php echo $key;?>"
                               placeholder="Cari berdasarkan Nama Kota, Nama Daerah, Nama Tempat Wisata"
                               class="form-control input-lg"
                               onclick="cleartxbkey()">
                        <div class="input-group-btn">
                            <button class="btn btn-lg btn-danger" type="submit">
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="col-lg-2"></div>

</div>

<?php

$rc = $datacari->rc;
$rd = $datacari->rd;

if($rc != '00'){
    ?>

    <div class="wrapper wrapper-content animated fadeInDown article" style="margin-top: 150px;">

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="ibox" style="outline: none; border-color: #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">
                    <div class="ibox-content text-center" style="padding: 20px;">

                        <h1>
                            KATA KUNCI WISATA TIDAK DITEMUKAN
                        </h1><br/>
                        <h2>Error API : <?php echo $rd;?></h2><br/>
                        <h2>Lakukan Pencarian Kata Kunci Kembali</h2><br/>
                        <a href="<?php echo base_url('wisata')?>"><button class="btn btn-danger">Kembali ke form pencarian</button></a>

                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>

    <?php
}else{

    $jmldatawisata = count($datacari->data);

    ?>

    <div class="row" style="position: fixed; z-index: 1; width: 100%; margin-top: 150px;">
        <div class="col-lg-2 col-lg-offset-2 col-sm-4">

            <div class="ibox" style="width: 100%;">
                <div class="ibox-title">
                    <h3>
                        <i class="fa fa-search"></i>
                        <?php echo $jmldatawisata.' Hasil Pencarian ditemukan'?>
                    </h3>
                </div>
            </div>

            <div class="ibox" style="width: 100%;">
                <div class="ibox-title">
                    <h3>Sorting Berdasarkan</h3>
                </div>
                <div class="ibox-content" style="padding-bottom: 0px;">

                    <form class="form-horizontal" id="formsorting" method="get" action="cari">

                        <input type="hidden" name="key" value="<?php echo $key; ?>">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <select class="form-control m-b" name="sorting" id="sorting" onchange="this.form.submit()">
                                    <option value="1" <?php if($sort == 1){echo 'selected';} ?>>Terbaru</option>
                                    <option value="2" <?php if($sort == 2){echo 'selected';} ?>>Harga: Rendah ke Tinggi</option>
                                    <option value="3" <?php if($sort == 3){echo 'selected';} ?>>Harga: Tinggi ke Rendah</option>
                                    <option value="4" <?php if($sort == 4){echo 'selected';} ?>>Populer: Rendah ke Tinggi</option>
                                    <option value="5" <?php if($sort == 5){echo 'selected';} ?>>Populer: Tinggi ke Rendah</option>
                                </select>
                            </div>
                        </div>

                        <div id="loadingsorting" style="display: none;">Loading data...</div>

                    </form>

                </div>
            </div>

            <div class="ibox" style="width: 100%;">
                <div class="ibox-title">
                    <h3>Durasi</h3>
                </div>
                <div class="ibox-content" style="padding-bottom: 0px; max-height: 150px; overflow-x: hidden; overflow-y: scroll;">

                    <form class="form-horizontal" id="formdurasi" method="get" action="#">

                        <div class="i-checks-durasi">
                            <?php
                            for ($x = 0; $x < $jmldatawisata; $x++) {
                                $days = $datacari->data[$x]->days;
                                $result[$days] = null;
                            }
                            $days = array_keys($result);
                            ?>
                            <?php
                            for ($x = 0; $x < count($days); $x++) {
                                ?>
                                <input type="checkbox"
                                       name="durasi"
                                       value="<?php echo $days[$x];?>"
                                       class="durasi">
                                <span><?php echo $days[$x].' Hari';?></span><br><br>
                                <?php
                            }
                            ?>

                        </div>

                    </form>

                </div>
            </div>

            <div class="ibox" style="width: 100%;">
                <div class="ibox-title">
                    <h3>Provinsi</h3>
                </div>
                <div class="ibox-content" style="padding-bottom: 0px; max-height: 250px; overflow-x: hidden; overflow-y: scroll;">

                    <form class="form-horizontal" id="formprovinsi" method="get" action="#">

                        <div class="i-checks-propinsi">
                            <?php
                            for ($x = 0; $x < $jmldatawisata; $x++) {
                                $propinsi = $datacari->data[$x]->nama_propinsi;
                                $res[$propinsi] = null;
                            }
                            $prop = array_keys($res);
                            ?>
                            <?php
                            for ($x = 0; $x < count($prop); $x++) {
                                ?>
                                <input type="checkbox"
                                       name="propinsi"
                                       value="<?php echo str_replace(' ', '', $prop[$x]);?>"
                                       class="propinsi">
                                <span><?php echo $prop[$x];?></span><br><br>
                                <?php
                            }
                            ?>

                        </div>

                    </form>

                </div>
            </div>

        </div>
        <div class="col-lg-8 col-sm-8"></div>

    </div>

    <div class="wrapper wrapper-content animated fadeInUp article" style="margin-top: 150px;">

        <div class="row">
            <div class="col-lg-2 col-lg-offset-2 col-sm-4"></div>
            <div class="col-lg-6 col-sm-8">

                <input type="hidden" id="txbjumlahwisata" value="<?php echo $jmldatawisata ?>">

                <?php
                for ($x = 0; $x < $jmldatawisata; $x++) {
                    $id_destinasi = $datacari->data[$x]->id_destinasi;
                    $image = $datacari->data[$x]->foto;
                    $nama_destinasi = $datacari->data[$x]->nama_destinasi;
                    $nama_provinsi = $datacari->data[$x]->nama_propinsi;
                    $days = $datacari->data[$x]->days;
                    $nights = $datacari->data[$x]->nights;
                    $jumlah_hari = $days . ' Hari';
                    if ($nights > 0) {
                        $jumlah_hari = $jumlah_hari . ' ' . $nights . ' Malam';
                    }
                    $harga = $datacari->data[$x]->harga;
                    $obyek_wisata = $datacari->data[$x]->obyek_wisata;
                    $viewer = $datacari->data[$x]->viewer;
                    $divid = 'ibox'.$x;
                    $div[$divid] = null;
                    $namaclasshari = $days;
                    $namaclassprop = str_replace(' ', '', $nama_provinsi);
                    ?>

                    <div class="ibox product-detail <?php echo $namaclasshari.' '.$namaclassprop;?>"
                         id="<?php echo $divid;?>"
                         style="outline: none; border-color: #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">

                        <div class="ibox-content" style="padding: 20px;">

                            <div class="row">
                                <div class="col-sm-5">

                                    <div class="product-images">

                                        <div class="image-imitation" style="padding: 0px;">
                                            <img alt="foto" src="<?php echo $image; ?>"
                                                 onerror="this.src = '<?php echo base_url('assets/img/No_Image_Available.png');?>';"
                                                 style="width: 100%; height: 20%;">
                                        </div>

                                    </div>

                                </div>
                                <div class="col-sm-7">

                                    <h2 class="font-bold m-b-xs">
                                        <?php echo $nama_destinasi; ?>
                                    </h2>
                                    <small>
                                        <i class="fa fa-map-marker"></i> <?php echo $nama_provinsi; ?>
                                        <i class="fa fa-clock-o m-l-lg"></i> <?php echo $jumlah_hari; ?>
                                        | <i class="fa fa-eye m-l-xs"></i> <?php echo $viewer; ?>
                                    </small>
                                    <div class="m-t-md">
                                        <h2 class="product-main-price">
                                            Rp. <?php echo number_format($harga, 0, ',', '.'); ?></h2>
                                    </div>
                                    <hr>

                                    <div class="col-sm-9">
                                        <div class="small text-muted">
                                            <?php
                                            $jmlobyekwisata = count($obyek_wisata);
                                            if ($jmlobyekwisata > 0) {
                                                echo '<h3>Obyek Wisata</h3>';
                                                for ($z = 0; $z < $jmlobyekwisata; $z++) {
                                                    echo $obyek_wisata[$z] . ' ,';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 text-right">
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-arrow-right"></i> Detail
                                        </button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <?php
                }
                $namadiv = array_keys($div);
                $namadiv = implode(",",$namadiv);
                ?>

                <input type="hidden" id="txbnamadiv" value="<?php echo $namadiv;?>">

            </div>
            <div class="col-lg-2"></div>
        </div>

    </div>

    <?php
}
?>


<!-- /content -->
