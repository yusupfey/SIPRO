<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model('M_Administrator');
        if ($this->session->userdata('id_user') === null) redirect('login');
    }
    public function index()
    {
        $this->HalamanAdmin('template/administrator/dasboard');
    }
    public function Property()
    {
        $data['db_property'] = $this->db->get('rumah')->result();
        $this->HalamanAdmin('user/property', $data);
    }
    public function pengguna()
    {
        $data['db_user'] = $this->db->get('user')->result();
        $this->HalamanAdmin('user/datauser', $data);
    }
    public function lokasi()
    {
        $data['prov'] = $this->db->get('provinsi')->result();
        $data['kota'] = $this->db->query('select kota.*, provinsi.provinsi from kota inner join provinsi on provinsi.id_prov = kota.id_prov')->result();
        $this->HalamanAdmin('master/lokasi', $data);
    }
    public function akses()
    {
        $data['prov'] = $this->db->get('akses')->result();
        $this->HalamanAdmin('master/akses', $data);
    }
    public function cluster()
    {
        $data['cluster'] = $this->db->query('select claster.*, perumahan.nm_perumahan from claster inner join perumahan on perumahan.id_perumahan = claster.id_perumahan')->result();

        $this->HalamanAdmin('master/cluster', $data);
    }
}
