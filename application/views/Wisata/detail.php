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
                <strong>Nama Wisata</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<!-- Content -->

<?php

if($wisata == null)
{
    ?>

    <div class="wrapper wrapper-content animated fadeInDown article" style="margin-top: 150px;">

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="ibox" style="outline: none; border-color: #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">
                    <div class="ibox-content text-center" style="padding: 20px;">

                        <h1>
                            API tidak terkoneksi
                        </h1><br/>
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

    $rc = $wisata->rc;
    $rd = $wisata->rd;

    if($rc != '00'){
        ?>

        <div class="wrapper wrapper-content animated fadeInDown article" style="margin-top: 150px;">

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="ibox" style="outline: none; border-color: #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">
                        <div class="ibox-content text-center" style="padding: 20px;">

                            <h2>Error API : <?php echo $rd;?></h2><br/>
                            <h2>Lakukan Pencarian Kata Kunci Kembali</h2><br/>

                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>

        <?php
    }else{
        $title = $wisata->data->title;
        $location = $wisata->data->location;
        $days = $wisata->data->days;
        $night = $wisata->data->nights;
        if($night > 0){
            $durasi = $days.' Hari, '.$night.' Malam';
        }else{
            $durasi = $days.' Hari';
        }
        $viewer = $wisata->data->viewer;
        $dateva = $wisata->data->dateAvailability;
        if(count($dateva)==null){
            $ketersediaan = 'Semua Tanggal';
        }else{
            $ketersediaan = 'Tanggal Tertentu';
        }
        $tourtype = $wisata->data->tourType;
        $harga = $wisata->data->price;
        $unit = $wisata->data->unit;

        ?>

        <div class="row animated fadeInUp" style="position:fixed; margin-top: 100px; width: 100%; z-index: 1;">
            <div class="col-lg-8 col-lg-offset-2">

                <div class="ibox-content red-bg" style="padding: 30px; outline: none; border-color: #ed5565;box-shadow: 0 0 10px #ed5565;">
                    <h2><?= $title;?></h2>
                    <h3>
                        <i class="fa fa-map-marker"></i> Lokasi : <?= $location;?>
                        | <i class="fa fa-clock-o m-l-md"></i> Durasi : <?= $durasi;?>
                        | <i class="fa fa-eye m-l-md"></i> Jumlah Dilihat :  <?= $viewer;?>
                        | <i class="fa fa-calendar m-l-md"></i> Ketersediaan :  <?= $ketersediaan;?>
                    </h3>
                    <text style="font-size: 16px;">
                        Jenis : <?= str_replace('_',' ',$tourtype);?>
                    </text>

                </div>
                <div class="ibox-content" style="outline: none; border-color: #ed5565;box-shadow: 0 0 10px #ed5565;">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Harga mulai dari : <b>Rp. <?php echo number_format($harga, 0, ',', '.'); ?></b> / <?= $unit;?> </h2>
                        </div>
                        <div class="col-sm-4 text-right m-t-sm">
                            <button type="button" class="btn btn-danger">Pilih Tanggal & Jumlah Peserta</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-2"></div>
        </div>

        <div class="row" style="margin-top: 370px;">

            <div class="col-lg-5 col-lg-offset-2 col-sm-6">

                <?php
                $tourobject = $wisata->data->tourObjects;
                $jmlobjekwisata = count($tourobject);
                    if($jmlobjekwisata>0) {
                    ?>

                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h2>Obyek Wisata</h2>
                        </div>
                        <div class="ibox-content">
                            <text style="font-size: 14px;">
                                <?php
                                for($i= 0 ; $i < $jmlobjekwisata ; $i++ ) {
                                    echo $tourobject[$i].', ';
                                }
                                ?>
                            </text>
                        </div>
                    </div>

                    <?php
                }
                ?>

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h2>Fasilitas</h2>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <?php
                            $fasilitas = $wisata->data->facilities;
                            $exfasilitas = $wisata->data->excludedFacilities;
                            $jmlfasilitas = count($fasilitas);
                            $jmlexfasilitas = count($exfasilitas);
                            ?>
                            <div class="col-xs-6">
                                <text style="font-size: 14px; font-weight: bold;">Termasuk (+) : </text><br/>
                                <hr>
                                <?php
                                if($jmlfasilitas>0){
                                    for($i= 0 ; $i < $jmlfasilitas ; $i++ ) {
                                    ?>
                                    <i class="fa fa-check fa-2x"></i><?php echo $fasilitas[$i] ?><br/>
                                    <?php
                                    }
                                }else{
                                    echo '-';
                                }

                                ?>
                            </div>
                            <div class="col-xs-6">

                                <text style="font-size: 14px; font-weight: bold;">Tidak Termasuk (-) :</text><br/>
                                <hr>
                                <?php
                                for ($i = 0; $i < $jmlexfasilitas; $i++) {
                                    ?>
                                    <i class="fa fa-times m-r-sm"></i><?php echo ucfirst($exfasilitas[$i]) ?><br/>
                                    <?php
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="row">
                            <div class="col-xs-9">
                                <h2>Itenerary / Jadwal Kegiatan</h2>
                            </div>
                            <div class="col-xs-3 text-right">
                                <?php
                                $itinerarytitle= $wisata->data->itenerary->title;
                                $itinerarycontent= $wisata->data->itenerary->content;
                                $itineraryurl= $wisata->data->iteneraryUrl;
                                ?>
                                <a href="<?php echo $itineraryurl;?>">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Download</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-lg-3 col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h2>Gallery</h2>
                    </div>
                    <div class="ibox-content">

                        <div class="lightBoxGallery">

                            <?php
                            $photo = $wisata->data->photos;
                            $jmlimages = count($photo);
                            for($i= 0 ; $i < $jmlimages ; $i++ ) {

                                ?>
                                <a href="<?php echo $photo[$i]; ?>" title="<?php echo $photo[$i]; ?>" data-gallery=""><img src="<?php echo $photo[$i]; ?>" style="height:100px; width: 130px;"></a>
                                <?php
                            }

                            ?>

                            <div id="blueimp-gallery" class="blueimp-gallery">
                                <div class="slides"></div>
                                <h3 class="title"></h3>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="close">×</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        <?php

    }

}
?>

<!-- /content -->
