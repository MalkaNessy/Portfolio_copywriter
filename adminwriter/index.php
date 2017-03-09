<?php
echo '<link href="style-admin.css" rel="stylesheet">';
require_once __DIR__ . "/../connection.php";
$link = dbconnect();

$body = '';
$result = mysql_query("SELECT * FROM lectures");
while ($row = mysql_fetch_array($result))
	{
		$body =  $body.'<tr>'.'<td>'.$row['button_name'].'</td>'.'<td>'.$row['title'].'</td>'.'<td><a href="form.php?id='.$row['ID'].'">Редактировать</a></td>'.'</tr>';
	};
$body='<table >'.'<tr><th>Надпись на кнопке</th><th>Заголовок статьи</th></tr>' .$body.'</table>';










$includes = '<link href="style.css" rel="stylesheet">'.
'<link rel="stylesheet" href="CLEditor1_4_5/jquery.cleditor.css" />'.
'<script src="jquery-3.1.1.js"></script>'.
'<script src="CLEditor1_4_5/jquery.cleditor.min.js"></script>'.
'<script src="form.js"></script>';




$html =" <head>$includes</head> <body>$body </body>  ";
echo $html;

mysql_close($link);
?>
