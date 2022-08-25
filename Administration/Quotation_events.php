<?php
//BindEvents Method @1-7620930B
function BindEvents()
{
    global $GridList;
    $GridList->tbladminist_client_tbladm1_TotalRecords->CCSEvents["BeforeShow"] = "GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow";
    $GridList->CCSEvents["BeforeShowRow"] = "GridList_BeforeShowRow";
}
//End BindEvents Method

//GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow @12-5A3CBE8C
function GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow(& $sender)
{
    $GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GridList; //Compatibility
//End GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow

//Retrieve number of records @13-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow @12-C50BC8CA
    return $GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow;
}
//End Close GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow

//GridList_BeforeShowRow @2-97EA3250
function GridList_BeforeShowRow(& $sender)
{
    $GridList_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GridList; //Compatibility
//End GridList_BeforeShowRow

//Custom Code @61-2A29BDB7
	$db = new clsDBGayaFusionAll;
	$IDna = $GridList->Quotation_H_ID->GetValue();
	$sql = "SELECT Proforma_H_ID,ProformaNo,ContactID FROM tblAdminist_Proforma_H WHERE Quotation_H_ID = $IDna";
	$db->query($sql);
	$result = $db->next_record();
	if($result){
		$Proforma_H_ID = $db->f("Proforma_H_ID");
		$ContactID = $db->f("ContactID");
		$GridList->LblLink->SetValue("<a target=\"_blank\" href=\"showProforma.php?Proforma_H_ID=$Proforma_H_ID&ContactID=$ContactID\">".$db->f("ProformaNo")."</a>");
	}else{
		$GridList->LblLink->SetValue("<a href=\"AddProforma.php?Quotation_H_ID=$IDna\">Make Proforma</a>");
	}
//End Custom Code

//Close GridList_BeforeShowRow @2-6961D946
    return $GridList_BeforeShowRow;
}
//End Close GridList_BeforeShowRow


?>
