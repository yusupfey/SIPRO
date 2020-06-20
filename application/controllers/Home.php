<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model('M_Home');
        // if ($this->session->userdata('id_user') === null) redirect('login');
    }
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->model('M_Home');
        // $data['prov'] = $this->M_Home->getdata('provinsi');
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/provinsi/';
        $readApi = file_get_contents($url);
        $proapi = json_decode($readApi, true);

        // $api = $proapi['rajaongkir'];
        // $data['apiProv'] = $api['results'];
        // var_dump($api['results']);
        // print_r($api['results']);
        // foreach ($api['results'] as $apey) :
        //     print_r($apey['province']);
        // endforeach;
        $data['apiProv'] = $proapi['provinsi'];


        $data['bispat'] = $this->db->get('perumahan')->result();
        $this->HalamanHome('template/nav-front/content', $data);
    }
    public function About()
    {
        $this->HalamanHome('template/nav-front/about.php');
    }
    public function Getdatabyajax()
    {
        $this->load->model('M_Home');

        $kode = $this->input->post('provinsi');
        // $data['dt'] = $this->M_Home->getid($table, 'id_prov', $kode);
        // // var_dump($data['dt']);
        // // var_dump($kode);
        // echo $kode;
        $toprint = '';
        // $prov = $this->M_Home->getid($table, 'id_prov', $kode);
        // var_dump($prov);
        // if ($prov['id_prov'] == 0) {
        //     foreach ($data['dt'] as $v) {
        //         $toprint = $toprint . '<option value="' . $v->id_kota . '">' . $v->kota . '</option>';
        //     }
        // } else {
        //     $toprint = $toprint . '<option value="' . $prov['id_kota'] . '">' . $prov['kota'] . '</option>';
        // }
        // echo $toprint;
        $url = "https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=$kode";
        // print_r($url);
        $readApi = file_get_contents($url);
        $proapi = json_decode($readApi, true);

        $api = $proapi['kota_kabupaten'];
        // // $data['apiProv'] = $api['results'];
        // // foreach ($api['results'] as $p) {
        // print_r($proapi['kota_kabupaten']);
        // }
        // if ($prov['id_prov'] == 0) {
        foreach ($api as $p) {
            //     // if ($p['city_name'] == 0) {
            $toprint = $toprint . '<option value="' . $p['id'] . '">' . $p['nama'] . '</option>';
            //     // }
        }
        // } else {
        //     $toprint = $toprint . '<option value="' . $prov['id_kota'] . '">' . $prov['kota'] . '</option>';
        // }
        echo $toprint;
    }
    public function profil()
    {
        $id = $this->session->userdata('id_user');
        $data['user'] = $this->db->get_where('user', ['id_user' => $id])->row_array();
        // $data['sidebar'] = $this->load->view('template/nav-front/sidebar');
        $this->Halamanprofil('user/profil', $data);
    }
    public function RequestPerum()
    {
        $id = $this->session->userdata('id_user');
        $pay = $this->db->get_where('payment', ['id_user' => $id])->row_array();
        if ($pay['id_user'] != $id && $pay['status'] == 0) {
            $data = $this->db->get_where('user', ['id_user' => $id])->result();
            foreach ($data as $t) {
                $p = $t->nama;
                $e = $t->email;
                $n = $t->notel;
            }
            // $id = $this->session->userdata('id_user');
            // $data['user'] = $this->db->get_where('user', ['id_user' => $id])->result();
            // $data['sidebar'] = $this->load->view('template/nav-front/sidebar');
            $id = [
                'type' => 'hidden',
                'name' => 'id',
                'class' => 'form-control',
                'READONLY' => TRUE,
                'value' => $id,
            ];
            $nama = [
                'type' => 'text',
                'name' => 'nama',
                'class' => 'form-control',
                'READONLY' => TRUE,
                'value' => $p,
            ];
            $email = [
                'type' => 'text',
                'name' => 'email',
                'class' => 'form-control',
                'READONLY' => TRUE,
                'value' => $e,
            ];
            $perum = [
                'type' => 'text',
                'name' => 'Nama Perumahan',
                'class' => 'form-control',
            ];
            $upload = [
                'type' => 'text',
                'name' => 'Nama Perumahan',
                'class' => 'form-control',
            ];
            $form['id'] = form_input($id);
            $form['nama'] = form_input($nama);
            $form['perum'] = form_input($perum);
            $form['email'] = form_input($email);
            $form['pic'] = form_input($upload);
            $this->Halamanprofil('user/Request_perum', $form);
        } else if ($pay['id_user'] == $id && $pay['status'] == 1) {
            $this->Halamanprofil('template/nav-front/halporses');
        } else {
            redirect('Home/payment');
        }
    }
    public function payment()
    {
        $upload = [
            'type' => 'file',
            'name' => 'foto',
            'class' => 'form-control',
        ];
        $form['upload'] = form_upload($upload);
        $this->Halamanprofil('user/payment', $form);
    }
    public function detail($id)
    {
        $data['rumah'] = $this->M_Home->getid('perum', 'id_perum', $id);
        // var_dump($data['rumah']);

        $this->HalamanHome('template/nav-front/detail_rumah', $data);
    }
    public function detail_perumahan($id)
    {
        $data['perum'] = $this->M_Home->jointreeid($id)->row_array();
        // print_r($data['perum']);
        $link = [
            'link' => 'Home/detail_perumahan/' . $id . ''
        ];
        $this->session->set_userdata($link);
        $this->HalamanHome('template/nav-front/detail_perum', $data);
    }
    public function katalog()
    {
        $data['db_property'] = $this->M_Home->innerRumah()->result();
        $data['perumahan'] = $this->M_Home->innerperum()->result();
        // var_dump($data['perumahan']);
        $this->HalamanHome('template/nav-front/katalog', $data);
    }
    /**
     * 
     * 
     * 
     * menampilkan data booking di profil
     * 
     * 
     * */
    public function Mybooking()
    {
        // $data['rumah'] = $this->M_Home->getid('rumah', 'id_rumah', $id);
        error_reporting(0);
        $id = $this->session->userdata('id_user');
        if ($id != "") {
            $data['cart'] = $this->M_Home->hitungcart();
            $oop = $this->M_Home->getidall('booking', 'user', $id);
            foreach ($oop as $t) :
                $get = $t->id;
                $data['bookcart'] = $this->M_Home->getcart($get)->result();
            endforeach;
        }
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            redirect('Dashboard/Mybooking', $data);
        } else {

            $this->Halamanprofil('user/booking', $data);
        }
    }
    /**
     * 
     * 
     * cek perumahan kita yang sudah di boking
     * 
     * 
     */
    public function CekPenjualan()
    {
        $id = $this->session->userdata('id_user');
        // $data['databook'] = $this->db->query('select booking.user, perum.*, user.nama, perumahan.nm_perumahan,claster.claster from booking right join perum on perum.id_perum = booking.id right join user on user.id_user=booking.user right join perumahan on perumahan.id_perumahan=perum.id_perumahan right join claster on claster.id_claster = perum.id_claster where booking.user ="' . $id . '" AND perum.status=1')->result();
        $data['databook'] = $this->db->query('select booking.*, perum.*, user.nama, perumahan.nm_perumahan,claster.claster from perum inner join booking on perum.id_perum = booking.id inner join user on user.id_user=booking.user left join perumahan on perumahan.id_perumahan=perum.id_perumahan left join claster on claster.id_claster = perum.id_claster where perum.id_user ="' . $id . '"')->result();
        print_r($data['databook']);
        $this->Halamanprofil('template/nav-front/receive-boking', $data);
    }
    /**
     * 
     * 
     * 
     * home data rumah per user
     * 
     * 
     * 
     * */
    public function rumah()
    {
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            $data['db_property'] = $this->db->get_where('perum', ['kategori' => 'Rumah'])->result();
            $this->Halamanprofil('Dashboard/Property', $data);
        }
        $data['db_property'] = $this->db->get_where('perum', ['id_user' => $this->session->userdata('id_user')])->result();
        $this->Halamanprofil('user/property', $data);
    }
    public function showrumah()
    {
        $data['db_property'] = $this->db->get_where('perum', ['id_user' => $this->session->userdata('id_user')])->result();
    }



    public function detailperumahan($id)
    {
        $data['perum'] = $this->M_Home->jointreeid($id)->row_array();
        // print_r($data['perum']);
        $this->load->view('user/detailperum', $data);
    }
    public function detailrumah($id)
    {
        $data['perum'] = $this->db->query('select perum.*, user.nama from perum inner join user on user.id_user=perum.id_user where perum.id_perum="' . $id . '"')->row_array();
        // var_dump($data['rumah']);

        $this->load->view('user/detailrumah', $data);
    }

    // halaman notifikasi user di home
    public function notification()
    {
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            redirect('Dashboarad/notification');
        } else {
            $id = $this->session->userdata('id_user');
            $data['not'] = $this->M_Home->getidAll('notif', 'user_tujuan', $id);
            $up = ['status' => 1];
            $this->M_Home->updatedata('notif', 'user_tujuan', $id, $up);
            $this->Halamanprofil('template/nav-front/notif', $data);
        }
    }
}
