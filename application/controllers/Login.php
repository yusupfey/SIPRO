<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends My_Controller
{
    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Halaman Login';
            $this->load->view('template/head');
            $this->load->view('template/nav-front/header');
            $this->load->view('login');
            $this->load->view('template/nav-front/footer');
            $this->load->view('template/foot');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $passwordx = md5($password);
            $qry = $this->db->query("Select * from log_user where username='$username' AND password ='$passwordx'")->row_array();
            if ($qry) {
                if ($qry['status'] == 1) {
                    $session = [
                        'id_user' => $qry['id_user'],
                        'username' => $qry['username'],
                        'id_akses' => $qry['id_akses'],
                    ];
                    $this->session->set_userdata($session);
                    $akses = $qry['id_akses'];
                    $acs = $this->db->query("Select * from akses where id_akses='$akses'")->row_array();
                    if ($qry['id_akses'] == $acs['id_akses']) {
                        redirect($acs['url']);
                    }
                } else {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert" style="z-index:1; position:relative;">Username Belum Active</div>');
                    redirect('Login/formlogin');
                }
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert" style="z-index:1; position:relative;">Username tidak terdaftar</div>');
                redirect('Login/formlogin');
            }
        }
    }
    public function register()
    {
        $this->HalamanHome('register');
    }
    public function formlogin()
    {

        $this->HalamanHome('login');
    }
}
