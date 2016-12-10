<?php
class clientesABM{
	function selClientes($filter = NULL){
		$query = "select * from clientes left join clientes_type using(idClientType) $filter";
		return mysql_query($query);
	}
		
	function update($post){				
		$query = "UPDATE clientes SET 
		cliente = '".$post['cliente']."', 
		direccion = '".$post['direccion']."', 
		email = '".$post['email']."', 
		tel = '".$post['tel']."', 
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
}
?>