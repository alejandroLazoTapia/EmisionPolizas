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
		$idPerfil = $this->session->userdata('perfil');
		// obtenemos el array de clientes 
		$datos['arrClientes'] = $this->Certificado->obtenerClientes($idUsuario, $idPerfil);
/*		$datos['arrAfavor'] = $this->obtieneAFavorCliente();*/
		$datos['arrPaisesEmision'] = $this->Certificado->obtenerPaisesEmision();
		/*$datos['arrPaises'] = $this->Certificado->obtenerPaises();*/
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
		$idUsuario = $this->session->userdata('id');
		$idPerfil = $this->session->userdata('perfil');
		if ($idPerfil) {
			$clientes = $this->Certificado->obtenerClientes($idUsuario, $idPerfil);
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
		$idUsuario = $this->session->userdata('id');
		$idPerfil = $this->session->userdata('perfil');
		
		if ($idUsuario) {
			$clientes = $this->Certificado->obtenerClientes($idUsuario, $idPerfil);
			if($clientes != null){
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
	
	public function obtieneDatosCliente()
	{
		$idCliente = $this->input->post('idCliente');
		$Datoscliente = $this->Certificado->obtenerDatosClientes($idCliente);
		echo(json_encode($Datoscliente));
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
	
	public function obtieneCertificadoPrevio()
	{
		$idCliente = $this->input->post('idCliente');
		$idPolizas = $this->input->post('idPoliza');
		$idCertificado = $this->input->post('idCertificado');

		$certificadoPrevio = $this->Certificado->obtenerCertificadoPrevio($idCliente, $idPolizas, $idCertificado);
		echo(json_encode($certificadoPrevio));
		//print_r($certificadoPrevio);
	}
	
	public function guardarCertificado()
	{
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX
		if ($this->input->is_ajax_request()) {
			$id_cliente = $this->input->post('idCliente');
			$id_poliza = $this->input->post('idPoliza');
/*			$id_a_favor = $this->input->post('idAFavor');*/
			$id_pais_emision = $this->input->post('idPaisEmision');
			$direccion_envio = $this->input->post('idDireccion');
			$referencia_interna = $this->input->post('idRefInterna');
			$id_moneda = $this->input->post('idMoneda');
			$deducible = $this->input->post('idDeducible');
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
			$pais_origen = $this->input->post('idPaisOrigen');
			$ciudad_origen = $this->input->post('idCiudadOrigen');
			$puerto_origen = $this->input->post('idPuertoOrigen');
			$pais_destino = $this->input->post('idPaisDestino');
			$ciudad_destino = $this->input->post('idCiudadDestino');
			$puerto_destino = $this->input->post('idPuertoDestino');

				$data = [
					"id_cliente" => $id_cliente,
					"id_poliza" => $id_poliza,
					"id_pais_emision" => $id_pais_emision,
					"direccion_envio" => $direccion_envio,
					"referencia_interna" => $referencia_interna,
					"id_moneda" => $id_moneda,
					"deducible" => $deducible,
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
					"pais_origen" => $pais_origen,
					"ciudad_origen" => $ciudad_origen,
					"puerto_origen" => $puerto_origen,
					"pais_destino" => $pais_destino,
					"ciudad_destino" => $ciudad_destino,
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
/*			$id_a_favor = $this->input->post('idAFavor');*/
			$id_pais_emision = $this->input->post('idPaisEmision');
			$direccion_envio = $this->input->post('idDireccion');
			$referencia_interna = $this->input->post('idRefInterna');
			$id_moneda = $this->input->post('idMoneda');
			$deducible = $this->input->post('idDeducible');
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
			$pais_origen = $this->input->post('idPaisOrigen');
			$ciudad_origen = $this->input->post('idCiudadOrigen');
			$puerto_origen = $this->input->post('idPuertoOrigen');
			$pais_destino = $this->input->post('idPaisDestino');
			$ciudad_destino = $this->input->post('idCiudadDestino');
			$puerto_destino = $this->input->post('idPuertoDestino');

			$data = [
				"id_cliente" => $id_cliente,
				"id_poliza" => $id_poliza,
/*				"id_a_favor" => $id_a_favor,*/
				"id_pais_emision" => $id_pais_emision,
				"direccion_envio" => $direccion_envio,
				"referencia_interna" => $referencia_interna,
				"id_moneda" => $id_moneda,
				"deducible" => $deducible,
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
				"pais_origen" => $pais_origen,
				"ciudad_origen" => $ciudad_origen,
				"puerto_origen" => $puerto_origen,
				"pais_destino" => $pais_destino,
				"ciudad_destino" => $ciudad_destino,
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
			$mpdf->SetAutoPageBreak(true,2);
			$html = $this->load->view('certificado_chile', $data ,true);
		}else{
			$data['certificado'] = $this->Certificado->obtenerCertificadoPeru($idCliente, $idPolizas, $idCertificado);
			$mpdf->showImageErrors = true;
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->SetAutoPageBreak(true,2);
			$html = $this->load->view('certificado_peru', $data ,true);
		}
		
		$mpdf->WriteHTML($html);
		$mpdf->Output(); // opens in browser
	}
	
	
	
	
}
?>