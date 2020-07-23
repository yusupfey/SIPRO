<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('M_Administrator');
        $this->load->library('form_validation');
        if ($this->session->userdata('id_akses') === 1) redirect('Home');
        if ($this->session->userdata('id_user') == "") redirect('login');
        $id = $this->session->userdata('id_user');
        $tgl = date('Y-m-d');
        $masa_active = $this->M_Administrator->getid('contract', 'id_user', $id);
        if ($this->session->userdata('id_akses') == 3 && $tgl >= $masa_active['masa_aktif']) redirect('MasaActive');
    }
    public function index()
    {
        //api provinsi
        if ($this->session->userdata('id_akses') == 1) {
            $this->HalamanAdmin('template/administrator/dasboard');
        } else {
            $url = 'https://dev.farizdotid.com/api/daerahindonesia/provinsi/';
            $readApi = file_get_contents($url);
            $proapi = json_decode($readApi, true);


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
            $data['prov'] = $proapi['provinsi'];
            // var_dump($data['properum']);
            $id_kota = $data['properum']['id_prov'];
            // echo $id_kota;
            $url = "https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=$id_kota";
            $getKotaApi = file_get_contents($url);
            $apiKota = json_decode($getKotaApi, true);
            $data['kota'] = $apiKota['kota_kabupaten'];
            /**
             * end api
             * 
             */
            /**
             * get contrat with perumahaan
             */
            $data['masa_active'] = $this->M_Administrator->getid('contract', 'id_user', $id);



            $this->HalamanAdmin('template/administrator/dasboard', $data);
        }
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
    public function UpdatePerumahan($id)
    {
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/provinsi/';
        $readApi = file_get_contents($url);
        $proapi = json_decode($readApi, true);

        if ($this->session->userdata('id_akses') == 1) {
            $getidperum = $this->db->get_where('perumahan', ['id_user' => $id]);
        } else {

            $id = $this->session->userdata('id_user');
        }
        $data['prov'] = $proapi['provinsi'];

        $data['properum'] = $this->M_Administrator->innerPerumahan($id);
        // var_dump($data['properum']);
        $this->HalamanAdmin('form/vform-perumahan', $data);
    }
    public function pengguna()
    {
        $data['db_user'] = $this->db->get('user')->result();
        $this->HalamanAdmin('user/datauser', $data);
    }
    public function lokasi()
    {
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/provinsi/';
        $readApi = file_get_contents($url);
        $proapi = json_decode($readApi, true);



        $url = "https://api.rajaongkir.com/starter/city?key=f4e894df6ff420d19117cc10ed734f69";
        $getKotaApi = file_get_contents($url);
        $apiKota = json_decode($getKotaApi, true);
        $api = $apiKota['rajaongkir'];
        $data['prov'] = $proapi['provinsi'];
        $data['kota'] = $api['results'];
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


        if ($this->session->userdata('id_akses') == 1) {

            $perum = $this->M_Administrator->getdata('perumahan');
            $inputidperumahan[''] = '-- Pilih Perumahan';
            foreach ($perum as $t) {
                $inputidperumahan[$t->id_perumahan] = $t->nm_perumahan;
            }

            $data['id_perumahan'] = form_dropdown('id_perumahan', $inputidperumahan, '', 'class="form-control" Required');
        } else {
            $perum = $this->M_Administrator->getid('perumahan', 'id_user', $id);
            $inputidperumahan = array(
                'type'             => 'text',
                'placeholder'     => 'ID Perumahan',
                'class'         => 'form-control',
                'READONLY'         => TRUE,
                'value'         => $perum['id_perumahan'],
                'name'             => 'id_perumahan'
            );
            $data['id_perumahan']    = form_input($inputidperumahan);
        }

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
            'Required'         => TRUE,
            'name'             => 'claster'
        );
        //publisher

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
        $this->session->set_flashdata('true', 'Di Update');
        $this->session->set_flashdata('alert', 'success');
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
        // var_dump($arr);
        $this->M_Administrator->insertdata('claster', $arr);
        $this->session->set_flashdata('true', 'Di Tambahkan');
        $this->session->set_flashdata('alert', 'success');
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
        $id = $this->session->userdata('id_user');
        if ($this->session->userdata('id_akses') == 1) {
            $data['not'] = $this->M_Administrator->getidAll('notif', 'user_tujuan', "");
            $id = $this->session->userdata('id_user');
            $up = ['status' => 1];
            $this->M_Administrator->updatedata('notif', 'user_tujuan', "", $up);
        } else {
            $id = $this->session->userdata('id_user');
            $data['not'] = $this->M_Administrator->getidAll('notif', 'user_tujuan', $id);
            $up = ['status' => 1];
            $this->M_Administrator->updatedata('notif', 'user_tujuan', $id, $up);
        }
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
        //iduser admin
        $admin = $this->session->userdata('id_user');

        $getcode = $this->db->query('Select max(id_perumahan) as maxKode FROM perumahan')->row_array();
        $no_urut = (int) substr($getcode['maxKode'], 3, 10);
        $no_urut++;
        $kode = 'PRU' . sprintf("%07s", $no_urut);
        // var_dump($kode);
        $tgl = date('Y-m-d');

        $not = [
            'id_user' => $admin,
            //id_user target notification nya
            'user_tujuan' => $id,
            'requerst' => "Data anda telah dikonfirmasi",
            'tgl' => $tgl,
            'icon' => 'fa-check-circle',
            'url' => 'Home/profil',
            'status' => 0,
        ];
        $data = [
            'id_akses' => 3,
            'status' => 1
        ];
        $buatkode = [
            'id_perumahan' => $kode,
            'id_user' => $id,
            'pic' => 'default.png'
        ];
        /**
         * 
         * make a logic duration contract
         * 
         **/
        $getTgl = $this->db->query("select paket.id_paket,paket.jml, paket.keterangan from payment inner join paket on payment.id_paket = paket.id_paket where payment.id_user='$id'")->row_array();
        $durasi = $getTgl['jml'];
        $keterangan = $getTgl['keterangan'];
        ($keterangan == 'bulan') ? $ket = 'month' : $ket = 'year';
        $batas_waktu = "$durasi $ket";
        $masa_aktif = date('Y-m-d', strtotime("+ $batas_waktu", strtotime($tgl))); //tambah tanggal sebanyak 6 bulan

        $contract = [
            'id_user' => $id,
            'tanggal' => $tgl,
            'masa_aktif' => $masa_aktif
        ];

        $this->M_Administrator->insertdata('notif', $not);
        $this->M_Administrator->updatedata('log_user', 'id_user', $id, $data);
        $this->M_Administrator->deletdata('payment', 'id_user', $id);
        $this->M_Administrator->insertdata('perumahan', $buatkode);
        $this->M_Administrator->insertdata('contract', $contract);
        redirect('Dashboard/pemesanan');
    }
    public function Getdatabyajax()
    {
        $kode = $this->input->post('provinsi');
        // $data['dt'] = $this->M_Administrator->getidAll($table, 'id_prov', $kode);
        // var_dump($data['dt']);
        // var_dump($kode);

        $toprint = '';
        // $prov = $this->M_Administrator->getid($table, 'id_prov', $kode);
        // // var_dump($prov);
        // if ($prov['id_prov'] == 0) {
        //     foreach ($data['dt'] as $v) {
        //         $toprint = $toprint . '<option value="' . $v->id_kota . '">' . $v->kota . '</option>';
        //     }
        // } else {
        //     $toprint = $toprint . '<option value="' . $prov['id_kota'] . '">' . $prov['kota'] . '</option>';
        // }
        $url = "https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=$kode";
        $getKotaApi = file_get_contents($url);
        $apiKota = json_decode($getKotaApi, true);
        foreach ($apiKota['kota_kabupaten'] as $v) {
            $toprint = $toprint . '<option value="' . $v['id'] . '">' . $v['nama'] . '</option>';
        }

        echo $toprint;
    }


    public function perumahan()
    {
        // $selectperum = ('perumahan.*');
        // $selectprov = ('provinsi.*');
        // $selectkota = ('kota.*');
        // $selectuser = ('user.*');
        // $joinprov = ('provinsi,provinsi.id_prov = perumahan.id_prov');
        // $joinkota = ('kota,kota.id_kota = perumahan.id_kota');
        // $data['perumahan'] = $this->M_Administrator->getperum($selectperum,  $selectuser, 'perumahan');
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/provinsi/';
        $readApi = file_get_contents($url);
        $proapi = json_decode($readApi, true);


        $id = $this->session->userdata('id_user');


        $where = ['id_user' => $id];
        $data['properum'] = $this->M_Administrator->innerThreedata($id);
        $data['prov'] = $proapi['provinsi'];
        $data['perumahan'] = $this->M_Administrator->getperum();
        // print_r($data['perumahan']);
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


    public function Actupdateperumahan()
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
        redirect('Dashboard/perumahan');
    }

    public function ActUploadPerum($id)
    {
        $data['properum'] = $this->db->get_where('perumahan', ['id_perumahan' => $id])->row_array();
        $temp = explode(".", $_FILES['foto']['name']);
        $nama_baru = round(microtime(true)) . '.' . end($temp);
        $pic = '';
        if ($_FILES['foto']['name'] != "") {
            $config['upload_path'] = 'assets/img-perumahan/';
            $config['allowed_types'] = 'png|jpg';
            $config['max_size'] = '1024000';
            $config['max_filename'] = '5000000';
            $config['encrypt_name'] = false;
            $config['file_name'] = $nama_baru;
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
        } else {
            $pic =  $data['properum']['pic'];
        }
        $data = [
            'pic' => $pic,
        ];
        // var_dump($data);
        $this->M_Administrator->updatedata('perumahan', 'id_perumahan', $id, $data);
        redirect('Dashboard/perumahan');
    }

    public function DeletePerumahan($id)
    {
        $data = $this->M_Administrator->getid('perumahan', 'id_perumahan', $id);
        $where = $data['id_user'];
        $update = [
            'status' => 1,
            'id_akses' => 2
        ];
        $this->M_Administrator->updatedata('log_user', 'id_user', $where, $update);
        // var_dump($data);
        $this->M_Administrator->deletdata('perumahan', 'id_perumahan', $id);
        $this->session->set_flashdata('true', 'Di Delete');
        $this->session->set_flashdata('alert', 'error');
        redirect('Dashboard/perumahan');
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
    public function EditProfil()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required', ['required' => 'Nama harus diisi!']);
        $this->form_validation->set_rules('notel', 'Telepon', 'numeric|required', ['required' => 'Telepone harus diisi contoh: 628989389832']);
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', ['required' => 'Alamat tidak boleh kosong !']);


        if ($this->form_validation->run() == FALSE) {
            $id = $this->session->userdata('id_user');
            $data['user'] = $this->db->get_where('user', ['id_user' => $id])->row_array();
            $data['judul'] = 'Halaman Profil';
            $this->HalamanAdmin('template/administrator/profil', $data);
        } else {
            $nohp = $this->input->post('notel', true);

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

            $pic = '';
            if ($_FILES['foto']['name'] != "") {
                $temp = explode(".", $_FILES['foto']['name']);
                $nama_baru = round(microtime(true)) . '.' . end($temp);
                // echo $nama_baru;

                $config['upload_path'] = 'assets/profil/';
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '1024000';
                $config['max_filename'] = '5000000';
                $config['file_name'] = $nama_baru;
                $config['encrypt_name'] = false;
                // echo $config['file_name'];
                if (file_exists('assets/profil/' . $config['file_name'])) {
                } else {
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('foto')) {
                        echo "upload error";
                    } else {
                        $pic = $config['file_name'];
                    }
                }
            } else {
                $pic = $this->input->post('img');
            }
            // var_dump($id);
            // echo $this->input->post('img', true);;
            // echo $hp;
            $data = [
                'nama' => $this->input->post('nama', true),
                'notel' => $hp,
                'email' => $this->input->post('email', true),
                'alamat' => $this->input->post('alamat', true),
                'pic' => $pic,
            ];
            // var_dump($data);

            $id = $this->session->userdata('id_user');
            $this->db->where('id_user', $id);
            $this->db->update('user', $data);
            $this->session->set_flashdata('true', '<div class="alert alert-danger" role="alert">Diupdate</div>');
            redirect('Dashboard/profiluser');
        }
    }
    public function GetIdPerumahanByAjax()
    {
        $kode = $this->input->post('id_perumahan');
        $toprint = '';
        $cluster = $this->db->get_where('claster', ['id_perumahan' => $kode])->result_array();
        foreach ($cluster as $p) {
            $toprint = $toprint . '<option value="' . $p['id_claster'] . '">' . $p['claster'] . '</option>';
        }

        echo $toprint;
    }
    public function GetIdUserByAjax()
    {
        $kode = $this->input->post('id_perumahan');
        $cluster = $this->db->get_where('perumahan', ['id_perumahan' => $kode])->row_array();
        echo $cluster['id_user'];
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
        if ($this->session->userdata('id_akses') == 1) {
            $data['perum'] = $this->M_Administrator->getdata('perumahan');
            // $data['perum'] = $this->M_Administrator->getid('perumahan');
            $data['claster'] = $this->M_Administrator->getdata('claster');
            $cluster[''] = '-- Pilih cluster --';
            foreach ($data['claster'] as $dt) {
                $cluster[$dt->id_claster] = $dt->claster;
            }
            $perumahan[''] = '-- Pilih perumahan --';
            foreach ($data['perum'] as $td) {
                $perumahan[$td->id_perumahan] = $td->nm_perumahan;
            }
            $iduser = [
                'type' => 'hidden',
                'name' => 'id_user',
                'class' => 'form-control iduser',
                'readonly' => true,
                'placeholder' => 'masukanid'
            ];

            $form['id_perumahan'] = form_dropdown('idperumahan', $perumahan, '', 'class="form-control perumahan"'); //name,option,value.class
            $form['claster'] = form_dropdown('cluster', '', '', 'id="kategori" class="form-control claster"'); //name,option,value.class

        } else {
            $idprmh = $this->M_Administrator->getid('perumahan', 'id_user', $iduser);
            $data['claster'] = $this->M_Administrator->getidAll('claster', 'id_perumahan', $idprmh['id_perumahan']);
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
            $cluster[''] = '-- Pilih cluster --';
            foreach ($data['claster'] as $dt) {
                $cluster[$dt->id_claster] = $dt->claster;

                /***
                 * end dropdown
                 */
            }
            $form['id_perumahan'] = form_input($idperumahan);
            $form['claster'] = form_dropdown('cluster', $cluster, '', 'id="kategori" class="form-control"'); //name,option,value.class

        }

        // var_dump($cluster);
        $id = [
            'type' => 'hidden',
            'name' => 'id',
            'class' => 'form-control',
            'value' => $idperum,
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
            $temp = explode(".", $_FILES['gambar']['name']);
            $nama_baru = round(microtime(true)) . '.' . end($temp);
            // echo $nama_baru;

            $config['file_name'] = $nama_baru;
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
        }
        // var_dump($data);
        $this->M_Administrator->insertdata('perum', $data);
        $this->session->set_flashdata('true', 'Di Tambahkan');
        $this->session->set_flashdata('alert', 'success');
        redirect('Dashboard/Perum');
    }
    public function ActUpdatePerum()
    {
        if ($_FILES['gambar']['name'] != "") {
            $temp = explode(".", $_FILES['gambar']['name']);
            $nama_baru = round(microtime(true)) . '.' . end($temp);
            // echo $nama_baru;

            $config['file_name'] = $nama_baru;
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
        $this->session->set_flashdata('true', 'Di Edit');
        $this->session->set_flashdata('alert', 'success');
        redirect('Dashboard/Perum');
    }
    public function Deleteclaster($id)
    {
        $this->M_Administrator->deletdata('claster', 'id_claster', $id);
        $this->session->set_flashdata('true', 'Di Delete');
        $this->session->set_flashdata('alert', 'error');
        // echo json_encode($db)
        redirect('Dashboard/cluster');
    }
    public function Deleteperum($id)
    {
        // $id = $this->input->get('id');
        $this->M_Administrator->deletdata('perum', 'id_perum', $id);
        // echo json_encode($db)
        $this->session->set_flashdata('true', 'Di Hapus');
        $this->session->set_flashdata('alert', 'error');
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
    public function Bookingcart()
    {
        // $data['rumah'] = $this->M_Home->getid('rumah', 'id_rumah', $id);
        $this->load->model('M_Home');
        error_reporting(0);
        $id = $this->session->userdata('id_user');
        if ($id != "") {
            $data['cart'] = $this->M_Home->hitungcart();
            $oop = $this->M_Home->getidall('booking', 'user', $id);
            foreach ($oop as $t) :
                $get = $t->id;
                $data['bookcart'] = $this->M_Home->getcart($get)->result();
            endforeach;
        }
        $this->HalamanAdmin('user/booking', $data);
    }
    public function UploadPerum($id)
    {
        $pic = '';
        if ($_FILES['foto']['name'] != "") {
            $temp = explode(".", $_FILES['foto']['name']);
            $nama_baru = round(microtime(true)) . '.' . end($temp);
            // echo $nama_baru;

            $config['file_name'] = $nama_baru;
            $config['upload_path'] = 'assets/img-perumahan/';
            $config['allowed_types'] = 'png|jpg';
            $config['max_size'] = '1024000';
            $config['max_filename'] = '5000000';
            $config['encrypt_name'] = false;
            // $config['file_name'] = $_FILES['foto']['name'];
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
        } else {
            $pic = $this->input->post('img');
        }
        $data = [
            'pic' => $pic,
        ];
        // var_dump($data);
        $this->M_Administrator->updatedata('perumahan', 'id_perumahan', $id, $data);
        // var_dump($id);
        redirect('Dashboard');
    }
    // mengirim pesan pembayaran gagal pada user
    public function kirimpesan()
    {
        $tgl = date('Y-m-d');
        $id = $this->input->post('id');
        $req = $this->input->post('massage');
        $admin = $this->session->userdata('id_user');

        $not = [
            'id_user' => $admin,
            //id_user target notification nya
            'user_tujuan' => $id,
            'requerst' => $req,
            'tgl' => $tgl,
            'icon' => 'exclamation',
            'url' => 'Home/profil',
            'status' => 0,
        ];
        $data = [
            'status' => 0
        ];
        $this->M_Administrator->insertdata('notif', $not);
        $this->M_Administrator->updatedata('payment', 'id_user', $id, $data);
        $this->session->set_flashdata('true', 'Di Kirim');
        $this->session->set_flashdata('alert', 'success');
        redirect('Dashboard/pemesanan');
    }
    /**
     * 
     * laporan pembelian paket
     * 
     */

    public function lap_pembelian()
    {
        $data['trans'] = $this->db->query("select * from histori_transaksi")->result();
        $this->HalamanAdmin("master/history_pembayaran", $data);
    }

    public function ChangePassword()
    {
        $id = $this->session->userdata('id_user');
        $data['get'] = $this->M_Administrator->getid('log_user', 'id_user', $id);
        $this->HalamanAdmin('master/ganti_password', $data);
    }

    public function actChangePassword()
    {
        $id = $this->session->userdata('id_user');
        $data['get'] = $this->M_Administrator->getid('log_user', 'id_user', $id);

        $this->form_validation->set_rules('username', 'Username', 'alpha|required', ['required' => 'Username tidak boleh kosong !']);
        $this->form_validation->set_rules('passlama', 'PasswordLama', 'required|trim', ['required' => 'Password Lama tidak boleh kosong !']);
        $this->form_validation->set_rules('passbaru', 'PasswordBaru', 'required|trim|matches[passconfirm]', ['required' => 'Password Baru tidak boleh kosong !', 'matches' => 'Password tidak sama']);
        $this->form_validation->set_rules('passconfirm', 'passconfirm', 'required|trim|matches[passbaru]', ['required' => 'Password lama tidak boleh kosong !', 'matches' => 'Password tidak sama']);
        if ($this->form_validation->run() == false) {
            $this->HalamanAdmin('master/ganti_password', $data);
        } else {

            $psbaru = md5($this->input->post('passconfirm'));
            // $data['get']['password']
            if ($data['get']['password'] == md5($this->input->post('passlama'))) {
                $data = [
                    'username' => $this->input->post('username'),
                    'password' => $psbaru,
                ];
                $this->M_Administrator->updatedata('log_user', 'id_user', $id, $data);
                redirect('Dashboard');
                echo $this->input->post('passlama');
            } else {
                $this->session->set_flashdata('false', 'Password Lama Salah');
                $this->session->set_flashdata('alert', 'warning');
                redirect('Dashboard/actChangePassword');
            }
        }
    }
}
