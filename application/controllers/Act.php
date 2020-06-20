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
        $this->form_validation->set_rules('nama', 'Username', 'alpha|required', ['required' => 'Username tidak boleh kosong !']);
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
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $pass = $this->input->post('password');
            $this->db->query("Insert into user (id_user,nama,email,pic) values ('$iduser','$nama','$email','default.png')");
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
            $this->Halamanprofil('user/profil', $data);
        } else {
            $nohp = $this->input->post('notel', true);
            if (!preg_match('/[^+0-9]/', trim($nohp))) {
                // cek apakah no hp karakter 1-3 adalah +62
                if (substr(trim($nohp), 0, 2) == '62') {
                    $hp = trim($nohp);
                }
                // cek apakah no hp karakter 1 adalah 0
                elseif (substr(trim($nohp), 0, 1) == '0') {
                    $hp = '62' . substr(trim($nohp), 1);
                } elseif (substr(trim($nohp), 0, 3) == '+62') {
                    $hp = '62' . substr(trim($nohp), 3);
                }
            }
            $pic = '';
            if ($_FILES['gambar']['name'] != "") {

                $temp = explode(".", $_FILES['gambar']['name']);
                $nama_baru = round(microtime(true)) . '.' . end($temp);
                // echo $nama_baru;

                $config['file_name'] = $nama_baru;
                $config['upload_path'] = './assets/profil/'; //,menentukan foldernya
                $config['allowed_types'] = 'png|jpg|jpeg'; //memnentukan format
                $config['max_size'] = '1024000';
                $config['max_filename'] = '5000000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar')) {
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
                } else {
                    $pic = $nama_baru;
                }
            } else {
                $pic = $this->input->post('img');
            }
            $data = [
                'nama' => $this->input->post('nama', true),
                'notel' => $hp,
                'email' => $this->input->post('email', true),
                'alamat' => $this->input->post('alamat', true),
                'pic' => $pic,
            ];
            // var_dump($data);
            // echo $_FILES['gambar']['tmp_name'];
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
            'tgl' => $tgl,
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
        $temp = explode(".", $_FILES['foto']['name']);
        $nama_baru = round(microtime(true)) . '.' . end($temp);
        // echo $nama_baru;

        $config['file_name'] = $nama_baru;
        $config['upload_path'] = './assets/img-struck'; //,menentukan foldernya
        $config['allowed_types'] = 'png|jpg|jpeg'; //memnentukan format
        $config['max_size'] = '1024000';
        $config['max_filename'] = '5000000';
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
            // echo $prov;
            // echo $kota;
            $data['perumahan'] = $this->M_Home->innerperumgetlocation($prov, $kota)->result();
            $data['db_property'] = $this->M_Home->innersearchRumah($prov, $kota)->result();
            // var_dump($data['db_property']);
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
        // $userboking = $this->M_Home->getid('booking', 'id', $id);
        $tgl = date('Y-m-d');
        // print_r($perum['id_user']);
        $notif = [
            'id_user' => $this->session->userdata('id_user'),
            'user_tujuan' => $perum['id_user'],
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
            redirect('Dashboard/Bookingcart');
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
        $this->load->model('M_Home');
        // $data['prov'] = $this->M_Home->getdata('provinsi');
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/provinsi/';
        $readApi = file_get_contents($url);
        $proapi = json_decode($readApi, true);

        $form['apiProv'] = $proapi['provinsi'];
        // $dropdown = [];

        // $op = '".foreach ($api as $drop) : endforeach."';
        // echo form_dropdown('shirts', $op
        //     // print_r($drop['id']);
        //     // print_r($drop['nama'];
        //     // $dropdown = [$drop['id'] => $drop['nama']];
        //     // $dropdown++;
        //     // print_r($dropdown);
        // );
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
        $pic = [
            'name' => 'gambar',
            'class' => 'input-group',
            'value' => $t['pic']
        ];
        $btn = [
            'class' => 'form-control btn btn-success',
            'value' => "Update data"
        ];
        $form['title'] = "Update Rumah";
        $form['img'] = "<img src=" . base_url() . "assets/img/" . $t['pic'] . " style='height:350px; width:350px'>";
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
        $form['pic'] = form_upload($pic);
        $form['btn'] = form_submit($btn);
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            $this->HalamanAdmin('form/vform-admin', $form);
        } else {
            $this->Halamanprofil('form/vform', $form);
        }
    }
    public function ActAddRumah()
    {
        if ($_FILES['gambar']['name'] != "") {
            $temp = explode(".", $_FILES['gambar']['name']);
            $nama_baru = round(microtime(true)) . '.' . end($temp);
            // echo $nama_baru;

            $config['file_name'] = $nama_baru;
            $config['upload_path'] = './assets/img'; //,menentukan foldernya
            $config['allowed_types'] = 'png|jpg|jpeg'; //memnentukan format
            $config['max_size'] = '1024000';
            $config['max_filename'] = '5000000';
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

            }
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
                'pic' => 'default.png',
                'kategori' => 'Rumah',
                'status' => '0',
            ];
        }
        $lok = [
            'id_unit' => $this->input->post('id'),
            'prov' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota'),
        ];
        $this->M_Home->inputdata('perum', $data);
        $this->M_Home->inputdata('lokasi_rumah', $lok);
        $this->session->set_flashdata('true', 'Di Tambahkan');
        $this->session->set_flashdata('alert', 'success');
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            redirect('Dashboard/property');
        } else {
            redirect('Home/rumah');
        }
    }
    public function ActUpdateRumah()
    {
        if ($_FILES['gambar']['name'] != "") {
            $temp = explode(".", $_FILES['gambar']['name']);
            $nama_baru = round(microtime(true)) . '.' . end($temp);
            // echo $nama_baru;

            $config['file_name'] = $nama_baru;
            $config['upload_path'] = './assets/img'; //,menentukan foldernya
            $config['allowed_types'] = 'png|jpg|jpeg'; //memnentukan format
            $config['max_size'] = '1024000';
            $config['max_filename'] = '5000000';
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
                    'kategori' => 'Rumah'
                ];
                // var_dump($data);
            }
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
                // 'pic' => $this->upload->data('file_name'),
                'kategori' => 'Rumah'
            ];
        }
        $this->M_Home->updatedata('perum', 'id_perum', $this->input->post('id'), $data);
        $this->session->set_flashdata('true', 'Di Edit');
        $this->session->set_flashdata('alert', 'success');
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            redirect('Dashboard/property');
        } else {
            redirect('Home/rumah');
        }
    }
    public function DeleteRumah($id)
    {
        // $id = $this->input->get('id');
        $db = $this->M_Home->deletedata('perum', 'id_perum', $id);
        // echo json_encode($db);
        $this->session->set_flashdata('true', 'Di Hapus');
        $this->session->set_flashdata('alert', 'error');
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            redirect('Dashboard/property');
        } else {
            redirect('Home/rumah');
        }
    }
    public function batalboking($id)
    {
        $update = [
            'status' => 0,
        ];
        $this->M_Home->updatedata('perum', 'id_perum', $id, $update);
        $perum = $this->M_Home->getid('perum', 'id_perum', $id);
        $tgl = date('Y-m-d');
        // print_r($perum['id_user']);
        $userboking = $this->M_Home->getid('booking', 'id', $id);
        var_dump($userboking);
        // $userloged = $this->session->userdata('id_user');
        $notif = [
            'id_user' => $perum['id_user'],
            'user_tujuan' => $userboking['user'],
            'requerst' => 'Bookingan dibatalkan',
            'icon' => 'fa fa-ban',
            'url' => 'Act/ActBooking',
            'tgl' => $tgl,
            'status' => 0
        ];
        var_dump($notif);

        /**
         * 
         * notifkasi untuk user
         * 
         */


        $this->M_Home->inputdata('notif', $notif);
        $this->M_Home->deletedata('booking', 'id', $id);
        $this->session->set_flashdata('true', 'dibatalkan');
        $this->session->set_flashdata('alert', 'warning');
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            redirect('Dashboard/Bookingan');
        } else {
            redirect('Home/CekPenjualan');
        }
    }
    public function terjual($id)
    {
        $this->M_Home->deletedata('booking', 'id', $id);
        $this->session->set_flashdata('true', 'Terjual');
        $this->session->set_flashdata('alert', 'success');
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            redirect('Dashboard/Bookingan');
        } else {
            redirect('Home/CekPenjualan');
        }
    }
    public function lap_penjualan()
    {
        $id = $this->session->userdata('id_user');
        if ($this->session->userdata('id_akses') == 1) {
            $data['terjual'] = $this->db->query('select history_penjualan.*,user.nama, perum.type,perum.pic, perum.kategori,perum.alamat, claster.claster,perumahan.nm_perumahan from history_penjualan inner join perum on perum.id_perum = history_penjualan.id_perum left join perumahan on perumahan.id_perumahan=perum.id_perumahan left join claster on claster.id_claster=perum.id_claster left join user on user.id_user=history_penjualan.id_user ')->result();
        } else {
            $data['terjual'] = $this->db->query('select history_penjualan.*,user.nama, perum.type,perum.pic, perum.kategori,perum.alamat, claster.claster,perumahan.nm_perumahan from history_penjualan inner join perum on perum.id_perum = history_penjualan.id_perum left join perumahan on perumahan.id_perumahan=perum.id_perumahan left join claster on claster.id_claster=perum.id_claster left join user on user.id_user=history_penjualan.id_user where perum.id_user ="' . $id . '"')->result();
        }

        // print_r($data['terjual']);
        if ($this->session->userdata('id_akses') == 1 or $this->session->userdata('id_akses') == 3) {
            $this->HalamanAdmin('user/history_penjualan', $data);
        } else {
            $this->Halamanprofil('user/history_penjualan', $data);
        }
    }
}
