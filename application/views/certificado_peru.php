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
		</style>
	</head>
	<body>
		<?php
		/*echo "
		<pre>";
		print_r($certificado);
		echo "</pre>";*/
		?>

		<table style="border:0px solid">
			<tr>
				<td  class="titulo1" style="border:0px solid;text-align: left;width: 310px;">
					<img src="<?=base_url() ?>recursos/images/LogoSGG.jpg">
				</td>
		
				<td  class="titulo1" style="border: 0px solid;vertical-align: bottom;text-align: center;">
					Certificate Of Insurance
				</td>
				<td  class="titulo1" style="border:0px solid;text-align: left;width: 310px;">
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
					SGG LOGISTICS
					<br></br>
					MAIPU,SANTIAGO, CHILE
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
				<td class="parrafo1" colspan="2" rowspan="2" VALIGN=TOP>&nbsp;&nbsp;CONVETANCE: <br>
					&nbsp;
					<b><?php echo $certificado->convetance ?></b></td>
			</tr>
			<tr>
				<td class="parrafo1" colspan="2">&nbsp;&nbsp;DEPARTING ON OR ABOUT:</td>
			</tr>
			<tr>
				<td class="parrafo1">&nbsp;&nbsp;FROM:</td>
				<td class="parrafo1">&nbsp;&nbsp;TO: </td>
				<td class="parrafo1">&nbsp;&nbsp;AMOUNT INSURE: 1</td>
				<td class="parrafo1">&nbsp;&nbsp;PREMIUM: </td>
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
				<td class="parrafo4" colspan="2">SETTLING AGENT:</td>
				<td class="parrafo4" colspan="2">CLAUSE:</td>
			</tr>
			<tr>
				<td class="parrafo4" colspan="1" style="text-align: left;border-bottom: 0px"><br>Issue Date:
					<b><?php echo $certificado->fecha_emision ?></b> <br><br>shipping date:
					<b><?php echo $certificado->fecha_emision ?></b> <br></td>
				<td class="parrafo4" colspan="2" style="text-align: left;border-bottom: 0px"><br>Countersignature:<br><br>Guia/BL:
					<b><?php echo $certificado->b_l ?></b><br></td>
				<td class="parrafo4" colspan="1" style="text-align: center;border-bottom: 0px"><br>Sergio Orellana, Gerente General<br><br>FIRMA<br></td>
			</tr>
			<tr>
				<td class="parrafo4" colspan="1" style="text-align: center;border-top: 0px"><br><br></td>
				<td class="parrafo4" colspan="2" style="text-align: center;border-top: 0px"><br><br></td>
				<td class="parrafo4" colspan="1" style="text-align: center;border-top: 0px"><br><br></td>
			</tr>
		</table>


		<table style="border:0px solid">
			<tr>
				<td class="parrafo3" style="border:0px solid"></td>
				<td class="parrafo3" style="border:0px solid;text-align:center;"><br>Valide su certificado en nuestro sitio web sgglogistics.cl/validacion<br>Codigo: abcdef123465</td>

			</tr>
		</table>
	</body>
</html>

