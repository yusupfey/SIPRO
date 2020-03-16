<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
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
            $qry = $this->db->query("Select * from log_user where username='$username' AND password ='$passwordx'")->row_array();
            if ($qry) {
                if ($qry['status'] == 1) {
                    if ($qry['id_akses'] == 1) {
                        redirect('Administrator');
                    } else if ($qry['id_akses'] == 2) {
                        redirect('Home/profil');
                    }
                } else {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert" style="z-index:1; position:relative;">Username Belum Active</div>');
                    redirect('Home/login');
                }
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert" style="z-index:1; position:relative;">Username tidak terdaftar</div>');
                redirect('Home/login');
            }
        }
    }
    // public function login()
    // {
    //     $data['judul'] = 'Halaman Login';
    //     $this->load->view('template/head');
    //     $this->load->view('template/nav-front/header');
    //     $this->load->view('login');
    //     $this->load->view('template/nav-front/footer');
    //     $this->load->view('template/foot');
    // }
    public function register()
    {
        $this->load->view('template/head');
        $this->load->view('template/nav-front/header');
        $this->load->view('register');
        $this->load->view('template/nav-front/footer');
        $this->load->view('template/foot');
    }
    public function formlogin()
    {
        //     // $username = array(
        //     //     'name' => 'username',
        //     //     'type' => 'text',
        //     //     'class' => 'form-control form-control-user',
        //     //     'placeholder' => 'Masukin username'
        //     // );
        //     // $password = array(
        //     //     'name' => 'password',
        //     //     'type' => 'password',
        //     //     'class' => 'form-control form-control-user',
        //     //     'placeholder' => 'Masukin Password'
        //     // );
        //     // $btn = array(
        //     //     'type' => 'submit',
        //     //     'class' => 'form-control btn btn-primary'
        //     // );
        //     // $data['tagopen'] = form_open('index.php/Act');
        //     // $data['tagclose'] = form_close();
        //     // $data['username'] = form_input($username);
        //     // $data['password'] = form_input($password);
        //     // $data['btn'] = form_submit($btn);

        $this->load->view('template/head');
        $this->load->view('template/nav-front/header');
        $this->load->view('login');
        $this->load->view('template/nav-front/footer');
        $this->load->view('template/foot');
    }
}
