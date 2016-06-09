<?php
	/*
		db.php: ubcnpro database handler and functions
		author: mert akengin
		date: 2016/06/08
	*/
	const dbfilename = "ubp.db";
	const ctab = "cons";
	const urltab = "links";
	const clicktab = "clicks";
	// core functions
	function dbinit($handle)
	{
		//global ctab, urltab, clicktab;
		$handle->exec("pragma foreign_keys = true;");
		$handle->exec(
			"create table if not exists '".ctab."' ("
				."'id' integer not null primary key,"
				."'name' text not null,"
				."'mail' text not null,"
				."'pass' text not null,"
				."'loc' text not null,"
				."'lvl' int not null,"
				."'resv' text "
			.") ;"
		) or die("error creating ".ctab."!");
		$handle->exec(
			"create table if not exists '".urltab."' ("
				."'id' integer not null primary key,"
				."'cid' int not null references ".ctab."(id),"
				."'url' text not null,"
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
		$res = $handle->query("select count(*) as cnt from ".clicktab." where for = '".intval($id)."' ;") or die("error getting click count");
		return intval($res->fetchArray(SQLITE3_NUM)[0]);
	}
	function table_dump($handle,$tabname)
	{
		$res = $handle->query("select * from ".$tabname." ;") or die("error dump");
		$ret = array();
		while($R = $res->fetchArray(SQLITE3_ASSOC))
			$ret[] = $R;
		return $ret;
	}
	function table_add($handle,$tabname,$cols,$vals)
	{
		$handle->exec("insert into ".$tabname." (".implode(",",$cols).") values ('".implode("','",$vals)."');") or die("error adding");
		return $handle->lastInsertRowid();
	}
	function table_rowcnt($handle,$tabname)
	{
		$res = $handle->query("select count(*) as cnt from ".$tabname.";") or die("error counting");
		return intval($res->fetchArray(SQLITE3_NUM)[0]);
	}
	$db = new SQLite3(dbfilename);
	dbinit($db);
	if(table_rowcnt($db,ctab) < 1)
		table_add($db,ctab,
			array("id","name","mail","pass","lvl","loc"),
			array(0,"admin","root@localhost",md5("admin"),99,"/"));
	if(table_rowcnt($db,urltab) < 1)
		table_add($db,urltab,
			array("cid","url","loc","lat","lon","hash"),
			array(0,"http://google.com","nowhere",0,0,md5("ggl")));
?>
