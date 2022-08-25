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
//Include Common Files @1-0ADD50B8
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowDesignMat.php");
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

//Class_Initialize Event @2-8F451F44
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
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->DesignMatCode = new clsControl(ccsLabel, "DesignMatCode", "Design Mat Code", ccsText, "", CCGetRequestParam("DesignMatCode", $Method, NULL), $this);
            $this->DesignMatDescription = new clsControl(ccsLabel, "DesignMatDescription", "Design Mat Description", ccsText, "", CCGetRequestParam("DesignMatDescription", $Method, NULL), $this);
            $this->DesignMatTechDraw = new clsControl(ccsImage, "DesignMatTechDraw", "Design Mat Tech Draw", ccsText, "", CCGetRequestParam("DesignMatTechDraw", $Method, NULL), $this);
            $this->DesignMatPhoto1 = new clsControl(ccsImage, "DesignMatPhoto1", "Design Mat Photo1", ccsText, "", CCGetRequestParam("DesignMatPhoto1", $Method, NULL), $this);
            $this->DesignMatPhoto2 = new clsControl(ccsImage, "DesignMatPhoto2", "Design Mat Photo2", ccsText, "", CCGetRequestParam("DesignMatPhoto2", $Method, NULL), $this);
            $this->DesignMatPhoto3 = new clsControl(ccsImage, "DesignMatPhoto3", "Design Mat Photo3", ccsText, "", CCGetRequestParam("DesignMatPhoto3", $Method, NULL), $this);
            $this->DesignMatPhoto4 = new clsControl(ccsImage, "DesignMatPhoto4", "Design Mat Photo4", ccsText, "", CCGetRequestParam("DesignMatPhoto4", $Method, NULL), $this);
            $this->SupCompany = new clsControl(ccsLabel, "SupCompany", "Design Mat Supplier", ccsText, "", CCGetRequestParam("SupCompany", $Method, NULL), $this);
            $this->UnitValue = new clsControl(ccsLabel, "UnitValue", "Design Mat Unit", ccsText, "", CCGetRequestParam("UnitValue", $Method, NULL), $this);
            $this->DesignMatUnitPrice = new clsControl(ccsLabel, "DesignMatUnitPrice", "Design Mat Unit Price", ccsFloat, "", CCGetRequestParam("DesignMatUnitPrice", $Method, NULL), $this);
            $this->DesignMatNotes = new clsControl(ccsLabel, "DesignMatNotes", "Design Mat Notes", ccsMemo, "", CCGetRequestParam("DesignMatNotes", $Method, NULL), $this);
            $this->SupContact = new clsControl(ccsLabel, "SupContact", "SupContact", ccsText, "", CCGetRequestParam("SupContact", $Method, NULL), $this);
            $this->SupAddress = new clsControl(ccsTextArea, "SupAddress", "SupAddress", ccsText, "", CCGetRequestParam("SupAddress", $Method, NULL), $this);
            $this->SupHP = new clsControl(ccsLabel, "SupHP", "SupHP", ccsText, "", CCGetRequestParam("SupHP", $Method, NULL), $this);
            $this->SupFax = new clsControl(ccsLabel, "SupFax", "SupFax", ccsText, "", CCGetRequestParam("SupFax", $Method, NULL), $this);
            $this->SupEmail = new clsControl(ccsLabel, "SupEmail", "SupEmail", ccsText, "", CCGetRequestParam("SupEmail", $Method, NULL), $this);
            $this->SupOtherInfo = new clsControl(ccsLabel, "SupOtherInfo", "SupOtherInfo", ccsText, "", CCGetRequestParam("SupOtherInfo", $Method, NULL), $this);
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

//Validate Method @2-541287D9
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->SupAddress->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->SupAddress->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-673440FD
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->DesignMatCode->Errors->Count());
        $errors = ($errors || $this->DesignMatDescription->Errors->Count());
        $errors = ($errors || $this->DesignMatTechDraw->Errors->Count());
        $errors = ($errors || $this->DesignMatPhoto1->Errors->Count());
        $errors = ($errors || $this->DesignMatPhoto2->Errors->Count());
        $errors = ($errors || $this->DesignMatPhoto3->Errors->Count());
        $errors = ($errors || $this->DesignMatPhoto4->Errors->Count());
        $errors = ($errors || $this->SupCompany->Errors->Count());
        $errors = ($errors || $this->UnitValue->Errors->Count());
        $errors = ($errors || $this->DesignMatUnitPrice->Errors->Count());
        $errors = ($errors || $this->DesignMatNotes->Errors->Count());
        $errors = ($errors || $this->SupContact->Errors->Count());
        $errors = ($errors || $this->SupAddress->Errors->Count());
        $errors = ($errors || $this->SupHP->Errors->Count());
        $errors = ($errors || $this->SupFax->Errors->Count());
        $errors = ($errors || $this->SupEmail->Errors->Count());
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

//Operation Method @2-17DC9883
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

//Show Method @2-83C655DE
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
                $this->DesignMatTechDraw->SetValue($this->DataSource->DesignMatTechDraw->GetValue());
                $this->DesignMatPhoto1->SetValue($this->DataSource->DesignMatPhoto1->GetValue());
                $this->DesignMatPhoto2->SetValue($this->DataSource->DesignMatPhoto2->GetValue());
                $this->DesignMatPhoto3->SetValue($this->DataSource->DesignMatPhoto3->GetValue());
                $this->DesignMatPhoto4->SetValue($this->DataSource->DesignMatPhoto4->GetValue());
                $this->SupCompany->SetValue($this->DataSource->SupCompany->GetValue());
                $this->UnitValue->SetValue($this->DataSource->UnitValue->GetValue());
                $this->DesignMatUnitPrice->SetValue($this->DataSource->DesignMatUnitPrice->GetValue());
                $this->DesignMatNotes->SetValue($this->DataSource->DesignMatNotes->GetValue());
                $this->SupContact->SetValue($this->DataSource->SupContact->GetValue());
                $this->SupHP->SetValue($this->DataSource->SupHP->GetValue());
                $this->SupFax->SetValue($this->DataSource->SupFax->GetValue());
                $this->SupEmail->SetValue($this->DataSource->SupEmail->GetValue());
                $this->SupOtherInfo->SetValue($this->DataSource->SupOtherInfo->GetValue());
                if(!$this->FormSubmitted){
                    $this->SupAddress->SetValue($this->DataSource->SupAddress->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->DesignMatCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatTechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatPhoto1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatPhoto2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatPhoto3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatPhoto4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupCompany->Errors->ToString());
            $Error = ComposeStrings($Error, $this->UnitValue->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnitPrice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatNotes->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupAddress->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupHP->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupFax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupEmail->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->DesignMatCode->Show();
        $this->DesignMatDescription->Show();
        $this->DesignMatTechDraw->Show();
        $this->DesignMatPhoto1->Show();
        $this->DesignMatPhoto2->Show();
        $this->DesignMatPhoto3->Show();
        $this->DesignMatPhoto4->Show();
        $this->SupCompany->Show();
        $this->UnitValue->Show();
        $this->DesignMatUnitPrice->Show();
        $this->DesignMatNotes->Show();
        $this->SupContact->Show();
        $this->SupAddress->Show();
        $this->SupHP->Show();
        $this->SupFax->Show();
        $this->SupEmail->Show();
        $this->SupOtherInfo->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tbldesignmat Class @2-FCB6E20C

class clstbldesignmatDataSource extends clsDBGayaFusionAll {  //tbldesignmatDataSource Class @2-AC733C40

//DataSource Variables @2-E076D772
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $DesignMatCode;
    public $DesignMatDescription;
    public $DesignMatTechDraw;
    public $DesignMatPhoto1;
    public $DesignMatPhoto2;
    public $DesignMatPhoto3;
    public $DesignMatPhoto4;
    public $SupCompany;
    public $UnitValue;
    public $DesignMatUnitPrice;
    public $DesignMatNotes;
    public $SupContact;
    public $SupAddress;
    public $SupHP;
    public $SupFax;
    public $SupEmail;
    public $SupOtherInfo;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-BFC303B6
    function clstbldesignmatDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tbldesignmat/Error";
        $this->Initialize();
        $this->DesignMatCode = new clsField("DesignMatCode", ccsText, "");
        
        $this->DesignMatDescription = new clsField("DesignMatDescription", ccsText, "");
        
        $this->DesignMatTechDraw = new clsField("DesignMatTechDraw", ccsText, "");
        
        $this->DesignMatPhoto1 = new clsField("DesignMatPhoto1", ccsText, "");
        
        $this->DesignMatPhoto2 = new clsField("DesignMatPhoto2", ccsText, "");
        
        $this->DesignMatPhoto3 = new clsField("DesignMatPhoto3", ccsText, "");
        
        $this->DesignMatPhoto4 = new clsField("DesignMatPhoto4", ccsText, "");
        
        $this->SupCompany = new clsField("SupCompany", ccsText, "");
        
        $this->UnitValue = new clsField("UnitValue", ccsText, "");
        
        $this->DesignMatUnitPrice = new clsField("DesignMatUnitPrice", ccsFloat, "");
        
        $this->DesignMatNotes = new clsField("DesignMatNotes", ccsMemo, "");
        
        $this->SupContact = new clsField("SupContact", ccsText, "");
        
        $this->SupAddress = new clsField("SupAddress", ccsText, "");
        
        $this->SupHP = new clsField("SupHP", ccsText, "");
        
        $this->SupFax = new clsField("SupFax", ccsText, "");
        
        $this->SupEmail = new clsField("SupEmail", ccsText, "");
        
        $this->SupOtherInfo = new clsField("SupOtherInfo", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-1B65FE1C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlDesignMatID", ccsInteger, "", "", $this->Parameters["urlDesignMatID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbldesignmat.DesignMatID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-2EC12B76
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT tbldesignmat.*, SupCompany, SupContact, SupAddress, SupHP, SupFax, SupEmail, SupOtherInfo, UnitValue \n\n" .
        "FROM (tbldesignmat LEFT JOIN tblsupplier ON\n\n" .
        "tbldesignmat.DesignMatSupplier = tblsupplier.ID) LEFT JOIN tblunit ON\n\n" .
        "tbldesignmat.DesignMatUnit = tblunit.UnitID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-02EE4A5B
    function SetValues()
    {
        $this->DesignMatCode->SetDBValue($this->f("DesignMatCode"));
        $this->DesignMatDescription->SetDBValue($this->f("DesignMatDescription"));
        $this->DesignMatTechDraw->SetDBValue($this->f("DesignMatTechDraw"));
        $this->DesignMatPhoto1->SetDBValue($this->f("DesignMatPhoto1"));
        $this->DesignMatPhoto2->SetDBValue($this->f("DesignMatPhoto2"));
        $this->DesignMatPhoto3->SetDBValue($this->f("DesignMatPhoto3"));
        $this->DesignMatPhoto4->SetDBValue($this->f("DesignMatPhoto4"));
        $this->SupCompany->SetDBValue($this->f("SupCompany"));
        $this->UnitValue->SetDBValue($this->f("UnitValue"));
        $this->DesignMatUnitPrice->SetDBValue(trim($this->f("DesignMatUnitPrice")));
        $this->DesignMatNotes->SetDBValue($this->f("DesignMatNotes"));
        $this->SupContact->SetDBValue($this->f("SupContact"));
        $this->SupAddress->SetDBValue($this->f("SupAddress"));
        $this->SupHP->SetDBValue($this->f("SupHP"));
        $this->SupFax->SetDBValue($this->f("SupFax"));
        $this->SupEmail->SetDBValue($this->f("SupEmail"));
        $this->SupOtherInfo->SetDBValue($this->f("SupOtherInfo"));
    }
//End SetValues Method

} //End tbldesignmatDataSource Class @2-FCB6E20C

//Initialize Page @1-10136474
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
$TemplateFileName = "ShowDesignMat.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-3E7B32FB
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tbldesignmat = new clsRecordtbldesignmat("", $MainPage);
$MainPage->tbldesignmat = & $tbldesignmat;
$tbldesignmat->Initialize();

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

//Show Page @1-E18C39AE
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
