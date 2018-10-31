<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('M_login');
        $this->load->model('M_trans_saldo');
        $this->load->model('M_user_deposit');
        $this->load->model('M_user');
        $this->domain = $_SERVER['HTTP_HOST'];

        date_default_timezone_set('Asia/Jakarta');
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

    public function topup()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            $data['jstopup_to_load']= 'js_topup.js';
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $this->load->view('layout/v_header',$data);
            $this->load->view('deposit/topup',$data);
            $this->load->view('layout/v_footer',$data);
        }
    }

    public function deposit()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $id = $this->session->userdata('iduser');
            $user_level = $this->session->userdata('user_level');
            $data['jsdeposit_to_load']= 'js_deposit.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            if($user_level == 0){

                $lembaga_id = $this->session->userdata('lembaga_id');
                $data['datatranssaldo'] = $this->M_trans_saldo->load_data($lembaga_id);
                $data['datasaldo'] = $this->cek_saldo_mobipay();

            }else{

                $data['datatranssaldo'] = $this->M_trans_saldo->load_data_whereid($id);
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }

            $this->load->view('layout/v_header',$data);
            $this->load->view('deposit/deposit',$data);
            $this->load->view('layout/v_footer',$data);
        }
    }

    public function topupsaldo()
    {

        if($this->session->userdata('user_level') == 0){

            redirect(base_url('Deposit/topup'));

        }else{

            $iduser = $this->session->userdata('iduser');
            $datetimenow = date("Y-m-d H:i:s");
            $metode = $this->input->post('metodetopup');
            $nominal = $this->input->post('txbnominal');
            $ambilangka=rand(100,999);
            $harga = (int)$nominal + $ambilangka;
            $namapengirim = $this->input->post('txbnamapengirim');
            $bankrektujuan = $this->input->post('txbbankrekeningtujuan');
            $norektujuan = $this->input->post('txbnorekeningtujuan');
            $anrektujuan = $this->input->post('txbanrekeningtujuan');
            $status = 4;
            $timelimit = strtotime($datetimenow) + 3600;
            $datetimelimit = date('Y-m-d H:i:s', $timelimit);

            $data = array(
                'id_user' => $iduser,
                'datetime' => $datetimenow,
                'metode' => $metode,
                'nominal' => $nominal,
                'harga' => $harga,
                'namapengirim' => $namapengirim,
                'nama_bank_rek_tujuan' => $bankrektujuan,
                'no_rek_tujuan' => $norektujuan,
                'an_rek_tujuan' => $anrektujuan,
                'status' => $status,
                'timelimit' => $datetimelimit,
                'lembaga_id' => $this->session->userdata('lembaga_id'),
            );

            $id = $this->M_trans_saldo->simpan_data($data);

            if($id != '') {
                $this->session->set_flashdata('savetranssaldoberhasil', $id);
                redirect(base_url('Deposit/deposit'));
            }else{
                $this->session->set_flashdata('savetranssaldogagal', 'Ada kesalahan pada database');
                redirect(base_url('Deposit/topup'));
            }

        }


    }

    public function uploadimage()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('imgInp')){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('uploadgambargagal', $error);
            redirect(base_url('Deposit/deposit'));
        }else{
            $data = array('upload_data' => $this->upload->data());

            $idbuktitransfer = $this->input->post('txbidbuktitransfer');

            $where = array(
                'id' => $idbuktitransfer
            );

            $data = array(
                'status' => 1,
                'img' => $data['upload_data']['full_path'],
            );

            $update = $this->M_trans_saldo->update_data($where,$data);

            $this->session->set_flashdata('uploadgambarberhasil', $data);
            redirect(base_url('Deposit/deposit'));

        }
    }

    public function lihatsaldo()
    {
        $id= $this->input->get('id');

        $data = json_encode($this->M_user->load_data_user_whereid($id));

        echo $data;

    }

    public function batalkansaldo()
    {
        $id = $this->input->post('txbidtransaksi');

        $where = array(
            'id' => $id
        );

        $data = array(
            'status' => 5,
        );

        $update = $this->M_trans_saldo->update_data($where,$data);

        if($update == true) {
            $this->session->set_flashdata('batalsaldoberhasil', $id);
            redirect(base_url('Deposit/deposit'));
        }else{
            $this->session->set_flashdata('batalsaldogagal', 'Ada kesalahan pada database');
            redirect(base_url('Deposit/deposit'));
        }
    }

    public function tambahsaldo()
    {
        $id = $this->input->post('txbidtransaksi');
        $iduser = $this->input->post('txbiduser');
        $nominal = $this->input->post('txbnominal');
        $datasaldo = $this->M_user->load_data_user_whereid($iduser);
        $saldo = $datasaldo[0]->saldo;
        $saldoskrng = $saldo + $nominal;

        $datetimenow = date("Y-m-d H:i:s");

        $whereuser = array(
            'id' => $iduser
        );

        $whereid = array(
            'id' => $id
        );

        $saldo = array(
            'saldo' => $saldoskrng,
        );

        $status = array(
            'status' => 2,
        );

        $update = $this->M_user->update_data($whereuser,$saldo);


        $updatestatus = $this->M_trans_saldo->update_data($whereid,$status);


        $datauserdepoadmin = array(
            'id_user' => $this->session->userdata('iduser'),
            'id_depo' => $iduser,
            'tanggal' => $datetimenow,
            'case' => 'Saldo',
            'id_transaksi' => $id,
            'ket_transaksi' => 'TopUp',
            'debet' => $nominal,
            'kredit' => 0,
            'sisa_saldo' => 0,
        );

        $this->M_user_deposit->simpan_data($datauserdepoadmin);


        $datauserdepo = array(
            'id_user' => $iduser,
            'tanggal' => $datetimenow,
            'case' => 'Saldo',
            'id_transaksi' => $id,
            'ket_transaksi' => 'TopUp',
            'debet' => 0,
            'kredit' => $nominal,
            'sisa_saldo' => $saldoskrng,
        );

        $this->M_user_deposit->simpan_data($datauserdepo);

        $this->session->set_flashdata('tambahsaldoberhasil', $id);
        redirect(base_url('Deposit/deposit'));

//        if($update == true) {
//            $this->session->set_flashdata('tambahsaldoberhasil', $id);
//            redirect(base_url('Deposit/deposit'));
//        }else{
//            $this->session->set_flashdata('tambahsaldogagal', 'Ada kesalahan pada database');
//            redirect(base_url('Deposit/deposit'));
//        }
    }

}