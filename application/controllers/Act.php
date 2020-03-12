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
            $qry = $this->db->query("Select * from user where id_user='$username' AND password ='$passwordx'")->row_array();
            if ($qry) {
                if ($qry['status'] == 1) {
                    if ($qry['akses'] == 'admin') {
                        redirect('Administrator');
                    } else if ($qry['akses'] == 'user1') {
                        echo 'user';
                    }
                } else {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert" style="z-index:1; position:relative;">Username Belum Active</div>');
                    redirect('Menu/login');
                }
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert" style="z-index:1; position:relative;">Username tidak terdaftar</div>');
                redirect('Menu/login');
            }
        }
    }
    public function login()
    {
        $data['judul'] = 'Halaman Login';
        $this->load->view('template/head');
        $this->load->view('template/nav-front/header');
        $this->load->view('login');
        $this->load->view('template/nav-front/footer');
        $this->load->view('template/foot');
    }
}
