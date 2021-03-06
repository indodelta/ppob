<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kredit extends CI_Controller
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

            $this->load->view('Kredit/form_kredit');

        }

    }

    public function open_form_angskredit()
    {
        $data['dataproduk'] = $this->getdatadenomproduk();
        $this->load->view('Kredit/form_kredit',$data);
    }

    public function getdatadenomproduk()
    {

        $parampln = Array(
            'kategori[]' => 11,
        );

        $APIurl = $this->config->item('api_produk');
        $dataproduk = json_decode($this->curl->simple_post($APIurl, $parampln, array(CURLOPT_BUFFERSIZE => 10)));

        return $dataproduk;

    }

    public function getdatakreditproduk()
    {

        $data = json_encode($this->getdatadenomproduk());

        echo $data;

    }

}