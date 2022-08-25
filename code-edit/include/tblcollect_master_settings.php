<?php



$tdatatblcollect_master = array();
$tdatatblcollect_master[".searchableFields"] = array();
$tdatatblcollect_master[".ShortName"] = "tblcollect_master";
$tdatatblcollect_master[".OwnerID"] = "";
$tdatatblcollect_master[".OriginalTable"] = "tblcollect_master";


$defaultPages = my_json_decode( "{\"edit\":\"edit\",\"export\":\"export\",\"list\":\"list\",\"search\":\"search\"}" );

$tdatatblcollect_master[".pagesByType"] = my_json_decode( "{\"edit\":[\"edit\"],\"export\":[\"export\"],\"list\":[\"list\"],\"search\":[\"search\"]}" );
$tdatatblcollect_master[".pages"] = types2pages( my_json_decode( "{\"edit\":[\"edit\"],\"export\":[\"export\"],\"list\":[\"list\"],\"search\":[\"search\"]}" ) );
$tdatatblcollect_master[".defaultPages"] = $defaultPages;

//	field labels
$fieldLabelstblcollect_master = array();
$fieldToolTipstblcollect_master = array();
$pageTitlestblcollect_master = array();
$placeHolderstblcollect_master = array();

if(mlang_getcurrentlang()=="English")
{
	$fieldLabelstblcollect_master["English"] = array();
	$fieldToolTipstblcollect_master["English"] = array();
	$placeHolderstblcollect_master["English"] = array();
	$pageTitlestblcollect_master["English"] = array();
	$fieldLabelstblcollect_master["English"]["CollectCode"] = "ID";
	$fieldToolTipstblcollect_master["English"]["CollectCode"] = "";
	$placeHolderstblcollect_master["English"]["CollectCode"] = "";
	$fieldLabelstblcollect_master["English"]["DesignCode"] = "Client";
	$fieldToolTipstblcollect_master["English"]["DesignCode"] = "";
	$placeHolderstblcollect_master["English"]["DesignCode"] = "";
	$fieldLabelstblcollect_master["English"]["NameCode"] = "Name";
	$fieldToolTipstblcollect_master["English"]["NameCode"] = "";
	$placeHolderstblcollect_master["English"]["NameCode"] = "";
	$fieldLabelstblcollect_master["English"]["CategoryCode"] = "Category";
	$fieldToolTipstblcollect_master["English"]["CategoryCode"] = "";
	$placeHolderstblcollect_master["English"]["CategoryCode"] = "";
	$fieldLabelstblcollect_master["English"]["ColorCode"] = "Color";
	$fieldToolTipstblcollect_master["English"]["ColorCode"] = "";
	$placeHolderstblcollect_master["English"]["ColorCode"] = "";
	$fieldLabelstblcollect_master["English"]["ClientCode"] = "Code";
	$fieldToolTipstblcollect_master["English"]["ClientCode"] = "";
	$placeHolderstblcollect_master["English"]["ClientCode"] = "";
	$fieldLabelstblcollect_master["English"]["Photo1"] = "Photo";
	$fieldToolTipstblcollect_master["English"]["Photo1"] = "";
	$placeHolderstblcollect_master["English"]["Photo1"] = "";
	$fieldLabelstblcollect_master["English"]["ID"] = "ID";
	$fieldToolTipstblcollect_master["English"]["ID"] = "";
	$placeHolderstblcollect_master["English"]["ID"] = "";
	$pageTitlestblcollect_master["English"]["edit"] = "Collections, Edit [{%ClientCode}]";
	if (count($fieldToolTipstblcollect_master["English"]))
		$tdatatblcollect_master[".isUseToolTips"] = true;
}


	$tdatatblcollect_master[".NCSearch"] = true;



$tdatatblcollect_master[".shortTableName"] = "tblcollect_master";
$tdatatblcollect_master[".nSecOptions"] = 0;

$tdatatblcollect_master[".mainTableOwnerID"] = "";
$tdatatblcollect_master[".entityType"] = 0;

$tdatatblcollect_master[".strOriginalTableName"] = "tblcollect_master";

	



$tdatatblcollect_master[".showAddInPopup"] = false;

$tdatatblcollect_master[".showEditInPopup"] = false;

$tdatatblcollect_master[".showViewInPopup"] = false;

//page's base css files names
$popupPagesLayoutNames = array();
$tdatatblcollect_master[".popupPagesLayoutNames"] = $popupPagesLayoutNames;


	$tdatatblcollect_master[".listAjax"] = true;
//	temporary
$tdatatblcollect_master[".listAjax"] = false;

	$tdatatblcollect_master[".audit"] = false;

	$tdatatblcollect_master[".locking"] = false;


$pages = $tdatatblcollect_master[".defaultPages"];

if( $pages[PAGE_EDIT] ) {
	$tdatatblcollect_master[".edit"] = true;
	$tdatatblcollect_master[".afterEditAction"] = 1;
	$tdatatblcollect_master[".closePopupAfterEdit"] = 1;
	$tdatatblcollect_master[".afterEditActionDetTable"] = "Detail tables not found!";
}

if( $pages[PAGE_ADD] ) {
$tdatatblcollect_master[".add"] = true;
$tdatatblcollect_master[".afterAddAction"] = 1;
$tdatatblcollect_master[".closePopupAfterAdd"] = 1;
$tdatatblcollect_master[".afterAddActionDetTable"] = "";
}

if( $pages[PAGE_LIST] ) {
	$tdatatblcollect_master[".list"] = true;
}



$tdatatblcollect_master[".strSortControlSettingsJSON"] = "";




if( $pages[PAGE_VIEW] ) {
$tdatatblcollect_master[".view"] = true;
}

if( $pages[PAGE_IMPORT] ) {
$tdatatblcollect_master[".import"] = true;
}

if( $pages[PAGE_EXPORT] ) {
$tdatatblcollect_master[".exportTo"] = true;
}

if( $pages[PAGE_PRINT] ) {
$tdatatblcollect_master[".printFriendly"] = true;
}



$tdatatblcollect_master[".showSimpleSearchOptions"] = true; // temp fix #13449

// Allow Show/Hide Fields in GRID
$tdatatblcollect_master[".allowShowHideFields"] = true; // temp fix #13449
//

// Allow Fields Reordering in GRID
$tdatatblcollect_master[".allowFieldsReordering"] = true; // temp fix #13449
//

$tdatatblcollect_master[".isUseAjaxSuggest"] = true;

$tdatatblcollect_master[".rowHighlite"] = true;





$tdatatblcollect_master[".ajaxCodeSnippetAdded"] = false;

$tdatatblcollect_master[".buttonsAdded"] = false;

$tdatatblcollect_master[".addPageEvents"] = false;

// use timepicker for search panel
$tdatatblcollect_master[".isUseTimeForSearch"] = false;


$tdatatblcollect_master[".badgeColor"] = "D2691E";


$tdatatblcollect_master[".allSearchFields"] = array();
$tdatatblcollect_master[".filterFields"] = array();
$tdatatblcollect_master[".requiredSearchFields"] = array();

$tdatatblcollect_master[".googleLikeFields"] = array();
$tdatatblcollect_master[".googleLikeFields"][] = "ClientCode";
$tdatatblcollect_master[".googleLikeFields"][] = "DesignCode";
$tdatatblcollect_master[".googleLikeFields"][] = "NameCode";
$tdatatblcollect_master[".googleLikeFields"][] = "CategoryCode";



$tdatatblcollect_master[".tableType"] = "list";

$tdatatblcollect_master[".printerPageOrientation"] = 0;
$tdatatblcollect_master[".nPrinterPageScale"] = 100;

$tdatatblcollect_master[".nPrinterSplitRecords"] = 40;

$tdatatblcollect_master[".geocodingEnabled"] = false;




$tdatatblcollect_master[".isDisplayLoading"] = true;






$tdatatblcollect_master[".pageSize"] = 20;

$tdatatblcollect_master[".warnLeavingPages"] = true;



$tstrOrderBy = "ORDER BY ID DESC";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatatblcollect_master[".strOrderBy"] = $tstrOrderBy;

$tdatatblcollect_master[".orderindexes"] = array();
	$tdatatblcollect_master[".orderindexes"][] = array(8, (0 ? "ASC" : "DESC"), "ID");


$tdatatblcollect_master[".sqlHead"] = "SELECT CollectCode,  ClientCode,  DesignCode,  NameCode,  CategoryCode,  ColorCode,  Photo1,  ID";
$tdatatblcollect_master[".sqlFrom"] = "FROM tblcollect_master";
$tdatatblcollect_master[".sqlWhereExpr"] = "";
$tdatatblcollect_master[".sqlTail"] = "";










//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatatblcollect_master[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatatblcollect_master[".arrGroupsPerPage"] = $arrGPP;

$tdatatblcollect_master[".highlightSearchResults"] = true;

$tableKeystblcollect_master = array();
$tableKeystblcollect_master[] = "ID";
$tdatatblcollect_master[".Keys"] = $tableKeystblcollect_master;


$tdatatblcollect_master[".hideMobileList"] = array();




//	CollectCode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "CollectCode";
	$fdata["GoodName"] = "CollectCode";
	$fdata["ownerTable"] = "tblcollect_master";
	$fdata["Label"] = GetFieldLabel("tblcollect_master","CollectCode");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "CollectCode";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "CollectCode";

	
	
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


	$tdatatblcollect_master["CollectCode"] = $fdata;
		$tdatatblcollect_master[".searchableFields"][] = "CollectCode";
//	ClientCode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "ClientCode";
	$fdata["GoodName"] = "ClientCode";
	$fdata["ownerTable"] = "tblcollect_master";
	$fdata["Label"] = GetFieldLabel("tblcollect_master","ClientCode");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "ClientCode";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "ClientCode";

	
	
				$fdata["UploadFolder"] = "files";

//  Begin View Formats
	$fdata["ViewFormats"] = array();

	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["view"] = $vdata;
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["list"] = $vdata;
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["print"] = $vdata;
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["export"] = $vdata;
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
			$edata["EditParams"].= " maxlength=20";

		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
								$edata["validateAs"]["basicValidate"][] = "DenyDuplicated";
	$edata["validateAs"]["customMessages"]["DenyDuplicated"] = array("message" => "Value code already exists", "messageType" => "Text");

	
	//	End validation

	
			
	
		$edata["denyDuplicates"] = true;

	
	$fdata["EditFormats"]["edit"] = $edata;
	$edata = array("EditFormat" => "Text field");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
			$edata["HTML5InuptType"] = "text";

		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=20";

		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["add"] = $edata;
	$edata = array("EditFormat" => "Text field");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
			$edata["HTML5InuptType"] = "text";

		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=20";

		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["search"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = true;




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


	$tdatatblcollect_master["ClientCode"] = $fdata;
		$tdatatblcollect_master[".searchableFields"][] = "ClientCode";
//	DesignCode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "DesignCode";
	$fdata["GoodName"] = "DesignCode";
	$fdata["ownerTable"] = "tblcollect_master";
	$fdata["Label"] = GetFieldLabel("tblcollect_master","DesignCode");
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
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["list"] = $vdata;
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["print"] = $vdata;
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["export"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Readonly");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["edit"] = $edata;
	$edata = array("EditFormat" => "Lookup wizard");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	

// Begin Lookup settings
				$edata["LookupType"] = 2;
	$edata["LookupTable"] = "tblcollect_design";
			$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
		$edata["LCType"] = 0;

	
		
	$edata["LinkField"] = "DesignCode";
	$edata["LinkFieldType"] = 200;
	$edata["DisplayField"] = "DesignName";

	

	
	$edata["LookupOrderBy"] = "DesignName";

	
	
	
	

	
	
		$edata["SelectSize"] = 1;

// End Lookup Settings


	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["add"] = $edata;
	$edata = array("EditFormat" => "Lookup wizard");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	

// Begin Lookup settings
				$edata["LookupType"] = 2;
	$edata["LookupTable"] = "tblcollect_design";
			$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
		$edata["LCType"] = 1;

	
		
	$edata["LinkField"] = "DesignCode";
	$edata["LinkFieldType"] = 200;
	$edata["DisplayField"] = "DesignName";

	

	
	$edata["LookupOrderBy"] = "DesignName";

	
	
	
	

	
	
	
// End Lookup Settings


	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["search"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = true;




// the field's search options settings
		$fdata["defaultSearchOption"] = "Equals";

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


	$tdatatblcollect_master["DesignCode"] = $fdata;
		$tdatatblcollect_master[".searchableFields"][] = "DesignCode";
//	NameCode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "NameCode";
	$fdata["GoodName"] = "NameCode";
	$fdata["ownerTable"] = "tblcollect_master";
	$fdata["Label"] = GetFieldLabel("tblcollect_master","NameCode");
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
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["list"] = $vdata;
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["print"] = $vdata;
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["export"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Readonly");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["edit"] = $edata;
	$edata = array("EditFormat" => "Lookup wizard");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	

// Begin Lookup settings
				$edata["LookupType"] = 2;
	$edata["LookupTable"] = "tblcollect_name";
			$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
		$edata["LCType"] = 0;

	
		
	$edata["LinkField"] = "NameCode";
	$edata["LinkFieldType"] = 200;
	$edata["DisplayField"] = "NameDesc";

	

	
	$edata["LookupOrderBy"] = "NameDesc";

	
	
	
	

	
	
		$edata["SelectSize"] = 1;

// End Lookup Settings


	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["add"] = $edata;
	$edata = array("EditFormat" => "Lookup wizard");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	

// Begin Lookup settings
				$edata["LookupType"] = 2;
	$edata["LookupTable"] = "tblcollect_name";
			$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
		$edata["LCType"] = 1;

	
		
	$edata["LinkField"] = "NameCode";
	$edata["LinkFieldType"] = 200;
	$edata["DisplayField"] = "NameDesc";

	

	
	$edata["LookupOrderBy"] = "NameDesc";

	
	
	
	

	
	
	
// End Lookup Settings


	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["search"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = true;




// the field's search options settings
		$fdata["defaultSearchOption"] = "Equals";

			// the user's search options list
		$fdata["searchOptionsList"] = array();
		$fdata["searchOptionsList"][] = "Contains";
		$fdata["searchOptionsList"][] = "Equals";
		$fdata["searchOptionsList"][] = "Starts with";
		$fdata["searchOptionsList"][] = "Between";
		$fdata["searchOptionsList"][] = "Empty";
		$fdata["searchOptionsList"][] = "NOT Empty";
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


	$tdatatblcollect_master["NameCode"] = $fdata;
		$tdatatblcollect_master[".searchableFields"][] = "NameCode";
//	CategoryCode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "CategoryCode";
	$fdata["GoodName"] = "CategoryCode";
	$fdata["ownerTable"] = "tblcollect_master";
	$fdata["Label"] = GetFieldLabel("tblcollect_master","CategoryCode");
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
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["list"] = $vdata;
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["print"] = $vdata;
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["export"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Readonly");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["edit"] = $edata;
	$edata = array("EditFormat" => "Lookup wizard");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	

// Begin Lookup settings
				$edata["LookupType"] = 2;
	$edata["LookupTable"] = "tblcollect_category";
			$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
		$edata["LCType"] = 0;

	
		
	$edata["LinkField"] = "CategoryCode";
	$edata["LinkFieldType"] = 200;
	$edata["DisplayField"] = "CategoryName";

	

	
	$edata["LookupOrderBy"] = "CategoryName";

	
	
	
	

	
	
		$edata["SelectSize"] = 1;

// End Lookup Settings


	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["add"] = $edata;
	$edata = array("EditFormat" => "Lookup wizard");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	

// Begin Lookup settings
				$edata["LookupType"] = 2;
	$edata["LookupTable"] = "tblcollect_category";
			$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
		$edata["LCType"] = 1;

	
		
	$edata["LinkField"] = "CategoryCode";
	$edata["LinkFieldType"] = 200;
	$edata["DisplayField"] = "CategoryName";

	

	
	$edata["LookupOrderBy"] = "CategoryName";

	
	
	
	

	
	
	
// End Lookup Settings


	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["search"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = true;




// the field's search options settings
		$fdata["defaultSearchOption"] = "Equals";

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


	$tdatatblcollect_master["CategoryCode"] = $fdata;
		$tdatatblcollect_master[".searchableFields"][] = "CategoryCode";
//	ColorCode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "ColorCode";
	$fdata["GoodName"] = "ColorCode";
	$fdata["ownerTable"] = "tblcollect_master";
	$fdata["Label"] = GetFieldLabel("tblcollect_master","ColorCode");
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
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["list"] = $vdata;
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["print"] = $vdata;
	$vdata = array("ViewFormat" => "");

	
	
	
	
	
	
	
	
	
	
	
	
		$vdata["NeedEncode"] = true;

	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["export"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Readonly");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["edit"] = $edata;
	$edata = array("EditFormat" => "Lookup wizard");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	

// Begin Lookup settings
				$edata["LookupType"] = 2;
	$edata["LookupTable"] = "tblcollect_color";
			$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
		$edata["LCType"] = 0;

	
		
	$edata["LinkField"] = "ColorCode";
	$edata["LinkFieldType"] = 200;
	$edata["DisplayField"] = "ColorName";

	

	
	$edata["LookupOrderBy"] = "ColorName";

	
	
	
	

	
	
		$edata["SelectSize"] = 1;

// End Lookup Settings


	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["add"] = $edata;
	$edata = array("EditFormat" => "Lookup wizard");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	

// Begin Lookup settings
				$edata["LookupType"] = 2;
	$edata["LookupTable"] = "tblcollect_color";
			$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
		$edata["LCType"] = 1;

	
		
	$edata["LinkField"] = "ColorCode";
	$edata["LinkFieldType"] = 200;
	$edata["DisplayField"] = "ColorName";

	

	
	$edata["LookupOrderBy"] = "ColorName";

	
	
	
	

	
	
	
// End Lookup Settings


	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["search"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = true;




// the field's search options settings
		$fdata["defaultSearchOption"] = "Equals";

			// the user's search options list
		$fdata["searchOptionsList"] = array();
		$fdata["searchOptionsList"][] = "Contains";
		$fdata["searchOptionsList"][] = "Equals";
		$fdata["searchOptionsList"][] = "Starts with";
		$fdata["searchOptionsList"][] = "Empty";
		$fdata["searchOptionsList"][] = "NOT Empty";
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


	$tdatatblcollect_master["ColorCode"] = $fdata;
		$tdatatblcollect_master[".searchableFields"][] = "ColorCode";
//	Photo1
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "Photo1";
	$fdata["GoodName"] = "Photo1";
	$fdata["ownerTable"] = "tblcollect_master";
	$fdata["Label"] = GetFieldLabel("tblcollect_master","Photo1");
	$fdata["FieldType"] = 200;

	
	
	
			

		$fdata["strField"] = "Photo1";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "Photo1";

	
		$fdata["CompatibilityMode"] = true;

				$fdata["UploadFolder"] = "192.168.0.110\C:\AppServ\www\GFSystem\upload";

//  Begin View Formats
	$fdata["ViewFormats"] = array();

	$vdata = array("ViewFormat" => "File-based Image");

	
	
				$vdata["ImageWidth"] = 75;
	$vdata["ImageHeight"] = 75;

			$vdata["multipleImgMode"] = 1;
	$vdata["maxImages"] = 0;

		
	$vdata["imageBorder"] = 0;
	$vdata["imageFullWidth"] = 0;


	
	
	
	
	
	
	
	
	
	
	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["view"] = $vdata;
	$vdata = array("ViewFormat" => "File-based Image");

	
	
				$vdata["ImageWidth"] = 75;
	$vdata["ImageHeight"] = 75;

			$vdata["multipleImgMode"] = 1;
	$vdata["maxImages"] = 0;

		
	$vdata["imageBorder"] = 0;
	$vdata["imageFullWidth"] = 0;


	
	
	
	
	
	
	
	
	
	
	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["list"] = $vdata;
	$vdata = array("ViewFormat" => "File-based Image");

	
	
				$vdata["ImageWidth"] = 75;
	$vdata["ImageHeight"] = 75;

			$vdata["multipleImgMode"] = 1;
	$vdata["maxImages"] = 0;

		
	$vdata["imageBorder"] = 1;
	$vdata["imageFullWidth"] = 1;


	
	
	
	
	
	
	
	
	
	
	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["print"] = $vdata;
	$vdata = array("ViewFormat" => "Document Download");

	
	
	
								$vdata["ShowIcon"] = true;
		
	
	
	
	
	
	
	
	
	
	
		$vdata["truncateText"] = true;
	$vdata["NumberOfChars"] = 80;

	$fdata["ViewFormats"]["export"] = $vdata;
//  End View Formats

//	Begin Edit Formats
	$fdata["EditFormats"] = array();

	$edata = array("EditFormat" => "Readonly");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["edit"] = $edata;
	$edata = array("EditFormat" => "Document upload");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["add"] = $edata;
	$edata = array("EditFormat" => "Readonly");

	
		$edata["weekdayMessage"] = array("message" => "", "messageType" => "Text");
	$edata["weekdays"] = "[]";


	
	



	
	
	
	
			$edata["acceptFileTypes"] = ".+$";
		$edata["acceptFileTypesHtml"] = "";

		$edata["maxNumberOfFiles"] = 1;

	
	
	
	
	
	
		$edata["controlWidth"] = 200;

//	Begin validation
	$edata["validateAs"] = array();
	$edata["validateAs"]["basicValidate"] = array();
	$edata["validateAs"]["customMessages"] = array();
	
	
	//	End validation

	
			
	
	
	
	$fdata["EditFormats"]["search"] = $edata;
//	End Edit Formats


	$fdata["isSeparate"] = true;


	$fdata["Absolute"] = true;


// the field's search options settings
		$fdata["defaultSearchOption"] = "Contains";

			// the default search options list
				$fdata["searchOptionsList"] = array("Contains", "Equals", "Starts with", "More than", "Less than", "Between", "Empty", NOT_EMPTY);
// the end of search options settings


//Filters settings
	$fdata["filterTotals"] = 0;
		$fdata["filterMultiSelect"] = 0;
		$fdata["filterTotalFields"] = "ID";
		$fdata["filterFormat"] = "Values list";
		$fdata["showCollapsed"] = false;

		$fdata["sortValueType"] = 0;
		$fdata["numberOfVisibleItems"] = 10;

		$fdata["filterBy"] = 0;

	

	
	
//end of Filters settings


	$tdatatblcollect_master["Photo1"] = $fdata;
		$tdatatblcollect_master[".searchableFields"][] = "Photo1";
//	ID
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "ID";
	$fdata["GoodName"] = "ID";
	$fdata["ownerTable"] = "tblcollect_master";
	$fdata["Label"] = GetFieldLabel("tblcollect_master","ID");
	$fdata["FieldType"] = 3;

	
		$fdata["AutoInc"] = true;

	
			

		$fdata["strField"] = "ID";

		$fdata["isSQLExpression"] = true;
	$fdata["FullName"] = "ID";

	
	
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


	$tdatatblcollect_master["ID"] = $fdata;
		$tdatatblcollect_master[".searchableFields"][] = "ID";


$tables_data["tblcollect_master"]=&$tdatatblcollect_master;
$field_labels["tblcollect_master"] = &$fieldLabelstblcollect_master;
$fieldToolTips["tblcollect_master"] = &$fieldToolTipstblcollect_master;
$placeHolders["tblcollect_master"] = &$placeHolderstblcollect_master;
$page_titles["tblcollect_master"] = &$pageTitlestblcollect_master;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["tblcollect_master"] = array();

// tables which are master tables for current table (detail)
$masterTablesData["tblcollect_master"] = array();



// -----------------end  prepare master-details data arrays ------------------------------//


require_once(getabspath("classes/sql.php"));










function createSqlQuery_tblcollect_master()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "CollectCode,  ClientCode,  DesignCode,  NameCode,  CategoryCode,  ColorCode,  Photo1,  ID";
$proto0["m_strFrom"] = "FROM tblcollect_master";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "ORDER BY ID DESC";
	
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
	"m_strName" => "CollectCode",
	"m_strTable" => "tblcollect_master",
	"m_srcTableName" => "tblcollect_master"
));

$proto6["m_sql"] = "CollectCode";
$proto6["m_srcTableName"] = "tblcollect_master";
$proto6["m_expr"]=$obj;
$proto6["m_alias"] = "";
$obj = new SQLFieldListItem($proto6);

$proto0["m_fieldlist"][]=$obj;
						$proto8=array();
			$obj = new SQLField(array(
	"m_strName" => "ClientCode",
	"m_strTable" => "tblcollect_master",
	"m_srcTableName" => "tblcollect_master"
));

$proto8["m_sql"] = "ClientCode";
$proto8["m_srcTableName"] = "tblcollect_master";
$proto8["m_expr"]=$obj;
$proto8["m_alias"] = "";
$obj = new SQLFieldListItem($proto8);

$proto0["m_fieldlist"][]=$obj;
						$proto10=array();
			$obj = new SQLField(array(
	"m_strName" => "DesignCode",
	"m_strTable" => "tblcollect_master",
	"m_srcTableName" => "tblcollect_master"
));

$proto10["m_sql"] = "DesignCode";
$proto10["m_srcTableName"] = "tblcollect_master";
$proto10["m_expr"]=$obj;
$proto10["m_alias"] = "";
$obj = new SQLFieldListItem($proto10);

$proto0["m_fieldlist"][]=$obj;
						$proto12=array();
			$obj = new SQLField(array(
	"m_strName" => "NameCode",
	"m_strTable" => "tblcollect_master",
	"m_srcTableName" => "tblcollect_master"
));

$proto12["m_sql"] = "NameCode";
$proto12["m_srcTableName"] = "tblcollect_master";
$proto12["m_expr"]=$obj;
$proto12["m_alias"] = "";
$obj = new SQLFieldListItem($proto12);

$proto0["m_fieldlist"][]=$obj;
						$proto14=array();
			$obj = new SQLField(array(
	"m_strName" => "CategoryCode",
	"m_strTable" => "tblcollect_master",
	"m_srcTableName" => "tblcollect_master"
));

$proto14["m_sql"] = "CategoryCode";
$proto14["m_srcTableName"] = "tblcollect_master";
$proto14["m_expr"]=$obj;
$proto14["m_alias"] = "";
$obj = new SQLFieldListItem($proto14);

$proto0["m_fieldlist"][]=$obj;
						$proto16=array();
			$obj = new SQLField(array(
	"m_strName" => "ColorCode",
	"m_strTable" => "tblcollect_master",
	"m_srcTableName" => "tblcollect_master"
));

$proto16["m_sql"] = "ColorCode";
$proto16["m_srcTableName"] = "tblcollect_master";
$proto16["m_expr"]=$obj;
$proto16["m_alias"] = "";
$obj = new SQLFieldListItem($proto16);

$proto0["m_fieldlist"][]=$obj;
						$proto18=array();
			$obj = new SQLField(array(
	"m_strName" => "Photo1",
	"m_strTable" => "tblcollect_master",
	"m_srcTableName" => "tblcollect_master"
));

$proto18["m_sql"] = "Photo1";
$proto18["m_srcTableName"] = "tblcollect_master";
$proto18["m_expr"]=$obj;
$proto18["m_alias"] = "";
$obj = new SQLFieldListItem($proto18);

$proto0["m_fieldlist"][]=$obj;
						$proto20=array();
			$obj = new SQLField(array(
	"m_strName" => "ID",
	"m_strTable" => "tblcollect_master",
	"m_srcTableName" => "tblcollect_master"
));

$proto20["m_sql"] = "ID";
$proto20["m_srcTableName"] = "tblcollect_master";
$proto20["m_expr"]=$obj;
$proto20["m_alias"] = "";
$obj = new SQLFieldListItem($proto20);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto22=array();
$proto22["m_link"] = "SQLL_MAIN";
			$proto23=array();
$proto23["m_strName"] = "tblcollect_master";
$proto23["m_srcTableName"] = "tblcollect_master";
$proto23["m_columns"] = array();
$proto23["m_columns"][] = "ID";
$proto23["m_columns"][] = "CollectCode";
$proto23["m_columns"][] = "DesignCode";
$proto23["m_columns"][] = "NameCode";
$proto23["m_columns"][] = "CategoryCode";
$proto23["m_columns"][] = "SizeCode";
$proto23["m_columns"][] = "TextureCode";
$proto23["m_columns"][] = "ColorCode";
$proto23["m_columns"][] = "MaterialCode";
$proto23["m_columns"][] = "ClientCode";
$proto23["m_columns"][] = "ClientDescription";
$proto23["m_columns"][] = "CollectDate";
$proto23["m_columns"][] = "TechDraw";
$proto23["m_columns"][] = "Photo1";
$proto23["m_columns"][] = "Photo2";
$proto23["m_columns"][] = "Photo3";
$proto23["m_columns"][] = "Photo4";
$proto23["m_columns"][] = "RefID";
$proto23["m_columns"][] = "Clay";
$proto23["m_columns"][] = "ClayKG";
$proto23["m_columns"][] = "ClayNote";
$proto23["m_columns"][] = "BuildTech";
$proto23["m_columns"][] = "BuildTechNote";
$proto23["m_columns"][] = "Rim";
$proto23["m_columns"][] = "Feet";
$proto23["m_columns"][] = "Casting1";
$proto23["m_columns"][] = "Casting2";
$proto23["m_columns"][] = "Casting3";
$proto23["m_columns"][] = "Casting4";
$proto23["m_columns"][] = "CastingNote";
$proto23["m_columns"][] = "Estruder1";
$proto23["m_columns"][] = "Estruder2";
$proto23["m_columns"][] = "Estruder3";
$proto23["m_columns"][] = "Estruder4";
$proto23["m_columns"][] = "EstruderNote";
$proto23["m_columns"][] = "Texture1";
$proto23["m_columns"][] = "Texture2";
$proto23["m_columns"][] = "Texture3";
$proto23["m_columns"][] = "Texture4";
$proto23["m_columns"][] = "TextureNote";
$proto23["m_columns"][] = "Tools1";
$proto23["m_columns"][] = "Tools2";
$proto23["m_columns"][] = "Tools3";
$proto23["m_columns"][] = "Tools4";
$proto23["m_columns"][] = "ToolsNote";
$proto23["m_columns"][] = "Engobe1";
$proto23["m_columns"][] = "Engobe2";
$proto23["m_columns"][] = "Engobe3";
$proto23["m_columns"][] = "Engobe4";
$proto23["m_columns"][] = "EngobeNote";
$proto23["m_columns"][] = "BisqueTemp";
$proto23["m_columns"][] = "StainOxide1";
$proto23["m_columns"][] = "StainOxide2";
$proto23["m_columns"][] = "StainOxide3";
$proto23["m_columns"][] = "StainOxide4";
$proto23["m_columns"][] = "StainOxideNote";
$proto23["m_columns"][] = "Glaze1";
$proto23["m_columns"][] = "Glaze2";
$proto23["m_columns"][] = "Glaze3";
$proto23["m_columns"][] = "Glaze4";
$proto23["m_columns"][] = "GlazeDensity1";
$proto23["m_columns"][] = "GlazeDensity2";
$proto23["m_columns"][] = "GlazeDensity3";
$proto23["m_columns"][] = "GlazeDensity4";
$proto23["m_columns"][] = "GlazeTechnique";
$proto23["m_columns"][] = "GlazeNote";
$proto23["m_columns"][] = "GlazeTemp";
$proto23["m_columns"][] = "Firing";
$proto23["m_columns"][] = "FiringNote";
$proto23["m_columns"][] = "Width";
$proto23["m_columns"][] = "Height";
$proto23["m_columns"][] = "Length";
$proto23["m_columns"][] = "Diameter";
$proto23["m_columns"][] = "SampCeramicVolume";
$proto23["m_columns"][] = "FinalSizeNote";
$proto23["m_columns"][] = "DesignMat1";
$proto23["m_columns"][] = "DesignMat2";
$proto23["m_columns"][] = "DesignMat3";
$proto23["m_columns"][] = "DesignMat4";
$proto23["m_columns"][] = "DesignMatQty1";
$proto23["m_columns"][] = "DesignMatQty2";
$proto23["m_columns"][] = "DesignMatQty3";
$proto23["m_columns"][] = "DesignMatQty4";
$proto23["m_columns"][] = "DesignMatNote";
$proto23["m_columns"][] = "History";
$proto23["m_columns"][] = "ClayType";
$proto23["m_columns"][] = "ClayPreparationMinute";
$proto23["m_columns"][] = "WheelMinute";
$proto23["m_columns"][] = "SlabMinute";
$proto23["m_columns"][] = "CastingMinute";
$proto23["m_columns"][] = "FinishingMinute";
$proto23["m_columns"][] = "GlazingMinute";
$proto23["m_columns"][] = "StandardBisqueLoading";
$proto23["m_columns"][] = "StandardGlazeLoading";
$proto23["m_columns"][] = "RakuBisqueLoading";
$proto23["m_columns"][] = "RakuGlazeLoading";
$proto23["m_columns"][] = "MovementMinute";
$proto23["m_columns"][] = "PackagingWorkMinute";
$proto23["m_columns"][] = "ClayPreparationPPH";
$proto23["m_columns"][] = "WheelPPH";
$proto23["m_columns"][] = "SlabPPH";
$proto23["m_columns"][] = "CastingPPH";
$proto23["m_columns"][] = "FinishingPPH";
$proto23["m_columns"][] = "GlazingPPH";
$proto23["m_columns"][] = "MovementPPH";
$proto23["m_columns"][] = "PackagingWorkPPH";
$proto23["m_columns"][] = "RealSellingPrice";
$proto23["m_columns"][] = "LastUpdate";
$proto23["m_columns"][] = "PriceDollar";
$proto23["m_columns"][] = "PriceEuro";
$proto23["m_columns"][] = "unit";
$proto23["m_columns"][] = "cat";
$proto23["m_columns"][] = "CompanyCode";
$proto23["m_columns"][] = "SupplierCode";
$proto23["m_columns"][] = "Description";
$proto23["m_columns"][] = "RCProcessSub";
$proto23["m_columns"][] = "RCProcessType";
$proto23["m_columns"][] = "RCClay";
$proto23["m_columns"][] = "RCClayCost";
$proto23["m_columns"][] = "RCClayPreparationCost";
$proto23["m_columns"][] = "RCWheelCost";
$proto23["m_columns"][] = "RCSlabCost";
$proto23["m_columns"][] = "RCFinishingCost";
$proto23["m_columns"][] = "RCGlazeCost";
$proto23["m_columns"][] = "RCFiring";
$proto23["m_columns"][] = "RCBisqueLoadCost";
$proto23["m_columns"][] = "RCGlazeLoadCost";
$proto23["m_columns"][] = "RCMovementCost";
$proto23["m_columns"][] = "RCPackCost";
$proto23["m_columns"][] = "RealCost";
$proto23["m_columns"][] = "RCClayPrice";
$proto23["m_columns"][] = "lockmode";
$proto23["m_columns"][] = "rc";
$proto23["m_columns"][] = "dlid";
$proto23["m_columns"][] = "nw";
$proto23["m_columns"][] = "Template";
$proto23["m_columns"][] = "TemplateNote";
$proto23["m_columns"][] = "BisqueNote";
$proto23["m_columns"][] = "GlazeThickness1";
$proto23["m_columns"][] = "GlazeThickness2";
$proto23["m_columns"][] = "GlazeThickness3";
$proto23["m_columns"][] = "GlazeThickness4";
$proto23["m_columns"][] = "Cone";
$proto23["m_columns"][] = "FiringPosition";
$proto23["m_columns"][] = "RCCastCost";
$proto23["m_columns"][] = "shop";
$proto23["m_columns"][] = "shopcategory";
$proto23["m_columns"][] = "shoptechnique";
$proto23["m_columns"][] = "oo";
$proto23["m_columns"][] = "shopprice";
$proto23["m_columns"][] = "stock";
$proto23["m_columns"][] = "shopname";
$proto23["m_columns"][] = "shopdesc";
$proto23["m_columns"][] = "act";
$obj = new SQLTable($proto23);

$proto22["m_table"] = $obj;
$proto22["m_sql"] = "tblcollect_master";
$proto22["m_alias"] = "";
$proto22["m_srcTableName"] = "tblcollect_master";
$proto24=array();
$proto24["m_sql"] = "";
$proto24["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto24["m_column"]=$obj;
$proto24["m_contained"] = array();
$proto24["m_strCase"] = "";
$proto24["m_havingmode"] = false;
$proto24["m_inBrackets"] = false;
$proto24["m_useAlias"] = false;
$obj = new SQLLogicalExpr($proto24);

$proto22["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto22);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
												$proto26=array();
						$obj = new SQLField(array(
	"m_strName" => "ID",
	"m_strTable" => "tblcollect_master",
	"m_srcTableName" => "tblcollect_master"
));

$proto26["m_column"]=$obj;
$proto26["m_bAsc"] = 0;
$proto26["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto26);

$proto0["m_orderby"][]=$obj;					
$proto0["m_srcTableName"]="tblcollect_master";		
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_tblcollect_master = createSqlQuery_tblcollect_master();


	
		;

								

$tdatatblcollect_master[".sqlquery"] = $queryData_tblcollect_master;

$tableEvents["tblcollect_master"] = new eventsBase;
$tdatatblcollect_master[".hasEvents"] = false;

?>