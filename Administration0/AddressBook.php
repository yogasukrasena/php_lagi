<?php
//Include Common Files @1-D3D1E871
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "AddressBook.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordSearchAddress { //SearchAddress Class @3-2556994A

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

//Class_Initialize Event @3-D5A8E04B
    function clsRecordSearchAddress($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SearchAddress/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SearchAddress";
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

//Operation Method @3-FD571936
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
        $Redirect = "AddressBook.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "AddressBook.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-B3C79D1D
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

        $this->Button_DoSearch->Show();
        $this->s_Company->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End SearchAddress Class @3-FCB6E20C

class clsGridAddressGrid { //AddressGrid class @2-F80E666D

//Variables @2-CE0389A1

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
//End Variables

//Class_Initialize Event @2-025A1662
    function clsGridAddressGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "AddressGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid AddressGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsAddressGridDataSource($this);
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
        $this->SorterName = CCGetParam("AddressGridOrder", "");
        $this->SorterDirection = CCGetParam("AddressGridDir", "");

        $this->AddressID = new clsControl(ccsLink, "AddressID", "AddressID", ccsInteger, "", CCGetRequestParam("AddressID", ccsGet, NULL), $this);
        $this->AddressID->Page = "AddressBook.php";
        $this->Company = new clsControl(ccsLabel, "Company", "Company", ccsText, "", CCGetRequestParam("Company", ccsGet, NULL), $this);
        $this->tbladminist_addressbook_TotalRecords = new clsControl(ccsLabel, "tbladminist_addressbook_TotalRecords", "tbladminist_addressbook_TotalRecords", ccsText, "", CCGetRequestParam("tbladminist_addressbook_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_AddressID = new clsSorter($this->ComponentName, "Sorter_AddressID", $FileName, $this);
        $this->Sorter_Company = new clsSorter($this->ComponentName, "Sorter_Company", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Parameters = CCGetQueryString("QueryString", array("AddressID", "ccsForm"));
        $this->Link1->Page = "AddressBook.php";
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

//Show Method @2-6F8256F0
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
            $this->ControlsVisible["AddressID"] = $this->AddressID->Visible;
            $this->ControlsVisible["Company"] = $this->Company->Visible;
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
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->AddressID->Show();
                $this->Company->Show();
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
        $this->tbladminist_addressbook_TotalRecords->Show();
        $this->Sorter_AddressID->Show();
        $this->Sorter_Company->Show();
        $this->Navigator->Show();
        $this->Link1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-B3616778
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->AddressID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Company->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End AddressGrid Class @2-FCB6E20C

class clsAddressGridDataSource extends clsDBGayaFusionAll {  //AddressGridDataSource Class @2-EE438D8A

//DataSource Variables @2-3240EEB2
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
//End DataSource Variables

//DataSourceClass_Initialize Event @2-99508369
    function clsAddressGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid AddressGrid";
        $this->Initialize();
        $this->AddressID = new clsField("AddressID", ccsInteger, "");
        
        $this->Company = new clsField("Company", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-194C5C93
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_AddressID" => array("AddressID", ""), 
            "Sorter_Company" => array("Company", "")));
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

//SetValues Method @2-19EFFA58
    function SetValues()
    {
        $this->AddressID->SetDBValue(trim($this->f("AddressID")));
        $this->Company->SetDBValue($this->f("Company"));
    }
//End SetValues Method

} //End AddressGridDataSource Class @2-FCB6E20C



class clsRecordAddNewHeader { //AddNewHeader Class @15-5850F9DE

//Variables @15-9E315808

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

//Class_Initialize Event @15-24035151
    function clsRecordAddNewHeader($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record AddNewHeader/Error";
        $this->DataSource = new clsAddNewHeaderDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "AddNewHeader";
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
        }
    }
//End Class_Initialize Event

//Initialize Method @15-2CBF6B15
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlAddressID"] = CCGetFromGet("AddressID", NULL);
    }
//End Initialize Method

//Validate Method @15-0D844E36
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->Company->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->Company->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @15-EB0FF731
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Company->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @15-ED598703
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

//Operation Method @15-3EF3910A
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "AddressID", "s_Company"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "AddressID", "s_Company"));
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

//InsertRow Method @15-2DA8FF88
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->Company->SetValue($this->Company->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @15-EC91CBDD
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->Company->SetValue($this->Company->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @15-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @15-192AE156
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
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->Company->Errors->ToString());
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddNewHeader Class @15-FCB6E20C

class clsAddNewHeaderDataSource extends clsDBGayaFusionAll {  //AddNewHeaderDataSource Class @15-B5B08D50

//DataSource Variables @15-2FF0CD43
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
//End DataSource Variables

//DataSourceClass_Initialize Event @15-F0E09CDD
    function clsAddNewHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddNewHeader/Error";
        $this->Initialize();
        $this->Company = new clsField("Company", ccsText, "");
        

        $this->InsertFields["Company"] = array("Name" => "Company", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Company"] = array("Name" => "Company", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @15-75248612
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

//Open Method @15-E832B8E6
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

//SetValues Method @15-39D03BE9
    function SetValues()
    {
        $this->Company->SetDBValue($this->f("Company"));
    }
//End SetValues Method

//Insert Method @15-F7C1C083
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["Company"]["Value"] = $this->Company->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_addressbook", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @15-7DCE0BE7
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["Company"]["Value"] = $this->Company->GetDBValue(true);
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

//Delete Method @15-DF0C8ABB
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

} //End AddNewHeaderDataSource Class @15-FCB6E20C

class clsEditableGridContactGrid { //ContactGrid Class @22-FDCF5BB1

//Variables @22-F9538F3C

    // Public variables
    public $ComponentType = "EditableGrid";
    public $ComponentName;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormParameters;
    public $FormState;
    public $FormEnctype;
    public $CachedColumns;
    public $TotalRows;
    public $UpdatedRows;
    public $EmptyRows;
    public $Visible;
    public $RowsErrors;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode;
    public $ValidatingControls;
    public $Controls;
    public $ControlsErrors;
    public $RowNumber;
    public $Attributes;
    public $PrimaryKeys;

    // Class variables
//End Variables

//Class_Initialize Event @22-4485330E
    function clsEditableGridContactGrid($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid ContactGrid/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "ContactGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["ContactId"][0] = "ContactId";
        $this->DataSource = new clsContactGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 11;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->AddressID = new clsControl(ccsHidden, "AddressID", "Address ID", ccsInteger, "", NULL, $this);
        $this->ContactName = new clsControl(ccsTextBox, "ContactName", "Contact Name", ccsText, "", NULL, $this);
        $this->ContactName->Required = true;
        $this->Email = new clsControl(ccsTextBox, "Email", "Email", ccsText, "", NULL, $this);
        $this->Alamat = new clsControl(ccsTextArea, "Alamat", "Address", ccsMemo, "", NULL, $this);
        $this->Alamat->Required = true;
        $this->Phone = new clsControl(ccsTextBox, "Phone", "Phone", ccsText, "", NULL, $this);
        $this->Fax = new clsControl(ccsTextBox, "Fax", "Fax", ccsText, "", NULL, $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->AddListBtn = new clsButton("AddListBtn", $Method, $this);
        $this->RowIDAttribute = new clsControl(ccsLabel, "RowIDAttribute", "RowIDAttribute", ccsText, "", NULL, $this);
        $this->RowStyleAttribute = new clsControl(ccsLabel, "RowStyleAttribute", "RowStyleAttribute", ccsText, "", NULL, $this);
        $this->RowStyleAttribute->HTML = true;
        $this->RowNameAttribute = new clsControl(ccsLabel, "RowNameAttribute", "RowNameAttribute", ccsText, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @22-052E3DE4
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlAddressID"] = CCGetFromGet("AddressID", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @22-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @22-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @22-B6670397
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["AddressID"][$RowNumber] = CCGetFromPost("AddressID_" . $RowNumber, NULL);
            $this->FormParameters["ContactName"][$RowNumber] = CCGetFromPost("ContactName_" . $RowNumber, NULL);
            $this->FormParameters["Email"][$RowNumber] = CCGetFromPost("Email_" . $RowNumber, NULL);
            $this->FormParameters["Alamat"][$RowNumber] = CCGetFromPost("Alamat_" . $RowNumber, NULL);
            $this->FormParameters["Phone"][$RowNumber] = CCGetFromPost("Phone_" . $RowNumber, NULL);
            $this->FormParameters["Fax"][$RowNumber] = CCGetFromPost("Fax_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @22-8A0E3790
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["ContactId"] = $this->CachedColumns["ContactId"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->AddressID->SetText($this->FormParameters["AddressID"][$this->RowNumber], $this->RowNumber);
            $this->ContactName->SetText($this->FormParameters["ContactName"][$this->RowNumber], $this->RowNumber);
            $this->Email->SetText($this->FormParameters["Email"][$this->RowNumber], $this->RowNumber);
            $this->Alamat->SetText($this->FormParameters["Alamat"][$this->RowNumber], $this->RowNumber);
            $this->Phone->SetText($this->FormParameters["Phone"][$this->RowNumber], $this->RowNumber);
            $this->Fax->SetText($this->FormParameters["Fax"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @22-60161213
    function ValidateRow()
    {
        global $CCSLocales;
        $this->AddressID->Validate();
        $this->ContactName->Validate();
        $this->Email->Validate();
        $this->Alamat->Validate();
        $this->Phone->Validate();
        $this->Fax->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->AddressID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ContactName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Email->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alamat->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Phone->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Fax->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->AddressID->Errors->Clear();
        $this->ContactName->Errors->Clear();
        $this->Email->Errors->Clear();
        $this->Alamat->Errors->Clear();
        $this->Phone->Errors->Clear();
        $this->Fax->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @22-C1DC9AC5
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["AddressID"][$this->RowNumber]) && count($this->FormParameters["AddressID"][$this->RowNumber])) || strlen($this->FormParameters["AddressID"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["ContactName"][$this->RowNumber]) && count($this->FormParameters["ContactName"][$this->RowNumber])) || strlen($this->FormParameters["ContactName"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Email"][$this->RowNumber]) && count($this->FormParameters["Email"][$this->RowNumber])) || strlen($this->FormParameters["Email"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Alamat"][$this->RowNumber]) && count($this->FormParameters["Alamat"][$this->RowNumber])) || strlen($this->FormParameters["Alamat"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Phone"][$this->RowNumber]) && count($this->FormParameters["Phone"][$this->RowNumber])) || strlen($this->FormParameters["Phone"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Fax"][$this->RowNumber]) && count($this->FormParameters["Fax"][$this->RowNumber])) || strlen($this->FormParameters["Fax"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @22-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @22-5700814D
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        } else if($this->AddListBtn->Pressed) {
            $this->PressedButton = "AddListBtn";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "AddressID"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            } else {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "AddressID", "AddressID", "s_Company"));
            }
        } else if($this->PressedButton == "AddListBtn") {
            if(!CCGetEvent($this->AddListBtn->CCSEvents, "OnClick", $this->AddListBtn)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @22-4C1B83E1
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["ContactId"] = $this->CachedColumns["ContactId"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->AddressID->SetText($this->FormParameters["AddressID"][$this->RowNumber], $this->RowNumber);
            $this->ContactName->SetText($this->FormParameters["ContactName"][$this->RowNumber], $this->RowNumber);
            $this->Email->SetText($this->FormParameters["Email"][$this->RowNumber], $this->RowNumber);
            $this->Alamat->SetText($this->FormParameters["Alamat"][$this->RowNumber], $this->RowNumber);
            $this->Phone->SetText($this->FormParameters["Phone"][$this->RowNumber], $this->RowNumber);
            $this->Fax->SetText($this->FormParameters["Fax"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//InsertRow Method @22-AFC5AE1A
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->AddressID->SetValue($this->AddressID->GetValue(true));
        $this->DataSource->ContactName->SetValue($this->ContactName->GetValue(true));
        $this->DataSource->Email->SetValue($this->Email->GetValue(true));
        $this->DataSource->Alamat->SetValue($this->Alamat->GetValue(true));
        $this->DataSource->Phone->SetValue($this->Phone->GetValue(true));
        $this->DataSource->Fax->SetValue($this->Fax->GetValue(true));
        $this->DataSource->RowIDAttribute->SetValue($this->RowIDAttribute->GetValue(true));
        $this->DataSource->RowStyleAttribute->SetValue($this->RowStyleAttribute->GetValue(true));
        $this->DataSource->RowNameAttribute->SetValue($this->RowNameAttribute->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @22-E3FADB73
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->AddressID->SetValue($this->AddressID->GetValue(true));
        $this->DataSource->ContactName->SetValue($this->ContactName->GetValue(true));
        $this->DataSource->Email->SetValue($this->Email->GetValue(true));
        $this->DataSource->Alamat->SetValue($this->Alamat->GetValue(true));
        $this->DataSource->Phone->SetValue($this->Phone->GetValue(true));
        $this->DataSource->Fax->SetValue($this->Fax->GetValue(true));
        $this->DataSource->RowIDAttribute->SetValue($this->RowIDAttribute->GetValue(true));
        $this->DataSource->RowStyleAttribute->SetValue($this->RowStyleAttribute->GetValue(true));
        $this->DataSource->RowNameAttribute->SetValue($this->RowNameAttribute->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @22-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @22-C9997CC7
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var ContactGridElements;\n";
        $script .= "var ContactGridEmptyRows = 11;\n";
        $script .= "var " . $this->ComponentName . "AddressIDID = 0;\n";
        $script .= "var " . $this->ComponentName . "ContactNameID = 1;\n";
        $script .= "var " . $this->ComponentName . "EmailID = 2;\n";
        $script .= "var " . $this->ComponentName . "AlamatID = 3;\n";
        $script .= "var " . $this->ComponentName . "PhoneID = 4;\n";
        $script .= "var " . $this->ComponentName . "FaxID = 5;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 6;\n";
        $script .= "\nfunction initContactGridElements() {\n";
        $script .= "\tvar ED = document.forms[\"ContactGrid\"];\n";
        $script .= "\tContactGridElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.AddressID_" . $i . ", " . "ED.ContactName_" . $i . ", " . "ED.Email_" . $i . ", " . "ED.Alamat_" . $i . ", " . "ED.Phone_" . $i . ", " . "ED.Fax_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @22-E2CB52DF
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["ContactId"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["ContactId"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @22-6E817CDD
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["ContactId"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @22-0FE58DEE
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["AddressID"] = $this->AddressID->Visible;
        $this->ControlsVisible["ContactName"] = $this->ContactName->Visible;
        $this->ControlsVisible["Email"] = $this->Email->Visible;
        $this->ControlsVisible["Alamat"] = $this->Alamat->Visible;
        $this->ControlsVisible["Phone"] = $this->Phone->Visible;
        $this->ControlsVisible["Fax"] = $this->Fax->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["RowIDAttribute"] = $this->RowIDAttribute->Visible;
        $this->ControlsVisible["RowStyleAttribute"] = $this->RowStyleAttribute->Visible;
        $this->ControlsVisible["RowNameAttribute"] = $this->RowNameAttribute->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["ContactId"][$this->RowNumber] = $this->DataSource->CachedColumns["ContactId"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
                    $this->ContactName->SetValue($this->DataSource->ContactName->GetValue());
                    $this->Email->SetValue($this->DataSource->Email->GetValue());
                    $this->Alamat->SetValue($this->DataSource->Alamat->GetValue());
                    $this->Phone->SetValue($this->DataSource->Phone->GetValue());
                    $this->Fax->SetValue($this->DataSource->Fax->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->AddressID->SetText($this->FormParameters["AddressID"][$this->RowNumber], $this->RowNumber);
                    $this->ContactName->SetText($this->FormParameters["ContactName"][$this->RowNumber], $this->RowNumber);
                    $this->Email->SetText($this->FormParameters["Email"][$this->RowNumber], $this->RowNumber);
                    $this->Alamat->SetText($this->FormParameters["Alamat"][$this->RowNumber], $this->RowNumber);
                    $this->Phone->SetText($this->FormParameters["Phone"][$this->RowNumber], $this->RowNumber);
                    $this->Fax->SetText($this->FormParameters["Fax"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["ContactId"][$this->RowNumber] = "";
                    $this->AddressID->SetText("");
                    $this->ContactName->SetText("");
                    $this->Email->SetText("");
                    $this->Alamat->SetText("");
                    $this->Phone->SetText("");
                    $this->Fax->SetText("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                } else {
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->AddressID->SetText($this->FormParameters["AddressID"][$this->RowNumber], $this->RowNumber);
                    $this->ContactName->SetText($this->FormParameters["ContactName"][$this->RowNumber], $this->RowNumber);
                    $this->Email->SetText($this->FormParameters["Email"][$this->RowNumber], $this->RowNumber);
                    $this->Alamat->SetText($this->FormParameters["Alamat"][$this->RowNumber], $this->RowNumber);
                    $this->Phone->SetText($this->FormParameters["Phone"][$this->RowNumber], $this->RowNumber);
                    $this->Fax->SetText($this->FormParameters["Fax"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->AddressID->Show($this->RowNumber);
                $this->ContactName->Show($this->RowNumber);
                $this->Email->Show($this->RowNumber);
                $this->Alamat->Show($this->RowNumber);
                $this->Phone->Show($this->RowNumber);
                $this->Fax->Show($this->RowNumber);
                $this->CheckBox_Delete->Show($this->RowNumber);
                $this->RowIDAttribute->Show($this->RowNumber);
                $this->RowStyleAttribute->Show($this->RowNumber);
                $this->RowNameAttribute->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["ContactId"] == $this->CachedColumns["ContactId"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Button_Submit->Show();
        $this->AddListBtn->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End ContactGrid Class @22-FCB6E20C

class clsContactGridDataSource extends clsDBGayaFusionAll {  //ContactGridDataSource Class @22-A9F33CBA

//DataSource Variables @22-D03CCA2A
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;
    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $AddressID;
    public $ContactName;
    public $Email;
    public $Alamat;
    public $Phone;
    public $Fax;
    public $CheckBox_Delete;
    public $RowIDAttribute;
    public $RowStyleAttribute;
    public $RowNameAttribute;
//End DataSource Variables

//DataSourceClass_Initialize Event @22-A746F25F
    function clsContactGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid ContactGrid/Error";
        $this->Initialize();
        $this->AddressID = new clsField("AddressID", ccsInteger, "");
        
        $this->ContactName = new clsField("ContactName", ccsText, "");
        
        $this->Email = new clsField("Email", ccsText, "");
        
        $this->Alamat = new clsField("Alamat", ccsMemo, "");
        
        $this->Phone = new clsField("Phone", ccsText, "");
        
        $this->Fax = new clsField("Fax", ccsText, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->RowIDAttribute = new clsField("RowIDAttribute", ccsText, "");
        
        $this->RowStyleAttribute = new clsField("RowStyleAttribute", ccsText, "");
        
        $this->RowNameAttribute = new clsField("RowNameAttribute", ccsText, "");
        

        $this->InsertFields["AddressID"] = array("Name" => "AddressID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["ContactName"] = array("Name" => "ContactName", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Email"] = array("Name" => "Email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Address"] = array("Name" => "Address", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["Phone"] = array("Name" => "Phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Fax"] = array("Name" => "Fax", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["AddressID"] = array("Name" => "AddressID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ContactName"] = array("Name" => "ContactName", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Email"] = array("Name" => "Email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Address"] = array("Name" => "Address", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["Phone"] = array("Name" => "Phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Fax"] = array("Name" => "Fax", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Prepare Method @22-75248612
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

//Open Method @22-D004640B
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_addressbook_contact";
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @22-F9FBB4CB
    function SetValues()
    {
        $this->CachedColumns["ContactId"] = $this->f("ContactId");
        $this->AddressID->SetDBValue(trim($this->f("AddressID")));
        $this->ContactName->SetDBValue($this->f("ContactName"));
        $this->Email->SetDBValue($this->f("Email"));
        $this->Alamat->SetDBValue($this->f("Address"));
        $this->Phone->SetDBValue($this->f("Phone"));
        $this->Fax->SetDBValue($this->f("Fax"));
    }
//End SetValues Method

//Insert Method @22-FE05E712
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["AddressID"]["Value"] = $this->AddressID->GetDBValue(true);
        $this->InsertFields["ContactName"]["Value"] = $this->ContactName->GetDBValue(true);
        $this->InsertFields["Email"]["Value"] = $this->Email->GetDBValue(true);
        $this->InsertFields["Address"]["Value"] = $this->Alamat->GetDBValue(true);
        $this->InsertFields["Phone"]["Value"] = $this->Phone->GetDBValue(true);
        $this->InsertFields["Fax"]["Value"] = $this->Fax->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_addressbook_contact", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @22-B3140CFF
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "ContactId=" . $this->ToSQL($this->CachedColumns["ContactId"], ccsInteger);
        $this->UpdateFields["AddressID"]["Value"] = $this->AddressID->GetDBValue(true);
        $this->UpdateFields["ContactName"]["Value"] = $this->ContactName->GetDBValue(true);
        $this->UpdateFields["Email"]["Value"] = $this->Email->GetDBValue(true);
        $this->UpdateFields["Address"]["Value"] = $this->Alamat->GetDBValue(true);
        $this->UpdateFields["Phone"]["Value"] = $this->Phone->GetDBValue(true);
        $this->UpdateFields["Fax"]["Value"] = $this->Fax->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_addressbook_contact", $this->UpdateFields, $this);
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

//Delete Method @22-20A16EA1
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "ContactId=" . $this->ToSQL($this->CachedColumns["ContactId"], ccsInteger);
        $this->SQL = "DELETE FROM tbladminist_addressbook_contact";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End ContactGridDataSource Class @22-FCB6E20C

//Initialize Page @1-F6022795
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
$TemplateFileName = "AddressBook.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-9661B76B
include_once("./AddressBook_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-AC2530C1
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$SearchAddress = new clsRecordSearchAddress("", $MainPage);
$AddressGrid = new clsGridAddressGrid("", $MainPage);
$AddNewHeader = new clsRecordAddNewHeader("", $MainPage);
$ContactGrid = new clsEditableGridContactGrid("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->SearchAddress = & $SearchAddress;
$MainPage->AddressGrid = & $AddressGrid;
$MainPage->AddNewHeader = & $AddNewHeader;
$MainPage->ContactGrid = & $ContactGrid;
$Panel1->AddComponent("SearchAddress", $SearchAddress);
$Panel1->AddComponent("AddressGrid", $AddressGrid);
$Panel1->AddComponent("AddNewHeader", $AddNewHeader);
$Panel1->AddComponent("ContactGrid", $ContactGrid);
$AddressGrid->Initialize();
$AddNewHeader->Initialize();
$ContactGrid->Initialize();

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

//Execute Components @1-CED2BAFA
$SearchAddress->Operation();
$AddNewHeader->Operation();
$ContactGrid->Operation();
//End Execute Components

//Go to destination page @1-11FCFACA
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($SearchAddress);
    unset($AddressGrid);
    unset($AddNewHeader);
    unset($ContactGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9C1F06BF
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);

$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-69F748BD
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($SearchAddress);
unset($AddressGrid);
unset($AddNewHeader);
unset($ContactGrid);
unset($Tpl);
//End Unload Page


?>
