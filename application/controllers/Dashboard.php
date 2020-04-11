<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('M_Administrator');
        if ($this->session->userdata('id_akses') === 1) redirect('Home');
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
        $id = $this->session->userdata('id_user');
        if ($this->session->userdata('id_akses') == 1) :
            $data['db_property'] = $this->db->get_where('perum', ['kategori' => 'Rumah'])->result();
        else :
            $data['db_property'] = $this->db->query('select * from perum where id_user="' . $id . '" AND kategori="Rumah"')->result();
        endif;
        // var_dump($data['db_property']);
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
        $getcode = $this->db->query('Select max(id_claster) as maxKode FROM claster')->row_array();
        $no_urut = (int) substr($getcode['maxKode'], 2, 7);
        $no_urut++;
        $kode = 'CL' . sprintf("%06s", $no_urut);
        $idclaster = $kode;



        $id = $this->session->userdata('id_user');
        $perum = $this->M_Administrator->getid('perumahan', 'id_user', $id);

        $inputidcluster = array(
            'type'             => 'text',
            'placeholder'    => 'ID Cluster',
            'class'            => 'form-control',
            'name'             => 'id_claster',
            'value'             => $idclaster,
            'READONLY'         => TRUE
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
            'READONLY'         => TRUE,
            'value'         => $perum['id_perumahan'],
            'name'             => 'id_perumahan'
        );
        $inputsubmit = array(
            'type'             => 'submit',
            'class'         => 'form-control btn btn-primary',
            'value'         => 'Simpan Data'
        );
        //di bawah kode untuk meng-generate formulirnya
        //diatas hanya arraynya saja
        $data['tagopen']    = form_open('Dashboard/simpan');
        $data['id_claster']        = form_input($inputidcluster);
        $data['claster']        = form_input($inputcluster);
        $data['id_perumahan']    = form_input($inputidperumahan);
        $data['submit']        = form_input($inputsubmit);
        $data['tagclose']    = form_close();

        // |_ dipanggil diview		|_ generate form

        if ($this->session->userdata('id_akses') == 1) {
            $data['cluster'] = $this->db->query('select claster.*, perumahan.nm_perumahan from claster inner join perumahan on perumahan.id_perumahan = claster.id_perumahan')->result();
        } else {
            $data['cluster'] = $this->db->query('select claster.*, perumahan.nm_perumahan from claster inner join perumahan on perumahan.id_perumahan = claster.id_perumahan where perumahan.id_user ="' . $id . '"')->result();
        }
        $this->HalamanAdmin('master/cluster', $data);
    }
    // public function FormClaster()
    // { //membuat input judul buku
    //     $inputidcluster = array(
    //         'type'             => 'text',
    //         'placeholder'    => 'ID Cluster',
    //         'class'            => 'form-control',
    //         'name'             => 'id_claster'
    //     );
    //     //author
    //     $inputcluster = array(
    //         'type'             => 'text',
    //         'placeholder'     => 'Cluster',
    //         'class'         => 'form-control',
    //         'name'             => 'claster'
    //     );
    //     //publisher
    //     $inputidperumahan = array(
    //         'type'             => 'text',
    //         'placeholder'     => 'ID Perumahan',
    //         'class'         => 'form-control',
    //         'name'             => 'id_perumahan'
    //     );
    //     $inputsubmit = array(
    //         'type'             => 'submit',
    //         'class'         => 'form-control btn btn-primary',
    //         'value'         => 'Simpan Data'
    //     );
    //     //di bawah kode untuk meng-generate formulirnya
    //     //diatas hanya arraynya saja
    //     $data['tagopen']    = form_open('Administrator/getcluster');
    //     $data['id_claster']        = form_input($inputidcluster);
    //     $data['claster']        = form_input($inputcluster);
    //     $data['id_perumahan']    = form_input($inputidperumahan);
    //     $data['submit']        = form_input($inputsubmit);
    //     $data['tagclose']    = form_close();

    //     // |_ dipanggil diview		|_ generate form

    //     $this->HalamanAdmin('master/cluster', $data);
    // }
    public function EditCluster()
    {
        $data = [
            'claster' => $this->input->post('cluster')
        ];
        $this->M_Administrator->updatedata('claster', 'id_claster', $this->input->post('idcluster'), $data);
        redirect('Dashboard/cluster');
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
        $this->M_Administrator->insertdata('claster', $arr);
        redirect('Dashboard/cluster');
    }
    public function perum()
    {
        $id = $this->session->userdata('id_user');
        if ($this->session->userdata('id_akses') == 1) {
            $data['db_perum'] = $this->db->query('select perum.*, perumahan.nm_perumahan, claster.claster from perum inner join perumahan on perumahan.id_perumahan = perum.id_perumahan inner join claster on claster.id_claster = perum.id_claster')->result();
        } else {
            $data['db_perum'] = $this->db->query('select perum.*, perumahan.nm_perumahan, claster.claster from perum inner join perumahan on perumahan.id_perumahan = perum.id_perumahan inner join claster on claster.id_claster = perum.id_claster where perum.id_user = "' . $id . '"')->result();
        }
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
        $selectuser = ('user.*');
        $joinprov = ('provinsi,provinsi.id_prov = perumahan.id_prov');
        $joinkota = ('kota,kota.id_kota = perumahan.id_kota');
        $data['perumahan'] = $this->M_Administrator->getperum($selectperum, $selectprov, $selectkota, $selectuser, 'perumahan', $joinkota, $joinprov);
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
    public function AddPerum()
    {
        $getcode = $this->db->query('Select max(id_perum) as maxKode FROM perum')->row_array();
        $no_urut = (int) substr($getcode['maxKode'], 3, 10);
        $no_urut++;
        $kode = 'PRH' . sprintf("%07s", $no_urut);
        $idperum = $kode;
        $iduser = $this->session->userdata('id_user');

        /**
         *dropdown
         */
        $idprmh = $this->M_Administrator->getid('perumahan', 'id_user', $iduser);

        $data['claster'] = $this->M_Administrator->getidAll('claster', 'id_perumahan', $idprmh['id_perumahan']);
        $cluster[''] = '-- Pilih cluster --';
        foreach ($data['claster'] as $dt) {
            $cluster[$dt->id_claster] = $dt->claster;

            /***
             * end dropdown
             */
        }

        $id = [
            'type' => 'hidden',
            'name' => 'id',
            'class' => 'form-control',
            'value' => $idperum,
            'readonly' => true,
            'placeholder' => 'masukanid'
        ];
        $idperumahan = [
            'type' => 'text',
            'name' => 'idperumahan',
            'class' => 'form-control',
            'value' => $idprmh['id_perumahan'],
            'readonly' => true,
            'placeholder' => 'masukanid'
        ];
        $iduser = [
            'type' => 'hidden',
            'name' => 'id_user',
            'class' => 'form-control',
            'value' => $iduser,
            'readonly' => true,
            'placeholder' => 'masukanid'
        ];
        $type = [
            'type' => 'text',
            'name' => 'type',
            'class' => 'form-control',
            'placeholder' => 'Masukan Type Rumah',
            'autofocus' => true
        ];
        $ukrumah = [
            'type' => 'text',
            'name' => 'ukrumah',
            'class' => 'form-control',
            'placeholder' => 'Ukuran Rumah'
        ];
        $harga = [
            'type' => 'text',
            'name' => 'harga',
            'class' => 'form-control',
            'placeholder' => 'Harga'
        ];
        $cicilan = [
            'type' => 'text',
            'name' => 'cicilan',
            'class' => 'form-control',
            'placeholder' => 'Cicilan'
        ];
        $desk = [
            'name' => 'deskripsi',
            'class' => 'form-control'
        ];
        $alamat = [
            'name' => 'Alamat',
            'class' => 'form-control'
        ];
        $pic = [
            'name' => 'gambar',
            'class' => 'input-group'
        ];
        $btn = [
            'class' => 'form-control btn btn-success',
            'value' => "Tambah data"
        ];
        $form['title'] = "Tambah Rumah";
        $form['form_open'] = form_open_multipart('Dashboard/ActAddPerum');
        $form['form_close'] = form_close();
        $form['idperum'] = form_input($id);
        $form['id_perumahan'] = form_input($idperumahan);
        $form['claster'] = form_dropdown('cluster', $cluster, '', 'id="kategori" class="form-control"'); //name,option,value.class
        $form['id_user'] = form_input($iduser);
        $form['type'] = form_input($type);
        $form['ukrumah'] = form_input($ukrumah);
        $form['harga'] = form_input($harga);
        $form['cicilan'] = form_input($cicilan);
        $form['desk'] = form_textarea($desk);
        $form['alamat'] = form_textarea($alamat);
        $form['pic'] = form_upload($pic);
        $form['btn'] = form_submit($btn);
        $this->HalamanAdmin('form/vform-admin', $form);
    }
    public function UpdatePerum($id)
    {
        $getcode = $this->M_Administrator->getid('perum', 'id_perum', $id);

        /**
         *dropdown
         */
        // $idprmh = $this->M_Administrator->getid('perumahan', 'id_user', $iduser);

        $data['claster'] = $this->M_Administrator->getidAll('claster', 'id_perumahan', $getcode['id_perumahan']);
        $cluster[''] = '-- Pilih cluster --';
        foreach ($data['claster'] as $dt) {
            $cluster[$dt->id_claster] = $dt->claster;
        }

        /***
         * end dropdown
         */

        $id = [
            'type' => 'hidden',
            'name' => 'id',
            'class' => 'form-control',
            'value' => $getcode['id_perum'],
            'readonly' => true,
            'placeholder' => 'masukanid'
        ];
        $idperumahan = [
            'type' => 'text',
            'name' => 'idperumahan',
            'class' => 'form-control',
            'value' => $getcode['id_perumahan'],
            'readonly' => true,
            'placeholder' => 'masukanid'
        ];
        $iduser = [
            'type' => 'hidden',
            'name' => 'id_user',
            'class' => 'form-control',
            'value' => $getcode['id_user'],
            'readonly' => true,
            'placeholder' => 'masukanid'
        ];
        $type = [
            'type' => 'text',
            'name' => 'type',
            'class' => 'form-control',
            'value' => $getcode['type'],
            'placeholder' => 'Masukan Type Rumah',
            'autofocus' => true
        ];
        $ukrumah = [
            'type' => 'text',
            'name' => 'ukrumah',
            'value' => $getcode['uk_rumah'],
            'class' => 'form-control',
            'placeholder' => 'Ukuran Rumah'
        ];
        $harga = [
            'type' => 'text',
            'value' => $getcode['harga'],
            'name' => 'harga',
            'class' => 'form-control',
            'placeholder' => 'Harga'
        ];
        $cicilan = [
            'type' => 'text',
            'name' => 'cicilan',
            'value' => $getcode['cicilan'],
            'class' => 'form-control',
            'placeholder' => 'Cicilan'
        ];
        $desk = [
            'name' => 'deskripsi',
            'value' => $getcode['deskripsi'],
            'class' => 'form-control'
        ];
        $alamat = [
            'name' => 'Alamat',
            'value' => $getcode['alamat'],
            'class' => 'form-control'
        ];
        $pic = [
            'name' => 'gambar',
            'class' => 'input-group'
        ];
        $btn = [
            'class' => 'form-control btn btn-success',
            'value' => "Simpan"
        ];
        $form['title'] = "Tambah Rumah";
        $form['img'] = "<img src=" . base_url() . "assets/img/" . $getcode['pic'] . " style='height:350px; width:350px'>";

        $form['form_open'] = form_open_multipart('Dashboard/ActUpdatePerum');
        $form['form_close'] = form_close();
        $form['idperum'] = form_input($id);
        $form['id_perumahan'] = form_input($idperumahan);
        $form['claster'] = form_dropdown('cluster', $cluster, $getcode['id_claster'], 'id="kategori" class="form-control"'); //name,option,value.class
        $form['id_user'] = form_input($iduser);
        $form['type'] = form_input($type);
        $form['ukrumah'] = form_input($ukrumah);
        $form['harga'] = form_input($harga);
        $form['cicilan'] = form_input($cicilan);
        $form['desk'] = form_textarea($desk);
        $form['alamat'] = form_textarea($alamat);
        $form['pic'] = form_upload($pic);
        $form['btn'] = form_submit($btn);
        $this->HalamanAdmin('form/vform-admin', $form);
    }
    public function ActAddPerum()
    {
        if ($_FILES['gambar']['name'] != "") {

            $config['upload_path'] = './assets/img'; //,menentukan foldernya
            $config['allowed_types'] = 'png|jpg|jpeg'; //memnentukan format
            $config['max_size'] = '1024000';
            $config['max_filename'] = '5000000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
            } else {
                $data = [
                    'id_perum' => $this->input->post('id'),
                    'id_perumahan' => $this->input->post('idperumahan'),
                    'id_claster' => $this->input->post('cluster'),
                    'id_user' => $this->input->post('id_user'),
                    'type' => $this->input->post('type'),
                    'uk_rumah' => $this->input->post('ukrumah'),
                    'harga' => $this->input->post('harga'),
                    'cicilan' => $this->input->post('cicilan'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'alamat' => $this->input->post('Alamat'),
                    'pic' => $this->upload->data('file_name'),
                    'kategori' => 'perum',
                    'status' => '0',
                ];
                // var_dump($data);

            }
        } else {
            $data = [
                'id_perum' => $this->input->post('id'),
                'id_perumahan' => $this->input->post('idperumahan'),
                'id_claster' => $this->input->post('cluster'),
                'id_user' => $this->input->post('id_user'),
                'type' => $this->input->post('type'),
                'uk_rumah' => $this->input->post('ukrumah'),
                'harga' => $this->input->post('harga'),
                'cicilan' => $this->input->post('cicilan'),
                'deskripsi' => $this->input->post('deskripsi'),
                'alamat' => $this->input->post('Alamat'),
                'pic' => 'default.png',
                'kategori' => 'perum',
                'status' => '0',

            ];
            // var_dump($data);

        }
        $this->M_Administrator->insertdata('perum', $data);
        redirect('Dashboard/Perum');
    }
    public function ActUpdatePerum()
    {
        if ($_FILES['gambar']['name'] != "") {

            $config['upload_path'] = './assets/img'; //,menentukan foldernya
            $config['allowed_types'] = 'png|jpg|jpeg'; //memnentukan format
            $config['max_size'] = '1024000';
            $config['max_filename'] = '5000000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
            } else {
                $data = [
                    'id_perum' => $this->input->post('id'),
                    'id_perumahan' => $this->input->post('idperumahan'),
                    'id_claster' => $this->input->post('cluster'),
                    'id_user' => $this->input->post('id_user'),
                    'type' => $this->input->post('type'),
                    'uk_rumah' => $this->input->post('ukrumah'),
                    'harga' => $this->input->post('harga'),
                    'cicilan' => $this->input->post('cicilan'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'alamat' => $this->input->post('Alamat'),
                    'pic' => $this->upload->data('file_name'),
                    'kategori' => 'perum',
                ];
                // var_dump($data);

            }
        } else {
            $data = [
                'id_perum' => $this->input->post('id'),
                'id_perumahan' => $this->input->post('idperumahan'),
                'id_claster' => $this->input->post('cluster'),
                'id_user' => $this->input->post('id_user'),
                'type' => $this->input->post('type'),
                'uk_rumah' => $this->input->post('ukrumah'),
                'harga' => $this->input->post('harga'),
                'cicilan' => $this->input->post('cicilan'),
                'deskripsi' => $this->input->post('deskripsi'),
                'alamat' => $this->input->post('Alamat'),
                // 'pic' => $this->upload->data('file_name'),
                'kategori' => 'perum',
            ];
        }
        $this->M_Administrator->updatedata('perum', 'id_perum', $this->input->post('id'), $data);
        redirect('Dashboard/Perum');
    }
    public function Deleteclaster($id)
    {
        $this->M_Administrator->deletdata('claster', 'id_claster', $id);
        // echo json_encode($db)
        redirect('Dashboard/cluster');
    }
    public function Deleteperum($id)
    {
        // $id = $this->input->get('id');
        $this->M_Administrator->deletdata('perum', 'id_perum', $id);
        // echo json_encode($db)
        redirect('Dashboard/perum');
    }
    public function Booking()
    {
        $id = $this->session->userdata('id_user');
        if ($this->session->userdata('id_akses') == 1) {
            $data['bookcart'] = $this->db->query('select booking.*, perum.*,perumahan.nm_perumahan, user.nama,claster.claster from perum inner join booking on perum.id_perum = booking.id inner join user on user.id_user=booking.user left join perumahan on perumahan.id_perumahan=perum.id_perumahan left join claster on claster.id_claster = perum.id_claster')->result();
            $this->HalamanAdmin('master/Booking', $data);
        } else {
            $data['bookcart'] = $this->db->query('select booking.*, perum.*, user.nama, perumahan.nm_perumahan,claster.claster from perum inner join booking on perum.id_perum = booking.id inner join user on user.id_user=booking.user left join perumahan on perumahan.id_perumahan=perum.id_perumahan left join claster on claster.id_claster = perum.id_claster where perum.id_user ="' . $id . '"')->result();
            $this->HalamanAdmin('master/Booking', $data);
        }
    }

    public function UploadPerum($id)
    {
        $pic = '';
        if (isset($_FILES['foto']['name'])) {
            $config['upload_path'] = 'assets/img-perumahan/';
            $config['allowed_types'] = 'png|jpg';
            $config['max_size'] = '1024000';
            $config['max_filename'] = '5000000';
            $config['encrypt_name'] = false;
            $config['file_name'] = $_FILES['foto']['name'];
            // echo $config['file_name'];
            if (file_exists('assets/img-perumahan/' . $config['file_name'])) {
            } else {
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('foto')) {
                    echo "upload error";
                } else {
                    $pic = $config['file_name'];
                }
            }
        }
        $data = [
            'pic' => $pic,
        ];
        $this->M_Administrator->updatedata('perumahan', 'id_perumahan', $id, $data);
    }
}
