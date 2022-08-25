<?php
//BindEvents Method @1-44A5CE0D
function BindEvents()
{
    global $Grid;
    global $Panel1;
    global $CCSEvents;
    $Grid->tbladminist_client_tbladm1_TotalRecords->CCSEvents["BeforeShow"] = "Grid_tbladminist_client_tbladm1_TotalRecords_BeforeShow";
    $Grid->CCSEvents["BeforeShowRow"] = "Grid_BeforeShowRow";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//Grid_tbladminist_client_tbladm1_TotalRecords_BeforeShow @26-DE12C6C8
function Grid_tbladminist_client_tbladm1_TotalRecords_BeforeShow(& $sender)
{
    $Grid_tbladminist_client_tbladm1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_tbladminist_client_tbladm1_TotalRecords_BeforeShow

//Retrieve number of records @27-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Grid_tbladminist_client_tbladm1_TotalRecords_BeforeShow @26-4372C95E
    return $Grid_tbladminist_client_tbladm1_TotalRecords_BeforeShow;
}
//End Close Grid_tbladminist_client_tbladm1_TotalRecords_BeforeShow

//Grid_BeforeShowRow @2-AC5B58BC
function Grid_BeforeShowRow(& $sender)
{
    $Grid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_BeforeShowRow

//Custom Code @115-2A29BDB7
$AddressID = $Grid->AddressID->GetValue();
$ContactID = $Grid->ContactID->GetValue();
$ClientID = $Grid->ClientID->GetValue();
$Pro_H_ID = $Grid->Proforma_H_ID->GetValue();
$doc = CCGetFromGet("doc","");
if($doc == "i"){
  $Grid->Proforma_H_ID->SetLink("AddInvoice1.php?Proforma_H_ID=$Pro_H_ID&AddressID=$AddressID&ContactID=$ContactID&ClientID=$ClientID");
}elseif($doc == "p"){
  $Grid->Proforma_H_ID->SetLink("PolUseProf.php?Proforma_H_ID=$Pro_H_ID");
}
//End Custom Code

//Close Grid_BeforeShowRow @2-CE8D36BE
    return $Grid_BeforeShowRow;
}
//End Close Grid_BeforeShowRow

//Panel1_BeforeShow @68-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Panel1UpdatePanel Page BeforeShow @95-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Panel1_BeforeShow @68-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//Page_BeforeInitialize @1-93622FD8
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ProformaChoose; //Compatibility
//End Page_BeforeInitialize

//Panel1UpdatePanel PageBeforeInitialize @95-B4F71FC5
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

//Page_AfterInitialize @1-E7CB4B7B
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ProformaChoose; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-43F6E7B1
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ProformaChoose; //Compatibility
//End Page_BeforeShow

//Panel1UpdatePanel Page BeforeShow @95-9F5F0EA1
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

//Page_BeforeOutput @1-AAFCBFA1
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ProformaChoose; //Compatibility
//End Page_BeforeOutput

//Panel1UpdatePanel PageBeforeOutput @95-69FFB31D
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-5E197100
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ProformaChoose; //Compatibility
//End Page_BeforeUnload

//Panel1UpdatePanel PageBeforeUnload @95-483BFCB6
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