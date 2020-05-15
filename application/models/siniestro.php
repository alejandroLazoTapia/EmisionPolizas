<?php

class Siniestro extends CI_Model
{
	
	public function existSinister($id_certificado)
	{
		$sql = "SELECT id FROM siniestro
				WHERE id_certificado = '".$id_certificado."' 
				and estado_reg = 1";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
 
	function insertSinister($data)
	{
		$this->db->insert("SINIESTRO",$data);

		if ($this->db->affected_rows() > 0) {
			$ultimoId = $this->db->insert_id();
			return $ultimoId;
		} else {
			return 0;
		}
	}

	function getSinesterClient($idCliente)
	{
		$sql = "SELECT DISTINCT sin.id as id_siniestro,
								sin.id_certificado,
								sin.fecha_reg as fecha_ingreso,
								est.desc_estado as estado
						   FROM SINIESTRO sin
					 INNER JOIN ESTADO_SINIESTRO est on est.id = sin.id_Estado and est.estado_reg = 1
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

}

?>