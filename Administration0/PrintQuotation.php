<?php
//Include Common Files @1-0F0E500F
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "PrintQuotation.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//tbladminist_addressbook_t ReportGroup class @2-BD74C8FC
class clsReportGrouptbladminist_addressbook_t {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $Report_Row_Number, $_Report_Row_NumberAttributes;
    public $Rev, $_RevAttributes;
    public $QuotationDate, $_QuotationDateAttributes;
    public $Validity, $_ValidityAttributes;
    public $ClientCompany, $_ClientCompanyAttributes;
    public $ClientOrderRef, $_ClientOrderRefAttributes;
    public $Company, $_CompanyAttributes;
    public $ContactName, $_ContactNameAttributes;
    public $Email, $_EmailAttributes;
    public $Address, $_AddressAttributes;
    public $Phone, $_PhoneAttributes;
    public $Fax, $_FaxAttributes;
    public $PackagingCost, $_PackagingCostAttributes;
    public $DeliveryTerm, $_DeliveryTermAttributes;
    public $DeliveryTime, $_DeliveryTimeAttributes;
    public $PaymentTerm, $_PaymentTermAttributes;
    public $SpecialInstruction, $_SpecialInstructionAttributes;
    public $RndCode, $_RndCodeAttributes;
    public $Photo, $_PhotoAttributes;
    public $Description, $_DescriptionAttributes;
    public $Diameter, $_DiameterAttributes;
    public $Height, $_HeightAttributes;
    public $Width, $_WidthAttributes;
    public $Length, $_LengthAttributes;
    public $UnitPrice, $_UnitPriceAttributes;
    public $Remark, $_RemarkAttributes;
    public $QuotationNo, $_QuotationNoAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;

    function clsReportGrouptbladminist_addressbook_t(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->Rev = $this->Parent->Rev->Value;
        $this->QuotationDate = $this->Parent->QuotationDate->Value;
        $this->Validity = $this->Parent->Validity->Value;
        $this->ClientCompany = $this->Parent->ClientCompany->Value;
        $this->ClientOrderRef = $this->Parent->ClientOrderRef->Value;
        $this->Company = $this->Parent->Company->Value;
        $this->ContactName = $this->Parent->ContactName->Value;
        $this->Email = $this->Parent->Email->Value;
        $this->Address = $this->Parent->Address->Value;
        $this->Phone = $this->Parent->Phone->Value;
        $this->Fax = $this->Parent->Fax->Value;
        $this->PackagingCost = $this->Parent->PackagingCost->Value;
        $this->DeliveryTerm = $this->Parent->DeliveryTerm->Value;
        $this->DeliveryTime = $this->Parent->DeliveryTime->Value;
        $this->PaymentTerm = $this->Parent->PaymentTerm->Value;
        $this->SpecialInstruction = $this->Parent->SpecialInstruction->Value;
        $this->RndCode = $this->Parent->RndCode->Value;
        $this->Photo = $this->Parent->Photo->Value;
        $this->Description = $this->Parent->Description->Value;
        $this->Diameter = $this->Parent->Diameter->Value;
        $this->Height = $this->Parent->Height->Value;
        $this->Width = $this->Parent->Width->Value;
        $this->Length = $this->Parent->Length->Value;
        $this->UnitPrice = $this->Parent->UnitPrice->Value;
        $this->Remark = $this->Parent->Remark->Value;
        $this->QuotationNo = $this->Parent->QuotationNo->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Report_Row_Number = $this->Parent->Report_Row_Number->GetTotalValue($mode);
        $this->_Report_Row_NumberAttributes = $this->Parent->Report_Row_Number->Attributes->GetAsArray();
        $this->_RevAttributes = $this->Parent->Rev->Attributes->GetAsArray();
        $this->_QuotationDateAttributes = $this->Parent->QuotationDate->Attributes->GetAsArray();
        $this->_ValidityAttributes = $this->Parent->Validity->Attributes->GetAsArray();
        $this->_ClientCompanyAttributes = $this->Parent->ClientCompany->Attributes->GetAsArray();
        $this->_ClientOrderRefAttributes = $this->Parent->ClientOrderRef->Attributes->GetAsArray();
        $this->_CompanyAttributes = $this->Parent->Company->Attributes->GetAsArray();
        $this->_ContactNameAttributes = $this->Parent->ContactName->Attributes->GetAsArray();
        $this->_EmailAttributes = $this->Parent->Email->Attributes->GetAsArray();
        $this->_AddressAttributes = $this->Parent->Address->Attributes->GetAsArray();
        $this->_PhoneAttributes = $this->Parent->Phone->Attributes->GetAsArray();
        $this->_FaxAttributes = $this->Parent->Fax->Attributes->GetAsArray();
        $this->_PackagingCostAttributes = $this->Parent->PackagingCost->Attributes->GetAsArray();
        $this->_DeliveryTermAttributes = $this->Parent->DeliveryTerm->Attributes->GetAsArray();
        $this->_DeliveryTimeAttributes = $this->Parent->DeliveryTime->Attributes->GetAsArray();
        $this->_PaymentTermAttributes = $this->Parent->PaymentTerm->Attributes->GetAsArray();
        $this->_SpecialInstructionAttributes = $this->Parent->SpecialInstruction->Attributes->GetAsArray();
        $this->_RndCodeAttributes = $this->Parent->RndCode->Attributes->GetAsArray();
        $this->_PhotoAttributes = $this->Parent->Photo->Attributes->GetAsArray();
        $this->_DescriptionAttributes = $this->Parent->Description->Attributes->GetAsArray();
        $this->_DiameterAttributes = $this->Parent->Diameter->Attributes->GetAsArray();
        $this->_HeightAttributes = $this->Parent->Height->Attributes->GetAsArray();
        $this->_WidthAttributes = $this->Parent->Width->Attributes->GetAsArray();
        $this->_LengthAttributes = $this->Parent->Length->Attributes->GetAsArray();
        $this->_UnitPriceAttributes = $this->Parent->UnitPrice->Attributes->GetAsArray();
        $this->_RemarkAttributes = $this->Parent->Remark->Attributes->GetAsArray();
        $this->_QuotationNoAttributes = $this->Parent->QuotationNo->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->Report_Row_Number = $this->Report_Row_Number;
        $Header->_Report_Row_NumberAttributes = $this->_Report_Row_NumberAttributes;
        $this->Rev = $Header->Rev;
        $Header->_RevAttributes = $this->_RevAttributes;
        $this->Parent->Rev->Value = $Header->Rev;
        $this->Parent->Rev->Attributes->RestoreFromArray($Header->_RevAttributes);
        $this->QuotationDate = $Header->QuotationDate;
        $Header->_QuotationDateAttributes = $this->_QuotationDateAttributes;
        $this->Parent->QuotationDate->Value = $Header->QuotationDate;
        $this->Parent->QuotationDate->Attributes->RestoreFromArray($Header->_QuotationDateAttributes);
        $this->Validity = $Header->Validity;
        $Header->_ValidityAttributes = $this->_ValidityAttributes;
        $this->Parent->Validity->Value = $Header->Validity;
        $this->Parent->Validity->Attributes->RestoreFromArray($Header->_ValidityAttributes);
        $this->ClientCompany = $Header->ClientCompany;
        $Header->_ClientCompanyAttributes = $this->_ClientCompanyAttributes;
        $this->Parent->ClientCompany->Value = $Header->ClientCompany;
        $this->Parent->ClientCompany->Attributes->RestoreFromArray($Header->_ClientCompanyAttributes);
        $this->ClientOrderRef = $Header->ClientOrderRef;
        $Header->_ClientOrderRefAttributes = $this->_ClientOrderRefAttributes;
        $this->Parent->ClientOrderRef->Value = $Header->ClientOrderRef;
        $this->Parent->ClientOrderRef->Attributes->RestoreFromArray($Header->_ClientOrderRefAttributes);
        $this->Company = $Header->Company;
        $Header->_CompanyAttributes = $this->_CompanyAttributes;
        $this->Parent->Company->Value = $Header->Company;
        $this->Parent->Company->Attributes->RestoreFromArray($Header->_CompanyAttributes);
        $this->ContactName = $Header->ContactName;
        $Header->_ContactNameAttributes = $this->_ContactNameAttributes;
        $this->Parent->ContactName->Value = $Header->ContactName;
        $this->Parent->ContactName->Attributes->RestoreFromArray($Header->_ContactNameAttributes);
        $this->Email = $Header->Email;
        $Header->_EmailAttributes = $this->_EmailAttributes;
        $this->Parent->Email->Value = $Header->Email;
        $this->Parent->Email->Attributes->RestoreFromArray($Header->_EmailAttributes);
        $this->Address = $Header->Address;
        $Header->_AddressAttributes = $this->_AddressAttributes;
        $this->Parent->Address->Value = $Header->Address;
        $this->Parent->Address->Attributes->RestoreFromArray($Header->_AddressAttributes);
        $this->Phone = $Header->Phone;
        $Header->_PhoneAttributes = $this->_PhoneAttributes;
        $this->Parent->Phone->Value = $Header->Phone;
        $this->Parent->Phone->Attributes->RestoreFromArray($Header->_PhoneAttributes);
        $this->Fax = $Header->Fax;
        $Header->_FaxAttributes = $this->_FaxAttributes;
        $this->Parent->Fax->Value = $Header->Fax;
        $this->Parent->Fax->Attributes->RestoreFromArray($Header->_FaxAttributes);
        $this->PackagingCost = $Header->PackagingCost;
        $Header->_PackagingCostAttributes = $this->_PackagingCostAttributes;
        $this->Parent->PackagingCost->Value = $Header->PackagingCost;
        $this->Parent->PackagingCost->Attributes->RestoreFromArray($Header->_PackagingCostAttributes);
        $this->DeliveryTerm = $Header->DeliveryTerm;
        $Header->_DeliveryTermAttributes = $this->_DeliveryTermAttributes;
        $this->Parent->DeliveryTerm->Value = $Header->DeliveryTerm;
        $this->Parent->DeliveryTerm->Attributes->RestoreFromArray($Header->_DeliveryTermAttributes);
        $this->DeliveryTime = $Header->DeliveryTime;
        $Header->_DeliveryTimeAttributes = $this->_DeliveryTimeAttributes;
        $this->Parent->DeliveryTime->Value = $Header->DeliveryTime;
        $this->Parent->DeliveryTime->Attributes->RestoreFromArray($Header->_DeliveryTimeAttributes);
        $this->PaymentTerm = $Header->PaymentTerm;
        $Header->_PaymentTermAttributes = $this->_PaymentTermAttributes;
        $this->Parent->PaymentTerm->Value = $Header->PaymentTerm;
        $this->Parent->PaymentTerm->Attributes->RestoreFromArray($Header->_PaymentTermAttributes);
        $this->SpecialInstruction = $Header->SpecialInstruction;
        $Header->_SpecialInstructionAttributes = $this->_SpecialInstructionAttributes;
        $this->Parent->SpecialInstruction->Value = $Header->SpecialInstruction;
        $this->Parent->SpecialInstruction->Attributes->RestoreFromArray($Header->_SpecialInstructionAttributes);
        $this->RndCode = $Header->RndCode;
        $Header->_RndCodeAttributes = $this->_RndCodeAttributes;
        $this->Parent->RndCode->Value = $Header->RndCode;
        $this->Parent->RndCode->Attributes->RestoreFromArray($Header->_RndCodeAttributes);
        $this->Photo = $Header->Photo;
        $Header->_PhotoAttributes = $this->_PhotoAttributes;
        $this->Parent->Photo->Value = $Header->Photo;
        $this->Parent->Photo->Attributes->RestoreFromArray($Header->_PhotoAttributes);
        $this->Description = $Header->Description;
        $Header->_DescriptionAttributes = $this->_DescriptionAttributes;
        $this->Parent->Description->Value = $Header->Description;
        $this->Parent->Description->Attributes->RestoreFromArray($Header->_DescriptionAttributes);
        $this->Diameter = $Header->Diameter;
        $Header->_DiameterAttributes = $this->_DiameterAttributes;
        $this->Parent->Diameter->Value = $Header->Diameter;
        $this->Parent->Diameter->Attributes->RestoreFromArray($Header->_DiameterAttributes);
        $this->Height = $Header->Height;
        $Header->_HeightAttributes = $this->_HeightAttributes;
        $this->Parent->Height->Value = $Header->Height;
        $this->Parent->Height->Attributes->RestoreFromArray($Header->_HeightAttributes);
        $this->Width = $Header->Width;
        $Header->_WidthAttributes = $this->_WidthAttributes;
        $this->Parent->Width->Value = $Header->Width;
        $this->Parent->Width->Attributes->RestoreFromArray($Header->_WidthAttributes);
        $this->Length = $Header->Length;
        $Header->_LengthAttributes = $this->_LengthAttributes;
        $this->Parent->Length->Value = $Header->Length;
        $this->Parent->Length->Attributes->RestoreFromArray($Header->_LengthAttributes);
        $this->UnitPrice = $Header->UnitPrice;
        $Header->_UnitPriceAttributes = $this->_UnitPriceAttributes;
        $this->Parent->UnitPrice->Value = $Header->UnitPrice;
        $this->Parent->UnitPrice->Attributes->RestoreFromArray($Header->_UnitPriceAttributes);
        $this->Remark = $Header->Remark;
        $Header->_RemarkAttributes = $this->_RemarkAttributes;
        $this->Parent->Remark->Value = $Header->Remark;
        $this->Parent->Remark->Attributes->RestoreFromArray($Header->_RemarkAttributes);
        $this->QuotationNo = $Header->QuotationNo;
        $Header->_QuotationNoAttributes = $this->_QuotationNoAttributes;
        $this->Parent->QuotationNo->Value = $Header->QuotationNo;
        $this->Parent->QuotationNo->Attributes->RestoreFromArray($Header->_QuotationNoAttributes);
    }
    function ChangeTotalControls() {
        $this->Report_Row_Number = $this->Parent->Report_Row_Number->GetValue();
    }
}
//End tbladminist_addressbook_t ReportGroup class

//tbladminist_addressbook_t GroupsCollection class @2-A60F62CE
class clsGroupsCollectiontbladminist_addressbook_t {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectiontbladminist_addressbook_t(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGrouptbladminist_addressbook_t($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->Report_Row_Number->Value = $this->Parent->Report_Row_Number->initialValue;
        $this->Parent->Rev->Value = $this->Parent->Rev->initialValue;
        $this->Parent->QuotationDate->Value = $this->Parent->QuotationDate->initialValue;
        $this->Parent->Validity->Value = $this->Parent->Validity->initialValue;
        $this->Parent->ClientCompany->Value = $this->Parent->ClientCompany->initialValue;
        $this->Parent->ClientOrderRef->Value = $this->Parent->ClientOrderRef->initialValue;
        $this->Parent->Company->Value = $this->Parent->Company->initialValue;
        $this->Parent->ContactName->Value = $this->Parent->ContactName->initialValue;
        $this->Parent->Email->Value = $this->Parent->Email->initialValue;
        $this->Parent->Address->Value = $this->Parent->Address->initialValue;
        $this->Parent->Phone->Value = $this->Parent->Phone->initialValue;
        $this->Parent->Fax->Value = $this->Parent->Fax->initialValue;
        $this->Parent->PackagingCost->Value = $this->Parent->PackagingCost->initialValue;
        $this->Parent->DeliveryTerm->Value = $this->Parent->DeliveryTerm->initialValue;
        $this->Parent->DeliveryTime->Value = $this->Parent->DeliveryTime->initialValue;
        $this->Parent->PaymentTerm->Value = $this->Parent->PaymentTerm->initialValue;
        $this->Parent->SpecialInstruction->Value = $this->Parent->SpecialInstruction->initialValue;
        $this->Parent->RndCode->Value = $this->Parent->RndCode->initialValue;
        $this->Parent->Photo->Value = $this->Parent->Photo->initialValue;
        $this->Parent->Description->Value = $this->Parent->Description->initialValue;
        $this->Parent->Diameter->Value = $this->Parent->Diameter->initialValue;
        $this->Parent->Height->Value = $this->Parent->Height->initialValue;
        $this->Parent->Width->Value = $this->Parent->Width->initialValue;
        $this->Parent->Length->Value = $this->Parent->Length->initialValue;
        $this->Parent->UnitPrice->Value = $this->Parent->UnitPrice->initialValue;
        $this->Parent->Remark->Value = $this->Parent->Remark->initialValue;
        $this->Parent->QuotationNo->Value = $this->Parent->QuotationNo->initialValue;
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
//End tbladminist_addressbook_t GroupsCollection class

class clsReporttbladminist_addressbook_t { //tbladminist_addressbook_t Class @2-9EEF1E54

//tbladminist_addressbook_t Variables @2-944D286E

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
//End tbladminist_addressbook_t Variables

//Class_Initialize Event @2-34B8F595
    function clsReporttbladminist_addressbook_t($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tbladminist_addressbook_t";
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
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->Errors = new clsErrors();
        $this->DataSource = new clstbladminist_addressbook_tDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ViewMode = CCGetParam("ViewMode", "Web");
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else if($this->ViewMode == "Print") {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 0;
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

        $this->Report_Row_Number = new clsControl(ccsReportLabel, "Report_Row_Number", "Report_Row_Number", ccsInteger, "", 0, $this);
        $this->Report_Row_Number->TotalFunction = "Count";
        $this->Report_Row_Number->IsEmptySource = true;
        $this->Rev = new clsControl(ccsReportLabel, "Rev", "Rev", ccsText, "", "", $this);
        $this->QuotationDate = new clsControl(ccsReportLabel, "QuotationDate", "QuotationDate", ccsDate, $DefaultDateFormat, "", $this);
        $this->Validity = new clsControl(ccsReportLabel, "Validity", "Validity", ccsText, "", "", $this);
        $this->ClientCompany = new clsControl(ccsReportLabel, "ClientCompany", "ClientCompany", ccsText, "", "", $this);
        $this->ClientOrderRef = new clsControl(ccsReportLabel, "ClientOrderRef", "ClientOrderRef", ccsText, "", "", $this);
        $this->Company = new clsControl(ccsReportLabel, "Company", "Company", ccsText, "", "", $this);
        $this->ContactName = new clsControl(ccsReportLabel, "ContactName", "ContactName", ccsText, "", "", $this);
        $this->Email = new clsControl(ccsReportLabel, "Email", "Email", ccsText, "", "", $this);
        $this->Address = new clsControl(ccsReportLabel, "Address", "Address", ccsMemo, "", "", $this);
        $this->Phone = new clsControl(ccsReportLabel, "Phone", "Phone", ccsText, "", "", $this);
        $this->Fax = new clsControl(ccsReportLabel, "Fax", "Fax", ccsText, "", "", $this);
        $this->PackagingCost = new clsControl(ccsReportLabel, "PackagingCost", "PackagingCost", ccsSingle, "", "", $this);
        $this->DeliveryTerm = new clsControl(ccsReportLabel, "DeliveryTerm", "DeliveryTerm", ccsText, "", "", $this);
        $this->DeliveryTime = new clsControl(ccsReportLabel, "DeliveryTime", "DeliveryTime", ccsText, "", "", $this);
        $this->PaymentTerm = new clsControl(ccsReportLabel, "PaymentTerm", "PaymentTerm", ccsText, "", "", $this);
        $this->SpecialInstruction = new clsControl(ccsReportLabel, "SpecialInstruction", "SpecialInstruction", ccsMemo, "", "", $this);
        $this->RndCode = new clsControl(ccsReportLabel, "RndCode", "RndCode", ccsText, "", "", $this);
        $this->Photo = new clsControl(ccsReportLabel, "Photo", "Photo", ccsText, "", "", $this);
        $this->Description = new clsControl(ccsReportLabel, "Description", "Description", ccsText, "", "", $this);
        $this->Diameter = new clsControl(ccsReportLabel, "Diameter", "Diameter", ccsFloat, "", "", $this);
        $this->Height = new clsControl(ccsReportLabel, "Height", "Height", ccsFloat, "", "", $this);
        $this->Width = new clsControl(ccsReportLabel, "Width", "Width", ccsFloat, "", "", $this);
        $this->Length = new clsControl(ccsReportLabel, "Length", "Length", ccsFloat, "", "", $this);
        $this->UnitPrice = new clsControl(ccsReportLabel, "UnitPrice", "UnitPrice", ccsFloat, "", "", $this);
        $this->Remark = new clsControl(ccsReportLabel, "Remark", "Remark", ccsMemo, "", "", $this);
        $this->QuotationNo = new clsControl(ccsReportLabel, "QuotationNo", "QuotationNo", ccsText, "", "", $this);
        $this->NoRecords = new clsPanel("NoRecords", $this);
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

//CheckErrors Method @2-74E65900
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Report_Row_Number->Errors->Count());
        $errors = ($errors || $this->Rev->Errors->Count());
        $errors = ($errors || $this->QuotationDate->Errors->Count());
        $errors = ($errors || $this->Validity->Errors->Count());
        $errors = ($errors || $this->ClientCompany->Errors->Count());
        $errors = ($errors || $this->ClientOrderRef->Errors->Count());
        $errors = ($errors || $this->Company->Errors->Count());
        $errors = ($errors || $this->ContactName->Errors->Count());
        $errors = ($errors || $this->Email->Errors->Count());
        $errors = ($errors || $this->Address->Errors->Count());
        $errors = ($errors || $this->Phone->Errors->Count());
        $errors = ($errors || $this->Fax->Errors->Count());
        $errors = ($errors || $this->PackagingCost->Errors->Count());
        $errors = ($errors || $this->DeliveryTerm->Errors->Count());
        $errors = ($errors || $this->DeliveryTime->Errors->Count());
        $errors = ($errors || $this->PaymentTerm->Errors->Count());
        $errors = ($errors || $this->SpecialInstruction->Errors->Count());
        $errors = ($errors || $this->RndCode->Errors->Count());
        $errors = ($errors || $this->Photo->Errors->Count());
        $errors = ($errors || $this->Description->Errors->Count());
        $errors = ($errors || $this->Diameter->Errors->Count());
        $errors = ($errors || $this->Height->Errors->Count());
        $errors = ($errors || $this->Width->Errors->Count());
        $errors = ($errors || $this->Length->Errors->Count());
        $errors = ($errors || $this->UnitPrice->Errors->Count());
        $errors = ($errors || $this->Remark->Errors->Count());
        $errors = ($errors || $this->QuotationNo->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-0ECCAE79
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Report_Row_Number->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Rev->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Validity->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientCompany->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientOrderRef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Company->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ContactName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Email->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Address->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Phone->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Fax->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PackagingCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryTerm->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryTime->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PaymentTerm->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SpecialInstruction->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RndCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Diameter->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Height->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Width->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Length->Errors->ToString());
        $errors = ComposeStrings($errors, $this->UnitPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-73A9DD27
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urltbladminist_quotation_h_Quotation_H_ID"] = CCGetFromGet("tbladminist_quotation_h_Quotation_H_ID", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $Groups = new clsGroupsCollectiontbladminist_addressbook_t($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->Rev->SetValue($this->DataSource->Rev->GetValue());
            $this->QuotationDate->SetValue($this->DataSource->QuotationDate->GetValue());
            $this->Validity->SetValue($this->DataSource->Validity->GetValue());
            $this->ClientCompany->SetValue($this->DataSource->ClientCompany->GetValue());
            $this->ClientOrderRef->SetValue($this->DataSource->ClientOrderRef->GetValue());
            $this->Company->SetValue($this->DataSource->Company->GetValue());
            $this->ContactName->SetValue($this->DataSource->ContactName->GetValue());
            $this->Email->SetValue($this->DataSource->Email->GetValue());
            $this->Address->SetValue($this->DataSource->Address->GetValue());
            $this->Phone->SetValue($this->DataSource->Phone->GetValue());
            $this->Fax->SetValue($this->DataSource->Fax->GetValue());
            $this->PackagingCost->SetValue($this->DataSource->PackagingCost->GetValue());
            $this->DeliveryTerm->SetValue($this->DataSource->DeliveryTerm->GetValue());
            $this->DeliveryTime->SetValue($this->DataSource->DeliveryTime->GetValue());
            $this->PaymentTerm->SetValue($this->DataSource->PaymentTerm->GetValue());
            $this->SpecialInstruction->SetValue($this->DataSource->SpecialInstruction->GetValue());
            $this->RndCode->SetValue($this->DataSource->RndCode->GetValue());
            $this->Photo->SetValue($this->DataSource->Photo->GetValue());
            $this->Description->SetValue($this->DataSource->Description->GetValue());
            $this->Diameter->SetValue($this->DataSource->Diameter->GetValue());
            $this->Height->SetValue($this->DataSource->Height->GetValue());
            $this->Width->SetValue($this->DataSource->Width->GetValue());
            $this->Length->SetValue($this->DataSource->Length->GetValue());
            $this->UnitPrice->SetValue($this->DataSource->UnitPrice->GetValue());
            $this->Remark->SetValue($this->DataSource->Remark->GetValue());
            $this->QuotationNo->SetValue($this->DataSource->QuotationNo->GetValue());
            $this->Report_Row_Number->SetValue(1);
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
            $this->ControlsVisible["Report_Row_Number"] = $this->Report_Row_Number->Visible;
            $this->ControlsVisible["Rev"] = $this->Rev->Visible;
            $this->ControlsVisible["QuotationDate"] = $this->QuotationDate->Visible;
            $this->ControlsVisible["Validity"] = $this->Validity->Visible;
            $this->ControlsVisible["ClientCompany"] = $this->ClientCompany->Visible;
            $this->ControlsVisible["ClientOrderRef"] = $this->ClientOrderRef->Visible;
            $this->ControlsVisible["Company"] = $this->Company->Visible;
            $this->ControlsVisible["ContactName"] = $this->ContactName->Visible;
            $this->ControlsVisible["Email"] = $this->Email->Visible;
            $this->ControlsVisible["Address"] = $this->Address->Visible;
            $this->ControlsVisible["Phone"] = $this->Phone->Visible;
            $this->ControlsVisible["Fax"] = $this->Fax->Visible;
            $this->ControlsVisible["PackagingCost"] = $this->PackagingCost->Visible;
            $this->ControlsVisible["DeliveryTerm"] = $this->DeliveryTerm->Visible;
            $this->ControlsVisible["DeliveryTime"] = $this->DeliveryTime->Visible;
            $this->ControlsVisible["PaymentTerm"] = $this->PaymentTerm->Visible;
            $this->ControlsVisible["SpecialInstruction"] = $this->SpecialInstruction->Visible;
            $this->ControlsVisible["RndCode"] = $this->RndCode->Visible;
            $this->ControlsVisible["Photo"] = $this->Photo->Visible;
            $this->ControlsVisible["Description"] = $this->Description->Visible;
            $this->ControlsVisible["Diameter"] = $this->Diameter->Visible;
            $this->ControlsVisible["Height"] = $this->Height->Visible;
            $this->ControlsVisible["Width"] = $this->Width->Visible;
            $this->ControlsVisible["Length"] = $this->Length->Visible;
            $this->ControlsVisible["UnitPrice"] = $this->UnitPrice->Visible;
            $this->ControlsVisible["Remark"] = $this->Remark->Visible;
            $this->ControlsVisible["QuotationNo"] = $this->QuotationNo->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->Report_Row_Number->SetValue($items[$i]->Report_Row_Number);
                        $this->Report_Row_Number->Attributes->RestoreFromArray($items[$i]->_Report_Row_NumberAttributes);
                        $this->Rev->SetValue($items[$i]->Rev);
                        $this->Rev->Attributes->RestoreFromArray($items[$i]->_RevAttributes);
                        $this->QuotationDate->SetValue($items[$i]->QuotationDate);
                        $this->QuotationDate->Attributes->RestoreFromArray($items[$i]->_QuotationDateAttributes);
                        $this->Validity->SetValue($items[$i]->Validity);
                        $this->Validity->Attributes->RestoreFromArray($items[$i]->_ValidityAttributes);
                        $this->ClientCompany->SetValue($items[$i]->ClientCompany);
                        $this->ClientCompany->Attributes->RestoreFromArray($items[$i]->_ClientCompanyAttributes);
                        $this->ClientOrderRef->SetValue($items[$i]->ClientOrderRef);
                        $this->ClientOrderRef->Attributes->RestoreFromArray($items[$i]->_ClientOrderRefAttributes);
                        $this->Company->SetValue($items[$i]->Company);
                        $this->Company->Attributes->RestoreFromArray($items[$i]->_CompanyAttributes);
                        $this->ContactName->SetValue($items[$i]->ContactName);
                        $this->ContactName->Attributes->RestoreFromArray($items[$i]->_ContactNameAttributes);
                        $this->Email->SetValue($items[$i]->Email);
                        $this->Email->Attributes->RestoreFromArray($items[$i]->_EmailAttributes);
                        $this->Address->SetValue($items[$i]->Address);
                        $this->Address->Attributes->RestoreFromArray($items[$i]->_AddressAttributes);
                        $this->Phone->SetValue($items[$i]->Phone);
                        $this->Phone->Attributes->RestoreFromArray($items[$i]->_PhoneAttributes);
                        $this->Fax->SetValue($items[$i]->Fax);
                        $this->Fax->Attributes->RestoreFromArray($items[$i]->_FaxAttributes);
                        $this->PackagingCost->SetValue($items[$i]->PackagingCost);
                        $this->PackagingCost->Attributes->RestoreFromArray($items[$i]->_PackagingCostAttributes);
                        $this->DeliveryTerm->SetValue($items[$i]->DeliveryTerm);
                        $this->DeliveryTerm->Attributes->RestoreFromArray($items[$i]->_DeliveryTermAttributes);
                        $this->DeliveryTime->SetValue($items[$i]->DeliveryTime);
                        $this->DeliveryTime->Attributes->RestoreFromArray($items[$i]->_DeliveryTimeAttributes);
                        $this->PaymentTerm->SetValue($items[$i]->PaymentTerm);
                        $this->PaymentTerm->Attributes->RestoreFromArray($items[$i]->_PaymentTermAttributes);
                        $this->SpecialInstruction->SetValue($items[$i]->SpecialInstruction);
                        $this->SpecialInstruction->Attributes->RestoreFromArray($items[$i]->_SpecialInstructionAttributes);
                        $this->RndCode->SetValue($items[$i]->RndCode);
                        $this->RndCode->Attributes->RestoreFromArray($items[$i]->_RndCodeAttributes);
                        $this->Photo->SetValue($items[$i]->Photo);
                        $this->Photo->Attributes->RestoreFromArray($items[$i]->_PhotoAttributes);
                        $this->Description->SetValue($items[$i]->Description);
                        $this->Description->Attributes->RestoreFromArray($items[$i]->_DescriptionAttributes);
                        $this->Diameter->SetValue($items[$i]->Diameter);
                        $this->Diameter->Attributes->RestoreFromArray($items[$i]->_DiameterAttributes);
                        $this->Height->SetValue($items[$i]->Height);
                        $this->Height->Attributes->RestoreFromArray($items[$i]->_HeightAttributes);
                        $this->Width->SetValue($items[$i]->Width);
                        $this->Width->Attributes->RestoreFromArray($items[$i]->_WidthAttributes);
                        $this->Length->SetValue($items[$i]->Length);
                        $this->Length->Attributes->RestoreFromArray($items[$i]->_LengthAttributes);
                        $this->UnitPrice->SetValue($items[$i]->UnitPrice);
                        $this->UnitPrice->Attributes->RestoreFromArray($items[$i]->_UnitPriceAttributes);
                        $this->Remark->SetValue($items[$i]->Remark);
                        $this->Remark->Attributes->RestoreFromArray($items[$i]->_RemarkAttributes);
                        $this->QuotationNo->SetValue($items[$i]->QuotationNo);
                        $this->QuotationNo->Attributes->RestoreFromArray($items[$i]->_QuotationNoAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->Report_Row_Number->Show();
                        $this->Rev->Show();
                        $this->QuotationDate->Show();
                        $this->Validity->Show();
                        $this->ClientCompany->Show();
                        $this->ClientOrderRef->Show();
                        $this->Company->Show();
                        $this->ContactName->Show();
                        $this->Email->Show();
                        $this->Address->Show();
                        $this->Phone->Show();
                        $this->Fax->Show();
                        $this->PackagingCost->Show();
                        $this->DeliveryTerm->Show();
                        $this->DeliveryTime->Show();
                        $this->PaymentTerm->Show();
                        $this->SpecialInstruction->Show();
                        $this->RndCode->Show();
                        $this->Photo->Show();
                        $this->Description->Show();
                        $this->Diameter->Show();
                        $this->Height->Show();
                        $this->Width->Show();
                        $this->Length->Show();
                        $this->UnitPrice->Show();
                        $this->Remark->Show();
                        $this->QuotationNo->Show();
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
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
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

} //End tbladminist_addressbook_t Class @2-FCB6E20C

class clstbladminist_addressbook_tDataSource extends clsDBGayaFusionAll {  //tbladminist_addressbook_tDataSource Class @2-A4B88CB2

//DataSource Variables @2-AEDF343E
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $Rev;
    public $QuotationDate;
    public $Validity;
    public $ClientCompany;
    public $ClientOrderRef;
    public $Company;
    public $ContactName;
    public $Email;
    public $Address;
    public $Phone;
    public $Fax;
    public $PackagingCost;
    public $DeliveryTerm;
    public $DeliveryTime;
    public $PaymentTerm;
    public $SpecialInstruction;
    public $RndCode;
    public $Photo;
    public $Description;
    public $Diameter;
    public $Height;
    public $Width;
    public $Length;
    public $UnitPrice;
    public $Remark;
    public $QuotationNo;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-DDBE8757
    function clstbladminist_addressbook_tDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report tbladminist_addressbook_t";
        $this->Initialize();
        $this->Rev = new clsField("Rev", ccsText, "");
        
        $this->QuotationDate = new clsField("QuotationDate", ccsDate, $this->DateFormat);
        
        $this->Validity = new clsField("Validity", ccsText, "");
        
        $this->ClientCompany = new clsField("ClientCompany", ccsText, "");
        
        $this->ClientOrderRef = new clsField("ClientOrderRef", ccsText, "");
        
        $this->Company = new clsField("Company", ccsText, "");
        
        $this->ContactName = new clsField("ContactName", ccsText, "");
        
        $this->Email = new clsField("Email", ccsText, "");
        
        $this->Address = new clsField("Address", ccsMemo, "");
        
        $this->Phone = new clsField("Phone", ccsText, "");
        
        $this->Fax = new clsField("Fax", ccsText, "");
        
        $this->PackagingCost = new clsField("PackagingCost", ccsSingle, "");
        
        $this->DeliveryTerm = new clsField("DeliveryTerm", ccsText, "");
        
        $this->DeliveryTime = new clsField("DeliveryTime", ccsText, "");
        
        $this->PaymentTerm = new clsField("PaymentTerm", ccsText, "");
        
        $this->SpecialInstruction = new clsField("SpecialInstruction", ccsMemo, "");
        
        $this->RndCode = new clsField("RndCode", ccsText, "");
        
        $this->Photo = new clsField("Photo", ccsText, "");
        
        $this->Description = new clsField("Description", ccsText, "");
        
        $this->Diameter = new clsField("Diameter", ccsFloat, "");
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->UnitPrice = new clsField("UnitPrice", ccsFloat, "");
        
        $this->Remark = new clsField("Remark", ccsMemo, "");
        
        $this->QuotationNo = new clsField("QuotationNo", ccsText, "");
        

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

//Prepare Method @2-8E4DB37E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urltbladminist_quotation_h_Quotation_H_ID", ccsInteger, "", "", $this->Parameters["urltbladminist_quotation_h_Quotation_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_quotation_h.Quotation_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-AFCC0F13
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT Fax, tbladminist_quotation_d.*, tbladminist_quotation_h.*, Phone, Email, Address, ContactName, Company, ClientCompany, DeliveryTerm,\n\n" .
        "DeliveryTime, PaymentTerm \n\n" .
        "FROM ((((((tbladminist_addressbook INNER JOIN tbladminist_addressbook_contact ON\n\n" .
        "tbladminist_addressbook_contact.AddressID = tbladminist_addressbook.AddressID) INNER JOIN tbladminist_quotation_h ON\n\n" .
        "tbladminist_quotation_h.ContactId = tbladminist_addressbook_contact.ContactId) INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_quotation_h.ClientID = tbladminist_client.ClientID) INNER JOIN tbladminist_deliveryterm ON\n\n" .
        "tbladminist_quotation_h.DeliveryTermID = tbladminist_deliveryterm.DeliveryTermID) INNER JOIN tbladminist_deliverytime ON\n\n" .
        "tbladminist_quotation_h.DeliveryTimeID = tbladminist_deliverytime.DeliveryTimeID) INNER JOIN tbladminist_paymentterm ON\n\n" .
        "tbladminist_quotation_h.PaymentTermID = tbladminist_paymentterm.PaymentTermID) INNER JOIN tbladminist_quotation_d ON\n\n" .
        "tbladminist_quotation_d.Quotation_H_ID = tbladminist_quotation_h.Quotation_H_ID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-B72930AD
    function SetValues()
    {
        $this->Rev->SetDBValue($this->f("Rev"));
        $this->QuotationDate->SetDBValue(trim($this->f("QuotationDate")));
        $this->Validity->SetDBValue($this->f("Validity"));
        $this->ClientCompany->SetDBValue($this->f("ClientCompany"));
        $this->ClientOrderRef->SetDBValue($this->f("ClientOrderRef"));
        $this->Company->SetDBValue($this->f("Company"));
        $this->ContactName->SetDBValue($this->f("ContactName"));
        $this->Email->SetDBValue($this->f("Email"));
        $this->Address->SetDBValue($this->f("Address"));
        $this->Phone->SetDBValue($this->f("Phone"));
        $this->Fax->SetDBValue($this->f("Fax"));
        $this->PackagingCost->SetDBValue(trim($this->f("PackagingCost")));
        $this->DeliveryTerm->SetDBValue($this->f("DeliveryTerm"));
        $this->DeliveryTime->SetDBValue($this->f("DeliveryTime"));
        $this->PaymentTerm->SetDBValue($this->f("PaymentTerm"));
        $this->SpecialInstruction->SetDBValue($this->f("SpecialInstruction"));
        $this->RndCode->SetDBValue($this->f("RndCode"));
        $this->Photo->SetDBValue($this->f("Photo"));
        $this->Description->SetDBValue($this->f("Description"));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->UnitPrice->SetDBValue(trim($this->f("UnitPrice")));
        $this->Remark->SetDBValue($this->f("Remark"));
        $this->QuotationNo->SetDBValue($this->f("QuotationNo"));
    }
//End SetValues Method

} //End tbladminist_addressbook_tDataSource Class @2-FCB6E20C

//Initialize Page @1-A8577D42
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
$TemplateFileName = "PrintQuotation.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-8234F44F
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tbladminist_addressbook_t = new clsReporttbladminist_addressbook_t("", $MainPage);
$MainPage->tbladminist_addressbook_t = & $tbladminist_addressbook_t;
$tbladminist_addressbook_t->Initialize();

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

//Go to destination page @1-EC874A1C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tbladminist_addressbook_t);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-EDA91D6D
$tbladminist_addressbook_t->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);

$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-35E76E18
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tbladminist_addressbook_t);
unset($Tpl);
//End Unload Page


?>
