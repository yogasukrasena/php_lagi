<?php
//BindEvents Method @1-F0D0E47D
function BindEvents()
{
    global $Search;
    $Search->CCSEvents["BeforeShow"] = "Search_BeforeShow";
}
//End BindEvents Method

//Search_BeforeShow @2-A0C18448
function Search_BeforeShow(& $sender)
{
    $Search_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Search; //Compatibility
//End Search_BeforeShow

//Hide-Show Component @13-286F3E6C
    $Parameter1 = CCGetFromGet("ViewMode", "");
    $Parameter2 = "Print";
    if (0 == CCCompareValues($Parameter1, $Parameter2, ccsText))
        $Component->Visible = false;
//End Hide-Show Component

//Close Search_BeforeShow @2-7A69E9B9
    return $Search_BeforeShow;
}
//End Close Search_BeforeShow


?>
