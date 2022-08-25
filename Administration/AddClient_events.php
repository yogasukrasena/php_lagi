<?php
//BindEvents Method @1-B713C14F
function BindEvents()
{
    global $tbladminist_client;
    global $Panel1;
    global $CCSEvents;
    $tbladminist_client->tbladminist_client_TotalRecords->CCSEvents["BeforeShow"] = "tbladminist_client_tbladminist_client_TotalRecords_BeforeShow";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//tbladminist_client_tbladminist_client_TotalRecords_BeforeShow @36-527D33EB
function tbladminist_client_tbladminist_client_TotalRecords_BeforeShow(& $sender)
{
    $tbladminist_client_tbladminist_client_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbladminist_client; //Compatibility
//End tbladminist_client_tbladminist_client_TotalRecords_BeforeShow

//Retrieve number of records @37-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tbladminist_client_tbladminist_client_TotalRecords_BeforeShow @36-B25D11CA
    return $tbladminist_client_tbladminist_client_TotalRecords_BeforeShow;
}
//End Close tbladminist_client_tbladminist_client_TotalRecords_BeforeShow

//Panel1_BeforeShow @51-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Panel1UpdatePanel Page BeforeShow @73-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Panel1_BeforeShow @51-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//Page_BeforeInitialize @1-1FEFCD40
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddClient; //Compatibility
//End Page_BeforeInitialize

//Panel1UpdatePanel PageBeforeInitialize @73-B4F71FC5
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

//Page_AfterInitialize @1-1E5B159C
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddClient; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-A5993DA8
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddClient; //Compatibility
//End Page_BeforeShow

//Panel1UpdatePanel Page BeforeShow @73-9F5F0EA1
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

//Page_BeforeOutput @1-F37F6BD6
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddClient; //Compatibility
//End Page_BeforeOutput

//Panel1UpdatePanel PageBeforeOutput @73-69FFB31D
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-D0181E11
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddClient; //Compatibility
//End Page_BeforeUnload

//Panel1UpdatePanel PageBeforeUnload @73-483BFCB6
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
