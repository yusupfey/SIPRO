<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Act extends My_Controller
{

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
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Home');
        // if ($this->session->userdata('id_pegawai') === null) redirect('login');
    }
    public function index()
    {
    }
    public function Actregis()
    {
        $this->form_validation->set_rules('nama', 'Username', 'required|trim', ['required' => 'Username tidak boleh kosong !']);
        // $this->form_validation->set_rules('alamat', 'Alamat', 'required', ['required' => 'Alamat tidak boleh kosong !']);
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password-awal', 'Password', 'required|trim|matches[password]', ['required' => 'Password tidak boleh kosong !', 'matches' => 'Password tidak sama']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|matches[password-awal]', ['required' => 'Password tidak boleh kosong !', 'matches' => 'Password tidak sama']);
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Halaman Register';

            $this->HalamanHome('register', $data);
        } else {
            // ini adalah kode untuk acak nomber
            $getcode = $this->db->query('Select max(id_user) as maxKode FROM user')->row_array();
            $no_urut = (int) substr($getcode['maxKode'], 1, 3);
            $no_urut++;
            $kode = 'U' . sprintf("%03s", $no_urut);
            $iduser = $kode;
            $email = $this->input->post('email');
            $pass = $this->input->post('password');
            $this->db->query("Insert into user (id_user,email) values ('$iduser','$email')");
            $password = md5($pass);
            $log_user = [
                'id_user' => $kode,
                'username' => $this->input->post('nama'),
                'password' => $password,
                'id_akses' => 2,
                'status' => 1,
            ];
            $this->db->insert('log_user', $log_user);

            redirect('Login/formlogin');
        }
    }
    public function logout()
    {
        // $this->session->unset('id_user');
        // $this->session->unset('username');
        // $this->session->unset('id_akses');
        session_destroy();
        redirect('Home');
    }
    public function Editprofil()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required', ['required' => 'Nama harus diisi!']);
        $this->form_validation->set_rules('notel', 'Telepon', 'required', ['required' => 'Telepone harus diisi!']);
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', ['required' => 'Alamat tidak boleh kosong !']);


        if ($this->form_validation->run() == FALSE) {
            $id = $this->session->userdata('id_user');
            $data['user'] = $this->db->get_where('user', ['id_user' => $id])->result();
            $data['judul'] = 'Halaman Profil';
            $this->HalamanHome('user/profil', $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama', true),
                'notel' => $this->input->post('notel', true),
                'email' => $this->input->post('email', true),
                'alamat' => $this->input->post('alamat', true),
            ];
            $id = $this->session->userdata('id_user');
            $this->db->where('id_user', $id);
            $this->db->update('user', $data);
            $this->session->set_flashdata('true', '<div class="alert alert-danger" role="alert">Diupdate</div>');
            redirect('Home/profil');
        }
    }
    public function isnotlogin()
    {
        return $this->session->userdata('id_user') === null;
    }
    //untuk notifikasi
    public function req()
    {
        $tgl = date('Y-m-d');
        $data = [
            'id_user' => $this->input->post('id'),
            'requerst' => "Permintaan Akses Untuk Jual Perumahan",
            'tgl' => $tgl,
            'icon' => 'fa-bell',
            'url' => 'Dashboard/notification',
            'status' => 0,
        ];
        // $this->load->model('M_Home');
        $this->M_Home->inputdata('notif', $data);
        $payment = [
            'id_user' => $this->input->post('id'),
            'id_paket' => $this->input->post('paket'),
            'pic' => '',
            'status' => 0,
        ];
        $this->M_Home->inputdata('payment', $payment);
        redirect('Home/payment');
    }
    //action upload kirim struck
    public function buy()
    {
        $tgl = date('Y-m-d');
        $id = $this->session->userdata('id_user');

        $not = [
            'id_user' => $id,
            'requerst' => "Telah mengirim struck pemesanan",
            'tgl' => $tgl,
            'icon' => 'fa-donate',
            'url' => 'Dashboard/pemesanan',
            'status' => 0,
        ];
        // $this->load->model('M_Home');

        // $foto = $this-['foto'];
        // $foto = $this->input->post('foto');

        $config['upload_path'] = './assets/img-struck'; //,menentukan foldernya
        $config['allowed_types'] = 'png|jpg|jpeg'; //memnentukan format
        $config['max_size'] = 1000; //untuk ukuran
        $config['max_width'] = 1024; // untuk lebar foto
        $config['max_height'] = 786; // untuk tinggi foto
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);
        } else {
            $data = array('pic' => $this->upload->data('file_name'), 'tgl' => $tgl, 'status' => 1);
            $id = $this->session->userdata('id_user');
            // $qry = $this->M_Home->getid('payment', 'id_user', $id);
            // $qry[]
            $this->db->where('id_user', $id);
            $this->db->update('payment', $data);
            $this->M_Home->inputdata('notif', $not);
            $this->session->set_flashdata('proses', ' v class="alert alert-danger" role="alert">sedang dalam proses</div>');
            redirect("Home/RequestPerum");
        }
        // $data = [
        //     'pic' => $foto
        // ];
        // 

    }
    //pencarioan rumah berdasarkan propinsi dan kota
    public function search()
    {
        $this->form_validation->set_rules('provinsi', 'provinsi', 'required');
        $this->form_validation->set_rules('kota', 'kota', 'required');
        if ($this->form_validation->run() == false) {
            $data['prov'] = $this->M_Home->getdata('provinsi');
            $data['bispat'] = $this->db->get('perumahan')->result();
            $this->HalamanHome('template/nav-front/content', $data);
        } else {
            $prov = $this->input->post('provinsi');
            $kota = $this->input->post('kota');
            $data['perumahan'] = $this->M_Home->innerperumgetlocation($prov, $kota)->result();
            $data['db_property'] = $this->db->get_where('perum', ['kategori' => 'Rumah'])->result();
            // var_dump($data['perumahan']);
            $this->HalamanHome('template/nav-front/katalog', $data);
        }
        // var_dump($_POST);
    }

    //action booking
    public function booking($id)
    {
        if ($this->session->userdata('id_user') === null) redirect('login');
        $this->session->unset_userdata('link');
        $perum = $this->M_Home->getid('perum', 'id_perum', $id);
        $tgl = date('Y-m-d');
        // print_r($perum['id_user']);
        $notif = [
            'id_user' => $perum['id_user'],
            'requerst' => 'Booking Rumah',
            'icon' => 'fa fa-handshake',
            'url' => 'Act/ActBooking',
            'tgl' => $tgl,
            'status' => 0
        ];
        $userloged = $this->session->userdata('id_user');
        $this->M_Home->inputdata('notif', $notif);
        $booking = [
            'user' => $userloged,
            'id' => $id,
            'tgl' => $tgl,
        ];
        $this->M_Home->inputdata('booking', $booking);
        $ubasstatus = [
            'status' => 1
        ];
        $this->M_Home->updatedata('perum', 'id_perum', $id, $ubasstatus);
        redirect('Act/actBooking');
    }

    //kodisi untuk redirect boking
    public function actBooking()
    {
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            redirect('Dashboard');
        } else {
            redirect('Home/Mybooking');
        }
    }

    //kodisi untuk redirect boking
    // public function CekPenjualan()
    // {
    //     if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
    //         redirect('Dashboard/Booking');
    //     } else {
    //         redirect('Home/CekPenjualan');
    //     }
    // }

    /**
     * 
     * function untuk tambah rumah/perum
     * 
     */
    public function AddRumah()
    {
        $getcode = $this->db->query('Select max(id_perum) as maxKode FROM perum')->row_array();
        $no_urut = (int) substr($getcode['maxKode'], 3, 10);
        $no_urut++;
        $kode = 'PRH' . sprintf("%07s", $no_urut);
        $idperum = $kode;
        $iduser = $this->session->userdata('id_user');
        $id = [
            'type' => 'hidden',
            'name' => 'id',
            'class' => 'form-control',
            'value' => $idperum,
            'readonly' => true,
            'placeholder' => 'masukanid'
        ];
        $iduser = [
            'type' => 'hidden',
            'name' => 'id_user',
            'class' => 'form-control',
            'value' => $iduser,
            'readonly' => true,
            'placeholder' => 'masukanid'
        ];
        $type = [
            'type' => 'text',
            'name' => 'type',
            'class' => 'form-control',
            'placeholder' => 'Masukan Type Rumah',
            'autofocus' => true
        ];
        $ukrumah = [
            'type' => 'text',
            'name' => 'ukrumah',
            'class' => 'form-control',
            'placeholder' => 'Ukuran Rumah'
        ];
        $harga = [
            'type' => 'text',
            'name' => 'harga',
            'class' => 'form-control',
            'placeholder' => 'Harga'
        ];
        $cicilan = [
            'type' => 'text',
            'name' => 'cicilan',
            'class' => 'form-control',
            'placeholder' => 'Cicilan'
        ];
        $desk = [
            'name' => 'deskripsi',
            'class' => 'form-control'
        ];
        $alamat = [
            'name' => 'Alamat',
            'class' => 'form-control'
        ];
        $pic = [
            'name' => 'gambar',
            'class' => 'input-group'
        ];
        $btn = [
            'class' => 'form-control btn btn-success',
            'value' => "Tambah data"
        ];
        $form['title'] = "Tambah Rumah";
        $form['form_open'] = form_open_multipart('Act/ActAddRumah');
        $form['form_close'] = form_close();
        $form['idperum'] = form_input($id);
        $form['id_user'] = form_input($iduser);
        $form['type'] = form_input($type);
        $form['ukrumah'] = form_input($ukrumah);
        $form['harga'] = form_input($harga);
        $form['cicilan'] = form_input($cicilan);
        $form['desk'] = form_textarea($desk);
        $form['alamat'] = form_textarea($alamat);
        $form['pic'] = form_upload($pic);
        $form['btn'] = form_submit($btn);
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            $this->HalamanAdmin('form/vform', $form);
        } else {
            $this->Halamanprofil('form/vform', $form);
        }
    }
    public function UpdateRumah($id)
    {
        $t = $this->M_Home->getid('perum', 'id_perum', $id);
        $id = [
            'type' => 'hidden',
            'name' => 'id',
            'class' => 'form-control',
            'value' => $t['id_perum'],
            'readonly' => true,
            'placeholder' => 'masukanid'
        ];
        $iduser = [
            'type' => 'hidden',
            'name' => 'id_user',
            'class' => 'form-control',
            'value' => $t['id_user'],
            'readonly' => true,
            'placeholder' => 'masukanid'
        ];
        $type = [
            'type' => 'text',
            'name' => 'type',
            'class' => 'form-control',
            'placeholder' => 'Masukan Type Rumah',
            'value' => $t['type'],
            'autofocus' => true
        ];
        $ukrumah = [
            'type' => 'text',
            'name' => 'ukrumah',
            'class' => 'form-control',
            'value' => $t['uk_rumah'],
            'placeholder' => 'Ukuran Rumah'
        ];
        $harga = [
            'type' => 'text',
            'name' => 'harga',
            'class' => 'form-control',
            'value' => $t['harga'],
            'placeholder' => 'Harga'
        ];
        $cicilan = [
            'type' => 'text',
            'name' => 'cicilan',
            'class' => 'form-control',
            'value' => $t['cicilan'],
            'placeholder' => 'Cicilan'
        ];
        $desk = [
            'name' => 'deskripsi',
            'value' => $t['deskripsi'],
            'class' => 'form-control'
        ];
        $alamat = [
            'name' => 'Alamat',
            'value' => $t['alamat'],
            'class' => 'form-control'
        ];
        // $pic = [
        //     'name' => 'gambar',
        //     'class' => 'input-group'
        // ];
        $btn = [
            'class' => 'form-control btn btn-success',
            'value' => "Update data"
        ];
        $form['title'] = "Update Rumah";
        $form['form_open'] = form_open_multipart('Act/ActUpdateRumah');
        $form['form_close'] = form_close();
        $form['idperum'] = form_input($id);
        $form['id_user'] = form_input($iduser);
        $form['type'] = form_input($type);
        $form['ukrumah'] = form_input($ukrumah);
        $form['harga'] = form_input($harga);
        $form['cicilan'] = form_input($cicilan);
        $form['desk'] = form_textarea($desk);
        $form['alamat'] = form_textarea($alamat);
        // $form['pic'] = form_upload($pic);
        $form['btn'] = form_submit($btn);
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            $this->HalamanAdmin('form/vform', $form);
        } else {
            $this->Halamanprofil('form/vform', $form);
        }
    }
    public function ActAddRumah()
    {
        // $this->form_validation->set_rules('type', 'Type', 'required');
        // if ($this->form_validation->run() == false) {
        //     if ($this->session->userdata('id_akses') == 1 and $this->session->userdata('id_akses') == 3) {
        //         $this->HalamanAdmin('form/vform');
        //     } else {
        //         $this->Halamanprofil('form/vform', $form);
        //     }
        // }
        $config['upload_path'] = './assets/img'; //,menentukan foldernya
        $config['allowed_types'] = 'png|jpg|jpeg'; //memnentukan format
        $config['max_size'] = 1000; //untuk ukuran
        $config['max_width'] = 1024; // untuk lebar foto
        $config['max_height'] = 786; // untuk tinggi foto
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar')) {
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);
        } else {
            $data = [
                'id_perum' => $this->input->post('id'),
                'id_user' => $this->input->post('id_user'),
                'type' => $this->input->post('type'),
                'uk_rumah' => $this->input->post('ukrumah'),
                'harga' => $this->input->post('harga'),
                'cicilan' => $this->input->post('cicilan'),
                'deskripsi' => $this->input->post('deskripsi'),
                'alamat' => $this->input->post('Alamat'),
                'pic' => $this->upload->data('file_name'),
                'kategori' => 'Rumah',
                'status' => '0',
            ];
            // var_dump($data);
            $this->M_Home->inputdata('perum', $data);
            if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
                redirect('Dashboard/property');
            } else {
                redirect('Home/rumah');
            }
        }
    }
    public function ActUpdateRumah()
    {
        // $this->form_validation->set_rules('type', 'Type', 'required');
        // if ($this->form_validation->run() == false) {
        //     if ($this->session->userdata('id_akses') == 1 and $this->session->userdata('id_akses') == 3) {
        //         $this->HalamanAdmin('form/vform');
        //     } else {
        //         $this->Halamanprofil('form/vform', $form);
        //     }
        // }
        // $config['upload_path'] = './assets/img'; //,menentukan foldernya
        // $config['allowed_types'] = 'png|jpg|jpeg'; //memnentukan format
        // $config['max_size'] = 1000; //untuk ukuran
        // $config['max_width'] = 1024; // untuk lebar foto
        // $config['max_height'] = 786; // untuk tinggi foto
        // $this->load->library('upload', $config);
        // if (!$this->upload->do_upload('gambar')) {
        //     $error = array('error' => $this->upload->display_errors());
        //     var_dump($error);
        // } else {
        $data = [
            'id_perum' => $this->input->post('id'),
            'id_user' => $this->input->post('id_user'),
            'type' => $this->input->post('type'),
            'uk_rumah' => $this->input->post('ukrumah'),
            'harga' => $this->input->post('harga'),
            'cicilan' => $this->input->post('cicilan'),
            'deskripsi' => $this->input->post('deskripsi'),
            'alamat' => $this->input->post('Alamat'),
            // 'pic' => $this->upload->data('file_name'),
            'kategori' => 'Rumah'
        ];
        // var_dump($data);
        $this->M_Home->updatedata('perum', 'id_perum', $this->input->post('id'), $data);
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            redirect('Dashboard/property');
        } else {
            redirect('Home/rumah');
        }
        // }
    }
    public function DeleteRumah()
    {
        $id = $this->input->get('id');
        $db = $this->M_Home->deletedata('perum', 'id_perum', $id);
        echo json_encode($db);
    }
}
