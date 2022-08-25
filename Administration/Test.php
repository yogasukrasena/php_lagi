<?php
//Include Common Files @1-F8D864CC
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "Test.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtbladminist_box_h { //tbladminist_box_h Class @2-60EEEAB9

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

//Class_Initialize Event @2-182AE10F
    function clsRecordtbladminist_box_h($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tbladminist_box_h/Error";
        $this->DataSource = new clstbladminist_box_hDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tbladminist_box_h";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->BoxNumber = new clsControl(ccsTextBox, "BoxNumber", "Box Number", ccsText, "", CCGetRequestParam("BoxNumber", $Method, NULL), $this);
            $this->BoxNumber->Required = true;
            $this->PL_H_ID = new clsControl(ccsTextBox, "PL_H_ID", "PL H ID", ccsInteger, "", CCGetRequestParam("PL_H_ID", $Method, NULL), $this);
            $this->PL_H_ID->Required = true;
            $this->Length = new clsControl(ccsTextBox, "Length", "Length", ccsFloat, "", CCGetRequestParam("Length", $Method, NULL), $this);
            $this->Width = new clsControl(ccsTextBox, "Width", "Width", ccsFloat, "", CCGetRequestParam("Width", $Method, NULL), $this);
            $this->Height = new clsControl(ccsTextBox, "Height", "Height", ccsFloat, "", CCGetRequestParam("Height", $Method, NULL), $this);
            $this->TextBox1 = new clsControl(ccsTextBox, "TextBox1", "TextBox1", ccsText, "", CCGetRequestParam("TextBox1", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-D8BB1A01
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlBox_H_ID"] = CCGetFromGet("Box_H_ID", NULL);
    }
//End Initialize Method

//Validate Method @2-7DD2E7AF
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->BoxNumber->Validate() && $Validation);
        $Validation = ($this->PL_H_ID->Validate() && $Validation);
        $Validation = ($this->Length->Validate() && $Validation);
        $Validation = ($this->Width->Validate() && $Validation);
        $Validation = ($this->Height->Validate() && $Validation);
        $Validation = ($this->TextBox1->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->BoxNumber->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PL_H_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Length->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Width->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Height->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox1->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-0A135582
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->BoxNumber->Errors->Count());
        $errors = ($errors || $this->PL_H_ID->Errors->Count());
        $errors = ($errors || $this->Length->Errors->Count());
        $errors = ($errors || $this->Width->Errors->Count());
        $errors = ($errors || $this->Height->Errors->Count());
        $errors = ($errors || $this->TextBox1->Errors->Count());
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

//Operation Method @2-B908BA44
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
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

//InsertRow Method @2-ADC9C882
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->BoxNumber->SetValue($this->BoxNumber->GetValue(true));
        $this->DataSource->PL_H_ID->SetValue($this->PL_H_ID->GetValue(true));
        $this->DataSource->Length->SetValue($this->Length->GetValue(true));
        $this->DataSource->Width->SetValue($this->Width->GetValue(true));
        $this->DataSource->Height->SetValue($this->Height->GetValue(true));
        $this->DataSource->TextBox1->SetValue($this->TextBox1->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-598B4CFA
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->BoxNumber->SetValue($this->BoxNumber->GetValue(true));
        $this->DataSource->PL_H_ID->SetValue($this->PL_H_ID->GetValue(true));
        $this->DataSource->Length->SetValue($this->Length->GetValue(true));
        $this->DataSource->Width->SetValue($this->Width->GetValue(true));
        $this->DataSource->Height->SetValue($this->Height->GetValue(true));
        $this->DataSource->TextBox1->SetValue($this->TextBox1->GetValue(true));
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

//Show Method @2-F2D1ED7E
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
                    $this->BoxNumber->SetValue($this->DataSource->BoxNumber->GetValue());
                    $this->PL_H_ID->SetValue($this->DataSource->PL_H_ID->GetValue());
                    $this->Length->SetValue($this->DataSource->Length->GetValue());
                    $this->Width->SetValue($this->DataSource->Width->GetValue());
                    $this->Height->SetValue($this->DataSource->Height->GetValue());
                    $this->TextBox1->SetValue($this->DataSource->TextBox1->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->BoxNumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PL_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Length->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Width->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Height->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox1->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->BoxNumber->Show();
        $this->PL_H_ID->Show();
        $this->Length->Show();
        $this->Width->Show();
        $this->Height->Show();
        $this->TextBox1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tbladminist_box_h Class @2-FCB6E20C

class clstbladminist_box_hDataSource extends clsDBGayaFusionAll {  //tbladminist_box_hDataSource Class @2-FA82B772

//DataSource Variables @2-F4E12834
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $BoxNumber;
    public $PL_H_ID;
    public $Length;
    public $Width;
    public $Height;
    public $TextBox1;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-FDF1C027
    function clstbladminist_box_hDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tbladminist_box_h/Error";
        $this->Initialize();
        $this->BoxNumber = new clsField("BoxNumber", ccsText, "");
        
        $this->PL_H_ID = new clsField("PL_H_ID", ccsInteger, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->TextBox1 = new clsField("TextBox1", ccsText, "");
        

        $this->InsertFields["BoxNumber"] = array("Name" => "BoxNumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["PL_H_ID"] = array("Name" => "PL_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Length"] = array("Name" => "Length", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Width"] = array("Name" => "Width", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Height"] = array("Name" => "Height", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Weight"] = array("Name" => "Weight", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["BoxNumber"] = array("Name" => "BoxNumber", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["PL_H_ID"] = array("Name" => "PL_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Length"] = array("Name" => "Length", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Width"] = array("Name" => "Width", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Height"] = array("Name" => "Height", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Weight"] = array("Name" => "Weight", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-DE88D80C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlBox_H_ID", ccsInteger, "", "", $this->Parameters["urlBox_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Box_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-8DB0E5CB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_box_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-1071002A
    function SetValues()
    {
        $this->BoxNumber->SetDBValue($this->f("BoxNumber"));
        $this->PL_H_ID->SetDBValue(trim($this->f("PL_H_ID")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->TextBox1->SetDBValue($this->f("Weight"));
    }
//End SetValues Method

//Insert Method @2-F1D073B7
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["BoxNumber"]["Value"] = $this->BoxNumber->GetDBValue(true);
        $this->InsertFields["PL_H_ID"]["Value"] = $this->PL_H_ID->GetDBValue(true);
        $this->InsertFields["Length"]["Value"] = $this->Length->GetDBValue(true);
        $this->InsertFields["Width"]["Value"] = $this->Width->GetDBValue(true);
        $this->InsertFields["Height"]["Value"] = $this->Height->GetDBValue(true);
        $this->InsertFields["Weight"]["Value"] = $this->TextBox1->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_box_h", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-A7054208
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["BoxNumber"]["Value"] = $this->BoxNumber->GetDBValue(true);
        $this->UpdateFields["PL_H_ID"]["Value"] = $this->PL_H_ID->GetDBValue(true);
        $this->UpdateFields["Length"]["Value"] = $this->Length->GetDBValue(true);
        $this->UpdateFields["Width"]["Value"] = $this->Width->GetDBValue(true);
        $this->UpdateFields["Height"]["Value"] = $this->Height->GetDBValue(true);
        $this->UpdateFields["Weight"]["Value"] = $this->TextBox1->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_box_h", $this->UpdateFields, $this);
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

//Delete Method @2-F369FBC3
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tbladminist_box_h";
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

} //End tbladminist_box_hDataSource Class @2-FCB6E20C

//Initialize Page @1-EFCE628C
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
$TemplateFileName = "Test.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-833855A9
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tbladminist_box_h = new clsRecordtbladminist_box_h("", $MainPage);
$MainPage->tbladminist_box_h = & $tbladminist_box_h;
$tbladminist_box_h->Initialize();

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

//Execute Components @1-F94CA861
$tbladminist_box_h->Operation();
//End Execute Components

//Go to destination page @1-3A2F1FEA
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tbladminist_box_h);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-FC56CBD9
$tbladminist_box_h->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F839AE5D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tbladminist_box_h);
unset($Tpl);
//End Unload Page


?>
