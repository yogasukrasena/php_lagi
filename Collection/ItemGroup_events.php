<?php
//BindEvents Method @1-A6B6C226
function BindEvents()
{
    global $GroupHeader;
    global $ItemList;
    $GroupHeader->CCSEvents["BeforeShow"] = "GroupHeader_BeforeShow";
    $ItemList->CCSEvents["BeforeShowRow"] = "ItemList_BeforeShowRow";
    $ItemList->ds->CCSEvents["BeforeBuildInsert"] = "ItemList_ds_BeforeBuildInsert";
}
//End BindEvents Method

//GroupHeader_BeforeShow @51-4E7BC49C
function GroupHeader_BeforeShow(& $sender)
{
    $GroupHeader_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GroupHeader; //Compatibility
//End GroupHeader_BeforeShow

//Custom Code @139-2A29BDB7
	global $GroupHeader;
	$Group_H_ID = CCGetFromGet("Group_H_ID", 0);
	if($Group_H_ID > 0){
		$db = new clsDBGayaFusionAll;
		$sql = "SELECT GroupCode, GroupDate, GroupDescription, GroupPhoto FROM tblCollect_Group_H WHERE Group_H_ID = ".$Group_H_ID;
		$db->query($sql);
		$result = $db->next_record();
		if($result){
			$groupcode = $db->f("GroupCode");
			$groupdesc = $db->f("GroupDescription");
			$groupdate = $db->f("GroupDate");
			$groupfoto = $db->f("GroupPhoto");
		}
		$db->close;
		$GroupHeader->GroupCode->SetValue($groupcode);
		$GroupHeader->GroupDate->SetValue($groupdate);
		$GroupHeader->GroupDescription->SetValue($groupdesc);
		$GroupHeader->FileFoto->SetValue($groupfoto);
	}
		

//End Custom Code

//Close GroupHeader_BeforeShow @51-F3B68FD1
    return $GroupHeader_BeforeShow;
}
//End Close GroupHeader_BeforeShow

//ItemList_BeforeShowRow @2-D367D48C
function ItemList_BeforeShowRow(& $sender)
{
    $ItemList_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ItemList; //Compatibility
//End ItemList_BeforeShowRow

//Custom Code @57-2A29BDB7
	global $ItemList;
	global $RowNumber;
  
  	$RowNumber++;
  	$ItemList->RowIDAttribute->SetValue($RowNumber);

  	if( ($RowNumber <= $ItemList->ds->RecordsCount) && ($RowNumber <= $ItemList->PageSize) ){
    	
		$ItemList->RowNameAttribute->SetValue("FillRow");

  	}else{ 

		$ItemList->RowNameAttribute->SetValue("EmptyRow");
    	$ItemList->RowStyleAttribute->SetValue("style='display:none;'");
     	
		if($ItemList->EditMode){

		    if($ItemList->ErrorMessages[$RowNumber]) $ItemList->RowStyleAttribute->SetValue("");
        }
	 }
	 $CollectID = $ItemList->CollectID->GetValue();
	 if($CollectID > 0){
	 	$db = new clsDBGayaFusionAll;
		$sql = "SELECT tblcollect_master.ID, tblcollect_master.CollectCode, tblcollect_color.ColorName, tblcollect_category.CategoryName,
  			tblcollect_name.NameDesc, tblcollect_texture.TextureName, tblcollect_size.SizeName, tblcollect_material.MaterialName, tblcollect_design.DesignName
			FROM tblcollect_design INNER JOIN tblcollect_master ON (tblcollect_design.DesignCode=tblcollect_master.DesignCode) INNER JOIN tblcollect_category ON (tblcollect_category.CategoryCode=tblcollect_master.CategoryCode)
 			INNER JOIN tblcollect_name ON (tblcollect_name.NameCode=tblcollect_master.NameCode) INNER JOIN tblcollect_texture ON (tblcollect_texture.TextureCode=tblcollect_master.TextureCode) INNER JOIN tblcollect_color ON (tblcollect_color.ColorCode=tblcollect_master.ColorCode)
 			INNER JOIN tblcollect_size ON (tblcollect_size.SizeCode=tblcollect_master.SizeCode) INNER JOIN tblcollect_material ON (tblcollect_material.MaterialCode=tblcollect_master.MaterialCode) WHERE tblCollect_master.ID = $CollectID";
		$db->query($sql);
		$result = $db->next_record();
		if($result){
			$ItemList->CollectCode->SetValue($db->f("CollectCode"));
			$ItemList->DesignName->SetValue($db->f("DesignName"));
			$ItemList->NameDesc->SetValue($db->f("NameDesc"));
			$ItemList->CategoryName->SetValue($db->f("CategoryName"));
			$ItemList->SizeName->SetValue($db->f("SizeName"));
			$ItemList->TextureName->SetValue($db->f("TextureName"));
			$ItemList->ColorName->SetValue($db->f("ColorName"));
			$ItemList->MaterialName->SetValue($db->f("MaterialName"));
		}
		$db->close();
	}
//End Custom Code

//Close ItemList_BeforeShowRow @2-B951FA3A
    return $ItemList_BeforeShowRow;
}
//End Close ItemList_BeforeShowRow

//ItemList_ds_BeforeBuildInsert @2-B596F592
function ItemList_ds_BeforeBuildInsert(& $sender)
{
    $ItemList_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ItemList; //Compatibility
//End ItemList_ds_BeforeBuildInsert

//Custom Code @58-2A29BDB7
	global $ItemList;
	$Group_H_ID = intval(CCGetFromGet("Group_H_ID",0));
	if($Group_H_ID > 0){
		$ItemList->ds->Group_H_ID->SetValue($Group_H_ID);
  	}
//End Custom Code

//Close ItemList_ds_BeforeBuildInsert @2-45DB8100
    return $ItemList_ds_BeforeBuildInsert;
}
//End Close ItemList_ds_BeforeBuildInsert


?>
