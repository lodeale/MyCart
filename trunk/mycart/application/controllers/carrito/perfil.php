<?php
/*
 * @package Perfil
 * 
 * Se encarga de dar de alta usuarios,
 * de enviarlo para registarse y el 
 * grabado de sesión.
 */
 class Perfil extends CI_Controller{
 	
 	
 	public function __construct(){
 		parent::__construct();
 		
 		/*
 		 * Carga de librerías
 		 *  @param form_validation para la validación de formularios
 		 */
 		$this->load->library("form_validation");
 		
 		/*
 		 * @package Model
 		 * 
 		 * @param inicio_model 
 		 * 
 		 * Obtiene datos como email y producto.
 		 * Inserta usuario y verifica si el usuario
 		 * existe en la base de datos
 		 */
 		$this->load->model("inicio_model");
 	}
	
	
	/*
	 * Muestra formulario para registrar
	 * 
	 * Formulario para dar de alta a
	 * un usuario.
	 */
 	public function registrar(){	
 		$data["titulo"] = "Resgistrarse";
 		/*
 		 * Toma las provincia de la
 		 * tabla provincia.
 		 */
 		$data["provincia"] = $this->inicio_model->getData("provincia"); 		
 		$this->load->view("carrito/include/header");
		$this->load->view("carrito/registrar_view",$data);
		$this->load->view("carrito/include/menu");
		$this->load->view("carrito/include/footer");
 	}
 	
 	/*
 	 * Agregar Usuario
 	 * 
 	 *  Una vez pasado los datos del registro
 	 *  para dar de alta un usuario se verifica
 	 *  que los campos sean cargados correctamente
 	 *  sino devolvemos un error, de lo contrario 
 	 *  se graba los datos en la base de datos.
 	 */
 	public function addUser(){
 		/*
 		 * Trabajamos validando los campos enviados
 		 * 
 		 * @package form_validation
 		 * @param string   nombre del campo.
 		 * @param string   nombre con el que muestra si hay un error.
 		 * @param string   directivas a cumplir.
 		 */
 		 $this->form_validation->set_rules("usuario","Usuario",'trim|required');
 		 $this->form_validation->set_rules("clave","Clave",'required|min_length[6]|matches[reclave]');
 		 $this->form_validation->set_rules("email","Email",'required|valid_email');
 		 $this->form_validation->set_rules("n_p","Nombre y Apellido",'required');
 		 $this->form_validation->set_rules("dni","DNI",'required');
 		 $this->form_validation->set_rules("tel","Telefono",'required');
 		 $this->form_validation->set_rules("direccion","Dirección",'required');
 		 $this->form_validation->set_rules("provincia","Provincia",'required');
 		 /*
 		  * Corriendo validación
 		  * 
 		  * Hacemos correr la validación 
 		  * con la función run().
 		  * 
 		  * @return FALSE si al menos una
 		  * directiva no se cumple.
 		  */
 		 if($this->form_validation->run() == FALSE):
 		 /*
 		  * @var array titulo
 		  */
 		 	$data["titulo"] = "Resgistrarse";
 		 /*
 		  * @var array Provincias
 		  */
 			$data["provincia"] = $this->inicio_model->getData("provincia");
 		/*
 		 * Include las partes del view.
 		 */
 		 	$this->load->view("carrito/include/header");
			$this->load->view("carrito/registrar_view",$data);
			$this->load->view("carrito/include/menu");
			$this->load->view("carrito/include/footer");
 		 else:
 			/*
	 		* Registrar usuarios.
	 		* 
	 		* @param array Todo los datos de la matriz POST.
	 		* @return TRUE si se grabo bien en la base de datos.
 			*/
 			$res = $this->inicio_model->registrar($this->input->post());
 			if($res):
 				
	 			redirect("carrito/inicio");
 			endif;
 		endif;	
 	}
 	
 	/*
 	 * @package Index
 	 * 
 	 * Encargado de crear la sesión 
 	 * al usuario especificado.
 	 */
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
 				$permiso = ($row->privilegios == 1)?TRUE:FALSE;
 				$data_session = array(
 							"loginTrue"=>TRUE,
 							"admin"=>$permiso,
 							"id"=>$row->id_user,
 							"user"=>$row->usuario 
 						);
 			}
 			$this->session->set_userdata($data_session);
 			redirect("carrito/myperfil");
 		else:
 			redirect("carrito/inicio");
 		endif;
 	}
 }
?>