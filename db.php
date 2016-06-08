<?php
	/*
		db.php: ubcnpro database handler and functions
		author: mert akengin
		date: 2016/06/08
	*/
	const dbfilename = "ubp.db";
	const urltab = "links";
	const clicktab = "clicks";
	// core functions
	function dbinit($handle)
	{
		$handle->exec("pragma foreign_keys = true;");
		$handle->exec(
			"create table if not exists '".urltab."' ("
				."'id' integer not null primary key,"
				."'url' text not null,"
				."'cid' integer not null,"
				."'loc' text not null,"
				."'lat' real not null,"
				."'lon' real not null,"
				."'hash' text not null unique"
			.") ;"
		) or die("error creating ".urltab."!");
		$handle->exec(
			"create table if not exists '".clicktab."' ("
				."'id' integer not null primary key,"
				."'for' int not null references ".urltab."(id),"
				."'time' int not null,"
				."'ua' int not null,"
				."'sid' int not null,"
				."'addr' int not null,"
				."'test' text "
			.") ;"
		) or die("error creating ".clicktab."!");
		return;
	}
	function click_count($handle,$id)
	{
		$res = $handle->query("select count(*) from ".clicktab." where for = '".intval($id)."' ;") or die("error getting click count");
		return $res->fetchArray(SQLITE3_NUM)[0];
	}
	$db = new SQLite3(dbfilename);
	dbinit($db);
	var_dump(click_count($db,0));
?>
