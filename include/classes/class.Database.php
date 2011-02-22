<?php
class Database
{

	//Constructor
	function Database()
	{
		//do nothing
	}

	//Methods

	function connect()
	{

		//$connection = mysql_connect(localh, DB_USER, DB_PASSWORD) or die(mysql_error());
        $connection = mysql_connect(DB_HOST, DB_USER,DB_PASSWORD) or die(mysql_error());
		if (mysql_errno() == 1203)
		{
  			// 1203 == ER_TOO_MANY_USER_CONNECTIONS (mysqld_error.h)
  			header("Location: too_many_connections");
  			exit;
		}
		$db = mysql_select_db(DB_DATABASE,$connection) or die("Couldn't select database.");
	}
}
?>