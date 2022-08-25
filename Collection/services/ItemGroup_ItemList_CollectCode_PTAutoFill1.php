<?php
//Include Common Files @1-916DDC62
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "ItemGroup_ItemList_CollectCode_PTAutoFill1.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridtblcollect_category_tblco { //tblcollect_category_tblco class @2-B8F7CBE3

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

//Class_Initialize Event @2-FA132FB9
    function clsGridtblcollect_category_tblco($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tblcollect_category_tblco";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tblcollect_category_tblco";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstblcollect_category_tblcoDataSource($this);
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

        $this->CategoryName = new clsControl(ccsLabel, "CategoryName", "CategoryName", ccsText, "", CCGetRequestParam("CategoryName", ccsGet, NULL), $this);
        $this->ColorName = new clsControl(ccsLabel, "ColorName", "ColorName", ccsText, "", CCGetRequestParam("ColorName", ccsGet, NULL), $this);
        $this->DesignName = new clsControl(ccsLabel, "DesignName", "DesignName", ccsText, "", CCGetRequestParam("DesignName", ccsGet, NULL), $this);
        $this->ID = new clsControl(ccsLabel, "ID", "ID", ccsInteger, "", CCGetRequestParam("ID", ccsGet, NULL), $this);
        $this->CollectCode = new clsControl(ccsLabel, "CollectCode", "CollectCode", ccsText, "", CCGetRequestParam("CollectCode", ccsGet, NULL), $this);
        $this->tblcollect_master_DesignCode = new clsControl(ccsLabel, "tblcollect_master_DesignCode", "tblcollect_master_DesignCode", ccsText, "", CCGetRequestParam("tblcollect_master_DesignCode", ccsGet, NULL), $this);
        $this->tblcollect_master_NameCode = new clsControl(ccsLabel, "tblcollect_master_NameCode", "tblcollect_master_NameCode", ccsText, "", CCGetRequestParam("tblcollect_master_NameCode", ccsGet, NULL), $this);
        $this->tblcollect_master_CategoryCode = new clsControl(ccsLabel, "tblcollect_master_CategoryCode", "tblcollect_master_CategoryCode", ccsText, "", CCGetRequestParam("tblcollect_master_CategoryCode", ccsGet, NULL), $this);
        $this->tblcollect_master_SizeCode = new clsControl(ccsLabel, "tblcollect_master_SizeCode", "tblcollect_master_SizeCode", ccsText, "", CCGetRequestParam("tblcollect_master_SizeCode", ccsGet, NULL), $this);
        $this->tblcollect_master_TextureCode = new clsControl(ccsLabel, "tblcollect_master_TextureCode", "tblcollect_master_TextureCode", ccsText, "", CCGetRequestParam("tblcollect_master_TextureCode", ccsGet, NULL), $this);
        $this->tblcollect_master_ColorCode = new clsControl(ccsLabel, "tblcollect_master_ColorCode", "tblcollect_master_ColorCode", ccsText, "", CCGetRequestParam("tblcollect_master_ColorCode", ccsGet, NULL), $this);
        $this->tblcollect_master_MaterialCode = new clsControl(ccsLabel, "tblcollect_master_MaterialCode", "tblcollect_master_MaterialCode", ccsText, "", CCGetRequestParam("tblcollect_master_MaterialCode", ccsGet, NULL), $this);
        $this->Photo1 = new clsControl(ccsLabel, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->MaterialName = new clsControl(ccsLabel, "MaterialName", "MaterialName", ccsText, "", CCGetRequestParam("MaterialName", ccsGet, NULL), $this);
        $this->NameDesc = new clsControl(ccsLabel, "NameDesc", "NameDesc", ccsText, "", CCGetRequestParam("NameDesc", ccsGet, NULL), $this);
        $this->SizeName = new clsControl(ccsLabel, "SizeName", "SizeName", ccsText, "", CCGetRequestParam("SizeName", ccsGet, NULL), $this);
        $this->TextureName = new clsControl(ccsLabel, "TextureName", "TextureName", ccsText, "", CCGetRequestParam("TextureName", ccsGet, NULL), $this);
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

//Show Method @2-91044994
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
            $this->ControlsVisible["CategoryName"] = $this->CategoryName->Visible;
            $this->ControlsVisible["ColorName"] = $this->ColorName->Visible;
            $this->ControlsVisible["DesignName"] = $this->DesignName->Visible;
            $this->ControlsVisible["ID"] = $this->ID->Visible;
            $this->ControlsVisible["CollectCode"] = $this->CollectCode->Visible;
            $this->ControlsVisible["tblcollect_master_DesignCode"] = $this->tblcollect_master_DesignCode->Visible;
            $this->ControlsVisible["tblcollect_master_NameCode"] = $this->tblcollect_master_NameCode->Visible;
            $this->ControlsVisible["tblcollect_master_CategoryCode"] = $this->tblcollect_master_CategoryCode->Visible;
            $this->ControlsVisible["tblcollect_master_SizeCode"] = $this->tblcollect_master_SizeCode->Visible;
            $this->ControlsVisible["tblcollect_master_TextureCode"] = $this->tblcollect_master_TextureCode->Visible;
            $this->ControlsVisible["tblcollect_master_ColorCode"] = $this->tblcollect_master_ColorCode->Visible;
            $this->ControlsVisible["tblcollect_master_MaterialCode"] = $this->tblcollect_master_MaterialCode->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["MaterialName"] = $this->MaterialName->Visible;
            $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
            $this->ControlsVisible["SizeName"] = $this->SizeName->Visible;
            $this->ControlsVisible["TextureName"] = $this->TextureName->Visible;
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
                $this->CategoryName->SetValue($this->DataSource->CategoryName->GetValue());
                $this->ColorName->SetValue($this->DataSource->ColorName->GetValue());
                $this->DesignName->SetValue($this->DataSource->DesignName->GetValue());
                $this->ID->SetValue($this->DataSource->ID->GetValue());
                $this->CollectCode->SetValue($this->DataSource->CollectCode->GetValue());
                $this->tblcollect_master_DesignCode->SetValue($this->DataSource->tblcollect_master_DesignCode->GetValue());
                $this->tblcollect_master_NameCode->SetValue($this->DataSource->tblcollect_master_NameCode->GetValue());
                $this->tblcollect_master_CategoryCode->SetValue($this->DataSource->tblcollect_master_CategoryCode->GetValue());
                $this->tblcollect_master_SizeCode->SetValue($this->DataSource->tblcollect_master_SizeCode->GetValue());
                $this->tblcollect_master_TextureCode->SetValue($this->DataSource->tblcollect_master_TextureCode->GetValue());
                $this->tblcollect_master_ColorCode->SetValue($this->DataSource->tblcollect_master_ColorCode->GetValue());
                $this->tblcollect_master_MaterialCode->SetValue($this->DataSource->tblcollect_master_MaterialCode->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->MaterialName->SetValue($this->DataSource->MaterialName->GetValue());
                $this->NameDesc->SetValue($this->DataSource->NameDesc->GetValue());
                $this->SizeName->SetValue($this->DataSource->SizeName->GetValue());
                $this->TextureName->SetValue($this->DataSource->TextureName->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->CategoryName->Show();
                $this->ColorName->Show();
                $this->DesignName->Show();
                $this->ID->Show();
                $this->CollectCode->Show();
                $this->tblcollect_master_DesignCode->Show();
                $this->tblcollect_master_NameCode->Show();
                $this->tblcollect_master_CategoryCode->Show();
                $this->tblcollect_master_SizeCode->Show();
                $this->tblcollect_master_TextureCode->Show();
                $this->tblcollect_master_ColorCode->Show();
                $this->tblcollect_master_MaterialCode->Show();
                $this->Photo1->Show();
                $this->MaterialName->Show();
                $this->NameDesc->Show();
                $this->SizeName->Show();
                $this->TextureName->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
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

//GetErrors Method @2-69CA6BE0
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->CategoryName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ColorName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tblcollect_master_DesignCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tblcollect_master_NameCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tblcollect_master_CategoryCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tblcollect_master_SizeCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tblcollect_master_TextureCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tblcollect_master_ColorCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tblcollect_master_MaterialCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MaterialName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SizeName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tblcollect_category_tblco Class @2-FCB6E20C

class clstblcollect_category_tblcoDataSource extends clsDBGayaFusionAll {  //tblcollect_category_tblcoDataSource Class @2-C7160B05

//DataSource Variables @2-BE8ECF49
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $CategoryName;
    public $ColorName;
    public $DesignName;
    public $ID;
    public $CollectCode;
    public $tblcollect_master_DesignCode;
    public $tblcollect_master_NameCode;
    public $tblcollect_master_CategoryCode;
    public $tblcollect_master_SizeCode;
    public $tblcollect_master_TextureCode;
    public $tblcollect_master_ColorCode;
    public $tblcollect_master_MaterialCode;
    public $Photo1;
    public $MaterialName;
    public $NameDesc;
    public $SizeName;
    public $TextureName;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-D9F1F28B
    function clstblcollect_category_tblcoDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tblcollect_category_tblco";
        $this->Initialize();
        $this->CategoryName = new clsField("CategoryName", ccsText, "");
        
        $this->ColorName = new clsField("ColorName", ccsText, "");
        
        $this->DesignName = new clsField("DesignName", ccsText, "");
        
        $this->ID = new clsField("ID", ccsInteger, "");
        
        $this->CollectCode = new clsField("CollectCode", ccsText, "");
        
        $this->tblcollect_master_DesignCode = new clsField("tblcollect_master_DesignCode", ccsText, "");
        
        $this->tblcollect_master_NameCode = new clsField("tblcollect_master_NameCode", ccsText, "");
        
        $this->tblcollect_master_CategoryCode = new clsField("tblcollect_master_CategoryCode", ccsText, "");
        
        $this->tblcollect_master_SizeCode = new clsField("tblcollect_master_SizeCode", ccsText, "");
        
        $this->tblcollect_master_TextureCode = new clsField("tblcollect_master_TextureCode", ccsText, "");
        
        $this->tblcollect_master_ColorCode = new clsField("tblcollect_master_ColorCode", ccsText, "");
        
        $this->tblcollect_master_MaterialCode = new clsField("tblcollect_master_MaterialCode", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->MaterialName = new clsField("MaterialName", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->SizeName = new clsField("SizeName", ccsText, "");
        
        $this->TextureName = new clsField("TextureName", ccsText, "");
        

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

//Prepare Method @2-E1516FBE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlkeyword", ccsInteger, "", "", $this->Parameters["urlkeyword"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-A56A41C6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode";
        $this->SQL = "SELECT CategoryName, ColorName, DesignName, MaterialName, NameDesc, SizeName, TextureName, ID, CollectCode, tblcollect_master.DesignCode AS tblcollect_master_DesignCode,\n\n" .
        "tblcollect_master.NameCode AS tblcollect_master_NameCode, tblcollect_master.CategoryCode AS tblcollect_master_CategoryCode,\n\n" .
        "tblcollect_master.SizeCode AS tblcollect_master_SizeCode, tblcollect_master.TextureCode AS tblcollect_master_TextureCode,\n\n" .
        "tblcollect_master.ColorCode AS tblcollect_master_ColorCode, tblcollect_master.MaterialCode AS tblcollect_master_MaterialCode,\n\n" .
        "Photo1 \n\n" .
        "FROM ((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-4DEE09E8
    function SetValues()
    {
        $this->CategoryName->SetDBValue($this->f("CategoryName"));
        $this->ColorName->SetDBValue($this->f("ColorName"));
        $this->DesignName->SetDBValue($this->f("DesignName"));
        $this->ID->SetDBValue(trim($this->f("ID")));
        $this->CollectCode->SetDBValue($this->f("CollectCode"));
        $this->tblcollect_master_DesignCode->SetDBValue($this->f("tblcollect_master_DesignCode"));
        $this->tblcollect_master_NameCode->SetDBValue($this->f("tblcollect_master_NameCode"));
        $this->tblcollect_master_CategoryCode->SetDBValue($this->f("tblcollect_master_CategoryCode"));
        $this->tblcollect_master_SizeCode->SetDBValue($this->f("tblcollect_master_SizeCode"));
        $this->tblcollect_master_TextureCode->SetDBValue($this->f("tblcollect_master_TextureCode"));
        $this->tblcollect_master_ColorCode->SetDBValue($this->f("tblcollect_master_ColorCode"));
        $this->tblcollect_master_MaterialCode->SetDBValue($this->f("tblcollect_master_MaterialCode"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->MaterialName->SetDBValue($this->f("MaterialName"));
        $this->NameDesc->SetDBValue($this->f("NameDesc"));
        $this->SizeName->SetDBValue($this->f("SizeName"));
        $this->TextureName->SetDBValue($this->f("TextureName"));
    }
//End SetValues Method

} //End tblcollect_category_tblcoDataSource Class @2-FCB6E20C

//Initialize Page @1-E184366A
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
$TemplateFileName = "ItemGroup_ItemList_CollectCode_PTAutoFill1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-8C1A276E
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblcollect_category_tblco = new clsGridtblcollect_category_tblco("", $MainPage);
$MainPage->tblcollect_category_tblco = & $tblcollect_category_tblco;
$tblcollect_category_tblco->Initialize();

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

//Go to destination page @1-7F7E9533
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblcollect_category_tblco);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E50531FC
$tblcollect_category_tblco->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-0BC5F05E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblcollect_category_tblco);
unset($Tpl);
//End Unload Page


?>
