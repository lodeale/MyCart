<?php
class Myperfil extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->_isLogin();
		$this->load->model("inicio_model");
		$this->load->helper("email");
	}
	public function index(){
 		$data["titulo"] = "Mi perfil";
 		if($this->session->userdata("admin")):
 			$data["menu"] = array(
					"Inicio" => "carrito/inicio",
					"Administrador" => "carrito/admin/",
					"salir" => "carrito/myperfil/salir"
					);
		endif;
	 	$data["products"] = $this->inicio_model->getProduct();
	 	
	 	$this->load->view("carrito/include/header");
		$this->load->view("carrito/perfil_view",$data);
		$this->load->view("carrito/include/menu");
		$this->load->view("carrito/include/footer");
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
					'name'=>substr($row->name,0,10)
				);
				$this->cart->insert($data);
			endforeach;
			$this->updateProduct();
		endif;
		redirect("carrito/myperfil");
 	}
 	
 	function updateProduct(){
 		$prod = array();
 		foreach($this->input->post() as $items):
 			array_push($prod,array(
								'rowid' => $items['rowid'],
								'qty' => $items['qty']
						));
		endforeach;
		$this->cart->update($prod);
		redirect("carrito/myperfil");
 	}
 	
 	public function clearProduct(){
 		$this->cart->destroy();
 		redirect("carrito/myperfil");
 	}
 	
 	function marketProduct(){
 		$idP = $this->session->userdata("id");
 		$data["persona"] = $this->inicio_model->getFactura($idP);
 		
 		$this->load->view("carrito/include/header");
		$this->load->view("carrito/pedido_view",$data);
		$this->load->view("carrito/include/menu");
		$this->load->view("carrito/include/footer");
		
 	}
 	
 	public function detailProduct($idP){
 		$product = $this->inicio_model->getProduct($idP);
 		$data["product"] = $product;
 		$this->load->view("carrito/include/header");
		$this->load->view("carrito/detail_view",$data);
		$this->load->view("carrito/include/menu");
		$this->load->view("carrito/include/footer");
 	}
 	
 	public function confirma(){
 		if($this->inicio_model->insertPedido()):
 			$id = $this->session->userdata("id");
	 		$user = $this->inicio_model->getEmail($id);
	 		$mensaje= "Para el deposito la cuenta es:\n
	 				12987391827391823874\n
	 				y el telefono es: 2432334";
	 				
			send_email($user[0]->email, '[MyCart mi pedido]', $mensaje);
	 		echo "<script type='text/javascript'>";
	 		echo "alert(su pedido fue enviado)";
	 		echo "</script>";
 			redirect("carrito/myperfil/clearProduct");
 		else:
 			exit("No anda");
 		endif;
 	}
 	
 	public function salir(){
 		$this->session->sess_destroy();
 		redirect("carrito/inicio");
 	}
}
?>
