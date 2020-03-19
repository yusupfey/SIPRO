<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Home extends CI_Model
{
    public function inputdata($table, $data)
    {
        return $this->db->insert($table, $data);
    }
}
