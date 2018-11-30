<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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

    public function profile()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            $data['js_to_load']= 'js_profile.js';
            $data['datauser'] = $this->M_user->load_data_user_whereid($id);
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }
            $this->load->view('layout/v_header',$data);
            $this->load->view('admin/profile',$data);
            $this->load->view('layout/v_footer',$data);
        }
    }

    public function update_profil()
    {
        $iduser = $this->input->post('txbid');
        $fullname = $this->input->post('txbnama');
        $telepon = $this->input->post('txbtelepon');
        $alamat = $this->input->post('txbalamat');
        $email = $this->input->post('txbemail');

        $where = array(
            'id' => $iduser
        );

        $data = array(
            'nama' => $fullname,
            'alamat' => $alamat,
            'email' => $email,
            'telepon' => $telepon,
        );

        $update = $this->M_user->update_data($where,$data);

        if($update == true) {
            $this->session->set_flashdata('updateprofilberhasil', $iduser);
            redirect(base_url('admin/profile'));
        }else{
            $this->session->set_flashdata('profilgagal', 'Ada kesalahan pada database');
            redirect(base_url('admin/profile'));
        }
    }

    public function password()
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
            $data['js_to_load']= 'js_password.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            $this->load->view('layout/v_header',$data);
            $this->load->view('admin/password',$data);
            $this->load->view('layout/v_footer',$data);
        }
    }

    public function cek_password()
    {
        $pass = $this->input->get('password');

        $where = array(
            'password' => md5($pass),
            'lembaga_id' => $this->session->userdata('lembaga_id'),
        );
        $cek = $this->M_user->cek_user($where)->num_rows();

        echo $cek;
    }

    public function cek_usernamepassword()
    {
        $user = $this->input->get('username');
        $pass = $this->input->get('password');

        $where = array(
            'username' => $user,
            'password' => md5($pass),
            'lembaga_id' => $this->session->userdata('lembaga_id'),
        );
        $cek = $this->M_user->cek_user($where)->num_rows();

        echo $cek;

    }

    public function update_password()
    {
        $newpass = $this->input->post('newpass1');
        $iduser = $this->input->post('txbid');

        $where = array(
            'id' => $iduser
        );

        $data = array(
            'password' => md5($newpass),
        );

        $update = $this->M_user->update_data($where,$data);

        if($update == true) {
            $this->session->set_flashdata('updatepasswordberhasil', $iduser);
            redirect(base_url('admin/password'));
        }else{
            $this->session->set_flashdata('updatepasswordgagal', 'Ada kesalahan pada database');
            redirect(base_url('admin/password'));
        }
    }

    public function user()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $lembagaid = $this->session->userdata('lembaga_id');
            $data['datasaldo'] = $this->cek_saldo_mobipay();
            $data['js_to_load']= 'js_user.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            $data['datauser'] = $this->M_user->load_data_user($lembagaid);
            $this->load->view('layout/v_header',$data);

            if ($this->session->userdata('user_level') == 0) {
                $this->load->view('admin/user', $data);
            }else{
                $this->load->view('errors/err_404', $data);
            }


            $this->load->view('layout/v_footer',$data);
        }
    }

    public function lembaga()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            $data['js_to_load']= 'js_lembaga.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            $data['lembaga'] = $this->M_lembaga->load_data_lembaga();
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }
            $this->load->view('layout/v_header',$data);
            $this->load->view('admin/lembaga',$data);
            $this->load->view('layout/v_footer',$data);
        }
    }

    public function api_setting()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $data['datasaldo'] = $this->cek_saldo_mobipay();
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            $this->load->view('layout/v_header',$data);
            if ($this->session->userdata('user_level') == 0) {
                $this->load->view('admin/api', $data);
            }else{
                $this->load->view('errors/err_404', $data);
            }
            $this->load->view('layout/v_footer',$data);
        }
    }

    public function api_doc()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $data['datasaldo'] = $this->cek_saldo_mobipay();
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            $this->load->view('layout/v_header',$data);
            if ($this->session->userdata('user_level') == 0) {
                $this->load->view('admin/apidoc', $data);
            }else{
                $this->load->view('errors/err_404', $data);
            }
            $this->load->view('layout/v_footer',$data);
        }
    }

}
