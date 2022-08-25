<?php



$tdatatbluser = array();
$tdatatbluser[".searchableFields"] = array();
$tdatatbluser[".ShortName"] = "tbluser";
$tdatatbluser[".OwnerID"] = "";
$tdatatbluser[".OriginalTable"] = "tbluser";


$defaultPages = my_json_decode( "{\"search\":\"search\"}" );

$tdatatbluser[".pagesByType"] = my_json_decode( "{\"search\":[\"search\"]}" );
$tdatatbluser[".pages"] = types2pages( my_json_decode( "{\"search\":[\"search\"]}" ) );
$tdatatbluser[".defaultPages"] = $defaultPages;

//	field labels
$fieldLabelstbluser = array();
$fieldToolTipstbluser = array();
$pageTitlestbluser = array();
$placeHolderstbluser = array();

if(mlang_getcurrentlang()=="English")
{
	$fieldLabelstbluser["English"] = array();
	$fieldToolTipstbluser["English"] = array();
	$placeHolderstbluser["English"] = array();
	$pageTitlestbluser["English"] = array();
	$fieldLabelstbluser["English"]["id"] = "Id";
	$fieldToolTipstbluser["English"]["id"] = "";
	$placeHolderstbluser["English"]["id"] = "";
	$fieldLabelstbluser["English"]["UserName"] = "User Name";
	$fieldToolTipstbluser["English"]["UserName"] = "";
	$placeHolderstbluser["English"]["UserName"] = "";
	$fieldLabelstbluser["English"]["LastName"] = "Last Name";
	$fieldToolTipstbluser["English"]["LastName"] = "";
	$placeHolderstbluser["English"]["LastName"] = "";
	$fieldLabelstbluser["English"]["FirstName"] = "First Name";
	$fieldToolTipstbluser["English"]["FirstName"] = "";
	$placeHolderstbluser["English"]["FirstName"] = "";
	$fieldLabelstbluser["English"]["Password"] = "Password";
	$fieldToolTipstbluser["English"]["Password"] = "";
	$placeHolderstbluser["English"]["Password"] = "";
	$fieldLabelstbluser["English"]["Type"] = "Type";
	$fieldToolTipstbluser["English"]["Type"] = "";
	$placeHolderstbluser["English"]["Type"] = "";
	if (count($fieldToolTipstbluser["English"]))
		$tdatatbluser[".isUseToolTips"] = true;
}


	$tdatatbluser[".NCSearch"] = true;



$tdatatbluser[".shortTableName"] = "tbluser";
$tdatatbluser[".nSecOptions"] = 0;

$tdatatbluser[".mainTableOwnerID"] = "";
$tdatatbluser[".entityType"] = 0;

$tdatatbluser[".strOriginalTableName"] = "tbluser";

	



$tdatatbluser[".showAddInPopup"] = false;

$tdatatbluser[".showEditInPopup"] = false;

$tdatatbluser[".showViewInPopup"] = false;

//page's base css files names
$popupPagesLayoutNames = array();
$tdatatbluser[".popupPagesLayoutNames"] = $popupPagesLayoutNames;


$tdatatbluser[".listAjax"] = false;
//	temporary
$tdatatbluser[".listAjax"] = false;

	$tdatatbluser[".audit"] = false;

	$tdatatbluser[".locking"] = false;


$pages = $tdatatbluser[".defaultPages"];

if( $pages[PAGE_EDIT] ) {
	$tdatatbluser[".edit"] = true;
	$tdatatbluser[".afterEditAction"] = 1;
	$tdatatbluser[".closePopupAfterEdit"] = 1;
	$tdatatbluser[".afterEditActionDetTable"] = "";
}

if( $pages[PAGE_ADD] ) {
$tdatatbluser[".add"] = true;
$tdatatbluser[".afterAddAction"] = 1;
$tdatatbluser[".closePopupAfterAdd"] = 1;
$tdatatbluser[".afterAddActionDetTable"] = "";
}

if( $pages[PAGE_LIST] ) {
	$tdatatbluser[".list"] = true;
}



$tdatatbluser[".strSortControlSettingsJSON"] = "";




if( $pages[PAGE_VIEW] ) {
$tdatatbluser[".view"] = true;
}

if( $pages[PAGE_IMPORT] ) {
$tdatatbluser[".import"] = true;
}

if( $pages[PAGE_EXPORT] ) {
$tdatatbluser[".exportTo"] = true;
}

if( $pages[PAGE_PRINT] ) {
$tdatatbluser[".printFriendly"] = true;
}



$tdatatbluser[".showSimpleSearchOptions"] = true; // temp fix #13449

// Allow Show/Hide Fields in GRID
$tdatatbluser[".allowShowHideFields"] = true; // temp fix #13449
//

// Allow Fields Reordering in GRID
$tdatatbluser[".allowFieldsReordering"] = true; // temp fix #13449
//

$tdatatbluser[".isUseAjaxSuggest"] = true;

$tdatatbluser[".rowHighlite"] = true;





$tdatatbluser[".ajaxCodeSnippetAdded"] = false;

$tdatatbluser[".buttonsAdded"] = false;

$tdatatbluser[".addPageEvents"] = false;

// use timepicker for search panel
$tdatatbluser[".isUseTimeForSearch"] = false;


$tdatatbluser[".badgeColor"] = "6DA5C8";


$tdatatbluser[".allSearchFields"] = array();
$tdatatbluser[".filterFields"] = array();
$tdatatbluser[".requiredSearchFields"] = array();

$tdatatbluser[".googleLikeFields"] = array();
$tdatatbluser[".googleLikeFields"][] = "id";
$tdatatbluser[".googleLikeFields"][] = "UserName";
$tdatatbluser[".googleLikeFields"][] = "LastName";
$tdatatbluser[".googleLikeFields"][] = "FirstName";
$tdatatbluser[".googleLikeFields"][] = "Password";
$tdatatbluser[".googleLikeFields"][] = "Type";



$tdatatbluser[".tableType"] = "list";

$tdatatbluser[".printerPageOrientation"] = 0;
$tdatatbluser[".nPrinterPageScale"] = 100;

$tdatatbluser[".nPrinterSplitRecords"] = 40;

$tdatatbluser[".geocodingEnabled"] = false;










$tdatatbluser[".pageSize"] = 20;

$tdatatbluser[".warnLeavingPages"] = true;



$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatatbluser[".strOrderBy"] = $tstrOrderBy;

$tdatatbluser[".orderindexes"] = array();

$tdatatbluser[".sqlHead"] = "SELECT id,  	UserName,  	LastName,  	FirstName,  	Password,  	`Type`";
$tdatatbluser[".sqlFrom"] = "FROM tbluser";
$tdatatbluser[".sqlWhereExpr"] = "";
$tdatatbluser[".sqlTail"] = "";










//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatatbluser[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatatbluser[".arrGroupsPerPage"] = $arrGPP;

$tdatatbluser[".highlightSearchResults"] = true;

$tableKeystbluser = array();
$tableKeystbluser[] = "id";
$tdatatbluser[".Keys"] = $tableKeystbluser;


$tdatatbluser[".hideMobileList"] = array();




//	id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "id";
	$fdata["GoodName"] = "id";
	$fdata["ownerTable"] = "tbluser";
	$fdata["Label"] = GetFieldLabel("tbluser","id");
	$fdata["FieldType"] = 3;

	
		$fdata["AutoInc"] = true;

	
			

		$fdata["strField"] = "id";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "id";

	
	
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


	
	



		$edata["IsRequired"] = true;

	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
			$edata["HTML5InuptType"] = "text";

		$edata["EditParams"] = "";
		
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
		
	
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


	$tdatatbluser["id"] = $fdata;
		$tdatatbluser[".searchableFields"][] = "id";
//	UserName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "UserName";
	$fdata["GoodName"] = "UserName";
	$fdata["ownerTable"] = "tbluser";
	$fdata["Label"] = GetFieldLabel("tbluser","UserName");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "UserName";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "UserName";

	
	
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
			$edata["EditParams"].= " maxlength=15";

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


	$tdatatbluser["UserName"] = $fdata;
		$tdatatbluser[".searchableFields"][] = "UserName";
//	LastName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "LastName";
	$fdata["GoodName"] = "LastName";
	$fdata["ownerTable"] = "tbluser";
	$fdata["Label"] = GetFieldLabel("tbluser","LastName");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "LastName";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "LastName";

	
	
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


	$tdatatbluser["LastName"] = $fdata;
		$tdatatbluser[".searchableFields"][] = "LastName";
//	FirstName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "FirstName";
	$fdata["GoodName"] = "FirstName";
	$fdata["ownerTable"] = "tbluser";
	$fdata["Label"] = GetFieldLabel("tbluser","FirstName");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "FirstName";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "FirstName";

	
	
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
			$edata["EditParams"].= " maxlength=30";

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


	$tdatatbluser["FirstName"] = $fdata;
		$tdatatbluser[".searchableFields"][] = "FirstName";
//	Password
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "Password";
	$fdata["GoodName"] = "Password";
	$fdata["ownerTable"] = "tbluser";
	$fdata["Label"] = GetFieldLabel("tbluser","Password");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "Password";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "Password";

	
	
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

	$edata = array("EditFormat" => "Password");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
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


	$tdatatbluser["Password"] = $fdata;
		$tdatatbluser[".searchableFields"][] = "Password";
//	Type
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "Type";
	$fdata["GoodName"] = "Type";
	$fdata["ownerTable"] = "tbluser";
	$fdata["Label"] = GetFieldLabel("tbluser","Type");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "Type";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "`Type`";

	
	
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
			$edata["EditParams"].= " maxlength=15";

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


	$tdatatbluser["Type"] = $fdata;
		$tdatatbluser[".searchableFields"][] = "Type";


$tables_data["tbluser"]=&$tdatatbluser;
$field_labels["tbluser"] = &$fieldLabelstbluser;
$fieldToolTips["tbluser"] = &$fieldToolTipstbluser;
$placeHolders["tbluser"] = &$placeHolderstbluser;
$page_titles["tbluser"] = &$pageTitlestbluser;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["tbluser"] = array();

// tables which are master tables for current table (detail)
$masterTablesData["tbluser"] = array();



// -----------------end  prepare master-details data arrays ------------------------------//


require_once(getabspath("classes/sql.php"));










function createSqlQuery_tbluser()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "id,  	UserName,  	LastName,  	FirstName,  	Password,  	`Type`";
$proto0["m_strFrom"] = "FROM tbluser";
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
	"m_strName" => "id",
	"m_strTable" => "tbluser",
	"m_srcTableName" => "tbluser"
));

$proto6["m_sql"] = "id";
$proto6["m_srcTableName"] = "tbluser";
$proto6["m_expr"]=$obj;
$proto6["m_alias"] = "";
$obj = new SQLFieldListItem($proto6);

$proto0["m_fieldlist"][]=$obj;
						$proto8=array();
			$obj = new SQLField(array(
	"m_strName" => "UserName",
	"m_strTable" => "tbluser",
	"m_srcTableName" => "tbluser"
));

$proto8["m_sql"] = "UserName";
$proto8["m_srcTableName"] = "tbluser";
$proto8["m_expr"]=$obj;
$proto8["m_alias"] = "";
$obj = new SQLFieldListItem($proto8);

$proto0["m_fieldlist"][]=$obj;
						$proto10=array();
			$obj = new SQLField(array(
	"m_strName" => "LastName",
	"m_strTable" => "tbluser",
	"m_srcTableName" => "tbluser"
));

$proto10["m_sql"] = "LastName";
$proto10["m_srcTableName"] = "tbluser";
$proto10["m_expr"]=$obj;
$proto10["m_alias"] = "";
$obj = new SQLFieldListItem($proto10);

$proto0["m_fieldlist"][]=$obj;
						$proto12=array();
			$obj = new SQLField(array(
	"m_strName" => "FirstName",
	"m_strTable" => "tbluser",
	"m_srcTableName" => "tbluser"
));

$proto12["m_sql"] = "FirstName";
$proto12["m_srcTableName"] = "tbluser";
$proto12["m_expr"]=$obj;
$proto12["m_alias"] = "";
$obj = new SQLFieldListItem($proto12);

$proto0["m_fieldlist"][]=$obj;
						$proto14=array();
			$obj = new SQLField(array(
	"m_strName" => "Password",
	"m_strTable" => "tbluser",
	"m_srcTableName" => "tbluser"
));

$proto14["m_sql"] = "Password";
$proto14["m_srcTableName"] = "tbluser";
$proto14["m_expr"]=$obj;
$proto14["m_alias"] = "";
$obj = new SQLFieldListItem($proto14);

$proto0["m_fieldlist"][]=$obj;
						$proto16=array();
			$obj = new SQLField(array(
	"m_strName" => "Type",
	"m_strTable" => "tbluser",
	"m_srcTableName" => "tbluser"
));

$proto16["m_sql"] = "`Type`";
$proto16["m_srcTableName"] = "tbluser";
$proto16["m_expr"]=$obj;
$proto16["m_alias"] = "";
$obj = new SQLFieldListItem($proto16);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto18=array();
$proto18["m_link"] = "SQLL_MAIN";
			$proto19=array();
$proto19["m_strName"] = "tbluser";
$proto19["m_srcTableName"] = "tbluser";
$proto19["m_columns"] = array();
$proto19["m_columns"][] = "id";
$proto19["m_columns"][] = "UserName";
$proto19["m_columns"][] = "LastName";
$proto19["m_columns"][] = "FirstName";
$proto19["m_columns"][] = "Password";
$proto19["m_columns"][] = "Type";
$obj = new SQLTable($proto19);

$proto18["m_table"] = $obj;
$proto18["m_sql"] = "tbluser";
$proto18["m_alias"] = "";
$proto18["m_srcTableName"] = "tbluser";
$proto20=array();
$proto20["m_sql"] = "";
$proto20["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto20["m_column"]=$obj;
$proto20["m_contained"] = array();
$proto20["m_strCase"] = "";
$proto20["m_havingmode"] = false;
$proto20["m_inBrackets"] = false;
$proto20["m_useAlias"] = false;
$obj = new SQLLogicalExpr($proto20);

$proto18["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto18);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$proto0["m_srcTableName"]="tbluser";		
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_tbluser = createSqlQuery_tbluser();


	
		;

						

$tdatatbluser[".sqlquery"] = $queryData_tbluser;

$tableEvents["tbluser"] = new eventsBase;
$tdatatbluser[".hasEvents"] = false;

?>