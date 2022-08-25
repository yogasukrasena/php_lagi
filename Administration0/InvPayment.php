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

//Include Common Files @1-633ED5BC
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "InvPayment.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGrid { //Grid class @2-76129994

//Variables @2-68F9076B

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
    public $Sorter_proforma_h_id;
    public $Sorter_invoice_h_id;
    public $Sorter_pre_date;
    public $Sorter_amount;
    public $Sorter_Diskon;
    public $Sorter_Packaging;
    public $Sorter_GrandTot;
    public $Sorter_Fumigation;
//End Variables

//Class_Initialize Event @2-049EB6A0
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
        $this->due_date = new clsControl(ccsLabel, "due_date", "due_date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("due_date", ccsGet, NULL), $this);
        $this->SubTotal = new clsControl(ccsLabel, "SubTotal", "SubTotal", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("SubTotal", ccsGet, NULL), $this);
        $this->Invoice_SH_ID = new clsControl(ccsHidden, "Invoice_SH_ID", "Invoice_SH_ID", ccsInteger, "", CCGetRequestParam("Invoice_SH_ID", ccsGet, NULL), $this);
        $this->InvoiceNo = new clsControl(ccsLink, "InvoiceNo", "InvoiceNo", ccsText, "", CCGetRequestParam("InvoiceNo", ccsGet, NULL), $this);
        $this->InvoiceNo->Page = "InvPayment2.php";
        $this->Invoice_H_ID = new clsControl(ccsHidden, "Invoice_H_ID", "Invoice_H_ID", ccsInteger, "", CCGetRequestParam("Invoice_H_ID", ccsGet, NULL), $this);
        $this->Discount = new clsControl(ccsLabel, "Discount", "Discount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Discount", ccsGet, NULL), $this);
        $this->Packaging = new clsControl(ccsLabel, "Packaging", "Packaging", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Packaging", ccsGet, NULL), $this);
        $this->Fumigation = new clsControl(ccsLabel, "Fumigation", "Fumigation", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Fumigation", ccsGet, NULL), $this);
        $this->GrandTotal = new clsControl(ccsLabel, "GrandTotal", "GrandTotal", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("GrandTotal", ccsGet, NULL), $this);
        $this->lblCurrency = new clsControl(ccsLabel, "lblCurrency", "lblCurrency", ccsText, "", CCGetRequestParam("lblCurrency", ccsGet, NULL), $this);
        $this->CurrencyID = new clsControl(ccsHidden, "CurrencyID", "CurrencyID", ccsInteger, "", CCGetRequestParam("CurrencyID", ccsGet, NULL), $this);
        $this->lblProforma = new clsControl(ccsLabel, "lblProforma", "lblProforma", ccsText, "", CCGetRequestParam("lblProforma", ccsGet, NULL), $this);
        $this->ar_invoice_pay_invoice_TotalRecords = new clsControl(ccsLabel, "ar_invoice_pay_invoice_TotalRecords", "ar_invoice_pay_invoice_TotalRecords", ccsText, "", CCGetRequestParam("ar_invoice_pay_invoice_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_proforma_h_id = new clsSorter($this->ComponentName, "Sorter_proforma_h_id", $FileName, $this);
        $this->Sorter_invoice_h_id = new clsSorter($this->ComponentName, "Sorter_invoice_h_id", $FileName, $this);
        $this->Sorter_pre_date = new clsSorter($this->ComponentName, "Sorter_pre_date", $FileName, $this);
        $this->Sorter_amount = new clsSorter($this->ComponentName, "Sorter_amount", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->lblClient = new clsControl(ccsLabel, "lblClient", "lblClient", ccsText, "", CCGetRequestParam("lblClient", ccsGet, NULL), $this);
        $this->Sorter_Diskon = new clsSorter($this->ComponentName, "Sorter_Diskon", $FileName, $this);
        $this->Sorter_Packaging = new clsSorter($this->ComponentName, "Sorter_Packaging", $FileName, $this);
        $this->Sorter_GrandTot = new clsSorter($this->ComponentName, "Sorter_GrandTot", $FileName, $this);
        $this->Sorter_Fumigation = new clsSorter($this->ComponentName, "Sorter_Fumigation", $FileName, $this);
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

//Show Method @2-706DC1E5
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlclient_id"] = CCGetFromGet("client_id", NULL);
        $this->DataSource->Parameters["expr32"] = 0;

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
            $this->ControlsVisible["due_date"] = $this->due_date->Visible;
            $this->ControlsVisible["SubTotal"] = $this->SubTotal->Visible;
            $this->ControlsVisible["Invoice_SH_ID"] = $this->Invoice_SH_ID->Visible;
            $this->ControlsVisible["InvoiceNo"] = $this->InvoiceNo->Visible;
            $this->ControlsVisible["Invoice_H_ID"] = $this->Invoice_H_ID->Visible;
            $this->ControlsVisible["Discount"] = $this->Discount->Visible;
            $this->ControlsVisible["Packaging"] = $this->Packaging->Visible;
            $this->ControlsVisible["Fumigation"] = $this->Fumigation->Visible;
            $this->ControlsVisible["GrandTotal"] = $this->GrandTotal->Visible;
            $this->ControlsVisible["lblCurrency"] = $this->lblCurrency->Visible;
            $this->ControlsVisible["CurrencyID"] = $this->CurrencyID->Visible;
            $this->ControlsVisible["lblProforma"] = $this->lblProforma->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->proforma_h_id->SetValue($this->DataSource->proforma_h_id->GetValue());
                $this->due_date->SetValue($this->DataSource->due_date->GetValue());
                $this->SubTotal->SetValue($this->DataSource->SubTotal->GetValue());
                $this->Invoice_SH_ID->SetValue($this->DataSource->Invoice_SH_ID->GetValue());
                $this->InvoiceNo->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->InvoiceNo->Parameters = CCAddParam($this->InvoiceNo->Parameters, "ar_invoice_id", $this->DataSource->f("ar_invoice_id"));
                $this->Invoice_H_ID->SetValue($this->DataSource->Invoice_H_ID->GetValue());
                $this->Discount->SetValue($this->DataSource->Discount->GetValue());
                $this->Packaging->SetValue($this->DataSource->Packaging->GetValue());
                $this->Fumigation->SetValue($this->DataSource->Fumigation->GetValue());
                $this->GrandTotal->SetValue($this->DataSource->GrandTotal->GetValue());
                $this->CurrencyID->SetValue($this->DataSource->CurrencyID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->proforma_h_id->Show();
                $this->due_date->Show();
                $this->SubTotal->Show();
                $this->Invoice_SH_ID->Show();
                $this->InvoiceNo->Show();
                $this->Invoice_H_ID->Show();
                $this->Discount->Show();
                $this->Packaging->Show();
                $this->Fumigation->Show();
                $this->GrandTotal->Show();
                $this->lblCurrency->Show();
                $this->CurrencyID->Show();
                $this->lblProforma->Show();
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
        $this->ar_invoice_pay_invoice_TotalRecords->Show();
        $this->Sorter_proforma_h_id->Show();
        $this->Sorter_invoice_h_id->Show();
        $this->Sorter_pre_date->Show();
        $this->Sorter_amount->Show();
        $this->Navigator->Show();
        $this->lblClient->Show();
        $this->Sorter_Diskon->Show();
        $this->Sorter_Packaging->Show();
        $this->Sorter_GrandTot->Show();
        $this->Sorter_Fumigation->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-67D5D7C2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->proforma_h_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->due_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SubTotal->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Invoice_SH_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->InvoiceNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Invoice_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Discount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Packaging->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Fumigation->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GrandTotal->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblCurrency->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CurrencyID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblProforma->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid Class @2-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @2-7708C172

//DataSource Variables @2-D4E04151
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $proforma_h_id;
    public $due_date;
    public $SubTotal;
    public $Invoice_SH_ID;
    public $Invoice_H_ID;
    public $Discount;
    public $Packaging;
    public $Fumigation;
    public $GrandTotal;
    public $CurrencyID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-0D42F13D
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid";
        $this->Initialize();
        $this->proforma_h_id = new clsField("proforma_h_id", ccsInteger, "");
        
        $this->due_date = new clsField("due_date", ccsDate, $this->DateFormat);
        
        $this->SubTotal = new clsField("SubTotal", ccsFloat, "");
        
        $this->Invoice_SH_ID = new clsField("Invoice_SH_ID", ccsInteger, "");
        
        $this->Invoice_H_ID = new clsField("Invoice_H_ID", ccsInteger, "");
        
        $this->Discount = new clsField("Discount", ccsFloat, "");
        
        $this->Packaging = new clsField("Packaging", ccsFloat, "");
        
        $this->Fumigation = new clsField("Fumigation", ccsFloat, "");
        
        $this->GrandTotal = new clsField("GrandTotal", ccsFloat, "");
        
        $this->CurrencyID = new clsField("CurrencyID", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-7CA513AE
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_proforma_h_id" => array("proforma_h_id", ""), 
            "Sorter_invoice_h_id" => array("invoice_h_id", ""), 
            "Sorter_pre_date" => array("due_date", ""), 
            "Sorter_amount" => array("SubTotal", ""), 
            "Sorter_Diskon" => array("Discount", ""), 
            "Sorter_Packaging" => array("Packaging", ""), 
            "Sorter_GrandTot" => array("GrandTotal", ""), 
            "Sorter_Fumigation" => array("Fumigation", "")));
    }
//End SetOrder Method

//Prepare Method @2-4A2CDB35
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlclient_id", ccsInteger, "", "", $this->Parameters["urlclient_id"], "", false);
        $this->wp->AddParameter("2", "expr32", ccsInteger, "", "", $this->Parameters["expr32"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ar_invoice.client_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "Paid", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-D2365A8E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ar_invoice";
        $this->SQL = "SELECT * \n\n" .
        "FROM ar_invoice {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-996D41A7
    function SetValues()
    {
        $this->proforma_h_id->SetDBValue(trim($this->f("proforma_h_id")));
        $this->due_date->SetDBValue(trim($this->f("due_date")));
        $this->SubTotal->SetDBValue(trim($this->f("SubTotal")));
        $this->Invoice_SH_ID->SetDBValue(trim($this->f("Invoice_SH_ID")));
        $this->Invoice_H_ID->SetDBValue(trim($this->f("invoice_h_id")));
        $this->Discount->SetDBValue(trim($this->f("Discount")));
        $this->Packaging->SetDBValue(trim($this->f("Packaging")));
        $this->Fumigation->SetDBValue(trim($this->f("Fumigation")));
        $this->GrandTotal->SetDBValue(trim($this->f("GrandTotal")));
        $this->CurrencyID->SetDBValue(trim($this->f("Currency")));
    }
//End SetValues Method

} //End GridDataSource Class @2-FCB6E20C

//Initialize Page @1-D6992978
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
$TemplateFileName = "InvPayment.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-548E3190
include_once("./InvPayment_events.php");
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

//Show Page @1-391FF5F0
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
