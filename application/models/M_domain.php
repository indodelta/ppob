<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_domain extends CI_Model
{

    function load_data_domain()
    {
        $this->db->from('domain');
        $query = $this->db->get();
        return $query->result();
    }

}