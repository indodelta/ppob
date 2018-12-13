<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 1000);

class Wisata extends CI_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_login');
        $this->load->model('M_user');
        $this->load->model('M_wisata');
        $this->domain = $_SERVER['HTTP_HOST'];

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
            $data['js_to_load']= 'js_wisata.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            $data['data_wisata_kota'] = $this->M_wisata->load_data_wisata_where_type('KOTA');
            $data['data_wisata_prov'] = $this->M_wisata->load_data_wisata_where_type('PROVINSI');
            $data['data_wisata_area'] = $this->M_wisata->load_data_wisata_where_type('AREA');
            $data['data_wisata_kategori'] = $this->M_wisata->load_data_wisata_where_type('KATEGORI');
            $keys = array('cariwisata', 'wisatadetail');
            $this->session->unset_userdata($keys);

            $this->load->view('layout/v_header',$data);
            $this->load->view('wisata/wisata');
            $this->load->view('layout/v_footer',$data);
        }

    }

    public function cari()
    {

        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            $key = $this->input->get('key',true);
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }

            $sorting = $this->input->get('sorting',true);

            if($sorting==""){
                $sort = 1;
                $data['datacari'] = $this->apicariwisata($key);
            }else{
                $sort = $sorting;
                if($sort == 1){
                    $data['datacari'] = $this->apicariwisata($key);
                }elseif($sort == 2){
                    $data['datacari'] = $this->sortinghargaasc($key);
                }elseif($sort == 3){
                    $data['datacari'] = $this->sortinghargadesc($key);
                }elseif($sort == 4){
                    $data['datacari'] = $this->sortingpopulerasc($key);
                }elseif($sort == 5){
                    $data['datacari'] = $this->sortingpopulerdesc($key);
                }

            }

            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            $data['key'] = $key;
            $data["sort"] = $sort;

            $data['js_to_load']= 'js_cariwisata.js';
            $this->load->view('layout/v_header',$data);
            $this->load->view('wisata/cari');
            $this->load->view('layout/v_footer',$data);
        }

    }

    function sortinghargaasc()  //bubble sort
    {
        $data = $this->session->userdata('cariwisata');

        do{
            $swapped = false;
            for( $i = 0, $c = count( $data->data ) - 1; $i < $c; $i++ )
            {
                if($data->data[$i]->harga > $data->data[$i + 1]->harga)
                {
                    list( $data->data[$i+1], $data->data[$i] ) =
                        array( $data->data[$i], $data->data[$i+1] );
                    $swapped = true;
                }
            }


        }
        while($swapped);

        return $data;
    }

    function sortinghargadesc()  //bubble sort
    {
        $data = $this->session->userdata('cariwisata');

        do{
            $swapped = false;
            for( $i = 0, $c = count( $data->data ) - 1; $i < $c; $i++ )
            {
                if($data->data[$i]->harga < $data->data[$i + 1]->harga)
                {
                    list( $data->data[$i+1], $data->data[$i] ) =
                        array( $data->data[$i], $data->data[$i+1] );
                    $swapped = true;
                }
            }


        }
        while($swapped);

        return $data;
    }

    function sortingpopulerasc()  //bubble sort
    {
        $data = $this->session->userdata('cariwisata');

        do{
            $swapped = false;
            for( $i = 0, $c = count( $data->data ) - 1; $i < $c; $i++ )
            {
                if($data->data[$i]->viewer > $data->data[$i + 1]->viewer)
                {
                    list( $data->data[$i+1], $data->data[$i] ) =
                        array( $data->data[$i], $data->data[$i+1] );
                    $swapped = true;
                }
            }


        }
        while($swapped);

        return $data;
    }

    function sortingpopulerdesc()  //bubble sort
    {
        $data = $this->session->userdata('cariwisata');

        do{
            $swapped = false;
            for( $i = 0, $c = count( $data->data ) - 1; $i < $c; $i++ )
            {
                if($data->data[$i]->viewer < $data->data[$i + 1]->viewer)
                {
                    list( $data->data[$i+1], $data->data[$i] ) =
                        array( $data->data[$i], $data->data[$i+1] );
                    $swapped = true;
                }
            }


        }
        while($swapped);

        return $data;
    }

    public function apicariwisata($key)
    {
        $month = date('m');
        $year = date('Y');
        $token = $this->session->userdata('tokenft');

        $param = array(
            'keySearch' => $key,
            'month' => $month,
            'year' => $year,
            'token' => $token
        );

        $APIurl = $this->config->item('api2_wisatasearch');

        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        $this->session->set_userdata('cariwisata', $data);

        return $data;
    }

    public function detail()
    {

        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            $iddestination = $this->input->get('id',true);
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }


            $data['wisata'] = $this->apidetailwisata($iddestination);


            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            $data['iddestination'] = $iddestination;

            $data['js_to_load']= 'js_detailwisata.js';
            $this->load->view('layout/v_header',$data);
            $this->load->view('Wisata/detail');
            $this->load->view('layout/v_footer',$data);
        }

    }

    public function apidetailwisata($iddestination)
    {
        $token = $this->session->userdata('tokenft');

        $param = array(
            'idDestination' => $iddestination,
            'token' => $token
        );

        $APIurl = $this->config->item('api2_wisatadetail');

        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        $this->session->set_userdata('wisatadetail', $data);

        return $data;
    }

    public function peserta()
    {

        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            $iddestination = $this->input->post('txbiddest',true);
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }


            $data['wisata'] = $this->apidetailwisata($iddestination);


            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            $data['iddestination'] = $iddestination;

            $data['js_to_load']= 'js_pesertawisata.js';
            $this->load->view('layout/v_header',$data);
            $this->load->view('Wisata/peserta');
            $this->load->view('layout/v_footer',$data);
        }

    }

    public function booking()
    {

        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{

            $namapemesan = $this->input->post('txbnamapemesan',true);

            echo $namapemesan;


        }

    }


}