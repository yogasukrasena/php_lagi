<?php
$strTableName="tblcollect_master";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="tblcollect_master";

$gstrOrderBy="ORDER BY ID DESC";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

// alias for 'SQLQuery' object
$gSettings = new ProjectSettings("tblcollect_master");
$gQuery = $gSettings->getSQLQuery();
$eventObj = &$tableEvents["tblcollect_master"];

$reportCaseSensitiveGroupFields = false;

$gstrSQL = $gQuery->gSQLWhere("");

?>