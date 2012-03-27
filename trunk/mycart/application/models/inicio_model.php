<?php
class Inicio_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	
	public function getProduct($id=null){
		if(empty($id)):
			$prod = $this->db->get("products");
			return $prod->result();
		else:
			$this->db->where("id",$id);
			$query = $this->db->get("products");
			if($query):
				return $query->result();
			endif;
			return FALSE;
		endif;
	}
	
	public function validarLogin($user,$pass){
		$this->db->select("id_user,usuario,privilegios");
		$this->db->from("user");
		$this->db->where("usuario = '".$user."'");
		$this->db->where("clave = '".sha1($pass)."'");
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0):
			return $query->result();
		else:
			return FALSE;
		endif;
	}
	
	public function registrar($reg){
		/*
		 * Ingreso persona primero
		 */
		$this->db->set("nombre_apellido",$reg["n_p"]);
		$this->db->set("dni",$reg["dni"]);
		$this->db->set("tel",$reg["tel"]);
		$this->db->set("direccion",$reg["direccion"]);
		$this->db->set("provincia",$reg["provincia"]);
		$query = $this->db->insert("persona");
		$idPersona = $this->db->insert_id();
		if(!$idPersona):
			return false;
		endif;
		/*
		 * Ingreso usuario si persona se ingreso
		 */
		$this->db->set("id_persona",$idPersona);
		$this->db->set("usuario",$reg["usuario"]);
		$this->db->set("clave",sha1($reg["clave"]));
		$this->db->set("email",$reg["email"]);
		$ins = $this->db->insert("user");
		if($ins):
			return TRUE;
		else:
			return FALSE;
		endif;
	}
	
	public function getData($tabla){
		$query = $this->db->get($tabla);
		if($query):
			return $query->result();
		else:
			return false;
		endif;
	}
	
	public function getEmail($id){
		$this->db->select("email");
		$this->db->from("user");
		$this->db->where("id_user = ".$id);
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0):
			return $query->result(); 
		endif;
		return FALSE;
	}
	
	public function insertPedido(){
		/*
		 * Obtenemos el id user y sacamos la persona
		 */
		$this->db->select("id_persona");
		$this->db->from("user");
		$this->db->where("id_user",$this->session->userdata("id"));
		$query = $this->db->get();
		if($query->num_rows() == 0):
			return FALSE;
		else:
			$persona = $query->result_array();
		endif;
		/*
		 * insertamos el pedido
		 */
		 
		$fecha = date("Y/m/d",time());
		$hora = date("h:i:s",time());
		$this->db->set("id_persona",$persona[0]["id_persona"]);
		$this->db->set("fecha",$fecha);
		$this->db->set("hora",$hora);
		$this->db->set("estado",1);
		$query = $this->db->insert("pedido");
		
		if($this->db->affected_rows() == 0):
			exit("no anda 1");
			return FALSE;
		endif;
		$idPedido = $this->db->insert_id();
		foreach($this->cart->contents() as $row):
				$this->db->set("id_pedido",$idPedido);
 				$this->db->set("id_prod",$row["id"]);
 				$this->db->set("cant",$row["qty"]);
 				$this->db->set("precio",$row["price"]);
 				$query = $this->db->insert("detalle_pedido");
 				if($this->db->affected_rows() > 0):
 					continue;
 				else:
 					break;
 				endif;
 		endforeach;
 		return TRUE;
	}
	
	function getFactura($idP){
		$this->db->select("u.email, p.nombre_apellido, r.provincia");
		$this->db->from("persona p, provincia r, user u");
		$this->db->where("p.provincia = r.id_provincia");
		$this->db->where("p.id_persona = u.id_persona");
		$this->db->where("u.id_user = ".$idP);
		$query = $this->db->get();
		if($query):
			return $query->result();
		endif;
		return FALSE;
	}
}
?>
