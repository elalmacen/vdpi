<?php
class clientes extends clientesABM{
	function clientes(){
		$this->tpl = new tplClass();
	}
	
	function listadoClientes(){
		$db = $this->selClientes();
		while($row = mysql_fetch_array($db)){
			$data["clientesList"] .= $this->tpl->printTemplate("clientes_list_line",$row);
		}
		return $this->tpl->printTemplate("clientes_list",$data);
	}
	
	function clientesProcess($data){
		if($id = $data['id']){
			$filter = "WHERE idCliente = ".$id;
			$db = $this->selClientes($filter);
			$data = mysql_fetch_array($db);
			$data['action'] = "?page=31&id=".$id;
			$select[$data["idClientType"]] = 'selected="selected"';
			$data['sub_btn'] = "Actualizar";
		}
		else{
			$data['action'] = "?page=31";
			$data['sub_btn'] = "Agregar";
		}
					
		//clientes types options
		$db = $this->selClientesType();		
		while($obj = mysql_fetch_object($db)){
			$row["value"] = $obj->idClientType;
			$row["option"] = $obj->clientTypeName;
			$row["selected"] = $select[$obj->idClientType];
			$data["optionsClientType"] .= $this->tpl->printTemplate("option",$row);
		}
		return $this->tpl->printTemplate("clientes_form",$data);
	}
	
	function processForm($post){		
		if($post["idCliente"])
			$this->update($post);
		else
			$this->insert($post);
	}
	
	function formTiposClientes($get){
		if($get["id"]){
			$filter = "where idClientType = ".$get["id"];
			$db = $this->selClientesType($filter);
			$data = mysql_fetch_array($db);	
			$data['sub_btn'] = "Actualizar";	
			$data['action'] = "?page=32&id=".$get["id"];	
		}
		else{
			$data['sub_btn'] = "Agregar";
			$data['action'] = "?page=32";
		}
		return $this->tpl->printTemplate("clientType_form",$data);
	}

	function listadoTiposClientes(){
		$db = $this->selClientesType();		
		while($row = mysql_fetch_array($db)){
			$data["clientesTypeList"] .= $this->tpl->printTemplate("clientes_type_list_line",$row);
		}
		return $this->tpl->printTemplate("clientes_type_list",$data);
	}
	
	function processFormTipo($post){		
		if($post["idClientType"])
			$this->updateTipo($post);
		else
			$this->insertTipo($post);
	}

}
?>