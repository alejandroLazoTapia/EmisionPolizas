<?php

class Certificado extends CI_Model
{
	public function obtenerClientes($nombreUsuario = '')
	{
	
		$sql = "select distinct cli.id as id_cliente,
		cli.nombre as nombre_cliente
		FROM  CLIENTE cli
		INNER JOIN USUARIO usu on cli.id = case when usu.id_perfil = 2 then usu.id_grupo
		else
			cli.id end and usu.estado_reg = 1
		WHERE   usu.nombre_usuario = '".$nombreUsuario."'
		and cli.estado_reg = 1
		order by cli.nombre asc";

		$result = $this->db->query($sql);
		
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}  
	}
	
	
	public function obtenerAllClient()
	{

		$sql = "select distinct 
					id as id_cliente,
					nombre as nombre_cliente
				FROM CLIENTE
				WHERE  estado_reg = 1
				order by nombre asc";

		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}

	public function obtenerPolizasCliente($idCliente = '')
	{
		$sql = "select pol.id as id_poliza,
		CONCAT(pol.desc_poliza,'-',pol.codigo_poliza) as nombre_poliza
		FROM CLIENTE cli
		INNER JOIN POLIZA pol on pol.id_cliente = cli.id and pol.estado_reg = 1 
		WHERE   cli.id = '".$idCliente."'
		AND 	cli.estado_reg = 1 
		order by pol.desc_poliza asc";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}  
	}


	public function obtenerCertificadosCliente($idCliente = '', $idPoliza = '' )
	{
		$sql = "select distinct
		cer.id
		FROM CERTIFICADO cer
		INNER JOIN CLIENTE cli on cli.id = cer.id_cliente and cer.estado_reg = 1 and cli.estado_reg = 1
		INNER JOIN POLIZA pol on pol.id = cer.id_poliza and pol.estado_reg = 1
		INNER JOIN CLAUSULA cla on cla.id = cer.id_clausula and cla.estado_reg = 1
		INNER JOIN EMBARQUE emb on emb.id = cer.id_tipo_embarque and emb.estado_reg = 1
		INNER JOIN TRANSPORTE tra on tra.id = cer.id_transporte and tra.estado_reg = 1
		INNER JOIN MONEDA mon on mon.id = cer.id_moneda and mon.estado_reg = 1
		INNER JOIN PAIS paiori on paiori.id = cer.id_pais_origen and paiori.estado_reg = 1
		INNER JOIN PAIS paides on paides.id = cer.id_pais_destino and paides.estado_reg = 1
		INNER JOIN PAIS paisem on paisem.id = cer.id_pais_emision and paisem.estado_reg = 1
		INNER JOIN TIPO_EMBALAJE tipemb on tipemb.id = cer.id_tipo_embalaje and tipemb.estado_reg = 1
		INNER JOIN ESTADO_REGION estrego on estrego.id = cer.id_est_reg_origen and estrego.estado_reg = 1
		INNER JOIN ESTADO_REGION estregd on estregd.id = cer.id_est_reg_origen and estregd.estado_reg = 1
		WHERE   cli.id = '".$idCliente."'
		and	pol.id = '".$idPoliza."'
		order by cer.id asc";


		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}  
	}
	
	
	public function obtenerCertificadoPrevio($idCliente = '', $idPoliza = '', $idCertificado = '' )
	{
		$sql = "select cer.id as id_certificado,
		cer.id_cliente,
		cli.nombre,
		cer.id_poliza,
		CONCAT(pol.desc_poliza,'-',pol.codigo_poliza) as nombre_poliza,
		cer.id_a_favor,
		afa.nombre as nombre_a_favor,
		cli.direccion as direccion_cliente,
		cer.id_pais_emision,
		paisem.desc_pais as pais_emision,
		cer.referencia_interna,
		cer.id_moneda,
		mon.desc_moneda as moneda,
		cer.prima_minima as deducible,
		cer.monto_asegurado as monto_asegurado,
		cer.tasa,
		cer.prima,
		cer.fecha_embarque,
		cer.fecha_arribo,
		cer.guia_bl,
		cer.nombre_linea,
		cer.nombre_nave,
		cer.vuelo_nave as nro_vuelo_nave,
		cer.id_tipo_embalaje,
		tipemb.desc_embalaje as embalaje,
		cer.desc_otro_tipo_embalaje as otro_embalaje,
		cer.id_transporte,
		tra.desc_transporte as transporte,
		cer.id_tipo_embarque,
		emb.desc_embarque as embarque,
		cer.desc_mercaderia,
		cer.id_pais_origen,
		paiori.desc_pais as pais_origen,
		cer.id_est_reg_origen,
		estrego.desc_estado_region as estado_region_origen,
		cer.puerto_origen,
		cer.id_pais_destino,
		paides.desc_pais as pais_destino,
		cer.id_est_reg_destino,
		estregd.desc_estado_region as estado_region_destino,
		cer.puerto_destino,
		cer.id_clausula,
		cla.desc_clausula as nombre_clausula

		FROM CERTIFICADO cer
		INNER JOIN CLIENTE cli on cli.id = cer.id_cliente and cer.estado_reg = 1 and cli.estado_reg = 1
		INNER JOIN EMPRESA_A_FAVOR afa on afa.id = cer.id_a_favor and afa.estado_reg = 1
		INNER JOIN POLIZA pol on pol.id = cer.id_poliza and pol.id_cliente = cli.id and pol.estado_reg = 1
		INNER JOIN CLAUSULA cla on cla.id = cer.id_clausula and cla.estado_reg = 1
		INNER JOIN EMBARQUE emb on emb.id = cer.id_tipo_embarque and emb.estado_reg = 1
		INNER JOIN TRANSPORTE tra on tra.id = cer.id_transporte and tra.estado_reg = 1
		INNER JOIN MONEDA mon on mon.id = cer.id_moneda and mon.estado_reg = 1
		INNER JOIN PAIS paiori on paiori.id = cer.id_pais_origen and paiori.estado_reg = 1
		INNER JOIN PAIS paides on paides.id = cer.id_pais_destino and paides.estado_reg = 1
		INNER JOIN PAIS paisem on paisem.id = cer.id_pais_emision and paisem.estado_reg = 1
		INNER JOIN TIPO_EMBALAJE tipemb on tipemb.id = cer.id_tipo_embalaje and tipemb.estado_reg = 1
		INNER JOIN ESTADO_REGION estrego on estrego.id = cer.id_est_reg_origen and estrego.estado_reg = 1
		INNER JOIN ESTADO_REGION estregd on estregd.id = cer.id_est_reg_destino and estregd.estado_reg = 1
		WHERE   cer.id_cliente = '".$idCliente."'
		AND cer.id_poliza = '".$idPoliza."'
		AND cer.id = '".$idCertificado."'";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}  
	}
	
	public function obtenerEmpresasAFavor($idCliente)
	{
		$sql = "SELECT DISTINCT id as id_a_favor,
								nombre as nombre_a_favor
						  FROM  EMPRESA_A_FAVOR
						  WHERE  id_cliente = '".$idCliente."'
						   AND	estado_reg = 1
						   ORDER BY  nombre asc";

		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}

	public function obtenerPaisesEmision()
	{

		$sql = "SELECT id as id_pais,
					   desc_pais as nombre_pais  
		          FROM PAIS
		         WHERE id in (81,89)
				   AND estado_reg = 1
			  ORDER BY desc_pais asc";

		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();

		} else {
			return null;
		}
	}
	
	public function obtenerPaises()
	{
		$sql = "SELECT DISTINCT id as id_pais, 
								desc_pais as nombre_pais 
						   FROM PAIS
						  WHERE estado_reg = 1
					   ORDER BY desc_pais asc";

		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}	
	
	public function obtenerMonedas()
	{
		$sql = "SELECT DISTINCT id as id_moneda,
								desc_moneda as nombre_moneda
						  FROM  MONEDA
						 WHERE  estado_reg = 1
					  ORDER BY  desc_moneda desc";

		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}	
	
	public function obtenerClausulas()
	{
		$sql = "SELECT DISTINCT id as id_clausula,
								desc_clausula as nombre_clausula
						  FROM  CLAUSULA
						 WHERE  estado_reg = 1
					  ORDER BY  desc_clausula asc";
		
		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}	
	
	public function obtenerTipoEmbalaje()
	{
		$sql = "SELECT DISTINCT id as id_embalaje,
								desc_embalaje as tipo_embalaje
						  FROM  TIPO_EMBALAJE
						 WHERE  estado_reg = 1
					  ORDER BY  desc_embalaje asc";

		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}	
	
	public function obtenerTipoTransporte()
	{
		$sql = "SELECT DISTINCT id as id_transporte,
								desc_transporte as tipo_transporte
						   FROM TRANSPORTE
						  WHERE estado_reg = 1
					   ORDER BY id asc";

		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
	
	public function obtenerCiudadesPais($idPais)
	{
		$sql = "SELECT DISTINCT id as id_region_estado,
								desc_estado_region as nombre_region_estado
						   FROM ESTADO_REGION
						  WHERE id_pais = '".$idPais."'
				            AND estado_reg = 1
					   ORDER BY CASE id WHEN 1513 THEN 0
								ELSE id END asc";

		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
	
	function ingresarCertificado($data)
	{
		$this->db->insert("CERTIFICADO",$data);

		if ($this->db->affected_rows() > 0) {
			$ultimoId = $this->db->insert_id();
			return $ultimoId;
		} else {
			return 0;
		}
	}
	
	function ingresarCertificadoPoliza($data)
	{
		$this->db->insert("POLIZA_CLIENTE",$data);

		if ($this->db->affected_rows() > 0) {
			$idPolCli = $this->db->insert_id();
			return $idPolCli;
		} else {
			return 0;
		}
	}
	
	function actualizarCertificado($idCertificado, $data)
	{
		$this->db->where('id',$idCertificado);
		$this->db->update('CERTIFICADO',$data);
		
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function actualizarPolizaCliente($idCertificado, $data)
	{

		$this->db->where("id_certificado",$idCertificado);
		$this->db->update("POLIZA_CLIENTE",$data);
		return TRUE;
	}
	
	function eliminarCertificado($idCertificado, $data)
	{
		$this->db->where('id',$idCertificado);
		$this->db->update('CERTIFICADO',$data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function eliminarPolizaCliente($idCertificado, $data)
	{
		$this->db->where("id_certificado",$idCertificado);
		$this->db->update("POLIZA_CLIENTE",$data);
		
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function obtenerCertificadoChile($idCliente, $idPolizas, $idCertificado)
	{
		$sql = "select pol.codigo_poliza as poliza_nro,
		cer.id as correlativo,
		CONCAT(mon.nombre_moneda ,' (',mon.signo,')') as moneda,
		'7036M' AS aviso_nro,
		'DEFINITIVO' AS tipo_certificado,
		CONCAT(cli.nombre,' Rut: ',
		case when length(cli.rut) = 8 THEN insert(insert(cli.rut,3,0,'.'),7,0,'.')
		else insert(insert(cli.rut,2,0,'.'),6,0,'.')
		end,'-',cli.dv) as asegurado,
		/*CONCAT(afa.nombre,' Rut: ',
		case when length(afa.rut) = 8 THEN insert(insert(afa.rut,3,0,'.'),7,0,'.')
		else insert(insert(afa.rut,2,0,'.'),6,0,'.')
		end,'-',afa.dv) as asegurado,*/
		cer.desc_mercaderia as materia,
		tipemb.desc_embalaje as embalaje,
		DATE_FORMAT(cer.fecha_arribo, '%d-%m-%Y') as fecha_salida,
		paiori.desc_pais as origen,
		estrego.desc_estado_region as via,
		'0' as nro_bultos,
		cer.nombre_linea as nombre_linea,
		CONCAT(estregd.desc_estado_region ,',', paides.desc_pais) as destino,
		cer.guia_bl as b_l,
		cer.nombre_nave as nave,
		CONCAT('TRANSPORTE ',tra.nombre_transporte,' PARA CARGA ',cla.desc_clausula) as cobertura,
		CONCAT(mon.signo,cer.monto_asegurado) as monto_asegurado,
		CONCAT(mon.signo,cer.prima) as prima,
		DATE_FORMAT(cer.fecha_mod, '%d-%m-%Y') as fecha_emision,
		mon.signo
		FROM CERTIFICADO cer
		INNER JOIN CLIENTE cli on cli.id = cer.id_cliente and cer.estado_reg = 1 and cli.estado_reg = 1
		INNER JOIN EMPRESA_A_FAVOR afa on afa.id = cer.id_a_favor and afa.estado_reg = 1
		INNER JOIN POLIZA pol on pol.id = cer.id_poliza and pol.id_cliente = cli.id and pol.estado_reg = 1
		INNER JOIN CLAUSULA cla on cla.id = cer.id_clausula and cla.estado_reg = 1
		INNER JOIN EMBARQUE emb on emb.id = cer.id_tipo_embarque and emb.estado_reg = 1
		INNER JOIN TRANSPORTE tra on tra.id = cer.id_transporte and tra.estado_reg = 1
		INNER JOIN MONEDA mon on mon.id = cer.id_moneda and mon.estado_reg = 1
		INNER JOIN PAIS paiori on paiori.id = cer.id_pais_origen and paiori.estado_reg = 1
		INNER JOIN PAIS paides on paides.id = cer.id_pais_destino and paides.estado_reg = 1
		INNER JOIN PAIS paisem on paisem.id = cer.id_pais_emision and paisem.estado_reg = 1
		INNER JOIN TIPO_EMBALAJE tipemb on tipemb.id = cer.id_tipo_embalaje and tipemb.estado_reg = 1
		INNER JOIN ESTADO_REGION estrego on estrego.id = cer.id_est_reg_origen and estrego.estado_reg = 1
		INNER JOIN ESTADO_REGION estregd on estregd.id = cer.id_est_reg_destino and estregd.estado_reg = 1
		WHERE   cer.id_cliente = ".$idCliente."
		AND cer.id_poliza = ".$idPolizas."
		AND cer.id = ".$idCertificado."
		AND cer.estado_reg = 1";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return null;
		}
	}
	
	public function obtenerCertificadoPeru($idCliente, $idPolizas, $idCertificado)
	{
		$sql = "select pol.codigo_poliza as policy_no,
		cer.id as certificate_no,
		CONCAT(mon.nombre_moneda ,' (',mon.signo,')') as moneda,
		'7036M' AS aviso_nro,
		'DEFINITIVO' AS tipo_certificado,
		CONCAT(cli.nombre,' Rut: ',
		case when length(cli.rut) = 8 THEN insert(insert(cli.rut,3,0,'.'),7,0,'.')
		else insert(insert(cli.rut,2,0,'.'),6,0,'.')
		end,'-',cli.dv) as asegurado,
		/*CONCAT(afa.nombre,' Rut: ',
		case when length(afa.rut) = 8 THEN insert(insert(afa.rut,3,0,'.'),7,0,'.')
		else insert(insert(afa.rut,2,0,'.'),6,0,'.')
		end,'-',afa.dv) as asegurado,*/
		cer.desc_mercaderia as matter_insured,
		tipemb.desc_embalaje as embalaje,
		cer.fecha_arribo as fecha_salida,
		paiori.desc_pais as origen,
		estrego.desc_estado_region as via,
		'0' as nro_bultos,
		cer.nombre_linea as nombre_linea,
		CONCAT(estregd.desc_estado_region ,',', paides.desc_pais) as destino,
		cer.guia_bl as b_l,
		cer.nombre_nave as nave,
		tra.nombre_transporte as convetance,
		CONCAT('TRANSPORTE ',tra.nombre_transporte,' PARA CARGA ',cla.desc_clausula) as cobertura,
		CONCAT(mon.signo,cer.monto_asegurado) as monto_asegurado,
		CONCAT(mon.signo,cer.prima) as prima,
		DATE_FORMAT(cer.fecha_mod, '%d-%m-%Y') as fecha_emision,
		mon.signo
		FROM CERTIFICADO cer
		INNER JOIN CLIENTE cli on cli.id = cer.id_cliente and cer.estado_reg = 1 and cli.estado_reg = 1
		INNER JOIN EMPRESA_A_FAVOR afa on afa.id = cer.id_a_favor and afa.estado_reg = 1
		INNER JOIN POLIZA pol on pol.id = cer.id_poliza and pol.id_cliente = cli.id and pol.estado_reg = 1
		INNER JOIN CLAUSULA cla on cla.id = cer.id_clausula and cla.estado_reg = 1
		INNER JOIN EMBARQUE emb on emb.id = cer.id_tipo_embarque and emb.estado_reg = 1
		INNER JOIN TRANSPORTE tra on tra.id = cer.id_transporte and tra.estado_reg = 1
		INNER JOIN MONEDA mon on mon.id = cer.id_moneda and mon.estado_reg = 1
		INNER JOIN PAIS paiori on paiori.id = cer.id_pais_origen and paiori.estado_reg = 1
		INNER JOIN PAIS paides on paides.id = cer.id_pais_destino and paides.estado_reg = 1
		INNER JOIN PAIS paisem on paisem.id = cer.id_pais_emision and paisem.estado_reg = 1
		INNER JOIN TIPO_EMBALAJE tipemb on tipemb.id = cer.id_tipo_embalaje and tipemb.estado_reg = 1
		INNER JOIN ESTADO_REGION estrego on estrego.id = cer.id_est_reg_origen and estrego.estado_reg = 1
		INNER JOIN ESTADO_REGION estregd on estregd.id = cer.id_est_reg_destino and estregd.estado_reg = 1
		WHERE   cer.id_cliente = ".$idCliente."
		AND cer.id_poliza = ".$idPolizas."
		AND cer.id = ".$idCertificado."
		AND cer.estado_reg = 1";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return null;
		}
	}
	
	
}

?>