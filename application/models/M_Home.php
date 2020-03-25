<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Home extends CI_Model
{
    public function inputdata($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function getid($table, $field, $id)
    {
        return $this->db->get_where($table, [$field => $id])->row_array();
    }
    public function getdata($table)
    {
        return $this->db->get($table)->result();
    }
    public function jointree()
    {
        $this->db->select('perumahan.*');
        $this->db->select('provinsi.*');
        $this->db->select('kota.*');
        $this->db->select('perum.*');
        $this->db->select('claster.*');
        $this->db->from('perum');
        $this->db->join('perumahan', 'perumahan.id_perumahan=perum.id_perumahan');
        $this->db->join('provinsi', 'provinsi.id_prov=perumahan.id_prov');
        $this->db->join('kota', 'kota.id_kota=perumahan.id_kota');
        $this->db->join('claster', 'claster.id_claster=perum.id_claster');
        return $this->db->get();
    }
    public function jointreeid($id)
    {
        $this->db->select('perumahan.*');
        $this->db->select('provinsi.*');
        $this->db->select('kota.*');
        $this->db->select('perum.*');
        $this->db->select('claster.*');
        $this->db->select('user.*');
        $this->db->from('perum');
        $this->db->join('perumahan', 'perumahan.id_perumahan=perum.id_perumahan');
        $this->db->join('provinsi', 'provinsi.id_prov=perumahan.id_prov');
        $this->db->join('kota', 'kota.id_kota=perumahan.id_kota');
        $this->db->join('claster', 'claster.id_claster=perum.id_claster');
        $this->db->join('user', 'user.id_user=perumahan.id_user');
        $this->db->where('id_perum', $id);
        return $this->db->get();
    }
}
