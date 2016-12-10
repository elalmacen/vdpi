<?
class editarPrecios extends editarPreciosABM{
	function editarPrecios(){
		$this->tpl = new tplClass();
	}
	function clientesProcess($data){
		if($id = $data['id']){	
			//no llega nada
			}
		else{
			$data['action'] = "?page=6";
			$data['sub_btn'] = "Editar";
		}
					
		//productos types options
		$db = $this->selProducto();		
		while($obj = mysql_fetch_object($db)){
			$row["value"] = $obj->idProducto;
			$row["option"] = $obj->producto;
			$row["selected"] = $select[$obj->idProducto];
			$data["optionsProductos"] .= $this->tpl->printTemplate("option",$row);
		}
		
		return $this->tpl->printTemplate("editarPrecios_form",$data);
	}
	
	function processForm($post){		
		if($post["idPrecio"]){
			$this->updatePrecioByCliente($post);
		}	
	}
	
	function cargarSelectTiposClientes($idProducto){
		$db = $this->selectClientTypeByProduct($idProducto);
		$js = new js();
		$jsCode = $js->openJS();
		$jsCode .= $js->changeDisable("idClientType","false");
		while($obj = mysql_fetch_object($db))
			$jsCode .= $js->addItemSelect($obj->clientTypeName,$obj->idClientType,"idClientType");
		$jsCode .= $js->closeJS();
		return $jsCode;
	}
	
	function cargarPrecioClientes($idClientType,$idProducto){
		$db = $this->selectPrecioByCliente($idClientType,$idProducto);
		$js = new js();
		$jsCode = $js->openJS();
		$jsCode .= $js->changeDisable("idPrecio","false");
		$obj = mysql_fetch_object($db);
		$jsCode .= $js->fillTextArea("idPrecio",$obj->precio);
		$jsCode .= $js->closeJS();
		return $jsCode;
	}

}
?>