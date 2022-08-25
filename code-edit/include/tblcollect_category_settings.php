<?php



$tdatatblcollect_category = array();
$tdatatblcollect_category[".searchableFields"] = array();
$tdatatblcollect_category[".ShortName"] = "tblcollect_category";
$tdatatblcollect_category[".OwnerID"] = "";
$tdatatblcollect_category[".OriginalTable"] = "tblcollect_category";


$defaultPages = my_json_decode( "{}" );

$tdatatblcollect_category[".pagesByType"] = my_json_decode( "{}" );
$tdatatblcollect_category[".pages"] = types2pages( my_json_decode( "{}" ) );
$tdatatblcollect_category[".defaultPages"] = $defaultPages;

//	field labels
$fieldLabelstblcollect_category = array();
$fieldToolTipstblcollect_category = array();
$pageTitlestblcollect_category = array();
$placeHolderstblcollect_category = array();

if(mlang_getcurrentlang()=="English")
{
	$fieldLabelstblcollect_category["English"] = array();
	$fieldToolTipstblcollect_category["English"] = array();
	$placeHolderstblcollect_category["English"] = array();
	$pageTitlestblcollect_category["English"] = array();
	$fieldLabelstblcollect_category["English"]["CategoryCode"] = "Category Code";
	$fieldToolTipstblcollect_category["English"]["CategoryCode"] = "";
	$placeHolderstblcollect_category["English"]["CategoryCode"] = "";
	$fieldLabelstblcollect_category["English"]["CategoryName"] = "Category Name";
	$fieldToolTipstblcollect_category["English"]["CategoryName"] = "";
	$placeHolderstblcollect_category["English"]["CategoryName"] = "";
	if (count($fieldToolTipstblcollect_category["English"]))
		$tdatatblcollect_category[".isUseToolTips"] = true;
}


	$tdatatblcollect_category[".NCSearch"] = true;



$tdatatblcollect_category[".shortTableName"] = "tblcollect_category";
$tdatatblcollect_category[".nSecOptions"] = 0;

$tdatatblcollect_category[".mainTableOwnerID"] = "";
$tdatatblcollect_category[".entityType"] = 0;

$tdatatblcollect_category[".strOriginalTableName"] = "tblcollect_category";

	



$tdatatblcollect_category[".showAddInPopup"] = false;

$tdatatblcollect_category[".showEditInPopup"] = false;

$tdatatblcollect_category[".showViewInPopup"] = false;

//page's base css files names
$popupPagesLayoutNames = array();
$tdatatblcollect_category[".popupPagesLayoutNames"] = $popupPagesLayoutNames;


$tdatatblcollect_category[".listAjax"] = false;
//	temporary
$tdatatblcollect_category[".listAjax"] = false;

	$tdatatblcollect_category[".audit"] = false;

	$tdatatblcollect_category[".locking"] = false;


$pages = $tdatatblcollect_category[".defaultPages"];

if( $pages[PAGE_EDIT] ) {
	$tdatatblcollect_category[".edit"] = true;
	$tdatatblcollect_category[".afterEditAction"] = 1;
	$tdatatblcollect_category[".closePopupAfterEdit"] = 1;
	$tdatatblcollect_category[".afterEditActionDetTable"] = "";
}

if( $pages[PAGE_ADD] ) {
$tdatatblcollect_category[".add"] = true;
$tdatatblcollect_category[".afterAddAction"] = 1;
$tdatatblcollect_category[".closePopupAfterAdd"] = 1;
$tdatatblcollect_category[".afterAddActionDetTable"] = "";
}

if( $pages[PAGE_LIST] ) {
	$tdatatblcollect_category[".list"] = true;
}



$tdatatblcollect_category[".strSortControlSettingsJSON"] = "";




if( $pages[PAGE_VIEW] ) {
$tdatatblcollect_category[".view"] = true;
}

if( $pages[PAGE_IMPORT] ) {
$tdatatblcollect_category[".import"] = true;
}

if( $pages[PAGE_EXPORT] ) {
$tdatatblcollect_category[".exportTo"] = true;
}

if( $pages[PAGE_PRINT] ) {
$tdatatblcollect_category[".printFriendly"] = true;
}



$tdatatblcollect_category[".showSimpleSearchOptions"] = true; // temp fix #13449

// Allow Show/Hide Fields in GRID
$tdatatblcollect_category[".allowShowHideFields"] = true; // temp fix #13449
//

// Allow Fields Reordering in GRID
$tdatatblcollect_category[".allowFieldsReordering"] = true; // temp fix #13449
//

$tdatatblcollect_category[".isUseAjaxSuggest"] = true;

$tdatatblcollect_category[".rowHighlite"] = true;





$tdatatblcollect_category[".ajaxCodeSnippetAdded"] = false;

$tdatatblcollect_category[".buttonsAdded"] = false;

$tdatatblcollect_category[".addPageEvents"] = false;

// use timepicker for search panel
$tdatatblcollect_category[".isUseTimeForSearch"] = false;


$tdatatblcollect_category[".badgeColor"] = "D2691E";


$tdatatblcollect_category[".allSearchFields"] = array();
$tdatatblcollect_category[".filterFields"] = array();
$tdatatblcollect_category[".requiredSearchFields"] = array();

$tdatatblcollect_category[".googleLikeFields"] = array();
$tdatatblcollect_category[".googleLikeFields"][] = "CategoryCode";
$tdatatblcollect_category[".googleLikeFields"][] = "CategoryName";



$tdatatblcollect_category[".tableType"] = "list";

$tdatatblcollect_category[".printerPageOrientation"] = 0;
$tdatatblcollect_category[".nPrinterPageScale"] = 100;

$tdatatblcollect_category[".nPrinterSplitRecords"] = 40;

$tdatatblcollect_category[".geocodingEnabled"] = false;










$tdatatblcollect_category[".pageSize"] = 20;

$tdatatblcollect_category[".warnLeavingPages"] = true;



$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatatblcollect_category[".strOrderBy"] = $tstrOrderBy;

$tdatatblcollect_category[".orderindexes"] = array();

$tdatatblcollect_category[".sqlHead"] = "SELECT CategoryCode,  	CategoryName";
$tdatatblcollect_category[".sqlFrom"] = "FROM tblcollect_category";
$tdatatblcollect_category[".sqlWhereExpr"] = "";
$tdatatblcollect_category[".sqlTail"] = "";










//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatatblcollect_category[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatatblcollect_category[".arrGroupsPerPage"] = $arrGPP;

$tdatatblcollect_category[".highlightSearchResults"] = true;

$tableKeystblcollect_category = array();
$tableKeystblcollect_category[] = "CategoryCode";
$tdatatblcollect_category[".Keys"] = $tableKeystblcollect_category;


$tdatatblcollect_category[".hideMobileList"] = array();




//	CategoryCode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "CategoryCode";
	$fdata["GoodName"] = "CategoryCode";
	$fdata["ownerTable"] = "tblcollect_category";
	$fdata["Label"] = GetFieldLabel("tblcollect_category","CategoryCode");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "CategoryCode";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "CategoryCode";

	
	
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


	$tdatatblcollect_category["CategoryCode"] = $fdata;
		$tdatatblcollect_category[".searchableFields"][] = "CategoryCode";
//	CategoryName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "CategoryName";
	$fdata["GoodName"] = "CategoryName";
	$fdata["ownerTable"] = "tblcollect_category";
	$fdata["Label"] = GetFieldLabel("tblcollect_category","CategoryName");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "CategoryName";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "CategoryName";

	
	
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


	$tdatatblcollect_category["CategoryName"] = $fdata;
		$tdatatblcollect_category[".searchableFields"][] = "CategoryName";


$tables_data["tblcollect_category"]=&$tdatatblcollect_category;
$field_labels["tblcollect_category"] = &$fieldLabelstblcollect_category;
$fieldToolTips["tblcollect_category"] = &$fieldToolTipstblcollect_category;
$placeHolders["tblcollect_category"] = &$placeHolderstblcollect_category;
$page_titles["tblcollect_category"] = &$pageTitlestblcollect_category;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["tblcollect_category"] = array();

// tables which are master tables for current table (detail)
$masterTablesData["tblcollect_category"] = array();



// -----------------end  prepare master-details data arrays ------------------------------//


require_once(getabspath("classes/sql.php"));










function createSqlQuery_tblcollect_category()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "CategoryCode,  	CategoryName";
$proto0["m_strFrom"] = "FROM tblcollect_category";
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
	"m_strName" => "CategoryCode",
	"m_strTable" => "tblcollect_category",
	"m_srcTableName" => "tblcollect_category"
));

$proto6["m_sql"] = "CategoryCode";
$proto6["m_srcTableName"] = "tblcollect_category";
$proto6["m_expr"]=$obj;
$proto6["m_alias"] = "";
$obj = new SQLFieldListItem($proto6);

$proto0["m_fieldlist"][]=$obj;
						$proto8=array();
			$obj = new SQLField(array(
	"m_strName" => "CategoryName",
	"m_strTable" => "tblcollect_category",
	"m_srcTableName" => "tblcollect_category"
));

$proto8["m_sql"] = "CategoryName";
$proto8["m_srcTableName"] = "tblcollect_category";
$proto8["m_expr"]=$obj;
$proto8["m_alias"] = "";
$obj = new SQLFieldListItem($proto8);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto10=array();
$proto10["m_link"] = "SQLL_MAIN";
			$proto11=array();
$proto11["m_strName"] = "tblcollect_category";
$proto11["m_srcTableName"] = "tblcollect_category";
$proto11["m_columns"] = array();
$proto11["m_columns"][] = "CategoryCode";
$proto11["m_columns"][] = "CategoryName";
$obj = new SQLTable($proto11);

$proto10["m_table"] = $obj;
$proto10["m_sql"] = "tblcollect_category";
$proto10["m_alias"] = "";
$proto10["m_srcTableName"] = "tblcollect_category";
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
$proto0["m_srcTableName"]="tblcollect_category";		
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_tblcollect_category = createSqlQuery_tblcollect_category();


	
		;

		

$tdatatblcollect_category[".sqlquery"] = $queryData_tblcollect_category;

$tableEvents["tblcollect_category"] = new eventsBase;
$tdatatblcollect_category[".hasEvents"] = false;

?>