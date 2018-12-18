<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 1000);

class PELNI extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_login');
        $this->load->model('M_user');
        $this->load->model('M_transaksi');
        $this->load->model('M_transdetail');
        $this->load->model('M_user_deposit');
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
            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }
            $data['jskereta_to_load']= 'js_pelni.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $this->load->view('layout/v_header',$data);
            $this->load->view('pelni/pelni');
            $this->load->view('layout/v_footer',$data);
        }

    }

    public function get_origin()
    {
        $token = $this->session->userdata('tokenft');

        $param = array("token"=>$token);

        $APIurl = $this->config->item('api2_pelniorigin');

        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        $a = array();

        if($data != ''){
            $lengthdata = count($data->data);

            for ($i = 0; $i < $lengthdata; $i++) {
                $name = $data->data[$i]->NAME;
                $code = $data->data[$i]->CODE;

                $label = $code.' - '.$name;

                array_push($a,$label);
            };
        }

        $arr = array(
            "name" => $a
        );

        echo json_encode($arr);
    }

    public function get_destination()
    {
        $token = $this->session->userdata('tokenft');

        $param = array("token"=>$token);

        $APIurl = $this->config->item('api2_pelnidestination');

        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        $a=array();

        if($data != '') {
            $lengthdata = count($data->data);

            for ($i = 0; $i < $lengthdata; $i++) {
                $name = $data->data[$i]->NAME;
                $code = $data->data[$i]->CODE;

                $label = $code . ' - ' . $name;

                array_push($a, $label);
            };

        }

        $arr = array(
            "name" => $a
        );

        echo json_encode($arr);
    }

    public function get_jadwal()
    {
        $cekpp = $this->input->post('cekpp');

        $origin = $this->input->post('origin',true);
        $exporigin = explode('-', $origin);
        $origincode = str_replace(' ', '', $exporigin[0]);

        $dest = $this->input->post('destination',true);
        $expdest = explode('-', $dest);
        $destcode = str_replace(' ', '', $expdest[0]);

        $tglpergi = $this->input->post('tglpergi',true);
        $exptglpergi = explode('/', $tglpergi);
        $tanggalpergi = $exptglpergi[2].'-'.$exptglpergi[1].'-'.$exptglpergi[0];

        $tglpulang = $this->input->post('tglpulang',true);
        $exptglpulang = explode('/', $tglpulang);
        $tanggalpulang = $exptglpulang[2].'-'.$exptglpulang[1].'-'.$exptglpulang[0];

        $token = $this->session->userdata('tokenft');

        $param = array(
          "origin"=>$origincode,
          "destination"=>$destcode,
          "tanggalpergi"=>$tanggalpergi,
          "token"=>$token,
        );

        $APIurl = $this->config->item('api2_pelnisearch');

        $data['pergi'] = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        if($cekpp == 'on'){

            $param = array(
                "origin"=>$destcode,
                "destination"=>$origincode,
                "tanggalpergi"=>$tanggalpulang,
                "token"=>$token,
            );

            $APIurl = $this->config->item('api2_pelnisearch');

            $data['pulang'] = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));


        }

        return $data;

    }

    public function get_namarute(){

        $token = $this->session->userdata('tokenft');

        $param = array("token"=>$token);

        $APIurl = $this->config->item('api2_pelnidestination');

        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        return $data;

    }

    public function jadwal()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            $data['jadwal'] = $this->get_jadwal();
            $data['kode'] = $this->get_namarute();
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }
            $data['jskereta_to_load']= 'js_jadwalpelni.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $this->load->view('layout/v_header',$data);
            $this->load->view('pelni/jadwal',$data);
            $this->load->view('layout/v_footer',$data);
        }

    }

    public function penumpang()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }
            $data['jskereta_to_load']= 'js_penumpangpelni.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $this->load->view('layout/v_header',$data);
            $this->load->view('pelni/penumpang',$data);
            $this->load->view('layout/v_footer',$data);
        }

    }

    public function booking()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{

            $data['booking'] = $this->get_booking();

            var_dump($data);

        }
    }

    public function get_booking()
    {
        $data = array();

        $token = $this->session->userdata('tokenft');

        $origin = $this->input->post('origin',true);
        $exporigin = explode('-', $origin);
        $origincode = str_replace(' ', '', $exporigin[0]);

        $destination = $this->input->post('destination',true);
        $expdest = explode('-', $destination);
        $destcode = str_replace(' ', '', $expdest[0]);

        $origincallpergi = $this->input->post('origincallpergi',true);
        $destinationcallpergi = $this->input->post('destinationcallpergi',true);
        $departuredatepergi = $this->input->post('departuredatepergi',true);
        $shipnumberpergi = $this->input->post('shipnumberpergi',true);

        $kelaspergi = $this->input->post('kelaspergi',true);
        $expkelaspergi = explode('-', $kelaspergi);
        $subkelaspergi = str_replace(' ', '', $expkelaspergi[1]);

        $male = $this->input->post('jmlpria',true);
        $female = $this->input->post('jmlwanita',true);
        $adult = $male + $female;
        $infant = $this->input->post('jmlbayi',true);

        $isfamily = 'N';
        $txbisfamily = $this->input->post('isfamily',true);
        if($txbisfamily == 'on'){
            $isfamily = 'Y';
        }

        $emailkontak = $this->input->post('txbemailkontak',true);
        $notelpkontak = $this->input->post('txbnotelpkontak',true);

        $arrcontact = array(
            "email" => $emailkontak,
            "phone" => $notelpkontak
        );

        $arraypenumpang = array();

        $arraypenumpangdewasa = array();

        for ($a = 1; $a <= $adult; $a++) {

            $txbnamedewasa = 'txbnamedewasa' . $a;
            $txbiddewasa = 'txbiddewasa' . $a;
            $txbtgllahirdewasa = 'txbtgllahirdewasa' . $a;
            $slgenderdewasa = 'slgenderdewasa'.$a;

            $namadewasa = $this->input->post($txbnamedewasa,true);
            $iddewasa = $this->input->post($txbiddewasa,true);
            $tgllahirdewasa = $this->input->post($txbtgllahirdewasa,true);
            $exptgllahirdewasa = explode('/', $tgllahirdewasa);
            $tgllahirdewasa = $exptgllahirdewasa[2].'-'.$exptgllahirdewasa[1].'-'.$exptgllahirdewasa[0];
            $genderdewasa = $this->input->post($slgenderdewasa,true);

            $arraydewasa = array(
              "name" => $namadewasa,
              "birthDate" => $tgllahirdewasa,
              "identityNumber" => $iddewasa,
              "gender" => $genderdewasa,
            );

            array_push($arraypenumpangdewasa,$arraydewasa);

        }

        $arraypenumpang['adults'] = $arraypenumpangdewasa;

        $arraypenumpangbayi = array();

        if($infant > 0){

            for ($a = 1; $a <= $infant; $a++) {

                $txbnamabayi = 'txbnamebayi' . $a;
                $txbtgllahirbayi = 'txbtgllahirbayi' . $a;
                $slgenderdbayi = 'slgenderdbayi'.$a;

                $namabayi = $this->input->post($txbnamabayi,true);
                $tgllahirbayi = $this->input->post($txbtgllahirbayi,true);
                $exptgllahirbayi = explode('/', $tgllahirbayi);
                $tgllahirbayi = $exptgllahirbayi[2].'-'.$exptgllahirbayi[1].'-'.$exptgllahirbayi[0];
                $genderdbayi = $this->input->post($slgenderdbayi,true);

                $arraybayi = array(
                    "name" => $namabayi,
                    "birthDate" => $tgllahirbayi,
                    "gender" => $genderdbayi,
                );

                array_push($arraypenumpangbayi,$arraybayi);

            }

            $arraypenumpang['infants'] = $arraypenumpangbayi;

        }

        $parampergi = array(
            "origin" => $origincode,
            "originCall" => $origincallpergi,
            "destination" => $destcode,
            "destinationCall" => $destinationcallpergi,
            "departureDate" => $departuredatepergi,
            "shipNumber" => $shipnumberpergi,
            "subClass" => $subkelaspergi,
            "male" => $male,
            "female" => $female,
            "adult" => $adult,
            "child" => 0,
            "infant" => $infant,
            "isFamily" => $isfamily,
            "contact" => $arrcontact,
            "passengers" => $arraypenumpang,
            "token" => $token);

        return $parampergi;

    }


}