<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lembaga extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_user');
        $this->load->model('M_login');
        $this->load->model('M_lembaga');
        $this->domain = $_SERVER['HTTP_HOST'];
    }

    public function index()
    {
        redirect(site_url("dashboard"));
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

    public function tambah()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }
            $this->load->view('layout/v_header',$data);
            $this->load->view('lembaga/form_tambah',$data);
            $this->load->view('layout/v_footer',$data);
        }
    }
}