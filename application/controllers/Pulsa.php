<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pulsa extends CI_Controller {

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

            $data["data_produk"]  = $this->getdatapulsadata();
            $data['jspulsa_to_load']= 'js_pulsa.js';
            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }

            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $this->load->view('layout/v_header',$data);
            $this->load->view('pulsa/pulsa',$data);
            $this->load->view('layout/v_footer',$data);
        }
    }

    public function getdatapulsadata()
    {

        $parampulsa = Array(
            'kategori[]' => 1,
        );

        $paramdata = Array(
            'kategori[]' => 2,
        );

        $APIurl = $this->config->item('api_produk');
        $datapulsa = json_decode($this->curl->simple_post($APIurl, $parampulsa, array(CURLOPT_BUFFERSIZE => 10)));
        $datadata = json_decode($this->curl->simple_post($APIurl, $paramdata, array(CURLOPT_BUFFERSIZE => 10)));

        $arr = array(
            "datapulsa" => $datapulsa,
            "datadata" => $datadata
        );

        return $arr;

    }

    public function getdatapulsanominal()
    {

        $data = json_encode($this->getdatapulsadata());

        echo $data;

    }

}
