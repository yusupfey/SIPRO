<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Administrator extends CI_Model
{
    public function hitungnotif()
    {
        $data = $this->db->query('select count(acc) as jml from notif where acc = 0');
        return $data->result();
    }
}
