<?php
//BindEvents Method @1-9B89A9F8
function BindEvents()
{
    global $GridCollection;
    global $Panel1;
    global $CCSEvents;
    $GridCollection->tblcollect_category_tblco1_TotalRecords->CCSEvents["BeforeShow"] = "GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow";
    $GridCollection->CCSEvents["BeforeShowRow"] = "GridCollection_BeforeShowRow";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow @28-A8013ABB
function GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow(& $sender)
{
    $GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GridCollection; //Compatibility
//End GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow

//Retrieve number of records @29-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow @28-F5257CAF
    return $GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow;
}
//End Close GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow

//GridCollection_BeforeShowRow @2-C952A723
function GridCollection_BeforeShowRow(& $sender)
{
    $GridCollection_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GridCollection; //Compatibility
//End GridCollection_BeforeShowRow

//Custom Code @172-2A29BDB7
	global $DBGayaFusionAll;
	$RefID = $GridCollection->RefID->GetValue();
	if($RefID > 0){
		$GridCollection->lblRef->Visible = false;
		$GridCollection->LnkRef->Visible = true;
		//$GridCollection->LnkRef->SetValue(CCDLookUp("RefCode","tblReference","ID = $RefID",$DBGayaFusionAll));
	}else{
		$GridCollection->lblRef->Visible = true;
		$GridCollection->LnkRef->Visible = false;
		$GridCollection->lblRef->SetValue("No Ref");
	}
//End Custom Code

//Close GridCollection_BeforeShowRow @2-7A2BED15
    return $GridCollection_BeforeShowRow;
}
//End Close GridCollection_BeforeShowRow

//DEL  	

//Panel1_BeforeShow @58-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Panel1UpdatePanel Page BeforeShow @115-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Panel1_BeforeShow @58-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//Page_BeforeInitialize @1-21DBB6BA
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Collection; //Compatibility
//End Page_BeforeInitialize

//Panel1UpdatePanel PageBeforeInitialize @115-B4F71FC5
    if (CCGetFromGet("FormFilter") == "Panel1" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $TemplateEncoding, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
        $CCSIsParamsEncoded = true;
    }
//End Panel1UpdatePanel PageBeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_AfterInitialize @1-AEBF9C9D
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Collection; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-8FB0AA00
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Collection; //Compatibility
//End Page_BeforeShow

//Panel1UpdatePanel Page BeforeShow @115-9F5F0EA1
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel1") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-385B106D
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Collection; //Compatibility
//End Page_BeforeOutput

//Panel1UpdatePanel PageBeforeOutput @115-69FFB31D
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-3D78200B
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Collection; //Compatibility
//End Page_BeforeUnload

//Panel1UpdatePanel PageBeforeUnload @115-483BFCB6
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Panel1") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel1UpdatePanel PageBeforeUnload

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload
?>
