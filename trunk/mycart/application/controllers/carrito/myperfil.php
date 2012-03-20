<?php
class Myperfil extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->_isLogin();
		$this->load->model("inicio_model");
	}
	public function index(){
 		$data["titulo"] = "*Mi perfil";
	 	$data["products"] = $this->inicio_model->getProduct();
	 	$this->load->view("carrito/perfil_view",$data);
 	}
 	
 	function _isLogin(){
 		$test = $this->session->userdata('loginTrue');
 		if($test != TRUE):
 			redirect("carrito/inicio");
 		endif;
 	}
 	
 	function addProduct($id){
 		$product = $this->inicio_model->getProduct($id);
 		if(count($product) > 0):
	 		foreach($product as $row):
		 		$data = array(
					'id'=>$row->id,
					'qty'=>1,
					'price'=>$row->price,
					'name'=>$row->name
				);
				$this->cart->insert($data);
			endforeach;
			$this->updateProduct();
		endif;
		redirect("carrito/myperfil");
 	}
 	
 	function updateProduct(){
 		$data = array();
 		$i = 1;
 		print_r($this->input->post());
 		echo "<br>";
 		print_r($this->cart->contents());
 		
 		foreach($this->cart->contents() as $k=>$items):
 			$prod = array(
				'rowid' => $items['rowid'],
				'qty' => $this->input->post('[qty]')
			);
			++$i;
			array_push($data,$prod);
		endforeach;
		$this->cart->update($data);
		redirect("carrito/myperfil");
 	}
 	
 	public function clearProduct(){
 		$this->cart->destroy();
 		redirect("carrito/myperfil");
 	}
 	
 	function marketProduct(){
		$this->load->view("carrito/pedido");
 	}
 	
 	public function salir(){
 		$this->session->sess_destroy();
 		redirect("carrito/inicio");
 	}
}
?>
