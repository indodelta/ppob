<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 300);

class Login extends CI_Controller {

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
        $this->load->view('login',$data);
    }

    function login_api_mobipay()
    {

        $APIurl = $this->config->item('api_login');

        $param = array(
            "uname"=>$this->config->item('uname'),
            "upass"=>$this->config->item('upass')
        );
        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        return $data;

    }

    function login_api_mobipay_fastravel()
    {

        $APIurl = $this->config->item('api2_login');

        $resp = get_http_response_code($APIurl);

        if($resp == '200'){
            $param = array();
            $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));
        }else{
            $data = array(
                'rc' => 99,
                'rd' => 'Response is not okay',
            );
        }

        return $data;
    }

    function aksi_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array(
          'username' => $username,
          'password' => md5($password)
        );

        $cek = $this->M_login->cek_login("user",$where)->num_rows();
        $data = $this->M_login->viewdata("user",$where);

        if($cek>0){

            if($data[0]->status_login == 0){

                $dataapi = $this->login_api_mobipay();

//                $dataapift = $this->login_api_mobipay_fastravel();

                $errcode = $dataapi->errorCode;
                $errmsg = $dataapi->errorMsg;

//                $errcode2 = $dataapift->rc;
//                $errmsg2 = $dataapift->rd;

                if($errcode != 0){
                    $this->session->set_flashdata('apigagallogin',$errmsg);
                    redirect(base_url());
                }
//                elseif($errcode2 != 0){
//                    $this->session->set_flashdata('api2gagallogin',$errmsg2);
//                    redirect(base_url());
//                }
                else{

//                    $whereid = array('id' => $data[0]->id);
//                    $datastlogin = array('status_login' => 1);
//
//                    $updatestatuslogin = $this->M_user->update_data($whereid,$datastlogin);

                    $certcode = $dataapi->data->certcode;

                    $tokenft = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjhkNzNtbmc4OWVkIn0.eyJpc3MiOiJodHRwOlwvXC9hcGkuZmFzdHJhdmVsLmNvLmlkIiwiYXVkIjoiRmFzdHJhdmVsQjJCIENsaWVudCIsImp0aSI6IjhkNzNtbmc4OWVkIiwiaWF0IjoxNTM2MDMyODk2LCJuYmYiOjE1MzYwMzI5NTYsImV4cCI6MTUzNjAzNjQ5Niwib3V0bGV0SWQiOiJTUDExMDgxNiIsInBpbiI6Ijc0MjM3NyIsImtleSI6IkZBU1RQQVkifQ.RrRhSwgH27HuLmjmkYjdBPRrjpFVC7trRnuGXhky5tA';
//                    $tokenft = $dataapift->token;

                    if($tokenft == ''){
                        $this->session->set_flashdata('api2gagallogin','Api 2 not found');
                        redirect(base_url());
                    }else {

                        $data_session = array(
                            'iduser' => $data[0]->id,
                            'username' => $data[0]->username,
                            'fullname' => $data[0]->nama,
                            'user_level' => $data[0]->user_level,
                            'lembaga_id' => $data[0]->lembaga_id,
                            'status' => "login",
                            'certcode' => $certcode,
                            'tokenft' => $tokenft
                        );

                        $this->session->set_userdata($data_session);

                        redirect(base_url('dashboard'));

                    }

                }

            }else{

                $this->session->set_flashdata('error','Akun anda telah melakukan login');
                redirect(base_url());

            }

        }else{
            $this->session->set_flashdata('error','Username dan Password Salah.');
            redirect(base_url());
        }

    }

    function logout()
    {
        $iduser = $this->session->userdata('iduser');
        $token = $this->session->userdata('tokenft');

        $whereid = array('id' => $iduser);
        $datastlogin = array('status_login' => 0);

        $updatestatuslogin = $this->M_user->update_data($whereid,$datastlogin);

        $APIurl = $this->config->item('api2_logout');

        $param = array ('token'=>$token);

//        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        $this->session->sess_destroy();

        redirect(base_url());
    }

}