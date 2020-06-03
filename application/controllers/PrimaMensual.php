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
			if ($idCliente) {
				$anos = $this->Prima->obtenerAnoVigente($idCliente);
				echo count($anos);
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
	
	public function obtieneMesPrima()
	{
		if ($this->input->is_ajax_request()) {
			$idCliente =  $this->input->post('idCliente');
			$idAnoPrima =  $this->input->post('idAnoPrima');
			
			if ($idCliente) {
				$meses = $this->Prima->obtieneMesVigente($idAnoPrima, $idCliente);
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
	
	public function obtieneDetallePrimaMensual()
	{
		if ($this->input->is_ajax_request()) {
			$idCliente =  $this->input->post('idCliente');
			$idAnoPrima =  $this->input->post('idAnoPrima');
			$idMesPrima =  $this->input->post('idMesPrima');
			$perfil = $this->session->userdata('perfil');
			$arrPrimas = $this->Prima->obtenerDetallePrimaMensual($idCliente, $idAnoPrima, $idMesPrima);
			
				
			if ($arrPrimas != null) {
				$arrTotalesPrimas = $this->Prima->obtenerTotalesPrimaMensual($idCliente, $idAnoPrima, $idMesPrima);
				if (count($arrPrimas) > 0) {
						$i = 1;
						/*$tot_prima_cliente = 0;
						$tot_prima_usuario = 0;
						$tot_prima_compania = 0;
						$tot_utilidad = 0;*/
						foreach ($arrPrimas as $index => $key) {
							echo '<tr style="text-align: right;">';
							echo '<td>'.$i.'</td>';
							echo '<td>'.$key["nombre_cliente"].'</td>';
							echo '<td>'.$key["codigo_poliza"].'</td>';
							echo '<td>'.$key["id_certificado"].'</td>';
							echo '<td>'.$key["fecha_emision"].'</td>';
							echo '<td>'.$key["usuario"].'</td>';
							echo '<td>'.$key["prima_cliente"].'</td>';
							echo '<td>'.$key["prima_usuario"].'</td>';
							echo '<td>'.$key["prima_compania"].'</td>';
							echo '<td>'.$key["utilidad"].'</td>';
							if($perfil == 1){
							echo '<td style="text-align: center;"><a class="idEditarPrima"><span class="glyphicon glyphicon-pencil"></span></a></td>';
							}
							echo '<td style="display:none">'.$idCliente.'</td>';
							echo '<td style="display:none">'.$idAnoPrima.'</td>';	
							echo '<td style="display:none">'.$idMesPrima.'</td>';		 
							echo'</tr>';
							
							$i = $i+1;
							/*$tot_prima_cliente = $tot_prima_cliente + $key["prima_cliente"];
							$tot_prima_usuario = $tot_prima_usuario + $key["prima_usuario"];
							$tot_prima_compania = $tot_prima_compania + $key["prima_compania"];
							$tot_utilidad = $tot_utilidad + $key["utilidad"];*/
						}
						foreach ($arrTotalesPrimas as $index => $key) {
							echo '<tr style="text-align: right;"><td></td><td></td><td></td><td></td><td></td>';
							echo '<td><b>TOTAL</b></td>';	
							echo '<td id="totPrimaCliente">$ '.$key["prima_cliente"].'</td>';	
							echo '<td id="totPrimaUsuario">$ '.$key["prima_usuario"].'</td>';	
							echo '<td id="totPrimaCompania">$ '.$key["prima_compania"].'</td>';	
							echo '<td id="totUtilidad">$ '.$key["utilidad"].'</td>';	
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

			$arrTotalesPrimas = $this->Prima->obtenerTotalesPrimaMensual($idCliente, $idAnoPrima, $idMesPrima);
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
   	
   	$arrPrimas = $this->Prima->obtenerDetallePrimaMensual($idCliente, $idAnoPrima, $idMesPrima);
	$arrTotalesPrimas = $this->Prima->obtenerTotalesPrimaMensual($idCliente, $idAnoPrima, $idMesPrima);
	
    
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
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(20);

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

        
        //Definimos los títulos de la cabecera.
		$sheet->setCellValue('A'.$contador, 'ITEM');
		$sheet->setCellValue('B'.$contador, 'CLIENTE');
		$sheet->setCellValue('C'.$contador, 'POLIZA');
		$sheet->setCellValue('D'.$contador, 'NRO CERTIFICADO');
		$sheet->setCellValue('E'.$contador, 'FECHA EMISION');
		$sheet->setCellValue('F'.$contador, 'USUARIO EMISION');
		$sheet->setCellValue('G'.$contador, 'PRIMA CLIENTE');
		$sheet->setCellValue('H'.$contador, 'PRIMA USUARIO');
		$sheet->setCellValue('I'.$contador, 'PRIMA COMPAÑIA');
		$sheet->setCellValue('J'.$contador, 'UTILIDAD');	                               
      
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
	        $sheet->setCellValue('G'.$contador, $key['prima_cliente']);
	        $sheet->setCellValue('H'.$contador, $key['prima_usuario']);
	        $sheet->setCellValue('I'.$contador, $key['prima_compania']);
	        $sheet->setCellValue('J'.$contador, $key['utilidad']);
        }
        
        
        foreach($arrTotalesPrimas as $index => $key ){
           //Incrementamos una fila más, para ir a la siguiente.
           $contador= $contador + 2;
           $sheet->getStyle('F'.$contador.':J'.$contador)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FAF68F');
           	$sheet->getStyle('F'.$contador.':J'.$contador)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
           	$sheet->getStyle('F'.$contador)->getFont()->setBold(true);
	        $sheet->getStyle('G'.$contador)->getFont()->setBold(true);
	        $sheet->getStyle('H'.$contador)->getFont()->setBold(true);
	        $sheet->getStyle('I'.$contador)->getFont()->setBold(true);
	        $sheet->getStyle('J'.$contador)->getFont()->setBold(true);
           //Informacion de las filas de la consulta.   
	        $sheet->setCellValue('A'.$contador, '');
	        $sheet->setCellValue('B'.$contador, '');
	        $sheet->setCellValue('C'.$contador, '');
	        $sheet->setCellValue('D'.$contador, '');
	        $sheet->setCellValue('E'.$contador, '');
	        $sheet->setCellValue('F'.$contador, 'TOTAL');
	        $sheet->setCellValue('G'.$contador, $key['prima_cliente']);
	        $sheet->setCellValue('H'.$contador, $key['prima_usuario']);
	        $sheet->setCellValue('I'.$contador, $key['prima_compania']);
	        $sheet->setCellValue('J'.$contador, $key['utilidad']);
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
