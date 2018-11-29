<?php
$nama_lembaga = $this->config->item("nama_lembaga"); $logo_lembaga = $this->config->item("logo_lembaga");
$css_lembaga = $this->config->item("css_lembaga"); $warna_lembaga = $this->config->item("warna_lembaga");
if (sizeof($data_lembaga)>0) {
    $nama_lembaga = $data_lembaga[0]["nama"];
    $logo_lembaga = $data_lembaga[0]["logo"];
    $css_lembaga = $data_lembaga[0]["css"];
    $warna_lembaga = $data_lembaga[0]["warna"];
}

$this->load->view('func_custom');

$cekreturn = $this->input->post('cekreturn');

$departure = $this->input->post('air_from',true);
$arrival = $this->input->post('air_to',true);
$departureDate = $this->input->post('tglpergi',true);
$returnDate = $this->input->post('tglpulang',true);
$adult = $this->input->post('jml_adult',true);
$child = $this->input->post('jml_child',true);
$infant = $this->input->post('jml_infant',true);
$txbairlinename = $this->input->post('airlineName',true);
$txbairlineicon = $this->input->post('airlineIcon',true);
$txbairlinecode = $this->input->post('airline',true);

$expdeparture = explode('-', $departure);
$departurecode = $expdeparture[0];
$departurename = $expdeparture[1];
$expdeparturename = explode('|', $departurename);
$depname = str_replace(" ","",$expdeparturename[0]);

$exparrival = explode('-', $arrival);
$arrivalcode = $exparrival[0];
$arrivalname = $exparrival[1];
$exparrivalname = explode('|', $arrivalname);
$arrname = str_replace(" ","",$exparrivalname[0]);

?>

<div class="row">
    <div class="col-lg-8 col-lg-offset-2">

        <div class="ibox-content" style="padding-top: 20px; padding-left: 50px; padding-bottom: 0px;">

            <div class="row">

                <div class="col-xs-10">

                    <div class="row" id="formsebelumpilihpergi" style="display: block;">
                        <h3>Jadwal Pesawat Pergi belum dipilih</h3>
                    </div>

                    <div class="row" id="formpilihpergi" style="display: none;">

                        <div class="col-xs-1"><img id="iconpilihpergi" class="img-md"></div>
                        <div class="col-xs-3 text-center">
                            <text id="transitpilihpergi" style="font-size: 14px; font-weight: bold; color: #ED5565;"></text><br/>
                            <text id="detailtransitpilihpergi" style="font-size: 12px; color: lightgrey;"></text>

                        </div>
                        <div class="col-xs-4">

                            <text style="font-size: 14px;">
                                <span style="font-weight: bold;">Pergi: </span><?php echo $depname.' ke '.$arrname;?>
                            </text>
                            <br/>
                            <text style="font-size: 14px;"><?php echo hari($departureDatedb).', '.$departureDateindo;?></text>
                            <br/>
                            <text id="flightcodepilihpergi" style="font-size: 12px; color: lightgrey;"></text>

                        </div>
                        <div class="col-xs-2">
                            <text id="jampergipilihpergi" style="font-size: 18px; font-weight: bold"></text><br/>
                            <text style="font-size: 12px; color: lightgrey;"><?php echo $depname;?></text>
                        </div>
                        <div class="col-xs-2">
                            <text id="jamtibapilihpergi" style="font-size: 18px; font-weight: bold"></text><br/>
                            <text style="font-size: 12px; color: lightgrey;"><?php echo $arrname;?></text>
                        </div>

                    </div>

                    <hr/>

                    <div class="row" id="formsebelumpilihpulang" style="display: block;">
                        <h3>Jadwal Pesawat Pulang belum dipilih</h3>
                    </div>

                    <div class="row" id="formpilihpulang" style="display: none;">

                        <div class="col-xs-1"><img id="iconpilihpulang" class="img-md"></div>
                        <div class="col-xs-3 text-center">
                            <text id="transitpilihpulang" style="font-size: 14px; font-weight: bold; color: #ED5565;"></text><br/>
                            <text id="detailtransitpilihpulang" style="font-size: 12px; color: lightgrey;"></text>

                        </div>
                        <div class="col-xs-4">

                            <text style="font-size: 14px;">
                                <span style="font-weight: bold;">Pulang: </span><?php echo $arrname.' ke '.$depname;?>
                            </text>
                            <br/>
                            <text style="font-size: 14px;"><?php echo $tanggalpulang;?></text>
                            <br/>
                            <text id="flightcodepilihpulang" style="font-size: 12px; color: lightgrey;"></text>

                        </div>
                        <div class="col-xs-2">
                            <text id="jampergipilihpulang" style="font-size: 18px; font-weight: bold"></text><br/>
                            <text style="font-size: 12px; color: lightgrey;"><?php echo $arrname;?></text>
                        </div>
                        <div class="col-xs-2">
                            <text id="jamtibapilihpulang" style="font-size: 18px; font-weight: bold"></text><br/>
                            <text style="font-size: 12px; color: lightgrey;"><?php echo $depname;?></text>
                        </div>

                    </div>

                </div>
                <div class="col-xs-2" id="forminputpilihpergi">

                    <form method="post" id="formpilihpulangpergi" target="_blank">

                        <!--pesawat pergi-->
                        <div id="rowinputpilihpergi">

                            <input type="hidden" id="txbjumlahpesawatpergi" name="jumlahpesawatpergi">
                            <input type="hidden" id="txbjumlahclassespergi" name="jumlahclassespergi">
                            <input type="hidden" id="txbistransitpergi" name="istransitpergi">
                            <input type="hidden" id="txbairlinecodepergi" name="airlinecodepergi">
                            <input type="hidden" id="txbjampergipergi" name="jampergipergi">
                            <input type="hidden" id="txbjamtibapergi" name="jamtibapergi">

                        </div>

                        <!--pesawat pulang-->
                        <div id="rowinputpilihpulang">

                            <input type="hidden" id="txbjumlahpesawatpulang" name="jumlahpesawatpulang">
                            <input type="hidden" id="txbjumlahclassespulang" name="jumlahclassespulang">
                            <input type="hidden" id="txbistransitpulang" name="istransitpulang">
                            <input type="hidden" id="txbairlinecodepulang" name="airlinecodepulang">
                            <input type="hidden" id="txbjampergipulang" name="jampergipulang">
                            <input type="hidden" id="txbjamtibapulang" name="jamtibapulang">

                        </div>

                        <div class="row text-center"
                             style="border-left: solid 1px #eeeeee; height: 150px; padding-top: 30px;">
                            <h2 id="flighttotalhargapp" style="color: <?php echo $warna_lembaga?>">Rp 0</h2>
                            <input type="hidden" id="flighthargapergi" value="0">
                            <input type="hidden" id="flighthargapulang" value="0">

                            <input type="hidden" name="pulangpergi" value="<?php echo $cekreturn;?>">
                            <input type="hidden" name="air_from" value="<?php echo $departure;?>">
                            <input type="hidden" name="air_to" value="<?php echo $arrival;?>">
                            <input type="hidden" name="departuredate" value="<?php echo $departureDate;?>">
                            <input type="hidden" name="returndate" value="<?php echo $returnDate;?>">
                            <input type="hidden" name="adult" value="<?php echo $adult;?>">
                            <input type="hidden" name="child" value="<?php echo $child;?>">
                            <input type="hidden" name="infant" value="<?php echo $infant;?>">


                            <button type="button" class="btn btn-danger" id="btnsubmitpulangpergi" onclick="submitpulangpergi()"> PESAN SEKARANG
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

        <div class="ibox-content" style="padding-top: 10px; padding-left: 20px; padding-right: 20px; max-height: 500px; overflow-y: scroll; overflow-x: hidden;">

        </div>

    </div>

    <div class="col-lg-2"></div>

</div>



