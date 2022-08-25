<?php
//Include Common Files @1-B3ABF109
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "PriceList.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordSearch { //Search Class @40-39E8735D

//Variables @40-9E315808

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

//Class_Initialize Event @40-B36506DA
    function clsRecordSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Search/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Search";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_DesignName = new clsControl(ccsListBox, "s_DesignName", "s_DesignName", ccsText, "", CCGetRequestParam("s_DesignName", $Method, NULL), $this);
            $this->s_DesignName->DSType = dsTable;
            $this->s_DesignName->DataSource = new clsDBGayaFusionAll();
            $this->s_DesignName->ds = & $this->s_DesignName->DataSource;
            $this->s_DesignName->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_design {SQL_Where} {SQL_OrderBy}";
            list($this->s_DesignName->BoundColumn, $this->s_DesignName->TextColumn, $this->s_DesignName->DBFormat) = array("DesignCode", "DesignName", "");
            $this->s_NameDesc = new clsControl(ccsListBox, "s_NameDesc", "s_NameDesc", ccsText, "", CCGetRequestParam("s_NameDesc", $Method, NULL), $this);
            $this->s_NameDesc->DSType = dsTable;
            $this->s_NameDesc->DataSource = new clsDBGayaFusionAll();
            $this->s_NameDesc->ds = & $this->s_NameDesc->DataSource;
            $this->s_NameDesc->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_name {SQL_Where} {SQL_OrderBy}";
            list($this->s_NameDesc->BoundColumn, $this->s_NameDesc->TextColumn, $this->s_NameDesc->DBFormat) = array("NameCode", "NameDesc", "");
            $this->s_CategoryName = new clsControl(ccsListBox, "s_CategoryName", "s_CategoryName", ccsText, "", CCGetRequestParam("s_CategoryName", $Method, NULL), $this);
            $this->s_CategoryName->DSType = dsTable;
            $this->s_CategoryName->DataSource = new clsDBGayaFusionAll();
            $this->s_CategoryName->ds = & $this->s_CategoryName->DataSource;
            $this->s_CategoryName->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_category {SQL_Where} {SQL_OrderBy}";
            list($this->s_CategoryName->BoundColumn, $this->s_CategoryName->TextColumn, $this->s_CategoryName->DBFormat) = array("CategoryCode", "CategoryName", "");
            $this->s_SizeName = new clsControl(ccsListBox, "s_SizeName", "s_SizeName", ccsText, "", CCGetRequestParam("s_SizeName", $Method, NULL), $this);
            $this->s_SizeName->DSType = dsTable;
            $this->s_SizeName->DataSource = new clsDBGayaFusionAll();
            $this->s_SizeName->ds = & $this->s_SizeName->DataSource;
            $this->s_SizeName->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_size {SQL_Where} {SQL_OrderBy}";
            list($this->s_SizeName->BoundColumn, $this->s_SizeName->TextColumn, $this->s_SizeName->DBFormat) = array("SizeCode", "SizeName", "");
            $this->s_TextureName = new clsControl(ccsListBox, "s_TextureName", "s_TextureName", ccsText, "", CCGetRequestParam("s_TextureName", $Method, NULL), $this);
            $this->s_TextureName->DSType = dsTable;
            $this->s_TextureName->DataSource = new clsDBGayaFusionAll();
            $this->s_TextureName->ds = & $this->s_TextureName->DataSource;
            $this->s_TextureName->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_texture {SQL_Where} {SQL_OrderBy}";
            list($this->s_TextureName->BoundColumn, $this->s_TextureName->TextColumn, $this->s_TextureName->DBFormat) = array("TextureCode", "TextureName", "");
            $this->s_ColorName = new clsControl(ccsListBox, "s_ColorName", "s_ColorName", ccsText, "", CCGetRequestParam("s_ColorName", $Method, NULL), $this);
            $this->s_ColorName->DSType = dsTable;
            $this->s_ColorName->DataSource = new clsDBGayaFusionAll();
            $this->s_ColorName->ds = & $this->s_ColorName->DataSource;
            $this->s_ColorName->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_color {SQL_Where} {SQL_OrderBy}";
            list($this->s_ColorName->BoundColumn, $this->s_ColorName->TextColumn, $this->s_ColorName->DBFormat) = array("ColorCode", "ColorName", "");
            $this->s_MaterialName = new clsControl(ccsListBox, "s_MaterialName", "s_MaterialName", ccsText, "", CCGetRequestParam("s_MaterialName", $Method, NULL), $this);
            $this->s_MaterialName->DSType = dsTable;
            $this->s_MaterialName->DataSource = new clsDBGayaFusionAll();
            $this->s_MaterialName->ds = & $this->s_MaterialName->DataSource;
            $this->s_MaterialName->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_material {SQL_Where} {SQL_OrderBy}";
            list($this->s_MaterialName->BoundColumn, $this->s_MaterialName->TextColumn, $this->s_MaterialName->DBFormat) = array("MaterialCode", "MaterialName", "");
            $this->s_CollectCode = new clsControl(ccsTextBox, "s_CollectCode", "s_CollectCode", ccsText, "", CCGetRequestParam("s_CollectCode", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @40-DDB3BF62
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_DesignName->Validate() && $Validation);
        $Validation = ($this->s_NameDesc->Validate() && $Validation);
        $Validation = ($this->s_CategoryName->Validate() && $Validation);
        $Validation = ($this->s_SizeName->Validate() && $Validation);
        $Validation = ($this->s_TextureName->Validate() && $Validation);
        $Validation = ($this->s_ColorName->Validate() && $Validation);
        $Validation = ($this->s_MaterialName->Validate() && $Validation);
        $Validation = ($this->s_CollectCode->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_DesignName->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_NameDesc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_CategoryName->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_SizeName->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_TextureName->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_ColorName->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_MaterialName->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_CollectCode->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @40-1230DF66
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_DesignName->Errors->Count());
        $errors = ($errors || $this->s_NameDesc->Errors->Count());
        $errors = ($errors || $this->s_CategoryName->Errors->Count());
        $errors = ($errors || $this->s_SizeName->Errors->Count());
        $errors = ($errors || $this->s_TextureName->Errors->Count());
        $errors = ($errors || $this->s_ColorName->Errors->Count());
        $errors = ($errors || $this->s_MaterialName->Errors->Count());
        $errors = ($errors || $this->s_CollectCode->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @40-ED598703
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

//Operation Method @40-28E98A6E
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
        $Redirect = "PriceList.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "PriceList.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @40-0CEBFEA8
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

        $this->s_DesignName->Prepare();
        $this->s_NameDesc->Prepare();
        $this->s_CategoryName->Prepare();
        $this->s_SizeName->Prepare();
        $this->s_TextureName->Prepare();
        $this->s_ColorName->Prepare();
        $this->s_MaterialName->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_DesignName->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_NameDesc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_CategoryName->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_SizeName->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_TextureName->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_ColorName->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_MaterialName->Errors->ToString());
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
        $this->s_DesignName->Show();
        $this->s_NameDesc->Show();
        $this->s_CategoryName->Show();
        $this->s_SizeName->Show();
        $this->s_TextureName->Show();
        $this->s_ColorName->Show();
        $this->s_MaterialName->Show();
        $this->s_CollectCode->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End Search Class @40-FCB6E20C

class clsGridGrid { //Grid class @2-76129994

//Variables @2-7323EF57

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
    public $Sorter_Photo1;
    public $Sorter_RealSellingPrice;
    public $Sorter_LastUpdate;
    public $Sorter_ClientCode;
    public $Sorter_ClientDescription;
//End Variables

//Class_Initialize Event @2-79B04CBE
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

        $this->DesignName = new clsControl(ccsLabel, "DesignName", "DesignName", ccsText, "", CCGetRequestParam("DesignName", ccsGet, NULL), $this);
        $this->NameDesc = new clsControl(ccsLabel, "NameDesc", "NameDesc", ccsText, "", CCGetRequestParam("NameDesc", ccsGet, NULL), $this);
        $this->CategoryName = new clsControl(ccsLabel, "CategoryName", "CategoryName", ccsText, "", CCGetRequestParam("CategoryName", ccsGet, NULL), $this);
        $this->SizeName = new clsControl(ccsLabel, "SizeName", "SizeName", ccsText, "", CCGetRequestParam("SizeName", ccsGet, NULL), $this);
        $this->TextureName = new clsControl(ccsLabel, "TextureName", "TextureName", ccsText, "", CCGetRequestParam("TextureName", ccsGet, NULL), $this);
        $this->ColorName = new clsControl(ccsLabel, "ColorName", "ColorName", ccsText, "", CCGetRequestParam("ColorName", ccsGet, NULL), $this);
        $this->MaterialName = new clsControl(ccsLabel, "MaterialName", "MaterialName", ccsText, "", CCGetRequestParam("MaterialName", ccsGet, NULL), $this);
        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->RealSellingPrice = new clsControl(ccsLink, "RealSellingPrice", "RealSellingPrice", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("RealSellingPrice", ccsGet, NULL), $this);
        $this->RealSellingPrice->Page = "EditPrice.php";
        $this->LastUpdate = new clsControl(ccsLabel, "LastUpdate", "LastUpdate", ccsDate, $DefaultDateFormat, CCGetRequestParam("LastUpdate", ccsGet, NULL), $this);
        $this->ClientCode = new clsControl(ccsLabel, "ClientCode", "ClientCode", ccsText, "", CCGetRequestParam("ClientCode", ccsGet, NULL), $this);
        $this->ClientDescription = new clsControl(ccsLabel, "ClientDescription", "ClientDescription", ccsText, "", CCGetRequestParam("ClientDescription", ccsGet, NULL), $this);
        $this->CollectID = new clsControl(ccsHidden, "CollectID", "CollectID", ccsText, "", CCGetRequestParam("CollectID", ccsGet, NULL), $this);
        $this->CollectCode = new clsControl(ccsLabel, "CollectCode", "CollectCode", ccsText, "", CCGetRequestParam("CollectCode", ccsGet, NULL), $this);
        $this->PriceDollar = new clsControl(ccsLink, "PriceDollar", "PriceDollar", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("PriceDollar", ccsGet, NULL), $this);
        $this->PriceDollar->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->PriceDollar->Page = "";
        $this->PriceEuro = new clsControl(ccsLink, "PriceEuro", "PriceEuro", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("PriceEuro", ccsGet, NULL), $this);
        $this->PriceEuro->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->PriceEuro->Page = "";
        $this->lblPriceDollar = new clsControl(ccsLabel, "lblPriceDollar", "lblPriceDollar", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("lblPriceDollar", ccsGet, NULL), $this);
        $this->lblPriceEuro = new clsControl(ccsLabel, "lblPriceEuro", "lblPriceEuro", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("lblPriceEuro", ccsGet, NULL), $this);
        $this->tblcollect_category_tblco1_TotalRecords = new clsControl(ccsLabel, "tblcollect_category_tblco1_TotalRecords", "tblcollect_category_tblco1_TotalRecords", ccsText, "", CCGetRequestParam("tblcollect_category_tblco1_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_CollectCode = new clsSorter($this->ComponentName, "Sorter_CollectCode", $FileName, $this);
        $this->Sorter_DesignName = new clsSorter($this->ComponentName, "Sorter_DesignName", $FileName, $this);
        $this->Sorter_NameDesc = new clsSorter($this->ComponentName, "Sorter_NameDesc", $FileName, $this);
        $this->Sorter_CategoryName = new clsSorter($this->ComponentName, "Sorter_CategoryName", $FileName, $this);
        $this->Sorter_SizeName = new clsSorter($this->ComponentName, "Sorter_SizeName", $FileName, $this);
        $this->Sorter_TextureName = new clsSorter($this->ComponentName, "Sorter_TextureName", $FileName, $this);
        $this->Sorter_ColorName = new clsSorter($this->ComponentName, "Sorter_ColorName", $FileName, $this);
        $this->Sorter_MaterialName = new clsSorter($this->ComponentName, "Sorter_MaterialName", $FileName, $this);
        $this->Sorter_Photo1 = new clsSorter($this->ComponentName, "Sorter_Photo1", $FileName, $this);
        $this->Sorter_RealSellingPrice = new clsSorter($this->ComponentName, "Sorter_RealSellingPrice", $FileName, $this);
        $this->Sorter_LastUpdate = new clsSorter($this->ComponentName, "Sorter_LastUpdate", $FileName, $this);
        $this->Sorter_ClientCode = new clsSorter($this->ComponentName, "Sorter_ClientCode", $FileName, $this);
        $this->Sorter_ClientDescription = new clsSorter($this->ComponentName, "Sorter_ClientDescription", $FileName, $this);
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

//Show Method @2-DDFBCB19
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_DesignName"] = CCGetFromGet("s_DesignName", NULL);
        $this->DataSource->Parameters["urls_NameDesc"] = CCGetFromGet("s_NameDesc", NULL);
        $this->DataSource->Parameters["urls_CategoryName"] = CCGetFromGet("s_CategoryName", NULL);
        $this->DataSource->Parameters["urls_SizeName"] = CCGetFromGet("s_SizeName", NULL);
        $this->DataSource->Parameters["urls_TextureName"] = CCGetFromGet("s_TextureName", NULL);
        $this->DataSource->Parameters["urls_ColorName"] = CCGetFromGet("s_ColorName", NULL);
        $this->DataSource->Parameters["urls_MaterialName"] = CCGetFromGet("s_MaterialName", NULL);
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
            $this->ControlsVisible["DesignName"] = $this->DesignName->Visible;
            $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
            $this->ControlsVisible["CategoryName"] = $this->CategoryName->Visible;
            $this->ControlsVisible["SizeName"] = $this->SizeName->Visible;
            $this->ControlsVisible["TextureName"] = $this->TextureName->Visible;
            $this->ControlsVisible["ColorName"] = $this->ColorName->Visible;
            $this->ControlsVisible["MaterialName"] = $this->MaterialName->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["RealSellingPrice"] = $this->RealSellingPrice->Visible;
            $this->ControlsVisible["LastUpdate"] = $this->LastUpdate->Visible;
            $this->ControlsVisible["ClientCode"] = $this->ClientCode->Visible;
            $this->ControlsVisible["ClientDescription"] = $this->ClientDescription->Visible;
            $this->ControlsVisible["CollectID"] = $this->CollectID->Visible;
            $this->ControlsVisible["CollectCode"] = $this->CollectCode->Visible;
            $this->ControlsVisible["PriceDollar"] = $this->PriceDollar->Visible;
            $this->ControlsVisible["PriceEuro"] = $this->PriceEuro->Visible;
            $this->ControlsVisible["lblPriceDollar"] = $this->lblPriceDollar->Visible;
            $this->ControlsVisible["lblPriceEuro"] = $this->lblPriceEuro->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DesignName->SetValue($this->DataSource->DesignName->GetValue());
                $this->NameDesc->SetValue($this->DataSource->NameDesc->GetValue());
                $this->CategoryName->SetValue($this->DataSource->CategoryName->GetValue());
                $this->SizeName->SetValue($this->DataSource->SizeName->GetValue());
                $this->TextureName->SetValue($this->DataSource->TextureName->GetValue());
                $this->ColorName->SetValue($this->DataSource->ColorName->GetValue());
                $this->MaterialName->SetValue($this->DataSource->MaterialName->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->RealSellingPrice->SetValue($this->DataSource->RealSellingPrice->GetValue());
                $this->RealSellingPrice->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->RealSellingPrice->Parameters = CCAddParam($this->RealSellingPrice->Parameters, "ID", $this->DataSource->f("ID"));
                $this->LastUpdate->SetValue($this->DataSource->LastUpdate->GetValue());
                $this->ClientCode->SetValue($this->DataSource->ClientCode->GetValue());
                $this->ClientDescription->SetValue($this->DataSource->ClientDescription->GetValue());
                $this->CollectID->SetValue($this->DataSource->CollectID->GetValue());
                $this->CollectCode->SetValue($this->DataSource->CollectCode->GetValue());
                $this->PriceDollar->SetValue($this->DataSource->PriceDollar->GetValue());
                $this->PriceEuro->SetValue($this->DataSource->PriceEuro->GetValue());
                $this->lblPriceDollar->SetValue($this->DataSource->lblPriceDollar->GetValue());
                $this->lblPriceEuro->SetValue($this->DataSource->lblPriceEuro->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DesignName->Show();
                $this->NameDesc->Show();
                $this->CategoryName->Show();
                $this->SizeName->Show();
                $this->TextureName->Show();
                $this->ColorName->Show();
                $this->MaterialName->Show();
                $this->Photo1->Show();
                $this->RealSellingPrice->Show();
                $this->LastUpdate->Show();
                $this->ClientCode->Show();
                $this->ClientDescription->Show();
                $this->CollectID->Show();
                $this->CollectCode->Show();
                $this->PriceDollar->Show();
                $this->PriceEuro->Show();
                $this->lblPriceDollar->Show();
                $this->lblPriceEuro->Show();
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
        $this->Sorter_Photo1->Show();
        $this->Sorter_RealSellingPrice->Show();
        $this->Sorter_LastUpdate->Show();
        $this->Sorter_ClientCode->Show();
        $this->Sorter_ClientDescription->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-63A9E2A6
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DesignName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CategoryName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SizeName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ColorName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MaterialName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RealSellingPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->LastUpdate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PriceDollar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PriceEuro->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblPriceDollar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblPriceEuro->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid Class @2-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @2-7708C172

//DataSource Variables @2-05298D47
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $DesignName;
    public $NameDesc;
    public $CategoryName;
    public $SizeName;
    public $TextureName;
    public $ColorName;
    public $MaterialName;
    public $Photo1;
    public $RealSellingPrice;
    public $LastUpdate;
    public $ClientCode;
    public $ClientDescription;
    public $CollectID;
    public $CollectCode;
    public $PriceDollar;
    public $PriceEuro;
    public $lblPriceDollar;
    public $lblPriceEuro;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-A2BB0B3B
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid";
        $this->Initialize();
        $this->DesignName = new clsField("DesignName", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->CategoryName = new clsField("CategoryName", ccsText, "");
        
        $this->SizeName = new clsField("SizeName", ccsText, "");
        
        $this->TextureName = new clsField("TextureName", ccsText, "");
        
        $this->ColorName = new clsField("ColorName", ccsText, "");
        
        $this->MaterialName = new clsField("MaterialName", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->RealSellingPrice = new clsField("RealSellingPrice", ccsFloat, "");
        
        $this->LastUpdate = new clsField("LastUpdate", ccsDate, $this->DateFormat);
        
        $this->ClientCode = new clsField("ClientCode", ccsText, "");
        
        $this->ClientDescription = new clsField("ClientDescription", ccsText, "");
        
        $this->CollectID = new clsField("CollectID", ccsText, "");
        
        $this->CollectCode = new clsField("CollectCode", ccsText, "");
        
        $this->PriceDollar = new clsField("PriceDollar", ccsFloat, "");
        
        $this->PriceEuro = new clsField("PriceEuro", ccsFloat, "");
        
        $this->lblPriceDollar = new clsField("lblPriceDollar", ccsFloat, "");
        
        $this->lblPriceEuro = new clsField("lblPriceEuro", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-F1ECFBC2
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_CollectCode" => array("CollectCode", ""), 
            "Sorter_DesignName" => array("DesignName", ""), 
            "Sorter_NameDesc" => array("NameDesc", ""), 
            "Sorter_CategoryName" => array("CategoryName", ""), 
            "Sorter_SizeName" => array("SizeName", ""), 
            "Sorter_TextureName" => array("TextureName", ""), 
            "Sorter_ColorName" => array("ColorName", ""), 
            "Sorter_MaterialName" => array("MaterialName", ""), 
            "Sorter_Photo1" => array("Photo1", ""), 
            "Sorter_RealSellingPrice" => array("RealSellingPrice", ""), 
            "Sorter_LastUpdate" => array("LastUpdate", ""), 
            "Sorter_ClientCode" => array("ClientCode", ""), 
            "Sorter_ClientDescription" => array("ClientDescription", "")));
    }
//End SetOrder Method

//Prepare Method @2-72DBBEE4
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_DesignName", ccsText, "", "", $this->Parameters["urls_DesignName"], "", false);
        $this->wp->AddParameter("2", "urls_NameDesc", ccsText, "", "", $this->Parameters["urls_NameDesc"], "", false);
        $this->wp->AddParameter("3", "urls_CategoryName", ccsText, "", "", $this->Parameters["urls_CategoryName"], "", false);
        $this->wp->AddParameter("4", "urls_SizeName", ccsText, "", "", $this->Parameters["urls_SizeName"], "", false);
        $this->wp->AddParameter("5", "urls_TextureName", ccsText, "", "", $this->Parameters["urls_TextureName"], "", false);
        $this->wp->AddParameter("6", "urls_ColorName", ccsText, "", "", $this->Parameters["urls_ColorName"], "", false);
        $this->wp->AddParameter("7", "urls_MaterialName", ccsText, "", "", $this->Parameters["urls_MaterialName"], "", false);
        $this->wp->AddParameter("8", "urls_CollectCode", ccsText, "", "", $this->Parameters["urls_CollectCode"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tblcollect_design.DesignCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "tblcollect_name.NameCode", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "tblcollect_category.CategoryCode", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "tblcollect_size.SizeCode", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "tblcollect_texture.TextureCode", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "tblcollect_color.ColorCode", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opEqual, "tblcollect_material.MaterialCode", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsText),false);
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

//Open Method @2-E8E3A601
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((((((tblcollect_master INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode";
        $this->SQL = "SELECT NameDesc, CollectCode, SizeName, CategoryName, ColorName, TextureName, DesignName, MaterialName, ClientCode, ClientDescription,\n\n" .
        "Photo1, RealSellingPrice, LastUpdate, ID, PriceDollar, PriceEuro \n\n" .
        "FROM ((((((tblcollect_master INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_material ON\n\n" .
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

//SetValues Method @2-F305CF03
    function SetValues()
    {
        $this->DesignName->SetDBValue($this->f("DesignName"));
        $this->NameDesc->SetDBValue($this->f("NameDesc"));
        $this->CategoryName->SetDBValue($this->f("CategoryName"));
        $this->SizeName->SetDBValue($this->f("SizeName"));
        $this->TextureName->SetDBValue($this->f("TextureName"));
        $this->ColorName->SetDBValue($this->f("ColorName"));
        $this->MaterialName->SetDBValue($this->f("MaterialName"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->RealSellingPrice->SetDBValue(trim($this->f("RealSellingPrice")));
        $this->LastUpdate->SetDBValue(trim($this->f("LastUpdate")));
        $this->ClientCode->SetDBValue($this->f("ClientCode"));
        $this->ClientDescription->SetDBValue($this->f("ClientDescription"));
        $this->CollectID->SetDBValue($this->f("ID"));
        $this->CollectCode->SetDBValue($this->f("CollectCode"));
        $this->PriceDollar->SetDBValue(trim($this->f("PriceDollar")));
        $this->PriceEuro->SetDBValue(trim($this->f("PriceEuro")));
        $this->lblPriceDollar->SetDBValue(trim($this->f("PriceDollar")));
        $this->lblPriceEuro->SetDBValue(trim($this->f("PriceEuro")));
    }
//End SetValues Method

} //End GridDataSource Class @2-FCB6E20C

//Initialize Page @1-B02076CC
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
$TemplateFileName = "PriceList.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-B68A5796
include_once("./PriceList_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D2FF37AB
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$Search = new clsRecordSearch("", $MainPage);
$Grid = new clsGridGrid("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->Search = & $Search;
$MainPage->Grid = & $Grid;
$Panel1->AddComponent("Search", $Search);
$Panel1->AddComponent("Grid", $Grid);
$Grid->Initialize();

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

//Execute Components @1-34D1993E
$Search->Operation();
//End Execute Components

//Go to destination page @1-7EE673AE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Search);
    unset($Grid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-79BA4D51
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D2DCB2C5
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Search);
unset($Grid);
unset($Tpl);
//End Unload Page


?>
