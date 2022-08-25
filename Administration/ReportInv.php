<?php
//Include Common Files @1-9B27925B
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ReportInv.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Grid ReportGroup class @2-236894E8
class clsReportGroupGrid {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $ClientCompany, $_ClientCompanyAttributes;
    public $proforma_h_id, $_proforma_h_idAttributes;
    public $due_date, $_due_dateAttributes;
    public $GrandTotal, $_GrandTotalAttributes;
    public $Currency, $_CurrencyAttributes;
    public $ar_invoice_Rate, $_ar_invoice_RateAttributes;
    public $paid_date, $_paid_dateAttributes;
    public $amount_paid, $_amount_paidAttributes;
    public $pay_invoice_Rate, $_pay_invoice_RateAttributes;
    public $lblReceivedRupiah, $_lblReceivedRupiahAttributes;
    public $InvoiceNo, $_InvoiceNoAttributes;
    public $lblCurrency, $_lblCurrencyAttributes;
    public $lblProforma, $_lblProformaAttributes;
    public $lblGrandTotalRupiah, $_lblGrandTotalRupiahAttributes;
    public $Sum_GrandTotalRupiah, $_Sum_GrandTotalRupiahAttributes;
    public $Sum_ReceivedRupiah, $_Sum_ReceivedRupiahAttributes;
    public $TotalSum_GrandTotalRupiah, $_TotalSum_GrandTotalRupiahAttributes;
    public $TotalSum_ReceivedRupiah, $_TotalSum_ReceivedRupiahAttributes;
    public $Report_CurrentDate, $_Report_CurrentDateAttributes;
    public $Report_CurrentPage, $_Report_CurrentPageAttributes;
    public $Report_TotalPages, $_Report_TotalPagesAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;
    public $ClientCompanyTotalIndex;

    function clsReportGroupGrid(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->ClientCompany = $this->Parent->ClientCompany->Value;
        $this->proforma_h_id = $this->Parent->proforma_h_id->Value;
        $this->due_date = $this->Parent->due_date->Value;
        $this->GrandTotal = $this->Parent->GrandTotal->Value;
        $this->Currency = $this->Parent->Currency->Value;
        $this->ar_invoice_Rate = $this->Parent->ar_invoice_Rate->Value;
        $this->paid_date = $this->Parent->paid_date->Value;
        $this->amount_paid = $this->Parent->amount_paid->Value;
        $this->pay_invoice_Rate = $this->Parent->pay_invoice_Rate->Value;
        $this->lblReceivedRupiah = $this->Parent->lblReceivedRupiah->Value;
        $this->InvoiceNo = $this->Parent->InvoiceNo->Value;
        $this->lblCurrency = $this->Parent->lblCurrency->Value;
        $this->lblProforma = $this->Parent->lblProforma->Value;
        $this->lblGrandTotalRupiah = $this->Parent->lblGrandTotalRupiah->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Sum_GrandTotalRupiah = $this->Parent->Sum_GrandTotalRupiah->GetTotalValue($mode);
        $this->Sum_ReceivedRupiah = $this->Parent->Sum_ReceivedRupiah->GetTotalValue($mode);
        $this->TotalSum_GrandTotalRupiah = $this->Parent->TotalSum_GrandTotalRupiah->GetTotalValue($mode);
        $this->TotalSum_ReceivedRupiah = $this->Parent->TotalSum_ReceivedRupiah->GetTotalValue($mode);
        $this->_Sorter_due_dateAttributes = $this->Parent->Sorter_due_date->Attributes->GetAsArray();
        $this->_Sorter_paid_dateAttributes = $this->Parent->Sorter_paid_date->Attributes->GetAsArray();
        $this->_Sorter_pay_invoice_RateAttributes = $this->Parent->Sorter_pay_invoice_Rate->Attributes->GetAsArray();
        $this->_ClientCompanyAttributes = $this->Parent->ClientCompany->Attributes->GetAsArray();
        $this->_proforma_h_idAttributes = $this->Parent->proforma_h_id->Attributes->GetAsArray();
        $this->_due_dateAttributes = $this->Parent->due_date->Attributes->GetAsArray();
        $this->_GrandTotalAttributes = $this->Parent->GrandTotal->Attributes->GetAsArray();
        $this->_CurrencyAttributes = $this->Parent->Currency->Attributes->GetAsArray();
        $this->_ar_invoice_RateAttributes = $this->Parent->ar_invoice_Rate->Attributes->GetAsArray();
        $this->_paid_dateAttributes = $this->Parent->paid_date->Attributes->GetAsArray();
        $this->_amount_paidAttributes = $this->Parent->amount_paid->Attributes->GetAsArray();
        $this->_pay_invoice_RateAttributes = $this->Parent->pay_invoice_Rate->Attributes->GetAsArray();
        $this->_lblReceivedRupiahAttributes = $this->Parent->lblReceivedRupiah->Attributes->GetAsArray();
        $this->_InvoiceNoAttributes = $this->Parent->InvoiceNo->Attributes->GetAsArray();
        $this->_lblCurrencyAttributes = $this->Parent->lblCurrency->Attributes->GetAsArray();
        $this->_lblProformaAttributes = $this->Parent->lblProforma->Attributes->GetAsArray();
        $this->_lblGrandTotalRupiahAttributes = $this->Parent->lblGrandTotalRupiah->Attributes->GetAsArray();
        $this->_Sum_GrandTotalRupiahAttributes = $this->Parent->Sum_GrandTotalRupiah->Attributes->GetAsArray();
        $this->_Sum_ReceivedRupiahAttributes = $this->Parent->Sum_ReceivedRupiah->Attributes->GetAsArray();
        $this->_TotalSum_GrandTotalRupiahAttributes = $this->Parent->TotalSum_GrandTotalRupiah->Attributes->GetAsArray();
        $this->_TotalSum_ReceivedRupiahAttributes = $this->Parent->TotalSum_ReceivedRupiah->Attributes->GetAsArray();
        $this->_Report_CurrentDateAttributes = $this->Parent->Report_CurrentDate->Attributes->GetAsArray();
        $this->_Report_CurrentPageAttributes = $this->Parent->Report_CurrentPage->Attributes->GetAsArray();
        $this->_Report_TotalPagesAttributes = $this->Parent->Report_TotalPages->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->Sum_GrandTotalRupiah = $this->Sum_GrandTotalRupiah;
        $Header->_Sum_GrandTotalRupiahAttributes = $this->_Sum_GrandTotalRupiahAttributes;
        $Header->Sum_ReceivedRupiah = $this->Sum_ReceivedRupiah;
        $Header->_Sum_ReceivedRupiahAttributes = $this->_Sum_ReceivedRupiahAttributes;
        $Header->TotalSum_GrandTotalRupiah = $this->TotalSum_GrandTotalRupiah;
        $Header->_TotalSum_GrandTotalRupiahAttributes = $this->_TotalSum_GrandTotalRupiahAttributes;
        $Header->TotalSum_ReceivedRupiah = $this->TotalSum_ReceivedRupiah;
        $Header->_TotalSum_ReceivedRupiahAttributes = $this->_TotalSum_ReceivedRupiahAttributes;
        $this->ClientCompany = $Header->ClientCompany;
        $Header->_ClientCompanyAttributes = $this->_ClientCompanyAttributes;
        $this->Parent->ClientCompany->Value = $Header->ClientCompany;
        $this->Parent->ClientCompany->Attributes->RestoreFromArray($Header->_ClientCompanyAttributes);
        $this->proforma_h_id = $Header->proforma_h_id;
        $Header->_proforma_h_idAttributes = $this->_proforma_h_idAttributes;
        $this->Parent->proforma_h_id->Value = $Header->proforma_h_id;
        $this->Parent->proforma_h_id->Attributes->RestoreFromArray($Header->_proforma_h_idAttributes);
        $this->due_date = $Header->due_date;
        $Header->_due_dateAttributes = $this->_due_dateAttributes;
        $this->Parent->due_date->Value = $Header->due_date;
        $this->Parent->due_date->Attributes->RestoreFromArray($Header->_due_dateAttributes);
        $this->GrandTotal = $Header->GrandTotal;
        $Header->_GrandTotalAttributes = $this->_GrandTotalAttributes;
        $this->Parent->GrandTotal->Value = $Header->GrandTotal;
        $this->Parent->GrandTotal->Attributes->RestoreFromArray($Header->_GrandTotalAttributes);
        $this->Currency = $Header->Currency;
        $Header->_CurrencyAttributes = $this->_CurrencyAttributes;
        $this->Parent->Currency->Value = $Header->Currency;
        $this->Parent->Currency->Attributes->RestoreFromArray($Header->_CurrencyAttributes);
        $this->ar_invoice_Rate = $Header->ar_invoice_Rate;
        $Header->_ar_invoice_RateAttributes = $this->_ar_invoice_RateAttributes;
        $this->Parent->ar_invoice_Rate->Value = $Header->ar_invoice_Rate;
        $this->Parent->ar_invoice_Rate->Attributes->RestoreFromArray($Header->_ar_invoice_RateAttributes);
        $this->paid_date = $Header->paid_date;
        $Header->_paid_dateAttributes = $this->_paid_dateAttributes;
        $this->Parent->paid_date->Value = $Header->paid_date;
        $this->Parent->paid_date->Attributes->RestoreFromArray($Header->_paid_dateAttributes);
        $this->amount_paid = $Header->amount_paid;
        $Header->_amount_paidAttributes = $this->_amount_paidAttributes;
        $this->Parent->amount_paid->Value = $Header->amount_paid;
        $this->Parent->amount_paid->Attributes->RestoreFromArray($Header->_amount_paidAttributes);
        $this->pay_invoice_Rate = $Header->pay_invoice_Rate;
        $Header->_pay_invoice_RateAttributes = $this->_pay_invoice_RateAttributes;
        $this->Parent->pay_invoice_Rate->Value = $Header->pay_invoice_Rate;
        $this->Parent->pay_invoice_Rate->Attributes->RestoreFromArray($Header->_pay_invoice_RateAttributes);
        $this->lblReceivedRupiah = $Header->lblReceivedRupiah;
        $Header->_lblReceivedRupiahAttributes = $this->_lblReceivedRupiahAttributes;
        $this->Parent->lblReceivedRupiah->Value = $Header->lblReceivedRupiah;
        $this->Parent->lblReceivedRupiah->Attributes->RestoreFromArray($Header->_lblReceivedRupiahAttributes);
        $this->InvoiceNo = $Header->InvoiceNo;
        $Header->_InvoiceNoAttributes = $this->_InvoiceNoAttributes;
        $this->Parent->InvoiceNo->Value = $Header->InvoiceNo;
        $this->Parent->InvoiceNo->Attributes->RestoreFromArray($Header->_InvoiceNoAttributes);
        $this->lblCurrency = $Header->lblCurrency;
        $Header->_lblCurrencyAttributes = $this->_lblCurrencyAttributes;
        $this->Parent->lblCurrency->Value = $Header->lblCurrency;
        $this->Parent->lblCurrency->Attributes->RestoreFromArray($Header->_lblCurrencyAttributes);
        $this->lblProforma = $Header->lblProforma;
        $Header->_lblProformaAttributes = $this->_lblProformaAttributes;
        $this->Parent->lblProforma->Value = $Header->lblProforma;
        $this->Parent->lblProforma->Attributes->RestoreFromArray($Header->_lblProformaAttributes);
        $this->lblGrandTotalRupiah = $Header->lblGrandTotalRupiah;
        $Header->_lblGrandTotalRupiahAttributes = $this->_lblGrandTotalRupiahAttributes;
        $this->Parent->lblGrandTotalRupiah->Value = $Header->lblGrandTotalRupiah;
        $this->Parent->lblGrandTotalRupiah->Attributes->RestoreFromArray($Header->_lblGrandTotalRupiahAttributes);
    }
    function ChangeTotalControls() {
        $this->Sum_GrandTotalRupiah = $this->Parent->Sum_GrandTotalRupiah->GetValue();
        $this->Sum_ReceivedRupiah = $this->Parent->Sum_ReceivedRupiah->GetValue();
        $this->TotalSum_GrandTotalRupiah = $this->Parent->TotalSum_GrandTotalRupiah->GetValue();
        $this->TotalSum_ReceivedRupiah = $this->Parent->TotalSum_ReceivedRupiah->GetValue();
    }
}
//End Grid ReportGroup class

//Grid GroupsCollection class @2-DCF222A4
class clsGroupsCollectionGrid {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $mClientCompanyCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectionGrid(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mClientCompanyCurrentHeaderIndex = 1;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupGrid($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->ClientCompanyTotalIndex = $this->mClientCompanyCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->ClientCompany->Value = $this->Parent->ClientCompany->initialValue;
        $this->Parent->proforma_h_id->Value = $this->Parent->proforma_h_id->initialValue;
        $this->Parent->due_date->Value = $this->Parent->due_date->initialValue;
        $this->Parent->GrandTotal->Value = $this->Parent->GrandTotal->initialValue;
        $this->Parent->Currency->Value = $this->Parent->Currency->initialValue;
        $this->Parent->ar_invoice_Rate->Value = $this->Parent->ar_invoice_Rate->initialValue;
        $this->Parent->paid_date->Value = $this->Parent->paid_date->initialValue;
        $this->Parent->amount_paid->Value = $this->Parent->amount_paid->initialValue;
        $this->Parent->pay_invoice_Rate->Value = $this->Parent->pay_invoice_Rate->initialValue;
        $this->Parent->lblReceivedRupiah->Value = $this->Parent->lblReceivedRupiah->initialValue;
        $this->Parent->InvoiceNo->Value = $this->Parent->InvoiceNo->initialValue;
        $this->Parent->lblCurrency->Value = $this->Parent->lblCurrency->initialValue;
        $this->Parent->lblProforma->Value = $this->Parent->lblProforma->initialValue;
        $this->Parent->lblGrandTotalRupiah->Value = $this->Parent->lblGrandTotalRupiah->initialValue;
        $this->Parent->Sum_GrandTotalRupiah->Value = $this->Parent->Sum_GrandTotalRupiah->initialValue;
        $this->Parent->Sum_ReceivedRupiah->Value = $this->Parent->Sum_ReceivedRupiah->initialValue;
        $this->Parent->TotalSum_GrandTotalRupiah->Value = $this->Parent->TotalSum_GrandTotalRupiah->initialValue;
        $this->Parent->TotalSum_ReceivedRupiah->Value = $this->Parent->TotalSum_ReceivedRupiah->initialValue;
    }

    function OpenPage() {
        $this->TotalPages++;
        $Group = & $this->InitGroup();
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnInitialize", $this->Parent->Page_Header);
        if ($this->Parent->Page_Header->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Page_Header->Height;
        $Group->SetTotalControls("GetNextValue");
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnCalculate", $this->Parent->Page_Header);
        $Group->SetControls();
        $Group->Mode = 1;
        $Group->GroupType = "Page";
        $Group->PageTotalIndex = count($this->Groups);
        $this->mPageCurrentHeaderIndex = count($this->Groups);
        $this->Groups[] =  & $Group;
        $this->Pages[] =  count($this->Groups) == 2 ? 0 : count($this->Groups) - 1;
    }

    function OpenGroup($groupName) {
        $Group = "";
        $OpenFlag = false;
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnInitialize", $this->Parent->Report_Header);
            if ($this->Parent->Report_Header->Visible) 
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Header->Height;
                $Group->SetTotalControls("GetNextValue");
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnCalculate", $this->Parent->Report_Header);
            $Group->SetControls();
            $Group->Mode = 1;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->OpenPage();
        }
        if ($groupName == "ClientCompany") {
            $GroupClientCompany = & $this->InitGroup(true);
            $this->Parent->ClientCompany_Header->CCSEventResult = CCGetEvent($this->Parent->ClientCompany_Header->CCSEvents, "OnInitialize", $this->Parent->ClientCompany_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->ClientCompany_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->ClientCompany_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->ClientCompany_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->ClientCompany_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->ClientCompany_Header->Height;
                $GroupClientCompany->SetTotalControls("GetNextValue");
            $this->Parent->ClientCompany_Header->CCSEventResult = CCGetEvent($this->Parent->ClientCompany_Header->CCSEvents, "OnCalculate", $this->Parent->ClientCompany_Header);
            $GroupClientCompany->SetControls();
            $GroupClientCompany->Mode = 1;
            $GroupClientCompany->GroupType = "ClientCompany";
            $this->mClientCompanyCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $GroupClientCompany;
            $this->Parent->Sum_GrandTotalRupiah->Reset();
            $this->Parent->Sum_ReceivedRupiah->Reset();
        }
    }

    function ClosePage() {
        $Group = & $this->InitGroup();
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnInitialize", $this->Parent->Page_Footer);
        $Group->SetTotalControls("GetPrevValue");
        $Group->SyncWithHeader($this->Groups[$this->mPageCurrentHeaderIndex]);
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnCalculate", $this->Parent->Page_Footer);
        $Group->SetControls();
        $this->RestoreValues();
        $this->CurrentPageSize = 0;
        $Group->Mode = 2;
        $Group->GroupType = "Page";
        $this->Groups[] = & $Group;
    }

    function CloseGroup($groupName)
    {
        $Group = "";
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnInitialize", $this->Parent->Report_Footer);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->Report_Footer->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->Report_Footer->Height;
            if (($this->PageSize > 0) and $this->Parent->Report_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            $Group->SetTotalControls("GetPrevValue");
            $Group->SyncWithHeader($this->Groups[0]);
            if ($this->Parent->Report_Footer->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Footer->Height;
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnCalculate", $this->Parent->Report_Footer);
            $Group->SetControls();
            $this->RestoreValues();
            $Group->Mode = 2;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->ClosePage();
            return;
        }
        $GroupClientCompany = & $this->InitGroup(true);
        $this->Parent->ClientCompany_Footer->CCSEventResult = CCGetEvent($this->Parent->ClientCompany_Footer->CCSEvents, "OnInitialize", $this->Parent->ClientCompany_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->ClientCompany_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->ClientCompany_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->ClientCompany_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $GroupClientCompany->SetTotalControls("GetPrevValue");
        $GroupClientCompany->SyncWithHeader($this->Groups[$this->mClientCompanyCurrentHeaderIndex]);
        if ($this->Parent->ClientCompany_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->ClientCompany_Footer->Height;
        $this->Parent->ClientCompany_Footer->CCSEventResult = CCGetEvent($this->Parent->ClientCompany_Footer->CCSEvents, "OnCalculate", $this->Parent->ClientCompany_Footer);
        $GroupClientCompany->SetControls();
        $this->Parent->Sum_GrandTotalRupiah->Reset();
        $this->Parent->Sum_ReceivedRupiah->Reset();
        $this->RestoreValues();
        $GroupClientCompany->Mode = 2;
        $GroupClientCompany->GroupType ="ClientCompany";
        $this->Groups[] = & $GroupClientCompany;
    }

    function AddItem()
    {
        $Group = & $this->InitGroup(true);
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnInitialize", $this->Parent->Detail);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->Detail->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->Detail->Height;
        if (($this->PageSize > 0) and $this->Parent->Detail->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $this->TotalRows++;
        if ($this->LastDetailIndex)
            $PrevGroup = & $this->Groups[$this->LastDetailIndex];
        else
            $PrevGroup = "";
        $Group->SetTotalControls("", $PrevGroup);
        if ($this->Parent->Detail->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Detail->Height;
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnCalculate", $this->Parent->Detail);
        $Group->SetControls($PrevGroup);
        $this->LastDetailIndex = count($this->Groups);
        $this->Groups[] = & $Group;
    }
}
//End Grid GroupsCollection class

class clsReportGrid { //Grid Class @2-64989BB0

//Grid Variables @2-25C51F87

    public $ComponentType = "Report";
    public $PageSize;
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $CCSEvents = array();
    public $CCSEventResult;
    public $RelativePath = "";
    public $ViewMode = "Web";
    public $TemplateBlock;
    public $PageNumber;
    public $RowNumber;
    public $TotalRows;
    public $TotalPages;
    public $ControlsVisible = array();
    public $IsEmpty;
    public $Attributes;
    public $DetailBlock, $Detail;
    public $Report_FooterBlock, $Report_Footer;
    public $Report_HeaderBlock, $Report_Header;
    public $Page_FooterBlock, $Page_Footer;
    public $Page_HeaderBlock, $Page_Header;
    public $ClientCompany_HeaderBlock, $ClientCompany_Header;
    public $ClientCompany_FooterBlock, $ClientCompany_Footer;
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
    public $ClientCompany_HeaderControls, $ClientCompany_FooterControls;
    public $Sorter_due_date;
    public $Sorter_paid_date;
    public $Sorter_pay_invoice_Rate;
//End Grid Variables

//Class_Initialize Event @2-62620C6A
    function clsReportGrid($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Grid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->Detail = new clsSection($this);
        $MinPageSize = 0;
        $MaxSectionSize = 0;
        $this->Detail->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Detail->Height);
        $this->Report_Footer = new clsSection($this);
        $this->Report_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Report_Footer->Height);
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Footer->Height = 2;
        $MinPageSize += $this->Page_Footer->Height;
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->ClientCompany_Footer = new clsSection($this);
        $this->ClientCompany_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->ClientCompany_Footer->Height);
        $this->ClientCompany_Header = new clsSection($this);
        $this->ClientCompany_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->ClientCompany_Header->Height);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ViewMode = CCGetParam("ViewMode", "Print");
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else if($this->ViewMode == "Print") {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 50;
             else if ($PageSize == "0")
                $this->PageSize = 0;
             else 
                $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 40;
             else if ($PageSize == "0")
                $this->PageSize = 100;
             else 
                $this->PageSize = min(100, $PageSize);
        }
        $MinPageSize += $MaxSectionSize;
        if ($this->PageSize && $MinPageSize && $this->PageSize < $MinPageSize)
            $this->PageSize = $MinPageSize;
        $this->PageNumber = $this->ViewMode == "Print" ? 1 : intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0 ) {
            $this->PageNumber = 1;
        }
        $this->SorterName = CCGetParam("GridOrder", "");
        $this->SorterDirection = CCGetParam("GridDir", "");

        $this->Sorter_due_date = new clsSorter($this->ComponentName, "Sorter_due_date", $FileName, $this);
        $this->Sorter_paid_date = new clsSorter($this->ComponentName, "Sorter_paid_date", $FileName, $this);
        $this->Sorter_pay_invoice_Rate = new clsSorter($this->ComponentName, "Sorter_pay_invoice_Rate", $FileName, $this);
        $this->ClientCompany = new clsControl(ccsReportLabel, "ClientCompany", "ClientCompany", ccsText, "", "", $this);
        $this->proforma_h_id = new clsControl(ccsHidden, "proforma_h_id", "proforma_h_id", ccsInteger, "", CCGetRequestParam("proforma_h_id", ccsGet, NULL), $this);
        $this->due_date = new clsControl(ccsReportLabel, "due_date", "due_date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), "", $this);
        $this->GrandTotal = new clsControl(ccsReportLabel, "GrandTotal", "GrandTotal", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), "", $this);
        $this->Currency = new clsControl(ccsHidden, "Currency", "Currency", ccsInteger, "", CCGetRequestParam("Currency", ccsGet, NULL), $this);
        $this->ar_invoice_Rate = new clsControl(ccsReportLabel, "ar_invoice_Rate", "ar_invoice_Rate", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), "", $this);
        $this->paid_date = new clsControl(ccsReportLabel, "paid_date", "paid_date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), "", $this);
        $this->amount_paid = new clsControl(ccsReportLabel, "amount_paid", "amount_paid", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), "", $this);
        $this->pay_invoice_Rate = new clsControl(ccsReportLabel, "pay_invoice_Rate", "pay_invoice_Rate", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), "", $this);
        $this->lblReceivedRupiah = new clsControl(ccsReportLabel, "lblReceivedRupiah", "lblReceivedRupiah", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), "", $this);
        $this->InvoiceNo = new clsControl(ccsReportLabel, "InvoiceNo", "InvoiceNo", ccsText, "", "", $this);
        $this->lblCurrency = new clsControl(ccsReportLabel, "lblCurrency", "lblCurrency", ccsText, "", "", $this);
        $this->lblCurrency->IsEmptySource = true;
        $this->lblProforma = new clsControl(ccsReportLabel, "lblProforma", "lblProforma", ccsText, "", "", $this);
        $this->lblProforma->IsEmptySource = true;
        $this->lblGrandTotalRupiah = new clsControl(ccsReportLabel, "lblGrandTotalRupiah", "lblGrandTotalRupiah", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), "", $this);
        $this->Sum_GrandTotalRupiah = new clsControl(ccsReportLabel, "Sum_GrandTotalRupiah", "Sum_GrandTotalRupiah", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), "", $this);
        $this->Sum_GrandTotalRupiah->TotalFunction = "Sum";
        $this->Sum_ReceivedRupiah = new clsControl(ccsReportLabel, "Sum_ReceivedRupiah", "Sum_ReceivedRupiah", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), "", $this);
        $this->Sum_ReceivedRupiah->TotalFunction = "Sum";
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->TotalSum_GrandTotalRupiah = new clsControl(ccsReportLabel, "TotalSum_GrandTotalRupiah", "TotalSum_GrandTotalRupiah", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), "", $this);
        $this->TotalSum_GrandTotalRupiah->TotalFunction = "Sum";
        $this->TotalSum_ReceivedRupiah = new clsControl(ccsReportLabel, "TotalSum_ReceivedRupiah", "TotalSum_ReceivedRupiah", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), "", $this);
        $this->TotalSum_ReceivedRupiah->TotalFunction = "Sum";
        $this->PageBreak = new clsPanel("PageBreak", $this);
        $this->Report_CurrentDate = new clsControl(ccsReportLabel, "Report_CurrentDate", "Report_CurrentDate", ccsText, array('ShortDate'), "", $this);
        $this->Report_CurrentPage = new clsControl(ccsReportLabel, "Report_CurrentPage", "Report_CurrentPage", ccsInteger, "", "", $this);
        $this->Report_TotalPages = new clsControl(ccsReportLabel, "Report_TotalPages", "Report_TotalPages", ccsInteger, "", "", $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @2-1A59E157
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ClientCompany->Errors->Count());
        $errors = ($errors || $this->proforma_h_id->Errors->Count());
        $errors = ($errors || $this->due_date->Errors->Count());
        $errors = ($errors || $this->GrandTotal->Errors->Count());
        $errors = ($errors || $this->Currency->Errors->Count());
        $errors = ($errors || $this->ar_invoice_Rate->Errors->Count());
        $errors = ($errors || $this->paid_date->Errors->Count());
        $errors = ($errors || $this->amount_paid->Errors->Count());
        $errors = ($errors || $this->pay_invoice_Rate->Errors->Count());
        $errors = ($errors || $this->lblReceivedRupiah->Errors->Count());
        $errors = ($errors || $this->InvoiceNo->Errors->Count());
        $errors = ($errors || $this->lblCurrency->Errors->Count());
        $errors = ($errors || $this->lblProforma->Errors->Count());
        $errors = ($errors || $this->lblGrandTotalRupiah->Errors->Count());
        $errors = ($errors || $this->Sum_GrandTotalRupiah->Errors->Count());
        $errors = ($errors || $this->Sum_ReceivedRupiah->Errors->Count());
        $errors = ($errors || $this->TotalSum_GrandTotalRupiah->Errors->Count());
        $errors = ($errors || $this->TotalSum_ReceivedRupiah->Errors->Count());
        $errors = ($errors || $this->Report_CurrentDate->Errors->Count());
        $errors = ($errors || $this->Report_CurrentPage->Errors->Count());
        $errors = ($errors || $this->Report_TotalPages->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-4832B9A9
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ClientCompany->Errors->ToString());
        $errors = ComposeStrings($errors, $this->proforma_h_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->due_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GrandTotal->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Currency->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ar_invoice_Rate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->paid_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->amount_paid->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pay_invoice_Rate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblReceivedRupiah->Errors->ToString());
        $errors = ComposeStrings($errors, $this->InvoiceNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblCurrency->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblProforma->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblGrandTotalRupiah->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Sum_GrandTotalRupiah->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Sum_ReceivedRupiah->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalSum_GrandTotalRupiah->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalSum_ReceivedRupiah->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentPage->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_TotalPages->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-FF924A45
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls_due_date"] = CCGetFromGet("s_due_date", NULL);
        $this->DataSource->Parameters["urls_due_date1"] = CCGetFromGet("s_due_date1", NULL);
        $this->DataSource->Parameters["urls_rec_date"] = CCGetFromGet("s_rec_date", NULL);
        $this->DataSource->Parameters["urls_rec_date1"] = CCGetFromGet("s_rec_date1", NULL);
        $this->DataSource->Parameters["urls_ClientID"] = CCGetFromGet("s_ClientID", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $ClientCompanyKey = "";
        $Groups = new clsGroupsCollectionGrid($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->ClientCompany->SetValue($this->DataSource->ClientCompany->GetValue());
            $this->proforma_h_id->SetValue($this->DataSource->proforma_h_id->GetValue());
            $this->due_date->SetValue($this->DataSource->due_date->GetValue());
            $this->GrandTotal->SetValue($this->DataSource->GrandTotal->GetValue());
            $this->Currency->SetValue($this->DataSource->Currency->GetValue());
            $this->ar_invoice_Rate->SetValue($this->DataSource->ar_invoice_Rate->GetValue());
            $this->paid_date->SetValue($this->DataSource->paid_date->GetValue());
            $this->amount_paid->SetValue($this->DataSource->amount_paid->GetValue());
            $this->pay_invoice_Rate->SetValue($this->DataSource->pay_invoice_Rate->GetValue());
            $this->lblReceivedRupiah->SetValue($this->DataSource->lblReceivedRupiah->GetValue());
            $this->InvoiceNo->SetValue($this->DataSource->InvoiceNo->GetValue());
            $this->lblGrandTotalRupiah->SetValue($this->DataSource->lblGrandTotalRupiah->GetValue());
            $this->Sum_GrandTotalRupiah->SetValue($this->DataSource->Sum_GrandTotalRupiah->GetValue());
            $this->Sum_ReceivedRupiah->SetValue($this->DataSource->Sum_ReceivedRupiah->GetValue());
            $this->TotalSum_GrandTotalRupiah->SetValue($this->DataSource->TotalSum_GrandTotalRupiah->GetValue());
            $this->TotalSum_ReceivedRupiah->SetValue($this->DataSource->TotalSum_ReceivedRupiah->GetValue());
            $this->lblCurrency->SetValue("");
            $this->lblProforma->SetValue("");
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $ClientCompanyKey != $this->DataSource->f("ClientCompany")) {
                $Groups->OpenGroup("ClientCompany");
            }
            $Groups->AddItem();
            $ClientCompanyKey = $this->DataSource->f("ClientCompany");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $ClientCompanyKey != $this->DataSource->f("ClientCompany")) {
                $Groups->CloseGroup("ClientCompany");
            }
        }
        if (!count($Groups->Groups)) 
            $Groups->OpenGroup("Report");
        else
            $this->NoRecords->Visible = false;
        $Groups->CloseGroup("Report");
        $this->TotalPages = $Groups->TotalPages;
        $this->TotalRows = $Groups->TotalRows;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $this->Attributes->Show();
        $ReportBlock = "Report " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;

        if($this->CheckErrors()) {
            $Tpl->replaceblock("", $this->GetErrors());
            $Tpl->block_path = $ParentPath;
            return;
        } else {
            $items = & $Groups->Groups;
            $i = $Groups->Pages[min($this->PageNumber, $Groups->TotalPages) - 1];
            $this->ControlsVisible["ClientCompany"] = $this->ClientCompany->Visible;
            $this->ControlsVisible["proforma_h_id"] = $this->proforma_h_id->Visible;
            $this->ControlsVisible["due_date"] = $this->due_date->Visible;
            $this->ControlsVisible["GrandTotal"] = $this->GrandTotal->Visible;
            $this->ControlsVisible["Currency"] = $this->Currency->Visible;
            $this->ControlsVisible["ar_invoice_Rate"] = $this->ar_invoice_Rate->Visible;
            $this->ControlsVisible["paid_date"] = $this->paid_date->Visible;
            $this->ControlsVisible["amount_paid"] = $this->amount_paid->Visible;
            $this->ControlsVisible["pay_invoice_Rate"] = $this->pay_invoice_Rate->Visible;
            $this->ControlsVisible["lblReceivedRupiah"] = $this->lblReceivedRupiah->Visible;
            $this->ControlsVisible["InvoiceNo"] = $this->InvoiceNo->Visible;
            $this->ControlsVisible["lblCurrency"] = $this->lblCurrency->Visible;
            $this->ControlsVisible["lblProforma"] = $this->lblProforma->Visible;
            $this->ControlsVisible["lblGrandTotalRupiah"] = $this->lblGrandTotalRupiah->Visible;
            $this->ControlsVisible["Sum_GrandTotalRupiah"] = $this->Sum_GrandTotalRupiah->Visible;
            $this->ControlsVisible["Sum_ReceivedRupiah"] = $this->Sum_ReceivedRupiah->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->proforma_h_id->SetValue($items[$i]->proforma_h_id);
                        $this->proforma_h_id->Attributes->RestoreFromArray($items[$i]->_proforma_h_idAttributes);
                        $this->due_date->SetValue($items[$i]->due_date);
                        $this->due_date->Attributes->RestoreFromArray($items[$i]->_due_dateAttributes);
                        $this->GrandTotal->SetValue($items[$i]->GrandTotal);
                        $this->GrandTotal->Attributes->RestoreFromArray($items[$i]->_GrandTotalAttributes);
                        $this->Currency->SetValue($items[$i]->Currency);
                        $this->Currency->Attributes->RestoreFromArray($items[$i]->_CurrencyAttributes);
                        $this->ar_invoice_Rate->SetValue($items[$i]->ar_invoice_Rate);
                        $this->ar_invoice_Rate->Attributes->RestoreFromArray($items[$i]->_ar_invoice_RateAttributes);
                        $this->paid_date->SetValue($items[$i]->paid_date);
                        $this->paid_date->Attributes->RestoreFromArray($items[$i]->_paid_dateAttributes);
                        $this->amount_paid->SetValue($items[$i]->amount_paid);
                        $this->amount_paid->Attributes->RestoreFromArray($items[$i]->_amount_paidAttributes);
                        $this->pay_invoice_Rate->SetValue($items[$i]->pay_invoice_Rate);
                        $this->pay_invoice_Rate->Attributes->RestoreFromArray($items[$i]->_pay_invoice_RateAttributes);
                        $this->lblReceivedRupiah->SetValue($items[$i]->lblReceivedRupiah);
                        $this->lblReceivedRupiah->Attributes->RestoreFromArray($items[$i]->_lblReceivedRupiahAttributes);
                        $this->InvoiceNo->SetValue($items[$i]->InvoiceNo);
                        $this->InvoiceNo->Attributes->RestoreFromArray($items[$i]->_InvoiceNoAttributes);
                        $this->lblCurrency->SetValue($items[$i]->lblCurrency);
                        $this->lblCurrency->Attributes->RestoreFromArray($items[$i]->_lblCurrencyAttributes);
                        $this->lblProforma->SetValue($items[$i]->lblProforma);
                        $this->lblProforma->Attributes->RestoreFromArray($items[$i]->_lblProformaAttributes);
                        $this->lblGrandTotalRupiah->SetValue($items[$i]->lblGrandTotalRupiah);
                        $this->lblGrandTotalRupiah->Attributes->RestoreFromArray($items[$i]->_lblGrandTotalRupiahAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->proforma_h_id->Show();
                        $this->due_date->Show();
                        $this->GrandTotal->Show();
                        $this->Currency->Show();
                        $this->ar_invoice_Rate->Show();
                        $this->paid_date->Show();
                        $this->amount_paid->Show();
                        $this->pay_invoice_Rate->Show();
                        $this->lblReceivedRupiah->Show();
                        $this->InvoiceNo->Show();
                        $this->lblCurrency->Show();
                        $this->lblProforma->Show();
                        $this->lblGrandTotalRupiah->Show();
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                        if ($this->Detail->Visible)
                            $Tpl->parseto("Section Detail", true, "Section Detail");
                        break;
                    case "Report":
                        if ($items[$i]->Mode == 1) {
                            $this->Report_Header->CCSEventResult = CCGetEvent($this->Report_Header->CCSEvents, "BeforeShow", $this->Report_Header);
                            if ($this->Report_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->TotalSum_GrandTotalRupiah->SetText(CCFormatNumber($items[$i]->TotalSum_GrandTotalRupiah, array(False, 2, Null, Null, False, "", "", 1, True, "")), ccsFloat);
                            $this->TotalSum_GrandTotalRupiah->Attributes->RestoreFromArray($items[$i]->_TotalSum_GrandTotalRupiahAttributes);
                            $this->TotalSum_ReceivedRupiah->SetText(CCFormatNumber($items[$i]->TotalSum_ReceivedRupiah, array(False, 2, Null, Null, False, "", "", 1, True, "")), ccsFloat);
                            $this->TotalSum_ReceivedRupiah->Attributes->RestoreFromArray($items[$i]->_TotalSum_ReceivedRupiahAttributes);
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
                                $this->TotalSum_GrandTotalRupiah->Show();
                                $this->TotalSum_ReceivedRupiah->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "Page":
                        if ($items[$i]->Mode == 1) {
                            $this->Page_Header->CCSEventResult = CCGetEvent($this->Page_Header->CCSEvents, "BeforeShow", $this->Page_Header);
                            if ($this->Page_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Header";
                                $this->Attributes->Show();
                                $this->Sorter_due_date->Show();
                                $this->Sorter_paid_date->Show();
                                $this->Sorter_pay_invoice_Rate->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2 && !$this->UseClientPaging || $items[$i]->Mode == 1 && $this->UseClientPaging) {
                            $this->PageBreak->Visible = (($i < count($items) - 1) && ($this->ViewMode == "Print"));
                            $this->Report_CurrentDate->SetValue(CCFormatDate(CCGetDateArray(), $this->Report_CurrentDate->Format));
                            $this->Report_CurrentDate->Attributes->RestoreFromArray($items[$i]->_Report_CurrentDateAttributes);
                            $this->Report_CurrentPage->SetValue($items[$i]->PageNumber);
                            $this->Report_CurrentPage->Attributes->RestoreFromArray($items[$i]->_Report_CurrentPageAttributes);
                            $this->Report_TotalPages->SetValue($Groups->TotalPages);
                            $this->Report_TotalPages->Attributes->RestoreFromArray($items[$i]->_Report_TotalPagesAttributes);
                            $this->Navigator->PageNumber = $items[$i]->PageNumber;
                            $this->Navigator->TotalPages = $Groups->TotalPages;
                            $this->Navigator->Visible = ("Print" != $this->ViewMode);
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
                                $this->PageBreak->Show();
                                $this->Report_CurrentDate->Show();
                                $this->Report_CurrentPage->Show();
                                $this->Report_TotalPages->Show();
                                $this->Navigator->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "ClientCompany":
                        if ($items[$i]->Mode == 1) {
                            $this->ClientCompany->SetValue($items[$i]->ClientCompany);
                            $this->ClientCompany->Attributes->RestoreFromArray($items[$i]->_ClientCompanyAttributes);
                            $this->ClientCompany_Header->CCSEventResult = CCGetEvent($this->ClientCompany_Header->CCSEvents, "BeforeShow", $this->ClientCompany_Header);
                            if ($this->ClientCompany_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section ClientCompany_Header";
                                $this->Attributes->Show();
                                $this->ClientCompany->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section ClientCompany_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->Sum_GrandTotalRupiah->SetText(CCFormatNumber($items[$i]->Sum_GrandTotalRupiah, array(False, 2, Null, Null, False, "", "", 1, True, "")), ccsFloat);
                            $this->Sum_GrandTotalRupiah->Attributes->RestoreFromArray($items[$i]->_Sum_GrandTotalRupiahAttributes);
                            $this->Sum_ReceivedRupiah->SetText(CCFormatNumber($items[$i]->Sum_ReceivedRupiah, array(False, 2, Null, Null, False, "", "", 1, True, "")), ccsFloat);
                            $this->Sum_ReceivedRupiah->Attributes->RestoreFromArray($items[$i]->_Sum_ReceivedRupiahAttributes);
                            $this->ClientCompany_Footer->CCSEventResult = CCGetEvent($this->ClientCompany_Footer->CCSEvents, "BeforeShow", $this->ClientCompany_Footer);
                            if ($this->ClientCompany_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section ClientCompany_Footer";
                                $this->Sum_GrandTotalRupiah->Show();
                                $this->Sum_ReceivedRupiah->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section ClientCompany_Footer", true, "Section Detail");
                            }
                        }
                        break;
                }
                $i++;
            } while ($i < count($items) && ($this->ViewMode == "Print" ||  !($i > 1 && $items[$i]->GroupType == 'Page' && $items[$i]->Mode == 1)));
            $Tpl->block_path = $ParentPath;
            $Tpl->parse($ReportBlock);
            $this->DataSource->close();
        }

    }
//End Show Method

} //End Grid Class @2-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @2-7708C172

//DataSource Variables @2-2B3529D1
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $ClientCompany;
    public $proforma_h_id;
    public $due_date;
    public $GrandTotal;
    public $Currency;
    public $ar_invoice_Rate;
    public $paid_date;
    public $amount_paid;
    public $pay_invoice_Rate;
    public $lblReceivedRupiah;
    public $InvoiceNo;
    public $lblGrandTotalRupiah;
    public $Sum_GrandTotalRupiah;
    public $Sum_ReceivedRupiah;
    public $TotalSum_GrandTotalRupiah;
    public $TotalSum_ReceivedRupiah;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-7EE2D1A3
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report Grid";
        $this->Initialize();
        $this->ClientCompany = new clsField("ClientCompany", ccsText, "");
        
        $this->proforma_h_id = new clsField("proforma_h_id", ccsInteger, "");
        
        $this->due_date = new clsField("due_date", ccsDate, $this->DateFormat);
        
        $this->GrandTotal = new clsField("GrandTotal", ccsFloat, "");
        
        $this->Currency = new clsField("Currency", ccsInteger, "");
        
        $this->ar_invoice_Rate = new clsField("ar_invoice_Rate", ccsFloat, "");
        
        $this->paid_date = new clsField("paid_date", ccsDate, $this->DateFormat);
        
        $this->amount_paid = new clsField("amount_paid", ccsFloat, "");
        
        $this->pay_invoice_Rate = new clsField("pay_invoice_Rate", ccsFloat, "");
        
        $this->lblReceivedRupiah = new clsField("lblReceivedRupiah", ccsFloat, "");
        
        $this->InvoiceNo = new clsField("InvoiceNo", ccsText, "");
        
        $this->lblGrandTotalRupiah = new clsField("lblGrandTotalRupiah", ccsFloat, "");
        
        $this->Sum_GrandTotalRupiah = new clsField("Sum_GrandTotalRupiah", ccsFloat, "");
        
        $this->Sum_ReceivedRupiah = new clsField("Sum_ReceivedRupiah", ccsFloat, "");
        
        $this->TotalSum_GrandTotalRupiah = new clsField("TotalSum_GrandTotalRupiah", ccsFloat, "");
        
        $this->TotalSum_ReceivedRupiah = new clsField("TotalSum_ReceivedRupiah", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-ECA8BF5E
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_due_date" => array("due_date", ""), 
            "Sorter_paid_date" => array("paid_date", ""), 
            "Sorter_pay_invoice_Rate" => array("pay_invoice.Rate", "")));
    }
//End SetOrder Method

//Prepare Method @2-78B24316
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_due_date", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_due_date"], "", false);
        $this->wp->AddParameter("2", "urls_due_date1", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_due_date1"], "", false);
        $this->wp->AddParameter("3", "urls_rec_date", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_rec_date"], "", false);
        $this->wp->AddParameter("4", "urls_rec_date1", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_rec_date1"], "", false);
        $this->wp->AddParameter("5", "urls_ClientID", ccsInteger, "", "", $this->Parameters["urls_ClientID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opGreaterThanOrEqual, "ar_invoice.due_date", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsDate),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opLessThanOrEqual, "ar_invoice.due_date", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsDate),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opGreaterThanOrEqual, "pay_invoice.paid_date", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsDate),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opLessThanOrEqual, "pay_invoice.paid_date", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsDate),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "ar_invoice.ClientID", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opOR(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]);
    }
//End Prepare Method

//Open Method @2-E3400795
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT ClientCompany, InvoiceDate, (ar_invoice.GrandTotal*ar_invoice.Rate) AS GrandTotalRupiah, (amount_paid*pay_invoice.rate) AS ReceivedRupiah,\n\n" .
        "ar_invoice.*, paid_date, amount_paid, pay_invoice.Rate AS pay_invoice_Rate, InvoiceNo \n\n" .
        "FROM ((ar_invoice INNER JOIN tbladminist_invoice_h ON\n\n" .
        "ar_invoice.invoice_h_id = tbladminist_invoice_h.Invoice_H_ID) LEFT JOIN pay_invoice ON\n\n" .
        "pay_invoice.ar_invoice_id = ar_invoice.ar_invoice_id) LEFT JOIN tbladminist_client ON\n\n" .
        "ar_invoice.ClientID = tbladminist_client.ClientID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "tbladminist_client.ClientCompany asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-D05BFA7F
    function SetValues()
    {
        $this->ClientCompany->SetDBValue($this->f("ClientCompany"));
        $this->proforma_h_id->SetDBValue(trim($this->f("proforma_h_id")));
        $this->due_date->SetDBValue(trim($this->f("due_date")));
        $this->GrandTotal->SetDBValue(trim($this->f("GrandTotal")));
        $this->Currency->SetDBValue(trim($this->f("Currency")));
        $this->ar_invoice_Rate->SetDBValue(trim($this->f("Rate")));
        $this->paid_date->SetDBValue(trim($this->f("paid_date")));
        $this->amount_paid->SetDBValue(trim($this->f("amount_paid")));
        $this->pay_invoice_Rate->SetDBValue(trim($this->f("pay_invoice_Rate")));
        $this->lblReceivedRupiah->SetDBValue(trim($this->f("ReceivedRupiah")));
        $this->InvoiceNo->SetDBValue($this->f("InvoiceNo"));
        $this->lblGrandTotalRupiah->SetDBValue(trim($this->f("GrandTotalRupiah")));
        $this->Sum_GrandTotalRupiah->SetDBValue(trim($this->f("GrandTotalRupiah")));
        $this->Sum_ReceivedRupiah->SetDBValue(trim($this->f("ReceivedRupiah")));
        $this->TotalSum_GrandTotalRupiah->SetDBValue(trim($this->f("GrandTotalRupiah")));
        $this->TotalSum_ReceivedRupiah->SetDBValue(trim($this->f("ReceivedRupiah")));
    }
//End SetValues Method

} //End GridDataSource Class @2-FCB6E20C



//Initialize Page @1-45785C72
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
$TemplateFileName = "ReportInv.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-E1485058
include_once("./ReportInv_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B6CB8500
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Grid = new clsReportGrid("", $MainPage);
$Report_Print = new clsControl(ccsLink, "Report_Print", "Report_Print", ccsText, "", CCGetRequestParam("Report_Print", ccsGet, NULL), $MainPage);
$Report_Print->Page = "ReportInv.php";
$MainPage->Grid = & $Grid;
$MainPage->Report_Print = & $Report_Print;
$Report_Print->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Report_Print->Parameters = CCAddParam($Report_Print->Parameters, "ViewMode", "Print");
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

//Show Page @1-9DAFADAE
$Grid->Show();
$Report_Print->Show();
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
