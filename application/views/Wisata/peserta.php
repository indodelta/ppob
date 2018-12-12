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

<!--<div class="row wrapper border-bottom white-bg page-heading" style="position: fixed; z-index: 2; width: 100%">-->
<!--    <div class="col-lg-10">-->
<!--        <ol class="breadcrumb" style="padding-top: 60px;">-->
<!--            <li>-->
<!--                <a href="--><?php //echo base_url('dashboard')?><!--">Home</a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="--><?php //echo base_url('wisata')?><!--">Wisata</a>-->
<!--            </li>-->
<!--            <li class="active">-->
<!--                <strong>Nama Wisata</strong>-->
<!--            </li>-->
<!--        </ol>-->
<!--    </div>-->
<!--    <div class="col-lg-2">-->
<!---->
<!--    </div>-->
<!--</div>-->

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
        $this->load->view('func_custom');

        $totalharga = $this->input->post('txbtotalharga',true);
        $jumlahpeserta = $this->input->post('txbjumlahpeserta',true);
        $tanggalpilih = $this->input->post('txbpilihtanggal',true);

        $destid = $wisata->data->destinationId;
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
//        $dateva = $wisata->data->dateAvailability;
//        if(count($dateva)==null){
//            $ketersediaan = 'Semua Tanggal';
//        }else{
//            $ketersediaan = 'Tanggal Tertentu';
//        }
        $tourtype = $wisata->data->tourType;
        $harga = $wisata->data->price;
        $unit = $wisata->data->unit;

        ?>

        <div class="row animated fadeInUp" style="position:fixed; margin-top: 60px; width: 100%; z-index: 2;">
            <div class="col-lg-8 col-lg-offset-2">

                <div class="carousel slide" id="carousel2" style="height: 250px">
                    <ol class="carousel-indicators">
                        <li data-slide-to="0" data-target="#carousel2" class="active"></li>
                        <li data-slide-to="1" data-target="#carousel2"></li>
                        <li data-slide-to="2" data-target="#carousel2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                        <?php
                        $photo = $wisata->data->photos;
                        $jmlimages = count($photo);
                        for($i= 0 ; $i < $jmlimages ; $i++ ) {

                            ?>
                            <div class="item <?php if($i==0){echo 'active';} ?>">
                                <img alt="image"
                                     class="img-responsive"
                                     style="width: 100%; height: 100%;"
                                     src="<?php echo $photo[$i]; ?>"
                                     onerror="this.src = '<?php echo base_url('assets/img/No_Image_Available.png');?>';">
                            </div>
                            <?php
                        }

                        ?>
                    </div>
                    <a data-slide="prev" href="#carousel2" class="left carousel-control">
                        <span class="icon-prev"></span>
                    </a>
                    <a data-slide="next" href="#carousel2" class="right carousel-control">
                        <span class="icon-next"></span>
                    </a>
                </div>

                <div class="ibox-content red-bg"
                     style="padding: 30px;
                            outline: none;
                            border-color: #ed5565;
                            box-shadow: 0 0 10px #ed5565;">
                    <h2><?= $title;?></h2>
                    <h3>
                        <i class="fa fa-map-marker"></i> Lokasi : <?= $location;?>
                        | <i class="fa fa-clock-o m-l-md"></i> Durasi : <?= $durasi;?>
                        | <i class="fa fa-eye m-l-md"></i> Jumlah Dilihat :  <?= $viewer;?>
                        <!--                        | <i class="fa fa-calendar m-l-md"></i> Ketersediaan :  --><?//= $ketersediaan;?>
                    </h3>
                    <text style="font-size: 16px;">
                        Tanggal Liburan : <?= tanggalindo($tanggalpilih);?><br/>
                        Jumlah Peserta : <?= $jumlahpeserta;?> Orang<br/>
                        Jenis : <?= str_replace('_',' ',$tourtype);?>
                    </text>

                </div>

                <div class="ibox-content" style="outline: none; border-color: #ed5565;box-shadow: 0 0 10px #ed5565;">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Total Harga : <b>Rp. <?php echo number_format($totalharga, 0, ',', '.'); ?></b></h2>
                        </div>
                        <div class="col-sm-4 text-right m-t-sm">
                            <button type="button" id="btnshowpesanan" class="btn btn-danger">Pesan</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-2"></div>
        </div>

        <?php

    }

}
?>

<!-- /content -->
