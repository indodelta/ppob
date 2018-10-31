<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 300);
ini_set('max_input_vars', 3000);

class Flight extends CI_Controller
{

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
            $data['jspesawat_to_load']= 'flight/flight.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $this->load->view('layout/v_header',$data);
            $this->load->view('flight/flight',$data);
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
        $data['config'] = $this->getflightconfiguration();

        $id = $this->session->userdata('iduser');
        $level = $this->session->userdata('user_level');
        if($level == 0){
            $data['datasaldo'] = $this->cek_saldo_mobipay();
        }else{
            $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
        }
        $data['jspesawat_to_load']= 'flight/flightsearch.js';
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

        $this->load->view('layout/v_header',$data);
        $this->load->view('flight/v_flightsearch',$data);
        $this->load->view('layout/v_footer',$data);
    }

    public function open_form_jadwal()
    {
        $cekreturn = $this->input->post('cekreturn',true);

        $data['jadwal'] = $this->input->post('jadwal',true);
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
        $data['jspesawat_to_load']= 'flight/flightform.js';
        if($cekreturn == 'on'){
            $this->load->view('flight/form_pulangpergi',$data);
        }else{
            $this->load->view('flight/form_pergi',$data);
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

        $APIurl = $this->config->item('api2_flightsearch2');

        $param = array(
            "return"=>$cekreturn,
            "airline"=>$airline,
            "departure"=>$departure,
            "arrival"=>$arrival,
            "departureDate"=>$departureDate,
            "returnDate"=>$returnDate,
            "isLowestPrice"=>true,
            "adult"=>$adult,
            "child"=>$child,
            "infant"=>$infant,
            "token"=>$token);

        $data = $this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10));

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
        $this->load->view('flight/v_flightinfo',$data);
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
                "adult"=>$adult,
                "child"=>$child,
                "infant"=>$infant,
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

}