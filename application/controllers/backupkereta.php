<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class backupkereta extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_kereta');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_login');
        $this->load->model('M_user');
        $this->load->model('M_transaksi');
        $this->load->model('M_transdetail');
        $this->load->model('M_user_deposit');
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
            $data['jskereta_to_load']= 'js_kereta.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $this->load->view('layout/v_header',$data);
            $this->load->view('kereta/kereta');
            $this->load->view('layout/v_footer',$data);
        }

    }

    public function viewjadwalkereta()
    {
        $data['jskereta_to_load']= 'js_kereta.js';
        $id = $this->session->userdata('iduser');
        $level = $this->session->userdata('user_level');
        if($level == 0){
            $data['datasaldo'] = $this->cek_saldo_mobipay();
        }else{
            $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
        }

        $data['jadwalkereta'] = $this->getdatajadwalkereta();
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

        $this->load->view('layout/v_header',$data);
        $this->load->view('kereta/v_jadwalkereta',$data);
        $this->load->view('layout/v_footer',$data);
    }

    public function viewinformasibooking()
    {
        $id = $this->session->userdata('iduser');
        $level = $this->session->userdata('user_level');
        if($level == 0){
            $data['datasaldo'] = $this->cek_saldo_mobipay();
        }else{
            $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
        }

        $data['jskereta_to_load']= 'js_kereta.js';
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

        $this->load->view('layout/v_header',$data);
        $this->load->view('kereta/v_informasibooking',$data);
        $this->load->view('layout/v_footer',$data);
    }

    public function viewpilihkursi()
    {
        $id = $this->session->userdata('iduser');
        $level = $this->session->userdata('user_level');
        if($level == 0){
            $data['datasaldo'] = $this->cek_saldo_mobipay();
        }else{
            $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
        }

        $data['jskereta_to_load']= 'js_kereta.js';
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

        $data['seatlayout'] = $this->getseatlayout();
        $data['bookingkereta'] = $this->bookingkereta();

        $this->load->view('layout/v_header',$data);
        $this->load->view('kereta/v_pilihkursi',$data);
        $this->load->view('layout/v_footer',$data);
    }

    public function viewpembayaran()
    {
        $txbjmldewasa = $this->input->post('txbjmldewasa');

        $tanggalpulang = $this->input->post('txbtanggalpulang');

        if ($tanggalpulang != '') {

            $data = array();

            $arradayangberubahpergi=array();

            for ($i = 0; $i < $txbjmldewasa; $i++) {

                $x=$i+1;

                $txbnoseatbarupenumpangpergi = 'txbnoseatbarupenumpangpergi'.$x;
                $noseatbarupenumpangpergi = $this->input->post($txbnoseatbarupenumpangpergi);

                if($noseatbarupenumpangpergi == '-'){

                    $adayangberubahpergi = 'tidak';

                }else{

                    $adayangberubahpergi = 'ada';

                }


                array_push($arradayangberubahpergi,$adayangberubahpergi);

            }

            if (in_array("ada", $arradayangberubahpergi)) {

                $datachangeseatpergi = $this->changeseatpergi();
                $data['datachangeseatpergi'] = $datachangeseatpergi;

            }else{
                $data['datachangeseatpergi'] = array();
            }

            $arradayangberubahpulang=array();

            for ($i = 0; $i < $txbjmldewasa; $i++) {

                $x=$i+1;

                $txbnoseatbarupenumpangpulang = 'txbnoseatbarupenumpangpulang'.$x;
                $noseatbarupenumpangpulang = $this->input->post($txbnoseatbarupenumpangpulang);

                if($noseatbarupenumpangpulang == '-'){

                    $adayangberubahpulang = 'tidak';

                }else{

                    $adayangberubahpulang = 'ada';

                }


                array_push($arradayangberubahpulang,$adayangberubahpulang);

            }

            if (in_array("ada", $arradayangberubahpulang)) {

                $datachangeseatpulang = $this->changeseatpulang();
                $data['datachangeseatpulang'] = $datachangeseatpulang;

            }else{
                $data['datachangeseatpulang'] = array();
            }

        }else{

            $arradayangberubahpergi=array();

            for ($i = 0; $i < $txbjmldewasa; $i++) {

                $x=$i+1;

                $txbnoseatbarupenumpangpergi = 'txbnoseatbarupenumpangpergi'.$x;
                $noseatbarupenumpangpergi = $this->input->post($txbnoseatbarupenumpangpergi);

                if($noseatbarupenumpangpergi == '-'){

                    $adayangberubahpergi = 'tidak';

                }else{

                    $adayangberubahpergi = 'ada';

                }


                array_push($arradayangberubahpergi,$adayangberubahpergi);

            }

            if (in_array("ada", $arradayangberubahpergi)) {

                $datachangeseatpergi = $this->changeseatpergi();
                $data['datachangeseatpergi'] = $datachangeseatpergi;

            }else{
                $data['datachangeseatpergi'] = array();
            }

        }

        $id = $this->session->userdata('iduser');
        $level = $this->session->userdata('user_level');
        if($level == 0){
            $data['datasaldo'] = $this->cek_saldo_mobipay();
        }else{
            $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
        }

        $data['jskereta_to_load']= 'js_kereta.js';
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

        $this->load->view('layout/v_header',$data);
        $this->load->view('kereta/v_pembayaran',$data);
        $this->load->view('layout/v_footer',$data);

    }

    public function simpantransaksi()
    {
        $tanggalpulang = $this->input->post('txbtanggalpulang');

        $datapaymentpergi = $this->paymentkeretapergi();

        $rcpergi = $datapaymentpergi->rc;
        $rdpergi = $datapaymentpergi->rd;

//        $rcpergi = '99';
//        $rdpergi = '99';

        if ($tanggalpulang != '') {

            $datapaymentpulang = $this->paymentkeretapulang();

            $rcpulang = $datapaymentpulang->rc;
            $rdpulang = $datapaymentpulang->rd;

            if($rcpergi == '00' && $rcpulang == '00'){
                echo 'sukses 22 nya';
            }else{

            }

        }else{




        }

        echo $rcpergi.' '.$rdpergi.'<br/>';

        die();
        $id= $this->savetotranskeretadetailharga();
        $datatranskereta = $this->M_kereta->loaddatatranswhere($id);
        $jmldatatranskereta = count($datatranskereta);

        $namakontak = $datatranskereta[0]->contact_name;
        $bookingcodepergi = $datatranskereta[0]->bookingCode;
        $stfrompergi = $datatranskereta[0]->st_from;
        $sttopergi = $datatranskereta[0]->st_to;
        $trainnamepergi = $datatranskereta[0]->train_name;

        if($jmldatatranskereta > 1){
            $bookingcodepulang = $datatranskereta[1]->bookingCode;
            $stfrompulang = $datatranskereta[1]->st_from;
            $sttopulang = $datatranskereta[1]->st_to;
            $trainnamepulang = $datatranskereta[1]->train_name;

            $booking = '<div>'.
                'Nama Kontak : '.$namakontak.'<br/><br/>'.
                'Tiket Pergi : <br/>'.
                'Booking Code   : '.$bookingcodepergi.'<br/>'.
                'Stasiun Asal   : '.$stfrompergi.'<br/>'.
                'Stasiun Tujuan : '.$sttopergi.'<br/>'.
                'Nama Kereta    : '.$trainnamepergi.'<br/><br/>'.
                'Tiket Pulang : <br/>'.
                'Booking Code   : '.$bookingcodepulang.'<br/>'.
                'Stasiun Asal   : '.$stfrompulang.'<br/>'.
                'Stasiun Tujuan : '.$sttopulang.'<br/>'.
                'Nama Kereta    : '.$trainnamepulang.'<br/>'.
                '</div>';
        }else{
            $booking = '<div>'.
                'Nama Kontak : '.$namakontak.'<br/><br/>'.
                'Tiket Pergi : <br/>'.
                'Booking Code   : '.$bookingcodepergi.'<br/>'.
                'Stasiun Asal   : '.$stfrompergi.'<br/>'.
                'Stasiun Tujuan : '.$sttopergi.'<br/>'.
                'Nama Kereta    : '.$trainnamepergi.'<br/>'.
                '</div>';
        }

        $this->session->set_flashdata('messageberhasil', $booking);


        redirect(base_url('kereta'));

    }

    //payment kereta

    public function paymentkeretapergi()
    {

        $bookingcodepergi = $this->input->post('txbbookingcodepergi');
        $idtransactionpergi = $this->input->post('txbidtransactionpergi');
        $nominalpergi = $this->input->post('txbnormalsalespergi');
        $nominaladminpergi = $this->input->post('txbnominaladminpergi');
        $discountpergi = $this->input->post('txbdiscountpergi');
        $paytype = 'TUNAI';
        $token = $this->session->userdata('tokenft');

        $param = array(
            'bookingcode' => $bookingcodepergi,
            'idtransaction' => $idtransactionpergi,
            'nominal' => $nominalpergi,
            'nominaladmin' => $nominaladminpergi,
            'discount' => $discountpergi,
            'paytype' => $paytype,
            'token' => $token,
        );

        $APIurl = $this->config->item('api2_trainpayment');
        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));
        return $data;
    }

    public function paymentkeretapulang()
    {

        $bookingcodepulang = $this->input->post('txbbookingcodepulang');
        $idtransactionpulang = $this->input->post('txbidtransactionpulang');
        $nominalpulang = $this->input->post('txbnormalsalespulang');
        $nominaladminpulang = $this->input->post('txbnominaladminpulang');
        $discountpulang = $this->input->post('txbdiscountpulang');
        $paytype = 'TUNAI';
        $token = $this->session->userdata('tokenft');

        $param = array(
            'bookingcode' => $bookingcodepulang,
            'idtransaction' => $idtransactionpulang,
            'nominal' => $nominalpulang,
            'nominaladmin' => $nominaladminpulang,
            'discount' => $discountpulang,
            'paytype' => $paytype,
            'token' => $token,
        );

        $APIurl = $this->config->item('api2_trainpayment');
        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));
        return $data;
    }

    //kurang saldo agen
    function kurangsaldoagen(){

        $totalharga = $this->input->post('txbtotalharga');
        $iduser = $this->session->userdata('iduser');
        $level = $this->session->userdata('user_level');

        if($level == 1){
            $saldo = $this->input->post("txbsaldosekarang",true);
            $saldoskrng = $saldo - $totalharga;

            $whereuser = array(
                'id' => $iduser
            );
            $saldo = array(
                'saldo' => $saldoskrng,
            );
            $update = $this->M_user->update_data($whereuser,$saldo);
        }

    }

    //save to transaksi table and user deposit
    function savetotransaksi($idtranskereta){
        $lembaga_id = $this->session->userdata('lembaga_id');
        $iduser = $this->session->userdata('iduser');
        $txbkodeproduk = 'WKAI';
        $datetimenow = date("Y-m-d H:i:s");
        $bookingcodepergi = $this->input->post('txbbookingcodepergi');
        $tanggalpulang = $this->input->post('txbtanggalpulang');
        if ($tanggalpulang != '') {
            $bookingcodepulang = $this->input->post('txbbookingcodepulang');
            $bookingcode = $bookingcodepergi.'<br/>'.$bookingcodepulang;
        }else{
            $bookingcode = $bookingcodepergi;
        }

        $totalharga = $this->input->post('txbtotalharga');

        $datadetail = array(
            'namaproduk' => 'TIKET KAI',
            'nopelanggan' => $bookingcode,
            'namapelanggan' => $this->input->post('txbnamekontak'),
            'nominal' => $totalharga,
        );

        $iddetail = $this->M_transdetail->simpan_data($datadetail);

        $datatransaksi = array(
            'lembaga_id' => $lembaga_id,
            'trans_code' => $txbkodeproduk,
            'trans_detail_code' => $iddetail,
            'date_created' => $datetimenow,
            'user_created' => $iduser,
            'ref' => $idtranskereta,
            'status' => 1,
        );

        $idtrans = $this->M_transaksi->simpan_data($datatransaksi);

        $saldo = $this->input->post("txbsaldosekarang",true);
        $saldoskrng = $saldo - $totalharga;
        $data = array(
            'id_user' => $iduser,
            'id_depo' => $iduser,
            'tanggal' => $datetimenow,
            'case' => $txbkodeproduk,
            'id_transaksi' => $idtrans,
            'ket_transaksi' => 'TIKET KERETA API',
            'debet' => $totalharga,
            'sisa_saldo' => $saldoskrng,
        );

        $iddepo = $this->M_user_deposit->simpan_data($data);
    }

    //save to trans_kereta table
    function savetotranskereta(){

        $txbcekpp = $this->input->post('txbcekpp');

        $totalharga = $this->input->post('txbtotalharga');

        $datecreated = date("Y-m-d H:i:s");

        $data = array(
            'pp' => $txbcekpp,
            'total_harga' => $totalharga,
            'contact_name' => $this->input->post('txbnamekontak'),
            'contact_email' => $this->input->post('txbemailkontak'),
            'contact_telp' => $this->input->post('txbnotelpkontak'),
            'contact_addr' => $this->input->post('txbalamatkontak'),
            'date_created' => $datecreated,
            'user_created' => $this->session->userdata('username')
        );

        $idsimpandata = $this->M_kereta->simpandataandgetid("trans_kereta",$data);

        $this->kurangsaldoagen();

        $idtransactionpergi = $this->input->post('txbidtransactionpergi');
        $tanggalpulang = $this->input->post('txbtanggalpulang');
        if ($tanggalpulang != '') {
            $idtransactionpulang = $this->input->post('txbidtransactionpulang');
            $idtransaction = $idtransactionpergi.'<br/>'.$idtransactionpulang;
        }else{
            $idtransaction = $idtransactionpergi;
        }
        $this->savetotransaksi($idtransaction);

        return $idsimpandata;
    }

    //save to trans_kereta_detail table
    function savetotranskeretadetail(){

        $id = $this->savetotranskereta();

        $bookingcodepergi = $this->input->post('txbbookingcodepergi');
        $idtransactionpergi = $this->input->post('txbidtransactionpergi');
        $nmstfrompergi = $this->input->post('txbnmstfrom');
        $kdstfrompergi = $this->input->post('txbkdstfrom');
        $namastasiunfrom = $nmstfrompergi.'-'.$kdstfrompergi;
        $nmsttopergi = $this->input->post('txbnmstto');
        $kdsttopergi = $this->input->post('txbkdstto');
        $namastasiunto = $nmsttopergi.'-'.$kdsttopergi;
        $trainnamepergi = $this->input->post('txbtrainnamepergi');
        $trainnumberpergi = $this->input->post('txbtrainnumberpergi');
        $namakereta = $trainnamepergi.'-'.$trainnumberpergi;
        $gradepergi = $this->input->post('txbgradepergi');
        $subclasspergi = $this->input->post('txbsubclasspergi');
        $priceadultpergi = $this->input->post('txbpriceadultpergi');
        $tanggalpergi = $this->input->post('txbtanggalpergi');
        $tanggalpulang = $this->input->post('txbtanggalpulang');
        $departuretimepergi = $this->input->post('txbdeparturetimepergi');
        $arrivaltimepergi = $this->input->post('txbarrivaltimepergi');
        $jmldewasa = $this->input->post('txbjmldewasa');
        $jmlbayi = $this->input->post('txbjmlbayi');
        $timelimitpergi = $this->input->post('txbtimelimitpergi');

        $data = array(
            'bookingCode' => $bookingcodepergi,
            'idTransaction' => $idtransactionpergi,
            'trans_id' => $id,
            'type' => 'Pergi',
            'st_from' => $namastasiunfrom,
            'st_to' => $namastasiunto,
            'train_name' => $namakereta,
            'grade' => $gradepergi,
            'subclass' => $subclasspergi,
            'price' => $priceadultpergi,
            'departure_date' => $tanggalpergi,
            'arrival_date' => $tanggalpulang,
            'departure_time' => $departuretimepergi,
            'arrival_time' => $arrivaltimepergi,
            'jumlah_dewasa' => $jmldewasa,
            'jumlah_bayi' => $jmlbayi,
            'timelimit' => $timelimitpergi
        );

        $simpandatapergi = $this->M_kereta->simpandata("trans_kereta_detail",$data);

        $tanggalpulang = $this->input->post('txbtanggalpulang');

        if ($tanggalpulang != '') {

            $bookingcodepulang = $this->input->post('txbbookingcodepulang');
            $idtransactionpulang = $this->input->post('txbidtransactionpulang');
            $nmstfrompulang = $this->input->post('txbnmstfrom');
            $kdstfrompulang = $this->input->post('txbkdstfrom');
            $namastasiunfrom = $nmstfrompulang.'-'.$kdstfrompulang;
            $nmsttopulang = $this->input->post('txbnmstto');
            $kdsttopulang = $this->input->post('txbkdstto');
            $namastasiunto = $nmsttopulang.'-'.$kdsttopulang;
            $trainnamepulang = $this->input->post('txbtrainnamepulang');
            $trainnumberpulang = $this->input->post('txbtrainnumberpulang');
            $namakereta = $trainnamepulang.'-'.$trainnumberpulang;
            $gradepulang = $this->input->post('txbgradepulang');
            $subclasspulang = $this->input->post('txbsubclasspulang');
            $priceadultpulang = $this->input->post('txbpriceadultpulang');
            $departuretimepulang = $this->input->post('txbdeparturetimepulang');
            $arrivaltimepulang = $this->input->post('txbarrivaltimepulang');
            $jmldewasa = $this->input->post('txbjmldewasa');
            $jmlbayi = $this->input->post('txbjmlbayi');
            $timelimitpulang = $this->input->post('txbtimelimitpulang');

            $data = array(
                'bookingCode' => $bookingcodepulang,
                'idTransaction' => $idtransactionpulang,
                'trans_id' => $id,
                'type' => 'pulang',
                'st_from' => $namastasiunto,
                'st_to' => $namastasiunfrom,
                'train_name' => $namakereta,
                'grade' => $gradepulang,
                'subclass' => $subclasspulang,
                'price' => $priceadultpulang,
                'departure_date' => $tanggalpulang,
                'arrival_date' => $tanggalpulang,
                'departure_time' => $departuretimepulang,
                'arrival_time' => $arrivaltimepulang,
                'jumlah_dewasa' => $jmldewasa,
                'jumlah_bayi' => $jmlbayi,
                'timelimit' => $timelimitpulang
            );

            $simpandatapulang = $this->M_kereta->simpandata("trans_kereta_detail",$data);

        }

        return $id;

    }

    //save to trans_kereta_nameseat table

    function savetotranskeretanameseat(){

        $id = $this->savetotranskeretadetail();

        $txbjmldewasa = $this->input->post('txbjmldewasa');
        $txbjmlbayi = $this->input->post('txbjmlbayi');
        $bookingcodepergi = $this->input->post('txbbookingcodepergi');

        for ($i = 0; $i < $txbjmldewasa; $i++) {
            $x = $i+1;
            $txbnamadewasa = 'txbnamadewasa'.$x;
            $namapenumpang = $this->input->post($txbnamadewasa);
            $txbiddewasa = 'txbiddewasa'.$x;
            $idpenumpang = $this->input->post($txbiddewasa);
            $txbtgllahirdewasa = 'txbtgllahirdewasa'.$x;
            $tgllahirpenumpang = $this->input->post($txbtgllahirdewasa);
            $txbnotelpdewasa = 'txbnotelpdewasa'.$x;
            $notelppenumpang = $this->input->post($txbnotelpdewasa);
            $txbnoseatpenumpangpergi = 'txbnoseatpenumpangpergi'.$x;
            $noseatpenumpangpergi = $this->input->post($txbnoseatpenumpangpergi);

            $data = array(
                'bookingCode' => $bookingcodepergi,
                'jenispenumpang' => 'D',
                'namapenumpang' => $namapenumpang,
                'idpenumpang' => $idpenumpang,
                'tgllahirpenumpang' => $tgllahirpenumpang,
                'notelppenumpang' => $notelppenumpang,
                'noseatpenumpang' => $noseatpenumpangpergi
            );

            $simpandataseatdewasapergi = $this->M_kereta->simpandata("trans_kereta_nameseat",$data);

        };

        for ($j = 0; $j < $txbjmlbayi; $j++) {
            $y = $j + 1;
            $txbnamabayi = 'txbnamabayi'.$x;
            $namabayi = $this->input->post($txbnamabayi);
            $txbtgllahirbayi = 'txbtgllahirbayi'.$x;
            $tgllahirbayi = $this->input->post($txbtgllahirbayi);

            $data = array(
                'bookingCode' => $bookingcodepergi,
                'jenispenumpang' => 'B',
                'namapenumpang' => $namabayi,
                'idpenumpang' => '-',
                'tgllahirpenumpang' => $tgllahirbayi,
                'notelppenumpang' => '-',
                'noseatpenumpang' => '-'
            );

            $simpandataseatbayipergi = $this->M_kereta->simpandata("trans_kereta_nameseat",$data);
        };

        $tanggalpulang = $this->input->post('txbtanggalpulang');

        if ($tanggalpulang != '') {

            $bookingcodepulang = $this->input->post('txbbookingcodepulang');

            for ($i = 0; $i < $txbjmldewasa; $i++) {
                $x = $i+1;
                $txbnamadewasa = 'txbnamadewasa'.$x;
                $namapenumpang = $this->input->post($txbnamadewasa);
                $txbiddewasa = 'txbiddewasa'.$x;
                $idpenumpang = $this->input->post($txbiddewasa);
                $txbtgllahirdewasa = 'txbtgllahirdewasa'.$x;
                $tgllahirpenumpang = $this->input->post($txbtgllahirdewasa);
                $txbnotelpdewasa = 'txbnotelpdewasa'.$x;
                $notelppenumpang = $this->input->post($txbnotelpdewasa);
                $txbnoseatpenumpangpulang = 'txbnoseatpenumpangpulang'.$x;
                $noseatpenumpangpulang = $this->input->post($txbnoseatpenumpangpulang);

                $data = array(
                    'bookingCode' => $bookingcodepulang,
                    'jenispenumpang' => 'D',
                    'namapenumpang' => $namapenumpang,
                    'idpenumpang' => $idpenumpang,
                    'tgllahirpenumpang' => $tgllahirpenumpang,
                    'notelppenumpang' => $notelppenumpang,
                    'noseatpenumpang' => $noseatpenumpangpulang
                );

                $simpandataseatdewasapulang = $this->M_kereta->simpandata("trans_kereta_nameseat",$data);

            };

            for ($j = 0; $j < $txbjmlbayi; $j++) {
                $y = $j + 1;
                $txbnamabayi = 'txbnamabayi'.$x;
                $namabayi = $this->input->post($txbnamabayi);
                $txbtgllahirbayi = 'txbtgllahirbayi'.$x;
                $tgllahirbayi = $this->input->post($txbtgllahirbayi);

                $data = array(
                    'bookingCode' => $bookingcodepulang,
                    'jenispenumpang' => 'B',
                    'namapenumpang' => $namabayi,
                    'idpenumpang' => '-',
                    'tgllahirpenumpang' => $tgllahirbayi,
                    'notelppenumpang' => '-',
                    'noseatpenumpang' => '-'
                );

                $simpandataseatbayipulang = $this->M_kereta->simpandata("trans_kereta_nameseat",$data);
            };

        }

        return $id;

    }

    function savetotranskeretadetailharga(){

        $id = $this->savetotranskeretanameseat();

        $bookingcodepergi = $this->input->post('txbbookingcodepergi');
        $tanggalpulang = $this->input->post('txbtanggalpulang');

        $data = array(
            'bookingCode' => $bookingcodepergi,
            'komisi' => $this->input->post('txbkomisipergi'),
            'normalSales' => $this->input->post('txbnormalsalespergi'),
            'extrafee' => $this->input->post('txbextrafeepergi'),
            'nominalAdmin' => $this->input->post('txbnominaladminpergi'),
            'bookBalance' => $this->input->post('txbbookbalancepergi'),
            'discount' => $this->input->post('txbdiscountpergi')
        );

        $this->M_kereta->simpandata("trans_kereta_detail_harga",$data);

        if ($tanggalpulang != '') {

            $bookingcodepulang = $this->input->post('txbbookingcodepulang');

            $datapulang = array(
                'bookingCode' => $bookingcodepulang,
                'komisi' => $this->input->post('txbkomisipulang'),
                'normalSales' => $this->input->post('txbnormalsalespulang'),
                'extrafee' => $this->input->post('txbextrafeepulang'),
                'nominalAdmin' => $this->input->post('txbnominaladminpulang'),
                'bookBalance' => $this->input->post('txbbookbalancepulang'),
                'discount' => $this->input->post('txbdiscountpulang')
            );

            $this->M_kereta->simpandata("trans_kereta_detail_harga",$datapulang);


        }

        return $id;


    }

    public function getdatastation()
    {

        $token = $this->session->userdata('tokenft');

        $param = array("token"=>$token);

        $APIurl = $this->config->item('api2_trainstations');

        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        $lengthdata = count($data->data);

        $a=array();
        for ($i = 0; $i < $lengthdata; $i++) {
            $idstasiun = $data->data[$i]->id_stasiun;
            $namastasiun = $data->data[$i]->nama_stasiun;
            $namakota = $data->data[$i]->nama_kota;

            $label = $idstasiun.' - '.$namastasiun.', '.$namakota;

            array_push($a,$label);
        };

        $arr = array(
            "name" => $a
        );

        echo json_encode($arr);
    }

    public function getdatajadwalkereta()
    {
        $cekpp = $this->input->post('cekpp');

        $st_from = $this->input->post('st_from');
        $st_to = $this->input->post('st_to');
        $tglpergi = $this->input->post('tglpergi');
        $token = $this->session->userdata('tokenft');

        if($cekpp == 'on'){

            $tglpulang = $this->input->post('tglpulang');

            $param = array(
                'cekpp' => $cekpp,
                'st_from' => $st_from,
                'st_to' => $st_to,
                'tglpergi' => $tglpergi,
                'tglpulang' => $tglpulang,
                'token' => $token
            );

        }else{

            $param = array(
                'cekpp' => $cekpp,
                'st_from' => $st_from,
                'st_to' => $st_to,
                'tglpergi' => $tglpergi,
                'token' => $token
            );

        }

        $APIurl = $this->config->item('api2_trainsearch');

        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));

        return $data;


    }

    public function bookingkereta()
    {
        $param = array();

        $txbjmldewasa = $this->input->post('txbjmldewasa');
        $txbjmlbayi = $this->input->post('txbjmlbayi');
        $stfrom = $this->input->post('txbnmstfrom');
        $kdstfrom = $this->input->post('txbkdstfrom');
        $stto = $this->input->post('txbnmstto');
        $kdstto = $this->input->post('txbkdstto');

        //data pergi
        $tanggalpergi = $this->input->post('txbtanggalpergi');
        $trainnumberpergi = $this->input->post('txbtrainnumberpergi');
        $gradepergi = $this->input->post('txbgradepergi');
        $classpergi = $this->input->post('txbsubclasspergi');
        $trainnamepergi = $this->input->post('txbtrainnamepergi');
        $departuretimepergi = $this->input->post('txbdeparturetimepergi');
        $arrivaltimepergi = $this->input->post('txbarrivaltimepergi');
        $priceadultpergi = $this->input->post('txbpriceadultpergi');
        $token = $this->session->userdata('tokenft');

        $tanggalpulang = $this->input->post('txbtanggalpulang');

        $param = array(
            'txbjmldewasa' => $txbjmldewasa,
            'txbjmlbayi' => $txbjmlbayi,
            'txbnmstfrom' => $stfrom,
            'txbkdstfrom' => $kdstfrom,
            'txbnmstto' => $stto,
            'txbkdstto' => $kdstto,
            'txbtanggalpergi' => $tanggalpergi,
            'txbtanggalpulang' => $tanggalpulang,
            'txbtrainnumberpergi' => $trainnumberpergi,
            'txbgradepergi' => $gradepergi,
            'txbsubclasspergi' => $classpergi,
            'txbtrainnamepergi' => $trainnamepergi,
            'txbdeparturetimepergi' => $departuretimepergi,
            'txbarrivaltimepergi' => $arrivaltimepergi,
            'txbpriceadultpergi' => $priceadultpergi,
            'token' => $token,
        );

        //data pulang

        if ($tanggalpulang != '') {

            $trainnumberpulang = $this->input->post('txbtrainnumberpulang');
            $gradepulang = $this->input->post('txbgradepulang');
            $classpulang = $this->input->post('txbsubclasspulang');
            $trainnamepulang = $this->input->post('txbtrainnamepulang');
            $departuretimepulang = $this->input->post('txbdeparturetimepulang');
            $arrivaltimepulang = $this->input->post('txbarrivaltimepulang');
            $priceadultpulang = $this->input->post('txbpriceadultpulang');

            $param['txbtrainnumberpulang'] = $trainnumberpulang;
            $param['txbgradepulang'] = $gradepulang;
            $param['txbsubclasspulang'] = $classpulang;
            $param['txbtrainnamepulang'] = $trainnamepulang;
            $param['txbdeparturetimepulang'] = $departuretimepulang;
            $param['txbarrivaltimepulang'] = $arrivaltimepulang;
            $param['txbpriceadultpulang'] = $priceadultpulang;

        }

        for ($i = 0; $i < $txbjmldewasa; $i++) {
            $x = $i + 1;
            $txbnamedewasa = 'txbnamedewasa'.$x;
            $namapenumpang = $this->input->post($txbnamedewasa);
            $txbiddewasa = 'txbiddewasa'.$x;
            $idpenumpang = $this->input->post($txbiddewasa);
            $txbtgllahirdewasa = 'txbtgllahirdewasa'.$x;
            $tgllahirdewasa = $this->input->post($txbtgllahirdewasa);
            $txbnotelpdewasa = 'txbnotelpdewasa'.$x;
            $notelpdewasa = $this->input->post($txbnotelpdewasa);
            if($notelpdewasa == '0'){
                $notelpondewasa = '08112345678'.$i;
            }else{
                $notelpondewasa = $notelpdewasa;
            }

            $param[$txbnamedewasa] = $namapenumpang;
            $param[$txbiddewasa] = $idpenumpang;
            $param[$txbtgllahirdewasa] = $tgllahirdewasa;
            $param[$txbnotelpdewasa] = $notelpondewasa;

        }

        for ($j = 0; $j < $txbjmlbayi; $j++) {
            $y=$j+1;
            $txbnamebayi = 'txbnamebayi'.$y;
            $namabayi = $this->input->post($txbnamebayi);
            $txbtgllahirbayi = 'txbtgllahirbayi'.$y;
            $tgllahirbayi = $this->input->post($txbtgllahirbayi);

            $param[$txbnamebayi] = $namabayi;
            $param[$txbtgllahirbayi] = $tgllahirbayi;
        };

        $APIurl = $this->config->item('api2_trainbook');
        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));
        return $data;

    }

    public function getseatlayout()
    {
        $kdstfrom = $this->input->post('txbkdstfrom');
        $kdstto = $this->input->post('txbkdstto');
        $tanggalpergi = $this->input->post('txbtanggalpergi');
        $tanggalpulang = $this->input->post('txbtanggalpulang');
        $trainnumberpergi = $this->input->post('txbtrainnumberpergi');
        $token = $this->session->userdata('tokenft');

        $param = array(
            'kdstfrom' => $kdstfrom,
            'kdstto' => $kdstto,
            'tanggalpergi' => $tanggalpergi,
            'tanggalpulang' => $tanggalpulang,
            'trainnumberpergi' => $trainnumberpergi,
            'token' => $token
        );

        //data pulang

        if ($tanggalpulang != '') {

            $trainnumberpulang = $this->input->post('txbtrainnumberpulang');

            $param['trainnumberpulang'] = $trainnumberpulang;

        }

        $APIurl = $this->config->item('api2_seatlayout');
        $data = json_decode($this->curl->simple_post($APIurl, $param, array(CURLOPT_BUFFERSIZE => 10)));
        return $data;

    }

    public function changeseatpergi()
    {
        $APIurls = $this->config->item('api2_trainchangeseat');

        $txbjmldewasa = $this->input->post('txbjmldewasa');
        $tanggalpulang = '';

        $txbcodebookingpergi = $this->input->post('txbcodebookingpergi');
        $txbtransactionidbookingpergi= $this->input->post('txbtransactionidbookingpergi');
        $txbwagoncodepenumpangpergi= $this->input->post('txbwagoncodepenumpangpergi1');
        $txbwagonnumberpenumpangpergi= $this->input->post('txbwagonnumberpenumpangpergi1');

        $param = array(
            'txbjmldewasa' => $txbjmldewasa,
            'txbtanggalpulang' => $tanggalpulang,
            'txbcodebooking' => $txbcodebookingpergi,
            'txbtransactionidbooking' => $txbtransactionidbookingpergi,
            'txbwagoncodepenumpang' => $txbwagoncodepenumpangpergi,
            'txbwagonnumberpenumpang' => $txbwagonnumberpenumpangpergi,
            'token' => $this->session->userdata('tokenft')
        );

        for ($i = 0; $i < $txbjmldewasa; $i++) {

            $x=$i+1;
            $txbrowpenumpangpergi = 'txbrowpenumpangpergi'.$x;
            $rowpenumpangpergi = $this->input->post($txbrowpenumpangpergi);

            $txbcolumnpenumpangpergi = 'txbcolumnpenumpangpergi'.$x;
            $columnpenumpangpergi = $this->input->post($txbcolumnpenumpangpergi);

            $param[$txbrowpenumpangpergi] = $rowpenumpangpergi;
            $param[$txbcolumnpenumpangpergi] = $columnpenumpangpergi;
        };

        $datachangeseatpergi = json_decode($this->curl->simple_post($APIurls, $param, array(CURLOPT_BUFFERSIZE => 10)));

        return $datachangeseatpergi;

    }

    public function changeseatpulang()
    {
        $APIurls = $this->config->item('api2_trainchangeseat');

        $txbjmldewasa = $this->input->post('txbjmldewasa');
        $tanggalpulang = $this->input->post('txbtanggalpulang');

        $txbcodebookingpulang = $this->input->post('txbcodebookingpulang');
        $txbtransactionidbookingpulang= $this->input->post('txbtransactionidbookingpulang');
        $txbwagoncodepenumpangpulang= $this->input->post('txbwagoncodepenumpangpulang1');
        $txbwagonnumberpenumpangpulang= $this->input->post('txbwagonnumberpenumpangpulang1');

        $param = array(
            'txbjmldewasa' => $txbjmldewasa,
            'txbtanggalpulang' => $tanggalpulang,
            'txbcodebooking' => $txbcodebookingpulang,
            'txbtransactionidbooking' => $txbtransactionidbookingpulang,
            'txbwagoncodepenumpang' => $txbwagoncodepenumpangpulang,
            'txbwagonnumberpenumpang' => $txbwagonnumberpenumpangpulang,
            'token' => $this->session->userdata('tokenft')
        );

        for ($i = 0; $i < $txbjmldewasa; $i++) {

            $x=$i+1;
            $txbrowpenumpangpulang = 'txbrowpenumpangpulang'.$x;
            $rowpenumpangpulang = $this->input->post($txbrowpenumpangpulang);

            $txbcolumnpenumpangpulang = 'txbcolumnpenumpangpulang'.$x;
            $columnpenumpangpulang = $this->input->post($txbcolumnpenumpangpulang);

            $param[$txbrowpenumpangpulang] = $rowpenumpangpulang;
            $param[$txbcolumnpenumpangpulang] = $columnpenumpangpulang;
        };

        $datachangeseatpulang = json_decode($this->curl->simple_post($APIurls, $param, array(CURLOPT_BUFFERSIZE => 10)));

        return $datachangeseatpulang;

    }

    public function cancelbook()
    {
        $APIurls = $this->config->item('api2_traincancelbook');

        $txacancel = $this->input->post('txacancel');
        $txbcancelcodebookingpergi = $this->input->post('txbcancelcodebookingpergi');
        $txbcanceltransactionidbookingpergi = $this->input->post('txbcanceltransactionidbookingpergi');

        $tanggalpulang = $this->input->post('txbcanceltanggalpulang');

        $param = array(
            'txacancelreason' => $txacancel,
            'txbcancelcodebookingpergi' => $txbcancelcodebookingpergi,
            'txbcanceltransactionidbookingpergi' => $txbcanceltransactionidbookingpergi,
            'txbcanceltanggalpulang' => $tanggalpulang,
            'token' => $this->session->userdata('tokenft')
        );

        if ($tanggalpulang != '') {

            $txbcancelcodebookingpulang = $this->input->post('txbcancelcodebookingpulang');
            $txbcanceltransactionidbookingpulang = $this->input->post('txbcanceltransactionidbookingpulang');

            $param['txbcancelcodebookingpulang'] = $txbcancelcodebookingpulang;
            $param['txbcanceltransactionidbookingpulang'] = $txbcanceltransactionidbookingpulang;

        }

        $datacancel = json_decode($this->curl->simple_post($APIurls, $param, array(CURLOPT_BUFFERSIZE => 10)));

        var_dump($datacancel);die();

        $this->session->set_flashdata('messagecancel', 'Berhasil');
        redirect(base_url('kereta'));
    }

}
