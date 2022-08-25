<?php
//BindEvents Method @1-6FB861EF
function BindEvents()
{
    global $Grid;
    global $AddNew;
    global $Panel1;
    global $CCSEvents;
    $Grid->tblcollect_design_tblcoll1_TotalRecords->CCSEvents["BeforeShow"] = "Grid_tblcollect_design_tblcoll1_TotalRecords_BeforeShow";
    $AddNew->CCSEvents["BeforeShow"] = "AddNew_BeforeShow";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//Grid_tblcollect_design_tblcoll1_TotalRecords_BeforeShow @13-C7DAC72F
function Grid_tblcollect_design_tblcoll1_TotalRecords_BeforeShow(& $sender)
{
    $Grid_tblcollect_design_tblcoll1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_tblcollect_design_tblcoll1_TotalRecords_BeforeShow

//Retrieve number of records @14-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Grid_tblcollect_design_tblcoll1_TotalRecords_BeforeShow @13-151B41D7
    return $Grid_tblcollect_design_tblcoll1_TotalRecords_BeforeShow;
}
//End Close Grid_tblcollect_design_tblcoll1_TotalRecords_BeforeShow

//AddNew_BeforeShow @31-02FDD40F
function AddNew_BeforeShow(& $sender)
{
    $AddNew_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNew; //Compatibility
//End AddNew_BeforeShow

//Custom Code @123-2A29BDB7
// -------------------------
    $AddNew->Edit->Visible = $AddNew->EditMode;
	$AddNew->ItemList->Visible = $AddNew->EditMode;
// -------------------------
//End Custom Code

//Close AddNew_BeforeShow @31-4285446C
    return $AddNew_BeforeShow;
}
//End Close AddNew_BeforeShow


//Panel1_BeforeShow @37-AAD8AF72
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

//Close Panel1_BeforeShow @37-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//DEL  // -------------------------
//DEL  
//DEL  	$GroupHID = CCGetfromGet("Group_H_ID",0);
//DEL  	if($GroupHID > 0){
//DEL      	$DB = new clsDBGayaFusionAll();
//DEL  		$sql = "SELECT * FROM tblCollect_Group_H WHERE Group_H_ID =".$GroupHID;
//DEL  		$DB->query($sql);
//DEL  		$result = $DB->next_record();
//DEL  		if($result){
//DEL  			$groupdate = $DB->f("GroupDate");
//DEL  			$ClientCode = $DB->f("ClientCode");
//DEL  			$ClientDesc = $DB->f("ClientDesc");
//DEL  			$Diameter = $DB->f("Diameter");
//DEL  			$Height = $DB->f("Height");
//DEL  			$Weight = $DB->f("Weight");
//DEL  			$Length = $DB->f("Length");
//DEL  			$Photo = $DB->f("Photo");
//DEL  		}
//DEL  		$DB->close();
//DEL  	//let's show the value :D
//DEL  		$EditCollectGroup->GroupDate->SetValue($groupdate);
//DEL  		$EditCollectGroup->ClientCode->SetValue($ClientCode);
//DEL  		$EditCollectGroup->ClientDesc->SetValue($ClientDesc);
//DEL  		$EditCollectGroup->Diameter->SetValue($Diameter);
//DEL  		$EditCollectGroup->Height->SetValue($Height);
//DEL  		$EditCollectGroup->Weight->SetValue($Weight);
//DEL  		$EditCollectGroup->Length->SetValue($Length);
//DEL  		$EditCollectGroup->GroupPhoto->SetValue($Photo);
//DEL  	}
//DEL  // -------------------------

//Page_BeforeInitialize @1-9BDC7DF3
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $CollectionGroup; //Compatibility
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

//Page_AfterInitialize @1-D47726C5
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $CollectionGroup; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-AF6230C7
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $CollectionGroup; //Compatibility
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

//Page_BeforeOutput @1-B23C2AFB
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $CollectionGroup; //Compatibility
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

//Page_BeforeUnload @1-13195C4B
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $CollectionGroup; //Compatibility
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
