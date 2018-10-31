<?php

class M_login extends CI_Model
{

    function cek_login($table,$where)
    {
        return $this->db->get_where($table,$where);
    }

    function viewdata($table,$where)
    {
        $q = $this->db->get_where($table,$where);
        return $q->result();

    }

    function get_datadomain($domain) {
        $sql = "select id, nama, logo, css, warna from lembaga where surl = ? ";
        $query = $this->db->query($sql,array($domain));
        return $query->result_array();
    }

}