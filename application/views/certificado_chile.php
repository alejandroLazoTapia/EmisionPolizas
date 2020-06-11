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
		.ancho {
				width: 200px; 
				font-size: 10px; 
				font-family: Verdana, Arial, Helvetica, sans-serif
				}
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
				font-size: 8px;
				text-align: left;
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
			}.wrap,
			.wrap2{ 
			  width:100px;
			  white-space: pre-wrap;      /* CSS3 */   
			  white-space: -moz-pre-wrap; /* Firefox */    
			  white-space: -pre-wrap;     /* Opera <7 */   
			  white-space: -o-pre-wrap;   /* Opera 7 */    
			  word-wrap: break-word;      /* IE */
			}

			.wrap{
			  width:542px;
			  font-size: 10px;
			  height: auto;
			  font-family:courier,arial,helvética;
			}

			.wrap2 { 
			  width:100px;
			  font-size: 12px;
			  font-family: Arial;
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
					Esta entidad aseguradora <b>BCI SEGUROS (Munich Re)</b>, en los términos detallados en la propuesta e individualizados en la presente póliza, y con arreglo a las Condiciones Generales y/o Particulares aceptadas por ambas partes asegura lo siguiente.
				</td>
			</tr>
		</table>
		<br>
		<table border="0">
			<tr>
				<td class="parrafoColor ancho" VALIGN=TOP> Riesgo: </td>
				<td><div class="wrap2" VALIGN=TOP><?php echo $certificado->riesgo ?></div></td>
				<td class="parrafoColor ancho" VALIGN=TOP> Sucursal: </td>
				<td class="parrafo1 ancho" VALIGN=TOP> SANTIAGO CENTRO </td>
			</tr>
			<tr>
				<td class="parrafoColor ancho" VALIGN=TOP>Moneda:</td>
				<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->moneda ?></td>
				<td class="parrafoColor ancho" VALIGN=TOP>Póliza Nro</td>
				<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->poliza_nro ?></td>
			</tr>
			<tr>
				<td class="parrafoColor ancho" VALIGN=TOP>Aviso Nro:</td>
				<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->correlativo-90 ?></td>
				<td class="parrafoColor ancho" VALIGN=TOP>Correlativo: </td>
				<td class="parrafo1 ancho" VALIGN=TOP> <?php echo $certificado->correlativo ?></td>
			</tr>
			<tr>
				<td class="parrafoColor ancho" VALIGN=TOP>Tipo Certificado: </td>
				<td class="parrafo1 ancho" VALIGN=TOP>DEFINITIVO </td>
				<td class="parrafoColor ancho" VALIGN=TOP> Referencia Interna: </td>
				<td class="parrafo1 ancho" VALIGN=TOP> <?php echo $certificado->referencia_interna ?></td>
			</tr>
		</table>

		<br>
		<table border="0">
			<tr >
				<td class="parrafoColor ancho" VALIGN=TOP>Contratante: </td>
				<td class="parrafo1 ancho" VALIGN=TOP>SGG LOGISTICS SPA</td>
				<td class="parrafoColor ancho" VALIGN=TOP>&nbsp;</td>
				<td class="parrafo1 ancho" VALIGN=TOP>&nbsp;</td>
			</tr>
			<tr >	
				<td class="parrafoColor ancho" VALIGN=TOP></td>
				<td class="parrafo1 ancho" VALIGN=TOP>Rut: 77.047.964-9 </td>
				<td class="parrafoColor ancho" VALIGN=TOP>&nbsp;</td>
				<td class="parrafo1 ancho" VALIGN=TOP>&nbsp;</td>
			</tr>
			<tr>
				<td class="parrafoColor ancho" VALIGN=TOP> Asegurado: </td>
				<td class="parrafo1 ancho" VALIGN=TOP> <?php echo $certificado->nombre_asegurado ?> </td>
				<td class="parrafoColor ancho" VALIGN=TOP>&nbsp;</td>
				<td class="parrafo1 ancho" VALIGN=TOP>&nbsp;</td>
			</tr>
			<tr >	
				<td class="parrafoColor ancho" VALIGN=TOP></td>
				<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->rut_asegurado ?></td>
				<td class="parrafoColor ancho" VALIGN=TOP>&nbsp;</td>
				<td class="parrafo1 ancho" VALIGN=TOP>&nbsp;</td>
			</tr>
		</table>
		<br>
			<table border="0">
				<tr >
					<td class="parrafoColor" VALIGN=TOP>Materia:</td>
					<td VALIGN=TOP><div class="wrap"><?php echo $certificado->materia ?></div>			
					</td>
				</tr>
			</table>
			<br>
		<?php if($certificado->codigo_transporte == "TM") {?>
			<table border="0">
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP>Embalaje:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->embalaje?></td>
					<td class="parrafoColor ancho" VALIGN=TOP> Nro. Bultos: </td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->nro_bultos ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP>Fecha Salida:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->fecha_salida ?></td>
					<td class="parrafoColor ancho" VALIGN=TOP>Nombre Nave:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->nombre_nave ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP>Origen:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->origen ?></td>
					<td class="parrafoColor ancho" VALIGN=TOP>Destino:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->destino ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP> Vía: </td>
					<td class="parrafo1 ancho" VALIGN=TOP> <?php echo $certificado->via ?> </td>
					<td class="parrafoColor ancho" VALIGN=TOP>B/L</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->b_l ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP>Cía. Naviera</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->nombre_linea ?> </td>
					<td class="parrafoColor ancho" VALIGN=TOP>Nro. de Nave:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->numero_nave ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP>Transbordo</td>
					<td class="parrafo1 ancho" VALIGN=TOP> </td>
					<td class="parrafoColor ancho" VALIGN=TOP></td>
					<td class="parrafo1 ancho" VALIGN=TOP></td>
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
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->signo ?>&nbsp;<?php echo $certificado->monto_asegurado ?></td>
				<td class="parrafoColor"></td>
			</tr>
			<tr>
				<td class="parrafo1">CLAUSULA CHILENA PARA HUELGA</td>
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->signo ?> 0.00</td>
				<td class="parrafoColor"></td>
			</tr>
			<tr>
				<td class="parrafo1">CLAUSULA CHILENA PARA GUERRA</td>
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->signo ?> 0.00</td>
				<td class="parrafoColor"> </td>
			</tr>
			<tr>
				<td class="parrafoColor">
					<b>Total</b></td>
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->signo ?>&nbsp;<?php echo $certificado->monto_asegurado ?></td>
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->signo ?>&nbsp;<?php echo $certificado->prima ?></td>
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
		<?php }else if($certificado->codigo_transporte == "TA" ){ ?>

			<table border="0">
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP>Embalaje:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->embalaje?></td>
					<td class="parrafoColor ancho" VALIGN=TOP> Nro. Bultos: </td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->nro_bultos ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP>Fecha Salida:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->fecha_salida ?></td>
					<td class="parrafoColor ancho" VALIGN=TOP>Línea Aérea:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->nombre_linea ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP>Origen:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->origen ?></td>
					<td class="parrafoColor ancho" VALIGN=TOP>Destino:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->destino ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP> Vía: </td>
					<td class="parrafo1 ancho" VALIGN=TOP> <?php echo $certificado->via ?> </td>
					<td class="parrafoColor ancho" VALIGN=TOP>Guía Aérea</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->b_l ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP>Transbordo</td>
					<td class="parrafo1 ancho" VALIGN=TOP> </td>
					<td class="parrafoColor ancho" VALIGN=TOP>Nro. de Viaje:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->numero_nave ?></td>
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
				<td class="parrafo1">PÓLIZA CHILENA PARA MERCANCÍAS</td>
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->monto_asegurado ?></td>
				<td class="parrafoColor"></td>
			</tr>
			<tr>
				<td class="parrafo1">CLAUSULA CHILENA PARA HUELGA</td>
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->signo ?> 0.00</td>
				<td class="parrafoColor"></td>
			</tr>
			<tr>
				<td class="parrafo1">CLAUSULA CHILENA PARA GUERRA</td>
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->signo ?> 0.00</td>
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
					</p>
				</td>
			</tr>
		</table>
		<?php }else { ?>
			<table border="0">
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP>Embalaje:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->embalaje?></td>
					<td class="parrafoColor ancho" VALIGN=TOP> Nro. Bultos: </td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->nro_bultos ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP>Fecha Salida:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->fecha_salida ?></td>
					<td class="parrafoColor ancho" VALIGN=TOP>Nombre Línea:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->nombre_linea ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP>Origen:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->origen ?></td>
					<td class="parrafoColor ancho" VALIGN=TOP>Destino:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->destino ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP> Vía: </td>
					<td class="parrafo1 ancho" VALIGN=TOP> <?php echo $certificado->via ?> </td>
					<td class="parrafoColor ancho" VALIGN=TOP>B/L</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->b_l ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho" VALIGN=TOP>Transbordo:</td>
					<td class="parrafo1 ancho" VALIGN=TOP> </td>
					<td class="parrafoColor ancho" VALIGN=TOP>Nave:</td>
					<td class="parrafo1 ancho" VALIGN=TOP><?php echo $certificado->numero_nave ?></td>
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
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->signo ?> 0.00</td>
				<td class="parrafoColor"></td>
			</tr>
			<tr>
				<td class="parrafo1">CLAUSULA CHILENA PARA GUERRA</td>
				<td class="parrafo1" style="text-align: right;"><?php echo $certificado->signo ?> 0.00</td>
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
		<?php }?>
		
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
				<td colspan="2"><img src="<?=base_url() ?>recursos/images/Pie.jpg" width="1000"></td>
			</tr>
		</table>
	</body>
</html>

