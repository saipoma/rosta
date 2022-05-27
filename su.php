<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_su = "localhost";
$database_su = "student_data";
$username_su = "root";
$password_su = "";
$su = mysql_pconnect($hostname_su, $username_su, $password_su) or trigger_error(mysql_error(),E_USER_ERROR); 
?>