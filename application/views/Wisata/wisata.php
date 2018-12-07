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
        <div class="col-lg-4 col-lg-offset-2">

            <h2>Kategori</h2>

            <?php
            $count = 1;
            foreach ($data_wisata_kategori as $data_wisata_kategori) {
                $nama = $data_wisata_kategori->nama;
                if ($count%4 == 1)
                {
                    echo "<div class='row'>";
                }
                ?>

                <div class="col-sm-3">
                    <a href="<?php echo base_url('wisata/cari?key='.$nama)?>">
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <text class="font-bold" style="font-size: 14px;"><?php echo $nama; ?></text>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <?php
                if ($count%4 == 0)
                {
                    echo "</div>";
                }
                $count++;
            }
            if ($count%4 != 1) echo "</div>";
            ?>

        </div>
        <div class="col-lg-4">
            <h2>Area Populer</h2>

            <table class="table no-borders">
                <tr class="no-borders">

            <?php
            $i = 1;
            foreach ($data_wisata_area as $data_wisata_area) {
                $nama = $data_wisata_area->nama;
                $img = $data_wisata_area->img;
                ?>
                    <td class="no-borders">
                        <a href="<?php echo base_url('wisata/cari?key='.$nama)?>">
                        <div class="ibox-content"
                             style="background-image: url('<?php echo base_url('assets/img/wisata/'.$img); ?>');
                                     background-size: cover;
                                     background-repeat: no-repeat;
                                     outline: none;
                                     border-color:
                                     #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">
                            <h2 style="color: white; font-weight: bolder"><?= $nama; ?></h2>
                            <p style="height: 100px;">&nbsp;</p>
                        </div>
                        </a>
                    </td>

                <?php
                if ($i % 2 == 0) echo "</tr><tr class='no-borders'>";
                $i++;
            }
            ?>

            </table>

        </div>
        <div class="col-lg-2"></div>

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
                    <a href="<?php echo base_url('wisata/cari?key='.$nama)?>">
                        <div>
                            <div class="ibox-content"
                                 style="background-image: url('<?php echo base_url('assets/img/wisata/'.$img); ?>');
                                         background-size: cover;
                                         background-repeat: no-repeat;
                                         margin: 0 10px;
                                         outline: none;
                                         border-color:
                                         #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">
                                <h2 style="color: white; font-weight: bolder"><?= $nama; ?></h2>
                                <p style="height: 100px;">&nbsp;</p>
                            </div>
                        </div>
                    </a>

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
                    <a href="<?php echo base_url('wisata/cari?key='.$nama)?>">
                        <div>
                            <div class="ibox-content"
                                 style="background-image: url('<?php echo base_url('assets/img/wisata/'.$img); ?>');
                                         background-size: cover;
                                         background-repeat: no-repeat;
                                         margin: 0 10px;
                                         outline: none;
                                         border-color:
                                         #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">
                                <h2 style="color: white; font-weight: bolder"><?= $nama; ?></h2>
                                <p style="height: 100px;">&nbsp;</p>
                            </div>
                        </div>
                    </a>

                    <?php
                }
                ?>
            </div>

        </div>

    </div>

<!-- /content -->


</div>
