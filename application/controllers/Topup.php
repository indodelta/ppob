<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup extends CI_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_login');
        $this->load->model('M_trans_saldo');
        $this->load->model('M_user_deposit');
        $this->load->model('M_user');
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
            $data['jstopup_to_load']= 'js_topupsaldo.js';
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $this->load->view('layout/v_header',$data);
            $this->load->view('topup/topup',$data);
            $this->load->view('layout/v_footer',$data);
        }
    }

    public function topup()
    {
        $Apiurl = 'http://www.mootacash.id/npay/topup';

        $nominal = $this->input->post("txbnominal",true);
        $metode = $this->input->post("slmetode",true);

        $id = $this->session->userdata('iduser');
        $datauser = $this->M_user->load_data_user_whereid($id);

//        if($metode == '01'){
//            $callbackurl = base_url('Topup/callbackCC');
//        }else if($metode == '02'){
//            $callbackurl = base_url('Topup/callbackVA');
//        }else if($metode == '03'){
//            $callbackurl = base_url('Topup/callbackCVS');
//        }else if($metode == '04'){
//            $callbackurl = base_url('Topup/callbackklik');
//        }else if($metode == '05'){
//            $callbackurl = base_url('Topup/callbackewallet');
//        }

        $param = array(
            "nominal"=>$nominal,
            "metode"=>$metode,
            "billingNm"=>$datauser[0]->nama,
            "billingPhone"=>$datauser[0]->telepon,
            "billingEmail"=>$datauser[0]->email,
            "billingAddr"=>$datauser[0]->alamat,
            "billingCity"=>$datauser[0]->kota,
            "billingState"=>$datauser[0]->provinsi,
            "billingPostCd"=>$datauser[0]->kodepos,
            "billingCountry"=>$datauser[0]->negara,
            "callbackUrl"=>base_url('Topup/callback'),
            );

        $response = json_decode($this->curl->simple_post($Apiurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        //Process response from NICEPAY
        if(isset($response->data->resultCd) && $response->data->resultCd == "0000"){
            header("Location: ".$response->data->requestURL."?tXid=".$response->tXid);
            //Please save your tXid in your database

        }elseif (isset($response->resultCd)) {
            $error = '<div>'.
                        'Result Code    : '.$response->resultCd.'<br/>'.
                        'Result Message : '.$response->resultMsg.'<br/>'.
                     '</div>';
            $this->session->set_flashdata('error', $error);
            redirect(base_url('Topup'));

        }else {
            $error = 'Connection Timeout. Please Try Again';
            $this->session->set_flashdata('error', $error);
            redirect(base_url('Topup'));
        }

    }

    public function callback() {
        $requestData['amt'] = $_GET['amount'];
        $requestData['referenceNo'] = $_GET['referenceNo'];
        $requestData['tXid'] = $_GET['tXid'];

        $Apiurl = 'http://www.mootacash.id/npay/status';
        $result = json_decode($this->curl->simple_post($Apiurl, $requestData, array(CURLOPT_BUFFERSIZE => 10)));

        //Process Response Nicepay
        if(isset($result->resultCd) && $result->resultCd == '0000'){
            $this->session->set_flashdata('dataresult', $result);
            redirect(base_url('Topup/info'));
        }
        elseif (isset($result->resultCd)) {
            $error = '<div>'.
                'Result Code    : '.$result->resultCd.'<br/>'.
                'Result Message : '.$result->resultMsg.'<br/>'.
                '</div>';
            $this->session->set_flashdata('error', $error);
            redirect(base_url('Topup'));
        }
        else {
            $error = 'Timeout When Checking Payment Status';
            $this->session->set_flashdata('error', $error);
            redirect(base_url('Topup'));
        }

    }

    public function info()
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
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $this->load->view('layout/v_header',$data);
            $this->load->view('topup/info',$data);
            $this->load->view('layout/v_footer',$data);
        }
    }


}