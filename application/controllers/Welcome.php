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


	function __construct()
	{
		parent::__construct();
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function laporan_pdf()
	{
		$dompdf = new Dompdf();
		$data['dataku'] = array(
			"nama" => "Akbar Abustang",
			"title" => "Programmer"
		);

		$html = $this->load->view('laporan_pdf', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'landscape');
		$dompdf->render();
		$pdf = $dompdf->output();
		$dompdf->stream('laporanku.pdf', array("Attachment" => false));
	}
}
