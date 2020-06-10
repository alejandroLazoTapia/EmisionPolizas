<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClienteMantenedor extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cliente");
		$this->load->model("Usuario");
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
	}

	public function index()
	{
		//datos logeado
		$nombreUsuario = $this->session->userdata('usuario');
		$idUsuario = $this->session->userdata('id');
		$idPerfil = $this->session->userdata('perfil');
		// obtenemos el array de clientes
		$datos['arrClientes'] = $this->Cliente->getAllClient($idUsuario, $idPerfil);
		$datos['arrUsuarios'] = $this->Usuario->getUsersCliente($idUsuario, $idPerfil);
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
			$rut_dni = $this->input->post('idRutDni');
			$id_usuario = $this->input->post('idUsuario');
			$direccion = $this->input->post('idDireccionCliente');
			$condiciones = $this->input->post('idCondiciones');
			$telefono = $this->input->post('idTelefono');
			
			if ($this->Cliente->existClient($rut_dni)==FALSE)
			{

				$data = [
				"id_usuario" => $id_usuario,
				"rut_dni" => $rut_dni,
				"nombre" => $nombre,
				"direccion" => $direccion,
				"condiciones" => $condiciones,
				"telefono" => $telefono,
				"estado_reg" => 1
				];
			
				if ($this->Cliente->insertClient($data)) {
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
			if ($this->Cliente->deleteClient($idCliente,$data)) {
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
			$rut_dni = $this->input->post('idRutDni');
			$id_usuario = $this->input->post('idUsuario');
			$direccion = $this->input->post('idDireccionCliente');
			$condiciones = $this->input->post('idCondiciones');
			$telefono = $this->input->post('idTelefono');
			

			$data = [
				"nombre" => $nombre,
				"rut_dni" => $rut_dni,
				"id_usuario" => $id_usuario,
				"direccion" => $direccion,
				"condiciones" => $condiciones,
				"telefono" => $telefono,
			];
			
			if ($this->Cliente->updateClient($idCliente,$data)) {
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

		if ($idCliente > 0) {

			$tipoPolizas = $this->Cliente->getPolicyClient($idCliente);
			
			
			if ($tipoPolizas) {
				foreach ($tipoPolizas as $tipoPoliza => $key) {
					echo'<tr>';
					echo '<td>'.$key["codigo_poliza"].'</td>';
					echo '<td>'.$key["desc_poliza"].'</td>';
					echo '<td style="text-align: center;"><a id="btnDelPolicy" data-toggle="modal" data-target="#myModalDelPolicy"><span class="glyphicon glyphicon-remove" ></span></a></td>';
					echo '<td style="display:none">'.$key["id_poliza"].'</td>';
					echo'<tr>';
				}
			} else {
				echo '<tr>';
				echo '<td colspan="3"><div class="alert alert-warning" role="alert"> No existen Pólizas ingresadas</div></td>';
				echo '</tr>';
			}
		} else{
			echo '<tr>';
			echo '<td colspan="3"><div class="alert alert-warning" role="alert"> No existen Pólizas ingresadas</div></td>';
			echo '</tr>';
		}
	}
	
	
/*	
	public function obtieneAFavorCLiente()
	{
		$idCliente = $this->input->post('idCliente');

		if ($idCliente) {

			$aFavors = $this->Cliente->getAFavorClient($idCliente);
			if ($aFavors) {
				$nro = 1;
				foreach ($aFavors as $aFavor => $key) {
					echo "<tr>";
					echo '<td>'.$nro.'</td>';
					echo '<td>'.$key["nombre_a_favor"].'</td>';
					echo '<td style="text-align: center;"><a id="btnDelAFavor" data-toggle="modal" data-target="#myModalDelAFavor"><span class="glyphicon glyphicon-remove" ></span></a></td>';
					echo '<td style="display:none">'.$key["id_a_favor"].'</td>';
					echo"</tr>";
					$nro = $nro +1;
				}
			} else {
				echo "<tr>";
				echo '<td colspan="3"><div class="alert alert-warning" role="alert"> No existen Empesas a Favor ingresadas</div></td>';
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo '<td colspan="3"><div class="alert alert-warning" role="alert"> No existen Empesas a Favor ingresadas</div></td>';
			echo "</tr>";
		}
	}*/
	
	
	
	public function guardarPoliza()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {

			$id_cliente = $this->input->post('idClientePol');
			$desc_poliza = $this->input->post('idDescripcion');
			$codigo_poliza = $this->input->post('idCodigoPoliza');
			$via = $this->input->post('idVia');
		/*	if ($this->Cliente->existPolicy($codigo_poliza)==FALSE) {*/
				$data = [
					"id_cliente" => $id_cliente,
					"desc_poliza" => $desc_poliza,
					"codigo_poliza" => $codigo_poliza,
					"via" => $via,
					"estado_reg" => 1
				];

				if ($this->Cliente->insertPolicy($data)) {
					echo 0;
				} else {
					echo 1; // no inserto
				}
		/*	} else {
				echo 2; //ya existe el cliente
			}*/
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
			
			if ($this->Cliente->deletePolicy($idPoliza,$data)) {
				echo 0;
			} else {
				echo 1; // NO ELIMINO
			}
		} else {
			echo 4;
		}
	}	

/*	
	public function guardarAFavor()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {

			$id_cliente = $this->input->post('idClienteAFavor');
			$rut = $this->input->post('idRutAFavor');
			$dv = $this->input->post('idDvAFavor');
			$nombre = $this->input->post('idNombreAfavor');

			if ($this->Cliente->existAFavor($rut)==FALSE) {
				$data = [
					"id_cliente" => $id_cliente,
					"rut" => $rut,
					"dv" => $dv,
					"nombre" => $nombre,
					"estado_reg" => 1
				];

				if ($this->Cliente->insertAFavor($data)) {
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

			if ($this->Cliente->deleteAFavor($idAFavor,$data)) {
				echo 0;
			} else {
				echo 1; // NO ELIMINO
			}
		} else {
			echo 4;
		}
	}
*/

}
?>