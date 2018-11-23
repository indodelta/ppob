<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_user_deposit');
        $this->load->model('M_user_topup');
        $this->load->model('M_transaksi');
        $this->load->model('M_transdetail');
        $this->load->model('M_login');
        $this->load->model('M_user');
        $this->domain = $_SERVER['HTTP_HOST'];
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        redirect(site_url("dashboard"));
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

    public function mutasideposit()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{

            $data['jsmutasideposit_to_load']= 'js_mutasideposit.js';

            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }

            $this->load->view('layout/v_header',$data);
            $this->load->view('Laporan/mutasideposit',$data);
            $this->load->view('layout/v_footer',$data);
        }

    }

    public function get_data_mutasi_deposit()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $lembaga_id = $this->session->userdata('lembaga_id');

            $this->load->library('ssp');

            $table = 't_user_deposit';

            $primaryKey = 'id';

            if($this->session->userdata('user_level') == 0){

                $columns = array(
                    array('db' => 'id_transaksi', 'dt' => 0, 'field' => 'id_transaksi'),
                    array('db' => 'tanggal', 'dt' => 1, 'field' => 'tanggal'),
                    array(
                        'db' => 'id_depo',
                        'dt' => 2,
                        'field' => 'id_depo',
                        'formatter' => function( $c ) {
                            return '
                                <button type="button" class="btn btn-xs" style="background-color: transparent; color: #75A4CC;" onclick="lihatSaldouser(this)" data-iduser='.$c.'>'.$c.'</button>
                            ';
                        }),
                    array('db' => 'case', 'dt' => 3, 'field' => 'case'),
                    array('db' => 'ket_transaksi', 'dt' => 4, 'field' => 'ket_transaksi'),
                    array(
                        'db' => 'debet',
                        'dt' => 5,
                        'field' => 'debet',
                        'formatter' => function( $f ) {
                            $nominal = number_format($f, 0, ',', '.');
                            return $nominal;
                        }),
                    array(
                        'db' => 'kredit',
                        'dt' => 6,
                        'field' => 'kredit',
                        'formatter' => function( $g ) {
                            $nominal = number_format($g, 0, ',', '.');
                            return $nominal;
                        }),
                    array(
                        'db' => 'komisi',
                        'dt' => 7,
                        'field' => 'komisi',
                        'formatter' => function( $h ) {
                            $nominal = number_format($h, 0, ',', '.');
                            return $nominal;
                        }),
                );

                $joinQuery = "";
                $extrawhere = "lembaga_id=$lembaga_id";

            }else{

                $columns = array(
                    array('db' => 'id_transaksi', 'dt' => 0, 'field' => 'id_transaksi'),
                    array('db' => 'tanggal', 'dt' => 1, 'field' => 'tanggal'),
                    array('db' => 'case', 'dt' => 2, 'field' => 'case'),
                    array('db' => 'ket_transaksi', 'dt' => 3, 'field' => 'ket_transaksi'),
                    array(
                        'db' => 'debet',
                        'dt' => 4,
                        'field' => 'debet',
                        'formatter' => function( $e ) {
                            $nominal = number_format($e, 0, ',', '.');
                            return $nominal;
                        }),
                    array(
                        'db' => 'kredit',
                        'dt' => 5,
                        'field' => 'kredit',
                        'formatter' => function( $f ) {
                            $nominal = number_format($f, 0, ',', '.');
                            return $nominal;
                        }),
                    array(
                        'db' => 'sisa_saldo',
                        'dt' => 6,
                        'field' => 'sisa_saldo',
                        'formatter' => function( $g ) {
                            $nominal = number_format($g, 0, ',', '.');
                            return $nominal;
                        }),
                );


                $id = $this->session->userdata('iduser');
                $joinQuery = "";
                $extrawhere = "id_user =$id";

            }

            // My SQL connection information
            $sql_details = array(
                'user' => 'root',
                'pass' => '',
                'db' => 'klikmbc',
                'host' => 'localhost'
            );

            echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extrawhere)
            );
        }
    }

    public function get_data_transaksi()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $lembaga_id = $this->session->userdata('lembaga_id');

            $this->load->library('ssp');

            $table = 'transaksi';

            $primaryKey = 'id';

            if($this->session->userdata('user_level') == 0){

                $columns = array(
                    array( 'db' => '`c`.`id`',
                        'dt' => 0,
                        'field' => 'id'
                    ),
                    array( 'db' => '`c`.`date_created`', 'dt' => 1,  'field' => 'date_created' ),
                    array( 'db' => '`c`.`user_created`', 'dt' => 2,  'field' => 'user_created' ),
                    array( 'db' => '`c`.`trans_code`', 'dt' => 3, 'field' => 'trans_code' ),
                    array( 'db' => '`cn`.`nopelanggan`', 'dt' => 4, 'field' => 'nopelanggan'),
                    array( 'db' => '`c`.`sn`', 'dt' => 5, 'field' => 'sn' ),
                    array( 'db' => '`c`.`ref`', 'dt' => 6, 'field' => 'ref' ),
                    array( 'db' => '`c`.`status`',
                        'dt' => 7,
                        'field' => 'status',
                        'formatter' => function( $g ) {
                            if($g == '1'){
                                $status = 'Berhasil';
                            }else{
                                $status = 'Gagal';
                            }
                            return $status;
                        }
                    ),
                    array( 'db' => '`cn`.`nominal`',
                        'dt' => 8,
                        'field' => 'nominal',
                        'formatter' => function( $h ) {
                            $nominal = number_format($h, 0, ',', '.');
                            return $nominal;
                        }

                    ),
                    array( 'db' => '`c`.`trans_detail_code`',
                        'dt' => 9,
                        'field' => 'trans_detail_code',
                        'formatter' => function( $i ) {
                            return '
                                    <text style="color: #75A4CC; cursor: pointer;" onclick="open_modal_lihat_detail(this)" data-id='.$i.'>Detail</text>
                                ';
                        }
                    ),
                );

                $joinQuery = "FROM `{$table}` AS `c` JOIN `transaksi_detail` AS `cn` ON (`cn`.`idtrans` = `c`.`trans_detail_code`)";
                $extraCondition = "`c`.`lembaga_id`='".$lembaga_id."'";

            }else{

                $columns = array(
                    array( 'db' => '`c`.`id`',
                        'dt' => 0,
                        'field' => 'id'
                    ),
                    array( 'db' => '`c`.`date_created`', 'dt' => 1,  'field' => 'date_created' ),
                    array( 'db' => '`c`.`trans_code`', 'dt' => 2, 'field' => 'trans_code' ),
                    array( 'db' => '`cn`.`nopelanggan`', 'dt' => 3, 'field' => 'nopelanggan'),
                    array( 'db' => '`c`.`sn`', 'dt' => 4, 'field' => 'sn' ),
                    array( 'db' => '`c`.`ref`', 'dt' => 5, 'field' => 'ref' ),
                    array( 'db' => '`c`.`status`',
                        'dt' => 6,
                        'field' => 'status',
                        'formatter' => function( $g ) {
                            if($g == '1'){
                                $status = 'Berhasil';
                            }else{
                                $status = 'Gagal';
                            }
                            return $status;
                        }
                    ),
                    array( 'db' => '`cn`.`nominal`',
                        'dt' => 7,
                        'field' => 'nominal',
                        'formatter' => function( $h ) {
                            $nominal = number_format($h, 0, ',', '.');
                            return $nominal;
                        }

                    ),
                    array( 'db' => '`c`.`trans_detail_code`',
                        'dt' => 8,
                        'field' => 'trans_detail_code',
                        'formatter' => function( $i ) {
                            return '
                                    <text style="color: #75A4CC; cursor: pointer;" onclick="open_modal_lihat_detail(this)" data-id='.$i.'>Detail</text>
                                ';
                        }
                    ),
                );


                $id = $this->session->userdata('iduser');
                $joinQuery = "FROM `{$table}` AS `c` JOIN `transaksi_detail` AS `cn` ON (`cn`.`idtrans` = `c`.`trans_detail_code`)";
                $extraCondition = "`c`.`user_created`='".$id."'";

            }

            // My SQL connection information
            $sql_details = array(
                'user' => 'root',
                'pass' => '',
                'db' => 'klikmbc',
                'host' => 'localhost'
            );

            echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraCondition)
            );
        }
    }

    public function get_data_transaksi_where()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $lembaga_id = $this->session->userdata('lembaga_id');

            $this->load->library('ssp');

            $table = 'transaksi';

            $primaryKey = 'id';

            if($this->session->userdata('user_level') == 0){
                $columns = array(
                    array( 'db' => '`c`.`id`',
                        'dt' => 0,
                        'field' => 'id'
                    ),
                    array( 'db' => '`c`.`date_created`', 'dt' => 1,  'field' => 'date_created' ),
                    array( 'db' => '`c`.`user_created`', 'dt' => 2,  'field' => 'user_created' ),
                    array( 'db' => '`c`.`trans_code`', 'dt' => 3, 'field' => 'trans_code' ),
                    array( 'db' => '`cn`.`nopelanggan`', 'dt' => 4, 'field' => 'nopelanggan'),
                    array( 'db' => '`c`.`sn`', 'dt' => 5, 'field' => 'sn' ),
                    array( 'db' => '`c`.`ref`', 'dt' => 6, 'field' => 'ref' ),
                    array( 'db' => '`c`.`status`',
                        'dt' => 7,
                        'field' => 'status',
                        'formatter' => function( $g ) {
                            if($g == '1'){
                                $status = 'Berhasil';
                            }else{
                                $status = 'Gagal';
                            }
                            return $status;
                        }
                    ),
                    array( 'db' => '`cn`.`nominal`',
                        'dt' => 8,
                        'field' => 'nominal',
                        'formatter' => function( $h ) {
                            $nominal = number_format($h, 0, ',', '.');
                            return $nominal;
                        }

                    ),
                    array( 'db' => '`c`.`trans_detail_code`',
                        'dt' => 9,
                        'field' => 'trans_detail_code',
                        'formatter' => function( $i ) {
                            return '
                                    <text style="color: #75A4CC; cursor: pointer;" onclick="open_modal_lihat_detail(this)" data-id='.$i.'>Detail</text>
                                ';
                        }
                    ),
                );

                $datestart = $this->input->get("datestart");
                $dateend = $this->input->get("dateend");
                $extraCondition = "(`c`.`date_created` between '".$datestart."' and '".$dateend."') AND `c`.`lembaga_id`='".$lembaga_id."'";

            }else{

                $columns = array(
                    array( 'db' => '`c`.`id`',
                        'dt' => 0,
                        'field' => 'id'
                    ),
                    array( 'db' => '`c`.`date_created`', 'dt' => 1,  'field' => 'date_created' ),
                    array( 'db' => '`c`.`trans_code`', 'dt' => 2, 'field' => 'trans_code' ),
                    array( 'db' => '`cn`.`nopelanggan`', 'dt' => 3, 'field' => 'nopelanggan'),
                    array( 'db' => '`c`.`sn`', 'dt' => 4, 'field' => 'sn' ),
                    array( 'db' => '`c`.`ref`', 'dt' => 5, 'field' => 'ref' ),
                    array( 'db' => '`c`.`status`',
                        'dt' => 6,
                        'field' => 'status',
                        'formatter' => function( $g ) {
                            if($g == '1'){
                                $status = 'Berhasil';
                            }else{
                                $status = 'Gagal';
                            }
                            return $status;
                        }
                    ),
                    array( 'db' => '`cn`.`nominal`',
                        'dt' => 7,
                        'field' => 'nominal',
                        'formatter' => function( $h ) {
                            $nominal = number_format($h, 0, ',', '.');
                            return $nominal;
                        }

                    ),
                    array( 'db' => '`c`.`trans_detail_code`',
                        'dt' => 8,
                        'field' => 'trans_detail_code',
                        'formatter' => function( $i ) {
                            return '
                                    <text style="color: #75A4CC; cursor: pointer;" onclick="open_modal_lihat_detail(this)" data-id='.$i.'>Detail</text>
                                ';
                        }
                    ),
                );

                $datestart = $this->input->get("datestart");
                $dateend = $this->input->get("dateend");
                $id = $this->session->userdata('iduser');
                $extraCondition = "`c`.`user_created`='".$id."' and `c`.`date_created` between '".$datestart."' and '".$dateend."'";
            }

            // My SQL connection information
            $sql_details = array(
                'user' => 'root',
                'pass' => '',
                'db' => 'klikmbc',
                'host' => 'localhost'
            );

            $joinQuery = "FROM `{$table}` AS `c` JOIN `transaksi_detail` AS `cn` ON (`cn`.`idtrans` = `c`.`trans_detail_code`)";

            echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraCondition)
            );
        }
    }

    public function transaksi()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{

            $data['jstransaksi_to_load']= 'js_transaksi.js';

            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);

            $id = $this->session->userdata('iduser');
            $lembaga_id = $this->session->userdata('lembaga_id');

            $user_level = $this->session->userdata('user_level');

            if($user_level == 0){

                $data['datasaldo'] = $this->cek_saldo_mobipay();

                if($this->input->get("start") == '') {

                    $data['datatotal'] = $this->M_transdetail->select_sum_nominal_admin();
                    $data['datajumlahberhasil'] = $this->M_transaksi->select_count_status_berhasil_admin($lembaga_id);
                    $data['datajumlahgagal'] = $this->M_transaksi->select_count_status_gagal_admin($lembaga_id);

                }else{

                    $start = $this->input->get("start");
                    $end = $this->input->get("end");

                    $splitstart = explode('/', $start);
                    $datestart= $splitstart[2].'-'.$splitstart[1].'-'.$splitstart[0].' 00:00:00';

                    $splitend = explode('/', $end);
                    $dateend= $splitend[2].'-'.$splitend[1].'-'.$splitend[0].' 23:59:59';

                    $data['datatotal'] = $this->M_transdetail->select_sum_nominal_where_admin($datestart,$dateend,$lembaga_id);
                    $data['datajumlahberhasil'] = $this->M_transaksi->select_count_status_berhasil_where_admin($datestart,$dateend,$lembaga_id);
                    $data['datajumlahgagal'] = $this->M_transaksi->select_count_status_gagal_where_admin($datestart,$dateend,$lembaga_id);

                }

            }else{

                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);

                if($this->input->get("start") == '') {

                    $data['datatotal'] = $this->M_transdetail->select_sum_nominal($id);
                    $data['datajumlahberhasil'] = $this->M_transaksi->select_count_status_berhasil($id);
                    $data['datajumlahgagal'] = $this->M_transaksi->select_count_status_gagal($id);

                }else{

                    $start = $this->input->get("start");
                    $end = $this->input->get("end");

                    $splitstart = explode('/', $start);
                    $datestart= $splitstart[2].'-'.$splitstart[1].'-'.$splitstart[0].' 00:00:00';

                    $splitend = explode('/', $end);
                    $dateend= $splitend[2].'-'.$splitend[1].'-'.$splitend[0].' 23:59:59';

                    $data['datatotal'] = $this->M_transdetail->select_sum_nominal_where($id,$datestart,$dateend);
                    $data['datajumlahberhasil'] = $this->M_transaksi->select_count_status_berhasil_where($id,$datestart,$dateend);
                    $data['datajumlahgagal'] = $this->M_transaksi->select_count_status_gagal_where($id,$datestart,$dateend);

                }

            }

            $this->load->view('layout/v_header',$data);
            $this->load->view('Laporan/transaksi',$data);
            $this->load->view('layout/v_footer',$data);
        }

    }

    public function lihatdetail()
    {
        $idtrx= $this->input->get('idtrx');

        $data = json_encode($this->M_transdetail->select_data_where_idtrx($idtrx));

        echo $data;

    }

    public function download_excel()
    {
        $id = $this->session->userdata('iduser');
        $user_level = $this->session->userdata('user_level');
        $lembaga_id = $this->session->userdata('lembaga_id');
        if($user_level == 0){

            if($this->input->get("start") == '') {

                $data['datatransaksi'] = $this->M_transaksi->load_data_join_detail_admin($lembaga_id);
                $datastartend = array();
                $data['datastartend']=$datastartend;
                $data['datatotal'] = $this->M_transdetail->select_sum_nominal_admin($lembaga_id);

            }else{

                $start = $this->input->get("start");
                $end = $this->input->get("end");

                $splitstart = explode('/', $start);
                $datestart= $splitstart[2].'-'.$splitstart[1].'-'.$splitstart[0].' 00:00:00';

                $splitend = explode('/', $end);
                $dateend= $splitend[2].'-'.$splitend[1].'-'.$splitend[0].' 23:59:59';

                $data['datatransaksi'] = $this->M_transaksi->load_data_join_detail_admin_where($datestart,$dateend,$lembaga_id);
                $datastartend = array(
                    'start' => $start,
                    'end' => $end,
                );
                $data['datastartend']=$datastartend;
                $data['datatotal'] = $this->M_transdetail->select_sum_nominal_where_admin($datestart,$dateend,$lembaga_id);

            }

        }else{

            if($this->input->get("start") == '') {

                $data['datatransaksi'] = $this->M_transaksi->load_data_join_detail($id);
                $datastartend = array();
                $data['datastartend']=$datastartend;
                $data['datatotal'] = $this->M_transdetail->select_sum_nominal($id);

            }else{

                $start = $this->input->get("start");
                $end = $this->input->get("end");

                $splitstart = explode('/', $start);
                $datestart= $splitstart[2].'-'.$splitstart[1].'-'.$splitstart[0].' 00:00:00';

                $splitend = explode('/', $end);
                $dateend= $splitend[2].'-'.$splitend[1].'-'.$splitend[0].' 23:59:59';

                $data['datatransaksi'] = $this->M_transaksi->load_data_join_detail_where($id,$datestart,$dateend);
                $datastartend = array(
                    'start' => $start,
                    'end' => $end,
                );
                $data['datastartend']=$datastartend;
                $data['datatotal'] = $this->M_transdetail->select_sum_nominal_where($id,$datestart,$dateend);


            }

        }

        $this->load->view('Laporan/transaksi_ex',$data);
    }

    public function topupsaldo()
    {
        if($this->session->userdata('status') == '') {
            $this->session->set_flashdata('belumlogin','Anda belum login');
            redirect(base_url());
        }else{
            $lembagaid = $this->session->userdata('lembaga_id');

            $data['js_to_load']= 'js_laporantopup.js';

            $data['data_lembaga'] = $this->M_login->get_datadomain($this->domain);
            $data['datatopup'] = $this->M_user_topup->load_data($lembagaid);

            $id = $this->session->userdata('iduser');
            $level = $this->session->userdata('user_level');
            if($level == 0){
                $data['datasaldo'] = $this->cek_saldo_mobipay();
            }else{
                $data['datasaldo'] = $this->M_user->load_data_user_whereid($id);
            }

            $this->load->view('layout/v_header',$data);
            $this->load->view('Laporan/topupsaldo',$data);
            $this->load->view('layout/v_footer',$data);
        }

    }

}