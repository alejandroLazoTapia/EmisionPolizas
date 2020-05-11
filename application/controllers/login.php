<?php

class login extends CI_Controller
{

	public function index()
	{
		$usuario = $this->input->post('username');
		$password = $this->input->post('pass');
		
		$this->load->model('usuario');
		$fila = $this->usuario->getUser($usuario);
		
		
		if($fila != null)
		{
			if($fila->pass == $password)
			{
				$data = array(
				'usuario' 	=> $usuario,
				'id' 	=> $fila->id_grupo,
				'nombre' 	  	=> $fila->nombre,
				'perfil' 	  	=> $fila->id_perfil,
				'login' 	=> TRUE
				);
				
				$this->session->set_userdata($data);
				$this->load->view('header');
				$this->load->view('menu');
				$this->load->view('home');
				$this->load->view('footer');
			}
			else {
				header("Location:". base_url());	
			}
		} else {
			header("Location:". base_url());
		}
	}
}

?>