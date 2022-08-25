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

//Include Common Files @1-C4F4078B
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "EditSupplier.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblsupplier { //tblsupplier Class @2-7B45C5B8

//Variables @2-9E315808

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

//Class_Initialize Event @2-5A7E2B31
    function clsRecordtblsupplier($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblsupplier/Error";
        $this->DataSource = new clstblsupplierDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblsupplier";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->SupCode = new clsControl(ccsLabel, "SupCode", "Sup Code", ccsText, "", CCGetRequestParam("SupCode", $Method, NULL), $this);
            $this->SupCompany = new clsControl(ccsLabel, "SupCompany", "Sup Company", ccsText, "", CCGetRequestParam("SupCompany", $Method, NULL), $this);
            $this->SupContact = new clsControl(ccsTextBox, "SupContact", "Sup Contact", ccsText, "", CCGetRequestParam("SupContact", $Method, NULL), $this);
            $this->SupContact->Required = true;
            $this->SupAddress = new clsControl(ccsTextArea, "SupAddress", "Sup Address", ccsText, "", CCGetRequestParam("SupAddress", $Method, NULL), $this);
            $this->SupHP = new clsControl(ccsTextBox, "SupHP", "Sup HP", ccsText, "", CCGetRequestParam("SupHP", $Method, NULL), $this);
            $this->SupOffice = new clsControl(ccsTextBox, "SupOffice", "Sup Office", ccsText, "", CCGetRequestParam("SupOffice", $Method, NULL), $this);
            $this->SupFax = new clsControl(ccsTextBox, "SupFax", "Sup Fax", ccsText, "", CCGetRequestParam("SupFax", $Method, NULL), $this);
            $this->SupEmail = new clsControl(ccsTextBox, "SupEmail", "Sup Email", ccsText, "", CCGetRequestParam("SupEmail", $Method, NULL), $this);
            $this->SupItems = new clsControl(ccsTextBox, "SupItems", "Sup Items", ccsText, "", CCGetRequestParam("SupItems", $Method, NULL), $this);
            $this->SupOtherInfo = new clsControl(ccsTextArea, "SupOtherInfo", "Sup Other Info", ccsMemo, "", CCGetRequestParam("SupOtherInfo", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-D6CB1C94
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlID"] = CCGetFromGet("ID", NULL);
    }
//End Initialize Method

//Validate Method @2-DE08CEAF
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->SupContact->Validate() && $Validation);
        $Validation = ($this->SupAddress->Validate() && $Validation);
        $Validation = ($this->SupHP->Validate() && $Validation);
        $Validation = ($this->SupOffice->Validate() && $Validation);
        $Validation = ($this->SupFax->Validate() && $Validation);
        $Validation = ($this->SupEmail->Validate() && $Validation);
        $Validation = ($this->SupItems->Validate() && $Validation);
        $Validation = ($this->SupOtherInfo->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->SupContact->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SupAddress->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SupHP->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SupOffice->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SupFax->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SupEmail->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SupItems->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SupOtherInfo->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-7D106EFB
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->SupCode->Errors->Count());
        $errors = ($errors || $this->SupCompany->Errors->Count());
        $errors = ($errors || $this->SupContact->Errors->Count());
        $errors = ($errors || $this->SupAddress->Errors->Count());
        $errors = ($errors || $this->SupHP->Errors->Count());
        $errors = ($errors || $this->SupOffice->Errors->Count());
        $errors = ($errors || $this->SupFax->Errors->Count());
        $errors = ($errors || $this->SupEmail->Errors->Count());
        $errors = ($errors || $this->SupItems->Errors->Count());
        $errors = ($errors || $this->SupOtherInfo->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
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

//Operation Method @2-7CA6C471
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

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = "Supplier.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "SupCode"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = "Supplier.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "SupCode"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateRow Method @2-E3159DED
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->SupCode->SetValue($this->SupCode->GetValue(true));
        $this->DataSource->SupCompany->SetValue($this->SupCompany->GetValue(true));
        $this->DataSource->SupContact->SetValue($this->SupContact->GetValue(true));
        $this->DataSource->SupAddress->SetValue($this->SupAddress->GetValue(true));
        $this->DataSource->SupHP->SetValue($this->SupHP->GetValue(true));
        $this->DataSource->SupOffice->SetValue($this->SupOffice->GetValue(true));
        $this->DataSource->SupFax->SetValue($this->SupFax->GetValue(true));
        $this->DataSource->SupEmail->SetValue($this->SupEmail->GetValue(true));
        $this->DataSource->SupItems->SetValue($this->SupItems->GetValue(true));
        $this->DataSource->SupOtherInfo->SetValue($this->SupOtherInfo->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-CDC27097
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
                $this->SupCode->SetValue($this->DataSource->SupCode->GetValue());
                $this->SupCompany->SetValue($this->DataSource->SupCompany->GetValue());
                if(!$this->FormSubmitted){
                    $this->SupContact->SetValue($this->DataSource->SupContact->GetValue());
                    $this->SupAddress->SetValue($this->DataSource->SupAddress->GetValue());
                    $this->SupHP->SetValue($this->DataSource->SupHP->GetValue());
                    $this->SupOffice->SetValue($this->DataSource->SupOffice->GetValue());
                    $this->SupFax->SetValue($this->DataSource->SupFax->GetValue());
                    $this->SupEmail->SetValue($this->DataSource->SupEmail->GetValue());
                    $this->SupItems->SetValue($this->DataSource->SupItems->GetValue());
                    $this->SupOtherInfo->SetValue($this->DataSource->SupOtherInfo->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->SupCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupCompany->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupAddress->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupHP->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupOffice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupFax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupEmail->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupItems->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupOtherInfo->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->SupCode->Show();
        $this->SupCompany->Show();
        $this->SupContact->Show();
        $this->SupAddress->Show();
        $this->SupHP->Show();
        $this->SupOffice->Show();
        $this->SupFax->Show();
        $this->SupEmail->Show();
        $this->SupItems->Show();
        $this->SupOtherInfo->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblsupplier Class @2-FCB6E20C

class clstblsupplierDataSource extends clsDBGayaFusionAll {  //tblsupplierDataSource Class @2-A709D700

//DataSource Variables @2-264F411D
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $UpdateFields = array();

    // Datasource fields
    public $SupCode;
    public $SupCompany;
    public $SupContact;
    public $SupAddress;
    public $SupHP;
    public $SupOffice;
    public $SupFax;
    public $SupEmail;
    public $SupItems;
    public $SupOtherInfo;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-00332DAE
    function clstblsupplierDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblsupplier/Error";
        $this->Initialize();
        $this->SupCode = new clsField("SupCode", ccsText, "");
        
        $this->SupCompany = new clsField("SupCompany", ccsText, "");
        
        $this->SupContact = new clsField("SupContact", ccsText, "");
        
        $this->SupAddress = new clsField("SupAddress", ccsText, "");
        
        $this->SupHP = new clsField("SupHP", ccsText, "");
        
        $this->SupOffice = new clsField("SupOffice", ccsText, "");
        
        $this->SupFax = new clsField("SupFax", ccsText, "");
        
        $this->SupEmail = new clsField("SupEmail", ccsText, "");
        
        $this->SupItems = new clsField("SupItems", ccsText, "");
        
        $this->SupOtherInfo = new clsField("SupOtherInfo", ccsMemo, "");
        

        $this->UpdateFields["SupContact"] = array("Name" => "SupContact", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SupAddress"] = array("Name" => "SupAddress", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SupHP"] = array("Name" => "SupHP", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SupOffice"] = array("Name" => "SupOffice", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SupFax"] = array("Name" => "SupFax", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SupEmail"] = array("Name" => "SupEmail", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SupItems"] = array("Name" => "SupItems", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SupOtherInfo"] = array("Name" => "SupOtherInfo", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-C6736E1B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlID", ccsInteger, "", "", $this->Parameters["urlID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-799C8DB1
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblsupplier {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-39F4BB28
    function SetValues()
    {
        $this->SupCode->SetDBValue($this->f("SupCode"));
        $this->SupCompany->SetDBValue($this->f("SupCompany"));
        $this->SupContact->SetDBValue($this->f("SupContact"));
        $this->SupAddress->SetDBValue($this->f("SupAddress"));
        $this->SupHP->SetDBValue($this->f("SupHP"));
        $this->SupOffice->SetDBValue($this->f("SupOffice"));
        $this->SupFax->SetDBValue($this->f("SupFax"));
        $this->SupEmail->SetDBValue($this->f("SupEmail"));
        $this->SupItems->SetDBValue($this->f("SupItems"));
        $this->SupOtherInfo->SetDBValue($this->f("SupOtherInfo"));
    }
//End SetValues Method

//Update Method @2-4398BD4E
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["SupContact"]["Value"] = $this->SupContact->GetDBValue(true);
        $this->UpdateFields["SupAddress"]["Value"] = $this->SupAddress->GetDBValue(true);
        $this->UpdateFields["SupHP"]["Value"] = $this->SupHP->GetDBValue(true);
        $this->UpdateFields["SupOffice"]["Value"] = $this->SupOffice->GetDBValue(true);
        $this->UpdateFields["SupFax"]["Value"] = $this->SupFax->GetDBValue(true);
        $this->UpdateFields["SupEmail"]["Value"] = $this->SupEmail->GetDBValue(true);
        $this->UpdateFields["SupItems"]["Value"] = $this->SupItems->GetDBValue(true);
        $this->UpdateFields["SupOtherInfo"]["Value"] = $this->SupOtherInfo->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblsupplier", $this->UpdateFields, $this);
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @2-919B32E1
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tblsupplier";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End tblsupplierDataSource Class @2-FCB6E20C

//Initialize Page @1-0318F874
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
$TemplateFileName = "EditSupplier.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-AA512045
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblsupplier = new clsRecordtblsupplier("", $MainPage);
$MainPage->tblsupplier = & $tblsupplier;
$tblsupplier->Initialize();

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

//Execute Components @1-9ABAAB43
$tblsupplier->Operation();
//End Execute Components

//Go to destination page @1-665FF81C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblsupplier);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9F151312
$tblsupplier->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8F99269A
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblsupplier);
unset($Tpl);
//End Unload Page


?>
