<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Act extends CI_Controller
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
        // $this->load->model('Pegawai_model');
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
            $this->load->view('template/head');
            $this->load->view('template/nav-front/header');
            $this->load->view('register', $data);
            $this->load->view('template/nav-front/footer');
            $this->load->view('template/foot');
        } else {
            // ini adalah kode untuk acak nomber
            $getcode = $this->db->query('Select max(id_user) as maxKode FROM user')->row_array();
            $no_urut = (int) substr($getcode['maxKode'], 1, 3);
            $no_urut++;
            $kode = 'U' . sprintf("%03s", $no_urut);
            $iduser = $kode;
            $email = $this->input->post('email');
            $this->db->query("Insert into user (id_user,email) values ('$iduser','$email')");

            $log_user = [
                'id_user' => $kode,
                'username' => $this->input->post('nama'),
                'password' => $this->input->post('password'),
                'id_akses' => 2,
                'status' => 1,
            ];
            $this->db->insert('log_user', $log_user);

            redirect('Login/formlogin');
        }
    }
    public function logout()
    {
        $this->session->unset('id_user');
        $this->session->unset('username');
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
            $this->load->view('template/head');
            $this->load->view('template/nav-front/header');
            $this->load->view('user/profil', $data);
            $this->load->view('template/nav-front/footer');
            $this->load->view('template/foot');
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
}
