<?php
class Admin extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->_isLogin();
		$this->load->library("form_validation");
		$this->load->model("admin_model");
	}
	
	function _isLogin(){
 		$test = $this->session->userdata('loginTrue');
 		$adm = $this->session->userdata('admin');
 		if($test != TRUE || $adm != TRUE):
 			redirect("carrito/inicio");
 		endif;
 	}
 	
	function index(){
		$data["menu"] = array(
				"Inicio" => "carrito/inicio",
				"Pedidos" => "carrito/admin/listarPedidos",
				"Cargar" => "carrito/admin/",
				"salir" => "carrito/myperfil/salir"
				);
		$this->load->view("carrito/include/header");
		$this->load->view("carrito/include/menu",$data);
		$this->load->view("carrito/cargar_view");
		$this->load->view("carrito/include/footer");
	}
	
	function listarPedidos(){
		$data["menu"] = array(
				"Inicio" => "carrito/inicio",
				"Pedidos" => "carrito/admin/listarPedidos",
				"Cargar" => "carrito/admin/",
				"salir" => "carrito/myperfil/salir"
				);
		$lista = $this->admin_model->listarPedidos();
		if($lista):
			$data["lista"] = $lista;
		else:
			$data["lista"] ="no existen pedidos";
		endif;	
		$this->load->view("carrito/include/header");
		$this->load->view("carrito/include/menu",$data);
		$this->load->view("carrito/listPedido_view",$data);
		$this->load->view("carrito/include/footer");
	}
	
	function cargar(){
		if($this->input->post("cargar")):
			$this->insertProduct();
		else:
			$this->do_upload();
		endif;
	}
	
	function insertProduct(){
		$nombre = $this->input->post("nombre");
 		$precio = $this->input->post("precio");
 		$imagen = $this->input->post("file_img");
 		
 		$nuevo = $this->admin_model->insertProduct($nombre,$precio,$imagen);
 		if($nuevo):
			echo "Se cargo con exito!";
			echo "<a href='carrito/admin'>Volver</a>";
 		else:
 			redirect("carrito/admin");	
 		endif;
	}
	
	function do_upload(){
		$config['upload_path'] = '/var/www/CodeIgniter/mycart/web/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '1000';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload()){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view("carrito/include/header");
			$this->load->view("carrito/include/menu");
			$this->load->view('carrito/cargar_view', $error);
			$this->load->view("carrito/include/footer");
		}else{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view("carrito/include/header");
			$this->load->view("carrito/include/menu");
			$this->load->view('carrito/cargar_view', $data);
			$this->load->view("carrito/include/footer");
		}
	}
	
	function estado($opc,$idP){
		if($opc > 0 && $opc < 3):
			$this->admin_model->changeStatus($opc+1,$idP);
		endif;
		redirect("carrito/admin/listarPedidos");
	}
	
	function borrarPedido($idP){
		$query = $this->admin_model->deleteOrder($idP);
		if($query):
			redirect("carrito/admin/listarPedidos");
		endif;
		redirect("carrito/admin/listarPedidos");
	}
	
}
?>
