<?php 
// 1. CREATE A DATABASE CONNECTION
$connection = mysql_connect('localhost', 'root', ''); 
// 2. SELECT A DATABSE TO USE
$db_select = mysql_select_db("widget_corp", $connection);

 ?>