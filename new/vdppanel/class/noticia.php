<?php
class noticia extends noticiaABM{
	function noticia(){
		$this->tpl = new tplClass();
	}
	
	function createnoticia(){
		$data["sub_btn"] = "Agregar";
		$data['action'] = "?page=12";
		//SELECCIONO TEMA
		$tema = $this->selectTema();		
		while($obj = mysql_fetch_object($tema)){
			$row["value"] = $obj->idTema;
			$row["option"] = $obj->tema;
			$row["selected"] = $select[$obj->idTema];
			$data["optionsTema"] .= $this->tpl->printTemplate("option",$row);
		}
		//FECHA
		//$dataFecha["date"] = date("MM/DD/YYYY",$data["fecha"]);
		$dataFecha["name"] = "Date";
		$data["calendario"] = $this->tpl->printTemplate("fecha",$dataFecha);
		$data["checked"] =  "checked='checked'";
		$data["wysiwyg"] .= $this->tpl->printTemplate("wysiwyg",$row);
		return $this->tpl->printTemplate("noticia_form",$data);
	}

	function noticiasProcesForm($post){
		//proceso fecha
		$arrDate = explode("/",$post["Date"]);
		$post["fecha"] = mktime(0,0,0,$arrDate[0],$arrDate[1],$arrDate[2]);
		$noticiaInsert = $this->insertNoticia($post);	
	}
//
	/*function deleteRemito($data){
		if($data['delete']=="ok"){
			$this->borrarRemitos($data['id']);
		}				
	}
	
	function remitosProductoslist($get){
		$idRemito=$get['id'];
		// cargo datos de remito, nombre, tipo, etc $row
		$db = $this->remitosSelProd($idRemito);
		$row = mysql_fetch_array($db);
		$row['fecha'] = date("d/m/Y",$row['fecha']);		
		switch($row['tipo']){
			case 1:$row['tipo']="A";
			break;
			case 2:$row['tipo']="B";
			break;
		}
		//cargo lista de productos $row2
		$db2 = $this->remitosViewProduct($idRemito);	
		while ($row2 = mysql_fetch_array($db2)){	
			$row['productos'] .= $this->tpl->printTemplate("remitos_product",$row2);
		}
		return $this->tpl->printTemplate("remitos_product_view",$row);	
	}
	
	function remitosForm($data){
		if($id = $data['id']){
		   $filter = "WHERE idRemito = ".$id;
		   $db = $this->selRemitos($filter);
		   $data = mysql_fetch_array($db);
		   $data['action'] = "?page=12&id=".$id;
		   $data['idRem'] = $id;
		   $select[$data["idCliente"]] = 'selected="selected"';
		   $select[$data["idZona"]] = 'selected="selected"';
		   $data['sub_btn'] = "";
		   $data['name'] = "departureTo_qj"; 
		   $data['selected'] = "selected='selected'";
		   $dataFecha["date"] = date("m/d/Y",$data["fecha"]);
		}
		else{
		   $data['action'] = "?page=12";
		   $data['sub_btn'] = "Nuevo";
		   $dataFecha["date"] = date("m/d/Y");
		}			

		//remitos clientes options
		$db = $this->selClientes();		
		while($obj = mysql_fetch_object($db)){
			$row["value"] = $obj->idCliente;
			$row["option"] = $obj->cliente;
			$select[$row["idCliente"]] = 'selected="selected"';
			$row["selected"] = $select[$obj->idCliente];
			$data["optionsProductType"] .= $this->tpl->printTemplate("option",$row);
		}
		
		//remitos zonas options
		$db = $this->selZonas();		
		while($obj = mysql_fetch_object($db)){
			$row["value"] = $obj->idZona;
			$row["option"] = $obj->zona;
			$row["selected"] = $select[$obj->idZona];
			$data["optionsProductTypeZona"] .= $this->tpl->printTemplate("option",$row);
		}
		
		//Ordeno Grupo y productos
		$db = $this->selectProductPorGrupo();	
		$grupoAnt = 0;	
		$n = 0;
		while($obj = mysql_fetch_object($db)){
			if($obj->idGrupo != $grupoAnt){
				$dataTit["grupo"] = $obj->grupo;
				$data["test"] .= $this->tpl->printTemplate("titulo_remitos",$dataTit);
				$grupoAnt = $obj->idGrupo;
			}			
									
		//	$row["grupos"] = $obj->grupo;
			$row["n"]=$n++;
			$row["productos"] = $obj->producto;
			$row["idProducto"] = $obj->idProducto;
			$data["test"] .= $this->tpl->printTemplate("remitosInputText",$row);		  
		}
		//fech
		$dataFecha["name"] = "Date";
		$data["Fecha"] = $this->tpl->printTemplate("fecha_remitos",$dataFecha);
		return $this->tpl->printTemplate("remitos_form",$data);
	}
	
	function listadoTiposGrupos(){
		$db = $this->selProductType();		
		while($row = mysql_fetch_array($db)){
			$data["optionsProductType"] .= $this->tpl->printTemplate("productos_type_list_line",$row);
		}
		return $this->tpl->printTemplate("productos_type_list",$data);
	}

	function processFormRemitos($post){
		$arrDate = explode("/",$post["Date"]);
		$post["fecha"] = mktime(0,0,0,$arrDate[0],$arrDate[1],$arrDate[2]);
		$lastNR = $this->getLastNumeroRemitoByTipo($post["tipo"]);
		$post["numeroRemito"] = $lastNR + 1;
		$idRemito = $this->insertRemito($post);
		$idRemitoInsert['idRem'] = mysql_insert_id(); 
		$cantProducto = $this->cantidadProducto($cant);
		$cantProd = mysql_fetch_array($cantProducto);
		$count = $cantProd[0];
		for($i=0;$i<$count;$i++){
			if($post["prod_".$i]){
				//insert item
				$idProd['idProd'] = $post["idprod_".$i];
				$valor['cantidad']=$post["prod_".$i];
				$price = $this->ultimoPrecio($idProd);
				$this->insertRemitoItems($idRemitoInsert,$valor,$idProd,$price);
			}
		}
	}
		
	function fechaRemitos(){
	 $data['name'] = "departureTo_qj"; 
	 $data['date'] = "7/11/2008";
	 $data['action'] = "index.php?page=12";
	 return $this->tpl->printTemplate("fecha_remitos",$data);
	}
*/
}
?>