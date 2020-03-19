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
    public function getcluster()
    { //membuat input judul buku
        $inputidcluster = array(
            'type'             => 'text',
            'placeholder'    => 'ID Cluster',
            'class'            => 'form-control',
            'name'             => 'id_claster'
        );
        //author
        $inputcluster = array(
            'type'             => 'text',
            'placeholder'     => 'Cluster',
            'class'         => 'form-control',
            'name'             => 'claster'
        );
        //publisher
        $inputidperumahan = array(
            'type'             => 'text',
            'placeholder'     => 'ID Perumahan',
            'class'         => 'form-control',
            'name'             => 'id_perumahan'
        );
        $inputsubmit = array(
            'type'             => 'submit',
            'class'         => 'form-control btn btn-primary',
            'value'         => 'Simpan Data'
        );
        //di bawah kode untuk meng-generate formulirnya
        //diatas hanya arraynya saja
        $data['tagopen']    = form_open('Administrator/getcluster');
        $data['id_claster']        = form_input($inputidcluster);
        $data['claster']        = form_input($inputcluster);
        $data['id_perumahan']    = form_input($inputidperumahan);
        $data['submit']        = form_input($inputsubmit);
        $data['tagclose']    = form_close();

        // |_ dipanggil diview		|_ generate form

        $this->load->view('template/head');
        $this->load->view('template/administrator/header');
        $this->load->view('master/crud_cluster', $data);
        $this->load->view('template/administrator/footer');
        $this->load->view('template/foot');
    }
    public function simpan()
    {
        $idclu = $this->input->post('id_claster');
        $idperumah = $this->input->post('id_perumahan');
        $clu = $this->input->post('claster');
        //var baru  		//lihat aarray
        $arr = array(
            'id_claster'    => $idclu,
            'id_perumahan' => $idperumah,
            'claster' => $clu,
            //kiri diambil dari field DB
            //kanan diambil dari variabel diatas(sesuai form)
        );
        echo "done";
        $this->isi->simpandata($arr);
        redirect('Administrator/getcluster');
    }
    public function FunctionName()
    {

        $data['db_perum'] = $this->db->query('select perum.*, perumahan.nm_perumahan, claster.claster from perum inner join perumahan on perumahan.id_perumahan = perum.id_perumahan inner join claster on claster.id_claster = perum.id_claster')->result();
        $this->load->view('template/head');
        $this->load->view('template/administrator/header');
        $this->load->view('user/perum', $data);
        $this->load->view('template/administrator/footer');
        $this->load->view('template/foot');
    }
}
