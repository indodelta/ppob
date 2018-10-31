<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->model('M_login');
        $this->load->model('M_trans_saldo');
        $this->load->model('M_user');
        $this->load->model('M_transaksi');
		$this->load->helper('url');
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
            $lembaga_id = $this->session->userdata('lembaga_id');
            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            $data['jumlah_konfirmasi_topupsaldo'] = $this->M_trans_saldo->jumlah_konfirmasi($lembaga_id)->num_rows();
            $data['jumlah_transaksi_deposit'] = count($this->M_trans_saldo->load_data($lembaga_id));

            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
                $wheretoday = array(
                    'lembaga_id' => $lembaga_id
                );
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
                $wheretoday = array(
                    'lembaga_id' => $lembaga_id,
                    'user_created' => $id
                );
            }

            $data['transaction_today'] = $this->M_transaksi->select_count_transaction_today($wheretoday);
            $data['transaction_month'] = $this->M_transaksi->select_count_transaction_monthly($wheretoday);

            $this->load->view('layout/v_header',$data);
            $this->load->view('dashboard',$data);
            $this->load->view('layout/v_footer',$data);
        }
	}

    public function send_mail() {

        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "mrrhie151@gmail.com";
        $config['smtp_pass'] = "15november1993";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";


        $ci->email->initialize($config);

        $ci->email->from('mrrhie151@gmail.com', 'Arie Lesmana Hidayat');
        $list = array('arielesmanahidayat@domain.com');
        $ci->email->to($list);
        $ci->email->subject('judul email');
        $ci->email->message('isi email');
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }


//        $our_server = 'mail.localhost.com';
//
//        ini_set('SMTP', $our_server );
//
//        $from_email = "mrrhie151@gmail.com";
//        $to_email = "arielesmanahidayat@gmail.com";;
//
//        $config = Array(
//            'protocol' => 'smtp',
//            'smtp_host' => 'ssl://smtp.googlemail.com',
//            'smtp_port' => 465,
//            'smtp_user' => $from_email,
//            'smtp_pass' => 'xxx',
//            'mailtype'  => 'html',
//            'charset'   => 'iso-8859-1'
//        );
//
//        $this->load->library('email', $config);
//        $this->email->set_newline("\r\n");
//
//         $this->email->from($from_email, 'Ane');
//         $this->email->to($to_email);
//         $this->email->subject('Test Pengiriman Email');
//         $this->email->message('Coba mengirim Email dengan CodeIgniter.');
//
//         //Send mail
//         if($this->email->send()){
//             echo 'berhasil';
//         }else {
//             echo 'gagal';
//         }
    }
}
