<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		require_once  'vendor/autoload.php';
		
		$mpdf = new \Mpdf\Mpdf();
		$html = $this->load->view('certificado_chile',[],true);
		$mpdf->WriteHTML($html);
		$mpdf->Output(); // opens in browser
		//$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
	}
}