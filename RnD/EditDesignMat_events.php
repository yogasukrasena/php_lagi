<?php
//BindEvents Method @1-7BC6AF9A
function BindEvents()
{
    global $tbldesignmat;
    $tbldesignmat->ImageLink2->CCSEvents["BeforeShow"] = "tbldesignmat_ImageLink2_BeforeShow";
    $tbldesignmat->DesignMatSupDesc->CCSEvents["BeforeShow"] = "tbldesignmat_DesignMatSupDesc_BeforeShow";
    $tbldesignmat->ImageLink1->CCSEvents["BeforeShow"] = "tbldesignmat_ImageLink1_BeforeShow";
}
//End BindEvents Method

//tbldesignmat_ImageLink2_BeforeShow @27-3781DE97
function tbldesignmat_ImageLink2_BeforeShow(& $sender)
{
    $tbldesignmat_ImageLink2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbldesignmat; //Compatibility
//End tbldesignmat_ImageLink2_BeforeShow

//Custom Code @33-2A29BDB7
	global $tbldesignmat;
	$supid = $tbldesignmat->DesignMatUnit->GetValue();
	if(!$supid == ""){
		$tbldesignmat->ImageLink2->Visible = false;
		$tbldesignmat->DelUnit->Visible = true;
	}else{
		$tbldesignmat->ImageLink2->Visible= true;
		$tbldesignmat->DelUnit->Visible = false;
	}
//End Custom Code

//Close tbldesignmat_ImageLink2_BeforeShow @27-94089FDB
    return $tbldesignmat_ImageLink2_BeforeShow;
}
//End Close tbldesignmat_ImageLink2_BeforeShow

//tbldesignmat_DesignMatSupDesc_BeforeShow @25-117DAD22
function tbldesignmat_DesignMatSupDesc_BeforeShow(& $sender)
{
    $tbldesignmat_DesignMatSupDesc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbldesignmat; //Compatibility
//End tbldesignmat_DesignMatSupDesc_BeforeShow

//Custom Code @30-2A29BDB7
	global $tbldesignmat;
	global $DBGayaFusionAll;
	$SupID = $tbldesignmat->DesignMatSupplier->GetValue();
	$tbldesignmat->DesignMatSupDesc->SetValue(CCDLookUp("SupCompany","tblSupplier","ID = $SupID",$DBGayaFusionAll));
//End Custom Code

//Close tbldesignmat_DesignMatSupDesc_BeforeShow @25-437B175E
    return $tbldesignmat_DesignMatSupDesc_BeforeShow;
}
//End Close tbldesignmat_DesignMatSupDesc_BeforeShow

//tbldesignmat_ImageLink1_BeforeShow @28-C8F230D0
function tbldesignmat_ImageLink1_BeforeShow(& $sender)
{
    $tbldesignmat_ImageLink1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbldesignmat; //Compatibility
//End tbldesignmat_ImageLink1_BeforeShow

//Custom Code @32-2A29BDB7
	global $tbldesignmat;
	$supid = $tbldesignmat->DesignMatSupplier->GetValue();
	if(!$supid == ""){
		$tbldesignmat->ImageLink1->Visible = false;
		$tbldesignmat->DelSup->Visible = true;
	}else{
		$tbldesignmat->ImageLink1->Visible= true;
		$tbldesignmat->DelSup->Visible = false;
	}
//End Custom Code

//Close tbldesignmat_ImageLink1_BeforeShow @28-E869BA00
    return $tbldesignmat_ImageLink1_BeforeShow;
}
//End Close tbldesignmat_ImageLink1_BeforeShow


?>
