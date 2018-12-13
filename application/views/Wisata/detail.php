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
        $this->load->view('func_custom');

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

        <div class="row animated fadeInUp" style="position:fixed; margin-top: 100px; width: 100%; z-index: 1;">
            <div class="col-lg-8 col-lg-offset-2">

                <div class="ibox-content red-bg" style="padding: 30px; outline: none; border-color: #ed5565;box-shadow: 0 0 10px #ed5565;">
                    <h2><?= $title;?></h2>
                    <h3>
                        <i class="fa fa-map-marker"></i> Lokasi : <?= $location;?>
                        | <i class="fa fa-clock-o m-l-md"></i> Durasi : <?= $durasi;?>
                        | <i class="fa fa-eye m-l-md"></i> Jumlah Dilihat :  <?= $viewer;?>
<!--                        | <i class="fa fa-calendar m-l-md"></i> Ketersediaan :  --><?//= $ketersediaan;?>
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
                            <a href="#divpesanan">
                                <button type="button" id="btnshowpesanan" class="btn btn-danger">Pilih Tanggal & Jumlah Peserta</button>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-2"></div>
        </div>

        <div class="row" style="margin-top: 370px;">

            <div class="form-group">

                <div class="col-lg-5 col-lg-offset-2 col-sm-6">

                    <?php
                    $tourobject = $wisata->data->tourObjects;
                    $jmlobjekwisata = count($tourobject);
                        if($jmlobjekwisata>0) {
                        ?>

                        <div class="ibox float-e-margins" style="outline: none; border-color: #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">
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

                    <div class="ibox float-e-margins" style="outline: none; border-color: #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">
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
                                        <i class="fa fa-check m-r-sm"></i><?php echo ucfirst($fasilitas[$i]) ?><br/>
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

                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="ibox float-e-margins" style="outline: none; border-color: #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h2>Jadwal Kegiatan</h2>
                                </div>
                                <div class="col-lg-6 text-right">
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

                    <div class="ibox float-e-margins" style="outline: none; border-color: #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">
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
                                    <a href="<?php echo $photo[$i]; ?>" title="<?php echo $photo[$i]; ?>" data-gallery="">
                                        <img src="<?php echo $photo[$i]; ?>"
                                             onerror="this.src = '<?php echo base_url('assets/img/No_Image_Available.png');?>';"
                                             style="height:100px; width: 130px;">
                                    </a>
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

        </div>

        <div class="row">

            <form id="formpesanan" method="post" action="#">

                <div class="form-group" id="divpesanan">

                    <div class="col-lg-8 col-lg-offset-2">

                        <input type="hidden" id="txbcolor" value="#ed5565">

                        <div class="ibox float-e-margins"
                             style="outline: none; border-color: #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">
                            <div class="ibox-title">
                                <h2>Pesanan Anda :</h2>
                            </div>
                            <div class="ibox-content" style="padding: 20px;">
                                <div class="row">
                                    <div class="col-lg-6" style="z-index: 0; border-right: solid 3px #F3F3F4; padding: 20px;">
                                        <div id="calendar"></div>
                                        <span class="help-block m-b-none">Silahkan klik pilihan tanggal anda sesua tanggal tersedia</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php
                                        $prices = $wisata->data->prices;
                                        $jumlahprices = count($prices);

                                        $tanggaltersedia = '';
                                        $arrtanggal = '';
                                        $arrratehotel = '';
                                        $arrquota = '';

                                        if($jumlahprices>0){
                                            $tanggalawaltersedia = $prices[0]->tanggal;
                                            $tanggalakhirtersedia = $prices[$jumlahprices - 1]->tanggal;


                                            for ($i = 0; $i < $jumlahprices; $i++) {
                                                $tanggal = $prices[$i]->tanggal;
                                                $ratehotel = $prices[$i]->rate_hotel;
                                                $quota = $prices[$i]->quota;
                                                $tanggalindo = tanggalindo($tanggal);

                                                $arraytanggal[$tanggal] = null;
                                                $arrayratehotel[$i] = $ratehotel;
                                                $arrayquota[$i] = $quota;

                                                $tanggaltersedia = $tanggaltersedia.', '.$tanggalindo;
                                            }

                                            $arrtanggal = array_keys($arraytanggal);
                                            $arrtanggal = implode(",",$arrtanggal);

                                            $arrratehotel = implode(",",$arrayratehotel);
                                            $arrquota = implode(",",$arrayquota);

                                            $tanggaltersedia = ltrim($tanggaltersedia, ', ');

                                            if($tourtype == 'OPEN_TRIP'){
                                                $tglawalindo = tanggalindo($tanggalawaltersedia);
                                                $tglakhirindo = tanggalindo($tanggalakhirtersedia);

                                                $tanggaltersedia = $tglawalindo.' - '.$tglakhirindo;
                                            }
                                        }

                                        $paxlist = $wisata->data->paxList;
                                        $jumlahpaxlist = count($paxlist);
                                        $paxlistawal = 0;
                                        $paxlistakhir = 0;
                                        if($jumlahpaxlist>0){
                                            $paxlistawal = $paxlist[0];
                                            $paxlistakhir = $paxlist[$jumlahpaxlist - 1];
                                        }

                                        $listprice = $wisata->data->listPrice;
                                        $jumlahlistprice = count($listprice);

                                        ?>
                                        <div class="form-group m-t-lg">
                                            <b><text style="font-size: 16px;">Tanggal Tersedia: <?= $tanggaltersedia;?></text></b>
                                            <input type="hidden" id="txbarraytanggal" value="<?php echo $arrtanggal ?>" readonly>
                                            <input type="hidden" id="txbarrayratehotel" value="<?php echo $arrratehotel ?>" readonly>
                                            <input type="hidden" id="txbarrayquota" value="<?php echo $arrquota ?>" readonly>
                                            <input type="hidden" id="txbtourtype" value="<?php echo $tourtype ?>" readonly>
                                            <input type="hidden" id="txbjumlahprices" value="<?php echo $jumlahprices ?>" readonly>
                                            <input type="hidden" id="txbpaxlistawal" value="<?php echo $paxlistawal ?>" readonly>
                                            <input type="hidden" id="txbpaxlistakhir" value="<?php echo $paxlistakhir ?>" readonly>
                                            <input type="hidden" id="txbratehotel" readonly>
                                        </div>

                                        <div class="form-group">
                                            <text style="font-size: 16px;">Pilihan Tanggal: </text>
                                            <input type="text" id="txbpilihantanggal"
                                                   style="color:#ed5565; background-color: transparent; border-color: transparent; font-size: 16px;" readonly>
                                            <text style="font-size: 16px;">Kuota: </text>
                                            <input type="text" id="txbquota"
                                                   style="color:#ed5565; background-color: transparent; border-color: transparent; font-size: 16px;" readonly>
                                            <input type="hidden" id="txbpilihtanggal" name="txbpilihtanggal" readonly>
                                        </div>

                                        <div class="form-group">
                                            <text style="font-size: 16px;">Jumlah Peserta : </text>
                                            <input type="number" id="txbjumlahpeserta" name="txbjumlahpeserta" class="form-control" value="<?php echo $paxlistawal;?>" min="<?php echo $paxlistawal;?>" max="<?php echo $paxlistakhir;?>" onchange="ubahjumlahpeserta()" required>
                                            <span class="help-block m-b-none">Min = <?php echo $paxlistawal;?> Orang, Max = <?php echo $paxlistakhir;?> Orang</span>
                                        </div>

                                        <div class="form-group">
                                            <text style="font-size: 16px;">List Harga : </text>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <tr class="text-center">
                                                        <th class="text-center">Peserta Tour</th>
                                                        <th class="text-center">Harga (/pax)</th>
                                                    </tr>
                                                    <?php
                                                    $arrjmlpesertalistprices = '';
                                                    $arrhargalistprices = '';
                                                    if($jumlahlistprice>0) {
                                                        for ($i = 0; $i < $jumlahlistprice; $i++) {
                                                            $jumlahpesertalistprice = $listprice[$i][0];
                                                            $hargalistprice = $listprice[$i][1];

                                                            $arrayjmlpesertalistprices[$i] = $jumlahpesertalistprice;
                                                            $arrayhargalistprices[$i] = $hargalistprice;
                                                            ?>
                                                            <tr class="text-center">
                                                                <td><?php echo $jumlahpesertalistprice ?></td>
                                                                <td><?php echo number_format($hargalistprice, 0, ',', '.'); ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        $arrjmlpesertalistprices = implode(",",$arrayjmlpesertalistprices);
                                                        $arrhargalistprices = implode(",",$arrayhargalistprices);
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                            <input type="hidden" id="txbjumlahlistprices" value="<?php echo $jumlahlistprice ?>" readonly>
                                            <input type="hidden" id="txbarrayjmlpesertalistprices" value="<?php echo $arrjmlpesertalistprices ?>" readonly>
                                            <input type="hidden" id="txbarrayhargalistprices" value="<?php echo $arrhargalistprices ?>" readonly>

                                        </div>

                                        <div class="form-group text-right">
                                            <text style="font-size: 16px;">Total Harga: </text>
                                            <input type="text" id="txbtotalhargarupiah" value="<?php echo 'Rp '.number_format($listprice[0][1] , 0, ',', '.')?>"
                                                   style="color:#ed5565; background-color: transparent; border-color: transparent; font-size: 20px;" readonly>
                                            <input type="hidden" id="txbtotalharga" name="txbtotalharga" value="<?php echo $listprice[0][1]?>" readonly>
                                            <input type="hidden" name="txbiddest" value="<?php echo $destid?>" readonly>
                                            <button type="button" class="btn btn-danger" onclick="submitform()">PESAN</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>

                </div>

            </form>

        </div>

        <?php

    }

}
?>

<!-- /content -->
