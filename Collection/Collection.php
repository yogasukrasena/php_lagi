<?php
//Include Common Files @1-E586222F
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "Collection.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordSearchCollection { //SearchCollection Class @18-E666F49B

//Variables @18-9E315808

    // Public variables
    public $ComponentType = "Record";
    public $ComponentName;
    public $Parent;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormEnctype;
    public $Visible;
    public $IsEmpty;

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode      = false;
    public $ds;
    public $DataSource;
    public $ValidatingControls;
    public $Controls;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @18-8DA7DA5A
    function clsRecordSearchCollection($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SearchCollection/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SearchCollection";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_tblcollect_color_ColorCode = new clsControl(ccsListBox, "s_tblcollect_color_ColorCode", "s_tblcollect_color_ColorCode", ccsText, "", CCGetRequestParam("s_tblcollect_color_ColorCode", $Method, NULL), $this);
            $this->s_tblcollect_color_ColorCode->DSType = dsTable;
            $this->s_tblcollect_color_ColorCode->DataSource = new clsDBGayaFusionAll();
            $this->s_tblcollect_color_ColorCode->ds = & $this->s_tblcollect_color_ColorCode->DataSource;
            $this->s_tblcollect_color_ColorCode->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_color {SQL_Where} {SQL_OrderBy}";
            $this->s_tblcollect_color_ColorCode->DataSource->Order = "ColorName";
            list($this->s_tblcollect_color_ColorCode->BoundColumn, $this->s_tblcollect_color_ColorCode->TextColumn, $this->s_tblcollect_color_ColorCode->DBFormat) = array("ColorCode", "ColorName", "");
            $this->s_tblcollect_color_ColorCode->DataSource->Order = "ColorName";
            $this->s_tblcollect_category_CategoryCode = new clsControl(ccsListBox, "s_tblcollect_category_CategoryCode", "s_tblcollect_category_CategoryCode", ccsText, "", CCGetRequestParam("s_tblcollect_category_CategoryCode", $Method, NULL), $this);
            $this->s_tblcollect_category_CategoryCode->DSType = dsTable;
            $this->s_tblcollect_category_CategoryCode->DataSource = new clsDBGayaFusionAll();
            $this->s_tblcollect_category_CategoryCode->ds = & $this->s_tblcollect_category_CategoryCode->DataSource;
            $this->s_tblcollect_category_CategoryCode->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_category {SQL_Where} {SQL_OrderBy}";
            $this->s_tblcollect_category_CategoryCode->DataSource->Order = "CategoryName";
            list($this->s_tblcollect_category_CategoryCode->BoundColumn, $this->s_tblcollect_category_CategoryCode->TextColumn, $this->s_tblcollect_category_CategoryCode->DBFormat) = array("CategoryCode", "CategoryName", "");
            $this->s_tblcollect_category_CategoryCode->DataSource->Order = "CategoryName";
            $this->s_tblcollect_design_DesignCode = new clsControl(ccsListBox, "s_tblcollect_design_DesignCode", "s_tblcollect_design_DesignCode", ccsText, "", CCGetRequestParam("s_tblcollect_design_DesignCode", $Method, NULL), $this);
            $this->s_tblcollect_design_DesignCode->DSType = dsTable;
            $this->s_tblcollect_design_DesignCode->DataSource = new clsDBGayaFusionAll();
            $this->s_tblcollect_design_DesignCode->ds = & $this->s_tblcollect_design_DesignCode->DataSource;
            $this->s_tblcollect_design_DesignCode->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_design {SQL_Where} {SQL_OrderBy}";
            $this->s_tblcollect_design_DesignCode->DataSource->Order = "DesignName";
            list($this->s_tblcollect_design_DesignCode->BoundColumn, $this->s_tblcollect_design_DesignCode->TextColumn, $this->s_tblcollect_design_DesignCode->DBFormat) = array("DesignCode", "DesignName", "");
            $this->s_tblcollect_design_DesignCode->DataSource->Order = "DesignName";
            $this->s_tblcollect_material_MaterialCode = new clsControl(ccsListBox, "s_tblcollect_material_MaterialCode", "s_tblcollect_material_MaterialCode", ccsText, "", CCGetRequestParam("s_tblcollect_material_MaterialCode", $Method, NULL), $this);
            $this->s_tblcollect_material_MaterialCode->DSType = dsTable;
            $this->s_tblcollect_material_MaterialCode->DataSource = new clsDBGayaFusionAll();
            $this->s_tblcollect_material_MaterialCode->ds = & $this->s_tblcollect_material_MaterialCode->DataSource;
            $this->s_tblcollect_material_MaterialCode->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_material {SQL_Where} {SQL_OrderBy}";
            $this->s_tblcollect_material_MaterialCode->DataSource->Order = "MaterialName";
            list($this->s_tblcollect_material_MaterialCode->BoundColumn, $this->s_tblcollect_material_MaterialCode->TextColumn, $this->s_tblcollect_material_MaterialCode->DBFormat) = array("MaterialCode", "MaterialName", "");
            $this->s_tblcollect_material_MaterialCode->DataSource->Order = "MaterialName";
            $this->s_tblcollect_texture_TextureCode = new clsControl(ccsListBox, "s_tblcollect_texture_TextureCode", "s_tblcollect_texture_TextureCode", ccsText, "", CCGetRequestParam("s_tblcollect_texture_TextureCode", $Method, NULL), $this);
            $this->s_tblcollect_texture_TextureCode->DSType = dsTable;
            $this->s_tblcollect_texture_TextureCode->DataSource = new clsDBGayaFusionAll();
            $this->s_tblcollect_texture_TextureCode->ds = & $this->s_tblcollect_texture_TextureCode->DataSource;
            $this->s_tblcollect_texture_TextureCode->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_texture {SQL_Where} {SQL_OrderBy}";
            $this->s_tblcollect_texture_TextureCode->DataSource->Order = "TextureName";
            list($this->s_tblcollect_texture_TextureCode->BoundColumn, $this->s_tblcollect_texture_TextureCode->TextColumn, $this->s_tblcollect_texture_TextureCode->DBFormat) = array("TextureCode", "TextureName", "");
            $this->s_tblcollect_texture_TextureCode->DataSource->Order = "TextureName";
            $this->s_tblcollect_size_SizeCode = new clsControl(ccsListBox, "s_tblcollect_size_SizeCode", "s_tblcollect_size_SizeCode", ccsText, "", CCGetRequestParam("s_tblcollect_size_SizeCode", $Method, NULL), $this);
            $this->s_tblcollect_size_SizeCode->DSType = dsTable;
            $this->s_tblcollect_size_SizeCode->DataSource = new clsDBGayaFusionAll();
            $this->s_tblcollect_size_SizeCode->ds = & $this->s_tblcollect_size_SizeCode->DataSource;
            $this->s_tblcollect_size_SizeCode->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_size {SQL_Where} {SQL_OrderBy}";
            $this->s_tblcollect_size_SizeCode->DataSource->Order = "SizeName";
            list($this->s_tblcollect_size_SizeCode->BoundColumn, $this->s_tblcollect_size_SizeCode->TextColumn, $this->s_tblcollect_size_SizeCode->DBFormat) = array("SizeCode", "SizeName", "");
            $this->s_tblcollect_size_SizeCode->DataSource->Order = "SizeName";
            $this->s_tblcollect_name_NameCode = new clsControl(ccsListBox, "s_tblcollect_name_NameCode", "s_tblcollect_name_NameCode", ccsText, "", CCGetRequestParam("s_tblcollect_name_NameCode", $Method, NULL), $this);
            $this->s_tblcollect_name_NameCode->DSType = dsTable;
            $this->s_tblcollect_name_NameCode->DataSource = new clsDBGayaFusionAll();
            $this->s_tblcollect_name_NameCode->ds = & $this->s_tblcollect_name_NameCode->DataSource;
            $this->s_tblcollect_name_NameCode->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_name {SQL_Where} {SQL_OrderBy}";
            $this->s_tblcollect_name_NameCode->DataSource->Order = "NameDesc";
            list($this->s_tblcollect_name_NameCode->BoundColumn, $this->s_tblcollect_name_NameCode->TextColumn, $this->s_tblcollect_name_NameCode->DBFormat) = array("NameCode", "NameDesc", "");
            $this->s_tblcollect_name_NameCode->DataSource->Order = "NameDesc";
            $this->s_CollectCode = new clsControl(ccsTextBox, "s_CollectCode", "s_CollectCode", ccsText, "", CCGetRequestParam("s_CollectCode", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @18-B361E1E1
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_tblcollect_color_ColorCode->Validate() && $Validation);
        $Validation = ($this->s_tblcollect_category_CategoryCode->Validate() && $Validation);
        $Validation = ($this->s_tblcollect_design_DesignCode->Validate() && $Validation);
        $Validation = ($this->s_tblcollect_material_MaterialCode->Validate() && $Validation);
        $Validation = ($this->s_tblcollect_texture_TextureCode->Validate() && $Validation);
        $Validation = ($this->s_tblcollect_size_SizeCode->Validate() && $Validation);
        $Validation = ($this->s_tblcollect_name_NameCode->Validate() && $Validation);
        $Validation = ($this->s_CollectCode->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_tblcollect_color_ColorCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tblcollect_category_CategoryCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tblcollect_design_DesignCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tblcollect_material_MaterialCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tblcollect_texture_TextureCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tblcollect_size_SizeCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tblcollect_name_NameCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_CollectCode->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @18-FB3648CB
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_tblcollect_color_ColorCode->Errors->Count());
        $errors = ($errors || $this->s_tblcollect_category_CategoryCode->Errors->Count());
        $errors = ($errors || $this->s_tblcollect_design_DesignCode->Errors->Count());
        $errors = ($errors || $this->s_tblcollect_material_MaterialCode->Errors->Count());
        $errors = ($errors || $this->s_tblcollect_texture_TextureCode->Errors->Count());
        $errors = ($errors || $this->s_tblcollect_size_SizeCode->Errors->Count());
        $errors = ($errors || $this->s_tblcollect_name_NameCode->Errors->Count());
        $errors = ($errors || $this->s_CollectCode->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @18-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @18-F45EBD8E
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "Collection.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "Collection.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @18-A555C1B4
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->s_tblcollect_color_ColorCode->Prepare();
        $this->s_tblcollect_category_CategoryCode->Prepare();
        $this->s_tblcollect_design_DesignCode->Prepare();
        $this->s_tblcollect_material_MaterialCode->Prepare();
        $this->s_tblcollect_texture_TextureCode->Prepare();
        $this->s_tblcollect_size_SizeCode->Prepare();
        $this->s_tblcollect_name_NameCode->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_tblcollect_color_ColorCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tblcollect_category_CategoryCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tblcollect_design_DesignCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tblcollect_material_MaterialCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tblcollect_texture_TextureCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tblcollect_size_SizeCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tblcollect_name_NameCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_CollectCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_DoSearch->Show();
        $this->s_tblcollect_color_ColorCode->Show();
        $this->s_tblcollect_category_CategoryCode->Show();
        $this->s_tblcollect_design_DesignCode->Show();
        $this->s_tblcollect_material_MaterialCode->Show();
        $this->s_tblcollect_texture_TextureCode->Show();
        $this->s_tblcollect_size_SizeCode->Show();
        $this->s_tblcollect_name_NameCode->Show();
        $this->s_CollectCode->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End SearchCollection Class @18-FCB6E20C

class clsGridGridCollection { //GridCollection class @2-113CD797

//Variables @2-AB3BAE01

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

//Class_Initialize Event @2-87472C77
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
        $this->LinkEdit = new clsControl(ccsLink, "LinkEdit", "LinkEdit", ccsText, "", CCGetRequestParam("LinkEdit", ccsGet, NULL), $this);
        $this->LinkEdit->Page = "AddCollection.php";
        $this->LinkShow = new clsControl(ccsLink, "LinkShow", "LinkShow", ccsText, "", CCGetRequestParam("LinkShow", ccsGet, NULL), $this);
        $this->LinkShow->Page = "ShowSampleCeramic.php";
        $this->RefID = new clsControl(ccsHidden, "RefID", "RefID", ccsText, "", CCGetRequestParam("RefID", ccsGet, NULL), $this);
        $this->lblRef = new clsControl(ccsLabel, "lblRef", "lblRef", ccsText, "", CCGetRequestParam("lblRef", ccsGet, NULL), $this);
        $this->LnkRef = new clsControl(ccsLink, "LnkRef", "LnkRef", ccsText, "", CCGetRequestParam("LnkRef", ccsGet, NULL), $this);
        $this->LnkRef->Page = "Reference.php";
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
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Link1->Page = "AddCollection.php";
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

//Show Method @2-F5AD07C0
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
            $this->ControlsVisible["LinkEdit"] = $this->LinkEdit->Visible;
            $this->ControlsVisible["LinkShow"] = $this->LinkShow->Visible;
            $this->ControlsVisible["RefID"] = $this->RefID->Visible;
            $this->ControlsVisible["lblRef"] = $this->lblRef->Visible;
            $this->ControlsVisible["LnkRef"] = $this->LnkRef->Visible;
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
                $this->LinkEdit->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->LinkEdit->Parameters = CCAddParam($this->LinkEdit->Parameters, "DesignCode", $this->DataSource->f("DesignCode"));
                $this->LinkEdit->Parameters = CCAddParam($this->LinkEdit->Parameters, "NameCode", $this->DataSource->f("NameCode"));
                $this->LinkEdit->Parameters = CCAddParam($this->LinkEdit->Parameters, "CategoryCode", $this->DataSource->f("CategoryCode"));
                $this->LinkEdit->Parameters = CCAddParam($this->LinkEdit->Parameters, "SizeCode", $this->DataSource->f("SizeCode"));
                $this->LinkEdit->Parameters = CCAddParam($this->LinkEdit->Parameters, "TextureCode", $this->DataSource->f("TextureCode"));
                $this->LinkEdit->Parameters = CCAddParam($this->LinkEdit->Parameters, "ColorCode", $this->DataSource->f("ColorCode"));
                $this->LinkEdit->Parameters = CCAddParam($this->LinkEdit->Parameters, "MaterialCode", $this->DataSource->f("MaterialCode"));
                $this->LinkEdit->Parameters = CCAddParam($this->LinkEdit->Parameters, "ID", $this->DataSource->f("ID"));
                $this->LinkShow->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "DesignCode", $this->DataSource->f("DesignCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "NameCode", $this->DataSource->f("NameCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "CategoryCode", $this->DataSource->f("CategoryCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "SizeCode", $this->DataSource->f("SizeCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "TextureCode", $this->DataSource->f("TextureCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "ColorCode", $this->DataSource->f("ColorCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "MaterialCode", $this->DataSource->f("MaterialCode"));
                $this->LinkShow->Parameters = CCAddParam($this->LinkShow->Parameters, "ID", $this->DataSource->f("ID"));
                $this->RefID->SetValue($this->DataSource->RefID->GetValue());
                $this->LnkRef->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->LnkRef->Parameters = CCAddParam($this->LnkRef->Parameters, "CollectID", $this->DataSource->f("ID"));
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
                $this->LinkEdit->Show();
                $this->LinkShow->Show();
                $this->RefID->Show();
                $this->lblRef->Show();
                $this->LnkRef->Show();
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
        $this->Link1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-71AD1D7E
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
        $errors = ComposeStrings($errors, $this->LinkEdit->Errors->ToString());
        $errors = ComposeStrings($errors, $this->LinkShow->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RefID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblRef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->LnkRef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GridCollection Class @2-FCB6E20C

class clsGridCollectionDataSource extends clsDBGayaFusionAll {  //GridCollectionDataSource Class @2-AC452327

//DataSource Variables @2-57295DF3
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
    public $RefID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-D8E99DBB
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
        
        $this->RefID = new clsField("RefID", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-35A21079
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ID";
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

//Prepare Method @2-E6D91E7C
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
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "tblcollect_color.ColorCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "tblcollect_category.CategoryCode", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "tblcollect_design.DesignCode", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "tblcollect_material.MaterialCode", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opContains, "tblcollect_texture.TextureCode", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opContains, "tblcollect_size.SizeCode", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opContains, "tblcollect_name.NameCode", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsText),false);
        $this->wp->Criterion[8] = $this->wp->Operation(opContains, "tblcollect_master.CollectCode", $this->wp->GetDBValue("8"), $this->ToSQL($this->wp->GetDBValue("8"), ccsText),false);
        $this->Where = $this->wp->opAND(
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
             $this->wp->Criterion[8]);
    }
//End Prepare Method

//Open Method @2-E3A9E986
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode";
        $this->SQL = "SELECT CategoryName, tblcollect_master.*, ColorName, DesignName, MaterialName, NameDesc, SizeName, TextureName \n\n" .
        "FROM ((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-B191FFBF
    function SetValues()
    {
        $this->CollectCode->SetDBValue($this->f("CollectCode"));
        $this->DesignName->SetDBValue($this->f("DesignName"));
        $this->NameDesc->SetDBValue($this->f("NameDesc"));
        $this->CategoryName->SetDBValue($this->f("CategoryName"));
        $this->SizeName->SetDBValue($this->f("SizeName"));
        $this->TextureName->SetDBValue($this->f("TextureName"));
        $this->ColorName->SetDBValue($this->f("ColorName"));
        $this->MaterialName->SetDBValue($this->f("MaterialName"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->RefID->SetDBValue($this->f("RefID"));
    }
//End SetValues Method

} //End GridCollectionDataSource Class @2-FCB6E20C

//Initialize Page @1-D6C2FD34
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
$TemplateFileName = "Collection.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-FF0F2086
include_once("./Collection_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A82D6209
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$SearchCollection = new clsRecordSearchCollection("", $MainPage);
$GridCollection = new clsGridGridCollection("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->SearchCollection = & $SearchCollection;
$MainPage->GridCollection = & $GridCollection;
$Panel1->AddComponent("SearchCollection", $SearchCollection);
$Panel1->AddComponent("GridCollection", $GridCollection);
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

//Execute Components @1-B62A3B03
$SearchCollection->Operation();
//End Execute Components

//Go to destination page @1-2F966EE4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($SearchCollection);
    unset($GridCollection);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-56ACD5EF
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-62A4F880
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($SearchCollection);
unset($GridCollection);
unset($Tpl);
//End Unload Page


?>
