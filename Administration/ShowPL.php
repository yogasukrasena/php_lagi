<?php
//Include Common Files @1-3274BBDB
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowPL.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Header ReportGroup class @2-3587C137
class clsReportGroupHeader {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $Company, $_CompanyAttributes;
    public $PLNo, $_PLNoAttributes;
    public $PLDate, $_PLDateAttributes;
    public $OrderRef, $_OrderRefAttributes;
    public $Attn1, $_Attn1Attributes;
    public $Address1, $_Address1Attributes;
    public $Phone1, $_Phone1Attributes;
    public $Fax1, $_Fax1Attributes;
    public $Attn2, $_Attn2Attributes;
    public $Address2, $_Address2Attributes;
    public $Phone2, $_Phone2Attributes;
    public $Fax2, $_Fax2Attributes;
    public $Company1, $_Company1Attributes;
    public $AddressID, $_AddressIDAttributes;
    public $DeliveryAddressID, $_DeliveryAddressIDAttributes;
    public $Invoice_H_ID, $_Invoice_H_IDAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;

    function clsReportGroupHeader(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->Company = $this->Parent->Company->Value;
        $this->PLNo = $this->Parent->PLNo->Value;
        $this->PLDate = $this->Parent->PLDate->Value;
        $this->OrderRef = $this->Parent->OrderRef->Value;
        $this->Attn1 = $this->Parent->Attn1->Value;
        $this->Address1 = $this->Parent->Address1->Value;
        $this->Phone1 = $this->Parent->Phone1->Value;
        $this->Fax1 = $this->Parent->Fax1->Value;
        $this->Attn2 = $this->Parent->Attn2->Value;
        $this->Address2 = $this->Parent->Address2->Value;
        $this->Phone2 = $this->Parent->Phone2->Value;
        $this->Fax2 = $this->Parent->Fax2->Value;
        $this->Company1 = $this->Parent->Company1->Value;
        $this->AddressID = $this->Parent->AddressID->Value;
        $this->DeliveryAddressID = $this->Parent->DeliveryAddressID->Value;
        $this->Invoice_H_ID = $this->Parent->Invoice_H_ID->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->_CompanyAttributes = $this->Parent->Company->Attributes->GetAsArray();
        $this->_PLNoAttributes = $this->Parent->PLNo->Attributes->GetAsArray();
        $this->_PLDateAttributes = $this->Parent->PLDate->Attributes->GetAsArray();
        $this->_OrderRefAttributes = $this->Parent->OrderRef->Attributes->GetAsArray();
        $this->_Attn1Attributes = $this->Parent->Attn1->Attributes->GetAsArray();
        $this->_Address1Attributes = $this->Parent->Address1->Attributes->GetAsArray();
        $this->_Phone1Attributes = $this->Parent->Phone1->Attributes->GetAsArray();
        $this->_Fax1Attributes = $this->Parent->Fax1->Attributes->GetAsArray();
        $this->_Attn2Attributes = $this->Parent->Attn2->Attributes->GetAsArray();
        $this->_Address2Attributes = $this->Parent->Address2->Attributes->GetAsArray();
        $this->_Phone2Attributes = $this->Parent->Phone2->Attributes->GetAsArray();
        $this->_Fax2Attributes = $this->Parent->Fax2->Attributes->GetAsArray();
        $this->_Company1Attributes = $this->Parent->Company1->Attributes->GetAsArray();
        $this->_AddressIDAttributes = $this->Parent->AddressID->Attributes->GetAsArray();
        $this->_DeliveryAddressIDAttributes = $this->Parent->DeliveryAddressID->Attributes->GetAsArray();
        $this->_Invoice_H_IDAttributes = $this->Parent->Invoice_H_ID->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $this->Company = $Header->Company;
        $Header->_CompanyAttributes = $this->_CompanyAttributes;
        $this->Parent->Company->Value = $Header->Company;
        $this->Parent->Company->Attributes->RestoreFromArray($Header->_CompanyAttributes);
        $this->PLNo = $Header->PLNo;
        $Header->_PLNoAttributes = $this->_PLNoAttributes;
        $this->Parent->PLNo->Value = $Header->PLNo;
        $this->Parent->PLNo->Attributes->RestoreFromArray($Header->_PLNoAttributes);
        $this->PLDate = $Header->PLDate;
        $Header->_PLDateAttributes = $this->_PLDateAttributes;
        $this->Parent->PLDate->Value = $Header->PLDate;
        $this->Parent->PLDate->Attributes->RestoreFromArray($Header->_PLDateAttributes);
        $this->OrderRef = $Header->OrderRef;
        $Header->_OrderRefAttributes = $this->_OrderRefAttributes;
        $this->Parent->OrderRef->Value = $Header->OrderRef;
        $this->Parent->OrderRef->Attributes->RestoreFromArray($Header->_OrderRefAttributes);
        $this->Attn1 = $Header->Attn1;
        $Header->_Attn1Attributes = $this->_Attn1Attributes;
        $this->Parent->Attn1->Value = $Header->Attn1;
        $this->Parent->Attn1->Attributes->RestoreFromArray($Header->_Attn1Attributes);
        $this->Address1 = $Header->Address1;
        $Header->_Address1Attributes = $this->_Address1Attributes;
        $this->Parent->Address1->Value = $Header->Address1;
        $this->Parent->Address1->Attributes->RestoreFromArray($Header->_Address1Attributes);
        $this->Phone1 = $Header->Phone1;
        $Header->_Phone1Attributes = $this->_Phone1Attributes;
        $this->Parent->Phone1->Value = $Header->Phone1;
        $this->Parent->Phone1->Attributes->RestoreFromArray($Header->_Phone1Attributes);
        $this->Fax1 = $Header->Fax1;
        $Header->_Fax1Attributes = $this->_Fax1Attributes;
        $this->Parent->Fax1->Value = $Header->Fax1;
        $this->Parent->Fax1->Attributes->RestoreFromArray($Header->_Fax1Attributes);
        $this->Attn2 = $Header->Attn2;
        $Header->_Attn2Attributes = $this->_Attn2Attributes;
        $this->Parent->Attn2->Value = $Header->Attn2;
        $this->Parent->Attn2->Attributes->RestoreFromArray($Header->_Attn2Attributes);
        $this->Address2 = $Header->Address2;
        $Header->_Address2Attributes = $this->_Address2Attributes;
        $this->Parent->Address2->Value = $Header->Address2;
        $this->Parent->Address2->Attributes->RestoreFromArray($Header->_Address2Attributes);
        $this->Phone2 = $Header->Phone2;
        $Header->_Phone2Attributes = $this->_Phone2Attributes;
        $this->Parent->Phone2->Value = $Header->Phone2;
        $this->Parent->Phone2->Attributes->RestoreFromArray($Header->_Phone2Attributes);
        $this->Fax2 = $Header->Fax2;
        $Header->_Fax2Attributes = $this->_Fax2Attributes;
        $this->Parent->Fax2->Value = $Header->Fax2;
        $this->Parent->Fax2->Attributes->RestoreFromArray($Header->_Fax2Attributes);
        $this->Company1 = $Header->Company1;
        $Header->_Company1Attributes = $this->_Company1Attributes;
        $this->Parent->Company1->Value = $Header->Company1;
        $this->Parent->Company1->Attributes->RestoreFromArray($Header->_Company1Attributes);
        $this->AddressID = $Header->AddressID;
        $Header->_AddressIDAttributes = $this->_AddressIDAttributes;
        $this->Parent->AddressID->Value = $Header->AddressID;
        $this->Parent->AddressID->Attributes->RestoreFromArray($Header->_AddressIDAttributes);
        $this->DeliveryAddressID = $Header->DeliveryAddressID;
        $Header->_DeliveryAddressIDAttributes = $this->_DeliveryAddressIDAttributes;
        $this->Parent->DeliveryAddressID->Value = $Header->DeliveryAddressID;
        $this->Parent->DeliveryAddressID->Attributes->RestoreFromArray($Header->_DeliveryAddressIDAttributes);
        $this->Invoice_H_ID = $Header->Invoice_H_ID;
        $Header->_Invoice_H_IDAttributes = $this->_Invoice_H_IDAttributes;
        $this->Parent->Invoice_H_ID->Value = $Header->Invoice_H_ID;
        $this->Parent->Invoice_H_ID->Attributes->RestoreFromArray($Header->_Invoice_H_IDAttributes);
    }
    function ChangeTotalControls() {
    }
}
//End Header ReportGroup class

//Header GroupsCollection class @2-ED087188
class clsGroupsCollectionHeader {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectionHeader(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupHeader($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->Company->Value = $this->Parent->Company->initialValue;
        $this->Parent->PLNo->Value = $this->Parent->PLNo->initialValue;
        $this->Parent->PLDate->Value = $this->Parent->PLDate->initialValue;
        $this->Parent->OrderRef->Value = $this->Parent->OrderRef->initialValue;
        $this->Parent->Attn1->Value = $this->Parent->Attn1->initialValue;
        $this->Parent->Address1->Value = $this->Parent->Address1->initialValue;
        $this->Parent->Phone1->Value = $this->Parent->Phone1->initialValue;
        $this->Parent->Fax1->Value = $this->Parent->Fax1->initialValue;
        $this->Parent->Attn2->Value = $this->Parent->Attn2->initialValue;
        $this->Parent->Address2->Value = $this->Parent->Address2->initialValue;
        $this->Parent->Phone2->Value = $this->Parent->Phone2->initialValue;
        $this->Parent->Fax2->Value = $this->Parent->Fax2->initialValue;
        $this->Parent->Company1->Value = $this->Parent->Company1->initialValue;
        $this->Parent->AddressID->Value = $this->Parent->AddressID->initialValue;
        $this->Parent->DeliveryAddressID->Value = $this->Parent->DeliveryAddressID->initialValue;
        $this->Parent->Invoice_H_ID->Value = $this->Parent->Invoice_H_ID->initialValue;
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
//End Header GroupsCollection class

class clsReportHeader { //Header Class @2-D64CA6A2

//Header Variables @2-944D286E

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
//End Header Variables

//Class_Initialize Event @2-A7F47347
    function clsReportHeader($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Header";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->Detail = new clsSection($this);
        $MinPageSize = 0;
        $MaxSectionSize = 0;
        $this->Detail->Height = 5;
        $MaxSectionSize = max($MaxSectionSize, $this->Detail->Height);
        $this->Report_Footer = new clsSection($this);
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Footer->Height = 2;
        $MinPageSize += $this->Page_Footer->Height;
        $this->Page_Header = new clsSection($this);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsHeaderDataSource($this);
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
        $this->Company->IsEmptySource = true;
        $this->PLNo = new clsControl(ccsReportLabel, "PLNo", "PLNo", ccsText, "", "", $this);
        $this->PLDate = new clsControl(ccsReportLabel, "PLDate", "PLDate", ccsDate, $DefaultDateFormat, "", $this);
        $this->OrderRef = new clsControl(ccsReportLabel, "OrderRef", "OrderRef", ccsText, "", "", $this);
        $this->Attn1 = new clsControl(ccsReportLabel, "Attn1", "Attn1", ccsText, "", "", $this);
        $this->Attn1->IsEmptySource = true;
        $this->Address1 = new clsControl(ccsReportLabel, "Address1", "Address1", ccsMemo, "", "", $this);
        $this->Address1->IsEmptySource = true;
        $this->Phone1 = new clsControl(ccsReportLabel, "Phone1", "Phone1", ccsText, "", "", $this);
        $this->Phone1->IsEmptySource = true;
        $this->Fax1 = new clsControl(ccsReportLabel, "Fax1", "Fax1", ccsText, "", "", $this);
        $this->Fax1->IsEmptySource = true;
        $this->Attn2 = new clsControl(ccsReportLabel, "Attn2", "Attn2", ccsText, "", "", $this);
        $this->Attn2->IsEmptySource = true;
        $this->Address2 = new clsControl(ccsReportLabel, "Address2", "Address2", ccsMemo, "", "", $this);
        $this->Address2->IsEmptySource = true;
        $this->Phone2 = new clsControl(ccsReportLabel, "Phone2", "Phone2", ccsText, "", "", $this);
        $this->Phone2->IsEmptySource = true;
        $this->Fax2 = new clsControl(ccsReportLabel, "Fax2", "Fax2", ccsText, "", "", $this);
        $this->Fax2->IsEmptySource = true;
        $this->Company1 = new clsControl(ccsReportLabel, "Company1", "Company1", ccsText, "", "", $this);
        $this->Company1->IsEmptySource = true;
        $this->AddressID = new clsControl(ccsHidden, "AddressID", "AddressID", ccsInteger, "", CCGetRequestParam("AddressID", ccsGet, NULL), $this);
        $this->DeliveryAddressID = new clsControl(ccsHidden, "DeliveryAddressID", "DeliveryAddressID", ccsInteger, "", CCGetRequestParam("DeliveryAddressID", ccsGet, NULL), $this);
        $this->Invoice_H_ID = new clsControl(ccsHidden, "Invoice_H_ID", "Invoice_H_ID", ccsInteger, "", CCGetRequestParam("Invoice_H_ID", ccsGet, NULL), $this);
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->PageBreak = new clsPanel("PageBreak", $this);
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

//CheckErrors Method @2-97E86C30
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Company->Errors->Count());
        $errors = ($errors || $this->PLNo->Errors->Count());
        $errors = ($errors || $this->PLDate->Errors->Count());
        $errors = ($errors || $this->OrderRef->Errors->Count());
        $errors = ($errors || $this->Attn1->Errors->Count());
        $errors = ($errors || $this->Address1->Errors->Count());
        $errors = ($errors || $this->Phone1->Errors->Count());
        $errors = ($errors || $this->Fax1->Errors->Count());
        $errors = ($errors || $this->Attn2->Errors->Count());
        $errors = ($errors || $this->Address2->Errors->Count());
        $errors = ($errors || $this->Phone2->Errors->Count());
        $errors = ($errors || $this->Fax2->Errors->Count());
        $errors = ($errors || $this->Company1->Errors->Count());
        $errors = ($errors || $this->AddressID->Errors->Count());
        $errors = ($errors || $this->DeliveryAddressID->Errors->Count());
        $errors = ($errors || $this->Invoice_H_ID->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-8B4AB5BB
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Company->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PLNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PLDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->OrderRef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Attn1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Address1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Phone1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Fax1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Attn2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Address2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Phone2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Fax2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Company1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->AddressID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryAddressID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Invoice_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-3EFE4FD3
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urlPL_H_ID"] = CCGetFromGet("PL_H_ID", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $Groups = new clsGroupsCollectionHeader($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->PLNo->SetValue($this->DataSource->PLNo->GetValue());
            $this->PLDate->SetValue($this->DataSource->PLDate->GetValue());
            $this->OrderRef->SetValue($this->DataSource->OrderRef->GetValue());
            $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
            $this->DeliveryAddressID->SetValue($this->DataSource->DeliveryAddressID->GetValue());
            $this->Invoice_H_ID->SetValue($this->DataSource->Invoice_H_ID->GetValue());
            $this->Company->SetValue("");
            $this->Attn1->SetValue("");
            $this->Address1->SetValue("");
            $this->Phone1->SetValue("");
            $this->Fax1->SetValue("");
            $this->Attn2->SetValue("");
            $this->Address2->SetValue("");
            $this->Phone2->SetValue("");
            $this->Fax2->SetValue("");
            $this->Company1->SetValue("");
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
            $this->ControlsVisible["PLNo"] = $this->PLNo->Visible;
            $this->ControlsVisible["PLDate"] = $this->PLDate->Visible;
            $this->ControlsVisible["OrderRef"] = $this->OrderRef->Visible;
            $this->ControlsVisible["Attn1"] = $this->Attn1->Visible;
            $this->ControlsVisible["Address1"] = $this->Address1->Visible;
            $this->ControlsVisible["Phone1"] = $this->Phone1->Visible;
            $this->ControlsVisible["Fax1"] = $this->Fax1->Visible;
            $this->ControlsVisible["Attn2"] = $this->Attn2->Visible;
            $this->ControlsVisible["Address2"] = $this->Address2->Visible;
            $this->ControlsVisible["Phone2"] = $this->Phone2->Visible;
            $this->ControlsVisible["Fax2"] = $this->Fax2->Visible;
            $this->ControlsVisible["Company1"] = $this->Company1->Visible;
            $this->ControlsVisible["AddressID"] = $this->AddressID->Visible;
            $this->ControlsVisible["DeliveryAddressID"] = $this->DeliveryAddressID->Visible;
            $this->ControlsVisible["Invoice_H_ID"] = $this->Invoice_H_ID->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->Company->SetValue($items[$i]->Company);
                        $this->Company->Attributes->RestoreFromArray($items[$i]->_CompanyAttributes);
                        $this->PLNo->SetValue($items[$i]->PLNo);
                        $this->PLNo->Attributes->RestoreFromArray($items[$i]->_PLNoAttributes);
                        $this->PLDate->SetValue($items[$i]->PLDate);
                        $this->PLDate->Attributes->RestoreFromArray($items[$i]->_PLDateAttributes);
                        $this->OrderRef->SetValue($items[$i]->OrderRef);
                        $this->OrderRef->Attributes->RestoreFromArray($items[$i]->_OrderRefAttributes);
                        $this->Attn1->SetValue($items[$i]->Attn1);
                        $this->Attn1->Attributes->RestoreFromArray($items[$i]->_Attn1Attributes);
                        $this->Address1->SetValue($items[$i]->Address1);
                        $this->Address1->Attributes->RestoreFromArray($items[$i]->_Address1Attributes);
                        $this->Phone1->SetValue($items[$i]->Phone1);
                        $this->Phone1->Attributes->RestoreFromArray($items[$i]->_Phone1Attributes);
                        $this->Fax1->SetValue($items[$i]->Fax1);
                        $this->Fax1->Attributes->RestoreFromArray($items[$i]->_Fax1Attributes);
                        $this->Attn2->SetValue($items[$i]->Attn2);
                        $this->Attn2->Attributes->RestoreFromArray($items[$i]->_Attn2Attributes);
                        $this->Address2->SetValue($items[$i]->Address2);
                        $this->Address2->Attributes->RestoreFromArray($items[$i]->_Address2Attributes);
                        $this->Phone2->SetValue($items[$i]->Phone2);
                        $this->Phone2->Attributes->RestoreFromArray($items[$i]->_Phone2Attributes);
                        $this->Fax2->SetValue($items[$i]->Fax2);
                        $this->Fax2->Attributes->RestoreFromArray($items[$i]->_Fax2Attributes);
                        $this->Company1->SetValue($items[$i]->Company1);
                        $this->Company1->Attributes->RestoreFromArray($items[$i]->_Company1Attributes);
                        $this->AddressID->SetValue($items[$i]->AddressID);
                        $this->AddressID->Attributes->RestoreFromArray($items[$i]->_AddressIDAttributes);
                        $this->DeliveryAddressID->SetValue($items[$i]->DeliveryAddressID);
                        $this->DeliveryAddressID->Attributes->RestoreFromArray($items[$i]->_DeliveryAddressIDAttributes);
                        $this->Invoice_H_ID->SetValue($items[$i]->Invoice_H_ID);
                        $this->Invoice_H_ID->Attributes->RestoreFromArray($items[$i]->_Invoice_H_IDAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->Company->Show();
                        $this->PLNo->Show();
                        $this->PLDate->Show();
                        $this->OrderRef->Show();
                        $this->Attn1->Show();
                        $this->Address1->Show();
                        $this->Phone1->Show();
                        $this->Fax1->Show();
                        $this->Attn2->Show();
                        $this->Address2->Show();
                        $this->Phone2->Show();
                        $this->Fax2->Show();
                        $this->Company1->Show();
                        $this->AddressID->Show();
                        $this->DeliveryAddressID->Show();
                        $this->Invoice_H_ID->Show();
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
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
                                $this->PageBreak->Show();
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

} //End Header Class @2-FCB6E20C

class clsHeaderDataSource extends clsDBGayaFusionAll {  //HeaderDataSource Class @2-AB3B61E5

//DataSource Variables @2-37DB11CA
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $PLNo;
    public $PLDate;
    public $OrderRef;
    public $AddressID;
    public $DeliveryAddressID;
    public $Invoice_H_ID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-FAC4F31D
    function clsHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report Header";
        $this->Initialize();
        $this->PLNo = new clsField("PLNo", ccsText, "");
        
        $this->PLDate = new clsField("PLDate", ccsDate, $this->DateFormat);
        
        $this->OrderRef = new clsField("OrderRef", ccsText, "");
        
        $this->AddressID = new clsField("AddressID", ccsInteger, "");
        
        $this->DeliveryAddressID = new clsField("DeliveryAddressID", ccsInteger, "");
        
        $this->Invoice_H_ID = new clsField("Invoice_H_ID", ccsInteger, "");
        

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

//Prepare Method @2-324194E5
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlPL_H_ID", ccsInteger, "", "", $this->Parameters["urlPL_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "PL_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-19D44372
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_packinglist_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-C7BEAA23
    function SetValues()
    {
        $this->PLNo->SetDBValue($this->f("PLNo"));
        $this->PLDate->SetDBValue(trim($this->f("PLDate")));
        $this->OrderRef->SetDBValue($this->f("OrderRef"));
        $this->AddressID->SetDBValue(trim($this->f("AddressID")));
        $this->DeliveryAddressID->SetDBValue(trim($this->f("DeliveryAddressID")));
        $this->Invoice_H_ID->SetDBValue(trim($this->f("Invoice_H_ID")));
    }
//End SetValues Method

} //End HeaderDataSource Class @2-FCB6E20C

//Detil ReportGroup class @44-564CE5F5
class clsReportGroupDetil {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $BoxNumber, $BoxNumberDup, $_BoxNumberAttributes;
    public $Unit, $_UnitAttributes;
    public $Remarks, $_RemarksAttributes;
    public $Qty, $_QtyAttributes;
    public $CategoryName, $_CategoryNameAttributes;
    public $ColorName, $_ColorNameAttributes;
    public $MaterialName, $_MaterialNameAttributes;
    public $NameDesc, $_NameDescAttributes;
    public $SizeName, $_SizeNameAttributes;
    public $TextureName, $_TextureNameAttributes;
    public $Length, $_LengthAttributes;
    public $Width, $_WidthAttributes;
    public $Height, $_HeightAttributes;
    public $Weight, $_WeightAttributes;
    public $CollectDiameter, $_CollectDiameterAttributes;
    public $CollectWidth, $_CollectWidthAttributes;
    public $CollectHeight, $_CollectHeightAttributes;
    public $CollectLength, $_CollectLengthAttributes;
    public $cLIENTcODE, $_cLIENTcODEAttributes;
    public $ClientDesc, $_ClientDescAttributes;
    public $LocalRowNumber, $_LocalRowNumberAttributes;
    public $ReportLabel1, $_ReportLabel1Attributes;
    public $ReportLabel2, $_ReportLabel2Attributes;
    public $ReportLabel3, $_ReportLabel3Attributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;
    public $BoxNumberTotalIndex;

    function clsReportGroupDetil(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->BoxNumber = $this->Parent->BoxNumber->Value;
        $this->Unit = $this->Parent->Unit->Value;
        $this->Remarks = $this->Parent->Remarks->Value;
        $this->Qty = $this->Parent->Qty->Value;
        $this->CategoryName = $this->Parent->CategoryName->Value;
        $this->ColorName = $this->Parent->ColorName->Value;
        $this->MaterialName = $this->Parent->MaterialName->Value;
        $this->NameDesc = $this->Parent->NameDesc->Value;
        $this->SizeName = $this->Parent->SizeName->Value;
        $this->TextureName = $this->Parent->TextureName->Value;
        $this->Length = $this->Parent->Length->Value;
        $this->Width = $this->Parent->Width->Value;
        $this->Height = $this->Parent->Height->Value;
        $this->Weight = $this->Parent->Weight->Value;
        $this->CollectDiameter = $this->Parent->CollectDiameter->Value;
        $this->CollectWidth = $this->Parent->CollectWidth->Value;
        $this->CollectHeight = $this->Parent->CollectHeight->Value;
        $this->CollectLength = $this->Parent->CollectLength->Value;
        $this->cLIENTcODE = $this->Parent->cLIENTcODE->Value;
        $this->ClientDesc = $this->Parent->ClientDesc->Value;
        $this->LocalRowNumber = $this->Parent->LocalRowNumber->Value;
        $this->ReportLabel2 = $this->Parent->ReportLabel2->Value;
        $this->ReportLabel3 = $this->Parent->ReportLabel3->Value;
        if ($PrevGroup) {
            $this->BoxNumberDup =  CCCompareValues($this->BoxNumber, $PrevGroup->BoxNumber, $this->Parent->BoxNumber->DataType) == 0;
        }
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->ReportLabel1 = $this->Parent->ReportLabel1->GetTotalValue($mode);
        $this->_BoxNumberAttributes = $this->Parent->BoxNumber->Attributes->GetAsArray();
        $this->_UnitAttributes = $this->Parent->Unit->Attributes->GetAsArray();
        $this->_RemarksAttributes = $this->Parent->Remarks->Attributes->GetAsArray();
        $this->_QtyAttributes = $this->Parent->Qty->Attributes->GetAsArray();
        $this->_CategoryNameAttributes = $this->Parent->CategoryName->Attributes->GetAsArray();
        $this->_ColorNameAttributes = $this->Parent->ColorName->Attributes->GetAsArray();
        $this->_MaterialNameAttributes = $this->Parent->MaterialName->Attributes->GetAsArray();
        $this->_NameDescAttributes = $this->Parent->NameDesc->Attributes->GetAsArray();
        $this->_SizeNameAttributes = $this->Parent->SizeName->Attributes->GetAsArray();
        $this->_TextureNameAttributes = $this->Parent->TextureName->Attributes->GetAsArray();
        $this->_LengthAttributes = $this->Parent->Length->Attributes->GetAsArray();
        $this->_WidthAttributes = $this->Parent->Width->Attributes->GetAsArray();
        $this->_HeightAttributes = $this->Parent->Height->Attributes->GetAsArray();
        $this->_WeightAttributes = $this->Parent->Weight->Attributes->GetAsArray();
        $this->_CollectDiameterAttributes = $this->Parent->CollectDiameter->Attributes->GetAsArray();
        $this->_CollectWidthAttributes = $this->Parent->CollectWidth->Attributes->GetAsArray();
        $this->_CollectHeightAttributes = $this->Parent->CollectHeight->Attributes->GetAsArray();
        $this->_CollectLengthAttributes = $this->Parent->CollectLength->Attributes->GetAsArray();
        $this->_cLIENTcODEAttributes = $this->Parent->cLIENTcODE->Attributes->GetAsArray();
        $this->_ClientDescAttributes = $this->Parent->ClientDesc->Attributes->GetAsArray();
        $this->_LocalRowNumberAttributes = $this->Parent->LocalRowNumber->Attributes->GetAsArray();
        $this->_ReportLabel1Attributes = $this->Parent->ReportLabel1->Attributes->GetAsArray();
        $this->_ReportLabel2Attributes = $this->Parent->ReportLabel2->Attributes->GetAsArray();
        $this->_ReportLabel3Attributes = $this->Parent->ReportLabel3->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->ReportLabel1 = $this->ReportLabel1;
        $Header->_ReportLabel1Attributes = $this->_ReportLabel1Attributes;
        $this->BoxNumber = $Header->BoxNumber;
        $Header->_BoxNumberAttributes = $this->_BoxNumberAttributes;
        $this->Parent->BoxNumber->Value = $Header->BoxNumber;
        $this->Parent->BoxNumber->Attributes->RestoreFromArray($Header->_BoxNumberAttributes);
        $this->Unit = $Header->Unit;
        $Header->_UnitAttributes = $this->_UnitAttributes;
        $this->Parent->Unit->Value = $Header->Unit;
        $this->Parent->Unit->Attributes->RestoreFromArray($Header->_UnitAttributes);
        $this->Remarks = $Header->Remarks;
        $Header->_RemarksAttributes = $this->_RemarksAttributes;
        $this->Parent->Remarks->Value = $Header->Remarks;
        $this->Parent->Remarks->Attributes->RestoreFromArray($Header->_RemarksAttributes);
        $this->Qty = $Header->Qty;
        $Header->_QtyAttributes = $this->_QtyAttributes;
        $this->Parent->Qty->Value = $Header->Qty;
        $this->Parent->Qty->Attributes->RestoreFromArray($Header->_QtyAttributes);
        $this->CategoryName = $Header->CategoryName;
        $Header->_CategoryNameAttributes = $this->_CategoryNameAttributes;
        $this->Parent->CategoryName->Value = $Header->CategoryName;
        $this->Parent->CategoryName->Attributes->RestoreFromArray($Header->_CategoryNameAttributes);
        $this->ColorName = $Header->ColorName;
        $Header->_ColorNameAttributes = $this->_ColorNameAttributes;
        $this->Parent->ColorName->Value = $Header->ColorName;
        $this->Parent->ColorName->Attributes->RestoreFromArray($Header->_ColorNameAttributes);
        $this->MaterialName = $Header->MaterialName;
        $Header->_MaterialNameAttributes = $this->_MaterialNameAttributes;
        $this->Parent->MaterialName->Value = $Header->MaterialName;
        $this->Parent->MaterialName->Attributes->RestoreFromArray($Header->_MaterialNameAttributes);
        $this->NameDesc = $Header->NameDesc;
        $Header->_NameDescAttributes = $this->_NameDescAttributes;
        $this->Parent->NameDesc->Value = $Header->NameDesc;
        $this->Parent->NameDesc->Attributes->RestoreFromArray($Header->_NameDescAttributes);
        $this->SizeName = $Header->SizeName;
        $Header->_SizeNameAttributes = $this->_SizeNameAttributes;
        $this->Parent->SizeName->Value = $Header->SizeName;
        $this->Parent->SizeName->Attributes->RestoreFromArray($Header->_SizeNameAttributes);
        $this->TextureName = $Header->TextureName;
        $Header->_TextureNameAttributes = $this->_TextureNameAttributes;
        $this->Parent->TextureName->Value = $Header->TextureName;
        $this->Parent->TextureName->Attributes->RestoreFromArray($Header->_TextureNameAttributes);
        $this->Length = $Header->Length;
        $Header->_LengthAttributes = $this->_LengthAttributes;
        $this->Parent->Length->Value = $Header->Length;
        $this->Parent->Length->Attributes->RestoreFromArray($Header->_LengthAttributes);
        $this->Width = $Header->Width;
        $Header->_WidthAttributes = $this->_WidthAttributes;
        $this->Parent->Width->Value = $Header->Width;
        $this->Parent->Width->Attributes->RestoreFromArray($Header->_WidthAttributes);
        $this->Height = $Header->Height;
        $Header->_HeightAttributes = $this->_HeightAttributes;
        $this->Parent->Height->Value = $Header->Height;
        $this->Parent->Height->Attributes->RestoreFromArray($Header->_HeightAttributes);
        $this->Weight = $Header->Weight;
        $Header->_WeightAttributes = $this->_WeightAttributes;
        $this->Parent->Weight->Value = $Header->Weight;
        $this->Parent->Weight->Attributes->RestoreFromArray($Header->_WeightAttributes);
        $this->CollectDiameter = $Header->CollectDiameter;
        $Header->_CollectDiameterAttributes = $this->_CollectDiameterAttributes;
        $this->Parent->CollectDiameter->Value = $Header->CollectDiameter;
        $this->Parent->CollectDiameter->Attributes->RestoreFromArray($Header->_CollectDiameterAttributes);
        $this->CollectWidth = $Header->CollectWidth;
        $Header->_CollectWidthAttributes = $this->_CollectWidthAttributes;
        $this->Parent->CollectWidth->Value = $Header->CollectWidth;
        $this->Parent->CollectWidth->Attributes->RestoreFromArray($Header->_CollectWidthAttributes);
        $this->CollectHeight = $Header->CollectHeight;
        $Header->_CollectHeightAttributes = $this->_CollectHeightAttributes;
        $this->Parent->CollectHeight->Value = $Header->CollectHeight;
        $this->Parent->CollectHeight->Attributes->RestoreFromArray($Header->_CollectHeightAttributes);
        $this->CollectLength = $Header->CollectLength;
        $Header->_CollectLengthAttributes = $this->_CollectLengthAttributes;
        $this->Parent->CollectLength->Value = $Header->CollectLength;
        $this->Parent->CollectLength->Attributes->RestoreFromArray($Header->_CollectLengthAttributes);
        $this->cLIENTcODE = $Header->cLIENTcODE;
        $Header->_cLIENTcODEAttributes = $this->_cLIENTcODEAttributes;
        $this->Parent->cLIENTcODE->Value = $Header->cLIENTcODE;
        $this->Parent->cLIENTcODE->Attributes->RestoreFromArray($Header->_cLIENTcODEAttributes);
        $this->ClientDesc = $Header->ClientDesc;
        $Header->_ClientDescAttributes = $this->_ClientDescAttributes;
        $this->Parent->ClientDesc->Value = $Header->ClientDesc;
        $this->Parent->ClientDesc->Attributes->RestoreFromArray($Header->_ClientDescAttributes);
        $this->LocalRowNumber = $Header->LocalRowNumber;
        $Header->_LocalRowNumberAttributes = $this->_LocalRowNumberAttributes;
        $this->Parent->LocalRowNumber->Value = $Header->LocalRowNumber;
        $this->Parent->LocalRowNumber->Attributes->RestoreFromArray($Header->_LocalRowNumberAttributes);
        $this->ReportLabel2 = $Header->ReportLabel2;
        $Header->_ReportLabel2Attributes = $this->_ReportLabel2Attributes;
        $this->Parent->ReportLabel2->Value = $Header->ReportLabel2;
        $this->Parent->ReportLabel2->Attributes->RestoreFromArray($Header->_ReportLabel2Attributes);
        $this->ReportLabel3 = $Header->ReportLabel3;
        $Header->_ReportLabel3Attributes = $this->_ReportLabel3Attributes;
        $this->Parent->ReportLabel3->Value = $Header->ReportLabel3;
        $this->Parent->ReportLabel3->Attributes->RestoreFromArray($Header->_ReportLabel3Attributes);
    }
    function ChangeTotalControls() {
        $this->ReportLabel1 = $this->Parent->ReportLabel1->GetValue();
    }
}
//End Detil ReportGroup class

//Detil GroupsCollection class @44-B6431394
class clsGroupsCollectionDetil {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $mBoxNumberCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectionDetil(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mBoxNumberCurrentHeaderIndex = 1;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupDetil($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->BoxNumberTotalIndex = $this->mBoxNumberCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->BoxNumber->Value = $this->Parent->BoxNumber->initialValue;
        $this->Parent->Unit->Value = $this->Parent->Unit->initialValue;
        $this->Parent->Remarks->Value = $this->Parent->Remarks->initialValue;
        $this->Parent->Qty->Value = $this->Parent->Qty->initialValue;
        $this->Parent->CategoryName->Value = $this->Parent->CategoryName->initialValue;
        $this->Parent->ColorName->Value = $this->Parent->ColorName->initialValue;
        $this->Parent->MaterialName->Value = $this->Parent->MaterialName->initialValue;
        $this->Parent->NameDesc->Value = $this->Parent->NameDesc->initialValue;
        $this->Parent->SizeName->Value = $this->Parent->SizeName->initialValue;
        $this->Parent->TextureName->Value = $this->Parent->TextureName->initialValue;
        $this->Parent->Length->Value = $this->Parent->Length->initialValue;
        $this->Parent->Width->Value = $this->Parent->Width->initialValue;
        $this->Parent->Height->Value = $this->Parent->Height->initialValue;
        $this->Parent->Weight->Value = $this->Parent->Weight->initialValue;
        $this->Parent->CollectDiameter->Value = $this->Parent->CollectDiameter->initialValue;
        $this->Parent->CollectWidth->Value = $this->Parent->CollectWidth->initialValue;
        $this->Parent->CollectHeight->Value = $this->Parent->CollectHeight->initialValue;
        $this->Parent->CollectLength->Value = $this->Parent->CollectLength->initialValue;
        $this->Parent->cLIENTcODE->Value = $this->Parent->cLIENTcODE->initialValue;
        $this->Parent->ClientDesc->Value = $this->Parent->ClientDesc->initialValue;
        $this->Parent->LocalRowNumber->Value = $this->Parent->LocalRowNumber->initialValue;
        $this->Parent->ReportLabel1->Value = $this->Parent->ReportLabel1->initialValue;
        $this->Parent->ReportLabel2->Value = $this->Parent->ReportLabel2->initialValue;
        $this->Parent->ReportLabel3->Value = $this->Parent->ReportLabel3->initialValue;
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
        if ($groupName == "BoxNumber") {
            $GroupBoxNumber = & $this->InitGroup(true);
            $this->Parent->BoxNumber_Header->CCSEventResult = CCGetEvent($this->Parent->BoxNumber_Header->CCSEvents, "OnInitialize", $this->Parent->BoxNumber_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->BoxNumber_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->BoxNumber_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->BoxNumber_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->BoxNumber_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->BoxNumber_Header->Height;
                $GroupBoxNumber->SetTotalControls("GetNextValue");
            $this->Parent->BoxNumber_Header->CCSEventResult = CCGetEvent($this->Parent->BoxNumber_Header->CCSEvents, "OnCalculate", $this->Parent->BoxNumber_Header);
            $GroupBoxNumber->SetControls();
            $GroupBoxNumber->Mode = 1;
            $GroupBoxNumber->GroupType = "BoxNumber";
            $this->mBoxNumberCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $GroupBoxNumber;
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
        $GroupBoxNumber = & $this->InitGroup(true);
        $this->Parent->BoxNumber_Footer->CCSEventResult = CCGetEvent($this->Parent->BoxNumber_Footer->CCSEvents, "OnInitialize", $this->Parent->BoxNumber_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->BoxNumber_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->BoxNumber_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->BoxNumber_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $GroupBoxNumber->SetTotalControls("GetPrevValue");
        $GroupBoxNumber->SyncWithHeader($this->Groups[$this->mBoxNumberCurrentHeaderIndex]);
        if ($this->Parent->BoxNumber_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->BoxNumber_Footer->Height;
        $this->Parent->BoxNumber_Footer->CCSEventResult = CCGetEvent($this->Parent->BoxNumber_Footer->CCSEvents, "OnCalculate", $this->Parent->BoxNumber_Footer);
        $GroupBoxNumber->SetControls();
        $this->RestoreValues();
        $GroupBoxNumber->Mode = 2;
        $GroupBoxNumber->GroupType ="BoxNumber";
        $this->Groups[] = & $GroupBoxNumber;
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
//End Detil GroupsCollection class

class clsReportDetil { //Detil Class @44-25ACCD95

//Detil Variables @44-08AB895F

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
    public $BoxNumber_HeaderBlock, $BoxNumber_Header;
    public $BoxNumber_FooterBlock, $BoxNumber_Footer;
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
    public $BoxNumber_HeaderControls, $BoxNumber_FooterControls;
//End Detil Variables

//Class_Initialize Event @44-A2369A17
    function clsReportDetil($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Detil";
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
        $this->Page_Footer->Height = 1;
        $MinPageSize += $this->Page_Footer->Height;
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->BoxNumber_Footer = new clsSection($this);
        $this->BoxNumber_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->BoxNumber_Footer->Height);
        $this->BoxNumber_Header = new clsSection($this);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsDetilDataSource($this);
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

        $this->BoxNumber = new clsControl(ccsReportLabel, "BoxNumber", "BoxNumber", ccsText, "", "", $this);
        $this->Unit = new clsControl(ccsReportLabel, "Unit", "Unit", ccsText, "", "", $this);
        $this->Remarks = new clsControl(ccsReportLabel, "Remarks", "Remarks", ccsMemo, "", "", $this);
        $this->Qty = new clsControl(ccsReportLabel, "Qty", "Qty", ccsInteger, "", "", $this);
        $this->CategoryName = new clsControl(ccsReportLabel, "CategoryName", "CategoryName", ccsText, "", "", $this);
        $this->ColorName = new clsControl(ccsReportLabel, "ColorName", "ColorName", ccsText, "", "", $this);
        $this->MaterialName = new clsControl(ccsReportLabel, "MaterialName", "MaterialName", ccsText, "", "", $this);
        $this->NameDesc = new clsControl(ccsReportLabel, "NameDesc", "NameDesc", ccsText, "", "", $this);
        $this->SizeName = new clsControl(ccsReportLabel, "SizeName", "SizeName", ccsText, "", "", $this);
        $this->TextureName = new clsControl(ccsReportLabel, "TextureName", "TextureName", ccsText, "", "", $this);
        $this->Length = new clsControl(ccsReportLabel, "Length", "Length", ccsFloat, "", "", $this);
        $this->Width = new clsControl(ccsReportLabel, "Width", "Width", ccsFloat, "", "", $this);
        $this->Height = new clsControl(ccsReportLabel, "Height", "Height", ccsFloat, "", "", $this);
        $this->Weight = new clsControl(ccsReportLabel, "Weight", "Weight", ccsFloat, "", "", $this);
        $this->CollectDiameter = new clsControl(ccsReportLabel, "CollectDiameter", "CollectDiameter", ccsFloat, "", "", $this);
        $this->CollectWidth = new clsControl(ccsReportLabel, "CollectWidth", "CollectWidth", ccsFloat, "", "", $this);
        $this->CollectHeight = new clsControl(ccsReportLabel, "CollectHeight", "CollectHeight", ccsFloat, "", "", $this);
        $this->CollectLength = new clsControl(ccsReportLabel, "CollectLength", "CollectLength", ccsFloat, "", "", $this);
        $this->cLIENTcODE = new clsControl(ccsReportLabel, "cLIENTcODE", "cLIENTcODE", ccsText, "", "", $this);
        $this->cLIENTcODE->IsEmptySource = true;
        $this->ClientDesc = new clsControl(ccsReportLabel, "ClientDesc", "ClientDesc", ccsText, "", "", $this);
        $this->ClientDesc->IsEmptySource = true;
        $this->LocalRowNumber = new clsControl(ccsReportLabel, "LocalRowNumber", "LocalRowNumber", ccsText, "", "", $this);
        $this->LocalRowNumber->IsEmptySource = true;
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->ReportLabel1 = new clsControl(ccsReportLabel, "ReportLabel1", "ReportLabel1", ccsFloat, "", "", $this);
        $this->ReportLabel1->TotalFunction = "Sum";
        $this->ReportLabel2 = new clsControl(ccsReportLabel, "ReportLabel2", "ReportLabel2", ccsFloat, "", "", $this);
        $this->ReportLabel2->IsEmptySource = true;
        $this->ReportLabel3 = new clsControl(ccsReportLabel, "ReportLabel3", "ReportLabel3", ccsText, "", "", $this);
        $this->ReportLabel3->IsEmptySource = true;
    }
//End Class_Initialize Event

//Initialize Method @44-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @44-BE1F0439
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->BoxNumber->Errors->Count());
        $errors = ($errors || $this->Unit->Errors->Count());
        $errors = ($errors || $this->Remarks->Errors->Count());
        $errors = ($errors || $this->Qty->Errors->Count());
        $errors = ($errors || $this->CategoryName->Errors->Count());
        $errors = ($errors || $this->ColorName->Errors->Count());
        $errors = ($errors || $this->MaterialName->Errors->Count());
        $errors = ($errors || $this->NameDesc->Errors->Count());
        $errors = ($errors || $this->SizeName->Errors->Count());
        $errors = ($errors || $this->TextureName->Errors->Count());
        $errors = ($errors || $this->Length->Errors->Count());
        $errors = ($errors || $this->Width->Errors->Count());
        $errors = ($errors || $this->Height->Errors->Count());
        $errors = ($errors || $this->Weight->Errors->Count());
        $errors = ($errors || $this->CollectDiameter->Errors->Count());
        $errors = ($errors || $this->CollectWidth->Errors->Count());
        $errors = ($errors || $this->CollectHeight->Errors->Count());
        $errors = ($errors || $this->CollectLength->Errors->Count());
        $errors = ($errors || $this->cLIENTcODE->Errors->Count());
        $errors = ($errors || $this->ClientDesc->Errors->Count());
        $errors = ($errors || $this->LocalRowNumber->Errors->Count());
        $errors = ($errors || $this->ReportLabel1->Errors->Count());
        $errors = ($errors || $this->ReportLabel2->Errors->Count());
        $errors = ($errors || $this->ReportLabel3->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @44-04945D91
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->BoxNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Unit->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Remarks->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CategoryName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ColorName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MaterialName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SizeName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Length->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Width->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Height->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Weight->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectDiameter->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectWidth->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectHeight->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectLength->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cLIENTcODE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->LocalRowNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @44-00DD3FD2
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urlPL_H_ID"] = CCGetFromGet("PL_H_ID", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $BoxNumberKey = "";
        $Groups = new clsGroupsCollectionDetil($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->BoxNumber->SetValue($this->DataSource->BoxNumber->GetValue());
            $this->Unit->SetValue($this->DataSource->Unit->GetValue());
            $this->Remarks->SetValue($this->DataSource->Remarks->GetValue());
            $this->Qty->SetValue($this->DataSource->Qty->GetValue());
            $this->CategoryName->SetValue($this->DataSource->CategoryName->GetValue());
            $this->ColorName->SetValue($this->DataSource->ColorName->GetValue());
            $this->MaterialName->SetValue($this->DataSource->MaterialName->GetValue());
            $this->NameDesc->SetValue($this->DataSource->NameDesc->GetValue());
            $this->SizeName->SetValue($this->DataSource->SizeName->GetValue());
            $this->TextureName->SetValue($this->DataSource->TextureName->GetValue());
            $this->Length->SetValue($this->DataSource->Length->GetValue());
            $this->Width->SetValue($this->DataSource->Width->GetValue());
            $this->Height->SetValue($this->DataSource->Height->GetValue());
            $this->Weight->SetValue($this->DataSource->Weight->GetValue());
            $this->CollectDiameter->SetValue($this->DataSource->CollectDiameter->GetValue());
            $this->CollectWidth->SetValue($this->DataSource->CollectWidth->GetValue());
            $this->CollectHeight->SetValue($this->DataSource->CollectHeight->GetValue());
            $this->CollectLength->SetValue($this->DataSource->CollectLength->GetValue());
            $this->ReportLabel1->SetValue($this->DataSource->ReportLabel1->GetValue());
            $this->cLIENTcODE->SetValue("");
            $this->ClientDesc->SetValue("");
            $this->LocalRowNumber->SetValue("");
            $this->ReportLabel2->SetValue("");
            $this->ReportLabel3->SetValue("");
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $BoxNumberKey != $this->DataSource->f("BoxNumber")) {
                $Groups->OpenGroup("BoxNumber");
            }
            $Groups->AddItem();
            $BoxNumberKey = $this->DataSource->f("BoxNumber");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $BoxNumberKey != $this->DataSource->f("BoxNumber")) {
                $Groups->CloseGroup("BoxNumber");
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
            $this->ControlsVisible["BoxNumber"] = $this->BoxNumber->Visible;
            $this->ControlsVisible["Unit"] = $this->Unit->Visible;
            $this->ControlsVisible["Remarks"] = $this->Remarks->Visible;
            $this->ControlsVisible["Qty"] = $this->Qty->Visible;
            $this->ControlsVisible["CategoryName"] = $this->CategoryName->Visible;
            $this->ControlsVisible["ColorName"] = $this->ColorName->Visible;
            $this->ControlsVisible["MaterialName"] = $this->MaterialName->Visible;
            $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
            $this->ControlsVisible["SizeName"] = $this->SizeName->Visible;
            $this->ControlsVisible["TextureName"] = $this->TextureName->Visible;
            $this->ControlsVisible["Length"] = $this->Length->Visible;
            $this->ControlsVisible["Width"] = $this->Width->Visible;
            $this->ControlsVisible["Height"] = $this->Height->Visible;
            $this->ControlsVisible["Weight"] = $this->Weight->Visible;
            $this->ControlsVisible["CollectDiameter"] = $this->CollectDiameter->Visible;
            $this->ControlsVisible["CollectWidth"] = $this->CollectWidth->Visible;
            $this->ControlsVisible["CollectHeight"] = $this->CollectHeight->Visible;
            $this->ControlsVisible["CollectLength"] = $this->CollectLength->Visible;
            $this->ControlsVisible["cLIENTcODE"] = $this->cLIENTcODE->Visible;
            $this->ControlsVisible["ClientDesc"] = $this->ClientDesc->Visible;
            $this->ControlsVisible["LocalRowNumber"] = $this->LocalRowNumber->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->BoxNumber->Visible = $this->ControlsVisible["BoxNumber"] && !$items[$i]->BoxNumberDup;
                        $this->BoxNumber->SetValue($items[$i]->BoxNumber);
                        $this->BoxNumber->Attributes->RestoreFromArray($items[$i]->_BoxNumberAttributes);
                        $this->Unit->SetValue($items[$i]->Unit);
                        $this->Unit->Attributes->RestoreFromArray($items[$i]->_UnitAttributes);
                        $this->Remarks->SetValue($items[$i]->Remarks);
                        $this->Remarks->Attributes->RestoreFromArray($items[$i]->_RemarksAttributes);
                        $this->Qty->SetValue($items[$i]->Qty);
                        $this->Qty->Attributes->RestoreFromArray($items[$i]->_QtyAttributes);
                        $this->CategoryName->SetValue($items[$i]->CategoryName);
                        $this->CategoryName->Attributes->RestoreFromArray($items[$i]->_CategoryNameAttributes);
                        $this->ColorName->SetValue($items[$i]->ColorName);
                        $this->ColorName->Attributes->RestoreFromArray($items[$i]->_ColorNameAttributes);
                        $this->MaterialName->SetValue($items[$i]->MaterialName);
                        $this->MaterialName->Attributes->RestoreFromArray($items[$i]->_MaterialNameAttributes);
                        $this->NameDesc->SetValue($items[$i]->NameDesc);
                        $this->NameDesc->Attributes->RestoreFromArray($items[$i]->_NameDescAttributes);
                        $this->SizeName->SetValue($items[$i]->SizeName);
                        $this->SizeName->Attributes->RestoreFromArray($items[$i]->_SizeNameAttributes);
                        $this->TextureName->SetValue($items[$i]->TextureName);
                        $this->TextureName->Attributes->RestoreFromArray($items[$i]->_TextureNameAttributes);
                        $this->Length->SetValue($items[$i]->Length);
                        $this->Length->Attributes->RestoreFromArray($items[$i]->_LengthAttributes);
                        $this->Width->SetValue($items[$i]->Width);
                        $this->Width->Attributes->RestoreFromArray($items[$i]->_WidthAttributes);
                        $this->Height->SetValue($items[$i]->Height);
                        $this->Height->Attributes->RestoreFromArray($items[$i]->_HeightAttributes);
                        $this->Weight->SetValue($items[$i]->Weight);
                        $this->Weight->Attributes->RestoreFromArray($items[$i]->_WeightAttributes);
                        $this->CollectDiameter->SetValue($items[$i]->CollectDiameter);
                        $this->CollectDiameter->Attributes->RestoreFromArray($items[$i]->_CollectDiameterAttributes);
                        $this->CollectWidth->SetValue($items[$i]->CollectWidth);
                        $this->CollectWidth->Attributes->RestoreFromArray($items[$i]->_CollectWidthAttributes);
                        $this->CollectHeight->SetValue($items[$i]->CollectHeight);
                        $this->CollectHeight->Attributes->RestoreFromArray($items[$i]->_CollectHeightAttributes);
                        $this->CollectLength->SetValue($items[$i]->CollectLength);
                        $this->CollectLength->Attributes->RestoreFromArray($items[$i]->_CollectLengthAttributes);
                        $this->cLIENTcODE->SetValue($items[$i]->cLIENTcODE);
                        $this->cLIENTcODE->Attributes->RestoreFromArray($items[$i]->_cLIENTcODEAttributes);
                        $this->ClientDesc->SetValue($items[$i]->ClientDesc);
                        $this->ClientDesc->Attributes->RestoreFromArray($items[$i]->_ClientDescAttributes);
                        $this->LocalRowNumber->SetValue($items[$i]->LocalRowNumber);
                        $this->LocalRowNumber->Attributes->RestoreFromArray($items[$i]->_LocalRowNumberAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->BoxNumber->Show();
                        $this->Unit->Show();
                        $this->Remarks->Show();
                        $this->Qty->Show();
                        $this->CategoryName->Show();
                        $this->ColorName->Show();
                        $this->MaterialName->Show();
                        $this->NameDesc->Show();
                        $this->SizeName->Show();
                        $this->TextureName->Show();
                        $this->Length->Show();
                        $this->Width->Show();
                        $this->Height->Show();
                        $this->Weight->Show();
                        $this->CollectDiameter->Show();
                        $this->CollectWidth->Show();
                        $this->CollectHeight->Show();
                        $this->CollectLength->Show();
                        $this->cLIENTcODE->Show();
                        $this->ClientDesc->Show();
                        $this->LocalRowNumber->Show();
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
                            $this->ReportLabel1->SetValue($items[$i]->ReportLabel1);
                            $this->ReportLabel1->Attributes->RestoreFromArray($items[$i]->_ReportLabel1Attributes);
                            $this->ReportLabel2->SetValue($items[$i]->ReportLabel2);
                            $this->ReportLabel2->Attributes->RestoreFromArray($items[$i]->_ReportLabel2Attributes);
                            $this->ReportLabel3->SetValue($items[$i]->ReportLabel3);
                            $this->ReportLabel3->Attributes->RestoreFromArray($items[$i]->_ReportLabel3Attributes);
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
                                $this->ReportLabel1->Show();
                                $this->ReportLabel2->Show();
                                $this->ReportLabel3->Show();
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
                    case "BoxNumber":
                        if ($items[$i]->Mode == 1) {
                            $this->BoxNumber_Header->CCSEventResult = CCGetEvent($this->BoxNumber_Header->CCSEvents, "BeforeShow", $this->BoxNumber_Header);
                            if ($this->BoxNumber_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section BoxNumber_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section BoxNumber_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->BoxNumber_Footer->CCSEventResult = CCGetEvent($this->BoxNumber_Footer->CCSEvents, "BeforeShow", $this->BoxNumber_Footer);
                            if ($this->BoxNumber_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section BoxNumber_Footer";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section BoxNumber_Footer", true, "Section Detail");
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

} //End Detil Class @44-FCB6E20C

class clsDetilDataSource extends clsDBGayaFusionAll {  //DetilDataSource Class @44-28B8FEE9

//DataSource Variables @44-71775091
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $BoxNumber;
    public $Unit;
    public $Remarks;
    public $Qty;
    public $CategoryName;
    public $ColorName;
    public $MaterialName;
    public $NameDesc;
    public $SizeName;
    public $TextureName;
    public $Length;
    public $Width;
    public $Height;
    public $Weight;
    public $CollectDiameter;
    public $CollectWidth;
    public $CollectHeight;
    public $CollectLength;
    public $ReportLabel1;
//End DataSource Variables

//DataSourceClass_Initialize Event @44-49B98901
    function clsDetilDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report Detil";
        $this->Initialize();
        $this->BoxNumber = new clsField("BoxNumber", ccsText, "");
        
        $this->Unit = new clsField("Unit", ccsText, "");
        
        $this->Remarks = new clsField("Remarks", ccsMemo, "");
        
        $this->Qty = new clsField("Qty", ccsInteger, "");
        
        $this->CategoryName = new clsField("CategoryName", ccsText, "");
        
        $this->ColorName = new clsField("ColorName", ccsText, "");
        
        $this->MaterialName = new clsField("MaterialName", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->SizeName = new clsField("SizeName", ccsText, "");
        
        $this->TextureName = new clsField("TextureName", ccsText, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Weight = new clsField("Weight", ccsFloat, "");
        
        $this->CollectDiameter = new clsField("CollectDiameter", ccsFloat, "");
        
        $this->CollectWidth = new clsField("CollectWidth", ccsFloat, "");
        
        $this->CollectHeight = new clsField("CollectHeight", ccsFloat, "");
        
        $this->CollectLength = new clsField("CollectLength", ccsFloat, "");
        
        $this->ReportLabel1 = new clsField("ReportLabel1", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @44-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @44-6874A8A6
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlPL_H_ID", ccsInteger, "", "", $this->Parameters["urlPL_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_box_h.PL_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @44-EF011D57
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT tbladminist_box_h.*, tblcollect_color.*, NameDesc, SizeName, TextureName, DesignName, CategoryName, MaterialName, tblcollect_master.Width AS CollectWidth,\n\n" .
        "tblcollect_master.Height AS CollectHeight, tblcollect_master.Length AS CollectLength, Diameter AS CollectDiameter, Qty,\n\n" .
        "Unit, Remarks, ClientCode, ClientDescription, tbladminist_box_d.Box_H_ID AS Box_H_ID \n\n" .
        "FROM ((((((((tbladminist_box_d INNER JOIN tbladminist_box_h ON\n\n" .
        "tbladminist_box_d.Box_H_ID = tbladminist_box_h.Box_H_ID) INNER JOIN tblcollect_master ON\n\n" .
        "tbladminist_box_d.CollectID = tblcollect_master.ID) INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "tbladminist_box_h.BoxNumber asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @44-DCE26884
    function SetValues()
    {
        $this->BoxNumber->SetDBValue($this->f("BoxNumber"));
        $this->Unit->SetDBValue($this->f("Unit"));
        $this->Remarks->SetDBValue($this->f("Remarks"));
        $this->Qty->SetDBValue(trim($this->f("Qty")));
        $this->CategoryName->SetDBValue($this->f("CategoryName"));
        $this->ColorName->SetDBValue($this->f("ColorName"));
        $this->MaterialName->SetDBValue($this->f("MaterialName"));
        $this->NameDesc->SetDBValue($this->f("NameDesc"));
        $this->SizeName->SetDBValue($this->f("SizeName"));
        $this->TextureName->SetDBValue($this->f("TextureName"));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Weight->SetDBValue(trim($this->f("Weight")));
        $this->CollectDiameter->SetDBValue(trim($this->f("CollectDiameter")));
        $this->CollectWidth->SetDBValue(trim($this->f("CollectWidth")));
        $this->CollectHeight->SetDBValue(trim($this->f("CollectHeight")));
        $this->CollectLength->SetDBValue(trim($this->f("CollectLength")));
        $this->ReportLabel1->SetDBValue(trim($this->f("Qty")));
    }
//End SetValues Method

} //End DetilDataSource Class @44-FCB6E20C

//Initialize Page @1-699C1280
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
$TemplateFileName = "ShowPL.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C0B9528C
include_once("./ShowPL_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1B3D249A
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = new clsReportHeader("", $MainPage);
$Report_Print = new clsControl(ccsLink, "Report_Print", "Report_Print", ccsText, "", CCGetRequestParam("Report_Print", ccsGet, NULL), $MainPage);
$Report_Print->Page = "ShowPL.php";
$Detil = new clsReportDetil("", $MainPage);
$lblAdministrasi = new clsControl(ccsLabel, "lblAdministrasi", "lblAdministrasi", ccsText, "", CCGetRequestParam("lblAdministrasi", ccsGet, NULL), $MainPage);
$lblCustomer = new clsControl(ccsLabel, "lblCustomer", "lblCustomer", ccsText, "", CCGetRequestParam("lblCustomer", ccsGet, NULL), $MainPage);
$MainPage->Header = & $Header;
$MainPage->Report_Print = & $Report_Print;
$MainPage->Detil = & $Detil;
$MainPage->lblAdministrasi = & $lblAdministrasi;
$MainPage->lblCustomer = & $lblCustomer;
$Report_Print->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Report_Print->Parameters = CCAddParam($Report_Print->Parameters, "ViewMode", "Print");
$Header->Initialize();
$Detil->Initialize();

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

//Go to destination page @1-4C0FF4C7
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Header);
    unset($Detil);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-682F532B
$Header->Show();
$Detil->Show();
$Report_Print->Show();
$lblAdministrasi->Show();
$lblCustomer->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-AE87764E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Header);
unset($Detil);
unset($Tpl);
//End Unload Page


?>
