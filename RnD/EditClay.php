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

//Include Common Files @1-D1446C31
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "EditClay.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblclay { //tblclay Class @2-B2B83375

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

//Class_Initialize Event @2-D77685DF
    function clsRecordtblclay($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblclay/Error";
        $this->DataSource = new clstblclayDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblclay";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "multipart/form-data";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->ClayCode = new clsControl(ccsLabel, "ClayCode", "Clay Code", ccsText, "", CCGetRequestParam("ClayCode", $Method, NULL), $this);
            $this->ClayDescription = new clsControl(ccsLabel, "ClayDescription", "Clay Description", ccsText, "", CCGetRequestParam("ClayDescription", $Method, NULL), $this);
            $this->ClayDate = new clsControl(ccsTextBox, "ClayDate", "Clay Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("ClayDate", $Method, NULL), $this);
            $this->ClayDate->Required = true;
            $this->DatePicker_ClayDate = new clsDatePicker("DatePicker_ClayDate", "tblclay", "ClayDate", $this);
            $this->ClayNotes = new clsControl(ccsTextArea, "ClayNotes", "Clay Notes", ccsMemo, "", CCGetRequestParam("ClayNotes", $Method, NULL), $this);
            $this->FileUpload1 = new clsFileUpload("FileUpload1", "FileUpload1", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->FileUpload2 = new clsFileUpload("FileUpload2", "FileUpload2", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->FileUpload3 = new clsFileUpload("FileUpload3", "FileUpload3", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->FileUpload4 = new clsFileUpload("FileUpload4", "FileUpload4", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->FileUpload5 = new clsFileUpload("FileUpload5", "FileUpload5", "%TEMP", "../upload/", "*", "", 100000, $this);
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

//Validate Method @2-DC9927EB
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ClayDate->Validate() && $Validation);
        $Validation = ($this->ClayNotes->Validate() && $Validation);
        $Validation = ($this->FileUpload1->Validate() && $Validation);
        $Validation = ($this->FileUpload2->Validate() && $Validation);
        $Validation = ($this->FileUpload3->Validate() && $Validation);
        $Validation = ($this->FileUpload4->Validate() && $Validation);
        $Validation = ($this->FileUpload5->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ClayDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClayNotes->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload5->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-843385ED
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ClayCode->Errors->Count());
        $errors = ($errors || $this->ClayDescription->Errors->Count());
        $errors = ($errors || $this->ClayDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_ClayDate->Errors->Count());
        $errors = ($errors || $this->ClayNotes->Errors->Count());
        $errors = ($errors || $this->FileUpload1->Errors->Count());
        $errors = ($errors || $this->FileUpload2->Errors->Count());
        $errors = ($errors || $this->FileUpload3->Errors->Count());
        $errors = ($errors || $this->FileUpload4->Errors->Count());
        $errors = ($errors || $this->FileUpload5->Errors->Count());
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

//Operation Method @2-F474ECAD
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

        $this->FileUpload1->Upload();
        $this->FileUpload2->Upload();
        $this->FileUpload3->Upload();
        $this->FileUpload4->Upload();
        $this->FileUpload5->Upload();

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
            $Redirect = "Clay.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "ClayCode"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = "Clay.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "ClayCode"));
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

//UpdateRow Method @2-515AEFFF
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ClayCode->SetValue($this->ClayCode->GetValue(true));
        $this->DataSource->ClayDescription->SetValue($this->ClayDescription->GetValue(true));
        $this->DataSource->ClayDate->SetValue($this->ClayDate->GetValue(true));
        $this->DataSource->ClayNotes->SetValue($this->ClayNotes->GetValue(true));
        $this->DataSource->FileUpload1->SetValue($this->FileUpload1->GetValue(true));
        $this->DataSource->FileUpload2->SetValue($this->FileUpload2->GetValue(true));
        $this->DataSource->FileUpload3->SetValue($this->FileUpload3->GetValue(true));
        $this->DataSource->FileUpload4->SetValue($this->FileUpload4->GetValue(true));
        $this->DataSource->FileUpload5->SetValue($this->FileUpload5->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->FileUpload1->Move();
            $this->FileUpload2->Move();
            $this->FileUpload3->Move();
            $this->FileUpload4->Move();
            $this->FileUpload5->Move();
        }
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-630D45DC
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->FileUpload1->Delete();
            $this->FileUpload2->Delete();
            $this->FileUpload3->Delete();
            $this->FileUpload4->Delete();
            $this->FileUpload5->Delete();
        }
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-318514F0
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
                $this->ClayCode->SetValue($this->DataSource->ClayCode->GetValue());
                $this->ClayDescription->SetValue($this->DataSource->ClayDescription->GetValue());
                if(!$this->FormSubmitted){
                    $this->ClayDate->SetValue($this->DataSource->ClayDate->GetValue());
                    $this->ClayNotes->SetValue($this->DataSource->ClayNotes->GetValue());
                    $this->FileUpload1->SetValue($this->DataSource->FileUpload1->GetValue());
                    $this->FileUpload2->SetValue($this->DataSource->FileUpload2->GetValue());
                    $this->FileUpload3->SetValue($this->DataSource->FileUpload3->GetValue());
                    $this->FileUpload4->SetValue($this->DataSource->FileUpload4->GetValue());
                    $this->FileUpload5->SetValue($this->DataSource->FileUpload5->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ClayCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_ClayDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayNotes->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload5->Errors->ToString());
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
        $this->ClayCode->Show();
        $this->ClayDescription->Show();
        $this->ClayDate->Show();
        $this->DatePicker_ClayDate->Show();
        $this->ClayNotes->Show();
        $this->FileUpload1->Show();
        $this->FileUpload2->Show();
        $this->FileUpload3->Show();
        $this->FileUpload4->Show();
        $this->FileUpload5->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblclay Class @2-FCB6E20C

class clstblclayDataSource extends clsDBGayaFusionAll {  //tblclayDataSource Class @2-232BD427

//DataSource Variables @2-4E200108
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
    public $ClayCode;
    public $ClayDescription;
    public $ClayDate;
    public $ClayNotes;
    public $FileUpload1;
    public $FileUpload2;
    public $FileUpload3;
    public $FileUpload4;
    public $FileUpload5;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-9703A2FF
    function clstblclayDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblclay/Error";
        $this->Initialize();
        $this->ClayCode = new clsField("ClayCode", ccsText, "");
        
        $this->ClayDescription = new clsField("ClayDescription", ccsText, "");
        
        $this->ClayDate = new clsField("ClayDate", ccsDate, $this->DateFormat);
        
        $this->ClayNotes = new clsField("ClayNotes", ccsMemo, "");
        
        $this->FileUpload1 = new clsField("FileUpload1", ccsText, "");
        
        $this->FileUpload2 = new clsField("FileUpload2", ccsText, "");
        
        $this->FileUpload3 = new clsField("FileUpload3", ccsText, "");
        
        $this->FileUpload4 = new clsField("FileUpload4", ccsText, "");
        
        $this->FileUpload5 = new clsField("FileUpload5", ccsText, "");
        

        $this->UpdateFields["ClayDate"] = array("Name" => "ClayDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClayNotes"] = array("Name" => "ClayNotes", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClayTechDraw"] = array("Name" => "ClayTechDraw", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClayPhoto1"] = array("Name" => "ClayPhoto1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClayPhoto2"] = array("Name" => "ClayPhoto2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClayPhoto3"] = array("Name" => "ClayPhoto3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClayPhoto4"] = array("Name" => "ClayPhoto4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @2-A8669435
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblclay {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-B3464B1C
    function SetValues()
    {
        $this->ClayCode->SetDBValue($this->f("ClayCode"));
        $this->ClayDescription->SetDBValue($this->f("ClayDescription"));
        $this->ClayDate->SetDBValue(trim($this->f("ClayDate")));
        $this->ClayNotes->SetDBValue($this->f("ClayNotes"));
        $this->FileUpload1->SetDBValue($this->f("ClayTechDraw"));
        $this->FileUpload2->SetDBValue($this->f("ClayPhoto1"));
        $this->FileUpload3->SetDBValue($this->f("ClayPhoto2"));
        $this->FileUpload4->SetDBValue($this->f("ClayPhoto3"));
        $this->FileUpload5->SetDBValue($this->f("ClayPhoto4"));
    }
//End SetValues Method

//Update Method @2-C1E34671
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["ClayDate"]["Value"] = $this->ClayDate->GetDBValue(true);
        $this->UpdateFields["ClayNotes"]["Value"] = $this->ClayNotes->GetDBValue(true);
        $this->UpdateFields["ClayTechDraw"]["Value"] = $this->FileUpload1->GetDBValue(true);
        $this->UpdateFields["ClayPhoto1"]["Value"] = $this->FileUpload2->GetDBValue(true);
        $this->UpdateFields["ClayPhoto2"]["Value"] = $this->FileUpload3->GetDBValue(true);
        $this->UpdateFields["ClayPhoto3"]["Value"] = $this->FileUpload4->GetDBValue(true);
        $this->UpdateFields["ClayPhoto4"]["Value"] = $this->FileUpload5->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblclay", $this->UpdateFields, $this);
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

//Delete Method @2-FED6C01B
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tblclay";
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

} //End tblclayDataSource Class @2-FCB6E20C

//Initialize Page @1-3F1EBB97
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
$TemplateFileName = "EditClay.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-42FA4BF1
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblclay = new clsRecordtblclay("", $MainPage);
$MainPage->tblclay = & $tblclay;
$tblclay->Initialize();

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

//Execute Components @1-DE418592
$tblclay->Operation();
//End Execute Components

//Go to destination page @1-8EB02727
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblclay);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-BE28FE0A
$tblclay->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-04E95DC7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblclay);
unset($Tpl);
//End Unload Page


?>
