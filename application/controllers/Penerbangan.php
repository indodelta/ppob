<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 1000);

class Penerbangan extends CI_Controller
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

    public function getflightconfiguration()
    {
        $token = array(
            'token' => $this->session->userdata('tokenft')
        );

        $APIurl = $this->config->item('api2_flightconfig');
        $data = json_decode($this->curl->simple_post($APIurl, $token, array(CURLOPT_BUFFERSIZE => 10)));

        return $data;
    }

    public function getdataairport()
    {
        $token = array(
            'token' => $this->session->userdata('tokenft')
        );

        $APIurl = $this->config->item('api2_airportsname');
        $data = json_decode($this->curl->simple_post($APIurl, $token, array(CURLOPT_BUFFERSIZE => 10)));

        $a=array();

        if($data != null){

            $lengthdata = count($data->data);

            for ($i = 0; $i < $lengthdata; $i++) {
                $bandara = $data->data[$i]->bandara;
                $name = $data->data[$i]->name;
                $code = $data->data[$i]->code;

                $label = $code.'-'.$name.' | '.$bandara;

                array_push($a,$label);
            };

        }

        $arr = array(
            "name" => $a
        );

        echo json_encode($arr);
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
            $data['jspesawat_to_load']= 'penerbangan/js_penerbangan.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $this->load->view('layout/v_header',$data);
            $this->load->view('penerbangan/index',$data);
            $this->load->view('layout/v_footer',$data);
        }
    }

    public function cari_jadwal()
    {
        $id = $this->session->userdata('iduser');
        $level = $this->session->userdata('user_level');
        if($level == 0){
            $data['datasaldo'] = $this->cek_saldo_mobipay();
        }else{
            $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
        }
        $data['jspesawat_to_load']= 'penerbangan/js_jadwalpenerbangan.js';
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

        $this->load->view('layout/v_header',$data);
        $this->load->view('penerbangan/v_flightsearch',$data);
        $this->load->view('layout/v_footer',$data);

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
            "return" => $cekreturn,
            "airline" => $airline,
            "departure" => $departure,
            "arrival" => $arrival,
            "departureDate" => $departureDate,
            "returnDate" => $departureDate,
            "isLowestPrice" => true,
            "adult" => $adult,
            "child" => $child,
            "infant" => $infant,
            "token" => $token);

        $jadwal = $this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10));

        echo $jadwal;
    }

    public function open_form_jadwal()
    {
        $cekreturn = $this->input->post('cekreturn',true);

        $data['jadwal'] = $this->input->post('jadwal',true);
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
        $data['js_to_load']= 'penerbangan/js_formpesawat.js';

        if($cekreturn == 'on'){
            $this->load->view('penerbangan/form_pulangpergi',$data);
        }else{
            $this->load->view('penerbangan/form_pergi',$data);
        }
    }


}