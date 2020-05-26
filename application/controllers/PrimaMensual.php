<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PrimaMensual extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Certificado");
		$this->db->query("SET lc_time_names = 'es_ES'");
		require_once  'vendor/autoload.php';
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
	}

	public function index()
	{
		//datos logeado
		$nombreUsuario = $this->session->userdata('usuario');
		$idUsuario = $this->session->userdata('id');
		$perfil = $this->session->userdata('perfil');

		// obtenemos el array de clientes
		$datos['arrClientes'] = $this->Certificado->obtenerClientes($idUsuario, $perfil);

		if ($perfil == 1) {
			$datos['arrAno'] = null;
		} else {
			$datos['arrAno'] = $this->Certificado->obtenerAnoUsuario($nombreUsuario);
		}

		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('primaMensual',$datos);
		$this->load->view('footer');
	}
}
