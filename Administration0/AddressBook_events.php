<?php
//BindEvents Method @1-D4A21F2E
function BindEvents()
{
    global $AddressGrid;
    global $AddNewHeader;
    global $ContactGrid;
    global $Panel1;
    global $CCSEvents;
    $AddressGrid->tbladminist_addressbook_TotalRecords->CCSEvents["BeforeShow"] = "AddressGrid_tbladminist_addressbook_TotalRecords_BeforeShow";
    $AddNewHeader->CCSEvents["BeforeShow"] = "AddNewHeader_BeforeShow";
    $AddNewHeader->CCSEvents["BeforeDelete"] = "AddNewHeader_BeforeDelete";
    $AddNewHeader->CCSEvents["AfterInsert"] = "AddNewHeader_AfterInsert";
    $ContactGrid->CCSEvents["BeforeShowRow"] = "ContactGrid_BeforeShowRow";
    $ContactGrid->ds->CCSEvents["BeforeBuildInsert"] = "ContactGrid_ds_BeforeBuildInsert";
    $ContactGrid->CCSEvents["BeforeShow"] = "ContactGrid_BeforeShow";
    $ContactGrid->CCSEvents["BeforeSubmit"] = "ContactGrid_BeforeSubmit";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//AddressGrid_tbladminist_addressbook_TotalRecords_BeforeShow @6-F25A2CCA
function AddressGrid_tbladminist_addressbook_TotalRecords_BeforeShow(& $sender)
{
    $AddressGrid_tbladminist_addressbook_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddressGrid; //Compatibility
//End AddressGrid_tbladminist_addressbook_TotalRecords_BeforeShow

//Retrieve number of records @7-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close AddressGrid_tbladminist_addressbook_TotalRecords_BeforeShow @6-6E8FAE7F
    return $AddressGrid_tbladminist_addressbook_TotalRecords_BeforeShow;
}
//End Close AddressGrid_tbladminist_addressbook_TotalRecords_BeforeShow

//AddNewHeader_BeforeShow @15-F3C590C7
function AddNewHeader_BeforeShow(& $sender)
{
    $AddNewHeader_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeShow

//Custom Code @39-2A29BDB7
// -------------------------
	global $AddNewHeader,$ContactGrid;
	if(!$AddNewHeader->EditMode) $ContactGrid->Visible = false;

// -------------------------
//End Custom Code

//Close AddNewHeader_BeforeShow @15-57E968BE
    return $AddNewHeader_BeforeShow;
}
//End Close AddNewHeader_BeforeShow

//AddNewHeader_BeforeDelete @15-5BB1DF18
function AddNewHeader_BeforeDelete(& $sender)
{
    $AddNewHeader_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeDelete

//Custom Code @40-2A29BDB7
	$AddressID = CCGetFromGet("AddressID",0);	
 
  	if(intval($AddressID) >0){
    
		//Create a new database connection object
    	$NewConnection = new clsDBGayaFusionAll();
    	$NewConnection->query("DELETE FROM tblAdminist_AddressBook_Contact WHERE AddressID=".$NewConnection->ToSQL($AddressID,ccsInteger));

    	//Close and destroy the database connection object
    	$NewConnection->close();
	}    
//End Custom Code

//Close AddNewHeader_BeforeDelete @15-30AF98EE
    return $AddNewHeader_BeforeDelete;
}
//End Close AddNewHeader_BeforeDelete

//AddNewHeader_AfterInsert @15-A55E4721
function AddNewHeader_AfterInsert(& $sender)
{
    $AddNewHeader_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_AfterInsert

//Custom Code @41-2A29BDB7
	global $DBGayaFusionAll;	
	global $Redirect,$FileName;

  	$Redirect = $FileName."?AddressID=".CCDLookUp("max(AddressID)","tblAdminist_AddressBook","", $DBGayaFusionAll);
//End Custom Code
//End Custom Code

//Close AddNewHeader_AfterInsert @15-55234D2C
    return $AddNewHeader_AfterInsert;
}
//End Close AddNewHeader_AfterInsert

//ContactGrid_BeforeShowRow @22-379691B1
function ContactGrid_BeforeShowRow(& $sender)
{
    $ContactGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ContactGrid; //Compatibility
//End ContactGrid_BeforeShowRow

//Custom Code @37-2A29BDB7
// -------------------------
	global $ContactGrid;
	global $RowNumber;
  
  	$RowNumber++;
  	$ContactGrid->RowIDAttribute->SetValue($RowNumber);

  	if( ($RowNumber <= $ContactGrid->ds->RecordsCount) && ($RowNumber <= $ContactGrid->PageSize) ){
    	
		$ContactGrid->RowNameAttribute->SetValue("FillRow");

  	}else{ 

		$ContactGrid->RowNameAttribute->SetValue("EmptyRow");
    	$ContactGrid->RowStyleAttribute->SetValue("style='display:none;'");
     	
		if($ContactGrid->EditMode){

		    if($ContactGrid->ErrorMessages[$RowNumber]) $ContactGrid->RowStyleAttribute->SetValue("");
        }
	 }
// -------------------------
//End Custom Code

//Close ContactGrid_BeforeShowRow @22-4DC294AF
    return $ContactGrid_BeforeShowRow;
}
//End Close ContactGrid_BeforeShowRow

//ContactGrid_ds_BeforeBuildInsert @22-2AB67A48
function ContactGrid_ds_BeforeBuildInsert(& $sender)
{
    $ContactGrid_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ContactGrid; //Compatibility
//End ContactGrid_ds_BeforeBuildInsert

//Custom Code @38-2A29BDB7
// -------------------------
 	global $ContactGrid;
	$AddressID = intval(CCGetFromGet("AddressID",0));
	if($AddressID >0){
		$ContactGrid->ds->AddressID->SetValue($AddressID);
  	}
// -------------------------
//End Custom Code

//Close ContactGrid_ds_BeforeBuildInsert @22-55776A81
    return $ContactGrid_ds_BeforeBuildInsert;
}
//End Close ContactGrid_ds_BeforeBuildInsert

//ContactGrid_BeforeShow @22-EA3860E6
function ContactGrid_BeforeShow(& $sender)
{
    $ContactGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ContactGrid; //Compatibility
//End ContactGrid_BeforeShow

//Custom Code @45-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close ContactGrid_BeforeShow @22-A721E3E9
    return $ContactGrid_BeforeShow;
}
//End Close ContactGrid_BeforeShow

//ContactGrid_BeforeSubmit @22-BD4346DD
function ContactGrid_BeforeSubmit(& $sender)
{
    $ContactGrid_BeforeSubmit = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ContactGrid; //Compatibility
//End ContactGrid_BeforeSubmit

//Custom Code @46-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close ContactGrid_BeforeSubmit @22-1B723155
    return $ContactGrid_BeforeSubmit;
}
//End Close ContactGrid_BeforeSubmit

//Panel1_BeforeShow @48-AAD8AF72
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

//Close Panel1_BeforeShow @48-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//Page_BeforeInitialize @1-1D2B4BD6
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddressBook; //Compatibility
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

//Page_AfterInitialize @1-B8AE9A97
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddressBook; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-36317A58
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddressBook; //Compatibility
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

//Page_BeforeOutput @1-05858C07
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddressBook; //Compatibility
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

//Page_BeforeUnload @1-A1516B5A
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddressBook; //Compatibility
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
