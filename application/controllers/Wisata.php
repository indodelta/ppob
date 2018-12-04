<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wisata extends CI_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_login');
        $this->load->model('M_user');
        $this->load->model('M_wisata');
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
            $data['jskereta_to_load']= 'js_wisata.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            $data['data_wisata_kota'] = $this->M_wisata->load_data_wisata_where_type('KOTA');
            $data['data_wisata_prov'] = $this->M_wisata->load_data_wisata_where_type('PROVINSI');
            $data['data_area_prov'] = $this->M_wisata->load_data_wisata_where_type('AREA');

            $this->load->view('layout/v_header',$data);
            $this->load->view('wisata/wisata');
            $this->load->view('layout/v_footer',$data);
        }

    }

    public function cari()
    {

        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $txbcari = $this->input->get('nama',true);

            echo $txbcari;
        }

    }


}