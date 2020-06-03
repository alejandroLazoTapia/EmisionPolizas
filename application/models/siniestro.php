<?php

class Siniestro extends CI_Model
{
	
	public function existSinister($id_certificado)
	{
		$sql = "SELECT id FROM SINIESTRO
				WHERE id_certificado = '".$id_certificado."' 
				and estado_reg = 1";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
 
	public function insertSinister($data)
	{
		$this->db->insert("SINIESTRO",$data);

		if ($this->db->affected_rows() > 0) {
			$ultimoId = $this->db->insert_id();
			return $ultimoId;
		} else {
			return 0;
		}
	}

	public function getSinesterClient($idCliente)
	{
		$sql = "SELECT DISTINCT sin.id as id_siniestro,
								sin.id_certificado,
								sin.fecha_reg as fecha_ingreso,
								est.desc_estado as estado,
								pol.codigo_poliza as poliza,
								FORMAT(sin.monto, 2, 'de_DE') AS monto
						   FROM SINIESTRO sin
					 INNER JOIN ESTADO_SINIESTRO est on est.id = sin.id_Estado and est.estado_reg = 1
					 INNER JOIN POLIZA pol on pol.id = sin.id_poliza and pol.estado_reg = 1
						  WHERE sin.id_cliente = '".$idCliente."'
				            AND sin.estado_reg = 1
					   ORDER BY sin.id asc";

		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
	
	public function getSinesterClientId($idUsuario)
	{
		$sql = "SELECT DISTINCT sin.id as id_siniestro,
								sin.id_certificado,
								sin.fecha_reg as fecha_ingreso,
								est.desc_estado as estado_siniestro,
								pol.codigo_poliza as poliza,
								FORMAT(sin.monto, 2, 'de_DE') AS monto
						   FROM SINIESTRO sin
					 INNER JOIN ESTADO_SINIESTRO est on est.id = sin.id_Estado and est.estado_reg = 1
					 INNER JOIN CLIENTE cli on cli.id = sin.id_cliente and cli.estado_reg = 1
					 INNER JOIN USUARIO usu on usu.id = cli.id_usuario and usu.estado_reg = 1
					 INNER JOIN POLIZA pol on pol.id = sin.id_poliza and pol.estado_reg = 1
					 	WHERE usu.id = '".$idUsuario."'
				            AND sin.estado_reg = 1
					   ORDER BY sin.id asc";

		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
	
	
	public function getPolicyClientId($idUsuario)
	{
		$sql = "SELECT DISTINCT pol.id as id_poliza,
								pol.codigo_poliza as nombre_poliza
								FROM POLIZA pol
								INNER JOIN CLIENTE cli on pol.id_cliente = cli.id and cli.estado_reg = 1
								INNER JOIN USUARIO usu on usu.id = cli.id_usuario and usu.estado_reg = 1
						WHERE usu.id = '".$idUsuario."'
				            AND pol.estado_reg = 1
					   ORDER BY pol.id asc";

		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
	
	public function getSinesterDetail($idSiniestro, $idCertificado)
	{
		$sql = "SELECT DISTINCT sin.id as id_siniestro,
                                sin.id_certificado,
                                sin.fecha_reg as fecha_ingreso,
                                est.desc_estado as estado_siniestro,
                                sin.adjunto,
                                sin.extension
                           FROM SINIESTRO sin
                     INNER JOIN ESTADO_SINIESTRO est on est.id = sin.id_Estado and est.estado_reg = 1
                     INNER JOIN CERTIFICADO cer on cer.id = sin.id_certificado and cer.estado_reg = 1
                        WHERE sin.id = '".$idSiniestro."'
                            and cer.id = '".$idCertificado."'
                            AND sin.estado_reg = 1
                       ORDER BY sin.id asc";

		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}

}

?>