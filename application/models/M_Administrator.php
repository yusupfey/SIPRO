<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Administrator extends CI_Model
{
    public function hitungnotif()
    {
        $data = $this->db->query('select count(acc) as jml from notif where acc = 0');
        return $data->result();
    }
    public function getdata($table)
    {
        $data = $this->db->get($table);
        return $data->result();
    }
    public function updatedatanot($table, $data, $where)
    {
        return $this->db->query("update $table set acc = $data where icon ='$where'");
    }
}
