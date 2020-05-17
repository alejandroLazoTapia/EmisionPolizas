<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class formularioEmision extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("certificado");
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

		//CARGAMOS LOS MODELS
		$this->load->model('certificado');
		// obtenemos el array de clientes 
		$datos['arrClientes'] = $this->certificado->obtenerClientes($nombreUsuario);
		$datos['arrAfavor'] = $this->obtieneAFavorCliente();
		$datos['arrPaisesEmision'] = $this->certificado->obtenerPaisesEmision();
		$datos['arrPaises'] = $this->certificado->obtenerPaises();
		$datos['arrMoneda'] = $this->certificado->obtenerMonedas();
		$datos['arrClausula'] = $this->certificado->obtenerClausulas();
		$datos['arrTipoEmbalaje'] = $this->certificado->obtenerTipoEmbalaje();
		$datos['arrTransporte'] = $this->certificado->obtenerTipoTransporte();
		
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('formularioEmision',$datos);
		$this->load->view('footer');
			
	}
	
	

	public function obtieneTipoPoliza()
	{
		$idCliente = $this->input->post('idCliente');

		if ($idCliente) {
			$this->load->model('certificado');
			$tipoPolizas = $this->certificado->obtenerPolizasCliente($idCliente);
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
			$this->load->model('certificado');
			$tipoPolizas = $this->certificado->obtenerPolizasCliente($idCliente);
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
			$this->load->model('certificado');
			$Certificados = $this->certificado->obtenerCertificadosCliente($idCliente, $idPoliza);
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
			$this->load->model('cliente');
			$AFavors = $this->cliente->getAFavorClient($idCliente);
			if ($AFavors == null) {
				echo '<option value="0">Seleccione</option>';
			} else {
				echo '<option value="">Seleccione</option>';
				foreach ($AFavors as $AFavor => $key) {
					echo '<option value="'.$key["id_a_favor"].'">'.$key["nombre_a_favor"].'</option>';
				}
			}
		} else {
			echo '<option value="">Seleccione</option>';
		}
	}
	
	
	public function obtieneCertificadoPrevio()
	{
		$idCliente = $this->input->post('idCliente');
		$idPolizas = $this->input->post('idPoliza');
		$idCertificado = $this->input->post('idCertificado');
		$this->load->model('certificado');
		$certificadoPrevio = $this->certificado->obtenerCertificadoPrevio($idCliente, $idPolizas, $idCertificado);
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
				$IdCert = $this->certificado->ingresarCertificado($data);
				
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

			if ($this->certificado->actualizarCertificado($id_certificado,$data)) {
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

			if ($this->certificado->eliminarCertificado($id_certificado,$data)) {
				
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
		
		if ($idPaisEmisio == 81){
			$data['certificado'] = $this->certificado->obtenerCertificadoChile($idCliente, $idPolizas, $idCertificado);
			$mpdf = new \Mpdf\Mpdf();
			$html = $this->load->view('certificado_chile', $data ,true);
		}else{
			$data['certificado'] = $this->certificado->obtenerCertificadoPeru($idCliente, $idPolizas, $idCertificado);
			$mpdf = new \Mpdf\Mpdf();
			$html = $this->load->view('certificado_peru', $data ,true);
		}
		
		$mpdf->WriteHTML($html);
		$mpdf->Output(); // opens in browser
	}
	
	
	
	
}
?>