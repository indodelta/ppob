<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 300);

class Topup extends CI_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_login');
        $this->load->model('M_trans_saldo');
        $this->load->model('M_user_deposit');
        $this->load->model('M_user');
        $this->load->model('M_user_topup');
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
        $Apiurl = $this->config->item('api_topupsaldo');

        $nominal = $this->input->post("slnominal",true);
        $metode = $this->input->post("slmetode",true);

        $id = $this->session->userdata('iduser');
        $datauser = $this->M_user->load_data_user_whereid($id);

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
            "dbprocessUrl"=>base_url('Topup/dbprocess'),
            );

        $response = json_decode($this->curl->simple_post($Apiurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        //Process response from NICEPAY
        if(isset($response->data->resultCd) && $response->data->resultCd == "0000"){

            $lembaga_id = $this->session->userdata('lembaga_id');
            $iduser = $this->session->userdata('iduser');
            $txid = $response->tXid;

            $data = array(
                'lembaga_id' => $lembaga_id,
                'id_user' => $iduser,
                'txId' => $txid,
                'method' => $metode,
                'date' =>  date("Y-m-d H:i:s"),
                'nominal' =>  $nominal,
            );

            $id = $this->M_user_topup->simpan_data($data);

            if($id != null){
                header("Location: ".$response->data->requestURL."?tXid=".$txid);
            }else{
                $error = 'Error Database. Please Try Again';
                $this->session->set_flashdata('error', $error);
                redirect(base_url('Topup'));
            }

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

        $Apiurl = $this->config->item('api_cekstatustopup');
        $result = json_decode($this->curl->simple_post($Apiurl, $requestData, array(CURLOPT_BUFFERSIZE => 10)));

        //Process Response Nicepay
        if(isset($result->resultCd) && $result->resultCd == '0000'){

            $txid = $result->tXid;
            $referenceNo = $result->referenceNo;
            $status = $result->status;
            $status_msg = $result->resultMsg;

            $where = array(
                'txId' => $txid
            );

            $data = array(
                'refNo' =>  $referenceNo,
                'date' =>  date("Y-m-d H:i:s"),
                'status' => $status,
                'status_msg' => $status_msg,
                'confirm_status' => 0,
            );

            $update = $this->M_user_topup->update_data($where,$data);

            if($update == true) {
                $this->session->set_flashdata('dataresult', $result);
                redirect(base_url('Topup/info'));
            }else{
                $error = 'Error Database. Please Try Again';
                $this->session->set_flashdata('error', $error);
                redirect(base_url('Topup'));
            }

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

    public function dbprocess()
    {
        $txid = $_GET['tXid'];
//            $referenceNo = $result->referenceNo;
//            $status = $result->status;
//            $status_msg = $result->resultMsg;

            $where = array(
                'txId' => $txid
            );

            $data = array(
//                'refNo' =>  $referenceNo,
//                'date' =>  date("Y-m-d h:i:s"),
//                'status' => $status,
//                'status_msg' => $status_msg,
                'confirm_status' => 1,
            );

            $update = $this->M_user_topup->update_data($where,$data);

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