<?php
//Include Common Files @1-61A415D1
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "InvoiceTotal.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordTotalan { //Totalan Class @2-BADF67E3

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

//Class_Initialize Event @2-546D334C
    function clsRecordTotalan($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Totalan/Error";
        $this->DataSource = new clsTotalanDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Totalan";
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
            $this->SubTotal = new clsControl(ccsTextBox, "SubTotal", "Sub Total", ccsFloat, "", CCGetRequestParam("SubTotal", $Method, NULL), $this);
            $this->SubTotal->Required = true;
            $this->Discount = new clsControl(ccsTextBox, "Discount", "Discount", ccsFloat, "", CCGetRequestParam("Discount", $Method, NULL), $this);
            $this->Discount->Required = true;
            $this->Packaging = new clsControl(ccsTextBox, "Packaging", "Packaging", ccsFloat, "", CCGetRequestParam("Packaging", $Method, NULL), $this);
            $this->Packaging->Required = true;
            $this->Fumigation = new clsControl(ccsTextBox, "Fumigation", "Fumigation", ccsFloat, "", CCGetRequestParam("Fumigation", $Method, NULL), $this);
            $this->Fumigation->Required = true;
            $this->GrandTotal = new clsControl(ccsTextBox, "GrandTotal", "Grand Total", ccsFloat, "", CCGetRequestParam("GrandTotal", $Method, NULL), $this);
            $this->GrandTotal->Required = true;
            $this->PackCostInt = new clsControl(ccsHidden, "PackCostInt", "PackCostInt", ccsInteger, "", CCGetRequestParam("PackCostInt", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-8B553631
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlInvoice_H_ID"] = CCGetFromGet("Invoice_H_ID", NULL);
    }
//End Initialize Method

//Validate Method @2-8375326B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->SubTotal->Validate() && $Validation);
        $Validation = ($this->Discount->Validate() && $Validation);
        $Validation = ($this->Packaging->Validate() && $Validation);
        $Validation = ($this->Fumigation->Validate() && $Validation);
        $Validation = ($this->GrandTotal->Validate() && $Validation);
        $Validation = ($this->PackCostInt->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->SubTotal->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Discount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Packaging->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Fumigation->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GrandTotal->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PackCostInt->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-E86F62FF
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->SubTotal->Errors->Count());
        $errors = ($errors || $this->Discount->Errors->Count());
        $errors = ($errors || $this->Packaging->Errors->Count());
        $errors = ($errors || $this->Fumigation->Errors->Count());
        $errors = ($errors || $this->GrandTotal->Errors->Count());
        $errors = ($errors || $this->PackCostInt->Errors->Count());
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

//Operation Method @2-517B5C36
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

//UpdateRow Method @2-70134BCC
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->SubTotal->SetValue($this->SubTotal->GetValue(true));
        $this->DataSource->Discount->SetValue($this->Discount->GetValue(true));
        $this->DataSource->Packaging->SetValue($this->Packaging->GetValue(true));
        $this->DataSource->Fumigation->SetValue($this->Fumigation->GetValue(true));
        $this->DataSource->GrandTotal->SetValue($this->GrandTotal->GetValue(true));
        $this->DataSource->PackCostInt->SetValue($this->PackCostInt->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-B0EE6005
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
                    $this->SubTotal->SetValue($this->DataSource->SubTotal->GetValue());
                    $this->Discount->SetValue($this->DataSource->Discount->GetValue());
                    $this->Packaging->SetValue($this->DataSource->Packaging->GetValue());
                    $this->Fumigation->SetValue($this->DataSource->Fumigation->GetValue());
                    $this->GrandTotal->SetValue($this->DataSource->GrandTotal->GetValue());
                    $this->PackCostInt->SetValue($this->DataSource->PackCostInt->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->SubTotal->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Discount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Packaging->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Fumigation->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GrandTotal->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PackCostInt->Errors->ToString());
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
        $this->SubTotal->Show();
        $this->Discount->Show();
        $this->Packaging->Show();
        $this->Fumigation->Show();
        $this->GrandTotal->Show();
        $this->PackCostInt->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End Totalan Class @2-FCB6E20C

class clsTotalanDataSource extends clsDBGayaFusionAll {  //TotalanDataSource Class @2-49C03C91

//DataSource Variables @2-575E4A07
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
    public $SubTotal;
    public $Discount;
    public $Packaging;
    public $Fumigation;
    public $GrandTotal;
    public $PackCostInt;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-4EC100F1
    function clsTotalanDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record Totalan/Error";
        $this->Initialize();
        $this->SubTotal = new clsField("SubTotal", ccsFloat, "");
        
        $this->Discount = new clsField("Discount", ccsFloat, "");
        
        $this->Packaging = new clsField("Packaging", ccsFloat, "");
        
        $this->Fumigation = new clsField("Fumigation", ccsFloat, "");
        
        $this->GrandTotal = new clsField("GrandTotal", ccsFloat, "");
        
        $this->PackCostInt = new clsField("PackCostInt", ccsInteger, "");
        

        $this->UpdateFields["SubTotal"] = array("Name" => "SubTotal", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Discount"] = array("Name" => "Discount", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Packaging"] = array("Name" => "Packaging", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Fumigation"] = array("Name" => "Fumigation", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["GrandTotal"] = array("Name" => "GrandTotal", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["PackagingCost"] = array("Name" => "PackagingCost", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-165F7009
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlInvoice_H_ID", ccsInteger, "", "", $this->Parameters["urlInvoice_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Invoice_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-E98A5081
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT Invoice_H_ID, SubTotal, Discount, Packaging, GrandTotal, PaymentBankTransferred, Balance, PackagingCost, Fumigation \n\n" .
        "FROM tbladminist_invoice_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-3E51DA6B
    function SetValues()
    {
        $this->SubTotal->SetDBValue(trim($this->f("SubTotal")));
        $this->Discount->SetDBValue(trim($this->f("Discount")));
        $this->Packaging->SetDBValue(trim($this->f("Packaging")));
        $this->Fumigation->SetDBValue(trim($this->f("Fumigation")));
        $this->GrandTotal->SetDBValue(trim($this->f("GrandTotal")));
        $this->PackCostInt->SetDBValue(trim($this->f("PackagingCost")));
    }
//End SetValues Method

//Update Method @2-E595AE2F
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["SubTotal"]["Value"] = $this->SubTotal->GetDBValue(true);
        $this->UpdateFields["Discount"]["Value"] = $this->Discount->GetDBValue(true);
        $this->UpdateFields["Packaging"]["Value"] = $this->Packaging->GetDBValue(true);
        $this->UpdateFields["Fumigation"]["Value"] = $this->Fumigation->GetDBValue(true);
        $this->UpdateFields["GrandTotal"]["Value"] = $this->GrandTotal->GetDBValue(true);
        $this->UpdateFields["PackagingCost"]["Value"] = $this->PackCostInt->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_invoice_h", $this->UpdateFields, $this);
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

} //End TotalanDataSource Class @2-FCB6E20C

//Initialize Page @1-6530CD13
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
$TemplateFileName = "InvoiceTotal.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C8DFC7A9
include_once("./InvoiceTotal_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9493AAB0
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Totalan = new clsRecordTotalan("", $MainPage);
$MainPage->Totalan = & $Totalan;
$Totalan->Initialize();

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

//Execute Components @1-3F8C7BBE
$Totalan->Operation();
//End Execute Components

//Go to destination page @1-25DD801A
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Totalan);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-AF42B9BB
$Totalan->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-E524A3EB
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Totalan);
unset($Tpl);
//End Unload Page


?>
