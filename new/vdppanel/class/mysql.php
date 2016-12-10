<?php
class mysql{
	function mysql(){
		$link = mysql_connect (DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
		mysql_select_db(DB_NAME,$link);
		echo mysql_error();
		return $link;
	}
}
?>
