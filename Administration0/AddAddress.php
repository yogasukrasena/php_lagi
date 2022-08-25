<?php
//Include Common Files @1-7B7D8999
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "AddAddress.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

class clsRecordSearch { //Search Class @3-39E8735D

//Variables @3-9E315808

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

//Class_Initialize Event @3-C4DC9FC4
    function clsRecordSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Search/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Search";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_Company = new clsControl(ccsListBox, "s_Company", "s_Company", ccsText, "", CCGetRequestParam("s_Company", $Method, NULL), $this);
            $this->s_Company->DSType = dsTable;
            $this->s_Company->DataSource = new clsDBGayaFusionAll();
            $this->s_Company->ds = & $this->s_Company->DataSource;
            $this->s_Company->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook {SQL_Where} {SQL_OrderBy}";
            list($this->s_Company->BoundColumn, $this->s_Company->TextColumn, $this->s_Company->DBFormat) = array("Company", "Company", "");
            $this->s_Contact = new clsControl(ccsTextBox, "s_Contact", "s_Contact", ccsText, "", CCGetRequestParam("s_Contact", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-E0E7E9E7
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_Company->Validate() && $Validation);
        $Validation = ($this->s_Contact->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_Company->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_Contact->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-754F5B95
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_Company->Errors->Count());
        $errors = ($errors || $this->s_Contact->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
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

//Operation Method @3-7BBDEEA5
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
        $Redirect = "AddAddress.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "AddAddress.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-B41AEF62
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

        $this->s_Company->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_Company->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_Contact->Errors->ToString());
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

        $this->Button_DoSearch->Show();
        $this->s_Company->Show();
        $this->s_Contact->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End Search Class @3-FCB6E20C

class clsGridGrid { //Grid class @2-76129994

//Variables @2-0E0D4E5D

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
    public $Sorter_AddressID;
    public $Sorter_Company;
    public $Sorter_Contact;
    public $Sorter_Email;
    public $Sorter_Address;
    public $Sorter_Phone;
    public $Sorter_Fax;
//End Variables

//Class_Initialize Event @2-39AE4EC1
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

        $this->AddressID = new clsControl(ccsLink, "AddressID", "AddressID", ccsInteger, "", CCGetRequestParam("AddressID", ccsGet, NULL), $this);
        $this->AddressID->Page = "AddAddress.php";
        $this->Company = new clsControl(ccsLabel, "Company", "Company", ccsText, "", CCGetRequestParam("Company", ccsGet, NULL), $this);
        $this->Contact = new clsControl(ccsLabel, "Contact", "Contact", ccsText, "", CCGetRequestParam("Contact", ccsGet, NULL), $this);
        $this->Email = new clsControl(ccsLabel, "Email", "Email", ccsText, "", CCGetRequestParam("Email", ccsGet, NULL), $this);
        $this->Address = new clsControl(ccsLabel, "Address", "Address", ccsText, "", CCGetRequestParam("Address", ccsGet, NULL), $this);
        $this->Phone = new clsControl(ccsLabel, "Phone", "Phone", ccsText, "", CCGetRequestParam("Phone", ccsGet, NULL), $this);
        $this->Fax = new clsControl(ccsLabel, "Fax", "Fax", ccsText, "", CCGetRequestParam("Fax", ccsGet, NULL), $this);
        $this->tbladminist_addressbook_Insert = new clsControl(ccsLink, "tbladminist_addressbook_Insert", "tbladminist_addressbook_Insert", ccsText, "", CCGetRequestParam("tbladminist_addressbook_Insert", ccsGet, NULL), $this);
        $this->tbladminist_addressbook_Insert->Parameters = CCGetQueryString("QueryString", array("AddressID", "ccsForm"));
        $this->tbladminist_addressbook_Insert->Page = "AddAddress.php";
        $this->tbladminist_addressbook_TotalRecords = new clsControl(ccsLabel, "tbladminist_addressbook_TotalRecords", "tbladminist_addressbook_TotalRecords", ccsText, "", CCGetRequestParam("tbladminist_addressbook_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_AddressID = new clsSorter($this->ComponentName, "Sorter_AddressID", $FileName, $this);
        $this->Sorter_Company = new clsSorter($this->ComponentName, "Sorter_Company", $FileName, $this);
        $this->Sorter_Contact = new clsSorter($this->ComponentName, "Sorter_Contact", $FileName, $this);
        $this->Sorter_Email = new clsSorter($this->ComponentName, "Sorter_Email", $FileName, $this);
        $this->Sorter_Address = new clsSorter($this->ComponentName, "Sorter_Address", $FileName, $this);
        $this->Sorter_Phone = new clsSorter($this->ComponentName, "Sorter_Phone", $FileName, $this);
        $this->Sorter_Fax = new clsSorter($this->ComponentName, "Sorter_Fax", $FileName, $this);
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

//Show Method @2-B034000B
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_Company"] = CCGetFromGet("s_Company", NULL);
        $this->DataSource->Parameters["urls_Contact"] = CCGetFromGet("s_Contact", NULL);

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
            $this->ControlsVisible["AddressID"] = $this->AddressID->Visible;
            $this->ControlsVisible["Company"] = $this->Company->Visible;
            $this->ControlsVisible["Contact"] = $this->Contact->Visible;
            $this->ControlsVisible["Email"] = $this->Email->Visible;
            $this->ControlsVisible["Address"] = $this->Address->Visible;
            $this->ControlsVisible["Phone"] = $this->Phone->Visible;
            $this->ControlsVisible["Fax"] = $this->Fax->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
                $this->AddressID->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->AddressID->Parameters = CCAddParam($this->AddressID->Parameters, "AddressID", $this->DataSource->f("AddressID"));
                $this->Company->SetValue($this->DataSource->Company->GetValue());
                $this->Contact->SetValue($this->DataSource->Contact->GetValue());
                $this->Email->SetValue($this->DataSource->Email->GetValue());
                $this->Address->SetValue($this->DataSource->Address->GetValue());
                $this->Phone->SetValue($this->DataSource->Phone->GetValue());
                $this->Fax->SetValue($this->DataSource->Fax->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->AddressID->Show();
                $this->Company->Show();
                $this->Contact->Show();
                $this->Email->Show();
                $this->Address->Show();
                $this->Phone->Show();
                $this->Fax->Show();
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
        $this->tbladminist_addressbook_Insert->Show();
        $this->tbladminist_addressbook_TotalRecords->Show();
        $this->Sorter_AddressID->Show();
        $this->Sorter_Company->Show();
        $this->Sorter_Contact->Show();
        $this->Sorter_Email->Show();
        $this->Sorter_Address->Show();
        $this->Sorter_Phone->Show();
        $this->Sorter_Fax->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-FBE2DB0B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->AddressID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Company->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Contact->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Email->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Address->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Phone->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Fax->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid Class @2-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @2-7708C172

//DataSource Variables @2-8F754B21
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $AddressID;
    public $Company;
    public $Contact;
    public $Email;
    public $Address;
    public $Phone;
    public $Fax;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-C3B64DE4
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid";
        $this->Initialize();
        $this->AddressID = new clsField("AddressID", ccsInteger, "");
        
        $this->Company = new clsField("Company", ccsText, "");
        
        $this->Contact = new clsField("Contact", ccsText, "");
        
        $this->Email = new clsField("Email", ccsText, "");
        
        $this->Address = new clsField("Address", ccsText, "");
        
        $this->Phone = new clsField("Phone", ccsText, "");
        
        $this->Fax = new clsField("Fax", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-E2E518AE
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "AddressID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_AddressID" => array("AddressID", ""), 
            "Sorter_Company" => array("Company", ""), 
            "Sorter_Contact" => array("Contact", ""), 
            "Sorter_Email" => array("Email", ""), 
            "Sorter_Address" => array("Address", ""), 
            "Sorter_Phone" => array("Phone", ""), 
            "Sorter_Fax" => array("Fax", "")));
    }
//End SetOrder Method

//Prepare Method @2-CE4C20F4
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_Company", ccsText, "", "", $this->Parameters["urls_Company"], "", false);
        $this->wp->AddParameter("2", "urls_Contact", ccsText, "", "", $this->Parameters["urls_Contact"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "Company", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "Contact", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-A21ED04C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_addressbook";
        $this->SQL = "SELECT AddressID, Company, Contact, Email, Address, Phone, Fax \n\n" .
        "FROM tbladminist_addressbook {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-74D6B593
    function SetValues()
    {
        $this->AddressID->SetDBValue(trim($this->f("AddressID")));
        $this->Company->SetDBValue($this->f("Company"));
        $this->Contact->SetDBValue($this->f("Contact"));
        $this->Email->SetDBValue($this->f("Email"));
        $this->Address->SetDBValue($this->f("Address"));
        $this->Phone->SetDBValue($this->f("Phone"));
        $this->Fax->SetDBValue($this->f("Fax"));
    }
//End SetValues Method

} //End GridDataSource Class @2-FCB6E20C

class clsRecordAdd { //Add Class @35-6BEB52A8

//Variables @35-9E315808

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

//Class_Initialize Event @35-BFA0DF63
    function clsRecordAdd($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Add/Error";
        $this->DataSource = new clsAddDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Add";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Company = new clsControl(ccsTextBox, "Company", "Company", ccsText, "", CCGetRequestParam("Company", $Method, NULL), $this);
            $this->Company->Required = true;
            $this->Contact = new clsControl(ccsTextBox, "Contact", "Contact", ccsText, "", CCGetRequestParam("Contact", $Method, NULL), $this);
            $this->AddressID = new clsControl(ccsTextBox, "AddressID", "AddressID", ccsInteger, "", CCGetRequestParam("AddressID", $Method, NULL), $this);
            $this->Edit = new clsPanel("Edit", $this);
            $this->EditInfo = new clsControl(ccsLink, "EditInfo", "EditInfo", ccsText, "", CCGetRequestParam("EditInfo", $Method, NULL), $this);
            $this->EditInfo->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->EditInfo->Page = "#";
            $this->Edit->AddComponent("EditInfo", $this->EditInfo);
        }
    }
//End Class_Initialize Event

//Initialize Method @35-2CBF6B15
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlAddressID"] = CCGetFromGet("AddressID", NULL);
    }
//End Initialize Method

//Validate Method @35-A8EEE6C0
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->Company->Validate() && $Validation);
        $Validation = ($this->Contact->Validate() && $Validation);
        $Validation = ($this->AddressID->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->Company->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Contact->Errors->Count() == 0);
        $Validation =  $Validation && ($this->AddressID->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @35-AFAD86A2
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Company->Errors->Count());
        $errors = ($errors || $this->Contact->Errors->Count());
        $errors = ($errors || $this->AddressID->Errors->Count());
        $errors = ($errors || $this->EditInfo->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @35-ED598703
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

//Operation Method @35-B908BA44
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
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

//InsertRow Method @35-7BE9D841
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->Company->SetValue($this->Company->GetValue(true));
        $this->DataSource->Contact->SetValue($this->Contact->GetValue(true));
        $this->DataSource->AddressID->SetValue($this->AddressID->GetValue(true));
        $this->DataSource->EditInfo->SetValue($this->EditInfo->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @35-A1ECB03E
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->Company->SetValue($this->Company->GetValue(true));
        $this->DataSource->Contact->SetValue($this->Contact->GetValue(true));
        $this->DataSource->AddressID->SetValue($this->AddressID->GetValue(true));
        $this->DataSource->EditInfo->SetValue($this->EditInfo->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @35-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @35-93511E5A
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
                    $this->Company->SetValue($this->DataSource->Company->GetValue());
                    $this->Contact->SetValue($this->DataSource->Contact->GetValue());
                    $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->Company->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Contact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddressID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EditInfo->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Company->Show();
        $this->Contact->Show();
        $this->AddressID->Show();
        $this->Edit->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End Add Class @35-FCB6E20C

class clsAddDataSource extends clsDBGayaFusionAll {  //AddDataSource Class @35-1F150DA3

//DataSource Variables @35-ABC66CBC
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $Company;
    public $Contact;
    public $AddressID;
    public $EditInfo;
//End DataSource Variables

//DataSourceClass_Initialize Event @35-2C12F5BD
    function clsAddDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record Add/Error";
        $this->Initialize();
        $this->Company = new clsField("Company", ccsText, "");
        
        $this->Contact = new clsField("Contact", ccsText, "");
        
        $this->AddressID = new clsField("AddressID", ccsInteger, "");
        
        $this->EditInfo = new clsField("EditInfo", ccsText, "");
        

        $this->InsertFields["Company"] = array("Name" => "Company", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Contact"] = array("Name" => "Contact", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["AddressID"] = array("Name" => "AddressID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Company"] = array("Name" => "Company", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Contact"] = array("Name" => "Contact", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["AddressID"] = array("Name" => "AddressID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @35-75248612
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlAddressID", ccsInteger, "", "", $this->Parameters["urlAddressID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "AddressID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @35-E832B8E6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_addressbook {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @35-2BCFB4A8
    function SetValues()
    {
        $this->Company->SetDBValue($this->f("Company"));
        $this->Contact->SetDBValue($this->f("Contact"));
        $this->AddressID->SetDBValue(trim($this->f("AddressID")));
    }
//End SetValues Method

//Insert Method @35-C356E0F4
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["Company"]["Value"] = $this->Company->GetDBValue(true);
        $this->InsertFields["Contact"]["Value"] = $this->Contact->GetDBValue(true);
        $this->InsertFields["AddressID"]["Value"] = $this->AddressID->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_addressbook", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @35-D00CE782
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["Company"]["Value"] = $this->Company->GetDBValue(true);
        $this->UpdateFields["Contact"]["Value"] = $this->Contact->GetDBValue(true);
        $this->UpdateFields["AddressID"]["Value"] = $this->AddressID->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_addressbook", $this->UpdateFields, $this);
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

//Delete Method @35-DF0C8ABB
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tbladminist_addressbook";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End AddDataSource Class @35-FCB6E20C

class clsRecordEdit { //Edit Class @84-B773AEED

//Variables @84-9E315808

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

//Class_Initialize Event @84-468846EF
    function clsRecordEdit($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Edit/Error";
        $this->DataSource = new clsEditDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Edit";
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
            $this->Cancel = new clsButton("Cancel", $Method, $this);
            $this->Email = new clsControl(ccsTextBox, "Email", "Email", ccsText, "", CCGetRequestParam("Email", $Method, NULL), $this);
            $this->Address = new clsControl(ccsTextBox, "Address", "Address", ccsText, "", CCGetRequestParam("Address", $Method, NULL), $this);
            $this->Phone = new clsControl(ccsTextBox, "Phone", "Phone", ccsText, "", CCGetRequestParam("Phone", $Method, NULL), $this);
            $this->Fax = new clsControl(ccsTextBox, "Fax", "Fax", ccsText, "", CCGetRequestParam("Fax", $Method, NULL), $this);
            $this->AdrID = new clsControl(ccsTextBox, "AdrID", "AdrID", ccsText, "", CCGetRequestParam("AdrID", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @84-2CBF6B15
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlAddressID"] = CCGetFromGet("AddressID", NULL);
    }
//End Initialize Method

//Validate Method @84-62E64AB4
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->Email->Validate() && $Validation);
        $Validation = ($this->Address->Validate() && $Validation);
        $Validation = ($this->Phone->Validate() && $Validation);
        $Validation = ($this->Fax->Validate() && $Validation);
        $Validation = ($this->AdrID->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->Email->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Address->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Phone->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Fax->Errors->Count() == 0);
        $Validation =  $Validation && ($this->AdrID->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @84-6B93DC72
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Email->Errors->Count());
        $errors = ($errors || $this->Address->Errors->Count());
        $errors = ($errors || $this->Phone->Errors->Count());
        $errors = ($errors || $this->Fax->Errors->Count());
        $errors = ($errors || $this->AdrID->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @84-ED598703
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

//Operation Method @84-1E133FAF
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Cancel";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Cancel->Pressed) {
                $this->PressedButton = "Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Cancel") {
            if(!CCGetEvent($this->Cancel->CCSEvents, "OnClick", $this->Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
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

//UpdateRow Method @84-5DAB257F
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->Email->SetValue($this->Email->GetValue(true));
        $this->DataSource->Address->SetValue($this->Address->GetValue(true));
        $this->DataSource->Phone->SetValue($this->Phone->GetValue(true));
        $this->DataSource->Fax->SetValue($this->Fax->GetValue(true));
        $this->DataSource->AdrID->SetValue($this->AdrID->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @84-70F1AA93
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
                    $this->Email->SetValue($this->DataSource->Email->GetValue());
                    $this->Address->SetValue($this->DataSource->Address->GetValue());
                    $this->Phone->SetValue($this->DataSource->Phone->GetValue());
                    $this->Fax->SetValue($this->DataSource->Fax->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->Email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Address->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Phone->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Fax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AdrID->Errors->ToString());
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
        $this->Cancel->Show();
        $this->Email->Show();
        $this->Address->Show();
        $this->Phone->Show();
        $this->Fax->Show();
        $this->AdrID->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End Edit Class @84-FCB6E20C

class clsEditDataSource extends clsDBGayaFusionAll {  //EditDataSource Class @84-DF3D2FA1

//DataSource Variables @84-E224BDA6
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $Email;
    public $Address;
    public $Phone;
    public $Fax;
    public $AdrID;
//End DataSource Variables

//DataSourceClass_Initialize Event @84-A5DBCC2A
    function clsEditDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record Edit/Error";
        $this->Initialize();
        $this->Email = new clsField("Email", ccsText, "");
        
        $this->Address = new clsField("Address", ccsText, "");
        
        $this->Phone = new clsField("Phone", ccsText, "");
        
        $this->Fax = new clsField("Fax", ccsText, "");
        
        $this->AdrID = new clsField("AdrID", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @84-75248612
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlAddressID", ccsInteger, "", "", $this->Parameters["urlAddressID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "AddressID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @84-E832B8E6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_addressbook {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @84-7C1313DF
    function SetValues()
    {
        $this->Email->SetDBValue($this->f("Email"));
        $this->Address->SetDBValue($this->f("Address"));
        $this->Phone->SetDBValue($this->f("Phone"));
        $this->Fax->SetDBValue($this->f("Fax"));
    }
//End SetValues Method

//Update Method @84-D7B1CADB
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["Email"] = new clsSQLParameter("ctrlEmail", ccsText, "", "", $this->Email->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["Address"] = new clsSQLParameter("ctrlAddress", ccsText, "", "", $this->Address->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["Phone"] = new clsSQLParameter("ctrlPhone", ccsText, "", "", $this->Phone->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["Fax"] = new clsSQLParameter("ctrlFax", ccsText, "", "", $this->Fax->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["AdrID"] = new clsSQLParameter("ctrlAdrID", ccsText, "", "", $this->AdrID->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["Email"]->GetValue()) and !strlen($this->cp["Email"]->GetText()) and !is_bool($this->cp["Email"]->GetValue())) 
            $this->cp["Email"]->SetValue($this->Email->GetValue(true));
        if (!is_null($this->cp["Address"]->GetValue()) and !strlen($this->cp["Address"]->GetText()) and !is_bool($this->cp["Address"]->GetValue())) 
            $this->cp["Address"]->SetValue($this->Address->GetValue(true));
        if (!is_null($this->cp["Phone"]->GetValue()) and !strlen($this->cp["Phone"]->GetText()) and !is_bool($this->cp["Phone"]->GetValue())) 
            $this->cp["Phone"]->SetValue($this->Phone->GetValue(true));
        if (!is_null($this->cp["Fax"]->GetValue()) and !strlen($this->cp["Fax"]->GetText()) and !is_bool($this->cp["Fax"]->GetValue())) 
            $this->cp["Fax"]->SetValue($this->Fax->GetValue(true));
        if (!is_null($this->cp["AdrID"]->GetValue()) and !strlen($this->cp["AdrID"]->GetText()) and !is_bool($this->cp["AdrID"]->GetValue())) 
            $this->cp["AdrID"]->SetValue($this->AdrID->GetValue(true));
        $this->SQL = "UPDATE tblAdminist_AddressBook SET Email=" . $this->SQLValue($this->cp["Email"]->GetDBValue(), ccsText) . ", Address=" . $this->SQLValue($this->cp["Address"]->GetDBValue(), ccsText) . ", Phone=" . $this->SQLValue($this->cp["Phone"]->GetDBValue(), ccsText) . ", Fax=" . $this->SQLValue($this->cp["Fax"]->GetDBValue(), ccsText) . " WHERE AddressID=" . $this->SQLValue($this->cp["AdrID"]->GetDBValue(), ccsText) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End EditDataSource Class @84-FCB6E20C

//Initialize Page @1-C1A56086
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
$TemplateFileName = "AddAddress.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-9B667FD5
include_once("./AddAddress_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-0924985E
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$Search = new clsRecordSearch("", $MainPage);
$Grid = new clsGridGrid("", $MainPage);
$Add = new clsRecordAdd("", $MainPage);
$Panel2 = new clsPanel("Panel2", $MainPage);
$Edit = new clsRecordEdit("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->Search = & $Search;
$MainPage->Grid = & $Grid;
$MainPage->Add = & $Add;
$MainPage->Panel2 = & $Panel2;
$MainPage->Edit = & $Edit;
$Panel1->AddComponent("Search", $Search);
$Panel1->AddComponent("Grid", $Grid);
$Panel1->AddComponent("Add", $Add);
$Panel2->AddComponent("Edit", $Edit);
$Grid->Initialize();
$Add->Initialize();
$Edit->Initialize();

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

//Execute Components @1-E69807E7
$Search->Operation();
$Add->Operation();
$Edit->Operation();
//End Execute Components

//Go to destination page @1-E5752942
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Search);
    unset($Grid);
    unset($Add);
    unset($Edit);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-494E0C6C
$Panel1->Show();
$Panel2->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);

$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-3E970A14
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Search);
unset($Grid);
unset($Add);
unset($Edit);
unset($Tpl);
//End Unload Page


?>
