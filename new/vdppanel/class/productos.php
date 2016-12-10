<?
class productos extends productosABM{
	function productos(){
		$this->tpl = new tplClass();
	}
	
	function listadoProductos(){
		$db = $this->selproductos();
		while($row = mysql_fetch_array($db)){
			$data["productosList"] .= $this->tpl->printTemplate("productos_list_line",$row);
		}
		return $this->tpl->printTemplate("productos_list",$data);
	}
		
		function productForm($data){
		if($id = $data['id']){
			$filter = "WHERE idProducto = ".$id;
			$db = $this->selProductos($filter);
			$data = mysql_fetch_array($db);
			$data['action'] = "?page=41&id=".$id;
			$data['sub_btn'] = "Actualizar";
		}
		else{
			$data['action'] = "?page=41";
			$data['sub_btn'] = "Agregar";
		}			

		//clientes types options
		$db = $this->selProductType();		
		while($obj = mysql_fetch_object($db)){
			$row["value"] = $obj->idGrupo;
			$row["option"] = $obj->grupo;
			$row["selected"] = $select[$obj->idGrupo];
			$data["optionsProductType"] .= $this->tpl->printTemplate("option",$row);
		}
		return $this->tpl->printTemplate("producto_form",$data);
	}
	
	function listadoTiposGrupos(){
		$db = $this->selProductType();		
		while($row = mysql_fetch_array($db)){
			$data["optionsProductType"] .= $this->tpl->printTemplate("productos_type_list_line",$row);
		}
		return $this->tpl->printTemplate("productos_type_list",$data);
	}
	
	function formTiposGrupos($get){
		if($get["id"]){
			$filter = "where idGrupo = ".$get["id"];
			$db = $this->selProductType($filter);
			$data = mysql_fetch_array($db);	
			$data['sub_btn'] = "Actualizar";	
			$data['action'] = "?page=42&id=".$get["id"];	
		}
		else{
			$data['sub_btn'] = "Agregar";
			$data['action'] = "?page=42";
		}
		return $this->tpl->printTemplate("producto_form_grupo",$data);
	}

	function processFormProduct($post){		
		if($post["idProducto"])
			 $this->updateProduct($post);
		else
			 $this->insertProducto($post);
	}
	
	function processFormGrupo($post){		
		if($post["idGrupo"])
			$this->updateTipoGrupo($post);
		else
			$this->insertGrupo($post);
	}
	
}
?>