<?php
//BindEvents Method @1-A731AE6B
function BindEvents()
{
    global $Option;
    $Option->CCSEvents["BeforeShow"] = "Option_BeforeShow";
}
//End BindEvents Method

//Option_BeforeShow @5-CB5AA7B2
function Option_BeforeShow(& $sender)
{
    $Option_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Option; //Compatibility
//End Option_BeforeShow

//Custom Code @8-2A29BDB7
	$html = "<ul> li><a href=\"a.php\" id=\"Link1\">FROM QUOTATION</a></li></ul> ";
    $html .= "  <ul><li><a href=\"b.php\" id=\"Link2\">FROM PROFORMA</a></li></ul> ";
    $html .= " <ul><li><a href=\"c.php\" id=\"Link3\">NOT USE ANY DOCUMENTS</a></li></ul>";
	$Option->Label1->SetValue($html);
//End Custom Code

//Close Option_BeforeShow @5-A18F7DAB
    return $Option_BeforeShow;
}
//End Close Option_BeforeShow


?>
