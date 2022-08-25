<?php
//BindEvents Method @1-74B4690C
function BindEvents()
{
    global $EditCollectGroup;
    $EditCollectGroup->GroupPhoto->CCSEvents["BeforeShow"] = "EditCollectGroup_GroupPhoto_BeforeShow";
}
//End BindEvents Method

//EditCollectGroup_GroupPhoto_BeforeShow @13-9CAA1244
function EditCollectGroup_GroupPhoto_BeforeShow(& $sender)
{
    $EditCollectGroup_GroupPhoto_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $EditCollectGroup; //Compatibility
//End EditCollectGroup_GroupPhoto_BeforeShow

//Get Original Filename @34-10353880
    $control_value = $Component->GetValue();
    $original_filename = CCGetOriginalFileName($control_value);
    $Component->SetValue($original_filename);
//End Get Original Filename

//Close EditCollectGroup_GroupPhoto_BeforeShow @13-1615A281
    return $EditCollectGroup_GroupPhoto_BeforeShow;
}
//End Close EditCollectGroup_GroupPhoto_BeforeShow


?>
