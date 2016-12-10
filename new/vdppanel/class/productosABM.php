<?
class productosABM{
	
	function selProductos($filter = NULL){
		$query = "select * from productos left join productos_grupo on productos_grupo.idGrupo=productos.idGrupo $filter";
		return mysql_query($query);
	}
	
	function updateProduct($post){				
		$query = "UPDATE productos SET 
		producto = '".$post['producto']."', 
		units_x_paquete = '".$post['units_x_paquete']."', 
		gramos_x_paquete = '".$post['gramos_x_paquete']."', 
		paquetes_x_caja = '".$post['paquetes_x_caja']."', 
		idGrupo = ".$post['idGrupo']." 
		WHERE idProducto = ".$post['id'].";";
		return mysql_query($query);
	}
	
	function insertProducto($post){
		$query = "insert into productos 
		(producto,idGrupo,units_x_paquete,gramos_x_paquete,paquetes_x_caja) 
		values 
		('".$post['producto']."','".$post['idGrupo']."','".$post['units_x_paquete']."','".$post['gramos_x_paquete']."','".$post['paquetes_x_caja']."');";
		return mysql_query($query);
	}
	
	function selProductType($filter = NULL){
		$query = "select * from productos_grupo $filter";
		return mysql_query($query);
	}
	
	function updateTipoGrupo($post){
		$query = "update productos_grupo set grupo = '".$post["grupo"]."' where idGrupo = ".$post["idGrupo"];
		return mysql_query($query);
	}
	
	function insertGrupo($post){
		$query = "insert into productos_grupo (grupo) values ('".$post["grupo"]."')";
		return mysql_query($query);
	}

}
?>