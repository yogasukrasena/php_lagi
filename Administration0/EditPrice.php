<?php
//Include Common Files @1-E1AB7EF7
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "EditPrice.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblcollect_master { //tblcollect_master Class @2-F9645367

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

//Class_Initialize Event @2-3092498E
    function clsRecordtblcollect_master($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblcollect_master/Error";
        $this->DataSource = new clstblcollect_masterDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblcollect_master";
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
            $this->RealSellingPrice = new clsControl(ccsTextBox, "RealSellingPrice", "Real Selling Price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("RealSellingPrice", $Method, NULL), $this);
            $this->LastUpdate = new clsControl(ccsHidden, "LastUpdate", "Last Update", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("LastUpdate", $Method, NULL), $this);
            $this->DollarPrice = new clsControl(ccsTextBox, "DollarPrice", "DollarPrice", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("DollarPrice", $Method, NULL), $this);
            $this->EuroPrice = new clsControl(ccsTextBox, "EuroPrice", "EuroPrice", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("EuroPrice", $Method, NULL), $this);
            $this->ID = new clsControl(ccsHidden, "ID", "ID", ccsInteger, "", CCGetRequestParam("ID", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->LastUpdate->Value) && !strlen($this->LastUpdate->Value) && $this->LastUpdate->Value !== false)
                    $this->LastUpdate->SetValue(time());
            }
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

//Validate Method @2-C931B1AC
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->RealSellingPrice->Validate() && $Validation);
        $Validation = ($this->LastUpdate->Validate() && $Validation);
        $Validation = ($this->DollarPrice->Validate() && $Validation);
        $Validation = ($this->EuroPrice->Validate() && $Validation);
        $Validation = ($this->ID->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->RealSellingPrice->Errors->Count() == 0);
        $Validation =  $Validation && ($this->LastUpdate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DollarPrice->Errors->Count() == 0);
        $Validation =  $Validation && ($this->EuroPrice->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ID->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-F2E9718B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->RealSellingPrice->Errors->Count());
        $errors = ($errors || $this->LastUpdate->Errors->Count());
        $errors = ($errors || $this->DollarPrice->Errors->Count());
        $errors = ($errors || $this->EuroPrice->Errors->Count());
        $errors = ($errors || $this->ID->Errors->Count());
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

//Operation Method @2-11D1C1C7
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
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = "PriceList.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//UpdateRow Method @2-A1C5871B
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->RealSellingPrice->SetValue($this->RealSellingPrice->GetValue(true));
        $this->DataSource->LastUpdate->SetValue($this->LastUpdate->GetValue(true));
        $this->DataSource->DollarPrice->SetValue($this->DollarPrice->GetValue(true));
        $this->DataSource->EuroPrice->SetValue($this->EuroPrice->GetValue(true));
        $this->DataSource->ID->SetValue($this->ID->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-6104CCBF
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
                    $this->RealSellingPrice->SetValue($this->DataSource->RealSellingPrice->GetValue());
                    $this->DollarPrice->SetValue($this->DataSource->DollarPrice->GetValue());
                    $this->EuroPrice->SetValue($this->DataSource->EuroPrice->GetValue());
                    $this->ID->SetValue($this->DataSource->ID->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->RealSellingPrice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LastUpdate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DollarPrice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EuroPrice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ID->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->RealSellingPrice->Show();
        $this->LastUpdate->Show();
        $this->DollarPrice->Show();
        $this->EuroPrice->Show();
        $this->ID->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblcollect_master Class @2-FCB6E20C

class clstblcollect_masterDataSource extends clsDBGayaFusionAll {  //tblcollect_masterDataSource Class @2-9A78A277

//DataSource Variables @2-EEF3A601
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $UpdateFields = array();

    // Datasource fields
    public $RealSellingPrice;
    public $LastUpdate;
    public $DollarPrice;
    public $EuroPrice;
    public $ID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-3F4D6C9D
    function clstblcollect_masterDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblcollect_master/Error";
        $this->Initialize();
        $this->RealSellingPrice = new clsField("RealSellingPrice", ccsFloat, "");
        
        $this->LastUpdate = new clsField("LastUpdate", ccsDate, $this->DateFormat);
        
        $this->DollarPrice = new clsField("DollarPrice", ccsFloat, "");
        
        $this->EuroPrice = new clsField("EuroPrice", ccsFloat, "");
        
        $this->ID = new clsField("ID", ccsInteger, "");
        

        $this->UpdateFields["RealSellingPrice"] = array("Name" => "RealSellingPrice", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["PriceDollar"] = array("Name" => "PriceDollar", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["PriceEuro"] = array("Name" => "PriceEuro", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["ID"] = array("Name" => "ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
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

//Open Method @2-3D3E4B61
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT ID, RealSellingPrice, PriceDollar, PriceEuro \n\n" .
        "FROM tblcollect_master {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-2F02B453
    function SetValues()
    {
        $this->RealSellingPrice->SetDBValue(trim($this->f("RealSellingPrice")));
        $this->DollarPrice->SetDBValue(trim($this->f("PriceDollar")));
        $this->EuroPrice->SetDBValue(trim($this->f("PriceEuro")));
        $this->ID->SetDBValue(trim($this->f("ID")));
    }
//End SetValues Method

//Update Method @2-558E9382
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["RealSellingPrice"]["Value"] = $this->RealSellingPrice->GetDBValue(true);
        $this->UpdateFields["PriceDollar"]["Value"] = $this->DollarPrice->GetDBValue(true);
        $this->UpdateFields["PriceEuro"]["Value"] = $this->EuroPrice->GetDBValue(true);
        $this->UpdateFields["ID"]["Value"] = $this->ID->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblcollect_master", $this->UpdateFields, $this);
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

} //End tblcollect_masterDataSource Class @2-FCB6E20C

//Initialize Page @1-2AC3C8B6
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
$TemplateFileName = "EditPrice.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-8C69CBD6
include_once("./EditPrice_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-091A0EDC
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblcollect_master = new clsRecordtblcollect_master("", $MainPage);
$MainPage->tblcollect_master = & $tblcollect_master;
$tblcollect_master->Initialize();

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

//Execute Components @1-EBFD1BFA
$tblcollect_master->Operation();
//End Execute Components

//Go to destination page @1-A085D54F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblcollect_master);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-29CAD458
$tblcollect_master->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-EA881DC6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblcollect_master);
unset($Tpl);
//End Unload Page


?>
