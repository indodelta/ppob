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

//$jumlahairlinepergi = count($jadwal[0]);
//$jumlahairlinepulang = count($jadwal[1]);

?>







