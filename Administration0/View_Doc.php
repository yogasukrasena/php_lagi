<?php
//Include Common Files @1-E39AC054
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "View_Doc.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtbladminist_administ_doc { //tbladminist_administ_doc Class @16-81B4DF5C

//Variables @16-9E315808

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

//Class_Initialize Event @16-6178C3B8
    function clsRecordtbladminist_administ_doc($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tbladminist_administ_doc/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tbladminist_administ_doc";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_tbladminist_client_ClientName = new clsControl(ccsListBox, "s_tbladminist_client_ClientName", "s_tbladminist_client_ClientName", ccsText, "", CCGetRequestParam("s_tbladminist_client_ClientName", $Method, NULL), $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @16-CBE7DD80
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_tbladminist_client_ClientName->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_tbladminist_client_ClientName->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @16-EF42C436
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_tbladminist_client_ClientName->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @16-ED598703
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

//Operation Method @16-F64577D0
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "View_Doc.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "View_Doc.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @16-F386B2A3
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

        $this->s_tbladminist_client_ClientName->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_tbladminist_client_ClientName->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
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

        $this->s_tbladminist_client_ClientName->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tbladminist_administ_doc Class @16-FCB6E20C

class clsGridtbladminist_administ_doc1 { //tbladminist_administ_doc1 class @2-94AA58A9

//Variables @2-E1B929DB

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
    public $Sorter_tbladminist_client_ClientName;
    public $Sorter_QuotationNo;
    public $Sorter_tbladminist_proforma_h_ProformaNo;
    public $Sorter_tbladminist_prodorderlist_h_ClientOrderRef;
    public $Sorter_InvoiceNo;
    public $Sorter_PackListNo;
//End Variables

//Class_Initialize Event @2-098EBA5F
    function clsGridtbladminist_administ_doc1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tbladminist_administ_doc1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tbladminist_administ_doc1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstbladminist_administ_doc1DataSource($this);
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
        $this->SorterName = CCGetParam("tbladminist_administ_doc1Order", "");
        $this->SorterDirection = CCGetParam("tbladminist_administ_doc1Dir", "");

        $this->tbladminist_client_ClientName = new clsControl(ccsLink, "tbladminist_client_ClientName", "tbladminist_client_ClientName", ccsText, "", CCGetRequestParam("tbladminist_client_ClientName", ccsGet, NULL), $this);
        $this->tbladminist_client_ClientName->Page = "View_Doc.php";
        $this->QuotationNo = new clsControl(ccsLabel, "QuotationNo", "QuotationNo", ccsText, "", CCGetRequestParam("QuotationNo", ccsGet, NULL), $this);
        $this->tbladminist_proforma_h_ProformaNo = new clsControl(ccsLabel, "tbladminist_proforma_h_ProformaNo", "tbladminist_proforma_h_ProformaNo", ccsText, "", CCGetRequestParam("tbladminist_proforma_h_ProformaNo", ccsGet, NULL), $this);
        $this->tbladminist_prodorderlist_h_ClientOrderRef = new clsControl(ccsLabel, "tbladminist_prodorderlist_h_ClientOrderRef", "tbladminist_prodorderlist_h_ClientOrderRef", ccsInteger, "", CCGetRequestParam("tbladminist_prodorderlist_h_ClientOrderRef", ccsGet, NULL), $this);
        $this->InvoiceNo = new clsControl(ccsLabel, "InvoiceNo", "InvoiceNo", ccsText, "", CCGetRequestParam("InvoiceNo", ccsGet, NULL), $this);
        $this->PackListNo = new clsControl(ccsLabel, "PackListNo", "PackListNo", ccsText, "", CCGetRequestParam("PackListNo", ccsGet, NULL), $this);
        $this->Sorter_tbladminist_client_ClientName = new clsSorter($this->ComponentName, "Sorter_tbladminist_client_ClientName", $FileName, $this);
        $this->Sorter_QuotationNo = new clsSorter($this->ComponentName, "Sorter_QuotationNo", $FileName, $this);
        $this->Sorter_tbladminist_proforma_h_ProformaNo = new clsSorter($this->ComponentName, "Sorter_tbladminist_proforma_h_ProformaNo", $FileName, $this);
        $this->Sorter_tbladminist_prodorderlist_h_ClientOrderRef = new clsSorter($this->ComponentName, "Sorter_tbladminist_prodorderlist_h_ClientOrderRef", $FileName, $this);
        $this->Sorter_InvoiceNo = new clsSorter($this->ComponentName, "Sorter_InvoiceNo", $FileName, $this);
        $this->Sorter_PackListNo = new clsSorter($this->ComponentName, "Sorter_PackListNo", $FileName, $this);
        $this->tbladminist_administ_doc1_Insert = new clsControl(ccsLink, "tbladminist_administ_doc1_Insert", "tbladminist_administ_doc1_Insert", ccsText, "", CCGetRequestParam("tbladminist_administ_doc1_Insert", ccsGet, NULL), $this);
        $this->tbladminist_administ_doc1_Insert->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->tbladminist_administ_doc1_Insert->Page = "View_Doc.php";
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @2-1AC928CF
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_tbladminist_client_ClientName"] = CCGetFromGet("s_tbladminist_client_ClientName", NULL);

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
            $this->ControlsVisible["tbladminist_client_ClientName"] = $this->tbladminist_client_ClientName->Visible;
            $this->ControlsVisible["QuotationNo"] = $this->QuotationNo->Visible;
            $this->ControlsVisible["tbladminist_proforma_h_ProformaNo"] = $this->tbladminist_proforma_h_ProformaNo->Visible;
            $this->ControlsVisible["tbladminist_prodorderlist_h_ClientOrderRef"] = $this->tbladminist_prodorderlist_h_ClientOrderRef->Visible;
            $this->ControlsVisible["InvoiceNo"] = $this->InvoiceNo->Visible;
            $this->ControlsVisible["PackListNo"] = $this->PackListNo->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                // Parse Separator
                if($this->RowNumber) {
                    $this->Attributes->Show();
                    $Tpl->parseto("Separator", true, "Row");
                }
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->tbladminist_client_ClientName->SetValue($this->DataSource->tbladminist_client_ClientName->GetValue());
                $this->tbladminist_client_ClientName->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->tbladminist_client_ClientName->Parameters = CCAddParam($this->tbladminist_client_ClientName->Parameters, "ID", $this->DataSource->f("ID"));
                $this->QuotationNo->SetValue($this->DataSource->QuotationNo->GetValue());
                $this->tbladminist_proforma_h_ProformaNo->SetValue($this->DataSource->tbladminist_proforma_h_ProformaNo->GetValue());
                $this->tbladminist_prodorderlist_h_ClientOrderRef->SetValue($this->DataSource->tbladminist_prodorderlist_h_ClientOrderRef->GetValue());
                $this->InvoiceNo->SetValue($this->DataSource->InvoiceNo->GetValue());
                $this->PackListNo->SetValue($this->DataSource->PackListNo->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->tbladminist_client_ClientName->Show();
                $this->QuotationNo->Show();
                $this->tbladminist_proforma_h_ProformaNo->Show();
                $this->tbladminist_prodorderlist_h_ClientOrderRef->Show();
                $this->InvoiceNo->Show();
                $this->PackListNo->Show();
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
        $this->Sorter_tbladminist_client_ClientName->Show();
        $this->Sorter_QuotationNo->Show();
        $this->Sorter_tbladminist_proforma_h_ProformaNo->Show();
        $this->Sorter_tbladminist_prodorderlist_h_ClientOrderRef->Show();
        $this->Sorter_InvoiceNo->Show();
        $this->Sorter_PackListNo->Show();
        $this->tbladminist_administ_doc1_Insert->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-F5D3E2BB
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->tbladminist_client_ClientName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tbladminist_proforma_h_ProformaNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tbladminist_prodorderlist_h_ClientOrderRef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->InvoiceNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PackListNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tbladminist_administ_doc1 Class @2-FCB6E20C

class clstbladminist_administ_doc1DataSource extends clsDBGayaFusionAll {  //tbladminist_administ_doc1DataSource Class @2-328315AE

//DataSource Variables @2-D39B6644
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $tbladminist_client_ClientName;
    public $QuotationNo;
    public $tbladminist_proforma_h_ProformaNo;
    public $tbladminist_prodorderlist_h_ClientOrderRef;
    public $InvoiceNo;
    public $PackListNo;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-7A0E3CEA
    function clstbladminist_administ_doc1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tbladminist_administ_doc1";
        $this->Initialize();
        $this->tbladminist_client_ClientName = new clsField("tbladminist_client_ClientName", ccsText, "");
        
        $this->QuotationNo = new clsField("QuotationNo", ccsText, "");
        
        $this->tbladminist_proforma_h_ProformaNo = new clsField("tbladminist_proforma_h_ProformaNo", ccsText, "");
        
        $this->tbladminist_prodorderlist_h_ClientOrderRef = new clsField("tbladminist_prodorderlist_h_ClientOrderRef", ccsInteger, "");
        
        $this->InvoiceNo = new clsField("InvoiceNo", ccsText, "");
        
        $this->PackListNo = new clsField("PackListNo", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-F9934027
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "tbladminist_administ_doc.ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_tbladminist_client_ClientName" => array("tbladminist_client.ClientName", ""), 
            "Sorter_QuotationNo" => array("QuotationNo", ""), 
            "Sorter_tbladminist_proforma_h_ProformaNo" => array("tbladminist_proforma_h.ProformaNo", ""), 
            "Sorter_tbladminist_prodorderlist_h_ClientOrderRef" => array("tbladminist_prodorderlist_h.ClientOrderRef", ""), 
            "Sorter_InvoiceNo" => array("InvoiceNo", ""), 
            "Sorter_PackListNo" => array("PackListNo", "")));
    }
//End SetOrder Method

//Prepare Method @2-0CCD6465
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_tbladminist_client_ClientName", ccsText, "", "", $this->Parameters["urls_tbladminist_client_ClientName"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "tbladminist_client.ClientName", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-D862288A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((((tbladminist_administ_doc INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_administ_doc.ClientID = tbladminist_client.ClientID) INNER JOIN tbladminist_packinglist_h ON\n\n" .
        "tbladminist_administ_doc.PackingListID = tbladminist_packinglist_h.PackingList_H_ID) INNER JOIN tbladminist_quotation_h ON\n\n" .
        "tbladminist_quotation_h.Quotation_H_ID = tbladminist_administ_doc.QuotationID) INNER JOIN tbladminist_proforma_h ON\n\n" .
        "tbladminist_administ_doc.ProformaID = tbladminist_proforma_h.Proforma_H_ID) INNER JOIN tbladminist_invoice_h ON\n\n" .
        "tbladminist_invoice_h.Invoice_H_ID = tbladminist_administ_doc.InvoiceID";
        $this->SQL = "SELECT tbladminist_administ_doc.*, ClientCompany, PackListNo, QuotationNo, tbladminist_proforma_h.ProformaNo AS tbladminist_proforma_h_ProformaNo,\n\n" .
        "InvoiceNo \n\n" .
        "FROM ((((tbladminist_administ_doc INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_administ_doc.ClientID = tbladminist_client.ClientID) INNER JOIN tbladminist_packinglist_h ON\n\n" .
        "tbladminist_administ_doc.PackingListID = tbladminist_packinglist_h.PackingList_H_ID) INNER JOIN tbladminist_quotation_h ON\n\n" .
        "tbladminist_quotation_h.Quotation_H_ID = tbladminist_administ_doc.QuotationID) INNER JOIN tbladminist_proforma_h ON\n\n" .
        "tbladminist_administ_doc.ProformaID = tbladminist_proforma_h.Proforma_H_ID) INNER JOIN tbladminist_invoice_h ON\n\n" .
        "tbladminist_invoice_h.Invoice_H_ID = tbladminist_administ_doc.InvoiceID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-48257158
    function SetValues()
    {
        $this->tbladminist_client_ClientName->SetDBValue($this->f("tbladminist_client_ClientName"));
        $this->QuotationNo->SetDBValue($this->f("QuotationNo"));
        $this->tbladminist_proforma_h_ProformaNo->SetDBValue($this->f("tbladminist_proforma_h_ProformaNo"));
        $this->tbladminist_prodorderlist_h_ClientOrderRef->SetDBValue(trim($this->f("ClientOrderRef")));
        $this->InvoiceNo->SetDBValue($this->f("InvoiceNo"));
        $this->PackListNo->SetDBValue($this->f("PackListNo"));
    }
//End SetValues Method

} //End tbladminist_administ_doc1DataSource Class @2-FCB6E20C

//Initialize Page @1-032836F7
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
$TemplateFileName = "View_Doc.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-2AD5B566
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tbladminist_administ_doc = new clsRecordtbladminist_administ_doc("", $MainPage);
$tbladminist_administ_doc1 = new clsGridtbladminist_administ_doc1("", $MainPage);
$MainPage->tbladminist_administ_doc = & $tbladminist_administ_doc;
$MainPage->tbladminist_administ_doc1 = & $tbladminist_administ_doc1;
$tbladminist_administ_doc1->Initialize();

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

//Execute Components @1-20CA0CD5
$tbladminist_administ_doc->Operation();
//End Execute Components

//Go to destination page @1-D840C90B
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tbladminist_administ_doc);
    unset($tbladminist_administ_doc1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F92E9898
$tbladminist_administ_doc->Show();
$tbladminist_administ_doc1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D1DA5CB4
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tbladminist_administ_doc);
unset($tbladminist_administ_doc1);
unset($Tpl);
//End Unload Page


?>
