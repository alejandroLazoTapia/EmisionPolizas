<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class denunciaSiniestro extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("siniestro");
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
			$idCliente = '1';
			$idPoliza = '1';

			// obtenemos el array de clientes 
			$datos['arrClientes'] = $this->certificado->obtenerClientes($nombreUsuario);
			$datos['$arrSiniestros'] = $this->obtieneSiniestrosCLiente(); 
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('denunciaSiniestro',$datos);
			$this->load->view('footer');

	}
	
	
	public function obtieneSiniestrosCLiente(){
		$idCliente = $this->input->post('idClienteSiniestro');
		if ($idCliente) {
			$siniestros = $this->siniestro->getSinesterClient($idCliente);

			if ($siniestros != null) {
				foreach ($siniestros as $siniestro => $key) {
					print"<tr>";
					print '<td>'.$key["id_siniestro"].'</td>';
					print '<td>'.$key["id_certificado"].'</td>';
					print '<td>'.$key["fecha_ingreso"].'</td>';
					print '<td>'.$key["estado"].'</td>';
					print '<td style="text-align: center;"><a id="btnVerSiniestro" data-toggle="modal" data-target="#myModalVerSiniestro"><span class="glyphicon glyphicon-eye-open" ></span></a></td>';
					print"</tr>";
				}
			} else {
				print "<tr>";
				print '<td colspan="3"><div class="alert alert-warning" role="alert"> El cliente no posee siniestros ingresados</div></td>';
				print "</tr>";
			}
		}else{
			echo NULL;
		}
	}
		

	public function guardarSiniestro()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
	if ($this->input->is_ajax_request()) {
		
			$id_cliente = $this->input->post('idClienteSiniestro');
			$id_poliza = $this->input->post('idPolizaSiniestro');
			$id_certificado = $this->input->post('idCertificadoSiniestro');
			$detalle = $this->input->post('idDetalle');
			$monto = $this->input->post('idMonto');
			$fecha_siniestro = $this->input->post('idFecha');
			$adjunto = $this->input->post('Base64Img');
			
	
			if ($this->siniestro->existSinister($id_certificado)==FALSE) {
				$data = [
					"id_cliente" => $id_cliente,
					"id_poliza" => $id_poliza,
					"id_certificado" => $id_certificado,
					"detalle" => $detalle,
					"monto" => $monto,
					"fecha_siniestro" => $fecha_siniestro,
					"adjunto" => $adjunto,
					"id_estado" => 1,
					"estado_reg" => 1
				];
				$this->db->set('fecha_reg', 'NOW()', FALSE);
				$this->db->set('fecha_mod', 'NOW()', FALSE);
				$nroSinester = $this->siniestro->insertSinister($data);
				if ($nroSinester > 0) {
					echo $nroSinester;
				} else {
					echo -1; // no inserto
				}
			} else {
				echo -2; //ya existe el cliente
			}
		} else {
			echo -5;  // no entro al ajax
		}
	}

}

?>