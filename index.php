<?php
	require_once("db.php");
	require_once("fn.php");
	echo click_count($db,0)."<br>\n";
	echo array_to_table(table_dump($db,ctab));
	echo array_to_table(table_dump($db,urltab));
	echo array_to_table(table_dump($db,clicktab),false);
?>