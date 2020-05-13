<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class cuentaUsuario extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("certificado");
		$this->load->model("usuario");
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
	}

	public function index()
	{
		//datos logeado
		$nombreUsuario = $this->session->userdata('usuario');
		$idUsuario = $this->session->userdata('id');

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
	
	public function guardarUsuario()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {

			$pass = $this->input->post('idContrasena');
			$id_grupo = $this->input->post('idCliente');
			$id_pais = $this->input->post('idPaisEmision');
			$id_perfil = $this->input->post('idPerfil');
			$nombre_usuario = $this->input->post('idNombreUsuario');
			$nombre = $this->input->post('idNombre');

			$data = [
			"nombre_usuario" => $nombre_usuario,
			"pass" => $pass,
			"id_grupo" => $id_grupo,			
			"id_pais" => $id_pais,
			"id_perfil" => $id_perfil,
			"nombre" => $nombre,
			"estado_reg" => 1
			];
			
			if ($this->usuario->existUser($nombre_usuario)==FALSE){
				if ($this->usuario->insertUser($data)) {
						echo 0;
				}else{
					echo 4;
				}
			}else{
				echo 1;
			}	
		} else {
			echo 4;
		}
	}	
	
	public function eliminaUsuario()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {
			$idUsuario = $this->input->post('idUsuario');
			$data = [
				"estado_reg" => 0
			];
			if ($this->usuario->deleteUser($idUsuario,$data)) {
					echo 0;
				} else {
					echo 1;
				}
		} else {
			echo 4;
		}
	}	
	
	public function actualizarUsuario()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {
			$idUsuario = $this->input->post('idUsuario');
			$pass = $this->input->post('idContrasena');
			$id_grupo = $this->input->post('idCliente');
			$id_pais = $this->input->post('idPaisEmision');
			$id_perfil = $this->input->post('idPerfil');
			$nombre_usuario = $this->input->post('idNombreUsuario');
			$nombre = $this->input->post('idNombre');

			$data = [
				"nombre_usuario" => $nombre_usuario,
				"pass" => $pass,
				"id_grupo" => $id_grupo,
				"id_pais" => $id_pais,
				"id_perfil" => $id_perfil,
				"nombre" => $nombre
			];
			if ($this->usuario->updateUser($idUsuario,$data)) {
				echo 2;
			} else {
				echo 3;
			}
		} else {
			echo 4;
		}
	}	
}
?>