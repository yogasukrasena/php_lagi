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
//Include Common Files @1-804DD1E9
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "EditDesignMat.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtbldesignmat { //tbldesignmat Class @2-41C43A86

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

//Class_Initialize Event @2-AC904447
    function clsRecordtbldesignmat($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tbldesignmat/Error";
        $this->DataSource = new clstbldesignmatDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tbldesignmat";
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
            $this->DesignMatCode = new clsControl(ccsLabel, "DesignMatCode", "Design Mat Code", ccsText, "", CCGetRequestParam("DesignMatCode", $Method, NULL), $this);
            $this->DesignMatDescription = new clsControl(ccsLabel, "DesignMatDescription", "Design Mat Description", ccsText, "", CCGetRequestParam("DesignMatDescription", $Method, NULL), $this);
            $this->DesignMatDate = new clsControl(ccsTextBox, "DesignMatDate", "Design Mat Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("DesignMatDate", $Method, NULL), $this);
            $this->DesignMatDate->Required = true;
            $this->DatePicker_DesignMatDate = new clsDatePicker("DatePicker_DesignMatDate", "tbldesignmat", "DesignMatDate", $this);
            $this->DesignMatUnit = new clsControl(ccsTextBox, "DesignMatUnit", "Design Mat Unit", ccsText, "", CCGetRequestParam("DesignMatUnit", $Method, NULL), $this);
            $this->DesignMatUnitPrice = new clsControl(ccsTextBox, "DesignMatUnitPrice", "Design Mat Unit Price", ccsFloat, "", CCGetRequestParam("DesignMatUnitPrice", $Method, NULL), $this);
            $this->DesignMatNotes = new clsControl(ccsTextArea, "DesignMatNotes", "Design Mat Notes", ccsMemo, "", CCGetRequestParam("DesignMatNotes", $Method, NULL), $this);
            $this->FileUpload1 = new clsFileUpload("FileUpload1", "FileUpload1", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->FileUpload2 = new clsFileUpload("FileUpload2", "FileUpload2", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->FileUpload3 = new clsFileUpload("FileUpload3", "FileUpload3", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->FileUpload4 = new clsFileUpload("FileUpload4", "FileUpload4", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->FileUpload5 = new clsFileUpload("FileUpload5", "FileUpload5", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->ImageLink2 = new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", CCGetRequestParam("ImageLink2", $Method, NULL), $this);
            $this->ImageLink2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->ImageLink2->Page = "UnitPopup.php";
            $this->DesignMatSupplier = new clsControl(ccsHidden, "DesignMatSupplier", "Design Mat Supplier", ccsInteger, "", CCGetRequestParam("DesignMatSupplier", $Method, NULL), $this);
            $this->DesignMatSupDesc = new clsControl(ccsTextBox, "DesignMatSupDesc", "DesignMatSupDesc", ccsText, "", CCGetRequestParam("DesignMatSupDesc", $Method, NULL), $this);
            $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", $Method, NULL), $this);
            $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->ImageLink1->Page = "";
            $this->DelSup = new clsControl(ccsLink, "DelSup", "DelSup", ccsText, "", CCGetRequestParam("DelSup", $Method, NULL), $this);
            $this->DelSup->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelSup->Page = "#";
            $this->DelUnit = new clsControl(ccsLink, "DelUnit", "DelUnit", ccsText, "", CCGetRequestParam("DelUnit", $Method, NULL), $this);
            $this->DelUnit->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelUnit->Page = "#";
        }
    }
//End Class_Initialize Event

//Initialize Method @2-721BCFDE
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlDesignMatID"] = CCGetFromGet("DesignMatID", NULL);
    }
//End Initialize Method

//Validate Method @2-3F897493
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->DesignMatDate->Validate() && $Validation);
        $Validation = ($this->DesignMatUnit->Validate() && $Validation);
        $Validation = ($this->DesignMatUnitPrice->Validate() && $Validation);
        $Validation = ($this->DesignMatNotes->Validate() && $Validation);
        $Validation = ($this->FileUpload1->Validate() && $Validation);
        $Validation = ($this->FileUpload2->Validate() && $Validation);
        $Validation = ($this->FileUpload3->Validate() && $Validation);
        $Validation = ($this->FileUpload4->Validate() && $Validation);
        $Validation = ($this->FileUpload5->Validate() && $Validation);
        $Validation = ($this->DesignMatSupplier->Validate() && $Validation);
        $Validation = ($this->DesignMatSupDesc->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->DesignMatDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnit->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnitPrice->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatNotes->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatSupplier->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatSupDesc->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-C2C7ECE5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->DesignMatCode->Errors->Count());
        $errors = ($errors || $this->DesignMatDescription->Errors->Count());
        $errors = ($errors || $this->DesignMatDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_DesignMatDate->Errors->Count());
        $errors = ($errors || $this->DesignMatUnit->Errors->Count());
        $errors = ($errors || $this->DesignMatUnitPrice->Errors->Count());
        $errors = ($errors || $this->DesignMatNotes->Errors->Count());
        $errors = ($errors || $this->FileUpload1->Errors->Count());
        $errors = ($errors || $this->FileUpload2->Errors->Count());
        $errors = ($errors || $this->FileUpload3->Errors->Count());
        $errors = ($errors || $this->FileUpload4->Errors->Count());
        $errors = ($errors || $this->FileUpload5->Errors->Count());
        $errors = ($errors || $this->ImageLink2->Errors->Count());
        $errors = ($errors || $this->DesignMatSupplier->Errors->Count());
        $errors = ($errors || $this->DesignMatSupDesc->Errors->Count());
        $errors = ($errors || $this->ImageLink1->Errors->Count());
        $errors = ($errors || $this->DelSup->Errors->Count());
        $errors = ($errors || $this->DelUnit->Errors->Count());
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

//Operation Method @2-05E0845E
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
            $Redirect = "DesignMat.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "DesignMatID", "DesignMatCode"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = "DesignMat.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "DesignMatID", "DesignMatCode"));
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

//UpdateRow Method @2-9E7728AD
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->DesignMatCode->SetValue($this->DesignMatCode->GetValue(true));
        $this->DataSource->DesignMatDescription->SetValue($this->DesignMatDescription->GetValue(true));
        $this->DataSource->DesignMatDate->SetValue($this->DesignMatDate->GetValue(true));
        $this->DataSource->DesignMatUnit->SetValue($this->DesignMatUnit->GetValue(true));
        $this->DataSource->DesignMatUnitPrice->SetValue($this->DesignMatUnitPrice->GetValue(true));
        $this->DataSource->DesignMatNotes->SetValue($this->DesignMatNotes->GetValue(true));
        $this->DataSource->FileUpload1->SetValue($this->FileUpload1->GetValue(true));
        $this->DataSource->FileUpload2->SetValue($this->FileUpload2->GetValue(true));
        $this->DataSource->FileUpload3->SetValue($this->FileUpload3->GetValue(true));
        $this->DataSource->FileUpload4->SetValue($this->FileUpload4->GetValue(true));
        $this->DataSource->FileUpload5->SetValue($this->FileUpload5->GetValue(true));
        $this->DataSource->ImageLink2->SetValue($this->ImageLink2->GetValue(true));
        $this->DataSource->DesignMatSupplier->SetValue($this->DesignMatSupplier->GetValue(true));
        $this->DataSource->DesignMatSupDesc->SetValue($this->DesignMatSupDesc->GetValue(true));
        $this->DataSource->ImageLink1->SetValue($this->ImageLink1->GetValue(true));
        $this->DataSource->DelSup->SetValue($this->DelSup->GetValue(true));
        $this->DataSource->DelUnit->SetValue($this->DelUnit->GetValue(true));
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

//Show Method @2-4AB91E52
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
                $this->DesignMatCode->SetValue($this->DataSource->DesignMatCode->GetValue());
                $this->DesignMatDescription->SetValue($this->DataSource->DesignMatDescription->GetValue());
                if(!$this->FormSubmitted){
                    $this->DesignMatDate->SetValue($this->DataSource->DesignMatDate->GetValue());
                    $this->DesignMatUnit->SetValue($this->DataSource->DesignMatUnit->GetValue());
                    $this->DesignMatUnitPrice->SetValue($this->DataSource->DesignMatUnitPrice->GetValue());
                    $this->DesignMatNotes->SetValue($this->DataSource->DesignMatNotes->GetValue());
                    $this->FileUpload1->SetValue($this->DataSource->FileUpload1->GetValue());
                    $this->FileUpload2->SetValue($this->DataSource->FileUpload2->GetValue());
                    $this->FileUpload3->SetValue($this->DataSource->FileUpload3->GetValue());
                    $this->FileUpload4->SetValue($this->DataSource->FileUpload4->GetValue());
                    $this->FileUpload5->SetValue($this->DataSource->FileUpload5->GetValue());
                    $this->DesignMatSupplier->SetValue($this->DataSource->DesignMatSupplier->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->DesignMatCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_DesignMatDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnit->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnitPrice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatNotes->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ImageLink2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatSupplier->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatSupDesc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ImageLink1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelSup->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelUnit->Errors->ToString());
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
        $this->DesignMatCode->Show();
        $this->DesignMatDescription->Show();
        $this->DesignMatDate->Show();
        $this->DatePicker_DesignMatDate->Show();
        $this->DesignMatUnit->Show();
        $this->DesignMatUnitPrice->Show();
        $this->DesignMatNotes->Show();
        $this->FileUpload1->Show();
        $this->FileUpload2->Show();
        $this->FileUpload3->Show();
        $this->FileUpload4->Show();
        $this->FileUpload5->Show();
        $this->ImageLink2->Show();
        $this->DesignMatSupplier->Show();
        $this->DesignMatSupDesc->Show();
        $this->ImageLink1->Show();
        $this->DelSup->Show();
        $this->DelUnit->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tbldesignmat Class @2-FCB6E20C

class clstbldesignmatDataSource extends clsDBGayaFusionAll {  //tbldesignmatDataSource Class @2-AC733C40

//DataSource Variables @2-28185072
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
    public $DesignMatCode;
    public $DesignMatDescription;
    public $DesignMatDate;
    public $DesignMatUnit;
    public $DesignMatUnitPrice;
    public $DesignMatNotes;
    public $FileUpload1;
    public $FileUpload2;
    public $FileUpload3;
    public $FileUpload4;
    public $FileUpload5;
    public $ImageLink2;
    public $DesignMatSupplier;
    public $DesignMatSupDesc;
    public $ImageLink1;
    public $DelSup;
    public $DelUnit;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-7BD37968
    function clstbldesignmatDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tbldesignmat/Error";
        $this->Initialize();
        $this->DesignMatCode = new clsField("DesignMatCode", ccsText, "");
        
        $this->DesignMatDescription = new clsField("DesignMatDescription", ccsText, "");
        
        $this->DesignMatDate = new clsField("DesignMatDate", ccsDate, $this->DateFormat);
        
        $this->DesignMatUnit = new clsField("DesignMatUnit", ccsText, "");
        
        $this->DesignMatUnitPrice = new clsField("DesignMatUnitPrice", ccsFloat, "");
        
        $this->DesignMatNotes = new clsField("DesignMatNotes", ccsMemo, "");
        
        $this->FileUpload1 = new clsField("FileUpload1", ccsText, "");
        
        $this->FileUpload2 = new clsField("FileUpload2", ccsText, "");
        
        $this->FileUpload3 = new clsField("FileUpload3", ccsText, "");
        
        $this->FileUpload4 = new clsField("FileUpload4", ccsText, "");
        
        $this->FileUpload5 = new clsField("FileUpload5", ccsText, "");
        
        $this->ImageLink2 = new clsField("ImageLink2", ccsText, "");
        
        $this->DesignMatSupplier = new clsField("DesignMatSupplier", ccsInteger, "");
        
        $this->DesignMatSupDesc = new clsField("DesignMatSupDesc", ccsText, "");
        
        $this->ImageLink1 = new clsField("ImageLink1", ccsText, "");
        
        $this->DelSup = new clsField("DelSup", ccsText, "");
        
        $this->DelUnit = new clsField("DelUnit", ccsText, "");
        

        $this->UpdateFields["DesignMatDate"] = array("Name" => "DesignMatDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatUnit"] = array("Name" => "DesignMatUnit", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatUnitPrice"] = array("Name" => "DesignMatUnitPrice", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatNotes"] = array("Name" => "DesignMatNotes", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatTechDraw"] = array("Name" => "DesignMatTechDraw", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatPhoto1"] = array("Name" => "DesignMatPhoto1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatPhoto2"] = array("Name" => "DesignMatPhoto2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatPhoto3"] = array("Name" => "DesignMatPhoto3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatPhoto4"] = array("Name" => "DesignMatPhoto4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatSupplier"] = array("Name" => "DesignMatSupplier", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-42308620
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlDesignMatID", ccsInteger, "", "", $this->Parameters["urlDesignMatID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "DesignMatID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-E003B0A3
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbldesignmat {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-E372A831
    function SetValues()
    {
        $this->DesignMatCode->SetDBValue($this->f("DesignMatCode"));
        $this->DesignMatDescription->SetDBValue($this->f("DesignMatDescription"));
        $this->DesignMatDate->SetDBValue(trim($this->f("DesignMatDate")));
        $this->DesignMatUnit->SetDBValue($this->f("DesignMatUnit"));
        $this->DesignMatUnitPrice->SetDBValue(trim($this->f("DesignMatUnitPrice")));
        $this->DesignMatNotes->SetDBValue($this->f("DesignMatNotes"));
        $this->FileUpload1->SetDBValue($this->f("DesignMatTechDraw"));
        $this->FileUpload2->SetDBValue($this->f("DesignMatPhoto1"));
        $this->FileUpload3->SetDBValue($this->f("DesignMatPhoto2"));
        $this->FileUpload4->SetDBValue($this->f("DesignMatPhoto3"));
        $this->FileUpload5->SetDBValue($this->f("DesignMatPhoto4"));
        $this->DesignMatSupplier->SetDBValue(trim($this->f("DesignMatSupplier")));
    }
//End SetValues Method

//Update Method @2-02109CFF
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["DesignMatDate"]["Value"] = $this->DesignMatDate->GetDBValue(true);
        $this->UpdateFields["DesignMatUnit"]["Value"] = $this->DesignMatUnit->GetDBValue(true);
        $this->UpdateFields["DesignMatUnitPrice"]["Value"] = $this->DesignMatUnitPrice->GetDBValue(true);
        $this->UpdateFields["DesignMatNotes"]["Value"] = $this->DesignMatNotes->GetDBValue(true);
        $this->UpdateFields["DesignMatTechDraw"]["Value"] = $this->FileUpload1->GetDBValue(true);
        $this->UpdateFields["DesignMatPhoto1"]["Value"] = $this->FileUpload2->GetDBValue(true);
        $this->UpdateFields["DesignMatPhoto2"]["Value"] = $this->FileUpload3->GetDBValue(true);
        $this->UpdateFields["DesignMatPhoto3"]["Value"] = $this->FileUpload4->GetDBValue(true);
        $this->UpdateFields["DesignMatPhoto4"]["Value"] = $this->FileUpload5->GetDBValue(true);
        $this->UpdateFields["DesignMatSupplier"]["Value"] = $this->DesignMatSupplier->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbldesignmat", $this->UpdateFields, $this);
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

//Delete Method @2-B8430B11
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tbldesignmat";
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

} //End tbldesignmatDataSource Class @2-FCB6E20C

//Initialize Page @1-B69D36C6
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
$TemplateFileName = "EditDesignMat.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C037EB7C
include_once("./EditDesignMat_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-744E6E52
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tbldesignmat = new clsRecordtbldesignmat("", $MainPage);
$MainPage->tbldesignmat = & $tbldesignmat;
$tbldesignmat->Initialize();

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

//Execute Components @1-216317D8
$tbldesignmat->Operation();
//End Execute Components

//Go to destination page @1-12F11059
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tbldesignmat);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-4AFF0A1C
$tbldesignmat->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-79C16A9E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tbldesignmat);
unset($Tpl);
//End Unload Page


?>
