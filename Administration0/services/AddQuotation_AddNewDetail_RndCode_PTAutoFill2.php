<?php
//Include Common Files @1-FD8E77EA
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "AddQuotation_AddNewDetail_RndCode_PTAutoFill2.php");
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

//Class_Initialize Event @2-ECF61F84
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
        $this->ClientCode = new clsControl(ccsLabel, "ClientCode", "ClientCode", ccsText, "", CCGetRequestParam("ClientCode", ccsGet, NULL), $this);
        $this->ClientDescription = new clsControl(ccsLabel, "ClientDescription", "ClientDescription", ccsText, "", CCGetRequestParam("ClientDescription", ccsGet, NULL), $this);
        $this->SampleDate = new clsControl(ccsLabel, "SampleDate", "SampleDate", ccsDate, $DefaultDateFormat, CCGetRequestParam("SampleDate", ccsGet, NULL), $this);
        $this->TechDraw = new clsControl(ccsLabel, "TechDraw", "TechDraw", ccsText, "", CCGetRequestParam("TechDraw", ccsGet, NULL), $this);
        $this->Photo1 = new clsControl(ccsLabel, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->Photo2 = new clsControl(ccsLabel, "Photo2", "Photo2", ccsText, "", CCGetRequestParam("Photo2", ccsGet, NULL), $this);
        $this->Photo3 = new clsControl(ccsLabel, "Photo3", "Photo3", ccsText, "", CCGetRequestParam("Photo3", ccsGet, NULL), $this);
        $this->Photo4 = new clsControl(ccsLabel, "Photo4", "Photo4", ccsText, "", CCGetRequestParam("Photo4", ccsGet, NULL), $this);
        $this->Reference = new clsControl(ccsLabel, "Reference", "Reference", ccsText, "", CCGetRequestParam("Reference", ccsGet, NULL), $this);
        $this->ReferenceNote = new clsControl(ccsLabel, "ReferenceNote", "ReferenceNote", ccsMemo, "", CCGetRequestParam("ReferenceNote", ccsGet, NULL), $this);
        $this->Clay = new clsControl(ccsLabel, "Clay", "Clay", ccsText, "", CCGetRequestParam("Clay", ccsGet, NULL), $this);
        $this->ClayKG = new clsControl(ccsLabel, "ClayKG", "ClayKG", ccsFloat, "", CCGetRequestParam("ClayKG", ccsGet, NULL), $this);
        $this->ClayNote = new clsControl(ccsLabel, "ClayNote", "ClayNote", ccsMemo, "", CCGetRequestParam("ClayNote", ccsGet, NULL), $this);
        $this->BuildTech = new clsControl(ccsLabel, "BuildTech", "BuildTech", ccsText, "", CCGetRequestParam("BuildTech", ccsGet, NULL), $this);
        $this->BuildTechNote = new clsControl(ccsLabel, "BuildTechNote", "BuildTechNote", ccsMemo, "", CCGetRequestParam("BuildTechNote", ccsGet, NULL), $this);
        $this->Rim = new clsControl(ccsLabel, "Rim", "Rim", ccsText, "", CCGetRequestParam("Rim", ccsGet, NULL), $this);
        $this->Feet = new clsControl(ccsLabel, "Feet", "Feet", ccsText, "", CCGetRequestParam("Feet", ccsGet, NULL), $this);
        $this->Casting1 = new clsControl(ccsLabel, "Casting1", "Casting1", ccsText, "", CCGetRequestParam("Casting1", ccsGet, NULL), $this);
        $this->Casting2 = new clsControl(ccsLabel, "Casting2", "Casting2", ccsText, "", CCGetRequestParam("Casting2", ccsGet, NULL), $this);
        $this->Casting3 = new clsControl(ccsLabel, "Casting3", "Casting3", ccsText, "", CCGetRequestParam("Casting3", ccsGet, NULL), $this);
        $this->Casting4 = new clsControl(ccsLabel, "Casting4", "Casting4", ccsText, "", CCGetRequestParam("Casting4", ccsGet, NULL), $this);
        $this->CastingNote = new clsControl(ccsLabel, "CastingNote", "CastingNote", ccsMemo, "", CCGetRequestParam("CastingNote", ccsGet, NULL), $this);
        $this->Estruder1 = new clsControl(ccsLabel, "Estruder1", "Estruder1", ccsText, "", CCGetRequestParam("Estruder1", ccsGet, NULL), $this);
        $this->Estruder2 = new clsControl(ccsLabel, "Estruder2", "Estruder2", ccsText, "", CCGetRequestParam("Estruder2", ccsGet, NULL), $this);
        $this->Estruder3 = new clsControl(ccsLabel, "Estruder3", "Estruder3", ccsText, "", CCGetRequestParam("Estruder3", ccsGet, NULL), $this);
        $this->Estruder4 = new clsControl(ccsLabel, "Estruder4", "Estruder4", ccsText, "", CCGetRequestParam("Estruder4", ccsGet, NULL), $this);
        $this->EstruderNote = new clsControl(ccsLabel, "EstruderNote", "EstruderNote", ccsMemo, "", CCGetRequestParam("EstruderNote", ccsGet, NULL), $this);
        $this->Texture1 = new clsControl(ccsLabel, "Texture1", "Texture1", ccsText, "", CCGetRequestParam("Texture1", ccsGet, NULL), $this);
        $this->Texture2 = new clsControl(ccsLabel, "Texture2", "Texture2", ccsText, "", CCGetRequestParam("Texture2", ccsGet, NULL), $this);
        $this->Texture3 = new clsControl(ccsLabel, "Texture3", "Texture3", ccsText, "", CCGetRequestParam("Texture3", ccsGet, NULL), $this);
        $this->Texture4 = new clsControl(ccsLabel, "Texture4", "Texture4", ccsText, "", CCGetRequestParam("Texture4", ccsGet, NULL), $this);
        $this->TextureNote = new clsControl(ccsLabel, "TextureNote", "TextureNote", ccsMemo, "", CCGetRequestParam("TextureNote", ccsGet, NULL), $this);
        $this->Tools1 = new clsControl(ccsLabel, "Tools1", "Tools1", ccsText, "", CCGetRequestParam("Tools1", ccsGet, NULL), $this);
        $this->Tools2 = new clsControl(ccsLabel, "Tools2", "Tools2", ccsText, "", CCGetRequestParam("Tools2", ccsGet, NULL), $this);
        $this->Tools3 = new clsControl(ccsLabel, "Tools3", "Tools3", ccsText, "", CCGetRequestParam("Tools3", ccsGet, NULL), $this);
        $this->Tools4 = new clsControl(ccsLabel, "Tools4", "Tools4", ccsText, "", CCGetRequestParam("Tools4", ccsGet, NULL), $this);
        $this->ToolsNote = new clsControl(ccsLabel, "ToolsNote", "ToolsNote", ccsMemo, "", CCGetRequestParam("ToolsNote", ccsGet, NULL), $this);
        $this->Engobe1 = new clsControl(ccsLabel, "Engobe1", "Engobe1", ccsText, "", CCGetRequestParam("Engobe1", ccsGet, NULL), $this);
        $this->Engobe2 = new clsControl(ccsLabel, "Engobe2", "Engobe2", ccsText, "", CCGetRequestParam("Engobe2", ccsGet, NULL), $this);
        $this->Engobe3 = new clsControl(ccsLabel, "Engobe3", "Engobe3", ccsText, "", CCGetRequestParam("Engobe3", ccsGet, NULL), $this);
        $this->Engobe4 = new clsControl(ccsLabel, "Engobe4", "Engobe4", ccsText, "", CCGetRequestParam("Engobe4", ccsGet, NULL), $this);
        $this->EngobeNote = new clsControl(ccsLabel, "EngobeNote", "EngobeNote", ccsMemo, "", CCGetRequestParam("EngobeNote", ccsGet, NULL), $this);
        $this->BisqueTemp = new clsControl(ccsLabel, "BisqueTemp", "BisqueTemp", ccsText, "", CCGetRequestParam("BisqueTemp", ccsGet, NULL), $this);
        $this->StainOxide1 = new clsControl(ccsLabel, "StainOxide1", "StainOxide1", ccsText, "", CCGetRequestParam("StainOxide1", ccsGet, NULL), $this);
        $this->StainOxide2 = new clsControl(ccsLabel, "StainOxide2", "StainOxide2", ccsText, "", CCGetRequestParam("StainOxide2", ccsGet, NULL), $this);
        $this->StainOxide3 = new clsControl(ccsLabel, "StainOxide3", "StainOxide3", ccsText, "", CCGetRequestParam("StainOxide3", ccsGet, NULL), $this);
        $this->StainOxide4 = new clsControl(ccsLabel, "StainOxide4", "StainOxide4", ccsText, "", CCGetRequestParam("StainOxide4", ccsGet, NULL), $this);
        $this->StainOxideNote = new clsControl(ccsLabel, "StainOxideNote", "StainOxideNote", ccsMemo, "", CCGetRequestParam("StainOxideNote", ccsGet, NULL), $this);
        $this->Glaze1 = new clsControl(ccsLabel, "Glaze1", "Glaze1", ccsText, "", CCGetRequestParam("Glaze1", ccsGet, NULL), $this);
        $this->Glaze2 = new clsControl(ccsLabel, "Glaze2", "Glaze2", ccsText, "", CCGetRequestParam("Glaze2", ccsGet, NULL), $this);
        $this->Glaze3 = new clsControl(ccsLabel, "Glaze3", "Glaze3", ccsText, "", CCGetRequestParam("Glaze3", ccsGet, NULL), $this);
        $this->Glaze4 = new clsControl(ccsLabel, "Glaze4", "Glaze4", ccsText, "", CCGetRequestParam("Glaze4", ccsGet, NULL), $this);
        $this->GlazeDensity1 = new clsControl(ccsLabel, "GlazeDensity1", "GlazeDensity1", ccsText, "", CCGetRequestParam("GlazeDensity1", ccsGet, NULL), $this);
        $this->GlazeDensity2 = new clsControl(ccsLabel, "GlazeDensity2", "GlazeDensity2", ccsText, "", CCGetRequestParam("GlazeDensity2", ccsGet, NULL), $this);
        $this->GlazeDensity3 = new clsControl(ccsLabel, "GlazeDensity3", "GlazeDensity3", ccsText, "", CCGetRequestParam("GlazeDensity3", ccsGet, NULL), $this);
        $this->GlazeDensity4 = new clsControl(ccsLabel, "GlazeDensity4", "GlazeDensity4", ccsText, "", CCGetRequestParam("GlazeDensity4", ccsGet, NULL), $this);
        $this->GlazeNote = new clsControl(ccsLabel, "GlazeNote", "GlazeNote", ccsMemo, "", CCGetRequestParam("GlazeNote", ccsGet, NULL), $this);
        $this->GlazeTemp = new clsControl(ccsLabel, "GlazeTemp", "GlazeTemp", ccsText, "", CCGetRequestParam("GlazeTemp", ccsGet, NULL), $this);
        $this->Firing = new clsControl(ccsLabel, "Firing", "Firing", ccsText, "", CCGetRequestParam("Firing", ccsGet, NULL), $this);
        $this->FiringNote = new clsControl(ccsLabel, "FiringNote", "FiringNote", ccsMemo, "", CCGetRequestParam("FiringNote", ccsGet, NULL), $this);
        $this->Width = new clsControl(ccsLabel, "Width", "Width", ccsFloat, "", CCGetRequestParam("Width", ccsGet, NULL), $this);
        $this->Height = new clsControl(ccsLabel, "Height", "Height", ccsFloat, "", CCGetRequestParam("Height", ccsGet, NULL), $this);
        $this->Length = new clsControl(ccsLabel, "Length", "Length", ccsFloat, "", CCGetRequestParam("Length", ccsGet, NULL), $this);
        $this->Diameter = new clsControl(ccsLabel, "Diameter", "Diameter", ccsFloat, "", CCGetRequestParam("Diameter", ccsGet, NULL), $this);
        $this->SampCeramicVolume = new clsControl(ccsLabel, "SampCeramicVolume", "SampCeramicVolume", ccsFloat, "", CCGetRequestParam("SampCeramicVolume", ccsGet, NULL), $this);
        $this->FinalSizeNote = new clsControl(ccsLabel, "FinalSizeNote", "FinalSizeNote", ccsMemo, "", CCGetRequestParam("FinalSizeNote", ccsGet, NULL), $this);
        $this->DesignMat1 = new clsControl(ccsLabel, "DesignMat1", "DesignMat1", ccsText, "", CCGetRequestParam("DesignMat1", ccsGet, NULL), $this);
        $this->DesignMat2 = new clsControl(ccsLabel, "DesignMat2", "DesignMat2", ccsText, "", CCGetRequestParam("DesignMat2", ccsGet, NULL), $this);
        $this->DesignMat3 = new clsControl(ccsLabel, "DesignMat3", "DesignMat3", ccsText, "", CCGetRequestParam("DesignMat3", ccsGet, NULL), $this);
        $this->DesignMat4 = new clsControl(ccsLabel, "DesignMat4", "DesignMat4", ccsText, "", CCGetRequestParam("DesignMat4", ccsGet, NULL), $this);
        $this->DesignMatQty1 = new clsControl(ccsLabel, "DesignMatQty1", "DesignMatQty1", ccsInteger, "", CCGetRequestParam("DesignMatQty1", ccsGet, NULL), $this);
        $this->DesignMatQty2 = new clsControl(ccsLabel, "DesignMatQty2", "DesignMatQty2", ccsInteger, "", CCGetRequestParam("DesignMatQty2", ccsGet, NULL), $this);
        $this->DesignMatQty3 = new clsControl(ccsLabel, "DesignMatQty3", "DesignMatQty3", ccsInteger, "", CCGetRequestParam("DesignMatQty3", ccsGet, NULL), $this);
        $this->DesignMatQty4 = new clsControl(ccsLabel, "DesignMatQty4", "DesignMatQty4", ccsInteger, "", CCGetRequestParam("DesignMatQty4", ccsGet, NULL), $this);
        $this->DesignMatNote = new clsControl(ccsLabel, "DesignMatNote", "DesignMatNote", ccsMemo, "", CCGetRequestParam("DesignMatNote", ccsGet, NULL), $this);
        $this->History = new clsControl(ccsLabel, "History", "History", ccsMemo, "", CCGetRequestParam("History", ccsGet, NULL), $this);
        $this->ClayType = new clsControl(ccsLabel, "ClayType", "ClayType", ccsText, "", CCGetRequestParam("ClayType", ccsGet, NULL), $this);
        $this->ClayCost = new clsControl(ccsLabel, "ClayCost", "ClayCost", ccsFloat, "", CCGetRequestParam("ClayCost", ccsGet, NULL), $this);
        $this->ClayPreparationMinute = new clsControl(ccsLabel, "ClayPreparationMinute", "ClayPreparationMinute", ccsInteger, "", CCGetRequestParam("ClayPreparationMinute", ccsGet, NULL), $this);
        $this->ClayPreparationCost = new clsControl(ccsLabel, "ClayPreparationCost", "ClayPreparationCost", ccsFloat, "", CCGetRequestParam("ClayPreparationCost", ccsGet, NULL), $this);
        $this->WheelMinute = new clsControl(ccsLabel, "WheelMinute", "WheelMinute", ccsInteger, "", CCGetRequestParam("WheelMinute", ccsGet, NULL), $this);
        $this->WheelCost = new clsControl(ccsLabel, "WheelCost", "WheelCost", ccsFloat, "", CCGetRequestParam("WheelCost", ccsGet, NULL), $this);
        $this->SlabMinute = new clsControl(ccsLabel, "SlabMinute", "SlabMinute", ccsInteger, "", CCGetRequestParam("SlabMinute", ccsGet, NULL), $this);
        $this->SlabCost = new clsControl(ccsLabel, "SlabCost", "SlabCost", ccsFloat, "", CCGetRequestParam("SlabCost", ccsGet, NULL), $this);
        $this->CastingMinute = new clsControl(ccsLabel, "CastingMinute", "CastingMinute", ccsInteger, "", CCGetRequestParam("CastingMinute", ccsGet, NULL), $this);
        $this->CastingCost = new clsControl(ccsLabel, "CastingCost", "CastingCost", ccsInteger, "", CCGetRequestParam("CastingCost", ccsGet, NULL), $this);
        $this->FinishingMinute = new clsControl(ccsLabel, "FinishingMinute", "FinishingMinute", ccsInteger, "", CCGetRequestParam("FinishingMinute", ccsGet, NULL), $this);
        $this->FinishingCost = new clsControl(ccsLabel, "FinishingCost", "FinishingCost", ccsFloat, "", CCGetRequestParam("FinishingCost", ccsGet, NULL), $this);
        $this->GlazingMinute = new clsControl(ccsLabel, "GlazingMinute", "GlazingMinute", ccsInteger, "", CCGetRequestParam("GlazingMinute", ccsGet, NULL), $this);
        $this->GlazingCost = new clsControl(ccsLabel, "GlazingCost", "GlazingCost", ccsFloat, "", CCGetRequestParam("GlazingCost", ccsGet, NULL), $this);
        $this->StandardBisqueLoading = new clsControl(ccsLabel, "StandardBisqueLoading", "StandardBisqueLoading", ccsInteger, "", CCGetRequestParam("StandardBisqueLoading", ccsGet, NULL), $this);
        $this->StandardBisqueCost = new clsControl(ccsLabel, "StandardBisqueCost", "StandardBisqueCost", ccsFloat, "", CCGetRequestParam("StandardBisqueCost", ccsGet, NULL), $this);
        $this->StandardGlazeLoading = new clsControl(ccsLabel, "StandardGlazeLoading", "StandardGlazeLoading", ccsInteger, "", CCGetRequestParam("StandardGlazeLoading", ccsGet, NULL), $this);
        $this->StandardGlazeCost = new clsControl(ccsLabel, "StandardGlazeCost", "StandardGlazeCost", ccsFloat, "", CCGetRequestParam("StandardGlazeCost", ccsGet, NULL), $this);
        $this->RakuBisqueLoading = new clsControl(ccsLabel, "RakuBisqueLoading", "RakuBisqueLoading", ccsInteger, "", CCGetRequestParam("RakuBisqueLoading", ccsGet, NULL), $this);
        $this->RakuBisqueCost = new clsControl(ccsLabel, "RakuBisqueCost", "RakuBisqueCost", ccsFloat, "", CCGetRequestParam("RakuBisqueCost", ccsGet, NULL), $this);
        $this->RakuGlazeLoading = new clsControl(ccsLabel, "RakuGlazeLoading", "RakuGlazeLoading", ccsInteger, "", CCGetRequestParam("RakuGlazeLoading", ccsGet, NULL), $this);
        $this->RakuGlazeCost = new clsControl(ccsLabel, "RakuGlazeCost", "RakuGlazeCost", ccsFloat, "", CCGetRequestParam("RakuGlazeCost", ccsGet, NULL), $this);
        $this->MovementMinute = new clsControl(ccsLabel, "MovementMinute", "MovementMinute", ccsInteger, "", CCGetRequestParam("MovementMinute", ccsGet, NULL), $this);
        $this->MovementCost = new clsControl(ccsLabel, "MovementCost", "MovementCost", ccsFloat, "", CCGetRequestParam("MovementCost", ccsGet, NULL), $this);
        $this->PackagingWorkMinute = new clsControl(ccsLabel, "PackagingWorkMinute", "PackagingWorkMinute", ccsInteger, "", CCGetRequestParam("PackagingWorkMinute", ccsGet, NULL), $this);
        $this->PackagingWorkCost = new clsControl(ccsLabel, "PackagingWorkCost", "PackagingWorkCost", ccsFloat, "", CCGetRequestParam("PackagingWorkCost", ccsGet, NULL), $this);
        $this->ClayPreparationPPH = new clsControl(ccsLabel, "ClayPreparationPPH", "ClayPreparationPPH", ccsInteger, "", CCGetRequestParam("ClayPreparationPPH", ccsGet, NULL), $this);
        $this->WheelPPH = new clsControl(ccsLabel, "WheelPPH", "WheelPPH", ccsInteger, "", CCGetRequestParam("WheelPPH", ccsGet, NULL), $this);
        $this->SlabPPH = new clsControl(ccsLabel, "SlabPPH", "SlabPPH", ccsInteger, "", CCGetRequestParam("SlabPPH", ccsGet, NULL), $this);
        $this->CastingPPH = new clsControl(ccsLabel, "CastingPPH", "CastingPPH", ccsInteger, "", CCGetRequestParam("CastingPPH", ccsGet, NULL), $this);
        $this->FinishingPPH = new clsControl(ccsLabel, "FinishingPPH", "FinishingPPH", ccsInteger, "", CCGetRequestParam("FinishingPPH", ccsGet, NULL), $this);
        $this->GlazingPPH = new clsControl(ccsLabel, "GlazingPPH", "GlazingPPH", ccsInteger, "", CCGetRequestParam("GlazingPPH", ccsGet, NULL), $this);
        $this->MovementPPH = new clsControl(ccsLabel, "MovementPPH", "MovementPPH", ccsInteger, "", CCGetRequestParam("MovementPPH", ccsGet, NULL), $this);
        $this->PackagingWorkPPH = new clsControl(ccsLabel, "PackagingWorkPPH", "PackagingWorkPPH", ccsInteger, "", CCGetRequestParam("PackagingWorkPPH", ccsGet, NULL), $this);
        $this->TotalAllCost = new clsControl(ccsLabel, "TotalAllCost", "TotalAllCost", ccsFloat, "", CCGetRequestParam("TotalAllCost", ccsGet, NULL), $this);
        $this->RiskPrice = new clsControl(ccsLabel, "RiskPrice", "RiskPrice", ccsFloat, "", CCGetRequestParam("RiskPrice", ccsGet, NULL), $this);
        $this->HypoSellingPrice = new clsControl(ccsLabel, "HypoSellingPrice", "HypoSellingPrice", ccsFloat, "", CCGetRequestParam("HypoSellingPrice", ccsGet, NULL), $this);
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

//Show Method @2-5AA3D157
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
            $this->ControlsVisible["ClientCode"] = $this->ClientCode->Visible;
            $this->ControlsVisible["ClientDescription"] = $this->ClientDescription->Visible;
            $this->ControlsVisible["SampleDate"] = $this->SampleDate->Visible;
            $this->ControlsVisible["TechDraw"] = $this->TechDraw->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["Photo2"] = $this->Photo2->Visible;
            $this->ControlsVisible["Photo3"] = $this->Photo3->Visible;
            $this->ControlsVisible["Photo4"] = $this->Photo4->Visible;
            $this->ControlsVisible["Reference"] = $this->Reference->Visible;
            $this->ControlsVisible["ReferenceNote"] = $this->ReferenceNote->Visible;
            $this->ControlsVisible["Clay"] = $this->Clay->Visible;
            $this->ControlsVisible["ClayKG"] = $this->ClayKG->Visible;
            $this->ControlsVisible["ClayNote"] = $this->ClayNote->Visible;
            $this->ControlsVisible["BuildTech"] = $this->BuildTech->Visible;
            $this->ControlsVisible["BuildTechNote"] = $this->BuildTechNote->Visible;
            $this->ControlsVisible["Rim"] = $this->Rim->Visible;
            $this->ControlsVisible["Feet"] = $this->Feet->Visible;
            $this->ControlsVisible["Casting1"] = $this->Casting1->Visible;
            $this->ControlsVisible["Casting2"] = $this->Casting2->Visible;
            $this->ControlsVisible["Casting3"] = $this->Casting3->Visible;
            $this->ControlsVisible["Casting4"] = $this->Casting4->Visible;
            $this->ControlsVisible["CastingNote"] = $this->CastingNote->Visible;
            $this->ControlsVisible["Estruder1"] = $this->Estruder1->Visible;
            $this->ControlsVisible["Estruder2"] = $this->Estruder2->Visible;
            $this->ControlsVisible["Estruder3"] = $this->Estruder3->Visible;
            $this->ControlsVisible["Estruder4"] = $this->Estruder4->Visible;
            $this->ControlsVisible["EstruderNote"] = $this->EstruderNote->Visible;
            $this->ControlsVisible["Texture1"] = $this->Texture1->Visible;
            $this->ControlsVisible["Texture2"] = $this->Texture2->Visible;
            $this->ControlsVisible["Texture3"] = $this->Texture3->Visible;
            $this->ControlsVisible["Texture4"] = $this->Texture4->Visible;
            $this->ControlsVisible["TextureNote"] = $this->TextureNote->Visible;
            $this->ControlsVisible["Tools1"] = $this->Tools1->Visible;
            $this->ControlsVisible["Tools2"] = $this->Tools2->Visible;
            $this->ControlsVisible["Tools3"] = $this->Tools3->Visible;
            $this->ControlsVisible["Tools4"] = $this->Tools4->Visible;
            $this->ControlsVisible["ToolsNote"] = $this->ToolsNote->Visible;
            $this->ControlsVisible["Engobe1"] = $this->Engobe1->Visible;
            $this->ControlsVisible["Engobe2"] = $this->Engobe2->Visible;
            $this->ControlsVisible["Engobe3"] = $this->Engobe3->Visible;
            $this->ControlsVisible["Engobe4"] = $this->Engobe4->Visible;
            $this->ControlsVisible["EngobeNote"] = $this->EngobeNote->Visible;
            $this->ControlsVisible["BisqueTemp"] = $this->BisqueTemp->Visible;
            $this->ControlsVisible["StainOxide1"] = $this->StainOxide1->Visible;
            $this->ControlsVisible["StainOxide2"] = $this->StainOxide2->Visible;
            $this->ControlsVisible["StainOxide3"] = $this->StainOxide3->Visible;
            $this->ControlsVisible["StainOxide4"] = $this->StainOxide4->Visible;
            $this->ControlsVisible["StainOxideNote"] = $this->StainOxideNote->Visible;
            $this->ControlsVisible["Glaze1"] = $this->Glaze1->Visible;
            $this->ControlsVisible["Glaze2"] = $this->Glaze2->Visible;
            $this->ControlsVisible["Glaze3"] = $this->Glaze3->Visible;
            $this->ControlsVisible["Glaze4"] = $this->Glaze4->Visible;
            $this->ControlsVisible["GlazeDensity1"] = $this->GlazeDensity1->Visible;
            $this->ControlsVisible["GlazeDensity2"] = $this->GlazeDensity2->Visible;
            $this->ControlsVisible["GlazeDensity3"] = $this->GlazeDensity3->Visible;
            $this->ControlsVisible["GlazeDensity4"] = $this->GlazeDensity4->Visible;
            $this->ControlsVisible["GlazeNote"] = $this->GlazeNote->Visible;
            $this->ControlsVisible["GlazeTemp"] = $this->GlazeTemp->Visible;
            $this->ControlsVisible["Firing"] = $this->Firing->Visible;
            $this->ControlsVisible["FiringNote"] = $this->FiringNote->Visible;
            $this->ControlsVisible["Width"] = $this->Width->Visible;
            $this->ControlsVisible["Height"] = $this->Height->Visible;
            $this->ControlsVisible["Length"] = $this->Length->Visible;
            $this->ControlsVisible["Diameter"] = $this->Diameter->Visible;
            $this->ControlsVisible["SampCeramicVolume"] = $this->SampCeramicVolume->Visible;
            $this->ControlsVisible["FinalSizeNote"] = $this->FinalSizeNote->Visible;
            $this->ControlsVisible["DesignMat1"] = $this->DesignMat1->Visible;
            $this->ControlsVisible["DesignMat2"] = $this->DesignMat2->Visible;
            $this->ControlsVisible["DesignMat3"] = $this->DesignMat3->Visible;
            $this->ControlsVisible["DesignMat4"] = $this->DesignMat4->Visible;
            $this->ControlsVisible["DesignMatQty1"] = $this->DesignMatQty1->Visible;
            $this->ControlsVisible["DesignMatQty2"] = $this->DesignMatQty2->Visible;
            $this->ControlsVisible["DesignMatQty3"] = $this->DesignMatQty3->Visible;
            $this->ControlsVisible["DesignMatQty4"] = $this->DesignMatQty4->Visible;
            $this->ControlsVisible["DesignMatNote"] = $this->DesignMatNote->Visible;
            $this->ControlsVisible["History"] = $this->History->Visible;
            $this->ControlsVisible["ClayType"] = $this->ClayType->Visible;
            $this->ControlsVisible["ClayCost"] = $this->ClayCost->Visible;
            $this->ControlsVisible["ClayPreparationMinute"] = $this->ClayPreparationMinute->Visible;
            $this->ControlsVisible["ClayPreparationCost"] = $this->ClayPreparationCost->Visible;
            $this->ControlsVisible["WheelMinute"] = $this->WheelMinute->Visible;
            $this->ControlsVisible["WheelCost"] = $this->WheelCost->Visible;
            $this->ControlsVisible["SlabMinute"] = $this->SlabMinute->Visible;
            $this->ControlsVisible["SlabCost"] = $this->SlabCost->Visible;
            $this->ControlsVisible["CastingMinute"] = $this->CastingMinute->Visible;
            $this->ControlsVisible["CastingCost"] = $this->CastingCost->Visible;
            $this->ControlsVisible["FinishingMinute"] = $this->FinishingMinute->Visible;
            $this->ControlsVisible["FinishingCost"] = $this->FinishingCost->Visible;
            $this->ControlsVisible["GlazingMinute"] = $this->GlazingMinute->Visible;
            $this->ControlsVisible["GlazingCost"] = $this->GlazingCost->Visible;
            $this->ControlsVisible["StandardBisqueLoading"] = $this->StandardBisqueLoading->Visible;
            $this->ControlsVisible["StandardBisqueCost"] = $this->StandardBisqueCost->Visible;
            $this->ControlsVisible["StandardGlazeLoading"] = $this->StandardGlazeLoading->Visible;
            $this->ControlsVisible["StandardGlazeCost"] = $this->StandardGlazeCost->Visible;
            $this->ControlsVisible["RakuBisqueLoading"] = $this->RakuBisqueLoading->Visible;
            $this->ControlsVisible["RakuBisqueCost"] = $this->RakuBisqueCost->Visible;
            $this->ControlsVisible["RakuGlazeLoading"] = $this->RakuGlazeLoading->Visible;
            $this->ControlsVisible["RakuGlazeCost"] = $this->RakuGlazeCost->Visible;
            $this->ControlsVisible["MovementMinute"] = $this->MovementMinute->Visible;
            $this->ControlsVisible["MovementCost"] = $this->MovementCost->Visible;
            $this->ControlsVisible["PackagingWorkMinute"] = $this->PackagingWorkMinute->Visible;
            $this->ControlsVisible["PackagingWorkCost"] = $this->PackagingWorkCost->Visible;
            $this->ControlsVisible["ClayPreparationPPH"] = $this->ClayPreparationPPH->Visible;
            $this->ControlsVisible["WheelPPH"] = $this->WheelPPH->Visible;
            $this->ControlsVisible["SlabPPH"] = $this->SlabPPH->Visible;
            $this->ControlsVisible["CastingPPH"] = $this->CastingPPH->Visible;
            $this->ControlsVisible["FinishingPPH"] = $this->FinishingPPH->Visible;
            $this->ControlsVisible["GlazingPPH"] = $this->GlazingPPH->Visible;
            $this->ControlsVisible["MovementPPH"] = $this->MovementPPH->Visible;
            $this->ControlsVisible["PackagingWorkPPH"] = $this->PackagingWorkPPH->Visible;
            $this->ControlsVisible["TotalAllCost"] = $this->TotalAllCost->Visible;
            $this->ControlsVisible["RiskPrice"] = $this->RiskPrice->Visible;
            $this->ControlsVisible["HypoSellingPrice"] = $this->HypoSellingPrice->Visible;
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
                $this->ClientCode->SetValue($this->DataSource->ClientCode->GetValue());
                $this->ClientDescription->SetValue($this->DataSource->ClientDescription->GetValue());
                $this->SampleDate->SetValue($this->DataSource->SampleDate->GetValue());
                $this->TechDraw->SetValue($this->DataSource->TechDraw->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->Photo2->SetValue($this->DataSource->Photo2->GetValue());
                $this->Photo3->SetValue($this->DataSource->Photo3->GetValue());
                $this->Photo4->SetValue($this->DataSource->Photo4->GetValue());
                $this->Reference->SetValue($this->DataSource->Reference->GetValue());
                $this->ReferenceNote->SetValue($this->DataSource->ReferenceNote->GetValue());
                $this->Clay->SetValue($this->DataSource->Clay->GetValue());
                $this->ClayKG->SetValue($this->DataSource->ClayKG->GetValue());
                $this->ClayNote->SetValue($this->DataSource->ClayNote->GetValue());
                $this->BuildTech->SetValue($this->DataSource->BuildTech->GetValue());
                $this->BuildTechNote->SetValue($this->DataSource->BuildTechNote->GetValue());
                $this->Rim->SetValue($this->DataSource->Rim->GetValue());
                $this->Feet->SetValue($this->DataSource->Feet->GetValue());
                $this->Casting1->SetValue($this->DataSource->Casting1->GetValue());
                $this->Casting2->SetValue($this->DataSource->Casting2->GetValue());
                $this->Casting3->SetValue($this->DataSource->Casting3->GetValue());
                $this->Casting4->SetValue($this->DataSource->Casting4->GetValue());
                $this->CastingNote->SetValue($this->DataSource->CastingNote->GetValue());
                $this->Estruder1->SetValue($this->DataSource->Estruder1->GetValue());
                $this->Estruder2->SetValue($this->DataSource->Estruder2->GetValue());
                $this->Estruder3->SetValue($this->DataSource->Estruder3->GetValue());
                $this->Estruder4->SetValue($this->DataSource->Estruder4->GetValue());
                $this->EstruderNote->SetValue($this->DataSource->EstruderNote->GetValue());
                $this->Texture1->SetValue($this->DataSource->Texture1->GetValue());
                $this->Texture2->SetValue($this->DataSource->Texture2->GetValue());
                $this->Texture3->SetValue($this->DataSource->Texture3->GetValue());
                $this->Texture4->SetValue($this->DataSource->Texture4->GetValue());
                $this->TextureNote->SetValue($this->DataSource->TextureNote->GetValue());
                $this->Tools1->SetValue($this->DataSource->Tools1->GetValue());
                $this->Tools2->SetValue($this->DataSource->Tools2->GetValue());
                $this->Tools3->SetValue($this->DataSource->Tools3->GetValue());
                $this->Tools4->SetValue($this->DataSource->Tools4->GetValue());
                $this->ToolsNote->SetValue($this->DataSource->ToolsNote->GetValue());
                $this->Engobe1->SetValue($this->DataSource->Engobe1->GetValue());
                $this->Engobe2->SetValue($this->DataSource->Engobe2->GetValue());
                $this->Engobe3->SetValue($this->DataSource->Engobe3->GetValue());
                $this->Engobe4->SetValue($this->DataSource->Engobe4->GetValue());
                $this->EngobeNote->SetValue($this->DataSource->EngobeNote->GetValue());
                $this->BisqueTemp->SetValue($this->DataSource->BisqueTemp->GetValue());
                $this->StainOxide1->SetValue($this->DataSource->StainOxide1->GetValue());
                $this->StainOxide2->SetValue($this->DataSource->StainOxide2->GetValue());
                $this->StainOxide3->SetValue($this->DataSource->StainOxide3->GetValue());
                $this->StainOxide4->SetValue($this->DataSource->StainOxide4->GetValue());
                $this->StainOxideNote->SetValue($this->DataSource->StainOxideNote->GetValue());
                $this->Glaze1->SetValue($this->DataSource->Glaze1->GetValue());
                $this->Glaze2->SetValue($this->DataSource->Glaze2->GetValue());
                $this->Glaze3->SetValue($this->DataSource->Glaze3->GetValue());
                $this->Glaze4->SetValue($this->DataSource->Glaze4->GetValue());
                $this->GlazeDensity1->SetValue($this->DataSource->GlazeDensity1->GetValue());
                $this->GlazeDensity2->SetValue($this->DataSource->GlazeDensity2->GetValue());
                $this->GlazeDensity3->SetValue($this->DataSource->GlazeDensity3->GetValue());
                $this->GlazeDensity4->SetValue($this->DataSource->GlazeDensity4->GetValue());
                $this->GlazeNote->SetValue($this->DataSource->GlazeNote->GetValue());
                $this->GlazeTemp->SetValue($this->DataSource->GlazeTemp->GetValue());
                $this->Firing->SetValue($this->DataSource->Firing->GetValue());
                $this->FiringNote->SetValue($this->DataSource->FiringNote->GetValue());
                $this->Width->SetValue($this->DataSource->Width->GetValue());
                $this->Height->SetValue($this->DataSource->Height->GetValue());
                $this->Length->SetValue($this->DataSource->Length->GetValue());
                $this->Diameter->SetValue($this->DataSource->Diameter->GetValue());
                $this->SampCeramicVolume->SetValue($this->DataSource->SampCeramicVolume->GetValue());
                $this->FinalSizeNote->SetValue($this->DataSource->FinalSizeNote->GetValue());
                $this->DesignMat1->SetValue($this->DataSource->DesignMat1->GetValue());
                $this->DesignMat2->SetValue($this->DataSource->DesignMat2->GetValue());
                $this->DesignMat3->SetValue($this->DataSource->DesignMat3->GetValue());
                $this->DesignMat4->SetValue($this->DataSource->DesignMat4->GetValue());
                $this->DesignMatQty1->SetValue($this->DataSource->DesignMatQty1->GetValue());
                $this->DesignMatQty2->SetValue($this->DataSource->DesignMatQty2->GetValue());
                $this->DesignMatQty3->SetValue($this->DataSource->DesignMatQty3->GetValue());
                $this->DesignMatQty4->SetValue($this->DataSource->DesignMatQty4->GetValue());
                $this->DesignMatNote->SetValue($this->DataSource->DesignMatNote->GetValue());
                $this->History->SetValue($this->DataSource->History->GetValue());
                $this->ClayType->SetValue($this->DataSource->ClayType->GetValue());
                $this->ClayCost->SetValue($this->DataSource->ClayCost->GetValue());
                $this->ClayPreparationMinute->SetValue($this->DataSource->ClayPreparationMinute->GetValue());
                $this->ClayPreparationCost->SetValue($this->DataSource->ClayPreparationCost->GetValue());
                $this->WheelMinute->SetValue($this->DataSource->WheelMinute->GetValue());
                $this->WheelCost->SetValue($this->DataSource->WheelCost->GetValue());
                $this->SlabMinute->SetValue($this->DataSource->SlabMinute->GetValue());
                $this->SlabCost->SetValue($this->DataSource->SlabCost->GetValue());
                $this->CastingMinute->SetValue($this->DataSource->CastingMinute->GetValue());
                $this->CastingCost->SetValue($this->DataSource->CastingCost->GetValue());
                $this->FinishingMinute->SetValue($this->DataSource->FinishingMinute->GetValue());
                $this->FinishingCost->SetValue($this->DataSource->FinishingCost->GetValue());
                $this->GlazingMinute->SetValue($this->DataSource->GlazingMinute->GetValue());
                $this->GlazingCost->SetValue($this->DataSource->GlazingCost->GetValue());
                $this->StandardBisqueLoading->SetValue($this->DataSource->StandardBisqueLoading->GetValue());
                $this->StandardBisqueCost->SetValue($this->DataSource->StandardBisqueCost->GetValue());
                $this->StandardGlazeLoading->SetValue($this->DataSource->StandardGlazeLoading->GetValue());
                $this->StandardGlazeCost->SetValue($this->DataSource->StandardGlazeCost->GetValue());
                $this->RakuBisqueLoading->SetValue($this->DataSource->RakuBisqueLoading->GetValue());
                $this->RakuBisqueCost->SetValue($this->DataSource->RakuBisqueCost->GetValue());
                $this->RakuGlazeLoading->SetValue($this->DataSource->RakuGlazeLoading->GetValue());
                $this->RakuGlazeCost->SetValue($this->DataSource->RakuGlazeCost->GetValue());
                $this->MovementMinute->SetValue($this->DataSource->MovementMinute->GetValue());
                $this->MovementCost->SetValue($this->DataSource->MovementCost->GetValue());
                $this->PackagingWorkMinute->SetValue($this->DataSource->PackagingWorkMinute->GetValue());
                $this->PackagingWorkCost->SetValue($this->DataSource->PackagingWorkCost->GetValue());
                $this->ClayPreparationPPH->SetValue($this->DataSource->ClayPreparationPPH->GetValue());
                $this->WheelPPH->SetValue($this->DataSource->WheelPPH->GetValue());
                $this->SlabPPH->SetValue($this->DataSource->SlabPPH->GetValue());
                $this->CastingPPH->SetValue($this->DataSource->CastingPPH->GetValue());
                $this->FinishingPPH->SetValue($this->DataSource->FinishingPPH->GetValue());
                $this->GlazingPPH->SetValue($this->DataSource->GlazingPPH->GetValue());
                $this->MovementPPH->SetValue($this->DataSource->MovementPPH->GetValue());
                $this->PackagingWorkPPH->SetValue($this->DataSource->PackagingWorkPPH->GetValue());
                $this->TotalAllCost->SetValue($this->DataSource->TotalAllCost->GetValue());
                $this->RiskPrice->SetValue($this->DataSource->RiskPrice->GetValue());
                $this->HypoSellingPrice->SetValue($this->DataSource->HypoSellingPrice->GetValue());
                $this->RealSellingPrice->SetValue($this->DataSource->RealSellingPrice->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->sID->Show();
                $this->SampleCode->Show();
                $this->SampleDescription->Show();
                $this->ClientCode->Show();
                $this->ClientDescription->Show();
                $this->SampleDate->Show();
                $this->TechDraw->Show();
                $this->Photo1->Show();
                $this->Photo2->Show();
                $this->Photo3->Show();
                $this->Photo4->Show();
                $this->Reference->Show();
                $this->ReferenceNote->Show();
                $this->Clay->Show();
                $this->ClayKG->Show();
                $this->ClayNote->Show();
                $this->BuildTech->Show();
                $this->BuildTechNote->Show();
                $this->Rim->Show();
                $this->Feet->Show();
                $this->Casting1->Show();
                $this->Casting2->Show();
                $this->Casting3->Show();
                $this->Casting4->Show();
                $this->CastingNote->Show();
                $this->Estruder1->Show();
                $this->Estruder2->Show();
                $this->Estruder3->Show();
                $this->Estruder4->Show();
                $this->EstruderNote->Show();
                $this->Texture1->Show();
                $this->Texture2->Show();
                $this->Texture3->Show();
                $this->Texture4->Show();
                $this->TextureNote->Show();
                $this->Tools1->Show();
                $this->Tools2->Show();
                $this->Tools3->Show();
                $this->Tools4->Show();
                $this->ToolsNote->Show();
                $this->Engobe1->Show();
                $this->Engobe2->Show();
                $this->Engobe3->Show();
                $this->Engobe4->Show();
                $this->EngobeNote->Show();
                $this->BisqueTemp->Show();
                $this->StainOxide1->Show();
                $this->StainOxide2->Show();
                $this->StainOxide3->Show();
                $this->StainOxide4->Show();
                $this->StainOxideNote->Show();
                $this->Glaze1->Show();
                $this->Glaze2->Show();
                $this->Glaze3->Show();
                $this->Glaze4->Show();
                $this->GlazeDensity1->Show();
                $this->GlazeDensity2->Show();
                $this->GlazeDensity3->Show();
                $this->GlazeDensity4->Show();
                $this->GlazeNote->Show();
                $this->GlazeTemp->Show();
                $this->Firing->Show();
                $this->FiringNote->Show();
                $this->Width->Show();
                $this->Height->Show();
                $this->Length->Show();
                $this->Diameter->Show();
                $this->SampCeramicVolume->Show();
                $this->FinalSizeNote->Show();
                $this->DesignMat1->Show();
                $this->DesignMat2->Show();
                $this->DesignMat3->Show();
                $this->DesignMat4->Show();
                $this->DesignMatQty1->Show();
                $this->DesignMatQty2->Show();
                $this->DesignMatQty3->Show();
                $this->DesignMatQty4->Show();
                $this->DesignMatNote->Show();
                $this->History->Show();
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

//GetErrors Method @2-48D0EFAE
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->sID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SampleCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SampleDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SampleDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TechDraw->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Reference->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReferenceNote->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Clay->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClayKG->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClayNote->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BuildTech->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BuildTechNote->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Rim->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Feet->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Casting1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Casting2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Casting3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Casting4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CastingNote->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Estruder1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Estruder2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Estruder3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Estruder4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->EstruderNote->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Texture1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Texture2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Texture3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Texture4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureNote->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Tools1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Tools2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Tools3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Tools4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ToolsNote->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Engobe1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Engobe2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Engobe3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Engobe4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->EngobeNote->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BisqueTemp->Errors->ToString());
        $errors = ComposeStrings($errors, $this->StainOxide1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->StainOxide2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->StainOxide3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->StainOxide4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->StainOxideNote->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Glaze1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Glaze2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Glaze3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Glaze4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GlazeDensity1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GlazeDensity2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GlazeDensity3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GlazeDensity4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GlazeNote->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GlazeTemp->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Firing->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FiringNote->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Width->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Height->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Length->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Diameter->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SampCeramicVolume->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FinalSizeNote->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMat1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMat2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMat3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMat4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMatQty1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMatQty2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMatQty3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMatQty4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMatNote->Errors->ToString());
        $errors = ComposeStrings($errors, $this->History->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClayType->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClayCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClayPreparationMinute->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClayPreparationCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->WheelMinute->Errors->ToString());
        $errors = ComposeStrings($errors, $this->WheelCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SlabMinute->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SlabCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CastingMinute->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CastingCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FinishingMinute->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FinishingCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GlazingMinute->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GlazingCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->StandardBisqueLoading->Errors->ToString());
        $errors = ComposeStrings($errors, $this->StandardBisqueCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->StandardGlazeLoading->Errors->ToString());
        $errors = ComposeStrings($errors, $this->StandardGlazeCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RakuBisqueLoading->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RakuBisqueCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RakuGlazeLoading->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RakuGlazeCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MovementMinute->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MovementCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PackagingWorkMinute->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PackagingWorkCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClayPreparationPPH->Errors->ToString());
        $errors = ComposeStrings($errors, $this->WheelPPH->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SlabPPH->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CastingPPH->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FinishingPPH->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GlazingPPH->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MovementPPH->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PackagingWorkPPH->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalAllCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RiskPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->HypoSellingPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RealSellingPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End sampleceramic Class @2-FCB6E20C

class clssampleceramicDataSource extends clsDBGayaFusionAll {  //sampleceramicDataSource Class @2-A88B2429

//DataSource Variables @2-CE481181
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
    public $ClientCode;
    public $ClientDescription;
    public $SampleDate;
    public $TechDraw;
    public $Photo1;
    public $Photo2;
    public $Photo3;
    public $Photo4;
    public $Reference;
    public $ReferenceNote;
    public $Clay;
    public $ClayKG;
    public $ClayNote;
    public $BuildTech;
    public $BuildTechNote;
    public $Rim;
    public $Feet;
    public $Casting1;
    public $Casting2;
    public $Casting3;
    public $Casting4;
    public $CastingNote;
    public $Estruder1;
    public $Estruder2;
    public $Estruder3;
    public $Estruder4;
    public $EstruderNote;
    public $Texture1;
    public $Texture2;
    public $Texture3;
    public $Texture4;
    public $TextureNote;
    public $Tools1;
    public $Tools2;
    public $Tools3;
    public $Tools4;
    public $ToolsNote;
    public $Engobe1;
    public $Engobe2;
    public $Engobe3;
    public $Engobe4;
    public $EngobeNote;
    public $BisqueTemp;
    public $StainOxide1;
    public $StainOxide2;
    public $StainOxide3;
    public $StainOxide4;
    public $StainOxideNote;
    public $Glaze1;
    public $Glaze2;
    public $Glaze3;
    public $Glaze4;
    public $GlazeDensity1;
    public $GlazeDensity2;
    public $GlazeDensity3;
    public $GlazeDensity4;
    public $GlazeNote;
    public $GlazeTemp;
    public $Firing;
    public $FiringNote;
    public $Width;
    public $Height;
    public $Length;
    public $Diameter;
    public $SampCeramicVolume;
    public $FinalSizeNote;
    public $DesignMat1;
    public $DesignMat2;
    public $DesignMat3;
    public $DesignMat4;
    public $DesignMatQty1;
    public $DesignMatQty2;
    public $DesignMatQty3;
    public $DesignMatQty4;
    public $DesignMatNote;
    public $History;
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
//End DataSource Variables

//DataSourceClass_Initialize Event @2-C70B8D3F
    function clssampleceramicDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid sampleceramic";
        $this->Initialize();
        $this->sID = new clsField("sID", ccsInteger, "");
        
        $this->SampleCode = new clsField("SampleCode", ccsText, "");
        
        $this->SampleDescription = new clsField("SampleDescription", ccsText, "");
        
        $this->ClientCode = new clsField("ClientCode", ccsText, "");
        
        $this->ClientDescription = new clsField("ClientDescription", ccsText, "");
        
        $this->SampleDate = new clsField("SampleDate", ccsDate, $this->DateFormat);
        
        $this->TechDraw = new clsField("TechDraw", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->Photo2 = new clsField("Photo2", ccsText, "");
        
        $this->Photo3 = new clsField("Photo3", ccsText, "");
        
        $this->Photo4 = new clsField("Photo4", ccsText, "");
        
        $this->Reference = new clsField("Reference", ccsText, "");
        
        $this->ReferenceNote = new clsField("ReferenceNote", ccsMemo, "");
        
        $this->Clay = new clsField("Clay", ccsText, "");
        
        $this->ClayKG = new clsField("ClayKG", ccsFloat, "");
        
        $this->ClayNote = new clsField("ClayNote", ccsMemo, "");
        
        $this->BuildTech = new clsField("BuildTech", ccsText, "");
        
        $this->BuildTechNote = new clsField("BuildTechNote", ccsMemo, "");
        
        $this->Rim = new clsField("Rim", ccsText, "");
        
        $this->Feet = new clsField("Feet", ccsText, "");
        
        $this->Casting1 = new clsField("Casting1", ccsText, "");
        
        $this->Casting2 = new clsField("Casting2", ccsText, "");
        
        $this->Casting3 = new clsField("Casting3", ccsText, "");
        
        $this->Casting4 = new clsField("Casting4", ccsText, "");
        
        $this->CastingNote = new clsField("CastingNote", ccsMemo, "");
        
        $this->Estruder1 = new clsField("Estruder1", ccsText, "");
        
        $this->Estruder2 = new clsField("Estruder2", ccsText, "");
        
        $this->Estruder3 = new clsField("Estruder3", ccsText, "");
        
        $this->Estruder4 = new clsField("Estruder4", ccsText, "");
        
        $this->EstruderNote = new clsField("EstruderNote", ccsMemo, "");
        
        $this->Texture1 = new clsField("Texture1", ccsText, "");
        
        $this->Texture2 = new clsField("Texture2", ccsText, "");
        
        $this->Texture3 = new clsField("Texture3", ccsText, "");
        
        $this->Texture4 = new clsField("Texture4", ccsText, "");
        
        $this->TextureNote = new clsField("TextureNote", ccsMemo, "");
        
        $this->Tools1 = new clsField("Tools1", ccsText, "");
        
        $this->Tools2 = new clsField("Tools2", ccsText, "");
        
        $this->Tools3 = new clsField("Tools3", ccsText, "");
        
        $this->Tools4 = new clsField("Tools4", ccsText, "");
        
        $this->ToolsNote = new clsField("ToolsNote", ccsMemo, "");
        
        $this->Engobe1 = new clsField("Engobe1", ccsText, "");
        
        $this->Engobe2 = new clsField("Engobe2", ccsText, "");
        
        $this->Engobe3 = new clsField("Engobe3", ccsText, "");
        
        $this->Engobe4 = new clsField("Engobe4", ccsText, "");
        
        $this->EngobeNote = new clsField("EngobeNote", ccsMemo, "");
        
        $this->BisqueTemp = new clsField("BisqueTemp", ccsText, "");
        
        $this->StainOxide1 = new clsField("StainOxide1", ccsText, "");
        
        $this->StainOxide2 = new clsField("StainOxide2", ccsText, "");
        
        $this->StainOxide3 = new clsField("StainOxide3", ccsText, "");
        
        $this->StainOxide4 = new clsField("StainOxide4", ccsText, "");
        
        $this->StainOxideNote = new clsField("StainOxideNote", ccsMemo, "");
        
        $this->Glaze1 = new clsField("Glaze1", ccsText, "");
        
        $this->Glaze2 = new clsField("Glaze2", ccsText, "");
        
        $this->Glaze3 = new clsField("Glaze3", ccsText, "");
        
        $this->Glaze4 = new clsField("Glaze4", ccsText, "");
        
        $this->GlazeDensity1 = new clsField("GlazeDensity1", ccsText, "");
        
        $this->GlazeDensity2 = new clsField("GlazeDensity2", ccsText, "");
        
        $this->GlazeDensity3 = new clsField("GlazeDensity3", ccsText, "");
        
        $this->GlazeDensity4 = new clsField("GlazeDensity4", ccsText, "");
        
        $this->GlazeNote = new clsField("GlazeNote", ccsMemo, "");
        
        $this->GlazeTemp = new clsField("GlazeTemp", ccsText, "");
        
        $this->Firing = new clsField("Firing", ccsText, "");
        
        $this->FiringNote = new clsField("FiringNote", ccsMemo, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->Diameter = new clsField("Diameter", ccsFloat, "");
        
        $this->SampCeramicVolume = new clsField("SampCeramicVolume", ccsFloat, "");
        
        $this->FinalSizeNote = new clsField("FinalSizeNote", ccsMemo, "");
        
        $this->DesignMat1 = new clsField("DesignMat1", ccsText, "");
        
        $this->DesignMat2 = new clsField("DesignMat2", ccsText, "");
        
        $this->DesignMat3 = new clsField("DesignMat3", ccsText, "");
        
        $this->DesignMat4 = new clsField("DesignMat4", ccsText, "");
        
        $this->DesignMatQty1 = new clsField("DesignMatQty1", ccsInteger, "");
        
        $this->DesignMatQty2 = new clsField("DesignMatQty2", ccsInteger, "");
        
        $this->DesignMatQty3 = new clsField("DesignMatQty3", ccsInteger, "");
        
        $this->DesignMatQty4 = new clsField("DesignMatQty4", ccsInteger, "");
        
        $this->DesignMatNote = new clsField("DesignMatNote", ccsMemo, "");
        
        $this->History = new clsField("History", ccsMemo, "");
        
        $this->ClayType = new clsField("ClayType", ccsText, "");
        
        $this->ClayCost = new clsField("ClayCost", ccsFloat, "");
        
        $this->ClayPreparationMinute = new clsField("ClayPreparationMinute", ccsInteger, "");
        
        $this->ClayPreparationCost = new clsField("ClayPreparationCost", ccsFloat, "");
        
        $this->WheelMinute = new clsField("WheelMinute", ccsInteger, "");
        
        $this->WheelCost = new clsField("WheelCost", ccsFloat, "");
        
        $this->SlabMinute = new clsField("SlabMinute", ccsInteger, "");
        
        $this->SlabCost = new clsField("SlabCost", ccsFloat, "");
        
        $this->CastingMinute = new clsField("CastingMinute", ccsInteger, "");
        
        $this->CastingCost = new clsField("CastingCost", ccsInteger, "");
        
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

//Prepare Method @2-7A4BFD8C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlkeyword", ccsInteger, "", "", $this->Parameters["urlkeyword"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "sID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
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

//SetValues Method @2-C7CB3E87
    function SetValues()
    {
        $this->sID->SetDBValue(trim($this->f("sID")));
        $this->SampleCode->SetDBValue($this->f("SampleCode"));
        $this->SampleDescription->SetDBValue($this->f("SampleDescription"));
        $this->ClientCode->SetDBValue($this->f("ClientCode"));
        $this->ClientDescription->SetDBValue($this->f("ClientDescription"));
        $this->SampleDate->SetDBValue(trim($this->f("SampleDate")));
        $this->TechDraw->SetDBValue($this->f("TechDraw"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->Photo2->SetDBValue($this->f("Photo2"));
        $this->Photo3->SetDBValue($this->f("Photo3"));
        $this->Photo4->SetDBValue($this->f("Photo4"));
        $this->Reference->SetDBValue($this->f("Reference"));
        $this->ReferenceNote->SetDBValue($this->f("ReferenceNote"));
        $this->Clay->SetDBValue($this->f("Clay"));
        $this->ClayKG->SetDBValue(trim($this->f("ClayKG")));
        $this->ClayNote->SetDBValue($this->f("ClayNote"));
        $this->BuildTech->SetDBValue($this->f("BuildTech"));
        $this->BuildTechNote->SetDBValue($this->f("BuildTechNote"));
        $this->Rim->SetDBValue($this->f("Rim"));
        $this->Feet->SetDBValue($this->f("Feet"));
        $this->Casting1->SetDBValue($this->f("Casting1"));
        $this->Casting2->SetDBValue($this->f("Casting2"));
        $this->Casting3->SetDBValue($this->f("Casting3"));
        $this->Casting4->SetDBValue($this->f("Casting4"));
        $this->CastingNote->SetDBValue($this->f("CastingNote"));
        $this->Estruder1->SetDBValue($this->f("Estruder1"));
        $this->Estruder2->SetDBValue($this->f("Estruder2"));
        $this->Estruder3->SetDBValue($this->f("Estruder3"));
        $this->Estruder4->SetDBValue($this->f("Estruder4"));
        $this->EstruderNote->SetDBValue($this->f("EstruderNote"));
        $this->Texture1->SetDBValue($this->f("Texture1"));
        $this->Texture2->SetDBValue($this->f("Texture2"));
        $this->Texture3->SetDBValue($this->f("Texture3"));
        $this->Texture4->SetDBValue($this->f("Texture4"));
        $this->TextureNote->SetDBValue($this->f("TextureNote"));
        $this->Tools1->SetDBValue($this->f("Tools1"));
        $this->Tools2->SetDBValue($this->f("Tools2"));
        $this->Tools3->SetDBValue($this->f("Tools3"));
        $this->Tools4->SetDBValue($this->f("Tools4"));
        $this->ToolsNote->SetDBValue($this->f("ToolsNote"));
        $this->Engobe1->SetDBValue($this->f("Engobe1"));
        $this->Engobe2->SetDBValue($this->f("Engobe2"));
        $this->Engobe3->SetDBValue($this->f("Engobe3"));
        $this->Engobe4->SetDBValue($this->f("Engobe4"));
        $this->EngobeNote->SetDBValue($this->f("EngobeNote"));
        $this->BisqueTemp->SetDBValue($this->f("BisqueTemp"));
        $this->StainOxide1->SetDBValue($this->f("StainOxide1"));
        $this->StainOxide2->SetDBValue($this->f("StainOxide2"));
        $this->StainOxide3->SetDBValue($this->f("StainOxide3"));
        $this->StainOxide4->SetDBValue($this->f("StainOxide4"));
        $this->StainOxideNote->SetDBValue($this->f("StainOxideNote"));
        $this->Glaze1->SetDBValue($this->f("Glaze1"));
        $this->Glaze2->SetDBValue($this->f("Glaze2"));
        $this->Glaze3->SetDBValue($this->f("Glaze3"));
        $this->Glaze4->SetDBValue($this->f("Glaze4"));
        $this->GlazeDensity1->SetDBValue($this->f("GlazeDensity1"));
        $this->GlazeDensity2->SetDBValue($this->f("GlazeDensity2"));
        $this->GlazeDensity3->SetDBValue($this->f("GlazeDensity3"));
        $this->GlazeDensity4->SetDBValue($this->f("GlazeDensity4"));
        $this->GlazeNote->SetDBValue($this->f("GlazeNote"));
        $this->GlazeTemp->SetDBValue($this->f("GlazeTemp"));
        $this->Firing->SetDBValue($this->f("Firing"));
        $this->FiringNote->SetDBValue($this->f("FiringNote"));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
        $this->SampCeramicVolume->SetDBValue(trim($this->f("SampCeramicVolume")));
        $this->FinalSizeNote->SetDBValue($this->f("FinalSizeNote"));
        $this->DesignMat1->SetDBValue($this->f("DesignMat1"));
        $this->DesignMat2->SetDBValue($this->f("DesignMat2"));
        $this->DesignMat3->SetDBValue($this->f("DesignMat3"));
        $this->DesignMat4->SetDBValue($this->f("DesignMat4"));
        $this->DesignMatQty1->SetDBValue(trim($this->f("DesignMatQty1")));
        $this->DesignMatQty2->SetDBValue(trim($this->f("DesignMatQty2")));
        $this->DesignMatQty3->SetDBValue(trim($this->f("DesignMatQty3")));
        $this->DesignMatQty4->SetDBValue(trim($this->f("DesignMatQty4")));
        $this->DesignMatNote->SetDBValue($this->f("DesignMatNote"));
        $this->History->SetDBValue($this->f("History"));
        $this->ClayType->SetDBValue($this->f("ClayType"));
        $this->ClayCost->SetDBValue(trim($this->f("ClayCost")));
        $this->ClayPreparationMinute->SetDBValue(trim($this->f("ClayPreparationMinute")));
        $this->ClayPreparationCost->SetDBValue(trim($this->f("ClayPreparationCost")));
        $this->WheelMinute->SetDBValue(trim($this->f("WheelMinute")));
        $this->WheelCost->SetDBValue(trim($this->f("WheelCost")));
        $this->SlabMinute->SetDBValue(trim($this->f("SlabMinute")));
        $this->SlabCost->SetDBValue(trim($this->f("SlabCost")));
        $this->CastingMinute->SetDBValue(trim($this->f("CastingMinute")));
        $this->CastingCost->SetDBValue(trim($this->f("CastingCost")));
        $this->FinishingMinute->SetDBValue(trim($this->f("FinishingMinute")));
        $this->FinishingCost->SetDBValue(trim($this->f("FinishingCost")));
        $this->GlazingMinute->SetDBValue(trim($this->f("GlazingMinute")));
        $this->GlazingCost->SetDBValue(trim($this->f("GlazingCost")));
        $this->StandardBisqueLoading->SetDBValue(trim($this->f("StandardBisqueLoading")));
        $this->StandardBisqueCost->SetDBValue(trim($this->f("StandardBisqueCost")));
        $this->StandardGlazeLoading->SetDBValue(trim($this->f("StandardGlazeLoading")));
        $this->StandardGlazeCost->SetDBValue(trim($this->f("StandardGlazeCost")));
        $this->RakuBisqueLoading->SetDBValue(trim($this->f("RakuBisqueLoading")));
        $this->RakuBisqueCost->SetDBValue(trim($this->f("RakuBisqueCost")));
        $this->RakuGlazeLoading->SetDBValue(trim($this->f("RakuGlazeLoading")));
        $this->RakuGlazeCost->SetDBValue(trim($this->f("RakuGlazeCost")));
        $this->MovementMinute->SetDBValue(trim($this->f("MovementMinute")));
        $this->MovementCost->SetDBValue(trim($this->f("MovementCost")));
        $this->PackagingWorkMinute->SetDBValue(trim($this->f("PackagingWorkMinute")));
        $this->PackagingWorkCost->SetDBValue(trim($this->f("PackagingWorkCost")));
        $this->ClayPreparationPPH->SetDBValue(trim($this->f("ClayPreparationPPH")));
        $this->WheelPPH->SetDBValue(trim($this->f("WheelPPH")));
        $this->SlabPPH->SetDBValue(trim($this->f("SlabPPH")));
        $this->CastingPPH->SetDBValue(trim($this->f("CastingPPH")));
        $this->FinishingPPH->SetDBValue(trim($this->f("FinishingPPH")));
        $this->GlazingPPH->SetDBValue(trim($this->f("GlazingPPH")));
        $this->MovementPPH->SetDBValue(trim($this->f("MovementPPH")));
        $this->PackagingWorkPPH->SetDBValue(trim($this->f("PackagingWorkPPH")));
        $this->TotalAllCost->SetDBValue(trim($this->f("TotalAllCost")));
        $this->RiskPrice->SetDBValue(trim($this->f("RiskPrice")));
        $this->HypoSellingPrice->SetDBValue(trim($this->f("HypoSellingPrice")));
        $this->RealSellingPrice->SetDBValue(trim($this->f("RealSellingPrice")));
    }
//End SetValues Method

} //End sampleceramicDataSource Class @2-FCB6E20C

//Initialize Page @1-D4F4DA8A
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
$TemplateFileName = "AddQuotation_AddNewDetail_RndCode_PTAutoFill2.html";
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
