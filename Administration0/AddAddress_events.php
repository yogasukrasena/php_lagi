<?php
//BindEvents Method @1-76DEE891
function BindEvents()
{
    global $Grid;
    global $Add;
    global $Panel1;
    global $Edit;
    global $Panel2;
    global $CCSEvents;
    $Grid->tbladminist_addressbook_TotalRecords->CCSEvents["BeforeShow"] = "Grid_tbladminist_addressbook_TotalRecords_BeforeShow";
    $Add->CCSEvents["BeforeShow"] = "Add_BeforeShow";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $Edit->AdrID->CCSEvents["BeforeShow"] = "Edit_AdrID_BeforeShow";
    $Panel2->CCSEvents["BeforeShow"] = "Panel2_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//Grid_tbladminist_addressbook_TotalRecords_BeforeShow @9-D8623178
function Grid_tbladminist_addressbook_TotalRecords_BeforeShow(& $sender)
{
    $Grid_tbladminist_addressbook_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_tbladminist_addressbook_TotalRecords_BeforeShow

//Retrieve number of records @10-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Grid_tbladminist_addressbook_TotalRecords_BeforeShow @9-6B6611EF
    return $Grid_tbladminist_addressbook_TotalRecords_BeforeShow;
}
//End Close Grid_tbladminist_addressbook_TotalRecords_BeforeShow

//Add_BeforeShow @35-395670A9
function Add_BeforeShow(& $sender)
{
    $Add_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Add; //Compatibility
//End Add_BeforeShow

//Custom Code @108-2A29BDB7
// -------------------------
    //$userss->Reg->Visible = !$userss->EditMode;
	$userss->Edit->Visible = $userss->EditMode;
// -------------------------
//End Custom Code

//Close Add_BeforeShow @35-8401FB76
    return $Add_BeforeShow;
}
//End Close Add_BeforeShow

//Panel1_BeforeShow @42-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Panel1UpdatePanel Page BeforeShow @83-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Panel1_BeforeShow @42-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//Edit_AdrID_BeforeShow @112-BEE33B21
function Edit_AdrID_BeforeShow(& $sender)
{
    $Edit_AdrID_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Edit; //Compatibility
//End Edit_AdrID_BeforeShow

//Retrieve Value for Control @113-DDC12103
    $Container->AdrID->SetValue(CCGetFromGet("AddressID", ""));
//End Retrieve Value for Control

//Close Edit_AdrID_BeforeShow @112-D7FDED10
    return $Edit_AdrID_BeforeShow;
}
//End Close Edit_AdrID_BeforeShow

//Panel2_BeforeShow @93-96696C3D
function Panel2_BeforeShow(& $sender)
{
    $Panel2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel2; //Compatibility
//End Panel2_BeforeShow

//Panel2UpdatePanel Page BeforeShow @103-CC9B4012
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel2") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel2\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel2UpdatePanel Page BeforeShow

//Close Panel2_BeforeShow @93-AE7F9FB3
    return $Panel2_BeforeShow;
}
//End Close Panel2_BeforeShow

//Page_BeforeInitialize @1-4B999021
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddAddress; //Compatibility
//End Page_BeforeInitialize

//RemoteCustomCode1 Initialization @109-35C32CB0
    if ('Panel1AddCompanyRemoteCustomCode1' == CCGetParam('callbackControl')) {
//End RemoteCustomCode1 Initialization

//RemoteCustomCode1 Displaying @109-2A29BDB7
        // -------------------------
        // Write your own code here.
        // -------------------------
//End RemoteCustomCode1 Displaying

//RemoteCustomCode1 Tail @109-27890EF8
        exit;
    }
//End RemoteCustomCode1 Tail

//Panel1UpdatePanel PageBeforeInitialize @83-E6DBAF50
    if (CCGetFromGet("FormFilter") == "Panel1") {
        global $TemplateEncoding;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
    }
//End Panel1UpdatePanel PageBeforeInitialize

//Panel2UpdatePanel PageBeforeInitialize @103-AF6D7A53
    if (CCGetFromGet("FormFilter") == "Panel2") {
        global $TemplateEncoding;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
    }
//End Panel2UpdatePanel PageBeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_AfterInitialize @1-C4FDBA06
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddAddress; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-E5F28C9B
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddAddress; //Compatibility
//End Page_BeforeShow

//Panel1UpdatePanel Page BeforeShow @83-51EBB0B5
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel1") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
    }
//End Panel1UpdatePanel Page BeforeShow

//Panel2UpdatePanel Page BeforeShow @103-A34A9519
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel2") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
    }
//End Panel2UpdatePanel Page BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-521936F6
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddAddress; //Compatibility
//End Page_BeforeOutput

//Panel1UpdatePanel PageBeforeOutput @83-69FFB31D
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel PageBeforeOutput

//Panel2UpdatePanel PageBeforeOutput @103-AE056578
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel2") {
        $main_block = $Tpl->getvar("/Panel Panel2");
    }
//End Panel2UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-573A0690
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddAddress; //Compatibility
//End Page_BeforeUnload

//Panel1UpdatePanel PageBeforeUnload @83-217819ED
    global $Redirect, $CCSFormFilter;
    if ($Redirect && $CCSFormFilter == "Panel1") {
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel1UpdatePanel PageBeforeUnload

//Panel2UpdatePanel PageBeforeUnload @103-7B37E886
    global $Redirect, $CCSFormFilter;
    if ($Redirect && $CCSFormFilter == "Panel2") {
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel2UpdatePanel PageBeforeUnload

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload
?>
