<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 1000);

class Pesawat extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_login');
        $this->load->model('M_user');
        $this->load->model('M_pesawat');
        $this->domain = $_SERVER['HTTP_HOST'];
    }

    function cek_saldo_mobipay()
    {
        $APIurl = $this->config->item('api_ceksaldo');
        $certcode = $this->session->userdata('certcode');
        $param = array(
            "certcode"=>$certcode
        );
        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));
        return $data;
    }

    public function index()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $data['airline'] = $this->getflightconfiguration();

            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }
            $data['jspesawat_to_load']= 'js_pesawat.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $this->load->view('layout/v_header',$data);
            $this->load->view('pesawat/pesawat',$data);
            $this->load->view('layout/v_footer',$data);
        }
    }

    public function getdataairport()
    {
        $token = array(
            'token' => $this->session->userdata('tokenft')
        );

        $APIurl = $this->config->item('api2_airportsname');
        $data = json_decode($this->curl->simple_post($APIurl, $token, array(CURLOPT_BUFFERSIZE => 10)));

        $lengthdata = count($data->data);

        $a=array();
        for ($i = 0; $i < $lengthdata; $i++) {
            $bandara = $data->data[$i]->bandara;
            $name = $data->data[$i]->name;
            $code = $data->data[$i]->code;

            $label = $code.'-'.$name.' | '.$bandara;

            array_push($a,$label);
        };

        $arr = array(
            "name" => $a
        );

        echo json_encode($arr);
    }

    public function getflightconfiguration()
    {
        $token = array(
            'token' => $this->session->userdata('tokenft')
        );

        $APIurl = $this->config->item('api2_flightconfig');
        $data = json_decode($this->curl->simple_post($APIurl, $token, array(CURLOPT_BUFFERSIZE => 10)));

        return $data;
    }

    public function cari_jadwal()
    {

        $airline = $this->input->post('airline',true);
        $jumlahairline = count($airline);

        if($jumlahairline > 0){

            $data['config'] = $this->getflightconfiguration();

            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }
            $data['jspesawat_to_load']= 'js_jadwalpesawat.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $this->load->view('layout/v_header',$data);
            $this->load->view('pesawat/v_flightsearch',$data);
            $this->load->view('layout/v_footer',$data);

        }else{

            $this->session->set_flashdata('airlinebelumdipilih','airline belum dipilih');
            redirect(base_url('pesawat'));

        }
    }

    public function open_form_jadwal()
    {
        $cekreturn = $this->input->post('cekreturn',true);

        $data['jadwal'] = $this->input->post('jadwal',true);
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
        $data['jspesawat_to_load']= 'js_formpesawat.js';

        if($cekreturn == 'on'){
            $this->load->view('pesawat/form_pulangpergi',$data);
        }else{
            $this->load->view('pesawat/form_pergi',$data);
        }
    }

    public function getflightschedule()
    {
        $cekreturn = $this->input->post('cekreturn');

        $airline = $this->input->post('airline',true);
        $departure = $this->input->post('air_from',true);
        $arrival = $this->input->post('air_to',true);
        $departureDate = $this->input->post('tglpergi',true);
        $returnDate = $this->input->post('tglpulang',true);
        $adult = $this->input->post('jml_adult',true);
        $child = $this->input->post('jml_child',true);
        $infant = $this->input->post('jml_infant',true);
        $token = $this->session->userdata('tokenft');

        $expdeparture = explode('-', $departure);
        $departure = $expdeparture[0];
        $exparrival = explode('-', $arrival);
        $arrival = $exparrival[0];
        $expdepartureDate = explode('/', $departureDate);
        $departureDate = $expdepartureDate[2].'-'.$expdepartureDate[1].'-'.$expdepartureDate[0];
        $expreturnDate = explode('/', $returnDate);
        $returnDate = $expreturnDate[2].'-'.$expreturnDate[1].'-'.$expreturnDate[0];

        $APIurl = $this->config->item('api2_flightsearchsingle');

        $param = array(
            "return"=>$cekreturn,
            "airline"=>$airline,
            "departure"=>$departure,
            "arrival"=>$arrival,
            "departureDate"=>$departureDate,
            "returnDate"=>$departureDate,
            "isLowestPrice"=>true,
            "adult"=>$adult,
            "child"=>$child,
            "infant"=>$infant,
            "token"=>$token);

        $data = $this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10));

//        return $data;
        echo $data;

    }

    public function info()
    {
        $data['fare'] = $this->getflightfare();

        $id = $this->session->userdata('iduser');
        $level = $this->session->userdata('user_level');
        if($level == 0){
            $data['datasaldo'] = $this->cek_saldo_mobipay();
        }else{
            $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
        }
        $data['jspesawat_to_load']= 'js_infopesawat.js';
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

        $json_data = file_get_contents( base_url('assets/world_countries-master/data/en/countries.json'));
        $data['country'] = json_decode($json_data, true);

        $this->load->view('layout/v_header',$data);
        $this->load->view('pesawat/v_flightinfo',$data);
        $this->load->view('layout/v_footer',$data);

    }

    public function getflightfare()
    {
        $data = array();

        $pulangpergi = $this->input->post('pulangpergi',true);

        $departureDate = $this->input->post('departuredate',true);
        $expdepartureDate = explode('/', $departureDate);
        $departureDate = $expdepartureDate[2] . '-' . $expdepartureDate[1] . '-' .$expdepartureDate[0];

        $returnDate = $this->input->post('returndate',true);
        $expreturnDate = explode('/', $returnDate);
        $returnDate = $expreturnDate[2].'-'.$expreturnDate[1].'-'.$expreturnDate[0];

        $adult = $this->input->post('adult',true);
        $child = $this->input->post('child',true);
        $infant = $this->input->post('infant',true);

        $token = $this->session->userdata('tokenft');
        $APIurl = $this->config->item('api2_flightfare');

        $jumlahpesawatpergi = $this->input->post('jumlahpesawatpergi',true);

        $airlinecodepergi = $this->input->post('airlinecodepergi',true);

        $arrdatapergi=array();

        for ($i = 0; $i < $jumlahpesawatpergi; $i++) {

            $txbtransitname1perginame = 'transitname1pergi'.$i;
            $txbtransitname2perginame = 'transitname2pergi'.$i;

            $airfrom = $this->input->post($txbtransitname1perginame,true);
            $expairfrom = explode('(', $airfrom);
            $departure = $expairfrom[1];
            $departure = str_replace(")","",$departure);
            $departure = str_replace(" ","",$departure);
            $airto = $this->input->post($txbtransitname2perginame,true);

            $expairto = explode('(', $airto);
            $arrival = $expairto[1];
            $arrival = str_replace(")","",$arrival);
            $arrival = str_replace(" ","",$arrival);

            $txbseatsperginame = 'seatspergi'.$i;
            $seats = $this->input->post($txbseatsperginame,true);

            $arrseats = array($seats);

            $paramspergi = array(
                "airline"=>$airlinecodepergi,
                "departure"=>$departure,
                "arrival"=>$arrival,
                "departureDate"=>$departureDate,
                "returnDate"=>$departureDate,
                "adult"=>(int)$adult,
                "child"=>(int)$child,
                "infant"=>(int)$infant,
                "seats"=>$arrseats,
                "token"=>$token);

            $jsonpergi = json_decode($this->curl->simple_post($APIurl, $paramspergi, array(CURLOPT_BUFFERSIZE => 10)));

            array_push($arrdatapergi,$jsonpergi);

        }

        $data['pergi'] = $arrdatapergi;

        if($pulangpergi == true){

            $jumlahpesawatpulang = $this->input->post('jumlahpesawatpulang',true);

            $airlinecodepulang = $this->input->post('airlinecodepulang',true);

            $arrdatapulang=array();

            for ($i = 0; $i < $jumlahpesawatpulang; $i++) {

                $txbtransitname1pulangname = 'transitname1pulang'.$i;
                $txbtransitname2pulangname = 'transitname2pulang'.$i;

                $airfrom = $this->input->post($txbtransitname1pulangname,true);
                $expairfrom = explode('(', $airfrom);
                $departure = $expairfrom[1];
                $departure = str_replace(")","",$departure);
                $departure = str_replace(" ","",$departure);
                $airto = $this->input->post($txbtransitname2pulangname,true);
                $expairto = explode('(', $airto);
                $arrival = $expairto[1];
                $arrival = str_replace(")","",$arrival);
                $arrival = str_replace(" ","",$arrival);

                $txbseatspulangname = 'seatspulang'.$i;
                $seats = $this->input->post($txbseatspulangname,true);

                $arrseats = array($seats);

                $paramspulang = array(
                    "airline"=>$airlinecodepulang,
                    "departure"=>$departure,
                    "arrival"=>$arrival,
                    "departureDate"=>$returnDate,
                    "returnDate"=>$returnDate,
                    "adult"=>$adult,
                    "child"=>$child,
                    "infant"=>$infant,
                    "seats"=>$arrseats,
                    "token"=>$token);

                $jsonpulang = json_decode($this->curl->simple_post($APIurl, $paramspulang, array(CURLOPT_BUFFERSIZE => 10)));

                array_push($arrdatapulang,$jsonpulang);

            }

            $data['pulang'] = $arrdatapulang;

        }

        return $data;

    }

    public function getflightfare2()
    {
        $data = array();

        $pulangpergi = $this->input->post('pulangpergi',true);

        $departureDate = $this->input->post('departuredate',true);
        $expdepartureDate = explode('/', $departureDate);
        $departureDate = $expdepartureDate[2] . '-' . $expdepartureDate[1] . '-' .$expdepartureDate[0];

        $returnDate = $this->input->post('returndate',true);
        $expreturnDate = explode('/', $returnDate);
        $returnDate = $expreturnDate[2].'-'.$expreturnDate[1].'-'.$expreturnDate[0];

        $adult = $this->input->post('adult',true);
        $child = $this->input->post('child',true);
        $infant = $this->input->post('infant',true);

        $token = $this->session->userdata('tokenft');
        $APIurl = $this->config->item('api2_flightfare');

        $jumlahpesawatpergi = $this->input->post('jumlahpesawatpergi',true);

        $airlinecodepergi = $this->input->post('airlinecodepergi',true);

        $arrdatapergi=array();

        for ($i = 0; $i < $jumlahpesawatpergi; $i++) {

            $txbtransitname1perginame = 'transitname1pergi'.$i;
            $txbtransitname2perginame = 'transitname2pergi'.$i;

            $airfrom = $this->input->post($txbtransitname1perginame,true);
            $expairfrom = explode('(', $airfrom);
            $departure = $expairfrom[1];
            $departure = str_replace(")","",$departure);
            $departure = str_replace(" ","",$departure);
            $airto = $this->input->post($txbtransitname2perginame,true);

            $expairto = explode('(', $airto);
            $arrival = $expairto[1];
            $arrival = str_replace(")","",$arrival);
            $arrival = str_replace(" ","",$arrival);

            $txbseatsperginame = 'seatspergi'.$i;
            $seats = $this->input->post($txbseatsperginame,true);

            $arrseats = array($seats);

            $paramspergi = array(
                "airline"=>$airlinecodepergi,
                "departure"=>$departure,
                "arrival"=>$arrival,
                "departureDate"=>$departureDate,
                "returnDate"=>$departureDate,
                "adult"=>(int)$adult,
                "child"=>(int)$child,
                "infant"=>(int)$infant,
                "seats"=>$arrseats,
                "token"=>$token);

            $jsonpergi = json_decode($this->curl->simple_post($APIurl, $paramspergi, array(CURLOPT_BUFFERSIZE => 10)));

            array_push($arrdatapergi,$jsonpergi);

        }

        $data['pergi'] = $arrdatapergi;

        if($pulangpergi == true){

            $jumlahpesawatpulang = $this->input->post('jumlahpesawatpulang',true);

            $airlinecodepulang = $this->input->post('airlinecodepulang',true);

            $arrdatapulang=array();

            for ($i = 0; $i < $jumlahpesawatpulang; $i++) {

                $txbtransitname1pulangname = 'transitname1pulang'.$i;
                $txbtransitname2pulangname = 'transitname2pulang'.$i;

                $airfrom = $this->input->post($txbtransitname1pulangname,true);
                $expairfrom = explode('(', $airfrom);
                $departure = $expairfrom[1];
                $departure = str_replace(")","",$departure);
                $departure = str_replace(" ","",$departure);
                $airto = $this->input->post($txbtransitname2pulangname,true);
                $expairto = explode('(', $airto);
                $arrival = $expairto[1];
                $arrival = str_replace(")","",$arrival);
                $arrival = str_replace(" ","",$arrival);

                $txbseatspulangname = 'seatspulang'.$i;
                $seats = $this->input->post($txbseatspulangname,true);

                $arrseats = array($seats);

                $paramspulang = array(
                    "airline"=>$airlinecodepulang,
                    "departure"=>$departure,
                    "arrival"=>$arrival,
                    "departureDate"=>$returnDate,
                    "returnDate"=>$returnDate,
                    "adult"=>$adult,
                    "child"=>$child,
                    "infant"=>$infant,
                    "seats"=>$arrseats,
                    "token"=>$token);

                $jsonpulang = json_decode($this->curl->simple_post($APIurl, $paramspulang, array(CURLOPT_BUFFERSIZE => 10)));

                array_push($arrdatapulang,$jsonpulang);

            }

            $data['pulang'] = $arrdatapulang;

        }

        echo $data;

    }

    public function booking()
    {
        $id = $this->session->userdata('iduser');

        $level = $this->session->userdata('user_level');
        if($level == 0){
            $data['datasaldo'] = $this->cek_saldo_mobipay();
        }else{
            $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
        }
        $data['jspesawat_to_load']= 'js_infopesawat.js';
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

        $transid = $this->input->post('transid',true);
        if(isset($transid)){

            $data['trans_id'] = $this->simpan_data();
            $this->session->set_flashdata('simpanberhasil', 'Berhasil');

        }else{
            $data['trans_id'] = $this->get_transid();

            //api booking
            $data['databooking'] = $this->getflightbook();

        }

        $this->load->view('layout/v_header',$data);
        $this->load->view('pesawat/v_flightbook',$data);
        $this->load->view('layout/v_footer',$data);

    }

    public function getflightbook()
    {

        $airlinecodepergi = $this->input->post('airlinecodepergi',true);

        $airfrom = $this->input->post('air_from',true);
        $expairfrom = explode('-', $airfrom);
        $airfromcode = $expairfrom[0];

        $airto = $this->input->post('air_to',true);
        $expairto = explode('-', $airto);
        $airtocode = $expairto[0];

        $departuredate= $this->input->post('departuredate',true);
        $expdepartureDate = explode('/', $departuredate);
        $departureDatedb = $expdepartureDate[2] . '-' . $expdepartureDate[1] . '-' .$expdepartureDate[0];

        $returndate = $this->input->post('returndate',true);
        $expreturnDate = explode('/', $returndate);
        $returnDatedb = $expreturnDate[2].'-'.$expreturnDate[1].'-'.$expreturnDate[0];

        $adult = $this->input->post('adult',true);
        $child = $this->input->post('child',true);
        $infant = $this->input->post('infant',true);

        $jumlahpesawatpergi = $this->input->post('jumlahpesawatpergi',true);

        $token = $this->session->userdata('tokenft');

        $arraypenumpang = array();

        $arraypenumpangdewasa = array();

        for ($a = 1; $a <= $adult; $a++) {
            $slkewarganegaraan = 'slkewarganegaraan'.$a;
            $txbtiteldewasa = 'txbtiteldewasa'.$a;
            $txbnamadepandewasa = 'txbnamadepandewasa'.$a;
            $txbnamabelakangdewasa = 'txbnamabelakangdewasa'.$a;
            $txbemaildewasa = 'txbemaildewasa'.$a;
            $txbnotelepondewasa = 'txbnotelepondewasa'.$a;
            $txbnohandphonedewasa = 'txbnohandphonedewasa'.$a;
            $txbtgllahirdewasa = 'txbtgllahirdewasa'.$a;
            $txbjenisidcardewasa = 'txbjenisidcardewasa'.$a;
            $txbnoidentitydewasa = 'txbnoidentitydewasa'.$a;

            $kewarganegaraan = $this->input->post($slkewarganegaraan,true);
            $titeldewasa = $this->input->post($txbtiteldewasa,true);
            $namadepandewasa = $this->input->post($txbnamadepandewasa,true);
            $namabelakangdewasa = $this->input->post($txbnamabelakangdewasa,true);
            $emaildewasa = $this->input->post($txbemaildewasa,true);
            $notelepondewasa = $this->input->post($txbnotelepondewasa,true);
            $notelepondewasa = 62 . substr($notelepondewasa, 1);
            $nohandphonedewasa = $this->input->post($txbnohandphonedewasa,true);
            $nohandphonedewasa = 62 . substr($nohandphonedewasa, 1);
            $tgllahirdewasa = $this->input->post($txbtgllahirdewasa,true);
            $exptgllahirdewasa = explode('/', $tgllahirdewasa);
            $tgllahirdewasa = $exptgllahirdewasa[1].'/'.$exptgllahirdewasa[0].'/'.$exptgllahirdewasa[2];
            $jenisidcardewasa = $this->input->post($txbjenisidcardewasa,true);
            $noidentitydewasa = $this->input->post($txbnoidentitydewasa,true);

            if($titeldewasa == 'Tuan'){
                $titel = 'MR';
            }elseif ($titeldewasa == 'Nyonya'){
                $titel = 'MRS';
            }elseif ($titeldewasa == 'Nona'){
                $titel = 'MISS';
            }

            $penumpang = 'ADT;'.$titel.';'.$namadepandewasa.';'.$namabelakangdewasa.';'.$tgllahirdewasa.';'.$noidentitydewasa.';::'.$notelepondewasa.';::'.$nohandphonedewasa.';;;;'.$emaildewasa.';'.$jenisidcardewasa.';'.strtoupper($kewarganegaraan);

            array_push($arraypenumpangdewasa,$penumpang);

        }

        $arraypenumpang['adults'] = $arraypenumpangdewasa;


        if($child > 0){
            $arraypenumpanganak = array();

            for ($a = 1; $a <= $child; $a++) {

                $txbtitelanak = 'txbtitelanak' . $a;
                $txbnamadepananak = 'txbnamadepananak' . $a;
                $txbnamabelakanganak = 'txbnamabelakanganak' . $a;
                $txbtgllahiranak = 'txbtgllahiranak'.$a;
                
                $titelanak = $this->input->post($txbtitelanak, true);
                $namadepananak = $this->input->post($txbnamadepananak, true);
                $namabelakanganak = $this->input->post($txbnamabelakanganak, true);
                $tgllahiranak = $this->input->post($txbtgllahiranak,true);
                $exptgllahiranak = explode('/', $tgllahiranak);
                $tgllahiranak = $exptgllahiranak[1].'/'.$exptgllahiranak[0].'/'.$exptgllahiranak[2];

                if($titelanak == 'Tuan'){
                    $titel = 'MR';
                }elseif ($titelanak == 'Nona'){
                    $titel = 'MISS';
                }

                $penumpanganak = 'CHD;'.$titel.';'.$namadepananak.';'.$namabelakanganak.';'.$tgllahiranak.';;::;::;;;;;;';

                array_push($arraypenumpanganak,$penumpanganak);

            }

            $arraypenumpang['children'] = $arraypenumpanganak;
        }

        if($infant > 0){
            $arraypenumpangbayi = array();

            for ($a = 1; $a <= $child; $a++) {

                $txbtitelbayi = 'txbtitelbayi' . $a;
                $txbnamadepanbayi = 'txbnamadepanbayi' . $a;
                $txbnamabelakangbayi = 'txbnamabelakangbayi' . $a;
                $txbtgllahirbayi = 'txbtgllahirbayi'.$a;

                $titelbayi = $this->input->post($txbtitelbayi, true);
                $namadepanbayi = $this->input->post($txbnamadepanbayi, true);
                $namabelakangbayi = $this->input->post($txbnamabelakangbayi, true);
                $tgllahirbayi = $this->input->post($txbtgllahirbayi,true);
                $exptgllahirbayi = explode('/', $tgllahirbayi);
                $tgllahirbayi = $exptgllahirbayi[1].'/'.$exptgllahirbayi[0].'/'.$exptgllahirbayi[2];

                if($titelbayi == 'Tuan'){
                    $titel = 'MR';
                }elseif ($titelbayi == 'Nona'){
                    $titel = 'MISS';
                }

                $penumpanganak = 'INF;'.$titel.';'.$namadepanbayi.';'.$namabelakangbayi.';'.$tgllahirbayi.';;::;::;;;;;;';

                array_push($arraypenumpanganak,$penumpanganak);

            }

            $arraypenumpang['infants'] = $arraypenumpangbayi;
        }

        $API_url = $this->config->item('api2_flightbook');

        $arraydata = array();

        for ($a = 0; $a < $jumlahpesawatpergi; $a++) {

            $txbtransitname1perginame = 'transitname1pergi'.$a;
            $txbtransitname2perginame = 'transitname2pergi'.$a;

            $airfrom = $this->input->post($txbtransitname1perginame,true);
            $expairfrom = explode('(', $airfrom);
            $departure = $expairfrom[1];
            $departure = str_replace(")","",$departure);
            $departure = str_replace(" ","",$departure);

            $airto = $this->input->post($txbtransitname2perginame,true);
            $expairto = explode('(', $airto);
            $arrival = $expairto[1];
            $arrival = str_replace(")","",$arrival);
            $arrival = str_replace(" ","",$arrival);

            $txbseatperginame = 'seatspergi'.$a;
            $seattransitpergi = $this->input->post($txbseatperginame,true);
            $arrseat = array($seattransitpergi);

//            $txbflightcodepergi = 'flightcodepergi'.$a;
//            $flightcodepergi = $this->input->post($txbflightcodepergi,true);
//            $flightcodepergi = str_replace(" ","_",$flightcodepergi);
//            $arrflight = array($flightcodepergi);

            $param = array(
                "airline" => $airlinecodepergi,
                "departure" => $departure,
                "arrival" => $arrival,
                "departureDate" => $departureDatedb,
                "returnDate" => $departureDatedb,
                "adult" => $adult,
                "child" => $child,
                "infant" => $infant,
                "flights" => $arrseat,
                "buyer" => '',
                "passengers" => $arraypenumpang,
                "token" => $token);

            $hasil = $this->curl->simple_post($API_url, $param, array(CURLOPT_BUFFERSIZE => 10));

            $data = json_decode($hasil);

            $arraydata[$a] = $data;
//            $arraydata[$a] = $param;

        }

        return $arraydata;


    }

    public function get_transid(){
        $id = $this->session->userdata('iduser');
        $lembagaid = $this->session->userdata('lembaga_id');
        $datenow = date("dmY");

        $transidawal = $id.''.$lembagaid.'1'.$datenow;
        $datatransid = $this->M_pesawat->selectlastid($transidawal);
        $jumlahdatatransid = count($datatransid);

        if($jumlahdatatransid == 0){
            $transid = $transidawal.'1';
        }else{
            $transid = $datatransid[0]->id;

            if(substr($transid,-1)== 9){
                $explastchartransid = explode($transidawal,$transid);
                $lastchartransid = $explastchartransid[1] + 1;
                $transid = $transidawal.''.$lastchartransid;
            }else{
                $transid = $transid+1;
            }

        }

        return $transid;

    }

    public function simpan_data(){

        //save to trans_flight table

        $transid = $this->input->post('transid',true);
        $lembaga_id = $this->session->userdata('lembaga_id');
        $pulangpergi = $this->input->post('pulangpergi',true);

        if($pulangpergi == 'on'){$pp = '1';}else{$pp='0';}

        //api payment pergi
        $urleticketpergi = 'http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739';
        $urlstrukpergi = 'http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739';
        $komisipergi = null;

        if($pulangpergi == 'on'){

            //api payment pulang
            $urleticketpulang = 'http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739';
            $urlstrukpulang = 'http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739';
            $komisipergi = null;
        }

        $adult = $this->input->post('adult',true);
        $child = $this->input->post('child',true);
        $infant = $this->input->post('infant',true);
        $departuredate = $this->input->post('departuredate',true);
        $expdepartureDate = explode('/', $departuredate);
        $departdate = $expdepartureDate[2] . '-' . $expdepartureDate[1] . '-' .$expdepartureDate[0];
        $returndate = $this->input->post('returndate',true);
        $expreturnDate = explode('/', $returndate);
        $returndate = $expreturnDate[2].'-'.$expreturnDate[1].'-'.$expreturnDate[0];
        $totalharga = $this->input->post('totalharga',true);
        $contacttitle = $this->input->post('contacttitle',true);
        $contactname = $this->input->post('contactname',true);
        $contacttelp = $this->input->post('contacttelp',true);
        $contactemail = $this->input->post('contactemail',true);
        $datecreated = date("Y-m-d H:i:s");
        $usercreated = $this->session->userdata('username');

        $datatransflight = array(
            'id' => $transid,
            'lembaga_id' => $lembaga_id,
            'pp' => $pp,
            'adult' => $adult,
            'child' => $child,
            'infant' => $infant,
            'depart_date' => $departdate,
            'return_date' => $returndate,
            'total_harga' => $totalharga,
            'contact_title' => $contacttitle,
            'contact_name' => $contactname,
            'contact_telp' => $contacttelp,
            'contact_email' => $contactemail,
            'date_created' => $datecreated,
            'user_created' => $usercreated
        );

        $transflight = $this->M_pesawat->simpandata("trans_flight",$datatransflight);

        //save to trans_flight_detail and trans_flight_detail_harga table
        $air_from = $this->input->post('air_from',true);
        $air_to = $this->input->post('air_to',true);

        //input pergi
        $jumlahpesawatpergi = $this->input->post('jumlahpesawatpergi',true);
        $departtimepergi = $this->input->post('jampergipergi',true);
        $arrivaltimepergi = $this->input->post('jamtibapergi',true);
        $istransitpergi = $this->input->post('istransitpergi',true);

        for ($a = 0; $a < $jumlahpesawatpergi; $a++) {

            $txbtransactionidperginame = 'transactionidpergi'.$a;
            $txbbookingcodeperginame = 'bookingcodepergi'.$a;
            $txbpaymentcodeperginame = 'paymentcodepergi'.$a;
            $txbtransittimeperginame = 'transittimepergi'.$a;
            $txbflightcodetransitperginame = 'flightcodepergi'.$a;
            $txbflightnametransitperginame = 'flightnamepergi'.$a;
            $txbflighticontransitperginame = 'flighticonpergi'.$a;
            $txbtransitname1perginame = 'transitname1pergi'.$a;
            $txbtransitname2perginame = 'transitname2pergi'.$a;
            $txbdeparttimetransitperginame = 'departtimepergi'.$a;
            $txbarrivaltimetransitperginame = 'arrivaltimepergi'.$a;
            $txbseatperginame = 'seatspergi'.$a;
            $txbflightclasstransitperginame = 'flightclasspergi'.$a;
            $txbbagasiperginame = 'bagasipergi'.$a;
            $txbtimelimitperginame = 'timelimitpergi'.$a;

            $transactionidpergi = $this->input->post($txbtransactionidperginame,true);
            $bookingcodepergi = $this->input->post($txbbookingcodeperginame,true);
            $paymentcodepergi = $this->input->post($txbpaymentcodeperginame,true);
            $transittimepergi = $this->input->post($txbtransittimeperginame,true);
            $flightcodetransitpergi = $this->input->post($txbflightcodetransitperginame,true);
            $flightnametransitpergi = $this->input->post($txbflightnametransitperginame,true);
            $flighticontransitpergi = $this->input->post($txbflighticontransitperginame,true);
            $transitName1pergi = $this->input->post($txbtransitname1perginame,true);
            $transitName2pergi = $this->input->post($txbtransitname2perginame,true);
            $departtimetransitpergi = $this->input->post($txbdeparttimetransitperginame,true);
            $arrivaltimetransitpergi = $this->input->post($txbarrivaltimetransitperginame,true);
            $seattransitpergi = $this->input->post($txbseatperginame,true);
            $flightclasstransitpergi = $this->input->post($txbflightclasstransitperginame,true);
            $bagasipergi = $this->input->post($txbbagasiperginame,true);
            $timelimitpergi = $this->input->post($txbtimelimitperginame,true);

            $datatransflightdetailpergi = array(
                'trans_id' => $transid,
                'transactionId' => $transactionidpergi,
                'bookingCode' => $bookingcodepergi,
                'paymentCode' => $paymentcodepergi,
                'type' => 'Pergi',
                'air_from' => $air_from,
                'air_to' => $air_to,
                'depart_time' => $departtimepergi,
                'arrival_time' => $arrivaltimepergi,
                'transitTime' => $transittimepergi,
                'flightCode' => $flightcodetransitpergi,
                'flightName' => $flightnametransitpergi,
                'flightIcon' => $flighticontransitpergi,
                'is_transit' => $istransitpergi,
                'transit_name1' => $transitName1pergi,
                'transit_name2' => $transitName2pergi,
                'depart_transit_time' => $departtimetransitpergi,
                'arrival_transit_time' => $arrivaltimetransitpergi,
                'seat' => $seattransitpergi,
                'class' => $flightclasstransitpergi,
                'baggage' => $bagasipergi,
                'timeLimit' => $timelimitpergi,
                'urlEtiket' => $urleticketpergi,
                'urlStruk' => $urlstrukpergi,
            );

            $transflightdetailpergi = $this->M_pesawat->simpandata("trans_flight_detail",$datatransflightdetailpergi);

            //input harga

            $txbflightfareperginame = 'flightfarepergi'.$a;
            $txbflightadminperginame = 'flightbiayaadminpergi'.$a;
            $txbcommisionperginame = 'commisionpergi'.$a;

            $nominal = $this->input->post($txbflightfareperginame,true);
            $nominaladmin = $this->input->post($txbflightadminperginame,true);
            $commision = $this->input->post($txbcommisionperginame,true);

            $datatransflightdetailhargapergi = array(
                'trans_id' => $transid,
                'transactionId' => $transactionidpergi,
                'nominal' => $nominal,
                'commision' => $commision,
                'nominalAdmin' => $nominaladmin,
            );

            $transflightdetailhargapergi = $this->M_pesawat->simpandata("trans_flight_detail_harga",$datatransflightdetailhargapergi);

        }

        if($pulangpergi == 'on'){

            //input pulang

            $jumlahpesawatpulang = $this->input->post('jumlahpesawatpulang',true);
            $departtimepulang = $this->input->post('jampergipulang',true);
            $arrivaltimepulang = $this->input->post('jamtibapulang',true);
            $istransitpulang = $this->input->post('istransitpulang',true);

            for ($a = 0; $a < $jumlahpesawatpulang; $a++) {

                $txbtransactionidpulangname = 'transactionidpulang'.$a;
                $txbbookingcodepulangname = 'bookingcodepulang'.$a;
                $txbpaymentcodepulangname = 'paymentcodepulang'.$a;
                $txbtransittimepulangname = 'transittimepulang'.$a;
                $txbflightcodetransitpulangname = 'flightcodepulang'.$a;
                $txbflightnametransitpulangname = 'flightnamepulang'.$a;
                $txbflighticontransitpulangname = 'flighticonpulang'.$a;
                $txbtransitname1pulangname = 'transitname1pulang'.$a;
                $txbtransitname2pulangname = 'transitname2pulang'.$a;
                $txbdeparttimetransitpulangname = 'departtimepulang'.$a;
                $txbarrivaltimetransitpulangname = 'arrivaltimepulang'.$a;
                $txbseatpulangname = 'seatspulang'.$a;
                $txbflightclasstransitpulangname = 'flightclasspulang'.$a;
                $txbbagasipulangname = 'bagasipulang'.$a;
                $txbtimelimitpulangname = 'timelimitpulang'.$a;

                $transactionidpulang = $this->input->post($txbtransactionidpulangname,true);
                $bookingcodepulang = $this->input->post($txbbookingcodepulangname,true);
                $paymentcodepulang = $this->input->post($txbpaymentcodepulangname,true);
                $transittimepulang = $this->input->post($txbtransittimepulangname,true);
                $flightcodetransitpulang = $this->input->post($txbflightcodetransitpulangname,true);
                $flightnametransitpulang = $this->input->post($txbflightnametransitpulangname,true);
                $flighticontransitpulang = $this->input->post($txbflighticontransitpulangname,true);
                $transitName1pulang = $this->input->post($txbtransitname1pulangname,true);
                $transitName2pulang = $this->input->post($txbtransitname2pulangname,true);
                $departtimetransitpulang = $this->input->post($txbdeparttimetransitpulangname,true);
                $arrivaltimetransitpulang = $this->input->post($txbarrivaltimetransitpulangname,true);
                $seattransitpulang = $this->input->post($txbseatpulangname,true);
                $flightclasstransitpulang = $this->input->post($txbflightclasstransitpulangname,true);
                $bagasipulang = $this->input->post($txbbagasipulangname,true);
                $timelimitpulang = $this->input->post($txbtimelimitpulangname,true);

                $datatransflightdetailpulang = array(
                    'trans_id' => $transid,
                    'transactionId' => $transactionidpulang,
                    'bookingCode' => $bookingcodepulang,
                    'paymentCode' => $paymentcodepulang,
                    'type' => 'Pulang',
                    'air_from' => $air_to,
                    'air_to' => $air_from,
                    'depart_time' => $departtimepulang,
                    'arrival_time' => $arrivaltimepulang,
                    'transitTime' => $transittimepulang,
                    'flightCode' => $flightcodetransitpulang,
                    'flightName' => $flightnametransitpulang,
                    'flightIcon' => $flighticontransitpulang,
                    'is_transit' => $istransitpulang,
                    'transit_name1' => $transitName1pulang,
                    'transit_name2' => $transitName2pulang,
                    'depart_transit_time' => $departtimetransitpulang,
                    'arrival_transit_time' => $arrivaltimetransitpulang,
                    'seat' => $seattransitpulang,
                    'class' => $flightclasstransitpulang,
                    'baggage' => $bagasipulang,
                    'timeLimit' => $timelimitpulang,
                    'urlEtiket' => $urleticketpulang,
                    'urlStruk' => $urlstrukpulang,
                );

                $transflightdetailpulang = $this->M_pesawat->simpandata("trans_flight_detail",$datatransflightdetailpulang);


                //input harga

                $txbflightfarepulangname = 'flightfarepulang'.$a;
                $txbflightadminpulangname = 'flightbiayaadminpulang'.$a;
                $txbcommisionpulangname = 'commisionpulang'.$a;

                $nominal = $this->input->post($txbflightfarepulangname,true);
                $nominaladmin = $this->input->post($txbflightadminpulangname,true);
                $commision = $this->input->post($txbcommisionpulangname,true);

                $datatransflightdetailhargapergi = array(
                    'trans_id' => $transid,
                    'transactionId' => $transactionidpulang,
                    'nominal' => $nominal,
                    'commision' => $commision,
                    'nominalAdmin' => $nominaladmin,
                );

                $transflightdetailhargapergi = $this->M_pesawat->simpandata("trans_flight_detail_harga",$datatransflightdetailhargapergi);


            }

        }

        //save to trans_flight_penumpang

        for ($a = 1; $a <= $adult; $a++) {

            $slkewarganegaraan = 'slkewarganegaraan'.$a;
            $txbtiteldewasa = 'txbtiteldewasa'.$a;
            $txbnamadepandewasa = 'txbnamadepandewasa'.$a;
            $txbnamabelakangdewasa = 'txbnamabelakangdewasa'.$a;
            $txbemaildewasa = 'txbemaildewasa'.$a;
            $txbnotelepondewasa = 'txbnotelepondewasa'.$a;
            $txbnohandphonedewasa = 'txbnohandphonedewasa'.$a;
            $txbtgllahirdewasa = 'txbtgllahirdewasa'.$a;
            $txbjenisidcardewasa = 'txbjenisidcardewasa'.$a;
            $txbnoidentitydewasa = 'txbnoidentitydewasa'.$a;

            $kewarganegaraan = $this->input->post($slkewarganegaraan,true);
            $titeldewasa = $this->input->post($txbtiteldewasa,true);
            $namadepandewasa = $this->input->post($txbnamadepandewasa,true);
            $namabelakangdewasa = $this->input->post($txbnamabelakangdewasa,true);
            $emaildewasa = $this->input->post($txbemaildewasa,true);
            $notelepondewasa = $this->input->post($txbnotelepondewasa,true);
            $nohandphonedewasa = $this->input->post($txbnohandphonedewasa,true);
            $tgllahirdewasa = $this->input->post($txbtgllahirdewasa,true);
            $exptgllahirdewasa = explode('/', $tgllahirdewasa);
            $tgllahir = $exptgllahirdewasa[2].'-'.$exptgllahirdewasa[1].'-'.$exptgllahirdewasa[0];
            $jenisidcardewasa = $this->input->post($txbjenisidcardewasa,true);
            $noidentitydewasa = $this->input->post($txbnoidentitydewasa,true);

            $datatranspenumpang = array(
                'trans_id' => $transid,
                'type' => 'Dewasa',
                'title' => $titeldewasa,
                'fname' => $namadepandewasa,
                'lname' => $namabelakangdewasa,
                'kewarganegaraan' => $kewarganegaraan,
                'email' => $emaildewasa,
                'no_telp' => $notelepondewasa,
                'no_hp' => $nohandphonedewasa,
                'tgl_lahir' => $tgllahir,
                'id_card' => $jenisidcardewasa,
                'no_id_card' => $noidentitydewasa,
            );

            $transflightdetailpenumpang = $this->M_pesawat->simpandata("trans_flight_detail_penumpang",$datatranspenumpang);


        }

        if($child > 0){

            for ($a = 1; $a <= $child; $a++) {

                $txbtitelanak = 'txbtitelanak'.$a;
                $txbnamadepananak = 'txbnamadepananak'.$a;
                $txbnamabelakanganak = 'txbnamabelakanganak'.$a;
                $txbtgllahiranak = 'txbtgllahiranak'.$a;

                $titelanak = $this->input->post($txbtitelanak,true);
                $namadepananak = $this->input->post($txbnamadepananak,true);
                $namabelakanganak = $this->input->post($txbnamabelakanganak,true);
                $tgllahiranak = $this->input->post($txbtgllahiranak,true);
                $exptgllahiranak= explode('/', $tgllahiranak);
                $tgllahir = $exptgllahiranak[2].'-'.$exptgllahiranak[1].'-'.$exptgllahiranak[0];

                $datatranspenumpang = array(
                    'trans_id' => $transid,
                    'type' => 'Anak-Anak',
                    'title' => $titelanak,
                    'fname' => $namadepananak,
                    'lname' => $namabelakanganak,
                    'tgl_lahir' => $tgllahir,
                );

                $transflightdetailpenumpang = $this->M_pesawat->simpandata("trans_flight_detail_penumpang",$datatranspenumpang);


            }

        }

        if($infant > 0){

            for ($a = 1; $a <= $infant; $a++) {

                $txbtitelbayi = 'txbtitelbayi'.$a;
                $txbnamadepanbayi = 'txbnamadepanbayi'.$a;
                $txbnamabelakangbayi = 'txbnamabelakangbayi'.$a;
                $txbtgllahirbayi = 'txbtgllahirbayi'.$a;

                $titelbayi = $this->input->post($txbtitelbayi,true);
                $namadepanbayi = $this->input->post($txbnamadepanbayi,true);
                $namabelakangbayi = $this->input->post($txbnamabelakangbayi,true);
                $tgllahirbayi = $this->input->post($txbtgllahirbayi,true);
                $exptgllahirbayi= explode('/', $tgllahirbayi);
                $tgllahir = $exptgllahirbayi[2].'-'.$exptgllahirbayi[1].'-'.$exptgllahirbayi[0];

                $datatranspenumpang = array(
                    'trans_id' => $transid,
                    'type' => 'Bayi',
                    'title' => $titelbayi,
                    'fname' => $namadepanbayi,
                    'lname' => $namabelakangbayi,
                    'tgl_lahir' => $tgllahir,
                );

                $transflightdetailpenumpang = $this->M_pesawat->simpandata("trans_flight_detail_penumpang",$datatranspenumpang);


            }

        }

        return $transid;

    }

}
