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
                    <strong>Booking Hotel</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


        <!-- Content -->

    <div class="wrapper wrapper-content article" style="margin-top: 20px;">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">

                <h2>
                    <i class="fa fa-hotel" style="font-size:1em;margin-right:10px;color: <?php echo $warna_lembaga ?>;"></i>
                    <span style="color: <?php echo $warna_lembaga ?>">Reservasi Hotel</span>
                </h2>

                <div class="ibox float-e-margins">
                    <div class="ibox-content">

                        <input type="hidden" value="hotel" name="txbpage" id="txbpage">
                        <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">

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

                        <form id="formcarihotel" class="form-horizontal" method="post">

<!--                            --><?php //echo $this->session->userdata('tokenft') ?>

                            <div class="form-group">

                                <div class="col-lg-12">
                                    <input type="text" id="txbnamakotahotel" name="txbnamakotahotel" class="form-control" placeholder="Hotel atau Kota tujuan anda" readonly style="background-color: transparent" onclick="onclicktxbsearchotel()" required>
                                    <input type="hidden" id="txbgroup" name="txbgroup">
                                    <input type="hidden" id="txbkey" name="txbkey">
                                    <input type="hidden" id="txbalamat" name="txbalamat">
                                </div>

                            </div>

                            <div class="form-group">

                                <div class="col-lg-4" id="tanggalcheckin">
                                        <label style="color: <?php echo $warna_lembaga ?>;"> CHECK-IN</label>
                                        <div class="input-group date">
                                            <?php $today = date("d/m/Y"); ?>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text"
                                                   id="tglcheckin"
                                                   name="txbcheckin"
                                                   class="form-control"
                                                   value="<?php echo $today?>"
                                                   onchange="ubahjmlmalam()"
                                                   required>
                                        </div>
                                </div>
                                <div class="col-lg-4">
                                    <label style="color: <?php echo $warna_lembaga ?>;"> Malam</label>
                                    <input id="jmlmalam" name="txbjmlmalam" type="number" class="form-control text-right" value="1" min="1" onchange="ubahjmlmalam()" required/>
                                </div>
                                <div class="col-lg-4" id="tanggalcheckout">
                                    <label style="color: <?php echo $warna_lembaga ?>;"> CHECK-OUT</label>
                                    <div class="input-group date">
                                        <?php
                                        $datetimetomorrow = new DateTime('tomorrow');
                                        $tomorrow = $datetimetomorrow->format("d/m/Y");
                                        ?>
                                        <span class="input-group-addon" style="background-color: #f2f2f2;"><i class="fa fa-calendar"></i></span>
                                        <input type="text"
                                               id="tglcheckout"
                                               name="txbcheckout"
                                               class="form-control"
                                               value="<?php echo $tomorrow?>"
                                               style="background-color: #f2f2f2;"
                                               onchange="ubahtglcheckout()"
                                               required>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <div class="col-lg-12">
                                    <label style="color: <?php echo $warna_lembaga ?>;">JUMLAH KAMAR</label>
                                    <input id="jml_kamar" name="txbjmlkamar" type="number" class="form-control text-right" value="1" min="1" required/>
                                </div>

                            </div>

                            <div class="form-group">

                                <div class="col-lg-12">
                                    <label style="color: <?php echo $warna_lembaga ?>;">JUMLAH TAMU</label>
                                    <input id="jml_tamu" name="txbjmltamu" type="number" class="form-control text-right" value="1" min="1" required/>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input class="btn btn-danger" type="button" id="btncarihotel" value="Cari Hotel" style="display: block; width: 100%;" onclick="submitcarihotel()">
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>

    <!-- /content -->


</div>
