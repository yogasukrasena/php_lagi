<?php
//Include Common Files @1-C2A11B26
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowSamplePackaging.php");
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

//Class_Initialize Event @2-10E74F74
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
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->SampleCode = new clsControl(ccsLabel, "SampleCode", "Sample Code", ccsText, "", CCGetRequestParam("SampleCode", $Method, NULL), $this);
            $this->Description = new clsControl(ccsLabel, "Description", "Description", ccsText, "", CCGetRequestParam("Description", $Method, NULL), $this);
            $this->SampleDate = new clsControl(ccsLabel, "SampleDate", "Sample Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("SampleDate", $Method, NULL), $this);
            $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", $Method, NULL), $this);
            $this->Photo2 = new clsControl(ccsImage, "Photo2", "Photo2", ccsText, "", CCGetRequestParam("Photo2", $Method, NULL), $this);
            $this->Photo3 = new clsControl(ccsImage, "Photo3", "Photo3", ccsText, "", CCGetRequestParam("Photo3", $Method, NULL), $this);
            $this->Photo4 = new clsControl(ccsImage, "Photo4", "Photo4", ccsText, "", CCGetRequestParam("Photo4", $Method, NULL), $this);
            $this->QtyDesMat1 = new clsControl(ccsLabel, "QtyDesMat1", "Qty Des Mat1", ccsInteger, "", CCGetRequestParam("QtyDesMat1", $Method, NULL), $this);
            $this->QtyDesMat2 = new clsControl(ccsLabel, "QtyDesMat2", "Qty Des Mat2", ccsInteger, "", CCGetRequestParam("QtyDesMat2", $Method, NULL), $this);
            $this->QtyDesMat3 = new clsControl(ccsLabel, "QtyDesMat3", "Qty Des Mat3", ccsInteger, "", CCGetRequestParam("QtyDesMat3", $Method, NULL), $this);
            $this->QtyDesMat4 = new clsControl(ccsLabel, "QtyDesMat4", "Qty Des Mat4", ccsInteger, "", CCGetRequestParam("QtyDesMat4", $Method, NULL), $this);
            $this->QtyDesMat5 = new clsControl(ccsLabel, "QtyDesMat5", "Qty Des Mat5", ccsInteger, "", CCGetRequestParam("QtyDesMat5", $Method, NULL), $this);
            $this->TotalDesMat1 = new clsControl(ccsLabel, "TotalDesMat1", "Total Des Mat1", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotalDesMat1", $Method, NULL), $this);
            $this->TotalDesMat2 = new clsControl(ccsLabel, "TotalDesMat2", "Total Des Mat2", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotalDesMat2", $Method, NULL), $this);
            $this->TotalDesMat3 = new clsControl(ccsLabel, "TotalDesMat3", "Total Des Mat3", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotalDesMat3", $Method, NULL), $this);
            $this->TotalDesMat4 = new clsControl(ccsLabel, "TotalDesMat4", "Total Des Mat4", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotalDesMat4", $Method, NULL), $this);
            $this->TotalDesMat5 = new clsControl(ccsLabel, "TotalDesMat5", "Total Des Mat5", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotalDesMat5", $Method, NULL), $this);
            $this->Supplier1 = new clsControl(ccsHidden, "Supplier1", "Supplier1", ccsInteger, "", CCGetRequestParam("Supplier1", $Method, NULL), $this);
            $this->Supplier2 = new clsControl(ccsHidden, "Supplier2", "Supplier2", ccsInteger, "", CCGetRequestParam("Supplier2", $Method, NULL), $this);
            $this->Supplier3 = new clsControl(ccsHidden, "Supplier3", "Supplier3", ccsInteger, "", CCGetRequestParam("Supplier3", $Method, NULL), $this);
            $this->Supplier4 = new clsControl(ccsHidden, "Supplier4", "Supplier4", ccsInteger, "", CCGetRequestParam("Supplier4", $Method, NULL), $this);
            $this->Supplier5 = new clsControl(ccsHidden, "Supplier5", "Supplier5", ccsInteger, "", CCGetRequestParam("Supplier5", $Method, NULL), $this);
            $this->Material1 = new clsControl(ccsLabel, "Material1", "Material1", ccsText, "", CCGetRequestParam("Material1", $Method, NULL), $this);
            $this->Material2 = new clsControl(ccsLabel, "Material2", "Material2", ccsText, "", CCGetRequestParam("Material2", $Method, NULL), $this);
            $this->Material3 = new clsControl(ccsLabel, "Material3", "Material3", ccsText, "", CCGetRequestParam("Material3", $Method, NULL), $this);
            $this->Material4 = new clsControl(ccsLabel, "Material4", "Material4", ccsText, "", CCGetRequestParam("Material4", $Method, NULL), $this);
            $this->Material5 = new clsControl(ccsLabel, "Material5", "Material5", ccsText, "", CCGetRequestParam("Material5", $Method, NULL), $this);
            $this->Color1 = new clsControl(ccsLabel, "Color1", "Color1", ccsText, "", CCGetRequestParam("Color1", $Method, NULL), $this);
            $this->Color2 = new clsControl(ccsLabel, "Color2", "Color2", ccsText, "", CCGetRequestParam("Color2", $Method, NULL), $this);
            $this->Color3 = new clsControl(ccsLabel, "Color3", "Color3", ccsText, "", CCGetRequestParam("Color3", $Method, NULL), $this);
            $this->Color4 = new clsControl(ccsLabel, "Color4", "Color4", ccsText, "", CCGetRequestParam("Color4", $Method, NULL), $this);
            $this->Color5 = new clsControl(ccsLabel, "Color5", "Color5", ccsText, "", CCGetRequestParam("Color5", $Method, NULL), $this);
            $this->CostPrice1 = new clsControl(ccsLabel, "CostPrice1", "Cost Price1", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("CostPrice1", $Method, NULL), $this);
            $this->CostPrice2 = new clsControl(ccsLabel, "CostPrice2", "Cost Price2", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("CostPrice2", $Method, NULL), $this);
            $this->CostPrice3 = new clsControl(ccsLabel, "CostPrice3", "Cost Price3", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("CostPrice3", $Method, NULL), $this);
            $this->CostPrice4 = new clsControl(ccsLabel, "CostPrice4", "Cost Price4", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("CostPrice4", $Method, NULL), $this);
            $this->CostPrice5 = new clsControl(ccsLabel, "CostPrice5", "Cost Price5", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("CostPrice5", $Method, NULL), $this);
            $this->TotalDesMat = new clsControl(ccsLabel, "TotalDesMat", "Total Des Mat", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotalDesMat", $Method, NULL), $this);
            $this->TotalCostPrice = new clsControl(ccsLabel, "TotalCostPrice", "Total Cost Price", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotalCostPrice", $Method, NULL), $this);
            $this->TotalCost = new clsControl(ccsLabel, "TotalCost", "Total Cost", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotalCost", $Method, NULL), $this);
            $this->InnerQty = new clsControl(ccsLabel, "InnerQty", "Inner Qty", ccsInteger, "", CCGetRequestParam("InnerQty", $Method, NULL), $this);
            $this->Width = new clsControl(ccsLabel, "Width", "Width", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Width", $Method, NULL), $this);
            $this->Height = new clsControl(ccsLabel, "Height", "Height", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Height", $Method, NULL), $this);
            $this->Length = new clsControl(ccsLabel, "Length", "Length", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Length", $Method, NULL), $this);
            $this->Volume = new clsControl(ccsLabel, "Volume", "Volume", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Volume", $Method, NULL), $this);
            $this->Weight = new clsControl(ccsLabel, "Weight", "Weight", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Weight", $Method, NULL), $this);
            $this->Notes = new clsControl(ccsLabel, "Notes", "Notes", ccsMemo, "", CCGetRequestParam("Notes", $Method, NULL), $this);
            $this->TechDraw = new clsControl(ccsImage, "TechDraw", "TechDraw", ccsText, "", CCGetRequestParam("TechDraw", $Method, NULL), $this);
            $this->DesMat1 = new clsControl(ccsHidden, "DesMat1", "Des Mat1", ccsInteger, "", CCGetRequestParam("DesMat1", $Method, NULL), $this);
            $this->DesMat2 = new clsControl(ccsHidden, "DesMat2", "Des Mat2", ccsInteger, "", CCGetRequestParam("DesMat2", $Method, NULL), $this);
            $this->DesMat3 = new clsControl(ccsHidden, "DesMat3", "Des Mat3", ccsInteger, "", CCGetRequestParam("DesMat3", $Method, NULL), $this);
            $this->DesMat4 = new clsControl(ccsHidden, "DesMat4", "Des Mat4", ccsInteger, "", CCGetRequestParam("DesMat4", $Method, NULL), $this);
            $this->DesMat5 = new clsControl(ccsHidden, "DesMat5", "Des Mat5", ccsInteger, "", CCGetRequestParam("DesMat5", $Method, NULL), $this);
            $this->DesMatDesc1 = new clsControl(ccsLabel, "DesMatDesc1", "DesMatDesc1", ccsText, "", CCGetRequestParam("DesMatDesc1", $Method, NULL), $this);
            $this->DesMatDesc2 = new clsControl(ccsLabel, "DesMatDesc2", "DesMatDesc2", ccsText, "", CCGetRequestParam("DesMatDesc2", $Method, NULL), $this);
            $this->DesMatDesc3 = new clsControl(ccsLabel, "DesMatDesc3", "DesMatDesc3", ccsText, "", CCGetRequestParam("DesMatDesc3", $Method, NULL), $this);
            $this->DesMatDesc4 = new clsControl(ccsLabel, "DesMatDesc4", "DesMatDesc4", ccsText, "", CCGetRequestParam("DesMatDesc4", $Method, NULL), $this);
            $this->DesMatDesc5 = new clsControl(ccsLabel, "DesMatDesc5", "DesMatDesc5", ccsText, "", CCGetRequestParam("DesMatDesc5", $Method, NULL), $this);
            $this->DesignMatSup1 = new clsControl(ccsLabel, "DesignMatSup1", "DesignMatSup1", ccsText, "", CCGetRequestParam("DesignMatSup1", $Method, NULL), $this);
            $this->DesignMatSup2 = new clsControl(ccsLabel, "DesignMatSup2", "DesignMatSup2", ccsText, "", CCGetRequestParam("DesignMatSup2", $Method, NULL), $this);
            $this->DesignMatSup3 = new clsControl(ccsLabel, "DesignMatSup3", "DesignMatSup3", ccsText, "", CCGetRequestParam("DesignMatSup3", $Method, NULL), $this);
            $this->DesignMatSup4 = new clsControl(ccsLabel, "DesignMatSup4", "DesignMatSup4", ccsText, "", CCGetRequestParam("DesignMatSup4", $Method, NULL), $this);
            $this->DesignMatSup5 = new clsControl(ccsLabel, "DesignMatSup5", "DesignMatSup5", ccsText, "", CCGetRequestParam("DesignMatSup5", $Method, NULL), $this);
            $this->DesignMatUnit1 = new clsControl(ccsLabel, "DesignMatUnit1", "DesignMatUnit1", ccsText, "", CCGetRequestParam("DesignMatUnit1", $Method, NULL), $this);
            $this->DesignMatUnit2 = new clsControl(ccsLabel, "DesignMatUnit2", "DesignMatUnit2", ccsText, "", CCGetRequestParam("DesignMatUnit2", $Method, NULL), $this);
            $this->DesignMatUnit3 = new clsControl(ccsLabel, "DesignMatUnit3", "DesignMatUnit3", ccsText, "", CCGetRequestParam("DesignMatUnit3", $Method, NULL), $this);
            $this->DesignMatUnit4 = new clsControl(ccsLabel, "DesignMatUnit4", "DesignMatUnit4", ccsText, "", CCGetRequestParam("DesignMatUnit4", $Method, NULL), $this);
            $this->DesignMatUnit5 = new clsControl(ccsLabel, "DesignMatUnit5", "DesignMatUnit5", ccsText, "", CCGetRequestParam("DesignMatUnit5", $Method, NULL), $this);
            $this->DesignMatUnitPrice1 = new clsControl(ccsLabel, "DesignMatUnitPrice1", "DesignMatUnitPrice1", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("DesignMatUnitPrice1", $Method, NULL), $this);
            $this->DesignMatUnitPrice2 = new clsControl(ccsLabel, "DesignMatUnitPrice2", "DesignMatUnitPrice2", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("DesignMatUnitPrice2", $Method, NULL), $this);
            $this->DesignMatUnitPrice3 = new clsControl(ccsLabel, "DesignMatUnitPrice3", "DesignMatUnitPrice3", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("DesignMatUnitPrice3", $Method, NULL), $this);
            $this->DesignMatUnitPrice4 = new clsControl(ccsLabel, "DesignMatUnitPrice4", "DesignMatUnitPrice4", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("DesignMatUnitPrice4", $Method, NULL), $this);
            $this->DesignMatUnitPrice5 = new clsControl(ccsLabel, "DesignMatUnitPrice5", "DesignMatUnitPrice5", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("DesignMatUnitPrice5", $Method, NULL), $this);
            $this->SupDesc1 = new clsControl(ccsLabel, "SupDesc1", "SupDesc1", ccsText, "", CCGetRequestParam("SupDesc1", $Method, NULL), $this);
            $this->SupDesc2 = new clsControl(ccsLabel, "SupDesc2", "SupDesc2", ccsText, "", CCGetRequestParam("SupDesc2", $Method, NULL), $this);
            $this->SupDesc3 = new clsControl(ccsLabel, "SupDesc3", "SupDesc3", ccsText, "", CCGetRequestParam("SupDesc3", $Method, NULL), $this);
            $this->SupDesc4 = new clsControl(ccsLabel, "SupDesc4", "SupDesc4", ccsText, "", CCGetRequestParam("SupDesc4", $Method, NULL), $this);
            $this->SupDesc5 = new clsControl(ccsLabel, "SupDesc5", "SupDesc5", ccsText, "", CCGetRequestParam("SupDesc5", $Method, NULL), $this);
            $this->lblKG = new clsControl(ccsLabel, "lblKG", "lblKG", ccsText, "", CCGetRequestParam("lblKG", $Method, NULL), $this);
            $this->Diameter = new clsControl(ccsLabel, "Diameter", "Diameter", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Diameter", $Method, NULL), $this);
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

//Validate Method @2-357E5AE2
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->Supplier1->Validate() && $Validation);
        $Validation = ($this->Supplier2->Validate() && $Validation);
        $Validation = ($this->Supplier3->Validate() && $Validation);
        $Validation = ($this->Supplier4->Validate() && $Validation);
        $Validation = ($this->Supplier5->Validate() && $Validation);
        $Validation = ($this->DesMat1->Validate() && $Validation);
        $Validation = ($this->DesMat2->Validate() && $Validation);
        $Validation = ($this->DesMat3->Validate() && $Validation);
        $Validation = ($this->DesMat4->Validate() && $Validation);
        $Validation = ($this->DesMat5->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->Supplier1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Supplier2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Supplier3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Supplier4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Supplier5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMat1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMat2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMat3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMat4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesMat5->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-C80380D0
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->SampleCode->Errors->Count());
        $errors = ($errors || $this->Description->Errors->Count());
        $errors = ($errors || $this->SampleDate->Errors->Count());
        $errors = ($errors || $this->Photo1->Errors->Count());
        $errors = ($errors || $this->Photo2->Errors->Count());
        $errors = ($errors || $this->Photo3->Errors->Count());
        $errors = ($errors || $this->Photo4->Errors->Count());
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
        $errors = ($errors || $this->Volume->Errors->Count());
        $errors = ($errors || $this->Weight->Errors->Count());
        $errors = ($errors || $this->Notes->Errors->Count());
        $errors = ($errors || $this->TechDraw->Errors->Count());
        $errors = ($errors || $this->DesMat1->Errors->Count());
        $errors = ($errors || $this->DesMat2->Errors->Count());
        $errors = ($errors || $this->DesMat3->Errors->Count());
        $errors = ($errors || $this->DesMat4->Errors->Count());
        $errors = ($errors || $this->DesMat5->Errors->Count());
        $errors = ($errors || $this->DesMatDesc1->Errors->Count());
        $errors = ($errors || $this->DesMatDesc2->Errors->Count());
        $errors = ($errors || $this->DesMatDesc3->Errors->Count());
        $errors = ($errors || $this->DesMatDesc4->Errors->Count());
        $errors = ($errors || $this->DesMatDesc5->Errors->Count());
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
        $errors = ($errors || $this->SupDesc1->Errors->Count());
        $errors = ($errors || $this->SupDesc2->Errors->Count());
        $errors = ($errors || $this->SupDesc3->Errors->Count());
        $errors = ($errors || $this->SupDesc4->Errors->Count());
        $errors = ($errors || $this->SupDesc5->Errors->Count());
        $errors = ($errors || $this->lblKG->Errors->Count());
        $errors = ($errors || $this->Diameter->Errors->Count());
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

//Operation Method @2-17DC9883
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

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @2-8E613F32
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
                $this->SampleCode->SetValue($this->DataSource->SampleCode->GetValue());
                $this->Description->SetValue($this->DataSource->Description->GetValue());
                $this->SampleDate->SetValue($this->DataSource->SampleDate->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->Photo2->SetValue($this->DataSource->Photo2->GetValue());
                $this->Photo3->SetValue($this->DataSource->Photo3->GetValue());
                $this->Photo4->SetValue($this->DataSource->Photo4->GetValue());
                $this->QtyDesMat1->SetValue($this->DataSource->QtyDesMat1->GetValue());
                $this->QtyDesMat2->SetValue($this->DataSource->QtyDesMat2->GetValue());
                $this->QtyDesMat3->SetValue($this->DataSource->QtyDesMat3->GetValue());
                $this->QtyDesMat4->SetValue($this->DataSource->QtyDesMat4->GetValue());
                $this->QtyDesMat5->SetValue($this->DataSource->QtyDesMat5->GetValue());
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
                $this->Volume->SetValue($this->DataSource->Volume->GetValue());
                $this->Weight->SetValue($this->DataSource->Weight->GetValue());
                $this->Notes->SetValue($this->DataSource->Notes->GetValue());
                $this->TechDraw->SetValue($this->DataSource->TechDraw->GetValue());
                $this->Diameter->SetValue($this->DataSource->Diameter->GetValue());
                if(!$this->FormSubmitted){
                    $this->Supplier1->SetValue($this->DataSource->Supplier1->GetValue());
                    $this->Supplier2->SetValue($this->DataSource->Supplier2->GetValue());
                    $this->Supplier3->SetValue($this->DataSource->Supplier3->GetValue());
                    $this->Supplier4->SetValue($this->DataSource->Supplier4->GetValue());
                    $this->Supplier5->SetValue($this->DataSource->Supplier5->GetValue());
                    $this->DesMat1->SetValue($this->DataSource->DesMat1->GetValue());
                    $this->DesMat2->SetValue($this->DataSource->DesMat2->GetValue());
                    $this->DesMat3->SetValue($this->DataSource->DesMat3->GetValue());
                    $this->DesMat4->SetValue($this->DataSource->DesMat4->GetValue());
                    $this->DesMat5->SetValue($this->DataSource->DesMat5->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->SampleCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SampleDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo4->Errors->ToString());
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
            $Error = ComposeStrings($Error, $this->Volume->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Weight->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Notes->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMat1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMat2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMat3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMat4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMat5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMatDesc1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMatDesc2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMatDesc3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMatDesc4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesMatDesc5->Errors->ToString());
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
            $Error = ComposeStrings($Error, $this->SupDesc1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupDesc2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupDesc3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupDesc4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupDesc5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblKG->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Diameter->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->SampleCode->Show();
        $this->Description->Show();
        $this->SampleDate->Show();
        $this->Photo1->Show();
        $this->Photo2->Show();
        $this->Photo3->Show();
        $this->Photo4->Show();
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
        $this->Volume->Show();
        $this->Weight->Show();
        $this->Notes->Show();
        $this->TechDraw->Show();
        $this->DesMat1->Show();
        $this->DesMat2->Show();
        $this->DesMat3->Show();
        $this->DesMat4->Show();
        $this->DesMat5->Show();
        $this->DesMatDesc1->Show();
        $this->DesMatDesc2->Show();
        $this->DesMatDesc3->Show();
        $this->DesMatDesc4->Show();
        $this->DesMatDesc5->Show();
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
        $this->SupDesc1->Show();
        $this->SupDesc2->Show();
        $this->SupDesc3->Show();
        $this->SupDesc4->Show();
        $this->SupDesc5->Show();
        $this->lblKG->Show();
        $this->Diameter->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddSamplePackaging Class @2-FCB6E20C

class clsAddSamplePackagingDataSource extends clsDBGayaFusionAll {  //AddSamplePackagingDataSource Class @2-12C36211

//DataSource Variables @2-383EE169
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $SampleCode;
    public $Description;
    public $SampleDate;
    public $Photo1;
    public $Photo2;
    public $Photo3;
    public $Photo4;
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
    public $Volume;
    public $Weight;
    public $Notes;
    public $TechDraw;
    public $DesMat1;
    public $DesMat2;
    public $DesMat3;
    public $DesMat4;
    public $DesMat5;
    public $DesMatDesc1;
    public $DesMatDesc2;
    public $DesMatDesc3;
    public $DesMatDesc4;
    public $DesMatDesc5;
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
    public $SupDesc1;
    public $SupDesc2;
    public $SupDesc3;
    public $SupDesc4;
    public $SupDesc5;
    public $lblKG;
    public $Diameter;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-4632885A
    function clsAddSamplePackagingDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddSamplePackaging/Error";
        $this->Initialize();
        $this->SampleCode = new clsField("SampleCode", ccsText, "");
        
        $this->Description = new clsField("Description", ccsText, "");
        
        $this->SampleDate = new clsField("SampleDate", ccsDate, $this->DateFormat);
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->Photo2 = new clsField("Photo2", ccsText, "");
        
        $this->Photo3 = new clsField("Photo3", ccsText, "");
        
        $this->Photo4 = new clsField("Photo4", ccsText, "");
        
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
        
        $this->Volume = new clsField("Volume", ccsFloat, "");
        
        $this->Weight = new clsField("Weight", ccsFloat, "");
        
        $this->Notes = new clsField("Notes", ccsMemo, "");
        
        $this->TechDraw = new clsField("TechDraw", ccsText, "");
        
        $this->DesMat1 = new clsField("DesMat1", ccsInteger, "");
        
        $this->DesMat2 = new clsField("DesMat2", ccsInteger, "");
        
        $this->DesMat3 = new clsField("DesMat3", ccsInteger, "");
        
        $this->DesMat4 = new clsField("DesMat4", ccsInteger, "");
        
        $this->DesMat5 = new clsField("DesMat5", ccsInteger, "");
        
        $this->DesMatDesc1 = new clsField("DesMatDesc1", ccsText, "");
        
        $this->DesMatDesc2 = new clsField("DesMatDesc2", ccsText, "");
        
        $this->DesMatDesc3 = new clsField("DesMatDesc3", ccsText, "");
        
        $this->DesMatDesc4 = new clsField("DesMatDesc4", ccsText, "");
        
        $this->DesMatDesc5 = new clsField("DesMatDesc5", ccsText, "");
        
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
        
        $this->DesignMatUnitPrice1 = new clsField("DesignMatUnitPrice1", ccsFloat, "");
        
        $this->DesignMatUnitPrice2 = new clsField("DesignMatUnitPrice2", ccsFloat, "");
        
        $this->DesignMatUnitPrice3 = new clsField("DesignMatUnitPrice3", ccsFloat, "");
        
        $this->DesignMatUnitPrice4 = new clsField("DesignMatUnitPrice4", ccsFloat, "");
        
        $this->DesignMatUnitPrice5 = new clsField("DesignMatUnitPrice5", ccsFloat, "");
        
        $this->SupDesc1 = new clsField("SupDesc1", ccsText, "");
        
        $this->SupDesc2 = new clsField("SupDesc2", ccsText, "");
        
        $this->SupDesc3 = new clsField("SupDesc3", ccsText, "");
        
        $this->SupDesc4 = new clsField("SupDesc4", ccsText, "");
        
        $this->SupDesc5 = new clsField("SupDesc5", ccsText, "");
        
        $this->lblKG = new clsField("lblKG", ccsText, "");
        
        $this->Diameter = new clsField("Diameter", ccsFloat, "");
        

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

//SetValues Method @2-20C6DEC6
    function SetValues()
    {
        $this->SampleCode->SetDBValue($this->f("SampleCode"));
        $this->Description->SetDBValue($this->f("Description"));
        $this->SampleDate->SetDBValue(trim($this->f("SampleDate")));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->Photo2->SetDBValue($this->f("Photo2"));
        $this->Photo3->SetDBValue($this->f("Photo3"));
        $this->Photo4->SetDBValue($this->f("Photo4"));
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
        $this->Volume->SetDBValue(trim($this->f("Volume")));
        $this->Weight->SetDBValue(trim($this->f("Weight")));
        $this->Notes->SetDBValue($this->f("Notes"));
        $this->TechDraw->SetDBValue($this->f("TechDraw"));
        $this->DesMat1->SetDBValue(trim($this->f("DesMat1")));
        $this->DesMat2->SetDBValue(trim($this->f("DesMat2")));
        $this->DesMat3->SetDBValue(trim($this->f("DesMat3")));
        $this->DesMat4->SetDBValue(trim($this->f("DesMat4")));
        $this->DesMat5->SetDBValue(trim($this->f("DesMat5")));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
    }
//End SetValues Method

} //End AddSamplePackagingDataSource Class @2-FCB6E20C

//Initialize Page @1-C78C2D5D
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
$TemplateFileName = "ShowSamplePackaging.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-9B9D1BBA
include_once("./ShowSamplePackaging_events.php");
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

//Show Page @1-A6D2536A
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
