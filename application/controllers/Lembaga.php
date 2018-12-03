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
        $this->load->model('M_domain');
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
            $data['js_to_load']= 'js_lembaga.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            $data['data_domain'] = $this->M_domain->load_data_domain();

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

    public function simpan()
    {
        //save to trans_flight table

        $namalembaga = $this->input->post('txbnamalembaga',true);
        $urllembaga = $this->input->post('txburllembaga',true);
        $sldomainlembaga = $this->input->post('sldomainlembaga',true);
        $surl = $urllembaga.'.'.$sldomainlembaga;
        $tampilan = $this->input->post('tampilan',true);
        if($tampilan == 'tampilan1'){
            $css = 'style.css';
            $css2 = 'swiper-slide-merah';
            $warna = '#ED5565';
            $bg_color = 'red-bg';
            $btn_color = 'btn-danger';
        }elseif ($tampilan == 'tampilan2'){
            $css = 'style_blue.css';
            $css2 = 'swiper-slide-abu';
            $warna = '#1a3664';
            $bg_color = 'blue-bg';
            $btn_color = 'btn-danger';
        }elseif ($tampilan == 'tampilan3'){
            $css = 'style1.css';
            $css2 = 'swiper-slide-abu';
            $warna = '#00963B';
            $bg_color = 'yellow-bg';
            $btn_color = 'btn-danger';
        }elseif ($tampilan == 'tampilan4'){
            $css = 'style_yellow.css';
            $css2 = 'swiper-slide-merah';
            $warna = '#454D88';
            $bg_color = 'yellow-bg';
            $btn_color = 'btn-danger';
        }

        $datalembaga = $this->M_lembaga->load_data_lembaga();
        $apiuserkey = $datalembaga[0]->api_userkey;
        if($apiuserkey == ''){
            $apiuserkey = 'MT101';
        }else{
            $apiuserkey = 'MT'.(substr($apiuserkey,-3)+1);
        }

        $apipasskey = "";
        $label = "ABCDEFGHIJKLIMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for ($i=0;$i<20;$i++) { $apipasskey .= $label[rand(0,strlen($label)-1)]; }

        $datasimpanlembaga = array(
            'nama' => $namalembaga,
            'surl' => $surl,
            'logo' => 'mantap.png',
            'css' => $css,
            'css2' => $css2,
            'warna' => $warna,
            'bg_color' => $bg_color,
            'btn_color' => $btn_color,
            'api_status' => 1,
            'api_userkey' => $apiuserkey,
            'api_passkey' => $apipasskey,
        );

        $config['upload_path']          = './assets/img/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('imgInp')){
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect(base_url('Lembaga/tambah'));
        }else{
            $data = array('upload_data' => $this->upload->data());
            $logo = $data['upload_data']['file_name'];

            $datasimpanlembaga = array(
                'nama' => $namalembaga,
                'surl' => $surl,
                'logo' => $logo,
                'css' => $css,
                'css2' => $css2,
                'warna' => $warna,
                'bg_color' => $bg_color,
                'btn_color' => $btn_color,
                'api_status' => 1,
                'api_userkey' => $apiuserkey,
                'api_passkey' => $apipasskey,
            );

            $id = $this->M_lembaga->simpan_data_lembaga($datasimpanlembaga);

            if($id != ''){
                $this->session->set_flashdata('success', 'Anda berhasil menambahkan lembaga baru');
                redirect(base_url('admin/lembaga'));
            }

        }

    }
}