<?php
require_once __DIR__ . "/../connection.php";
$link = dbconnect();


//var_dump($_POST);
$sql = 'UPDATE examples'.
' SET title_url = "'. 
mysql_real_escape_string($_POST["title_url"])  .'"'.  
' , title = "'. 
mysql_real_escape_string($_POST["title"])  .'"'.
' , content = "'. 
mysql_real_escape_string($_POST["content"])  .'"'. 
' , button_name = "'. 
mysql_real_escape_string($_POST["button_name"])  .'"'.
' , a = "'. 
mysql_real_escape_string($_POST["a"])  .'"'.
    
' WHERE ID = "'.
mysql_real_escape_string($_POST["ID"])  .'"
';
//echo mysql_error();

// UPDATE Customers
//SET City = 'Hamburg'
//WHERE CustomerID = 1; 

mysql_query($sql);

//var_dump($sql);

mysql_close($link);

header('Location:admin.php');


?>