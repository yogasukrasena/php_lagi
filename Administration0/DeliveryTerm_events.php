<?php
//BindEvents Method @1-A58420E5
function BindEvents()
{
    global $Grid;
    global $Panel1;
    global $CCSEvents;
    $Grid->tbladminist_deliveryterm_TotalRecords->CCSEvents["BeforeShow"] = "Grid_tbladminist_deliveryterm_TotalRecords_BeforeShow";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//Grid_tbladminist_deliveryterm_TotalRecords_BeforeShow @5-32E592D7
function Grid_tbladminist_deliveryterm_TotalRecords_BeforeShow(& $sender)
{
    $Grid_tbladminist_deliveryterm_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_tbladminist_deliveryterm_TotalRecords_BeforeShow

//Retrieve number of records @6-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Grid_tbladminist_deliveryterm_TotalRecords_BeforeShow @5-AEDA0318
    return $Grid_tbladminist_deliveryterm_TotalRecords_BeforeShow;
}
//End Close Grid_tbladminist_deliveryterm_TotalRecords_BeforeShow

//Panel1_BeforeShow @22-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Panel1UpdatePanel Page BeforeShow @42-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Panel1_BeforeShow @22-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//Page_BeforeInitialize @1-F2331CF2
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DeliveryTerm; //Compatibility
//End Page_BeforeInitialize

//Panel1UpdatePanel PageBeforeInitialize @42-E6DBAF50
    if (CCGetFromGet("FormFilter") == "Panel1") {
        global $TemplateEncoding;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
    }
//End Panel1UpdatePanel PageBeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_AfterInitialize @1-F34DE825
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DeliveryTerm; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-F818A8E4
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DeliveryTerm; //Compatibility
//End Page_BeforeShow

//Panel1UpdatePanel Page BeforeShow @42-51EBB0B5
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel1") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-03FF5077
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DeliveryTerm; //Compatibility
//End Page_BeforeOutput

//Panel1UpdatePanel PageBeforeOutput @42-69FFB31D
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-1681A9D9
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DeliveryTerm; //Compatibility
//End Page_BeforeUnload

//Panel1UpdatePanel PageBeforeUnload @42-217819ED
    global $Redirect, $CCSFormFilter;
    if ($Redirect && $CCSFormFilter == "Panel1") {
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel1UpdatePanel PageBeforeUnload

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload
?>
