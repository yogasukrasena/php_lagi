<?php
//BindEvents Method @1-7F4B8FDE
function BindEvents()
{
    global $AddSamplePackaging;
    $AddSamplePackaging->DesMat1->CCSEvents["BeforeShow"] = "AddSamplePackaging_DesMat1_BeforeShow";
    $AddSamplePackaging->DesMat2->CCSEvents["BeforeShow"] = "AddSamplePackaging_DesMat2_BeforeShow";
    $AddSamplePackaging->DesMat3->CCSEvents["BeforeShow"] = "AddSamplePackaging_DesMat3_BeforeShow";
    $AddSamplePackaging->DesMat4->CCSEvents["BeforeShow"] = "AddSamplePackaging_DesMat4_BeforeShow";
    $AddSamplePackaging->DesMat5->CCSEvents["BeforeShow"] = "AddSamplePackaging_DesMat5_BeforeShow";
    $AddSamplePackaging->SupDesc1->CCSEvents["BeforeShow"] = "AddSamplePackaging_SupDesc1_BeforeShow";
    $AddSamplePackaging->SupDesc2->CCSEvents["BeforeShow"] = "AddSamplePackaging_SupDesc2_BeforeShow";
    $AddSamplePackaging->SupDesc3->CCSEvents["BeforeShow"] = "AddSamplePackaging_SupDesc3_BeforeShow";
    $AddSamplePackaging->SupDesc4->CCSEvents["BeforeShow"] = "AddSamplePackaging_SupDesc4_BeforeShow";
    $AddSamplePackaging->SupDesc5->CCSEvents["BeforeShow"] = "AddSamplePackaging_SupDesc5_BeforeShow";
    $AddSamplePackaging->lblKG->CCSEvents["BeforeShow"] = "AddSamplePackaging_lblKG_BeforeShow";
    $AddSamplePackaging->CCSEvents["BeforeShow"] = "AddSamplePackaging_BeforeShow";
}
//End BindEvents Method

//AddSamplePackaging_DesMat1_BeforeShow @59-37D82A41
function AddSamplePackaging_DesMat1_BeforeShow(& $sender)
{
    $AddSamplePackaging_DesMat1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_DesMat1_BeforeShow

//Custom Code @60-2A29BDB7
$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$DB = new clsDBGayaFusionAll;
		global $AddSamplePackaging;
		$IDnya = $AddSamplePackaging->DesMat1->GetValue();
		$sql = "SELECT tblsupplier.SupCompany, tbldesignmat.DesignMatID, tbldesignmat.DesignMatCode, tbldesignmat.DesignMatDescription, ";
 $sql = $sql." tbldesignmat.DesignMatSupplier, tbldesignmat.DesignMatUnit, tbldesignmat.DesignMatUnitPrice, ";
 $sql = $sql." tbldesignmat.DesignMatNotes, tbldesignmat.DesignMatDate, tblunit.UnitValue FROM tbldesignmat ";
 $sql = $sql." INNER JOIN tblsupplier ON (tbldesignmat.DesignMatSupplier=tblsupplier.ID) INNER JOIN tblunit ON (tbldesignmat.DesignMatUnit=tblunit.UnitID) ";
 $sql = $sql." WHERE tbldesignmat.DesignMatID = ".$IDnya;
		$DB->query($sql);
		$result = $DB->next_record();
		if($result){
			$AddSamplePackaging->DesignMatSup1->SetValue($DB->f("SupCompany"));
			$AddSamplePackaging->DesMatDesc1->SetValue($DB->f("DesignMatDescription"));
			$AddSamplePackaging->DesignMatUnit1->SetValue($DB->f("UnitValue"));
			$AddSamplePackaging->DesignMatUnitPrice1->SetValue($DB->f("DesignMatUnitPrice"));
		}
		$DB->close();
	}
//End Custom Code

//Close AddSamplePackaging_DesMat1_BeforeShow @59-3EE75123
    return $AddSamplePackaging_DesMat1_BeforeShow;
}
//End Close AddSamplePackaging_DesMat1_BeforeShow

//AddSamplePackaging_DesMat2_BeforeShow @61-50581E00
function AddSamplePackaging_DesMat2_BeforeShow(& $sender)
{
    $AddSamplePackaging_DesMat2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_DesMat2_BeforeShow

//Custom Code @62-2A29BDB7
$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$DB = new clsDBGayaFusionAll;
		global $AddSamplePackaging;
		$IDnya = $AddSamplePackaging->DesMat2->GetValue();
		$sql = "SELECT tblsupplier.SupCompany, tbldesignmat.DesignMatID, tbldesignmat.DesignMatCode, tbldesignmat.DesignMatDescription, ";
 $sql = $sql." tbldesignmat.DesignMatSupplier, tbldesignmat.DesignMatUnit, tbldesignmat.DesignMatUnitPrice, ";
 $sql = $sql." tbldesignmat.DesignMatNotes, tbldesignmat.DesignMatDate, tblunit.UnitValue FROM tbldesignmat ";
 $sql = $sql." INNER JOIN tblsupplier ON (tbldesignmat.DesignMatSupplier=tblsupplier.ID) INNER JOIN tblunit ON (tbldesignmat.DesignMatUnit=tblunit.UnitID) ";
 $sql = $sql." WHERE tbldesignmat.DesignMatID = ".$IDnya;
		$DB->query($sql);
		$result = $DB->next_record();
		if($result){
			$AddSamplePackaging->DesignMatSup2->SetValue($DB->f("SupCompany"));
			$AddSamplePackaging->DesMatDesc2->SetValue($DB->f("DesignMatDescription"));
			$AddSamplePackaging->DesignMatUnit2->SetValue($DB->f("UnitValue"));
			$AddSamplePackaging->DesignMatUnitPrice2->SetValue($DB->f("DesignMatUnitPrice"));
		}
		$DB->close();
	}
//End Custom Code

//Close AddSamplePackaging_DesMat2_BeforeShow @61-428674F8
    return $AddSamplePackaging_DesMat2_BeforeShow;
}
//End Close AddSamplePackaging_DesMat2_BeforeShow

//AddSamplePackaging_DesMat3_BeforeShow @63-C408F000
function AddSamplePackaging_DesMat3_BeforeShow(& $sender)
{
    $AddSamplePackaging_DesMat3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_DesMat3_BeforeShow

//Custom Code @64-2A29BDB7
$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$DB = new clsDBGayaFusionAll;
		global $AddSamplePackaging;
		$IDnya = $AddSamplePackaging->DesMat3->GetValue();
		$sql = "SELECT tblsupplier.SupCompany, tbldesignmat.DesignMatID, tbldesignmat.DesignMatCode, tbldesignmat.DesignMatDescription, ";
 $sql = $sql." tbldesignmat.DesignMatSupplier, tbldesignmat.DesignMatUnit, tbldesignmat.DesignMatUnitPrice, ";
 $sql = $sql." tbldesignmat.DesignMatNotes, tbldesignmat.DesignMatDate, tblunit.UnitValue FROM tbldesignmat ";
 $sql = $sql." INNER JOIN tblsupplier ON (tbldesignmat.DesignMatSupplier=tblsupplier.ID) INNER JOIN tblunit ON (tbldesignmat.DesignMatUnit=tblunit.UnitID) ";
 $sql = $sql." WHERE tbldesignmat.DesignMatID = ".$IDnya;
		$DB->query($sql);
		$result = $DB->next_record();
		if($result){
			$AddSamplePackaging->DesignMatSup3->SetValue($DB->f("SupCompany"));
			$AddSamplePackaging->DesMatDesc3->SetValue($DB->f("DesignMatDescription"));
			$AddSamplePackaging->DesignMatUnit3->SetValue($DB->f("UnitValue"));
			$AddSamplePackaging->DesignMatUnitPrice3->SetValue($DB->f("DesignMatUnitPrice"));
		}
		$DB->close();
	}
//End Custom Code

//Close AddSamplePackaging_DesMat3_BeforeShow @63-DF89958E
    return $AddSamplePackaging_DesMat3_BeforeShow;
}
//End Close AddSamplePackaging_DesMat3_BeforeShow

//AddSamplePackaging_DesMat4_BeforeShow @65-9F587682
function AddSamplePackaging_DesMat4_BeforeShow(& $sender)
{
    $AddSamplePackaging_DesMat4_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_DesMat4_BeforeShow

//Custom Code @66-2A29BDB7
$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$DB = new clsDBGayaFusionAll;
		global $AddSamplePackaging;
		$IDnya = $AddSamplePackaging->DesMat4->GetValue();
		$sql = "SELECT tblsupplier.SupCompany, tbldesignmat.DesignMatID, tbldesignmat.DesignMatCode, tbldesignmat.DesignMatDescription, ";
 $sql = $sql." tbldesignmat.DesignMatSupplier, tbldesignmat.DesignMatUnit, tbldesignmat.DesignMatUnitPrice, ";
 $sql = $sql." tbldesignmat.DesignMatNotes, tbldesignmat.DesignMatDate, tblunit.UnitValue FROM tbldesignmat ";
 $sql = $sql." INNER JOIN tblsupplier ON (tbldesignmat.DesignMatSupplier=tblsupplier.ID) INNER JOIN tblunit ON (tbldesignmat.DesignMatUnit=tblunit.UnitID) ";
 $sql = $sql." WHERE tbldesignmat.DesignMatID = ".$IDnya;
		$DB->query($sql);
		$result = $DB->next_record();
		if($result){
			$AddSamplePackaging->DesignMatSup4->SetValue($DB->f("SupCompany"));
			$AddSamplePackaging->DesMatDesc4->SetValue($DB->f("DesignMatDescription"));
			$AddSamplePackaging->DesignMatUnit4->SetValue($DB->f("UnitValue"));
			$AddSamplePackaging->DesignMatUnitPrice4->SetValue($DB->f("DesignMatUnitPrice"));
		}
		$DB->close();
	}
//End Custom Code

//Close AddSamplePackaging_DesMat4_BeforeShow @65-BA443F4E
    return $AddSamplePackaging_DesMat4_BeforeShow;
}
//End Close AddSamplePackaging_DesMat4_BeforeShow

//AddSamplePackaging_DesMat5_BeforeShow @67-0B089882
function AddSamplePackaging_DesMat5_BeforeShow(& $sender)
{
    $AddSamplePackaging_DesMat5_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_DesMat5_BeforeShow

//Custom Code @68-2A29BDB7
$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$DB = new clsDBGayaFusionAll;
		global $AddSamplePackaging;
		$IDnya = $AddSamplePackaging->DesMat5->GetValue();
		$sql = "SELECT tblsupplier.SupCompany, tbldesignmat.DesignMatID, tbldesignmat.DesignMatCode, tbldesignmat.DesignMatDescription, ";
 $sql = $sql." tbldesignmat.DesignMatSupplier, tbldesignmat.DesignMatUnit, tbldesignmat.DesignMatUnitPrice, ";
 $sql = $sql." tbldesignmat.DesignMatNotes, tbldesignmat.DesignMatDate, tblunit.UnitValue FROM tbldesignmat ";
 $sql = $sql." INNER JOIN tblsupplier ON (tbldesignmat.DesignMatSupplier=tblsupplier.ID) INNER JOIN tblunit ON (tbldesignmat.DesignMatUnit=tblunit.UnitID) ";
 $sql = $sql." WHERE tbldesignmat.DesignMatID = ".$IDnya;
		$DB->query($sql);
		$result = $DB->next_record();
		if($result){
			$AddSamplePackaging->DesignMatSup5->SetValue($DB->f("SupCompany"));
			$AddSamplePackaging->DesMatDesc5->SetValue($DB->f("DesignMatDescription"));
			$AddSamplePackaging->DesignMatUnit5->SetValue($DB->f("UnitValue"));
			$AddSamplePackaging->DesignMatUnitPrice5->SetValue($DB->f("DesignMatUnitPrice"));
		}
		$DB->close();
	}
//End Custom Code

//Close AddSamplePackaging_DesMat5_BeforeShow @67-274BDE38
    return $AddSamplePackaging_DesMat5_BeforeShow;
}
//End Close AddSamplePackaging_DesMat5_BeforeShow

//AddSamplePackaging_SupDesc1_BeforeShow @89-A709E51A
function AddSamplePackaging_SupDesc1_BeforeShow(& $sender)
{
    $AddSamplePackaging_SupDesc1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_SupDesc1_BeforeShow

//Custom Code @94-2A29BDB7
global $DBGayaFusionAll;
	$supid = $AddSamplePackaging->Supplier1->GetValue();
	if($supid > 0){
		$AddSamplePackaging->SupDesc1->SetValue(CCDLookUp("SupCompany","tblSupplier","ID = $supid",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSamplePackaging_SupDesc1_BeforeShow @89-A473F907
    return $AddSamplePackaging_SupDesc1_BeforeShow;
}
//End Close AddSamplePackaging_SupDesc1_BeforeShow

//AddSamplePackaging_SupDesc2_BeforeShow @90-2C56D9F2
function AddSamplePackaging_SupDesc2_BeforeShow(& $sender)
{
    $AddSamplePackaging_SupDesc2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_SupDesc2_BeforeShow

//Custom Code @95-2A29BDB7
global $DBGayaFusionAll;
	$supid = $AddSamplePackaging->Supplier2->GetValue();
	if($supid > 0){
		$AddSamplePackaging->SupDesc2->SetValue(CCDLookUp("SupCompany","tblSupplier","ID = $supid",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSamplePackaging_SupDesc2_BeforeShow @90-D812DCDC
    return $AddSamplePackaging_SupDesc2_BeforeShow;
}
//End Close AddSamplePackaging_SupDesc2_BeforeShow

//AddSamplePackaging_SupDesc3_BeforeShow @91-5563CDAA
function AddSamplePackaging_SupDesc3_BeforeShow(& $sender)
{
    $AddSamplePackaging_SupDesc3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_SupDesc3_BeforeShow

//Custom Code @96-2A29BDB7
global $DBGayaFusionAll;
	$supid = $AddSamplePackaging->Supplier3->GetValue();
	if($supid > 0){
		$AddSamplePackaging->SupDesc3->SetValue(CCDLookUp("SupCompany","tblSupplier","ID = $supid",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSamplePackaging_SupDesc3_BeforeShow @91-451D3DAA
    return $AddSamplePackaging_SupDesc3_BeforeShow;
}
//End Close AddSamplePackaging_SupDesc3_BeforeShow

//AddSamplePackaging_SupDesc4_BeforeShow @92-E199A663
function AddSamplePackaging_SupDesc4_BeforeShow(& $sender)
{
    $AddSamplePackaging_SupDesc4_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_SupDesc4_BeforeShow

//Custom Code @97-2A29BDB7
global $DBGayaFusionAll;
	$supid = $AddSamplePackaging->Supplier4->GetValue();
	if($supid > 0){
		$AddSamplePackaging->SupDesc4->SetValue(CCDLookUp("SupCompany","tblSupplier","ID = $supid",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSamplePackaging_SupDesc4_BeforeShow @92-20D0976A
    return $AddSamplePackaging_SupDesc4_BeforeShow;
}
//End Close AddSamplePackaging_SupDesc4_BeforeShow

//AddSamplePackaging_SupDesc5_BeforeShow @93-98ACB23B
function AddSamplePackaging_SupDesc5_BeforeShow(& $sender)
{
    $AddSamplePackaging_SupDesc5_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_SupDesc5_BeforeShow

//Custom Code @98-2A29BDB7
global $DBGayaFusionAll;
	$supid = $AddSamplePackaging->Supplier5->GetValue();
	if($supid > 0){
		$AddSamplePackaging->SupDesc5->SetValue(CCDLookUp("SupCompany","tblSupplier","ID = $supid",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSamplePackaging_SupDesc5_BeforeShow @93-BDDF761C
    return $AddSamplePackaging_SupDesc5_BeforeShow;
}
//End Close AddSamplePackaging_SupDesc5_BeforeShow

//AddSamplePackaging_lblKG_BeforeShow @99-40C4062B
function AddSamplePackaging_lblKG_BeforeShow(& $sender)
{
    $AddSamplePackaging_lblKG_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_lblKG_BeforeShow

//Custom Code @100-2A29BDB7
	$width = $AddSamplePackaging->Width->GetValue();
	if(!$width == ""){
		$AddSamplePackaging->lblKG->SetValue("KG");
	}
//End Custom Code

//Close AddSamplePackaging_lblKG_BeforeShow @99-607EF1DB
    return $AddSamplePackaging_lblKG_BeforeShow;
}
//End Close AddSamplePackaging_lblKG_BeforeShow

//AddSamplePackaging_BeforeShow @2-387A9D1B
function AddSamplePackaging_BeforeShow(& $sender)
{
    $AddSamplePackaging_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_BeforeShow

//Custom Code @101-2A29BDB7
global $DBGayaFusionAll;
$dm1 = $AddSamplePackaging->DesMat1->GetValue();
$dm2 = $AddSamplePackaging->DesMat2->GetValue();
$dm3 = $AddSamplePackaging->DesMat3->GetValue();
$dm4 = $AddSamplePackaging->DesMat4->GetValue();
$dm5 = $AddSamplePackaging->DesMat5->GetValue();
$dmPrice1 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm1, ccsInteger), $DBGayaFusionAll);
$dmPrice2 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm2, ccsInteger), $DBGayaFusionAll);
$dmPrice3 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm3, ccsInteger), $DBGayaFusionAll);
$dmPrice4 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm4, ccsInteger), $DBGayaFusionAll);
$dmPrice5 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm5, ccsInteger), $DBGayaFusionAll);
$TotDM1 = $AddSamplePackaging->QtyDesMat1->GetValue() * $dmPrice1;
$TotDM2 = $AddSamplePackaging->QtyDesMat2->GetValue() * $dmPrice2;
$TotDM3 = $AddSamplePackaging->QtyDesMat3->GetValue() * $dmPrice3;
$TotDM4 = $AddSamplePackaging->QtyDesMat4->GetValue() * $dmPrice4;
$TotDM5 = $AddSamplePackaging->QtyDesMat5->GetValue() * $dmPrice5;
$AddSamplePackaging->TotalDesMat1->SetValue($TotDM1);
$AddSamplePackaging->TotalDesMat2->SetValue($TotDM2);
$AddSamplePackaging->TotalDesMat3->SetValue($TotDM3);
$AddSamplePackaging->TotalDesMat4->SetValue($TotDM4);
$AddSamplePackaging->TotalDesMat5->SetValue($TotDM5);
$TotDMAll = $TotDM1 + $TotDM2 + $TotDM3 + $TotDM4 + $TotDM5;
$AddSamplePackaging->TotalDesMat->SetValue($TotDMAll);
$TotCostPrice = $AddSamplePackaging->TotalCostPrice->GetValue();
$AddSamplePackaging->TotalCost->SetValue($TotDMAll + $TotCostPrice);
//End Custom Code

//Close AddSamplePackaging_BeforeShow @2-9CE7A340
    return $AddSamplePackaging_BeforeShow;
}
//End Close AddSamplePackaging_BeforeShow
?>
