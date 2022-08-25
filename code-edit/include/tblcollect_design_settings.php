<?php



$tdatatblcollect_design = array();
$tdatatblcollect_design[".searchableFields"] = array();
$tdatatblcollect_design[".ShortName"] = "tblcollect_design";
$tdatatblcollect_design[".OwnerID"] = "";
$tdatatblcollect_design[".OriginalTable"] = "tblcollect_design";


$defaultPages = my_json_decode( "{}" );

$tdatatblcollect_design[".pagesByType"] = my_json_decode( "{}" );
$tdatatblcollect_design[".pages"] = types2pages( my_json_decode( "{}" ) );
$tdatatblcollect_design[".defaultPages"] = $defaultPages;

//	field labels
$fieldLabelstblcollect_design = array();
$fieldToolTipstblcollect_design = array();
$pageTitlestblcollect_design = array();
$placeHolderstblcollect_design = array();

if(mlang_getcurrentlang()=="English")
{
	$fieldLabelstblcollect_design["English"] = array();
	$fieldToolTipstblcollect_design["English"] = array();
	$placeHolderstblcollect_design["English"] = array();
	$pageTitlestblcollect_design["English"] = array();
	$fieldLabelstblcollect_design["English"]["DesignCode"] = "Design Code";
	$fieldToolTipstblcollect_design["English"]["DesignCode"] = "";
	$placeHolderstblcollect_design["English"]["DesignCode"] = "";
	$fieldLabelstblcollect_design["English"]["DesignName"] = "Design Name";
	$fieldToolTipstblcollect_design["English"]["DesignName"] = "";
	$placeHolderstblcollect_design["English"]["DesignName"] = "";
	if (count($fieldToolTipstblcollect_design["English"]))
		$tdatatblcollect_design[".isUseToolTips"] = true;
}


	$tdatatblcollect_design[".NCSearch"] = true;



$tdatatblcollect_design[".shortTableName"] = "tblcollect_design";
$tdatatblcollect_design[".nSecOptions"] = 0;

$tdatatblcollect_design[".mainTableOwnerID"] = "";
$tdatatblcollect_design[".entityType"] = 0;

$tdatatblcollect_design[".strOriginalTableName"] = "tblcollect_design";

	



$tdatatblcollect_design[".showAddInPopup"] = false;

$tdatatblcollect_design[".showEditInPopup"] = false;

$tdatatblcollect_design[".showViewInPopup"] = false;

//page's base css files names
$popupPagesLayoutNames = array();
$tdatatblcollect_design[".popupPagesLayoutNames"] = $popupPagesLayoutNames;


$tdatatblcollect_design[".listAjax"] = false;
//	temporary
$tdatatblcollect_design[".listAjax"] = false;

	$tdatatblcollect_design[".audit"] = false;

	$tdatatblcollect_design[".locking"] = false;


$pages = $tdatatblcollect_design[".defaultPages"];

if( $pages[PAGE_EDIT] ) {
	$tdatatblcollect_design[".edit"] = true;
	$tdatatblcollect_design[".afterEditAction"] = 1;
	$tdatatblcollect_design[".closePopupAfterEdit"] = 1;
	$tdatatblcollect_design[".afterEditActionDetTable"] = "";
}

if( $pages[PAGE_ADD] ) {
$tdatatblcollect_design[".add"] = true;
$tdatatblcollect_design[".afterAddAction"] = 1;
$tdatatblcollect_design[".closePopupAfterAdd"] = 1;
$tdatatblcollect_design[".afterAddActionDetTable"] = "";
}

if( $pages[PAGE_LIST] ) {
	$tdatatblcollect_design[".list"] = true;
}



$tdatatblcollect_design[".strSortControlSettingsJSON"] = "";




if( $pages[PAGE_VIEW] ) {
$tdatatblcollect_design[".view"] = true;
}

if( $pages[PAGE_IMPORT] ) {
$tdatatblcollect_design[".import"] = true;
}

if( $pages[PAGE_EXPORT] ) {
$tdatatblcollect_design[".exportTo"] = true;
}

if( $pages[PAGE_PRINT] ) {
$tdatatblcollect_design[".printFriendly"] = true;
}



$tdatatblcollect_design[".showSimpleSearchOptions"] = true; // temp fix #13449

// Allow Show/Hide Fields in GRID
$tdatatblcollect_design[".allowShowHideFields"] = true; // temp fix #13449
//

// Allow Fields Reordering in GRID
$tdatatblcollect_design[".allowFieldsReordering"] = true; // temp fix #13449
//

$tdatatblcollect_design[".isUseAjaxSuggest"] = true;

$tdatatblcollect_design[".rowHighlite"] = true;





$tdatatblcollect_design[".ajaxCodeSnippetAdded"] = false;

$tdatatblcollect_design[".buttonsAdded"] = false;

$tdatatblcollect_design[".addPageEvents"] = false;

// use timepicker for search panel
$tdatatblcollect_design[".isUseTimeForSearch"] = false;


$tdatatblcollect_design[".badgeColor"] = "E67349";


$tdatatblcollect_design[".allSearchFields"] = array();
$tdatatblcollect_design[".filterFields"] = array();
$tdatatblcollect_design[".requiredSearchFields"] = array();

$tdatatblcollect_design[".googleLikeFields"] = array();
$tdatatblcollect_design[".googleLikeFields"][] = "DesignCode";
$tdatatblcollect_design[".googleLikeFields"][] = "DesignName";



$tdatatblcollect_design[".tableType"] = "list";

$tdatatblcollect_design[".printerPageOrientation"] = 0;
$tdatatblcollect_design[".nPrinterPageScale"] = 100;

$tdatatblcollect_design[".nPrinterSplitRecords"] = 40;

$tdatatblcollect_design[".geocodingEnabled"] = false;










$tdatatblcollect_design[".pageSize"] = 20;

$tdatatblcollect_design[".warnLeavingPages"] = true;



$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatatblcollect_design[".strOrderBy"] = $tstrOrderBy;

$tdatatblcollect_design[".orderindexes"] = array();

$tdatatblcollect_design[".sqlHead"] = "SELECT DesignCode,  	DesignName";
$tdatatblcollect_design[".sqlFrom"] = "FROM tblcollect_design";
$tdatatblcollect_design[".sqlWhereExpr"] = "";
$tdatatblcollect_design[".sqlTail"] = "";










//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatatblcollect_design[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatatblcollect_design[".arrGroupsPerPage"] = $arrGPP;

$tdatatblcollect_design[".highlightSearchResults"] = true;

$tableKeystblcollect_design = array();
$tableKeystblcollect_design[] = "DesignCode";
$tdatatblcollect_design[".Keys"] = $tableKeystblcollect_design;


$tdatatblcollect_design[".hideMobileList"] = array();




//	DesignCode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "DesignCode";
	$fdata["GoodName"] = "DesignCode";
	$fdata["ownerTable"] = "tblcollect_design";
	$fdata["Label"] = GetFieldLabel("tblcollect_design","DesignCode");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "DesignCode";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "DesignCode";

	
	
				$fdata["UploadFolder"] = "files";

//  Begin View Formats
	$fdata["ViewFormats"] = array();

	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Text field");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
			$edata["HTML5InuptType"] = "text";

		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=2";

		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = false;




// the field's search options settings
		$fdata["defaultSearchOption"] = "Contains";

			// the default search options list
				$fdata["searchOptionsList"] = array("Contains", "Equals", "Starts with", "More than", "Less than", "Between", "Empty", NOT_EMPTY);
// the end of search options settings


//Filters settings
	$fdata["filterTotals"] = 0;
		$fdata["filterMultiSelect"] = 0;
			$fdata["filterFormat"] = "Values list";
		$fdata["showCollapsed"] = false;

		$fdata["sortValueType"] = 0;
		$fdata["numberOfVisibleItems"] = 10;

		$fdata["filterBy"] = 0;

	

	
	
//end of Filters settings


	$tdatatblcollect_design["DesignCode"] = $fdata;
		$tdatatblcollect_design[".searchableFields"][] = "DesignCode";
//	DesignName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "DesignName";
	$fdata["GoodName"] = "DesignName";
	$fdata["ownerTable"] = "tblcollect_design";
	$fdata["Label"] = GetFieldLabel("tblcollect_design","DesignName");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "DesignName";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "DesignName";

	
	
				$fdata["UploadFolder"] = "files";

//  Begin View Formats
	$fdata["ViewFormats"] = array();

	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Text field");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
			$edata["HTML5InuptType"] = "text";

		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=100";

		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = false;




// the field's search options settings
		$fdata["defaultSearchOption"] = "Contains";

			// the default search options list
				$fdata["searchOptionsList"] = array("Contains", "Equals", "Starts with", "More than", "Less than", "Between", "Empty", NOT_EMPTY);
// the end of search options settings


//Filters settings
	$fdata["filterTotals"] = 0;
		$fdata["filterMultiSelect"] = 0;
			$fdata["filterFormat"] = "Values list";
		$fdata["showCollapsed"] = false;

		$fdata["sortValueType"] = 0;
		$fdata["numberOfVisibleItems"] = 10;

		$fdata["filterBy"] = 0;

	

	
	
//end of Filters settings


	$tdatatblcollect_design["DesignName"] = $fdata;
		$tdatatblcollect_design[".searchableFields"][] = "DesignName";


$tables_data["tblcollect_design"]=&$tdatatblcollect_design;
$field_labels["tblcollect_design"] = &$fieldLabelstblcollect_design;
$fieldToolTips["tblcollect_design"] = &$fieldToolTipstblcollect_design;
$placeHolders["tblcollect_design"] = &$placeHolderstblcollect_design;
$page_titles["tblcollect_design"] = &$pageTitlestblcollect_design;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["tblcollect_design"] = array();

// tables which are master tables for current table (detail)
$masterTablesData["tblcollect_design"] = array();



// -----------------end  prepare master-details data arrays ------------------------------//


require_once(getabspath("classes/sql.php"));










function createSqlQuery_tblcollect_design()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "DesignCode,  	DesignName";
$proto0["m_strFrom"] = "FROM tblcollect_design";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
	
		;
			$proto0["cipherer"] = null;
$proto2=array();
$proto2["m_sql"] = "";
$proto2["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto2["m_column"]=$obj;
$proto2["m_contained"] = array();
$proto2["m_strCase"] = "";
$proto2["m_havingmode"] = false;
$proto2["m_inBrackets"] = false;
$proto2["m_useAlias"] = false;
$obj = new SQLLogicalExpr($proto2);

$proto0["m_where"] = $obj;
$proto4=array();
$proto4["m_sql"] = "";
$proto4["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto4["m_column"]=$obj;
$proto4["m_contained"] = array();
$proto4["m_strCase"] = "";
$proto4["m_havingmode"] = false;
$proto4["m_inBrackets"] = false;
$proto4["m_useAlias"] = false;
$obj = new SQLLogicalExpr($proto4);

$proto0["m_having"] = $obj;
$proto0["m_fieldlist"] = array();
						$proto6=array();
			$obj = new SQLField(array(
	"m_strName" => "DesignCode",
	"m_strTable" => "tblcollect_design",
	"m_srcTableName" => "tblcollect_design"
));

$proto6["m_sql"] = "DesignCode";
$proto6["m_srcTableName"] = "tblcollect_design";
$proto6["m_expr"]=$obj;
$proto6["m_alias"] = "";
$obj = new SQLFieldListItem($proto6);

$proto0["m_fieldlist"][]=$obj;
						$proto8=array();
			$obj = new SQLField(array(
	"m_strName" => "DesignName",
	"m_strTable" => "tblcollect_design",
	"m_srcTableName" => "tblcollect_design"
));

$proto8["m_sql"] = "DesignName";
$proto8["m_srcTableName"] = "tblcollect_design";
$proto8["m_expr"]=$obj;
$proto8["m_alias"] = "";
$obj = new SQLFieldListItem($proto8);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto10=array();
$proto10["m_link"] = "SQLL_MAIN";
			$proto11=array();
$proto11["m_strName"] = "tblcollect_design";
$proto11["m_srcTableName"] = "tblcollect_design";
$proto11["m_columns"] = array();
$proto11["m_columns"][] = "DesignCode";
$proto11["m_columns"][] = "DesignName";
$obj = new SQLTable($proto11);

$proto10["m_table"] = $obj;
$proto10["m_sql"] = "tblcollect_design";
$proto10["m_alias"] = "";
$proto10["m_srcTableName"] = "tblcollect_design";
$proto12=array();
$proto12["m_sql"] = "";
$proto12["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto12["m_column"]=$obj;
$proto12["m_contained"] = array();
$proto12["m_strCase"] = "";
$proto12["m_havingmode"] = false;
$proto12["m_inBrackets"] = false;
$proto12["m_useAlias"] = false;
$obj = new SQLLogicalExpr($proto12);

$proto10["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto10);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$proto0["m_srcTableName"]="tblcollect_design";		
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_tblcollect_design = createSqlQuery_tblcollect_design();


	
		;

		

$tdatatblcollect_design[".sqlquery"] = $queryData_tblcollect_design;

$tableEvents["tblcollect_design"] = new eventsBase;
$tdatatblcollect_design[".hasEvents"] = false;

?>