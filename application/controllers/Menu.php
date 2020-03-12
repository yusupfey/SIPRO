<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
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
        $data['db_property'] = $this->db->get('rumah')->result();
        $this->load->view('template/head');
        $this->load->view('template/nav-front/header');
        $this->load->view('template/nav-front/content', $data);
        $this->load->view('template/nav-front/footer');
        $this->load->view('template/foot');
    }
    public function profil()
    {
        $this->load->view('template/head');
        $this->load->view('template/nav-front/header');
        $this->load->view('user/profil');
        $this->load->view('template/nav-front/footer');
        $this->load->view('template/foot');
    }
    public function register()
    {
        $this->load->view('template/head');
        $this->load->view('template/nav-front/header');
        $this->load->view('register');
        $this->load->view('template/nav-front/footer');
        $this->load->view('template/foot');
    }
    public function login()
    {
        // $username = array(
        //     'name' => 'username',
        //     'type' => 'text',
        //     'class' => 'form-control form-control-user',
        //     'placeholder' => 'Masukin username'
        // );
        // $password = array(
        //     'name' => 'password',
        //     'type' => 'password',
        //     'class' => 'form-control form-control-user',
        //     'placeholder' => 'Masukin Password'
        // );
        // $btn = array(
        //     'type' => 'submit',
        //     'class' => 'form-control btn btn-primary'
        // );
        // $data['tagopen'] = form_open('index.php/Act');
        // $data['tagclose'] = form_close();
        // $data['username'] = form_input($username);
        // $data['password'] = form_input($password);
        // $data['btn'] = form_submit($btn);

        $this->load->view('template/head');
        $this->load->view('template/nav-front/header');
        $this->load->view('login');
        $this->load->view('template/nav-front/footer');
        $this->load->view('template/foot');
    }
}
