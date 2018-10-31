<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 300);

class Pesawat extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_login');
        $this->load->model('M_user');
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
            $data['config'] = $this->getflightconfiguration();

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

        $data['jadwal'] = $this->getflightschedule();

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
    }

    public function getflightschedule()
    {
        $cekreturn = $this->input->post('cekreturn');

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

        $dataairline = $this->getflightconfiguration();

        $data = array();
        $arrAirline = array();

        $jmlsettings = count($dataairline->data->settings);

        $ischd = '';
        $isinf = '';

        $APIurl = $this->config->item('api2_flightsearch');

        if($child>0 and $infant>0){

            $ischd = 1;
            $isinf = 1;

            for($x=0;$x<$jmlsettings;$x++) {

                if($dataairline->data->settings[$x]->isActive == 1){

                    $isinfant = $dataairline->data->settings[$x]->isInfant;
                    $ischild = $dataairline->data->settings[$x]->isChild;

                    if($isinfant == $isinf and $ischild == $ischd){

                        $airline = $dataairline->data->settings[$x]->airline;

                        $arrAirline[] = $airline;

                    }

                }

            }

        }elseif($child>0 or $infant>0){

            if($child>0){$ischd = 1;}
            if($infant>0){$isinf = 1;}

            for($x=0;$x<$jmlsettings;$x++) {
                if($dataairline->data->settings[$x]->isActive == 1){

                    $isinfant = $dataairline->data->settings[$x]->isInfant;
                    $ischild = $dataairline->data->settings[$x]->isChild;

                    if($isinfant == $isinf or $ischild == $ischd){

                        $airline = $dataairline->data->settings[$x]->airline;

                        $arrAirline[] = $airline;

                    }

                }

            }

        }else{

            for($x=0;$x<$jmlsettings;$x++) {
                if($dataairline->data->settings[$x]->isActive == 1){

                    $airline = $dataairline->data->settings[$x]->airline;

                    $arrAirline[] = $airline;

                }

            }

        }

        $jmlairline = count($arrAirline);

        if($cekreturn == 'on'){
            $arrPergi = array();
            $arrPulang = array();

            for($y=0;$y<$jmlairline;$y++) {

                $parampergi = array(
                    "airline"=>$arrAirline[$y],
                    "departure"=>$departure,
                    "arrival"=>$arrival,
                    "departureDate"=>$departureDate,
                    "returnDate"=>$departureDate,
                    "isLowestPrice"=>true,
                    "adult"=>$adult,
                    "child"=>$child,
                    "infant"=>$infant,
                    "token"=>$token);

                $dataApipergi = json_decode($this->curl->simple_post($APIurl, $parampergi, array(CURLOPT_BUFFERSIZE => 10)));

                if($dataApipergi->rc == 00){
                    $arrPergi[] = $dataApipergi;
                }

            }

            for($z=0;$z<$jmlairline;$z++) {

                $parampulang = array(
                    "airline"=>$arrAirline[$z],
                    "departure"=>$arrival,
                    "arrival"=>$departure,
                    "departureDate"=>$returnDate,
                    "returnDate"=>$returnDate,
                    "isLowestPrice"=>true,
                    "adult"=>$adult,
                    "child"=>$child,
                    "infant"=>$infant,
                    "token"=>$token);

                $dataApipulang = json_decode($this->curl->simple_post($APIurl, $parampulang, array(CURLOPT_BUFFERSIZE => 10)));

                if($dataApipulang->rc == 00){
                    $arrPulang[] = $dataApipulang;
                }

            }

            $data['pergi'] = $arrPergi;
            $data['pulang'] = $arrPulang;

        }else{

            for($y=0;$y<$jmlairline;$y++) {

                $param = array(
                    "airline"=>$arrAirline[$y],
                    "departure"=>$departure,
                    "arrival"=>$arrival,
                    "departureDate"=>$departureDate,
                    "returnDate"=>$returnDate,
                    "isLowestPrice"=>true,
                    "adult"=>$adult,
                    "child"=>$child,
                    "infant"=>$infant,
                    "token"=>$token);

                $dataApi = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

                if($dataApi->rc == 00){
                    $data[] = $dataApi;
                }


            }

        }

        return $data;

    }


}
