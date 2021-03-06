<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DenunciaSiniestro extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Siniestro");
		$this->load->model("Certificado");
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

			$datos['arrPolizas'] = $this->Siniestro->getPolicyClientId($idUsuario);
			$datos['arrSiniestros'] = $this->Siniestro->getSinesterClientId($idUsuario);
			$datos['arrClientes'] = $this->Certificado->obtenerClientes($idUsuario, $idPerfil);

			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('denunciaSiniestro',$datos);
			$this->load->view('footer');

	}
	
	public function obtieneSiniestrosCLiente(){
		$idCliente = $this->input->post('idClienteSiniestro');
		$idUsuario = $this->session->userdata('id');
		$idPerfil = $this->session->userdata('perfil');
			$siniestros = $this->Siniestro->getSinesterClient($idCliente, $idUsuario, $idPerfil);
			

			if ($siniestros != null) {
				foreach ($siniestros as $siniestro => $key) {
					print"<tr>";
					echo '<td>'.$key["id_siniestro"].'</td>';
					echo '<td>'.$key["id_certificado"].'</td>';
					echo '<td>'.$key["poliza"].'</td>';
					echo '<td>'.$key["fecha_ingreso"].'</td>';
					echo '<td>'.$key["monto"].'</td>';
					print '<td style="text-align: center;"><a id="btnVerSiniestro" data-toggle="modal" data-target="#myModalSinester"><span class="glyphicon glyphicon-eye-open" style="color: red !important;"></span></a></td>';
					print"</tr>";
				}
			} else {
				print "<tr>";
				print '<td colspan="6" style="text-align: center"><div class="alert alert-warning" role="alert"> El cliente no posee siniestros ingresados</div></td>';
				print "</tr>";
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
			$extension = $this->input->post('idExtension');
			
			
	/*		echo var_dump($id_cliente);
			echo var_dump($id_poliza);
			echo var_dump($id_certificado);
			echo var_dump($detalle);
			echo var_dump($monto);			
			echo var_dump($fecha_siniestro);			
			echo var_dump($adjunto);	*/		
						
			
			if ($this->Siniestro->existSinister($id_certificado)==FALSE) {
				$data = [
					"id_cliente" => $id_cliente,
					"id_poliza" => $id_poliza,
					"id_certificado" => $id_certificado,
					"detalle" => $detalle,
					"monto" => $monto,
					"fecha_siniestro" => $fecha_siniestro,
					"adjunto" => $adjunto,
					"extension" => $extension,
					"id_estado" => 1,
					"estado_reg" => 1
				];
				$this->db->set('fecha_reg', 'NOW()', FALSE);
				$this->db->set('fecha_mod', 'NOW()', FALSE);
				
				$nroSinester = $this->Siniestro->insertSinister($data);
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
	
	public function obtieneDetalleSiniestro(){
		$idSiniestro = $this->input->post('idSiniestro');
		$idCertificado = $this->input->post('idCertificado');
		$DatosSiniestro = $this->Siniestro->getSinesterDetail($idSiniestro, $idCertificado);
		echo(json_encode($DatosSiniestro));
	}

}

?>