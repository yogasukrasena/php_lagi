<?php
//Include Common Files @1-64CA9DD8
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "GroupDetil.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGrid { //Grid class @2-76129994

//Variables @2-BBFD7D96

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
    public $Sorter_GroupCode;
    public $Sorter_DesignName;
    public $Sorter_GroupDescription;
    public $Sorter_ClientCode;
    public $Sorter_ClientDesc;
    public $Sorter_GroupPhoto;
//End Variables

//Class_Initialize Event @2-4D65FB73
    function clsGridGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Grid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Grid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("GridOrder", "");
        $this->SorterDirection = CCGetParam("GridDir", "");

        $this->GroupCode = new clsControl(ccsLabel, "GroupCode", "GroupCode", ccsText, "", CCGetRequestParam("GroupCode", ccsGet, NULL), $this);
        $this->DesignName = new clsControl(ccsLabel, "DesignName", "DesignName", ccsText, "", CCGetRequestParam("DesignName", ccsGet, NULL), $this);
        $this->GroupDescription = new clsControl(ccsLabel, "GroupDescription", "GroupDescription", ccsText, "", CCGetRequestParam("GroupDescription", ccsGet, NULL), $this);
        $this->ClientCode = new clsControl(ccsLabel, "ClientCode", "ClientCode", ccsText, "", CCGetRequestParam("ClientCode", ccsGet, NULL), $this);
        $this->ClientDesc = new clsControl(ccsLabel, "ClientDesc", "ClientDesc", ccsText, "", CCGetRequestParam("ClientDesc", ccsGet, NULL), $this);
        $this->GroupPhoto = new clsControl(ccsImage, "GroupPhoto", "GroupPhoto", ccsText, "", CCGetRequestParam("GroupPhoto", ccsGet, NULL), $this);
        $this->Sorter_GroupCode = new clsSorter($this->ComponentName, "Sorter_GroupCode", $FileName, $this);
        $this->Sorter_DesignName = new clsSorter($this->ComponentName, "Sorter_DesignName", $FileName, $this);
        $this->Sorter_GroupDescription = new clsSorter($this->ComponentName, "Sorter_GroupDescription", $FileName, $this);
        $this->Sorter_ClientCode = new clsSorter($this->ComponentName, "Sorter_ClientCode", $FileName, $this);
        $this->Sorter_ClientDesc = new clsSorter($this->ComponentName, "Sorter_ClientDesc", $FileName, $this);
        $this->Sorter_GroupPhoto = new clsSorter($this->ComponentName, "Sorter_GroupPhoto", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-B5441FFD
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_DesignName"] = CCGetFromGet("s_DesignName", NULL);
        $this->DataSource->Parameters["urls_GroupDescription"] = CCGetFromGet("s_GroupDescription", NULL);
        $this->DataSource->Parameters["urlGroup_H_ID"] = CCGetFromGet("Group_H_ID", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["GroupCode"] = $this->GroupCode->Visible;
            $this->ControlsVisible["DesignName"] = $this->DesignName->Visible;
            $this->ControlsVisible["GroupDescription"] = $this->GroupDescription->Visible;
            $this->ControlsVisible["ClientCode"] = $this->ClientCode->Visible;
            $this->ControlsVisible["ClientDesc"] = $this->ClientDesc->Visible;
            $this->ControlsVisible["GroupPhoto"] = $this->GroupPhoto->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->GroupCode->SetValue($this->DataSource->GroupCode->GetValue());
                $this->DesignName->SetValue($this->DataSource->DesignName->GetValue());
                $this->GroupDescription->SetValue($this->DataSource->GroupDescription->GetValue());
                $this->ClientCode->SetValue($this->DataSource->ClientCode->GetValue());
                $this->ClientDesc->SetValue($this->DataSource->ClientDesc->GetValue());
                $this->GroupPhoto->SetValue($this->DataSource->GroupPhoto->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->GroupCode->Show();
                $this->DesignName->Show();
                $this->GroupDescription->Show();
                $this->ClientCode->Show();
                $this->ClientDesc->Show();
                $this->GroupPhoto->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Sorter_GroupCode->Show();
        $this->Sorter_DesignName->Show();
        $this->Sorter_GroupDescription->Show();
        $this->Sorter_ClientCode->Show();
        $this->Sorter_ClientDesc->Show();
        $this->Sorter_GroupPhoto->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-E997D7D6
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->GroupCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GroupDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GroupPhoto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid Class @2-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @2-7708C172

//DataSource Variables @2-D7DA63AE
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $GroupCode;
    public $DesignName;
    public $GroupDescription;
    public $ClientCode;
    public $ClientDesc;
    public $GroupPhoto;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-F1D3AD79
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid";
        $this->Initialize();
        $this->GroupCode = new clsField("GroupCode", ccsText, "");
        
        $this->DesignName = new clsField("DesignName", ccsText, "");
        
        $this->GroupDescription = new clsField("GroupDescription", ccsText, "");
        
        $this->ClientCode = new clsField("ClientCode", ccsText, "");
        
        $this->ClientDesc = new clsField("ClientDesc", ccsText, "");
        
        $this->GroupPhoto = new clsField("GroupPhoto", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-4D7B4F1A
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "Group_H_ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_GroupCode" => array("GroupCode", ""), 
            "Sorter_DesignName" => array("DesignName", ""), 
            "Sorter_GroupDescription" => array("GroupDescription", ""), 
            "Sorter_ClientCode" => array("ClientCode", ""), 
            "Sorter_ClientDesc" => array("ClientDesc", ""), 
            "Sorter_GroupPhoto" => array("GroupPhoto", "")));
    }
//End SetOrder Method

//Prepare Method @2-438837FA
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_DesignName", ccsText, "", "", $this->Parameters["urls_DesignName"], "", false);
        $this->wp->AddParameter("2", "urls_GroupDescription", ccsText, "", "", $this->Parameters["urls_GroupDescription"], "", false);
        $this->wp->AddParameter("3", "urlGroup_H_ID", ccsInteger, "", "", $this->Parameters["urlGroup_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "tblcollect_design.DesignName", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "tblcollect_group_h.GroupDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "tblcollect_group_h.Group_H_ID", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @2-E2727DC6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tblcollect_group_h INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_group_h.DesignCode = tblcollect_design.DesignCode";
        $this->SQL = "SELECT tblcollect_group_h.*, DesignName \n\n" .
        "FROM tblcollect_group_h INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_group_h.DesignCode = tblcollect_design.DesignCode {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-DC3A248A
    function SetValues()
    {
        $this->GroupCode->SetDBValue($this->f("GroupCode"));
        $this->DesignName->SetDBValue($this->f("DesignName"));
        $this->GroupDescription->SetDBValue($this->f("GroupDescription"));
        $this->ClientCode->SetDBValue($this->f("ClientCode"));
        $this->ClientDesc->SetDBValue($this->f("ClientDesc"));
        $this->GroupPhoto->SetDBValue($this->f("GroupPhoto"));
    }
//End SetValues Method

} //End GridDataSource Class @2-FCB6E20C

class clsGridGridCollection { //GridCollection class @27-113CD797

//Variables @27-AB3BAE01

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
    public $Sorter_CollectCode;
    public $Sorter_DesignName;
    public $Sorter_NameDesc;
    public $Sorter_CategoryName;
    public $Sorter_SizeName;
    public $Sorter_TextureName;
    public $Sorter_ColorName;
    public $Sorter_MaterialName;
//End Variables

//Class_Initialize Event @27-4972CE20
    function clsGridGridCollection($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GridCollection";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GridCollection";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGridCollectionDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("GridCollectionOrder", "");
        $this->SorterDirection = CCGetParam("GridCollectionDir", "");

        $this->CollectCode = new clsControl(ccsLabel, "CollectCode", "CollectCode", ccsText, "", CCGetRequestParam("CollectCode", ccsGet, NULL), $this);
        $this->DesignName = new clsControl(ccsLabel, "DesignName", "DesignName", ccsText, "", CCGetRequestParam("DesignName", ccsGet, NULL), $this);
        $this->NameDesc = new clsControl(ccsLabel, "NameDesc", "NameDesc", ccsText, "", CCGetRequestParam("NameDesc", ccsGet, NULL), $this);
        $this->CategoryName = new clsControl(ccsLabel, "CategoryName", "CategoryName", ccsText, "", CCGetRequestParam("CategoryName", ccsGet, NULL), $this);
        $this->SizeName = new clsControl(ccsLabel, "SizeName", "SizeName", ccsText, "", CCGetRequestParam("SizeName", ccsGet, NULL), $this);
        $this->TextureName = new clsControl(ccsLabel, "TextureName", "TextureName", ccsText, "", CCGetRequestParam("TextureName", ccsGet, NULL), $this);
        $this->ColorName = new clsControl(ccsLabel, "ColorName", "ColorName", ccsText, "", CCGetRequestParam("ColorName", ccsGet, NULL), $this);
        $this->MaterialName = new clsControl(ccsLabel, "MaterialName", "MaterialName", ccsText, "", CCGetRequestParam("MaterialName", ccsGet, NULL), $this);
        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->LinkShow = new clsControl(ccsLink, "LinkShow", "LinkShow", ccsText, "", CCGetRequestParam("LinkShow", ccsGet, NULL), $this);
        $this->LinkShow->Page = "../collection/ShowSampleCeramic.php";
        $this->lblQty = new clsControl(ccsLabel, "lblQty", "lblQty", ccsInteger, "", CCGetRequestParam("lblQty", ccsGet, NULL), $this);
        $this->tblcollect_category_tblco1_TotalRecords = new clsControl(ccsLabel, "tblcollect_category_tblco1_TotalRecords", "tblcollect_category_tblco1_TotalRecords", ccsText, "", CCGetRequestParam("tblcollect_category_tblco1_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_CollectCode = new clsSorter($this->ComponentName, "Sorter_CollectCode", $FileName, $this);
        $this->Sorter_DesignName = new clsSorter($this->ComponentName, "Sorter_DesignName", $FileName, $this);
        $this->Sorter_NameDesc = new clsSorter($this->ComponentName, "Sorter_NameDesc", $FileName, $this);
        $this->Sorter_CategoryName = new clsSorter($this->ComponentName, "Sorter_CategoryName", $FileName, $this);
        $this->Sorter_SizeName = new clsSorter($this->ComponentName, "Sorter_SizeName", $FileName, $this);
        $this->Sorter_TextureName = new clsSorter($this->ComponentName, "Sorter_TextureName", $FileName, $this);
        $this->Sorter_ColorName = new clsSorter($this->ComponentName, "Sorter_ColorName", $FileName, $this);
        $this->Sorter_MaterialName = new clsSorter($this->ComponentName, "Sorter_MaterialName", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @27-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @27-325A9D53
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_tblcollect_color_ColorCode"] = CCGetFromGet("s_tblcollect_color_ColorCode", NULL);
        $this->DataSource->Parameters["urls_tblcollect_category_CategoryCode"] = CCGetFromGet("s_tblcollect_category_CategoryCode", NULL);
        $this->DataSource->Parameters["urls_tblcollect_design_DesignCode"] = CCGetFromGet("s_tblcollect_design_DesignCode", NULL);
        $this->DataSource->Parameters["urls_tblcollect_material_MaterialCode"] = CCGetFromGet("s_tblcollect_material_MaterialCode", NULL);
        $this->DataSource->Parameters["urls_tblcollect_texture_TextureCode"] = CCGetFromGet("s_tblcollect_texture_TextureCode", NULL);
        $this->DataSource->Parameters["urls_tblcollect_size_SizeCode"] = CCGetFromGet("s_tblcollect_size_SizeCode", NULL);
        $this->DataSource->Parameters["urls_tblcollect_name_NameCode"] = CCGetFromGet("s_tblcollect_name_NameCode", NULL);
        $this->DataSource->Parameters["urls_CollectCode"] = CCGetFromGet("s_CollectCode", NULL);
        $this->DataSource->Parameters["urlGroup_H_ID"] = CCGetFromGet("Group_H_ID", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["CollectCode"] = $this->CollectCode->Visible;
            $this->ControlsVisible["DesignName"] = $this->DesignName->Visible;
            $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
            $this->ControlsVisible["CategoryName"] = $this->CategoryName->Visible;
            $this->ControlsVisible["SizeName"] = $this->SizeName->Visible;
            $this->ControlsVisible["TextureName"] = $this->TextureName->Visible;
            $this->ControlsVisible["ColorName"] = $this->ColorName->Visible;
            $this->ControlsVisible["MaterialName"] = $this->MaterialName->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["LinkShow"] = $this->LinkShow->Visible;
            $this->ControlsVisible["lblQty"] = $this->lblQty->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->CollectCode->SetValue($this->DataSource->CollectCode->GetValue());
                $this->DesignName->SetValue($this->DataSource->DesignName->GetValue());
                $this->NameDesc->SetValue($this->DataSource->NameDesc->GetValue());
                $this->CategoryName->SetValue($this->DataSource->CategoryName->GetValue());
                $this->SizeName->SetValue($this->DataSource->SizeName->GetValue());
                $this->TextureName->SetValue($this->DataSource->TextureName->GetValue());
                $this->ColorName->SetValue($this->DataSource->ColorName->GetValue());
                $this->MaterialName->SetValue($this->DataSource->MaterialName->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->LinkShow->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "DesignCode", $this->DataSource->f("tblcollect_master_DesignCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "NameCode", $this->DataSource->f("tblcollect_master_NameCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "CategoryCode", $this->DataSource->f("tblcollect_master_CategoryCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "SizeCode", $this->DataSource->f("tblcollect_master_SizeCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "TextureCode", $this->DataSource->f("tblcollect_master_TextureCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "ColorCode", $this->DataSource->f("tblcollect_master_ColorCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "MaterialCode", $this->DataSource->f("tblcollect_master_MaterialCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "ID", $this->DataSource->f("tblcollect_master_ID"));
                $this->lblQty->SetValue($this->DataSource->lblQty->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->CollectCode->Show();
                $this->DesignName->Show();
                $this->NameDesc->Show();
                $this->CategoryName->Show();
                $this->SizeName->Show();
                $this->TextureName->Show();
                $this->ColorName->Show();
                $this->MaterialName->Show();
                $this->Photo1->Show();
                $this->LinkShow->Show();
                $this->lblQty->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->tblcollect_category_tblco1_TotalRecords->Show();
        $this->Sorter_CollectCode->Show();
        $this->Sorter_DesignName->Show();
        $this->Sorter_NameDesc->Show();
        $this->Sorter_CategoryName->Show();
        $this->Sorter_SizeName->Show();
        $this->Sorter_TextureName->Show();
        $this->Sorter_ColorName->Show();
        $this->Sorter_MaterialName->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @27-C64384AA
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->CollectCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CategoryName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SizeName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ColorName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MaterialName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->LinkShow->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblQty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GridCollection Class @27-FCB6E20C

class clsGridCollectionDataSource extends clsDBGayaFusionAll {  //GridCollectionDataSource Class @27-AC452327

//DataSource Variables @27-9B8ACD23
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $CollectCode;
    public $DesignName;
    public $NameDesc;
    public $CategoryName;
    public $SizeName;
    public $TextureName;
    public $ColorName;
    public $MaterialName;
    public $Photo1;
    public $lblQty;
//End DataSource Variables

//DataSourceClass_Initialize Event @27-525DBB5F
    function clsGridCollectionDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GridCollection";
        $this->Initialize();
        $this->CollectCode = new clsField("CollectCode", ccsText, "");
        
        $this->DesignName = new clsField("DesignName", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->CategoryName = new clsField("CategoryName", ccsText, "");
        
        $this->SizeName = new clsField("SizeName", ccsText, "");
        
        $this->TextureName = new clsField("TextureName", ccsText, "");
        
        $this->ColorName = new clsField("ColorName", ccsText, "");
        
        $this->MaterialName = new clsField("MaterialName", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->lblQty = new clsField("lblQty", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @27-761300BE
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "tblcollect_master.ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_CollectCode" => array("CollectCode", ""), 
            "Sorter_DesignName" => array("DesignName", ""), 
            "Sorter_NameDesc" => array("NameDesc", ""), 
            "Sorter_CategoryName" => array("CategoryName", ""), 
            "Sorter_SizeName" => array("SizeName", ""), 
            "Sorter_TextureName" => array("TextureName", ""), 
            "Sorter_ColorName" => array("ColorName", ""), 
            "Sorter_MaterialName" => array("MaterialName", "")));
    }
//End SetOrder Method

//Prepare Method @27-0E93E691
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_tblcollect_color_ColorCode", ccsText, "", "", $this->Parameters["urls_tblcollect_color_ColorCode"], "", false);
        $this->wp->AddParameter("2", "urls_tblcollect_category_CategoryCode", ccsText, "", "", $this->Parameters["urls_tblcollect_category_CategoryCode"], "", false);
        $this->wp->AddParameter("3", "urls_tblcollect_design_DesignCode", ccsText, "", "", $this->Parameters["urls_tblcollect_design_DesignCode"], "", false);
        $this->wp->AddParameter("4", "urls_tblcollect_material_MaterialCode", ccsText, "", "", $this->Parameters["urls_tblcollect_material_MaterialCode"], "", false);
        $this->wp->AddParameter("5", "urls_tblcollect_texture_TextureCode", ccsText, "", "", $this->Parameters["urls_tblcollect_texture_TextureCode"], "", false);
        $this->wp->AddParameter("6", "urls_tblcollect_size_SizeCode", ccsText, "", "", $this->Parameters["urls_tblcollect_size_SizeCode"], "", false);
        $this->wp->AddParameter("7", "urls_tblcollect_name_NameCode", ccsText, "", "", $this->Parameters["urls_tblcollect_name_NameCode"], "", false);
        $this->wp->AddParameter("8", "urls_CollectCode", ccsText, "", "", $this->Parameters["urls_CollectCode"], "", false);
        $this->wp->AddParameter("9", "urlGroup_H_ID", ccsInteger, "", "", $this->Parameters["urlGroup_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "tblcollect_color.ColorCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "tblcollect_category.CategoryCode", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "tblcollect_design.DesignCode", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "tblcollect_material.MaterialCode", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opContains, "tblcollect_texture.TextureCode", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opContains, "tblcollect_size.SizeCode", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opContains, "tblcollect_name.NameCode", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsText),false);
        $this->wp->Criterion[8] = $this->wp->Operation(opContains, "tblcollect_master.CollectCode", $this->wp->GetDBValue("8"), $this->ToSQL($this->wp->GetDBValue("8"), ccsText),false);
        $this->wp->Criterion[9] = $this->wp->Operation(opEqual, "tblcollect_group_det.Group_H_ID", $this->wp->GetDBValue("9"), $this->ToSQL($this->wp->GetDBValue("9"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]), 
             $this->wp->Criterion[7]), 
             $this->wp->Criterion[8]), 
             $this->wp->Criterion[9]);
    }
//End Prepare Method

//Open Method @27-0076BF8E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tblcollect_group_det ON\n\n" .
        "tblcollect_group_det.CollectCode = tblcollect_master.ID";
        $this->SQL = "SELECT CategoryName, ColorName, DesignName, MaterialName, NameDesc, SizeName, TextureName, Qty, tblcollect_master.CollectCode AS tblcollect_master_CollectCode,\n\n" .
        "Photo1, tblcollect_master.ID AS tblcollect_master_ID, tblcollect_master.DesignCode AS tblcollect_master_DesignCode, tblcollect_master.NameCode AS tblcollect_master_NameCode,\n\n" .
        "tblcollect_master.CategoryCode AS tblcollect_master_CategoryCode, tblcollect_master.SizeCode AS tblcollect_master_SizeCode,\n\n" .
        "tblcollect_master.TextureCode AS tblcollect_master_TextureCode, tblcollect_master.ColorCode AS tblcollect_master_ColorCode,\n\n" .
        "tblcollect_master.MaterialCode AS tblcollect_master_MaterialCode \n\n" .
        "FROM (((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tblcollect_group_det ON\n\n" .
        "tblcollect_group_det.CollectCode = tblcollect_master.ID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @27-1E8E3BE5
    function SetValues()
    {
        $this->CollectCode->SetDBValue($this->f("tblcollect_master_CollectCode"));
        $this->DesignName->SetDBValue($this->f("DesignName"));
        $this->NameDesc->SetDBValue($this->f("NameDesc"));
        $this->CategoryName->SetDBValue($this->f("CategoryName"));
        $this->SizeName->SetDBValue($this->f("SizeName"));
        $this->TextureName->SetDBValue($this->f("TextureName"));
        $this->ColorName->SetDBValue($this->f("ColorName"));
        $this->MaterialName->SetDBValue($this->f("MaterialName"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->lblQty->SetDBValue(trim($this->f("Qty")));
    }
//End SetValues Method

} //End GridCollectionDataSource Class @27-FCB6E20C

//Initialize Page @1-109B9487
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "GroupDetil.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-5CA68B36
include_once("./GroupDetil_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A6CEC540
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Grid = new clsGridGrid("", $MainPage);
$GridCollection = new clsGridGridCollection("", $MainPage);
$MainPage->Grid = & $Grid;
$MainPage->GridCollection = & $GridCollection;
$Grid->Initialize();
$GridCollection->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-E710DB26
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-4ED7EFEE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Grid);
    unset($GridCollection);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F34F9452
$Grid->Show();
$GridCollection->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-528E6031
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Grid);
unset($GridCollection);
unset($Tpl);
//End Unload Page


?>
