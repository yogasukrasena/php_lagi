<?php
//BindEvents Method @1-8855FEC8
function BindEvents()
{
    global $AddSamplePackaging;
    $AddSamplePackaging->DesMat1->CCSEvents["BeforeShow"] = "AddSamplePackaging_DesMat1_BeforeShow";
    $AddSamplePackaging->DesMat2->CCSEvents["BeforeShow"] = "AddSamplePackaging_DesMat2_BeforeShow";
    $AddSamplePackaging->DesMat3->CCSEvents["BeforeShow"] = "AddSamplePackaging_DesMat3_BeforeShow";
    $AddSamplePackaging->DesMat4->CCSEvents["BeforeShow"] = "AddSamplePackaging_DesMat4_BeforeShow";
    $AddSamplePackaging->DesMat5->CCSEvents["BeforeShow"] = "AddSamplePackaging_DesMat5_BeforeShow";
    $AddSamplePackaging->CCSEvents["BeforeShow"] = "AddSamplePackaging_BeforeShow";
}
//End BindEvents Method

//AddSamplePackaging_DesMat1_BeforeShow @17-37D82A41
function AddSamplePackaging_DesMat1_BeforeShow(& $sender)
{
    $AddSamplePackaging_DesMat1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_DesMat1_BeforeShow

//Custom Code @109-2A29BDB7
	$IDnya = $AddSamplePackaging->DesMat1->GetValue();
	if($IDnya > 0){
		$DB = new clsDBGayaFusionAll;
		global $AddSamplePackaging;
		$AddSamplePackaging->DelDesMat1->Visible = true;
		$AddSamplePackaging->LinkDM1->Visible = false;
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
	}else{
		$AddSamplePackaging->DelDesMat1->Visible = false;
		$AddSamplePackaging->LinkDM1->Visible = true;
	}
//End Custom Code

//Close AddSamplePackaging_DesMat1_BeforeShow @17-3EE75123
    return $AddSamplePackaging_DesMat1_BeforeShow;
}
//End Close AddSamplePackaging_DesMat1_BeforeShow

//AddSamplePackaging_DesMat2_BeforeShow @18-50581E00
function AddSamplePackaging_DesMat2_BeforeShow(& $sender)
{
    $AddSamplePackaging_DesMat2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_DesMat2_BeforeShow

//Custom Code @110-2A29BDB7
	$IDnya = $AddSamplePackaging->DesMat2->GetValue();
	if($IDnya > 0){
		$DB = new clsDBGayaFusionAll;
		global $AddSamplePackaging;
		$AddSamplePackaging->DelDesMat2->Visible = true;
		$AddSamplePackaging->LinkDM2->Visible = false;
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
	}else{
		$AddSamplePackaging->DelDesMat2->Visible = false;
		$AddSamplePackaging->LinkDM2->Visible = true;
	}
//End Custom Code

//Close AddSamplePackaging_DesMat2_BeforeShow @18-428674F8
    return $AddSamplePackaging_DesMat2_BeforeShow;
}
//End Close AddSamplePackaging_DesMat2_BeforeShow

//AddSamplePackaging_DesMat3_BeforeShow @19-C408F000
function AddSamplePackaging_DesMat3_BeforeShow(& $sender)
{
    $AddSamplePackaging_DesMat3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_DesMat3_BeforeShow

//Custom Code @111-2A29BDB7
$IDnya = $AddSamplePackaging->DesMat3->GetValue();
	if($IDnya > 0){
		$DB = new clsDBGayaFusionAll;
		global $AddSamplePackaging;
		$AddSamplePackaging->DelDesMat3->Visible = true;
		$AddSamplePackaging->LinkDM3->Visible = false;
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
	}else{
		$AddSamplePackaging->DelDesMat3->Visible = false;
		$AddSamplePackaging->LinkDM3->Visible = true;
	}
//End Custom Code

//Close AddSamplePackaging_DesMat3_BeforeShow @19-DF89958E
    return $AddSamplePackaging_DesMat3_BeforeShow;
}
//End Close AddSamplePackaging_DesMat3_BeforeShow

//AddSamplePackaging_DesMat4_BeforeShow @20-9F587682
function AddSamplePackaging_DesMat4_BeforeShow(& $sender)
{
    $AddSamplePackaging_DesMat4_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_DesMat4_BeforeShow

//Custom Code @112-2A29BDB7
$IDnya = $AddSamplePackaging->DesMat4->GetValue();
	if($IDnya > 0){
		$DB = new clsDBGayaFusionAll;
		global $AddSamplePackaging;
		$AddSamplePackaging->DelDesMat4->Visible = true;
		$AddSamplePackaging->LinkDM4->Visible = false;
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
	}else{
		$AddSamplePackaging->DelDesMat4->Visible = false;
		$AddSamplePackaging->LinkDM4->Visible = true;
	}
//End Custom Code

//Close AddSamplePackaging_DesMat4_BeforeShow @20-BA443F4E
    return $AddSamplePackaging_DesMat4_BeforeShow;
}
//End Close AddSamplePackaging_DesMat4_BeforeShow

//AddSamplePackaging_DesMat5_BeforeShow @21-0B089882
function AddSamplePackaging_DesMat5_BeforeShow(& $sender)
{
    $AddSamplePackaging_DesMat5_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_DesMat5_BeforeShow

//Custom Code @113-2A29BDB7
$IDnya = $AddSamplePackaging->DesMat5->GetValue();
	if($IDnya > 0){
		$DB = new clsDBGayaFusionAll;
		global $AddSamplePackaging;
		$AddSamplePackaging->DelDesMat5->Visible = true;
		$AddSamplePackaging->LinkDM5->Visible = false;
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
	}else{
		$AddSamplePackaging->DelDesMat5->Visible = false;
		$AddSamplePackaging->LinkDM5->Visible = true;
	}
//End Custom Code

//Close AddSamplePackaging_DesMat5_BeforeShow @21-274BDE38
    return $AddSamplePackaging_DesMat5_BeforeShow;
}
//End Close AddSamplePackaging_DesMat5_BeforeShow

//DEL  	

//AddSamplePackaging_BeforeShow @2-387A9D1B
function AddSamplePackaging_BeforeShow(& $sender)
{
    $AddSamplePackaging_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSamplePackaging; //Compatibility
//End AddSamplePackaging_BeforeShow

//Custom Code @103-2A29BDB7
//before show, select the suppliers based on their id
	global $AddSamplePackaging;
	global $DBGayaFusionAll;

	$id = CCGetFromGet("ID", 0);
	for($i=1 ; $i<=5; $i++){
		$fieldsupname = "Supplier".$i;
		$SupplierID = CCDLookUp($fieldsupname,"samplepackaging","ID = $id",$DBGayaFusionAll);
		switch($i) {
			case 1:
				$AddSamplePackaging->SupDesc1->SetValue(CCDLookUp("SupCompany","tblSupplier","ID = $SupplierID",$DBGayaFusionAll));
				break;
			case 2:
				$AddSamplePackaging->SupDesc2->SetValue(CCDLookUp("SupCompany","tblSupplier","ID = $SupplierID",$DBGayaFusionAll));
				break;
			case 3:
				$AddSamplePackaging->SupDesc3->SetValue(CCDLookUp("SupCompany","tblSupplier","ID = $SupplierID",$DBGayaFusionAll));
				break;
			case 4:
				$AddSamplePackaging->SupDesc4->SetValue(CCDLookUp("SupCompany","tblSupplier","ID = $SupplierID",$DBGayaFusionAll));
				break;
			case 5:
				$AddSamplePackaging->SupDesc5->SetValue(CCDLookUp("SupCompany","tblSupplier","ID = $SupplierID",$DBGayaFusionAll));
				break;
		}

	}

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
;//End Custom Code

//Close AddSamplePackaging_BeforeShow @2-9CE7A340
    return $AddSamplePackaging_BeforeShow;
}
//End Close AddSamplePackaging_BeforeShow


?>
