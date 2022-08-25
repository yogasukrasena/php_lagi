<?php
//BindEvents Method @1-E620D733
function BindEvents()
{
    global $samplepackaging;
    $samplepackaging->TotalRecord->CCSEvents["BeforeShow"] = "samplepackaging_TotalRecord_BeforeShow";
    $samplepackaging->CCSEvents["BeforeShowRow"] = "samplepackaging_BeforeShowRow";
}
//End BindEvents Method

//samplepackaging_TotalRecord_BeforeShow @51-E926DA78
function samplepackaging_TotalRecord_BeforeShow(& $sender)
{
    $samplepackaging_TotalRecord_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $samplepackaging; //Compatibility
//End samplepackaging_TotalRecord_BeforeShow

//Retrieve number of records @52-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close samplepackaging_TotalRecord_BeforeShow @51-83DDDFD6
    return $samplepackaging_TotalRecord_BeforeShow;
}
//End Close samplepackaging_TotalRecord_BeforeShow

//DEL  	$IDnya = $Addsamplepackaging->DesMat1->GetValue();
//DEL  	if($IDnya > 0){
//DEL  		$DB = new clsDBGayaFusionAll;
//DEL  		global $Addsamplepackaging;
//DEL  		$Addsamplepackaging->DelDesMat1->Visible = true;
//DEL  		$Addsamplepackaging->LinkDM1->Visible = false;
//DEL  		$sql = "SELECT tblsupplier.SupCompany, tbldesignmat.DesignMatID, tbldesignmat.DesignMatCode, tbldesignmat.DesignMatDescription, ";
//DEL   $sql = $sql." tbldesignmat.DesignMatSupplier, tbldesignmat.DesignMatUnit, tbldesignmat.DesignMatUnitPrice, ";
//DEL   $sql = $sql." tbldesignmat.DesignMatNotes, tbldesignmat.DesignMatDate, tblunit.UnitValue FROM tbldesignmat ";
//DEL   $sql = $sql." INNER JOIN tblsupplier ON (tbldesignmat.DesignMatSupplier=tblsupplier.ID) INNER JOIN tblunit ON (tbldesignmat.DesignMatUnit=tblunit.UnitID) ";
//DEL   $sql = $sql." WHERE tbldesignmat.DesignMatID = ".$IDnya;
//DEL  		$DB->query($sql);
//DEL  		$result = $DB->next_record();
//DEL  		if($result){
//DEL  			$Addsamplepackaging->DesignMatSup1->SetValue($DB->f("SupCompany"));
//DEL  			$Addsamplepackaging->DesMatDesc1->SetValue($DB->f("DesignMatDescription"));
//DEL  			$Addsamplepackaging->DesignMatUnit1->SetValue($DB->f("UnitValue"));
//DEL  			$Addsamplepackaging->DesignMatUnitPrice1->SetValue($DB->f("DesignMatUnitPrice"));
//DEL  		}
//DEL  		$DB->close();
//DEL  	}else{
//DEL  		$Addsamplepackaging->DelDesMat1->Visible = false;
//DEL  		$Addsamplepackaging->LinkDM1->Visible = true;
//DEL  	}

//DEL  	$IDnya = $Addsamplepackaging->DesMat2->GetValue();
//DEL  	if($IDnya > 0){
//DEL  		$DB = new clsDBGayaFusionAll;
//DEL  		global $Addsamplepackaging;
//DEL  		$Addsamplepackaging->DelDesMat2->Visible = true;
//DEL  		$Addsamplepackaging->LinkDM2->Visible = false;
//DEL  		$sql = "SELECT tblsupplier.SupCompany, tbldesignmat.DesignMatID, tbldesignmat.DesignMatCode, tbldesignmat.DesignMatDescription, ";
//DEL   $sql = $sql." tbldesignmat.DesignMatSupplier, tbldesignmat.DesignMatUnit, tbldesignmat.DesignMatUnitPrice, ";
//DEL   $sql = $sql." tbldesignmat.DesignMatNotes, tbldesignmat.DesignMatDate, tblunit.UnitValue FROM tbldesignmat ";
//DEL   $sql = $sql." INNER JOIN tblsupplier ON (tbldesignmat.DesignMatSupplier=tblsupplier.ID) INNER JOIN tblunit ON (tbldesignmat.DesignMatUnit=tblunit.UnitID) ";
//DEL   $sql = $sql." WHERE tbldesignmat.DesignMatID = ".$IDnya;
//DEL  		$DB->query($sql);
//DEL  		$result = $DB->next_record();
//DEL  		if($result){
//DEL  			$Addsamplepackaging->DesignMatSup2->SetValue($DB->f("SupCompany"));
//DEL  			$Addsamplepackaging->DesMatDesc2->SetValue($DB->f("DesignMatDescription"));
//DEL  			$Addsamplepackaging->DesignMatUnit2->SetValue($DB->f("UnitValue"));
//DEL  			$Addsamplepackaging->DesignMatUnitPrice2->SetValue($DB->f("DesignMatUnitPrice"));
//DEL  		}
//DEL  		$DB->close();
//DEL  	}else{
//DEL  		$Addsamplepackaging->DelDesMat2->Visible = false;
//DEL  		$Addsamplepackaging->LinkDM2->Visible = true;
//DEL  	}

//samplepackaging_BeforeShowRow @2-A9F35B93
function samplepackaging_BeforeShowRow(& $sender)
{
    $samplepackaging_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $samplepackaging; //Compatibility
//End samplepackaging_BeforeShowRow

//Custom Code @78-2A29BDB7
global $DBGayaFusionAll;
$dm1 = $samplepackaging->DesMat1->GetValue();
$dm2 = $samplepackaging->DesMat2->GetValue();
$dm3 = $samplepackaging->DesMat3->GetValue();
$dm4 = $samplepackaging->DesMat4->GetValue();
$dm5 = $samplepackaging->DesMat5->GetValue();
$dmPrice1 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm1, ccsInteger), $DBGayaFusionAll);
$dmPrice2 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm2, ccsInteger), $DBGayaFusionAll);
$dmPrice3 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm3, ccsInteger), $DBGayaFusionAll);
$dmPrice4 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm4, ccsInteger), $DBGayaFusionAll);
$dmPrice5 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm5, ccsInteger), $DBGayaFusionAll);
$TotDM1 = $samplepackaging->QtyDesMat1->GetValue() * $dmPrice1;
$TotDM2 = $samplepackaging->QtyDesMat2->GetValue() * $dmPrice2;
$TotDM3 = $samplepackaging->QtyDesMat3->GetValue() * $dmPrice3;
$TotDM4 = $samplepackaging->QtyDesMat4->GetValue() * $dmPrice4;
$TotDM5 = $samplepackaging->QtyDesMat5->GetValue() * $dmPrice5;
$TotCostPrice = $samplepackaging->TotalCostPrice->GetValue();
$TotCost= $TotCostPrice + $TotDM1 + $TotDM2 + $TotDM3 + $TotDM4 + $TotDM5;
$samplepackaging->TotalCost->SetValue($TotCost);
//End Custom Code

//Close samplepackaging_BeforeShowRow @2-6C899E10
    return $samplepackaging_BeforeShowRow;
}
//End Close samplepackaging_BeforeShowRow


?>