<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_examen_con = "localhost";
$database_examen_con = "viajes";
$username_examen_con = "root";
$password_examen_con = "";
$examen_con = mysql_pconnect($hostname_examen_con, $username_examen_con, $password_examen_con) or trigger_error(mysql_error(),E_USER_ERROR); 
?>