<?php

class Usuario extends CI_Model
{
	public function getUser($usuario = '')
	{
		$sql = "select * FROM USUARIO WHERE nombre_usuario = '".$usuario."' LIMIT 1";
		$result = $this->db->query($sql);
		if($result->num_rows() > 0)
		{
			return $result->row();
		}
		else
		{
			return null;		
		}
		
	}
	
	public function getUsers()
	{
		$sql = "select usu.id as id_usuario,
					   usu.nombre_usuario,
                       usu.nombre as nombre,
                       per.id as id_perfil,
					   per.desc_perfil as tipo_perfil,
                       usu.id_pais as id_pais,
					   usu.id_grupo as id_cliente
				  FROM USUARIO usu
			      inner join PERFIL per on per.id = usu.id_perfil
				  WHERE usu.estado_reg = 1
                  and per.estado_reg = 1
				  order by usu.nombre_usuario asc";
				  
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
	
	public function getProfiles()
	{
		$sql = "select distinct
                       id as id_perfil,
					   desc_perfil as tipo_perfil
				  FROM PERFIL
				  WHERE estado_reg = 1
				  order by id asc";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return null;
		}
	}
	
	public function deleteUser($idUsuario, $data)
	{
		$this->db->where("id",$idUsuario);
		$this->db->update("USUARIO",$data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function existUser($nombre_usuario)
	{
		$sql = "select id
				  FROM USUARIO
				  WHERE upper(nombre_usuario) = upper('".$nombre_usuario."') 
                  	AND	estado_reg = 1";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function insertUser($data)
	{
		$this->db->insert("USUARIO",$data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function updateUser($idUsuario, $data)
	{
		$this->db->where("id",$idUsuario);
		$this->db->update("USUARIO",$data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
}

?>