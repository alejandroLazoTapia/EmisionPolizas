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

			table, td, th{
				margin-left: auto;
				margin-right: auto;
				width: 700px;
				border: 1px solid black;
				border-collapse: collapse;
			}

			textarea {
				resize: none;
				border: none;
			}
			.titulo1 {
				margin-left: auto;
				margin-right: auto;
				font-family: Arial;
				font-size: 40px;
				font-weight: bolder;
				text-align: center;
			}
			.parrafo {
				margin-left: auto;
				margin-right: auto;
				font-family: Arial;
				font-size: 15px;
				text-align: left;
				resize: none;
			}
			.parrafo1 {
				margin-left: auto;
				margin-right: auto;
				font-family: Arial;
				font-size: 45px;
				text-align: left;
				resize: none;
			}
			.parrafo4 {
				margin-left: auto;
				margin-right: auto;
				font-family: Arial;
				font-size: 38px;
				text-align: left;
				resize: none;
			}
			.parrafo2 {
				margin-left: auto;
				margin-right: auto;
				font-family: Arial;
				font-weight: bold;
				font-size: 36px;
				text-align: left;
				resize: none;
			}
			.parrafo3 {
				margin-left: auto;
				margin-right: auto;
				font-family: Arial;
				font-size: 20px;
				text-align: left;
				resize: none;
			}
			 #g-table tr > td{
                    padding-top: 5px;
                }
			
		</style>
	</head>
	<body>
		<!--<?php
		/*echo "
		<pre>";
		print_r($certificado);
		echo "</pre>";*/
		?>-->

		<table style="border:0px solid">
			<tr>
				<td  class="titulo1" style="border:0px solid;text-align: left;width: 310px;">
					<img src="<?=base_url() ?>recursos/images/munich_re.jpg">
				</td>
		
				<td  class="titulo1" style="border: 0px solid;vertical-align: bottom;text-align: center;">
					Certificate Of Insurance
				</td>
				<td  class="titulo1" style="border:0px solid;text-align: right;width: 310px;">
					
				</td>
			</tr>
			<tr>
				<td colspan="3" class="parrafo" style="border: 0px solid;text-align: center;">
					This is to certify that BCI Seguros (Munich RE) hereby agrees to insure against loss, damage or expenses to the extent and in the manner here in provided.
				</td>
			</tr>
		</table>
		<br></br>

		<table>
			<tr>
				<td class="parrafo1" rowspan="3" style="border: 0px solid;text-align: center;height: 100px;">
					ASSURED
					<br></br>
					SEEMANN GROUP
					<br></br>
					PROVIDENCIA, SANTIAGO, CHILE.
					<br></br>
					CLAIMS CONTACTS
				</td>
				<td class="parrafo1" colspan="2">&nbsp;&nbsp;POLICY No:
					<b><?php echo $certificado->policy_no ?></b></td>
				<td class="parrafo1">&nbsp;&nbsp;SECURITY No: </td>
			</tr>
			<tr>
				<td class="parrafo1" colspan="2">&nbsp;&nbsp;CERTIFICATE No:
					<b><?php echo $certificado->certificate_no ?></b></td>
				<td class="parrafo1" colspan="2" rowspan="2" VALIGN=TOP>&nbsp;&nbsp;CONVEYANCE: <br>
					&nbsp;
					<b><?php echo $certificado->conveyance ?></b></td>
			</tr>
			<tr>
				<td class="parrafo1" colspan="2">&nbsp;&nbsp;DEPARTING ON OR ABOUT:</td>
			</tr>
			<tr>
				<td class="parrafo1">&nbsp;&nbsp;FROM: <?php echo $certificado->fromm ?></td>
				<td class="parrafo1">&nbsp;&nbsp;TO: <?php echo $certificado->too ?></td>
				<td class="parrafo1">&nbsp;&nbsp;AMOUNT INSURE: <?php echo $certificado->amount_insure ?></td>
				<td class="parrafo1">&nbsp;&nbsp;PREMIUM: <?php echo $certificado->premium ?></td>
			</tr>
			<tr>
				<td class="parrafo1" colspan="4">
					<p style="font-size: 34px">
						&nbsp;&nbsp;SUBJECT-MATTER INSURED
						<br>
						<br>
						&nbsp;&nbsp;
						<b><?php echo $certificado->matter_insured ?></b>
						<br>
						<br>
						<b>&nbsp;&nbsp;Sobre bienes y /o de mercancias de procedencia legal de todo tipo Excluyendo:</b>
						<br>
						&nbsp;&nbsp;Documentos como contratos, ensayos, diplomas, monedas, acciones de valores, cheques y bonos; así como documentos transables de cualquier tipo; Joyería, piedras preciosas, 
						<br>
						&nbsp;&nbsp;metales preciosos y semi-preciosos (incluyendo cobre), de cualquier tipo (excepto por consentrados de plata, oro y cobre, que estarán sujetos a pre-aviso caso a caso tal como
						<br>
						&nbsp;&nbsp;los gráneles); Animales, plantas y vegetales; vivos o muertos; Obras de arte; Explosivos o inflamables; Armas y municiones; Frutas, Verduras y Hortalizas Frescas; Acero y hierro
					</p>
				</td>
			</tr>
			<tr>
				<td class="parrafo4" colspan="4" style="text-align: center;"> CLAUSES, SPECIAL CONDITIONS AND WARRANTIES </td>
			</tr>
			<tr>
				<td class="parrafo1" colspan="4" style="border-bottom: 0px;">
					<p style="font-size: 34px;">
						&nbsp;&nbsp;Standar Condition
						<br>
						&nbsp;&nbsp;Cláusulas del Instituto
						<br>
						&nbsp;&nbsp;Cláusulas de Carga del Instituto (A) CI. 382 1/1/09 (solo para mercaderia nueva y sin uso)
						<br>
						&nbsp;&nbsp;Cláusulas de Carga del Instituto (C) CI. 384 1/1/09 (para mercadería usada)
						<br>
						&nbsp;&nbsp;Cláusulas de Carga del Instituto (Aéreas) excluyendo envíos postales. CI. 387 1/1/09
						<br>
						&nbsp;&nbsp;Cláusula de Carga del Instituto para Alimentos Congelados (A) (Excluyendo Carne Congelada) CI. 263 1/1/86
						<br>
						&nbsp;&nbsp;Cláusula de Carne Congelada (A) - Paralización de 24 Horas CI. 324 1/1/86
						<br>
						&nbsp;&nbsp;Cláusulas de Guerra del Instituto CI. 385 1/1/09. Cláusulas de Huelga del Instituto CI. 386 1/1/09
						<br>
						&nbsp;&nbsp;Cláusula de Reemplazo del Instituto CI. 161 1/1/34
						<br>
						&nbsp;&nbsp;Cláusula de Huelga del Instituto para Alimentos Congelados (Excluyendo Carne Congelada) CI. 265 1/1/86 
						<br>
						&nbsp;&nbsp;Cláusula de Huelga del Instituto para Carne Congelada CI. 326 1/1/86
						<br>
						&nbsp;&nbsp;Cláusulas de Huelga del Instituto (Carga Aérea) CL.260. Cláusula de Guerra del Instituto (Carga Aérea) CL. 258  
						<br>
						&nbsp;&nbsp;Cláusula de Clasificación del Instituto CL. 354 1/1/01
					</p>
				</td>
			</tr>
			<tr>
				<td class="parrafo2" colspan="4" style="text-align: center;border-top: 0px"> 
				<br>
					Subject to term and conditions of Policy No: <?php echo $certificado->policy_no ?></td>
			</tr>
			<tr>
				<td class="parrafo1" colspan="4">
					<ul style="font-size: 34px;">
						<li>&nbsp;&nbsp;&nbsp;&nbsp;Cláusula de Exclusión de Contaminación Radioactiva, Armas Quimicas, Bioquímicas y Electromagnéticas del Instituto, CL. 370</li>
						<li>&nbsp;&nbsp;&nbsp;&nbsp;Cláusulas de Exclusión de Ataque Cibernético del Instituto CL. 380</li>
						<li>&nbsp;&nbsp;&nbsp;&nbsp;Cláusula de Exclusión de Armas Químicas, Biológicas, Bioquímicas y Electromagnéticas del Instituto CL. 365 1/11/02</li>
						<li>&nbsp;&nbsp;&nbsp;&nbsp;Cláusula de Término del Tránsito (Terrorismo) JC2009/056</li>
						<li>&nbsp;&nbsp;&nbsp;&nbsp;Cláusula de Pago de Primas LSW 3001</li>
					</ul>

				</td>
			</tr>
			<tr>
				<td class="parrafo1" colspan="4" style="border-top: 0px;text-align: center;border-bottom: 0px">
					<p style="font-size: 34px;">
						Important
						<br>
						Procedure in the event of los sor damage for wich underwrites may be liable Liability of carrier, bailees or other third parties.
						<br>
					</p>
				</td>
			</tr>
			<tr>
				<td class="parrafo1" colspan="4" style="border-top: 0px">
					<p style="font-size: 34px;text-align: left;">
					<br>
					It is the duty of the Assured and their Agents, in all cases, to take such measures as may be reasonable for the purpose of averting or minimising a loss and to ensure that all rights against Carriers, Bailees or other third parties are properly preserved and exercised. In particular, the Assured or their Agents are required:
					<br>
						<br>
					&nbsp;&nbsp;1. To claim immediately on the Carriers, Port Authorities or other Bailees for any missing packages.
					<br>
					&nbsp;&nbsp;2. In no circumstances, except under written protest, to give clean receipts where goods are in doubtful condition.
					<br>
						&nbsp;&nbsp;3. When delivery is made by Container, to ensure that the Container and its seals are examined immediately by their respective official. If the Container is delivered damaged or &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;with seals broken or missing or with seals other than as stated in the shipping documents, to clause the delivery receipt accordingly and retain all defective or irregular seals for &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subsequent identification. 
					<br>
						&nbsp;&nbsp;4. To apply immediately for survey by Carriers' or other Bailees' Representatives if any loss or damage be apparent and claim on the Carriers or other Bailees for any actual loss or &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;damage found at such survey.
					<br>
						&nbsp;&nbsp;5. To give notice in writing to the Carriers or other Bailees within 3 days of delivery if the loss or damage was not apparent at the time of taking delivery. Note: - The Consignees or &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;their Agents are recommended to make themselves familiar with the Regulations of the Port Authorities at the port of discharge B. INSTRUCTIONS FOR SURVEY 
					<br>
						&nbsp;&nbsp;6. In the event of loss or damage which may involve a claim under this insurance, immediate notice of such loss or damage should be given to and a Survey Report obtained from &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;the oficce or agent nominated velow. C.DOCUMENTATION OF CLAIMS.  
					<br>
					&nbsp;&nbsp;7. In the event of any claim arising under this insurance, request for settlement should be madeto the settling agent named below. 
					<br>
					&nbsp;&nbsp;8. To enable claims to be dealt with promptly, the Assured or their Agents are advised to submit all available supporting documents without delay, including when applicable:
					<br> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Original policy or certificate of insurance.
					<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Original or copy of shipping invoices together with shipping specification and/or weight notes.
					<br>					
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c. Original Bill of Lading and/or other contract of carriage.
					<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;d. Survey report and other documentary evidence to show the extent of the loss or damage.
					<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;e. Landing account and weight notes at final destination.  			
					<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f. Correspondence exchanged with the carriers. D. GENERAL AVERAGE 9. A general average agreement should be signed only under reserve of all rights and with the option to &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;appeal. The settling agent named below should in any case be consulted before complementing such lagrement.
						
					</p>
				</td>
			</tr>
			<tr>
				<td class="parrafo4" colspan="2">SETTLING AGENT: <?php echo $certificado->nombre_cliente ?></td>
				<td class="parrafo4" colspan="2">CLAUSE: <?php echo $certificado->clausula?></td>
			</tr>
			<tr>
				<td class="parrafo4" colspan="1" style="text-align: left;border-bottom: 0px"><br>Issue Date:
					<b><?php echo $certificado->fecha_emision ?></b> <br><br>shipping date:
					<b><?php echo $certificado->fecha_envio ?></b> <br></td>
				<td class="parrafo4" colspan="2" style="text-align: left;border-bottom: 0px"><br>Countersignature:<br><br>Guia/BL:
					<b><?php echo $certificado->b_l ?></b><br></td>
				<td class="parrafo4" colspan="1" style="text-align: center;border-bottom: 0px;">
						<img width="70%" src="<?=base_url() ?>recursos/images/FirmaPeru.jpg">
					<br>Firma
				</td>
			</tr>
			<tr>
				<td class="parrafo4" colspan="1" style="text-align: center;border-top: 0px"><br><br></td>
				<td class="parrafo4" colspan="2" style="text-align: center;border-top: 0px"><br><br></td>
				<td class="parrafo4" colspan="1" style="text-align: center;border-top: 0px"><br><br></td>
			</tr>
		</table>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	 <div style="border-color: black;border-width: 2px;border-style: solid;padding: 10px">
		<table style="border: hidden">
			<tr style="border: hidden">
				<td style="border: hidden" >
				</td>
				<td style="border: hidden">	
				</td>
				<td style="border: hidden">	
				</td>
				<td style="text-align: right;border: hidden">
					<img width="150%" src="<?=base_url() ?>recursos/images/bandera_peruana.jpg">		
				</td>
			</tr>
		</table>

		<table style="font-family: Arial;margin-top: 40px;border: hidden">
			<tr style="background-color: #edebf1;border: hidden">	
				<td style="text-align: center;font-size:18px;">
					<p>NOTA DE COBRO SEEMANN GROUP</p>
				</td>		
			</tr>
		</table>
		
		<table style="font-family: Arial;border: hidden;margin-top: 30px;">
			<tr style="border: hidden">
				<td style="border: hidden"></td>
				<td style="border: hidden"></td>
				<td style="text-align: center;font-size:60px;border: hidden">
					<b>N°</b>
				</td>
				<td style="text-align: center;font-size:60px;border: hidden">
					<b><?php echo $certificado->certificate_no ?></b>
				</td>
			</tr>
			<tr style="border: hidden;border: hidden">
				<td style="border: hidden"></td>
				<td style="border: hidden"></td>
				<td style="text-align: center;font-size:50px;border: hidden">
					<b>Fecha</b>
				</td>
				<td style="text-align: center;font-size:50px;border: hidden">
					<b><?php echo $certificado->fecha_emision ?></b>
				</td>
			</tr>
		</table>
		
		<table style="font-family: Arial;margin-top: 30px;border: hidden">
			<tr style="border: hidden">
				<td style="text-align: left;font-size:15px;border: hidden">
					<p>DATOS DEL ASEGURADO</p>
				</td>
			</tr>
		</table>
		
			<table style="font-family: Arial;border: hidden">
				<tr>
					<td style="text-align: left;font-size:35px;padding-left: 40px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						ASEGURADO
					</td>
					<td colspan="2" style="text-align: left;font-size:35px;padding-left: 60px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						<?php echo $certificado->asegurado ?>
					</td>
					<!--<td style="border: hidden">
					</td>-->
				</tr>
				<tr>
					<td style="text-align: left;font-size:35px;padding-left: 40px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						RUC
					</td>
					<td colspan="2" style="text-align: left;font-size:35px;padding-left: 60px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						<?php echo $certificado->ruc ?>
					</td>
					<!--<td style="border: hidden">
					</td>-->
				</tr>
				<tr>
					<td style="text-align: left;font-size:35px;padding-left: 40px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						DOMICILIO
					</td>
					<td colspan="2" style="text-align: left;font-size:35px;padding-left: 60px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						<?php echo $certificado->domicilio ?>
					</td>
					<!--<td style="border: hidden">
					</td>-->
				</tr>
				<tr>
					<td style="text-align: left;font-size:35px;padding-left: 40px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						CIUDAD
					</td>
					<td colspan="2" style="text-align: left;font-size:35px;padding-left: 60px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						&nbsp;
					</td>
					<!--<td style="border: hidden">
					</td>-->
				</tr>
				<tr>
					<td style="text-align: left;font-size:35px;padding-left: 40px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						PAIS
					</td>
					<td style="text-align: left;font-size:35px;padding-left: 60px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						<?php echo $certificado->pais ?>
					</td>
					<td style="border: hidden">
					</td>
				</tr>
			</table>
		
		<table style="font-family: Arial;margin-top: 40px;border: hidden">
			<tr>
				<td style="text-align: left;font-size:15px;border: hidden">
					<p>DATOS DEL CERTIFICADO</p>
				</td>
			</tr>
		</table>
		
		
		<table style="font-family: Arial;border: hidden">
				<tr>
					<td style="text-align: left;font-size:35px;padding-left: 40px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						CONDICIONES DE PAGO
					</td>
					<td colspan="2" style="text-align: left;font-size:35px;padding-left: 60px;border: hidden" VALIGN=TOP VALIGN=TOP>
						<b><?php echo $certificado->condiciones_pago ?></b>
					</td>
					<!--<td style="border: hidden">
					</td>-->
				</tr>
				<tr>
					<td style="text-align: left;font-size:35px;padding-left: 40px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						POR LA CANCELACIÓN DE LO SIGUIENTE:
					</td>
					<td style="border: hidden">					
					</td>
					<td style="border: hidden">
					</td>
				</tr>
				<tr>
					<td style="text-align: left;font-size:35px;padding-left: 40px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						POLIZA DE TRANSPORTE
					</td>
					<td colspan="2" style="text-align: left;font-size:35px;padding-left: 60px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						<?php echo $certificado->policy_no ?>
					</td>
					<!--<td style="border: hidden">
					</td>-->
				</tr>
				<tr>
					<td style="text-align: left;font-size:35px;padding-left: 40px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						NUMERO CERTIFICADO
					</td>
					<td colspan="2" style="text-align: left;font-size:35px;padding-left: 60px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						<?php echo $certificado->certificate_no ?>
					</td>
					<!--<td style="border: hidden">
					</td>-->
				</tr>
				<tr style="border: hidden">
					<td style="text-align: left;font-size:35px;padding-left: 40px;padding-bottom: 20px;padding-top: 20px;border: hidden" VALIGN=TOP>
						FECHA EMISIÓN
					</td>
					<td colspan="2" style="text-align: left;font-size:35px;padding-left: 60px;padding-bottom: 20px;padding-top: 20px;" VALIGN=TOP>
						<?php echo $certificado->fecha_emision ?>
					</td>
					<!--<td style="border: hidden">
					</td>-->
				</tr>
			</table>
		
		
		<table style="font-family: Arial;margin-top: 40px;border: hidden">
			<tr>
				<td style="text-align: left;font-size:15px;border: hidden">
					<p>MONTO USD</p>
				</td>
			</tr>
		</table>
		
		<table style="font-family: Arial;border: hidden;margin-top: 50px;margin-bottom: 110px;">
				<tr>
					<td style="border-top:hidden;border-bottom:hidden;border-left:hidden;">
						
					</td>
					<td style="text-align: left;padding-left: 80px;font-size:55px;padding-bottom: 30px;padding-top: 30px;border-bottom:hidden;border-right:hidden;">
						<b>MONTO ASEGURADO :</b>
					</td >
					<td style="text-align: right;padding-left: 80px;padding-right: 80px;font-size:55px;padding-bottom: 30px;padding-top: 30px;border-bottom:hidden;">
						<b><?php echo $certificado->amount_insure ?></b>
					</td>
					<td style="border-top:hidden;border-bottom:hidden;border-right:hidden;">
					</td>
				</tr>
				<tr>
					<td style="border-left:hidden;border-bottom:hidden;">
						
					</td>
					<td style="text-align: left;padding-left: 80px;font-size:55px;padding-bottom: 30px;padding-top: 30px;border-right:hidden;">
						<b>PRIMA TOTAL :</b>
					</td >
					<td style="text-align: right;padding-left: 80px;padding-right: 80px;font-size:55px;padding-bottom: 30px;padding-top: 20px;">
						<b><?php echo $certificado->premium ?></b>
					</td>
					<td style="border-right:hidden;border-bottom:hidden;">
					</td>
				</tr>
			</table>
		</div>	
	</body>
</html>

