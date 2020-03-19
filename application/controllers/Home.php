<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends My_Controller
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
        $this->HalamanHome('template/nav-front/content', $data);
    }
    public function profil()
    {
        $id = $this->session->userdata('id_user');
        $data['user'] = $this->db->get_where('user', ['id_user' => $id])->result();
        // $data['sidebar'] = $this->load->view('template/nav-front/sidebar');
        $this->Halamanprofil('user/profil', $data);
    }
    public function RequestPerum()
    {
        $id = $this->session->userdata('id_user');
        $pay = $this->db->get_where('notif', ['id_user' => $id])->row_array();
        if ($pay['id_user'] != $id) {
            $data = $this->db->get_where('user', ['id_user' => $id])->result();
            foreach ($data as $t) {
                $p = $t->nama;
                $e = $t->email;
                $n = $t->notel;
            }
            // $id = $this->session->userdata('id_user');
            // $data['user'] = $this->db->get_where('user', ['id_user' => $id])->result();
            // $data['sidebar'] = $this->load->view('template/nav-front/sidebar');
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
                'value' => $p,
            ];
            $email = [
                'type' => 'text',
                'name' => 'email',
                'class' => 'form-control',
                'READONLY' => TRUE,
                'value' => $e,
            ];
            $perum = [
                'type' => 'text',
                'name' => 'Nama Perumahan',
                'class' => 'form-control',
            ];
            $form['id'] = form_input($id);
            $form['nama'] = form_input($nama);
            $form['perum'] = form_input($perum);
            $form['email'] = form_input($email);
            $this->Halamanprofil('user/Request_perum', $form);
        } else {
            redirect('Home/payment');
        }
    }
    public function payment()
    {
        $upload = [
            'type' => 'file',
            'name' => 'email',
            'class' => 'form-control',
        ];
        $form['upload'] = form_upload($upload);
        $this->Halamanprofil('user/payment', $form);
    }
}
