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

 Content

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
        $harga = $wisata->data->price;
        $unit = $wisata->data->unit;

        ?>

        <div class="row" style="margin-top: 100px;">

            <form id="formbooking" class="form-horizontal" method="post" action="booking" autocomplete="off">

                <div class="col-lg-6 col-lg-offset-2 col-xs-8">

                    <div class="ibox animated fadeInUp" style="outline: none; border-color: #F4F4F4;box-shadow: 0 0 50px #F4F4F4;">

                        <div class="ibox-title red-bg">
                            <h2>Data Pemesan (Kontak)</h2>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Nama <span style="color:#ed5565">*</span></label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" name="txbnamapemesan">
                                    <span class="help-block m-b-none">Nama lengkap sesuai dengan KTP/Paspor/SIM(tanpa tanda baca/gelar)</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-3">Email <span style="color:#ed5565">*</span></label>
                                <div class="col-xs-9">
                                    <input type="email" class="form-control" name="txbemailpemesan">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-3">No Telp / Handphone <span style="color:#ed5565">*</span></label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" name="txbtlppemesan" placeholder="081xxxxxxxx">
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="ibox animated fadeInUp m-t-lg" style="outline: none; border-color: #F4F4F4;box-shadow: 0 0 50px #F4F4F4;">

                        <div class="ibox-title red-bg">
                            <h2>Data Peserta</h2>
                        </div>

                        <?php
                        $j = 1;
                        for ($i = 0; $i < $jumlahpeserta; $i++) {
                            ?>

                            <div class="ibox-content">

                                <div class="form-group">
                                    <label class="control-label col-xs-1"><?php echo $j;?>).</label>
                                    <label class="control-label col-xs-2">Nama</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" name="<?php echo 'txbnamapeserta'.$j ?>">
                                        <span class="help-block m-b-none">Nama lengkap sesuai dengan KTP/Paspor/SIM(tanpa tanda baca/gelar)</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-3">Email</label>
                                    <div class="col-xs-9">
                                        <input type="email" class="form-control" name="<?php echo 'txbemailpeserta'.$j ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-3">No Telp / Handphone</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" name="<?php echo 'txbtelppeserta'.$j ?>" placeholder="081xxxxxxxx">
                                    </div>
                                </div>

                            </div>

                            <?php
                            $j++;
                        }
                        ?>

                    </div>

                </div>
                <div class="col-lg-2 col-lg-offset-8 col-xs-4 col-xs-offset-8" style="position: fixed;">

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="carousel slide" id="carousel2" style="height: 250px">
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
                                                 onerror="this.src = '<?php echo base_url('assets/img/No_Image_Available.png');?>//';">
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

                        </div>
                    </div>

                    <div class="ibox-content red-bg"
                         style="padding: 30px;
                                outline: none;
                                border-color: #ed5565;
                                box-shadow: 0 0 10px #ed5565;">
                        <div class="row">
                            <div class="col-lg-12">

                                <h2><?= $title;?></h2>
                                <text style="font-size: 12px;">
                                    <i class="fa fa-map-marker"></i> Lokasi : <?= $location;?><br/>
                                    <i class="fa fa-clock-o"></i> Durasi : <?= $durasi;?>
                                </text><br/>
                                <hr>
                                <text style="font-size: 16px;">
                                    Tanggal Liburan : <br/><?= tanggalindo($tanggalpilih);?><br/>
                                    <br/>
                                    Jumlah Peserta : <br/><?= $jumlahpeserta;?> Orang
                                </text>

                            </div>
                        </div>

                    </div>

                    <div class="ibox-content"
                         style="outline: none;
                                    border-color: #ed5565;
                                    box-shadow: 0 0 10px #ed5565;">
                        <div class="row">
                            <div class="col-lg-8">
                                <h2>Total Harga :
                                    <br/>
                                    <b>Rp. <?php echo number_format($totalharga, 0, ',', '.'); ?></b></h2>
                            </div>
                            <div class="col-lg-4 text-right m-t-sm">
                                <button type="submit" id="btnshowpesanan" class="btn btn-danger">Pesan</button>
                            </div>
                        </div>
                    </div>

                </div>

            </form>

        </div>


        <?php

    }

}
?>

<!-- /content -->
