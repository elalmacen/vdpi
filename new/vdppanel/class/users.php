<?php
class users{
	function users(){
		$this->tpl = new tplClass();
		$this->usersABM = new usersABM();
	}
	function usersList(){
		$db = $this->usersABM->selUsers();
		while($row = mysql_fetch_array($db)){
			$data['userList'] .= $this->tpl->printTemplate("users_list_line",$row);
		}
		return $this->tpl->printTemplate("users_list",$data);
	}
	function userUpDate($data){
		$idUser = $data['id'];
		$filter = "WHERE idUser = ".$idUser;
		$db = $this->usersABM->selUsers($filter);
		$data = mysql_fetch_array($db);
		$data['action'] = "?page=21&id=".$idUser;
		$data['sub_btn'] = "Actualizar";
		return $this->tpl->printTemplate("users_form",$data);
	}
	function userNewForm(){
		$data['action'] = "?page=22";
		$data['sub_btn'] = "Agregar";
		return $this->tpl->printTemplate("users_form",$data);
	}
}
?>