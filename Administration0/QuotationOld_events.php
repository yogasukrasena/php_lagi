<?php
//BindEvents Method @1-E9454446
function BindEvents()
{
    global $GridQuotation;
    global $AddQuotation;
    global $AddItem;
    $GridQuotation->tbladminist_client_tbladm1_TotalRecords->CCSEvents["BeforeShow"] = "GridQuotation_tbladminist_client_tbladm1_TotalRecords_BeforeShow";
    $AddQuotation->CCSEvents["BeforeShow"] = "AddQuotation_BeforeShow";
    $AddQuotation->CCSEvents["AfterInsert"] = "AddQuotation_AfterInsert";
    $AddQuotation->CCSEvents["BeforeDelete"] = "AddQuotation_BeforeDelete";
    $AddQuotation->ds->CCSEvents["BeforeBuildInsert"] = "AddQuotation_ds_BeforeBuildInsert";
    $AddItem->DescArray->CCSEvents["BeforeShow"] = "AddItem_DescArray_BeforeShow";
    $AddItem->PriceArray->CCSEvents["BeforeShow"] = "AddItem_PriceArray_BeforeShow";
    $AddItem->ds->CCSEvents["BeforeBuildInsert"] = "AddItem_ds_BeforeBuildInsert";
    $AddItem->CCSEvents["BeforeShowRow"] = "AddItem_BeforeShowRow";
}
//End BindEvents Method

//GridQuotation_tbladminist_client_tbladm1_TotalRecords_BeforeShow @12-092B0992
function GridQuotation_tbladminist_client_tbladm1_TotalRecords_BeforeShow(& $sender)
{
    $GridQuotation_tbladminist_client_tbladm1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GridQuotation; //Compatibility
//End GridQuotation_tbladminist_client_tbladm1_TotalRecords_BeforeShow

//Retrieve number of records @13-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close GridQuotation_tbladminist_client_tbladm1_TotalRecords_BeforeShow @12-5816FFDF
    return $GridQuotation_tbladminist_client_tbladm1_TotalRecords_BeforeShow;
}
//End Close GridQuotation_tbladminist_client_tbladm1_TotalRecords_BeforeShow

//AddQuotation_BeforeShow @26-C15F9904
function AddQuotation_BeforeShow(& $sender)
{
    $AddQuotation_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddQuotation; //Compatibility
//End AddQuotation_BeforeShow

//Custom Code @53-2A29BDB7
// -------------------------
    global $AddQuotation,$AddItem;
	if(!$AddQuotation->EditMode) $AddItem->Visible = false;

// -------------------------
//End Custom Code

//Close AddQuotation_BeforeShow @26-0B273844
    return $AddQuotation_BeforeShow;
}
//End Close AddQuotation_BeforeShow

//AddQuotation_AfterInsert @26-5796C9B9
function AddQuotation_AfterInsert(& $sender)
{
    $AddQuotation_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddQuotation; //Compatibility
//End AddQuotation_AfterInsert

//Custom Code @55-2A29BDB7
 // -------------------------
    global $DBGayaFusionAll;	
  	global $Redirect,$FileName;
  
    	$Redirect = $FileName."?Quotation_H_ID=".CCDLookUp("max(Quotation_H_ID)","tblAdminist_Quotation_H","", $DBGayaFusionAll);
  // -------------------------

//End Custom Code

//Close AddQuotation_AfterInsert @26-0817987E
    return $AddQuotation_AfterInsert;
}
//End Close AddQuotation_AfterInsert

//AddQuotation_BeforeDelete @26-B39197E9
function AddQuotation_BeforeDelete(& $sender)
{
    $AddQuotation_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddQuotation; //Compatibility
//End AddQuotation_BeforeDelete

//Custom Code @54-2A29BDB7
// -------------------------
     	$Quotation_H_ID = CCGetFromGet("Quotation_H_ID",0);	
   
    	if(intval($Quotation_H_ID) >0){
 		//Create a new database connection object
      	$NewConnection = new clsDBGayaFusionAll();
      	$NewConnection->query("DELETE FROM tblAdminist_Quotation_D WHERE Quotation_H_ID=".$NewConnection->ToSQL($Quotation_H_ID,ccsInteger));
  		}
      	//Close and destroy the database connection object
      	$NewConnection->close();
  // -------------------------
//End Custom Code

//Close AddQuotation_BeforeDelete @26-B5979CE3
    return $AddQuotation_BeforeDelete;
}
//End Close AddQuotation_BeforeDelete

//AddQuotation_ds_BeforeBuildInsert @26-FBEAFED7
function AddQuotation_ds_BeforeBuildInsert(& $sender)
{
    $AddQuotation_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddQuotation; //Compatibility
//End AddQuotation_ds_BeforeBuildInsert

//Custom Code @62-2A29BDB7
// -------------------------
    global $QuotationNo;
	global $AddQuotation;
	global $NoTrans;
	$NewConnection = new clsDBGayaFusionAll();
	$Prefik = "QUO".date(Ym);
	
	$sqlquery = "SELECT * FROM tblAdminist_Quotation_H WHERE QuotationNo LIKE '".$Prefik."%'";
	if ($NewConnection->num_rows->$sqlquery > 0){
		$sqlquery = "SELECT MAX(QuotationNo) FROM tblAdminist_Quotation_H";
		$NoTrans = $NewConnection->query->$sqlquery;
		$NoTrans = "QUO".strval(intval(substr($NoTrans, -2) + 1));
	}
	else{
		$NoTrans = $Prefik."01";
	}
	$AddQuotation->QuotationNo->SetValue($NoTrans);

// -------------------------
//End Custom Code

//Close AddQuotation_ds_BeforeBuildInsert @26-D9E78499
    return $AddQuotation_ds_BeforeBuildInsert;
}
//End Close AddQuotation_ds_BeforeBuildInsert

//AddItem_DescArray_BeforeShow @45-2FD39BF3
function AddItem_DescArray_BeforeShow(& $sender)
{
    $AddItem_DescArray_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddItem; //Compatibility
//End AddItem_DescArray_BeforeShow

//Custom Code @51-2A29BDB7
	global $AddItem;	    
  	$Rnd_Desc_Var = "";
  
      $NewConnection = new clsDBGayaFusionAll();
  	$RnD_Desc_Var = "<script language='JavaScript'> RnD_Desc = new Array ();";
          
      $NewConnection->query("SELECT sID, SampleDescription FROM SampleCeramic");
      while($NewConnection->next_record()){
  
  		$RnD_Desc_Var.=" RnD_Desc[".$NewConnection->f("sID")."]='".$NewConnection->f("SampleDescription")."';";
      			
  	}
  	$RnD_Desc_Var.=" </script>";
      $AddItem->DescArray->SetValue($RnD_Desc_Var);
      
  	//Close and destroy the database connection object
      $NewConnection->close();
//End Custom Code

//Close AddItem_DescArray_BeforeShow @45-4E8C3C14
    return $AddItem_DescArray_BeforeShow;
}
//End Close AddItem_DescArray_BeforeShow

//AddItem_PriceArray_BeforeShow @60-9D5B1F05
function AddItem_PriceArray_BeforeShow(& $sender)
{
    $AddItem_PriceArray_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddItem; //Compatibility
//End AddItem_PriceArray_BeforeShow

//Custom Code @61-2A29BDB7
// -------------------------
   	global $AddItem;	    
  	$Price_Var = "";
  
    $NewConnection = new clsDBGayaFusionAll();
  	$Price_Var = "<script language='JavaScript'> PriceList = new Array ();";
          
      $NewConnection->query("SELECT sID, RealSellingPrice FROM SampleCeramic");
      while($NewConnection->next_record()){
  
  		$Price_Var.=" PriceList[".$NewConnection->f("sID")."]='".$NewConnection->f("RealSellingPrice")."';";
      			
  	}
  	$Price_Var.=" </script>";
      $AddItem->PriceArray->SetValue($Price_Var);
      
  	//Close and destroy the database connection object
      $NewConnection->close();
// -------------------------
//End Custom Code

//Close AddItem_PriceArray_BeforeShow @60-0A79274F
    return $AddItem_PriceArray_BeforeShow;
}
//End Close AddItem_PriceArray_BeforeShow


//AddItem_ds_BeforeBuildInsert @35-34FAB9F5
function AddItem_ds_BeforeBuildInsert(& $sender)
{
    $AddItem_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddItem; //Compatibility
//End AddItem_ds_BeforeBuildInsert

//Custom Code @57-2A29BDB7
// -------------------------
    global $AddItem;
	$Quotation_H_ID = intval(CCGetFromGet("Quotation_H_ID",0));
	if($Quotation_H_ID > 0){
		$AddItem->ds->Quotation_H_ID->SetValue($Quotation_H_ID);
  	}
// -------------------------
//End Custom Code

//Close AddItem_ds_BeforeBuildInsert @35-0EBAB9D4
    return $AddItem_ds_BeforeBuildInsert;
}
//End Close AddItem_ds_BeforeBuildInsert

//AddItem_BeforeShowRow @35-3CC2A234
function AddItem_BeforeShowRow(& $sender)
{
    $AddItem_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddItem; //Compatibility
//End AddItem_BeforeShowRow

//Custom Code @56-2A29BDB7
// -------------------------
    global $AddItem;
	global $RowNumber;
  
  	$RowNumber++;
  	$AddItem->RowIDAttribute->SetValue($RowNumber);

  	if( ($RowNumber <= $AddItem->ds->RecordsCount) && ($RowNumber <= $AddItem->PageSize) ){
    	
		$AddItem->RowNameAttribute->SetValue("FillRow");

  	}else{ 

		$AddItem->RowNameAttribute->SetValue("EmptyRow");
    	$AddItem->RowStyleAttribute->SetValue("style='display:none;'");
     	
		if($AddItem->EditMode){

		    if($AddItem->ErrorMessages[$RowNumber]) $AddItem->RowStyleAttribute->SetValue("");
        }
	 }
// -------------------------
//End Custom Code

//Close AddItem_BeforeShowRow @35-84F0CE02
    return $AddItem_BeforeShowRow;
}
//End Close AddItem_BeforeShowRow
?>