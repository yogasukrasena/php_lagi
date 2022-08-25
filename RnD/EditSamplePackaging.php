<?php
//Include Common Files @1-D81726A4
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "EditSamplePackaging.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordAddSamplePackaging { //AddSamplePackaging Class @2-3E63B498

//Variables @2-9E315808

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

//Class_Initialize Event @2-C87503ED
    function clsRecordAddSamplePackaging($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record AddSamplePackaging/Error";
        $this->DataSource = new clsAddSamplePackagingDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "AddSamplePackaging";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "multipart/form-data";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->SampleCode = new clsControl(ccsTextBox, "SampleCode", "Sample Code", ccsText, "", CCGetRequestParam("SampleCode", $Method, NULL), $this);
            $this->SampleCode->Required = true;
            $this->Description = new clsControl(ccsTextBox, "Description", "Description", ccsText, "", CCGetRequestParam("Description", $Method, NULL), $this);
            $this->Description->Required = true;
            $this->SampleDate = new clsControl(ccsTextBox, "SampleDate", "Sample Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("SampleDate", $Method, NULL), $this);
            $this->SampleDate->Required = true;
            $this->DatePicker_SampleDate = new clsDatePicker("DatePicker_SampleDate", "AddSamplePackaging", "SampleDate", $this);
            $this->DesMat1 = new clsControl(ccsHidden, "DesMat1", "Des Mat1", ccsInteger, "", CCGetRequestParam("DesMat1", $Method, NULL), $this);
            $this->DesMat2 = new clsControl(ccsHidden, "DesMat2", "Des Mat2", ccsInteger, "", CCGetRequestParam("DesMat2", $Method, NULL), $this);
            $this->DesMat3 = new clsControl(ccsHidden, "DesMat3", "Des Mat3", ccsInteger, "", CCGetRequestParam("DesMat3", $Method, NULL), $this);
            $this->DesMat4 = new clsControl(ccsHidden, "DesMat4", "Des Mat4", ccsInteger, "", CCGetRequestParam("DesMat4", $Method, NULL), $this);
            $this->DesMat5 = new clsControl(ccsHidden, "DesMat5", "Des Mat5", ccsInteger, "", CCGetRequestParam("DesMat5", $Method, NULL), $this);
            $this->QtyDesMat1 = new clsControl(ccsTextBox, "QtyDesMat1", "Qty Des Mat1", ccsInteger, "", CCGetRequestParam("QtyDesMat1", $Method, NULL), $this);
            $this->QtyDesMat2 = new clsControl(ccsTextBox, "QtyDesMat2", "Qty Des Mat2", ccsInteger, "", CCGetRequestParam("QtyDesMat2", $Method, NULL), $this);
            $this->QtyDesMat3 = new clsControl(ccsTextBox, "QtyDesMat3", "Qty Des Mat3", ccsInteger, "", CCGetRequestParam("QtyDesMat3", $Method, NULL), $this);
            $this->QtyDesMat4 = new clsControl(ccsTextBox, "QtyDesMat4", "Qty Des Mat4", ccsInteger, "", CCGetRequestParam("QtyDesMat4", $Method, NULL), $this);
            $this->QtyDesMat5 = new clsControl(ccsTextBox, "QtyDesMat5", "Qty Des Mat5", ccsInteger, "", CCGetRequestParam("QtyDesMat5", $Method, NULL), $this);
            $this->TotalDesMat1 = new clsControl(ccsTextBox, "TotalDesMat1", "Total Des Mat1", ccsFloat, "", CCGetRequestParam("TotalDesMat1", $Method, NULL), $this);
            $this->TotalDesMat2 = new clsControl(ccsTextBox, "TotalDesMat2", "Total Des Mat2", ccsFloat, "", CCGetRequestParam("TotalDesMat2", $Method, NULL), $this);
            $this->TotalDesMat3 = new clsControl(ccsTextBox, "TotalDesMat3", "Total Des Mat3", ccsFloat, "", CCGetRequestParam("TotalDesMat3", $Method, NULL), $this);
            $this->TotalDesMat4 = new clsControl(ccsTextBox, "TotalDesMat4", "Total Des Mat4", ccsFloat, "", CCGetRequestParam("TotalDesMat4", $Method, NULL), $this);
            $this->TotalDesMat5 = new clsControl(ccsTextBox, "TotalDesMat5", "Total Des Mat5", ccsFloat, "", CCGetRequestParam("TotalDesMat5", $Method, NULL), $this);
            $this->Supplier1 = new clsControl(ccsHidden, "Supplier1", "Supplier1", ccsInteger, "", CCGetRequestParam("Supplier1", $Method, NULL), $this);
            $this->Supplier2 = new clsControl(ccsHidden, "Supplier2", "Supplier2", ccsInteger, "", CCGetRequestParam("Supplier2", $Method, NULL), $this);
            $this->Supplier3 = new clsControl(ccsHidden, "Supplier3", "Supplier3", ccsInteger, "", CCGetRequestParam("Supplier3", $Method, NULL), $this);
            $this->Supplier4 = new clsControl(ccsHidden, "Supplier4", "Supplier4", ccsInteger, "", CCGetRequestParam("Supplier4", $Method, NULL), $this);
            $this->Supplier5 = new clsControl(ccsHidden, "Supplier5", "Supplier5", ccsInteger, "", CCGetRequestParam("Supplier5", $Method, NULL), $this);
            $this->Material1 = new clsControl(ccsTextBox, "Material1", "Material1", ccsText, "", CCGetRequestParam("Material1", $Method, NULL), $this);
            $this->Material2 = new clsControl(ccsTextBox, "Material2", "Material2", ccsText, "", CCGetRequestParam("Material2", $Method, NULL), $this);
            $this->Material3 = new clsControl(ccsTextBox, "Material3", "Material3", ccsText, "", CCGetRequestParam("Material3", $Method, NULL), $this);
            $this->Material4 = new clsControl(ccsTextBox, "Material4", "Material4", ccsText, "", CCGetRequestParam("Material4", $Method, NULL), $this);
            $this->Material5 = new clsControl(ccsTextBox, "Material5", "Material5", ccsText, "", CCGetRequestParam("Material5", $Method, NULL), $this);
            $this->Color1 = new clsControl(ccsTextBox, "Color1", "Color1", ccsText, "", CCGetRequestParam("Color1", $Method, NULL), $this);
            $this->Color2 = new clsControl(ccsTextBox, "Color2", "Color2", ccsText, "", CCGetRequestParam("Color2", $Method, NULL), $this);
            $this->Color3 = new clsControl(ccsTextBox, "Color3", "Color3", ccsText, "", CCGetRequestParam("Color3", $Method, NULL), $this);
            $this->Color4 = new clsControl(ccsTextBox, "Color4", "Color4", ccsText, "", CCGetRequestParam("Color4", $Method, NULL), $this);
            $this->Color5 = new clsControl(ccsTextBox, "Color5", "Color5", ccsText, "", CCGetRequestParam("Color5", $Method, NULL), $this);
            $this->CostPrice1 = new clsControl(ccsTextBox, "CostPrice1", "Cost Price1", ccsFloat, "", CCGetRequestParam("CostPrice1", $Method, NULL), $this);
            $this->CostPrice2 = new clsControl(ccsTextBox, "CostPrice2", "Cost Price2", ccsFloat, "", CCGetRequestParam("CostPrice2", $Method, NULL), $this);
            $this->CostPrice3 = new clsControl(ccsTextBox, "CostPrice3", "Cost Price3", ccsFloat, "", CCGetRequestParam("CostPrice3", $Method, NULL), $this);
            $this->CostPrice4 = new clsControl(ccsTextBox, "CostPrice4", "Cost Price4", ccsFloat, "", CCGetRequestParam("CostPrice4", $Method, NULL), $this);
            $this->CostPrice5 = new clsControl(ccsTextBox, "CostPrice5", "Cost Price5", ccsFloat, "", CCGetRequestParam("CostPrice5", $Method, NULL), $this);
            $this->TotalDesMat = new clsControl(ccsTextBox, "TotalDesMat", "Total Des Mat", ccsFloat, "", CCGetRequestParam("TotalDesMat", $Method, NULL), $this);
            $this->TotalCostPrice = new clsControl(ccsTextBox, "TotalCostPrice", "Total Cost Price", ccsFloat, "", CCGetRequestParam("TotalCostPrice", $Method, NULL), $this);
            $this->TotalCost = new clsControl(ccsTextBox, "TotalCost", "Total Cost", ccsFloat, "", CCGetRequestParam("TotalCost", $Method, NULL), $this);
            $this->InnerQty = new clsControl(ccsTextBox, "InnerQty", "Inner Qty", ccsInteger, "", CCGetRequestParam("InnerQty", $Method, NULL), $this);
            $this->Width = new clsControl(ccsTextBox, "Width", "Width", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Width", $Method, NULL), $this);
            $this->Height = new clsControl(ccsTextBox, "Height", "Height", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Height", $Method, NULL), $this);
            $this->Length = new clsControl(ccsTextBox, "Length", "Length", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Length", $Method, NULL), $this);
            $this->Diameter = new clsControl(ccsTextBox, "Diameter", "Diameter", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Diameter", $Method, NULL), $this);
            $this->Volume = new clsControl(ccsTextBox, "Volume", "Volume", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Volume", $Method, NULL), $this);
            $this->Weight = new clsControl(ccsTextBox, "Weight", "Weight", ccsFloat, "", CCGetRequestParam("Weight", $Method, NULL), $this);
            $this->Notes = new clsControl(ccsTextArea, "Notes", "Notes", ccsMemo, "", CCGetRequestParam("Notes", $Method, NULL), $this);
            $this->TechDraw = new clsFileUpload("TechDraw", "TechDraw", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->Photo1 = new clsFileUpload("Photo1", "Photo1", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->Photo2 = new clsFileUpload("Photo2", "Photo2", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->Photo3 = new clsFileUpload("Photo3", "Photo3", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->Photo4 = new clsFileUpload("Photo4", "Photo4", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->LinkDM1 = new clsControl(ccsImageLink, "LinkDM1", "LinkDM1", ccsText, "", CCGetRequestParam("LinkDM1", $Method, NULL), $this);
            $this->LinkDM1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->LinkDM1->Page = "#";
            $this->LinkDM2 = new clsControl(ccsImageLink, "LinkDM2", "LinkDM2", ccsText, "", CCGetRequestParam("LinkDM2", $Method, NULL), $this);
            $this->LinkDM2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->LinkDM2->Page = "#";
            $this->LinkDM3 = new clsControl(ccsImageLink, "LinkDM3", "LinkDM3", ccsText, "", CCGetRequestParam("LinkDM3", $Method, NULL), $this);
            $this->LinkDM3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->LinkDM3->Page = "#";
            $this->LinkDM4 = new clsControl(ccsImageLink, "LinkDM4", "LinkDM4", ccsText, "", CCGetRequestParam("LinkDM4", $Method, NULL), $this);
            $this->LinkDM4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->LinkDM4->Page = "#";
            $this->LinkDM5 = new clsControl(ccsImageLink, "LinkDM5", "LinkDM5", ccsText, "", CCGetRequestParam("LinkDM5", $Method, NULL), $this);
            $this->LinkDM5->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->LinkDM5->Page = "#";
            $this->DesignMatSup1 = new clsControl(ccsTextBox, "DesignMatSup1", "DesignMatSup1", ccsText, "", CCGetRequestParam("DesignMatSup1", $Method, NULL), $this);
            $this->DesignMatSup2 = new clsControl(ccsTextBox, "DesignMatSup2", "DesignMatSup2", ccsText, "", CCGetRequestParam("DesignMatSup2", $Method, NULL), $this);
            $this->DesignMatSup3 = new clsControl(ccsTextBox, "DesignMatSup3", "DesignMatSup3", ccsText, "", CCGetRequestParam("DesignMatSup3", $Method, NULL), $this);
            $this->DesignMatSup4 = new clsControl(ccsTextBox, "DesignMatSup4", "DesignMatSup4", ccsText, "", CCGetRequestParam("DesignMatSup4", $Method, NULL), $this);
            $this->DesignMatSup5 = new clsControl(ccsTextBox, "DesignMatSup5", "DesignMatSup5", ccsText, "", CCGetRequestParam("DesignMatSup5", $Method, NULL), $this);
            $this->DesignMatUnit1 = new clsControl(ccsTextBox, "DesignMatUnit1", "DesignMatUnit1", ccsText, "", CCGetRequestParam("DesignMatUnit1", $Method, NULL), $this);
            $this->DesignMatUnit2 = new clsControl(ccsTextBox, "DesignMatUnit2", "DesignMatUnit2", ccsText, "", CCGetRequestParam("DesignMatUnit2", $Method, NULL), $this);
            $this->DesignMatUnit3 = new clsControl(ccsTextBox, "DesignMatUnit3", "DesignMatUnit3", ccsText, "", CCGetRequestParam("DesignMatUnit3", $Method, NULL), $this);
            $this->DesignMatUnit4 = new clsControl(ccsTextBox, "DesignMatUnit4", "DesignMatUnit4", ccsText, "", CCGetRequestParam("DesignMatUnit4", $Method, NULL), $this);
            $this->DesignMatUnit5 = new clsControl(ccsTextBox, "DesignMatUnit5", "DesignMatUnit5", ccsText, "", CCGetRequestParam("DesignMatUnit5", $Method, NULL), $this);
            $this->DesignMatUnitPrice1 = new clsControl(ccsTextBox, "DesignMatUnitPrice1", "DesignMatUnitPrice1", ccsText, "", CCGetRequestParam("DesignMatUnitPrice1", $Method, NULL), $this);
            $this->DesignMatUnitPrice2 = new clsControl(ccsTextBox, "DesignMatUnitPrice2", "DesignMatUnitPrice2", ccsText, "", CCGetRequestParam("DesignMatUnitPrice2", $Method, NULL), $this);
            $this->DesignMatUnitPrice3 = new clsControl(ccsTextBox, "DesignMatUnitPrice3", "DesignMatUnitPrice3", ccsText, "", CCGetRequestParam("DesignMatUnitPrice3", $Method, NULL), $this);
            $this->DesignMatUnitPrice4 = new clsControl(ccsTextBox, "DesignMatUnitPrice4", "DesignMatUnitPrice4", ccsText, "", CCGetRequestParam("DesignMatUnitPrice4", $Method, NULL), $this);
            $this->DesignMatUnitPrice5 = new clsControl(ccsTextBox, "DesignMatUnitPrice5", "DesignMatUnitPrice5", ccsText, "", CCGetRequestParam("DesignMatUnitPrice5", $Method, NULL), $this);
            $this->LinkSup1 = new clsControl(ccsImageLink, "LinkSup1", "LinkSup1", ccsText, "", CCGetRequestParam("LinkSup1", $Method, NULL), $this);
            $this->LinkSup1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->LinkSup1->Page = "SupplierPopup.php";
            $this->LinkSup2 = new clsControl(ccsImageLink, "LinkSup2", "LinkSup2", ccsText, "", CCGetRequestParam("LinkSup2", $Method, NULL), $this);
            $this->LinkSup2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->LinkSup2->Page = "SupplierPopup.php";
            $this->LinkSup3 = new clsControl(ccsImageLink, "LinkSup3", "LinkSup3", ccsText, "", CCGetRequestParam("LinkSup3", $Method, NULL), $this);
            $this->LinkSup3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->LinkSup3->Page = "SupplierPopup.php";
            $this->LinkSup4 = new clsControl(ccsImageLink, "LinkSup4", "LinkSup4", ccsText, "", CCGetRequestParam("LinkSup4", $Method, NULL), $this);
            $this->LinkSup4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->LinkSup4->Page = "SupplierPopup.php";
            $this->LinkSup5 = new clsControl(ccsImageLink, "LinkSup5", "LinkSup5", ccsText, "", CCGetRequestParam("LinkSup5", $Method, NULL), $this);
            $this->LinkSup5->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->LinkSup5->Page = "SupplierPopup.php";
            $this->SupDesc1 = new clsControl(ccsTextBox, "SupDesc1", "SupDesc1", ccsText, "", CCGetRequestParam("SupDesc1", $Method, NULL), $this);
            $this->SupDesc2 = new clsControl(ccsTextBox, "SupDesc2", "SupDesc2", ccsText, "", CCGetRequestParam("SupDesc2", $Method, NULL), $this);
            $this->SupDesc3 = new clsControl(ccsTextBox, "SupDesc3", "SupDesc3", ccsText, "", CCGetRequestParam("SupDesc3", $Method, NULL), $this);
            $this->SupDesc4 = new clsControl(ccsTextBox, "SupDesc4", "SupDesc4", ccsText, "", CCGetRequestParam("SupDesc4", $Method, NULL), $this);
            $this->SupDesc5 = new clsControl(ccsTextBox, "SupDesc5", "SupDesc5", ccsText, "", CCGetRequestParam("SupDesc5", $Method, NULL), $this);
            $this->DesMatDesc1 = new clsControl(ccsTextBox, "DesMatDesc1", "DesMatDesc1", ccsText, "", CCGetRequestParam("DesMatDesc1", $Method, NULL), $this);
            $this->DesMatDesc2 = new clsControl(ccsTextBox, "DesMatDesc2", "DesMatDesc2", ccsText, "", CCGetRequestParam("DesMatDesc2", $Method, NULL), $this);
            $this->DesMatDesc3 = new clsControl(ccsTextBox, "DesMatDesc3", "DesMatDesc3", ccsText, "", CCGetRequestParam("DesMatDesc3", $Method, NULL), $this);
            $this->DesMatDesc4 = new clsControl(ccsTextBox, "DesMatDesc4", "DesMatDesc4", ccsText, "", CCGetRequestParam("DesMatDesc4", $Method, NULL), $this);
            $this->DesMatDesc5 = new clsControl(ccsTextBox, "DesMatDesc5", "DesMatDesc5", ccsText, "", CCGetRequestParam("DesMatDesc5", $Method, NULL), $this);
            $this->DelDesMat1 = new clsControl(ccsLink, "DelDesMat1", "DelDesMat1", ccsText, "", CCGetRequestParam("DelDesMat1", $Method, NULL), $this);
            $this->DelDesMat1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelDesMat1->Page = "#";
            $this->DelDesMat2 = new clsControl(ccsLink, "DelDesMat2", "DelDesMat2", ccsText, "", CCGetRequestParam("DelDesMat2", $Method, NULL), $this);
            $this->DelDesMat2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelDesMat2->Page = "#";
            $this->DelDesMat3 = new clsControl(ccsLink, "DelDesMat3", "DelDesMat3", ccsText, "", CCGetRequestParam("DelDesMat3", $Method, NULL), $this);
            $this->DelDesMat3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelDesMat3->Page = "#";
            $this->DelDesMat4 = new clsControl(ccsLink, "DelDesMat4", "DelDesMat4", ccsText, "", CCGetRequestParam("DelDesMat4", $Method, NULL), $this);
            $this->DelDesMat4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelDesMat4->Page = "#";
            $this->DelDesMat5 = new clsControl(ccsLink, "DelDesMat5", "DelDesMat5", ccsText, "", CCGetRequestParam("DelDesMat5", $Method, NULL), $this);
            $this->DelDesMat5->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelDesMat5->Page = "#";
            $this->DelSup1 = new clsControl(ccsLink, "DelSup1", "DelSup1", ccsText, "", CCGetRequestParam("DelSup1", $Method, NULL), $this);
            $this->DelSup1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelSup1->Page = "#";
            $this->DelSup2 = new clsControl(ccsLink, "DelSup2", "DelSup2", ccsText, "", CCGetRequestParam("DelSup2", $Method, NULL), $this);
            $this->DelSup2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelSup2->Page = "#";
            $this->DelSup3 = new clsControl(ccsLink, "DelSup3", "DelSup3", ccsText, "", CCGetRequestParam("DelSup3", $Method, NULL), $this);
            $this->DelSup3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelSup3->Page = "#";
            $this->DelSup4 = new clsControl(ccsLink, "DelSup4", "DelSup4", ccsText, "", CCGetRequestParam("DelSup4", $Method, NULL), $this);
            $this->DelSup4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelSup4->Page = "#";
            $this->DelSup5 = new clsControl(ccsLink, "DelSup5", "DelSup5", ccsText, "", CCGetRequestParam("DelSup5", $Method, NULL), $this);
            $this->DelSup5->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelSup5->Page = "#";
            if(!$this->FormSubmitted) {
                if(!is_array($this->TotalDesMat1->Value) && !strlen($this->TotalDesMat1->Value) && $this->TotalDesMat1->Value !== false)
                    $this->TotalDesMat1->SetText(0);
                if(!is_array($this->TotalDesMat2->Value) && !strlen($this->TotalDesMat2->Value) && $this->TotalDesMat2->Value !== false)
                    $this->TotalDesMat2->SetText(0);
                if(!is_array($this->TotalDesMat3->Value) && !strlen($this->TotalDesMat3->Value) && $this->TotalDesMat3->Value !== false)
                    $this->TotalDesMat3->SetText(0);
                if(!is_array($this->TotalDesMat4->Value) && !strlen($this->TotalDesMat4->Value) && $this->TotalDesMat4->Value !== false)
                    $this->TotalDesMat4->SetText(0);
                if(!is_array($this->TotalDesMat5->Value) && !strlen($this->TotalDesMat5->Value) && $this->TotalDesMat5->Value !== false)
                    $this->TotalDesMat5->SetText(0);
                if(!is_array($this->CostPrice1->Value) && !strlen($this->CostPrice1->Value) && $this->CostPrice1->Value !== false)
                    $this->CostPrice1->SetText(0);
                if(!is_array($this->CostPrice2->Value) && !strlen($this->CostPrice2->Value) && $this->CostPrice2->Value !== false)
                    $this->CostPrice2->SetText(0);
                if(!is_array($this->CostPrice3->Value) && !strlen($this->CostPrice3->Value) && $this->CostPrice3->Value !== false)
                    $this->CostPrice3->SetText(0);
                if(!is_array($this->CostPrice4->Value) && !strlen($this->CostPrice4->Value) && $this->CostPrice4->Value !== false)
                    $this->CostPrice4->SetText(0);
                if(!is_array($this->CostPrice5->Value) && !strlen($this->CostPrice5->Value) && $this->CostPrice5->Value !== false)
                    $this->CostPrice5->SetText(0);
                if(!is_array($this->TotalCostPrice->Value) && !strlen($this->TotalCostPrice->Value) && $this->TotalCostPrice->Value !== false)
                    $this->TotalCostPrice->SetText(0);
                if(!is_array($this->TotalCost->Value) && !strlen($this->TotalCost->Value) && $this->TotalCost->Value !== false)
                    $this->TotalCost->SetText(0);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @2-D6CB1C94
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlID"] = CCGetFromGet("ID", NULL);
    }
//End Initialize Method

//Validate Method @2-8CEFF0A1
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->SampleCode->Validate() && $Validation);
        $Validation = ($this->Description->Validate() && $Validation);
        $Validation = ($this->SampleDate->Validate() && $Validation);
        $Validation = ($this->DesMat1->Validate() && $Validation);
        $Validation = ($this->DesMat2->Validate() && $Validation);
        $Validation = ($this->DesMat3->Validate() && $Validation);
        $Validation = ($this->DesMat4->Validate() && $Validation);
        $Validation = ($this->DesMat5->Validate() && $Validation);
        $Validation = ($this->QtyDesMat1->Validate() && $Validation);
        $Validation = ($this->QtyDesMat2->Validate() && $Validation);
        $Validation = ($this->QtyDesMat3->Validate() && $Validation);
        $Validation = ($this->QtyDesMat4->Validate() && $Validation);
        $Validation = ($this->QtyDesMat5->Validate() && $Validation);
        $Validation = ($this->TotalDesMat1->Validate() && $Validation);
        $Validation = ($this->TotalDesMat2->Validate() && $Validation);
        $Validation = ($this->TotalDesMat3->Validate() && $Validation);
        $Validation = ($this->TotalDesMat4->Validate() && $Validation);
        $Validation = ($this->TotalDesMat5->Validate() && $Validation);
        $Validation = ($this->Supplier1->Validate() && $Validation);
        $Validation = ($this->Supplier2->Validate() && $Validation);
        $Validation = ($this->Supplier3->Validate() && $Validation);
        $Validation = ($this->Supplier4->Validate() && $Validation);
        $Validation = ($this->Supplier5->Validate() && $Validation);
        $Validation = ($this->Material1->Validate() && $Validation);
        $Validation = ($this->Material2->Validate() && $Validation);
        $Validation = ($this->Material3->Validate() && $Validation);
        $Validation = ($this->Material4->Validate() && $Validation);
        $Validation = ($this->Material5->Validate() && $Validation);
        $Validation = ($this->Color1->Validate() && $Validation);
        $Validation = ($this->Color2->Validate() && $Validation);
        $Validation = ($this->Color3->Validate() && $Validation);
        $Validation = ($this->Color4->Validate() && $Validation);
        $Validation = ($this->Color5->Validate() && $Validation);
        $Validation = ($this->CostPrice1->Validate() && $Validation);
        $Validation = ($this->CostPrice2->Validate() && $Validation);
        $Validation = ($this->CostPrice3->Validate() && $Validation);
        $Validation = ($this->CostPrice4->Validate() && $Validation);
        $Validation = ($this->CostPrice5->Validate() && $Validation);
        $Validation = ($this->TotalDesMat->Validate() && $Validation);
        $Validation = ($this->TotalCostPrice->Validate() && $Validation);
        $Validation = ($this->TotalCost->Validate() && $Validation);
        $Validation = ($this->InnerQty->Validate() && $Validation);
        $Validation = ($this->Width->Validate() && $Validation);
        $Validation = ($this->Height->Validate() && $Validation);
        $Validation = ($this->Length->Validate() && $Validation);
        $Validation = ($this->Diameter->Validate() && $Validation);
        $Validation = ($this->Volume->Validate() && $Validation);
        $Validation = ($this->Weight->Validate() && $Validation);
        $Validation = ($this->Notes->Validate() && $Validation);
        $Validation = ($this->TechDraw->Validate() && $Validation);
        $Validation = ($this->Photo1->Validate() && $Validation);
        $Validation = ($this->Photo2->Validate() && $Validation);
        $Validation = ($this->Photo3->Validate() && $Validation);
        $Validation = ($this->Photo4->Validate() && $Validation);
        $Validation = ($this->DesignMatSup1->Validate() && $Validation);
        $Validation = ($this->DesignMatSup2->Validate() && $Validation);
        $Validation = ($this->DesignMatSup3->Validate() && $Validation);
        $Validation = ($this->DesignMatSup4->Validate() && $Validation);
        $Validation = ($this->DesignMatSup5->Validate() && $Validation);
        $Validation = ($this->DesignMatUnit1->Validate() && $Validation);
        $Validation = ($this->DesignMatUnit2->Validate() && $Validation);
        $Validation = ($this->DesignMatUnit3->Validate() && $Validation);
        $Validation = ($this->DesignMatUnit4->Validate() && $Validation);
        $Validation = ($this->DesignMatUnit5->Validate() && $Validation);
        $Validation = ($this->DesignMatUnitPrice1->Validate() && $Validation);
        $Validation = ($this->DesignMatUnitPrice2->Validate() && $Validation);
        $Validation = ($this->DesignMatUnitPrice3->Validate() && $Validation);
        $Validation = ($this->DesignMatUnitPrice4->Validate() && $Validation);
        $Validation = ($this->DesignMatUnitPrice5->Validate() && $Validation);
        $Validation = ($this->SupDesc1->Validate() && $Validation);
        $Validation = ($this->SupDesc2->Validate() && $Validation);
        $Validation = ($this->SupDesc3->Validate() && $Validation);
        $Validation = ($this->SupDesc4->Validate() && $Validation);
        $Validation = ($this->SupDesc5->Validate() && $Validation);
        $Validation = ($this->DesMatDesc1->Validate() && $Validation);
        $Validation = ($this->DesMatDesc2->Validate() && $Validation);
        $Validation = ($this->DesMatDesc3->Validate() && $Validation);
        $Validation = ($this->DesMatDesc4->Validate() && $Validation);
        $Validation = ($this->DesMatDesc5->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->SampleCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SampleDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMat1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMat2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMat3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMat4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMat5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->QtyDesMat1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->QtyDesMat2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->QtyDesMat3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->QtyDesMat4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->QtyDesMat5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TotalDesMat1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TotalDesMat2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TotalDesMat3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TotalDesMat4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TotalDesMat5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Supplier1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Supplier2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Supplier3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Supplier4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Supplier5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Material1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Material2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Material3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Material4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Material5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Color1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Color2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Color3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Color4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Color5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CostPrice1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CostPrice2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CostPrice3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CostPrice4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CostPrice5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TotalDesMat->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TotalCostPrice->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TotalCost->Errors->Count() == 0);
        $Validation =  $Validation && ($this->InnerQty->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Width->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Height->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Length->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Diameter->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Volume->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Weight->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Notes->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TechDraw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Photo1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Photo2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Photo3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Photo4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatSup1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatSup2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatSup3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatSup4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatSup5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnit1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnit2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnit3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnit4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnit5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnitPrice1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnitPrice2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnitPrice3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnitPrice4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnitPrice5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SupDesc1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SupDesc2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SupDesc3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SupDesc4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SupDesc5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMatDesc1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMatDesc2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMatDesc3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMatDesc4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMatDesc5->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-88BE761E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->SampleCode->Errors->Count());
        $errors = ($errors || $this->Description->Errors->Count());
        $errors = ($errors || $this->SampleDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_SampleDate->Errors->Count());
        $errors = ($errors || $this->DesMat1->Errors->Count());
        $errors = ($errors || $this->DesMat2->Errors->Count());
        $errors = ($errors || $this->DesMat3->Errors->Count());
        $errors = ($errors || $this->DesMat4->Errors->Count());
        $errors = ($errors || $this->DesMat5->Errors->Count());
        $errors = ($errors || $this->QtyDesMat1->Errors->Count());
        $errors = ($errors || $this->QtyDesMat2->Errors->Count());
        $errors = ($errors || $this->QtyDesMat3->Errors->Count());
        $errors = ($errors || $this->QtyDesMat4->Errors->Count());
        $errors = ($errors || $this->QtyDesMat5->Errors->Count());
        $errors = ($errors || $this->TotalDesMat1->Errors->Count());
        $errors = ($errors || $this->TotalDesMat2->Errors->Count());
        $errors = ($errors || $this->TotalDesMat3->Errors->Count());
        $errors = ($errors || $this->TotalDesMat4->Errors->Count());
        $errors = ($errors || $this->TotalDesMat5->Errors->Count());
        $errors = ($errors || $this->Supplier1->Errors->Count());
        $errors = ($errors || $this->Supplier2->Errors->Count());
        $errors = ($errors || $this->Supplier3->Errors->Count());
        $errors = ($errors || $this->Supplier4->Errors->Count());
        $errors = ($errors || $this->Supplier5->Errors->Count());
        $errors = ($errors || $this->Material1->Errors->Count());
        $errors = ($errors || $this->Material2->Errors->Count());
        $errors = ($errors || $this->Material3->Errors->Count());
        $errors = ($errors || $this->Material4->Errors->Count());
        $errors = ($errors || $this->Material5->Errors->Count());
        $errors = ($errors || $this->Color1->Errors->Count());
        $errors = ($errors || $this->Color2->Errors->Count());
        $errors = ($errors || $this->Color3->Errors->Count());
        $errors = ($errors || $this->Color4->Errors->Count());
        $errors = ($errors || $this->Color5->Errors->Count());
        $errors = ($errors || $this->CostPrice1->Errors->Count());
        $errors = ($errors || $this->CostPrice2->Errors->Count());
        $errors = ($errors || $this->CostPrice3->Errors->Count());
        $errors = ($errors || $this->CostPrice4->Errors->Count());
        $errors = ($errors || $this->CostPrice5->Errors->Count());
        $errors = ($errors || $this->TotalDesMat->Errors->Count());
        $errors = ($errors || $this->TotalCostPrice->Errors->Count());
        $errors = ($errors || $this->TotalCost->Errors->Count());
        $errors = ($errors || $this->InnerQty->Errors->Count());
        $errors = ($errors || $this->Width->Errors->Count());
        $errors = ($errors || $this->Height->Errors->Count());
        $errors = ($errors || $this->Length->Errors->Count());
        $errors = ($errors || $this->Diameter->Errors->Count());
        $errors = ($errors || $this->Volume->Errors->Count());
        $errors = ($errors || $this->Weight->Errors->Count());
        $errors = ($errors || $this->Notes->Errors->Count());
        $errors = ($errors || $this->TechDraw->Errors->Count());
        $errors = ($errors || $this->Photo1->Errors->Count());
        $errors = ($errors || $this->Photo2->Errors->Count());
        $errors = ($errors || $this->Photo3->Errors->Count());
        $errors = ($errors || $this->Photo4->Errors->Count());
        $errors = ($errors || $this->LinkDM1->Errors->Count());
        $errors = ($errors || $this->LinkDM2->Errors->Count());
        $errors = ($errors || $this->LinkDM3->Errors->Count());
        $errors = ($errors || $this->LinkDM4->Errors->Count());
        $errors = ($errors || $this->LinkDM5->Errors->Count());
        $errors = ($errors || $this->DesignMatSup1->Errors->Count());
        $errors = ($errors || $this->DesignMatSup2->Errors->Count());
        $errors = ($errors || $this->DesignMatSup3->Errors->Count());
        $errors = ($errors || $this->DesignMatSup4->Errors->Count());
        $errors = ($errors || $this->DesignMatSup5->Errors->Count());
        $errors = ($errors || $this->DesignMatUnit1->Errors->Count());
        $errors = ($errors || $this->DesignMatUnit2->Errors->Count());
        $errors = ($errors || $this->DesignMatUnit3->Errors->Count());
        $errors = ($errors || $this->DesignMatUnit4->Errors->Count());
        $errors = ($errors || $this->DesignMatUnit5->Errors->Count());
        $errors = ($errors || $this->DesignMatUnitPrice1->Errors->Count());
        $errors = ($errors || $this->DesignMatUnitPrice2->Errors->Count());
        $errors = ($errors || $this->DesignMatUnitPrice3->Errors->Count());
        $errors = ($errors || $this->DesignMatUnitPrice4->Errors->Count());
        $errors = ($errors || $this->DesignMatUnitPrice5->Errors->Count());
        $errors = ($errors || $this->LinkSup1->Errors->Count());
        $errors = ($errors || $this->LinkSup2->Errors->Count());
        $errors = ($errors || $this->LinkSup3->Errors->Count());
        $errors = ($errors || $this->LinkSup4->Errors->Count());
        $errors = ($errors || $this->LinkSup5->Errors->Count());
        $errors = ($errors || $this->SupDesc1->Errors->Count());
        $errors = ($errors || $this->SupDesc2->Errors->Count());
        $errors = ($errors || $this->SupDesc3->Errors->Count());
        $errors = ($errors || $this->SupDesc4->Errors->Count());
        $errors = ($errors || $this->SupDesc5->Errors->Count());
        $errors = ($errors || $this->DesMatDesc1->Errors->Count());
        $errors = ($errors || $this->DesMatDesc2->Errors->Count());
        $errors = ($errors || $this->DesMatDesc3->Errors->Count());
        $errors = ($errors || $this->DesMatDesc4->Errors->Count());
        $errors = ($errors || $this->DesMatDesc5->Errors->Count());
        $errors = ($errors || $this->DelDesMat1->Errors->Count());
        $errors = ($errors || $this->DelDesMat2->Errors->Count());
        $errors = ($errors || $this->DelDesMat3->Errors->Count());
        $errors = ($errors || $this->DelDesMat4->Errors->Count());
        $errors = ($errors || $this->DelDesMat5->Errors->Count());
        $errors = ($errors || $this->DelSup1->Errors->Count());
        $errors = ($errors || $this->DelSup2->Errors->Count());
        $errors = ($errors || $this->DelSup3->Errors->Count());
        $errors = ($errors || $this->DelSup4->Errors->Count());
        $errors = ($errors || $this->DelSup5->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
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

//Operation Method @2-4B0AC26D
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

        $this->TechDraw->Upload();
        $this->Photo1->Upload();
        $this->Photo2->Upload();
        $this->Photo3->Upload();
        $this->Photo4->Upload();

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
            $Redirect = "SamplePackaging.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "SamplePackaging.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "SamplePackaging.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @2-74419A57
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->SampleCode->SetValue($this->SampleCode->GetValue(true));
        $this->DataSource->Description->SetValue($this->Description->GetValue(true));
        $this->DataSource->SampleDate->SetValue($this->SampleDate->GetValue(true));
        $this->DataSource->DesMat1->SetValue($this->DesMat1->GetValue(true));
        $this->DataSource->DesMat2->SetValue($this->DesMat2->GetValue(true));
        $this->DataSource->DesMat3->SetValue($this->DesMat3->GetValue(true));
        $this->DataSource->DesMat4->SetValue($this->DesMat4->GetValue(true));
        $this->DataSource->DesMat5->SetValue($this->DesMat5->GetValue(true));
        $this->DataSource->QtyDesMat1->SetValue($this->QtyDesMat1->GetValue(true));
        $this->DataSource->QtyDesMat2->SetValue($this->QtyDesMat2->GetValue(true));
        $this->DataSource->QtyDesMat3->SetValue($this->QtyDesMat3->GetValue(true));
        $this->DataSource->QtyDesMat4->SetValue($this->QtyDesMat4->GetValue(true));
        $this->DataSource->QtyDesMat5->SetValue($this->QtyDesMat5->GetValue(true));
        $this->DataSource->TotalDesMat1->SetValue($this->TotalDesMat1->GetValue(true));
        $this->DataSource->TotalDesMat2->SetValue($this->TotalDesMat2->GetValue(true));
        $this->DataSource->TotalDesMat3->SetValue($this->TotalDesMat3->GetValue(true));
        $this->DataSource->TotalDesMat4->SetValue($this->TotalDesMat4->GetValue(true));
        $this->DataSource->TotalDesMat5->SetValue($this->TotalDesMat5->GetValue(true));
        $this->DataSource->Supplier1->SetValue($this->Supplier1->GetValue(true));
        $this->DataSource->Supplier2->SetValue($this->Supplier2->GetValue(true));
        $this->DataSource->Supplier3->SetValue($this->Supplier3->GetValue(true));
        $this->DataSource->Supplier4->SetValue($this->Supplier4->GetValue(true));
        $this->DataSource->Supplier5->SetValue($this->Supplier5->GetValue(true));
        $this->DataSource->Material1->SetValue($this->Material1->GetValue(true));
        $this->DataSource->Material2->SetValue($this->Material2->GetValue(true));
        $this->DataSource->Material3->SetValue($this->Material3->GetValue(true));
        $this->DataSource->Material4->SetValue($this->Material4->GetValue(true));
        $this->DataSource->Material5->SetValue($this->Material5->GetValue(true));
        $this->DataSource->Color1->SetValue($this->Color1->GetValue(true));
        $this->DataSource->Color2->SetValue($this->Color2->GetValue(true));
        $this->DataSource->Color3->SetValue($this->Color3->GetValue(true));
        $this->DataSource->Color4->SetValue($this->Color4->GetValue(true));
        $this->DataSource->Color5->SetValue($this->Color5->GetValue(true));
        $this->DataSource->CostPrice1->SetValue($this->CostPrice1->GetValue(true));
        $this->DataSource->CostPrice2->SetValue($this->CostPrice2->GetValue(true));
        $this->DataSource->CostPrice3->SetValue($this->CostPrice3->GetValue(true));
        $this->DataSource->CostPrice4->SetValue($this->CostPrice4->GetValue(true));
        $this->DataSource->CostPrice5->SetValue($this->CostPrice5->GetValue(true));
        $this->DataSource->TotalDesMat->SetValue($this->TotalDesMat->GetValue(true));
        $this->DataSource->TotalCostPrice->SetValue($this->TotalCostPrice->GetValue(true));
        $this->DataSource->TotalCost->SetValue($this->TotalCost->GetValue(true));
        $this->DataSource->InnerQty->SetValue($this->InnerQty->GetValue(true));
        $this->DataSource->Width->SetValue($this->Width->GetValue(true));
        $this->DataSource->Height->SetValue($this->Height->GetValue(true));
        $this->DataSource->Length->SetValue($this->Length->GetValue(true));
        $this->DataSource->Diameter->SetValue($this->Diameter->GetValue(true));
        $this->DataSource->Volume->SetValue($this->Volume->GetValue(true));
        $this->DataSource->Weight->SetValue($this->Weight->GetValue(true));
        $this->DataSource->Notes->SetValue($this->Notes->GetValue(true));
        $this->DataSource->TechDraw->SetValue($this->TechDraw->GetValue(true));
        $this->DataSource->Photo1->SetValue($this->Photo1->GetValue(true));
        $this->DataSource->Photo2->SetValue($this->Photo2->GetValue(true));
        $this->DataSource->Photo3->SetValue($this->Photo3->GetValue(true));
        $this->DataSource->Photo4->SetValue($this->Photo4->GetValue(true));
        $this->DataSource->LinkDM1->SetValue($this->LinkDM1->GetValue(true));
        $this->DataSource->LinkDM2->SetValue($this->LinkDM2->GetValue(true));
        $this->DataSource->LinkDM3->SetValue($this->LinkDM3->GetValue(true));
        $this->DataSource->LinkDM4->SetValue($this->LinkDM4->GetValue(true));
        $this->DataSource->LinkDM5->SetValue($this->LinkDM5->GetValue(true));
        $this->DataSource->DesignMatSup1->SetValue($this->DesignMatSup1->GetValue(true));
        $this->DataSource->DesignMatSup2->SetValue($this->DesignMatSup2->GetValue(true));
        $this->DataSource->DesignMatSup3->SetValue($this->DesignMatSup3->GetValue(true));
        $this->DataSource->DesignMatSup4->SetValue($this->DesignMatSup4->GetValue(true));
        $this->DataSource->DesignMatSup5->SetValue($this->DesignMatSup5->GetValue(true));
        $this->DataSource->DesignMatUnit1->SetValue($this->DesignMatUnit1->GetValue(true));
        $this->DataSource->DesignMatUnit2->SetValue($this->DesignMatUnit2->GetValue(true));
        $this->DataSource->DesignMatUnit3->SetValue($this->DesignMatUnit3->GetValue(true));
        $this->DataSource->DesignMatUnit4->SetValue($this->DesignMatUnit4->GetValue(true));
        $this->DataSource->DesignMatUnit5->SetValue($this->DesignMatUnit5->GetValue(true));
        $this->DataSource->DesignMatUnitPrice1->SetValue($this->DesignMatUnitPrice1->GetValue(true));
        $this->DataSource->DesignMatUnitPrice2->SetValue($this->DesignMatUnitPrice2->GetValue(true));
        $this->DataSource->DesignMatUnitPrice3->SetValue($this->DesignMatUnitPrice3->GetValue(true));
        $this->DataSource->DesignMatUnitPrice4->SetValue($this->DesignMatUnitPrice4->GetValue(true));
        $this->DataSource->DesignMatUnitPrice5->SetValue($this->DesignMatUnitPrice5->GetValue(true));
        $this->DataSource->LinkSup1->SetValue($this->LinkSup1->GetValue(true));
        $this->DataSource->LinkSup2->SetValue($this->LinkSup2->GetValue(true));
        $this->DataSource->LinkSup3->SetValue($this->LinkSup3->GetValue(true));
        $this->DataSource->LinkSup4->SetValue($this->LinkSup4->GetValue(true));
        $this->DataSource->LinkSup5->SetValue($this->LinkSup5->GetValue(true));
        $this->DataSource->SupDesc1->SetValue($this->SupDesc1->GetValue(true));
        $this->DataSource->SupDesc2->SetValue($this->SupDesc2->GetValue(true));
        $this->DataSource->SupDesc3->SetValue($this->SupDesc3->GetValue(true));
        $this->DataSource->SupDesc4->SetValue($this->SupDesc4->GetValue(true));
        $this->DataSource->SupDesc5->SetValue($this->SupDesc5->GetValue(true));
        $this->DataSource->DesMatDesc1->SetValue($this->DesMatDesc1->GetValue(true));
        $this->DataSource->DesMatDesc2->SetValue($this->DesMatDesc2->GetValue(true));
        $this->DataSource->DesMatDesc3->SetValue($this->DesMatDesc3->GetValue(true));
        $this->DataSource->DesMatDesc4->SetValue($this->DesMatDesc4->GetValue(true));
        $this->DataSource->DesMatDesc5->SetValue($this->DesMatDesc5->GetValue(true));
        $this->DataSource->DelDesMat1->SetValue($this->DelDesMat1->GetValue(true));
        $this->DataSource->DelDesMat2->SetValue($this->DelDesMat2->GetValue(true));
        $this->DataSource->DelDesMat3->SetValue($this->DelDesMat3->GetValue(true));
        $this->DataSource->DelDesMat4->SetValue($this->DelDesMat4->GetValue(true));
        $this->DataSource->DelDesMat5->SetValue($this->DelDesMat5->GetValue(true));
        $this->DataSource->DelSup1->SetValue($this->DelSup1->GetValue(true));
        $this->DataSource->DelSup2->SetValue($this->DelSup2->GetValue(true));
        $this->DataSource->DelSup3->SetValue($this->DelSup3->GetValue(true));
        $this->DataSource->DelSup4->SetValue($this->DelSup4->GetValue(true));
        $this->DataSource->DelSup5->SetValue($this->DelSup5->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->TechDraw->Move();
            $this->Photo1->Move();
            $this->Photo2->Move();
            $this->Photo3->Move();
            $this->Photo4->Move();
        }
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-D421B38C
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->SampleCode->SetValue($this->SampleCode->GetValue(true));
        $this->DataSource->Description->SetValue($this->Description->GetValue(true));
        $this->DataSource->SampleDate->SetValue($this->SampleDate->GetValue(true));
        $this->DataSource->DesMat1->SetValue($this->DesMat1->GetValue(true));
        $this->DataSource->DesMat2->SetValue($this->DesMat2->GetValue(true));
        $this->DataSource->DesMat3->SetValue($this->DesMat3->GetValue(true));
        $this->DataSource->DesMat4->SetValue($this->DesMat4->GetValue(true));
        $this->DataSource->DesMat5->SetValue($this->DesMat5->GetValue(true));
        $this->DataSource->QtyDesMat1->SetValue($this->QtyDesMat1->GetValue(true));
        $this->DataSource->QtyDesMat2->SetValue($this->QtyDesMat2->GetValue(true));
        $this->DataSource->QtyDesMat3->SetValue($this->QtyDesMat3->GetValue(true));
        $this->DataSource->QtyDesMat4->SetValue($this->QtyDesMat4->GetValue(true));
        $this->DataSource->QtyDesMat5->SetValue($this->QtyDesMat5->GetValue(true));
        $this->DataSource->TotalDesMat1->SetValue($this->TotalDesMat1->GetValue(true));
        $this->DataSource->TotalDesMat2->SetValue($this->TotalDesMat2->GetValue(true));
        $this->DataSource->TotalDesMat3->SetValue($this->TotalDesMat3->GetValue(true));
        $this->DataSource->TotalDesMat4->SetValue($this->TotalDesMat4->GetValue(true));
        $this->DataSource->TotalDesMat5->SetValue($this->TotalDesMat5->GetValue(true));
        $this->DataSource->Supplier1->SetValue($this->Supplier1->GetValue(true));
        $this->DataSource->Supplier2->SetValue($this->Supplier2->GetValue(true));
        $this->DataSource->Supplier3->SetValue($this->Supplier3->GetValue(true));
        $this->DataSource->Supplier4->SetValue($this->Supplier4->GetValue(true));
        $this->DataSource->Supplier5->SetValue($this->Supplier5->GetValue(true));
        $this->DataSource->Material1->SetValue($this->Material1->GetValue(true));
        $this->DataSource->Material2->SetValue($this->Material2->GetValue(true));
        $this->DataSource->Material3->SetValue($this->Material3->GetValue(true));
        $this->DataSource->Material4->SetValue($this->Material4->GetValue(true));
        $this->DataSource->Material5->SetValue($this->Material5->GetValue(true));
        $this->DataSource->Color1->SetValue($this->Color1->GetValue(true));
        $this->DataSource->Color2->SetValue($this->Color2->GetValue(true));
        $this->DataSource->Color3->SetValue($this->Color3->GetValue(true));
        $this->DataSource->Color4->SetValue($this->Color4->GetValue(true));
        $this->DataSource->Color5->SetValue($this->Color5->GetValue(true));
        $this->DataSource->CostPrice1->SetValue($this->CostPrice1->GetValue(true));
        $this->DataSource->CostPrice2->SetValue($this->CostPrice2->GetValue(true));
        $this->DataSource->CostPrice3->SetValue($this->CostPrice3->GetValue(true));
        $this->DataSource->CostPrice4->SetValue($this->CostPrice4->GetValue(true));
        $this->DataSource->CostPrice5->SetValue($this->CostPrice5->GetValue(true));
        $this->DataSource->TotalDesMat->SetValue($this->TotalDesMat->GetValue(true));
        $this->DataSource->TotalCostPrice->SetValue($this->TotalCostPrice->GetValue(true));
        $this->DataSource->TotalCost->SetValue($this->TotalCost->GetValue(true));
        $this->DataSource->InnerQty->SetValue($this->InnerQty->GetValue(true));
        $this->DataSource->Width->SetValue($this->Width->GetValue(true));
        $this->DataSource->Height->SetValue($this->Height->GetValue(true));
        $this->DataSource->Length->SetValue($this->Length->GetValue(true));
        $this->DataSource->Diameter->SetValue($this->Diameter->GetValue(true));
        $this->DataSource->Volume->SetValue($this->Volume->GetValue(true));
        $this->DataSource->Weight->SetValue($this->Weight->GetValue(true));
        $this->DataSource->Notes->SetValue($this->Notes->GetValue(true));
        $this->DataSource->TechDraw->SetValue($this->TechDraw->GetValue(true));
        $this->DataSource->Photo1->SetValue($this->Photo1->GetValue(true));
        $this->DataSource->Photo2->SetValue($this->Photo2->GetValue(true));
        $this->DataSource->Photo3->SetValue($this->Photo3->GetValue(true));
        $this->DataSource->Photo4->SetValue($this->Photo4->GetValue(true));
        $this->DataSource->LinkDM1->SetValue($this->LinkDM1->GetValue(true));
        $this->DataSource->LinkDM2->SetValue($this->LinkDM2->GetValue(true));
        $this->DataSource->LinkDM3->SetValue($this->LinkDM3->GetValue(true));
        $this->DataSource->LinkDM4->SetValue($this->LinkDM4->GetValue(true));
        $this->DataSource->LinkDM5->SetValue($this->LinkDM5->GetValue(true));
        $this->DataSource->DesignMatSup1->SetValue($this->DesignMatSup1->GetValue(true));
        $this->DataSource->DesignMatSup2->SetValue($this->DesignMatSup2->GetValue(true));
        $this->DataSource->DesignMatSup3->SetValue($this->DesignMatSup3->GetValue(true));
        $this->DataSource->DesignMatSup4->SetValue($this->DesignMatSup4->GetValue(true));
        $this->DataSource->DesignMatSup5->SetValue($this->DesignMatSup5->GetValue(true));
        $this->DataSource->DesignMatUnit1->SetValue($this->DesignMatUnit1->GetValue(true));
        $this->DataSource->DesignMatUnit2->SetValue($this->DesignMatUnit2->GetValue(true));
        $this->DataSource->DesignMatUnit3->SetValue($this->DesignMatUnit3->GetValue(true));
        $this->DataSource->DesignMatUnit4->SetValue($this->DesignMatUnit4->GetValue(true));
        $this->DataSource->DesignMatUnit5->SetValue($this->DesignMatUnit5->GetValue(true));
        $this->DataSource->DesignMatUnitPrice1->SetValue($this->DesignMatUnitPrice1->GetValue(true));
        $this->DataSource->DesignMatUnitPrice2->SetValue($this->DesignMatUnitPrice2->GetValue(true));
        $this->DataSource->DesignMatUnitPrice3->SetValue($this->DesignMatUnitPrice3->GetValue(true));
        $this->DataSource->DesignMatUnitPrice4->SetValue($this->DesignMatUnitPrice4->GetValue(true));
        $this->DataSource->DesignMatUnitPrice5->SetValue($this->DesignMatUnitPrice5->GetValue(true));
        $this->DataSource->LinkSup1->SetValue($this->LinkSup1->GetValue(true));
        $this->DataSource->LinkSup2->SetValue($this->LinkSup2->GetValue(true));
        $this->DataSource->LinkSup3->SetValue($this->LinkSup3->GetValue(true));
        $this->DataSource->LinkSup4->SetValue($this->LinkSup4->GetValue(true));
        $this->DataSource->LinkSup5->SetValue($this->LinkSup5->GetValue(true));
        $this->DataSource->SupDesc1->SetValue($this->SupDesc1->GetValue(true));
        $this->DataSource->SupDesc2->SetValue($this->SupDesc2->GetValue(true));
        $this->DataSource->SupDesc3->SetValue($this->SupDesc3->GetValue(true));
        $this->DataSource->SupDesc4->SetValue($this->SupDesc4->GetValue(true));
        $this->DataSource->SupDesc5->SetValue($this->SupDesc5->GetValue(true));
        $this->DataSource->DesMatDesc1->SetValue($this->DesMatDesc1->GetValue(true));
        $this->DataSource->DesMatDesc2->SetValue($this->DesMatDesc2->GetValue(true));
        $this->DataSource->DesMatDesc3->SetValue($this->DesMatDesc3->GetValue(true));
        $this->DataSource->DesMatDesc4->SetValue($this->DesMatDesc4->GetValue(true));
        $this->DataSource->DesMatDesc5->SetValue($this->DesMatDesc5->GetValue(true));
        $this->DataSource->DelDesMat1->SetValue($this->DelDesMat1->GetValue(true));
        $this->DataSource->DelDesMat2->SetValue($this->DelDesMat2->GetValue(true));
        $this->DataSource->DelDesMat3->SetValue($this->DelDesMat3->GetValue(true));
        $this->DataSource->DelDesMat4->SetValue($this->DelDesMat4->GetValue(true));
        $this->DataSource->DelDesMat5->SetValue($this->DelDesMat5->GetValue(true));
        $this->DataSource->DelSup1->SetValue($this->DelSup1->GetValue(true));
        $this->DataSource->DelSup2->SetValue($this->DelSup2->GetValue(true));
        $this->DataSource->DelSup3->SetValue($this->DelSup3->GetValue(true));
        $this->DataSource->DelSup4->SetValue($this->DelSup4->GetValue(true));
        $this->DataSource->DelSup5->SetValue($this->DelSup5->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->TechDraw->Move();
            $this->Photo1->Move();
            $this->Photo2->Move();
            $this->Photo3->Move();
            $this->Photo4->Move();
        }
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-2CD11B1B
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->TechDraw->Delete();
            $this->Photo1->Delete();
            $this->Photo2->Delete();
            $this->Photo3->Delete();
            $this->Photo4->Delete();
        }
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-067F30DD
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
                    $this->SampleCode->SetValue($this->DataSource->SampleCode->GetValue());
                    $this->Description->SetValue($this->DataSource->Description->GetValue());
                    $this->SampleDate->SetValue($this->DataSource->SampleDate->GetValue());
                    $this->DesMat1->SetValue($this->DataSource->DesMat1->GetValue());
                    $this->DesMat2->SetValue($this->DataSource->DesMat2->GetValue());
                    $this->DesMat3->SetValue($this->DataSource->DesMat3->GetValue());
                    $this->DesMat4->SetValue($this->DataSource->DesMat4->GetValue());
                    $this->DesMat5->SetValue($this->DataSource->DesMat5->GetValue());
                    $this->QtyDesMat1->SetValue($this->DataSource->QtyDesMat1->GetValue());
                    $this->QtyDesMat2->SetValue($this->DataSource->QtyDesMat2->GetValue());
                    $this->QtyDesMat3->SetValue($this->DataSource->QtyDesMat3->GetValue());
                    $this->QtyDesMat4->SetValue($this->DataSource->QtyDesMat4->GetValue());
                    $this->QtyDesMat5->SetValue($this->DataSource->QtyDesMat5->GetValue());
                    $this->Supplier1->SetValue($this->DataSource->Supplier1->GetValue());
                    $this->Supplier2->SetValue($this->DataSource->Supplier2->GetValue());
                    $this->Supplier3->SetValue($this->DataSource->Supplier3->GetValue());
                    $this->Supplier4->SetValue($this->DataSource->Supplier4->GetValue());
                    $this->Supplier5->SetValue($this->DataSource->Supplier5->GetValue());
                    $this->Material1->SetValue($this->DataSource->Material1->GetValue());
                    $this->Material2->SetValue($this->DataSource->Material2->GetValue());
                    $this->Material3->SetValue($this->DataSource->Material3->GetValue());
                    $this->Material4->SetValue($this->DataSource->Material4->GetValue());
                    $this->Material5->SetValue($this->DataSource->Material5->GetValue());
                    $this->Color1->SetValue($this->DataSource->Color1->GetValue());
                    $this->Color2->SetValue($this->DataSource->Color2->GetValue());
                    $this->Color3->SetValue($this->DataSource->Color3->GetValue());
                    $this->Color4->SetValue($this->DataSource->Color4->GetValue());
                    $this->Color5->SetValue($this->DataSource->Color5->GetValue());
                    $this->CostPrice1->SetValue($this->DataSource->CostPrice1->GetValue());
                    $this->CostPrice2->SetValue($this->DataSource->CostPrice2->GetValue());
                    $this->CostPrice3->SetValue($this->DataSource->CostPrice3->GetValue());
                    $this->CostPrice4->SetValue($this->DataSource->CostPrice4->GetValue());
                    $this->CostPrice5->SetValue($this->DataSource->CostPrice5->GetValue());
                    $this->TotalCostPrice->SetValue($this->DataSource->TotalCostPrice->GetValue());
                    $this->InnerQty->SetValue($this->DataSource->InnerQty->GetValue());
                    $this->Width->SetValue($this->DataSource->Width->GetValue());
                    $this->Height->SetValue($this->DataSource->Height->GetValue());
                    $this->Length->SetValue($this->DataSource->Length->GetValue());
                    $this->Diameter->SetValue($this->DataSource->Diameter->GetValue());
                    $this->Volume->SetValue($this->DataSource->Volume->GetValue());
                    $this->Weight->SetValue($this->DataSource->Weight->GetValue());
                    $this->Notes->SetValue($this->DataSource->Notes->GetValue());
                    $this->TechDraw->SetValue($this->DataSource->TechDraw->GetValue());
                    $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                    $this->Photo2->SetValue($this->DataSource->Photo2->GetValue());
                    $this->Photo3->SetValue($this->DataSource->Photo3->GetValue());
                    $this->Photo4->SetValue($this->DataSource->Photo4->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->SampleCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SampleDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_SampleDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMat1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMat2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMat3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMat4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMat5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->QtyDesMat1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->QtyDesMat2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->QtyDesMat3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->QtyDesMat4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->QtyDesMat5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotalDesMat1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotalDesMat2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotalDesMat3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotalDesMat4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotalDesMat5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Supplier1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Supplier2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Supplier3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Supplier4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Supplier5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Material1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Material2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Material3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Material4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Material5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Color1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Color2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Color3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Color4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Color5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CostPrice1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CostPrice2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CostPrice3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CostPrice4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CostPrice5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotalDesMat->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotalCostPrice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotalCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InnerQty->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Width->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Height->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Length->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Diameter->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Volume->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Weight->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Notes->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkDM1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkDM2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkDM3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkDM4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkDM5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatSup1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatSup2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatSup3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatSup4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatSup5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnit1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnit2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnit3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnit4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnit5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnitPrice1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnitPrice2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnitPrice3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnitPrice4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnitPrice5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkSup1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkSup2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkSup3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkSup4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkSup5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupDesc1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupDesc2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupDesc3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupDesc4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupDesc5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMatDesc1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMatDesc2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMatDesc3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMatDesc4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMatDesc5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelDesMat1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelDesMat2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelDesMat3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelDesMat4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelDesMat5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelSup1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelSup2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelSup3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelSup4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelSup5->Errors->ToString());
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
        $this->SampleCode->Show();
        $this->Description->Show();
        $this->SampleDate->Show();
        $this->DatePicker_SampleDate->Show();
        $this->DesMat1->Show();
        $this->DesMat2->Show();
        $this->DesMat3->Show();
        $this->DesMat4->Show();
        $this->DesMat5->Show();
        $this->QtyDesMat1->Show();
        $this->QtyDesMat2->Show();
        $this->QtyDesMat3->Show();
        $this->QtyDesMat4->Show();
        $this->QtyDesMat5->Show();
        $this->TotalDesMat1->Show();
        $this->TotalDesMat2->Show();
        $this->TotalDesMat3->Show();
        $this->TotalDesMat4->Show();
        $this->TotalDesMat5->Show();
        $this->Supplier1->Show();
        $this->Supplier2->Show();
        $this->Supplier3->Show();
        $this->Supplier4->Show();
        $this->Supplier5->Show();
        $this->Material1->Show();
        $this->Material2->Show();
        $this->Material3->Show();
        $this->Material4->Show();
        $this->Material5->Show();
        $this->Color1->Show();
        $this->Color2->Show();
        $this->Color3->Show();
        $this->Color4->Show();
        $this->Color5->Show();
        $this->CostPrice1->Show();
        $this->CostPrice2->Show();
        $this->CostPrice3->Show();
        $this->CostPrice4->Show();
        $this->CostPrice5->Show();
        $this->TotalDesMat->Show();
        $this->TotalCostPrice->Show();
        $this->TotalCost->Show();
        $this->InnerQty->Show();
        $this->Width->Show();
        $this->Height->Show();
        $this->Length->Show();
        $this->Diameter->Show();
        $this->Volume->Show();
        $this->Weight->Show();
        $this->Notes->Show();
        $this->TechDraw->Show();
        $this->Photo1->Show();
        $this->Photo2->Show();
        $this->Photo3->Show();
        $this->Photo4->Show();
        $this->LinkDM1->Show();
        $this->LinkDM2->Show();
        $this->LinkDM3->Show();
        $this->LinkDM4->Show();
        $this->LinkDM5->Show();
        $this->DesignMatSup1->Show();
        $this->DesignMatSup2->Show();
        $this->DesignMatSup3->Show();
        $this->DesignMatSup4->Show();
        $this->DesignMatSup5->Show();
        $this->DesignMatUnit1->Show();
        $this->DesignMatUnit2->Show();
        $this->DesignMatUnit3->Show();
        $this->DesignMatUnit4->Show();
        $this->DesignMatUnit5->Show();
        $this->DesignMatUnitPrice1->Show();
        $this->DesignMatUnitPrice2->Show();
        $this->DesignMatUnitPrice3->Show();
        $this->DesignMatUnitPrice4->Show();
        $this->DesignMatUnitPrice5->Show();
        $this->LinkSup1->Show();
        $this->LinkSup2->Show();
        $this->LinkSup3->Show();
        $this->LinkSup4->Show();
        $this->LinkSup5->Show();
        $this->SupDesc1->Show();
        $this->SupDesc2->Show();
        $this->SupDesc3->Show();
        $this->SupDesc4->Show();
        $this->SupDesc5->Show();
        $this->DesMatDesc1->Show();
        $this->DesMatDesc2->Show();
        $this->DesMatDesc3->Show();
        $this->DesMatDesc4->Show();
        $this->DesMatDesc5->Show();
        $this->DelDesMat1->Show();
        $this->DelDesMat2->Show();
        $this->DelDesMat3->Show();
        $this->DelDesMat4->Show();
        $this->DelDesMat5->Show();
        $this->DelSup1->Show();
        $this->DelSup2->Show();
        $this->DelSup3->Show();
        $this->DelSup4->Show();
        $this->DelSup5->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddSamplePackaging Class @2-FCB6E20C

class clsAddSamplePackagingDataSource extends clsDBGayaFusionAll {  //AddSamplePackagingDataSource Class @2-12C36211

//DataSource Variables @2-F891CEF3
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
    public $SampleCode;
    public $Description;
    public $SampleDate;
    public $DesMat1;
    public $DesMat2;
    public $DesMat3;
    public $DesMat4;
    public $DesMat5;
    public $QtyDesMat1;
    public $QtyDesMat2;
    public $QtyDesMat3;
    public $QtyDesMat4;
    public $QtyDesMat5;
    public $TotalDesMat1;
    public $TotalDesMat2;
    public $TotalDesMat3;
    public $TotalDesMat4;
    public $TotalDesMat5;
    public $Supplier1;
    public $Supplier2;
    public $Supplier3;
    public $Supplier4;
    public $Supplier5;
    public $Material1;
    public $Material2;
    public $Material3;
    public $Material4;
    public $Material5;
    public $Color1;
    public $Color2;
    public $Color3;
    public $Color4;
    public $Color5;
    public $CostPrice1;
    public $CostPrice2;
    public $CostPrice3;
    public $CostPrice4;
    public $CostPrice5;
    public $TotalDesMat;
    public $TotalCostPrice;
    public $TotalCost;
    public $InnerQty;
    public $Width;
    public $Height;
    public $Length;
    public $Diameter;
    public $Volume;
    public $Weight;
    public $Notes;
    public $TechDraw;
    public $Photo1;
    public $Photo2;
    public $Photo3;
    public $Photo4;
    public $LinkDM1;
    public $LinkDM2;
    public $LinkDM3;
    public $LinkDM4;
    public $LinkDM5;
    public $DesignMatSup1;
    public $DesignMatSup2;
    public $DesignMatSup3;
    public $DesignMatSup4;
    public $DesignMatSup5;
    public $DesignMatUnit1;
    public $DesignMatUnit2;
    public $DesignMatUnit3;
    public $DesignMatUnit4;
    public $DesignMatUnit5;
    public $DesignMatUnitPrice1;
    public $DesignMatUnitPrice2;
    public $DesignMatUnitPrice3;
    public $DesignMatUnitPrice4;
    public $DesignMatUnitPrice5;
    public $LinkSup1;
    public $LinkSup2;
    public $LinkSup3;
    public $LinkSup4;
    public $LinkSup5;
    public $SupDesc1;
    public $SupDesc2;
    public $SupDesc3;
    public $SupDesc4;
    public $SupDesc5;
    public $DesMatDesc1;
    public $DesMatDesc2;
    public $DesMatDesc3;
    public $DesMatDesc4;
    public $DesMatDesc5;
    public $DelDesMat1;
    public $DelDesMat2;
    public $DelDesMat3;
    public $DelDesMat4;
    public $DelDesMat5;
    public $DelSup1;
    public $DelSup2;
    public $DelSup3;
    public $DelSup4;
    public $DelSup5;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-D76641B2
    function clsAddSamplePackagingDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddSamplePackaging/Error";
        $this->Initialize();
        $this->SampleCode = new clsField("SampleCode", ccsText, "");
        
        $this->Description = new clsField("Description", ccsText, "");
        
        $this->SampleDate = new clsField("SampleDate", ccsDate, $this->DateFormat);
        
        $this->DesMat1 = new clsField("DesMat1", ccsInteger, "");
        
        $this->DesMat2 = new clsField("DesMat2", ccsInteger, "");
        
        $this->DesMat3 = new clsField("DesMat3", ccsInteger, "");
        
        $this->DesMat4 = new clsField("DesMat4", ccsInteger, "");
        
        $this->DesMat5 = new clsField("DesMat5", ccsInteger, "");
        
        $this->QtyDesMat1 = new clsField("QtyDesMat1", ccsInteger, "");
        
        $this->QtyDesMat2 = new clsField("QtyDesMat2", ccsInteger, "");
        
        $this->QtyDesMat3 = new clsField("QtyDesMat3", ccsInteger, "");
        
        $this->QtyDesMat4 = new clsField("QtyDesMat4", ccsInteger, "");
        
        $this->QtyDesMat5 = new clsField("QtyDesMat5", ccsInteger, "");
        
        $this->TotalDesMat1 = new clsField("TotalDesMat1", ccsFloat, "");
        
        $this->TotalDesMat2 = new clsField("TotalDesMat2", ccsFloat, "");
        
        $this->TotalDesMat3 = new clsField("TotalDesMat3", ccsFloat, "");
        
        $this->TotalDesMat4 = new clsField("TotalDesMat4", ccsFloat, "");
        
        $this->TotalDesMat5 = new clsField("TotalDesMat5", ccsFloat, "");
        
        $this->Supplier1 = new clsField("Supplier1", ccsInteger, "");
        
        $this->Supplier2 = new clsField("Supplier2", ccsInteger, "");
        
        $this->Supplier3 = new clsField("Supplier3", ccsInteger, "");
        
        $this->Supplier4 = new clsField("Supplier4", ccsInteger, "");
        
        $this->Supplier5 = new clsField("Supplier5", ccsInteger, "");
        
        $this->Material1 = new clsField("Material1", ccsText, "");
        
        $this->Material2 = new clsField("Material2", ccsText, "");
        
        $this->Material3 = new clsField("Material3", ccsText, "");
        
        $this->Material4 = new clsField("Material4", ccsText, "");
        
        $this->Material5 = new clsField("Material5", ccsText, "");
        
        $this->Color1 = new clsField("Color1", ccsText, "");
        
        $this->Color2 = new clsField("Color2", ccsText, "");
        
        $this->Color3 = new clsField("Color3", ccsText, "");
        
        $this->Color4 = new clsField("Color4", ccsText, "");
        
        $this->Color5 = new clsField("Color5", ccsText, "");
        
        $this->CostPrice1 = new clsField("CostPrice1", ccsFloat, "");
        
        $this->CostPrice2 = new clsField("CostPrice2", ccsFloat, "");
        
        $this->CostPrice3 = new clsField("CostPrice3", ccsFloat, "");
        
        $this->CostPrice4 = new clsField("CostPrice4", ccsFloat, "");
        
        $this->CostPrice5 = new clsField("CostPrice5", ccsFloat, "");
        
        $this->TotalDesMat = new clsField("TotalDesMat", ccsFloat, "");
        
        $this->TotalCostPrice = new clsField("TotalCostPrice", ccsFloat, "");
        
        $this->TotalCost = new clsField("TotalCost", ccsFloat, "");
        
        $this->InnerQty = new clsField("InnerQty", ccsInteger, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->Diameter = new clsField("Diameter", ccsFloat, "");
        
        $this->Volume = new clsField("Volume", ccsFloat, "");
        
        $this->Weight = new clsField("Weight", ccsFloat, "");
        
        $this->Notes = new clsField("Notes", ccsMemo, "");
        
        $this->TechDraw = new clsField("TechDraw", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->Photo2 = new clsField("Photo2", ccsText, "");
        
        $this->Photo3 = new clsField("Photo3", ccsText, "");
        
        $this->Photo4 = new clsField("Photo4", ccsText, "");
        
        $this->LinkDM1 = new clsField("LinkDM1", ccsText, "");
        
        $this->LinkDM2 = new clsField("LinkDM2", ccsText, "");
        
        $this->LinkDM3 = new clsField("LinkDM3", ccsText, "");
        
        $this->LinkDM4 = new clsField("LinkDM4", ccsText, "");
        
        $this->LinkDM5 = new clsField("LinkDM5", ccsText, "");
        
        $this->DesignMatSup1 = new clsField("DesignMatSup1", ccsText, "");
        
        $this->DesignMatSup2 = new clsField("DesignMatSup2", ccsText, "");
        
        $this->DesignMatSup3 = new clsField("DesignMatSup3", ccsText, "");
        
        $this->DesignMatSup4 = new clsField("DesignMatSup4", ccsText, "");
        
        $this->DesignMatSup5 = new clsField("DesignMatSup5", ccsText, "");
        
        $this->DesignMatUnit1 = new clsField("DesignMatUnit1", ccsText, "");
        
        $this->DesignMatUnit2 = new clsField("DesignMatUnit2", ccsText, "");
        
        $this->DesignMatUnit3 = new clsField("DesignMatUnit3", ccsText, "");
        
        $this->DesignMatUnit4 = new clsField("DesignMatUnit4", ccsText, "");
        
        $this->DesignMatUnit5 = new clsField("DesignMatUnit5", ccsText, "");
        
        $this->DesignMatUnitPrice1 = new clsField("DesignMatUnitPrice1", ccsText, "");
        
        $this->DesignMatUnitPrice2 = new clsField("DesignMatUnitPrice2", ccsText, "");
        
        $this->DesignMatUnitPrice3 = new clsField("DesignMatUnitPrice3", ccsText, "");
        
        $this->DesignMatUnitPrice4 = new clsField("DesignMatUnitPrice4", ccsText, "");
        
        $this->DesignMatUnitPrice5 = new clsField("DesignMatUnitPrice5", ccsText, "");
        
        $this->LinkSup1 = new clsField("LinkSup1", ccsText, "");
        
        $this->LinkSup2 = new clsField("LinkSup2", ccsText, "");
        
        $this->LinkSup3 = new clsField("LinkSup3", ccsText, "");
        
        $this->LinkSup4 = new clsField("LinkSup4", ccsText, "");
        
        $this->LinkSup5 = new clsField("LinkSup5", ccsText, "");
        
        $this->SupDesc1 = new clsField("SupDesc1", ccsText, "");
        
        $this->SupDesc2 = new clsField("SupDesc2", ccsText, "");
        
        $this->SupDesc3 = new clsField("SupDesc3", ccsText, "");
        
        $this->SupDesc4 = new clsField("SupDesc4", ccsText, "");
        
        $this->SupDesc5 = new clsField("SupDesc5", ccsText, "");
        
        $this->DesMatDesc1 = new clsField("DesMatDesc1", ccsText, "");
        
        $this->DesMatDesc2 = new clsField("DesMatDesc2", ccsText, "");
        
        $this->DesMatDesc3 = new clsField("DesMatDesc3", ccsText, "");
        
        $this->DesMatDesc4 = new clsField("DesMatDesc4", ccsText, "");
        
        $this->DesMatDesc5 = new clsField("DesMatDesc5", ccsText, "");
        
        $this->DelDesMat1 = new clsField("DelDesMat1", ccsText, "");
        
        $this->DelDesMat2 = new clsField("DelDesMat2", ccsText, "");
        
        $this->DelDesMat3 = new clsField("DelDesMat3", ccsText, "");
        
        $this->DelDesMat4 = new clsField("DelDesMat4", ccsText, "");
        
        $this->DelDesMat5 = new clsField("DelDesMat5", ccsText, "");
        
        $this->DelSup1 = new clsField("DelSup1", ccsText, "");
        
        $this->DelSup2 = new clsField("DelSup2", ccsText, "");
        
        $this->DelSup3 = new clsField("DelSup3", ccsText, "");
        
        $this->DelSup4 = new clsField("DelSup4", ccsText, "");
        
        $this->DelSup5 = new clsField("DelSup5", ccsText, "");
        

        $this->InsertFields["SampleCode"] = array("Name" => "SampleCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Description"] = array("Name" => "Description", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["SampleDate"] = array("Name" => "SampleDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["DesMat1"] = array("Name" => "DesMat1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DesMat2"] = array("Name" => "DesMat2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DesMat3"] = array("Name" => "DesMat3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DesMat4"] = array("Name" => "DesMat4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DesMat5"] = array("Name" => "DesMat5", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["QtyDesMat1"] = array("Name" => "QtyDesMat1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["QtyDesMat2"] = array("Name" => "QtyDesMat2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["QtyDesMat3"] = array("Name" => "QtyDesMat3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["QtyDesMat4"] = array("Name" => "QtyDesMat4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["QtyDesMat5"] = array("Name" => "QtyDesMat5", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Supplier1"] = array("Name" => "Supplier1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Supplier2"] = array("Name" => "Supplier2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Supplier3"] = array("Name" => "Supplier3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Supplier4"] = array("Name" => "Supplier4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Supplier5"] = array("Name" => "Supplier5", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Material1"] = array("Name" => "Material1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Material2"] = array("Name" => "Material2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Material3"] = array("Name" => "Material3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Material4"] = array("Name" => "Material4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Material5"] = array("Name" => "Material5", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Color1"] = array("Name" => "Color1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Color2"] = array("Name" => "Color2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Color3"] = array("Name" => "Color3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Color4"] = array("Name" => "Color4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Color5"] = array("Name" => "Color5", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["CostPrice1"] = array("Name" => "CostPrice1", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["CostPrice2"] = array("Name" => "CostPrice2", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["CostPrice3"] = array("Name" => "CostPrice3", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["CostPrice4"] = array("Name" => "CostPrice4", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["CostPrice5"] = array("Name" => "CostPrice5", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["TotalCostPrice"] = array("Name" => "TotalCostPrice", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["InnerQty"] = array("Name" => "InnerQty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Width"] = array("Name" => "Width", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Height"] = array("Name" => "Height", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Length"] = array("Name" => "Length", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Diameter"] = array("Name" => "Diameter", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Volume"] = array("Name" => "Volume", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Weight"] = array("Name" => "Weight", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Notes"] = array("Name" => "Notes", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["TechDraw"] = array("Name" => "TechDraw", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Photo1"] = array("Name" => "Photo1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Photo2"] = array("Name" => "Photo2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Photo3"] = array("Name" => "Photo3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Photo4"] = array("Name" => "Photo4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SampleCode"] = array("Name" => "SampleCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Description"] = array("Name" => "Description", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SampleDate"] = array("Name" => "SampleDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesMat1"] = array("Name" => "DesMat1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesMat2"] = array("Name" => "DesMat2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesMat3"] = array("Name" => "DesMat3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesMat4"] = array("Name" => "DesMat4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesMat5"] = array("Name" => "DesMat5", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["QtyDesMat1"] = array("Name" => "QtyDesMat1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["QtyDesMat2"] = array("Name" => "QtyDesMat2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["QtyDesMat3"] = array("Name" => "QtyDesMat3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["QtyDesMat4"] = array("Name" => "QtyDesMat4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["QtyDesMat5"] = array("Name" => "QtyDesMat5", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Supplier1"] = array("Name" => "Supplier1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Supplier2"] = array("Name" => "Supplier2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Supplier3"] = array("Name" => "Supplier3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Supplier4"] = array("Name" => "Supplier4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Supplier5"] = array("Name" => "Supplier5", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Material1"] = array("Name" => "Material1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Material2"] = array("Name" => "Material2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Material3"] = array("Name" => "Material3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Material4"] = array("Name" => "Material4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Material5"] = array("Name" => "Material5", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Color1"] = array("Name" => "Color1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Color2"] = array("Name" => "Color2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Color3"] = array("Name" => "Color3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Color4"] = array("Name" => "Color4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Color5"] = array("Name" => "Color5", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["CostPrice1"] = array("Name" => "CostPrice1", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["CostPrice2"] = array("Name" => "CostPrice2", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["CostPrice3"] = array("Name" => "CostPrice3", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["CostPrice4"] = array("Name" => "CostPrice4", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["CostPrice5"] = array("Name" => "CostPrice5", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["TotalCostPrice"] = array("Name" => "TotalCostPrice", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["InnerQty"] = array("Name" => "InnerQty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Width"] = array("Name" => "Width", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Height"] = array("Name" => "Height", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Length"] = array("Name" => "Length", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Diameter"] = array("Name" => "Diameter", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Volume"] = array("Name" => "Volume", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Weight"] = array("Name" => "Weight", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Notes"] = array("Name" => "Notes", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["TechDraw"] = array("Name" => "TechDraw", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Photo1"] = array("Name" => "Photo1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Photo2"] = array("Name" => "Photo2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Photo3"] = array("Name" => "Photo3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Photo4"] = array("Name" => "Photo4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-C6736E1B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlID", ccsInteger, "", "", $this->Parameters["urlID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-4EE35D69
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM samplepackaging {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-F23BDC15
    function SetValues()
    {
        $this->SampleCode->SetDBValue($this->f("SampleCode"));
        $this->Description->SetDBValue($this->f("Description"));
        $this->SampleDate->SetDBValue(trim($this->f("SampleDate")));
        $this->DesMat1->SetDBValue(trim($this->f("DesMat1")));
        $this->DesMat2->SetDBValue(trim($this->f("DesMat2")));
        $this->DesMat3->SetDBValue(trim($this->f("DesMat3")));
        $this->DesMat4->SetDBValue(trim($this->f("DesMat4")));
        $this->DesMat5->SetDBValue(trim($this->f("DesMat5")));
        $this->QtyDesMat1->SetDBValue(trim($this->f("QtyDesMat1")));
        $this->QtyDesMat2->SetDBValue(trim($this->f("QtyDesMat2")));
        $this->QtyDesMat3->SetDBValue(trim($this->f("QtyDesMat3")));
        $this->QtyDesMat4->SetDBValue(trim($this->f("QtyDesMat4")));
        $this->QtyDesMat5->SetDBValue(trim($this->f("QtyDesMat5")));
        $this->Supplier1->SetDBValue(trim($this->f("Supplier1")));
        $this->Supplier2->SetDBValue(trim($this->f("Supplier2")));
        $this->Supplier3->SetDBValue(trim($this->f("Supplier3")));
        $this->Supplier4->SetDBValue(trim($this->f("Supplier4")));
        $this->Supplier5->SetDBValue(trim($this->f("Supplier5")));
        $this->Material1->SetDBValue($this->f("Material1"));
        $this->Material2->SetDBValue($this->f("Material2"));
        $this->Material3->SetDBValue($this->f("Material3"));
        $this->Material4->SetDBValue($this->f("Material4"));
        $this->Material5->SetDBValue($this->f("Material5"));
        $this->Color1->SetDBValue($this->f("Color1"));
        $this->Color2->SetDBValue($this->f("Color2"));
        $this->Color3->SetDBValue($this->f("Color3"));
        $this->Color4->SetDBValue($this->f("Color4"));
        $this->Color5->SetDBValue($this->f("Color5"));
        $this->CostPrice1->SetDBValue(trim($this->f("CostPrice1")));
        $this->CostPrice2->SetDBValue(trim($this->f("CostPrice2")));
        $this->CostPrice3->SetDBValue(trim($this->f("CostPrice3")));
        $this->CostPrice4->SetDBValue(trim($this->f("CostPrice4")));
        $this->CostPrice5->SetDBValue(trim($this->f("CostPrice5")));
        $this->TotalCostPrice->SetDBValue(trim($this->f("TotalCostPrice")));
        $this->InnerQty->SetDBValue(trim($this->f("InnerQty")));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
        $this->Volume->SetDBValue(trim($this->f("Volume")));
        $this->Weight->SetDBValue(trim($this->f("Weight")));
        $this->Notes->SetDBValue($this->f("Notes"));
        $this->TechDraw->SetDBValue($this->f("TechDraw"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->Photo2->SetDBValue($this->f("Photo2"));
        $this->Photo3->SetDBValue($this->f("Photo3"));
        $this->Photo4->SetDBValue($this->f("Photo4"));
    }
//End SetValues Method

//Insert Method @2-C1A7ACF1
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["SampleCode"]["Value"] = $this->SampleCode->GetDBValue(true);
        $this->InsertFields["Description"]["Value"] = $this->Description->GetDBValue(true);
        $this->InsertFields["SampleDate"]["Value"] = $this->SampleDate->GetDBValue(true);
        $this->InsertFields["DesMat1"]["Value"] = $this->DesMat1->GetDBValue(true);
        $this->InsertFields["DesMat2"]["Value"] = $this->DesMat2->GetDBValue(true);
        $this->InsertFields["DesMat3"]["Value"] = $this->DesMat3->GetDBValue(true);
        $this->InsertFields["DesMat4"]["Value"] = $this->DesMat4->GetDBValue(true);
        $this->InsertFields["DesMat5"]["Value"] = $this->DesMat5->GetDBValue(true);
        $this->InsertFields["QtyDesMat1"]["Value"] = $this->QtyDesMat1->GetDBValue(true);
        $this->InsertFields["QtyDesMat2"]["Value"] = $this->QtyDesMat2->GetDBValue(true);
        $this->InsertFields["QtyDesMat3"]["Value"] = $this->QtyDesMat3->GetDBValue(true);
        $this->InsertFields["QtyDesMat4"]["Value"] = $this->QtyDesMat4->GetDBValue(true);
        $this->InsertFields["QtyDesMat5"]["Value"] = $this->QtyDesMat5->GetDBValue(true);
        $this->InsertFields["Supplier1"]["Value"] = $this->Supplier1->GetDBValue(true);
        $this->InsertFields["Supplier2"]["Value"] = $this->Supplier2->GetDBValue(true);
        $this->InsertFields["Supplier3"]["Value"] = $this->Supplier3->GetDBValue(true);
        $this->InsertFields["Supplier4"]["Value"] = $this->Supplier4->GetDBValue(true);
        $this->InsertFields["Supplier5"]["Value"] = $this->Supplier5->GetDBValue(true);
        $this->InsertFields["Material1"]["Value"] = $this->Material1->GetDBValue(true);
        $this->InsertFields["Material2"]["Value"] = $this->Material2->GetDBValue(true);
        $this->InsertFields["Material3"]["Value"] = $this->Material3->GetDBValue(true);
        $this->InsertFields["Material4"]["Value"] = $this->Material4->GetDBValue(true);
        $this->InsertFields["Material5"]["Value"] = $this->Material5->GetDBValue(true);
        $this->InsertFields["Color1"]["Value"] = $this->Color1->GetDBValue(true);
        $this->InsertFields["Color2"]["Value"] = $this->Color2->GetDBValue(true);
        $this->InsertFields["Color3"]["Value"] = $this->Color3->GetDBValue(true);
        $this->InsertFields["Color4"]["Value"] = $this->Color4->GetDBValue(true);
        $this->InsertFields["Color5"]["Value"] = $this->Color5->GetDBValue(true);
        $this->InsertFields["CostPrice1"]["Value"] = $this->CostPrice1->GetDBValue(true);
        $this->InsertFields["CostPrice2"]["Value"] = $this->CostPrice2->GetDBValue(true);
        $this->InsertFields["CostPrice3"]["Value"] = $this->CostPrice3->GetDBValue(true);
        $this->InsertFields["CostPrice4"]["Value"] = $this->CostPrice4->GetDBValue(true);
        $this->InsertFields["CostPrice5"]["Value"] = $this->CostPrice5->GetDBValue(true);
        $this->InsertFields["TotalCostPrice"]["Value"] = $this->TotalCostPrice->GetDBValue(true);
        $this->InsertFields["InnerQty"]["Value"] = $this->InnerQty->GetDBValue(true);
        $this->InsertFields["Width"]["Value"] = $this->Width->GetDBValue(true);
        $this->InsertFields["Height"]["Value"] = $this->Height->GetDBValue(true);
        $this->InsertFields["Length"]["Value"] = $this->Length->GetDBValue(true);
        $this->InsertFields["Diameter"]["Value"] = $this->Diameter->GetDBValue(true);
        $this->InsertFields["Volume"]["Value"] = $this->Volume->GetDBValue(true);
        $this->InsertFields["Weight"]["Value"] = $this->Weight->GetDBValue(true);
        $this->InsertFields["Notes"]["Value"] = $this->Notes->GetDBValue(true);
        $this->InsertFields["TechDraw"]["Value"] = $this->TechDraw->GetDBValue(true);
        $this->InsertFields["Photo1"]["Value"] = $this->Photo1->GetDBValue(true);
        $this->InsertFields["Photo2"]["Value"] = $this->Photo2->GetDBValue(true);
        $this->InsertFields["Photo3"]["Value"] = $this->Photo3->GetDBValue(true);
        $this->InsertFields["Photo4"]["Value"] = $this->Photo4->GetDBValue(true);
        $this->SQL = CCBuildInsert("samplepackaging", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-364683D8
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["SampleCode"]["Value"] = $this->SampleCode->GetDBValue(true);
        $this->UpdateFields["Description"]["Value"] = $this->Description->GetDBValue(true);
        $this->UpdateFields["SampleDate"]["Value"] = $this->SampleDate->GetDBValue(true);
        $this->UpdateFields["DesMat1"]["Value"] = $this->DesMat1->GetDBValue(true);
        $this->UpdateFields["DesMat2"]["Value"] = $this->DesMat2->GetDBValue(true);
        $this->UpdateFields["DesMat3"]["Value"] = $this->DesMat3->GetDBValue(true);
        $this->UpdateFields["DesMat4"]["Value"] = $this->DesMat4->GetDBValue(true);
        $this->UpdateFields["DesMat5"]["Value"] = $this->DesMat5->GetDBValue(true);
        $this->UpdateFields["QtyDesMat1"]["Value"] = $this->QtyDesMat1->GetDBValue(true);
        $this->UpdateFields["QtyDesMat2"]["Value"] = $this->QtyDesMat2->GetDBValue(true);
        $this->UpdateFields["QtyDesMat3"]["Value"] = $this->QtyDesMat3->GetDBValue(true);
        $this->UpdateFields["QtyDesMat4"]["Value"] = $this->QtyDesMat4->GetDBValue(true);
        $this->UpdateFields["QtyDesMat5"]["Value"] = $this->QtyDesMat5->GetDBValue(true);
        $this->UpdateFields["Supplier1"]["Value"] = $this->Supplier1->GetDBValue(true);
        $this->UpdateFields["Supplier2"]["Value"] = $this->Supplier2->GetDBValue(true);
        $this->UpdateFields["Supplier3"]["Value"] = $this->Supplier3->GetDBValue(true);
        $this->UpdateFields["Supplier4"]["Value"] = $this->Supplier4->GetDBValue(true);
        $this->UpdateFields["Supplier5"]["Value"] = $this->Supplier5->GetDBValue(true);
        $this->UpdateFields["Material1"]["Value"] = $this->Material1->GetDBValue(true);
        $this->UpdateFields["Material2"]["Value"] = $this->Material2->GetDBValue(true);
        $this->UpdateFields["Material3"]["Value"] = $this->Material3->GetDBValue(true);
        $this->UpdateFields["Material4"]["Value"] = $this->Material4->GetDBValue(true);
        $this->UpdateFields["Material5"]["Value"] = $this->Material5->GetDBValue(true);
        $this->UpdateFields["Color1"]["Value"] = $this->Color1->GetDBValue(true);
        $this->UpdateFields["Color2"]["Value"] = $this->Color2->GetDBValue(true);
        $this->UpdateFields["Color3"]["Value"] = $this->Color3->GetDBValue(true);
        $this->UpdateFields["Color4"]["Value"] = $this->Color4->GetDBValue(true);
        $this->UpdateFields["Color5"]["Value"] = $this->Color5->GetDBValue(true);
        $this->UpdateFields["CostPrice1"]["Value"] = $this->CostPrice1->GetDBValue(true);
        $this->UpdateFields["CostPrice2"]["Value"] = $this->CostPrice2->GetDBValue(true);
        $this->UpdateFields["CostPrice3"]["Value"] = $this->CostPrice3->GetDBValue(true);
        $this->UpdateFields["CostPrice4"]["Value"] = $this->CostPrice4->GetDBValue(true);
        $this->UpdateFields["CostPrice5"]["Value"] = $this->CostPrice5->GetDBValue(true);
        $this->UpdateFields["TotalCostPrice"]["Value"] = $this->TotalCostPrice->GetDBValue(true);
        $this->UpdateFields["InnerQty"]["Value"] = $this->InnerQty->GetDBValue(true);
        $this->UpdateFields["Width"]["Value"] = $this->Width->GetDBValue(true);
        $this->UpdateFields["Height"]["Value"] = $this->Height->GetDBValue(true);
        $this->UpdateFields["Length"]["Value"] = $this->Length->GetDBValue(true);
        $this->UpdateFields["Diameter"]["Value"] = $this->Diameter->GetDBValue(true);
        $this->UpdateFields["Volume"]["Value"] = $this->Volume->GetDBValue(true);
        $this->UpdateFields["Weight"]["Value"] = $this->Weight->GetDBValue(true);
        $this->UpdateFields["Notes"]["Value"] = $this->Notes->GetDBValue(true);
        $this->UpdateFields["TechDraw"]["Value"] = $this->TechDraw->GetDBValue(true);
        $this->UpdateFields["Photo1"]["Value"] = $this->Photo1->GetDBValue(true);
        $this->UpdateFields["Photo2"]["Value"] = $this->Photo2->GetDBValue(true);
        $this->UpdateFields["Photo3"]["Value"] = $this->Photo3->GetDBValue(true);
        $this->UpdateFields["Photo4"]["Value"] = $this->Photo4->GetDBValue(true);
        $this->SQL = CCBuildUpdate("samplepackaging", $this->UpdateFields, $this);
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

//Delete Method @2-99B50F0B
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM samplepackaging";
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

} //End AddSamplePackagingDataSource Class @2-FCB6E20C

//Initialize Page @1-022EE352
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
$TemplateFileName = "EditSamplePackaging.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-041603A2
include_once("./EditSamplePackaging_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-BD11ABEF
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$AddSamplePackaging = new clsRecordAddSamplePackaging("", $MainPage);
$MainPage->AddSamplePackaging = & $AddSamplePackaging;
$AddSamplePackaging->Initialize();

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

//Execute Components @1-61C1EB5A
$AddSamplePackaging->Operation();
//End Execute Components

//Go to destination page @1-3F66C45D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($AddSamplePackaging);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-85AC782D
$AddSamplePackaging->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-E917D660
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($AddSamplePackaging);
unset($Tpl);
//End Unload Page


?>
