<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PGN extends CI_Controller
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

            $this->load->view('PGN/form_pgn');

        }

    }

    public function open_form_pgn()
    {
        $data['dataproduk'] = $this->getdatadenomproduk();
        $this->load->view('PGN/form_pgn',$data);
    }

    public function getdatadenomproduk()
    {

        $parampln = Array(
            'kategori[]' => 14,
        );

        $APIurl = $this->config->item('api_produk');
        $dataproduk = json_decode($this->curl->simple_post($APIurl, $parampln, array(CURLOPT_BUFFERSIZE => 10)));

        return $dataproduk;

    }

}