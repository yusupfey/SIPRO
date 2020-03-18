<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        // $this->load->model('Pegawai_model');
        if ($this->session->userdata('id_user') === null) redirect('login');
    }
    public function index()
    {
        $this->load->view('template/head');
        $this->load->view('template/administrator/header');
        $this->load->view('template/administrator/dasboard');
        $this->load->view('template/administrator/footer');
        $this->load->view('template/foot');
    }
    public function property()
    {
        $data['db_property'] = $this->db->get('rumah')->result();
        $this->load->view('template/head');
        $this->load->view('template/administrator/header');
        $this->load->view('user/property', $data);
        $this->load->view('template/administrator/footer');
        $this->load->view('template/foot');
    }
    public function getproperty()
    {
    }
    public function pengguna()
    {
        $data['db_user'] = $this->db->get('user')->result();
        $this->load->view('template/head');
        $this->load->view('template/administrator/header');
        $this->load->view('user/datauser', $data);
        $this->load->view('template/administrator/footer');
        $this->load->view('template/foot');
    }
    public function perum()
    {
        $data['db_perum'] = $this->db->query('select perum.*, perumahan.nm_perumahan, claster.claster from perum inner join perumahan on perumahan.id_perumahan = perum.id_perumahan inner join claster on claster.id_claster = perum.id_claster')->result();
        $this->load->view('template/head');
        $this->load->view('template/administrator/header');
        $this->load->view('user/perum', $data);
        $this->load->view('template/administrator/footer');
        $this->load->view('template/foot');
    }
    public function Lokasi()
    {
        $data['prov'] = $this->db->get('provinsi')->result();
        $data['kota'] = $this->db->query('select kota.*, provinsi.provinsi from provinsi inner join kota on kota.id_prov = provinsi.id_prov')->result();
        $this->load->view('template/head');
        $this->load->view('template/administrator/header');
        $this->load->view('master/lokasi', $data);
        $this->load->view('template/administrator/footer');
        $this->load->view('template/foot');
    }
    public function akses()
    {
        $data['prov'] = $this->db->get('akses')->result();
        // $data['kota'] = $this->db->query('select kota.*, provinsi.provinsi from provinsi inner join kota on kota.id_prov = provinsi.id_prov')->result();
        $this->load->view('template/head');
        $this->load->view('template/administrator/header');
        $this->load->view('master/akses', $data);
        $this->load->view('template/administrator/footer');
        $this->load->view('template/foot');
    }
    public function cluster()
    {
        // $data['prov'] = $this->db->get('cluster')->result();
        $data['cluster'] = $this->db->query('select claster.*, perumahan.nm_perumahan from claster inner join perumahan on perumahan.id_perumahan = claster.id_perumahan')->result();
        $this->load->view('template/head');
        $this->load->view('template/administrator/header');
        $this->load->view('master/cluster', $data);
        $this->load->view('template/administrator/footer');
        $this->load->view('template/foot');
    }
}
