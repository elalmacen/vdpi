<?php
class pageSwitch{
	function pageSwitch($post=null,$get=null){
		$ci = new commonInterface();
		$users = new users();
		$usersABM = new usersABM();
		
		//incluyo los javascript segun la pagina en la que este
		//incluyo las clases generales que utilizo en la pagina
		switch(substr( $get['page'] , 0 ,1)){
			case 1: 
				$noticiaObj = new noticia;
				$includes = '<script language="javascript" src="js/calendarDateInput.js"></script>'; 
				$includes .= '<script language="javascript" src="js/val_remitos.js"></script>'; 
				$includes .= '<script language="javascript" src="js/common.js"></script>'; 
				$includes .= '<script language="JavaScript" type="text/javascript" src="wysiwyg/scripts/wysiwyg.js"></script>';
				$includes .= '<script language="JavaScript" type="text/javascript" src="wysiwyg/scripts/wysiwyg-settings.js"></script> ';
			break;
			case 3: 
				$clientObj = new clientes;
				$includes = '<script language="javascript" src="js/val_clientes.js"></script>'; 
			break;
			case 4: 
				$productObj = new productos;
				$includes = '<script language="javascript" src="js/val_productos.js"></script>';
			break;
			case 5: 
				$preciosObj = new precios;
				$includes = '<script language="javascript" src="js/calendarDateInput.js"></script>'; 
				$includes .= '<script language="javascript" src="js/validator.js"></script>'; 
			break;
			case 6: 
				$editoPrecio = new editarPrecios;
				$preciosObj = new editarPrecios;
				$includes = '<script language="javascript" src="js/calendarDateInput.js"></script>'; 
				$includes .= '<script language="javascript" src="js/validator.js"></script>'; 
			break;
		}		
		
		switch ($get['page']) {
			// NOTICIAS.
			case 1:
				$html = $noticiaObj->createnoticia($get);		
				break;
			case 12:				
				if($post['sub_btn']){
					$noticiaObj->noticiasProcesForm($post);
				}				
				$html .= $noticiaObj->createnoticia($get);				
				break;
			case 13:						
				$html = $remitosObj->remitosProductoslist($get);	
				break;
			// USUARIO.
			case 2:				
				$html = $users->usersList();
				break;
			case 21:
				if($post['sub_btn']){$usersABM->update($post);}
				$html = $users->userUpDate($get);
				break;
			case 22:
				if($post['sub_btn']){$usersABM->insert($post);}
				$html = $users->userNewForm();
				break;
			//CLIENTES.
			case 3:
				$html = $clientObj->listadoClientes();
				break;
			case 31:						
				if($post['sub_btn']){$clientObj->processForm($post);}
				$html = $clientObj->clientesProcess($get);
				break;
			case 32:
				if($post['sub_btn']){$clientObj->processFormTipo($post);}
				$html = $clientObj->formTiposClientes($get);
				$html .= $clientObj->listadoTiposClientes();
				break;	
			//PRODUCTOS.
			case 4:
				$html = $productObj->listadoProductos();
				break;
			case 41:
				if($post['sub_btn']){$productObj->processFormProduct($post);}
				$html = $productObj->productForm($get);
				break;
			case 42:
				if($post['sub_btn']){$productObj->processFormGrupo($post);}
				$html = $productObj->formTiposGrupos($get);
				$html .= $productObj->listadoTiposGrupos();
				break;
			//PRECIOS.
			case 5:
				$html = $preciosObj->listadoPrecios();
				break;
			case 51:
				if($post['sub_btn']){$preciosObj->processFormPrecios($post);}
				$html = $preciosObj->preciosForm($get);
				break;
			case 6:
				if($post['sub_btn']){$preciosObj->processForm($post);}
				$html = $editoPrecio->clientesProcess($post);
				break;
			default:
				$html = $ci->userDetail();
				break;
		}
		echo $ci->body($html,$includes);
	}
}

?>