<?php

require_once("connection.php");
$link = dbconnect(); //подключение к базе данных


$page = "intro"; 
function ispagename($str)
{
  return preg_match("/^[0-9A-Za-z_]+$/",$str);
}

if( isset($_GET['page']))
{
$page1 = $_GET['page'];
	if (ispagename($page1)){
		$page = $page1;
	}
}
$current_res = mysql_query("SELECT * FROM examples WHERE title_url = '$page' ");
$current_row = mysql_fetch_array($current_res);
if (!($current_row)) {
	die('Page not found ' );
}
$result = mysql_query("SELECT * FROM examples");

$menu = '';

 while ($row = mysql_fetch_array($result))
	{
		$class ='';
		if ($current_row['title_url'] == $row['title_url'] ){
			$class = 'class="selected"';
		}
		if ($row['nav']){
		$menu =  $menu. '<li><a href="'.'index.php?page='.$row['title_url'].'" '.$class.' >'.$row['button_name'].'</a>
					
		</li>';}
	}; 
	
$menu='<nav><ul>'.$menu.'</ul></nav> ';	

$content =$current_row['content'];

$includes = '<link rel="stylesheet" href="css/normalize.css" >'.
'<link rel="stylesheet" href="css/main.css" >'.
'<link rel="stylesheet" href="css/responsive.css">';

/*  */


$body = '<header>
	    <a href="" id="logo">
        <h1>Малка Корец</h1>
        <h2>Копирайтер</h2>
      </a>'.$menu.'
</header>

<div id="wrapper" >
	<div id="title"> 
	  <h3>'.$current_row[title].'</h3>
	</div>
  <div id="content" >'.
	$content.'</div>
</div>';

$html = '<!DOCTYPE html>
<html>
	<head> 
	  <meta charset="utf-8">
	  <title>Malka Korets | Copywriter</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">'.
$includes.'</head> <body>'.$body.'</body></html>';


echo $html;
mysql_close($link); 
?>