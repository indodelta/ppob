<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class M_transaksi extends CI_Model
{

    function simpan_data($data)
    {
        $simpan = $this->db->insert('transaksi',$data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    function select_count_status_berhasil_admin($lembaga_id)
    {
        $this->db->from('transaksi');
        $this->db->where('status = 1');
        $this->db->where('lembaga_id = '.$lembaga_id);
        $count = $this->db->count_all_results();
        return $count;
    }

    function select_count_status_gagal_admin($lembaga_id)
    {
        $this->db->from('transaksi');
        $this->db->where('status = 0');
        $this->db->where('lembaga_id = '.$lembaga_id);
        $count = $this->db->count_all_results();
        return $count;
    }

    function select_count_status_berhasil($iduser)
    {
        $this->db->from('transaksi');
        $this->db->where('user_created =', $iduser);
        $this->db->where('status = 1');
        $count = $this->db->count_all_results();
        return $count;
    }

    function select_count_status_gagal($iduser)
    {
        $this->db->from('transaksi');
        $this->db->where('user_created =', $iduser);
        $this->db->where('status = 0');
        $count = $this->db->count_all_results();
        return $count;
    }

    function select_count_status_berhasil_where_admin($datestart,$dateend,$lembaga_id)
    {
        $this->db->from('transaksi');
        $this->db->where('date_created >=', $datestart);
        $this->db->where('date_created <=', $dateend);
        $this->db->where('lembaga_id = '.$lembaga_id);
        $this->db->where('status = 1');
        $count = $this->db->count_all_results();
        return $count;
    }

    function select_count_status_gagal_where_admin($datestart,$dateend,$lembaga_id)
    {
        $this->db->from('transaksi');
        $this->db->where('date_created >=', $datestart);
        $this->db->where('date_created <=', $dateend);
        $this->db->where('lembaga_id = '.$lembaga_id);
        $this->db->where('status = 0');
        $count = $this->db->count_all_results();
        return $count;
    }

    function select_count_status_berhasil_where($iduser,$datestart,$dateend,$lembaga_id)
    {
        $this->db->from('transaksi');
        $this->db->where('user_created =', $iduser);
        $this->db->where('date_created >=', $datestart);
        $this->db->where('date_created <=', $dateend);
        $this->db->where('lembaga_id = '.$lembaga_id);
        $this->db->where('status = 1');
        $count = $this->db->count_all_results();
        return $count;
    }

    function select_count_status_gagal_where($iduser,$datestart,$dateend)
    {
        $this->db->from('transaksi');
        $this->db->where('user_created =', $iduser);
        $this->db->where('date_created >=', $datestart);
        $this->db->where('date_created <=', $dateend);
        $this->db->where('status = 0');
        $count = $this->db->count_all_results();
        return $count;
    }

    function load_data_join_detail_admin($lembaga_id)
    {
        $this->db->select('transaksi.id,
                           transaksi.date_created,
                           transaksi.user_created,
                           transaksi.trans_code,
                           transaksi_detail.nopelanggan,
                           transaksi.sn,
                           transaksi.ref,
                           transaksi.status,
                           transaksi_detail.nominal');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail', 'transaksi_detail.idtrans = transaksi.trans_detail_code');
        $this->db->where('lembaga_id = '.$lembaga_id);
        $this->db->order_by('transaksi.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function load_data_join_detail_admin_where($datestart,$dateend,$lembaga_id)
    {
        $this->db->select('transaksi.id,
                           transaksi.date_created,
                           transaksi.trans_code,
                           transaksi_detail.nopelanggan,
                           transaksi.sn,
                           transaksi.ref,
                           transaksi.status,
                           transaksi_detail.nominal');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail', 'transaksi_detail.idtrans = transaksi.trans_detail_code');
        $this->db->where('date_created >=', $datestart);
        $this->db->where('date_created <=', $dateend);
        $this->db->where('lembaga_id = '.$lembaga_id);
        $this->db->order_by('transaksi.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function load_data_join_detail($id)
    {
        $this->db->select('transaksi.id,
                           transaksi.date_created,
                           transaksi.trans_code,
                           transaksi_detail.nopelanggan,
                           transaksi.sn,
                           transaksi.ref,
                           transaksi.status,
                           transaksi_detail.nominal');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail', 'transaksi_detail.idtrans = transaksi.trans_detail_code');
        $this->db->where('user_created', $id);
        $this->db->order_by('transaksi.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function load_data_join_detail_where($id,$datestart,$dateend)
    {
        $this->db->select('transaksi.id,
                           transaksi.date_created,
                           transaksi.trans_code,
                           transaksi_detail.nopelanggan,
                           transaksi.sn,
                           transaksi.ref,
                           transaksi.status,
                           transaksi_detail.nominal');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail', 'transaksi_detail.idtrans = transaksi.trans_detail_code');
        $this->db->where('user_created', $id);
        $this->db->where('date_created >=', $datestart);
        $this->db->where('date_created <=', $dateend);
        $this->db->order_by('transaksi.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function select_count_transaction_today($where)
    {
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d ');

        $this->db->from('transaksi');
        $this->db->where($where);
        $this->db->where('DATE(date_created)',$curr_date);
        $count = $this->db->count_all_results();
        return $count;
    }

    function select_count_transaction_monthly($where)
    {
        $date = new DateTime("now");
        $curr_month = $date->format('m');
        $curr_year = $date->format('Y');

        $this->db->from('transaksi');
        $this->db->where($where);
        $this->db->where('MONTH(date_created)',$curr_month);
        $this->db->where('YEAR(date_created)',$curr_year);
        $count = $this->db->count_all_results();
        return $count;
    }

}