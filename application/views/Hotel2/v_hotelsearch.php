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
                <a href="<?php echo base_url('hotel')?>">Hotel</a>
            </li>
            <li class="active">
                <strong>Hasil Pencarian Hotel</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->

<div class="wrapper wrapper-content article">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">

            <div class="ibox float-e-margins">

                <!-- Judul Pergi dan Tujuan -->

                <?php
                $this->load->view('func_custom');

                $namakotahotel = $this->input->post('txbnamakotahotel');
                $jmlmalam = $this->input->post('txbjmlmalam');
                $jmlkamar = $this->input->post('txbjmlkamar');
                $jmltamu = $this->input->post('txbjmltamu');

                $jenisgroup = $this->input->post('txbgroup',true);

                $tglcheckin = $this->input->post('txbcheckin');
                $split = explode('/', $tglcheckin);
                $bulan = bulan($split[1]);
                $tanggalcheckin = $split[0] . ' ' . $bulan . ' ' .$split[2];

                $tglcheckout = $this->input->post('txbcheckout');
                $splitout = explode('/', $tglcheckout);
                $bulanout = bulan($splitout[1]);
                $tanggalcheckout = $splitout[0] . ' ' . $bulanout . ' ' .$splitout[2];
                ?>

                <div class="ibox-content red-bg">

                    <input type="hidden" value="carihotel" name="txbpage" id="txbpage">

                    <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">

                    <div class="row">
                        <div class="col-lg-9">
                            <h2><?php echo $namakotahotel; ?></h2>
                            <h3>
                                <i class="fa fa-calendar"></i>
                                <?php echo $tanggalcheckin ?>
                                - <?php echo $tanggalcheckout; ?>
                                | <i class="fa fa-user"></i> <?php echo $data_api['param']['guest']; ?> Orang
                                | <i class="fa fa-hotel"></i> <?php echo $data_api['param']['room']; ?> Kamar
                            </h3>
                        </div>
                        <div class="col-lg-3">
                            <a href="#" onclick="showubahcari()" style="color: white" id="btnubahcari"><h3>Ubah Pencarian</h3></a>
                        </div>
                    </div>

                </div>

                <!-- Modal cari kota / hotel-->
                <div class="modal inmodal fade" id="modal-cari-hotel" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <i class="fa fa-search modal-icon"></i>
                                <h4 class="modal-title">Cari Kota atau Hotel</h4>
                            </div>
                            <div class="modal-body">

                                <div id="search-form" class="search-form">
                                    <form autocomplete="off">
                                        <div class="input-group">
                                            <input type="text" placeholder="Masukkan kata kunci nama kota atau hotel" name="txbsearchkeyword" id="txbsearchkeyword" class="form-control input-lg" onclick="cleartext()">
                                            <div class="input-group-btn">
                                                <button class="btn btn-lg btn-danger" type="button" onclick="searchcityhotel()">
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div id="loading">Loading data...</div>
                                <div class="hr-line-solid"></div>
                                <h3>Data Pencarian</h3>
                                <div class="hr-line-solid"></div>
                                <div id="searchresults" class="search-result table-responsive" style="height: 500px; overflow-y: scroll">

                                    <div class="col-lg-12" id="popularList">

                                        <table class="table table-responsive">

                                            <tr>
                                                <td> Destinasi Populer : </td>
                                            </tr>

                                            <?php
                                            $jmldatapopular = count($data_popular->data);

                                            if($jmldatapopular>0){

                                                for($i= 0 ; $i < $jmldatapopular ; $i++ )
                                                {
                                                    $label = $data_popular->data[$i]->label;
                                                    $label_location = $data_popular->data[$i]->label_location;
                                                    $group = $data_popular->data[$i]->group;
                                                    $key = $data_popular->data[$i]->key;

                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <i class='fa fa-map-marker'></i>
                                                            <button data-label='<?php echo $label?>'
                                                                    data-key ='<?php echo $key ?>'
                                                                    data-group = '<?php echo $group ?>'
                                                                    data-labellocation='<?php echo $label_location ?>'
                                                                    onclick='pilihcityhotel(this)'
                                                                    style='background-color: transparent; border: none;'>
                                                                <?php echo $data_popular->data[$i]->label ?>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }

                                            }
                                            ?>

                                        </table>

                                    </div>

                                    <table class="table table-responsive" id="searchList">
                                        <tr></tr>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- Form Pencarian -->

                <div class="ibox-content formubahcari" id="formubahcari" style="padding-top: 15px; padding-bottom: 5px; display: none;">

                    <form id="formcarihotel" class="form-horizontal" method="post" autocomplete="off">

                        <div class="form-group">

                            <div class="col-lg-12">
                                <label>Nama Kota /  Hotel</label>
                                <input type="text"
                                       id="txbnamakotahotel"
                                       name="txbnamakotahotel"
                                       class="form-control"
                                       placeholder="Hotel atau Kota yang dipilih"
                                       readonly
                                       style="background-color: transparent"
                                       onclick="onclicktxbsearchotel()"
                                       value="<?php echo $namakotahotel; ?>"
                                       required>
                                <input type="hidden" id="txbgroup" name="txbgroup">
                                <input type="hidden" id="txbkey" name="txbkey">
                                <input type="hidden" id="txbalamat" name="txbalamat">
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-lg-3" id="tanggalcheckin">
                                <label> Check-In</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text"
                                           id="tglcheckin"
                                           name="txbcheckin"
                                           class="form-control"
                                           value="<?php echo $tglcheckin?>"
                                           onchange="ubahjmlmalam()"
                                           required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label> Malam</label>
                                <input id="jmlmalam" name="txbjmlmalam" type="number" class="form-control text-right" value="<?php echo $jmlmalam?>" min="1" onchange="ubahjmlmalam()" required/>
                            </div>
                            <div class="col-lg-3" id="tanggalcheckout">
                                <label> Check-Out</label>
                                <div class="input-group date">
                                    <span class="input-group-addon" style="background-color: #f2f2f2;"><i class="fa fa-calendar"></i></span>
                                    <input type="text"
                                           id="tglcheckout"
                                           name="txbcheckout"
                                           class="form-control"
                                           value="<?php echo $tglcheckout?>"
                                           style="background-color: #f2f2f2;"
                                           onchange="ubahtglcheckout()"
                                           required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label>Jumlah Kamar</label>
                                <input id="jml_kamar" name="txbjmlkamar" type="number" class="form-control text-right" value="<?php echo $jmlkamar?>" min="1" required/>
                            </div>
                            <div class="col-lg-2">
                                <label>Jumlah Tamu</label>
                                <input id="jml_tamu" name="txbjmltamu" type="number" class="form-control text-right" value="<?php echo $jmltamu?>" min="1" required/>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <input class="btn btn-danger" type="button" id="btncarihotel" value="Cari Hotel" style="display: block; width: 100%;" onclick="submitcarihotel()">
                            </div>
                        </div>

                    </form>

                </div>

                <!--Form Hasil Cari-->

                <?php
                if($data_api['hotel']->rc != '00') {
                    ?>

                    <div class="ibox-content">

                        <div class="row text-center">

                            <h1>DATA TIDAK DITEMUKAN</h1><br/>
                            <h2>Ada masalah pada API => <?php echo $data_api['hotel']->rd ?></h2><br/>
                            <a href="<?php echo base_url('hotel') ?>">
                                <button class="btn btn-danger">Kembali ke form pencarian</button>
                            </a>

                        </div>

                    </div>

                    <?php
                }
                else {

                    $hasil_pencarian = 0;

                    $jmldatahotel = count($data_api['hotel']->data);

                    if($jmldatahotel>0){

                        $jmlavail = 0;

                        for($k= 0 ; $k < $jmldatahotel ; $k++ ) {

                            $avail = $data_api['hotel']->data[$k]->avail;

                            if ($avail == 'true') {
                                $jmlavail = $jmlavail + 1;
                            }

                        }

                        if($jenisgroup == 'Hotel'){

                            for($j= 0 ; $j < $jmldatahotel ; $j++ ) {

                                $hotelname = $data_api['hotel']->data[$j]->hotelName ;

                                if(str_replace(" ","",$hotelname) == str_replace(" ","",$namakotahotel)){

                                    $hasil_pencarian = $hasil_pencarian + 1;

                                    ?>

                                        <div class="ibox-content">

                                            <div class="row">

                                                <div class="col-sm-2">

                                                    <div class="img-preview img-preview-sm" style="width: 130px;">
                                                        <?php
                                                        $hotelimage = $data_api['hotel']->data[$j]->hotelImage;
                                                        if($hotelimage == ''){
                                                            ?>
                                                            <img src="<?php echo base_url('assets\img\No_Image_Available.png') ?>"
                                                                 style="width: 100%; height: 100%;">
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <img src="<?php echo $hotelimage; ?>"
                                                                 style="width: 100%; height: 100%;">
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                </div>
                                                <div class="col-sm-4">
                                                    <h3>
                                                        <a href="#" class="text-info">
                                                            <?php echo $data_api['hotel']->data[$j]->hotelName; ?>
                                                        </a>
                                                    </h3>
                                                    <p class="small">
                                                        <?php echo $data_api['hotel']->data[$j]->hotelAddress; ?>
                                                    </p>
                                                    <dl class="small m-b-none">
                                                        <?php
                                                        $rating = $data_api['hotel']->data[$j]->rating;
                                                        for ($x = 0; $x <= 4; $x++) {

                                                            if ($x < $rating) {
                                                                $color = '#FEBA02';
                                                            } else {
                                                                $color = '#E0E0E0';
                                                            }

                                                            if($rating > 0){
                                                                ?>
                                                                <i class="fa fa-star" style="color: <?php echo $color; ?>;"></i>
                                                                <?php
                                                            }

                                                        }
                                                        ?>
                                                    </dl>

                                                </div>
                                                <div class="col-sm-3 text-right" style="margin-top: 40px;">
                                                    <?php
                                                    $typename = $data_api['hotel']->data[$j]->roomCateg[0]->roomType->typeName;
                                                    if($typename != ''){
                                                        $splittype = explode(' ', $typename);

                                                        if($splittype[0] == 'Diskon'){
                                                            ?>
                                                            <p>
                                                                    <span class="label label-info" style="font-size: 20px;">
                                                                        <?php echo $typename; ?>
                                                                    </span>
                                                            </p>

                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-sm-3 text-right">
                                                    <h3 style="color: <?php echo $warna_lembaga; ?>">STARTING FROM</h3>
                                                    <h2 style="font-weight: bold; color: <?php echo $warna_lembaga; ?>">
                                                        <?php
                                                        $currency = $data_api['hotel']->data[$j]->currency;
                                                        $totalprice = $data_api['hotel']->data[$j]->roomCateg[0]->roomType->totalPrice;
                                                        $rptotalprice = number_format($totalprice, 0, ',', '.');

                                                        echo $currency.' '.$rptotalprice;
                                                        ?>
                                                    </h2>
                                                    <?php
                                                    $available = $data_api['hotel']->data[$j]->avail;
                                                    if($available == 'true'){
                                                        $idhotel = $data_api['hotel']->data[$j]->idHotelFp;
                                                        $idbiller = $data_api['hotel']->data[$j]->idBillerHotel;
                                                        $url = 'room='.$jmlkamar.'&guest='.$jmltamu.'&checkindate='.$tglcheckin.'&checkoutdate='.$tglcheckout.'&hotel='.$idhotel.'&biller='.$idbiller;
                                                        ?>
                                                        <a href="<?php echo base_url('hotel/detailhotel?'.$url)?>" target="_blank">
                                                            <button class="btn btn-danger dim" type="button">
                                                                SEE ROOM
                                                            </button>
                                                        </a>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <h2 style="color: <?php echo $warna_lembaga; ?>">KAMAR PENUH</h2>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>

                                            </div>

                                        </div>

                                    <?php

                                }

                            }

                            if($hasil_pencarian == 0){
                                ?>

                                <div class="ibox-content">

                                    <div class="row text-center">

                                        <h2>Mohon maaf, pencarian yang anda cari tidak ditemukan, Di bawah ini hotel rekomendasi sesuai dengan hasil pencarian anda.</h2>

                                    </div>

                                </div>

                                <?php
                            }

                        }

                        ?>

                        <div class="ibox-content">

                            <?php
                                if($hasil_pencarian > 0){
                                    ?>
                                    <h2><?php echo $jmldatahotel-1; ?> Hotel lain ditemukan di <?php echo $data_api['param']['cityid'];?> , <?php echo $jmlavail-1; ?> Tersedia</h2>
                                    <?php
                                }else{
                                    ?>
                                    <h2><?php echo $jmldatahotel; ?> Hotel ditemukan di <?php echo $data_api['param']['cityid'];?> , <?php echo $jmlavail; ?> Tersedia</h2>
                                    <?php
                                }
                            ?>

                            <hr>

                            <div>
                                <table class="table table-striped table-bordered table-hover data-hotel" >
                                    <thead>
                                    <tr>
                                        <th><h2>HOTEL</h2></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    if($hasil_pencarian > 0){

                                        for($i= 0 ; $i < $jmldatahotel ; $i++ ) {

                                            $hotel_name = $data_api['hotel']->data[$i]->hotelName;

                                            if(str_replace(" ","",$hotel_name) != str_replace(" ","",$namakotahotel)){

                                                ?>

                                                <tr>
                                                    <td>

                                                        <div class="row">

                                                            <div class="col-sm-2">

                                                                <div class="img-preview img-preview-sm" style="width: 130px;">
                                                                    <?php
                                                                    $hotelimage = $data_api['hotel']->data[$i]->hotelImage;
                                                                    if($hotelimage == ''){
                                                                        ?>
                                                                        <img src="<?php echo base_url('assets\img\No_Image_Available.png') ?>"
                                                                             style="width: 100%; height: 100%;">
                                                                        <?php
                                                                    }else{
                                                                        ?>
                                                                        <img src="<?php echo $hotelimage; ?>"
                                                                             style="width: 100%; height: 100%;">
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>

                                                            </div>
                                                            <div class="col-sm-4">
                                                                <h3>
                                                                    <a href="#" class="text-info">
                                                                        <?php echo $hotel_name; ?>
                                                                    </a>
                                                                </h3>
                                                                <p class="small">
                                                                    <?php echo $data_api['hotel']->data[$i]->hotelAddress; ?>
                                                                </p>
                                                                <dl class="small m-b-none">
                                                                    <?php
                                                                    $rating = $data_api['hotel']->data[$i]->rating;
                                                                    for ($x = 0; $x <= 4; $x++) {

                                                                        if ($x < $rating) {
                                                                            $color = '#FEBA02';
                                                                        } else {
                                                                            $color = '#E0E0E0';
                                                                        }

                                                                        if($rating > 0){
                                                                            ?>
                                                                            <i class="fa fa-star" style="color: <?php echo $color; ?>;"></i>
                                                                            <?php
                                                                        }

                                                                    }
                                                                    ?>
                                                                </dl>

                                                            </div>
                                                            <div class="col-sm-3 text-right" style="margin-top: 40px;">
                                                                <?php
                                                                $typename = $data_api['hotel']->data[$i]->roomCateg[0]->roomType->typeName;
                                                                if($typename != ''){
                                                                    $splittype = explode(' ', $typename);

                                                                    if($splittype[0] == 'Diskon'){
                                                                        ?>
                                                                        <p>
                                                                    <span class="label label-info" style="font-size: 20px;">
                                                                        <?php echo $typename; ?>
                                                                    </span>
                                                                        </p>

                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="col-sm-3 text-right">
                                                                <h3 style="color: <?php echo $warna_lembaga; ?>">STARTING FROM</h3>
                                                                <h2 style="font-weight: bold; color: <?php echo $warna_lembaga; ?>">
                                                                    <?php
                                                                    $currency = $data_api['hotel']->data[$i]->currency;
                                                                    $totalprice = $data_api['hotel']->data[$i]->roomCateg[0]->roomType->totalPrice;
                                                                    $rptotalprice = number_format($totalprice, 0, ',', '.');

                                                                    echo $currency.' '.$rptotalprice;
                                                                    ?>
                                                                </h2>
                                                                <?php
                                                                $available = $data_api['hotel']->data[$i]->avail;
                                                                if($available == 'true'){
                                                                    $idhotel = $data_api['hotel']->data[$i]->idHotelFp;
                                                                    $idbiller = $data_api['hotel']->data[$i]->idBillerHotel;
                                                                    $url = 'room='.$jmlkamar.'&guest='.$jmltamu.'&checkindate='.$tglcheckin.'&checkoutdate='.$tglcheckout.'&hotel='.$idhotel.'&biller='.$idbiller;
                                                                    ?>
                                                                    <a href="<?php echo base_url('hotel/detailhotel?'.$url)?>" target="_blank">
                                                                        <button class="btn btn-danger dim" type="button">
                                                                            SEE ROOM
                                                                        </button>
                                                                    </a>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <h2 style="color: <?php echo $warna_lembaga; ?>">KAMAR PENUH</h2>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>

                                                        </div>


                                                    </td>
                                                </tr>

                                                <?php

                                            }


                                        }

                                    }else{


                                        for($i= 0 ; $i < $jmldatahotel ; $i++ ) {

                                            $namaform = 'formdetailhotel'.$i;

                                            ?>

                                            <form id="<?php echo $namaform;?>" method="post" autocomplete="off">

                                            <tr>
                                                <td>

                                                    <div class="row">

                                                        <div class="col-sm-2">

                                                            <div class="img-preview img-preview-sm" style="width: 130px;">
                                                                <?php
                                                                $hotelimage = $data_api['hotel']->data[$i]->hotelImage;
                                                                if($hotelimage == ''){
                                                                    ?>
                                                                    <img src="<?php echo base_url('assets\img\No_Image_Available.png') ?>"
                                                                         style="width: 100%; height: 100%;">
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <img src="<?php echo $hotelimage; ?>"
                                                                         style="width: 100%; height: 100%;">
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-4">
                                                            <h3>
                                                                <a href="#" class="text-info">
                                                                    <?php echo $data_api['hotel']->data[$i]->hotelName; ?>
                                                                </a>
                                                            </h3>
                                                            <p class="small">
                                                                <?php echo $data_api['hotel']->data[$i]->hotelAddress; ?>
                                                            </p>
                                                            <dl class="small m-b-none">
                                                                <?php
                                                                $rating = $data_api['hotel']->data[$i]->rating;
                                                                for ($x = 0; $x <= 4; $x++) {

                                                                    if ($x < $rating) {
                                                                        $color = '#FEBA02';
                                                                    } else {
                                                                        $color = '#E0E0E0';
                                                                    }

                                                                    if($rating > 0){
                                                                        ?>
                                                                        <i class="fa fa-star" style="color: <?php echo $color; ?>;"></i>
                                                                        <?php
                                                                    }

                                                                }
                                                                ?>
                                                            </dl>

                                                        </div>
                                                        <div class="col-sm-3 text-right" style="margin-top: 40px;">
                                                            <?php
                                                            $typename = $data_api['hotel']->data[$i]->roomCateg[0]->roomType->typeName;
                                                            if($typename != ''){
                                                                $splittype = explode(' ', $typename);

                                                                if($splittype[0] == 'Diskon'){
                                                                    ?>
                                                                    <p>
                                                                    <span class="label label-info" style="font-size: 20px;">
                                                                        <?php echo $typename; ?>
                                                                    </span>
                                                                    </p>

                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="col-sm-3 text-right">
                                                            <h3 style="color: <?php echo $warna_lembaga; ?>">STARTING FROM</h3>
                                                            <h2 style="font-weight: bold; color: <?php echo $warna_lembaga; ?>">
                                                                <?php
                                                                $currency = $data_api['hotel']->data[$i]->currency;
                                                                $totalprice = $data_api['hotel']->data[$i]->roomCateg[0]->roomType->totalPrice;
                                                                $rptotalprice = number_format($totalprice, 0, ',', '.');

                                                                echo $currency.' '.$rptotalprice;
                                                                ?>
                                                            </h2>
                                                            <?php
                                                            $available = $data_api['hotel']->data[$i]->avail;
                                                            if($available == 'true'){
                                                                $idhotel = $data_api['hotel']->data[$i]->idHotelFp;
                                                                $idbiller = $data_api['hotel']->data[$i]->idBillerHotel;
                                                                $url = 'room='.$jmlkamar.'&guest='.$jmltamu.'&checkindate='.$tglcheckin.'&checkoutdate='.$tglcheckout.'&hotel='.$idhotel.'&biller='.$idbiller;
                                                                ?>
                                                                <a href="<?php echo base_url('hotel/detailhotel?'.$url)?>" target="_blank">
                                                                    <button class="btn btn-danger dim" type="button">
                                                                        SEE ROOM
                                                                    </button>
                                                                </a>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <h2 style="color: <?php echo $warna_lembaga; ?>">KAMAR PENUH</h2>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>

                                                    </div>


                                                </td>
                                            </tr>

                                            </form>

                                            <?php
                                        }


                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>


                        </div>

                        <?php

                    }else{

                        ?>

                        <div class="ibox-content">

                            <div class="row text-center">

                                <h1>DATA TIDAK DITEMUKAN</h1><br/>
                                <a href="<?php echo base_url('hotel') ?>">
                                    <button class="btn btn-danger">Kembali ke form pencarian</button>
                                </a>

                            </div>

                        </div>

                        <?php

                    }

                }
                ?>

            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>
</div>

<!-- /content -->


</div>
