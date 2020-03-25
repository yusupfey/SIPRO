<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model('M_Administrator');
        if ($this->session->userdata('id_user') === null) redirect('login');
    }
    public function index()
    {
        $id = $this->session->userdata('id_user');
        // echo $id;
        $select = [
            'id_perumahan', 'nm_perumahan', 'titik_coridinat', 'alamat_lengkap', 'pic', 'nama', 'provinsi', 'kota'
        ];
        // $joinprov = ['provinsi' => 'provinsi.id_prov = perumahan.id_prov'];
        // $joinkota = ['kota' => 'kota.id_kota = perumahan.id_kota'];
        $joinuser = 'user, user.id_user = perumahan.id_user';

        $where = ['id_user' => $id];
        $data['properum'] = $this->M_Administrator->innerThreedata($id);
        $data['prov'] = $this->M_Administrator->getdata('provinsi');
        $data['kota'] = $this->M_Administrator->getdata('kota');
        // var_dump($data['properum']);
        $this->HalamanAdmin('template/administrator/dasboard', $data);
    }
    public function Property()
    {
        $data['db_property'] = $this->db->get('rumah')->result();
        $this->HalamanAdmin('user/property', $data);
    }
    public function pengguna()
    {
        $data['db_user'] = $this->db->get('user')->result();
        $this->HalamanAdmin('user/datauser', $data);
    }
    public function lokasi()
    {
        $data['prov'] = $this->db->get('provinsi')->result();
        $data['kota'] = $this->db->query('select kota.*, provinsi.provinsi from kota inner join provinsi on provinsi.id_prov = kota.id_prov')->result();
        $this->HalamanAdmin('master/lokasi', $data);
    }
    public function akses()
    {
        $data['prov'] = $this->db->get('akses')->result();
        $this->HalamanAdmin('master/akses', $data);
    }
    public function cluster()
    {
        $data['cluster'] = $this->db->query('select claster.*, perumahan.nm_perumahan from claster inner join perumahan on perumahan.id_perumahan = claster.id_perumahan')->result();

        $this->HalamanAdmin('master/cluster', $data);
    }
    public function FormClaster()
    { //membuat input judul buku
        $inputidcluster = array(
            'type'             => 'text',
            'placeholder'    => 'ID Cluster',
            'class'            => 'form-control',
            'name'             => 'id_claster'
        );
        //author
        $inputcluster = array(
            'type'             => 'text',
            'placeholder'     => 'Cluster',
            'class'         => 'form-control',
            'name'             => 'claster'
        );
        //publisher
        $inputidperumahan = array(
            'type'             => 'text',
            'placeholder'     => 'ID Perumahan',
            'class'         => 'form-control',
            'name'             => 'id_perumahan'
        );
        $inputsubmit = array(
            'type'             => 'submit',
            'class'         => 'form-control btn btn-primary',
            'value'         => 'Simpan Data'
        );
        //di bawah kode untuk meng-generate formulirnya
        //diatas hanya arraynya saja
        $data['tagopen']    = form_open('Administrator/getcluster');
        $data['id_claster']        = form_input($inputidcluster);
        $data['claster']        = form_input($inputcluster);
        $data['id_perumahan']    = form_input($inputidperumahan);
        $data['submit']        = form_input($inputsubmit);
        $data['tagclose']    = form_close();

        // |_ dipanggil diview		|_ generate form

        $this->HalamanAdmin('master/crud_cluster', $data);
    }
    public function simpan()
    {
        $idclu = $this->input->post('id_claster');
        $idperumah = $this->input->post('id_perumahan');
        $clu = $this->input->post('claster');
        //var baru  		//lihat aarray
        $arr = array(
            'id_claster'    => $idclu,
            'id_perumahan' => $idperumah,
            'claster' => $clu,
            //kiri diambil dari field DB
            //kanan diambil dari variabel diatas(sesuai form)
        );
        echo "done";
        $this->isi->simpandata($arr);
        redirect('Administrator/getcluster');
    }
    public function perum()
    {

        $data['db_perum'] = $this->db->query('select perum.*, perumahan.nm_perumahan, claster.claster from perum inner join perumahan on perumahan.id_perumahan = perum.id_perumahan inner join claster on claster.id_claster = perum.id_claster')->result();
        $this->HalamanAdmin('user/perum', $data);
    }
    public function notification()
    {
        $data['not'] = $this->M_Administrator->getdata('notif');
        $up = ['status' => 1];
        $this->M_Administrator->updatedatanot('notif', 1, 'fa-bell');
        $this->M_Administrator->updatedatanot('notif', 1, 'fa-donate');
        $this->HalamanAdmin('master/notification', $data);
    }
    public function pemesanan()
    {
        $data['pay'] = $this->M_Administrator->getidAll('payment', 'status', 0);
        $data['paytrue'] = $this->M_Administrator->getidAll('payment', 'status', 1);
        $this->HalamanAdmin('master/data_pemesanan', $data);
        // var_dump($data['pay']);
    }
    public function konfirmasi($id)
    {
        $data['acc'] = $this->db->query("select payment.*, paket.nominal,paket.keterangan, user.nama, user.email, log_user.username from paket inner join payment on paket.id_paket=payment.id_paket inner join user on user.id_user= payment.id_user inner join log_user on log_user.id_user=user.id_user where payment.id_user ='$id'")->row_array();
        $this->HalamanAdmin('master/acc', $data);
    }
    public function act_konfirmasi($id)
    {
        $getcode = $this->db->query('Select max(id_perumahan) as maxKode FROM perumahan')->row_array();
        $no_urut = (int) substr($getcode['maxKode'], 3, 10);
        $no_urut++;
        $kode = 'PRU' . sprintf("%07s", $no_urut);
        var_dump($kode);

        $data = [
            'id_akses' => 3,
            'status' => 1
        ];
        $buatkode = [
            'id_perumahan' => $kode,
            'id_user' => $id,
            'pic' => 'default.png'
        ];
        $where = ['id_user' => $id];
        $this->M_Administrator->updatedata('log_user', 'id_user', $id, $data);
        $this->M_Administrator->deletdata('payment', $where);
        $this->M_Administrator->insertdata('perumahan', $buatkode);
        redirect('Dashboard/pemesanan');
    }
    public function Getdatabyajax($table)
    {
        $kode = $this->input->post('provinsi');
        $data['dt'] = $this->M_Administrator->getidAll($table, 'id_prov', $kode);
        // var_dump($data['dt']);
        // var_dump($kode);

        $toprint = '';
        $prov = $this->M_Administrator->getid($table, 'id_prov', $kode);
        // var_dump($prov);
        if ($prov['id_prov'] == 0) {
            foreach ($data['dt'] as $v) {
                $toprint = $toprint . '<option value="' . $v->id_kota . '">' . $v->kota . '</option>';
            }
        } else {
            $toprint = $toprint . '<option value="' . $prov['id_kota'] . '">' . $prov['kota'] . '</option>';
        }
        echo $toprint;
    }

    public function perumahan()
    {
        $selectperum = ('perumahan.*');
        $selectprov = ('provinsi.*');
        $selectkota = ('kota.*');
        $joinprov = ('provinsi,provinsi.id_prov = perumahan.id_prov');
        $joinkota = ('kota,kota.id_kota = perumahan.id_kota');
        $data['perumahan'] = $this->M_Administrator->getperum($selectperum, $selectprov, $selectkota, 'perumahan', $joinkota, $joinprov);
        $this->HalamanAdmin('master/master_perumahan', $data);
    }
    public function profilperum()
    {
        $id = $this->input->post('id');

        $data = [
            'nm_perumahan' => $this->input->post('nama'),
            'titik_coridinat' => $this->input->post('tikor'),
            'id_prov' => $this->input->post('provinsi'),
            'id_kota' => $this->input->post('kota'),
            'alamat_lengkap' => $this->input->post('alamat'),
        ];
        $where = $id;
        $this->M_Administrator->updatedata('perumahan', 'id_perumahan', $where, $data);
        redirect('Dashboard');
    }
    public function profiluser()
    {
        // $id = $this->input->post('id');

        // $data = [
        //     'nm_perumahan' => $this->input->post('nama'),
        //     'titik_coridinat' => $this->input->post('tikor'),
        //     'id_prov' => $this->input->post('provinsi'),
        //     'id_kota' => $this->input->post('kota'),
        //     'alamat_lengkap' => $this->input->post('alamat'),
        // ];
        // $where = $id;
        // $this->M_Administrator->updatedata();
        $id = $this->session->userdata('id_user');
        $data['user'] = $this->db->get_where('user', ['id_user' => $id])->row_array();
        // $data['sidebar'] = $this->load->view('template/nav-front/sidebar');
        // $this->Halamanprofil('user   /profil', $data);
        $this->HalamanAdmin('template/administrator/profil', $data);
    }
}
