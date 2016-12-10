<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2007
 */
class tplClass{
	public $arrData = Array();
	function file($template_file){
		global $path;
		$this->tpl_file = $path.'templates/' . $template_file . '.tpl';
	}

	function muestra(){
		if (!($this->fd = @fopen($this->tpl_file, 'r')))
		{
			echo('error al abrir la plantilla ' . $this->tpl_file);
		} else{
			$this->template_file = fread($this->fd, filesize($this->tpl_file));
			fclose($this->fd);
			$this->mihtml = $this->template_file;
			$this->mihtml = str_replace ("'", "\'", $this->mihtml);
			$this->mihtml = preg_replace('#\{([a-z0-9\-_]*?)\}#is', "' . $\\1 . '", $this->mihtml);
			reset ($this->arrData);
			while (list($key, $val) = each($this->arrData))
			{
				$$key = $val;
			}
			eval("\$this->mihtml = '$this->mihtml';");
			reset ($this->arrData);
			while (list($key, $val) = each($this->arrData))
			{
				unset($$key);
			}
			$this->mihtml=str_replace ("\'", "'", $this->mihtml);
			return $this->mihtml;
		}
	}

	function printTemplate($file,$data){

		$this->file($file);
		if(is_Array($data))
			$this->arrData = $data;
		return $this->muestra();
	}
}

?>