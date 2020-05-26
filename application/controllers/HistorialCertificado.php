<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class HistorialCertificado extends CI_Controller
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
		
		if ($perfil == 1){
			$datos['arrCertificados'] = $this->Certificado->obtenerHistorialCertTotal();
			$datos['arrAno'] = null;
		}
		else{
			$datos['arrCertificados'] = NULL;
			$datos['arrAno'] = $this->Certificado->obtenerAnoUsuario($nombreUsuario);
		}
		
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('historialCertificado',$datos);
		$this->load->view('footer');
	}
	
	
	public function obtieneAnoCliente()
	{
		if ($this->input->is_ajax_request()) {
			$idCliente =  $this->input->post('idCliente');

			if ($idCliente) {
				$anos = $this->Certificado->obtenerAnoCliente($idCliente);
				if($anos != null){
					if (count($anos) > 0) {
						echo '<option selected value="0">Seleccione</option>';
						foreach ($anos as $ano => $key) {
							echo '<option value="'.$key["ano"].'">'.$key["ano"].'</option>';
						}
					} else {
						echo '<option selected value="0">Seleccione</option>';
					}
				} else {
					echo '<option selected value="0">Seleccione</option>';
				}
			} else {
				echo '<option selected value="0">Seleccione</option>';
			}
		} else {
			echo -3;
		}
	} 
	
	
	public function obtieneMesCliente()
	{
		if ($this->input->is_ajax_request()) {
			$idCliente =  $this->input->post('idCliente');
			$idAnoCert =  $this->input->post('idAnoCert');
			
			if ($idCliente) {
				$meses = $this->Certificado->obtieneMesVigente($idAnoCert, $idCliente);
				if ($meses != null) {
					if (count($meses) > 0) {
						echo '<option style="background-color:red;" value="0">Todos</option>';
						echo '<option selected value="">Seleccione</option>';
						foreach ($meses as $mes => $key) {
							echo '<option value="'.$key["id_mes"].'">'.$key["desc_mes"].'</option>';
						}
					} else {
						echo '<option selected value="">Seleccione</option>';
					}
				} else {
					echo '<option selected value="">Seleccione</option>';
				}
			} else {
				echo '<option selected value="">Seleccione</option>';
			}
		} else {
			echo -3;
		}
	} 
	
	public function obtieneCertificadosCliente()
	{
		if ($this->input->is_ajax_request()) {
			$idCliente =  $this->input->post('idCliente');
			$idAnoCert =  $this->input->post('idAnoCert');
			$idMesCert =  $this->input->post('idMesCert');

			$arrCertificados = $this->Certificado->obtenerHistorialCertClientes($idCliente, $idAnoCert, $idMesCert);
			
				
			if ($arrCertificados != null) {
				if (count($arrCertificados) > 0) {
						$i = 1;
						foreach ($arrCertificados as $index => $key) {
							echo"<tr>";
							echo '<td>'.$i.'</td>';
							echo '<td>'.$key["nombre_cliente"].'</td>';
							echo '<td>'.$key["codigo_poliza"].'</td>';
							echo '<td>'.$key["id_certificado"].'</td>';
							echo '<td>'.$key["fecha_emision"].'</td>';
							echo '<td>'.$key["usuario"].'</td>';
							echo '<td style="text-align: center;">
										<a class="idDescargarCertificado">
													<span class="glyphicon glyphicon-download-alt"></span>
												</a>
											</td>';
							echo '<td style="display:none">'.$key["id_cliente"].'</td>';
							echo '<td style="display:none">'.$key["id_poliza"].'</td>';
							echo '<td style="display:none">'.$key["id_pais_emision"].'</td>';
							echo'</tr>';
							$i = $i+1;
						}
					}else{
						echo "<tr>";
						echo '<td colspan="7"><div class="alert alert-warning" role="alert"> El cliente no posee certificados emitidos</div></td>';
						echo "</tr>";
					}		
			} else {
				echo "<tr>";
				echo '<td colspan="7"><div class="alert alert-warning" role="alert"> El cliente no posee certificados emitidos</div></td>';
				echo "</tr>";
			}
		} else {
			echo -3;
		}
	} 
	
}

?>