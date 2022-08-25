<?php
//BindEvents Method @1-B31F84E6
function BindEvents()
{
    global $Doc;
    $Doc->CCSEvents["BeforeShow"] = "Doc_BeforeShow";
}
//End BindEvents Method

//Doc_BeforeShow @2-69EBC592
function Doc_BeforeShow(& $sender)
{
    $Doc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Doc; //Compatibility
//End Doc_BeforeShow

//Custom Code @9-2A29BDB7
	$ClientID = CCGetFromGet("ClientID",0);
	$Doc->ClientID->SetValue($ClientID);
//End Custom Code

//Close Doc_BeforeShow @2-45612A5E
    return $Doc_BeforeShow;
}
//End Close Doc_BeforeShow
?>
