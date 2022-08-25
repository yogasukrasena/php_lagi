<?php
//Include Common Files @1-4A131246
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "RndPopup.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordsampleceramicSearch { //sampleceramicSearch Class @3-C8006D23

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

//Class_Initialize Event @3-FDDAF8DD
    function clsRecordsampleceramicSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record sampleceramicSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "sampleceramicSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_SampleCode = new clsControl(ccsTextBox, "s_SampleCode", "s_SampleCode", ccsText, "", CCGetRequestParam("s_SampleCode", $Method, NULL), $this);
            $this->s_SampleDescription = new clsControl(ccsTextBox, "s_SampleDescription", "s_SampleDescription", ccsText, "", CCGetRequestParam("s_SampleDescription", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-F61AE455
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_SampleCode->Validate() && $Validation);
        $Validation = ($this->s_SampleDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_SampleCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_SampleDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-B3ED1976
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_SampleCode->Errors->Count());
        $errors = ($errors || $this->s_SampleDescription->Errors->Count());
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

//Operation Method @3-220FF4C8
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
        $Redirect = "RndPopup.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "RndPopup.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_SampleCode", "s_SampleDescription", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-5C5557D3
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
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_SampleCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_SampleDescription->Errors->ToString());
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
        $this->s_SampleCode->Show();
        $this->s_SampleDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End sampleceramicSearch Class @3-FCB6E20C

class clsGridsampleceramic { //sampleceramic class @2-7B826106

//Variables @2-6120EEB2

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
    public $Sorter_SampleCode;
    public $Sorter_SampleDescription;
    public $Sorter_Photo1;
    public $Sorter_Width;
    public $Sorter_Height;
    public $Sorter_Length;
    public $Sorter_Diameter;
    public $Sorter_RealSellingPrice;
//End Variables

//Class_Initialize Event @2-2E6EB785
    function clsGridsampleceramic($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "sampleceramic";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid sampleceramic";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clssampleceramicDataSource($this);
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
        $this->SorterName = CCGetParam("sampleceramicOrder", "");
        $this->SorterDirection = CCGetParam("sampleceramicDir", "");

        $this->SampleDescription = new clsControl(ccsLabel, "SampleDescription", "SampleDescription", ccsText, "", CCGetRequestParam("SampleDescription", ccsGet, NULL), $this);
        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->Width = new clsControl(ccsLabel, "Width", "Width", ccsFloat, "", CCGetRequestParam("Width", ccsGet, NULL), $this);
        $this->Height = new clsControl(ccsLabel, "Height", "Height", ccsFloat, "", CCGetRequestParam("Height", ccsGet, NULL), $this);
        $this->Length = new clsControl(ccsLabel, "Length", "Length", ccsFloat, "", CCGetRequestParam("Length", ccsGet, NULL), $this);
        $this->Diameter = new clsControl(ccsLabel, "Diameter", "Diameter", ccsFloat, "", CCGetRequestParam("Diameter", ccsGet, NULL), $this);
        $this->RealSellingPrice = new clsControl(ccsLink, "RealSellingPrice", "RealSellingPrice", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("RealSellingPrice", ccsGet, NULL), $this);
        $this->RealSellingPrice->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->RealSellingPrice->Page = "";
        $this->PriceDollar = new clsControl(ccsLink, "PriceDollar", "PriceDollar", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("PriceDollar", ccsGet, NULL), $this);
        $this->PriceDollar->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->PriceDollar->Page = "";
        $this->PriceEuro = new clsControl(ccsLink, "PriceEuro", "PriceEuro", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("PriceEuro", ccsGet, NULL), $this);
        $this->PriceEuro->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->PriceEuro->Page = "";
        $this->SampleCode = new clsControl(ccsLabel, "SampleCode", "SampleCode", ccsText, "", CCGetRequestParam("SampleCode", ccsGet, NULL), $this);
        $this->SampleCod = new clsControl(ccsHidden, "SampleCod", "SampleCod", ccsText, "", CCGetRequestParam("SampleCod", ccsGet, NULL), $this);
        $this->sampleceramic_TotalRecords = new clsControl(ccsLabel, "sampleceramic_TotalRecords", "sampleceramic_TotalRecords", ccsText, "", CCGetRequestParam("sampleceramic_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_SampleCode = new clsSorter($this->ComponentName, "Sorter_SampleCode", $FileName, $this);
        $this->Sorter_SampleDescription = new clsSorter($this->ComponentName, "Sorter_SampleDescription", $FileName, $this);
        $this->Sorter_Photo1 = new clsSorter($this->ComponentName, "Sorter_Photo1", $FileName, $this);
        $this->Sorter_Width = new clsSorter($this->ComponentName, "Sorter_Width", $FileName, $this);
        $this->Sorter_Height = new clsSorter($this->ComponentName, "Sorter_Height", $FileName, $this);
        $this->Sorter_Length = new clsSorter($this->ComponentName, "Sorter_Length", $FileName, $this);
        $this->Sorter_Diameter = new clsSorter($this->ComponentName, "Sorter_Diameter", $FileName, $this);
        $this->Sorter_RealSellingPrice = new clsSorter($this->ComponentName, "Sorter_RealSellingPrice", $FileName, $this);
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

//Show Method @2-F785DA86
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_SampleCode"] = CCGetFromGet("s_SampleCode", NULL);
        $this->DataSource->Parameters["urls_SampleDescription"] = CCGetFromGet("s_SampleDescription", NULL);

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
            $this->ControlsVisible["SampleDescription"] = $this->SampleDescription->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["Width"] = $this->Width->Visible;
            $this->ControlsVisible["Height"] = $this->Height->Visible;
            $this->ControlsVisible["Length"] = $this->Length->Visible;
            $this->ControlsVisible["Diameter"] = $this->Diameter->Visible;
            $this->ControlsVisible["RealSellingPrice"] = $this->RealSellingPrice->Visible;
            $this->ControlsVisible["PriceDollar"] = $this->PriceDollar->Visible;
            $this->ControlsVisible["PriceEuro"] = $this->PriceEuro->Visible;
            $this->ControlsVisible["SampleCode"] = $this->SampleCode->Visible;
            $this->ControlsVisible["SampleCod"] = $this->SampleCod->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->SampleDescription->SetValue($this->DataSource->SampleDescription->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->Width->SetValue($this->DataSource->Width->GetValue());
                $this->Height->SetValue($this->DataSource->Height->GetValue());
                $this->Length->SetValue($this->DataSource->Length->GetValue());
                $this->Diameter->SetValue($this->DataSource->Diameter->GetValue());
                $this->RealSellingPrice->SetValue($this->DataSource->RealSellingPrice->GetValue());
                $this->PriceDollar->SetValue($this->DataSource->PriceDollar->GetValue());
                $this->PriceEuro->SetValue($this->DataSource->PriceEuro->GetValue());
                $this->SampleCode->SetValue($this->DataSource->SampleCode->GetValue());
                $this->SampleCod->SetValue($this->DataSource->SampleCod->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->SampleDescription->Show();
                $this->Photo1->Show();
                $this->Width->Show();
                $this->Height->Show();
                $this->Length->Show();
                $this->Diameter->Show();
                $this->RealSellingPrice->Show();
                $this->PriceDollar->Show();
                $this->PriceEuro->Show();
                $this->SampleCode->Show();
                $this->SampleCod->Show();
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
        $this->sampleceramic_TotalRecords->Show();
        $this->Sorter_SampleCode->Show();
        $this->Sorter_SampleDescription->Show();
        $this->Sorter_Photo1->Show();
        $this->Sorter_Width->Show();
        $this->Sorter_Height->Show();
        $this->Sorter_Length->Show();
        $this->Sorter_Diameter->Show();
        $this->Sorter_RealSellingPrice->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-08FA58D6
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->SampleDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Width->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Height->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Length->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Diameter->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RealSellingPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PriceDollar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PriceEuro->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SampleCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SampleCod->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End sampleceramic Class @2-FCB6E20C

class clssampleceramicDataSource extends clsDBGayaFusionAll {  //sampleceramicDataSource Class @2-A88B2429

//DataSource Variables @2-EB18B9C4
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $SampleDescription;
    public $Photo1;
    public $Width;
    public $Height;
    public $Length;
    public $Diameter;
    public $RealSellingPrice;
    public $PriceDollar;
    public $PriceEuro;
    public $SampleCode;
    public $SampleCod;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-753CD5C6
    function clssampleceramicDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid sampleceramic";
        $this->Initialize();
        $this->SampleDescription = new clsField("SampleDescription", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->Diameter = new clsField("Diameter", ccsFloat, "");
        
        $this->RealSellingPrice = new clsField("RealSellingPrice", ccsFloat, "");
        
        $this->PriceDollar = new clsField("PriceDollar", ccsFloat, "");
        
        $this->PriceEuro = new clsField("PriceEuro", ccsFloat, "");
        
        $this->SampleCode = new clsField("SampleCode", ccsText, "");
        
        $this->SampleCod = new clsField("SampleCod", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-24C66026
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "sID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_SampleCode" => array("SampleCode", ""), 
            "Sorter_SampleDescription" => array("SampleDescription", ""), 
            "Sorter_Photo1" => array("Photo1", ""), 
            "Sorter_Width" => array("Width", ""), 
            "Sorter_Height" => array("Height", ""), 
            "Sorter_Length" => array("Length", ""), 
            "Sorter_Diameter" => array("Diameter", ""), 
            "Sorter_RealSellingPrice" => array("RealSellingPrice", "")));
    }
//End SetOrder Method

//Prepare Method @2-FC2DC4C9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_SampleCode", ccsText, "", "", $this->Parameters["urls_SampleCode"], "", false);
        $this->wp->AddParameter("2", "urls_SampleDescription", ccsText, "", "", $this->Parameters["urls_SampleDescription"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "SampleCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "SampleDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-71C01762
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM sampleceramic";
        $this->SQL = "SELECT sID, SampleCode, SampleDescription, Photo1, Width, Height, Length, Diameter, RealSellingPrice, PriceDollar, PriceEuro, LastUpdate \n\n" .
        "FROM sampleceramic {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-9A1015D9
    function SetValues()
    {
        $this->SampleDescription->SetDBValue($this->f("SampleDescription"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
        $this->RealSellingPrice->SetDBValue(trim($this->f("RealSellingPrice")));
        $this->PriceDollar->SetDBValue(trim($this->f("PriceDollar")));
        $this->PriceEuro->SetDBValue(trim($this->f("PriceEuro")));
        $this->SampleCode->SetDBValue($this->f("SampleCode"));
        $this->SampleCod->SetDBValue($this->f("SampleCode"));
    }
//End SetValues Method

} //End sampleceramicDataSource Class @2-FCB6E20C



//Initialize Page @1-DF9FB7FB
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
$TemplateFileName = "RndPopup.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-89943E8A
include_once("./RndPopup_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-2A92202F
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$sampleceramicSearch = new clsRecordsampleceramicSearch("", $MainPage);
$sampleceramic = new clsGridsampleceramic("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->sampleceramicSearch = & $sampleceramicSearch;
$MainPage->sampleceramic = & $sampleceramic;
$Panel1->AddComponent("sampleceramicSearch", $sampleceramicSearch);
$Panel1->AddComponent("sampleceramic", $sampleceramic);
$sampleceramic->Initialize();

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

//Execute Components @1-F25EC17F
$sampleceramicSearch->Operation();
//End Execute Components

//Go to destination page @1-2853D65B
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($sampleceramicSearch);
    unset($sampleceramic);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-92000602
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-A387F8D0
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($sampleceramicSearch);
unset($sampleceramic);
unset($Tpl);
//End Unload Page


?>
