<?php
//Include Common Files @1-65E0752B
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "PrintInvoice.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//tbladminist_invoice_h_tbl ReportGroup class @2-15A0F649
class clsReportGrouptbladminist_invoice_h_tbl {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $Company, $_CompanyAttributes;
    public $ClientCompany, $_ClientCompanyAttributes;
    public $Invoice_D_ID, $_Invoice_D_IDAttributes;
    public $tbladminist_invoice_d_Invoice_H_ID, $_tbladminist_invoice_d_Invoice_H_IDAttributes;
    public $tbladminist_invoice_d_InvoicePar, $_tbladminist_invoice_d_InvoiceParAttributes;
    public $Qty, $_QtyAttributes;
    public $Unit, $_UnitAttributes;
    public $CollectID, $_CollectIDAttributes;
    public $CollectCode, $_CollectCodeAttributes;
    public $UnitPrice, $_UnitPriceAttributes;
    public $Total, $_TotalAttributes;
    public $tbladminist_invoice_h_Invoice_H_ID, $_tbladminist_invoice_h_Invoice_H_IDAttributes;
    public $Invoice_SH_ID, $_Invoice_SH_IDAttributes;
    public $tbladminist_invoice_h_InvoicePar, $_tbladminist_invoice_h_InvoiceParAttributes;
    public $Quotation_H_ID, $_Quotation_H_IDAttributes;
    public $Proforma_H_ID, $_Proforma_H_IDAttributes;
    public $InvoiceDate, $_InvoiceDateAttributes;
    public $ClientOrderRef, $_ClientOrderRefAttributes;
    public $GayaOrderRef, $_GayaOrderRefAttributes;
    public $DeliveryTermID, $_DeliveryTermIDAttributes;
    public $PaymentTermID, $_PaymentTermIDAttributes;
    public $DueDate, $_DueDateAttributes;
    public $ClientID, $_ClientIDAttributes;
    public $AddressID, $_AddressIDAttributes;
    public $InvoiceContactID, $_InvoiceContactIDAttributes;
    public $DeliveryContactID, $_DeliveryContactIDAttributes;
    public $SubTotal, $_SubTotalAttributes;
    public $Discount, $_DiscountAttributes;
    public $Packaging, $_PackagingAttributes;
    public $ShippingCost, $_ShippingCostAttributes;
    public $GrandTotal, $_GrandTotalAttributes;
    public $PaymentBankTransferred, $_PaymentBankTransferredAttributes;
    public $Balance, $_BalanceAttributes;
    public $InvoiceNo, $_InvoiceNoAttributes;
    public $Report_CurrentDate, $_Report_CurrentDateAttributes;
    public $Report_CurrentPage, $_Report_CurrentPageAttributes;
    public $Report_TotalPages, $_Report_TotalPagesAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;

    function clsReportGrouptbladminist_invoice_h_tbl(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->Company = $this->Parent->Company->Value;
        $this->ClientCompany = $this->Parent->ClientCompany->Value;
        $this->Invoice_D_ID = $this->Parent->Invoice_D_ID->Value;
        $this->tbladminist_invoice_d_Invoice_H_ID = $this->Parent->tbladminist_invoice_d_Invoice_H_ID->Value;
        $this->tbladminist_invoice_d_InvoicePar = $this->Parent->tbladminist_invoice_d_InvoicePar->Value;
        $this->Qty = $this->Parent->Qty->Value;
        $this->Unit = $this->Parent->Unit->Value;
        $this->CollectID = $this->Parent->CollectID->Value;
        $this->CollectCode = $this->Parent->CollectCode->Value;
        $this->UnitPrice = $this->Parent->UnitPrice->Value;
        $this->Total = $this->Parent->Total->Value;
        $this->tbladminist_invoice_h_Invoice_H_ID = $this->Parent->tbladminist_invoice_h_Invoice_H_ID->Value;
        $this->Invoice_SH_ID = $this->Parent->Invoice_SH_ID->Value;
        $this->tbladminist_invoice_h_InvoicePar = $this->Parent->tbladminist_invoice_h_InvoicePar->Value;
        $this->Quotation_H_ID = $this->Parent->Quotation_H_ID->Value;
        $this->Proforma_H_ID = $this->Parent->Proforma_H_ID->Value;
        $this->InvoiceDate = $this->Parent->InvoiceDate->Value;
        $this->ClientOrderRef = $this->Parent->ClientOrderRef->Value;
        $this->GayaOrderRef = $this->Parent->GayaOrderRef->Value;
        $this->DeliveryTermID = $this->Parent->DeliveryTermID->Value;
        $this->PaymentTermID = $this->Parent->PaymentTermID->Value;
        $this->DueDate = $this->Parent->DueDate->Value;
        $this->ClientID = $this->Parent->ClientID->Value;
        $this->AddressID = $this->Parent->AddressID->Value;
        $this->InvoiceContactID = $this->Parent->InvoiceContactID->Value;
        $this->DeliveryContactID = $this->Parent->DeliveryContactID->Value;
        $this->SubTotal = $this->Parent->SubTotal->Value;
        $this->Discount = $this->Parent->Discount->Value;
        $this->Packaging = $this->Parent->Packaging->Value;
        $this->ShippingCost = $this->Parent->ShippingCost->Value;
        $this->GrandTotal = $this->Parent->GrandTotal->Value;
        $this->PaymentBankTransferred = $this->Parent->PaymentBankTransferred->Value;
        $this->Balance = $this->Parent->Balance->Value;
        $this->InvoiceNo = $this->Parent->InvoiceNo->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->_CompanyAttributes = $this->Parent->Company->Attributes->GetAsArray();
        $this->_ClientCompanyAttributes = $this->Parent->ClientCompany->Attributes->GetAsArray();
        $this->_Invoice_D_IDAttributes = $this->Parent->Invoice_D_ID->Attributes->GetAsArray();
        $this->_tbladminist_invoice_d_Invoice_H_IDAttributes = $this->Parent->tbladminist_invoice_d_Invoice_H_ID->Attributes->GetAsArray();
        $this->_tbladminist_invoice_d_InvoiceParAttributes = $this->Parent->tbladminist_invoice_d_InvoicePar->Attributes->GetAsArray();
        $this->_QtyAttributes = $this->Parent->Qty->Attributes->GetAsArray();
        $this->_UnitAttributes = $this->Parent->Unit->Attributes->GetAsArray();
        $this->_CollectIDAttributes = $this->Parent->CollectID->Attributes->GetAsArray();
        $this->_CollectCodeAttributes = $this->Parent->CollectCode->Attributes->GetAsArray();
        $this->_UnitPriceAttributes = $this->Parent->UnitPrice->Attributes->GetAsArray();
        $this->_TotalAttributes = $this->Parent->Total->Attributes->GetAsArray();
        $this->_tbladminist_invoice_h_Invoice_H_IDAttributes = $this->Parent->tbladminist_invoice_h_Invoice_H_ID->Attributes->GetAsArray();
        $this->_Invoice_SH_IDAttributes = $this->Parent->Invoice_SH_ID->Attributes->GetAsArray();
        $this->_tbladminist_invoice_h_InvoiceParAttributes = $this->Parent->tbladminist_invoice_h_InvoicePar->Attributes->GetAsArray();
        $this->_Quotation_H_IDAttributes = $this->Parent->Quotation_H_ID->Attributes->GetAsArray();
        $this->_Proforma_H_IDAttributes = $this->Parent->Proforma_H_ID->Attributes->GetAsArray();
        $this->_InvoiceDateAttributes = $this->Parent->InvoiceDate->Attributes->GetAsArray();
        $this->_ClientOrderRefAttributes = $this->Parent->ClientOrderRef->Attributes->GetAsArray();
        $this->_GayaOrderRefAttributes = $this->Parent->GayaOrderRef->Attributes->GetAsArray();
        $this->_DeliveryTermIDAttributes = $this->Parent->DeliveryTermID->Attributes->GetAsArray();
        $this->_PaymentTermIDAttributes = $this->Parent->PaymentTermID->Attributes->GetAsArray();
        $this->_DueDateAttributes = $this->Parent->DueDate->Attributes->GetAsArray();
        $this->_ClientIDAttributes = $this->Parent->ClientID->Attributes->GetAsArray();
        $this->_AddressIDAttributes = $this->Parent->AddressID->Attributes->GetAsArray();
        $this->_InvoiceContactIDAttributes = $this->Parent->InvoiceContactID->Attributes->GetAsArray();
        $this->_DeliveryContactIDAttributes = $this->Parent->DeliveryContactID->Attributes->GetAsArray();
        $this->_SubTotalAttributes = $this->Parent->SubTotal->Attributes->GetAsArray();
        $this->_DiscountAttributes = $this->Parent->Discount->Attributes->GetAsArray();
        $this->_PackagingAttributes = $this->Parent->Packaging->Attributes->GetAsArray();
        $this->_ShippingCostAttributes = $this->Parent->ShippingCost->Attributes->GetAsArray();
        $this->_GrandTotalAttributes = $this->Parent->GrandTotal->Attributes->GetAsArray();
        $this->_PaymentBankTransferredAttributes = $this->Parent->PaymentBankTransferred->Attributes->GetAsArray();
        $this->_BalanceAttributes = $this->Parent->Balance->Attributes->GetAsArray();
        $this->_InvoiceNoAttributes = $this->Parent->InvoiceNo->Attributes->GetAsArray();
        $this->_Report_CurrentDateAttributes = $this->Parent->Report_CurrentDate->Attributes->GetAsArray();
        $this->_Report_CurrentPageAttributes = $this->Parent->Report_CurrentPage->Attributes->GetAsArray();
        $this->_Report_TotalPagesAttributes = $this->Parent->Report_TotalPages->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $this->Company = $Header->Company;
        $Header->_CompanyAttributes = $this->_CompanyAttributes;
        $this->Parent->Company->Value = $Header->Company;
        $this->Parent->Company->Attributes->RestoreFromArray($Header->_CompanyAttributes);
        $this->ClientCompany = $Header->ClientCompany;
        $Header->_ClientCompanyAttributes = $this->_ClientCompanyAttributes;
        $this->Parent->ClientCompany->Value = $Header->ClientCompany;
        $this->Parent->ClientCompany->Attributes->RestoreFromArray($Header->_ClientCompanyAttributes);
        $this->Invoice_D_ID = $Header->Invoice_D_ID;
        $Header->_Invoice_D_IDAttributes = $this->_Invoice_D_IDAttributes;
        $this->Parent->Invoice_D_ID->Value = $Header->Invoice_D_ID;
        $this->Parent->Invoice_D_ID->Attributes->RestoreFromArray($Header->_Invoice_D_IDAttributes);
        $this->tbladminist_invoice_d_Invoice_H_ID = $Header->tbladminist_invoice_d_Invoice_H_ID;
        $Header->_tbladminist_invoice_d_Invoice_H_IDAttributes = $this->_tbladminist_invoice_d_Invoice_H_IDAttributes;
        $this->Parent->tbladminist_invoice_d_Invoice_H_ID->Value = $Header->tbladminist_invoice_d_Invoice_H_ID;
        $this->Parent->tbladminist_invoice_d_Invoice_H_ID->Attributes->RestoreFromArray($Header->_tbladminist_invoice_d_Invoice_H_IDAttributes);
        $this->tbladminist_invoice_d_InvoicePar = $Header->tbladminist_invoice_d_InvoicePar;
        $Header->_tbladminist_invoice_d_InvoiceParAttributes = $this->_tbladminist_invoice_d_InvoiceParAttributes;
        $this->Parent->tbladminist_invoice_d_InvoicePar->Value = $Header->tbladminist_invoice_d_InvoicePar;
        $this->Parent->tbladminist_invoice_d_InvoicePar->Attributes->RestoreFromArray($Header->_tbladminist_invoice_d_InvoiceParAttributes);
        $this->Qty = $Header->Qty;
        $Header->_QtyAttributes = $this->_QtyAttributes;
        $this->Parent->Qty->Value = $Header->Qty;
        $this->Parent->Qty->Attributes->RestoreFromArray($Header->_QtyAttributes);
        $this->Unit = $Header->Unit;
        $Header->_UnitAttributes = $this->_UnitAttributes;
        $this->Parent->Unit->Value = $Header->Unit;
        $this->Parent->Unit->Attributes->RestoreFromArray($Header->_UnitAttributes);
        $this->CollectID = $Header->CollectID;
        $Header->_CollectIDAttributes = $this->_CollectIDAttributes;
        $this->Parent->CollectID->Value = $Header->CollectID;
        $this->Parent->CollectID->Attributes->RestoreFromArray($Header->_CollectIDAttributes);
        $this->CollectCode = $Header->CollectCode;
        $Header->_CollectCodeAttributes = $this->_CollectCodeAttributes;
        $this->Parent->CollectCode->Value = $Header->CollectCode;
        $this->Parent->CollectCode->Attributes->RestoreFromArray($Header->_CollectCodeAttributes);
        $this->UnitPrice = $Header->UnitPrice;
        $Header->_UnitPriceAttributes = $this->_UnitPriceAttributes;
        $this->Parent->UnitPrice->Value = $Header->UnitPrice;
        $this->Parent->UnitPrice->Attributes->RestoreFromArray($Header->_UnitPriceAttributes);
        $this->Total = $Header->Total;
        $Header->_TotalAttributes = $this->_TotalAttributes;
        $this->Parent->Total->Value = $Header->Total;
        $this->Parent->Total->Attributes->RestoreFromArray($Header->_TotalAttributes);
        $this->tbladminist_invoice_h_Invoice_H_ID = $Header->tbladminist_invoice_h_Invoice_H_ID;
        $Header->_tbladminist_invoice_h_Invoice_H_IDAttributes = $this->_tbladminist_invoice_h_Invoice_H_IDAttributes;
        $this->Parent->tbladminist_invoice_h_Invoice_H_ID->Value = $Header->tbladminist_invoice_h_Invoice_H_ID;
        $this->Parent->tbladminist_invoice_h_Invoice_H_ID->Attributes->RestoreFromArray($Header->_tbladminist_invoice_h_Invoice_H_IDAttributes);
        $this->Invoice_SH_ID = $Header->Invoice_SH_ID;
        $Header->_Invoice_SH_IDAttributes = $this->_Invoice_SH_IDAttributes;
        $this->Parent->Invoice_SH_ID->Value = $Header->Invoice_SH_ID;
        $this->Parent->Invoice_SH_ID->Attributes->RestoreFromArray($Header->_Invoice_SH_IDAttributes);
        $this->tbladminist_invoice_h_InvoicePar = $Header->tbladminist_invoice_h_InvoicePar;
        $Header->_tbladminist_invoice_h_InvoiceParAttributes = $this->_tbladminist_invoice_h_InvoiceParAttributes;
        $this->Parent->tbladminist_invoice_h_InvoicePar->Value = $Header->tbladminist_invoice_h_InvoicePar;
        $this->Parent->tbladminist_invoice_h_InvoicePar->Attributes->RestoreFromArray($Header->_tbladminist_invoice_h_InvoiceParAttributes);
        $this->Quotation_H_ID = $Header->Quotation_H_ID;
        $Header->_Quotation_H_IDAttributes = $this->_Quotation_H_IDAttributes;
        $this->Parent->Quotation_H_ID->Value = $Header->Quotation_H_ID;
        $this->Parent->Quotation_H_ID->Attributes->RestoreFromArray($Header->_Quotation_H_IDAttributes);
        $this->Proforma_H_ID = $Header->Proforma_H_ID;
        $Header->_Proforma_H_IDAttributes = $this->_Proforma_H_IDAttributes;
        $this->Parent->Proforma_H_ID->Value = $Header->Proforma_H_ID;
        $this->Parent->Proforma_H_ID->Attributes->RestoreFromArray($Header->_Proforma_H_IDAttributes);
        $this->InvoiceDate = $Header->InvoiceDate;
        $Header->_InvoiceDateAttributes = $this->_InvoiceDateAttributes;
        $this->Parent->InvoiceDate->Value = $Header->InvoiceDate;
        $this->Parent->InvoiceDate->Attributes->RestoreFromArray($Header->_InvoiceDateAttributes);
        $this->ClientOrderRef = $Header->ClientOrderRef;
        $Header->_ClientOrderRefAttributes = $this->_ClientOrderRefAttributes;
        $this->Parent->ClientOrderRef->Value = $Header->ClientOrderRef;
        $this->Parent->ClientOrderRef->Attributes->RestoreFromArray($Header->_ClientOrderRefAttributes);
        $this->GayaOrderRef = $Header->GayaOrderRef;
        $Header->_GayaOrderRefAttributes = $this->_GayaOrderRefAttributes;
        $this->Parent->GayaOrderRef->Value = $Header->GayaOrderRef;
        $this->Parent->GayaOrderRef->Attributes->RestoreFromArray($Header->_GayaOrderRefAttributes);
        $this->DeliveryTermID = $Header->DeliveryTermID;
        $Header->_DeliveryTermIDAttributes = $this->_DeliveryTermIDAttributes;
        $this->Parent->DeliveryTermID->Value = $Header->DeliveryTermID;
        $this->Parent->DeliveryTermID->Attributes->RestoreFromArray($Header->_DeliveryTermIDAttributes);
        $this->PaymentTermID = $Header->PaymentTermID;
        $Header->_PaymentTermIDAttributes = $this->_PaymentTermIDAttributes;
        $this->Parent->PaymentTermID->Value = $Header->PaymentTermID;
        $this->Parent->PaymentTermID->Attributes->RestoreFromArray($Header->_PaymentTermIDAttributes);
        $this->DueDate = $Header->DueDate;
        $Header->_DueDateAttributes = $this->_DueDateAttributes;
        $this->Parent->DueDate->Value = $Header->DueDate;
        $this->Parent->DueDate->Attributes->RestoreFromArray($Header->_DueDateAttributes);
        $this->ClientID = $Header->ClientID;
        $Header->_ClientIDAttributes = $this->_ClientIDAttributes;
        $this->Parent->ClientID->Value = $Header->ClientID;
        $this->Parent->ClientID->Attributes->RestoreFromArray($Header->_ClientIDAttributes);
        $this->AddressID = $Header->AddressID;
        $Header->_AddressIDAttributes = $this->_AddressIDAttributes;
        $this->Parent->AddressID->Value = $Header->AddressID;
        $this->Parent->AddressID->Attributes->RestoreFromArray($Header->_AddressIDAttributes);
        $this->InvoiceContactID = $Header->InvoiceContactID;
        $Header->_InvoiceContactIDAttributes = $this->_InvoiceContactIDAttributes;
        $this->Parent->InvoiceContactID->Value = $Header->InvoiceContactID;
        $this->Parent->InvoiceContactID->Attributes->RestoreFromArray($Header->_InvoiceContactIDAttributes);
        $this->DeliveryContactID = $Header->DeliveryContactID;
        $Header->_DeliveryContactIDAttributes = $this->_DeliveryContactIDAttributes;
        $this->Parent->DeliveryContactID->Value = $Header->DeliveryContactID;
        $this->Parent->DeliveryContactID->Attributes->RestoreFromArray($Header->_DeliveryContactIDAttributes);
        $this->SubTotal = $Header->SubTotal;
        $Header->_SubTotalAttributes = $this->_SubTotalAttributes;
        $this->Parent->SubTotal->Value = $Header->SubTotal;
        $this->Parent->SubTotal->Attributes->RestoreFromArray($Header->_SubTotalAttributes);
        $this->Discount = $Header->Discount;
        $Header->_DiscountAttributes = $this->_DiscountAttributes;
        $this->Parent->Discount->Value = $Header->Discount;
        $this->Parent->Discount->Attributes->RestoreFromArray($Header->_DiscountAttributes);
        $this->Packaging = $Header->Packaging;
        $Header->_PackagingAttributes = $this->_PackagingAttributes;
        $this->Parent->Packaging->Value = $Header->Packaging;
        $this->Parent->Packaging->Attributes->RestoreFromArray($Header->_PackagingAttributes);
        $this->ShippingCost = $Header->ShippingCost;
        $Header->_ShippingCostAttributes = $this->_ShippingCostAttributes;
        $this->Parent->ShippingCost->Value = $Header->ShippingCost;
        $this->Parent->ShippingCost->Attributes->RestoreFromArray($Header->_ShippingCostAttributes);
        $this->GrandTotal = $Header->GrandTotal;
        $Header->_GrandTotalAttributes = $this->_GrandTotalAttributes;
        $this->Parent->GrandTotal->Value = $Header->GrandTotal;
        $this->Parent->GrandTotal->Attributes->RestoreFromArray($Header->_GrandTotalAttributes);
        $this->PaymentBankTransferred = $Header->PaymentBankTransferred;
        $Header->_PaymentBankTransferredAttributes = $this->_PaymentBankTransferredAttributes;
        $this->Parent->PaymentBankTransferred->Value = $Header->PaymentBankTransferred;
        $this->Parent->PaymentBankTransferred->Attributes->RestoreFromArray($Header->_PaymentBankTransferredAttributes);
        $this->Balance = $Header->Balance;
        $Header->_BalanceAttributes = $this->_BalanceAttributes;
        $this->Parent->Balance->Value = $Header->Balance;
        $this->Parent->Balance->Attributes->RestoreFromArray($Header->_BalanceAttributes);
        $this->InvoiceNo = $Header->InvoiceNo;
        $Header->_InvoiceNoAttributes = $this->_InvoiceNoAttributes;
        $this->Parent->InvoiceNo->Value = $Header->InvoiceNo;
        $this->Parent->InvoiceNo->Attributes->RestoreFromArray($Header->_InvoiceNoAttributes);
    }
    function ChangeTotalControls() {
    }
}
//End tbladminist_invoice_h_tbl ReportGroup class

//tbladminist_invoice_h_tbl GroupsCollection class @2-C161CDAC
class clsGroupsCollectiontbladminist_invoice_h_tbl {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectiontbladminist_invoice_h_tbl(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGrouptbladminist_invoice_h_tbl($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->Company->Value = $this->Parent->Company->initialValue;
        $this->Parent->ClientCompany->Value = $this->Parent->ClientCompany->initialValue;
        $this->Parent->Invoice_D_ID->Value = $this->Parent->Invoice_D_ID->initialValue;
        $this->Parent->tbladminist_invoice_d_Invoice_H_ID->Value = $this->Parent->tbladminist_invoice_d_Invoice_H_ID->initialValue;
        $this->Parent->tbladminist_invoice_d_InvoicePar->Value = $this->Parent->tbladminist_invoice_d_InvoicePar->initialValue;
        $this->Parent->Qty->Value = $this->Parent->Qty->initialValue;
        $this->Parent->Unit->Value = $this->Parent->Unit->initialValue;
        $this->Parent->CollectID->Value = $this->Parent->CollectID->initialValue;
        $this->Parent->CollectCode->Value = $this->Parent->CollectCode->initialValue;
        $this->Parent->UnitPrice->Value = $this->Parent->UnitPrice->initialValue;
        $this->Parent->Total->Value = $this->Parent->Total->initialValue;
        $this->Parent->tbladminist_invoice_h_Invoice_H_ID->Value = $this->Parent->tbladminist_invoice_h_Invoice_H_ID->initialValue;
        $this->Parent->Invoice_SH_ID->Value = $this->Parent->Invoice_SH_ID->initialValue;
        $this->Parent->tbladminist_invoice_h_InvoicePar->Value = $this->Parent->tbladminist_invoice_h_InvoicePar->initialValue;
        $this->Parent->Quotation_H_ID->Value = $this->Parent->Quotation_H_ID->initialValue;
        $this->Parent->Proforma_H_ID->Value = $this->Parent->Proforma_H_ID->initialValue;
        $this->Parent->InvoiceDate->Value = $this->Parent->InvoiceDate->initialValue;
        $this->Parent->ClientOrderRef->Value = $this->Parent->ClientOrderRef->initialValue;
        $this->Parent->GayaOrderRef->Value = $this->Parent->GayaOrderRef->initialValue;
        $this->Parent->DeliveryTermID->Value = $this->Parent->DeliveryTermID->initialValue;
        $this->Parent->PaymentTermID->Value = $this->Parent->PaymentTermID->initialValue;
        $this->Parent->DueDate->Value = $this->Parent->DueDate->initialValue;
        $this->Parent->ClientID->Value = $this->Parent->ClientID->initialValue;
        $this->Parent->AddressID->Value = $this->Parent->AddressID->initialValue;
        $this->Parent->InvoiceContactID->Value = $this->Parent->InvoiceContactID->initialValue;
        $this->Parent->DeliveryContactID->Value = $this->Parent->DeliveryContactID->initialValue;
        $this->Parent->SubTotal->Value = $this->Parent->SubTotal->initialValue;
        $this->Parent->Discount->Value = $this->Parent->Discount->initialValue;
        $this->Parent->Packaging->Value = $this->Parent->Packaging->initialValue;
        $this->Parent->ShippingCost->Value = $this->Parent->ShippingCost->initialValue;
        $this->Parent->GrandTotal->Value = $this->Parent->GrandTotal->initialValue;
        $this->Parent->PaymentBankTransferred->Value = $this->Parent->PaymentBankTransferred->initialValue;
        $this->Parent->Balance->Value = $this->Parent->Balance->initialValue;
        $this->Parent->InvoiceNo->Value = $this->Parent->InvoiceNo->initialValue;
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
//End tbladminist_invoice_h_tbl GroupsCollection class

class clsReporttbladminist_invoice_h_tbl { //tbladminist_invoice_h_tbl Class @2-CDC2E347

//tbladminist_invoice_h_tbl Variables @2-944D286E

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
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
//End tbladminist_invoice_h_tbl Variables

//Class_Initialize Event @2-EF107144
    function clsReporttbladminist_invoice_h_tbl($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tbladminist_invoice_h_tbl";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->Detail = new clsSection($this);
        $MinPageSize = 0;
        $MaxSectionSize = 0;
        $this->Detail->Height = 34;
        $MaxSectionSize = max($MaxSectionSize, $this->Detail->Height);
        $this->Report_Footer = new clsSection($this);
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Footer->Height = 2;
        $MinPageSize += $this->Page_Footer->Height;
        $this->Page_Header = new clsSection($this);
        $this->Errors = new clsErrors();
        $this->DataSource = new clstbladminist_invoice_h_tblDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ViewMode = CCGetParam("ViewMode", "Web");
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

        $this->Company = new clsControl(ccsReportLabel, "Company", "Company", ccsText, "", "", $this);
        $this->ClientCompany = new clsControl(ccsReportLabel, "ClientCompany", "ClientCompany", ccsText, "", "", $this);
        $this->Invoice_D_ID = new clsControl(ccsReportLabel, "Invoice_D_ID", "Invoice_D_ID", ccsInteger, "", "", $this);
        $this->tbladminist_invoice_d_Invoice_H_ID = new clsControl(ccsReportLabel, "tbladminist_invoice_d_Invoice_H_ID", "tbladminist_invoice_d_Invoice_H_ID", ccsInteger, "", "", $this);
        $this->tbladminist_invoice_d_InvoicePar = new clsControl(ccsReportLabel, "tbladminist_invoice_d_InvoicePar", "tbladminist_invoice_d_InvoicePar", ccsText, "", "", $this);
        $this->Qty = new clsControl(ccsReportLabel, "Qty", "Qty", ccsInteger, "", "", $this);
        $this->Unit = new clsControl(ccsReportLabel, "Unit", "Unit", ccsText, "", "", $this);
        $this->CollectID = new clsControl(ccsReportLabel, "CollectID", "CollectID", ccsInteger, "", "", $this);
        $this->CollectCode = new clsControl(ccsReportLabel, "CollectCode", "CollectCode", ccsText, "", "", $this);
        $this->UnitPrice = new clsControl(ccsReportLabel, "UnitPrice", "UnitPrice", ccsFloat, "", "", $this);
        $this->Total = new clsControl(ccsReportLabel, "Total", "Total", ccsFloat, "", "", $this);
        $this->tbladminist_invoice_h_Invoice_H_ID = new clsControl(ccsReportLabel, "tbladminist_invoice_h_Invoice_H_ID", "tbladminist_invoice_h_Invoice_H_ID", ccsInteger, "", "", $this);
        $this->Invoice_SH_ID = new clsControl(ccsReportLabel, "Invoice_SH_ID", "Invoice_SH_ID", ccsInteger, "", "", $this);
        $this->tbladminist_invoice_h_InvoicePar = new clsControl(ccsReportLabel, "tbladminist_invoice_h_InvoicePar", "tbladminist_invoice_h_InvoicePar", ccsText, "", "", $this);
        $this->Quotation_H_ID = new clsControl(ccsReportLabel, "Quotation_H_ID", "Quotation_H_ID", ccsInteger, "", "", $this);
        $this->Proforma_H_ID = new clsControl(ccsReportLabel, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", "", $this);
        $this->InvoiceDate = new clsControl(ccsReportLabel, "InvoiceDate", "InvoiceDate", ccsDate, $DefaultDateFormat, "", $this);
        $this->ClientOrderRef = new clsControl(ccsReportLabel, "ClientOrderRef", "ClientOrderRef", ccsText, "", "", $this);
        $this->GayaOrderRef = new clsControl(ccsReportLabel, "GayaOrderRef", "GayaOrderRef", ccsText, "", "", $this);
        $this->DeliveryTermID = new clsControl(ccsReportLabel, "DeliveryTermID", "DeliveryTermID", ccsInteger, "", "", $this);
        $this->PaymentTermID = new clsControl(ccsReportLabel, "PaymentTermID", "PaymentTermID", ccsInteger, "", "", $this);
        $this->DueDate = new clsControl(ccsReportLabel, "DueDate", "DueDate", ccsDate, $DefaultDateFormat, "", $this);
        $this->ClientID = new clsControl(ccsReportLabel, "ClientID", "ClientID", ccsInteger, "", "", $this);
        $this->AddressID = new clsControl(ccsReportLabel, "AddressID", "AddressID", ccsInteger, "", "", $this);
        $this->InvoiceContactID = new clsControl(ccsReportLabel, "InvoiceContactID", "InvoiceContactID", ccsInteger, "", "", $this);
        $this->DeliveryContactID = new clsControl(ccsReportLabel, "DeliveryContactID", "DeliveryContactID", ccsInteger, "", "", $this);
        $this->SubTotal = new clsControl(ccsReportLabel, "SubTotal", "SubTotal", ccsFloat, "", "", $this);
        $this->Discount = new clsControl(ccsReportLabel, "Discount", "Discount", ccsFloat, "", "", $this);
        $this->Packaging = new clsControl(ccsReportLabel, "Packaging", "Packaging", ccsFloat, "", "", $this);
        $this->ShippingCost = new clsControl(ccsReportLabel, "ShippingCost", "ShippingCost", ccsFloat, "", "", $this);
        $this->GrandTotal = new clsControl(ccsReportLabel, "GrandTotal", "GrandTotal", ccsFloat, "", "", $this);
        $this->PaymentBankTransferred = new clsControl(ccsReportLabel, "PaymentBankTransferred", "PaymentBankTransferred", ccsFloat, "", "", $this);
        $this->Balance = new clsControl(ccsReportLabel, "Balance", "Balance", ccsFloat, "", "", $this);
        $this->InvoiceNo = new clsControl(ccsReportLabel, "InvoiceNo", "InvoiceNo", ccsText, "", "", $this);
        $this->NoRecords = new clsPanel("NoRecords", $this);
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

//CheckErrors Method @2-6BCF0F8E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Company->Errors->Count());
        $errors = ($errors || $this->ClientCompany->Errors->Count());
        $errors = ($errors || $this->Invoice_D_ID->Errors->Count());
        $errors = ($errors || $this->tbladminist_invoice_d_Invoice_H_ID->Errors->Count());
        $errors = ($errors || $this->tbladminist_invoice_d_InvoicePar->Errors->Count());
        $errors = ($errors || $this->Qty->Errors->Count());
        $errors = ($errors || $this->Unit->Errors->Count());
        $errors = ($errors || $this->CollectID->Errors->Count());
        $errors = ($errors || $this->CollectCode->Errors->Count());
        $errors = ($errors || $this->UnitPrice->Errors->Count());
        $errors = ($errors || $this->Total->Errors->Count());
        $errors = ($errors || $this->tbladminist_invoice_h_Invoice_H_ID->Errors->Count());
        $errors = ($errors || $this->Invoice_SH_ID->Errors->Count());
        $errors = ($errors || $this->tbladminist_invoice_h_InvoicePar->Errors->Count());
        $errors = ($errors || $this->Quotation_H_ID->Errors->Count());
        $errors = ($errors || $this->Proforma_H_ID->Errors->Count());
        $errors = ($errors || $this->InvoiceDate->Errors->Count());
        $errors = ($errors || $this->ClientOrderRef->Errors->Count());
        $errors = ($errors || $this->GayaOrderRef->Errors->Count());
        $errors = ($errors || $this->DeliveryTermID->Errors->Count());
        $errors = ($errors || $this->PaymentTermID->Errors->Count());
        $errors = ($errors || $this->DueDate->Errors->Count());
        $errors = ($errors || $this->ClientID->Errors->Count());
        $errors = ($errors || $this->AddressID->Errors->Count());
        $errors = ($errors || $this->InvoiceContactID->Errors->Count());
        $errors = ($errors || $this->DeliveryContactID->Errors->Count());
        $errors = ($errors || $this->SubTotal->Errors->Count());
        $errors = ($errors || $this->Discount->Errors->Count());
        $errors = ($errors || $this->Packaging->Errors->Count());
        $errors = ($errors || $this->ShippingCost->Errors->Count());
        $errors = ($errors || $this->GrandTotal->Errors->Count());
        $errors = ($errors || $this->PaymentBankTransferred->Errors->Count());
        $errors = ($errors || $this->Balance->Errors->Count());
        $errors = ($errors || $this->InvoiceNo->Errors->Count());
        $errors = ($errors || $this->Report_CurrentDate->Errors->Count());
        $errors = ($errors || $this->Report_CurrentPage->Errors->Count());
        $errors = ($errors || $this->Report_TotalPages->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-4E277EF2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Company->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientCompany->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Invoice_D_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tbladminist_invoice_d_Invoice_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tbladminist_invoice_d_InvoicePar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Unit->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->UnitPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Total->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tbladminist_invoice_h_Invoice_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Invoice_SH_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tbladminist_invoice_h_InvoicePar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Quotation_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Proforma_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->InvoiceDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientOrderRef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GayaOrderRef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryTermID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PaymentTermID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DueDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->AddressID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->InvoiceContactID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryContactID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SubTotal->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Discount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Packaging->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ShippingCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GrandTotal->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PaymentBankTransferred->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Balance->Errors->ToString());
        $errors = ComposeStrings($errors, $this->InvoiceNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentPage->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_TotalPages->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-E77C34FA
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;


        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $Groups = new clsGroupsCollectiontbladminist_invoice_h_tbl($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->Company->SetValue($this->DataSource->Company->GetValue());
            $this->ClientCompany->SetValue($this->DataSource->ClientCompany->GetValue());
            $this->Invoice_D_ID->SetValue($this->DataSource->Invoice_D_ID->GetValue());
            $this->tbladminist_invoice_d_Invoice_H_ID->SetValue($this->DataSource->tbladminist_invoice_d_Invoice_H_ID->GetValue());
            $this->tbladminist_invoice_d_InvoicePar->SetValue($this->DataSource->tbladminist_invoice_d_InvoicePar->GetValue());
            $this->Qty->SetValue($this->DataSource->Qty->GetValue());
            $this->Unit->SetValue($this->DataSource->Unit->GetValue());
            $this->CollectID->SetValue($this->DataSource->CollectID->GetValue());
            $this->CollectCode->SetValue($this->DataSource->CollectCode->GetValue());
            $this->UnitPrice->SetValue($this->DataSource->UnitPrice->GetValue());
            $this->Total->SetValue($this->DataSource->Total->GetValue());
            $this->tbladminist_invoice_h_Invoice_H_ID->SetValue($this->DataSource->tbladminist_invoice_h_Invoice_H_ID->GetValue());
            $this->Invoice_SH_ID->SetValue($this->DataSource->Invoice_SH_ID->GetValue());
            $this->tbladminist_invoice_h_InvoicePar->SetValue($this->DataSource->tbladminist_invoice_h_InvoicePar->GetValue());
            $this->Quotation_H_ID->SetValue($this->DataSource->Quotation_H_ID->GetValue());
            $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
            $this->InvoiceDate->SetValue($this->DataSource->InvoiceDate->GetValue());
            $this->ClientOrderRef->SetValue($this->DataSource->ClientOrderRef->GetValue());
            $this->GayaOrderRef->SetValue($this->DataSource->GayaOrderRef->GetValue());
            $this->DeliveryTermID->SetValue($this->DataSource->DeliveryTermID->GetValue());
            $this->PaymentTermID->SetValue($this->DataSource->PaymentTermID->GetValue());
            $this->DueDate->SetValue($this->DataSource->DueDate->GetValue());
            $this->ClientID->SetValue($this->DataSource->ClientID->GetValue());
            $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
            $this->InvoiceContactID->SetValue($this->DataSource->InvoiceContactID->GetValue());
            $this->DeliveryContactID->SetValue($this->DataSource->DeliveryContactID->GetValue());
            $this->SubTotal->SetValue($this->DataSource->SubTotal->GetValue());
            $this->Discount->SetValue($this->DataSource->Discount->GetValue());
            $this->Packaging->SetValue($this->DataSource->Packaging->GetValue());
            $this->ShippingCost->SetValue($this->DataSource->ShippingCost->GetValue());
            $this->GrandTotal->SetValue($this->DataSource->GrandTotal->GetValue());
            $this->PaymentBankTransferred->SetValue($this->DataSource->PaymentBankTransferred->GetValue());
            $this->Balance->SetValue($this->DataSource->Balance->GetValue());
            $this->InvoiceNo->SetValue($this->DataSource->InvoiceNo->GetValue());
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            $Groups->AddItem();
            $is_next_record = $this->DataSource->next_record();
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
            $this->ControlsVisible["Company"] = $this->Company->Visible;
            $this->ControlsVisible["ClientCompany"] = $this->ClientCompany->Visible;
            $this->ControlsVisible["Invoice_D_ID"] = $this->Invoice_D_ID->Visible;
            $this->ControlsVisible["tbladminist_invoice_d_Invoice_H_ID"] = $this->tbladminist_invoice_d_Invoice_H_ID->Visible;
            $this->ControlsVisible["tbladminist_invoice_d_InvoicePar"] = $this->tbladminist_invoice_d_InvoicePar->Visible;
            $this->ControlsVisible["Qty"] = $this->Qty->Visible;
            $this->ControlsVisible["Unit"] = $this->Unit->Visible;
            $this->ControlsVisible["CollectID"] = $this->CollectID->Visible;
            $this->ControlsVisible["CollectCode"] = $this->CollectCode->Visible;
            $this->ControlsVisible["UnitPrice"] = $this->UnitPrice->Visible;
            $this->ControlsVisible["Total"] = $this->Total->Visible;
            $this->ControlsVisible["tbladminist_invoice_h_Invoice_H_ID"] = $this->tbladminist_invoice_h_Invoice_H_ID->Visible;
            $this->ControlsVisible["Invoice_SH_ID"] = $this->Invoice_SH_ID->Visible;
            $this->ControlsVisible["tbladminist_invoice_h_InvoicePar"] = $this->tbladminist_invoice_h_InvoicePar->Visible;
            $this->ControlsVisible["Quotation_H_ID"] = $this->Quotation_H_ID->Visible;
            $this->ControlsVisible["Proforma_H_ID"] = $this->Proforma_H_ID->Visible;
            $this->ControlsVisible["InvoiceDate"] = $this->InvoiceDate->Visible;
            $this->ControlsVisible["ClientOrderRef"] = $this->ClientOrderRef->Visible;
            $this->ControlsVisible["GayaOrderRef"] = $this->GayaOrderRef->Visible;
            $this->ControlsVisible["DeliveryTermID"] = $this->DeliveryTermID->Visible;
            $this->ControlsVisible["PaymentTermID"] = $this->PaymentTermID->Visible;
            $this->ControlsVisible["DueDate"] = $this->DueDate->Visible;
            $this->ControlsVisible["ClientID"] = $this->ClientID->Visible;
            $this->ControlsVisible["AddressID"] = $this->AddressID->Visible;
            $this->ControlsVisible["InvoiceContactID"] = $this->InvoiceContactID->Visible;
            $this->ControlsVisible["DeliveryContactID"] = $this->DeliveryContactID->Visible;
            $this->ControlsVisible["SubTotal"] = $this->SubTotal->Visible;
            $this->ControlsVisible["Discount"] = $this->Discount->Visible;
            $this->ControlsVisible["Packaging"] = $this->Packaging->Visible;
            $this->ControlsVisible["ShippingCost"] = $this->ShippingCost->Visible;
            $this->ControlsVisible["GrandTotal"] = $this->GrandTotal->Visible;
            $this->ControlsVisible["PaymentBankTransferred"] = $this->PaymentBankTransferred->Visible;
            $this->ControlsVisible["Balance"] = $this->Balance->Visible;
            $this->ControlsVisible["InvoiceNo"] = $this->InvoiceNo->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->Company->SetValue($items[$i]->Company);
                        $this->Company->Attributes->RestoreFromArray($items[$i]->_CompanyAttributes);
                        $this->ClientCompany->SetValue($items[$i]->ClientCompany);
                        $this->ClientCompany->Attributes->RestoreFromArray($items[$i]->_ClientCompanyAttributes);
                        $this->Invoice_D_ID->SetValue($items[$i]->Invoice_D_ID);
                        $this->Invoice_D_ID->Attributes->RestoreFromArray($items[$i]->_Invoice_D_IDAttributes);
                        $this->tbladminist_invoice_d_Invoice_H_ID->SetValue($items[$i]->tbladminist_invoice_d_Invoice_H_ID);
                        $this->tbladminist_invoice_d_Invoice_H_ID->Attributes->RestoreFromArray($items[$i]->_tbladminist_invoice_d_Invoice_H_IDAttributes);
                        $this->tbladminist_invoice_d_InvoicePar->SetValue($items[$i]->tbladminist_invoice_d_InvoicePar);
                        $this->tbladminist_invoice_d_InvoicePar->Attributes->RestoreFromArray($items[$i]->_tbladminist_invoice_d_InvoiceParAttributes);
                        $this->Qty->SetValue($items[$i]->Qty);
                        $this->Qty->Attributes->RestoreFromArray($items[$i]->_QtyAttributes);
                        $this->Unit->SetValue($items[$i]->Unit);
                        $this->Unit->Attributes->RestoreFromArray($items[$i]->_UnitAttributes);
                        $this->CollectID->SetValue($items[$i]->CollectID);
                        $this->CollectID->Attributes->RestoreFromArray($items[$i]->_CollectIDAttributes);
                        $this->CollectCode->SetValue($items[$i]->CollectCode);
                        $this->CollectCode->Attributes->RestoreFromArray($items[$i]->_CollectCodeAttributes);
                        $this->UnitPrice->SetValue($items[$i]->UnitPrice);
                        $this->UnitPrice->Attributes->RestoreFromArray($items[$i]->_UnitPriceAttributes);
                        $this->Total->SetValue($items[$i]->Total);
                        $this->Total->Attributes->RestoreFromArray($items[$i]->_TotalAttributes);
                        $this->tbladminist_invoice_h_Invoice_H_ID->SetValue($items[$i]->tbladminist_invoice_h_Invoice_H_ID);
                        $this->tbladminist_invoice_h_Invoice_H_ID->Attributes->RestoreFromArray($items[$i]->_tbladminist_invoice_h_Invoice_H_IDAttributes);
                        $this->Invoice_SH_ID->SetValue($items[$i]->Invoice_SH_ID);
                        $this->Invoice_SH_ID->Attributes->RestoreFromArray($items[$i]->_Invoice_SH_IDAttributes);
                        $this->tbladminist_invoice_h_InvoicePar->SetValue($items[$i]->tbladminist_invoice_h_InvoicePar);
                        $this->tbladminist_invoice_h_InvoicePar->Attributes->RestoreFromArray($items[$i]->_tbladminist_invoice_h_InvoiceParAttributes);
                        $this->Quotation_H_ID->SetValue($items[$i]->Quotation_H_ID);
                        $this->Quotation_H_ID->Attributes->RestoreFromArray($items[$i]->_Quotation_H_IDAttributes);
                        $this->Proforma_H_ID->SetValue($items[$i]->Proforma_H_ID);
                        $this->Proforma_H_ID->Attributes->RestoreFromArray($items[$i]->_Proforma_H_IDAttributes);
                        $this->InvoiceDate->SetValue($items[$i]->InvoiceDate);
                        $this->InvoiceDate->Attributes->RestoreFromArray($items[$i]->_InvoiceDateAttributes);
                        $this->ClientOrderRef->SetValue($items[$i]->ClientOrderRef);
                        $this->ClientOrderRef->Attributes->RestoreFromArray($items[$i]->_ClientOrderRefAttributes);
                        $this->GayaOrderRef->SetValue($items[$i]->GayaOrderRef);
                        $this->GayaOrderRef->Attributes->RestoreFromArray($items[$i]->_GayaOrderRefAttributes);
                        $this->DeliveryTermID->SetValue($items[$i]->DeliveryTermID);
                        $this->DeliveryTermID->Attributes->RestoreFromArray($items[$i]->_DeliveryTermIDAttributes);
                        $this->PaymentTermID->SetValue($items[$i]->PaymentTermID);
                        $this->PaymentTermID->Attributes->RestoreFromArray($items[$i]->_PaymentTermIDAttributes);
                        $this->DueDate->SetValue($items[$i]->DueDate);
                        $this->DueDate->Attributes->RestoreFromArray($items[$i]->_DueDateAttributes);
                        $this->ClientID->SetValue($items[$i]->ClientID);
                        $this->ClientID->Attributes->RestoreFromArray($items[$i]->_ClientIDAttributes);
                        $this->AddressID->SetValue($items[$i]->AddressID);
                        $this->AddressID->Attributes->RestoreFromArray($items[$i]->_AddressIDAttributes);
                        $this->InvoiceContactID->SetValue($items[$i]->InvoiceContactID);
                        $this->InvoiceContactID->Attributes->RestoreFromArray($items[$i]->_InvoiceContactIDAttributes);
                        $this->DeliveryContactID->SetValue($items[$i]->DeliveryContactID);
                        $this->DeliveryContactID->Attributes->RestoreFromArray($items[$i]->_DeliveryContactIDAttributes);
                        $this->SubTotal->SetValue($items[$i]->SubTotal);
                        $this->SubTotal->Attributes->RestoreFromArray($items[$i]->_SubTotalAttributes);
                        $this->Discount->SetValue($items[$i]->Discount);
                        $this->Discount->Attributes->RestoreFromArray($items[$i]->_DiscountAttributes);
                        $this->Packaging->SetValue($items[$i]->Packaging);
                        $this->Packaging->Attributes->RestoreFromArray($items[$i]->_PackagingAttributes);
                        $this->ShippingCost->SetValue($items[$i]->ShippingCost);
                        $this->ShippingCost->Attributes->RestoreFromArray($items[$i]->_ShippingCostAttributes);
                        $this->GrandTotal->SetValue($items[$i]->GrandTotal);
                        $this->GrandTotal->Attributes->RestoreFromArray($items[$i]->_GrandTotalAttributes);
                        $this->PaymentBankTransferred->SetValue($items[$i]->PaymentBankTransferred);
                        $this->PaymentBankTransferred->Attributes->RestoreFromArray($items[$i]->_PaymentBankTransferredAttributes);
                        $this->Balance->SetValue($items[$i]->Balance);
                        $this->Balance->Attributes->RestoreFromArray($items[$i]->_BalanceAttributes);
                        $this->InvoiceNo->SetValue($items[$i]->InvoiceNo);
                        $this->InvoiceNo->Attributes->RestoreFromArray($items[$i]->_InvoiceNoAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->Company->Show();
                        $this->ClientCompany->Show();
                        $this->Invoice_D_ID->Show();
                        $this->tbladminist_invoice_d_Invoice_H_ID->Show();
                        $this->tbladminist_invoice_d_InvoicePar->Show();
                        $this->Qty->Show();
                        $this->Unit->Show();
                        $this->CollectID->Show();
                        $this->CollectCode->Show();
                        $this->UnitPrice->Show();
                        $this->Total->Show();
                        $this->tbladminist_invoice_h_Invoice_H_ID->Show();
                        $this->Invoice_SH_ID->Show();
                        $this->tbladminist_invoice_h_InvoicePar->Show();
                        $this->Quotation_H_ID->Show();
                        $this->Proforma_H_ID->Show();
                        $this->InvoiceDate->Show();
                        $this->ClientOrderRef->Show();
                        $this->GayaOrderRef->Show();
                        $this->DeliveryTermID->Show();
                        $this->PaymentTermID->Show();
                        $this->DueDate->Show();
                        $this->ClientID->Show();
                        $this->AddressID->Show();
                        $this->InvoiceContactID->Show();
                        $this->DeliveryContactID->Show();
                        $this->SubTotal->Show();
                        $this->Discount->Show();
                        $this->Packaging->Show();
                        $this->ShippingCost->Show();
                        $this->GrandTotal->Show();
                        $this->PaymentBankTransferred->Show();
                        $this->Balance->Show();
                        $this->InvoiceNo->Show();
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
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
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
                }
                $i++;
            } while ($i < count($items) && ($this->ViewMode == "Print" ||  !($i > 1 && $items[$i]->GroupType == 'Page' && $items[$i]->Mode == 1)));
            $Tpl->block_path = $ParentPath;
            $Tpl->parse($ReportBlock);
            $this->DataSource->close();
        }

    }
//End Show Method

} //End tbladminist_invoice_h_tbl Class @2-FCB6E20C

class clstbladminist_invoice_h_tblDataSource extends clsDBGayaFusionAll {  //tbladminist_invoice_h_tblDataSource Class @2-6FA365FE

//DataSource Variables @2-23038DB5
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $Company;
    public $ClientCompany;
    public $Invoice_D_ID;
    public $tbladminist_invoice_d_Invoice_H_ID;
    public $tbladminist_invoice_d_InvoicePar;
    public $Qty;
    public $Unit;
    public $CollectID;
    public $CollectCode;
    public $UnitPrice;
    public $Total;
    public $tbladminist_invoice_h_Invoice_H_ID;
    public $Invoice_SH_ID;
    public $tbladminist_invoice_h_InvoicePar;
    public $Quotation_H_ID;
    public $Proforma_H_ID;
    public $InvoiceDate;
    public $ClientOrderRef;
    public $GayaOrderRef;
    public $DeliveryTermID;
    public $PaymentTermID;
    public $DueDate;
    public $ClientID;
    public $AddressID;
    public $InvoiceContactID;
    public $DeliveryContactID;
    public $SubTotal;
    public $Discount;
    public $Packaging;
    public $ShippingCost;
    public $GrandTotal;
    public $PaymentBankTransferred;
    public $Balance;
    public $InvoiceNo;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-74E6EA94
    function clstbladminist_invoice_h_tblDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report tbladminist_invoice_h_tbl";
        $this->Initialize();
        $this->Company = new clsField("Company", ccsText, "");
        
        $this->ClientCompany = new clsField("ClientCompany", ccsText, "");
        
        $this->Invoice_D_ID = new clsField("Invoice_D_ID", ccsInteger, "");
        
        $this->tbladminist_invoice_d_Invoice_H_ID = new clsField("tbladminist_invoice_d_Invoice_H_ID", ccsInteger, "");
        
        $this->tbladminist_invoice_d_InvoicePar = new clsField("tbladminist_invoice_d_InvoicePar", ccsText, "");
        
        $this->Qty = new clsField("Qty", ccsInteger, "");
        
        $this->Unit = new clsField("Unit", ccsText, "");
        
        $this->CollectID = new clsField("CollectID", ccsInteger, "");
        
        $this->CollectCode = new clsField("CollectCode", ccsText, "");
        
        $this->UnitPrice = new clsField("UnitPrice", ccsFloat, "");
        
        $this->Total = new clsField("Total", ccsFloat, "");
        
        $this->tbladminist_invoice_h_Invoice_H_ID = new clsField("tbladminist_invoice_h_Invoice_H_ID", ccsInteger, "");
        
        $this->Invoice_SH_ID = new clsField("Invoice_SH_ID", ccsInteger, "");
        
        $this->tbladminist_invoice_h_InvoicePar = new clsField("tbladminist_invoice_h_InvoicePar", ccsText, "");
        
        $this->Quotation_H_ID = new clsField("Quotation_H_ID", ccsInteger, "");
        
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        
        $this->InvoiceDate = new clsField("InvoiceDate", ccsDate, $this->DateFormat);
        
        $this->ClientOrderRef = new clsField("ClientOrderRef", ccsText, "");
        
        $this->GayaOrderRef = new clsField("GayaOrderRef", ccsText, "");
        
        $this->DeliveryTermID = new clsField("DeliveryTermID", ccsInteger, "");
        
        $this->PaymentTermID = new clsField("PaymentTermID", ccsInteger, "");
        
        $this->DueDate = new clsField("DueDate", ccsDate, $this->DateFormat);
        
        $this->ClientID = new clsField("ClientID", ccsInteger, "");
        
        $this->AddressID = new clsField("AddressID", ccsInteger, "");
        
        $this->InvoiceContactID = new clsField("InvoiceContactID", ccsInteger, "");
        
        $this->DeliveryContactID = new clsField("DeliveryContactID", ccsInteger, "");
        
        $this->SubTotal = new clsField("SubTotal", ccsFloat, "");
        
        $this->Discount = new clsField("Discount", ccsFloat, "");
        
        $this->Packaging = new clsField("Packaging", ccsFloat, "");
        
        $this->ShippingCost = new clsField("ShippingCost", ccsFloat, "");
        
        $this->GrandTotal = new clsField("GrandTotal", ccsFloat, "");
        
        $this->PaymentBankTransferred = new clsField("PaymentBankTransferred", ccsFloat, "");
        
        $this->Balance = new clsField("Balance", ccsFloat, "");
        
        $this->InvoiceNo = new clsField("InvoiceNo", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-6C3EA372
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT tbladminist_invoice_h.*, tbladminist_invoice_d.*, InvoiceNo, ClientCompany, Company \n\n" .
        "FROM (((tbladminist_invoice_h INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_invoice_h.ClientID = tbladminist_client.ClientID) INNER JOIN tbladminist_invoice_d ON\n\n" .
        "tbladminist_invoice_d.Invoice_H_ID = tbladminist_invoice_h.Invoice_H_ID) INNER JOIN tbladminist_invoice_sh ON\n\n" .
        "tbladminist_invoice_h.Invoice_SH_ID = tbladminist_invoice_sh.Invoice_SH_ID) INNER JOIN tbladminist_addressbook ON\n\n" .
        "tbladminist_invoice_h.AddressID = tbladminist_addressbook.AddressID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-FA176D60
    function SetValues()
    {
        $this->Company->SetDBValue($this->f("Company"));
        $this->ClientCompany->SetDBValue($this->f("ClientCompany"));
        $this->Invoice_D_ID->SetDBValue(trim($this->f("Invoice_D_ID")));
        $this->tbladminist_invoice_d_Invoice_H_ID->SetDBValue(trim($this->f("tbladminist_invoice_d_Invoice_H_ID")));
        $this->tbladminist_invoice_d_InvoicePar->SetDBValue($this->f("tbladminist_invoice_d_InvoicePar"));
        $this->Qty->SetDBValue(trim($this->f("Qty")));
        $this->Unit->SetDBValue($this->f("Unit"));
        $this->CollectID->SetDBValue(trim($this->f("CollectID")));
        $this->CollectCode->SetDBValue($this->f("CollectCode"));
        $this->UnitPrice->SetDBValue(trim($this->f("UnitPrice")));
        $this->Total->SetDBValue(trim($this->f("Total")));
        $this->tbladminist_invoice_h_Invoice_H_ID->SetDBValue(trim($this->f("tbladminist_invoice_h_Invoice_H_ID")));
        $this->Invoice_SH_ID->SetDBValue(trim($this->f("Invoice_SH_ID")));
        $this->tbladminist_invoice_h_InvoicePar->SetDBValue($this->f("tbladminist_invoice_h_InvoicePar"));
        $this->Quotation_H_ID->SetDBValue(trim($this->f("Quotation_H_ID")));
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
        $this->InvoiceDate->SetDBValue(trim($this->f("InvoiceDate")));
        $this->ClientOrderRef->SetDBValue($this->f("ClientOrderRef"));
        $this->GayaOrderRef->SetDBValue($this->f("GayaOrderRef"));
        $this->DeliveryTermID->SetDBValue(trim($this->f("DeliveryTermID")));
        $this->PaymentTermID->SetDBValue(trim($this->f("PaymentTermID")));
        $this->DueDate->SetDBValue(trim($this->f("DueDate")));
        $this->ClientID->SetDBValue(trim($this->f("ClientID")));
        $this->AddressID->SetDBValue(trim($this->f("AddressID")));
        $this->InvoiceContactID->SetDBValue(trim($this->f("InvoiceContactID")));
        $this->DeliveryContactID->SetDBValue(trim($this->f("DeliveryContactID")));
        $this->SubTotal->SetDBValue(trim($this->f("SubTotal")));
        $this->Discount->SetDBValue(trim($this->f("Discount")));
        $this->Packaging->SetDBValue(trim($this->f("Packaging")));
        $this->ShippingCost->SetDBValue(trim($this->f("ShippingCost")));
        $this->GrandTotal->SetDBValue(trim($this->f("GrandTotal")));
        $this->PaymentBankTransferred->SetDBValue(trim($this->f("PaymentBankTransferred")));
        $this->Balance->SetDBValue(trim($this->f("Balance")));
        $this->InvoiceNo->SetDBValue($this->f("InvoiceNo"));
    }
//End SetValues Method

} //End tbladminist_invoice_h_tblDataSource Class @2-FCB6E20C

//Initialize Page @1-777F0CF5
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
$TemplateFileName = "PrintInvoice.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C1A92254
include_once("./PrintInvoice_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-72DADC83
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tbladminist_invoice_h_tbl = new clsReporttbladminist_invoice_h_tbl("", $MainPage);
$Report_Print = new clsControl(ccsLink, "Report_Print", "Report_Print", ccsText, "", CCGetRequestParam("Report_Print", ccsGet, NULL), $MainPage);
$Report_Print->Page = "PrintInvoice.php";
$MainPage->tbladminist_invoice_h_tbl = & $tbladminist_invoice_h_tbl;
$MainPage->Report_Print = & $Report_Print;
$Report_Print->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Report_Print->Parameters = CCAddParam($Report_Print->Parameters, "ViewMode", "Print");
$tbladminist_invoice_h_tbl->Initialize();

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

//Go to destination page @1-15B7A7E3
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tbladminist_invoice_h_tbl);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E122F1DF
$tbladminist_invoice_h_tbl->Show();
$Report_Print->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F923B46D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tbladminist_invoice_h_tbl);
unset($Tpl);
//End Unload Page


?>
