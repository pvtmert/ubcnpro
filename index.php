<?php
	if(substr($_SERVER["SCRIPT_URL"],-1) != '/')
	{
		$target = basename($_SERVER["SCRIPT_URL"])."/";
		if(!empty($_SERVER["QUERY_STRING"]))
			$target .= "?".$_SERVER["QUERY_STRING"];
		header("location: ".$target);
		exit;
	}
	$ndata = array(
		"hash" => strtolower(basename($_SERVER["SCRIPT_URL"])),
		"query" => $_SERVER["QUERY_STRING"],
	);
	session_start();
	if(empty($ndata["hash"]))
		die("wrong place mf");
	require_once("db.php");
	require_once("fn.php");
	if($ndata["hash"] == "admin" || $ndata["hash"] == "ubcnpro")
	{
		echo "<h2>\n"
			."<a href=?usr >users</a>\n"
			."<a href=?urls >urls</a>\n"
			."<a href=?clicks >clicks</a>\n"
			."<a href=?headers >headers</a>\n"
			."<a href=../manage >manage</a>\n"
			."</h2>\n";
		switch(true)
		{
			case !strcmp($ndata["query"],"usr"):
				echo array_to_table(table_dump($db,ctab));
				break;
			case !strcmp($ndata["query"],"urls"):
				echo array_to_table(table_dump($db,urltab));
				break;
			case !strcmp($ndata["query"],"clicks"):
				echo array_to_table(table_dump($db,clicktab,true),false);
				break;
			case !strcmp($ndata["query"],"headers"):
				echo "<pre>\n";
				print_r($_SERVER);
				echo "\n";
				print_r(getallheaders());
				echo "\n";
				print_r(dirname($ndata["hash"]));
				echo "\n";
				print_r(basename($ndata["hash"]));
				echo "</pre>\n";
				break;
		}
	}else{
		$urls = hashtourl($db,$ndata["hash"]);
		header("location: ".$urls[0]["url"]);
		table_add($db,clicktab,
			array("for","time","ua","sid","addr","test"),
			array(intval($urls[0]["id"]),time(),
				SQLite3::escapeString($_SERVER["HTTP_USER_AGENT"]),
				SQLite3::escapeString(session_id()),
				ip2long($_SERVER["REMOTE_ADDR"]),
				json_encode(getallheaders(),JSON_PRETTY_PRINT)
			)
		);
		exit;
	}
?>
<style>
	table, tr, td, th, a {
		border-collapse:collapse;
		border:1px solid black;
		padding:4px;
		font-family:monaco,monospace;
		font-size:0.9em;
		text-decoration:none;
	}
</style>
<script>
	function loadstuff() {
		if(!window.scrollY) {
			var req = new XMLHttpRequest();
			req.addEventListener("load",function(e) {
				if(this.status != 200)
					return;
				if(this.response.length <= document.body.innerHTML.length)
					return;
				document.body.innerHTML = this.response;
				return;
			});
			req.open("GET",window.location,true);
			req.send(null);
		}
	}
	setInterval(loadstuff,1000*5);
</script>