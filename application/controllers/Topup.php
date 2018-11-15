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

    function generateReference() {
        $microdate = microtime();
        $date_array = explode(" ",$microdate);
        $date = date("YmdHis",$date_array[1]);
        $date_array[0] = preg_replace('/[^\p{L}\p{N}\s]/u', '', $date_array[0]);
        return "Ref".$date.$date_array[0].rand(100,999);
    }

    public function topupcc()
    {
        $Apiurl = 'http://www.mootacash.id/npay/cc';

        $nominal = $this->input->post("txbnominal",true);

        $param = array(
            "nominal"=>$nominal,
            "referenceNo"=>$this->generateReference(),
            "noreff"=>'12345',);

        $response = $this->curl->simple_post($Apiurl, $param, array(CURLOPT_BUFFERSIZE => 10));

        var_dump($response);

//        //Process response from NICEPAY
//        if(isset($response->data->resultCd) && $response->data->resultCd == "0000"){
//            header("Location: ".$response->data->requestURL."?tXid=".$response->tXid);
//            //Please save your tXid in your database
//        }elseif (isset($response->resultCd)) {
//            // In this sample, we echo error message
//            echo "<pre>";
//            echo "result code    : ".$response->resultCd."\n";
//            echo "result message : ".$response->resultMsg."\n";
//            echo "</pre>";
//        }else {
//            // In this sample, we echo error message
//            echo "<pre>Connection Timeout. Please Try Again.</pre>";
//        }

    }


}