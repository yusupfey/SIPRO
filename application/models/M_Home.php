<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Home extends CI_Model
{
    public function inputdata($table, $data)
    {
        return $this->db->insert($table, $data);
    }
    public function updatedata($table, $field, $where, $data)
    {
        $this->db->where($field, $where);
        $this->db->update($table, $data);
    }
    public function getid($table, $field, $id)
    {
        return $this->db->get_where($table, [$field => $id])->row_array();
    }
    public function getidall($table, $field, $id)
    {
        return $this->db->get_where($table, [$field => $id])->result();
    }
    public function getdata($table)
    {
        return $this->db->get($table)->result();
    }
    public function deletedata($table, $field, $where)
    {
        $this->db->where($field, $where);
        $this->db->delete($table);
    }
    public function innerperum()
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
        $this->db->select('perumahan.nm_perumahan,perumahan.titik_coridinat');
        $this->db->select('provinsi.provinsi');
        $this->db->select('kota.kota');
        $this->db->select('perum.*');
        $this->db->select('claster.claster');
        $this->db->select('user.nama');
        $this->db->from('perum');
        $this->db->join('perumahan', 'perumahan.id_perumahan=perum.id_perumahan');
        $this->db->join('provinsi', 'provinsi.id_prov=perumahan.id_prov');
        $this->db->join('kota', 'kota.id_kota=perumahan.id_kota');
        $this->db->join('claster', 'claster.id_claster=perum.id_claster');
        $this->db->join('user', 'user.id_user=perumahan.id_user');
        $this->db->where('perum.id_perum ="' . $id . '"');
        return $this->db->get();
        // return $this->db->query("SELECT `perumahan`.*, `provinsi`.*, `kota`.*, `perum`.*, `claster`.*, `user`.* FROM `perum` JOIN `perumahan` ON `perumahan`.`id_perumahan`=`perum`.`id_perumahan` JOIN `provinsi` ON `provinsi`.`id_prov`=`perumahan`.`id_prov` JOIN `kota` ON `kota`.`id_kota`=`perumahan`.`id_kota` JOIN `claster` ON `claster`.`id_claster`=`perum`.`id_claster` JOIN `user` ON `user`.`id_user`=`perumahan`.`id_user` WHERE `perum`.`id_perum` = '$id' ");
        // echo $id;
    }
    public function innerperumgetlocation($prov, $kota)
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
        $this->db->where('provinsi.id_prov', $prov);
        $this->db->where('kota.id_kota', $kota);
        return $this->db->get();
    }
    public function getcart($t)
    {
        $id = $this->session->userdata('id_user');
        return $this->db->query('select booking.*, claster.claster, perum.*,user.nama from booking left join perum on perum.id_perum=booking.id left join claster on claster.id_claster=perum.id_claster left join user on user.id_user=perum.id_user where booking.user="' . $id . '"');
        // return $this->db->get();
    }
    public function getrumah($t)
    {
        $id = $this->session->userdata('id_user');
        return $this->db->query('select booking.*, rumah.* from booking inner join rumah on rumah.id_rumah=booking.id where booking.user="' . $id . '" AND booking.id="' . $t . '"');
        // return $this->db->get();
    }
    public function hitungcart()
    {
        $id = $this->session->userdata('id_user');
        return $this->db->query('select count(user) as booking from booking where user="' . $id . '"')->result();
    }
}
