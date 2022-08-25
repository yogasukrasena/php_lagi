<?php
//BindEvents Method @1-C9E37CA3
function BindEvents()
{
    global $tbladminist_invoice_h_tbl;
    global $Report_Print;
    $tbladminist_invoice_h_tbl->Navigator->CCSEvents["BeforeShow"] = "tbladminist_invoice_h_tbl_Navigator_BeforeShow";
    $Report_Print->CCSEvents["BeforeShow"] = "Report_Print_BeforeShow";
}
//End BindEvents Method

//tbladminist_invoice_h_tbl_Navigator_BeforeShow @37-25D4C7DB
function tbladminist_invoice_h_tbl_Navigator_BeforeShow(& $sender)
{
    $tbladminist_invoice_h_tbl_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbladminist_invoice_h_tbl; //Compatibility
//End tbladminist_invoice_h_tbl_Navigator_BeforeShow

//Hide-Show Component @38-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close tbladminist_invoice_h_tbl_Navigator_BeforeShow @37-39DA218D
    return $tbladminist_invoice_h_tbl_Navigator_BeforeShow;
}
//End Close tbladminist_invoice_h_tbl_Navigator_BeforeShow

//Report_Print_BeforeShow @24-6CD7E3F9
function Report_Print_BeforeShow(& $sender)
{
    $Report_Print_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report_Print; //Compatibility
//End Report_Print_BeforeShow

//Hide-Show Component @26-286F3E6C
    $Parameter1 = CCGetFromGet("ViewMode", "");
    $Parameter2 = "Print";
    if (0 == CCCompareValues($Parameter1, $Parameter2, ccsText))
        $Component->Visible = false;
//End Hide-Show Component

//Close Report_Print_BeforeShow @24-0DD1CC60
    return $Report_Print_BeforeShow;
}
//End Close Report_Print_BeforeShow


?>
