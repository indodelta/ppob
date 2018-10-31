<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class lupa_password extends CI_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->model('M_login');
        $this->load->model('M_user');
        $this->load->view('func_custom');
        $this->domain = $_SERVER['HTTP_HOST'];
    }

    public function index()
    {
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
        $this->load->view('lupa_password',$data);
    }

}