<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PPOB extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_login');
        $this->load->model('M_user');
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

            $tabs= $this->input->get("tab",true);

            if ($tabs!="") {
                $tab = $tabs;
            }else{
                $tab = "1";
            }

            $data['tab'] = $tab;
            $data['jsppob_to_load']= 'js_ppob.js';
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }


            $this->load->view('layout/v_header',$data);
            $this->load->view('ppob/ppob',$data);
            $this->load->view('layout/v_footer',$data);
        }
    }

    public function checkout()
    {
        $data = $this->view_data_tagihan();

        $data['jscheckout_to_load']= 'js_checkout.js';
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
        $id = $this->session->userdata('iduser');
        $level = $this->session->userdata('user_level');
        if($level == 0){
            $data['datasaldo'] = $this->cek_saldo_mobipay();
        }else{
            $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
        }

        $this->load->view('layout/v_header',$data);
        $this->load->view('Checkout/checkout',$data);
        $this->load->view('layout/v_footer',$data);
    }

    public function view_data_tagihan()
    {
        $txbjenistagihan = $this->input->post("txbjenistagihan");
        $txbtab = $this->input->post("txbtab");
        $nomorpelanggan = $this->input->post("nomorpelanggan",true);

        $certcode = $this->session->userdata('certcode');

        if($txbjenistagihan == 'PASCABAYAR'){

            $jenistagihan = $this->input->post("jenistagihan",true);
            $kodeproduk = array("HPTSEL","HPMTRIX","HPXL","HPESIA","HPSMART","HPTHREE");
            $produk = $kodeproduk[$jenistagihan];

            $data['jenistagihan'] = $jenistagihan;

        }else if($txbjenistagihan == 'TOKENPLN'){

            $produk = $this->input->post("txbproduk",true);
            $nomorpelanggan = $this->input->post("txbnomorpelanggan",true);
            $nominaltoken= $this->input->post("txbnominaltoken",true);
            $data['nominaltoken'] = $nominaltoken;

        }else if($txbjenistagihan == 'PLNPASCABAYAR'){

            $produk = $this->input->post("txbproduk",true);

        }else if($txbjenistagihan == 'VOUCHERGAME'){

            $produk = $this->input->post("pilihanprodukgameonline",true);

        }else if($txbjenistagihan == 'INDIHOME'){

            $txbkodeproduk= $this->input->post("txbkodeproduk",true);
            $produk = substr($txbkodeproduk, 0, -1);

        }else if($txbjenistagihan == 'TELEPON'){

            $produk = $this->input->post("txbkodeproduk",true);

        }else if($txbjenistagihan == 'PDAM'){

            $pilihanpdam= $this->input->post("pilihanpdam",true);
            $split = explode('-', $pilihanpdam);
            $produk = $split[0];
            $namapdam = $split[1];

            $data['namapdam'] = $namapdam;

        }else if($txbjenistagihan == 'TVKABEL'){

            $pilihantvkabel= $this->input->post("pilihanproduktvkabel",true);
            $split = explode('-', $pilihantvkabel);
            $produk = $split[0];
            $namatvkabel = $split[1];

            $data['namatvkabel'] = $namatvkabel;

        }else if($txbjenistagihan == 'ANGSKREDIT'){

            $pilihanangskredit= $this->input->post("pilihanprodukkredit",true);
            $split = explode('-', $pilihanangskredit);
            $produk = $split[0];
            $namaangskredit = $split[1];

            $data['namaangskredit'] = $namaangskredit;

        }else if($txbjenistagihan == 'PGN'){

            $produk = $this->input->post("txbproduk",true);

        }

        $data['txbjenistagihan'] = $txbjenistagihan;
        $data['txbtab'] = $txbtab;
        $data['nomorpelanggan'] = $nomorpelanggan;

        $param = array("certcode"=>$certcode,
            "notelp"=>$nomorpelanggan,
            "produk"=>$produk);

        //contoh hasil

        $datatagihan = array(
            "nama"=>'Arie',
            "periode"=>'201805',
            "nominal"=>'96087',
            "admin"=>'3000',
            "ref2"=>'1234567890'
        );

        $tagihans = array(
            "errorCode"=>0,
            "errorMsg"=>'',
            "reqid"=>'1805240000007',
            "tgl"=>'24 May 2018 - 09:12:26',
            "nilai"=>'99087',
            "data"=>$datatagihan
        );
        $tagihan = json_encode($tagihans);

//        $tagihan = $this->curl->simple_post($this->config->item('api_inquiry'), $param, array(CURLOPT_BUFFERSIZE => 10));
        $data_tagihan = json_decode($tagihan);

        $data['param'] = $param;
        $data['data_tagihan'] = $data_tagihan;



        return $data;

    }

    public function payment()
    {
        $txbjenistagihan = $this->input->post("txbjenistagihan");

        if($txbjenistagihan == 'PULSA' or $txbjenistagihan == 'DATA' or $txbjenistagihan == 'VOUCHERGAME' or $txbjenistagihan == 'EMONEY'){
            $data = $this->api_trans();
        }else{
            $data = $this->api_payment();
        }

        $data['jspayment_to_load']= 'js_payment.js';
        $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
        $id = $this->session->userdata('iduser');
        $level = $this->session->userdata('user_level');
        if($level == 0){
            $data['datasaldo'] = $this->cek_saldo_mobipay();
        }else{
            $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
        }
        $data['txbjenistagihan'] = $txbjenistagihan;

        $this->load->view('layout/v_header',$data);
        $this->load->view('Checkout/payment',$data);
        $this->load->view('layout/v_footer',$data);
    }

    public function api_trans()
    {
        $certcode = $this->session->userdata('certcode');

        $txbjenistagihan = $this->input->post("txbjenistagihan");
        $txbtab = $this->input->post("txbtab");
        $txbnopelanggan = $this->input->post("txbnomorpelanggan",true);

        if($txbjenistagihan == 'PULSA'){
            $pilihannominal = $this->input->post("nominalpulsa",true);
        }else if($txbjenistagihan == 'DATA'){
            $pilihannominal = $this->input->post("nominaldata",true);
        }else if($txbjenistagihan == 'VOUCHERGAME'){
            $pilihannominal = $this->input->post("pilihanprodukgameonline",true);
        }else if($txbjenistagihan == 'EMONEY'){
            $pilihannominal = $this->input->post("pilihanprodukemoney",true);
        }

        $split = explode(',', $pilihannominal);
        $namaoperator = $split[0];
        $produk = $split[1];
        $namaproduk = $split[2];
        $harga = $split[3];

        $param = array("certcode"=>$certcode,
                       "notelp"=>$txbnopelanggan,
                       "produk"=>$produk);

        //contoh hasil

        $tagihans = array(
            "errorCode"=>0,
            "errorMsg"=>'',
            "reqid"=>'1805240000007',
            "tgl"=>'24 May 2018 - 09:12:26',
            "sn"=>'10001010101',
            "nilai"=>'125000',
            "produk"=>$produk,
            "mitra"=>3
        );

        $tagihan = json_encode($tagihans);

//        $tagihan = $this->curl->simple_post($this->config->item('api_trans'), $param, array(CURLOPT_BUFFERSIZE => 10));
        $data_bayar = json_decode($tagihan);

        $data['param'] = $param;
        $data['data_bayar'] = $data_bayar;
        $data['tab'] = $txbtab;

        $data['dataproduk'] = array("namaoperator"=>$namaoperator,
                                    "produk"=>$produk,
                                    "namaproduk"=>$namaproduk,
                                    "harga"=>$harga);


        return $data;
    }

    public function api_payment()
    {
        $certcode = $this->session->userdata('certcode');

        $txbjenistagihan = $this->input->post("txbjenistagihan");
        $txbtab = $this->input->post("txbtab");
        $txbnopelanggan = $this->input->post("txbnomorpelanggan",true);
        $produk= $this->input->post("txbproduk",true);
        $namaproduk= $this->input->post("txbnamaproduk",true);

        if($txbjenistagihan == 'TOKENPLN'){

            $nominal= $this->input->post("txbnominaltoken",true);

            $param = array("certcode"=>$certcode,
                           "notelp"=>$txbnopelanggan,
                           "produk"=>$produk,
                           "nominal"=>$nominal);

            //contoh hasil

            $datatagihan = array(
                "nama"=>'Arie',
                "periode"=>'201805',
                "nominal"=>'50000',
                "admin"=>'3000',
                "ref2"=>'1000101020101',
                "token"=>'10112121323131'
            );

            $tagihans = array(
                "errorCode"=>0,
                "errorMsg"=>'',
                "reqid"=>'1805240000007',
                "tgl"=>'24 May 2018 - 09:12:26',
                "nilai"=>'125000',
                "data"=>$datatagihan
            );

        }else{

            $param = array("certcode"=>$certcode,
                "notelp"=>$txbnopelanggan,
                "produk"=>$produk);

            //contoh hasil

            $datatagihan = array(
                "nama"=>'Arie',
                "periode"=>'201805',
                "nominal"=>'26000',
                "admin"=>'3000',
                "ref2"=>'1000101020101'
            );

            $tagihans = array(
                "errorCode"=>0,
                "errorMsg"=>'',
                "reqid"=>'1805240000007',
                "tgl"=>'24 May 2018 - 09:12:26',
                "nilai"=>'125000',
                "data"=>$datatagihan
            );

        }

        $tagihan = json_encode($tagihans);

//        $tagihan = $this->curl->simple_post($this->config->item('api_payment'), $param, array(CURLOPT_BUFFERSIZE => 10));
        $data_bayar = json_decode($tagihan);
//
        $data['param'] = $param;
        $data['data_bayar'] = $data_bayar;
        $data['tab'] = $txbtab;

        $data['dataproduk'] = array("produk"=>$produk,
                                    "namaproduk"=>$namaproduk);

        return $data;
    }

    public function bayar_tagihan()
    {
        $txbjenistagihan = $this->input->post("txbjenistagihan");
        $txbkodeproduk = $this->input->post("txbkodeproduk",true);
        $txbnamaproduk = $this->input->post("txbnamaproduk",true);
        $txbnopelanggan = $this->input->post("txbnopelanggan",true);
        $txbnamapelanggan = $this->input->post("txbnamapelanggan",true);
        $txbnominal = $this->input->post("txbnominal",true);
        $txbsn = $this->input->post("txbsn",true);
        $txbref = $this->input->post("txbref",true);
        $tab = $this->input->post("txbtab",true);

        $lembaga_id = $this->session->userdata('lembaga_id');
        $datetimenow = date("Y-m-d H:i:s");
        $iduser = $this->session->userdata('iduser');

        $datadetail = array(
            'namaproduk' => $txbnamaproduk,
            'nopelanggan' => $txbnopelanggan,
            'namapelanggan' => $txbnamapelanggan,
            'nominal' => $txbnominal,
        );

        $iddetail = $this->M_transdetail->simpan_data($datadetail);

        $datatransaksi = array(
            'lembaga_id' => $lembaga_id,
            'trans_code' => $txbkodeproduk,
            'trans_detail_code' => $iddetail,
            'date_created' => $datetimenow,
            'user_created' => $iduser,
            'sn' => $txbsn,
            'ref' => $txbref,
            'status' => 1,
        );

        $idtrans = $this->M_transaksi->simpan_data($datatransaksi);

        $saldo = $this->input->post("txbsaldosekarang",true);
        $saldoskrng = $saldo - $txbnominal;

        $data = array(
            'lembaga_id' => $lembaga_id,
            'id_user' => $iduser,
            'id_depo' => $iduser,
            'tanggal' => $datetimenow,
            'case' => $txbkodeproduk,
            'id_transaksi' => $idtrans,
            'ket_transaksi' => $txbnamaproduk,
            'debet' => $txbnominal,
            'sisa_saldo' => $saldoskrng,
        );

        $iddepo = $this->M_user_deposit->simpan_data($data);

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

        if($txbjenistagihan == 'PULSA' or $txbjenistagihan == 'DATA' ){
            if($txbjenistagihan == 'PULSA'){
                $setsession = $idtrans.','.$txbnopelanggan.','.$txbnamaproduk.','.$iddepo;
                $this->session->set_flashdata('tambahpulsaberhasil',$setsession);
            }else if($txbjenistagihan == 'DATA'){
                $setsession = $idtrans.','.$txbnopelanggan.','.$txbnamaproduk.','.$iddepo;
                $this->session->set_flashdata('tambahdataberhasil',$setsession);
            }
            redirect(base_url('Pulsa'));
        }else{
            if($txbjenistagihan == 'TOKENPLN'){
                $setsession = $txbjenistagihan.','.$idtrans.','.$txbnopelanggan.','.$txbnamaproduk.','.$iddepo.','.$txbsn;
            }else{
                $setsession = $txbjenistagihan.','.$idtrans.','.$txbnopelanggan.','.$txbnamaproduk.','.$iddepo;
            }
            $this->session->set_flashdata('tambahdataberhasil',$setsession);
            redirect(base_url('ppob?tab='.$tab));

        }


    }


}
