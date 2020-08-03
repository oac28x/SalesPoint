<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PostModel extends CI_Model {
	
	//Delete ventes data and reset AutoIncrement
	//delete from ventas;    
	//delete from sqlite_sequence where name='ventas';

	function ChecaUsr($usuario){
		$this->db->select("*");
		$this->db->from("usuarios");
		$this->db->where("usuario", $usuario);
		$query = $this->db->get();
		return $query->row();
	}

	function cehcaUsrsVentas(){
		$this->db->select("*");
		$this->db->from("usuarios");
		$this->db->where("permiso", 0);
		$query = $this->db->get();
		return $query->result_array();
	}

	function sugerencia($like, $a){
		$this->db->select("clave,nombre,precio,presentacion");
		$this->db->from('articulos');

		switch ($a) {
			case 1:
				$this->db->where("clave like '$like%'");
				break;
			
			case 2:
				$this->db->where("nombre like '$like%'");
				break;

			case 3:
				$this->db->where("sustancia like '$like%'");
				break;
		}	
		$this->db->limit(20);	
		$query = $this->db->get();		
		return $query->result_array();
	}

	function sugerenciaUsr($nombre){
		$this->db->select("*");
		$this->db->from("usuarios");
		$this->db->where("NCompleto like '%$nombre%'");
		$this->db->limit(10);	
		$query = $this->db->get();		
		return $query->result_array();
	}

	function buscaUsr($usr, $nombre){
		$this->db->select("*");
		$this->db->from("usuarios");
		$this->db->where("usuario", $usr);
		$this->db->where("NCompleto", $nombre);
		$query = $this->db->get();
		return $query->row();
	}

	function buscaId($id){
		$this->db->select("clave,nombre,precio,cantidad");
		$this->db->from("articulos");
		$this->db->where("clave", $id);
		$query = $this->db->get();
		return $query->row();
	}

	function insertCompra($id, $nombre, $cont, $p_un, $p_tot, $fecha, $quien, $pago, $cambio){
		$dato=array(
			'id_articulo'=>$id,
			'nombre'=>$nombre,
			'cuantos'=>$cont,
			'precio_un'=>$p_un,
			'precio_tot'=>$p_tot,
			'fecha'=>$fecha,
			'quien'=>$quien,
			'cuanto_paga'=>$pago,
			'cambio'=>$cambio
		);
		$this->db->insert('ventas',$dato);

		$this->db->query('update articulos set cantidad = cantidad - '.$cont.' where clave = '.$id.';');
	}

	function checkFolio(){
		$this->db->select("max(folio) as folio");
		$this->db->from('ventas');
		$query = $this->db->get();
		return $query->row();
	}

	function selectVentas($IFecha, $FFecha, $usr){
		$this->db->select("*");
		$this->db->from("ventas");
		$this->db->where("fecha >=", strtotime($IFecha.' 07:00:01'));
		$this->db->where("fecha <=", strtotime($FFecha.' 07:00:01'));

		if($usr != "Todos"){
			$this->db->where("quien", $usr);
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	function selectArtLow($cant){
		$this->db->select("clave,cantidad,nombre,precio");
		$this->db->from("articulos");
		$this->db->where("cantidad <=",$cant);
		$query = $this->db->get();
		return $query->result_array();
	}

	function buscaArt($id){
		$this->db->select("*");
		$this->db->from('articulos');
		$this->db->where("clave",$id);
		$query = $this->db->get();
		return $query->row();
	}
 
 	function eliminaArt($id){
 		$this->db->where('clave', $id);
		$this->db->delete('articulos');
		return "ok";
 	}

 	function actualizaArt($idr, $nombre, $clave, $sustancia, $present, $cantidad, $precio){
 		$data = array(
 			'clave'=>$clave,
 			'nombre'=>$nombre,
 			'sustancia'=>$sustancia,
 			'presentacion'=>$present,
 			'cantidad'=>$cantidad,
 			'precio'=>$precio
 		);

 		$this->db->where("clave",$idr);
 		$this->db->update('articulos', $data);
 		return "ok";
 	}

 	function insertNewArt($clave, $nombre, $sustancia, $present, $cantidad, $precio){
 		$data = array(
 			'clave'=>$clave,
 			'nombre'=>$nombre,
 			'sustancia'=>$sustancia,
 			'presentacion'=>$present,
 			'cantidad'=>$cantidad,
 			'precio'=>$precio
 		);
		$this->db->insert('articulos',$data);
 	}

 	function insertNewUsr($nombre, $usr, $clave, $permiso){

 		switch ($permiso) {
 			case 'Administrador':
 				$permiso = 1;
 				break;

 			case 'Vendedor':
 				$permiso = 0;
 				break;
 		}

 		$data = array(
 			'permiso'=>$permiso,
 			'usuario'=>$usr,
 			'contra'=>$clave,
 			'NCompleto'=>$nombre
 		);
		$this->db->insert('usuarios',$data);
 	}

 	function actualizaUsr($idUsr, $nombre, $usr, $usrContra, $permiso){
 		switch ($permiso) {
 			case 'Administrador':
 				$permiso = 1;
 				break;

 			case 'Vendedor':
 				$permiso = 0;
 				break;
 		}

 		$data = array(
 			'permiso'=>$permiso,
 			'usuario'=>$usr,
 			'contra'=>$usrContra,
 			'NCompleto'=>$nombre
 		);

 		$this->db->where("NCompleto",$idUsr);
 		$this->db->update('usuarios', $data);
 		return "ok";
 	}

 	function eliminaUsr($idUsr, $usr){
 		$this->db->where('usuario', $usr);
 		$this->db->where('NCompleto', $idUsr);
		$this->db->delete('usuarios');
		return "ok";
 	}
}