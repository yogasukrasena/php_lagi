<?php



$tdatatblcollect_color = array();
$tdatatblcollect_color[".searchableFields"] = array();
$tdatatblcollect_color[".ShortName"] = "tblcollect_color";
$tdatatblcollect_color[".OwnerID"] = "";
$tdatatblcollect_color[".OriginalTable"] = "tblcollect_color";


$defaultPages = my_json_decode( "{}" );

$tdatatblcollect_color[".pagesByType"] = my_json_decode( "{}" );
$tdatatblcollect_color[".pages"] = types2pages( my_json_decode( "{}" ) );
$tdatatblcollect_color[".defaultPages"] = $defaultPages;

//	field labels
$fieldLabelstblcollect_color = array();
$fieldToolTipstblcollect_color = array();
$pageTitlestblcollect_color = array();
$placeHolderstblcollect_color = array();

if(mlang_getcurrentlang()=="English")
{
	$fieldLabelstblcollect_color["English"] = array();
	$fieldToolTipstblcollect_color["English"] = array();
	$placeHolderstblcollect_color["English"] = array();
	$pageTitlestblcollect_color["English"] = array();
	$fieldLabelstblcollect_color["English"]["ColorCode"] = "Color Code";
	$fieldToolTipstblcollect_color["English"]["ColorCode"] = "";
	$placeHolderstblcollect_color["English"]["ColorCode"] = "";
	$fieldLabelstblcollect_color["English"]["ColorName"] = "Color Name";
	$fieldToolTipstblcollect_color["English"]["ColorName"] = "";
	$placeHolderstblcollect_color["English"]["ColorName"] = "";
	if (count($fieldToolTipstblcollect_color["English"]))
		$tdatatblcollect_color[".isUseToolTips"] = true;
}


	$tdatatblcollect_color[".NCSearch"] = true;



$tdatatblcollect_color[".shortTableName"] = "tblcollect_color";
$tdatatblcollect_color[".nSecOptions"] = 0;

$tdatatblcollect_color[".mainTableOwnerID"] = "";
$tdatatblcollect_color[".entityType"] = 0;

$tdatatblcollect_color[".strOriginalTableName"] = "tblcollect_color";

	



$tdatatblcollect_color[".showAddInPopup"] = false;

$tdatatblcollect_color[".showEditInPopup"] = false;

$tdatatblcollect_color[".showViewInPopup"] = false;

//page's base css files names
$popupPagesLayoutNames = array();
$tdatatblcollect_color[".popupPagesLayoutNames"] = $popupPagesLayoutNames;


$tdatatblcollect_color[".listAjax"] = false;
//	temporary
$tdatatblcollect_color[".listAjax"] = false;

	$tdatatblcollect_color[".audit"] = false;

	$tdatatblcollect_color[".locking"] = false;


$pages = $tdatatblcollect_color[".defaultPages"];

if( $pages[PAGE_EDIT] ) {
	$tdatatblcollect_color[".edit"] = true;
	$tdatatblcollect_color[".afterEditAction"] = 1;
	$tdatatblcollect_color[".closePopupAfterEdit"] = 1;
	$tdatatblcollect_color[".afterEditActionDetTable"] = "";
}

if( $pages[PAGE_ADD] ) {
$tdatatblcollect_color[".add"] = true;
$tdatatblcollect_color[".afterAddAction"] = 1;
$tdatatblcollect_color[".closePopupAfterAdd"] = 1;
$tdatatblcollect_color[".afterAddActionDetTable"] = "";
}

if( $pages[PAGE_LIST] ) {
	$tdatatblcollect_color[".list"] = true;
}



$tdatatblcollect_color[".strSortControlSettingsJSON"] = "";




if( $pages[PAGE_VIEW] ) {
$tdatatblcollect_color[".view"] = true;
}

if( $pages[PAGE_IMPORT] ) {
$tdatatblcollect_color[".import"] = true;
}

if( $pages[PAGE_EXPORT] ) {
$tdatatblcollect_color[".exportTo"] = true;
}

if( $pages[PAGE_PRINT] ) {
$tdatatblcollect_color[".printFriendly"] = true;
}



$tdatatblcollect_color[".showSimpleSearchOptions"] = true; // temp fix #13449

// Allow Show/Hide Fields in GRID
$tdatatblcollect_color[".allowShowHideFields"] = true; // temp fix #13449
//

// Allow Fields Reordering in GRID
$tdatatblcollect_color[".allowFieldsReordering"] = true; // temp fix #13449
//

$tdatatblcollect_color[".isUseAjaxSuggest"] = true;

$tdatatblcollect_color[".rowHighlite"] = true;





$tdatatblcollect_color[".ajaxCodeSnippetAdded"] = false;

$tdatatblcollect_color[".buttonsAdded"] = false;

$tdatatblcollect_color[".addPageEvents"] = false;

// use timepicker for search panel
$tdatatblcollect_color[".isUseTimeForSearch"] = false;


$tdatatblcollect_color[".badgeColor"] = "2F4F4F";


$tdatatblcollect_color[".allSearchFields"] = array();
$tdatatblcollect_color[".filterFields"] = array();
$tdatatblcollect_color[".requiredSearchFields"] = array();

$tdatatblcollect_color[".googleLikeFields"] = array();
$tdatatblcollect_color[".googleLikeFields"][] = "ColorCode";
$tdatatblcollect_color[".googleLikeFields"][] = "ColorName";



$tdatatblcollect_color[".tableType"] = "list";

$tdatatblcollect_color[".printerPageOrientation"] = 0;
$tdatatblcollect_color[".nPrinterPageScale"] = 100;

$tdatatblcollect_color[".nPrinterSplitRecords"] = 40;

$tdatatblcollect_color[".geocodingEnabled"] = false;










$tdatatblcollect_color[".pageSize"] = 20;

$tdatatblcollect_color[".warnLeavingPages"] = true;



$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatatblcollect_color[".strOrderBy"] = $tstrOrderBy;

$tdatatblcollect_color[".orderindexes"] = array();

$tdatatblcollect_color[".sqlHead"] = "SELECT ColorCode,  	ColorName";
$tdatatblcollect_color[".sqlFrom"] = "FROM tblcollect_color";
$tdatatblcollect_color[".sqlWhereExpr"] = "";
$tdatatblcollect_color[".sqlTail"] = "";










//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatatblcollect_color[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatatblcollect_color[".arrGroupsPerPage"] = $arrGPP;

$tdatatblcollect_color[".highlightSearchResults"] = true;

$tableKeystblcollect_color = array();
$tableKeystblcollect_color[] = "ColorCode";
$tdatatblcollect_color[".Keys"] = $tableKeystblcollect_color;


$tdatatblcollect_color[".hideMobileList"] = array();




//	ColorCode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "ColorCode";
	$fdata["GoodName"] = "ColorCode";
	$fdata["ownerTable"] = "tblcollect_color";
	$fdata["Label"] = GetFieldLabel("tblcollect_color","ColorCode");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "ColorCode";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "ColorCode";

	
	
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


	$tdatatblcollect_color["ColorCode"] = $fdata;
		$tdatatblcollect_color[".searchableFields"][] = "ColorCode";
//	ColorName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "ColorName";
	$fdata["GoodName"] = "ColorName";
	$fdata["ownerTable"] = "tblcollect_color";
	$fdata["Label"] = GetFieldLabel("tblcollect_color","ColorName");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "ColorName";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "ColorName";

	
	
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


	$tdatatblcollect_color["ColorName"] = $fdata;
		$tdatatblcollect_color[".searchableFields"][] = "ColorName";


$tables_data["tblcollect_color"]=&$tdatatblcollect_color;
$field_labels["tblcollect_color"] = &$fieldLabelstblcollect_color;
$fieldToolTips["tblcollect_color"] = &$fieldToolTipstblcollect_color;
$placeHolders["tblcollect_color"] = &$placeHolderstblcollect_color;
$page_titles["tblcollect_color"] = &$pageTitlestblcollect_color;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["tblcollect_color"] = array();

// tables which are master tables for current table (detail)
$masterTablesData["tblcollect_color"] = array();



// -----------------end  prepare master-details data arrays ------------------------------//


require_once(getabspath("classes/sql.php"));










function createSqlQuery_tblcollect_color()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "ColorCode,  	ColorName";
$proto0["m_strFrom"] = "FROM tblcollect_color";
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
	"m_strName" => "ColorCode",
	"m_strTable" => "tblcollect_color",
	"m_srcTableName" => "tblcollect_color"
));

$proto6["m_sql"] = "ColorCode";
$proto6["m_srcTableName"] = "tblcollect_color";
$proto6["m_expr"]=$obj;
$proto6["m_alias"] = "";
$obj = new SQLFieldListItem($proto6);

$proto0["m_fieldlist"][]=$obj;
						$proto8=array();
			$obj = new SQLField(array(
	"m_strName" => "ColorName",
	"m_strTable" => "tblcollect_color",
	"m_srcTableName" => "tblcollect_color"
));

$proto8["m_sql"] = "ColorName";
$proto8["m_srcTableName"] = "tblcollect_color";
$proto8["m_expr"]=$obj;
$proto8["m_alias"] = "";
$obj = new SQLFieldListItem($proto8);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto10=array();
$proto10["m_link"] = "SQLL_MAIN";
			$proto11=array();
$proto11["m_strName"] = "tblcollect_color";
$proto11["m_srcTableName"] = "tblcollect_color";
$proto11["m_columns"] = array();
$proto11["m_columns"][] = "ColorCode";
$proto11["m_columns"][] = "ColorName";
$obj = new SQLTable($proto11);

$proto10["m_table"] = $obj;
$proto10["m_sql"] = "tblcollect_color";
$proto10["m_alias"] = "";
$proto10["m_srcTableName"] = "tblcollect_color";
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
$proto0["m_srcTableName"]="tblcollect_color";		
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_tblcollect_color = createSqlQuery_tblcollect_color();


	
		;

		

$tdatatblcollect_color[".sqlquery"] = $queryData_tblcollect_color;

$tableEvents["tblcollect_color"] = new eventsBase;
$tdatatblcollect_color[".hasEvents"] = false;

?>