<?php
//BindEvents Method @1-A3E4CCB3
function BindEvents()
{
    global $tbltexture;
    $tbltexture->tbltexture_TotalRecords->CCSEvents["BeforeShow"] = "tbltexture_tbltexture_TotalRecords_BeforeShow";
    $tbltexture->CCSEvents["BeforeShow"] = "tbltexture_BeforeShow";
}
//End BindEvents Method

//tbltexture_tbltexture_TotalRecords_BeforeShow @7-563CC354
function tbltexture_tbltexture_TotalRecords_BeforeShow(& $sender)
{
    $tbltexture_tbltexture_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbltexture; //Compatibility
//End tbltexture_tbltexture_TotalRecords_BeforeShow

//Retrieve number of records @8-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tbltexture_tbltexture_TotalRecords_BeforeShow @7-9908C8B3
    return $tbltexture_tbltexture_TotalRecords_BeforeShow;
}
//End Close tbltexture_tbltexture_TotalRecords_BeforeShow

//tbltexture_BeforeShow @6-9FA80241
function tbltexture_BeforeShow(& $sender)
{
    $tbltexture_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbltexture; //Compatibility
//End tbltexture_BeforeShow

//Custom Code @30-2A29BDB7
	global $Tpl;
	$txtID = CCGetFromGet("txtID", 0);
	$txtdesc = CCGetFromGet("txtdesc", "");

	$Tpl->setvar('txtID', $txtID);
	$Tpl->setvar('txtdesc', $txtdesc);

//End Custom Code

//Close tbltexture_BeforeShow @6-DB6E0593
    return $tbltexture_BeforeShow;
}
//End Close tbltexture_BeforeShow


?>
