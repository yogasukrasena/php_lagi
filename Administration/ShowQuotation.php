<?php
//Include Common Files @1-6A97B9F2
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowQuotation.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridHeader { //Header class @2-C9AA34A2

//Variables @2-6E51DF5A

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
//End Variables

//Class_Initialize Event @2-9E1778D5
    function clsGridHeader($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Header";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Header";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsHeaderDataSource($this);
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

        $this->Validity = new clsControl(ccsLabel, "Validity", "Validity", ccsText, "", CCGetRequestParam("Validity", ccsGet, NULL), $this);
        $this->QuotationDate = new clsControl(ccsLabel, "QuotationDate", "QuotationDate", ccsDate, $DefaultDateFormat, CCGetRequestParam("QuotationDate", ccsGet, NULL), $this);
        $this->ClientID = new clsControl(ccsHidden, "ClientID", "ClientID", ccsInteger, "", CCGetRequestParam("ClientID", ccsGet, NULL), $this);
        $this->AddressID = new clsControl(ccsHidden, "AddressID", "AddressID", ccsInteger, "", CCGetRequestParam("AddressID", ccsGet, NULL), $this);
        $this->QuotationContactID = new clsControl(ccsHidden, "QuotationContactID", "QuotationContactID", ccsInteger, "", CCGetRequestParam("QuotationContactID", ccsGet, NULL), $this);
        $this->DeliveryContactID = new clsControl(ccsHidden, "DeliveryContactID", "DeliveryContactID", ccsInteger, "", CCGetRequestParam("DeliveryContactID", ccsGet, NULL), $this);
        $this->DeliveryTermID = new clsControl(ccsHidden, "DeliveryTermID", "DeliveryTermID", ccsInteger, "", CCGetRequestParam("DeliveryTermID", ccsGet, NULL), $this);
        $this->DeliveryTimeID = new clsControl(ccsHidden, "DeliveryTimeID", "DeliveryTimeID", ccsInteger, "", CCGetRequestParam("DeliveryTimeID", ccsGet, NULL), $this);
        $this->PaymentTermID = new clsControl(ccsHidden, "PaymentTermID", "PaymentTermID", ccsInteger, "", CCGetRequestParam("PaymentTermID", ccsGet, NULL), $this);
        $this->SpecialInstruction = new clsControl(ccsLabel, "SpecialInstruction", "SpecialInstruction", ccsMemo, "", CCGetRequestParam("SpecialInstruction", ccsGet, NULL), $this);
        $this->Client = new clsControl(ccsLabel, "Client", "Client", ccsText, "", CCGetRequestParam("Client", ccsGet, NULL), $this);
        $this->Address = new clsControl(ccsLabel, "Address", "Address", ccsText, "", CCGetRequestParam("Address", ccsGet, NULL), $this);
        $this->QuotationContact = new clsControl(ccsLabel, "QuotationContact", "QuotationContact", ccsText, "", CCGetRequestParam("QuotationContact", ccsGet, NULL), $this);
        $this->QuotationEmail = new clsControl(ccsLabel, "QuotationEmail", "QuotationEmail", ccsText, "", CCGetRequestParam("QuotationEmail", ccsGet, NULL), $this);
        $this->QuotationAddress = new clsControl(ccsLabel, "QuotationAddress", "QuotationAddress", ccsMemo, "", CCGetRequestParam("QuotationAddress", ccsGet, NULL), $this);
        $this->QuotationPhone = new clsControl(ccsLabel, "QuotationPhone", "QuotationPhone", ccsText, "", CCGetRequestParam("QuotationPhone", ccsGet, NULL), $this);
        $this->QuotationFax = new clsControl(ccsLabel, "QuotationFax", "QuotationFax", ccsText, "", CCGetRequestParam("QuotationFax", ccsGet, NULL), $this);
        $this->DeliveryContact = new clsControl(ccsLabel, "DeliveryContact", "DeliveryContact", ccsText, "", CCGetRequestParam("DeliveryContact", ccsGet, NULL), $this);
        $this->DeliveryEmail = new clsControl(ccsLabel, "DeliveryEmail", "DeliveryEmail", ccsText, "", CCGetRequestParam("DeliveryEmail", ccsGet, NULL), $this);
        $this->DeliveryAddress = new clsControl(ccsLabel, "DeliveryAddress", "DeliveryAddress", ccsMemo, "", CCGetRequestParam("DeliveryAddress", ccsGet, NULL), $this);
        $this->DeliveryPhone = new clsControl(ccsLabel, "DeliveryPhone", "DeliveryPhone", ccsText, "", CCGetRequestParam("DeliveryPhone", ccsGet, NULL), $this);
        $this->DeliveryFax = new clsControl(ccsLabel, "DeliveryFax", "DeliveryFax", ccsText, "", CCGetRequestParam("DeliveryFax", ccsGet, NULL), $this);
        $this->DeliveryTem = new clsControl(ccsLabel, "DeliveryTem", "DeliveryTem", ccsText, "", CCGetRequestParam("DeliveryTem", ccsGet, NULL), $this);
        $this->DocMaker = new clsControl(ccsHidden, "DocMaker", "DocMaker", ccsInteger, "", CCGetRequestParam("DocMaker", ccsGet, NULL), $this);
        $this->Currency = new clsControl(ccsHidden, "Currency", "Currency", ccsInteger, "", CCGetRequestParam("Currency", ccsGet, NULL), $this);
        $this->DeliveryTime = new clsControl(ccsLabel, "DeliveryTime", "DeliveryTime", ccsText, "", CCGetRequestParam("DeliveryTime", ccsGet, NULL), $this);
        $this->PaymentTerm = new clsControl(ccsLabel, "PaymentTerm", "PaymentTerm", ccsText, "", CCGetRequestParam("PaymentTerm", ccsGet, NULL), $this);
        $this->DeliveryAddressID = new clsControl(ccsHidden, "DeliveryAddressID", "DeliveryAddressID", ccsInteger, "", CCGetRequestParam("DeliveryAddressID", ccsGet, NULL), $this);
        $this->DeliveryAddr = new clsControl(ccsLabel, "DeliveryAddr", "DeliveryAddr", ccsText, "", CCGetRequestParam("DeliveryAddr", ccsGet, NULL), $this);
        $this->QuotationNo = new clsControl(ccsLabel, "QuotationNo", "QuotationNo", ccsText, "", CCGetRequestParam("QuotationNo", ccsGet, NULL), $this);
        $this->Rev = new clsControl(ccsLabel, "Rev", "Rev", ccsText, "", CCGetRequestParam("Rev", ccsGet, NULL), $this);
        $this->ClientOrderRef = new clsControl(ccsLabel, "ClientOrderRef", "ClientOrderRef", ccsText, "", CCGetRequestParam("ClientOrderRef", ccsGet, NULL), $this);
        $this->PackagingCost = new clsControl(ccsLabel, "PackagingCost", "PackagingCost", ccsSingle, "", CCGetRequestParam("PackagingCost", ccsGet, NULL), $this);
        $this->Quotation_H_ID = new clsControl(ccsHidden, "Quotation_H_ID", "Quotation_H_ID", ccsInteger, "", CCGetRequestParam("Quotation_H_ID", ccsGet, NULL), $this);
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

//Show Method @2-C003D863
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlQuotation_H_ID"] = CCGetFromGet("Quotation_H_ID", NULL);

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
            $this->ControlsVisible["Validity"] = $this->Validity->Visible;
            $this->ControlsVisible["QuotationDate"] = $this->QuotationDate->Visible;
            $this->ControlsVisible["ClientID"] = $this->ClientID->Visible;
            $this->ControlsVisible["AddressID"] = $this->AddressID->Visible;
            $this->ControlsVisible["QuotationContactID"] = $this->QuotationContactID->Visible;
            $this->ControlsVisible["DeliveryContactID"] = $this->DeliveryContactID->Visible;
            $this->ControlsVisible["DeliveryTermID"] = $this->DeliveryTermID->Visible;
            $this->ControlsVisible["DeliveryTimeID"] = $this->DeliveryTimeID->Visible;
            $this->ControlsVisible["PaymentTermID"] = $this->PaymentTermID->Visible;
            $this->ControlsVisible["SpecialInstruction"] = $this->SpecialInstruction->Visible;
            $this->ControlsVisible["Client"] = $this->Client->Visible;
            $this->ControlsVisible["Address"] = $this->Address->Visible;
            $this->ControlsVisible["QuotationContact"] = $this->QuotationContact->Visible;
            $this->ControlsVisible["QuotationEmail"] = $this->QuotationEmail->Visible;
            $this->ControlsVisible["QuotationAddress"] = $this->QuotationAddress->Visible;
            $this->ControlsVisible["QuotationPhone"] = $this->QuotationPhone->Visible;
            $this->ControlsVisible["QuotationFax"] = $this->QuotationFax->Visible;
            $this->ControlsVisible["DeliveryContact"] = $this->DeliveryContact->Visible;
            $this->ControlsVisible["DeliveryEmail"] = $this->DeliveryEmail->Visible;
            $this->ControlsVisible["DeliveryAddress"] = $this->DeliveryAddress->Visible;
            $this->ControlsVisible["DeliveryPhone"] = $this->DeliveryPhone->Visible;
            $this->ControlsVisible["DeliveryFax"] = $this->DeliveryFax->Visible;
            $this->ControlsVisible["DeliveryTem"] = $this->DeliveryTem->Visible;
            $this->ControlsVisible["DocMaker"] = $this->DocMaker->Visible;
            $this->ControlsVisible["Currency"] = $this->Currency->Visible;
            $this->ControlsVisible["DeliveryTime"] = $this->DeliveryTime->Visible;
            $this->ControlsVisible["PaymentTerm"] = $this->PaymentTerm->Visible;
            $this->ControlsVisible["DeliveryAddressID"] = $this->DeliveryAddressID->Visible;
            $this->ControlsVisible["DeliveryAddr"] = $this->DeliveryAddr->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Validity->SetValue($this->DataSource->Validity->GetValue());
                $this->QuotationDate->SetValue($this->DataSource->QuotationDate->GetValue());
                $this->ClientID->SetValue($this->DataSource->ClientID->GetValue());
                $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
                $this->QuotationContactID->SetValue($this->DataSource->QuotationContactID->GetValue());
                $this->DeliveryContactID->SetValue($this->DataSource->DeliveryContactID->GetValue());
                $this->DeliveryTermID->SetValue($this->DataSource->DeliveryTermID->GetValue());
                $this->DeliveryTimeID->SetValue($this->DataSource->DeliveryTimeID->GetValue());
                $this->PaymentTermID->SetValue($this->DataSource->PaymentTermID->GetValue());
                $this->SpecialInstruction->SetValue($this->DataSource->SpecialInstruction->GetValue());
                $this->DocMaker->SetValue($this->DataSource->DocMaker->GetValue());
                $this->Currency->SetValue($this->DataSource->Currency->GetValue());
                $this->DeliveryAddressID->SetValue($this->DataSource->DeliveryAddressID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Validity->Show();
                $this->QuotationDate->Show();
                $this->ClientID->Show();
                $this->AddressID->Show();
                $this->QuotationContactID->Show();
                $this->DeliveryContactID->Show();
                $this->DeliveryTermID->Show();
                $this->DeliveryTimeID->Show();
                $this->PaymentTermID->Show();
                $this->SpecialInstruction->Show();
                $this->Client->Show();
                $this->Address->Show();
                $this->QuotationContact->Show();
                $this->QuotationEmail->Show();
                $this->QuotationAddress->Show();
                $this->QuotationPhone->Show();
                $this->QuotationFax->Show();
                $this->DeliveryContact->Show();
                $this->DeliveryEmail->Show();
                $this->DeliveryAddress->Show();
                $this->DeliveryPhone->Show();
                $this->DeliveryFax->Show();
                $this->DeliveryTem->Show();
                $this->DocMaker->Show();
                $this->Currency->Show();
                $this->DeliveryTime->Show();
                $this->PaymentTerm->Show();
                $this->DeliveryAddressID->Show();
                $this->DeliveryAddr->Show();
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
        $this->QuotationNo->SetValue($this->DataSource->QuotationNo->GetValue());
        $this->Rev->SetValue($this->DataSource->Rev->GetValue());
        $this->ClientOrderRef->SetValue($this->DataSource->ClientOrderRef->GetValue());
        $this->PackagingCost->SetValue($this->DataSource->PackagingCost->GetValue());
        $this->Quotation_H_ID->SetValue($this->DataSource->Quotation_H_ID->GetValue());
        $this->QuotationNo->Show();
        $this->Rev->Show();
        $this->ClientOrderRef->Show();
        $this->PackagingCost->Show();
        $this->Quotation_H_ID->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-BD45D76C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Validity->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->AddressID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationContactID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryContactID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryTermID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryTimeID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PaymentTermID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SpecialInstruction->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Client->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Address->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationContact->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationEmail->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationAddress->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationPhone->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationFax->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryContact->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryEmail->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryAddress->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryPhone->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryFax->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryTem->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DocMaker->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Currency->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryTime->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PaymentTerm->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryAddressID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryAddr->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Header Class @2-FCB6E20C

class clsHeaderDataSource extends clsDBGayaFusionAll {  //HeaderDataSource Class @2-AB3B61E5

//DataSource Variables @2-FC088511
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $QuotationNo;
    public $Rev;
    public $Validity;
    public $QuotationDate;
    public $ClientOrderRef;
    public $ClientID;
    public $AddressID;
    public $QuotationContactID;
    public $DeliveryContactID;
    public $PackagingCost;
    public $DeliveryTermID;
    public $DeliveryTimeID;
    public $PaymentTermID;
    public $SpecialInstruction;
    public $Quotation_H_ID;
    public $DocMaker;
    public $Currency;
    public $DeliveryAddressID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-49779AF0
    function clsHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Header";
        $this->Initialize();
        $this->QuotationNo = new clsField("QuotationNo", ccsText, "");
        
        $this->Rev = new clsField("Rev", ccsText, "");
        
        $this->Validity = new clsField("Validity", ccsText, "");
        
        $this->QuotationDate = new clsField("QuotationDate", ccsDate, $this->DateFormat);
        
        $this->ClientOrderRef = new clsField("ClientOrderRef", ccsText, "");
        
        $this->ClientID = new clsField("ClientID", ccsInteger, "");
        
        $this->AddressID = new clsField("AddressID", ccsInteger, "");
        
        $this->QuotationContactID = new clsField("QuotationContactID", ccsInteger, "");
        
        $this->DeliveryContactID = new clsField("DeliveryContactID", ccsInteger, "");
        
        $this->PackagingCost = new clsField("PackagingCost", ccsSingle, "");
        
        $this->DeliveryTermID = new clsField("DeliveryTermID", ccsInteger, "");
        
        $this->DeliveryTimeID = new clsField("DeliveryTimeID", ccsInteger, "");
        
        $this->PaymentTermID = new clsField("PaymentTermID", ccsInteger, "");
        
        $this->SpecialInstruction = new clsField("SpecialInstruction", ccsMemo, "");
        
        $this->Quotation_H_ID = new clsField("Quotation_H_ID", ccsInteger, "");
        
        $this->DocMaker = new clsField("DocMaker", ccsInteger, "");
        
        $this->Currency = new clsField("Currency", ccsInteger, "");
        
        $this->DeliveryAddressID = new clsField("DeliveryAddressID", ccsInteger, "");
        

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

//Prepare Method @2-CC9CA820
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlQuotation_H_ID", ccsInteger, "", "", $this->Parameters["urlQuotation_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Quotation_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-D839838D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_quotation_h";
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_quotation_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-206EBECD
    function SetValues()
    {
        $this->QuotationNo->SetDBValue($this->f("QuotationNo"));
        $this->Rev->SetDBValue($this->f("Rev"));
        $this->Validity->SetDBValue($this->f("Validity"));
        $this->QuotationDate->SetDBValue(trim($this->f("QuotationDate")));
        $this->ClientOrderRef->SetDBValue($this->f("ClientOrderRef"));
        $this->ClientID->SetDBValue(trim($this->f("ClientID")));
        $this->AddressID->SetDBValue(trim($this->f("AddressID")));
        $this->QuotationContactID->SetDBValue(trim($this->f("QuotationContactID")));
        $this->DeliveryContactID->SetDBValue(trim($this->f("DeliveryContactID")));
        $this->PackagingCost->SetDBValue(trim($this->f("PackagingCost")));
        $this->DeliveryTermID->SetDBValue(trim($this->f("DeliveryTermID")));
        $this->DeliveryTimeID->SetDBValue(trim($this->f("DeliveryTimeID")));
        $this->PaymentTermID->SetDBValue(trim($this->f("PaymentTermID")));
        $this->SpecialInstruction->SetDBValue($this->f("SpecialInstruction"));
        $this->Quotation_H_ID->SetDBValue(trim($this->f("Quotation_H_ID")));
        $this->DocMaker->SetDBValue(trim($this->f("DocMaker")));
        $this->Currency->SetDBValue(trim($this->f("Currency")));
        $this->DeliveryAddressID->SetDBValue(trim($this->f("DeliveryAddressID")));
    }
//End SetValues Method

} //End HeaderDataSource Class @2-FCB6E20C

//Detil ReportGroup class @22-9BDFCBCE
class clsReportGroupDetil {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $SampleCode, $_SampleCodeAttributes;
    public $SampleDescription, $_SampleDescriptionAttributes;
    public $Width, $_WidthAttributes;
    public $Height, $_HeightAttributes;
    public $Length, $_LengthAttributes;
    public $Diameter, $_DiameterAttributes;
    public $UnitPrice, $_UnitPriceAttributes;
    public $Remark, $_RemarkAttributes;
    public $LocalRowNumber, $_LocalRowNumberAttributes;
    public $Photo1, $_Photo1Attributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;

    function clsReportGroupDetil(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->SampleCode = $this->Parent->SampleCode->Value;
        $this->SampleDescription = $this->Parent->SampleDescription->Value;
        $this->Width = $this->Parent->Width->Value;
        $this->Height = $this->Parent->Height->Value;
        $this->Length = $this->Parent->Length->Value;
        $this->Diameter = $this->Parent->Diameter->Value;
        $this->UnitPrice = $this->Parent->UnitPrice->Value;
        $this->Remark = $this->Parent->Remark->Value;
        $this->LocalRowNumber = $this->Parent->LocalRowNumber->Value;
        $this->Photo1 = $this->Parent->Photo1->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->_SampleCodeAttributes = $this->Parent->SampleCode->Attributes->GetAsArray();
        $this->_SampleDescriptionAttributes = $this->Parent->SampleDescription->Attributes->GetAsArray();
        $this->_WidthAttributes = $this->Parent->Width->Attributes->GetAsArray();
        $this->_HeightAttributes = $this->Parent->Height->Attributes->GetAsArray();
        $this->_LengthAttributes = $this->Parent->Length->Attributes->GetAsArray();
        $this->_DiameterAttributes = $this->Parent->Diameter->Attributes->GetAsArray();
        $this->_UnitPriceAttributes = $this->Parent->UnitPrice->Attributes->GetAsArray();
        $this->_RemarkAttributes = $this->Parent->Remark->Attributes->GetAsArray();
        $this->_LocalRowNumberAttributes = $this->Parent->LocalRowNumber->Attributes->GetAsArray();
        $this->_Photo1Attributes = $this->Parent->Photo1->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $this->SampleCode = $Header->SampleCode;
        $Header->_SampleCodeAttributes = $this->_SampleCodeAttributes;
        $this->Parent->SampleCode->Value = $Header->SampleCode;
        $this->Parent->SampleCode->Attributes->RestoreFromArray($Header->_SampleCodeAttributes);
        $this->SampleDescription = $Header->SampleDescription;
        $Header->_SampleDescriptionAttributes = $this->_SampleDescriptionAttributes;
        $this->Parent->SampleDescription->Value = $Header->SampleDescription;
        $this->Parent->SampleDescription->Attributes->RestoreFromArray($Header->_SampleDescriptionAttributes);
        $this->Width = $Header->Width;
        $Header->_WidthAttributes = $this->_WidthAttributes;
        $this->Parent->Width->Value = $Header->Width;
        $this->Parent->Width->Attributes->RestoreFromArray($Header->_WidthAttributes);
        $this->Height = $Header->Height;
        $Header->_HeightAttributes = $this->_HeightAttributes;
        $this->Parent->Height->Value = $Header->Height;
        $this->Parent->Height->Attributes->RestoreFromArray($Header->_HeightAttributes);
        $this->Length = $Header->Length;
        $Header->_LengthAttributes = $this->_LengthAttributes;
        $this->Parent->Length->Value = $Header->Length;
        $this->Parent->Length->Attributes->RestoreFromArray($Header->_LengthAttributes);
        $this->Diameter = $Header->Diameter;
        $Header->_DiameterAttributes = $this->_DiameterAttributes;
        $this->Parent->Diameter->Value = $Header->Diameter;
        $this->Parent->Diameter->Attributes->RestoreFromArray($Header->_DiameterAttributes);
        $this->UnitPrice = $Header->UnitPrice;
        $Header->_UnitPriceAttributes = $this->_UnitPriceAttributes;
        $this->Parent->UnitPrice->Value = $Header->UnitPrice;
        $this->Parent->UnitPrice->Attributes->RestoreFromArray($Header->_UnitPriceAttributes);
        $this->Remark = $Header->Remark;
        $Header->_RemarkAttributes = $this->_RemarkAttributes;
        $this->Parent->Remark->Value = $Header->Remark;
        $this->Parent->Remark->Attributes->RestoreFromArray($Header->_RemarkAttributes);
        $this->LocalRowNumber = $Header->LocalRowNumber;
        $Header->_LocalRowNumberAttributes = $this->_LocalRowNumberAttributes;
        $this->Parent->LocalRowNumber->Value = $Header->LocalRowNumber;
        $this->Parent->LocalRowNumber->Attributes->RestoreFromArray($Header->_LocalRowNumberAttributes);
        $this->Photo1 = $Header->Photo1;
        $Header->_Photo1Attributes = $this->_Photo1Attributes;
        $this->Parent->Photo1->Value = $Header->Photo1;
        $this->Parent->Photo1->Attributes->RestoreFromArray($Header->_Photo1Attributes);
    }
    function ChangeTotalControls() {
    }
}
//End Detil ReportGroup class

//Detil GroupsCollection class @22-482BE523
class clsGroupsCollectionDetil {
    public $Groups;
    public $mPageCurrentHeaderIndex;
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
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupDetil($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->SampleCode->Value = $this->Parent->SampleCode->initialValue;
        $this->Parent->SampleDescription->Value = $this->Parent->SampleDescription->initialValue;
        $this->Parent->Width->Value = $this->Parent->Width->initialValue;
        $this->Parent->Height->Value = $this->Parent->Height->initialValue;
        $this->Parent->Length->Value = $this->Parent->Length->initialValue;
        $this->Parent->Diameter->Value = $this->Parent->Diameter->initialValue;
        $this->Parent->UnitPrice->Value = $this->Parent->UnitPrice->initialValue;
        $this->Parent->Remark->Value = $this->Parent->Remark->initialValue;
        $this->Parent->LocalRowNumber->Value = $this->Parent->LocalRowNumber->initialValue;
        $this->Parent->Photo1->Value = $this->Parent->Photo1->initialValue;
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
//End Detil GroupsCollection class

class clsReportDetil { //Detil Class @22-25ACCD95

//Detil Variables @22-944D286E

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
//End Detil Variables

//Class_Initialize Event @22-7065C736
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
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Footer->Height = 1;
        $this->Page_Footer->Visible = false;
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
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
                $this->PageSize = 30;
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

        $this->SampleCode = new clsControl(ccsReportLabel, "SampleCode", "SampleCode", ccsText, "", "", $this);
        $this->SampleCode->HTML = true;
        $this->SampleCode->EmptyText = "&nbsp;";
        $this->SampleDescription = new clsControl(ccsReportLabel, "SampleDescription", "SampleDescription", ccsText, "", "", $this);
        $this->SampleDescription->HTML = true;
        $this->SampleDescription->EmptyText = "&nbsp;";
        $this->Width = new clsControl(ccsReportLabel, "Width", "Width", ccsFloat, "", "", $this);
        $this->Width->HTML = true;
        $this->Width->EmptyText = "&nbsp;";
        $this->Height = new clsControl(ccsReportLabel, "Height", "Height", ccsFloat, "", "", $this);
        $this->Height->HTML = true;
        $this->Height->EmptyText = "&nbsp;";
        $this->Length = new clsControl(ccsReportLabel, "Length", "Length", ccsFloat, "", "", $this);
        $this->Length->HTML = true;
        $this->Length->EmptyText = "&nbsp;";
        $this->Diameter = new clsControl(ccsReportLabel, "Diameter", "Diameter", ccsFloat, "", "", $this);
        $this->Diameter->HTML = true;
        $this->Diameter->EmptyText = "&nbsp;";
        $this->UnitPrice = new clsControl(ccsReportLabel, "UnitPrice", "UnitPrice", ccsFloat, "", "", $this);
        $this->UnitPrice->HTML = true;
        $this->UnitPrice->EmptyText = "&nbsp;";
        $this->Remark = new clsControl(ccsReportLabel, "Remark", "Remark", ccsMemo, "", "", $this);
        $this->Remark->HTML = true;
        $this->Remark->EmptyText = "&nbsp;";
        $this->LocalRowNumber = new clsControl(ccsReportLabel, "LocalRowNumber", "LocalRowNumber", ccsText, "", "", $this);
        $this->LocalRowNumber->IsEmptySource = true;
        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @22-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @22-0A2AFA7D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->SampleCode->Errors->Count());
        $errors = ($errors || $this->SampleDescription->Errors->Count());
        $errors = ($errors || $this->Width->Errors->Count());
        $errors = ($errors || $this->Height->Errors->Count());
        $errors = ($errors || $this->Length->Errors->Count());
        $errors = ($errors || $this->Diameter->Errors->Count());
        $errors = ($errors || $this->UnitPrice->Errors->Count());
        $errors = ($errors || $this->Remark->Errors->Count());
        $errors = ($errors || $this->LocalRowNumber->Errors->Count());
        $errors = ($errors || $this->Photo1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @22-AE2D37CB
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->SampleCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SampleDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Width->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Height->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Length->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Diameter->Errors->ToString());
        $errors = ComposeStrings($errors, $this->UnitPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->LocalRowNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @22-084C1556
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urlQuotation_H_ID"] = CCGetFromGet("Quotation_H_ID", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $Groups = new clsGroupsCollectionDetil($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->SampleCode->SetValue($this->DataSource->SampleCode->GetValue());
            $this->SampleDescription->SetValue($this->DataSource->SampleDescription->GetValue());
            $this->Width->SetValue($this->DataSource->Width->GetValue());
            $this->Height->SetValue($this->DataSource->Height->GetValue());
            $this->Length->SetValue($this->DataSource->Length->GetValue());
            $this->Diameter->SetValue($this->DataSource->Diameter->GetValue());
            $this->UnitPrice->SetValue($this->DataSource->UnitPrice->GetValue());
            $this->Remark->SetValue($this->DataSource->Remark->GetValue());
            $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
            $this->LocalRowNumber->SetValue("");
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

        $this->Attributes->SetValue("LocalRowNumber", "");
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
            $this->ControlsVisible["SampleCode"] = $this->SampleCode->Visible;
            $this->ControlsVisible["SampleDescription"] = $this->SampleDescription->Visible;
            $this->ControlsVisible["Width"] = $this->Width->Visible;
            $this->ControlsVisible["Height"] = $this->Height->Visible;
            $this->ControlsVisible["Length"] = $this->Length->Visible;
            $this->ControlsVisible["Diameter"] = $this->Diameter->Visible;
            $this->ControlsVisible["UnitPrice"] = $this->UnitPrice->Visible;
            $this->ControlsVisible["Remark"] = $this->Remark->Visible;
            $this->ControlsVisible["LocalRowNumber"] = $this->LocalRowNumber->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->SampleCode->SetValue($items[$i]->SampleCode);
                        $this->SampleCode->Attributes->RestoreFromArray($items[$i]->_SampleCodeAttributes);
                        $this->SampleDescription->SetValue($items[$i]->SampleDescription);
                        $this->SampleDescription->Attributes->RestoreFromArray($items[$i]->_SampleDescriptionAttributes);
                        $this->Width->SetValue($items[$i]->Width);
                        $this->Width->Attributes->RestoreFromArray($items[$i]->_WidthAttributes);
                        $this->Height->SetValue($items[$i]->Height);
                        $this->Height->Attributes->RestoreFromArray($items[$i]->_HeightAttributes);
                        $this->Length->SetValue($items[$i]->Length);
                        $this->Length->Attributes->RestoreFromArray($items[$i]->_LengthAttributes);
                        $this->Diameter->SetValue($items[$i]->Diameter);
                        $this->Diameter->Attributes->RestoreFromArray($items[$i]->_DiameterAttributes);
                        $this->UnitPrice->SetValue($items[$i]->UnitPrice);
                        $this->UnitPrice->Attributes->RestoreFromArray($items[$i]->_UnitPriceAttributes);
                        $this->Remark->SetValue($items[$i]->Remark);
                        $this->Remark->Attributes->RestoreFromArray($items[$i]->_RemarkAttributes);
                        $this->LocalRowNumber->SetValue($items[$i]->LocalRowNumber);
                        $this->LocalRowNumber->Attributes->RestoreFromArray($items[$i]->_LocalRowNumberAttributes);
                        $this->Photo1->SetValue($items[$i]->Photo1);
                        $this->Photo1->Attributes->RestoreFromArray($items[$i]->_Photo1Attributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->SampleCode->Show();
                        $this->SampleDescription->Show();
                        $this->Width->Show();
                        $this->Height->Show();
                        $this->Length->Show();
                        $this->Diameter->Show();
                        $this->UnitPrice->Show();
                        $this->Remark->Show();
                        $this->LocalRowNumber->Show();
                        $this->Photo1->Show();
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
                            $this->Navigator->PageNumber = $items[$i]->PageNumber;
                            $this->Navigator->TotalPages = $Groups->TotalPages;
                            $this->Navigator->Visible = ("Print" != $this->ViewMode);
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
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

} //End Detil Class @22-FCB6E20C

class clsDetilDataSource extends clsDBGayaFusionAll {  //DetilDataSource Class @22-28B8FEE9

//DataSource Variables @22-6CF7B2F4
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $SampleCode;
    public $SampleDescription;
    public $Width;
    public $Height;
    public $Length;
    public $Diameter;
    public $UnitPrice;
    public $Remark;
    public $Photo1;
//End DataSource Variables

//DataSourceClass_Initialize Event @22-F06BAA2A
    function clsDetilDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report Detil";
        $this->Initialize();
        $this->SampleCode = new clsField("SampleCode", ccsText, "");
        
        $this->SampleDescription = new clsField("SampleDescription", ccsText, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->Diameter = new clsField("Diameter", ccsFloat, "");
        
        $this->UnitPrice = new clsField("UnitPrice", ccsFloat, "");
        
        $this->Remark = new clsField("Remark", ccsMemo, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @22-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @22-C9B6F5F2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlQuotation_H_ID", ccsInteger, "", "", $this->Parameters["urlQuotation_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_quotation_d.Quotation_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @22-D9351A3E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT UnitPrice, Remark, SampleCode, SampleDescription, Photo1, Width, Height, Length, Diameter \n\n" .
        "FROM tbladminist_quotation_d INNER JOIN sampleceramic ON\n\n" .
        "tbladminist_quotation_d.RndCode = sampleceramic.SampleCode {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @22-37087867
    function SetValues()
    {
        $this->SampleCode->SetDBValue($this->f("SampleCode"));
        $this->SampleDescription->SetDBValue($this->f("SampleDescription"));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
        $this->UnitPrice->SetDBValue(trim($this->f("UnitPrice")));
        $this->Remark->SetDBValue($this->f("Remark"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
    }
//End SetValues Method

} //End DetilDataSource Class @22-FCB6E20C

//Initialize Page @1-C1349B0B
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
$TemplateFileName = "ShowQuotation.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-880EC5A2
include_once("./ShowQuotation_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-0ED15434
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = new clsGridHeader("", $MainPage);
$Detil = new clsReportDetil("", $MainPage);
$Report_Print = new clsControl(ccsLink, "Report_Print", "Report_Print", ccsText, "", CCGetRequestParam("Report_Print", ccsGet, NULL), $MainPage);
$Report_Print->HTML = true;
$Report_Print->Page = "ShowQuotation.php";
$lblAdministrasi = new clsControl(ccsLabel, "lblAdministrasi", "lblAdministrasi", ccsText, "", CCGetRequestParam("lblAdministrasi", ccsGet, NULL), $MainPage);
$lblCustomer = new clsControl(ccsLabel, "lblCustomer", "lblCustomer", ccsText, "", CCGetRequestParam("lblCustomer", ccsGet, NULL), $MainPage);
$MainPage->Header = & $Header;
$MainPage->Detil = & $Detil;
$MainPage->Report_Print = & $Report_Print;
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

//Show Page @1-133C0301
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
