<?php 

class Cliente extends CI_Model
{
	public function getAllClient($idUsuario, $idPerfil)
	{

		$sql = "select distinct
						cli.id as id_cliente,
						cli.nombre as nombre_cliente,
						cli.direccion as direccion_cliente,
						cli.condiciones,
						usu.id as id_usuario,
						usu.nombre_usuario as nombre_usuario,
						cli.rut_dni,
						cli.telefono

					FROM CLIENTE cli
						 INNER JOIN USUARIO usu on usu.id = cli.id_usuario
					WHERE cli.estado_reg = 1
					  and usu.estado_reg = 1
				      and usu.id = case when '".$idPerfil."' = 1 then  usu.id
									else '".$idUsuario."'
				                    end
					order by cli.nombre asc";

		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
	
	public function insertClient($data)
	{
		$this->db->insert("CLIENTE",$data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function updateClient($idCliente, $data)
	{
		$this->db->where("id",$idCliente);
		$this->db->update("CLIENTE",$data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function deleteClient($idCliente, $data)
	{
		$this->db->where("id",$idCliente);
		$this->db->update("CLIENTE",$data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	
	
	public function existClient($rut_dni)
	{
		$sql = "select id
				  FROM CLIENTE
				  WHERE rut_dni = '".$rut_dni."'
                  	AND	estado_reg = 1";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function newId()
	{
		$sql = "select (nvl(max(id),0)+1) as idNew
				FROM CLIENTE";
		$result = $this->db->query($sql);
		return $result->row();
	}
	
	public function getPolicyClient($idCliente)
	{
		$sql = "SELECT id as id_poliza, 
					   codigo_poliza, 
					   desc_poliza 
				  FROM POLIZA 
				 WHERE id_cliente = '".$idCliente."' 
				   AND estado_reg = 1";
		$result = $this->db->query($sql);
		
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
	
	public function existPolicy($codigo_poliza)
	{
		$sql = "select id
				   FROM POLIZA
				  WHERE upper(codigo_poliza) = upper('".$codigo_poliza."' )
					AND	estado_reg = 1;";
					
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function insertPolicy($data)
	{
		$this->db->insert("POLIZA",$data);
		
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function deletePolicy($idPoliza, $data)
	{
		$this->db->where("id",$idPoliza);
		$this->db->update("POLIZA",$data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function getAFavorClient($idCliente)
	{
		$sql = "SELECT id as id_a_favor,
				       nombre as nombre_a_favor
				FROM   EMPRESA_A_FAVOR
				WHERE  id_cliente  = '".$idCliente."'
				AND    estado_reg = 1
				order  by nombre asc";
				
		$result = $this->db->query($sql);

		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
	
	public function existAFavor($rut)
	{
		$sql = "select id
				  FROM EMPRESA_A_FAVOR
				  WHERE rut = '".$rut."'
                  	AND	estado_reg = 1";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function insertAFavor($data)
	{
		$this->db->insert("EMPRESA_A_FAVOR",$data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function deleteAFavor($idAFavor, $data)
	{
		$this->db->where("id",$idAFavor);
		$this->db->update("EMPRESA_A_FAVOR",$data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}

?>