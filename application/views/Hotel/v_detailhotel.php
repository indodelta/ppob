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
                <strong>Pilih Kamar</strong>
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

            <!-- <?php echo $this->session->userdata('tokenft') ?> -->


                <!-- Judul Pergi dan Tujuan -->

                <?php
                $this->load->view('func_custom');

                $namahotel = $hotel->data->hotelName;

                $jmlkamar = $this->input->get('room');
                $jmltamu = $this->input->get('guest');
                $alamat = $this->input->get('alamat');
                $alamathotel = $this->input->get('alamathotel');
                $idhotel = $this->input->get('hotel');
                $idbiller = $this->input->get('biller');

                $tglcheckin = $this->input->get('checkindate');
                $split = explode('/', $tglcheckin);
                $bulan = bulan($split[1]);
                $tanggalcheckin = $split[0] . ' ' . $bulan . ' ' .$split[2];
                $tanggaldbcheckin = $split[2] . '-' . $split[1] . '-' .$split[0];

                $tglcheckout = $this->input->get('checkoutdate');
                $splitout = explode('/', $tglcheckout);
                $bulanout = bulan($splitout[1]);
                $tanggalcheckout = $splitout[0] . ' ' . $bulanout . ' ' .$splitout[2];
                $tanggaldbcheckout = $splitout[2] . '-' . $splitout[1] . '-' .$splitout[0];

                $datediff = strtotime($tanggaldbcheckout) - strtotime($tanggaldbcheckin);

                $jmlmalam = round($datediff / (60 * 60 * 24));
                ?>

                <div class="ibox-content red-bg">

                    <input type="hidden" value="detailhotel" name="txbpage" id="txbpage">
                    <input type="hidden" id="txbcancelbookberhasil" value="">

                    <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">

                    <div class="row">
                        <div class="col-lg-9">
                            <h2><?php echo $namahotel; ?></h2>
                            <h3>
                                <?php
                                // if($hotel->data->address1 == $hotel->data->address2){
                                //     $alamat = $hotel->data->address1;
                                // }else{
                                //     $alamat = 'Alamat 1 : '.$hotel->data->address1.'<br/>Alamat 2 : '.$hotel->data->address2;
                                // }
                                echo $alamathotel;
                                ?>
                            </h3>
                            <h3>
                                <?php
                                $rating = $hotel->data->rating;
                                for ($x = 0; $x <= 4; $x++) {

                                    if ($x < $rating) {
                                        $color = '#FEBA02';
                                    } else {
                                        $color = 'white';
                                    }

                                    if($rating > 0){
                                        ?>
                                        <i class="fa fa-star" style="color: <?php echo $color; ?>;"></i>
                                        <?php
                                    }

                                }
                                ?>
                            </h3>
                            <h3>
                                <i class="fa fa-calendar"></i>
                                <?php echo $tanggalcheckin ?>
                                - <?php echo $tanggalcheckout; ?>
                                | <i class="fa fa-user"></i> <?php echo $jmltamu; ?> Orang
                                | <i class="fa fa-hotel"></i> <?php echo $jmlkamar ?> Kamar
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
                                       value="<?php echo $namahotel; ?>"
                                       required>
                                <input type="hidden" id="txbgroup" name="txbgroup" value="Hotel">
                                <input type="hidden" id="idhotel" name="idhotel" value="<?php echo $idhotel; ?>">
                                <input type="hidden" id="txbkey" name="txbkey" value="">
                                <input type="hidden" id="txbalamat" name="txbalamat" value="<?php echo $alamat; ?>">
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

                <div class="ibox-content">

                    <div class="row">

                        <div class="col-lg-4">

                            <h2>Ubah Jadwal Kamar</h2>

                            <hr/>

                            <form class="form-horizontal" id="formcarikamar" method="get" autocomplete="off">

                                <div class="form-group">

                                    <div class="col-lg-12" id="tanggalkamarcheckin">
                                        <label> Check-In</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text"
                                                   id="tglkamarcheckin"
                                                   name="checkindate"
                                                   class="form-control"
                                                   value="<?php echo $tglcheckin?>"
                                                   onchange="ubahjmlkamarmalam()"
                                                   required>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="form-group">

                                    <div class="col-lg-12" id="tanggalkamarcheckout">
                                        <label> Check-Out</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon" style="background-color: #f2f2f2;"><i class="fa fa-calendar"></i></span>
                                            <input type="text"
                                                   id="tglkamarcheckout"
                                                   name="checkoutdate"
                                                   class="form-control"
                                                   value="<?php echo $tglcheckout?>"
                                                   style="background-color: #f2f2f2;"
                                                   onchange="ubahkamartglcheckout()"
                                                   required>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-lg-4">
                                        <label> Malam</label>
                                        <input id="jmlkamarmalam" name="txbjmlmalam" type="number" class="form-control text-right" value="<?php echo $jmlmalam?>" min="1" onchange="ubahjmlkamarmalam()" required/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Kamar</label>
                                        <input id="jml_kamar_kamar" name="room" type="number" class="form-control text-right" value="<?php echo $jmlkamar?>" min="1" required/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Tamu</label>
                                        <input id="jml_tamu_kamar" name="guest" type="number" class="form-control text-right" value="<?php echo $jmltamu?>" min="1" required/>
                                    </div>

                                </div>

                                <input type="hidden" name="hotel" value="<?php echo $idhotel ?>">
                                <input type="hidden" name="biller" value="<?php echo $idbiller ?>">
                                <input type="hidden" name="alamat" value="<?php echo $alamat ?>">
                                <input type="hidden" name="alamathotel" value="<?php echo $alamathotel ?>">

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <!-- <button class="btn btn-danger"  type="submit" style="display: block; width: 100%; margin-top: 15px;">Ubah</button> -->
                                        <input class="btn btn-danger" type="button" id="btncarikamar" value="Ubah" style="display: block; width: 100%; margin-top: 15px;" onclick="submitcarikamar()">
                                    </div>
                                </div>

                            </form>

                            <h2>Fasilitas</h2>

                            <hr/>

                            <?php
                            $jmlfasilitas = count($hotel->data->facility);
                            $jmljenisfac = 0;
                            $facvaluesebelum ='';

                            $arrfacvalue = array();

                            for($j= 0 ; $j < $jmlfasilitas ; $j++ ) {
                                $facvalue = $hotel->data->facility[$j]->value;
                                $facname = $hotel->data->facility[$j]->name;

                                if($facvalue != $facvaluesebelum){
                                    $namafacvalue =  $facvalue.':';
                                    array_push($arrfacvalue,$facvalue);                                 
                                }else{
                                    $namafacvalue = '';
                                }

                                $facvaluesebelum = $facvalue;

                            }

                            $jmlfasilitasvalue = count($arrfacvalue);

                            for($m= 0 ; $m < $jmlfasilitasvalue ; $m++ ) {

                                ?>

                                <div class="ibox collapsed">
                                    <div class="ibox-title">
                                        <h5><?php echo ucfirst($arrfacvalue[$m]).' :'?></h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <p>
                                            <?php 

                                            for($n= 0 ; $n < $jmlfasilitas ; $n++ ) {
                                                $facnvalue = $hotel->data->facility[$n]->value;
                                                $facnname = $hotel->data->facility[$n]->name;

                                                if($facnvalue == $arrfacvalue[$m]){

                                                    ?>
                                                        <i class="fa fa-check-square-o" style="color: <?php echo $warna_lembaga; ?>; font-size: 12px;"></i> 
                                                        <?php echo $facnname ?>
                                                        <br/>
                                                             
                                                    <?php
                                                }

                                            }

                                            ?>
                                        </p>
                                    </div>
                                </div>

                                <?php

                            }

                            ?>


                        </div>

                        <div class="col-lg-8">

                            <h2>Silahkan Pilih Tipe Kamar</h2>

                            <hr/>

                            <table class="table table-striped table-bordered table-hover">                                

                                <?php

                                    $jmlrooms = count($hotel->data->rooms);
                                    $hotelid = $hotel->data->hotelId;
                                    $searchingmid = $hotel->mid;
                                    for($k= 0 ; $k < $jmlrooms ; $k++ ) {

                                        $roomid = $hotel->data->rooms[$k]->RoomInformation->Id;
                                        $roomname = $hotel->data->rooms[$k]->RoomInformation->Name;
                                        $roomimage = $hotel->data->rooms[$k]->RoomInformation->RoomTypeImageUrl;
                                        $roomsize = $hotel->data->rooms[$k]->RoomInformation->MaxOccupancy;

                                        $includebreakfast = $hotel->data->rooms[$k]->RateInformation->IsIncludeBreakfast;

                                        $typename = $hotel->data->rooms[$k]->TypeName;

                                        $categoryid = $hotel->data->rooms[$k]->CatgId;                                        

                                        $allotment = $hotel->data->rooms[$k]->Allotment;

                                        $internalcode = $hotel->data->rooms[$k]->InternalCode;

                                        $amount = $hotel->data->rooms[$k]->Amount;
                                        $totalamount = $hotel->data->rooms[$k]->TotalAmount;
                                        $taxamount = $hotel->data->rooms[$k]->TaxAmount;

                                        $isbookable = $hotel->data->rooms[$k]->IsBookable;

                                        $roompolicy = $hotel->data->rooms[$k]->RoomPolicy;

                                        if (array_key_exists(0, $roompolicy) == true) {
                                            $roompolicy = $hotel->data->rooms[$k]->RoomPolicy[0];
                                        }else{
                                            $roompolicy = ' - ';
                                        }


                                        ?>
                                            <tr>

                                                <td>

                                                    <form method="post" action="bookhotel" target="_blank" id="<?php echo "formpilihamar".$k; ?>">

                                                    <div class="row">

                                                        <input type="hidden" value="<?php echo $idbiller ?>" name="txbbillerid">
                                                        <input type="hidden" value="<?php echo $searchingmid ?>" name="txbsearchingmid">
                                                        <input type="hidden" value="<?php echo $jmltamu ?>" name="txbjmltamu">
                                                        <input type="hidden" value="<?php echo $internalcode ?>" name="txbinternalcode">
                                                        <input type="hidden" value="<?php echo $idhotel ?>" name="txbhotelid">
                                                        <input type="hidden" value="<?php echo $namahotel ?>" name="txbhotelname">
                                                        <input type="hidden" value="<?php echo $alamathotel ?>" name="txbhoteladdress">
                                                        <input type="hidden" value="<?php echo $categoryid ?>" name="txbcategoryid">
                                                        <input type="hidden" value="<?php echo $typename ?>" name="txbtypename">
                                                        <input type="hidden" value="<?php echo $tanggaldbcheckin ?>" name="txbcheckindate">
                                                        <input type="hidden" value="<?php echo $tanggaldbcheckout ?>" name="txbcheckoutdate">
                                                        <input type="hidden" value="<?php echo $amount ?>" name="txbamount">
                                                        <input type="hidden" value="<?php echo $totalamount ?>" name="txbtotalamount">
                                                        <input type="hidden" value="<?php echo $taxamount ?>" name="txbtaxamount">
                                                        <input type="hidden" value="<?php echo $roomimage ?>" name="txbroomimage">
                                                        <input type="hidden" value="<?php echo $roomname ?>" name="txbroomname">
                                                        <input type="hidden" value="1" name="tabs">


                                                        <div class="col-xs-5">

                                                            <h3>
                                                                <a href="#" class="text-info">
                                                                    <?php echo $roomname; ?>
                                                                </a>
                                                            </h3>

                                                            <?php

                                                            echo '<p style="font-size: 10px; font-weight:bold;">* Kamar untuk '.$roomsize.' orang</p>'

                                                            ?>
                                                                    
                                                            <div class="img-preview" style="width: 180px; height: 110px;">
                                                                <?php
                                                                if($roomimage == ''){
                                                                    ?>
                                                                    <img src="<?php echo base_url('assets\img\No_Image_Available.png') ?>"
                                                                         style="width: 100%; height: 100%;">
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <img src="<?php echo $roomimage; ?>"
                                                                         style="width: 100%; height: 100%;">
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>

                                                            <?php 

                                                            if($includebreakfast == true){
                                                                echo '<p style="font-size: 12px;">* Termasuk Sarapan Pagi</p>';
                                                            }

                                                            ?>

                                                        </div>

                                                        <div class="col-xs-2 text-center tooltip-demo">

                                                            <p style="font-size: 10px;">Kamar</p>
                                                            <select class="form-control" name="<?php echo "sljmlkamar"; ?>" style="padding-top: 0px;">

                                                                <?php 

                                                                for($l= 1 ; $l <= $allotment ; $l++ ) {

                                                                    ?>

                                                                    <option value="<?php echo $l; ?>"><?php echo $l; ?></option>

                                                                    <?php

                                                                }

                                                                ?>
                                                            </select>

                                                            <!-- <br/>

                                                            <button class="btn btn-danger btn-circle btn-outline" 
                                                                    type="button"
                                                                    data-toggle="tooltip"
                                                                    data-placement="bottom"
                                                                    title="Tes"
                                                                    >
                                                                <i class="fa fa-info"></i>
                                                            </button> -->


                                                        </div>

                                                        <div class="col-xs-5 text-right">

                                                            <h2 style="font-weight: bold; color: <?php echo $warna_lembaga; ?>; margin-top: 10px;">
                                                                <?php
                                                                $currency = 'IDR';
                                                                $rpamount = number_format($amount, 0, ',', '.');

                                                                echo $currency.' '.$rpamount;
                                                                ?>
                                                            </h2>
                                                            <p style="font-size: 11px;">Price inclusive of Tax</p>
                                                            <?php                                                                
                                                                if($isbookable == 'true'){
                                                                    ?>
                                                                        <button class="btn btn-danger dim" type="submit">
                                                                            PESAN SEKARANG
                                                                        </button>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <h2 style="color: <?php echo $warna_lembaga; ?>">KAMAR TELAH DIBOOKING</h2>
                                                                    <?php
                                                                }
                                                            ?>

                                                        </div>

                                                    </div>

                                                    <div class="ibox collapsed" style="background-color: transparent; border: none;">
                                                        <div class="ibox-title" style="border: none; background-color: transparent;">
                                                            <h5 class="text-info">Informasi Selengkapnya</h5>
                                                            <div class="ibox-tools">
                                                                <a class="collapse-link">
                                                                    <i class="fa fa-chevron-up"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="ibox-content" style="background-color: transparent;">
                                                            <h5>Kebijakan Hotel</h5>
                                                            <p style="font-size: 12px;"><?php echo $roompolicy; ?></p>
                                                        </div>
                                                    </div>

                                                    </form>

                                                </td>

                                            </tr>

                                        <?php
                                    }

                                ?>

                            </table>

                        </div>

                    </div>

                </div>

                <div class="ibox-content">

                    <h2>GALERI</h2>

                    <hr/>

                    <div class="lightBoxGallery">

                        <?php
                        $jmlimages = count($hotel->data->images);


                        for($i= 0 ; $i < $jmlimages ; $i++ ) {

                            $arrimages = $hotel->data->images[$i];

                            if (array_key_exists('value', $arrimages) == true) {
                                $value = $hotel->data->images[$i]->value;
                            }else{
                                $value = '';
                            }

                            $path = $hotel->data->images[$i]->path;
                            ?>
                            <a href="<?php echo $path; ?>" title="<?php echo $value; ?>" data-gallery=""><img src="<?php echo $path; ?>" style="height:100px; width: 130px;"></a>
                            <?php
                        }

                        ?>

                        <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
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
        <div class="col-lg-2"></div>
    </div>
</div>

<!-- /content -->


</div>
