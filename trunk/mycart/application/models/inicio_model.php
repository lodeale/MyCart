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
		$this->db->select("id_user,usuario");
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
}
?>
