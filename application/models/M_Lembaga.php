<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Lembaga extends CI_Model
{
    function load_data_lembaga()
    {
        $this->db->from('lembaga');
        $query = $this->db->get();
        return $query->result();
    }

}