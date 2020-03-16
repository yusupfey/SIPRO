<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        // $this->load->model('Pegawai_model');
        // if ($this->session->userdata('id_pegawai') === null) redirect('login');
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
    public function user()
    {
        $data['db_user'] = $this->db->get('user')->result();
        $this->load->view('template/head');
        $this->load->view('template/administrator/header');
        $this->load->view('user/datauser', $data);
        $this->load->view('template/administrator/footer');
        $this->load->view('template/foot');
    }
}
