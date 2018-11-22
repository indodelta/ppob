<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_user_topup extends CI_Model
{

    function simpan_data($data)
    {
        $simpan = $this->db->insert('t_user_topup',$data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    function update_data($where,$data) {
        $this->db->where($where);
        $update =$this->db->update('t_user_topup', $data);
        return $update;
    }

}