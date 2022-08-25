<?php
//BindEvents Method @1-21C53932
function BindEvents()
{
    global $RevRecord;
    $RevRecord->CCSEvents["BeforeUpdate"] = "RevRecord_BeforeUpdate";
}
//End BindEvents Method

//RevRecord_BeforeUpdate @2-A80EF26D
function RevRecord_BeforeUpdate(& $sender)
{
    $RevRecord_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $RevRecord; //Compatibility
//End RevRecord_BeforeUpdate

//Custom Code @7-2A29BDB7
	global $DBGayaFusionAll;
	global $RevRecord;

	$db = new clsDBGayaFusionAll;
	$Quotation_H_ID = CCGetFromGet("Quotation_H_ID", 0);
	if($Quotation_H_ID > 0){
		$sql = "SELECT * FROM tblAdminist_Quotation_H WHERE Quotation_H_ID = $Quotation_H_ID ";
		$db->query($sql);
		$result = $db->next_record();
		if($result){
			$insert = "INSERT INTO `tbladminist_quotationrev_h` (`Quotation_H_ID`, `QuotationNo`, `Rev`, `Validity`, `QuotationDate`, `ClientOrderRef`, `ClientID`, `AddressID`, `ContactID`, `PackagingCost`, `DeliveryTermID`, `DeliveryTimeID`, `PaymentTermID`, `SpecialInstruction`) ";
			$insert = $insert." SELECT * FROM tblAdminist_Quotation_H WHERE Quotation_H_ID = $Quotation_H_ID ";
			$db->query($insert);
		}
		$QuotationRev_H_ID = CCDLookUp("max(QuotationRev_H_ID)","tblAdminist_QuotationRev_H","",$DBGayaFusionAll);
		echo "monyongg <br>";
		echo $QuotationRev_H_ID;
		$sql = "SELECT * FROM tblAdminist_Quotation_D WHERE Quotation_H_ID = $Quotation_H_ID ";
		$db->query($sql);
		$result = $db->next_record();
		if($result){
			$RevText = $RevRecord->Rev->GetValue();
			$insert = "INSERT INTO `tbladminist_quotationrev_d` (`Quotation_D_ID`, `Quotation_H_ID`, `RndCode`, `UnitPrice`, `Remark`) ";
			$insert = $insert."SELECT * FROM tblAdminist_Quotation_D WHERE Quotation_H_ID = $Quotation_H_ID ";
			$db->query($insert);
			$Quotationrev_D_ID = CCDLookUp("max(QuotationRev_D_ID)","tblAdminist_QuotationRev_D","",$db);
			$Update = "UPDATE tblAdminist_QuotationRev_D SET QuotationRev_H_ID = $QuotationRev_H_ID WHERE WHERE QuotationRev_D_ID = $Quotationrev_D_ID";
			$db->query($Update);
		}
		$db->close;
	}
//End Custom Code

//Close RevRecord_BeforeUpdate @2-CEDC05B4
    return $RevRecord_BeforeUpdate;
}
//End Close RevRecord_BeforeUpdate
?>
