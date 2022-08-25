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

//Include Common Files @1-19ADDF4C
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ProfPayment.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGrid { //Grid class @2-76129994

//Variables @2-AF6BF993

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
    public $Sorter_proforma_H_id;
    public $Sorter_pre_date;
    public $Sorter_SubTotal;
    public $Sorter_Discount;
    public $Sorter_Packaging;
    public $Sorter_Fumigation;
    public $Sorter_GrandTotal;
//End Variables

//Class_Initialize Event @2-8AD20C9A
    function clsGridGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Grid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Grid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("GridOrder", "");
        $this->SorterDirection = CCGetParam("GridDir", "");

        $this->proforma_h_id = new clsControl(ccsHidden, "proforma_h_id", "proforma_h_id", ccsInteger, "", CCGetRequestParam("proforma_h_id", ccsGet, NULL), $this);
        $this->pre_date = new clsControl(ccsLabel, "pre_date", "pre_date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("pre_date", ccsGet, NULL), $this);
        $this->SubTotal = new clsControl(ccsLabel, "SubTotal", "SubTotal", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("SubTotal", ccsGet, NULL), $this);
        $this->Discount = new clsControl(ccsLabel, "Discount", "Discount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Discount", ccsGet, NULL), $this);
        $this->Packaging = new clsControl(ccsLabel, "Packaging", "Packaging", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Packaging", ccsGet, NULL), $this);
        $this->Fumigation = new clsControl(ccsLabel, "Fumigation", "Fumigation", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Fumigation", ccsGet, NULL), $this);
        $this->GrandTotal = new clsControl(ccsLabel, "GrandTotal", "GrandTotal", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("GrandTotal", ccsGet, NULL), $this);
        $this->lnkProforma = new clsControl(ccsLink, "lnkProforma", "lnkProforma", ccsText, "", CCGetRequestParam("lnkProforma", ccsGet, NULL), $this);
        $this->lnkProforma->Page = "ProfPayment2.php";
        $this->lblCurrency = new clsControl(ccsLabel, "lblCurrency", "lblCurrency", ccsText, "", CCGetRequestParam("lblCurrency", ccsGet, NULL), $this);
        $this->CurrencyID = new clsControl(ccsHidden, "CurrencyID", "CurrencyID", ccsInteger, "", CCGetRequestParam("CurrencyID", ccsGet, NULL), $this);
        $this->ar_proforma_pay_proforma_TotalRecords = new clsControl(ccsLabel, "ar_proforma_pay_proforma_TotalRecords", "ar_proforma_pay_proforma_TotalRecords", ccsText, "", CCGetRequestParam("ar_proforma_pay_proforma_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_proforma_H_id = new clsSorter($this->ComponentName, "Sorter_proforma_H_id", $FileName, $this);
        $this->Sorter_pre_date = new clsSorter($this->ComponentName, "Sorter_pre_date", $FileName, $this);
        $this->Sorter_SubTotal = new clsSorter($this->ComponentName, "Sorter_SubTotal", $FileName, $this);
        $this->Sorter_Discount = new clsSorter($this->ComponentName, "Sorter_Discount", $FileName, $this);
        $this->Sorter_Packaging = new clsSorter($this->ComponentName, "Sorter_Packaging", $FileName, $this);
        $this->Sorter_Fumigation = new clsSorter($this->ComponentName, "Sorter_Fumigation", $FileName, $this);
        $this->Sorter_GrandTotal = new clsSorter($this->ComponentName, "Sorter_GrandTotal", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->lblClient = new clsControl(ccsLabel, "lblClient", "lblClient", ccsText, "", CCGetRequestParam("lblClient", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-4C3B9AEF
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlClientID"] = CCGetFromGet("ClientID", NULL);
        $this->DataSource->Parameters["expr47"] = 0;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["proforma_h_id"] = $this->proforma_h_id->Visible;
            $this->ControlsVisible["pre_date"] = $this->pre_date->Visible;
            $this->ControlsVisible["SubTotal"] = $this->SubTotal->Visible;
            $this->ControlsVisible["Discount"] = $this->Discount->Visible;
            $this->ControlsVisible["Packaging"] = $this->Packaging->Visible;
            $this->ControlsVisible["Fumigation"] = $this->Fumigation->Visible;
            $this->ControlsVisible["GrandTotal"] = $this->GrandTotal->Visible;
            $this->ControlsVisible["lnkProforma"] = $this->lnkProforma->Visible;
            $this->ControlsVisible["lblCurrency"] = $this->lblCurrency->Visible;
            $this->ControlsVisible["CurrencyID"] = $this->CurrencyID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->proforma_h_id->SetValue($this->DataSource->proforma_h_id->GetValue());
                $this->pre_date->SetValue($this->DataSource->pre_date->GetValue());
                $this->SubTotal->SetValue($this->DataSource->SubTotal->GetValue());
                $this->Discount->SetValue($this->DataSource->Discount->GetValue());
                $this->Packaging->SetValue($this->DataSource->Packaging->GetValue());
                $this->Fumigation->SetValue($this->DataSource->Fumigation->GetValue());
                $this->GrandTotal->SetValue($this->DataSource->GrandTotal->GetValue());
                $this->lnkProforma->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->lnkProforma->Parameters = CCAddParam($this->lnkProforma->Parameters, "ar_proforma_id", $this->DataSource->f("ar_proforma_id"));
                $this->CurrencyID->SetValue($this->DataSource->CurrencyID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->proforma_h_id->Show();
                $this->pre_date->Show();
                $this->SubTotal->Show();
                $this->Discount->Show();
                $this->Packaging->Show();
                $this->Fumigation->Show();
                $this->GrandTotal->Show();
                $this->lnkProforma->Show();
                $this->lblCurrency->Show();
                $this->CurrencyID->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->ar_proforma_pay_proforma_TotalRecords->Show();
        $this->Sorter_proforma_H_id->Show();
        $this->Sorter_pre_date->Show();
        $this->Sorter_SubTotal->Show();
        $this->Sorter_Discount->Show();
        $this->Sorter_Packaging->Show();
        $this->Sorter_Fumigation->Show();
        $this->Sorter_GrandTotal->Show();
        $this->Navigator->Show();
        $this->lblClient->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-4B88C296
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->proforma_h_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pre_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SubTotal->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Discount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Packaging->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Fumigation->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GrandTotal->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lnkProforma->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblCurrency->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CurrencyID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid Class @2-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @2-7708C172

//DataSource Variables @2-2726B609
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $proforma_h_id;
    public $pre_date;
    public $SubTotal;
    public $Discount;
    public $Packaging;
    public $Fumigation;
    public $GrandTotal;
    public $CurrencyID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-B33B7C88
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid";
        $this->Initialize();
        $this->proforma_h_id = new clsField("proforma_h_id", ccsInteger, "");
        
        $this->pre_date = new clsField("pre_date", ccsDate, $this->DateFormat);
        
        $this->SubTotal = new clsField("SubTotal", ccsFloat, "");
        
        $this->Discount = new clsField("Discount", ccsFloat, "");
        
        $this->Packaging = new clsField("Packaging", ccsFloat, "");
        
        $this->Fumigation = new clsField("Fumigation", ccsFloat, "");
        
        $this->GrandTotal = new clsField("GrandTotal", ccsFloat, "");
        
        $this->CurrencyID = new clsField("CurrencyID", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-BD1B393D
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_proforma_H_id" => array("proforma_h_id", ""), 
            "Sorter_pre_date" => array("pre_date", ""), 
            "Sorter_SubTotal" => array("SubTotal", ""), 
            "Sorter_Discount" => array("Discount", ""), 
            "Sorter_Packaging" => array("Packaging", ""), 
            "Sorter_Fumigation" => array("Fumigation", ""), 
            "Sorter_GrandTotal" => array("GrandTotal", "")));
    }
//End SetOrder Method

//Prepare Method @2-F30ADF22
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlClientID", ccsInteger, "", "", $this->Parameters["urlClientID"], "", false);
        $this->wp->AddParameter("2", "expr47", ccsInteger, "", "", $this->Parameters["expr47"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "client_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "Paid", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-579A5DA2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ar_proforma";
        $this->SQL = "SELECT * \n\n" .
        "FROM ar_proforma {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-9CFBFC50
    function SetValues()
    {
        $this->proforma_h_id->SetDBValue(trim($this->f("proforma_h_id")));
        $this->pre_date->SetDBValue(trim($this->f("pre_date")));
        $this->SubTotal->SetDBValue(trim($this->f("SubTotal")));
        $this->Discount->SetDBValue(trim($this->f("Discount")));
        $this->Packaging->SetDBValue(trim($this->f("Packaging")));
        $this->Fumigation->SetDBValue(trim($this->f("Fumigation")));
        $this->GrandTotal->SetDBValue(trim($this->f("GrandTotal")));
        $this->CurrencyID->SetDBValue(trim($this->f("Currency")));
    }
//End SetValues Method

} //End GridDataSource Class @2-FCB6E20C



//Initialize Page @1-E4A2DA96
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
$TemplateFileName = "ProfPayment.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-0624F6B2
include_once("./ProfPayment_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9DB681B9
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Grid = new clsGridGrid("", $MainPage);
$MainPage->Grid = & $Grid;
$Grid->Initialize();

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

//Go to destination page @1-8F75E0D3
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Grid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-13E909A8
$Grid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-DE3D54BD
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Grid);
unset($Tpl);
//End Unload Page


?>
