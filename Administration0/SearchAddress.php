<?php
//Include Common Files @1-E2BF6FD8
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "SearchAddress.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtbladminist_addressbookSearch { //tbladminist_addressbookSearch Class @3-DFA29F06

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

//Class_Initialize Event @3-BF23E0D1
    function clsRecordtbladminist_addressbookSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tbladminist_addressbookSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tbladminist_addressbookSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_Company = new clsControl(ccsListBox, "s_Company", "s_Company", ccsText, "", CCGetRequestParam("s_Company", $Method, NULL), $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-7AE72679
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_Company->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_Company->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-E682BDE7
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_Company->Errors->Count());
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

//Operation Method @3-958425BB
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
        $Redirect = "SearchAddress.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "SearchAddress.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-9BE52549
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

        $this->s_Company->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tbladminist_addressbookSearch Class @3-FCB6E20C

class clsGridtbladminist_addressbook { //tbladminist_addressbook class @2-4FB00FA9

//Variables @2-B5C832CC

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
    public $Sorter_Company;
    public $Sorter_Contact;
    public $Sorter_Email;
    public $Sorter_Address;
    public $Sorter_Phone;
    public $Sorter_Fax;
//End Variables

//Class_Initialize Event @2-071D98BB
    function clsGridtbladminist_addressbook($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tbladminist_addressbook";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tbladminist_addressbook";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstbladminist_addressbookDataSource($this);
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
        $this->SorterName = CCGetParam("tbladminist_addressbookOrder", "");
        $this->SorterDirection = CCGetParam("tbladminist_addressbookDir", "");

        $this->Company = new clsControl(ccsLabel, "Company", "Company", ccsText, "", CCGetRequestParam("Company", ccsGet, NULL), $this);
        $this->Contact = new clsControl(ccsLabel, "Contact", "Contact", ccsText, "", CCGetRequestParam("Contact", ccsGet, NULL), $this);
        $this->Email = new clsControl(ccsLabel, "Email", "Email", ccsText, "", CCGetRequestParam("Email", ccsGet, NULL), $this);
        $this->Address = new clsControl(ccsLabel, "Address", "Address", ccsText, "", CCGetRequestParam("Address", ccsGet, NULL), $this);
        $this->Phone = new clsControl(ccsLabel, "Phone", "Phone", ccsText, "", CCGetRequestParam("Phone", ccsGet, NULL), $this);
        $this->Fax = new clsControl(ccsLabel, "Fax", "Fax", ccsText, "", CCGetRequestParam("Fax", ccsGet, NULL), $this);
        $this->Sorter_Company = new clsSorter($this->ComponentName, "Sorter_Company", $FileName, $this);
        $this->Sorter_Contact = new clsSorter($this->ComponentName, "Sorter_Contact", $FileName, $this);
        $this->Sorter_Email = new clsSorter($this->ComponentName, "Sorter_Email", $FileName, $this);
        $this->Sorter_Address = new clsSorter($this->ComponentName, "Sorter_Address", $FileName, $this);
        $this->Sorter_Phone = new clsSorter($this->ComponentName, "Sorter_Phone", $FileName, $this);
        $this->Sorter_Fax = new clsSorter($this->ComponentName, "Sorter_Fax", $FileName, $this);
        $this->AddNew = new clsControl(ccsLink, "AddNew", "AddNew", ccsText, "", CCGetRequestParam("AddNew", ccsGet, NULL), $this);
        $this->AddNew->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->AddNew->Page = "AddAddress.php";
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

//Show Method @2-D088C82E
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_Company"] = CCGetFromGet("s_Company", NULL);

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
                $this->Company->SetValue($this->DataSource->Company->GetValue());
                $this->Contact->SetValue($this->DataSource->Contact->GetValue());
                $this->Email->SetValue($this->DataSource->Email->GetValue());
                $this->Address->SetValue($this->DataSource->Address->GetValue());
                $this->Phone->SetValue($this->DataSource->Phone->GetValue());
                $this->Fax->SetValue($this->DataSource->Fax->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
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
        $this->Sorter_Company->Show();
        $this->Sorter_Contact->Show();
        $this->Sorter_Email->Show();
        $this->Sorter_Address->Show();
        $this->Sorter_Phone->Show();
        $this->Sorter_Fax->Show();
        $this->AddNew->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-632BF7F9
    function GetErrors()
    {
        $errors = "";
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

} //End tbladminist_addressbook Class @2-FCB6E20C

class clstbladminist_addressbookDataSource extends clsDBGayaFusionAll {  //tbladminist_addressbookDataSource Class @2-33EC98C0

//DataSource Variables @2-1B0C85EA
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $Company;
    public $Contact;
    public $Email;
    public $Address;
    public $Phone;
    public $Fax;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-5C4958CD
    function clstbladminist_addressbookDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tbladminist_addressbook";
        $this->Initialize();
        $this->Company = new clsField("Company", ccsText, "");
        
        $this->Contact = new clsField("Contact", ccsText, "");
        
        $this->Email = new clsField("Email", ccsText, "");
        
        $this->Address = new clsField("Address", ccsText, "");
        
        $this->Phone = new clsField("Phone", ccsText, "");
        
        $this->Fax = new clsField("Fax", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-4B9C90A6
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "AddressID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_Company" => array("Company", ""), 
            "Sorter_Contact" => array("Contact", ""), 
            "Sorter_Email" => array("Email", ""), 
            "Sorter_Address" => array("Address", ""), 
            "Sorter_Phone" => array("Phone", ""), 
            "Sorter_Fax" => array("Fax", "")));
    }
//End SetOrder Method

//Prepare Method @2-72F42134
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_Company", ccsText, "", "", $this->Parameters["urls_Company"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "Company", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-6ABA7ECE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_addressbook";
        $this->SQL = "SELECT * \n\n" .
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

//SetValues Method @2-C0D8FF95
    function SetValues()
    {
        $this->Company->SetDBValue($this->f("Company"));
        $this->Contact->SetDBValue($this->f("Contact"));
        $this->Email->SetDBValue($this->f("Email"));
        $this->Address->SetDBValue($this->f("Address"));
        $this->Phone->SetDBValue($this->f("Phone"));
        $this->Fax->SetDBValue($this->f("Fax"));
    }
//End SetValues Method

} //End tbladminist_addressbookDataSource Class @2-FCB6E20C





//Initialize Page @1-D9D3D61D
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
$TemplateFileName = "SearchAddress.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D844C84D
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tbladminist_addressbookSearch = new clsRecordtbladminist_addressbookSearch("", $MainPage);
$tbladminist_addressbook = new clsGridtbladminist_addressbook("", $MainPage);
$MainPage->tbladminist_addressbookSearch = & $tbladminist_addressbookSearch;
$MainPage->tbladminist_addressbook = & $tbladminist_addressbook;
$tbladminist_addressbook->Initialize();

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

//Execute Components @1-984E1C56
$tbladminist_addressbookSearch->Operation();
//End Execute Components

//Go to destination page @1-B36EBB78
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tbladminist_addressbookSearch);
    unset($tbladminist_addressbook);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-44533DE5
$tbladminist_addressbookSearch->Show();
$tbladminist_addressbook->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);

$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-DA2DBFD6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tbladminist_addressbookSearch);
unset($tbladminist_addressbook);
unset($Tpl);
//End Unload Page


?>
