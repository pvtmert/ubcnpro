<?php
	function array_to_table($arr,$with_header = true)
	{
		$res = "<table>\n";
		if($with_header)
		{
			$res .= "\t<tr>\n";
			foreach($arr[0] as $k => $v)
				$res .= "\t\t<th>".$k."</th>\n";
			$res .= "\t</tr>\n";
		}
		foreach($arr as $ai)
		{
			$res .= "\t<tr>\n";
			foreach($ai as $k => $v)
				$res .= "\t\t<td ".$k." >".$v."</td>\n";
			$res .= "\t</tr>\n";
		}
		$res .= "</table>\n";
		return $res;
	}
?>