<?php
class Prima extends CI_Model
{
	public function obtenerClientes($idUsuario, $idPerfil)
	{
		$sql = "select distinct cli.id as id_cliente,
				cli.nombre as nombre_cliente,
		        cli.rut_dni,
		        cli.telefono,
		        cli.direccion,
		        cli.condiciones
				FROM  CLIENTE cli
				LEFT JOIN USUARIO usu on usu.id = cli.id_usuario
				WHERE   usu.id = case when '".$idPerfil."' = 1 then usu.id
								else '".$idUsuario."'
		                        end
				and cli.estado_reg = 1
		        and usu.estado_Reg = 1
				order by cli.nombre asc";

		$result = $this->db->query($sql);
		
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		} 
	} 
		
		
	public function obtenerAnoUsuario($nombreUsuario)
	{
		$sql = "select  distinct
			date_format(cer.fecha_reg, '%Y') as ano
			FROM CERTIFICADO cer
			INNER JOIN CLIENTE cli on cli.id = cer.id_cliente and cer.estado_reg = 1 
			INNER JOIN POLIZA pol on pol.id = cer.id_poliza and pol.id_cliente = cli.id 
			INNER JOIN USUARIO usu on usu.id = cli.id_usuario
			WHERE usu.nombre_usuario = '".$nombreUsuario."'
			order by ano desc";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
	
	public function obtenerAnoVigente($idCliente)
	{
		$sql = "select  distinct
					date_format(cer.fecha_reg, '%Y') as ano
					FROM CERTIFICADO cer
					INNER JOIN CLIENTE cli on cli.id = cer.id_cliente and cer.estado_reg = 1 
					INNER JOIN POLIZA pol on pol.id = cer.id_poliza and pol.id_cliente = cli.id 
					INNER JOIN USUARIO usu on usu.id = cli.id_usuario
				WHERE cer.id_cliente = ".$idCliente."
		        order by ano desc";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
	
	
	public function obtieneMesVigente($ano, $idCliente)
	{
		$sql = "select DISTINCT
		date_format(cer.fecha_reg, '%c') as id_mes,
        CONCAT(UPPER(LEFT(monthname(cer.fecha_reg), 1)), LOWER(SUBSTRING(monthname(cer.fecha_reg), 2))) as desc_mes
		FROM CERTIFICADO cer
		INNER JOIN CLIENTE cli on cli.id = cer.id_cliente 
		WHERE   cer.id_cliente = '".$idCliente."'
		AND 	cer.estado_reg = 1 
		AND 	DATE_FORMAT(cer.fecha_reg, '%Y') = '".$ano."'
		order by id_mes asc";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}	
	
	public function obtenerDetallePrimaMensual($idCliente, $ano, $mes)
	{
		$sql = "select
        cli.nombre as nombre_cliente,
		pol.codigo_poliza as codigo_poliza,
		cer.id as id_certificado,
		cer.fecha_reg as fecha_emision,
		cer.usuario_reg as usuario,
		FORMAT(cer.prima, 2, 'de_DE') as prima_cliente,
        FORMAT(cer.prima_usuario, 2, 'de_DE') as prima_usuario,
        FORMAT(cer.prima_compania, 2, 'de_DE') as prima_compania,
        FORMAT(cer.utilidad, 2, 'de_DE') as utilidad
		FROM CERTIFICADO cer
		INNER JOIN CLIENTE cli on cli.id = cer.id_cliente
		INNER JOIN POLIZA pol on pol.id = cer.id_poliza and pol.id_cliente = cli.id 
		INNER JOIN USUARIO usu on usu.id = cli.id_usuario
		WHERE cer.id_cliente = case when '".$idCliente."' = 0 then cer.id_cliente
								else '".$idCliente."'
                                end
        AND DATE_FORMAT(cer.fecha_reg, '%Y') = case when '".$ano."' = 0 then DATE_FORMAT(cer.fecha_reg, '%Y')
											   else '".$ano."'
                                               end
        AND DATE_FORMAT(cer.fecha_reg, '%c') = case when '".$mes."' = 0 then DATE_FORMAT(cer.fecha_reg, '%c')
											   else '".$mes."'
                                               end
		and cer.estado_reg = 1
        order by cer.id desc";
	
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
	
	
	public function obtenerTotalesPrimaMensual($idCliente, $ano, $mes)
	{
		$sql = "select 
		FORMAT(sum(cer.prima), 2, 'de_DE') as prima_cliente,
        FORMAT(sum(cer.prima_usuario), 2, 'de_DE') as prima_usuario,
        FORMAT(sum(cer.prima_compania), 2, 'de_DE') as prima_compania,
        FORMAT(sum(cer.utilidad), 2, 'de_DE') as utilidad
		FROM CERTIFICADO cer
		INNER JOIN CLIENTE cli on cli.id = cer.id_cliente
		INNER JOIN POLIZA pol on pol.id = cer.id_poliza and pol.id_cliente = cli.id 
		INNER JOIN USUARIO usu on usu.id = cli.id_usuario
		WHERE cer.id_cliente = case when '".$idCliente."' = 0 then cer.id_cliente
								else '".$idCliente."'
                                end
        AND DATE_FORMAT(cer.fecha_reg, '%Y') = case when '".$ano."' = 0 then DATE_FORMAT(cer.fecha_reg, '%Y')
											   else '".$ano."'
                                               end
        AND DATE_FORMAT(cer.fecha_reg, '%c') = case when '".$mes."' = 0 then DATE_FORMAT(cer.fecha_reg, '%c')
											   else '".$mes."'
                                               end
		and cer.estado_reg = 1
        order by cer.id desc";
	
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
}
?>