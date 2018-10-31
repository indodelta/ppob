<?php

class M_kereta extends CI_Model
{
    function simpandata($table,$data)
    {
        $simpan = $this->db->insert($table, $data);
        return $simpan;
    }

    function simpandataandgetid($table,$data)
    {
        $simpan = $this->db->insert($table, $data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    function selectlastrow($col, $table)
    {
        $last_row = $this->db->order_by($col,"desc")->limit(1)->get($table)->row();
        return $last_row;
    }

    function loaddatatranswhere($id)
    {
        $this->db->select('trans_kereta.contact_name,
                           trans_kereta_detail.bookingCode, 
                           trans_kereta_detail.st_from, 
                           trans_kereta_detail.st_to, 
                           trans_kereta_detail.train_name');
        $this->db->from('trans_kereta');
        $this->db->join('trans_kereta_detail', 'trans_kereta_detail.trans_id = trans_kereta.id');
        $this->db->where('trans_kereta.id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function update_data_transkeretadetail($where,$data) {
        $this->db->where($where);
        $update =$this->db->update('trans_kereta_detail', $data);
        return $update;
    }
}