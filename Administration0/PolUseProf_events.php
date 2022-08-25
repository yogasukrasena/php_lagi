<?php
//BindEvents Method @1-1FB59B56
function BindEvents()
{
    global $NewPol;
    $NewPol->CCSEvents["BeforeShow"] = "NewPol_BeforeShow";
}
//End BindEvents Method

//NewPol_BeforeShow @2-02816CDA
function NewPol_BeforeShow(& $sender)
{
    $NewPol_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $NewPol; //Compatibility
//End NewPol_BeforeShow

//Custom Code @6-2A29BDB7
global $DBGayaFusionAll;
$Proforma_H_ID = CCGetFromGet("Proforma_H_ID", 0);
if($Proforma_H_ID > 0){
	$Prefix = "POL".date(Ym);
	$sqlquery = "SELECT POL_H_ID FROM tblAdminist_POL_H WHERE POLNo LIKE '".$Prefix."%'";
	$jumlah = mysql_num_rows(mysql_query($sqlquery));
	if($jumlah > 0){
		$sqlquery = "SELECT MAX(POLNo) FROM tblAdminist_POL_H";
		$NoTrans = mysql_fetch_array(mysql_query($sqlquery));
		$NoTrans = $Prefix.substr("0".strval(intval(substr($NoTrans[0],-2)+1)),-2);
	}else{
		$NoTrans = $Prefix."01";
	}
	$tgl = date('Y-m-d');
	$DBGayaFusionAll->query("INSERT INTO tblAdminist_Pol_H (PolNo, Proforma_H_ID, POLDate) VALUES (".$DBGayaFusionAll->ToSQL($NoTrans,ccsText).", ".$DBGayaFusionAll->ToSQL($Proforma_H_ID, ccsInteger).",".$DBGayaFusionAll->ToSQL($tgl,ccsDate).")");

}
//End Custom Code

//Close NewPol_BeforeShow @2-22A31418
    return $NewPol_BeforeShow;
}
//End Close NewPol_BeforeShow
?>