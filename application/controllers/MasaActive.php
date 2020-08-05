<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasaActive extends My_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_akses') === 1) redirect('Home');
		if ($this->session->userdata('id_user') == "") redirect('login');
		$id = $this->session->userdata('id_user');
		$tgl = date('Y-m-d');
		$this->load->model('M_Administrator');
		$masa_active = $this->M_Administrator->getid('contract', 'id_user', $id);
		if ($this->session->userdata('id_akses') == 3 && $tgl < @$masa_active['masa_aktif']) redirect('Dashboard');
	}
	public function index()
	{
		$this->masaActive('MasaActive/index');
	}
	public function payment()
	{
		$form['judul'] = 'Halaman Pembayaran';
		$id = $this->session->userdata('id_user');
		$pay = $this->db->get_where('payment', ['id_user' => $id])->row_array();
		if (@$pay['id_user'] != $id && @$pay['status'] == 0) {
			@$data = $this->db->get_where('user', ['id_user' => $id])->row_array();
			$perum = $this->db->get_where('perumahan', ['id_user' => $id])->row_array();
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
				'value' => $data['nama'],
			];
			$email = [
				'type' => 'text',
				'name' => 'email',
				'class' => 'form-control',
				'READONLY' => TRUE,
				'value' => $data['notel'],
			];
			$nmperum = [
				'type' => 'text',
				'name' => 'perumahan',
				'class' => 'form-control',
				'READONLY' => TRUE,
				'value' => $perum['nm_perumahan'],
			];
			$form['id'] = form_input($id);
			$form['nama'] = form_input($nama);
			$form['email'] = form_input($email);
			$form['perum'] = form_input($nmperum);
			$this->masaActive('MasaActive/req', $form);
		} elseif (@$pay['id_user'] == $id && @$pay['status'] == 1) {
			$this->masaActive('template/nav-front/halporses');
		} else {
			$upload = [
				'type' => 'file',
				'name' => 'foto',
				'class' => 'form-control',
			];
			$form['upload'] = form_input($upload);
			$this->masaActive('MasaActive/buy', $form);
		}
	}
	public function req()
	{
		$this->load->model('M_Home');
		$tgl = date('Y-m-d');
		$data = [
			'id_user' => $this->input->post('id'),
			'requerst' => "Perpanjang Akses Untuk Jual Perumahan",
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
		redirect('MasaActive/payment');
	}
	public function buy()
	{
		$this->load->model('M_Home');

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
			redirect("MasaActive/payment");
		}
	}
}
