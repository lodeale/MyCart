<?php
class Admin_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	
	function insertProduct($nom,$pre,$img){
		/*
		 * Ingreso nuevo producto
		 */
		 
		$this->db->set("name",$nom);	
		$this->db->set("price",$pre);
		$this->db->set("image",$img);
		
		$query = $this->db->insert("products");
		
	   if($query):
	   		return TRUE;
       else:
       		return FALSE;
       endif;
       
    }
    
    
    function listarPedidos(){
    	//SELECT p.fecha, p.estado, p.id_persona, d.id_pedido, d.cant, d.precio FROM pedido p, detalle_pedido d where p.id_pedido = d.id_pedido
    	$this->db->select("p.fecha, p.estado, p.id_persona, d.id_pedido, d.cant, d.precio, e.nombre_apellido");
    	$this->db->from("pedido p, detalle_pedido d, persona e");
    	$this->db->where("p.id_pedido = d.id_pedido");
    	$this->db->where("p.id_persona = e.id_persona");
    	$query = $this->db->get();
    	if($query->num_rows > 0):
    		return $query->result();
    	else:
    		return FALSE;
    	endif;
    }
    
    function changeStatus($opc,$idP){
    	$data = array(
    		"estado"=>$opc
    	);
    	$query = $this->db->update("pedido",$data,"id_pedido = ".$idP);
    	if($query):
    		return TRUE;
    	else:
    		return FALSE;
    	endif;
    }
    
    function deleteOrder($idP){
    	$query = $this->db->delete("pedido",array("id_pedido"=>$idP));
    	if($query):
    		return TRUE;
    	endif;
    	return FALSE;
    }
}