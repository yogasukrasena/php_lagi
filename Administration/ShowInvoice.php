<?php
session_start();
include ("../settings.php");
include("../language/$cfg_language");
include ("../classes/db_functions.php");
include ("../classes/security_functions.php");

$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'RnD',$lang);

if(!$sec->isLoggedIn())
{
	header ("location: ../login.php");
	exit();
}
//Include Common Files @1-8C12B552
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowInvoice.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



class clsGridDetil { //Detil class @45-19BDA346

//Variables @45-6E51DF5A

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

//Class_Initialize Event @45-8392E032
    function clsGridDetil($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Detil";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Detil";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsDetilDataSource($this);
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

        $this->Proforma_H_ID = new clsControl(ccsHidden, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", CCGetRequestParam("Proforma_H_ID", ccsGet, NULL), $this);
        $this->CollectID = new clsControl(ccsLabel, "CollectID", "CollectID", ccsInteger, "", CCGetRequestParam("CollectID", ccsGet, NULL), $this);
        $this->CollectCode = new clsControl(ccsLabel, "CollectCode", "CollectCode", ccsText, "", CCGetRequestParam("CollectCode", ccsGet, NULL), $this);
        $this->Qty = new clsControl(ccsLabel, "Qty", "Qty", ccsInteger, "", CCGetRequestParam("Qty", ccsGet, NULL), $this);
        $this->Unit = new clsControl(ccsLabel, "Unit", "Unit", ccsText, "", CCGetRequestParam("Unit", ccsGet, NULL), $this);
        $this->UnitPrice = new clsControl(ccsLabel, "UnitPrice", "UnitPrice", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("UnitPrice", ccsGet, NULL), $this);
        $this->Total = new clsControl(ccsLabel, "Total", "Total", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Total", ccsGet, NULL), $this);
        $this->CategoryName = new clsControl(ccsLabel, "CategoryName", "CategoryName", ccsText, "", CCGetRequestParam("CategoryName", ccsGet, NULL), $this);
        $this->ColorName = new clsControl(ccsLabel, "ColorName", "ColorName", ccsText, "", CCGetRequestParam("ColorName", ccsGet, NULL), $this);
        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->Width = new clsControl(ccsLabel, "Width", "Width", ccsFloat, "", CCGetRequestParam("Width", ccsGet, NULL), $this);
        $this->Height = new clsControl(ccsLabel, "Height", "Height", ccsFloat, "", CCGetRequestParam("Height", ccsGet, NULL), $this);
        $this->Length = new clsControl(ccsLabel, "Length", "Length", ccsFloat, "", CCGetRequestParam("Length", ccsGet, NULL), $this);
        $this->Diameter = new clsControl(ccsLabel, "Diameter", "Diameter", ccsFloat, "", CCGetRequestParam("Diameter", ccsGet, NULL), $this);
        $this->MaterialName = new clsControl(ccsLabel, "MaterialName", "MaterialName", ccsText, "", CCGetRequestParam("MaterialName", ccsGet, NULL), $this);
        $this->NameDesc = new clsControl(ccsLabel, "NameDesc", "NameDesc", ccsText, "", CCGetRequestParam("NameDesc", ccsGet, NULL), $this);
        $this->SizeName = new clsControl(ccsLabel, "SizeName", "SizeName", ccsText, "", CCGetRequestParam("SizeName", ccsGet, NULL), $this);
        $this->TextureName = new clsControl(ccsLabel, "TextureName", "TextureName", ccsText, "", CCGetRequestParam("TextureName", ccsGet, NULL), $this);
        $this->lblCurrency = new clsControl(ccsLabel, "lblCurrency", "lblCurrency", ccsText, "", CCGetRequestParam("lblCurrency", ccsGet, NULL), $this);
        $this->DiscountItem = new clsControl(ccsLabel, "DiscountItem", "DiscountItem", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("DiscountItem", ccsGet, NULL), $this);
        $this->DocNotes = new clsControl(ccsLabel, "DocNotes", "DocNotes", ccsMemo, "", CCGetRequestParam("DocNotes", ccsGet, NULL), $this);
        $this->SubTotal = new clsControl(ccsLabel, "SubTotal", "SubTotal", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("SubTotal", ccsGet, NULL), $this);
        $this->PackCost = new clsControl(ccsLabel, "PackCost", "PackCost", ccsInteger, "", CCGetRequestParam("PackCost", ccsGet, NULL), $this);
        $this->Discount = new clsControl(ccsLabel, "Discount", "Discount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Discount", ccsGet, NULL), $this);
        $this->Packaging = new clsControl(ccsLabel, "Packaging", "Packaging", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Packaging", ccsGet, NULL), $this);
        $this->Fumigation = new clsControl(ccsLabel, "Fumigation", "Fumigation", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Fumigation", ccsGet, NULL), $this);
        $this->GrandTotal = new clsControl(ccsLabel, "GrandTotal", "GrandTotal", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("GrandTotal", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @45-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @45-E5AC87E4
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlInvoice_H_ID"] = CCGetFromGet("Invoice_H_ID", NULL);

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
            $this->ControlsVisible["Proforma_H_ID"] = $this->Proforma_H_ID->Visible;
            $this->ControlsVisible["CollectID"] = $this->CollectID->Visible;
            $this->ControlsVisible["CollectCode"] = $this->CollectCode->Visible;
            $this->ControlsVisible["Qty"] = $this->Qty->Visible;
            $this->ControlsVisible["Unit"] = $this->Unit->Visible;
            $this->ControlsVisible["UnitPrice"] = $this->UnitPrice->Visible;
            $this->ControlsVisible["Total"] = $this->Total->Visible;
            $this->ControlsVisible["CategoryName"] = $this->CategoryName->Visible;
            $this->ControlsVisible["ColorName"] = $this->ColorName->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["Width"] = $this->Width->Visible;
            $this->ControlsVisible["Height"] = $this->Height->Visible;
            $this->ControlsVisible["Length"] = $this->Length->Visible;
            $this->ControlsVisible["Diameter"] = $this->Diameter->Visible;
            $this->ControlsVisible["MaterialName"] = $this->MaterialName->Visible;
            $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
            $this->ControlsVisible["SizeName"] = $this->SizeName->Visible;
            $this->ControlsVisible["TextureName"] = $this->TextureName->Visible;
            $this->ControlsVisible["lblCurrency"] = $this->lblCurrency->Visible;
            $this->ControlsVisible["DiscountItem"] = $this->DiscountItem->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
                $this->CollectID->SetValue($this->DataSource->CollectID->GetValue());
                $this->CollectCode->SetValue($this->DataSource->CollectCode->GetValue());
                $this->Qty->SetValue($this->DataSource->Qty->GetValue());
                $this->Unit->SetValue($this->DataSource->Unit->GetValue());
                $this->UnitPrice->SetValue($this->DataSource->UnitPrice->GetValue());
                $this->Total->SetValue($this->DataSource->Total->GetValue());
                $this->CategoryName->SetValue($this->DataSource->CategoryName->GetValue());
                $this->ColorName->SetValue($this->DataSource->ColorName->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->Width->SetValue($this->DataSource->Width->GetValue());
                $this->Height->SetValue($this->DataSource->Height->GetValue());
                $this->Length->SetValue($this->DataSource->Length->GetValue());
                $this->Diameter->SetValue($this->DataSource->Diameter->GetValue());
                $this->MaterialName->SetValue($this->DataSource->MaterialName->GetValue());
                $this->NameDesc->SetValue($this->DataSource->NameDesc->GetValue());
                $this->SizeName->SetValue($this->DataSource->SizeName->GetValue());
                $this->TextureName->SetValue($this->DataSource->TextureName->GetValue());
                $this->DiscountItem->SetValue($this->DataSource->DiscountItem->GetValue());
                $this->Attributes->SetValue("LocalRowNumber", "");
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Proforma_H_ID->Show();
                $this->CollectID->Show();
                $this->CollectCode->Show();
                $this->Qty->Show();
                $this->Unit->Show();
                $this->UnitPrice->Show();
                $this->Total->Show();
                $this->CategoryName->Show();
                $this->ColorName->Show();
                $this->Photo1->Show();
                $this->Width->Show();
                $this->Height->Show();
                $this->Length->Show();
                $this->Diameter->Show();
                $this->MaterialName->Show();
                $this->NameDesc->Show();
                $this->SizeName->Show();
                $this->TextureName->Show();
                $this->lblCurrency->Show();
                $this->DiscountItem->Show();
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
        $this->DocNotes->Show();
        $this->SubTotal->Show();
        $this->PackCost->Show();
        $this->Discount->Show();
        $this->Packaging->Show();
        $this->Fumigation->Show();
        $this->GrandTotal->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @45-C389D9B9
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Proforma_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Unit->Errors->ToString());
        $errors = ComposeStrings($errors, $this->UnitPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Total->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CategoryName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ColorName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Width->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Height->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Length->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Diameter->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MaterialName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SizeName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblCurrency->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DiscountItem->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Detil Class @45-FCB6E20C

class clsDetilDataSource extends clsDBGayaFusionAll {  //DetilDataSource Class @45-28B8FEE9

//DataSource Variables @45-5067269B
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $Proforma_H_ID;
    public $CollectID;
    public $CollectCode;
    public $Qty;
    public $Unit;
    public $UnitPrice;
    public $Total;
    public $CategoryName;
    public $ColorName;
    public $Photo1;
    public $Width;
    public $Height;
    public $Length;
    public $Diameter;
    public $MaterialName;
    public $NameDesc;
    public $SizeName;
    public $TextureName;
    public $DiscountItem;
//End DataSource Variables

//DataSourceClass_Initialize Event @45-6CFA7202
    function clsDetilDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Detil";
        $this->Initialize();
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        
        $this->CollectID = new clsField("CollectID", ccsInteger, "");
        
        $this->CollectCode = new clsField("CollectCode", ccsText, "");
        
        $this->Qty = new clsField("Qty", ccsInteger, "");
        
        $this->Unit = new clsField("Unit", ccsText, "");
        
        $this->UnitPrice = new clsField("UnitPrice", ccsFloat, "");
        
        $this->Total = new clsField("Total", ccsFloat, "");
        
        $this->CategoryName = new clsField("CategoryName", ccsText, "");
        
        $this->ColorName = new clsField("ColorName", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->Diameter = new clsField("Diameter", ccsFloat, "");
        
        $this->MaterialName = new clsField("MaterialName", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->SizeName = new clsField("SizeName", ccsText, "");
        
        $this->TextureName = new clsField("TextureName", ccsText, "");
        
        $this->DiscountItem = new clsField("DiscountItem", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @45-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @45-793D3A3C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlInvoice_H_ID", ccsInteger, "", "", $this->Parameters["urlInvoice_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_invoice_d.Invoice_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @45-E3BBE387
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tbladminist_invoice_d ON\n\n" .
        "tbladminist_invoice_d.CollectID = tblcollect_master.ID";
        $this->SQL = "SELECT CategoryName, SizeName, TextureName, ColorName, DesignName, MaterialName, NameDesc, ID, Photo1, Width, Height, Length, Diameter,\n\n" .
        "tbladminist_invoice_d.* \n\n" .
        "FROM (((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tbladminist_invoice_d ON\n\n" .
        "tbladminist_invoice_d.CollectID = tblcollect_master.ID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @45-D08572DE
    function SetValues()
    {
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
        $this->CollectID->SetDBValue(trim($this->f("CollectID")));
        $this->CollectCode->SetDBValue($this->f("CollectCode"));
        $this->Qty->SetDBValue(trim($this->f("Qty")));
        $this->Unit->SetDBValue($this->f("Unit"));
        $this->UnitPrice->SetDBValue(trim($this->f("UnitPrice")));
        $this->Total->SetDBValue(trim($this->f("Total")));
        $this->CategoryName->SetDBValue($this->f("CategoryName"));
        $this->ColorName->SetDBValue($this->f("ColorName"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
        $this->MaterialName->SetDBValue($this->f("MaterialName"));
        $this->NameDesc->SetDBValue($this->f("NameDesc"));
        $this->SizeName->SetDBValue($this->f("SizeName"));
        $this->TextureName->SetDBValue($this->f("TextureName"));
        $this->DiscountItem->SetDBValue(trim($this->f("DiscountItem")));
    }
//End SetValues Method

} //End DetilDataSource Class @45-FCB6E20C

class clsGridHeader { //Header class @173-C9AA34A2

//Variables @173-6E51DF5A

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

//Class_Initialize Event @173-00895976
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

        $this->GayaOrderRef = new clsControl(ccsLabel, "GayaOrderRef", "GayaOrderRef", ccsText, "", CCGetRequestParam("GayaOrderRef", ccsGet, NULL), $this);
        $this->QuotationDate = new clsControl(ccsLabel, "QuotationDate", "QuotationDate", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("QuotationDate", ccsGet, NULL), $this);
        $this->ClientID = new clsControl(ccsHidden, "ClientID", "ClientID", ccsInteger, "", CCGetRequestParam("ClientID", ccsGet, NULL), $this);
        $this->AddressID = new clsControl(ccsHidden, "AddressID", "AddressID", ccsInteger, "", CCGetRequestParam("AddressID", ccsGet, NULL), $this);
        $this->QuotationContactID = new clsControl(ccsHidden, "QuotationContactID", "QuotationContactID", ccsInteger, "", CCGetRequestParam("QuotationContactID", ccsGet, NULL), $this);
        $this->DeliveryContactID = new clsControl(ccsHidden, "DeliveryContactID", "DeliveryContactID", ccsInteger, "", CCGetRequestParam("DeliveryContactID", ccsGet, NULL), $this);
        $this->DeliveryTermID = new clsControl(ccsHidden, "DeliveryTermID", "DeliveryTermID", ccsInteger, "", CCGetRequestParam("DeliveryTermID", ccsGet, NULL), $this);
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
        $this->DeliveryAddressID = new clsControl(ccsHidden, "DeliveryAddressID", "DeliveryAddressID", ccsInteger, "", CCGetRequestParam("DeliveryAddressID", ccsGet, NULL), $this);
        $this->DeliveryAddr = new clsControl(ccsLabel, "DeliveryAddr", "DeliveryAddr", ccsText, "", CCGetRequestParam("DeliveryAddr", ccsGet, NULL), $this);
        $this->PaymentTerm = new clsControl(ccsLabel, "PaymentTerm", "PaymentTerm", ccsText, "", CCGetRequestParam("PaymentTerm", ccsGet, NULL), $this);
        $this->PaymentTermID = new clsControl(ccsHidden, "PaymentTermID", "PaymentTermID", ccsInteger, "", CCGetRequestParam("PaymentTermID", ccsGet, NULL), $this);
        $this->DueDate = new clsControl(ccsLabel, "DueDate", "DueDate", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("DueDate", ccsGet, NULL), $this);
        $this->QuotationNo = new clsControl(ccsLabel, "QuotationNo", "QuotationNo", ccsText, "", CCGetRequestParam("QuotationNo", ccsGet, NULL), $this);
        $this->ClientOrderRef = new clsControl(ccsLabel, "ClientOrderRef", "ClientOrderRef", ccsText, "", CCGetRequestParam("ClientOrderRef", ccsGet, NULL), $this);
        $this->PackagingCost = new clsControl(ccsLabel, "PackagingCost", "PackagingCost", ccsSingle, "", CCGetRequestParam("PackagingCost", ccsGet, NULL), $this);
        $this->Quotation_H_ID = new clsControl(ccsHidden, "Quotation_H_ID", "Quotation_H_ID", ccsInteger, "", CCGetRequestParam("Quotation_H_ID", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @173-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @173-5D586502
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlInvoice_H_ID"] = CCGetFromGet("Invoice_H_ID", NULL);

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
            $this->ControlsVisible["GayaOrderRef"] = $this->GayaOrderRef->Visible;
            $this->ControlsVisible["QuotationDate"] = $this->QuotationDate->Visible;
            $this->ControlsVisible["ClientID"] = $this->ClientID->Visible;
            $this->ControlsVisible["AddressID"] = $this->AddressID->Visible;
            $this->ControlsVisible["QuotationContactID"] = $this->QuotationContactID->Visible;
            $this->ControlsVisible["DeliveryContactID"] = $this->DeliveryContactID->Visible;
            $this->ControlsVisible["DeliveryTermID"] = $this->DeliveryTermID->Visible;
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
            $this->ControlsVisible["DeliveryAddressID"] = $this->DeliveryAddressID->Visible;
            $this->ControlsVisible["DeliveryAddr"] = $this->DeliveryAddr->Visible;
            $this->ControlsVisible["PaymentTerm"] = $this->PaymentTerm->Visible;
            $this->ControlsVisible["PaymentTermID"] = $this->PaymentTermID->Visible;
            $this->ControlsVisible["DueDate"] = $this->DueDate->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->GayaOrderRef->SetValue($this->DataSource->GayaOrderRef->GetValue());
                $this->QuotationDate->SetValue($this->DataSource->QuotationDate->GetValue());
                $this->ClientID->SetValue($this->DataSource->ClientID->GetValue());
                $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
                $this->QuotationContactID->SetValue($this->DataSource->QuotationContactID->GetValue());
                $this->DeliveryContactID->SetValue($this->DataSource->DeliveryContactID->GetValue());
                $this->DeliveryTermID->SetValue($this->DataSource->DeliveryTermID->GetValue());
                $this->SpecialInstruction->SetValue($this->DataSource->SpecialInstruction->GetValue());
                $this->DocMaker->SetValue($this->DataSource->DocMaker->GetValue());
                $this->Currency->SetValue($this->DataSource->Currency->GetValue());
                $this->DeliveryAddressID->SetValue($this->DataSource->DeliveryAddressID->GetValue());
                $this->PaymentTermID->SetValue($this->DataSource->PaymentTermID->GetValue());
                $this->DueDate->SetValue($this->DataSource->DueDate->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->GayaOrderRef->Show();
                $this->QuotationDate->Show();
                $this->ClientID->Show();
                $this->AddressID->Show();
                $this->QuotationContactID->Show();
                $this->DeliveryContactID->Show();
                $this->DeliveryTermID->Show();
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
                $this->DeliveryAddressID->Show();
                $this->DeliveryAddr->Show();
                $this->PaymentTerm->Show();
                $this->PaymentTermID->Show();
                $this->DueDate->Show();
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
        $this->ClientOrderRef->SetValue($this->DataSource->ClientOrderRef->GetValue());
        $this->PackagingCost->SetValue($this->DataSource->PackagingCost->GetValue());
        $this->Quotation_H_ID->SetValue($this->DataSource->Quotation_H_ID->GetValue());
        $this->QuotationNo->Show();
        $this->ClientOrderRef->Show();
        $this->PackagingCost->Show();
        $this->Quotation_H_ID->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @173-1DFA4C40
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->GayaOrderRef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->AddressID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationContactID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryContactID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryTermID->Errors->ToString());
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
        $errors = ComposeStrings($errors, $this->DeliveryAddressID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryAddr->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PaymentTerm->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PaymentTermID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DueDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Header Class @173-FCB6E20C

class clsHeaderDataSource extends clsDBGayaFusionAll {  //HeaderDataSource Class @173-AB3B61E5

//DataSource Variables @173-368420EE
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $QuotationNo;
    public $GayaOrderRef;
    public $QuotationDate;
    public $ClientOrderRef;
    public $ClientID;
    public $AddressID;
    public $QuotationContactID;
    public $DeliveryContactID;
    public $PackagingCost;
    public $DeliveryTermID;
    public $SpecialInstruction;
    public $Quotation_H_ID;
    public $DocMaker;
    public $Currency;
    public $DeliveryAddressID;
    public $PaymentTermID;
    public $DueDate;
//End DataSource Variables

//DataSourceClass_Initialize Event @173-3A5D41AF
    function clsHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Header";
        $this->Initialize();
        $this->QuotationNo = new clsField("QuotationNo", ccsText, "");
        
        $this->GayaOrderRef = new clsField("GayaOrderRef", ccsText, "");
        
        $this->QuotationDate = new clsField("QuotationDate", ccsDate, $this->DateFormat);
        
        $this->ClientOrderRef = new clsField("ClientOrderRef", ccsText, "");
        
        $this->ClientID = new clsField("ClientID", ccsInteger, "");
        
        $this->AddressID = new clsField("AddressID", ccsInteger, "");
        
        $this->QuotationContactID = new clsField("QuotationContactID", ccsInteger, "");
        
        $this->DeliveryContactID = new clsField("DeliveryContactID", ccsInteger, "");
        
        $this->PackagingCost = new clsField("PackagingCost", ccsSingle, "");
        
        $this->DeliveryTermID = new clsField("DeliveryTermID", ccsInteger, "");
        
        $this->SpecialInstruction = new clsField("SpecialInstruction", ccsMemo, "");
        
        $this->Quotation_H_ID = new clsField("Quotation_H_ID", ccsInteger, "");
        
        $this->DocMaker = new clsField("DocMaker", ccsInteger, "");
        
        $this->Currency = new clsField("Currency", ccsInteger, "");
        
        $this->DeliveryAddressID = new clsField("DeliveryAddressID", ccsInteger, "");
        
        $this->PaymentTermID = new clsField("PaymentTermID", ccsInteger, "");
        
        $this->DueDate = new clsField("DueDate", ccsDate, $this->DateFormat);
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @173-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @173-9A4BEBDB
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlInvoice_H_ID", ccsInteger, "", "", $this->Parameters["urlInvoice_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Invoice_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @173-454B6175
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_invoice_h";
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_invoice_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @173-D3D692F8
    function SetValues()
    {
        $this->QuotationNo->SetDBValue($this->f("InvoiceNo"));
        $this->GayaOrderRef->SetDBValue($this->f("GayaOrderRef"));
        $this->QuotationDate->SetDBValue(trim($this->f("InvoiceDate")));
        $this->ClientOrderRef->SetDBValue($this->f("ClientOrderRef"));
        $this->ClientID->SetDBValue(trim($this->f("ClientID")));
        $this->AddressID->SetDBValue(trim($this->f("AddressID")));
        $this->QuotationContactID->SetDBValue(trim($this->f("InvoiceContactID")));
        $this->DeliveryContactID->SetDBValue(trim($this->f("DeliveryContactID")));
        $this->PackagingCost->SetDBValue(trim($this->f("PackagingCost")));
        $this->DeliveryTermID->SetDBValue(trim($this->f("DeliveryTermID")));
        $this->SpecialInstruction->SetDBValue($this->f("SpecialInstruction"));
        $this->Quotation_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
        $this->DocMaker->SetDBValue(trim($this->f("DocMaker")));
        $this->Currency->SetDBValue(trim($this->f("Currency")));
        $this->DeliveryAddressID->SetDBValue(trim($this->f("DeliveryAddressID")));
        $this->PaymentTermID->SetDBValue(trim($this->f("PaymentTermID")));
        $this->DueDate->SetDBValue(trim($this->f("DueDate")));
    }
//End SetValues Method

} //End HeaderDataSource Class @173-FCB6E20C

//Initialize Page @1-E31159AD
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
$TemplateFileName = "ShowInvoice.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-53989A2B
include_once("./ShowInvoice_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B82F56FE
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Detil = new clsGridDetil("", $MainPage);
$lblAdministrasi = new clsControl(ccsLabel, "lblAdministrasi", "lblAdministrasi", ccsText, "", CCGetRequestParam("lblAdministrasi", ccsGet, NULL), $MainPage);
$lblCustomer = new clsControl(ccsLabel, "lblCustomer", "lblCustomer", ccsText, "", CCGetRequestParam("lblCustomer", ccsGet, NULL), $MainPage);
$Header = new clsGridHeader("", $MainPage);
$MainPage->Detil = & $Detil;
$MainPage->lblAdministrasi = & $lblAdministrasi;
$MainPage->lblCustomer = & $lblCustomer;
$MainPage->Header = & $Header;
$Detil->Initialize();
$Header->Initialize();

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

//Go to destination page @1-B2DB1CB8
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Detil);
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-8DE053FE
$Detil->Show();
$Header->Show();
$lblAdministrasi->Show();
$lblCustomer->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FBCB6E29
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Detil);
unset($Header);
unset($Tpl);
//End Unload Page


?>
