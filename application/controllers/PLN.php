<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PLN extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{

            $this->load->view('PLN/form_pln');

        }

    }

    public function open_form_pln()
    {
        $data['dataproduk'] = $this->getdatadenomproduk();
        $this->load->view('PLN/form_pln',$data);
    }

    public function getdatadenomproduk()
    {

        $parampln = Array(
            'kategori[]' => 8,
        );

        $APIurl = $this->config->item('api_produk');
        $dataproduk = json_decode($this->curl->simple_post($APIurl, $parampln, array(CURLOPT_BUFFERSIZE => 10)));

        return $dataproduk;

    }


}