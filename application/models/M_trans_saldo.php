<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_trans_saldo extends CI_Model
{
    function simpan_data($data)
    {
        $simpan = $this->db->insert('trans_saldo',$data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    function load_data($lembagaid)
    {
        $this->db->from('trans_saldo');
        $this->db->where('lembaga_id', $lembagaid);
        $query = $this->db->get();
        return $query->result();
    }

    function load_data_whereid($id)
    {
        $this->db->from('trans_saldo');
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function jumlah_konfirmasi($lembagaid)
    {
        $this->db->from('trans_saldo');
        $this->db->where('lembaga_id', $lembagaid);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query;
    }

    function update_data($where,$data) {
        $this->db->where($where);
        $update =$this->db->update('trans_saldo', $data);
        return $update;
    }

}