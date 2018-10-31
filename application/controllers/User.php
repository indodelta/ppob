<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_user');
        $this->load->model('M_login');
        $this->domain = $_SERVER['HTTP_HOST'];
        date_default_timezone_set('Asia/Jakarta');

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
            $data['jsuser_to_load']= 'js_user.js';

//            $data['datauser'] = $this->M_user->load_data_user();

            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $this->load->view('layout/v_header',$data);
            $this->load->view('user/manajemen_user',$data);
            $this->load->view('layout/v_footer',$data);
        }
    }

    public function get_data_user()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('ssp');

            $table = 'user';

            $primaryKey = 'id';

            $columns = array(
                array('db' => 'id', 'dt' => 0, 'field' => 'id'),
                array('db' => 'user_level', 'dt' => 1, 'field' => 'user_level'),
                array('db' => 'klasifikasi', 'dt' => 2, 'field' => 'klasifikasi'),
                array('db' => 'username', 'dt' => 3, 'field' => 'username'),
                array('db' => 'nama', 'dt' => 4, 'field' => 'nama'),
                array('db' => 'user_status', 'dt' => 5, 'field' => 'user_status'),
                array(
                    'db' => 'id',
                    'dt' => 6,
                    'field' => 'id',
                    'formatter' => function( $d ) {
                        return '
                        <form id="formhapususer" method="get">
                            <button type="button" class="btn btn-warning btn-xs" style="margin-bottom: 0px;" onclick="hapus_user(this)" data-id='.$d.'>Hapus</button>
                            <button type="button" class="btn btn-info btn-xs" onclick="ubah_user(this)" style="margin-bottom: 0px;" data-id='.$d.'>Ubah</button>
                        </form>
                            ';
                    }
                ),
            );

            $lembagaid = $this->session->userdata('lembaga_id');
            $joinQuery='';
            $extrawhere = "lembaga_id =$lembagaid";

            // SQL server connection information
            $sql_details = array(
                'user' => 'root',
                'pass' => '',
                'db' => 'klikmbc',
                'host' => 'localhost'
            );

            echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extrawhere)
            );
        }
    }

    public function open_form_tambahuser()
    {
        $this->load->view('user/form_tambahuser');
    }


    public function cek_user()
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

    public function save_user()
    {
        $nm = $this->input->post('txbfullname');
        $telepon = $this->input->post('txbnotelepon');
        $alamat = $this->input->post('txbalamat');
        $email = $this->input->post('txbemail');
        $level = $this->input->post('txblevel');
        $user = $this->input->post('txbusername');
        $pass = $this->input->post('txbpassword');

        if($level == 1){
            $klasifikasi = $this->input->post('txbklasifikasi');

            $nama = 'Agent '.$nm.' Klasfikasi '.$klasifikasi;

        }else{
            $klasifikasi = '';
            $nama = $nm;
        }

        $data = array(
            'username' => $user,
            'password' => md5($pass),
            'nama' => $nama,
            'user_level' => $level,
            'klasifikasi' => $klasifikasi,
            'user_status' => 1,
            'lembaga_id' => $this->session->userdata('lembaga_id'),
            'alamat' => $alamat,
            'email' => $email,
            'telepon' => $telepon,
        );

        $id = $this->M_user->simpan_data($data);

        if($id != '') {
            $this->session->set_flashdata('saveuserberhasil', $id);
            redirect(base_url('user'));
        }else{
            $this->session->set_flashdata('usergagal', 'Ada kesalahan pada database');
            redirect(base_url('user'));
        }

    }

    public function open_form_ubahuser()
    {
        $iduser = $_GET['iduser'];
        $data['datauser'] = $this->M_user->load_data_user_whereid($iduser);
        $this->load->view('user/form_ubahuser',$data);
    }

    public function update_user()
    {
        $iduser = $this->input->post('txbiduser');
        $fullname = $this->input->post('txbfullname');
        $telepon = $this->input->post('txbnotelepon');
        $alamat = $this->input->post('txbalamat');
        $email = $this->input->post('txbemail');
        $status = $this->input->post('txbstatus');
        $level = $this->input->post('txblevel');

        if($level == 1){
            $klasifikasi = $this->input->post('txbklasifikasi');

        }else{
            $klasifikasi = '';
        }

        $where = array(
            'id' => $iduser
        );

        $data = array(
            'nama' => $fullname,
            'user_status' => $status,
            'klasifikasi' => $klasifikasi,
            'alamat' => $alamat,
            'email' => $email,
            'telepon' => $telepon,
        );

        $update = $this->M_user->update_data($where,$data);

        if($update == true) {
            $this->session->set_flashdata('updateuserberhasil', $iduser);
            redirect(base_url('user'));
        }else{
            $this->session->set_flashdata('usergagal', 'Ada kesalahan pada database');
            redirect(base_url('user'));
        }


    }

    public function hapus_user($id)
    {
        $hapus = $this->M_user->hapus_data($id);

        if($hapus == true) {
            $this->session->set_flashdata('hapususerberhasil', $id);
            redirect(base_url('user'));
        }else{
            $this->session->set_flashdata('usergagal', 'Ada kesalahan pada database');
            redirect(base_url('user'));
        }

    }
}