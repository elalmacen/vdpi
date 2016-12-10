<?
class preciosABM{
	
	function selprecios($filter = NULL){
		$query = "select * from productos_precio left join Productos using(idProducto) left join clientes_type using(idClientType) order by fecha desc $filter";
		return mysql_query($query);
	}
	
	function selproductosPrecios($filter = NULL){
		$query = "select * from productos $filter";
		return mysql_query($query);
	}
	
	function selClientTypePrecios($filter = NULL){
		$query = "select * from clientes_type $filter";
		return mysql_query($query);
	}
	
	function insertPrecios($post){
	$query = "insert into productos_precio 
		(precio,idProducto,idClientType,fecha) 
		values 
		('".$post['precio']."','".$post['producto']."','".$post['idClientType']."',".time().");";
		return mysql_query($query);
	}
	
	function selProductType($filter = NULL){
		$query = "select * from productos_grupo $filter";
		return mysql_query($query);
	}
		
}
?>