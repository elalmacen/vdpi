<?
class editarPreciosABM{
	function selProducto($filter = NULL){
		$query = "select * from productos $filter";
		return mysql_query($query);
	}
	
	function selClientType($filter = NULL){
		$query = "select * from clientes_type $filter";
		return mysql_query($query);
	}
		
	function update($post){				
		$query = "UPDATE productos_precio SET 
		precio = '".$post['idPrecio']."', 
		idProducto = '".$post['direccion']."', 
		idClientType = '".$post['email']."', 
		fecha = '".$post['tel']."', 
		idClientType = ".$post['idClientType']." 
		WHERE idCliente = ".$post['idCliente'].";";
		return mysql_query($query);
	}
	
	function insert($post){
		$query = "insert into clientes 
		(cliente,direccion,email,tel,idClientType) 
		values 
		('".$post['cliente']."','".$post['direccion']."','".$post['email']."','".$post['tel']."',".$post['idClientType'].");";
		return mysql_query($query);
	}
	
	function selClientesType($filter = NULL){
		$query = "select * from clientes_type $filter";
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
	
	function selectClientTypeByProduct($idProducto){
		$query = "select ct.idClientType,ct.clientTypeName from productos_precio pp join clientes_type ct on(pp.idClientType = ct.idClientType) where pp.idProducto = ".$idProducto." GROUP by ct.idClientType";
		return mysql_query($query);
	}
	
	function selectPrecioByCliente($idClientType,$idProducto){
		$query = "select * from productos_precio where idClientType=".$idClientType." and idProducto = ".$idProducto." order by fecha desc limit 1";
		return mysql_query($query);
	}
	
	function updatePrecioByCliente($post){
		$query = "update productos_precio set precio =  " . $post['idPrecio']. " where idClientType = " .$post['idClientType']. " and idProducto = " .$post['idProducto'] . " order by fecha desc limit 1";
		return mysql_query($query);
	}
}
?>