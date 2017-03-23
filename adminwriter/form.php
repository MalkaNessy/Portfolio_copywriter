<?php
require_once __DIR__ . "/../connection.php";
//echo '<link href="style-admin.css" rel="stylesheet">';
function isint($str)
{
  return preg_match("/^[0-9]+$/",$str);
}
$id = $_GET['id']; //id статьи в таблице
if (!isint($id))
{
	die('Wrong ID');
}

$link = dbconnect();

$result = mysql_query("SELECT * FROM examples WHERE ID=$id");
$row = mysql_fetch_array($result);
if (!$row)
{
	die('Такой страницы нет');
}
//var_dump($row); 
//echo $row["title"];


$includes = '<link href="style-admin.css" rel="stylesheet">'.
'<link rel="stylesheet" href="CLEditor1_4_5/jquery.cleditor.css" />'.
'<script src="jquery-3.1.1.js"></script>'.
'<script src="CLEditor1_4_5/jquery.cleditor.min.js"></script>'.
'<script src="form.js"></script>';


$body = '<form action="savedata.php" method="post"><span class="formname">Надпись на кнопке или в превью: </span><input name="button_name" type="text" value="'   .$row["button_name"]. '"> <br>'. PHP_EOL .
'<input name="title_url" value="'   .$row["title_url"]. '" type="hidden" > <br>'. PHP_EOL .

'<span class="formname">Картинка: </span><textarea name="a" type="text"  cols="80" >'   .$row["a"]. ' </textarea> <br>'. PHP_EOL .

'<span class="formname">Заголовок статьи: <br></span><textarea name="title" type="text" cols="80"  >'   .$row["title"]. ' </textarea><br>'. PHP_EOL .
'<span class="formname">Текст статьи: </span><br><textarea name="content" id="data_content" rows="25" cols="100"> '   .$row["content"]. '</textarea> <br>'. PHP_EOL .
'<input name="ID" type="hidden" value="'   .$id. '"> <br>'.
'<input type="submit" value="Сохранить все изменения"> </form>';

$html =" <head>$includes</head> <body>$body </body>  ";
echo $html;

mysql_close($link);
?>
