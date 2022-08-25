<?php

/**
* getLookupMainTableSettings - tests whether the lookup link exists between the tables
*
*  returns array with ProjectSettings class for main table if the link exists in project settings.
*  returns NULL otherwise
*/
function getLookupMainTableSettings($lookupTable, $mainTableShortName, $mainField, $desiredPage = "")
{
	global $lookupTableLinks;
	if(!isset($lookupTableLinks[$lookupTable]))
		return null;
	if(!isset($lookupTableLinks[$lookupTable][$mainTableShortName.".".$mainField]))
		return null;
	$arr = &$lookupTableLinks[$lookupTable][$mainTableShortName.".".$mainField];
	$effectivePage = $desiredPage;
	if(!isset($arr[$effectivePage]))
	{
		$effectivePage = PAGE_EDIT;
		if(!isset($arr[$effectivePage]))
		{
			if($desiredPage == "" && 0 < count($arr))
			{
				$effectivePage = $arr[0];
			}
			else
				return null;
		}
	}
	return new ProjectSettings($arr[$effectivePage]["table"], $effectivePage);
}

/** 
* $lookupTableLinks array stores all lookup links between tables in the project
*/
function InitLookupLinks()
{
	global $lookupTableLinks;

	$lookupTableLinks = array();

		if( !isset( $lookupTableLinks["tblcollect_design"] ) ) {
			$lookupTableLinks["tblcollect_design"] = array();
		}
		if( !isset( $lookupTableLinks["tblcollect_design"]["tblcollect_master.DesignCode"] )) {
			$lookupTableLinks["tblcollect_design"]["tblcollect_master.DesignCode"] = array();
		}
		$lookupTableLinks["tblcollect_design"]["tblcollect_master.DesignCode"]["add"] = array("table" => "tblcollect_master", "field" => "DesignCode", "page" => "add");
		if( !isset( $lookupTableLinks["tblcollect_design"] ) ) {
			$lookupTableLinks["tblcollect_design"] = array();
		}
		if( !isset( $lookupTableLinks["tblcollect_design"]["tblcollect_master.DesignCode"] )) {
			$lookupTableLinks["tblcollect_design"]["tblcollect_master.DesignCode"] = array();
		}
		$lookupTableLinks["tblcollect_design"]["tblcollect_master.DesignCode"]["search"] = array("table" => "tblcollect_master", "field" => "DesignCode", "page" => "search");
		if( !isset( $lookupTableLinks["tblcollect_name"] ) ) {
			$lookupTableLinks["tblcollect_name"] = array();
		}
		if( !isset( $lookupTableLinks["tblcollect_name"]["tblcollect_master.NameCode"] )) {
			$lookupTableLinks["tblcollect_name"]["tblcollect_master.NameCode"] = array();
		}
		$lookupTableLinks["tblcollect_name"]["tblcollect_master.NameCode"]["add"] = array("table" => "tblcollect_master", "field" => "NameCode", "page" => "add");
		if( !isset( $lookupTableLinks["tblcollect_name"] ) ) {
			$lookupTableLinks["tblcollect_name"] = array();
		}
		if( !isset( $lookupTableLinks["tblcollect_name"]["tblcollect_master.NameCode"] )) {
			$lookupTableLinks["tblcollect_name"]["tblcollect_master.NameCode"] = array();
		}
		$lookupTableLinks["tblcollect_name"]["tblcollect_master.NameCode"]["search"] = array("table" => "tblcollect_master", "field" => "NameCode", "page" => "search");
		if( !isset( $lookupTableLinks["tblcollect_category"] ) ) {
			$lookupTableLinks["tblcollect_category"] = array();
		}
		if( !isset( $lookupTableLinks["tblcollect_category"]["tblcollect_master.CategoryCode"] )) {
			$lookupTableLinks["tblcollect_category"]["tblcollect_master.CategoryCode"] = array();
		}
		$lookupTableLinks["tblcollect_category"]["tblcollect_master.CategoryCode"]["add"] = array("table" => "tblcollect_master", "field" => "CategoryCode", "page" => "add");
		if( !isset( $lookupTableLinks["tblcollect_category"] ) ) {
			$lookupTableLinks["tblcollect_category"] = array();
		}
		if( !isset( $lookupTableLinks["tblcollect_category"]["tblcollect_master.CategoryCode"] )) {
			$lookupTableLinks["tblcollect_category"]["tblcollect_master.CategoryCode"] = array();
		}
		$lookupTableLinks["tblcollect_category"]["tblcollect_master.CategoryCode"]["search"] = array("table" => "tblcollect_master", "field" => "CategoryCode", "page" => "search");
		if( !isset( $lookupTableLinks["tblcollect_color"] ) ) {
			$lookupTableLinks["tblcollect_color"] = array();
		}
		if( !isset( $lookupTableLinks["tblcollect_color"]["tblcollect_master.ColorCode"] )) {
			$lookupTableLinks["tblcollect_color"]["tblcollect_master.ColorCode"] = array();
		}
		$lookupTableLinks["tblcollect_color"]["tblcollect_master.ColorCode"]["add"] = array("table" => "tblcollect_master", "field" => "ColorCode", "page" => "add");
		if( !isset( $lookupTableLinks["tblcollect_color"] ) ) {
			$lookupTableLinks["tblcollect_color"] = array();
		}
		if( !isset( $lookupTableLinks["tblcollect_color"]["tblcollect_master.ColorCode"] )) {
			$lookupTableLinks["tblcollect_color"]["tblcollect_master.ColorCode"] = array();
		}
		$lookupTableLinks["tblcollect_color"]["tblcollect_master.ColorCode"]["search"] = array("table" => "tblcollect_master", "field" => "ColorCode", "page" => "search");
}

?>