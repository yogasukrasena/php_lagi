<?php

$tdataGLOBAL = array();


$allPages = my_json_decode( "{\"menu\":[\"menu\"]}" );
$pages = array();

foreach( $allPages as $ptype => $pids ) {
	foreach(  $pids as $pid ) {
		$pages[$pid] = $ptype;
	}
}

$defaultPages = my_json_decode( "{\"menu\":\"menu\"}" );

$tdataGLOBAL[".pages"] = $pages;
$tdataGLOBAL[".defaultPages"] = $defaultPages;
$tables_data["<global>"] =& $tdataGLOBAL;

$detailsTablesData["<global>"] = array();
$masterTablesData["<global>"] = array();

?>