<?php
/*
 * Pagína de perfil del carrito
 */
 
 class Perfil extends CI_Controller{
 	public function __construct(){
 		parent::__construct();
 		$this->load->library("form_validation");
 		$this->load->model("inicio_model");
 	}

 	public function registrar(){	
 		$data["titulo"] = "Resgistrarse";
 		$data["provincia"] = $this->inicio_model->getData("provincia");
 		$this->load->view("carrito/registrar_view",$data);
 	}
 	
 	public function addUser(){
 		/*
 		 * Trabajamos validando los capos enviados
 		 */
 		 $this->form_validation->set_rules("usuario","Usuario",'required');
 		 $this->form_validation->set_rules("clave","Clave",'required|min_length[6]|matches[reclave]');
 		 $this->form_validation->set_rules("email","Email",'required|valid_email');
 		 $this->form_validation->set_rules("n_p","Nombre y Apellido",'required');
 		 $this->form_validation->set_rules("dni","DNI",'required');
 		 $this->form_validation->set_rules("tel","Telefono",'required');
 		 $this->form_validation->set_rules("direccion","Dirección",'required');
 		 $this->form_validation->set_rules("provincia","Provincia",'required');
 		 /*
 		  * Hago correr la validación
 		  */
 		 if($this->form_validation->run() == FALSE):
 		 	$data["titulo"] = "Resgistrarse";
 			$data["provincia"] = $this->inicio_model->getData("provincia");
 		 	$this->load->view("carrito/registrar_view",$data);
 		 else:
 			/*
	 		* fin de la validación
 			*/
 			$res = $this->inicio_model->registrar($this->input->post());
 			if($res):
	 			redirect("carrito/inicio");
 			endif;
 		endif;	
 	}
 	
 	public function index(){
 		$user = $this->input->post("usuario");
 		$pass = $this->input->post("clave");
 		
 		if(!isset($user) && !isset($pass)):
 			redirect("carrito/inicio");
 		endif;
 		
	 	/*
	 	 * Si no existe la sesion
	 	 */
 		$query = $this->inicio_model->validarLogin($user,$pass);
 		if($query):
 			foreach($query as $row){
 				$data_session = array(
 							"loginTrue"=>TRUE,
 							"id"=>$row->id_user,
 							"user"=>$row->usuario 
 						);
 			}
 			$this->session->set_userdata($data_session);
 			redirect("carrito/myperfil");
 		else:
 			exit("aaaaaa");
 			redirect("carrito/inicio");
 		endif;
 	}
 }
?>

