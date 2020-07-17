<?php
class My_Controller extends CI_Controller
{
    public function HalamanAdmin($content, $data = null)
    {
        $data['judul'] = 'Administrator || SIPRO';

        $this->load->model('M_Administrator');
        $id = $this->session->userdata('id_user');
        $data['user'] = $this->M_Administrator->getid('user', 'id_user', $id);
        if ($this->session->userdata('id_akses') == 1) {
            $data['count'] = $this->M_Administrator->hitungnotifadmin();
            $data['notif'] = $this->db->get_where('notif', ['status' => 0, 'user_tujuan' => ''])->result();
        } else {

            $data['count'] = $this->M_Administrator->hitungnotif();
            $data['notif'] = $this->db->get_where('notif', ['status' => 0, 'user_tujuan' => $id])->result();
        }
        $data['notpay'] = $this->M_Administrator->notifpayment();
        $data['countperum'] = $this->M_Administrator->countperum();
        $data['countrumah'] = $this->M_Administrator->countrumah();
        $data['countcluster'] = $this->M_Administrator->countcluster();
        $data['countbooking'] = $this->M_Administrator->countbooking();
        // $data['notif'] = $this->db->get_where('payment', ['status' => 0])->result();

        $hal['header'] = $this->load->view('template/administrator/header', $data, TRUE);
        $hal['content'] = $this->load->view($content, $data, TRUE);
        $hal['footer'] = $this->load->view('template/administrator/footer', $data, TRUE);

        $this->load->view('index', $hal, $data);
    }
    public function HalamanHome($konten, $data = null)
    {
        error_reporting(0);
        $data['judul'] = 'Home || SIPRO';

        $this->load->model('M_Home');
        $id = $this->session->userdata('id_user');

        $data['notif'] = $this->M_Home->hitungnotif();
        $data['notification'] = $this->db->get_where('notif', ['status' => 0, 'user_tujuan' => $id])->result();

        if ($id != "") {
            $data['cart'] = $this->M_Home->hitungcart();
            $oop = $this->M_Home->getidall('booking', 'user', $id);
            foreach ($oop as $t) :
                $get = $t->id;
                $data['bookcart'] = $this->M_Home->getcart($get)->result();
            endforeach;
        }

        $hal['header'] = $this->load->view('template/nav-front/header', $data, TRUE);
        $hal['content'] = $this->load->view($konten, $data, TRUE);
        $hal['footer'] = $this->load->view('template/nav-front/footer', $data, TRUE);

        $this->load->view('index', $hal, $data);
    }
    public function Halamanprofil($konten, $data = null)
    {
        error_reporting(0);
        $data['judul'] = 'Profil || SIPRO';
        $id = $this->session->userdata('id_user');
        $data['notif'] = $this->M_Home->hitungnotif();
        $data['notification'] = $this->db->get_where('notif', ['status' => 0, 'user_tujuan' => $id])->result();
        if ($id != "") {
            $data['cart'] = $this->M_Home->hitungcart();
            $oop = $this->M_Home->getidall('booking', 'user', $id);
            foreach ($oop as $t) :
                $get = $t->id;
                $data['bookcart'] = $this->M_Home->getcart($get)->result();
            endforeach;
        }
        $hal['header'] = $this->load->view('template/nav-front/header', $data, TRUE);
        $hal['sidebar'] = $this->load->view('template/nav-front/sidebar', $data, TRUE);
        $hal['content'] = $this->load->view($konten, $data, TRUE);
        $hal['foot'] = '</div></div>';
        $hal['footer'] = $this->load->view('template/nav-front/footer', $data, TRUE);

        $this->load->view('index', $hal, $data);
    }
    public function masaActive($content, $data = null)
    {
        $hal['content'] = $this->load->view($content, $data, TRUE);

        $this->load->view('index', $hal, $data);
    }
}
