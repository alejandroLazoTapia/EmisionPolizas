<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class PrimaMensual extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Prima");
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
		$datos['arrClientes'] = $this->Prima->obtenerClientes($idUsuario, $perfil);
	
		if ($perfil == 1) {
			$datos['arrAno'] = null;
			$datos['arrPrimas'] = $this->Prima->obtenerDetallePrimaMensual(0, date("Y"), date("n"), $idUsuario, $perfil);
			$datos['arrTotalesPrimas'] = $this->Prima->obtenerTotalesPrimaMensual(0, date("Y"), date("n"), $idUsuario, $perfil);
		} else {
			$datos['arrAno'] = $this->Prima->obtenerAnoUsuario($nombreUsuario);
		}

		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('primaMensual',$datos);
		$this->load->view('footer');
	}

	
	public function obtieneAnoPrima()
	{
		if ($this->input->is_ajax_request()) {
			$idCliente =  $this->input->post('idCliente');
			$idUsuario = $this->session->userdata('id');
			$perfil = $this->session->userdata('perfil');
			$anos = $this->Prima->obtenerAnoVigente($idCliente, $idUsuario, $perfil);
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
			echo -3;
		}
	}
	
	
	public function obtieneMesPrima()
	{
		if ($this->input->is_ajax_request()) {
			$idCliente =  $this->input->post('idCliente');
			$idAnoPrima =  $this->input->post('idAnoPrima');
			$idUsuario = $this->session->userdata('id');
			$perfil = $this->session->userdata('perfil');
				$meses = $this->Prima->obtieneMesVigente($idAnoPrima, $idCliente, $idUsuario, $perfil);
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
			echo -3;
		}
	}  
	
	public function obtieneDetallePrimaMensual()
	{
		if ($this->input->is_ajax_request()) {
			$idCliente =  $this->input->post('idCliente');
			$idAnoPrima =  $this->input->post('idAnoPrima');
			$idMesPrima =  $this->input->post('idMesPrima');
			$perfil = $this->session->userdata('perfil');
			$idUsuario = $this->session->userdata('id');
			$arrPrimas = $this->Prima->obtenerDetallePrimaMensual($idCliente, $idAnoPrima, $idMesPrima, $idUsuario, $perfil);
			
				
			if ($arrPrimas != null) {
				$arrTotalesPrimas = $this->Prima->obtenerTotalesPrimaMensual($idCliente, $idAnoPrima, $idMesPrima, $idUsuario, $perfil);
				if (count($arrPrimas) > 0) {
						$i = 1;
						foreach ($arrPrimas as $index => $key) {
							echo '<tr style="text-align: right;">';
							echo '<td style="text-align: left;">'.$i.'</td>';
							echo '<td style="text-align: left;">'.$key["nombre_cliente"].'</td>';
							echo '<td style="text-align: left;">'.$key["codigo_poliza"].'</td>';
							echo '<td style="text-align: left;">'.$key["id_certificado"].'</td>';
							echo '<td style="text-align: left;">'.$key["fecha_emision"].'</td>';
							echo '<td style="text-align: left;">'.$key["usuario"].'</td>';
							echo '<td style="text-align: right;">'.$key["monto_asegurado"].'</td>';
							echo '<td style="text-align: right;">'.$key["prima_cliente"].'</td>';
				if($perfil == 1){
							echo '<td style="text-align: right;">'.$key["prima_usuario"].'</td>';
							echo '<td style="text-align: right;">'.$key["prima_compania"].'</td>';
							echo '<td style="text-align: right;">'.$key["utilidad"].'</td>';
							echo '<td style="text-align: center;"><a class="idEditarPrima"><span class="glyphicon glyphicon-pencil"></span></a></td>';
							}	 
							echo'</tr>';		
							$i = $i+1;
						}
						
							foreach ($arrTotalesPrimas as $index => $key) {
								echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td>';
								echo '<td style="text-align: left;"><b>TOTAL</b></td>';	
								echo '<td id="totPrimaCliente" style="text-align: right;">$&nbsp;'.$key["prima_cliente"].'</td>';	
								if($perfil == 1){
								echo '<td id="totPrimaUsuario" style="text-align: right;">$&nbsp;'.$key["prima_usuario"].'</td>';	
								echo '<td id="totPrimaCompania" style="text-align: right;">$&nbsp;'.$key["prima_compania"].'</td>';	
								echo '<td id="totUtilidad" style="text-align: right;">$&nbsp;'.$key["utilidad"].'</td>';	
								}
								echo '<td></td><td></td>';
								echo '</tr>';				
							}
						
					}else{
						echo "<tr>";
						echo '<td colspan="12"><div class="alert alert-warning" role="alert"> El cliente no posee certificados emitidos</div></td>';
						echo "</tr>";
					}		
			} else {
				echo "<tr>";
				echo '<td colspan="12"><div class="alert alert-warning" role="alert"> El cliente no posee certificados emitidos</div></td>';
				echo "</tr>";
			}
		} else {
			echo -3;
		}
	} 
	
	public function obtieneCalculoPrimaMensual()
	{
		if ($this->input->is_ajax_request()) {
			$idCliente =  $this->input->post('idCliente');
			$idAnoPrima =  $this->input->post('idAnoPrima');
			$idMesPrima =  $this->input->post('idMesPrima');
			$perfil = $this->session->userdata('perfil');
			$idUsuario = $this->session->userdata('id');

			$arrTotalesPrimas = $this->Prima->obtenerTotalesPrimaMensual($idCliente, $idAnoPrima, $idMesPrima, $idUsuario, $perfil);
			echo(json_encode($arrTotalesPrimas));
		} else {
			echo -3;
		}
	}
	
	public function guardarPrima()
	{
		if ($this->input->is_ajax_request()) {
			$idCertificado =  $this->input->post('idCertificado');
			$idPrimaUsuario =  $this->input->post('idPrimaUsuario');
			$idPrimaCompania =  $this->input->post('idPrimaCompania');
			$idUtilidad =  $this->input->post('idUtilidad');
			
			$data = [
					"prima_usuario" => $idPrimaUsuario,
					"prima_compania" => $idPrimaCompania,
					"utilidad" => $idUtilidad
				];
				
				$this->db->set('fecha_mod', 'NOW()', FALSE);
				
				if ($this->Certificado->actualizarCertificado($idCertificado,$data)) {
					echo 1;
				} else {
					echo -2;
				}
		} else {
			echo -3;
		}
	}
	
	public function generar_excel(){
   	
   	$idCliente = $this->input->post('idClientePrimaExcel');
   	$idAnoPrima = $this->input->post('idAnoPrimaExcel');
   	$idMesPrima = $this->input->post('idMesPrimaExcel');
   	$perfil = $this->session->userdata('perfil');
	$idUsuario = $this->session->userdata('id');
   	
   	$arrPrimas = $this->Prima->obtenerDetallePrimaMensual($idCliente, $idAnoPrima, $idMesPrima, $idUsuario, $perfil);
	$arrTotalesPrimas = $this->Prima->obtenerTotalesPrimaMensual($idCliente, $idAnoPrima, $idMesPrima, $idUsuario, $perfil);
	
    
    if(count($arrPrimas) > 0){
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
        if ($perfil == 1){
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(20);
        }

        //Le aplicamos negrita a los títulos de la cabecera.
        $sheet->getStyle('A'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('B'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('C'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('D'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('E'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('F'.$contador)->getFont()->setBold(true);
        $sheet->getStyle('G'.$contador)->getFont()->setBold(true);
         $sheet->getStyle('H'.$contador)->getFont()->setBold(true);
         if ($perfil == 1){
	        $sheet->getStyle('I'.$contador)->getFont()->setBold(true);
	        $sheet->getStyle('J'.$contador)->getFont()->setBold(true);
	        $sheet->getStyle('K'.$contador)->getFont()->setBold(true);
			}
        
        //Definimos los títulos de la cabecera.
		$sheet->setCellValue('A'.$contador, 'ITEM');
		$sheet->setCellValue('B'.$contador, 'CLIENTE');
		$sheet->setCellValue('C'.$contador, 'POLIZA');
		$sheet->setCellValue('D'.$contador, 'NRO CERTIFICADO');
		$sheet->setCellValue('E'.$contador, 'FECHA EMISION');
		$sheet->setCellValue('F'.$contador, 'USUARIO EMISION');
		$sheet->setCellValue('G'.$contador, 'MONTO ASEGURADO');
		$sheet->setCellValue('H'.$contador, 'PRIMA CLIENTE');
		 if ($perfil == 1){
			$sheet->setCellValue('I'.$contador, 'PRIMA USUARIO');
			$sheet->setCellValue('J'.$contador, 'PRIMA COMPAÑIA');
			$sheet->setCellValue('K'.$contador, 'UTILIDAD');	                               
			}
        //Definimos la data del cuerpo.        
        foreach($arrPrimas as $index => $key ){
           //Incrementamos una fila más, para ir a la siguiente.
           $contador++;
           
           //Informacion de las filas de la consulta.   
	        $sheet->setCellValue('A'.$contador, $contador-1);
	        $sheet->setCellValue('B'.$contador, $key['nombre_cliente']);
	        $sheet->setCellValue('C'.$contador, $key['codigo_poliza']);
	        $sheet->setCellValue('D'.$contador, $key['id_certificado']);
	        $sheet->setCellValue('E'.$contador, $key['fecha_emision']);
	        $sheet->setCellValue('F'.$contador, $key['usuario']);
	        $sheet->setCellValue('G'.$contador, $key['monto_asegurado']);
	        $sheet->setCellValue('H'.$contador, $key['prima_cliente']);
	        if ($perfil == 1){
		        $sheet->setCellValue('I'.$contador, $key['prima_usuario']);
		        $sheet->setCellValue('J'.$contador, $key['prima_compania']);
		        $sheet->setCellValue('K'.$contador, $key['utilidad']);
			}
        }
        
        
        foreach($arrTotalesPrimas as $index => $key ){
           //Incrementamos una fila más, para ir a la siguiente.
           $contador= $contador + 2;
            if ($perfil == 1){
         			$sheet->getStyle('G'.$contador.':K'.$contador)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FAF68F');
           			$sheet->getStyle('G'.$contador.':K'.$contador)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
				}else{
					$sheet->getStyle('G'.$contador.':K'.$contador)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FAF68F');
           	$sheet->getStyle('G'.$contador.':H'.$contador)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
				}
           	
           	
           	$sheet->getStyle('G'.$contador)->getFont()->setBold(true);
	        $sheet->getStyle('H'.$contador)->getFont()->setBold(true);
	         if ($perfil == 1){
		        $sheet->getStyle('I'.$contador)->getFont()->setBold(true);
		        $sheet->getStyle('J'.$contador)->getFont()->setBold(true);
		        $sheet->getStyle('K'.$contador)->getFont()->setBold(true);
			}
           //Informacion de las filas de la consulta.   
	        $sheet->setCellValue('A'.$contador, '');
	        $sheet->setCellValue('B'.$contador, '');
	        $sheet->setCellValue('C'.$contador, '');
	        $sheet->setCellValue('D'.$contador, '');
	        $sheet->setCellValue('E'.$contador, '');
	        $sheet->setCellValue('F'.$contador, '');
	        $sheet->setCellValue('G'.$contador, 'TOTAL');
	        $sheet->setCellValue('H'.$contador, $key['prima_cliente']);
	        if ($perfil == 1){
		        $sheet->setCellValue('I'.$contador, $key['prima_usuario']);
		        $sheet->setCellValue('J'.$contador, $key['prima_compania']);
		        $sheet->setCellValue('K'.$contador, $key['utilidad']);
			}
        }
        
        //descargamos el EXCEL
        $filename = 'prima_'.time().'.xlsx';
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
