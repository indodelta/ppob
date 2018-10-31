<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model
{
    function load_data_user()
    {
        $this->db->from('user');
        $query = $this->db->get();
        return $query->result();
    }

    function load_data_user_whereid($id)
    {
        $this->db->from('user');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function simpan_data($data)
    {
        $simpan = $this->db->insert('user',$data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    function cek_user($where)
    {
        return $this->db->get_where('user',$where);
    }

    function update_data($where,$data) {
        $this->db->where($where);
        $update =$this->db->update('user', $data);
        return $update;
    }

    function hapus_data($id)
    {
        $this->db->where('id', $id);
        $hapus = $this->db->delete('user');
        return $hapus;
    }
}