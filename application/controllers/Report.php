<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
    }
    public function laporan_penjualan()
    {

        $dompdf = new Dompdf();

        $id = $this->session->userdata('id_user');
        if ($this->session->userdata('id_akses') == 1) {
            $data['terjual'] = $this->db->query('select history_penjualan.*,user.nama, perum.type,perum.pic, perum.kategori,perum.alamat, claster.claster,perumahan.nm_perumahan from history_penjualan inner join perum on perum.id_perum = history_penjualan.id_perum left join perumahan on perumahan.id_perumahan=perum.id_perumahan left join claster on claster.id_claster=perum.id_claster left join user on user.id_user=history_penjualan.id_user ')->result();
        } else {
            $user = $this->db->get_where('user', ['id_user' => $id])->row_array();
            $data['terjual'] = $this->db->query('select history_penjualan.*,user.nama, perum.type,perum.pic, perum.kategori,perum.alamat, claster.claster,perumahan.nm_perumahan from history_penjualan inner join perum on perum.id_perum = history_penjualan.id_perum left join perumahan on perumahan.id_perumahan=perum.id_perumahan left join claster on claster.id_claster=perum.id_claster left join user on user.id_user=history_penjualan.id_user where perum.id_user ="' . $id . '"')->result();
        }

        // print_r($data['terjual']);




        @$data['name'] = $user['nama'];

        $html = $this->load->view('Report/penjualanPDF', $data, true);
        $dompdf->load_html($html);
        $dompdf->set_paper('A4', 'landscape');
        $dompdf->render();
        $pdf = $dompdf->output();
        $dompdf->stream('laporanku.pdf', array("Attachment" => false));
    }
    public function laporan_transaksi()
    {

        $dompdf = new Dompdf();

        $data['trans'] = $this->db->query("select histori_transaksi.tanggal,histori_transaksi.keterangan as ket, perumahan.nm_perumahan,paket.*,user.nama from histori_transaksi inner join user on user.id_user=histori_transaksi.id_user inner join perumahan on perumahan.id_user=histori_transaksi.id_user inner join paket on paket.id_paket=histori_transaksi.paket")->result();






        // $data['dataku'] = $terjual;

        $html = $this->load->view('Report/transaksiPDF', $data, true);
        $dompdf->load_html($html);
        $dompdf->set_paper('A4', 'landscape');
        $dompdf->render();
        $pdf = $dompdf->output();
        $dompdf->stream('laporanku.pdf', array("Attachment" => false));
    }
}
