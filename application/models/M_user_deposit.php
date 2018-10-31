<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_user_deposit extends CI_Model
{
    function simpan_data($data)
    {
        $simpan = $this->db->insert('t_user_deposit',$data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    function load_data()
    {
        $this->db->from('t_user_deposit');
        $query = $this->db->get();
        return $query->result();
    }

    function load_data_whereiduser($id)
    {
        $this->db->from('t_user_deposit');
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->result();
    }


}