<?php
class My_Controller extends CI_Controller
{
    public function HalamanAdmin($content, $data = null)
    {
        $this->load->model('M_Administrator');
        $data['count'] = $this->M_Administrator->hitungnotif();
        $data['notif'] = $this->db->get_where('notif', ['acc' => 0])->result();

        $hal['header'] = $this->load->view('template/administrator/header', $data, TRUE);
        $hal['content'] = $this->load->view($content, $data, TRUE);
        $hal['footer'] = $this->load->view('template/administrator/footer', $data, TRUE);

        $this->load->view('index', $hal, $data);
    }
    public function HalamanHome($konten, $data = null)
    {
        $hal['header'] = $this->load->view('template/nav-front/header', $data, TRUE);
        $hal['content'] = $this->load->view($konten, $data, TRUE);
        $hal['footer'] = $this->load->view('template/nav-front/footer', $data, TRUE);

        $this->load->view('index', $hal, $data);
    }
    public function Halamanprofil($konten, $data = null)
    {
        $hal['header'] = $this->load->view('template/nav-front/header', $data, TRUE);
        $hal['content'] = $this->load->view($konten, $data, TRUE);
        $hal['footer'] = $this->load->view('template/nav-front/footer', $data, TRUE);

        $this->load->view('index', $hal, $data);
    }
}
