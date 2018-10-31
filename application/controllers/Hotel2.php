<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
        $this->load->model('M_login');
        $this->load->model('M_user');
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
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $data['jshotel_to_load']= 'js_hotel.js';
            $data['data_popular'] = $this->populardestination();

            $this->load->view('layout/v_header',$data);
            $this->load->view('hotel/hotel',$data);
            $this->load->view('layout/v_footer',$data);

        }
	}

    public function populardestination()
    {
        $keyword = $this->input->get('keyword');
        $token = $this->session->userdata('tokenft');

        $param = array("keyword"=>$keyword,"token"=>$token);

        $APIurl = $this->config->item('api2_hoteldestination');
        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        return $data;
    }

	public function caridestination()
    {
        $keyword = $this->input->get('keyword');
        $token = $this->session->userdata('tokenft');

        $param = array("keyword"=>$keyword,"token"=>$token);

        $APIurl = $this->config->item('api2_hoteldestination');
        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        echo json_encode($data);
    }

    public function apicarihotel()
    {
        $cityid = $this->input->post('txbalamat',true);
        $room = $this->input->post('txbjmlkamar',true);
        $guest = $this->input->post('txbjmltamu',true);
        $txbcheckin = $this->input->post('txbcheckin',true);
        $txbcheckout = $this->input->post('txbcheckout',true);
        $token = $this->session->userdata('tokenft');

        $split = explode('/', $txbcheckin);
        $checkindate = $split[2] . '-' . $split[1] . '-' .$split[0];
        $splitout = explode('/', $txbcheckout);
        $checkoutdate = $splitout[2] . '-' . $splitout[1] . '-' .$splitout[0];

        $param = array("cityid"=>$cityid,
            "room"=>$room,
            "guest"=>$guest,
            "checkindate"=>$checkindate,
            "checkoutdate"=>$checkoutdate,
            "token"=>$token);

        $APIurl = $this->config->item('api2_hotelsearch');
        $dataapi = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        $data['param'] = $param;
        $data['hotel'] = $dataapi;

        return $data;

    }

    public function carihotel()
    {
        $data['data_api'] = $this->apicarihotel();

        $id = $this->session->userdata('iduser');
        $level = $this->session->userdata('user_level');
        if($level == 0){
            $data['datasaldo'] = $this->cek_saldo_mobipay();
        }else{
            $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
        }
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

        $data['jshotel_to_load']= 'js_hotel.js';
        $data['data_popular'] = $this->populardestination();

        $this->load->view('layout/v_header',$data);
        $this->load->view('hotel/v_hotelsearch',$data);
        $this->load->view('layout/v_footer',$data);
    }

    public function detailhotel()
    {
        $hotelid = $this->input->get('hotel',true);
        $billerid = $this->input->get('biller',true);
        $room = $this->input->get('room',true);
        $guest = $this->input->get('guest',true);
        $txbcheckin = $this->input->get('checkindate',true);
        $txbcheckout = $this->input->get('checkoutdate',true);
        $token = $this->session->userdata('tokenft');

        $split = explode('/', $txbcheckin);
        $checkindate = $split[2] . '-' . $split[1] . '-' .$split[0];
        $splitout = explode('/', $txbcheckout);
        $checkoutdate = $splitout[2] . '-' . $splitout[1] . '-' .$splitout[0];

        $param = array("hotelid"=>$hotelid,
                       "billerid"=>$billerid,
                       "room"=>$room,
                       "guest"=>$guest,
                       "checkindate"=>$checkindate,
                       "checkoutdate"=>$checkoutdate,
                       "token"=>$token);

        $APIurl = $this->config->item('api2_hoteldetail');
        $dataapi = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        $data['param'] = $param;
        $data['hotel'] = $dataapi;
        $data['data_popular'] = $this->populardestination();

        $id = $this->session->userdata('iduser');
        $level = $this->session->userdata('user_level');
        if($level == 0){
            $data['datasaldo'] = $this->cek_saldo_mobipay();
        }else{
            $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
        }
        $data['jshotel_to_load']= 'js_hotel.js';
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);


        $this->load->view('layout/v_header',$data);
        $this->load->view('hotel/v_detailhotel',$data);
        $this->load->view('layout/v_footer',$data);

    }
}
