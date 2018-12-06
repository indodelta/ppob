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
            <li class="active">
                <strong>Cari Tempat Wisata</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->


<div class="wrapper wrapper-content  animated fadeInRight article">

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">

            <div class="carousel slide" id="carousel2" style="height: 350px">
                <ol class="carousel-indicators">
                    <li data-slide-to="0" data-target="#carousel2" class="active"></li>
                    <li data-slide-to="1" data-target="#carousel2"></li>
                    <li data-slide-to="2" data-target="#carousel2" class=""></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img alt="image" class="img-responsive" style="width: 100%; height: 100%;" src="<?php echo base_url('assets/img/wisata/carousel1.jpg');?>">
                    </div>
                    <div class="item ">
                        <img alt="image" class="img-responsive" style="width: 100%; height: 100%;" src="<?php echo base_url('assets/img/wisata/carousel2.jpg');?>">
                    </div>
                    <div class="item">
                        <img alt="image" class="img-responsive" style="width: 100%; height: 100%;" src="<?php echo base_url('assets/img/wisata/carousel3.jpg');?>">
                    </div>
                </div>
                <a data-slide="prev" href="#carousel2" class="left carousel-control">
                    <span class="icon-prev"></span>
                </a>
                <a data-slide="next" href="#carousel2" class="right carousel-control">
                    <span class="icon-next"></span>
                </a>
            </div>

            <div class="search-form" style="position: absolute; top: 200px; left: 70px; right: 70px;">
                <form action="wisata/cari" method="get" autocomplete="off">
                    <div class="input-group">
                        <input type="text"
                               placeholder="Cari berdasarkan Nama Kota, Nama Daerah, Nama Tempat Wisata"
                               name="key"
                               class="form-control input-lg">
                        <div class="input-group-btn">
                            <button class="btn btn-lg btn-danger" type="submit">
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">

            <h2>Kota Populer</h2>

            <div class="slick_demo_2">

                <?php
                foreach ($data_wisata_kota as $data_wisata_kota) {
                    $nama = $data_wisata_kota->nama;
                    $img = $data_wisata_kota->img;
                    ?>
                    <div>
                        <div class="ibox-content"
                             style="background-image: url('<?php echo base_url('assets/img/wisata/'.$img); ?>');
                                     background-size: cover;
                                     background-repeat: no-repeat;
                                     margin: 0 10px;">
                            <h2 style="color: white; font-weight: bolder"><?= $nama; ?></h2>
                            <p style="height: 100px;">&nbsp;</p>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">

            <h2>Provinsi Populer</h2>

            <div class="slick_demo_2">

                <?php
                foreach ($data_wisata_prov as $data_wisata_prov) {
                    $nama = $data_wisata_prov->nama;
                    $img = $data_wisata_prov->img;
                    ?>
                    <div>
                        <div class="ibox-content"
                             style="background-image: url('<?php echo base_url('assets/img/wisata/'.$img); ?>');
                                     background-size: cover;
                                     background-repeat: no-repeat;
                                     margin: 0 10px;">
                            <h2 style="color: white; font-weight: bolder"><?= $nama; ?></h2>
                            <p style="height: 100px;">&nbsp;</p>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">

            <h2>Area Populer</h2>

            <div class="slick_demo_2">

                <?php
                foreach ($data_area_prov as $data_area_prov) {
                    $nama = $data_area_prov->nama;
                    $img = $data_area_prov->img;
                    ?>
                    <div>
                        <div class="ibox-content"
                             style="background-image: url('<?php echo base_url('assets/img/wisata/'.$img); ?>');
                                     background-size: cover;
                                     background-repeat: no-repeat;
                                     margin: 0 10px;">
                            <h2 style="color: white; font-weight: bolder"><?= $nama; ?></h2>
                            <p style="height: 100px;">&nbsp;</p>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </div>

        </div>

    </div>

<!-- /content -->


</div>
