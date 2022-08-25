<?php
//Include Common Files @1-DAFCB5E3
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "ListQuotation_AddNewDetail_RndCode_PTAutoFill1.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridsampleceramic { //sampleceramic class @2-7B826106

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

//Class_Initialize Event @2-74E53E03
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

        $this->sID = new clsControl(ccsLabel, "sID", "sID", ccsInteger, "", CCGetRequestParam("sID", ccsGet, NULL), $this);
        $this->SampleCode = new clsControl(ccsLabel, "SampleCode", "SampleCode", ccsText, "", CCGetRequestParam("SampleCode", ccsGet, NULL), $this);
        $this->SampleDescription = new clsControl(ccsLabel, "SampleDescription", "SampleDescription", ccsText, "", CCGetRequestParam("SampleDescription", ccsGet, NULL), $this);
        $this->Photo1 = new clsControl(ccsLabel, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->Width = new clsControl(ccsLabel, "Width", "Width", ccsFloat, "", CCGetRequestParam("Width", ccsGet, NULL), $this);
        $this->Height = new clsControl(ccsLabel, "Height", "Height", ccsFloat, "", CCGetRequestParam("Height", ccsGet, NULL), $this);
        $this->Length = new clsControl(ccsLabel, "Length", "Length", ccsFloat, "", CCGetRequestParam("Length", ccsGet, NULL), $this);
        $this->Diameter = new clsControl(ccsLabel, "Diameter", "Diameter", ccsFloat, "", CCGetRequestParam("Diameter", ccsGet, NULL), $this);
        $this->SampCeramicVolume = new clsControl(ccsLabel, "SampCeramicVolume", "SampCeramicVolume", ccsFloat, "", CCGetRequestParam("SampCeramicVolume", ccsGet, NULL), $this);
        $this->RealSellingPrice = new clsControl(ccsLabel, "RealSellingPrice", "RealSellingPrice", ccsFloat, "", CCGetRequestParam("RealSellingPrice", ccsGet, NULL), $this);
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

//Show Method @2-EA9B77F6
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlkeyword"] = CCGetFromGet("keyword", NULL);

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
            $this->ControlsVisible["sID"] = $this->sID->Visible;
            $this->ControlsVisible["SampleCode"] = $this->SampleCode->Visible;
            $this->ControlsVisible["SampleDescription"] = $this->SampleDescription->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["Width"] = $this->Width->Visible;
            $this->ControlsVisible["Height"] = $this->Height->Visible;
            $this->ControlsVisible["Length"] = $this->Length->Visible;
            $this->ControlsVisible["Diameter"] = $this->Diameter->Visible;
            $this->ControlsVisible["SampCeramicVolume"] = $this->SampCeramicVolume->Visible;
            $this->ControlsVisible["RealSellingPrice"] = $this->RealSellingPrice->Visible;
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
                $this->sID->SetValue($this->DataSource->sID->GetValue());
                $this->SampleCode->SetValue($this->DataSource->SampleCode->GetValue());
                $this->SampleDescription->SetValue($this->DataSource->SampleDescription->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->Width->SetValue($this->DataSource->Width->GetValue());
                $this->Height->SetValue($this->DataSource->Height->GetValue());
                $this->Length->SetValue($this->DataSource->Length->GetValue());
                $this->Diameter->SetValue($this->DataSource->Diameter->GetValue());
                $this->SampCeramicVolume->SetValue($this->DataSource->SampCeramicVolume->GetValue());
                $this->RealSellingPrice->SetValue($this->DataSource->RealSellingPrice->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->sID->Show();
                $this->SampleCode->Show();
                $this->SampleDescription->Show();
                $this->Photo1->Show();
                $this->Width->Show();
                $this->Height->Show();
                $this->Length->Show();
                $this->Diameter->Show();
                $this->SampCeramicVolume->Show();
                $this->RealSellingPrice->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-B24C549F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->sID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SampleCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SampleDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Width->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Height->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Length->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Diameter->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SampCeramicVolume->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RealSellingPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End sampleceramic Class @2-FCB6E20C

class clssampleceramicDataSource extends clsDBGayaFusionAll {  //sampleceramicDataSource Class @2-A88B2429

//DataSource Variables @2-ED52FF21
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $sID;
    public $SampleCode;
    public $SampleDescription;
    public $Photo1;
    public $Width;
    public $Height;
    public $Length;
    public $Diameter;
    public $SampCeramicVolume;
    public $RealSellingPrice;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-86E1DCA7
    function clssampleceramicDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid sampleceramic";
        $this->Initialize();
        $this->sID = new clsField("sID", ccsInteger, "");
        
        $this->SampleCode = new clsField("SampleCode", ccsText, "");
        
        $this->SampleDescription = new clsField("SampleDescription", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->Diameter = new clsField("Diameter", ccsFloat, "");
        
        $this->SampCeramicVolume = new clsField("SampCeramicVolume", ccsFloat, "");
        
        $this->RealSellingPrice = new clsField("RealSellingPrice", ccsFloat, "");
        

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

//Prepare Method @2-C5125966
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlkeyword", ccsText, "", "", $this->Parameters["urlkeyword"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "SampleCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-0D0790AF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM sampleceramic";
        $this->SQL = "SELECT * \n\n" .
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

//SetValues Method @2-819E28A0
    function SetValues()
    {
        $this->sID->SetDBValue(trim($this->f("sID")));
        $this->SampleCode->SetDBValue($this->f("SampleCode"));
        $this->SampleDescription->SetDBValue($this->f("SampleDescription"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
        $this->SampCeramicVolume->SetDBValue(trim($this->f("SampCeramicVolume")));
        $this->RealSellingPrice->SetDBValue(trim($this->f("RealSellingPrice")));
    }
//End SetValues Method

} //End sampleceramicDataSource Class @2-FCB6E20C

//Initialize Page @1-A9C825DF
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
$TemplateFileName = "ListQuotation_AddNewDetail_RndCode_PTAutoFill1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-74F2B2AA
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$sampleceramic = new clsGridsampleceramic("", $MainPage);
$MainPage->sampleceramic = & $sampleceramic;
$sampleceramic->Initialize();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-52F9C312
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-3A2B6E4B
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($sampleceramic);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F94C4278
$sampleceramic->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-3310F9E2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($sampleceramic);
unset($Tpl);
//End Unload Page


?>
