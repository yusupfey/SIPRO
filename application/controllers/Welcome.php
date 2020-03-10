<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
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
		$this->load->view('template/head');
		$this->load->view('template/nav-front/header');
		$this->load->view('template/nav-front/content');
		$this->load->view('template/nav-front/footer');
		$this->load->view('template/foot');
	}
	public function admin()
	{
		$this->load->view('template/head');
		$this->load->view('template/administrator/header');
		$this->load->view('template/administrator/dasboard');
		$this->load->view('template/administrator/footer');
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
}
