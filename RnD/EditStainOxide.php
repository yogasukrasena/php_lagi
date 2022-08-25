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

//Include Common Files @1-367D13ED
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "EditStainOxide.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblstainoxide { //tblstainoxide Class @2-27CFCEBB

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

//Class_Initialize Event @2-51A05947
    function clsRecordtblstainoxide($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblstainoxide/Error";
        $this->DataSource = new clstblstainoxideDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblstainoxide";
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
            $this->StainOxideCode = new clsControl(ccsLabel, "StainOxideCode", "Stain Oxide Code", ccsText, "", CCGetRequestParam("StainOxideCode", $Method, NULL), $this);
            $this->StainOxideDescription = new clsControl(ccsLabel, "StainOxideDescription", "Stain Oxide Description", ccsText, "", CCGetRequestParam("StainOxideDescription", $Method, NULL), $this);
            $this->StainOxideDate = new clsControl(ccsTextBox, "StainOxideDate", "Stain Oxide Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("StainOxideDate", $Method, NULL), $this);
            $this->StainOxideDate->Required = true;
            $this->DatePicker_StainOxideDate = new clsDatePicker("DatePicker_StainOxideDate", "tblstainoxide", "StainOxideDate", $this);
            $this->StainOxideNotes = new clsControl(ccsTextArea, "StainOxideNotes", "Stain Oxide Notes", ccsMemo, "", CCGetRequestParam("StainOxideNotes", $Method, NULL), $this);
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

//Validate Method @2-AA89F7BA
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->StainOxideDate->Validate() && $Validation);
        $Validation = ($this->StainOxideNotes->Validate() && $Validation);
        $Validation = ($this->FileUpload1->Validate() && $Validation);
        $Validation = ($this->FileUpload2->Validate() && $Validation);
        $Validation = ($this->FileUpload3->Validate() && $Validation);
        $Validation = ($this->FileUpload4->Validate() && $Validation);
        $Validation = ($this->FileUpload5->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->StainOxideDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxideNotes->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload5->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-16A955A6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->StainOxideCode->Errors->Count());
        $errors = ($errors || $this->StainOxideDescription->Errors->Count());
        $errors = ($errors || $this->StainOxideDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_StainOxideDate->Errors->Count());
        $errors = ($errors || $this->StainOxideNotes->Errors->Count());
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

//Operation Method @2-0EFFED11
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
            $Redirect = "StainOxide.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "StainOxideCode"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = "StainOxide.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "StainOxideCode"));
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

//UpdateRow Method @2-C9EB8844
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->StainOxideCode->SetValue($this->StainOxideCode->GetValue(true));
        $this->DataSource->StainOxideDescription->SetValue($this->StainOxideDescription->GetValue(true));
        $this->DataSource->StainOxideDate->SetValue($this->StainOxideDate->GetValue(true));
        $this->DataSource->StainOxideNotes->SetValue($this->StainOxideNotes->GetValue(true));
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

//Show Method @2-3CCB86AC
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
                $this->StainOxideCode->SetValue($this->DataSource->StainOxideCode->GetValue());
                $this->StainOxideDescription->SetValue($this->DataSource->StainOxideDescription->GetValue());
                if(!$this->FormSubmitted){
                    $this->StainOxideDate->SetValue($this->DataSource->StainOxideDate->GetValue());
                    $this->StainOxideNotes->SetValue($this->DataSource->StainOxideNotes->GetValue());
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
            $Error = ComposeStrings($Error, $this->StainOxideCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxideDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxideDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_StainOxideDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxideNotes->Errors->ToString());
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
        $this->StainOxideCode->Show();
        $this->StainOxideDescription->Show();
        $this->StainOxideDate->Show();
        $this->DatePicker_StainOxideDate->Show();
        $this->StainOxideNotes->Show();
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

} //End tblstainoxide Class @2-FCB6E20C

class clstblstainoxideDataSource extends clsDBGayaFusionAll {  //tblstainoxideDataSource Class @2-E62D4DC1

//DataSource Variables @2-406A823E
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
    public $StainOxideCode;
    public $StainOxideDescription;
    public $StainOxideDate;
    public $StainOxideNotes;
    public $FileUpload1;
    public $FileUpload2;
    public $FileUpload3;
    public $FileUpload4;
    public $FileUpload5;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-3DED9B4B
    function clstblstainoxideDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblstainoxide/Error";
        $this->Initialize();
        $this->StainOxideCode = new clsField("StainOxideCode", ccsText, "");
        
        $this->StainOxideDescription = new clsField("StainOxideDescription", ccsText, "");
        
        $this->StainOxideDate = new clsField("StainOxideDate", ccsDate, $this->DateFormat);
        
        $this->StainOxideNotes = new clsField("StainOxideNotes", ccsMemo, "");
        
        $this->FileUpload1 = new clsField("FileUpload1", ccsText, "");
        
        $this->FileUpload2 = new clsField("FileUpload2", ccsText, "");
        
        $this->FileUpload3 = new clsField("FileUpload3", ccsText, "");
        
        $this->FileUpload4 = new clsField("FileUpload4", ccsText, "");
        
        $this->FileUpload5 = new clsField("FileUpload5", ccsText, "");
        

        $this->UpdateFields["StainOxideDate"] = array("Name" => "StainOxideDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["StainOxideNotes"] = array("Name" => "StainOxideNotes", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["StainOxideTechDraw"] = array("Name" => "StainOxideTechDraw", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["StainOxidePhoto1"] = array("Name" => "StainOxidePhoto1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["StainOxidePhoto2"] = array("Name" => "StainOxidePhoto2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["StainOxidePhoto3"] = array("Name" => "StainOxidePhoto3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["StainOxidePhoto4"] = array("Name" => "StainOxidePhoto4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @2-766ABE51
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblstainoxide {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-55994E24
    function SetValues()
    {
        $this->StainOxideCode->SetDBValue($this->f("StainOxideCode"));
        $this->StainOxideDescription->SetDBValue($this->f("StainOxideDescription"));
        $this->StainOxideDate->SetDBValue(trim($this->f("StainOxideDate")));
        $this->StainOxideNotes->SetDBValue($this->f("StainOxideNotes"));
        $this->FileUpload1->SetDBValue($this->f("StainOxideTechDraw"));
        $this->FileUpload2->SetDBValue($this->f("StainOxidePhoto1"));
        $this->FileUpload3->SetDBValue($this->f("StainOxidePhoto2"));
        $this->FileUpload4->SetDBValue($this->f("StainOxidePhoto3"));
        $this->FileUpload5->SetDBValue($this->f("StainOxidePhoto4"));
    }
//End SetValues Method

//Update Method @2-F7457234
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["StainOxideDate"]["Value"] = $this->StainOxideDate->GetDBValue(true);
        $this->UpdateFields["StainOxideNotes"]["Value"] = $this->StainOxideNotes->GetDBValue(true);
        $this->UpdateFields["StainOxideTechDraw"]["Value"] = $this->FileUpload1->GetDBValue(true);
        $this->UpdateFields["StainOxidePhoto1"]["Value"] = $this->FileUpload2->GetDBValue(true);
        $this->UpdateFields["StainOxidePhoto2"]["Value"] = $this->FileUpload3->GetDBValue(true);
        $this->UpdateFields["StainOxidePhoto3"]["Value"] = $this->FileUpload4->GetDBValue(true);
        $this->UpdateFields["StainOxidePhoto4"]["Value"] = $this->FileUpload5->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblstainoxide", $this->UpdateFields, $this);
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

//Delete Method @2-9E06414D
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tblstainoxide";
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

} //End tblstainoxideDataSource Class @2-FCB6E20C

//Initialize Page @1-37A494F7
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
$TemplateFileName = "EditStainOxide.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1864F441
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblstainoxide = new clsRecordtblstainoxide("", $MainPage);
$MainPage->tblstainoxide = & $tblstainoxide;
$tblstainoxide->Initialize();

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

//Execute Components @1-D2078264
$tblstainoxide->Operation();
//End Execute Components

//Go to destination page @1-AD4AF866
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblstainoxide);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-30249458
$tblstainoxide->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-EA58F007
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblstainoxide);
unset($Tpl);
//End Unload Page


?>
