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

$expdepartureDate = explode('/', $departureDate);
$bulandepartureDate = bulan($expdepartureDate[1]);
$departureDateindo = $expdepartureDate[0] . ' ' . $bulandepartureDate . ' ' .$expdepartureDate[2];
$departureDatedb = $expdepartureDate[2] . '-' . $expdepartureDate[1] . '-' .$expdepartureDate[0];

$expreturnDate = explode('/', $returnDate);
$bulanreturnDate = bulan($expreturnDate[1]);
$returnDateindo = $expreturnDate[0].' '.$bulanreturnDate.' '.$expreturnDate[2];
$returnDatedb = $expreturnDate[2].'-'.$expreturnDate[1].'-'.$expreturnDate[0];

if($cekreturn == 'on'){
    $tanggalpulang = hari($returnDatedb).', '.$returnDateindo;
    $displaydppulangenable = 'block';
    $displaydppulangdisable = 'none';
    $checked = 'checked';
    $pp = '(PP)';
}else{
    $tanggalpulang = '';
    $displaydppulangenable = 'none';
    $displaydppulangdisable = 'block';
    $checked = '';
    $pp = '';
}

$jumlahairline = count($jadwal);

if($jumlahairline == 0){

    ?>

    <div class="ibox-content">

        <div class="row text-center">

            <h1>
                JADWAL PENERBANGAN TIDAK DITEMUKAN
            </h1><br/>
            <h2>Lakukan Pencarian Jadwal Pesawat Kembali</h2><br/>
            <a href="<?php echo base_url('pesawat')?>"><button class="btn btn-danger">Kembali ke form pencarian</button></a>

        </div>

    </div>

    <?php

}else{

    $rc00 = 0;

    var_dump($jadwal[0]);

    for ($x = 0; $x < $jumlahairline; $x++) {

//        if($jadwal[$x] != null){
//
//            $rc = $jadwal[$x][0]['rc'];
//
//            if($rc == '00'){
//                $rc00 += 1;
//            }
//
//        }

    }

//    if($rc00 == 0){
//
//        ?>
<!---->
<!--        <div class="ibox-content">-->
<!---->
<!--            <div class="row text-center">-->
<!---->
<!--                <h1>-->
<!--                    JADWAL PENERBANGAN TIDAK DITEMUKAN-->
<!--                </h1><br/>-->
<!--                <h2>Lakukan Pencarian Jadwal Pesawat Kembali</h2><br/>-->
<!--                <a href="--><?php //echo base_url('pesawat')?><!--"><button class="btn btn-danger">Kembali ke form pencarian</button></a>-->
<!---->
<!--            </div>-->
<!---->
<!--        </div>-->
<!---->
<!--        --><?php
//
//
//    }else {
//
//        for ($x = 0; $x < $jumlahairline; $x++) {
//
//            if ($jadwal[$x] != null) {
//
//                $rc = $jadwal[$x][0]['rc'];
//
//                if ($rc == '00') {
//
//                    $aircode = $jadwal[$x][0]['data'][0]['airlineCode'];
//                    $airname = $jadwal[$x][0]['data'][0]['airlineName'];
//                    $airicon = $jadwal[$x][0]['data'][0]['airlineIcon'];
//
//                    $jumlahjadwal = count($jadwal[$x][0]['data']);
//
//                    $idibox = 'iboxcontent' . $x;
//
//                    //modal
//
//                    for ($y = 0; $y < $jumlahjadwal; $y++) {
//                        $jumlahpesawat = count($jadwal[$x][0]['data'][$y]['detailTitle']);
//                        $jmlclasses = count($jadwal[$x][0]['data'][$y]['classes']);
//
//                        $idtransit = $aircode . '' . $y;
//
//                    }
//
//                    ?>
<!---->
<!--                    <div class="ibox">-->
<!--                        <input type="hidden" value="--><?php //echo $warna_lembaga ?><!--" name="txbwarnalembaga" id="txbwarnalembaga">-->
<!---->
<!--                        <div class="ibox-title red-bg" style="padding-top: 15px;">-->
<!---->
<!--                            <div class="row">-->
<!--                                <div class="col-xs-2 text-right">-->
<!--                                    <img class="img-md" src="--><?php //echo $airicon; ?><!--" style="width: 100px;">-->
<!--                                </div>-->
<!--                                <div class="col-xs-8" style="padding-left: 0px;">-->
<!--                                    <h2 style="margin-top: 20px;">--><?php //echo $airname; ?><!--</h2>-->
<!--                                    <input type="hidden" id="aircode" value="--><?php //echo $aircode; ?><!--">-->
<!--                                </div>-->
<!--                                <div class="col-xs-2">-->
<!--                                    <div class="ibox-tools">-->
<!--                                        <a data-toggle="collapse" data-target="#--><?php //echo $idibox; ?><!--"-->
<!--                                           class="collapse-link">-->
<!--                                            <i class="fa fa-chevron-down fa-2x" style="color: white;"></i>-->
<!--                                        </a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    --><?php
//
//                }
//
//            }
//
//        }
//
//    }

}

?>




<script src="<?php echo base_url(); ?>assets/js/<?php echo $js_to_load;?>"></script>



