<?php

class login{
	function login($post=null,$get=null){
		
		$this->user = $post["user"];
		$this->pass = $post["pass"];
		if($post)
			$this->doLogin();
		else{
			$this->logout();
			$this->showLoginForm();
		}
		

	}

	function logout(){
		global $HTTP_SESSION_VARS;
		// Destruye todas las variables de la sesi&oacute;n
		session_unset();
		// Finalmente, destruye la sesi&oacute;n
		session_destroy();


	}
	function showLoginForm(){

		global $PHP_SELF;
		/// create object
		$templatObject=new tplClass();
		// login
		$data['message'] = $this->message;
		$htmlOut .= $templatObject->printTemplate("login",$data);
		echo $htmlOut;
	}
	function doLogin(){
		global $HTTP_SESSION_VARS;
		$usersABM = new usersABM();

		$filter = "where user='".$this->user."' and pass='".$this->pass."'";
		$db = $usersABM->selUsers($filter);
		
		if(mysql_num_rows($db) > 0){
			$row = mysql_fetch_array($db);
			$HTTP_SESSION_VARS["idUser"] = $row['idUser'];
			$HTTP_SESSION_VARS["user"] = $row['user'];
			$HTTP_SESSION_VARS["name"] = $row['name'];
			$HTTP_SESSION_VARS["email"] = $row['email'];
			$HTTP_SESSION_VARS["idtype"] = $row['idtype'];
			$HTTP_SESSION_VARS["type"] = $row['type'];
			cpSwich(null);
		}else{
			$this->message = "Error de Usuario y Contraseña.<br />Intente nuevamente.";
			$this->logout();
			$this->showLoginForm();
		}
	}
}