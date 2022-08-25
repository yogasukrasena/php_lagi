<?php
//Include Common Files @1-A1BD7527
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowPOL.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGrid { //Grid class @2-76129994

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

//Class_Initialize Event @2-4870D5A1
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

        $this->ClientCompany = new clsControl(ccsLabel, "ClientCompany", "ClientCompany", ccsText, "", CCGetRequestParam("ClientCompany", ccsGet, NULL), $this);
        $this->ClientOrderRef = new clsControl(ccsLabel, "ClientOrderRef", "ClientOrderRef", ccsText, "", CCGetRequestParam("ClientOrderRef", ccsGet, NULL), $this);
        $this->ProformaNo = new clsControl(ccsLabel, "ProformaNo", "ProformaNo", ccsText, "", CCGetRequestParam("ProformaNo", ccsGet, NULL), $this);
        $this->ProformaRef = new clsControl(ccsLabel, "ProformaRef", "ProformaRef", ccsText, "", CCGetRequestParam("ProformaRef", ccsGet, NULL), $this);
        $this->PolDate = new clsControl(ccsLabel, "PolDate", "PolDate", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("PolDate", ccsGet, NULL), $this);
        $this->DeliveryTime = new clsControl(ccsLabel, "DeliveryTime", "DeliveryTime", ccsText, "", CCGetRequestParam("DeliveryTime", ccsGet, NULL), $this);
        $this->POL_H_ID = new clsControl(ccsHidden, "POL_H_ID", "POL_H_ID", ccsInteger, "", CCGetRequestParam("POL_H_ID", ccsGet, NULL), $this);
        $this->Proforma_H_ID = new clsControl(ccsHidden, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", CCGetRequestParam("Proforma_H_ID", ccsGet, NULL), $this);
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

//Show Method @2-9D1E65A2
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlPOL_H_ID"] = CCGetFromGet("POL_H_ID", NULL);

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
            $this->ControlsVisible["ClientCompany"] = $this->ClientCompany->Visible;
            $this->ControlsVisible["ClientOrderRef"] = $this->ClientOrderRef->Visible;
            $this->ControlsVisible["ProformaNo"] = $this->ProformaNo->Visible;
            $this->ControlsVisible["ProformaRef"] = $this->ProformaRef->Visible;
            $this->ControlsVisible["PolDate"] = $this->PolDate->Visible;
            $this->ControlsVisible["DeliveryTime"] = $this->DeliveryTime->Visible;
            $this->ControlsVisible["POL_H_ID"] = $this->POL_H_ID->Visible;
            $this->ControlsVisible["Proforma_H_ID"] = $this->Proforma_H_ID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->PolDate->SetValue($this->DataSource->PolDate->GetValue());
                $this->POL_H_ID->SetValue($this->DataSource->POL_H_ID->GetValue());
                $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ClientCompany->Show();
                $this->ClientOrderRef->Show();
                $this->ProformaNo->Show();
                $this->ProformaRef->Show();
                $this->PolDate->Show();
                $this->DeliveryTime->Show();
                $this->POL_H_ID->Show();
                $this->Proforma_H_ID->Show();
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

//GetErrors Method @2-03F67F1B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ClientCompany->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientOrderRef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ProformaNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ProformaRef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PolDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryTime->Errors->ToString());
        $errors = ComposeStrings($errors, $this->POL_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Proforma_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid Class @2-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @2-7708C172

//DataSource Variables @2-8021E57A
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $PolDate;
    public $POL_H_ID;
    public $Proforma_H_ID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-CCEF3A2B
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid";
        $this->Initialize();
        $this->PolDate = new clsField("PolDate", ccsDate, $this->DateFormat);
        
        $this->POL_H_ID = new clsField("POL_H_ID", ccsInteger, "");
        
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        

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

//Prepare Method @2-79050802
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlPOL_H_ID", ccsInteger, "", "", $this->Parameters["urlPOL_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "POL_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-0F55D93F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_pol_h";
        $this->SQL = "SELECT Proforma_H_ID, POL_H_ID, POLDate \n\n" .
        "FROM tbladminist_pol_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-2FD6F735
    function SetValues()
    {
        $this->PolDate->SetDBValue(trim($this->f("POLDate")));
        $this->POL_H_ID->SetDBValue(trim($this->f("POL_H_ID")));
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
    }
//End SetValues Method

} //End GridDataSource Class @2-FCB6E20C

class clsGridDetailPOL { //DetailPOL class @25-EB37BA55

//Variables @25-6E51DF5A

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

//Class_Initialize Event @25-916F1C54
    function clsGridDetailPOL($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "DetailPOL";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid DetailPOL";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsDetailPOLDataSource($this);
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

        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->NameDesc = new clsControl(ccsLabel, "NameDesc", "NameDesc", ccsText, "", CCGetRequestParam("NameDesc", ccsGet, NULL), $this);
        $this->CategoryName = new clsControl(ccsLabel, "CategoryName", "CategoryName", ccsText, "", CCGetRequestParam("CategoryName", ccsGet, NULL), $this);
        $this->SizeName = new clsControl(ccsLabel, "SizeName", "SizeName", ccsText, "", CCGetRequestParam("SizeName", ccsGet, NULL), $this);
        $this->TextureName = new clsControl(ccsLabel, "TextureName", "TextureName", ccsText, "", CCGetRequestParam("TextureName", ccsGet, NULL), $this);
        $this->ColorName = new clsControl(ccsLabel, "ColorName", "ColorName", ccsText, "", CCGetRequestParam("ColorName", ccsGet, NULL), $this);
        $this->MaterialName = new clsControl(ccsLabel, "MaterialName", "MaterialName", ccsText, "", CCGetRequestParam("MaterialName", ccsGet, NULL), $this);
        $this->Qty = new clsControl(ccsLabel, "Qty", "Qty", ccsText, "", CCGetRequestParam("Qty", ccsGet, NULL), $this);
        $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $this);
        $this->Label2 = new clsControl(ccsLabel, "Label2", "Label2", ccsText, "", CCGetRequestParam("Label2", ccsGet, NULL), $this);
        $this->Label3 = new clsControl(ccsLabel, "Label3", "Label3", ccsText, "", CCGetRequestParam("Label3", ccsGet, NULL), $this);
        $this->POL_D_ID = new clsControl(ccsHidden, "POL_D_ID", "POL_D_ID", ccsInteger, "", CCGetRequestParam("POL_D_ID", ccsGet, NULL), $this);
        $this->POL_H_ID = new clsControl(ccsHidden, "POL_H_ID", "POL_H_ID", ccsInteger, "", CCGetRequestParam("POL_H_ID", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @25-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @25-D3074E7A
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlPOL_H_ID"] = CCGetFromGet("POL_H_ID", NULL);

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
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
            $this->ControlsVisible["CategoryName"] = $this->CategoryName->Visible;
            $this->ControlsVisible["SizeName"] = $this->SizeName->Visible;
            $this->ControlsVisible["TextureName"] = $this->TextureName->Visible;
            $this->ControlsVisible["ColorName"] = $this->ColorName->Visible;
            $this->ControlsVisible["MaterialName"] = $this->MaterialName->Visible;
            $this->ControlsVisible["Qty"] = $this->Qty->Visible;
            $this->ControlsVisible["Label1"] = $this->Label1->Visible;
            $this->ControlsVisible["Label2"] = $this->Label2->Visible;
            $this->ControlsVisible["Label3"] = $this->Label3->Visible;
            $this->ControlsVisible["POL_D_ID"] = $this->POL_D_ID->Visible;
            $this->ControlsVisible["POL_H_ID"] = $this->POL_H_ID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->NameDesc->SetValue($this->DataSource->NameDesc->GetValue());
                $this->CategoryName->SetValue($this->DataSource->CategoryName->GetValue());
                $this->SizeName->SetValue($this->DataSource->SizeName->GetValue());
                $this->TextureName->SetValue($this->DataSource->TextureName->GetValue());
                $this->ColorName->SetValue($this->DataSource->ColorName->GetValue());
                $this->MaterialName->SetValue($this->DataSource->MaterialName->GetValue());
                $this->Qty->SetValue($this->DataSource->Qty->GetValue());
                $this->POL_D_ID->SetValue($this->DataSource->POL_D_ID->GetValue());
                $this->POL_H_ID->SetValue($this->DataSource->POL_H_ID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Photo1->Show();
                $this->NameDesc->Show();
                $this->CategoryName->Show();
                $this->SizeName->Show();
                $this->TextureName->Show();
                $this->ColorName->Show();
                $this->MaterialName->Show();
                $this->Qty->Show();
                $this->Label1->Show();
                $this->Label2->Show();
                $this->Label3->Show();
                $this->POL_D_ID->Show();
                $this->POL_H_ID->Show();
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

//GetErrors Method @25-AC1ADB29
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CategoryName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SizeName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ColorName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MaterialName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->POL_D_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->POL_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End DetailPOL Class @25-FCB6E20C

class clsDetailPOLDataSource extends clsDBGayaFusionAll {  //DetailPOLDataSource Class @25-340547B3

//DataSource Variables @25-9F321AE4
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $Photo1;
    public $NameDesc;
    public $CategoryName;
    public $SizeName;
    public $TextureName;
    public $ColorName;
    public $MaterialName;
    public $Qty;
    public $POL_D_ID;
    public $POL_H_ID;
//End DataSource Variables

//DataSourceClass_Initialize Event @25-9A9E20C4
    function clsDetailPOLDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid DetailPOL";
        $this->Initialize();
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->CategoryName = new clsField("CategoryName", ccsText, "");
        
        $this->SizeName = new clsField("SizeName", ccsText, "");
        
        $this->TextureName = new clsField("TextureName", ccsText, "");
        
        $this->ColorName = new clsField("ColorName", ccsText, "");
        
        $this->MaterialName = new clsField("MaterialName", ccsText, "");
        
        $this->Qty = new clsField("Qty", ccsText, "");
        
        $this->POL_D_ID = new clsField("POL_D_ID", ccsInteger, "");
        
        $this->POL_H_ID = new clsField("POL_H_ID", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @25-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @25-D0148E7F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlPOL_H_ID", ccsInteger, "", "", $this->Parameters["urlPOL_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_pol_d.POL_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @25-43A91797
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
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tbladminist_pol_d ON\n\n" .
        "tbladminist_pol_d.CollectID = tblcollect_master.ID";
        $this->SQL = "SELECT tbladminist_pol_d.*, Photo1, CategoryName, SizeName, TextureName, ColorName, DesignName, MaterialName, NameDesc \n\n" .
        "FROM (((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tbladminist_pol_d ON\n\n" .
        "tbladminist_pol_d.CollectID = tblcollect_master.ID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @25-B8933C33
    function SetValues()
    {
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->NameDesc->SetDBValue($this->f("NameDesc"));
        $this->CategoryName->SetDBValue($this->f("CategoryName"));
        $this->SizeName->SetDBValue($this->f("SizeName"));
        $this->TextureName->SetDBValue($this->f("TextureName"));
        $this->ColorName->SetDBValue($this->f("ColorName"));
        $this->MaterialName->SetDBValue($this->f("MaterialName"));
        $this->Qty->SetDBValue($this->f("Qty"));
        $this->POL_D_ID->SetDBValue(trim($this->f("POL_D_ID")));
        $this->POL_H_ID->SetDBValue(trim($this->f("POL_H_ID")));
    }
//End SetValues Method

} //End DetailPOLDataSource Class @25-FCB6E20C

class clsGridDetailPROF { //DetailPROF class @176-C4E2AC5D

//Variables @176-6E51DF5A

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

//Class_Initialize Event @176-AFFEFF6B
    function clsGridDetailPROF($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "DetailPROF";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid DetailPROF";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsDetailPROFDataSource($this);
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

        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->NameDesc = new clsControl(ccsLabel, "NameDesc", "NameDesc", ccsText, "", CCGetRequestParam("NameDesc", ccsGet, NULL), $this);
        $this->CategoryName = new clsControl(ccsLabel, "CategoryName", "CategoryName", ccsText, "", CCGetRequestParam("CategoryName", ccsGet, NULL), $this);
        $this->SizeName = new clsControl(ccsLabel, "SizeName", "SizeName", ccsText, "", CCGetRequestParam("SizeName", ccsGet, NULL), $this);
        $this->TextureName = new clsControl(ccsLabel, "TextureName", "TextureName", ccsText, "", CCGetRequestParam("TextureName", ccsGet, NULL), $this);
        $this->ColorName = new clsControl(ccsLabel, "ColorName", "ColorName", ccsText, "", CCGetRequestParam("ColorName", ccsGet, NULL), $this);
        $this->MaterialName = new clsControl(ccsLabel, "MaterialName", "MaterialName", ccsText, "", CCGetRequestParam("MaterialName", ccsGet, NULL), $this);
        $this->Qty = new clsControl(ccsLabel, "Qty", "Qty", ccsInteger, "", CCGetRequestParam("Qty", ccsGet, NULL), $this);
        $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $this);
        $this->Label2 = new clsControl(ccsLabel, "Label2", "Label2", ccsText, "", CCGetRequestParam("Label2", ccsGet, NULL), $this);
        $this->Label3 = new clsControl(ccsLabel, "Label3", "Label3", ccsText, "", CCGetRequestParam("Label3", ccsGet, NULL), $this);
        $this->Proforma_D_ID = new clsControl(ccsHidden, "Proforma_D_ID", "Proforma_D_ID", ccsInteger, "", CCGetRequestParam("Proforma_D_ID", ccsGet, NULL), $this);
        $this->Proforma_H_ID = new clsControl(ccsHidden, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", CCGetRequestParam("Proforma_H_ID", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @176-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @176-0CBCDCC9
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlProforma_H_ID"] = CCGetFromGet("Proforma_H_ID", NULL);

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
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
            $this->ControlsVisible["CategoryName"] = $this->CategoryName->Visible;
            $this->ControlsVisible["SizeName"] = $this->SizeName->Visible;
            $this->ControlsVisible["TextureName"] = $this->TextureName->Visible;
            $this->ControlsVisible["ColorName"] = $this->ColorName->Visible;
            $this->ControlsVisible["MaterialName"] = $this->MaterialName->Visible;
            $this->ControlsVisible["Qty"] = $this->Qty->Visible;
            $this->ControlsVisible["Label1"] = $this->Label1->Visible;
            $this->ControlsVisible["Label2"] = $this->Label2->Visible;
            $this->ControlsVisible["Label3"] = $this->Label3->Visible;
            $this->ControlsVisible["Proforma_D_ID"] = $this->Proforma_D_ID->Visible;
            $this->ControlsVisible["Proforma_H_ID"] = $this->Proforma_H_ID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->NameDesc->SetValue($this->DataSource->NameDesc->GetValue());
                $this->CategoryName->SetValue($this->DataSource->CategoryName->GetValue());
                $this->SizeName->SetValue($this->DataSource->SizeName->GetValue());
                $this->TextureName->SetValue($this->DataSource->TextureName->GetValue());
                $this->ColorName->SetValue($this->DataSource->ColorName->GetValue());
                $this->MaterialName->SetValue($this->DataSource->MaterialName->GetValue());
                $this->Qty->SetValue($this->DataSource->Qty->GetValue());
                $this->Proforma_D_ID->SetValue($this->DataSource->Proforma_D_ID->GetValue());
                $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Photo1->Show();
                $this->NameDesc->Show();
                $this->CategoryName->Show();
                $this->SizeName->Show();
                $this->TextureName->Show();
                $this->ColorName->Show();
                $this->MaterialName->Show();
                $this->Qty->Show();
                $this->Label1->Show();
                $this->Label2->Show();
                $this->Label3->Show();
                $this->Proforma_D_ID->Show();
                $this->Proforma_H_ID->Show();
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

//GetErrors Method @176-50FBC0D1
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CategoryName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SizeName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ColorName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MaterialName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Proforma_D_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Proforma_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End DetailPROF Class @176-FCB6E20C

class clsDetailPROFDataSource extends clsDBGayaFusionAll {  //DetailPROFDataSource Class @176-C7F58061

//DataSource Variables @176-CEFAF1B0
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $Photo1;
    public $NameDesc;
    public $CategoryName;
    public $SizeName;
    public $TextureName;
    public $ColorName;
    public $MaterialName;
    public $Qty;
    public $Proforma_D_ID;
    public $Proforma_H_ID;
//End DataSource Variables

//DataSourceClass_Initialize Event @176-696132BE
    function clsDetailPROFDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid DetailPROF";
        $this->Initialize();
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->CategoryName = new clsField("CategoryName", ccsText, "");
        
        $this->SizeName = new clsField("SizeName", ccsText, "");
        
        $this->TextureName = new clsField("TextureName", ccsText, "");
        
        $this->ColorName = new clsField("ColorName", ccsText, "");
        
        $this->MaterialName = new clsField("MaterialName", ccsText, "");
        
        $this->Qty = new clsField("Qty", ccsInteger, "");
        
        $this->Proforma_D_ID = new clsField("Proforma_D_ID", ccsInteger, "");
        
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @176-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @176-DBC47ED7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlProforma_H_ID", ccsInteger, "", "", $this->Parameters["urlProforma_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_proforma_d.Proforma_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @176-2CBB0E5F
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
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tbladminist_proforma_d ON\n\n" .
        "tbladminist_proforma_d.CollectID = tblcollect_master.ID";
        $this->SQL = "SELECT Proforma_D_ID, Proforma_H_ID, CollectID, Qty, Photo1, NameDesc, CategoryName, ColorName, SizeName, TextureName, DesignName,\n\n" .
        "MaterialName \n\n" .
        "FROM (((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tbladminist_proforma_d ON\n\n" .
        "tbladminist_proforma_d.CollectID = tblcollect_master.ID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @176-52845493
    function SetValues()
    {
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->NameDesc->SetDBValue($this->f("NameDesc"));
        $this->CategoryName->SetDBValue($this->f("CategoryName"));
        $this->SizeName->SetDBValue($this->f("SizeName"));
        $this->TextureName->SetDBValue($this->f("TextureName"));
        $this->ColorName->SetDBValue($this->f("ColorName"));
        $this->MaterialName->SetDBValue($this->f("MaterialName"));
        $this->Qty->SetDBValue(trim($this->f("Qty")));
        $this->Proforma_D_ID->SetDBValue(trim($this->f("Proforma_D_ID")));
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
    }
//End SetValues Method

} //End DetailPROFDataSource Class @176-FCB6E20C







//Initialize Page @1-C420EDB1
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
$TemplateFileName = "ShowPOL.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-900FD1FC
include_once("./ShowPOL_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DBBF2C7D
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Grid = new clsGridGrid("", $MainPage);
$DetailPOL = new clsGridDetailPOL("", $MainPage);
$DetailPROF = new clsGridDetailPROF("", $MainPage);
$MainPage->Grid = & $Grid;
$MainPage->DetailPOL = & $DetailPOL;
$MainPage->DetailPROF = & $DetailPROF;
$Grid->Initialize();
$DetailPOL->Initialize();
$DetailPROF->Initialize();

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

//Go to destination page @1-9DB97632
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Grid);
    unset($DetailPOL);
    unset($DetailPROF);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-8F239904
$Grid->Show();
$DetailPOL->Show();
$DetailPROF->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-E14360B6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Grid);
unset($DetailPOL);
unset($DetailPROF);
unset($Tpl);
//End Unload Page


?>
