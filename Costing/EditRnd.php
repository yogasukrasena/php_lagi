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

//Include Common Files @1-35A6DA02
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "EditRnd.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

class clsRecordCosting { //Costing Class @2-94E47BDD

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

//Class_Initialize Event @2-8328A308
    function clsRecordCosting($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Costing/Error";
        $this->DataSource = new clsCostingDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Costing";
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
            $this->SampleCode = new clsControl(ccsLabel, "SampleCode", "Sample Code", ccsText, "", CCGetRequestParam("SampleCode", $Method, NULL), $this);
            $this->SampleDescription = new clsControl(ccsLabel, "SampleDescription", "Sample Description", ccsText, "", CCGetRequestParam("SampleDescription", $Method, NULL), $this);
            $this->ClientCode = new clsControl(ccsLabel, "ClientCode", "Client Code", ccsText, "", CCGetRequestParam("ClientCode", $Method, NULL), $this);
            $this->ClientDescription = new clsControl(ccsLabel, "ClientDescription", "Client Description", ccsText, "", CCGetRequestParam("ClientDescription", $Method, NULL), $this);
            $this->ClayKG = new clsControl(ccsTextBox, "ClayKG", "Clay KG", ccsFloat, "", CCGetRequestParam("ClayKG", $Method, NULL), $this);
            $this->ClayType = new clsControl(ccsListBox, "ClayType", "Clay Type", ccsInteger, "", CCGetRequestParam("ClayType", $Method, NULL), $this);
            $this->ClayType->DSType = dsTable;
            $this->ClayType->DataSource = new clsDBGayaFusionAll();
            $this->ClayType->ds = & $this->ClayType->DataSource;
            $this->ClayType->DataSource->SQL = "SELECT * \n" .
"FROM tblcosting_clay {SQL_Where} {SQL_OrderBy}";
            list($this->ClayType->BoundColumn, $this->ClayType->TextColumn, $this->ClayType->DBFormat) = array("ID", "ClayType", "");
            $this->ClayCost = new clsControl(ccsLabel, "ClayCost", "Clay Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("ClayCost", $Method, NULL), $this);
            $this->ClayPreparationMinute = new clsControl(ccsTextBox, "ClayPreparationMinute", "Clay Preparation Minute", ccsInteger, "", CCGetRequestParam("ClayPreparationMinute", $Method, NULL), $this);
            $this->ClayPreparationCost = new clsControl(ccsLabel, "ClayPreparationCost", "Clay Preparation Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("ClayPreparationCost", $Method, NULL), $this);
            $this->WheelMinute = new clsControl(ccsTextBox, "WheelMinute", "Wheel Minute", ccsInteger, "", CCGetRequestParam("WheelMinute", $Method, NULL), $this);
            $this->WheelCost = new clsControl(ccsLabel, "WheelCost", "Wheel Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("WheelCost", $Method, NULL), $this);
            $this->SlabMinute = new clsControl(ccsTextBox, "SlabMinute", "Slab Minute", ccsInteger, "", CCGetRequestParam("SlabMinute", $Method, NULL), $this);
            $this->SlabCost = new clsControl(ccsLabel, "SlabCost", "Slab Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("SlabCost", $Method, NULL), $this);
            $this->CastingMinute = new clsControl(ccsTextBox, "CastingMinute", "Casting Minute", ccsInteger, "", CCGetRequestParam("CastingMinute", $Method, NULL), $this);
            $this->CastingCost = new clsControl(ccsLabel, "CastingCost", "Casting Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("CastingCost", $Method, NULL), $this);
            $this->FinishingMinute = new clsControl(ccsTextBox, "FinishingMinute", "Finishing Minute", ccsInteger, "", CCGetRequestParam("FinishingMinute", $Method, NULL), $this);
            $this->FinishingCost = new clsControl(ccsLabel, "FinishingCost", "Finishing Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("FinishingCost", $Method, NULL), $this);
            $this->GlazingMinute = new clsControl(ccsTextBox, "GlazingMinute", "Glazing Minute", ccsInteger, "", CCGetRequestParam("GlazingMinute", $Method, NULL), $this);
            $this->GlazingCost = new clsControl(ccsLabel, "GlazingCost", "Glazing Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("GlazingCost", $Method, NULL), $this);
            $this->StandardBisqueLoading = new clsControl(ccsTextBox, "StandardBisqueLoading", "Standard Bisque Loading", ccsInteger, "", CCGetRequestParam("StandardBisqueLoading", $Method, NULL), $this);
            $this->StandardBisqueCost = new clsControl(ccsLabel, "StandardBisqueCost", "Standard Bisque Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("StandardBisqueCost", $Method, NULL), $this);
            $this->StandardGlazeLoading = new clsControl(ccsTextBox, "StandardGlazeLoading", "Standard Glaze Loading", ccsInteger, "", CCGetRequestParam("StandardGlazeLoading", $Method, NULL), $this);
            $this->StandardGlazeCost = new clsControl(ccsLabel, "StandardGlazeCost", "Standard Glaze Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("StandardGlazeCost", $Method, NULL), $this);
            $this->RakuBisqueLoading = new clsControl(ccsTextBox, "RakuBisqueLoading", "Raku Bisque Loading", ccsInteger, "", CCGetRequestParam("RakuBisqueLoading", $Method, NULL), $this);
            $this->RakuBisqueCost = new clsControl(ccsLabel, "RakuBisqueCost", "Raku Bisque Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("RakuBisqueCost", $Method, NULL), $this);
            $this->RakuGlazeLoading = new clsControl(ccsTextBox, "RakuGlazeLoading", "Raku Glaze Loading", ccsInteger, "", CCGetRequestParam("RakuGlazeLoading", $Method, NULL), $this);
            $this->RakuGlazeCost = new clsControl(ccsLabel, "RakuGlazeCost", "Raku Glaze Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("RakuGlazeCost", $Method, NULL), $this);
            $this->MovementMinute = new clsControl(ccsTextBox, "MovementMinute", "Movement Minute", ccsInteger, "", CCGetRequestParam("MovementMinute", $Method, NULL), $this);
            $this->MovementCost = new clsControl(ccsLabel, "MovementCost", "Movement Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("MovementCost", $Method, NULL), $this);
            $this->PackagingWorkMinute = new clsControl(ccsTextBox, "PackagingWorkMinute", "Packaging Work Minute", ccsInteger, "", CCGetRequestParam("PackagingWorkMinute", $Method, NULL), $this);
            $this->PackagingWorkCost = new clsControl(ccsLabel, "PackagingWorkCost", "Packaging Work Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("PackagingWorkCost", $Method, NULL), $this);
            $this->ClayPreparationPPH = new clsControl(ccsTextBox, "ClayPreparationPPH", "Clay Preparation PPH", ccsInteger, "", CCGetRequestParam("ClayPreparationPPH", $Method, NULL), $this);
            $this->WheelPPH = new clsControl(ccsTextBox, "WheelPPH", "Wheel PPH", ccsInteger, "", CCGetRequestParam("WheelPPH", $Method, NULL), $this);
            $this->SlabPPH = new clsControl(ccsTextBox, "SlabPPH", "Slab PPH", ccsInteger, "", CCGetRequestParam("SlabPPH", $Method, NULL), $this);
            $this->CastingPPH = new clsControl(ccsTextBox, "CastingPPH", "Casting PPH", ccsInteger, "", CCGetRequestParam("CastingPPH", $Method, NULL), $this);
            $this->FinishingPPH = new clsControl(ccsTextBox, "FinishingPPH", "Finishing PPH", ccsInteger, "", CCGetRequestParam("FinishingPPH", $Method, NULL), $this);
            $this->GlazingPPH = new clsControl(ccsTextBox, "GlazingPPH", "Glazing PPH", ccsInteger, "", CCGetRequestParam("GlazingPPH", $Method, NULL), $this);
            $this->MovementPPH = new clsControl(ccsTextBox, "MovementPPH", "Movement PPH", ccsInteger, "", CCGetRequestParam("MovementPPH", $Method, NULL), $this);
            $this->PackagingWorkPPH = new clsControl(ccsTextBox, "PackagingWorkPPH", "Packaging Work PPH", ccsInteger, "", CCGetRequestParam("PackagingWorkPPH", $Method, NULL), $this);
            $this->TotalAllCost = new clsControl(ccsLabel, "TotalAllCost", "Total All Cost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotalAllCost", $Method, NULL), $this);
            $this->RiskPrice = new clsControl(ccsLabel, "RiskPrice", "Risk Price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("RiskPrice", $Method, NULL), $this);
            $this->HypoSellingPrice = new clsControl(ccsLabel, "HypoSellingPrice", "Hypo Selling Price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("HypoSellingPrice", $Method, NULL), $this);
            $this->RealSellingPrice = new clsControl(ccsTextBox, "RealSellingPrice", "Real Selling Price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("RealSellingPrice", $Method, NULL), $this);
            $this->Btn_Cancel = new clsButton("Btn_Cancel", $Method, $this);
            $this->ClayPrice = new clsControl(ccsTextBox, "ClayPrice", "ClayPrice", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("ClayPrice", $Method, NULL), $this);
            $this->ClayPreparationCPM = new clsControl(ccsTextBox, "ClayPreparationCPM", "ClayPreparationCPM", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("ClayPreparationCPM", $Method, NULL), $this);
            $this->WheelCPM = new clsControl(ccsTextBox, "WheelCPM", "WheelCPM", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("WheelCPM", $Method, NULL), $this);
            $this->SlabCPM = new clsControl(ccsTextBox, "SlabCPM", "SlabCPM", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("SlabCPM", $Method, NULL), $this);
            $this->CastingCPM = new clsControl(ccsTextBox, "CastingCPM", "CastingCPM", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("CastingCPM", $Method, NULL), $this);
            $this->FinishingCPM = new clsControl(ccsTextBox, "FinishingCPM", "FinishingCPM", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("FinishingCPM", $Method, NULL), $this);
            $this->GlazingCPM = new clsControl(ccsTextBox, "GlazingCPM", "GlazingCPM", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("GlazingCPM", $Method, NULL), $this);
            $this->MovementCPM = new clsControl(ccsTextBox, "MovementCPM", "MovementCPM", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("MovementCPM", $Method, NULL), $this);
            $this->PackagingCPM = new clsControl(ccsTextBox, "PackagingCPM", "PackagingCPM", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("PackagingCPM", $Method, NULL), $this);
            $this->DesignMat1 = new clsControl(ccsHidden, "DesignMat1", "DesignMat1", ccsInteger, "", CCGetRequestParam("DesignMat1", $Method, NULL), $this);
            $this->DesignMat2 = new clsControl(ccsHidden, "DesignMat2", "DesignMat2", ccsInteger, "", CCGetRequestParam("DesignMat2", $Method, NULL), $this);
            $this->DesignMat3 = new clsControl(ccsHidden, "DesignMat3", "DesignMat3", ccsInteger, "", CCGetRequestParam("DesignMat3", $Method, NULL), $this);
            $this->DesignMat4 = new clsControl(ccsHidden, "DesignMat4", "DesignMat4", ccsInteger, "", CCGetRequestParam("DesignMat4", $Method, NULL), $this);
            $this->DesignMatQty1 = new clsControl(ccsTextBox, "DesignMatQty1", "DesignMatQty1", ccsInteger, "", CCGetRequestParam("DesignMatQty1", $Method, NULL), $this);
            $this->DesignMatQty2 = new clsControl(ccsTextBox, "DesignMatQty2", "DesignMatQty2", ccsInteger, "", CCGetRequestParam("DesignMatQty2", $Method, NULL), $this);
            $this->DesignMatQty3 = new clsControl(ccsTextBox, "DesignMatQty3", "DesignMatQty3", ccsInteger, "", CCGetRequestParam("DesignMatQty3", $Method, NULL), $this);
            $this->DesignMatQty4 = new clsControl(ccsTextBox, "DesignMatQty4", "DesignMatQty4", ccsInteger, "", CCGetRequestParam("DesignMatQty4", $Method, NULL), $this);
            $this->lblUnit1 = new clsControl(ccsLabel, "lblUnit1", "lblUnit1", ccsText, "", CCGetRequestParam("lblUnit1", $Method, NULL), $this);
            $this->lblUnit2 = new clsControl(ccsLabel, "lblUnit2", "lblUnit2", ccsText, "", CCGetRequestParam("lblUnit2", $Method, NULL), $this);
            $this->lblUnit3 = new clsControl(ccsLabel, "lblUnit3", "lblUnit3", ccsText, "", CCGetRequestParam("lblUnit3", $Method, NULL), $this);
            $this->lblUnit4 = new clsControl(ccsLabel, "lblUnit4", "lblUnit4", ccsText, "", CCGetRequestParam("lblUnit4", $Method, NULL), $this);
            $this->lblStdBisque = new clsControl(ccsLabel, "lblStdBisque", "lblStdBisque", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("lblStdBisque", $Method, NULL), $this);
            $this->lblStdGlaze = new clsControl(ccsLabel, "lblStdGlaze", "lblStdGlaze", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("lblStdGlaze", $Method, NULL), $this);
            $this->lblRakuBisque = new clsControl(ccsLabel, "lblRakuBisque", "lblRakuBisque", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("lblRakuBisque", $Method, NULL), $this);
            $this->lblRakuGlaze = new clsControl(ccsLabel, "lblRakuGlaze", "lblRakuGlaze", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("lblRakuGlaze", $Method, NULL), $this);
            $this->StdBisquePerFiring = new clsControl(ccsTextBox, "StdBisquePerFiring", "StdBisquePerFiring", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("StdBisquePerFiring", $Method, NULL), $this);
            $this->StdGlazePerFiring = new clsControl(ccsTextBox, "StdGlazePerFiring", "StdGlazePerFiring", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("StdGlazePerFiring", $Method, NULL), $this);
            $this->RakuBisquePerFiring = new clsControl(ccsTextBox, "RakuBisquePerFiring", "RakuBisquePerFiring", ccsFloat, "", CCGetRequestParam("RakuBisquePerFiring", $Method, NULL), $this);
            $this->RakuGlazePerFiring = new clsControl(ccsTextBox, "RakuGlazePerFiring", "RakuGlazePerFiring", ccsFloat, "", CCGetRequestParam("RakuGlazePerFiring", $Method, NULL), $this);
            $this->DesignMatUnitPrice1 = new clsControl(ccsTextBox, "DesignMatUnitPrice1", "DesignMatUnitPrice1", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("DesignMatUnitPrice1", $Method, NULL), $this);
            $this->DesignMatUnitPrice2 = new clsControl(ccsTextBox, "DesignMatUnitPrice2", "DesignMatUnitPrice2", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("DesignMatUnitPrice2", $Method, NULL), $this);
            $this->DesignMatUnitPrice3 = new clsControl(ccsTextBox, "DesignMatUnitPrice3", "DesignMatUnitPrice3", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("DesignMatUnitPrice3", $Method, NULL), $this);
            $this->DesignMatUnitPrice4 = new clsControl(ccsTextBox, "DesignMatUnitPrice4", "DesignMatUnitPrice4", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("DesignMatUnitPrice4", $Method, NULL), $this);
            $this->TotDesignMat1 = new clsControl(ccsLabel, "TotDesignMat1", "TotDesignMat1", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotDesignMat1", $Method, NULL), $this);
            $this->TotDesignMat2 = new clsControl(ccsLabel, "TotDesignMat2", "TotDesignMat2", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotDesignMat2", $Method, NULL), $this);
            $this->TotDesignMat3 = new clsControl(ccsLabel, "TotDesignMat3", "TotDesignMat3", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotDesignMat3", $Method, NULL), $this);
            $this->TotDesignMat4 = new clsControl(ccsLabel, "TotDesignMat4", "TotDesignMat4", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotDesignMat4", $Method, NULL), $this);
            $this->TotAllPieces = new clsControl(ccsLabel, "TotAllPieces", "TotAllPieces", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotAllPieces", $Method, NULL), $this);
            $this->lblYear = new clsControl(ccsLabel, "lblYear", "lblYear", ccsText, "", CCGetRequestParam("lblYear", $Method, NULL), $this);
            $this->Day = new clsControl(ccsLabel, "Day", "Day", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Day", $Method, NULL), $this);
            $this->Month = new clsControl(ccsLabel, "Month", "Month", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Month", $Method, NULL), $this);
            $this->Year = new clsControl(ccsLabel, "Year", "Year", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Year", $Method, NULL), $this);
            $this->Worker = new clsControl(ccsLabel, "Worker", "Worker", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Worker", $Method, NULL), $this);
            $this->WheelPPH1 = new clsControl(ccsLabel, "WheelPPH1", "Wheel PPH", ccsInteger, "", CCGetRequestParam("WheelPPH1", $Method, NULL), $this);
            $this->TotPiecesDay = new clsControl(ccsLabel, "TotPiecesDay", "TotPiecesDay", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotPiecesDay", $Method, NULL), $this);
            $this->TotPiecesMonth = new clsControl(ccsLabel, "TotPiecesMonth", "TotPiecesMonth", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotPiecesMonth", $Method, NULL), $this);
            $this->TotPiecesYear = new clsControl(ccsLabel, "TotPiecesYear", "TotPiecesYear", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotPiecesYear", $Method, NULL), $this);
            $this->TotPiecesWorker = new clsControl(ccsLabel, "TotPiecesWorker", "TotPiecesWorker", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotPiecesWorker", $Method, NULL), $this);
            $this->CostBudget = new clsControl(ccsLabel, "CostBudget", "CostBudget", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("CostBudget", $Method, NULL), $this);
            $this->BEP = new clsControl(ccsLabel, "BEP", "BEP", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("BEP", $Method, NULL), $this);
            $this->lblDesignMat1 = new clsControl(ccsLabel, "lblDesignMat1", "lblDesignMat1", ccsText, "", CCGetRequestParam("lblDesignMat1", $Method, NULL), $this);
            $this->lblDesignMat2 = new clsControl(ccsLabel, "lblDesignMat2", "lblDesignMat2", ccsText, "", CCGetRequestParam("lblDesignMat2", $Method, NULL), $this);
            $this->lblDesignMat3 = new clsControl(ccsLabel, "lblDesignMat3", "lblDesignMat3", ccsText, "", CCGetRequestParam("lblDesignMat3", $Method, NULL), $this);
            $this->lblDesignMat4 = new clsControl(ccsLabel, "lblDesignMat4", "lblDesignMat4", ccsText, "", CCGetRequestParam("lblDesignMat4", $Method, NULL), $this);
            $this->lblYear1 = new clsControl(ccsLabel, "lblYear1", "lblYear1", ccsText, "", CCGetRequestParam("lblYear1", $Method, NULL), $this);
            $this->StdBisqueColor = new clsControl(ccsLabel, "StdBisqueColor", "StdBisqueColor", ccsText, "", CCGetRequestParam("StdBisqueColor", $Method, NULL), $this);
            $this->StdGlazeColor = new clsControl(ccsLabel, "StdGlazeColor", "StdGlazeColor", ccsText, "", CCGetRequestParam("StdGlazeColor", $Method, NULL), $this);
            $this->RakuBisqueColor = new clsControl(ccsLabel, "RakuBisqueColor", "RakuBisqueColor", ccsText, "", CCGetRequestParam("RakuBisqueColor", $Method, NULL), $this);
            $this->RakuGlazeColor = new clsControl(ccsLabel, "RakuGlazeColor", "RakuGlazeColor", ccsText, "", CCGetRequestParam("RakuGlazeColor", $Method, NULL), $this);
            $this->DollarPrice = new clsControl(ccsTextBox, "DollarPrice", "DollarPrice", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("DollarPrice", $Method, NULL), $this);
            $this->EuroPrice = new clsControl(ccsTextBox, "EuroPrice", "EuroPrice", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("EuroPrice", $Method, NULL), $this);
            $this->LastUpdate = new clsControl(ccsHidden, "LastUpdate", "LastUpdate", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("LastUpdate", $Method, NULL), $this);
            $this->sID = new clsControl(ccsHidden, "sID", "sID", ccsInteger, "", CCGetRequestParam("sID", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->LastUpdate->Value) && !strlen($this->LastUpdate->Value) && $this->LastUpdate->Value !== false)
                    $this->LastUpdate->SetValue(time());
            }
            if(!is_array($this->ClayCost->Value) && !strlen($this->ClayCost->Value) && $this->ClayCost->Value !== false)
                $this->ClayCost->SetText(0);
            if(!is_array($this->StandardBisqueCost->Value) && !strlen($this->StandardBisqueCost->Value) && $this->StandardBisqueCost->Value !== false)
                $this->StandardBisqueCost->SetText(0);
            if(!is_array($this->StandardGlazeCost->Value) && !strlen($this->StandardGlazeCost->Value) && $this->StandardGlazeCost->Value !== false)
                $this->StandardGlazeCost->SetText(0);
            if(!is_array($this->RakuBisqueCost->Value) && !strlen($this->RakuBisqueCost->Value) && $this->RakuBisqueCost->Value !== false)
                $this->RakuBisqueCost->SetText(0);
            if(!is_array($this->RakuGlazeCost->Value) && !strlen($this->RakuGlazeCost->Value) && $this->RakuGlazeCost->Value !== false)
                $this->RakuGlazeCost->SetText(0);
            if(!is_array($this->TotalAllCost->Value) && !strlen($this->TotalAllCost->Value) && $this->TotalAllCost->Value !== false)
                $this->TotalAllCost->SetText(0);
            if(!is_array($this->HypoSellingPrice->Value) && !strlen($this->HypoSellingPrice->Value) && $this->HypoSellingPrice->Value !== false)
                $this->HypoSellingPrice->SetText(0);
            if(!is_array($this->TotAllPieces->Value) && !strlen($this->TotAllPieces->Value) && $this->TotAllPieces->Value !== false)
                $this->TotAllPieces->SetText(0);
            if(!is_array($this->TotPiecesDay->Value) && !strlen($this->TotPiecesDay->Value) && $this->TotPiecesDay->Value !== false)
                $this->TotPiecesDay->SetText(0);
            if(!is_array($this->TotPiecesMonth->Value) && !strlen($this->TotPiecesMonth->Value) && $this->TotPiecesMonth->Value !== false)
                $this->TotPiecesMonth->SetText(0);
            if(!is_array($this->TotPiecesYear->Value) && !strlen($this->TotPiecesYear->Value) && $this->TotPiecesYear->Value !== false)
                $this->TotPiecesYear->SetText(0);
            if(!is_array($this->TotPiecesWorker->Value) && !strlen($this->TotPiecesWorker->Value) && $this->TotPiecesWorker->Value !== false)
                $this->TotPiecesWorker->SetText(0);
            if(!is_array($this->CostBudget->Value) && !strlen($this->CostBudget->Value) && $this->CostBudget->Value !== false)
                $this->CostBudget->SetText(0);
            if(!is_array($this->BEP->Value) && !strlen($this->BEP->Value) && $this->BEP->Value !== false)
                $this->BEP->SetText(0);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-8CCBE5AE
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlsID"] = CCGetFromGet("sID", NULL);
    }
//End Initialize Method

//Validate Method @2-C3ABA0BE
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ClayKG->Validate() && $Validation);
        $Validation = ($this->ClayType->Validate() && $Validation);
        $Validation = ($this->ClayPreparationMinute->Validate() && $Validation);
        $Validation = ($this->WheelMinute->Validate() && $Validation);
        $Validation = ($this->SlabMinute->Validate() && $Validation);
        $Validation = ($this->CastingMinute->Validate() && $Validation);
        $Validation = ($this->FinishingMinute->Validate() && $Validation);
        $Validation = ($this->GlazingMinute->Validate() && $Validation);
        $Validation = ($this->StandardBisqueLoading->Validate() && $Validation);
        $Validation = ($this->StandardGlazeLoading->Validate() && $Validation);
        $Validation = ($this->RakuBisqueLoading->Validate() && $Validation);
        $Validation = ($this->RakuGlazeLoading->Validate() && $Validation);
        $Validation = ($this->MovementMinute->Validate() && $Validation);
        $Validation = ($this->PackagingWorkMinute->Validate() && $Validation);
        $Validation = ($this->ClayPreparationPPH->Validate() && $Validation);
        $Validation = ($this->WheelPPH->Validate() && $Validation);
        $Validation = ($this->SlabPPH->Validate() && $Validation);
        $Validation = ($this->CastingPPH->Validate() && $Validation);
        $Validation = ($this->FinishingPPH->Validate() && $Validation);
        $Validation = ($this->GlazingPPH->Validate() && $Validation);
        $Validation = ($this->MovementPPH->Validate() && $Validation);
        $Validation = ($this->PackagingWorkPPH->Validate() && $Validation);
        $Validation = ($this->RealSellingPrice->Validate() && $Validation);
        $Validation = ($this->ClayPrice->Validate() && $Validation);
        $Validation = ($this->ClayPreparationCPM->Validate() && $Validation);
        $Validation = ($this->WheelCPM->Validate() && $Validation);
        $Validation = ($this->SlabCPM->Validate() && $Validation);
        $Validation = ($this->CastingCPM->Validate() && $Validation);
        $Validation = ($this->FinishingCPM->Validate() && $Validation);
        $Validation = ($this->GlazingCPM->Validate() && $Validation);
        $Validation = ($this->MovementCPM->Validate() && $Validation);
        $Validation = ($this->PackagingCPM->Validate() && $Validation);
        $Validation = ($this->DesignMat1->Validate() && $Validation);
        $Validation = ($this->DesignMat2->Validate() && $Validation);
        $Validation = ($this->DesignMat3->Validate() && $Validation);
        $Validation = ($this->DesignMat4->Validate() && $Validation);
        $Validation = ($this->DesignMatQty1->Validate() && $Validation);
        $Validation = ($this->DesignMatQty2->Validate() && $Validation);
        $Validation = ($this->DesignMatQty3->Validate() && $Validation);
        $Validation = ($this->DesignMatQty4->Validate() && $Validation);
        $Validation = ($this->StdBisquePerFiring->Validate() && $Validation);
        $Validation = ($this->StdGlazePerFiring->Validate() && $Validation);
        $Validation = ($this->RakuBisquePerFiring->Validate() && $Validation);
        $Validation = ($this->RakuGlazePerFiring->Validate() && $Validation);
        $Validation = ($this->DesignMatUnitPrice1->Validate() && $Validation);
        $Validation = ($this->DesignMatUnitPrice2->Validate() && $Validation);
        $Validation = ($this->DesignMatUnitPrice3->Validate() && $Validation);
        $Validation = ($this->DesignMatUnitPrice4->Validate() && $Validation);
        $Validation = ($this->DollarPrice->Validate() && $Validation);
        $Validation = ($this->EuroPrice->Validate() && $Validation);
        $Validation = ($this->LastUpdate->Validate() && $Validation);
        $Validation = ($this->sID->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ClayKG->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClayType->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClayPreparationMinute->Errors->Count() == 0);
        $Validation =  $Validation && ($this->WheelMinute->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SlabMinute->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CastingMinute->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FinishingMinute->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GlazingMinute->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StandardBisqueLoading->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StandardGlazeLoading->Errors->Count() == 0);
        $Validation =  $Validation && ($this->RakuBisqueLoading->Errors->Count() == 0);
        $Validation =  $Validation && ($this->RakuGlazeLoading->Errors->Count() == 0);
        $Validation =  $Validation && ($this->MovementMinute->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PackagingWorkMinute->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClayPreparationPPH->Errors->Count() == 0);
        $Validation =  $Validation && ($this->WheelPPH->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SlabPPH->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CastingPPH->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FinishingPPH->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GlazingPPH->Errors->Count() == 0);
        $Validation =  $Validation && ($this->MovementPPH->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PackagingWorkPPH->Errors->Count() == 0);
        $Validation =  $Validation && ($this->RealSellingPrice->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClayPrice->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClayPreparationCPM->Errors->Count() == 0);
        $Validation =  $Validation && ($this->WheelCPM->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SlabCPM->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CastingCPM->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FinishingCPM->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GlazingCPM->Errors->Count() == 0);
        $Validation =  $Validation && ($this->MovementCPM->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PackagingCPM->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatQty1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatQty2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatQty3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatQty4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StdBisquePerFiring->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StdGlazePerFiring->Errors->Count() == 0);
        $Validation =  $Validation && ($this->RakuBisquePerFiring->Errors->Count() == 0);
        $Validation =  $Validation && ($this->RakuGlazePerFiring->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnitPrice1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnitPrice2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnitPrice3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatUnitPrice4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DollarPrice->Errors->Count() == 0);
        $Validation =  $Validation && ($this->EuroPrice->Errors->Count() == 0);
        $Validation =  $Validation && ($this->LastUpdate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sID->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-B9887601
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->SampleCode->Errors->Count());
        $errors = ($errors || $this->SampleDescription->Errors->Count());
        $errors = ($errors || $this->ClientCode->Errors->Count());
        $errors = ($errors || $this->ClientDescription->Errors->Count());
        $errors = ($errors || $this->ClayKG->Errors->Count());
        $errors = ($errors || $this->ClayType->Errors->Count());
        $errors = ($errors || $this->ClayCost->Errors->Count());
        $errors = ($errors || $this->ClayPreparationMinute->Errors->Count());
        $errors = ($errors || $this->ClayPreparationCost->Errors->Count());
        $errors = ($errors || $this->WheelMinute->Errors->Count());
        $errors = ($errors || $this->WheelCost->Errors->Count());
        $errors = ($errors || $this->SlabMinute->Errors->Count());
        $errors = ($errors || $this->SlabCost->Errors->Count());
        $errors = ($errors || $this->CastingMinute->Errors->Count());
        $errors = ($errors || $this->CastingCost->Errors->Count());
        $errors = ($errors || $this->FinishingMinute->Errors->Count());
        $errors = ($errors || $this->FinishingCost->Errors->Count());
        $errors = ($errors || $this->GlazingMinute->Errors->Count());
        $errors = ($errors || $this->GlazingCost->Errors->Count());
        $errors = ($errors || $this->StandardBisqueLoading->Errors->Count());
        $errors = ($errors || $this->StandardBisqueCost->Errors->Count());
        $errors = ($errors || $this->StandardGlazeLoading->Errors->Count());
        $errors = ($errors || $this->StandardGlazeCost->Errors->Count());
        $errors = ($errors || $this->RakuBisqueLoading->Errors->Count());
        $errors = ($errors || $this->RakuBisqueCost->Errors->Count());
        $errors = ($errors || $this->RakuGlazeLoading->Errors->Count());
        $errors = ($errors || $this->RakuGlazeCost->Errors->Count());
        $errors = ($errors || $this->MovementMinute->Errors->Count());
        $errors = ($errors || $this->MovementCost->Errors->Count());
        $errors = ($errors || $this->PackagingWorkMinute->Errors->Count());
        $errors = ($errors || $this->PackagingWorkCost->Errors->Count());
        $errors = ($errors || $this->ClayPreparationPPH->Errors->Count());
        $errors = ($errors || $this->WheelPPH->Errors->Count());
        $errors = ($errors || $this->SlabPPH->Errors->Count());
        $errors = ($errors || $this->CastingPPH->Errors->Count());
        $errors = ($errors || $this->FinishingPPH->Errors->Count());
        $errors = ($errors || $this->GlazingPPH->Errors->Count());
        $errors = ($errors || $this->MovementPPH->Errors->Count());
        $errors = ($errors || $this->PackagingWorkPPH->Errors->Count());
        $errors = ($errors || $this->TotalAllCost->Errors->Count());
        $errors = ($errors || $this->RiskPrice->Errors->Count());
        $errors = ($errors || $this->HypoSellingPrice->Errors->Count());
        $errors = ($errors || $this->RealSellingPrice->Errors->Count());
        $errors = ($errors || $this->ClayPrice->Errors->Count());
        $errors = ($errors || $this->ClayPreparationCPM->Errors->Count());
        $errors = ($errors || $this->WheelCPM->Errors->Count());
        $errors = ($errors || $this->SlabCPM->Errors->Count());
        $errors = ($errors || $this->CastingCPM->Errors->Count());
        $errors = ($errors || $this->FinishingCPM->Errors->Count());
        $errors = ($errors || $this->GlazingCPM->Errors->Count());
        $errors = ($errors || $this->MovementCPM->Errors->Count());
        $errors = ($errors || $this->PackagingCPM->Errors->Count());
        $errors = ($errors || $this->DesignMat1->Errors->Count());
        $errors = ($errors || $this->DesignMat2->Errors->Count());
        $errors = ($errors || $this->DesignMat3->Errors->Count());
        $errors = ($errors || $this->DesignMat4->Errors->Count());
        $errors = ($errors || $this->DesignMatQty1->Errors->Count());
        $errors = ($errors || $this->DesignMatQty2->Errors->Count());
        $errors = ($errors || $this->DesignMatQty3->Errors->Count());
        $errors = ($errors || $this->DesignMatQty4->Errors->Count());
        $errors = ($errors || $this->lblUnit1->Errors->Count());
        $errors = ($errors || $this->lblUnit2->Errors->Count());
        $errors = ($errors || $this->lblUnit3->Errors->Count());
        $errors = ($errors || $this->lblUnit4->Errors->Count());
        $errors = ($errors || $this->lblStdBisque->Errors->Count());
        $errors = ($errors || $this->lblStdGlaze->Errors->Count());
        $errors = ($errors || $this->lblRakuBisque->Errors->Count());
        $errors = ($errors || $this->lblRakuGlaze->Errors->Count());
        $errors = ($errors || $this->StdBisquePerFiring->Errors->Count());
        $errors = ($errors || $this->StdGlazePerFiring->Errors->Count());
        $errors = ($errors || $this->RakuBisquePerFiring->Errors->Count());
        $errors = ($errors || $this->RakuGlazePerFiring->Errors->Count());
        $errors = ($errors || $this->DesignMatUnitPrice1->Errors->Count());
        $errors = ($errors || $this->DesignMatUnitPrice2->Errors->Count());
        $errors = ($errors || $this->DesignMatUnitPrice3->Errors->Count());
        $errors = ($errors || $this->DesignMatUnitPrice4->Errors->Count());
        $errors = ($errors || $this->TotDesignMat1->Errors->Count());
        $errors = ($errors || $this->TotDesignMat2->Errors->Count());
        $errors = ($errors || $this->TotDesignMat3->Errors->Count());
        $errors = ($errors || $this->TotDesignMat4->Errors->Count());
        $errors = ($errors || $this->TotAllPieces->Errors->Count());
        $errors = ($errors || $this->lblYear->Errors->Count());
        $errors = ($errors || $this->Day->Errors->Count());
        $errors = ($errors || $this->Month->Errors->Count());
        $errors = ($errors || $this->Year->Errors->Count());
        $errors = ($errors || $this->Worker->Errors->Count());
        $errors = ($errors || $this->WheelPPH1->Errors->Count());
        $errors = ($errors || $this->TotPiecesDay->Errors->Count());
        $errors = ($errors || $this->TotPiecesMonth->Errors->Count());
        $errors = ($errors || $this->TotPiecesYear->Errors->Count());
        $errors = ($errors || $this->TotPiecesWorker->Errors->Count());
        $errors = ($errors || $this->CostBudget->Errors->Count());
        $errors = ($errors || $this->BEP->Errors->Count());
        $errors = ($errors || $this->lblDesignMat1->Errors->Count());
        $errors = ($errors || $this->lblDesignMat2->Errors->Count());
        $errors = ($errors || $this->lblDesignMat3->Errors->Count());
        $errors = ($errors || $this->lblDesignMat4->Errors->Count());
        $errors = ($errors || $this->lblYear1->Errors->Count());
        $errors = ($errors || $this->StdBisqueColor->Errors->Count());
        $errors = ($errors || $this->StdGlazeColor->Errors->Count());
        $errors = ($errors || $this->RakuBisqueColor->Errors->Count());
        $errors = ($errors || $this->RakuGlazeColor->Errors->Count());
        $errors = ($errors || $this->DollarPrice->Errors->Count());
        $errors = ($errors || $this->EuroPrice->Errors->Count());
        $errors = ($errors || $this->LastUpdate->Errors->Count());
        $errors = ($errors || $this->sID->Errors->Count());
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

//Operation Method @2-DA86CCB2
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Btn_Cancel";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Btn_Cancel->Pressed) {
                $this->PressedButton = "Btn_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Btn_Cancel") {
                $Redirect = "SampleCeramic.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
                if(!CCGetEvent($this->Btn_Cancel->CCSEvents, "OnClick", $this->Btn_Cancel)) {
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

//UpdateRow Method @2-6AA95087
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ClayKG->SetValue($this->ClayKG->GetValue(true));
        $this->DataSource->ClayType->SetValue($this->ClayType->GetValue(true));
        $this->DataSource->ClayPreparationMinute->SetValue($this->ClayPreparationMinute->GetValue(true));
        $this->DataSource->WheelMinute->SetValue($this->WheelMinute->GetValue(true));
        $this->DataSource->SlabMinute->SetValue($this->SlabMinute->GetValue(true));
        $this->DataSource->CastingMinute->SetValue($this->CastingMinute->GetValue(true));
        $this->DataSource->FinishingMinute->SetValue($this->FinishingMinute->GetValue(true));
        $this->DataSource->GlazingMinute->SetValue($this->GlazingMinute->GetValue(true));
        $this->DataSource->StandardBisqueLoading->SetValue($this->StandardBisqueLoading->GetValue(true));
        $this->DataSource->StandardGlazeLoading->SetValue($this->StandardGlazeLoading->GetValue(true));
        $this->DataSource->RakuBisqueLoading->SetValue($this->RakuBisqueLoading->GetValue(true));
        $this->DataSource->RakuGlazeLoading->SetValue($this->RakuGlazeLoading->GetValue(true));
        $this->DataSource->MovementMinute->SetValue($this->MovementMinute->GetValue(true));
        $this->DataSource->PackagingWorkMinute->SetValue($this->PackagingWorkMinute->GetValue(true));
        $this->DataSource->ClayPreparationPPH->SetValue($this->ClayPreparationPPH->GetValue(true));
        $this->DataSource->WheelPPH->SetValue($this->WheelPPH->GetValue(true));
        $this->DataSource->SlabPPH->SetValue($this->SlabPPH->GetValue(true));
        $this->DataSource->CastingPPH->SetValue($this->CastingPPH->GetValue(true));
        $this->DataSource->FinishingPPH->SetValue($this->FinishingPPH->GetValue(true));
        $this->DataSource->GlazingPPH->SetValue($this->GlazingPPH->GetValue(true));
        $this->DataSource->MovementPPH->SetValue($this->MovementPPH->GetValue(true));
        $this->DataSource->PackagingWorkPPH->SetValue($this->PackagingWorkPPH->GetValue(true));
        $this->DataSource->RealSellingPrice->SetValue($this->RealSellingPrice->GetValue(true));
        $this->DataSource->DesignMat1->SetValue($this->DesignMat1->GetValue(true));
        $this->DataSource->DesignMat2->SetValue($this->DesignMat2->GetValue(true));
        $this->DataSource->DesignMat3->SetValue($this->DesignMat3->GetValue(true));
        $this->DataSource->DesignMat4->SetValue($this->DesignMat4->GetValue(true));
        $this->DataSource->DesignMatQty1->SetValue($this->DesignMatQty1->GetValue(true));
        $this->DataSource->DesignMatQty2->SetValue($this->DesignMatQty2->GetValue(true));
        $this->DataSource->DesignMatQty3->SetValue($this->DesignMatQty3->GetValue(true));
        $this->DataSource->DesignMatQty4->SetValue($this->DesignMatQty4->GetValue(true));
        $this->DataSource->DollarPrice->SetValue($this->DollarPrice->GetValue(true));
        $this->DataSource->EuroPrice->SetValue($this->EuroPrice->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-08ADED46
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

        $this->ClayType->Prepare();

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
                $this->SampleDescription->SetValue($this->DataSource->SampleDescription->GetValue());
                $this->ClientCode->SetValue($this->DataSource->ClientCode->GetValue());
                $this->ClientDescription->SetValue($this->DataSource->ClientDescription->GetValue());
                if(!$this->FormSubmitted){
                    $this->ClayKG->SetValue($this->DataSource->ClayKG->GetValue());
                    $this->ClayType->SetValue($this->DataSource->ClayType->GetValue());
                    $this->ClayPreparationMinute->SetValue($this->DataSource->ClayPreparationMinute->GetValue());
                    $this->WheelMinute->SetValue($this->DataSource->WheelMinute->GetValue());
                    $this->SlabMinute->SetValue($this->DataSource->SlabMinute->GetValue());
                    $this->CastingMinute->SetValue($this->DataSource->CastingMinute->GetValue());
                    $this->FinishingMinute->SetValue($this->DataSource->FinishingMinute->GetValue());
                    $this->GlazingMinute->SetValue($this->DataSource->GlazingMinute->GetValue());
                    $this->StandardBisqueLoading->SetValue($this->DataSource->StandardBisqueLoading->GetValue());
                    $this->StandardGlazeLoading->SetValue($this->DataSource->StandardGlazeLoading->GetValue());
                    $this->RakuBisqueLoading->SetValue($this->DataSource->RakuBisqueLoading->GetValue());
                    $this->RakuGlazeLoading->SetValue($this->DataSource->RakuGlazeLoading->GetValue());
                    $this->MovementMinute->SetValue($this->DataSource->MovementMinute->GetValue());
                    $this->PackagingWorkMinute->SetValue($this->DataSource->PackagingWorkMinute->GetValue());
                    $this->ClayPreparationPPH->SetValue($this->DataSource->ClayPreparationPPH->GetValue());
                    $this->WheelPPH->SetValue($this->DataSource->WheelPPH->GetValue());
                    $this->SlabPPH->SetValue($this->DataSource->SlabPPH->GetValue());
                    $this->CastingPPH->SetValue($this->DataSource->CastingPPH->GetValue());
                    $this->FinishingPPH->SetValue($this->DataSource->FinishingPPH->GetValue());
                    $this->GlazingPPH->SetValue($this->DataSource->GlazingPPH->GetValue());
                    $this->MovementPPH->SetValue($this->DataSource->MovementPPH->GetValue());
                    $this->PackagingWorkPPH->SetValue($this->DataSource->PackagingWorkPPH->GetValue());
                    $this->RealSellingPrice->SetValue($this->DataSource->RealSellingPrice->GetValue());
                    $this->DesignMat1->SetValue($this->DataSource->DesignMat1->GetValue());
                    $this->DesignMat2->SetValue($this->DataSource->DesignMat2->GetValue());
                    $this->DesignMat3->SetValue($this->DataSource->DesignMat3->GetValue());
                    $this->DesignMat4->SetValue($this->DataSource->DesignMat4->GetValue());
                    $this->DesignMatQty1->SetValue($this->DataSource->DesignMatQty1->GetValue());
                    $this->DesignMatQty2->SetValue($this->DataSource->DesignMatQty2->GetValue());
                    $this->DesignMatQty3->SetValue($this->DataSource->DesignMatQty3->GetValue());
                    $this->DesignMatQty4->SetValue($this->DataSource->DesignMatQty4->GetValue());
                    $this->DollarPrice->SetValue($this->DataSource->DollarPrice->GetValue());
                    $this->EuroPrice->SetValue($this->DataSource->EuroPrice->GetValue());
                    $this->sID->SetValue($this->DataSource->sID->GetValue());
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
            $Error = ComposeStrings($Error, $this->SampleDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayKG->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayType->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayPreparationMinute->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayPreparationCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->WheelMinute->Errors->ToString());
            $Error = ComposeStrings($Error, $this->WheelCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SlabMinute->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SlabCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CastingMinute->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CastingCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FinishingMinute->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FinishingCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazingMinute->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazingCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StandardBisqueLoading->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StandardBisqueCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StandardGlazeLoading->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StandardGlazeCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RakuBisqueLoading->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RakuBisqueCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RakuGlazeLoading->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RakuGlazeCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->MovementMinute->Errors->ToString());
            $Error = ComposeStrings($Error, $this->MovementCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PackagingWorkMinute->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PackagingWorkCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayPreparationPPH->Errors->ToString());
            $Error = ComposeStrings($Error, $this->WheelPPH->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SlabPPH->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CastingPPH->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FinishingPPH->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazingPPH->Errors->ToString());
            $Error = ComposeStrings($Error, $this->MovementPPH->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PackagingWorkPPH->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotalAllCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RiskPrice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->HypoSellingPrice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RealSellingPrice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayPrice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayPreparationCPM->Errors->ToString());
            $Error = ComposeStrings($Error, $this->WheelCPM->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SlabCPM->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CastingCPM->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FinishingCPM->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazingCPM->Errors->ToString());
            $Error = ComposeStrings($Error, $this->MovementCPM->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PackagingCPM->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMat1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMat2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMat3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMat4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatQty1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatQty2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatQty3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatQty4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblUnit1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblUnit2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblUnit3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblUnit4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblStdBisque->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblStdGlaze->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblRakuBisque->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblRakuGlaze->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StdBisquePerFiring->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StdGlazePerFiring->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RakuBisquePerFiring->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RakuGlazePerFiring->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnitPrice1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnitPrice2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnitPrice3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatUnitPrice4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotDesignMat1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotDesignMat2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotDesignMat3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotDesignMat4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotAllPieces->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblYear->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Day->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Month->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Year->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Worker->Errors->ToString());
            $Error = ComposeStrings($Error, $this->WheelPPH1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotPiecesDay->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotPiecesMonth->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotPiecesYear->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TotPiecesWorker->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CostBudget->Errors->ToString());
            $Error = ComposeStrings($Error, $this->BEP->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblDesignMat1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblDesignMat2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblDesignMat3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblDesignMat4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblYear1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StdBisqueColor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StdGlazeColor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RakuBisqueColor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RakuGlazeColor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DollarPrice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EuroPrice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LastUpdate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sID->Errors->ToString());
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
        $this->SampleCode->Show();
        $this->SampleDescription->Show();
        $this->ClientCode->Show();
        $this->ClientDescription->Show();
        $this->ClayKG->Show();
        $this->ClayType->Show();
        $this->ClayCost->Show();
        $this->ClayPreparationMinute->Show();
        $this->ClayPreparationCost->Show();
        $this->WheelMinute->Show();
        $this->WheelCost->Show();
        $this->SlabMinute->Show();
        $this->SlabCost->Show();
        $this->CastingMinute->Show();
        $this->CastingCost->Show();
        $this->FinishingMinute->Show();
        $this->FinishingCost->Show();
        $this->GlazingMinute->Show();
        $this->GlazingCost->Show();
        $this->StandardBisqueLoading->Show();
        $this->StandardBisqueCost->Show();
        $this->StandardGlazeLoading->Show();
        $this->StandardGlazeCost->Show();
        $this->RakuBisqueLoading->Show();
        $this->RakuBisqueCost->Show();
        $this->RakuGlazeLoading->Show();
        $this->RakuGlazeCost->Show();
        $this->MovementMinute->Show();
        $this->MovementCost->Show();
        $this->PackagingWorkMinute->Show();
        $this->PackagingWorkCost->Show();
        $this->ClayPreparationPPH->Show();
        $this->WheelPPH->Show();
        $this->SlabPPH->Show();
        $this->CastingPPH->Show();
        $this->FinishingPPH->Show();
        $this->GlazingPPH->Show();
        $this->MovementPPH->Show();
        $this->PackagingWorkPPH->Show();
        $this->TotalAllCost->Show();
        $this->RiskPrice->Show();
        $this->HypoSellingPrice->Show();
        $this->RealSellingPrice->Show();
        $this->Btn_Cancel->Show();
        $this->ClayPrice->Show();
        $this->ClayPreparationCPM->Show();
        $this->WheelCPM->Show();
        $this->SlabCPM->Show();
        $this->CastingCPM->Show();
        $this->FinishingCPM->Show();
        $this->GlazingCPM->Show();
        $this->MovementCPM->Show();
        $this->PackagingCPM->Show();
        $this->DesignMat1->Show();
        $this->DesignMat2->Show();
        $this->DesignMat3->Show();
        $this->DesignMat4->Show();
        $this->DesignMatQty1->Show();
        $this->DesignMatQty2->Show();
        $this->DesignMatQty3->Show();
        $this->DesignMatQty4->Show();
        $this->lblUnit1->Show();
        $this->lblUnit2->Show();
        $this->lblUnit3->Show();
        $this->lblUnit4->Show();
        $this->lblStdBisque->Show();
        $this->lblStdGlaze->Show();
        $this->lblRakuBisque->Show();
        $this->lblRakuGlaze->Show();
        $this->StdBisquePerFiring->Show();
        $this->StdGlazePerFiring->Show();
        $this->RakuBisquePerFiring->Show();
        $this->RakuGlazePerFiring->Show();
        $this->DesignMatUnitPrice1->Show();
        $this->DesignMatUnitPrice2->Show();
        $this->DesignMatUnitPrice3->Show();
        $this->DesignMatUnitPrice4->Show();
        $this->TotDesignMat1->Show();
        $this->TotDesignMat2->Show();
        $this->TotDesignMat3->Show();
        $this->TotDesignMat4->Show();
        $this->TotAllPieces->Show();
        $this->lblYear->Show();
        $this->Day->Show();
        $this->Month->Show();
        $this->Year->Show();
        $this->Worker->Show();
        $this->WheelPPH1->Show();
        $this->TotPiecesDay->Show();
        $this->TotPiecesMonth->Show();
        $this->TotPiecesYear->Show();
        $this->TotPiecesWorker->Show();
        $this->CostBudget->Show();
        $this->BEP->Show();
        $this->lblDesignMat1->Show();
        $this->lblDesignMat2->Show();
        $this->lblDesignMat3->Show();
        $this->lblDesignMat4->Show();
        $this->lblYear1->Show();
        $this->StdBisqueColor->Show();
        $this->StdGlazeColor->Show();
        $this->RakuBisqueColor->Show();
        $this->RakuGlazeColor->Show();
        $this->DollarPrice->Show();
        $this->EuroPrice->Show();
        $this->LastUpdate->Show();
        $this->sID->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End Costing Class @2-FCB6E20C

class clsCostingDataSource extends clsDBGayaFusionAll {  //CostingDataSource Class @2-C1B73552

//DataSource Variables @2-6A6B5BF5
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $UpdateFields = array();

    // Datasource fields
    public $SampleCode;
    public $SampleDescription;
    public $ClientCode;
    public $ClientDescription;
    public $ClayKG;
    public $ClayType;
    public $ClayCost;
    public $ClayPreparationMinute;
    public $ClayPreparationCost;
    public $WheelMinute;
    public $WheelCost;
    public $SlabMinute;
    public $SlabCost;
    public $CastingMinute;
    public $CastingCost;
    public $FinishingMinute;
    public $FinishingCost;
    public $GlazingMinute;
    public $GlazingCost;
    public $StandardBisqueLoading;
    public $StandardBisqueCost;
    public $StandardGlazeLoading;
    public $StandardGlazeCost;
    public $RakuBisqueLoading;
    public $RakuBisqueCost;
    public $RakuGlazeLoading;
    public $RakuGlazeCost;
    public $MovementMinute;
    public $MovementCost;
    public $PackagingWorkMinute;
    public $PackagingWorkCost;
    public $ClayPreparationPPH;
    public $WheelPPH;
    public $SlabPPH;
    public $CastingPPH;
    public $FinishingPPH;
    public $GlazingPPH;
    public $MovementPPH;
    public $PackagingWorkPPH;
    public $TotalAllCost;
    public $RiskPrice;
    public $HypoSellingPrice;
    public $RealSellingPrice;
    public $ClayPrice;
    public $ClayPreparationCPM;
    public $WheelCPM;
    public $SlabCPM;
    public $CastingCPM;
    public $FinishingCPM;
    public $GlazingCPM;
    public $MovementCPM;
    public $PackagingCPM;
    public $DesignMat1;
    public $DesignMat2;
    public $DesignMat3;
    public $DesignMat4;
    public $DesignMatQty1;
    public $DesignMatQty2;
    public $DesignMatQty3;
    public $DesignMatQty4;
    public $lblUnit1;
    public $lblUnit2;
    public $lblUnit3;
    public $lblUnit4;
    public $lblStdBisque;
    public $lblStdGlaze;
    public $lblRakuBisque;
    public $lblRakuGlaze;
    public $StdBisquePerFiring;
    public $StdGlazePerFiring;
    public $RakuBisquePerFiring;
    public $RakuGlazePerFiring;
    public $DesignMatUnitPrice1;
    public $DesignMatUnitPrice2;
    public $DesignMatUnitPrice3;
    public $DesignMatUnitPrice4;
    public $TotDesignMat1;
    public $TotDesignMat2;
    public $TotDesignMat3;
    public $TotDesignMat4;
    public $TotAllPieces;
    public $lblYear;
    public $Day;
    public $Month;
    public $Year;
    public $Worker;
    public $WheelPPH1;
    public $TotPiecesDay;
    public $TotPiecesMonth;
    public $TotPiecesYear;
    public $TotPiecesWorker;
    public $CostBudget;
    public $BEP;
    public $lblDesignMat1;
    public $lblDesignMat2;
    public $lblDesignMat3;
    public $lblDesignMat4;
    public $lblYear1;
    public $StdBisqueColor;
    public $StdGlazeColor;
    public $RakuBisqueColor;
    public $RakuGlazeColor;
    public $DollarPrice;
    public $EuroPrice;
    public $LastUpdate;
    public $sID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-4B791D8F
    function clsCostingDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record Costing/Error";
        $this->Initialize();
        $this->SampleCode = new clsField("SampleCode", ccsText, "");
        
        $this->SampleDescription = new clsField("SampleDescription", ccsText, "");
        
        $this->ClientCode = new clsField("ClientCode", ccsText, "");
        
        $this->ClientDescription = new clsField("ClientDescription", ccsText, "");
        
        $this->ClayKG = new clsField("ClayKG", ccsFloat, "");
        
        $this->ClayType = new clsField("ClayType", ccsInteger, "");
        
        $this->ClayCost = new clsField("ClayCost", ccsFloat, "");
        
        $this->ClayPreparationMinute = new clsField("ClayPreparationMinute", ccsInteger, "");
        
        $this->ClayPreparationCost = new clsField("ClayPreparationCost", ccsFloat, "");
        
        $this->WheelMinute = new clsField("WheelMinute", ccsInteger, "");
        
        $this->WheelCost = new clsField("WheelCost", ccsFloat, "");
        
        $this->SlabMinute = new clsField("SlabMinute", ccsInteger, "");
        
        $this->SlabCost = new clsField("SlabCost", ccsFloat, "");
        
        $this->CastingMinute = new clsField("CastingMinute", ccsInteger, "");
        
        $this->CastingCost = new clsField("CastingCost", ccsFloat, "");
        
        $this->FinishingMinute = new clsField("FinishingMinute", ccsInteger, "");
        
        $this->FinishingCost = new clsField("FinishingCost", ccsFloat, "");
        
        $this->GlazingMinute = new clsField("GlazingMinute", ccsInteger, "");
        
        $this->GlazingCost = new clsField("GlazingCost", ccsFloat, "");
        
        $this->StandardBisqueLoading = new clsField("StandardBisqueLoading", ccsInteger, "");
        
        $this->StandardBisqueCost = new clsField("StandardBisqueCost", ccsFloat, "");
        
        $this->StandardGlazeLoading = new clsField("StandardGlazeLoading", ccsInteger, "");
        
        $this->StandardGlazeCost = new clsField("StandardGlazeCost", ccsFloat, "");
        
        $this->RakuBisqueLoading = new clsField("RakuBisqueLoading", ccsInteger, "");
        
        $this->RakuBisqueCost = new clsField("RakuBisqueCost", ccsFloat, "");
        
        $this->RakuGlazeLoading = new clsField("RakuGlazeLoading", ccsInteger, "");
        
        $this->RakuGlazeCost = new clsField("RakuGlazeCost", ccsFloat, "");
        
        $this->MovementMinute = new clsField("MovementMinute", ccsInteger, "");
        
        $this->MovementCost = new clsField("MovementCost", ccsFloat, "");
        
        $this->PackagingWorkMinute = new clsField("PackagingWorkMinute", ccsInteger, "");
        
        $this->PackagingWorkCost = new clsField("PackagingWorkCost", ccsFloat, "");
        
        $this->ClayPreparationPPH = new clsField("ClayPreparationPPH", ccsInteger, "");
        
        $this->WheelPPH = new clsField("WheelPPH", ccsInteger, "");
        
        $this->SlabPPH = new clsField("SlabPPH", ccsInteger, "");
        
        $this->CastingPPH = new clsField("CastingPPH", ccsInteger, "");
        
        $this->FinishingPPH = new clsField("FinishingPPH", ccsInteger, "");
        
        $this->GlazingPPH = new clsField("GlazingPPH", ccsInteger, "");
        
        $this->MovementPPH = new clsField("MovementPPH", ccsInteger, "");
        
        $this->PackagingWorkPPH = new clsField("PackagingWorkPPH", ccsInteger, "");
        
        $this->TotalAllCost = new clsField("TotalAllCost", ccsFloat, "");
        
        $this->RiskPrice = new clsField("RiskPrice", ccsFloat, "");
        
        $this->HypoSellingPrice = new clsField("HypoSellingPrice", ccsFloat, "");
        
        $this->RealSellingPrice = new clsField("RealSellingPrice", ccsFloat, "");
        
        $this->ClayPrice = new clsField("ClayPrice", ccsFloat, "");
        
        $this->ClayPreparationCPM = new clsField("ClayPreparationCPM", ccsFloat, "");
        
        $this->WheelCPM = new clsField("WheelCPM", ccsFloat, "");
        
        $this->SlabCPM = new clsField("SlabCPM", ccsFloat, "");
        
        $this->CastingCPM = new clsField("CastingCPM", ccsFloat, "");
        
        $this->FinishingCPM = new clsField("FinishingCPM", ccsFloat, "");
        
        $this->GlazingCPM = new clsField("GlazingCPM", ccsFloat, "");
        
        $this->MovementCPM = new clsField("MovementCPM", ccsFloat, "");
        
        $this->PackagingCPM = new clsField("PackagingCPM", ccsFloat, "");
        
        $this->DesignMat1 = new clsField("DesignMat1", ccsInteger, "");
        
        $this->DesignMat2 = new clsField("DesignMat2", ccsInteger, "");
        
        $this->DesignMat3 = new clsField("DesignMat3", ccsInteger, "");
        
        $this->DesignMat4 = new clsField("DesignMat4", ccsInteger, "");
        
        $this->DesignMatQty1 = new clsField("DesignMatQty1", ccsInteger, "");
        
        $this->DesignMatQty2 = new clsField("DesignMatQty2", ccsInteger, "");
        
        $this->DesignMatQty3 = new clsField("DesignMatQty3", ccsInteger, "");
        
        $this->DesignMatQty4 = new clsField("DesignMatQty4", ccsInteger, "");
        
        $this->lblUnit1 = new clsField("lblUnit1", ccsText, "");
        
        $this->lblUnit2 = new clsField("lblUnit2", ccsText, "");
        
        $this->lblUnit3 = new clsField("lblUnit3", ccsText, "");
        
        $this->lblUnit4 = new clsField("lblUnit4", ccsText, "");
        
        $this->lblStdBisque = new clsField("lblStdBisque", ccsFloat, "");
        
        $this->lblStdGlaze = new clsField("lblStdGlaze", ccsFloat, "");
        
        $this->lblRakuBisque = new clsField("lblRakuBisque", ccsFloat, "");
        
        $this->lblRakuGlaze = new clsField("lblRakuGlaze", ccsFloat, "");
        
        $this->StdBisquePerFiring = new clsField("StdBisquePerFiring", ccsFloat, "");
        
        $this->StdGlazePerFiring = new clsField("StdGlazePerFiring", ccsFloat, "");
        
        $this->RakuBisquePerFiring = new clsField("RakuBisquePerFiring", ccsFloat, "");
        
        $this->RakuGlazePerFiring = new clsField("RakuGlazePerFiring", ccsFloat, "");
        
        $this->DesignMatUnitPrice1 = new clsField("DesignMatUnitPrice1", ccsFloat, "");
        
        $this->DesignMatUnitPrice2 = new clsField("DesignMatUnitPrice2", ccsFloat, "");
        
        $this->DesignMatUnitPrice3 = new clsField("DesignMatUnitPrice3", ccsFloat, "");
        
        $this->DesignMatUnitPrice4 = new clsField("DesignMatUnitPrice4", ccsFloat, "");
        
        $this->TotDesignMat1 = new clsField("TotDesignMat1", ccsFloat, "");
        
        $this->TotDesignMat2 = new clsField("TotDesignMat2", ccsFloat, "");
        
        $this->TotDesignMat3 = new clsField("TotDesignMat3", ccsFloat, "");
        
        $this->TotDesignMat4 = new clsField("TotDesignMat4", ccsFloat, "");
        
        $this->TotAllPieces = new clsField("TotAllPieces", ccsFloat, "");
        
        $this->lblYear = new clsField("lblYear", ccsText, "");
        
        $this->Day = new clsField("Day", ccsFloat, "");
        
        $this->Month = new clsField("Month", ccsFloat, "");
        
        $this->Year = new clsField("Year", ccsFloat, "");
        
        $this->Worker = new clsField("Worker", ccsFloat, "");
        
        $this->WheelPPH1 = new clsField("WheelPPH1", ccsInteger, "");
        
        $this->TotPiecesDay = new clsField("TotPiecesDay", ccsFloat, "");
        
        $this->TotPiecesMonth = new clsField("TotPiecesMonth", ccsFloat, "");
        
        $this->TotPiecesYear = new clsField("TotPiecesYear", ccsFloat, "");
        
        $this->TotPiecesWorker = new clsField("TotPiecesWorker", ccsFloat, "");
        
        $this->CostBudget = new clsField("CostBudget", ccsFloat, "");
        
        $this->BEP = new clsField("BEP", ccsFloat, "");
        
        $this->lblDesignMat1 = new clsField("lblDesignMat1", ccsText, "");
        
        $this->lblDesignMat2 = new clsField("lblDesignMat2", ccsText, "");
        
        $this->lblDesignMat3 = new clsField("lblDesignMat3", ccsText, "");
        
        $this->lblDesignMat4 = new clsField("lblDesignMat4", ccsText, "");
        
        $this->lblYear1 = new clsField("lblYear1", ccsText, "");
        
        $this->StdBisqueColor = new clsField("StdBisqueColor", ccsText, "");
        
        $this->StdGlazeColor = new clsField("StdGlazeColor", ccsText, "");
        
        $this->RakuBisqueColor = new clsField("RakuBisqueColor", ccsText, "");
        
        $this->RakuGlazeColor = new clsField("RakuGlazeColor", ccsText, "");
        
        $this->DollarPrice = new clsField("DollarPrice", ccsFloat, "");
        
        $this->EuroPrice = new clsField("EuroPrice", ccsFloat, "");
        
        $this->LastUpdate = new clsField("LastUpdate", ccsDate, $this->DateFormat);
        
        $this->sID = new clsField("sID", ccsInteger, "");
        

        $this->UpdateFields["ClayKG"] = array("Name" => "ClayKG", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClayType"] = array("Name" => "ClayType", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClayPreparationMinute"] = array("Name" => "ClayPreparationMinute", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["WheelMinute"] = array("Name" => "WheelMinute", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["SlabMinute"] = array("Name" => "SlabMinute", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["CastingMinute"] = array("Name" => "CastingMinute", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["FinishingMinute"] = array("Name" => "FinishingMinute", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["GlazingMinute"] = array("Name" => "GlazingMinute", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["StandardBisqueLoading"] = array("Name" => "StandardBisqueLoading", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["StandardGlazeLoading"] = array("Name" => "StandardGlazeLoading", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["RakuBisqueLoading"] = array("Name" => "RakuBisqueLoading", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["RakuGlazeLoading"] = array("Name" => "RakuGlazeLoading", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["MovementMinute"] = array("Name" => "MovementMinute", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["PackagingWorkMinute"] = array("Name" => "PackagingWorkMinute", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClayPreparationPPH"] = array("Name" => "ClayPreparationPPH", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["WheelPPH"] = array("Name" => "WheelPPH", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["SlabPPH"] = array("Name" => "SlabPPH", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["CastingPPH"] = array("Name" => "CastingPPH", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["FinishingPPH"] = array("Name" => "FinishingPPH", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["GlazingPPH"] = array("Name" => "GlazingPPH", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["MovementPPH"] = array("Name" => "MovementPPH", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["PackagingWorkPPH"] = array("Name" => "PackagingWorkPPH", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["RealSellingPrice"] = array("Name" => "RealSellingPrice", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMat1"] = array("Name" => "DesignMat1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMat2"] = array("Name" => "DesignMat2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMat3"] = array("Name" => "DesignMat3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMat4"] = array("Name" => "DesignMat4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatQty1"] = array("Name" => "DesignMatQty1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatQty2"] = array("Name" => "DesignMatQty2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatQty3"] = array("Name" => "DesignMatQty3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatQty4"] = array("Name" => "DesignMatQty4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["PriceDollar"] = array("Name" => "PriceDollar", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["PriceEuro"] = array("Name" => "PriceEuro", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-E1530F59
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlsID", ccsInteger, "", "", $this->Parameters["urlsID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "sID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-D1E981F7
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT sID, SampleCode, SampleDescription, ClientCode, ClientDescription, ClayKG, DesignMat1, DesignMat2, DesignMat3, DesignMat4,\n\n" .
        "DesignMatQty1, DesignMatQty2, DesignMatQty3, DesignMatQty4, ClayType, ClayPreparationMinute, WheelMinute, SlabMinute, CastingMinute,\n\n" .
        "FinishingMinute, GlazingMinute, StandardBisqueLoading, StandardGlazeLoading, RakuBisqueLoading, RakuGlazeLoading, MovementMinute,\n\n" .
        "ClayPreparationPPH, WheelPPH, PackagingWorkMinute, SlabPPH, CastingPPH, FinishingPPH, GlazingPPH, MovementPPH, PackagingWorkPPH,\n\n" .
        "RealSellingPrice, PriceDollar, PriceEuro \n\n" .
        "FROM sampleceramic {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-753ED54B
    function SetValues()
    {
        $this->SampleCode->SetDBValue($this->f("SampleCode"));
        $this->SampleDescription->SetDBValue($this->f("SampleDescription"));
        $this->ClientCode->SetDBValue($this->f("ClientCode"));
        $this->ClientDescription->SetDBValue($this->f("ClientDescription"));
        $this->ClayKG->SetDBValue(trim($this->f("ClayKG")));
        $this->ClayType->SetDBValue(trim($this->f("ClayType")));
        $this->ClayPreparationMinute->SetDBValue(trim($this->f("ClayPreparationMinute")));
        $this->WheelMinute->SetDBValue(trim($this->f("WheelMinute")));
        $this->SlabMinute->SetDBValue(trim($this->f("SlabMinute")));
        $this->CastingMinute->SetDBValue(trim($this->f("CastingMinute")));
        $this->FinishingMinute->SetDBValue(trim($this->f("FinishingMinute")));
        $this->GlazingMinute->SetDBValue(trim($this->f("GlazingMinute")));
        $this->StandardBisqueLoading->SetDBValue(trim($this->f("StandardBisqueLoading")));
        $this->StandardGlazeLoading->SetDBValue(trim($this->f("StandardGlazeLoading")));
        $this->RakuBisqueLoading->SetDBValue(trim($this->f("RakuBisqueLoading")));
        $this->RakuGlazeLoading->SetDBValue(trim($this->f("RakuGlazeLoading")));
        $this->MovementMinute->SetDBValue(trim($this->f("MovementMinute")));
        $this->PackagingWorkMinute->SetDBValue(trim($this->f("PackagingWorkMinute")));
        $this->ClayPreparationPPH->SetDBValue(trim($this->f("ClayPreparationPPH")));
        $this->WheelPPH->SetDBValue(trim($this->f("WheelPPH")));
        $this->SlabPPH->SetDBValue(trim($this->f("SlabPPH")));
        $this->CastingPPH->SetDBValue(trim($this->f("CastingPPH")));
        $this->FinishingPPH->SetDBValue(trim($this->f("FinishingPPH")));
        $this->GlazingPPH->SetDBValue(trim($this->f("GlazingPPH")));
        $this->MovementPPH->SetDBValue(trim($this->f("MovementPPH")));
        $this->PackagingWorkPPH->SetDBValue(trim($this->f("PackagingWorkPPH")));
        $this->RealSellingPrice->SetDBValue(trim($this->f("RealSellingPrice")));
        $this->DesignMat1->SetDBValue(trim($this->f("DesignMat1")));
        $this->DesignMat2->SetDBValue(trim($this->f("DesignMat2")));
        $this->DesignMat3->SetDBValue(trim($this->f("DesignMat3")));
        $this->DesignMat4->SetDBValue(trim($this->f("DesignMat4")));
        $this->DesignMatQty1->SetDBValue(trim($this->f("DesignMatQty1")));
        $this->DesignMatQty2->SetDBValue(trim($this->f("DesignMatQty2")));
        $this->DesignMatQty3->SetDBValue(trim($this->f("DesignMatQty3")));
        $this->DesignMatQty4->SetDBValue(trim($this->f("DesignMatQty4")));
        $this->DollarPrice->SetDBValue(trim($this->f("PriceDollar")));
        $this->EuroPrice->SetDBValue(trim($this->f("PriceEuro")));
        $this->sID->SetDBValue(trim($this->f("sID")));
    }
//End SetValues Method

//Update Method @2-B6EE5E16
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["ClayKG"] = new clsSQLParameter("ctrlClayKG", ccsFloat, "", "", $this->ClayKG->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["ClayType"] = new clsSQLParameter("ctrlClayType", ccsInteger, "", "", $this->ClayType->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["ClayPreparationMinute"] = new clsSQLParameter("ctrlClayPreparationMinute", ccsInteger, "", "", $this->ClayPreparationMinute->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["WheelMinute"] = new clsSQLParameter("ctrlWheelMinute", ccsInteger, "", "", $this->WheelMinute->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["SlabMinute"] = new clsSQLParameter("ctrlSlabMinute", ccsInteger, "", "", $this->SlabMinute->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["CastingMinute"] = new clsSQLParameter("ctrlCastingMinute", ccsInteger, "", "", $this->CastingMinute->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["FinishingMinute"] = new clsSQLParameter("ctrlFinishingMinute", ccsInteger, "", "", $this->FinishingMinute->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["GlazingMinute"] = new clsSQLParameter("ctrlGlazingMinute", ccsInteger, "", "", $this->GlazingMinute->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["StandardBisqueLoading"] = new clsSQLParameter("ctrlStandardBisqueLoading", ccsInteger, "", "", $this->StandardBisqueLoading->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["StandardGlazeLoading"] = new clsSQLParameter("ctrlStandardGlazeLoading", ccsInteger, "", "", $this->StandardGlazeLoading->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["RakuBisqueLoading"] = new clsSQLParameter("ctrlRakuBisqueLoading", ccsInteger, "", "", $this->RakuBisqueLoading->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["RakuGlazeLoading"] = new clsSQLParameter("ctrlRakuGlazeLoading", ccsInteger, "", "", $this->RakuGlazeLoading->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["MovementMinute"] = new clsSQLParameter("ctrlMovementMinute", ccsInteger, "", "", $this->MovementMinute->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["PackagingWorkMinute"] = new clsSQLParameter("ctrlPackagingWorkMinute", ccsInteger, "", "", $this->PackagingWorkMinute->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["ClayPreparationPPH"] = new clsSQLParameter("ctrlClayPreparationPPH", ccsInteger, "", "", $this->ClayPreparationPPH->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["WheelPPH"] = new clsSQLParameter("ctrlWheelPPH", ccsInteger, "", "", $this->WheelPPH->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["SlabPPH"] = new clsSQLParameter("ctrlSlabPPH", ccsInteger, "", "", $this->SlabPPH->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["CastingPPH"] = new clsSQLParameter("ctrlCastingPPH", ccsInteger, "", "", $this->CastingPPH->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["FinishingPPH"] = new clsSQLParameter("ctrlFinishingPPH", ccsInteger, "", "", $this->FinishingPPH->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["GlazingPPH"] = new clsSQLParameter("ctrlGlazingPPH", ccsInteger, "", "", $this->GlazingPPH->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["MovementPPH"] = new clsSQLParameter("ctrlMovementPPH", ccsInteger, "", "", $this->MovementPPH->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["PackagingWorkPPH"] = new clsSQLParameter("ctrlPackagingWorkPPH", ccsInteger, "", "", $this->PackagingWorkPPH->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["RealSellingPrice"] = new clsSQLParameter("ctrlRealSellingPrice", ccsFloat, "", "", $this->RealSellingPrice->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DesignMat1"] = new clsSQLParameter("ctrlDesignMat1", ccsInteger, "", "", $this->DesignMat1->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DesignMat2"] = new clsSQLParameter("ctrlDesignMat2", ccsInteger, "", "", $this->DesignMat2->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DesignMat3"] = new clsSQLParameter("ctrlDesignMat3", ccsInteger, "", "", $this->DesignMat3->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DesignMat4"] = new clsSQLParameter("ctrlDesignMat4", ccsInteger, "", "", $this->DesignMat4->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DesignMatQty1"] = new clsSQLParameter("ctrlDesignMatQty1", ccsInteger, "", "", $this->DesignMatQty1->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DesignMatQty2"] = new clsSQLParameter("ctrlDesignMatQty2", ccsInteger, "", "", $this->DesignMatQty2->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DesignMatQty3"] = new clsSQLParameter("ctrlDesignMatQty3", ccsInteger, "", "", $this->DesignMatQty3->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DesignMatQty4"] = new clsSQLParameter("ctrlDesignMatQty4", ccsInteger, "", "", $this->DesignMatQty4->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["PriceDollar"] = new clsSQLParameter("ctrlDollarPrice", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), "", $this->DollarPrice->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["PriceEuro"] = new clsSQLParameter("ctrlEuroPrice", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), "", $this->EuroPrice->GetValue(true), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "urlsID", ccsInteger, "", "", CCGetFromGet("sID", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["ClayKG"]->GetValue()) and !strlen($this->cp["ClayKG"]->GetText()) and !is_bool($this->cp["ClayKG"]->GetValue())) 
            $this->cp["ClayKG"]->SetValue($this->ClayKG->GetValue(true));
        if (!is_null($this->cp["ClayType"]->GetValue()) and !strlen($this->cp["ClayType"]->GetText()) and !is_bool($this->cp["ClayType"]->GetValue())) 
            $this->cp["ClayType"]->SetValue($this->ClayType->GetValue(true));
        if (!is_null($this->cp["ClayPreparationMinute"]->GetValue()) and !strlen($this->cp["ClayPreparationMinute"]->GetText()) and !is_bool($this->cp["ClayPreparationMinute"]->GetValue())) 
            $this->cp["ClayPreparationMinute"]->SetValue($this->ClayPreparationMinute->GetValue(true));
        if (!is_null($this->cp["WheelMinute"]->GetValue()) and !strlen($this->cp["WheelMinute"]->GetText()) and !is_bool($this->cp["WheelMinute"]->GetValue())) 
            $this->cp["WheelMinute"]->SetValue($this->WheelMinute->GetValue(true));
        if (!is_null($this->cp["SlabMinute"]->GetValue()) and !strlen($this->cp["SlabMinute"]->GetText()) and !is_bool($this->cp["SlabMinute"]->GetValue())) 
            $this->cp["SlabMinute"]->SetValue($this->SlabMinute->GetValue(true));
        if (!is_null($this->cp["CastingMinute"]->GetValue()) and !strlen($this->cp["CastingMinute"]->GetText()) and !is_bool($this->cp["CastingMinute"]->GetValue())) 
            $this->cp["CastingMinute"]->SetValue($this->CastingMinute->GetValue(true));
        if (!is_null($this->cp["FinishingMinute"]->GetValue()) and !strlen($this->cp["FinishingMinute"]->GetText()) and !is_bool($this->cp["FinishingMinute"]->GetValue())) 
            $this->cp["FinishingMinute"]->SetValue($this->FinishingMinute->GetValue(true));
        if (!is_null($this->cp["GlazingMinute"]->GetValue()) and !strlen($this->cp["GlazingMinute"]->GetText()) and !is_bool($this->cp["GlazingMinute"]->GetValue())) 
            $this->cp["GlazingMinute"]->SetValue($this->GlazingMinute->GetValue(true));
        if (!is_null($this->cp["StandardBisqueLoading"]->GetValue()) and !strlen($this->cp["StandardBisqueLoading"]->GetText()) and !is_bool($this->cp["StandardBisqueLoading"]->GetValue())) 
            $this->cp["StandardBisqueLoading"]->SetValue($this->StandardBisqueLoading->GetValue(true));
        if (!is_null($this->cp["StandardGlazeLoading"]->GetValue()) and !strlen($this->cp["StandardGlazeLoading"]->GetText()) and !is_bool($this->cp["StandardGlazeLoading"]->GetValue())) 
            $this->cp["StandardGlazeLoading"]->SetValue($this->StandardGlazeLoading->GetValue(true));
        if (!is_null($this->cp["RakuBisqueLoading"]->GetValue()) and !strlen($this->cp["RakuBisqueLoading"]->GetText()) and !is_bool($this->cp["RakuBisqueLoading"]->GetValue())) 
            $this->cp["RakuBisqueLoading"]->SetValue($this->RakuBisqueLoading->GetValue(true));
        if (!is_null($this->cp["RakuGlazeLoading"]->GetValue()) and !strlen($this->cp["RakuGlazeLoading"]->GetText()) and !is_bool($this->cp["RakuGlazeLoading"]->GetValue())) 
            $this->cp["RakuGlazeLoading"]->SetValue($this->RakuGlazeLoading->GetValue(true));
        if (!is_null($this->cp["MovementMinute"]->GetValue()) and !strlen($this->cp["MovementMinute"]->GetText()) and !is_bool($this->cp["MovementMinute"]->GetValue())) 
            $this->cp["MovementMinute"]->SetValue($this->MovementMinute->GetValue(true));
        if (!is_null($this->cp["PackagingWorkMinute"]->GetValue()) and !strlen($this->cp["PackagingWorkMinute"]->GetText()) and !is_bool($this->cp["PackagingWorkMinute"]->GetValue())) 
            $this->cp["PackagingWorkMinute"]->SetValue($this->PackagingWorkMinute->GetValue(true));
        if (!is_null($this->cp["ClayPreparationPPH"]->GetValue()) and !strlen($this->cp["ClayPreparationPPH"]->GetText()) and !is_bool($this->cp["ClayPreparationPPH"]->GetValue())) 
            $this->cp["ClayPreparationPPH"]->SetValue($this->ClayPreparationPPH->GetValue(true));
        if (!is_null($this->cp["WheelPPH"]->GetValue()) and !strlen($this->cp["WheelPPH"]->GetText()) and !is_bool($this->cp["WheelPPH"]->GetValue())) 
            $this->cp["WheelPPH"]->SetValue($this->WheelPPH->GetValue(true));
        if (!is_null($this->cp["SlabPPH"]->GetValue()) and !strlen($this->cp["SlabPPH"]->GetText()) and !is_bool($this->cp["SlabPPH"]->GetValue())) 
            $this->cp["SlabPPH"]->SetValue($this->SlabPPH->GetValue(true));
        if (!is_null($this->cp["CastingPPH"]->GetValue()) and !strlen($this->cp["CastingPPH"]->GetText()) and !is_bool($this->cp["CastingPPH"]->GetValue())) 
            $this->cp["CastingPPH"]->SetValue($this->CastingPPH->GetValue(true));
        if (!is_null($this->cp["FinishingPPH"]->GetValue()) and !strlen($this->cp["FinishingPPH"]->GetText()) and !is_bool($this->cp["FinishingPPH"]->GetValue())) 
            $this->cp["FinishingPPH"]->SetValue($this->FinishingPPH->GetValue(true));
        if (!is_null($this->cp["GlazingPPH"]->GetValue()) and !strlen($this->cp["GlazingPPH"]->GetText()) and !is_bool($this->cp["GlazingPPH"]->GetValue())) 
            $this->cp["GlazingPPH"]->SetValue($this->GlazingPPH->GetValue(true));
        if (!is_null($this->cp["MovementPPH"]->GetValue()) and !strlen($this->cp["MovementPPH"]->GetText()) and !is_bool($this->cp["MovementPPH"]->GetValue())) 
            $this->cp["MovementPPH"]->SetValue($this->MovementPPH->GetValue(true));
        if (!is_null($this->cp["PackagingWorkPPH"]->GetValue()) and !strlen($this->cp["PackagingWorkPPH"]->GetText()) and !is_bool($this->cp["PackagingWorkPPH"]->GetValue())) 
            $this->cp["PackagingWorkPPH"]->SetValue($this->PackagingWorkPPH->GetValue(true));
        if (!is_null($this->cp["RealSellingPrice"]->GetValue()) and !strlen($this->cp["RealSellingPrice"]->GetText()) and !is_bool($this->cp["RealSellingPrice"]->GetValue())) 
            $this->cp["RealSellingPrice"]->SetValue($this->RealSellingPrice->GetValue(true));
        if (!is_null($this->cp["DesignMat1"]->GetValue()) and !strlen($this->cp["DesignMat1"]->GetText()) and !is_bool($this->cp["DesignMat1"]->GetValue())) 
            $this->cp["DesignMat1"]->SetValue($this->DesignMat1->GetValue(true));
        if (!is_null($this->cp["DesignMat2"]->GetValue()) and !strlen($this->cp["DesignMat2"]->GetText()) and !is_bool($this->cp["DesignMat2"]->GetValue())) 
            $this->cp["DesignMat2"]->SetValue($this->DesignMat2->GetValue(true));
        if (!is_null($this->cp["DesignMat3"]->GetValue()) and !strlen($this->cp["DesignMat3"]->GetText()) and !is_bool($this->cp["DesignMat3"]->GetValue())) 
            $this->cp["DesignMat3"]->SetValue($this->DesignMat3->GetValue(true));
        if (!is_null($this->cp["DesignMat4"]->GetValue()) and !strlen($this->cp["DesignMat4"]->GetText()) and !is_bool($this->cp["DesignMat4"]->GetValue())) 
            $this->cp["DesignMat4"]->SetValue($this->DesignMat4->GetValue(true));
        if (!is_null($this->cp["DesignMatQty1"]->GetValue()) and !strlen($this->cp["DesignMatQty1"]->GetText()) and !is_bool($this->cp["DesignMatQty1"]->GetValue())) 
            $this->cp["DesignMatQty1"]->SetValue($this->DesignMatQty1->GetValue(true));
        if (!is_null($this->cp["DesignMatQty2"]->GetValue()) and !strlen($this->cp["DesignMatQty2"]->GetText()) and !is_bool($this->cp["DesignMatQty2"]->GetValue())) 
            $this->cp["DesignMatQty2"]->SetValue($this->DesignMatQty2->GetValue(true));
        if (!is_null($this->cp["DesignMatQty3"]->GetValue()) and !strlen($this->cp["DesignMatQty3"]->GetText()) and !is_bool($this->cp["DesignMatQty3"]->GetValue())) 
            $this->cp["DesignMatQty3"]->SetValue($this->DesignMatQty3->GetValue(true));
        if (!is_null($this->cp["DesignMatQty4"]->GetValue()) and !strlen($this->cp["DesignMatQty4"]->GetText()) and !is_bool($this->cp["DesignMatQty4"]->GetValue())) 
            $this->cp["DesignMatQty4"]->SetValue($this->DesignMatQty4->GetValue(true));
        if (!is_null($this->cp["PriceDollar"]->GetValue()) and !strlen($this->cp["PriceDollar"]->GetText()) and !is_bool($this->cp["PriceDollar"]->GetValue())) 
            $this->cp["PriceDollar"]->SetValue($this->DollarPrice->GetValue(true));
        if (!is_null($this->cp["PriceEuro"]->GetValue()) and !strlen($this->cp["PriceEuro"]->GetText()) and !is_bool($this->cp["PriceEuro"]->GetValue())) 
            $this->cp["PriceEuro"]->SetValue($this->EuroPrice->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "sID", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["ClayKG"]["Value"] = $this->cp["ClayKG"]->GetDBValue(true);
        $this->UpdateFields["ClayType"]["Value"] = $this->cp["ClayType"]->GetDBValue(true);
        $this->UpdateFields["ClayPreparationMinute"]["Value"] = $this->cp["ClayPreparationMinute"]->GetDBValue(true);
        $this->UpdateFields["WheelMinute"]["Value"] = $this->cp["WheelMinute"]->GetDBValue(true);
        $this->UpdateFields["SlabMinute"]["Value"] = $this->cp["SlabMinute"]->GetDBValue(true);
        $this->UpdateFields["CastingMinute"]["Value"] = $this->cp["CastingMinute"]->GetDBValue(true);
        $this->UpdateFields["FinishingMinute"]["Value"] = $this->cp["FinishingMinute"]->GetDBValue(true);
        $this->UpdateFields["GlazingMinute"]["Value"] = $this->cp["GlazingMinute"]->GetDBValue(true);
        $this->UpdateFields["StandardBisqueLoading"]["Value"] = $this->cp["StandardBisqueLoading"]->GetDBValue(true);
        $this->UpdateFields["StandardGlazeLoading"]["Value"] = $this->cp["StandardGlazeLoading"]->GetDBValue(true);
        $this->UpdateFields["RakuBisqueLoading"]["Value"] = $this->cp["RakuBisqueLoading"]->GetDBValue(true);
        $this->UpdateFields["RakuGlazeLoading"]["Value"] = $this->cp["RakuGlazeLoading"]->GetDBValue(true);
        $this->UpdateFields["MovementMinute"]["Value"] = $this->cp["MovementMinute"]->GetDBValue(true);
        $this->UpdateFields["PackagingWorkMinute"]["Value"] = $this->cp["PackagingWorkMinute"]->GetDBValue(true);
        $this->UpdateFields["ClayPreparationPPH"]["Value"] = $this->cp["ClayPreparationPPH"]->GetDBValue(true);
        $this->UpdateFields["WheelPPH"]["Value"] = $this->cp["WheelPPH"]->GetDBValue(true);
        $this->UpdateFields["SlabPPH"]["Value"] = $this->cp["SlabPPH"]->GetDBValue(true);
        $this->UpdateFields["CastingPPH"]["Value"] = $this->cp["CastingPPH"]->GetDBValue(true);
        $this->UpdateFields["FinishingPPH"]["Value"] = $this->cp["FinishingPPH"]->GetDBValue(true);
        $this->UpdateFields["GlazingPPH"]["Value"] = $this->cp["GlazingPPH"]->GetDBValue(true);
        $this->UpdateFields["MovementPPH"]["Value"] = $this->cp["MovementPPH"]->GetDBValue(true);
        $this->UpdateFields["PackagingWorkPPH"]["Value"] = $this->cp["PackagingWorkPPH"]->GetDBValue(true);
        $this->UpdateFields["RealSellingPrice"]["Value"] = $this->cp["RealSellingPrice"]->GetDBValue(true);
        $this->UpdateFields["DesignMat1"]["Value"] = $this->cp["DesignMat1"]->GetDBValue(true);
        $this->UpdateFields["DesignMat2"]["Value"] = $this->cp["DesignMat2"]->GetDBValue(true);
        $this->UpdateFields["DesignMat3"]["Value"] = $this->cp["DesignMat3"]->GetDBValue(true);
        $this->UpdateFields["DesignMat4"]["Value"] = $this->cp["DesignMat4"]->GetDBValue(true);
        $this->UpdateFields["DesignMatQty1"]["Value"] = $this->cp["DesignMatQty1"]->GetDBValue(true);
        $this->UpdateFields["DesignMatQty2"]["Value"] = $this->cp["DesignMatQty2"]->GetDBValue(true);
        $this->UpdateFields["DesignMatQty3"]["Value"] = $this->cp["DesignMatQty3"]->GetDBValue(true);
        $this->UpdateFields["DesignMatQty4"]["Value"] = $this->cp["DesignMatQty4"]->GetDBValue(true);
        $this->UpdateFields["PriceDollar"]["Value"] = $this->cp["PriceDollar"]->GetDBValue(true);
        $this->UpdateFields["PriceEuro"]["Value"] = $this->cp["PriceEuro"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("sampleceramic", $this->UpdateFields, $this);
        $this->SQL = CCBuildSQL($this->SQL, $Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End CostingDataSource Class @2-FCB6E20C

//Initialize Page @1-CF4B0B70
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
$TemplateFileName = "EditRnd.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-A39DA57E
include_once("./EditRnd_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-848BC8C9
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Costing = new clsRecordCosting("", $MainPage);
$MainPage->Costing = & $Costing;
$Costing->Initialize();

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

//Execute Components @1-91DEC567
$Costing->Operation();
//End Execute Components

//Go to destination page @1-0DF9CCCB
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Costing);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-473B6DEE
$Costing->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4B761D32
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Costing);
unset($Tpl);
//End Unload Page


?>
