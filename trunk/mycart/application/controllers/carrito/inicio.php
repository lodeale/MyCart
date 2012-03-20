<?php
/*
 * Pagína de inicio del carrito
 */
 
 class Inicio extends CI_Controller{
 	public function __construct(){
 		parent::__construct();
 		$this->load->model("inicio_model");
 	}
 	
 	public function index(){
 		$data["products"] = $this->inicio_model->getProduct();
 		$this->load->view("carrito/inicio_view",$data);
 	}
 	
 	public function registrar($valid = null){
 		$data["titulo"] = "Resgistrarse";
 		if($valid):
 			$res = $this->inicio_model->registrar($this->input->post());
 			if($res):
 				redirect("carrito/inicio");
 			endif;	
 		else:
 			$this->load->view("carrito/registrar_view",$data);
 		endif;
 		
 	}
 }
?>
