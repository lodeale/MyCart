<?php
/*
 * Pagína de inicio del carrito
 */
 
 class Inicio extends CI_Controller{
 	public function __construct(){
 		parent::__construct();
 		$this->_isLogin();
 		$this->load->model("inicio_model");
 	}
	
	function _isLogin(){
 		$test = $this->session->userdata('loginTrue');
 		if($test):
 			redirect("carrito/myperfil");
 		endif;
 	}
 	
	public function index(){
		/*
		 * Cargamos los productos de
		 * la base de datos
		 */
 		$data["products"] = $this->inicio_model->getProduct();
 		
 		/*
 		 * Incluimos las partes para conformar 
 		 * la vista de inicio.
 		 */
 		$this->load->view("carrito/include/header");
		$this->load->view("carrito/inicio_view",$data);
		$this->load->view("carrito/include/menu");
		$this->load->view("carrito/include/footer");
	}
 	 	
 }
?>
