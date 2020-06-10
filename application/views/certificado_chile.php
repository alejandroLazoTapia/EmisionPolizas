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
					Esta entidad aseguradora <b>BCI SEGUROS (Munich Re)</b>, en los términos detallados en la propuesta e individualizados en la presente póliza, y con arreglo a las Condiciones Generales y/o Particulares aceptadas por ambas partes asegura lo siguiente.
				</td>
			</tr>
		</table>
		<br>
		<table border="0">
			<tr>
				<td class="parrafoColor ancho"> Riesgo: </td>
				<td class="parrafo1 ancho"><?php echo $certificado->riesgo ?></td>
				<td class="parrafoColor ancho"> Sucursal: </td>
				<td class="parrafo1 ancho"> SANTIAGO CENTRO </td>
			</tr>
			<tr>
				<td class="parrafoColor ancho">Moneda:</td>
				<td class="parrafo1 ancho"><?php echo $certificado->moneda ?></td>
				<td class="parrafoColor ancho">Póliza Nro</td>
				<td class="parrafo1 ancho"><?php echo $certificado->poliza_nro ?></td>
			</tr>
			<tr>
				<td class="parrafoColor ancho">Aviso Nro:</td>
				<td class="parrafo1 ancho"><?php echo $certificado->correlativo-90 ?></td>
				<td class="parrafoColor ancho">Correlativo: </td>
				<td class="parrafo1 ancho"> <?php echo $certificado->correlativo ?></td>
			</tr>
			<tr>
				<td class="parrafoColor ancho">Tipo Certificado: </td>
				<td class="parrafo1 ancho">DEFINITIVO </td>
				<td class="parrafoColor ancho"> Referencia Interna: </td>
				<td class="parrafo1 ancho"> <?php echo $certificado->referencia_interna ?></td>
			</tr>
		</table>

		<br>
		<table border="0">
			<tr >
				<td class="parrafoColor ancho">Contratante: </td>
				<td class="parrafo1 ancho">SGG LOGISTICS SPA</td>
				<td class="parrafoColor ancho">&nbsp;</td>
				<td class="parrafo1 ancho">&nbsp;</td>
			</tr>
			<tr >	
				<td class="parrafoColor ancho"></td>
				<td class="parrafo1 ancho">Rut: 77.047.964-9 </td>
				<td class="parrafoColor ancho">&nbsp;</td>
				<td class="parrafo1 ancho">&nbsp;</td>
			</tr>
			<tr>
				<td class="parrafoColor ancho"> Asegurado: </td>
				<td class="parrafo1 ancho"> <?php echo $certificado->nombre_asegurado ?> </td>
				<td class="parrafoColor ancho">&nbsp;</td>
				<td class="parrafo1 ancho">&nbsp;</td>
			</tr>
			<tr >	
				<td class="parrafoColor ancho"></td>
				<td class="parrafo1 ancho"><?php echo $certificado->rut_asegurado ?></td>
				<td class="parrafoColor ancho">&nbsp;</td>
				<td class="parrafo1 ancho">&nbsp;</td>
			</tr>
		</table>
		<br>
					<table border="0">
				<tr >
					<td class="parrafoColor" VALIGN=TOP>Materia:</td>
					<td class="parrafo3" >
						<p style = "font-family:courier,arial,helvética;"><?php echo $certificado->materia ?></p>
						<br>				
					</td>
				</tr>
			</table>
			<br>
		<?php if($certificado->codigo_transporte == "TM") {?>
			<table border="0">
				<tr>
					<td class="parrafoColor ancho">Embalaje:</td>
					<td class="parrafo1 ancho"><?php echo $certificado->embalaje ?></td>
					<td class="parrafoColor ancho"> Nro. Bultos: </td>
					<td class="parrafo1 ancho"><?php echo $certificado->nro_bultos ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho">Fecha Salida:</td>
					<td class="parrafo1 ancho"><?php echo $certificado->fecha_salida ?></td>
					<td class="parrafoColor ancho">Nombre Nave:</td>
					<td class="parrafo1 ancho"><?php echo $certificado->nombre_nave ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho">Origen:</td>
					<td class="parrafo1 ancho"><?php echo $certificado->origen ?></td>
					<td class="parrafoColor ancho">Destino:</td>
					<td class="parrafo1 ancho"><?php echo $certificado->destino ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho"> Vía: </td>
					<td class="parrafo1 ancho"> <?php echo $certificado->via ?> </td>
					<td class="parrafoColor ancho">B/L</td>
					<td class="parrafo1 ancho"><?php echo $certificado->b_l ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho">Cía. Naviera</td>
					<td class="parrafo1 ancho"><?php echo $certificado->nombre_linea ?> </td>
					<td class="parrafoColor ancho">Nro. de Nave:</td>
					<td class="parrafo1 ancho"><?php echo $certificado->numero_nave ?></td>
				</tr>
				<tr>
					<td class="parrafoColor ancho">Transbordo</td>
					<td class="parrafo1 ancho"> </td>
					<td class="parrafoColor ancho"></td>
					<td class="parrafo1 ancho"></td>
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
					<td class="parrafoColor">Embalaje:</td>
					<td class="parrafo1"><?php echo $certificado->embalaje ?></td>
					<td class="parrafoColor"> Nro. Bultos: </td>
					<td class="parrafo1"><?php echo $certificado->nro_bultos ?></td>
				</tr>
				<tr>
					<td class="parrafoColor">Fecha Salida:</td>
					<td class="parrafo1"><?php echo $certificado->fecha_salida ?></td>
					<td class="parrafoColor">Línea Aérea:</td>
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
					<td class="parrafoColor">Guía Aérea</td>
					<td class="parrafo1"><?php echo $certificado->b_l ?></td>
				</tr>
				<tr>
					<td class="parrafoColor">Transbordo</td>
					<td class="parrafo1"> </td>
					<td class="parrafoColor">Nro. de Viaje:</td>
					<td class="parrafo1"><?php echo $certificado->numero_nave ?></td>
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
					<td class="parrafo1"><?php echo $certificado->numero_nave ?></td>
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

