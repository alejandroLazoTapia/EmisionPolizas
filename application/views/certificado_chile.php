<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Certificado</title>
		<style type="text/css">

			table {
				margin-left: auto;
				margin-right: auto;
				width: 700px;
			}
			textarea {
				resize: none;
				border: 1px solid white;
				border-color: white;
			}
			.titulo1 {
				margin-left: auto;
				margin-right: auto;
				font-family: Arial;
				font-size: 14px;
				font-weight: bold;
				text-align: left;
			}
			.parrafo1 {
				margin-left: auto;
				margin-right: auto;
				font-family: Arial;
				font-size: 12px;
				text-align: left;
				resize: none;
			}
			.parrafo3 {
				margin-left: auto;
				margin-right: auto;
				font-family: Arial;
				font-size: 10px;
				text-align: left;
				resize: none;
			}
			.parrafo2 {
				margin-left: auto;
				margin-right: auto;
				font-family: Arial;
				font-size: 10px;
				text-align: left;
				resize: none;
			}
			.parrafoColor{
				margin-left: auto;
				margin-right: auto;
				font-family: Arial;
				font-size: 12px;
				color: #5DADE2;
				text-align: left;
				width: 150px;
			}
		</style>
	</head>
	<body>
	<!--	<?php
		/*echo "
		<pre>";
		print_r($certificado);
		echo "</pre>";*/
		?>-->
	
		<table>
			<caption><img src="<?=base_url() ?>recursos/images/BciSeguros.jpg"></caption>
			<tr>
				<td  class="titulo1">
					CERTIFICADO DE TRANSPORTE
					<hr style="color:#5DADE2">
				</td>
			</tr>
			<tr>
				<td class="parrafo1">
					Esta entidad aseguradora, en los términos detallados en la propuesta e individualizados en la presente póliza,
					y con arreglo a las Condiciones Generales y/o Particulares aceptadas por ambas partes asegura lo siguiente.
				</td>
			</tr>
		</table>
		<br>
		<table border="0">
			<tr>
				<td class="parrafoColor"> Riesgo: </td>
				<td class="parrafo1"><?php echo $certificado->riesgo ?></td>
				<td class="parrafoColor"> Sucursal: </td>
				<td class="parrafo1"> SANTIAGO CENTRO </td>
			</tr>
			<tr>
				<td class="parrafoColor">Moneda:</td>
				<td class="parrafo1"><?php echo $certificado->moneda ?></td>
				<td class="parrafoColor">Póliza Nro</td>
				<td class="parrafo1"><?php echo $certificado->poliza_nro ?></td>
			</tr>
			<tr>
				<td class="parrafoColor">Aviso Nro:</td>
				<td class="parrafo1"><?php echo $certificado->correlativo ?></td>
				<td class="parrafoColor"> Correlativo: </td>
				<td class="parrafo1"> <?php echo $certificado->correlativo ?></td>
			</tr>
			<tr>
				<td class="parrafoColor"> Tipo Certificado: </td>
				<td class="parrafo1"> DEFINITIVO </td>
				<td class="parrafoColor"> </td>
				<td class="parrafo1"> </td>
			</tr>
		</table>

		<br>
		<table border="0">
			<tr >
				<td class="parrafoColor"> Contratante: </td>
				<td class="parrafo1"> SGG LOGISTICS SPA   Rut: 77.047.964-9 </td>
			</tr>
			<tr>
				<td class="parrafoColor"> Asegurado: </td>
				<td class="parrafo1"> <?php echo $certificado->asegurado ?> </td>
			</tr>
		</table>

		<br>
		<table border="0">
			<tr >
				<td class="parrafoColor" VALIGN=TOP>Materia:</td>
				<td class="parrafo3" >
					<p style = "font-family:courier,arial,helvética;"><?php echo $certificado->materia ?></p>
					<br>
					<br>
					<br>
										
				</td>
			</tr>
		</table>

		<br>
		<table border="0">
			<tr>
				<td class="parrafoColor">Embalaje:</td>
				<td class="parrafo1"><?php echo $certificado->embalaje ?></td>
				<td class="parrafoColor"> Nro. Bultos: </td>
				<td class="parrafo1"><?php echo $certificado->nro_bultos ?></td>
			</tr>
			<tr>
				<td class="parrafoColor">Fecha Salida:</td>
				<td class="parrafo1"><?php echo $certificado->fecha_salida ?></td>
				<td class="parrafoColor">Nombre Línea:</td>
				<td class="parrafo1"><?php echo $certificado->nombre_linea ?></td>
			</tr>
			<tr>
				<td class="parrafoColor">Origen:</td>
				<td class="parrafo1"><?php echo $certificado->origen ?></td>
				<td class="parrafoColor">Destino:</td>
				<td class="parrafo1"><?php echo $certificado->destino ?></td>
			</tr>
			<tr>
				<td class="parrafoColor"> Vía: </td>
				<td class="parrafo1"> <?php echo $certificado->via ?> </td>
				<td class="parrafoColor">B/L</td>
				<td class="parrafo1"><?php echo $certificado->b_l ?></td>
			</tr>
			<tr>
				<td class="parrafoColor">Transbordo:</td>
				<td class="parrafo1"> </td>
				<td class="parrafoColor">Nave:</td>
				<td class="parrafo1"><?php echo $certificado->nave ?></td>
			</tr>
		</table>

		<br>
		<table border="0">
			<tr>
				<td class="titulo1" style="width: 400px;" BGCOLOR="#c0c0c0">Coberturas</td>
				<td class="titulo1" style="width: 150px;text-align: right;" BGCOLOR="#c0c0c0">Monto Asegurado</td>
				<td class="titulo1" style="text-align: right;" BGCOLOR="#c0c0c0">Prima</td>
			</tr>
			<tr>
				<td class="parrafo1"><?php echo $certificado->cobertura ?></td>
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->monto_asegurado ?></td>
				<td class="parrafoColor"></td>
			</tr>
			<tr>
				<td class="parrafo1">CLAUSULA CHILENA PARA HUELGA</td>
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->signo ?>0.00</td>
				<td class="parrafoColor"></td>
			</tr>
			<tr>
				<td class="parrafo1">CLAUSULA CHILENA PARA GUERRA</td>
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->signo ?>0.00</td>
				<td class="parrafoColor"> </td>
			</tr>
			<tr>
				<td class="parrafoColor">
					<b>Total</b></td>
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->monto_asegurado ?></td>
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->prima ?></td>
			</tr>
		</table>

		<br>
		<table border="0">
			<tr>
				<td class="parrafoColor">
					<b>Notas</b></td>
			</tr>
			<tr style="border-color: white;">
				<td style="border-color: white;">
					<p class="parrafo2" style="font-size: 8px">
1. Queda expresamente convenido que el presente certificado definitivo está sujeto a los términos y condiciones de la Póliza Flotante  Nro. <?php echo $certificado->poliza_nro ?>
<br>
2.
<br>
3. Rige Cláusula de Clasificación del Instituto de Aseguradores de Londres(CL. 354 del 13.04.92) la que será aplicada respecto a primas  adicionales una vez conocida la edad de la Nave
					</p>
				</td>
			</tr>
		</table>

		<table border="0">
			<tr>
				<td class="parrafo1">
					<b>Fecha de Emisión: <?php echo $certificado->fecha_emision ?></b></td>
			
				<td style="text-align: right;"><img src="<?=base_url() ?>recursos/images/Firma.jpg"></td>

			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2"><img src="<?=base_url() ?>recursos/images/Pie.jpg" width="900"></td>
			</tr>
		</table>
	</body>
</html>

