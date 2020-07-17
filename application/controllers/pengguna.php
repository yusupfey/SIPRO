<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pengguna extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model('M_Administrator');
        $this->load->library('form_validation');
        // if ($this->session->userdata('id_user') === null) redirect('login');
    }
    public function createUser()
    {
        $data['akses'] = $this->M_Administrator->getdata('akses');
        $this->HalamanAdmin('form/pengguna/create', $data);
    }
    public function create()
    {
        $data['akses'] = $this->M_Administrator->getdata('akses');

        $this->form_validation->set_rules('nama', 'nama', 'required', ['required' => 'Tidak Boleh Kosong!!']);
        $this->form_validation->set_rules('alamat', 'alamat', 'required', ['required' => 'Tidak Boleh Kosong!!']);
        $this->form_validation->set_rules('telp', 'telp', 'required|numeric', ['required' => 'Tidak Boleh Kosong!!', 'numeric' => 'Harus Angka!!']);
        $this->form_validation->set_rules('email', 'email', 'required', ['required' => 'Tidak Boleh Kosong!!']);
        $this->form_validation->set_rules('username', 'username', 'required|alpha_dash', ['required' => 'Tidak Boleh Kosong!!', 'alpha_dash' => 'Tidak Boleh Menggunakan Space']);
        $this->form_validation->set_rules('password', 'password', 'required', ['required' => 'Tidak Boleh Kosong!!']);
        $this->form_validation->set_rules('akses', 'akses', 'required', ['required' => 'Tidak Boleh Kosong!!']);
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Halaman pengguna';
            $this->HalamanAdmin('form/pengguna/create', $data);
        } else {
            $getcode = $this->db->query('Select max(id_user) as maxKode FROM user')->row_array();
            $no_urut = (int) substr($getcode['maxKode'], 1, 3);
            $no_urut++;
            $kode = 'U' . sprintf("%03s", $no_urut);



            $nohp = $this->input->post('telp', true);


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



            $datauser = [
                'id_user' => $kode,
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'notel' => $hp,
                'email' => $this->input->post('email'),
                'pic' => 'default.png'
            ];
            $akses = [
                'username' => $this->input->post('username'),
                'id_user' => $kode,
                'password' => $this->input->post('password'),
                'id_akses' => $this->input->post('akses'),
                'status' => 1,
            ];
            $this->M_Administrator->insertdata('user', $datauser);
            $this->M_Administrator->insertdata('log_user', $akses);

            $this->session->set_flashdata('true', 'Berhasil Di Tambahkan !');
            $this->session->set_flashdata('alert', 'success');
            redirect('Dashboard/pengguna');
        }
    }
    public function UpdateUser($id)
    {
        $data['get'] = $this->M_Administrator->getid('user', 'id_user', $id);
        $data['getlog'] = $this->M_Administrator->getid('log_user', 'id_user', $id);
        $data['akses'] = $this->M_Administrator->getdata('akses');

        $this->HalamanAdmin('form/pengguna/update', $data);
    }
    public function Update()
    {
        $data['get'] = $this->M_Administrator->getid('user', 'id_user', $this->input->post('id'));
        $data['getlog'] = $this->M_Administrator->getid('log_user', 'id_user', $this->input->post('id'));
        $data['akses'] = $this->M_Administrator->getdata('akses');

        $this->form_validation->set_rules('nama', 'nama', 'required', ['required' => 'Tidak Boleh Kosong!!']);
        $this->form_validation->set_rules('alamat', 'alamat', 'required', ['required' => 'Tidak Boleh Kosong!!']);
        $this->form_validation->set_rules('telp', 'telp', 'required|numeric', ['required' => 'Tidak Boleh Kosong!!', 'numeric' => 'Harus Angka!!']);
        $this->form_validation->set_rules('email', 'email', 'required', ['required' => 'Tidak Boleh Kosong!!']);
        $this->form_validation->set_rules('username', 'username', 'required|alpha_dash', ['required' => 'Tidak Boleh Kosong!!', 'alpha_dash' => 'Tidak Boleh Menggunakan Space']);
        $this->form_validation->set_rules('akses', 'akses', 'required', ['required' => 'Tidak Boleh Kosong!!']);
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Halaman pengguna';
            $this->HalamanAdmin('form/pengguna/create', $data);
        } else {
            $nohp = $this->input->post('telp', true);

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


            $datauser = [
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'notel' => $hp,
                'email' => $this->input->post('email'),
                'pic' => 'default.png'
            ];
            $password = $this->input->post('password');
            $passwordx = md5($password);
            if (!$password) {
                $akses = [
                    'username' => $this->input->post('username'),
                    'id_akses' => $this->input->post('akses'),
                    'status' => 1,
                ];
            } else {
                $akses = [
                    'username' => $this->input->post('username'),
                    'password' => $passwordx,
                    'id_akses' => $this->input->post('akses'),
                    'status' => 1,
                ];
            }
            $this->M_Administrator->updatedata('user', 'id_user', $this->input->post('id'), $datauser);
            $this->M_Administrator->updatedata('log_user', 'id_user', $this->input->post('id'), $akses);

            $this->session->set_flashdata('true', 'Berhasil Di Update !');
            $this->session->set_flashdata('alert', 'success');
            redirect('Dashboard/pengguna');
        }
    }
    public function delete($id)
    {
        $this->M_Administrator->deletdata('user', 'id_user', $id);
        $this->session->set_flashdata('true', 'Berhasil Di Hapus !');
        $this->session->set_flashdata('alert', 'success');
        redirect('Dashboard/pengguna');
    }
}
