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

}