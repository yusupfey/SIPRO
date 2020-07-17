<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Administrator extends CI_Model
{
    public function hitungnotifadmin()
    {
        $data = $this->db->query('select count(status) as jml from notif where status = 0 AND user_tujuan = ""');
        return $data->result();
    }
    public function countperum()
    {
        $data = $this->db->query('select count(id_perum) as jml from perum where kategori = "perum"');
        return $data->row_array();
    }
    public function countrumah()
    {
        $data = $this->db->query('select count(id_perum) as jml from perum where kategori = "rumah"');
        return $data->row_array();
    }
    public function countcluster()
    {
        $data = $this->db->query('select count(id_claster) as jml from claster');
        return $data->row_array();
    }
    public function countbooking()
    {
        $data = $this->db->query('select count(id_booking) as jml from booking');
        return $data->row_array();
    }
    public function hitungnotif()
    {
        $id = $this->session->userdata('id_user');

        $data = $this->db->query('select count(status) as jml from notif where status = 0 AND user_tujuan = "' . $id . '"');
        return $data->result();
    }
    public function notifpayment()
    {
        $data = $this->db->query('select count(status) as jml from payment where status = 1');
        return $data->result();
    }
    public function getdata($table)
    {
        $data = $this->db->get($table);
        return $data->result();
    }
    public function updatedatanot($table, $data, $where)
    {
        return $this->db->query("update $table set status = $data where icon ='$where'");
        // return $this->db->where('icon', $where);
        // return $this->db->query($table, $data);
    }

    public function getidAll($table, $field, $id)
    {
        // return $this->db->order_by('tgl', 'desc');
        return $this->db->get_where($table, [$field => $id])->result();
    }
    public function getid($table, $field, $id)
    {
        // return $this->db->order_by('tgl', 'desc');
        return $this->db->get_where($table, [$field => $id])->row_array();
    }
    public function deletdata($table, $where, $id)
    {
        $this->db->where($where, $id);
        $this->db->delete($table);
    }
    public function updatedata($table, $field, $where, $data)
    {
        $this->db->where($field, $where);
        $this->db->update($table, $data);
    }
    public function innerThreedata($id)
    {

        // $this->db->select('*');
        $this->db->select('perumahan.*');
        // $this->db->select('kota.*');
        // $this->db->select('provinsi.*');
        $this->db->from('perumahan');
        // var_dump($where);
        $this->db->join('user', 'user.id_user = perumahan.id_user');
        // $this->db->join('provinsi', 'provinsi.id_prov = perumahan.id_prov');
        // $this->db->join('kota', 'kota.id_kota = perumahan.id_kota');
        $this->db->where('perumahan.id_user', $id);
        return $this->db->get()->row_array();
    }
    public function innerPerumahan($id)
    {

        // $this->db->select('*');
        $this->db->select('perumahan.*');
        // $this->db->select('kota.*');
        // $this->db->select('provinsi.*');
        $this->db->from('perumahan');
        // var_dump($where);
        $this->db->join('user', 'user.id_user = perumahan.id_user');
        // $this->db->join('provinsi', 'provinsi.id_prov = perumahan.id_prov');
        // $this->db->join('kota', 'kota.id_kota = perumahan.id_kota');
        $this->db->where('perumahan.id_perumahan', $id);
        return $this->db->get()->row_array();
    }
    public function insertdata($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function getperum()
    {
        // $this->db->select($select1);
        // $this->db->select($select2);
        // $this->db->from($from);
        // $this->db->join('user', 'user.id_user = perumahan.id_user', 'left');
        // $this->db->join('provinsi', 'provinsi.id_prov = perumahan.id_prov', 'left');
        // $this->db->join('kota', 'kota.id_kota = perumahan.id_kota', 'left');
        // return $this->db->get()->result()
        // var_dump($query);

        return $this->db->query('select perumahan.id_perumahan,perumahan.nm_perumahan,user.nama,perumahan.id_prov,perumahan.id_kota, perumahan.alamat_lengkap from perumahan inner join user on perumahan.id_user=user.id_user')->result();
    }
}
