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
}
