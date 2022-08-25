<?php
session_start();
include ("../settings.php");
include("../language/$cfg_language");
include ("../classes/db_functions.php");
include ("../classes/security_functions.php");

$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'RnD',$lang);


if(!$sec->isLoggedIn())
{
	header ("location: ../login.php");
	exit();
}

//Include Common Files @1-4D7998B9
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ItemGroup.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordGroupHeader { //GroupHeader Class @51-A4A44D1B

//Variables @51-9E315808

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

//Class_Initialize Event @51-9B58E575
    function clsRecordGroupHeader($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record GroupHeader/Error";
        $this->DataSource = new clsGroupHeaderDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "GroupHeader";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->GroupCode = new clsControl(ccsLabel, "GroupCode", "Group Code", ccsText, "", CCGetRequestParam("GroupCode", $Method, NULL), $this);
            $this->GroupDate = new clsControl(ccsLabel, "GroupDate", "Group Date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("GroupDate", $Method, NULL), $this);
            $this->GroupDescription = new clsControl(ccsLabel, "GroupDescription", "Group Description", ccsText, "", CCGetRequestParam("GroupDescription", $Method, NULL), $this);
            $this->GroupPhoto = new clsControl(ccsImage, "GroupPhoto", "Group Photo", ccsText, "", CCGetRequestParam("GroupPhoto", $Method, NULL), $this);
            $this->FileFoto = new clsControl(ccsHidden, "FileFoto", "FileFoto", ccsText, "", CCGetRequestParam("FileFoto", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @51-6AF05085
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlGroup_H_ID"] = CCGetFromGet("Group_H_ID", NULL);
    }
//End Initialize Method

//Validate Method @51-C8BA2C9C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->FileFoto->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->FileFoto->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @51-46A83967
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->GroupCode->Errors->Count());
        $errors = ($errors || $this->GroupDate->Errors->Count());
        $errors = ($errors || $this->GroupDescription->Errors->Count());
        $errors = ($errors || $this->GroupPhoto->Errors->Count());
        $errors = ($errors || $this->FileFoto->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @51-ED598703
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

//Operation Method @51-17DC9883
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @51-651FBB90
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


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                $this->GroupCode->SetValue($this->DataSource->GroupCode->GetValue());
                $this->GroupDate->SetValue($this->DataSource->GroupDate->GetValue());
                $this->GroupDescription->SetValue($this->DataSource->GroupDescription->GetValue());
                $this->GroupPhoto->SetValue($this->DataSource->GroupPhoto->GetValue());
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->GroupCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GroupDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GroupDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GroupPhoto->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileFoto->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
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

        $this->GroupCode->Show();
        $this->GroupDate->Show();
        $this->GroupDescription->Show();
        $this->GroupPhoto->Show();
        $this->FileFoto->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End GroupHeader Class @51-FCB6E20C

class clsGroupHeaderDataSource extends clsDBGayaFusionAll {  //GroupHeaderDataSource Class @51-868D1831

//DataSource Variables @51-1146C0AE
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $GroupCode;
    public $GroupDate;
    public $GroupDescription;
    public $GroupPhoto;
    public $FileFoto;
//End DataSource Variables

//DataSourceClass_Initialize Event @51-847DD7FD
    function clsGroupHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record GroupHeader/Error";
        $this->Initialize();
        $this->GroupCode = new clsField("GroupCode", ccsText, "");
        
        $this->GroupDate = new clsField("GroupDate", ccsDate, $this->DateFormat);
        
        $this->GroupDescription = new clsField("GroupDescription", ccsText, "");
        
        $this->GroupPhoto = new clsField("GroupPhoto", ccsText, "");
        
        $this->FileFoto = new clsField("FileFoto", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @51-EB4225C2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlGroup_H_ID", ccsInteger, "", "", $this->Parameters["urlGroup_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Group_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @51-00083104
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblcollect_group_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @51-079545FE
    function SetValues()
    {
        $this->GroupCode->SetDBValue($this->f("GroupCode"));
        $this->GroupDate->SetDBValue(trim($this->f("GroupDate")));
        $this->GroupDescription->SetDBValue($this->f("GroupDescription"));
        $this->GroupPhoto->SetDBValue($this->f("GroupPhoto"));
    }
//End SetValues Method

} //End GroupHeaderDataSource Class @51-FCB6E20C

class clsEditableGridItemList { //ItemList Class @2-E9F80925

//Variables @2-F9538F3C

    // Public variables
    public $ComponentType = "EditableGrid";
    public $ComponentName;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormParameters;
    public $FormState;
    public $FormEnctype;
    public $CachedColumns;
    public $TotalRows;
    public $UpdatedRows;
    public $EmptyRows;
    public $Visible;
    public $RowsErrors;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode;
    public $ValidatingControls;
    public $Controls;
    public $ControlsErrors;
    public $RowNumber;
    public $Attributes;
    public $PrimaryKeys;

    // Class variables
//End Variables

//Class_Initialize Event @2-E54CD70C
    function clsEditableGridItemList($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid ItemList/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "ItemList";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["ID"][0] = "ID";
        $this->DataSource = new clsItemListDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 30;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->Group_H_ID = new clsControl(ccsHidden, "Group_H_ID", "Group H ID", ccsInteger, "", NULL, $this);
        $this->CollectCode = new clsControl(ccsTextBox, "CollectCode", "Collect Code", ccsText, "", NULL, $this);
        $this->DesignName = new clsControl(ccsTextBox, "DesignName", "Design Name", ccsText, "", NULL, $this);
        $this->NameDesc = new clsControl(ccsTextBox, "NameDesc", "Name Desc", ccsText, "", NULL, $this);
        $this->CategoryName = new clsControl(ccsTextBox, "CategoryName", "Category Name", ccsText, "", NULL, $this);
        $this->SizeName = new clsControl(ccsTextBox, "SizeName", "Size Name", ccsText, "", NULL, $this);
        $this->TextureName = new clsControl(ccsTextBox, "TextureName", "Texture Name", ccsText, "", NULL, $this);
        $this->ColorName = new clsControl(ccsTextBox, "ColorName", "Color Name", ccsText, "", NULL, $this);
        $this->MaterialName = new clsControl(ccsTextBox, "MaterialName", "Material Name", ccsText, "", NULL, $this);
        $this->Qty = new clsControl(ccsTextBox, "Qty", "Qty", ccsInteger, "", NULL, $this);
        $this->CheckBox_Delete_Panel = new clsPanel("CheckBox_Delete_Panel", $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->RowIDAttribute = new clsControl(ccsLabel, "RowIDAttribute", "RowIDAttribute", ccsText, "", NULL, $this);
        $this->RowStyleAttribute = new clsControl(ccsLabel, "RowStyleAttribute", "RowStyleAttribute", ccsText, "", NULL, $this);
        $this->RowNameAttribute = new clsControl(ccsLabel, "RowNameAttribute", "RowNameAttribute", ccsText, "", NULL, $this);
        $this->AddItem = new clsButton("AddItem", $Method, $this);
        $this->CollectID = new clsControl(ccsHidden, "CollectID", "CollectID", ccsText, "", NULL, $this);
        $this->LnkPopup = new clsControl(ccsImageLink, "LnkPopup", "LnkPopup", ccsText, "", NULL, $this);
        $this->LnkPopup->Parameters = CCGetQueryString("QueryString", array("FormFilter", "ccsForm"));
        $this->LnkPopup->Page = "";
        $this->CheckBox_Delete_Panel->AddComponent("CheckBox_Delete", $this->CheckBox_Delete);
    }
//End Class_Initialize Event

//Initialize Method @2-E55F5D29
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlGroup_H_ID"] = CCGetFromGet("Group_H_ID", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @2-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @2-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @2-65A599AD
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["Group_H_ID"][$RowNumber] = CCGetFromPost("Group_H_ID_" . $RowNumber, NULL);
            $this->FormParameters["CollectCode"][$RowNumber] = CCGetFromPost("CollectCode_" . $RowNumber, NULL);
            $this->FormParameters["DesignName"][$RowNumber] = CCGetFromPost("DesignName_" . $RowNumber, NULL);
            $this->FormParameters["NameDesc"][$RowNumber] = CCGetFromPost("NameDesc_" . $RowNumber, NULL);
            $this->FormParameters["CategoryName"][$RowNumber] = CCGetFromPost("CategoryName_" . $RowNumber, NULL);
            $this->FormParameters["SizeName"][$RowNumber] = CCGetFromPost("SizeName_" . $RowNumber, NULL);
            $this->FormParameters["TextureName"][$RowNumber] = CCGetFromPost("TextureName_" . $RowNumber, NULL);
            $this->FormParameters["ColorName"][$RowNumber] = CCGetFromPost("ColorName_" . $RowNumber, NULL);
            $this->FormParameters["MaterialName"][$RowNumber] = CCGetFromPost("MaterialName_" . $RowNumber, NULL);
            $this->FormParameters["Qty"][$RowNumber] = CCGetFromPost("Qty_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["CollectID"][$RowNumber] = CCGetFromPost("CollectID_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @2-F6E7591C
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["ID"] = $this->CachedColumns["ID"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->Group_H_ID->SetText($this->FormParameters["Group_H_ID"][$this->RowNumber], $this->RowNumber);
            $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
            $this->DesignName->SetText($this->FormParameters["DesignName"][$this->RowNumber], $this->RowNumber);
            $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
            $this->CategoryName->SetText($this->FormParameters["CategoryName"][$this->RowNumber], $this->RowNumber);
            $this->SizeName->SetText($this->FormParameters["SizeName"][$this->RowNumber], $this->RowNumber);
            $this->TextureName->SetText($this->FormParameters["TextureName"][$this->RowNumber], $this->RowNumber);
            $this->ColorName->SetText($this->FormParameters["ColorName"][$this->RowNumber], $this->RowNumber);
            $this->MaterialName->SetText($this->FormParameters["MaterialName"][$this->RowNumber], $this->RowNumber);
            $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @2-C701454A
    function ValidateRow()
    {
        global $CCSLocales;
        $this->Group_H_ID->Validate();
        $this->CollectCode->Validate();
        $this->DesignName->Validate();
        $this->NameDesc->Validate();
        $this->CategoryName->Validate();
        $this->SizeName->Validate();
        $this->TextureName->Validate();
        $this->ColorName->Validate();
        $this->MaterialName->Validate();
        $this->Qty->Validate();
        $this->CheckBox_Delete->Validate();
        $this->CollectID->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->Group_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CategoryName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SizeName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ColorName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MaterialName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectID->Errors->ToString());
        $this->Group_H_ID->Errors->Clear();
        $this->CollectCode->Errors->Clear();
        $this->DesignName->Errors->Clear();
        $this->NameDesc->Errors->Clear();
        $this->CategoryName->Errors->Clear();
        $this->SizeName->Errors->Clear();
        $this->TextureName->Errors->Clear();
        $this->ColorName->Errors->Clear();
        $this->MaterialName->Errors->Clear();
        $this->Qty->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $this->CollectID->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-BD2F2664
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["Group_H_ID"][$this->RowNumber]) && count($this->FormParameters["Group_H_ID"][$this->RowNumber])) || strlen($this->FormParameters["Group_H_ID"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["CollectCode"][$this->RowNumber]) && count($this->FormParameters["CollectCode"][$this->RowNumber])) || strlen($this->FormParameters["CollectCode"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["DesignName"][$this->RowNumber]) && count($this->FormParameters["DesignName"][$this->RowNumber])) || strlen($this->FormParameters["DesignName"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["NameDesc"][$this->RowNumber]) && count($this->FormParameters["NameDesc"][$this->RowNumber])) || strlen($this->FormParameters["NameDesc"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["CategoryName"][$this->RowNumber]) && count($this->FormParameters["CategoryName"][$this->RowNumber])) || strlen($this->FormParameters["CategoryName"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["SizeName"][$this->RowNumber]) && count($this->FormParameters["SizeName"][$this->RowNumber])) || strlen($this->FormParameters["SizeName"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["TextureName"][$this->RowNumber]) && count($this->FormParameters["TextureName"][$this->RowNumber])) || strlen($this->FormParameters["TextureName"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["ColorName"][$this->RowNumber]) && count($this->FormParameters["ColorName"][$this->RowNumber])) || strlen($this->FormParameters["ColorName"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["MaterialName"][$this->RowNumber]) && count($this->FormParameters["MaterialName"][$this->RowNumber])) || strlen($this->FormParameters["MaterialName"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Qty"][$this->RowNumber]) && count($this->FormParameters["Qty"][$this->RowNumber])) || strlen($this->FormParameters["Qty"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["CollectID"][$this->RowNumber]) && count($this->FormParameters["CollectID"][$this->RowNumber])) || strlen($this->FormParameters["CollectID"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @2-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-B09453A6
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        } else if($this->AddItem->Pressed) {
            $this->PressedButton = "AddItem";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            } else {
                $Redirect = "CollectionGroup.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "Group_H_ID"));
            }
        } else if($this->PressedButton == "AddItem") {
            if(!CCGetEvent($this->AddItem->CCSEvents, "OnClick", $this->AddItem)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @2-44100FC8
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["ID"] = $this->CachedColumns["ID"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->Group_H_ID->SetText($this->FormParameters["Group_H_ID"][$this->RowNumber], $this->RowNumber);
            $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
            $this->DesignName->SetText($this->FormParameters["DesignName"][$this->RowNumber], $this->RowNumber);
            $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
            $this->CategoryName->SetText($this->FormParameters["CategoryName"][$this->RowNumber], $this->RowNumber);
            $this->SizeName->SetText($this->FormParameters["SizeName"][$this->RowNumber], $this->RowNumber);
            $this->TextureName->SetText($this->FormParameters["TextureName"][$this->RowNumber], $this->RowNumber);
            $this->ColorName->SetText($this->FormParameters["ColorName"][$this->RowNumber], $this->RowNumber);
            $this->MaterialName->SetText($this->FormParameters["MaterialName"][$this->RowNumber], $this->RowNumber);
            $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//InsertRow Method @2-B38715BD
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->Group_H_ID->SetValue($this->Group_H_ID->GetValue(true));
        $this->DataSource->CollectCode->SetValue($this->CollectCode->GetValue(true));
        $this->DataSource->DesignName->SetValue($this->DesignName->GetValue(true));
        $this->DataSource->NameDesc->SetValue($this->NameDesc->GetValue(true));
        $this->DataSource->CategoryName->SetValue($this->CategoryName->GetValue(true));
        $this->DataSource->SizeName->SetValue($this->SizeName->GetValue(true));
        $this->DataSource->TextureName->SetValue($this->TextureName->GetValue(true));
        $this->DataSource->ColorName->SetValue($this->ColorName->GetValue(true));
        $this->DataSource->MaterialName->SetValue($this->MaterialName->GetValue(true));
        $this->DataSource->Qty->SetValue($this->Qty->GetValue(true));
        $this->DataSource->RowIDAttribute->SetValue($this->RowIDAttribute->GetValue(true));
        $this->DataSource->RowStyleAttribute->SetValue($this->RowStyleAttribute->GetValue(true));
        $this->DataSource->RowNameAttribute->SetValue($this->RowNameAttribute->GetValue(true));
        $this->DataSource->CollectID->SetValue($this->CollectID->GetValue(true));
        $this->DataSource->LnkPopup->SetValue($this->LnkPopup->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @2-C133B27D
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->Group_H_ID->SetValue($this->Group_H_ID->GetValue(true));
        $this->DataSource->CollectCode->SetValue($this->CollectCode->GetValue(true));
        $this->DataSource->Qty->SetValue($this->Qty->GetValue(true));
        $this->DataSource->CollectID->SetValue($this->CollectID->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @2-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @2-DEDEB2B4
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var ItemListElements;\n";
        $script .= "var ItemListEmptyRows = 30;\n";
        $script .= "var " . $this->ComponentName . "Group_H_IDID = 0;\n";
        $script .= "var " . $this->ComponentName . "CollectCodeID = 1;\n";
        $script .= "var " . $this->ComponentName . "DesignNameID = 2;\n";
        $script .= "var " . $this->ComponentName . "NameDescID = 3;\n";
        $script .= "var " . $this->ComponentName . "CategoryNameID = 4;\n";
        $script .= "var " . $this->ComponentName . "SizeNameID = 5;\n";
        $script .= "var " . $this->ComponentName . "TextureNameID = 6;\n";
        $script .= "var " . $this->ComponentName . "ColorNameID = 7;\n";
        $script .= "var " . $this->ComponentName . "MaterialNameID = 8;\n";
        $script .= "var " . $this->ComponentName . "QtyID = 9;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 10;\n";
        $script .= "var " . $this->ComponentName . "CollectIDID = 11;\n";
        $script .= "\nfunction initItemListElements() {\n";
        $script .= "\tvar ED = document.forms[\"ItemList\"];\n";
        $script .= "\tItemListElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.Group_H_ID_" . $i . ", " . "ED.CollectCode_" . $i . ", " . "ED.DesignName_" . $i . ", " . "ED.NameDesc_" . $i . ", " . "ED.CategoryName_" . $i . ", " . "ED.SizeName_" . $i . ", " . "ED.TextureName_" . $i . ", " . "ED.ColorName_" . $i . ", " . "ED.MaterialName_" . $i . ", " . "ED.Qty_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ", " . "ED.CollectID_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @2-CD28CF05
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["ID"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["ID"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @2-1D4E6124
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["ID"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @2-092D7407
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["Group_H_ID"] = $this->Group_H_ID->Visible;
        $this->ControlsVisible["CollectCode"] = $this->CollectCode->Visible;
        $this->ControlsVisible["DesignName"] = $this->DesignName->Visible;
        $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
        $this->ControlsVisible["CategoryName"] = $this->CategoryName->Visible;
        $this->ControlsVisible["SizeName"] = $this->SizeName->Visible;
        $this->ControlsVisible["TextureName"] = $this->TextureName->Visible;
        $this->ControlsVisible["ColorName"] = $this->ColorName->Visible;
        $this->ControlsVisible["MaterialName"] = $this->MaterialName->Visible;
        $this->ControlsVisible["Qty"] = $this->Qty->Visible;
        $this->ControlsVisible["CheckBox_Delete_Panel"] = $this->CheckBox_Delete_Panel->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["RowIDAttribute"] = $this->RowIDAttribute->Visible;
        $this->ControlsVisible["RowStyleAttribute"] = $this->RowStyleAttribute->Visible;
        $this->ControlsVisible["RowNameAttribute"] = $this->RowNameAttribute->Visible;
        $this->ControlsVisible["CollectID"] = $this->CollectID->Visible;
        $this->ControlsVisible["LnkPopup"] = $this->LnkPopup->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                    $this->CheckBox_Delete_Panel->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["ID"][$this->RowNumber] = $this->DataSource->CachedColumns["ID"];
                    $this->CollectCode->SetText("");
                    $this->DesignName->SetText("");
                    $this->NameDesc->SetText("");
                    $this->CategoryName->SetText("");
                    $this->SizeName->SetText("");
                    $this->TextureName->SetText("");
                    $this->ColorName->SetText("");
                    $this->MaterialName->SetText("");
                    $this->CheckBox_Delete->SetValue("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->LnkPopup->SetText("");
                    $this->Group_H_ID->SetValue($this->DataSource->Group_H_ID->GetValue());
                    $this->Qty->SetValue($this->DataSource->Qty->GetValue());
                    $this->CollectID->SetValue($this->DataSource->CollectID->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->LnkPopup->SetText("");
                    $this->Group_H_ID->SetText($this->FormParameters["Group_H_ID"][$this->RowNumber], $this->RowNumber);
                    $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
                    $this->DesignName->SetText($this->FormParameters["DesignName"][$this->RowNumber], $this->RowNumber);
                    $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
                    $this->CategoryName->SetText($this->FormParameters["CategoryName"][$this->RowNumber], $this->RowNumber);
                    $this->SizeName->SetText($this->FormParameters["SizeName"][$this->RowNumber], $this->RowNumber);
                    $this->TextureName->SetText($this->FormParameters["TextureName"][$this->RowNumber], $this->RowNumber);
                    $this->ColorName->SetText($this->FormParameters["ColorName"][$this->RowNumber], $this->RowNumber);
                    $this->MaterialName->SetText($this->FormParameters["MaterialName"][$this->RowNumber], $this->RowNumber);
                    $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["ID"][$this->RowNumber] = "";
                    $this->Group_H_ID->SetText("");
                    $this->CollectCode->SetText("");
                    $this->DesignName->SetText("");
                    $this->NameDesc->SetText("");
                    $this->CategoryName->SetText("");
                    $this->SizeName->SetText("");
                    $this->TextureName->SetText("");
                    $this->ColorName->SetText("");
                    $this->MaterialName->SetText("");
                    $this->Qty->SetText("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->CollectID->SetText("");
                    $this->LnkPopup->SetText("");
                } else {
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->LnkPopup->SetText("");
                    $this->Group_H_ID->SetText($this->FormParameters["Group_H_ID"][$this->RowNumber], $this->RowNumber);
                    $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
                    $this->DesignName->SetText($this->FormParameters["DesignName"][$this->RowNumber], $this->RowNumber);
                    $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
                    $this->CategoryName->SetText($this->FormParameters["CategoryName"][$this->RowNumber], $this->RowNumber);
                    $this->SizeName->SetText($this->FormParameters["SizeName"][$this->RowNumber], $this->RowNumber);
                    $this->TextureName->SetText($this->FormParameters["TextureName"][$this->RowNumber], $this->RowNumber);
                    $this->ColorName->SetText($this->FormParameters["ColorName"][$this->RowNumber], $this->RowNumber);
                    $this->MaterialName->SetText($this->FormParameters["MaterialName"][$this->RowNumber], $this->RowNumber);
                    $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Group_H_ID->Show($this->RowNumber);
                $this->CollectCode->Show($this->RowNumber);
                $this->DesignName->Show($this->RowNumber);
                $this->NameDesc->Show($this->RowNumber);
                $this->CategoryName->Show($this->RowNumber);
                $this->SizeName->Show($this->RowNumber);
                $this->TextureName->Show($this->RowNumber);
                $this->ColorName->Show($this->RowNumber);
                $this->MaterialName->Show($this->RowNumber);
                $this->Qty->Show($this->RowNumber);
                $this->CheckBox_Delete_Panel->Show($this->RowNumber);
                $this->RowIDAttribute->Show($this->RowNumber);
                $this->RowStyleAttribute->Show($this->RowNumber);
                $this->RowNameAttribute->Show($this->RowNumber);
                $this->CollectID->Show($this->RowNumber);
                $this->LnkPopup->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["ID"] == $this->CachedColumns["ID"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Button_Submit->Show();
        $this->AddItem->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End ItemList Class @2-FCB6E20C

class clsItemListDataSource extends clsDBGayaFusionAll {  //ItemListDataSource Class @2-21A93E66

//DataSource Variables @2-C7B198C1
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;
    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $Group_H_ID;
    public $CollectCode;
    public $DesignName;
    public $NameDesc;
    public $CategoryName;
    public $SizeName;
    public $TextureName;
    public $ColorName;
    public $MaterialName;
    public $Qty;
    public $CheckBox_Delete;
    public $RowIDAttribute;
    public $RowStyleAttribute;
    public $RowNameAttribute;
    public $CollectID;
    public $LnkPopup;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-01A0B102
    function clsItemListDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid ItemList/Error";
        $this->Initialize();
        $this->Group_H_ID = new clsField("Group_H_ID", ccsInteger, "");
        
        $this->CollectCode = new clsField("CollectCode", ccsText, "");
        
        $this->DesignName = new clsField("DesignName", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->CategoryName = new clsField("CategoryName", ccsText, "");
        
        $this->SizeName = new clsField("SizeName", ccsText, "");
        
        $this->TextureName = new clsField("TextureName", ccsText, "");
        
        $this->ColorName = new clsField("ColorName", ccsText, "");
        
        $this->MaterialName = new clsField("MaterialName", ccsText, "");
        
        $this->Qty = new clsField("Qty", ccsInteger, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->RowIDAttribute = new clsField("RowIDAttribute", ccsText, "");
        
        $this->RowStyleAttribute = new clsField("RowStyleAttribute", ccsText, "");
        
        $this->RowNameAttribute = new clsField("RowNameAttribute", ccsText, "");
        
        $this->CollectID = new clsField("CollectID", ccsText, "");
        
        $this->LnkPopup = new clsField("LnkPopup", ccsText, "");
        

        $this->InsertFields["Group_H_ID"] = array("Name" => "Group_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Qty"] = array("Name" => "Qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["CollectCode"] = array("Name" => "CollectCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Group_H_ID"] = array("Name" => "Group_H_ID", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["CollectCode"] = array("Name" => "CollectCode", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["Qty"] = array("Name" => "Qty", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["CollectCode"] = array("Name" => "CollectCode", "Value" => "", "DataType" => ccsText);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-EB4225C2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlGroup_H_ID", ccsInteger, "", "", $this->Parameters["urlGroup_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Group_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-0248D924
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tblcollect_group_det";
        $this->SQL = "SELECT * \n\n" .
        "FROM tblcollect_group_det {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-04F6C388
    function SetValues()
    {
        $this->CachedColumns["ID"] = $this->f("ID");
        $this->Group_H_ID->SetDBValue(trim($this->f("Group_H_ID")));
        $this->Qty->SetDBValue(trim($this->f("Qty")));
        $this->CollectID->SetDBValue($this->f("CollectCode"));
    }
//End SetValues Method

//Insert Method @2-DA65E96D
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["Group_H_ID"]["Value"] = $this->Group_H_ID->GetDBValue(true);
        $this->InsertFields["Qty"]["Value"] = $this->Qty->GetDBValue(true);
        $this->InsertFields["CollectCode"]["Value"] = $this->CollectID->GetDBValue(true);
        $this->SQL = CCBuildInsert("tblcollect_group_det", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-A799B180
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["Group_H_ID"] = new clsSQLParameter("ctrlGroup_H_ID", ccsInteger, "", "", $this->Group_H_ID->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["CollectCode"] = new clsSQLParameter("ctrlCollectCode", ccsText, "", "", $this->CollectCode->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["Qty"] = new clsSQLParameter("ctrlQty", ccsInteger, "", "", $this->Qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["CollectCode"] = new clsSQLParameter("ctrlCollectID", ccsText, "", "", $this->CollectID->GetValue(true), "", false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsID", ccsInteger, "", "", $this->CachedColumns["ID"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["Group_H_ID"]->GetValue()) and !strlen($this->cp["Group_H_ID"]->GetText()) and !is_bool($this->cp["Group_H_ID"]->GetValue())) 
            $this->cp["Group_H_ID"]->SetValue($this->Group_H_ID->GetValue(true));
        if (!is_null($this->cp["CollectCode"]->GetValue()) and !strlen($this->cp["CollectCode"]->GetText()) and !is_bool($this->cp["CollectCode"]->GetValue())) 
            $this->cp["CollectCode"]->SetValue($this->CollectCode->GetValue(true));
        if (!is_null($this->cp["Qty"]->GetValue()) and !strlen($this->cp["Qty"]->GetText()) and !is_bool($this->cp["Qty"]->GetValue())) 
            $this->cp["Qty"]->SetValue($this->Qty->GetValue(true));
        if (!is_null($this->cp["CollectCode"]->GetValue()) and !strlen($this->cp["CollectCode"]->GetText()) and !is_bool($this->cp["CollectCode"]->GetValue())) 
            $this->cp["CollectCode"]->SetValue($this->CollectID->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "ID", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["Group_H_ID"]["Value"] = $this->cp["Group_H_ID"]->GetDBValue(true);
        $this->UpdateFields["CollectCode"]["Value"] = $this->cp["CollectCode"]->GetDBValue(true);
        $this->UpdateFields["Qty"]["Value"] = $this->cp["Qty"]->GetDBValue(true);
        $this->UpdateFields["CollectCode"]["Value"] = $this->cp["CollectCode"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblcollect_group_det", $this->UpdateFields, $this);
        $this->SQL = CCBuildSQL($this->SQL, $Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @2-85795930
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "ID=" . $this->ToSQL($this->CachedColumns["ID"], ccsInteger);
        $this->SQL = "DELETE FROM tblcollect_group_det";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End ItemListDataSource Class @2-FCB6E20C



//Initialize Page @1-81CC4315
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
$TemplateFileName = "ItemGroup.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-361159C9
include_once("./ItemGroup_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-74C96912
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$GroupHeader = new clsRecordGroupHeader("", $MainPage);
$ItemList = new clsEditableGridItemList("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->GroupHeader = & $GroupHeader;
$MainPage->ItemList = & $ItemList;
$Panel1->AddComponent("GroupHeader", $GroupHeader);
$Panel1->AddComponent("ItemList", $ItemList);
$GroupHeader->Initialize();
$ItemList->Initialize();

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

//Execute Components @1-D4C07708
$GroupHeader->Operation();
$ItemList->Operation();
//End Execute Components

//Go to destination page @1-AD34D4CC
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($GroupHeader);
    unset($ItemList);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-601FFDAE
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-A7203373
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($GroupHeader);
unset($ItemList);
unset($Tpl);
//End Unload Page


?>
