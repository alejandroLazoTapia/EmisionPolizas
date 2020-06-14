<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
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
	
	public function obtieneCertificadosClientes()
	{
		if ($this->input->is_ajax_request()) {
			$perfil = $this->session->userdata('perfil');
			$arrCertificados = $this->Certificado->obtenerHistorialCertTotal();
			
				
			if ($arrCertificados != null) {
				if (count($arrCertificados) > 0) {
						$i = 1;
						if($perfil == 2){
							foreach ($arrCertificados as $index => $key) {
							if($key['estado_reg'] == 0){
								echo '<tr style="background-color: #FCAAAA;">';
							}else{
								echo '<tr>';
							}
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
							echo '<td style="display:none">anulado</td>';		
									
							echo '<td style="display:none">'.$key["id_cliente"].'</td>';
							echo '<td style="display:none">'.$key["id_poliza"].'</td>';
							echo '<td style="display:none">'.$key["id_pais_emision"].'</td>';
							echo'</tr>';
							$i = $i+1;
							}
						}else{
						
						foreach ($arrCertificados as $index => $key) {
							if($key['estado_reg'] == 0){
								echo '<tr style="background-color: #FCAAAA;">';
							}else{
								echo '<tr>';
							}
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
							if($key['estado_reg'] == 0){
								echo'<td style="text-align: center;"><b>Anulado</b></td>';
								}else{
								echo '<td style="text-align: center;">
										<a class="idAnulaCertificado" data-toggle="modal" data-target="#myModalAnular">
													<span class="glyphicon glyphicon-remove"></span>
												</a>
											</td>';		
							}				
									
							echo '<td style="display:none">'.$key["id_cliente"].'</td>';
							echo '<td style="display:none">'.$key["id_poliza"].'</td>';
							echo '<td style="display:none">'.$key["id_pais_emision"].'</td>';
							echo'</tr>';
							$i = $i+1;
						}
					}
					}else{
						echo "<tr>";
						echo '<td colspan="7"><div class="alert alert-warning" role="alert"> No existen certificados emitidos</div></td>';
						echo "</tr>";
					}		
			} else {
				echo "<tr>";
				echo '<td colspan="7"><div class="alert alert-warning" role="alert"> No existen certificados emitidos</div></td>';
				echo "</tr>";
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
			$perfil = $this->session->userdata('perfil');
				
			if ($arrCertificados != null) {
				if (count($arrCertificados) > 0) {
						$i = 1;
						if($perfil == 2){
							foreach ($arrCertificados as $index => $key) {
							if($key['estado_reg'] == 0){
								echo '<tr style="background-color: #FCAAAA;">';
							}else{
								echo '<tr>';
							}
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
							echo '<td style="display:none">anulado</td>';		
									
							echo '<td style="display:none">'.$key["id_cliente"].'</td>';
							echo '<td style="display:none">'.$key["id_poliza"].'</td>';
							echo '<td style="display:none">'.$key["id_pais_emision"].'</td>';
							echo'</tr>';
							$i = $i+1;
							}
						}else{
						
						foreach ($arrCertificados as $index => $key) {
							if($key['estado_reg'] == 0){
								echo '<tr style="background-color: #FCAAAA;">';
							}else{
								echo '<tr>';
							}
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
							if($key['estado_reg'] == 0){
								echo'<td style="text-align: center;"><b>Anulado</b></td>';
								}else{
								echo '<td style="text-align: center;">
										<a class="idAnulaCertificado" data-toggle="modal" data-target="#myModalAnular">
													<span class="glyphicon glyphicon-remove"></span>
												</a>
											</td>';		
							}				
									
							echo '<td style="display:none">'.$key["id_cliente"].'</td>';
							echo '<td style="display:none">'.$key["id_poliza"].'</td>';
							echo '<td style="display:none">'.$key["id_pais_emision"].'</td>';
							echo'</tr>';
							$i = $i+1;
						}
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
	
	
   public function generar_excel(){
   	
   	$idCliente = $this->input->post('idClienteExcel');
   	$idAnoCert = $this->input->post('idAnoExcel');
   	$idMesCert = $this->input->post('idMesExcel');
   	
	$certificados = $this->Certificado->obtenerDetalleCliente($idCliente, $idAnoCert, $idMesCert);
    
    if(count($certificados) > 0){
    //Contador de filas
    $contador = 1;
    $spreadsheet = new Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();
	$sheet->getStyle('A1:AC1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        //Le aplicamos ancho las columnas.
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(20);
        $sheet->getColumnDimension('L')->setWidth(30);
        $sheet->getColumnDimension('M')->setWidth(30);
        $sheet->getColumnDimension('N')->setWidth(20);
        $sheet->getColumnDimension('O')->setWidth(20);
        $sheet->getColumnDimension('P')->setWidth(20);
        $sheet->getColumnDimension('Q')->setWidth(20);
        $sheet->getColumnDimension('R')->setWidth(20);
        $sheet->getColumnDimension('S')->setWidth(20);
        $sheet->getColumnDimension('T')->setWidth(20);
        $sheet->getColumnDimension('U')->setWidth(20);
        $sheet->getColumnDimension('V')->setWidth(100);
        $sheet->getColumnDimension('W')->setWidth(20);
        $sheet->getColumnDimension('X')->setWidth(20);
        $sheet->getColumnDimension('Y')->setWidth(20);
        $sheet->getColumnDimension('Z')->setWidth(20);
        $sheet->getColumnDimension('AA')->setWidth(20);
        $sheet->getColumnDimension('AB')->setWidth(20);
        $sheet->getColumnDimension('AC')->setWidth(20);
        //Le aplicamos negrita a los títulos de la cabecera.
        $sheet->getStyle('A'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('B'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('C'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('D'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('E'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('F'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('G'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('H'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('I'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('J'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('K'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('L'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('M'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('N'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('O'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('P'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('Q'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('R'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('S'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('T'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('U'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('V'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('W'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('X'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('Y'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('Z'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('AA'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('AB'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('AC'.$contador)->getFont()->setBold(true);
        
        //Definimos los títulos de la cabecera.
		$sheet->setCellValue('A'.$contador, 'USUARIO');
		$sheet->setCellValue('B'.$contador, 'POLIZA');
		$sheet->setCellValue('C'.$contador, 'NRO CERT');
		$sheet->setCellValue('D'.$contador, 'FECHA SOLICITUD');
		$sheet->setCellValue('E'.$contador, 'CONTRATANTE');
		$sheet->setCellValue('F'.$contador, 'CLIENTE');
		$sheet->setCellValue('G'.$contador, 'TIPO DESPACHO');
		$sheet->setCellValue('H'.$contador, 'PAIS DE ORIGEN');
		$sheet->setCellValue('I'.$contador, 'PAIS DE DESTINO');
		$sheet->setCellValue('J'.$contador, 'CIUDAD DE ORIGEN');
		$sheet->setCellValue('K'.$contador, 'CIUDAD DE DESTINO');
		$sheet->setCellValue('L'.$contador, 'PUERTO DE ORIGEN');
		$sheet->setCellValue('M'.$contador, 'PUERTO DE DESTINO');
		$sheet->setCellValue('N'.$contador, 'FECHA DE ARRIBO');
		$sheet->setCellValue('O'.$contador, 'VIA DE TRANSPORTE');
		$sheet->setCellValue('P'.$contador, 'TRANSBORDO');
		$sheet->setCellValue('Q'.$contador, 'PAIS TRANSBORDO');
		$sheet->setCellValue('R'.$contador, 'PUERTO TRANSBORDO');
		$sheet->setCellValue('S'.$contador, 'NOMBRE LINEA AEREA / NAVE');
		$sheet->setCellValue('T'.$contador, 'VUELO / NAVE');
		$sheet->setCellValue('U'.$contador, 'FECHA EMBARQUE');
		$sheet->setCellValue('V'.$contador, 'DESCRIPCION MERCADERIA');
		$sheet->setCellValue('W'.$contador, 'TIPO EMBALAJE');
		$sheet->setCellValue('X'.$contador, 'MONEDA');  	
		$sheet->setCellValue('Y'.$contador, 'MONTO ASEGURADO US$');  
		$sheet->setCellValue('Z'.$contador, 'VALOR PRIMA US$');  
		$sheet->setCellValue('AA'.$contador, 'REFERENCIA INTERNA');  
		$sheet->setCellValue('AB'.$contador, 'GUIA / BL');
		$sheet->setCellValue('AC'.$contador, 'DEDUCIBLE'); 			                               
      
        //Definimos la data del cuerpo.        
        foreach($certificados as $index => $key ){
           //Incrementamos una fila más, para ir a la siguiente.
           $contador++;
           if($key['estado_reg'] == 0){
		   	 $sheet->getStyle('A'.$contador.':AE'.$contador)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FCD5B4');
		   }
           
           //Informacion de las filas de la consulta.   
	        $sheet->setCellValue('A'.$contador, $key['USUARIO']);
	        $sheet->setCellValue('B'.$contador, $key['POLIZA']);
	        $sheet->setCellValue('C'.$contador, $key['NRO_CERT']);
	        $sheet->setCellValue('D'.$contador, $key['FECHA_SOLICITUD']);
	        $sheet->setCellValue('E'.$contador, $key['CONTRATANTE']);
	        $sheet->setCellValue('F'.$contador, $key['CLIENTE']);
	        $sheet->setCellValue('G'.$contador, $key['TIPO_DESPACHO']);
	        $sheet->setCellValue('H'.$contador, $key['PAIS_DE_ORIGEN']);
	        $sheet->setCellValue('I'.$contador, $key['PAIS_DE_DESTINO']);
	        $sheet->setCellValue('J'.$contador, $key['CIUDAD_DE_ORIGEN']);
	        $sheet->setCellValue('K'.$contador, $key['CIUDAD_DE_DESTINO']);
	        $sheet->setCellValue('L'.$contador, $key['PUERTO_DE_ORIGEN']);
	        $sheet->setCellValue('M'.$contador, $key['PUERTO_DE_DESTINO']);
	        $sheet->setCellValue('N'.$contador, $key['FECHA_DE_ARRIBO']);
	        $sheet->setCellValue('O'.$contador, $key['VIA_DE_TRANSPORTE']);
	        $sheet->setCellValue('P'.$contador, $key['TRANSBORDO']);
	        $sheet->setCellValue('Q'.$contador, $key['PAIS_TRANSBORDO']);
	        $sheet->setCellValue('R'.$contador, $key['PUERTO_TRANSBORDO']);
	        $sheet->setCellValue('S'.$contador, $key['NOMBRE_LINEA_AEREA_NAVE']);
	        $sheet->setCellValue('T'.$contador, $key['VUELO_NAVE']);
	        $sheet->setCellValue('U'.$contador, $key['FECHA_EMBARQUE']);
	        $sheet->setCellValue('V'.$contador, $key['DESCRIPCION_MERCADERIA']);
	        $sheet->setCellValue('W'.$contador, $key['TIPO_EMBALAJE']);
	        $sheet->setCellValue('X'.$contador, $key['MONEDA']);  
	        $sheet->setCellValue('Y'.$contador, $key['MONTO_ASEGURADO']);                                           	
	        $sheet->setCellValue('Z'.$contador, $key['VALOR_PRIMA']);  
	        $sheet->setCellValue('AA'.$contador, $key['REFERENCIA_INTERNA']);
	        $sheet->setCellValue('AB'.$contador, $key['GUIA_BL']);  
	        $sheet->setCellValue('AC'.$contador, $key['DEDUCIBLE']);  
        }
        
        //descargamos el EXCEL
        $filename = 'certificados_'.time().'.xlsx';
		// Redirect output to a client's web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		 
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
     }else{
        echo 'No se pudo descargar el excel';
        exit;        
     }
  }
	
}

?>