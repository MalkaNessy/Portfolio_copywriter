<?php

require_once("connection.php");//will check if the file "connection.php" has already been included
$link = dbconnect(); // connect to Data Base


$page = "intro";// to use with URL 
function ispagename($str)// check sympols in URL 
{
  return preg_match("/^[0-9A-Za-z_]+$/",$str);
}

if( isset($_GET['page']))// check the 'page'=part of URL and rewrite the variable 
{
$page1 = $_GET['page'];
	if (ispagename($page1)){
		$page = $page1;
	}
}
$current_res = mysql_query("SELECT * FROM examples WHERE title_url = '$page' ");//select from DataBase according to the 'page' field. 
$current_row = mysql_fetch_array($current_res);//taking one row from table, where title_url == 'page' (remember, this is current URL)
if (!($current_row)) {
	die('Page not found ' );
}
$result = mysql_query("SELECT * FROM examples");

$menu = '';
$gallery='';
$main_title = "index.php?page=intro";//site title alwayse has link to main page

//generate menu and gallery 
 while ($row = mysql_fetch_array($result))
	{
		$class ='';
		if ($current_row['title_url'] == $row['title_url'] ){
			$class = 'class="selected"';
		}
		if ($row['nav']){
		$menu =  $menu. '<li><a href="'.'index.php?page='.$row['title_url'].'" '.$class.' >'.$row['button_name'].'</a>
					
		</li>';}
		if ($row['gal']){
		$gallery =  $gallery. '<li><a href="'.'index.php?page='.$row['title_url'].'" ><img src="http://test1.ru/Copywriter/img/'.$row['a'].'" alt=""><p>'.$row['button_name'].'</p></a>
					
		</li>';}
		
	}; 


	
 
//generate menu on page		
$menu='<nav><ul>'.$menu.'</ul></nav> ';
	
//generate content (texts) on page
$content =$current_row['content'];

//generate part of header: included files
$includes = '<link rel="stylesheet" href="css/normalize.css" >'.
'<link rel="stylesheet" href="css/main.css" >'.
'<link rel="stylesheet" href="css/responsive.css">';

//generate main page
if ($page == "intro"){
	
	$body = '<header>
	<a href="" id="logo">
        <h1>Малка Корец</h1>
        <h2>Копирайтер</h2>
    </a>'.$menu.'
</header>
<div id="wrapper" >
	<div id="topic"> 
	  <h3>"Жизнь коротка. Нет времени оставлять важные слова несказанными." Пауло Коэльо.</h3>
	</div>
  <ul id="gallery">
		'.$gallery.'
	</ul>
  
  <footer style="font-size: 13.3333px;"><p>© 2016 Malka Korets</p></footer>

	
  
</div>

';

$html = '<!DOCTYPE html>
<html>
	<head> 
	  <meta charset="utf-8">
	  <title>Malka Korets | Copywriter</title>
	  <base target="_self"> 
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">'.
$includes.'</head> <body>'.$body.'</body></html>';



echo $html;
mysql_close($link); 
	
}

//generate all pages exept main page
else{

$body = '<header>
	    <a href='.$main_title.' id="logo">
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
	<footer style="font-size: 13.3333px;"><p>© 2016 Malka Korets</p></footer>
</div>';

$html = '<!DOCTYPE html>
<html>
	<head> 
	  <meta charset="utf-8">
	  <title>Malka Korets | Copywriter</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">'.
$includes.'</head> <body>'.$body.'</body></html>';


echo $html;
mysql_close($link); }
?>