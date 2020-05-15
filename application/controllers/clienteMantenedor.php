<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clienteMantenedor extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("cliente");
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
		$datos['arrClientes'] = $this->cliente->getAllClient();

		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('clienteMantenedor',$datos);
		$this->load->view('footer');
	}
	
	public function guardarCliente()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {

			$nombre = $this->input->post('idNombreCliente');
			$rut = $this->input->post('idRut');
			$dv = $this->input->post('idDv');
			$id_grup = $this->input->post('idGrupo');
			$direccion = $this->input->post('idDireccionCliente');
			$condiciones = $this->input->post('idCondiciones');
			$telefono = $this->input->post('idTelefono');
			$id_grupo = 0;
			$fila = $this->cliente->newId();
			if ($this->cliente->existClient($rut)==FALSE)
			{
				if ($id_grup == 0) {
					$id_grupo = $fila->idNew;
				}else{
					$id_grupo = $id_grup;
				}

				$data = [
				"nombre" => $nombre,
				"rut" => $rut,
				"dv" => $dv,
				"id_grupo" => $id_grupo,
				"direccion" => $direccion,
				"condiciones" => $condiciones,
				"telefono" => $telefono,
				"estado_reg" => 1
				];
			
				if ($this->cliente->insertClient($data)) {
					echo 0;
				} else {
					echo 4; // no inserto
				}
			} else {
				echo 1; //ya existe el cliente
			}
		} else {
			echo 5;  // no entro al ajax
		}
	}	
	
	public function eliminaCliente()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {
			$idCliente = $this->input->post('idCliente');
			$data = [
				"estado_reg" => 0
			];
			if ($this->cliente->deleteClient($idCliente,$data)) {
				echo 0;
			} else {
				echo 1;
			}
		} else {
			echo 4;
		}
	}	
	
	public function actualizarCliente()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {
			$idCliente = $this->input->post('idCliente');
			$nombre = $this->input->post('idNombreCliente');
			$rut = $this->input->post('idRut');
			$dv = $this->input->post('idDv');
			$id_grupo = $this->input->post('idGrupo');
			$direccion = $this->input->post('idDireccionCliente');
			$condiciones = $this->input->post('idCondiciones');
			$telefono = $this->input->post('idTelefono');

			$data = [
				"nombre" => $nombre,
				"rut" => $rut,
				"dv" => $dv,
				"id_grupo" => $id_grupo,
				"direccion" => $direccion,
				"condiciones" => $condiciones,
				"telefono" => $telefono,
			];
			
			if ($this->cliente->updateClient($idCliente,$data)) {
				echo 2;
			} else {
				echo 3;
			}
		} else {
			echo 4;
		}
	}	
	
	public function obtienePolizasCLiente()
	{
		$idCliente = $this->input->post('idCliente');

		if ($idCliente) {

			$tipoPolizas = $this->cliente->getPolicyClient($idCliente);
			if ($tipoPolizas != null) {
				foreach ($tipoPolizas as $tipoPoliza => $key) {
					print"<tr>";
					print '<td>'.$key["codigo_poliza"].'</td>';
					print '<td>'.$key["desc_poliza"].'</td>';
					print '<td style="text-align: center;"><a id="btnDelPolicy" data-toggle="modal" data-target="#myModalDelPolicy"><span class="glyphicon glyphicon-remove" ></span></a></td>';
					print '<td style="display:none">'.$key["id_poliza"].'</td>';
					print"<tr>";
				}
			} else {
				print "<tr>";
				print '<td colspan="3"><div class="alert alert-warning" role="alert"> No existen Pólizas ingresadas</div></td>';
				print "</tr>";
			}
		} 
	}
	
	public function obtieneAFavorCLiente()
	{
		$idCliente = $this->input->post('idCliente');

		if ($idCliente) {

			$aFavors = $this->cliente->getAFavorClient($idCliente);
			if ($aFavors != null) {
				$nro = 1;
				foreach ($aFavors as $aFavor => $key) {
					print"<tr>";
					print '<td>'.$nro.'</td>';
					print '<td>'.$key["nombre_a_favor"].'</td>';
					print '<td style="text-align: center;"><a id="btnDelAFavor" data-toggle="modal" data-target="#myModalDelAFavor"><span class="glyphicon glyphicon-remove" ></span></a></td>';
					print '<td style="display:none">'.$key["id_a_favor"].'</td>';
					print"</tr>";
					$nro = $nro +1;
				}
			} else {
				print "<tr>";
				print '<td colspan="3"><div class="alert alert-warning" role="alert"> No existen Empesas a Favor ingresadas</div></td>';
				print "</tr>";
			}
		}
	}
	
	public function guardarPoliza()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {

			$id_cliente = $this->input->post('idClientePol');
			$desc_poliza = $this->input->post('idDescripcion');
			$codigo_poliza = $this->input->post('idCodigoPoliza');
			if ($this->cliente->existPolicy($codigo_poliza)==FALSE) {
				$data = [
					"id_cliente" => $id_cliente,
					"desc_poliza" => $desc_poliza,
					"codigo_poliza" => $codigo_poliza,
					"estado_reg" => 1
				];

				if ($this->cliente->insertPolicy($data)) {
					echo 0;
				} else {
					echo 1; // no inserto
				}
			} else {
				echo 2; //ya existe el cliente
			}
		} else {
			echo 5;  // no entro al ajax
		}
	}	
	
	public function eliminaPoliza()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {
			$idPoliza = $this->input->post('idPoliza');
			$data = [
				"estado_reg" => 0
			];
			
			if ($this->cliente->deletePolicy($idPoliza,$data)) {
				echo 0;
			} else {
				echo 1; // NO ELIMINO
			}
		} else {
			echo 4;
		}
	}	
	
	public function guardarAFavor()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {

			$id_cliente = $this->input->post('idClienteAFavor');
			$rut = $this->input->post('idRutAFavor');
			$dv = $this->input->post('idDvAFavor');
			$nombre = $this->input->post('idNombreAfavor');

			if ($this->cliente->existAFavor($rut)==FALSE) {
				$data = [
					"id_cliente" => $id_cliente,
					"rut" => $rut,
					"dv" => $dv,
					"nombre" => $nombre,
					"estado_reg" => 1
				];

				if ($this->cliente->insertAFavor($data)) {
					echo 0;
				} else {
					echo 1; // no inserto
				}
			} else {
				echo 2; //ya existe el cliente
			}
		} else {
			echo 5;  // no entro al ajax
		}
	}	
	
	public function eliminaAFavor()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {
			$idAFavor = $this->input->post('idAFavor');
			$data = [
				"estado_reg" => 0
			];

			if ($this->cliente->deleteAFavor($idAFavor,$data)) {
				echo 0;
			} else {
				echo 1; // NO ELIMINO
			}
		} else {
			echo 4;
		}
	}

}
?>