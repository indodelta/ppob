<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_user');
        $this->load->model('M_login');
        $this->domain = $_SERVER['HTTP_HOST'];
    }

    public function index()
    {
        $user_data = $this->session->userdata;

//        $data['jsprofil_to_load']= 'js_profil.js';
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

        $data['datauser'] = $this->M_user->load_data_user_whereid($user_data['iduser']);

        $id = $this->session->userdata('iduser');
        $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);

        $this->load->view('layout/v_header',$data);
        $this->load->view('profil/profil',$data);
        $this->load->view('layout/v_footer',$data);
    }

}