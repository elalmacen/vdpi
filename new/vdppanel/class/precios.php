<?
class precios extends preciosABM{
	function precios(){
		$this->tpl = new tplClass();
	}

	function listadoPrecios(){
		$db = $this->selPrecios();
		while($row = mysql_fetch_array($db)){
			$row["fecha"]=date("d/m/Y",$row["fecha"]); 
			$data["preciosList"] .= $this->tpl->printTemplate("precios_list_line",$row);
		}
		return $this->tpl->printTemplate("precios_list",$data);
	}
		
	function preciosForm($data){
		if($id = $data['id']){
			$filter = "WHERE idPrecio = ".$id;
			$db = $this->selPrecios($filter);
			$data = mysql_fetch_array($db);
			$data['action'] = "?page=51&id=".$id;
			$data['sub_btn'] = "Actualizar";
		}
		else{
			$data['action'] = "?page=51";
			$data['sub_btn'] = "Agregar";
			$dataFecha["date"] = date("m/d/Y");
		}			

		//producto types options
		$db = $this->selproductosPrecios();		
		while($obj = mysql_fetch_object($db)){
			$row["value"] = $obj->idProducto;
			$row["option"] = $obj->producto;
			$row["selected"] = $select[$obj->idProducto];
			$data["optionsGrupoPrecioType"] .= $this->tpl->printTemplate("option",$row);
		}
		//client types options
		$db = $this->selClientTypePrecios();		
		while($obj = mysql_fetch_object($db)){
			$row["value"] = $obj->idClientType;
			$row["option"] = $obj->clientTypeName;
			$row["selected"] = $select[$obj->idClientType];
			$data["optionsclientTypePrecio"] .= $this->tpl->printTemplate("option",$row);
		}
		return $this->tpl->printTemplate("precios_form",$data);
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

	function processFormPrecios($post){		
		if($post["idPrecio"])
		$this->updatePrecioByCliente($post);
		else
		$this->insertPrecios($post);
	}

}
?>