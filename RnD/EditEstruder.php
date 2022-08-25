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

//Include Common Files @1-B1908BDD
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "EditEstruder.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblestruder { //tblestruder Class @2-44ED5FF2

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

//Class_Initialize Event @2-4C606848
    function clsRecordtblestruder($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblestruder/Error";
        $this->DataSource = new clstblestruderDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblestruder";
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
            $this->EstruderCode = new clsControl(ccsLabel, "EstruderCode", "Estruder Code", ccsText, "", CCGetRequestParam("EstruderCode", $Method, NULL), $this);
            $this->EstruderDescription = new clsControl(ccsLabel, "EstruderDescription", "Estruder Description", ccsText, "", CCGetRequestParam("EstruderDescription", $Method, NULL), $this);
            $this->EstruderDate = new clsControl(ccsTextBox, "EstruderDate", "Estruder Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("EstruderDate", $Method, NULL), $this);
            $this->EstruderDate->Required = true;
            $this->DatePicker_EstruderDate = new clsDatePicker("DatePicker_EstruderDate", "tblestruder", "EstruderDate", $this);
            $this->EstruderNotes = new clsControl(ccsTextArea, "EstruderNotes", "Estruder Notes", ccsMemo, "", CCGetRequestParam("EstruderNotes", $Method, NULL), $this);
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

//Validate Method @2-B8B4F713
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->EstruderDate->Validate() && $Validation);
        $Validation = ($this->EstruderNotes->Validate() && $Validation);
        $Validation = ($this->FileUpload1->Validate() && $Validation);
        $Validation = ($this->FileUpload2->Validate() && $Validation);
        $Validation = ($this->FileUpload3->Validate() && $Validation);
        $Validation = ($this->FileUpload4->Validate() && $Validation);
        $Validation = ($this->FileUpload5->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->EstruderDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->EstruderNotes->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload5->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-5D3D7759
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->EstruderCode->Errors->Count());
        $errors = ($errors || $this->EstruderDescription->Errors->Count());
        $errors = ($errors || $this->EstruderDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_EstruderDate->Errors->Count());
        $errors = ($errors || $this->EstruderNotes->Errors->Count());
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

//Operation Method @2-4A6A114F
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
            $Redirect = "Estruder.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "EstruderCode"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = "Estruder.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "EstruderCode"));
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

//UpdateRow Method @2-3CC7513A
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->EstruderCode->SetValue($this->EstruderCode->GetValue(true));
        $this->DataSource->EstruderDescription->SetValue($this->EstruderDescription->GetValue(true));
        $this->DataSource->EstruderDate->SetValue($this->EstruderDate->GetValue(true));
        $this->DataSource->EstruderNotes->SetValue($this->EstruderNotes->GetValue(true));
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

//Show Method @2-92C2BE1D
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
                $this->EstruderCode->SetValue($this->DataSource->EstruderCode->GetValue());
                $this->EstruderDescription->SetValue($this->DataSource->EstruderDescription->GetValue());
                if(!$this->FormSubmitted){
                    $this->EstruderDate->SetValue($this->DataSource->EstruderDate->GetValue());
                    $this->EstruderNotes->SetValue($this->DataSource->EstruderNotes->GetValue());
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
            $Error = ComposeStrings($Error, $this->EstruderCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EstruderDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EstruderDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_EstruderDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EstruderNotes->Errors->ToString());
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
        $this->EstruderCode->Show();
        $this->EstruderDescription->Show();
        $this->EstruderDate->Show();
        $this->DatePicker_EstruderDate->Show();
        $this->EstruderNotes->Show();
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

} //End tblestruder Class @2-FCB6E20C

class clstblestruderDataSource extends clsDBGayaFusionAll {  //tblestruderDataSource Class @2-A80CA00D

//DataSource Variables @2-1AADBDED
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
    public $EstruderCode;
    public $EstruderDescription;
    public $EstruderDate;
    public $EstruderNotes;
    public $FileUpload1;
    public $FileUpload2;
    public $FileUpload3;
    public $FileUpload4;
    public $FileUpload5;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-13A477F3
    function clstblestruderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblestruder/Error";
        $this->Initialize();
        $this->EstruderCode = new clsField("EstruderCode", ccsText, "");
        
        $this->EstruderDescription = new clsField("EstruderDescription", ccsText, "");
        
        $this->EstruderDate = new clsField("EstruderDate", ccsDate, $this->DateFormat);
        
        $this->EstruderNotes = new clsField("EstruderNotes", ccsMemo, "");
        
        $this->FileUpload1 = new clsField("FileUpload1", ccsText, "");
        
        $this->FileUpload2 = new clsField("FileUpload2", ccsText, "");
        
        $this->FileUpload3 = new clsField("FileUpload3", ccsText, "");
        
        $this->FileUpload4 = new clsField("FileUpload4", ccsText, "");
        
        $this->FileUpload5 = new clsField("FileUpload5", ccsText, "");
        

        $this->UpdateFields["EstruderDate"] = array("Name" => "EstruderDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["EstruderNotes"] = array("Name" => "EstruderNotes", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["EstruderTechDraw"] = array("Name" => "EstruderTechDraw", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["EstruderPhoto1"] = array("Name" => "EstruderPhoto1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["EstruderPhoto2"] = array("Name" => "EstruderPhoto2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["EstruderPhoto3"] = array("Name" => "EstruderPhoto3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["EstruderPhoto4"] = array("Name" => "EstruderPhoto4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @2-FB36456E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblestruder {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-C5C8D201
    function SetValues()
    {
        $this->EstruderCode->SetDBValue($this->f("EstruderCode"));
        $this->EstruderDescription->SetDBValue($this->f("EstruderDescription"));
        $this->EstruderDate->SetDBValue(trim($this->f("EstruderDate")));
        $this->EstruderNotes->SetDBValue($this->f("EstruderNotes"));
        $this->FileUpload1->SetDBValue($this->f("EstruderTechDraw"));
        $this->FileUpload2->SetDBValue($this->f("EstruderPhoto1"));
        $this->FileUpload3->SetDBValue($this->f("EstruderPhoto2"));
        $this->FileUpload4->SetDBValue($this->f("EstruderPhoto3"));
        $this->FileUpload5->SetDBValue($this->f("EstruderPhoto4"));
    }
//End SetValues Method

//Update Method @2-48C512C9
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["EstruderDate"]["Value"] = $this->EstruderDate->GetDBValue(true);
        $this->UpdateFields["EstruderNotes"]["Value"] = $this->EstruderNotes->GetDBValue(true);
        $this->UpdateFields["EstruderTechDraw"]["Value"] = $this->FileUpload1->GetDBValue(true);
        $this->UpdateFields["EstruderPhoto1"]["Value"] = $this->FileUpload2->GetDBValue(true);
        $this->UpdateFields["EstruderPhoto2"]["Value"] = $this->FileUpload3->GetDBValue(true);
        $this->UpdateFields["EstruderPhoto3"]["Value"] = $this->FileUpload4->GetDBValue(true);
        $this->UpdateFields["EstruderPhoto4"]["Value"] = $this->FileUpload5->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblestruder", $this->UpdateFields, $this);
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

//Delete Method @2-4166412C
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tblestruder";
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

} //End tblestruderDataSource Class @2-FCB6E20C

//Initialize Page @1-3599698D
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
$TemplateFileName = "EditEstruder.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-113774E1
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblestruder = new clsRecordtblestruder("", $MainPage);
$MainPage->tblestruder = & $tblestruder;
$tblestruder->Initialize();

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

//Execute Components @1-49C6B40B
$tblestruder->Operation();
//End Execute Components

//Go to destination page @1-C9C2E403
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblestruder);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-3FA6C930
$tblestruder->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);

$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5CE539D2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblestruder);
unset($Tpl);
//End Unload Page


?>
