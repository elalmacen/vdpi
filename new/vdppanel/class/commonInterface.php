<?php
class commonInterface{
	function commonInterface(){
		$this->tpl = new tplClass();
	}
	function body($contenido,$includes){
		$data['menu'] = $this->menu();
		$data['submenu'] = $this->submenu();
		$data['contenido'] = $contenido;
		$data["includes"] = $includes;
		return $this->tpl->printTemplate("body",$data);
	}
	function menu(){
		global $HTTP_SESSION_VARS;
		global $HTTP_GET_VARS;
		$page = substr( $HTTP_GET_VARS['page'] , 0 ,1); //Para marcar el menu seleccionado.
		$data["sel".$page] = "Sel"; //Agrega a class para que use el estilo de lo marcado.
		$data["menuSombra".$page] = "menuSombra";
		//Recordar depurar codigo, en el loguin, por ejemplo en el case de abajo, limpiar lo q no sirve.
		$HTTP_SESSION_VARS["idtype"] = 1;
		switch($HTTP_SESSION_VARS["idtype"]){
			case 1:
				return $this->tpl->printTemplate("menu_admin",$data);
				break;
			case 2:
				return $this->tpl->printTemplate("menu_oper",$data);
				break;
		}
	}
	function submenu(){
		global $HTTP_GET_VARS;
		$page = substr( $HTTP_GET_VARS['page'] , 0 ,1);
		switch($page){
			case 1:
				$submenu = $this->tpl->printTemplate("submenu_1",null);
				break;
			case 2:
				$submenu = $this->tpl->printTemplate("submenu_2",null);
				break;
			case 3:
				$submenu = $this->tpl->printTemplate("submenu_3",null);
				break;
			case 4:
				$submenu = $this->tpl->printTemplate("submenu_4",null);
				break;
			case 5:
				$submenu = $this->tpl->printTemplate("submenu_5",null);
				break;
			case 6:
				$submenu = $this->tpl->printTemplate("submenu_5",null);
				break;
			default:
				$submenu = $this->tpl->printTemplate("submenu_0",null);
				break;
		}
		return $submenu;
	}
	function userDetail(){
		global $HTTP_SESSION_VARS;
		return $this->tpl->printTemplate("user_detail",$HTTP_SESSION_VARS);
	}
}
?>
