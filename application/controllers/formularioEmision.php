<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FormularioEmision extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Certificado");
		$this->load->model("Cliente");
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

		// obtenemos el array de clientes 
		$datos['arrClientes'] = $this->Certificado->obtenerClientes($nombreUsuario);
		$datos['arrAfavor'] = $this->obtieneAFavorCliente();
		$datos['arrPaisesEmision'] = $this->Certificado->obtenerPaisesEmision();
		$datos['arrPaises'] = $this->Certificado->obtenerPaises();
		$datos['arrMoneda'] = $this->Certificado->obtenerMonedas();
		$datos['arrClausula'] = $this->Certificado->obtenerClausulas();
		$datos['arrTipoEmbalaje'] = $this->Certificado->obtenerTipoEmbalaje();
		$datos['arrTransporte'] = $this->Certificado->obtenerTipoTransporte();
		
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('formularioEmision',$datos);
		$this->load->view('footer');
			
	}
	
	public function obtieneClientesModal()
	{
		$nombreUsuario = $this->session->userdata('usuario');

		if ($nombreUsuario) {
			$clientes = $this->Certificado->obtenerClientes($nombreUsuario);
			if (count($clientes) == 1) {
				foreach ($clientes as $cliente => $key) {
					echo '<option selected value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
				}
			} else if (count($clientes) > 1) {
				echo '<option selected value="0">Seleccione</option>';
				foreach ($clientes as $cliente => $key) {
					echo '<option value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
				}
			} else{
				echo '<option selected value="0">Seleccione</option>';
			}
		} else {
			echo '<option selected value="0">Seleccione</option>';
		}
	}
	
	public function obtieneClientes()
	{
		$nombreUsuario = $this->session->userdata('usuario');

		if ($nombreUsuario) {
			$clientes = $this->Certificado->obtenerClientes($nombreUsuario);
			if($cliente != null){
				if (count($clientes) == 1) {
					foreach ($clientes as $cliente => $key) {
						echo '<option selected value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
					}
				} else if (count($clientes) > 1) {
					echo '<option selected value="">Seleccione</option>';
					foreach ($clientes as $cliente => $key) {
						echo '<option value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
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
	}
	

	public function obtieneTipoPoliza()
	{
		$idCliente = $this->input->post('idCliente');

		if ($idCliente) {

			$tipoPolizas = $this->Certificado->obtenerPolizasCliente($idCliente);
			if ($tipoPolizas == null) {
				echo '<option value="">Seleccione</option>';
			} else {
				echo '<option value="">Seleccione</option>';
				foreach ($tipoPolizas as $tipoPoliza => $key) {
					echo '<option value="'.$key["id_poliza"].'">'.$key["nombre_poliza"].'</option>';
				}
			}
		} else {
			echo '<option value="">Seleccione</option>';
		}
	}
	
	public function obtieneTipoPolizaModal()
	{
		$idCliente = $this->input->post('idCliente');

		if ($idCliente) {
			$tipoPolizas = $this->Certificado->obtenerPolizasCliente($idCliente);
			if ($tipoPolizas == null) {
			echo '<option value="0">Seleccione</option>';
			}else{
				echo '<option value="0">Seleccione</option>';
			foreach ($tipoPolizas as $tipoPoliza => $key) {
				echo '<option value="'.$key["id_poliza"].'">'.$key["nombre_poliza"].'</option>';
				}
			}
		} else {
			echo '<option value="0">Seleccione</option>';
		}
	}
	
	public function obtieneCertificadoPoliza()
	{
		$idCliente = $this->input->post('idCliente');
		$idPoliza = $this->input->post('idPoliza');

		if ($idCliente) {

			$Certificados = $this->Certificado->obtenerCertificadosCliente($idCliente, $idPoliza);
			if ($Certificados == null) {
				echo '<option value="0">Seleccione</option>';
			} else {
				echo '<option value="0">Seleccione</option>';
				foreach ($Certificados as $Certificado => $key) {
					echo '<option value="'.$key["id"].'">'.$key["id"].'</option>';
				}
			}
		} else {
			echo '<option value="0">Seleccione</option>';
		}
	}
	
	public function obtieneAFavorCliente()
	{
		$idCliente = $this->input->post('idCliente');

		if ($idCliente) {
			$AFavors = $this->Cliente->getAFavorClient($idCliente);
			if ($AFavors == null) {
				echo '<option value="0">Seleccione</option>';
			} else {
				echo '<option value="0">Seleccione</option>';
				foreach ($AFavors as $AFavor => $key) {
					echo '<option value="'.$key["id_a_favor"].'">'.$key["nombre_a_favor"].'</option>';
				}
			}
		} else {
			echo '';
		}
	}
	
	
	public function obtieneCertificadoPrevio()
	{
		$idCliente = $this->input->post('idCliente');
		$idPolizas = $this->input->post('idPoliza');
		$idCertificado = $this->input->post('idCertificado');
		$this->load->model('certificado');
		$certificadoPrevio = $this->Certificado->obtenerCertificadoPrevio($idCliente, $idPolizas, $idCertificado);
		echo(json_encode($certificadoPrevio));
		//print_r($certificadoPrevio);
	}
	
	public function obtieneCiudadesPais()
	{
		$idPais = $this->input->post('idPais');
		if ($idPais) {
			$this->load->model('certificado');
			$ciudades = $this->certificado->obtenerCiudadesPais($idPais);
			echo '<option value="">Seleccione</option>';
			foreach ($ciudades as $ciudad => $key) {
				echo '<option value="'.$key["id_region_estado"].'">'.$key["nombre_region_estado"].'</option>';
			}
		} else {
			echo '<option value="">Seleccione</option>';
		}
	}
	
	
	
	public function guardarCertificado()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {
			$id_cliente = $this->input->post('idCliente');
			$id_poliza = $this->input->post('idPoliza');
			$id_a_favor = $this->input->post('idAFavor');
			$id_pais_emision = $this->input->post('idPaisEmision');
			$direccion_envio = $this->input->post('idDireccion');
			$referencia_interna = $this->input->post('idRefInterna');
			$id_moneda = $this->input->post('idMoneda');
			$prima_minima = $this->input->post('idPrimaMinima');
			$monto_asegurado = $this->input->post('idMontoAsegurado');
			$tasa = $this->input->post('idTasa');
			$id_clausula = $this->input->post('idClausula');
			$prima = $this->input->post('idPrima');
			$fecha_embarque = $this->input->post('idFechaEmbarque');
			$fecha_arribo = $this->input->post('idFechaArribo');
			$guia_bl = $this->input->post('idGuiaBl');
			$nombre_linea = $this->input->post('idNomLineaNave');
			$nombre_nave = $this->input->post('idNomNave');
			$vuelo_nave = $this->input->post('idNumVueloNave');
			$id_tipo_embalaje = $this->input->post('idTipoEmbalaje');
			$desc_otro_tipo_embalaje = $this->input->post('idOtroTipEmb');
			$id_transporte = $this->input->post('idTransporte');
			$id_tipo_embarque = $this->input->post('idTipoEmbarque');
			$desc_mercaderia = $this->input->post('idDescMercaderia');
			$id_pais_origen = $this->input->post('idPaisOrigen');
			$id_est_reg_origen = $this->input->post('idCiudadOrigen');
			$puerto_origen = $this->input->post('idPuertoOrigen');
			$id_pais_destino = $this->input->post('idPaisDestino');
			$id_est_reg_destino = $this->input->post('idCiudadDestino');
			$puerto_destino = $this->input->post('idPuertoDestino');

				$data = [
					"id_cliente" => $id_cliente,
					"id_poliza" => $id_poliza,
					"id_a_favor" => $id_a_favor,
					"id_pais_emision" => $id_pais_emision,
					"direccion_envio" => $direccion_envio,
					"referencia_interna" => $referencia_interna,
					"id_moneda" => $id_moneda,
					"prima_minima" => $prima_minima,
					"monto_asegurado" => $monto_asegurado,
					"tasa" => $tasa,
					"id_clausula" => $id_clausula,
					"prima" => $prima,
					"fecha_embarque" => $fecha_embarque,
					"fecha_arribo" => $fecha_arribo,
					"guia_bl" => $guia_bl,
					"nombre_linea" => $nombre_linea,
					"nombre_nave" => $nombre_nave,
					"vuelo_nave" => $vuelo_nave,
					"id_tipo_embalaje" => $id_tipo_embalaje,
					"desc_otro_tipo_embalaje" => $desc_otro_tipo_embalaje,
					"id_transporte" => $id_transporte,
					"id_tipo_embarque" => $id_tipo_embarque,
					"desc_mercaderia" => $desc_mercaderia,
					"id_pais_origen" => $id_pais_origen,
					"id_est_reg_origen" => $id_est_reg_origen,
					"puerto_origen" => $puerto_origen,
					"id_pais_destino" => $id_pais_destino,
					"id_est_reg_destino" => $id_est_reg_destino,
					"puerto_destino" => $puerto_destino,
					"id_pais_transbordo" => 0,
					"transbordo" => FALSE,
					
					"usuario_reg" => $this->session->userdata('usuario'),
					"estado_reg" => 1
				];
				$this->db->set('fecha_reg', 'NOW()', FALSE);
				$this->db->set('fecha_mod', 'NOW()', FALSE);
				$IdCert = $this->Certificado->ingresarCertificado($data);
				
				if ($IdCert > 0) {
					echo $IdCert;
				} else {
					echo -1;
				}
		}else{
				echo -3;
			}
	}
	
	public function actualizaCertificado()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {
			$id_certificado = $this->input->post('idCertActivo');
			$id_cliente = $this->input->post('idCliente');
			$id_poliza = $this->input->post('idPoliza');
			$id_a_favor = $this->input->post('idAFavor');
			$id_pais_emision = $this->input->post('idPaisEmision');
			$direccion_envio = $this->input->post('idDireccion');
			$referencia_interna = $this->input->post('idRefInterna');
			$id_moneda = $this->input->post('idMoneda');
			$prima_minima = $this->input->post('idPrimaMinima');
			$monto_asegurado = $this->input->post('idMontoAsegurado');
			$tasa = $this->input->post('idTasa');
			$id_clausula = $this->input->post('idClausula');
			$prima = $this->input->post('idPrima');
			$fecha_embarque = $this->input->post('idFechaEmbarque');
			$fecha_arribo = $this->input->post('idFechaArribo');
			$guia_bl = $this->input->post('idGuiaBl');
			$nombre_linea = $this->input->post('idNomLineaNave');
			$nombre_nave = $this->input->post('idNomNave');
			$vuelo_nave = $this->input->post('idNumVueloNave');
			$id_tipo_embalaje = $this->input->post('idTipoEmbalaje');
			$desc_otro_tipo_embalaje = $this->input->post('idOtroTipEmb');
			$id_transporte = $this->input->post('idTransporte');
			$id_tipo_embarque = $this->input->post('idTipoEmbarque');
			$desc_mercaderia = $this->input->post('idDescMercaderia');
			$id_pais_origen = $this->input->post('idPaisOrigen');
			$id_est_reg_origen = $this->input->post('idCiudadOrigen');
			$puerto_origen = $this->input->post('idPuertoOrigen');
			$id_pais_destino = $this->input->post('idPaisDestino');
			$id_est_reg_destino = $this->input->post('idCiudadDestino');
			$puerto_destino = $this->input->post('idPuertoDestino');

			$data = [
				"id_cliente" => $id_cliente,
				"id_poliza" => $id_poliza,
				"id_a_favor" => $id_a_favor,
				"id_pais_emision" => $id_pais_emision,
				"direccion_envio" => $direccion_envio,
				"referencia_interna" => $referencia_interna,
				"id_moneda" => $id_moneda,
				"prima_minima" => $prima_minima,
				"monto_asegurado" => $monto_asegurado,
				"tasa" => $tasa,
				"id_clausula" => $id_clausula,
				"prima" => $prima,
				"fecha_embarque" => $fecha_embarque,
				"fecha_arribo" => $fecha_arribo,
				"guia_bl" => $guia_bl,
				"nombre_linea" => $nombre_linea,
				"nombre_nave" => $nombre_nave,
				"vuelo_nave" => $vuelo_nave,
				"id_tipo_embalaje" => $id_tipo_embalaje,
				"desc_otro_tipo_embalaje" => $desc_otro_tipo_embalaje,
				"id_transporte" => $id_transporte,
				"id_tipo_embarque" => $id_tipo_embarque,
				"desc_mercaderia" => $desc_mercaderia,
				"id_pais_origen" => $id_pais_origen,
				"id_est_reg_origen" => $id_est_reg_origen,
				"puerto_origen" => $puerto_origen,
				"id_pais_destino" => $id_pais_destino,
				"id_est_reg_destino" => $id_est_reg_destino,
				"puerto_destino" => $puerto_destino,
				"usuario_reg" => $this->session->userdata('usuario')
			];
			$this->db->set('fecha_mod', 'NOW()', FALSE);

			if ($this->Certificado->actualizarCertificado($id_certificado,$data)) {
					echo 0;
			} else {
				echo -2;
			}
		} else {
			echo -3;
		}
	}	
	
	
	public function eliminaCertificado()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {
			$id_certificado = $this->input->post('idCertActivo');

			$data = [
				"usuario_reg" => $this->session->userdata('usuario'),
				"estado_reg" => 0
			];
			$this->db->set('fecha_mod', 'NOW()', FALSE);

			if ($this->Certificado->eliminarCertificado($id_certificado,$data)) {
				
					echo 0;
			} else {
				echo 2;
			}
		} else {
			echo 3;
		}
	}	
	
	
	public function descargarPdf()
	{
		$idCliente = $this->input->post('idClientePdf');
		$idPolizas = $this->input->post('idPolizaPdf');
		$idCertificado = $this->input->post('idCertificadoPdf');
		$idPaisEmisio = $this->input->post('idPaisEmisionPdf');
		
		if ($idPaisEmisio == 81) {
			$data['certificado'] = $this->Certificado->obtenerCertificadoChile($idCliente, $idPolizas, $idCertificado);
			$mpdf->showImageErrors = true;
			$mpdf = new \Mpdf\Mpdf();
			$html = $this->load->view('certificado_chile', $data ,true);
		}else{
			$data['certificado'] = $this->Certificado->obtenerCertificadoPeru($idCliente, $idPolizas, $idCertificado);
			$mpdf->showImageErrors = true;
			$mpdf = new \Mpdf\Mpdf();
			$html = $this->load->view('certificado_peru', $data ,true);
		}
		
		$mpdf->WriteHTML($html);
		$mpdf->Output(); // opens in browser
	}
	
	
	
	
}
?>