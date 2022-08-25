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

//Include Common Files @1-EDBF888F
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "EditCollectGroup.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordEditCollectGroup { //EditCollectGroup Class @3-B159698E

//Variables @3-9E315808

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

//Class_Initialize Event @3-1E5E4A95
    function clsRecordEditCollectGroup($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record EditCollectGroup/Error";
        $this->DataSource = new clsEditCollectGroupDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "EditCollectGroup";
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
            $this->GroupDate = new clsControl(ccsTextBox, "GroupDate", "Group Date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("GroupDate", $Method, NULL), $this);
            $this->GroupDate->Required = true;
            $this->DatePicker_GroupDate = new clsDatePicker("DatePicker_GroupDate", "EditCollectGroup", "GroupDate", $this);
            $this->ClientCode = new clsControl(ccsTextBox, "ClientCode", "Client Code", ccsText, "", CCGetRequestParam("ClientCode", $Method, NULL), $this);
            $this->ClientDesc = new clsControl(ccsTextBox, "ClientDesc", "Client Desc", ccsText, "", CCGetRequestParam("ClientDesc", $Method, NULL), $this);
            $this->Diameter = new clsControl(ccsTextBox, "Diameter", "Diameter", ccsFloat, "", CCGetRequestParam("Diameter", $Method, NULL), $this);
            $this->Height = new clsControl(ccsTextBox, "Height", "Height", ccsFloat, "", CCGetRequestParam("Height", $Method, NULL), $this);
            $this->Weight = new clsControl(ccsTextBox, "Weight", "Weight", ccsFloat, "", CCGetRequestParam("Weight", $Method, NULL), $this);
            $this->Length = new clsControl(ccsTextBox, "Length", "Length", ccsFloat, "", CCGetRequestParam("Length", $Method, NULL), $this);
            $this->GroupPhoto = new clsFileUpload("GroupPhoto", "GroupPhoto", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->Delete = new clsButton("Delete", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @3-6AF05085
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlGroup_H_ID"] = CCGetFromGet("Group_H_ID", NULL);
    }
//End Initialize Method

//Validate Method @3-E6823755
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->GroupDate->Validate() && $Validation);
        $Validation = ($this->ClientCode->Validate() && $Validation);
        $Validation = ($this->ClientDesc->Validate() && $Validation);
        $Validation = ($this->Diameter->Validate() && $Validation);
        $Validation = ($this->Height->Validate() && $Validation);
        $Validation = ($this->Weight->Validate() && $Validation);
        $Validation = ($this->Length->Validate() && $Validation);
        $Validation = ($this->GroupPhoto->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->GroupDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClientCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClientDesc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Diameter->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Height->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Weight->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Length->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GroupPhoto->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-09B5CBC1
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->GroupDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_GroupDate->Errors->Count());
        $errors = ($errors || $this->ClientCode->Errors->Count());
        $errors = ($errors || $this->ClientDesc->Errors->Count());
        $errors = ($errors || $this->Diameter->Errors->Count());
        $errors = ($errors || $this->Height->Errors->Count());
        $errors = ($errors || $this->Weight->Errors->Count());
        $errors = ($errors || $this->Length->Errors->Count());
        $errors = ($errors || $this->GroupPhoto->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
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

//Operation Method @3-43454841
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

        $this->GroupPhoto->Upload();

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Delete->Pressed) {
                $this->PressedButton = "Delete";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = "CollectionGroup.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "Group_H_ID", "IsParamsEncoded", "FormFilter"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Delete") {
                $Redirect = "CollectionGroup.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "Group_H_ID", "IsParamsEncoded", "FormFilter"));
                if(!CCGetEvent($this->Delete->CCSEvents, "OnClick", $this->Delete) || !$this->DeleteRow()) {
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

//UpdateRow Method @3-2CF670F8
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->GroupDate->SetValue($this->GroupDate->GetValue(true));
        $this->DataSource->ClientCode->SetValue($this->ClientCode->GetValue(true));
        $this->DataSource->ClientDesc->SetValue($this->ClientDesc->GetValue(true));
        $this->DataSource->Diameter->SetValue($this->Diameter->GetValue(true));
        $this->DataSource->Height->SetValue($this->Height->GetValue(true));
        $this->DataSource->Weight->SetValue($this->Weight->GetValue(true));
        $this->DataSource->Length->SetValue($this->Length->GetValue(true));
        $this->DataSource->GroupPhoto->SetValue($this->GroupPhoto->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->GroupPhoto->Move();
        }
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @3-9C38EFD5
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->GroupPhoto->Delete();
        }
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @3-04E02DF6
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
                if(!$this->FormSubmitted){
                    $this->GroupDate->SetValue($this->DataSource->GroupDate->GetValue());
                    $this->ClientCode->SetValue($this->DataSource->ClientCode->GetValue());
                    $this->ClientDesc->SetValue($this->DataSource->ClientDesc->GetValue());
                    $this->Diameter->SetValue($this->DataSource->Diameter->GetValue());
                    $this->Height->SetValue($this->DataSource->Height->GetValue());
                    $this->Weight->SetValue($this->DataSource->Weight->GetValue());
                    $this->Length->SetValue($this->DataSource->Length->GetValue());
                    $this->GroupPhoto->SetValue($this->DataSource->GroupPhoto->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->GroupDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_GroupDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientDesc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Diameter->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Height->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Weight->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Length->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GroupPhoto->Errors->ToString());
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
        $this->Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->GroupDate->Show();
        $this->DatePicker_GroupDate->Show();
        $this->ClientCode->Show();
        $this->ClientDesc->Show();
        $this->Diameter->Show();
        $this->Height->Show();
        $this->Weight->Show();
        $this->Length->Show();
        $this->GroupPhoto->Show();
        $this->Delete->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End EditCollectGroup Class @3-FCB6E20C

class clsEditCollectGroupDataSource extends clsDBGayaFusionAll {  //EditCollectGroupDataSource Class @3-F515763F

//DataSource Variables @3-9D71AA2B
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
    public $GroupDate;
    public $ClientCode;
    public $ClientDesc;
    public $Diameter;
    public $Height;
    public $Weight;
    public $Length;
    public $GroupPhoto;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-4C04C9F6
    function clsEditCollectGroupDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record EditCollectGroup/Error";
        $this->Initialize();
        $this->GroupDate = new clsField("GroupDate", ccsDate, $this->DateFormat);
        
        $this->ClientCode = new clsField("ClientCode", ccsText, "");
        
        $this->ClientDesc = new clsField("ClientDesc", ccsText, "");
        
        $this->Diameter = new clsField("Diameter", ccsFloat, "");
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Weight = new clsField("Weight", ccsFloat, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->GroupPhoto = new clsField("GroupPhoto", ccsText, "");
        

        $this->UpdateFields["GroupDate"] = array("Name" => "GroupDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClientCode"] = array("Name" => "ClientCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClientDesc"] = array("Name" => "ClientDesc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Diameter"] = array("Name" => "Diameter", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Height"] = array("Name" => "Height", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Weight"] = array("Name" => "Weight", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Length"] = array("Name" => "Length", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["GroupPhoto"] = array("Name" => "GroupPhoto", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-EB4225C2
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

//Open Method @3-00083104
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

//SetValues Method @3-76114AD7
    function SetValues()
    {
        $this->GroupDate->SetDBValue(trim($this->f("GroupDate")));
        $this->ClientCode->SetDBValue($this->f("ClientCode"));
        $this->ClientDesc->SetDBValue($this->f("ClientDesc"));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Weight->SetDBValue(trim($this->f("Weight")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->GroupPhoto->SetDBValue($this->f("GroupPhoto"));
    }
//End SetValues Method

//Update Method @3-DFAC6722
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["GroupDate"]["Value"] = $this->GroupDate->GetDBValue(true);
        $this->UpdateFields["ClientCode"]["Value"] = $this->ClientCode->GetDBValue(true);
        $this->UpdateFields["ClientDesc"]["Value"] = $this->ClientDesc->GetDBValue(true);
        $this->UpdateFields["Diameter"]["Value"] = $this->Diameter->GetDBValue(true);
        $this->UpdateFields["Height"]["Value"] = $this->Height->GetDBValue(true);
        $this->UpdateFields["Weight"]["Value"] = $this->Weight->GetDBValue(true);
        $this->UpdateFields["Length"]["Value"] = $this->Length->GetDBValue(true);
        $this->UpdateFields["GroupPhoto"]["Value"] = $this->GroupPhoto->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblcollect_group_h", $this->UpdateFields, $this);
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

//Delete Method @3-F5C06F4B
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tblcollect_group_h";
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

} //End EditCollectGroupDataSource Class @3-FCB6E20C

//Initialize Page @1-407A814D
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
$TemplateFileName = "EditCollectGroup.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9C0B70BC
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel2 = new clsPanel("Panel2", $MainPage);
$EditCollectGroup = new clsRecordEditCollectGroup("", $MainPage);
$MainPage->Panel2 = & $Panel2;
$MainPage->EditCollectGroup = & $EditCollectGroup;
$Panel2->AddComponent("EditCollectGroup", $EditCollectGroup);
$EditCollectGroup->Initialize();

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

//Execute Components @1-0D288FD3
$EditCollectGroup->Operation();
//End Execute Components

//Go to destination page @1-5EECB79A
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($EditCollectGroup);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9F2A8799
$Panel2->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-7C4D6F76
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($EditCollectGroup);
unset($Tpl);
//End Unload Page


?>
