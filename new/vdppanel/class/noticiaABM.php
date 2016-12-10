<?php
class noticiaABM{
	function selectTema(){
		$query = "select * from tema";
		return mysql_query($query);
	}
	
	function insertNoticia($post){
		echo $query = "insert into nota (idTema,titulo,fecha,foto,texto) values ('".$post['tema']."','".$post['titulo']."','".$post['fecha']."','".$post['foto']."','".$post['noticia']."');";
		return mysql_query($query);
	}
//
	/*function remitosSelProd($idRemito){
		$query = "select * from remito left join clientes using(IdCliente) left join zonas using(idZona) where idRemito=".$idRemito;
		return mysql_query($query); 
	}
	
	function remitosViewProduct($idRemito){
        $query = "select * from remito left join remito_items using(idremito) left join productos using (idProducto) where idRemito=".$idRemito;
		return mysql_query($query); 
	}
	
	function borrarRemitos($data){
		$query = "delete from remito_items where idRemito=".$data;
		if(mysql_query($query)){
			$query = "delete from remito where idRemito=".$data;
		}
		return mysql_query($query);
	}
		
	function updateRemito($post){				
		$query = "UPDATE remito SET 
		numeroRemito = '".$post['numeroRemito']."', 
		fecha = '".$post['fecha']."', 
		tipo = '".$post['tipo']."', 
		idCliente = '".$post['idCliente']."', 
		idZona = ".$post['idZona']." 
		WHERE idRemito = ".$post['idRem'].";";
		return mysql_query($query);
	}
	
	function insertRemito($post){
		$query = "insert into remito
		(numeroRemito,fecha,tipo,idCliente,idZona) 
		values 
		('".$post['numeroRemito']."','".$post['fecha']."','".$post['tipo']."','".$post['idCliente']."',".$post['idZona'].");";
		mysql_query($query);
		return mysql_insert_id();
	}
	
	function ultimoPrecio($idProd){
		$query = "select cliente,precio from clientes c join productos_precio p on (c.idClientType = p.idClientType and p.idProducto = ". $idProd['idProd'] .") 	 		 	 			 where c.idCliente =". $idProd['idProd'] ." order by fecha desc limit 1";
		$db = mysql_query($query);
		if(mysql_num_rows($db)>0){
			$obj = mysql_fetch_object($db);
			return $obj->precio;
		}else{
			return 0;
			}
	}
	
	function getLastNumeroRemitoByTipo($tipo){
		$query = "select * from remito where tipo = $tipo order by numeroRemito desc limit 1";
		$db = mysql_query($query);
		if(mysql_num_rows($db)>0){
			$obj = mysql_fetch_object($db);
			return $obj->numeroRemito;
		}else{
			return 0;
			}
	}
	
	function cantidadProducto($cant){
		$query = "SELECT COUNT(*) FROM productos";
		return mysql_query($query);
	}
	
	function insertRemitoItems($idRemitoInsert,$valor,$idProd,$price){
		$query = "insert into remito_items
		(idRemito,idProducto,cantida,Punitario) 
		values 
		('".$idRemitoInsert['idRem']."','".$idProd['idProd']."','".$valor['cantidad']."','".$price."');";
		return mysql_query($query);
		// mysql_insert_id();
	}
	
	function selClientesType($filter = NULL){
		$query = "select * from clientes_type $filter";
		return mysql_query($query);
	}
	
	function selClientes($filter = NULL){
		$query = "select * from clientes $filter";
		return mysql_query($query);
	}
	
	function selZonas($filter = NULL){
		$query = "select * from zonas $filter";
		return mysql_query($query);
	}
	
	function updateTipo($post){
		$query = "update clientes_type set clientTypeName = '".$post["clientTypeName"]."' where idClientType = ".$post["idClientType"];
		return mysql_query($query);
	}
	
	function insertTipo($post){
		$query = "insert into clientes_type (clientTypeName) values ('".$post["clientTypeName"]."')";
		return mysql_query($query);
	}
	
	function selectProductPorGrupo($filter = NULL){
		$query = "select * from productos left join productos_grupo using(idGrupo) order by idGrupo";
		return mysql_query($query);
	}*/
}
?>