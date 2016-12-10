<?php
class usersABM{
	function usersABM(){
		$this->tpl = new tplClass();
	}
	function selUsers($filter=null){
		echo $query = "SELECT * FROM users $filter;";
		return mysql_query($query);
	}
	function update($post){
		$idUser = $post['idUser'];
		$user = $post['user'];
		$pass = $post['pass'];
		$name = $post['name'];
		$email = $post['email'];
		$query = "UPDATE users SET 
		user = '$user', 
		pass = '$pass', 
		name = '$name', 
		email = '$email', 
		WHERE idUser = $idUser;";
		return mysql_query($query);
	}
	function insert($post){
		$user = $post['user'];
		$pass = $post['pass'];
		$name = $post['name'];
		$email = $post['email'];
		$idtype = $post['idtype'];
		$query = "INSERT INTO users (user,pass,name,email,idtype) VALUES ('$user','$pass','$name','$email',$idtype);";
		return mysql_query($query);
	}
}
?>