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
                <strong>Detail Hotel</strong>
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

                $namahotel = $hotel->data->hotelName;

                $jmlkamar = $this->input->get('room');
                $jmltamu = $this->input->get('guest');

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

                    <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">

                    <div class="row">
                        <div class="col-lg-9">
                            <h2><?php echo $namahotel; ?></h2>
                            <h3>
                                <?php
                                if($hotel->data->address1 == $hotel->data->address2){
                                    $alamat = $hotel->data->address1;
                                }else{
                                    $alamat = 'Alamat 1 : '.$hotel->data->address1.'<br/>Alamat 2 : '.$hotel->data->address2;
                                }
                                echo $alamat;
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
                                <input id="jmlmalam" name="txbjmlmalam" type="number" class="form-control" value="<?php echo $jmlmalam?>" min="1" onchange="ubahjmlmalam()" required/>
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

                        <div class="col-lg-6">

                            <h2>GALERI</h2>

                            <hr/>

                            <div class="lightBoxGallery">

                                <?php
                                $jmlimages = count($hotel->data->images);

                                for($i= 0 ; $i < $jmlimages ; $i++ ) {
                                    $value = $hotel->data->images[$i]->value;
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

                            <br/><br/>

                            <h2>Fasilitas Hotel</h2>

                            <hr/>

                            <?php
                            $jmlfasilitas = count($hotel->data->facility);
                            $jmljenisfac = 0;
                            $facvaluesebelum ='';

                            for($j= 0 ; $j < $jmlfasilitas ; $j++ ) {
                                $facvalue = $hotel->data->facility[$j]->value;
                                $facname = $hotel->data->facility[$j]->name;

                                if($facvalue != $facvaluesebelum){
                                    $jmljenisfac = $jmljenisfac+1;
                                }

                                $facvaluesebelum = $facvalue;

                            }

                            echo $jmljenisfac;
                            ?>

                            <table class="table table-bordered">
                            <?php
                            for($k= 1 ; $k <= $jmljenisfac ; $k++ ) {
                                ?>

                                <tr><td><?php echo $k; ?></td></tr>

                                <?php
                            }
                            ?>
                            </table>



                        </div>

                        <div class="col-lg-6">

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
