<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
        $this->load->model('M_login');
        $this->load->model('M_user');
        $this->load->model('M_hotel');
        $this->load->model('M_transaksi');
        $this->load->model('M_transdetail');
        $this->load->model('M_user_deposit');
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

        $this->session->set_userdata('hotel', $data['hotel']);
        $this->session->set_userdata('param', $data['param']);

        return $data;

    }

    //fungsi sorting dipisah supaya time execution lebih cepat sehingga tidak error

    function sortinghargaasc()  //bubble sort
    {
        $data = $this->session->userdata('hotel');

        do{
            $swapped = false;
            for( $i = 0, $c = count( $data->data ) - 1; $i < $c; $i++ )
            {
                if($data->data[$i]->roomCateg[0]->roomType->totalPrice > $data->data[$i + 1]->roomCateg[0]->roomType->totalPrice)
                {
                    list( $data->data[$i+1], $data->data[$i] ) =
                        array( $data->data[$i], $data->data[$i+1] );
                    $swapped = true;
                }
            }


        }
        while($swapped);

        $datax['param'] = $this->session->userdata('param');
        $datax['hotel'] = $data;

        return $datax;
    }

    function sortinghargadesc()  //bubble sort
    {
        $data = $this->session->userdata('hotel');

        do{
            $swapped = false;
            for( $i = 0, $c = count( $data->data ) - 1; $i < $c; $i++ )
            {
                if($data->data[$i]->roomCateg[0]->roomType->totalPrice < $data->data[$i + 1]->roomCateg[0]->roomType->totalPrice)
                {
                    list( $data->data[$i+1], $data->data[$i] ) =
                        array( $data->data[$i], $data->data[$i+1] );
                    $swapped = true;
                }
            }


        }
        while($swapped);

        $datax['param'] = $this->session->userdata('param');
        $datax['hotel'] = $data;

        return $datax;
    }

    function sortingratingasc()  //bubble sort
    {
        $data = $this->session->userdata('hotel');

        do{
            $swapped = false;
            for( $i = 0, $c = count( $data->data ) - 1; $i < $c; $i++ )
            {
                if($data->data[$i]->rating > $data->data[$i + 1]->rating)
                {
                    list( $data->data[$i+1], $data->data[$i] ) =
                        array( $data->data[$i], $data->data[$i+1] );
                    $swapped = true;
                }
            }


        }
        while($swapped);

        $datax['param'] = $this->session->userdata('param');
        $datax['hotel'] = $data;

        return $datax;
    }

    function sortingratingdesc()  //bubble sort
    {
        $data = $this->session->userdata('hotel');

        do{
            $swapped = false;
            for( $i = 0, $c = count( $data->data ) - 1; $i < $c; $i++ )
            {
                if($data->data[$i]->rating < $data->data[$i + 1]->rating)
                {
                    list( $data->data[$i+1], $data->data[$i] ) =
                        array( $data->data[$i], $data->data[$i+1] );
                    $swapped = true;
                }
            }


        }
        while($swapped);

        $datax['param'] = $this->session->userdata('param');
        $datax['hotel'] = $data;

        return $datax;
    }

    function sortingnamaasc()  //bubble sort
    {
        $data = $this->session->userdata('hotel');

        do{
            $swapped = false;
            for( $i = 0, $c = count( $data->data ) - 1; $i < $c; $i++ )
            {
                if($data->data[$i]->hotelName > $data->data[$i + 1]->hotelName)
                {
                    list( $data->data[$i+1], $data->data[$i] ) =
                        array( $data->data[$i], $data->data[$i+1] );
                    $swapped = true;
                }
            }


        }
        while($swapped);

        $datax['param'] = $this->session->userdata('param');
        $datax['hotel'] = $data;

        return $datax;
    }

    function sortingnamadesc()  //bubble sort
    {
        $data = $this->session->userdata('hotel');

        do{
            $swapped = false;
            for( $i = 0, $c = count( $data->data ) - 1; $i < $c; $i++ )
            {
                if($data->data[$i]->hotelName < $data->data[$i + 1]->hotelName)
                {
                    list( $data->data[$i+1], $data->data[$i] ) =
                        array( $data->data[$i], $data->data[$i+1] );
                    $swapped = true;
                }
            }


        }
        while($swapped);

        $datax['param'] = $this->session->userdata('param');
        $datax['hotel'] = $data;

        return $datax;
    }

    public function carihotel()
    {
        $sorting = $this->input->post('sorting',true);

        if($sorting==""){
            $sort = 1;
            $data['data_api'] = $this->apicarihotel();
        }else{
            $sort = $sorting;
            if($sort == 1){
                $data['data_api'] = $this->sortinghargaasc();
            }elseif ($sort == 2){
                $data['data_api'] = $this->sortinghargadesc();
            }elseif ($sort == 3){
                $data['data_api'] = $this->sortingratingasc();
            }elseif ($sort == 4){
                $data['data_api'] = $this->sortingratingdesc();
            }elseif ($sort == 5){
                $data['data_api'] = $this->sortingnamaasc();
            }elseif ($sort == 6){
                $data['data_api'] = $this->sortingnamadesc();
            }
        }

        $data["sort"] = $sort;

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

        $keys = array('hotel', 'param');
        $this->session->unset_userdata($keys);

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

    public function bookhotel(){

        $tabs = $this->input->post('tabs');

        if($tabs == 2){
            $data['booking'] = $this->apibookhotel();
        }elseif ($tabs == 3){
            $data['payment'] = $this->apipaymenthotel();
        }

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
        $this->load->view('hotel/v_bookhotel',$data);
        $this->load->view('layout/v_footer',$data);

    }

    public function apibookhotel(){

        $billerid = $this->input->post('txbbillerid');
        $searchingmid = $this->input->post('txbsearchingmid');
        $guest = $this->input->post('txbjmltamu');
        $room = $this->input->post('sljmlkamar');
        $phone = $this->input->post('txbnotelpkontak');
        $fname = $this->input->post('txbfirstnamekontak');
        $lname = $this->input->post('txblastnamekontak');
        $email = $this->input->post('txbemailkontak');
        $city = $this->input->post('txbkotakontak');
        $internalcode = $this->input->post('txbinternalcode');
        $hotelid = $this->input->post('txbhotelid');
        $categoryid = $this->input->post('txbcategoryid');
        $categoryname = $this->input->post('txbtypename');
        $checkindate = $this->input->post('txbcheckindate');
        $checkoutdate = $this->input->post('txbcheckoutdate');
        $price = $this->input->post('txbtotalamount');
        $token = $this->session->userdata('tokenft');

        $param = array("billerid"=>$billerid,
                       "searchingmid"=>$searchingmid,
                       "room"=>$room,
                       "guest"=>$guest,
                       "contactphone"=>$phone,
                       "contactfname"=>$fname,
                       "contactlname"=>$lname,
                       "contactemail"=>$email,
                       "contactcity"=>$city,
                       "internalcode"=>$internalcode,
                       "hotelid"=>$hotelid,
                       "categoryid"=>$categoryid,
                       "categoryname"=>$categoryname,
                       "checkindate"=>$checkindate,
                       "checkoutdate"=>$checkoutdate,
                       "price"=>$price,
                       "token"=>$token);

        $APIbook = $this->config->item('api2_hotelbook');
        $dataapibooking = json_decode($this->curl->simple_post($APIbook, $param, array(CURLOPT_BUFFERSIZE => 10)));

        $data['param'] = $param;
        $data['booking'] = $dataapibooking;

        return $data;

    }

    public function apipaymenthotel(){

        $billerid = $this->input->post('txbbillerid');
        $searchingmid = $this->input->post('txbsearchingmid');
        $guest = $this->input->post('txbjmltamu');
        $room = $this->input->post('sljmlkamar');
        $phone = $this->input->post('txbnotelpkontak');
        $fname = $this->input->post('txbfirstnamekontak');
        $lname = $this->input->post('txblastnamekontak');
        $email = $this->input->post('txbemailkontak');
        $city = $this->input->post('txbkotakontak');
        $bookingcode = $this->input->post('txbbookingcode');
        $internalcode = $this->input->post('txbinternalcode');
        $hotelid = $this->input->post('txbhotelid');
        $hotelname = $this->input->post('txbhotelname');
        $hoteladdress = $this->input->post('txbhoteladdress');
        $categoryid = $this->input->post('txbcategoryid');
        $categoryname = $this->input->post('txbtypename');
        $roomimage = $this->input->post('txbroomimage');
        $checkindate = $this->input->post('txbcheckindate');
        $checkoutdate = $this->input->post('txbcheckoutdate');
        $price = $this->input->post('txbtotalamount');
        $komisi = $this->input->post('txbkomisi');
        $certcode = $this->session->userdata('certcode');
        $token = $this->session->userdata('tokenft');

        $param = array("billerid"=>$billerid,
                       "searchingmid"=>$searchingmid,
                       "room"=>$room,
                       "guest"=>$guest,
                       "bookingcode"=>$bookingcode,
                       "contactphone"=>$phone,
                       "contactfname"=>$fname,
                       "contactlname"=>$lname,
                       "contactemail"=>$email,
                       "contactcity"=>$city,
                       "internalcode"=>$internalcode,
                       "hotelid"=>$hotelid,
                       "categoryid"=>$categoryid,
                       "categoryname"=>$categoryname,
                       "checkindate"=>$checkindate,
                       "checkoutdate"=>$checkoutdate,
                       "price"=>$price,
                       "komisi"=>'',
                       "certcode"=>$certcode,
                       "token"=>$token);

        $APIpayment = $this->config->item('api2_hotelpayment');
        $dataapipayment = json_decode($this->curl->simple_post($APIpayment, $param, array(CURLOPT_BUFFERSIZE => 10)));

        if($dataapipayment->errorCode == '00'){

            //save to trans_hotel table

            $datecreated = date("Y-m-d H:i:s");
            $nominal = $dataapipayment->data->data->nominal;
            $nominaladmin = $dataapipayment->data->data->nominalAdmin;

            if($nominaladmin == ''){
                $nominaladmin = 0;
            }

            $totalharga = $nominal + $nominaladmin;


            $lembaga_id = $this->session->userdata('lembaga_id');
            $iduser = $this->session->userdata('iduser');
            $username = $this->session->userdata('username');


            $datatranshotel = array(
                'date_created' => $datecreated,
                'user_created' => $username,
                'lembaga_id' => $lembaga_id,
                'contact_fname' => $fname,
                'contact_lname' => $lname,
                'contact_email' => $email,
                'contact_telp' => $phone,
                'contact_city' => $city,
                'total_harga' => $totalharga,
            );

            $idtranshotel = $this->M_hotel->simpandataandgetid("trans_hotel",$datatranshotel);

            //save to trans_hotel_detail table

            $mid = $dataapipayment->data->data->mid;
            $urletiket = $dataapipayment->data->data->url_etiket;
            $urlstruk = $dataapipayment->data->data->url_struk;

            $datatranshoteldetail = array(
                'bookingCode' => $bookingcode,
                'id' => $idtranshotel,
                'mid' => $mid,
                'hotelId' => $hotelid,
                'hotelName' => $hotelname,
                'hotelAddress' => $hoteladdress,
                'checkInDate' => $checkindate,
                'checkoutdate' => $checkoutdate,
                'jumlahTamu' => $guest,
                'jumlahKamar' => $room,
                'typeKamar' => $categoryname,
                'roomImage' => $roomimage,
                'urlEtiket' => $urletiket,
                'urlStruk' => $urlstruk,
            );

            $transhoteldetail = $this->M_hotel->simpandata("trans_hotel_detail",$datatranshoteldetail);

            //save to trans_hotel_detail_harga table

            $idtransaction = $dataapipayment->data->data->transaction_id;

            if($idtransaction == ''){
                $idtransaction = $this->input->post('txbtransactionid');
            }

            $methodpayment = $this->input->post('slmethodpayment');
            $namabank = $this->input->post('txbnamabank');
            $norekening = $this->input->post('txbnorekening');
            $namapengirim = $this->input->post('txbnamapengirim');
            $amount = $this->input->post('txbamount');
            $taxamount = $this->input->post('txbtaxamount');
            $komisi = $dataapipayment->data->data->komisi;
            if($komisi == null){
                $komisi = $this->input->post('txbkomisi');
            };
            $timelimit = $this->input->post('txbtimelimit');

            $datatranshotelharga = array(
                'idTransaction' => $idtransaction,
                'id' => $idtranshotel,
                'methodPayment' => $methodpayment,
                'namaBank' => $namabank,
                'noRekening' => $norekening,
                'namaPengirim' => $namapengirim,
                'amount' => $amount,
                'totalAmount' => $price,
                'taxAmount' => $taxamount,
                'komisi' => '',
                'nominal' => $nominal,
                'nominalAdmin' => $nominaladmin,
                'timeLimit' => $timelimit
            );

            $transhotelharga = $this->M_hotel->simpandata("trans_hotel_detail_harga",$datatranshotelharga);

            //save to trans_hotel_guest table

            for ($i = 1; $i <= $guest; $i++) {
                $txbfirstnametamu= 'txbfirstnametamu' . $i;
                $firstnametamu = $this->input->post($txbfirstnametamu);
                $txblastnametamu= 'txblastnametamu' . $i;
                $lastnametamu = $this->input->post($txblastnametamu);
                $txbidcardtamu= 'txbidcardtamu' . $i;
                $idcardtamu = $this->input->post($txbidcardtamu);

                $datatranshotelguest = array(
                    'bookingCode' => $bookingcode,
                    'guestFname' => $firstnametamu,
                    'guestLname' => $lastnametamu,
                    'guestIdCard' => $idcardtamu
                );


                $transhotelguest= $this->M_hotel->simpandata("trans_hotel_guest",$datatranshotelguest);

            }

            //save to transaksi_detail table

            $namapelanggan = $fname.' '.$lname;

            $datadetail = array(
                'namaproduk' => 'HOTEL',
                'nopelanggan' => $bookingcode,
                'namapelanggan' => $namapelanggan,
                'nominal' => $totalharga,
            );

            $iddetailtransaksi = $this->M_transdetail->simpan_data($datadetail);

            //save to transaksi table

            $datatransaksi = array(
                'lembaga_id' => $lembaga_id,
                'trans_code' => 'HOTEL',
                'trans_detail_code' => $iddetailtransaksi,
                'date_created' => $datecreated,
                'user_created' => $iduser,
                'ref' => $idtransaction,
                'status' => 1,
            );

            $idtrans = $this->M_transaksi->simpan_data($datatransaksi);

            //save to t_user_deposit table

            $saldo = $this->input->post("txbsaldosekarang",true);
            $saldoskrng = $saldo - $totalharga;
            $datauserdeposit = array(
                'lembaga_id' => $lembaga_id,
                'id_user' => $iduser,
                'id_depo' => $iduser,
                'tanggal' => $datecreated,
                'case' => 'HOTEL',
                'id_transaksi' => $idtrans,
                'ket_transaksi' => 'BOOKING HOTEL',
                'debet' => $totalharga,
                'sisa_saldo' => $saldoskrng,
                'komisi' => $komisi
            );

            $iddepo = $this->M_user_deposit->simpan_data($datauserdeposit);

            //kurang saldo agen

            $level = $this->session->userdata('user_level');

            if($level == 1){
                $whereuser = array(
                    'id' => $iduser
                );
                $saldo = array(
                    'saldo' => $saldoskrng,
                );
                $update = $this->M_user->update_data($whereuser,$saldo);
            }


            $data['idtranshotel'] = $idtranshotel;
            $data['idtransaksi'] = $idtrans;
            $data['iddepo'] = $iddepo;

        }

        $data['param'] = $param;
        $data['payment'] = $dataapipayment;

        return $data;

    }

    public function cancelbook(){
        $this->session->set_flashdata('messagecancel', 'Berhasil');
        redirect(base_url('hotel'));
    }
}
