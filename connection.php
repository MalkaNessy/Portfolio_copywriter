<?php

function dbconnect ()
{
	$link = mysql_connect('localhost', 'themalka_root', 'oIN0PXW1-;at');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('themalka_writer', $link);
        mysql_set_charset('utf8',$link);
	return $link;
}









?>