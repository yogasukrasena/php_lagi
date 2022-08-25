<?php



$tdatatblcollect_name = array();
$tdatatblcollect_name[".searchableFields"] = array();
$tdatatblcollect_name[".ShortName"] = "tblcollect_name";
$tdatatblcollect_name[".OwnerID"] = "";
$tdatatblcollect_name[".OriginalTable"] = "tblcollect_name";


$defaultPages = my_json_decode( "{}" );

$tdatatblcollect_name[".pagesByType"] = my_json_decode( "{}" );
$tdatatblcollect_name[".pages"] = types2pages( my_json_decode( "{}" ) );
$tdatatblcollect_name[".defaultPages"] = $defaultPages;

//	field labels
$fieldLabelstblcollect_name = array();
$fieldToolTipstblcollect_name = array();
$pageTitlestblcollect_name = array();
$placeHolderstblcollect_name = array();

if(mlang_getcurrentlang()=="English")
{
	$fieldLabelstblcollect_name["English"] = array();
	$fieldToolTipstblcollect_name["English"] = array();
	$placeHolderstblcollect_name["English"] = array();
	$pageTitlestblcollect_name["English"] = array();
	$fieldLabelstblcollect_name["English"]["NameCode"] = "Name Code";
	$fieldToolTipstblcollect_name["English"]["NameCode"] = "";
	$placeHolderstblcollect_name["English"]["NameCode"] = "";
	$fieldLabelstblcollect_name["English"]["NameDesc"] = "Name Desc";
	$fieldToolTipstblcollect_name["English"]["NameDesc"] = "";
	$placeHolderstblcollect_name["English"]["NameDesc"] = "";
	if (count($fieldToolTipstblcollect_name["English"]))
		$tdatatblcollect_name[".isUseToolTips"] = true;
}


	$tdatatblcollect_name[".NCSearch"] = true;



$tdatatblcollect_name[".shortTableName"] = "tblcollect_name";
$tdatatblcollect_name[".nSecOptions"] = 0;

$tdatatblcollect_name[".mainTableOwnerID"] = "";
$tdatatblcollect_name[".entityType"] = 0;

$tdatatblcollect_name[".strOriginalTableName"] = "tblcollect_name";

	



$tdatatblcollect_name[".showAddInPopup"] = false;

$tdatatblcollect_name[".showEditInPopup"] = false;

$tdatatblcollect_name[".showViewInPopup"] = false;

//page's base css files names
$popupPagesLayoutNames = array();
$tdatatblcollect_name[".popupPagesLayoutNames"] = $popupPagesLayoutNames;


$tdatatblcollect_name[".listAjax"] = false;
//	temporary
$tdatatblcollect_name[".listAjax"] = false;

	$tdatatblcollect_name[".audit"] = false;

	$tdatatblcollect_name[".locking"] = false;


$pages = $tdatatblcollect_name[".defaultPages"];

if( $pages[PAGE_EDIT] ) {
	$tdatatblcollect_name[".edit"] = true;
	$tdatatblcollect_name[".afterEditAction"] = 1;
	$tdatatblcollect_name[".closePopupAfterEdit"] = 1;
	$tdatatblcollect_name[".afterEditActionDetTable"] = "";
}

if( $pages[PAGE_ADD] ) {
$tdatatblcollect_name[".add"] = true;
$tdatatblcollect_name[".afterAddAction"] = 1;
$tdatatblcollect_name[".closePopupAfterAdd"] = 1;
$tdatatblcollect_name[".afterAddActionDetTable"] = "";
}

if( $pages[PAGE_LIST] ) {
	$tdatatblcollect_name[".list"] = true;
}



$tdatatblcollect_name[".strSortControlSettingsJSON"] = "";




if( $pages[PAGE_VIEW] ) {
$tdatatblcollect_name[".view"] = true;
}

if( $pages[PAGE_IMPORT] ) {
$tdatatblcollect_name[".import"] = true;
}

if( $pages[PAGE_EXPORT] ) {
$tdatatblcollect_name[".exportTo"] = true;
}

if( $pages[PAGE_PRINT] ) {
$tdatatblcollect_name[".printFriendly"] = true;
}



$tdatatblcollect_name[".showSimpleSearchOptions"] = true; // temp fix #13449

// Allow Show/Hide Fields in GRID
$tdatatblcollect_name[".allowShowHideFields"] = true; // temp fix #13449
//

// Allow Fields Reordering in GRID
$tdatatblcollect_name[".allowFieldsReordering"] = true; // temp fix #13449
//

$tdatatblcollect_name[".isUseAjaxSuggest"] = true;

$tdatatblcollect_name[".rowHighlite"] = true;





$tdatatblcollect_name[".ajaxCodeSnippetAdded"] = false;

$tdatatblcollect_name[".buttonsAdded"] = false;

$tdatatblcollect_name[".addPageEvents"] = false;

// use timepicker for search panel
$tdatatblcollect_name[".isUseTimeForSearch"] = false;


$tdatatblcollect_name[".badgeColor"] = "CD853F";


$tdatatblcollect_name[".allSearchFields"] = array();
$tdatatblcollect_name[".filterFields"] = array();
$tdatatblcollect_name[".requiredSearchFields"] = array();

$tdatatblcollect_name[".googleLikeFields"] = array();
$tdatatblcollect_name[".googleLikeFields"][] = "NameCode";
$tdatatblcollect_name[".googleLikeFields"][] = "NameDesc";



$tdatatblcollect_name[".tableType"] = "list";

$tdatatblcollect_name[".printerPageOrientation"] = 0;
$tdatatblcollect_name[".nPrinterPageScale"] = 100;

$tdatatblcollect_name[".nPrinterSplitRecords"] = 40;

$tdatatblcollect_name[".geocodingEnabled"] = false;










$tdatatblcollect_name[".pageSize"] = 20;

$tdatatblcollect_name[".warnLeavingPages"] = true;



$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatatblcollect_name[".strOrderBy"] = $tstrOrderBy;

$tdatatblcollect_name[".orderindexes"] = array();

$tdatatblcollect_name[".sqlHead"] = "SELECT NameCode,  	NameDesc";
$tdatatblcollect_name[".sqlFrom"] = "FROM tblcollect_name";
$tdatatblcollect_name[".sqlWhereExpr"] = "";
$tdatatblcollect_name[".sqlTail"] = "";










//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatatblcollect_name[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatatblcollect_name[".arrGroupsPerPage"] = $arrGPP;

$tdatatblcollect_name[".highlightSearchResults"] = true;

$tableKeystblcollect_name = array();
$tableKeystblcollect_name[] = "NameCode";
$tdatatblcollect_name[".Keys"] = $tableKeystblcollect_name;


$tdatatblcollect_name[".hideMobileList"] = array();




//	NameCode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "NameCode";
	$fdata["GoodName"] = "NameCode";
	$fdata["ownerTable"] = "tblcollect_name";
	$fdata["Label"] = GetFieldLabel("tblcollect_name","NameCode");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "NameCode";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "NameCode";

	
	
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


	$tdatatblcollect_name["NameCode"] = $fdata;
		$tdatatblcollect_name[".searchableFields"][] = "NameCode";
//	NameDesc
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "NameDesc";
	$fdata["GoodName"] = "NameDesc";
	$fdata["ownerTable"] = "tblcollect_name";
	$fdata["Label"] = GetFieldLabel("tblcollect_name","NameDesc");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "NameDesc";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "NameDesc";

	
	
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
			$edata["EditParams"].= " maxlength=50";

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


	$tdatatblcollect_name["NameDesc"] = $fdata;
		$tdatatblcollect_name[".searchableFields"][] = "NameDesc";


$tables_data["tblcollect_name"]=&$tdatatblcollect_name;
$field_labels["tblcollect_name"] = &$fieldLabelstblcollect_name;
$fieldToolTips["tblcollect_name"] = &$fieldToolTipstblcollect_name;
$placeHolders["tblcollect_name"] = &$placeHolderstblcollect_name;
$page_titles["tblcollect_name"] = &$pageTitlestblcollect_name;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["tblcollect_name"] = array();

// tables which are master tables for current table (detail)
$masterTablesData["tblcollect_name"] = array();



// -----------------end  prepare master-details data arrays ------------------------------//


require_once(getabspath("classes/sql.php"));










function createSqlQuery_tblcollect_name()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "NameCode,  	NameDesc";
$proto0["m_strFrom"] = "FROM tblcollect_name";
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
	"m_strName" => "NameCode",
	"m_strTable" => "tblcollect_name",
	"m_srcTableName" => "tblcollect_name"
));

$proto6["m_sql"] = "NameCode";
$proto6["m_srcTableName"] = "tblcollect_name";
$proto6["m_expr"]=$obj;
$proto6["m_alias"] = "";
$obj = new SQLFieldListItem($proto6);

$proto0["m_fieldlist"][]=$obj;
						$proto8=array();
			$obj = new SQLField(array(
	"m_strName" => "NameDesc",
	"m_strTable" => "tblcollect_name",
	"m_srcTableName" => "tblcollect_name"
));

$proto8["m_sql"] = "NameDesc";
$proto8["m_srcTableName"] = "tblcollect_name";
$proto8["m_expr"]=$obj;
$proto8["m_alias"] = "";
$obj = new SQLFieldListItem($proto8);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto10=array();
$proto10["m_link"] = "SQLL_MAIN";
			$proto11=array();
$proto11["m_strName"] = "tblcollect_name";
$proto11["m_srcTableName"] = "tblcollect_name";
$proto11["m_columns"] = array();
$proto11["m_columns"][] = "NameCode";
$proto11["m_columns"][] = "NameDesc";
$obj = new SQLTable($proto11);

$proto10["m_table"] = $obj;
$proto10["m_sql"] = "tblcollect_name";
$proto10["m_alias"] = "";
$proto10["m_srcTableName"] = "tblcollect_name";
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
$proto0["m_srcTableName"]="tblcollect_name";		
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_tblcollect_name = createSqlQuery_tblcollect_name();


	
		;

		

$tdatatblcollect_name[".sqlquery"] = $queryData_tblcollect_name;

$tableEvents["tblcollect_name"] = new eventsBase;
$tdatatblcollect_name[".hasEvents"] = false;

?>