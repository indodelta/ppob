<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pascabayar extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_login');
        $this->domain = $_SERVER['HTTP_HOST'];
    }

    public function index()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{

            $this->load->view('PascaBayar/form_pascabayar');

        }

    }

    public function open_form_pascabayar()
    {
        $this->load->view('PascaBayar/form_pascabayar');
    }

}