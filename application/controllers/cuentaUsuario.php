<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class cuentaUsuario extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("certificado");
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
	}

	public function index()
	{
		//datos logeado
		$nombreUsuario = $this->session->userdata('usuario');
		$idUsuario = $this->session->userdata('id');

		//CARGAMOS LOS MODELS
		$this->load->model('certificado');
		$this->load->model('usuario');
		// obtenemos el array de clientes
		$datos['arrUsuarios'] = $this->usuario->getUsers();
		$datos['arrPerfiles'] = $this->usuario->getProfiles();
		$datos['arrClientes'] = $this->certificado->obtenerAllClient();
		$datos['arrPaisesEmision'] = $this->certificado->obtenerPaisesEmision();

		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('cuentaUsuario',$datos);
		$this->load->view('footer');
	}
}
?>