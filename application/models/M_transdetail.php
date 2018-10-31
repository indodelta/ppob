<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_transdetail extends CI_Model
{

    function simpan_data($data)
    {
        $simpan = $this->db->insert('transaksi_detail',$data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    function select_sum_nominal_admin()
    {
        $this->db->select_sum('nominal');
        $this->db->from('transaksi_detail');
        $query = $this->db->get();
        return $query->result();
    }

    function select_sum_nominal_where_admin($datestart,$dateend)
    {
        $this->db->select_sum('nominal');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail', 'transaksi_detail.idtrans = transaksi.trans_detail_code');
        $this->db->where('date_created >=', $datestart);
        $this->db->where('date_created <=', $dateend);
        $query = $this->db->get();
        return $query->result();
    }

    function select_sum_nominal($iduser)
    {
        $this->db->select_sum('nominal');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail', 'transaksi_detail.idtrans = transaksi.trans_detail_code');
        $this->db->where('user_created =', $iduser);
        $query = $this->db->get();
        return $query->result();
    }

    function select_sum_nominal_where($iduser,$datestart,$dateend)
    {
        $this->db->select_sum('nominal');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail', 'transaksi_detail.idtrans = transaksi.trans_detail_code');
        $this->db->where('user_created =', $iduser);
        $this->db->where('date_created >=', $datestart);
        $this->db->where('date_created <=', $dateend);
        $query = $this->db->get();
        return $query->result();
    }

    function select_data_where_idtrx($idtrx)
    {
        $this->db->from('transaksi_detail');
        $this->db->where('idtrans =', $idtrx);
        $query = $this->db->get();
        return $query->result();
    }

}