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

//Include Common Files @1-B6D528BA
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowSampleCeramic.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordAddSampleCeramic { //AddSampleCeramic Class @2-98F18515

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

//Class_Initialize Event @2-C6A16DE6
    function clsRecordAddSampleCeramic($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record AddSampleCeramic/Error";
        $this->DataSource = new clsAddSampleCeramicDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "AddSampleCeramic";
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
            $this->SampleDescription = new clsControl(ccsLabel, "SampleDescription", "Sample Description", ccsText, "", CCGetRequestParam("SampleDescription", $Method, NULL), $this);
            $this->ClientCode = new clsControl(ccsLabel, "ClientCode", "Client Code", ccsText, "", CCGetRequestParam("ClientCode", $Method, NULL), $this);
            $this->ClientDescription = new clsControl(ccsLabel, "ClientDescription", "Client Description", ccsText, "", CCGetRequestParam("ClientDescription", $Method, NULL), $this);
            $this->TechDraw = new clsControl(ccsImage, "TechDraw", "Tech Draw", ccsText, "", CCGetRequestParam("TechDraw", $Method, NULL), $this);
            $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", $Method, NULL), $this);
            $this->Photo2 = new clsControl(ccsImage, "Photo2", "Photo2", ccsText, "", CCGetRequestParam("Photo2", $Method, NULL), $this);
            $this->Photo3 = new clsControl(ccsImage, "Photo3", "Photo3", ccsText, "", CCGetRequestParam("Photo3", $Method, NULL), $this);
            $this->Photo4 = new clsControl(ccsImage, "Photo4", "Photo4", ccsText, "", CCGetRequestParam("Photo4", $Method, NULL), $this);
            $this->Clay = new clsControl(ccsHidden, "Clay", "Clay", ccsText, "", CCGetRequestParam("Clay", $Method, NULL), $this);
            $this->ClayKG = new clsControl(ccsLabel, "ClayKG", "Clay KG", ccsFloat, "", CCGetRequestParam("ClayKG", $Method, NULL), $this);
            $this->ClayNote = new clsControl(ccsLabel, "ClayNote", "Clay Note", ccsMemo, "", CCGetRequestParam("ClayNote", $Method, NULL), $this);
            $this->BuildTech = new clsControl(ccsLabel, "BuildTech", "Build Tech", ccsText, "", CCGetRequestParam("BuildTech", $Method, NULL), $this);
            $this->BuildTechNote = new clsControl(ccsLabel, "BuildTechNote", "Build Tech Note", ccsMemo, "", CCGetRequestParam("BuildTechNote", $Method, NULL), $this);
            $this->Rim = new clsControl(ccsLabel, "Rim", "Rim", ccsText, "", CCGetRequestParam("Rim", $Method, NULL), $this);
            $this->Feet = new clsControl(ccsLabel, "Feet", "Feet", ccsText, "", CCGetRequestParam("Feet", $Method, NULL), $this);
            $this->Casting1 = new clsControl(ccsHidden, "Casting1", "Casting1", ccsInteger, "", CCGetRequestParam("Casting1", $Method, NULL), $this);
            $this->Casting2 = new clsControl(ccsHidden, "Casting2", "Casting2", ccsInteger, "", CCGetRequestParam("Casting2", $Method, NULL), $this);
            $this->Casting3 = new clsControl(ccsHidden, "Casting3", "Casting3", ccsInteger, "", CCGetRequestParam("Casting3", $Method, NULL), $this);
            $this->Casting4 = new clsControl(ccsHidden, "Casting4", "Casting4", ccsInteger, "", CCGetRequestParam("Casting4", $Method, NULL), $this);
            $this->CastingNote = new clsControl(ccsLabel, "CastingNote", "Casting Note", ccsMemo, "", CCGetRequestParam("CastingNote", $Method, NULL), $this);
            $this->Estruder1 = new clsControl(ccsHidden, "Estruder1", "Estruder1", ccsText, "", CCGetRequestParam("Estruder1", $Method, NULL), $this);
            $this->Estruder2 = new clsControl(ccsHidden, "Estruder2", "Estruder2", ccsText, "", CCGetRequestParam("Estruder2", $Method, NULL), $this);
            $this->Estruder3 = new clsControl(ccsHidden, "Estruder3", "Estruder3", ccsText, "", CCGetRequestParam("Estruder3", $Method, NULL), $this);
            $this->Estruder4 = new clsControl(ccsHidden, "Estruder4", "Estruder4", ccsText, "", CCGetRequestParam("Estruder4", $Method, NULL), $this);
            $this->EstruderNote = new clsControl(ccsLabel, "EstruderNote", "Estruder Note", ccsMemo, "", CCGetRequestParam("EstruderNote", $Method, NULL), $this);
            $this->Texture1 = new clsControl(ccsHidden, "Texture1", "Texture1", ccsText, "", CCGetRequestParam("Texture1", $Method, NULL), $this);
            $this->Texture2 = new clsControl(ccsHidden, "Texture2", "Texture2", ccsText, "", CCGetRequestParam("Texture2", $Method, NULL), $this);
            $this->Texture3 = new clsControl(ccsHidden, "Texture3", "Texture3", ccsText, "", CCGetRequestParam("Texture3", $Method, NULL), $this);
            $this->Texture4 = new clsControl(ccsHidden, "Texture4", "Texture4", ccsText, "", CCGetRequestParam("Texture4", $Method, NULL), $this);
            $this->TextureNote = new clsControl(ccsLabel, "TextureNote", "Texture Note", ccsMemo, "", CCGetRequestParam("TextureNote", $Method, NULL), $this);
            $this->Tools1 = new clsControl(ccsHidden, "Tools1", "Tools1", ccsText, "", CCGetRequestParam("Tools1", $Method, NULL), $this);
            $this->Tools2 = new clsControl(ccsHidden, "Tools2", "Tools2", ccsText, "", CCGetRequestParam("Tools2", $Method, NULL), $this);
            $this->Tools3 = new clsControl(ccsHidden, "Tools3", "Tools3", ccsText, "", CCGetRequestParam("Tools3", $Method, NULL), $this);
            $this->Tools4 = new clsControl(ccsHidden, "Tools4", "Tools4", ccsText, "", CCGetRequestParam("Tools4", $Method, NULL), $this);
            $this->ToolsNote = new clsControl(ccsLabel, "ToolsNote", "Tools Note", ccsMemo, "", CCGetRequestParam("ToolsNote", $Method, NULL), $this);
            $this->Engobe1 = new clsControl(ccsHidden, "Engobe1", "Engobe1", ccsText, "", CCGetRequestParam("Engobe1", $Method, NULL), $this);
            $this->Engobe2 = new clsControl(ccsHidden, "Engobe2", "Engobe2", ccsText, "", CCGetRequestParam("Engobe2", $Method, NULL), $this);
            $this->Engobe3 = new clsControl(ccsHidden, "Engobe3", "Engobe3", ccsText, "", CCGetRequestParam("Engobe3", $Method, NULL), $this);
            $this->Engobe4 = new clsControl(ccsHidden, "Engobe4", "Engobe4", ccsText, "", CCGetRequestParam("Engobe4", $Method, NULL), $this);
            $this->EngobeNote = new clsControl(ccsLabel, "EngobeNote", "Engobe Note", ccsMemo, "", CCGetRequestParam("EngobeNote", $Method, NULL), $this);
            $this->BisqueTemp = new clsControl(ccsLabel, "BisqueTemp", "Bisque Temp", ccsText, "", CCGetRequestParam("BisqueTemp", $Method, NULL), $this);
            $this->StainOxide1 = new clsControl(ccsHidden, "StainOxide1", "Stain Oxide1", ccsText, "", CCGetRequestParam("StainOxide1", $Method, NULL), $this);
            $this->StainOxide2 = new clsControl(ccsHidden, "StainOxide2", "Stain Oxide2", ccsText, "", CCGetRequestParam("StainOxide2", $Method, NULL), $this);
            $this->StainOxide3 = new clsControl(ccsHidden, "StainOxide3", "Stain Oxide3", ccsText, "", CCGetRequestParam("StainOxide3", $Method, NULL), $this);
            $this->StainOxide4 = new clsControl(ccsHidden, "StainOxide4", "Stain Oxide4", ccsText, "", CCGetRequestParam("StainOxide4", $Method, NULL), $this);
            $this->StainOxideNote = new clsControl(ccsLabel, "StainOxideNote", "Stain Oxide Note", ccsMemo, "", CCGetRequestParam("StainOxideNote", $Method, NULL), $this);
            $this->Glaze1 = new clsControl(ccsHidden, "Glaze1", "Glaze1", ccsText, "", CCGetRequestParam("Glaze1", $Method, NULL), $this);
            $this->Glaze2 = new clsControl(ccsHidden, "Glaze2", "Glaze2", ccsText, "", CCGetRequestParam("Glaze2", $Method, NULL), $this);
            $this->Glaze3 = new clsControl(ccsHidden, "Glaze3", "Glaze3", ccsText, "", CCGetRequestParam("Glaze3", $Method, NULL), $this);
            $this->Glaze4 = new clsControl(ccsHidden, "Glaze4", "Glaze4", ccsText, "", CCGetRequestParam("Glaze4", $Method, NULL), $this);
            $this->GlazeDensity1 = new clsControl(ccsLabel, "GlazeDensity1", "Glaze Density1", ccsText, "", CCGetRequestParam("GlazeDensity1", $Method, NULL), $this);
            $this->GlazeDensity2 = new clsControl(ccsLabel, "GlazeDensity2", "Glaze Density2", ccsText, "", CCGetRequestParam("GlazeDensity2", $Method, NULL), $this);
            $this->GlazeDensity3 = new clsControl(ccsLabel, "GlazeDensity3", "Glaze Density3", ccsText, "", CCGetRequestParam("GlazeDensity3", $Method, NULL), $this);
            $this->GlazeDensity4 = new clsControl(ccsLabel, "GlazeDensity4", "Glaze Density4", ccsText, "", CCGetRequestParam("GlazeDensity4", $Method, NULL), $this);
            $this->GlazeNote = new clsControl(ccsLabel, "GlazeNote", "Glaze Note", ccsMemo, "", CCGetRequestParam("GlazeNote", $Method, NULL), $this);
            $this->GlazeTemp = new clsControl(ccsLabel, "GlazeTemp", "Glaze Temp", ccsText, "", CCGetRequestParam("GlazeTemp", $Method, NULL), $this);
            $this->Firing = new clsControl(ccsLabel, "Firing", "Firing", ccsText, "", CCGetRequestParam("Firing", $Method, NULL), $this);
            $this->FiringNote = new clsControl(ccsLabel, "FiringNote", "Firing Note", ccsMemo, "", CCGetRequestParam("FiringNote", $Method, NULL), $this);
            $this->Width = new clsControl(ccsLabel, "Width", "Width", ccsFloat, "", CCGetRequestParam("Width", $Method, NULL), $this);
            $this->Height = new clsControl(ccsLabel, "Height", "Height", ccsFloat, "", CCGetRequestParam("Height", $Method, NULL), $this);
            $this->Length = new clsControl(ccsLabel, "Length", "Length", ccsFloat, "", CCGetRequestParam("Length", $Method, NULL), $this);
            $this->Diameter = new clsControl(ccsLabel, "Diameter", "Diameter", ccsFloat, "", CCGetRequestParam("Diameter", $Method, NULL), $this);
            $this->FinalSizeNote = new clsControl(ccsLabel, "FinalSizeNote", "Final Size Note", ccsMemo, "", CCGetRequestParam("FinalSizeNote", $Method, NULL), $this);
            $this->DesignMat1 = new clsControl(ccsHidden, "DesignMat1", "Design Mat1", ccsText, "", CCGetRequestParam("DesignMat1", $Method, NULL), $this);
            $this->DesignMat2 = new clsControl(ccsHidden, "DesignMat2", "Design Mat2", ccsText, "", CCGetRequestParam("DesignMat2", $Method, NULL), $this);
            $this->DesignMat3 = new clsControl(ccsHidden, "DesignMat3", "Design Mat3", ccsText, "", CCGetRequestParam("DesignMat3", $Method, NULL), $this);
            $this->DesignMat4 = new clsControl(ccsHidden, "DesignMat4", "Design Mat4", ccsText, "", CCGetRequestParam("DesignMat4", $Method, NULL), $this);
            $this->DesignMatQty1 = new clsControl(ccsLabel, "DesignMatQty1", "Design Mat Qty1", ccsInteger, "", CCGetRequestParam("DesignMatQty1", $Method, NULL), $this);
            $this->DesignMatQty2 = new clsControl(ccsLabel, "DesignMatQty2", "Design Mat Qty2", ccsInteger, "", CCGetRequestParam("DesignMatQty2", $Method, NULL), $this);
            $this->DesignMatQty3 = new clsControl(ccsLabel, "DesignMatQty3", "Design Mat Qty3", ccsInteger, "", CCGetRequestParam("DesignMatQty3", $Method, NULL), $this);
            $this->DesignMatQty4 = new clsControl(ccsLabel, "DesignMatQty4", "Design Mat Qty4", ccsInteger, "", CCGetRequestParam("DesignMatQty4", $Method, NULL), $this);
            $this->DesignMatNote = new clsControl(ccsLabel, "DesignMatNote", "Design Mat Note", ccsMemo, "", CCGetRequestParam("DesignMatNote", $Method, NULL), $this);
            $this->ToolsPic1 = new clsControl(ccsImage, "ToolsPic1", "ToolsPic1", ccsText, "", CCGetRequestParam("ToolsPic1", $Method, NULL), $this);
            $this->ToolsPic2 = new clsControl(ccsImage, "ToolsPic2", "ToolsPic2", ccsText, "", CCGetRequestParam("ToolsPic2", $Method, NULL), $this);
            $this->ToolsPic3 = new clsControl(ccsImage, "ToolsPic3", "ToolsPic3", ccsText, "", CCGetRequestParam("ToolsPic3", $Method, NULL), $this);
            $this->ToolsPic4 = new clsControl(ccsImage, "ToolsPic4", "ToolsPic4", ccsText, "", CCGetRequestParam("ToolsPic4", $Method, NULL), $this);
            $this->Casting1Desc = new clsControl(ccsLabel, "Casting1Desc", "Casting1Desc", ccsText, "", CCGetRequestParam("Casting1Desc", $Method, NULL), $this);
            $this->Casting2Desc = new clsControl(ccsLabel, "Casting2Desc", "Casting2Desc", ccsText, "", CCGetRequestParam("Casting2Desc", $Method, NULL), $this);
            $this->Casting3Desc = new clsControl(ccsLabel, "Casting3Desc", "Casting3Desc", ccsText, "", CCGetRequestParam("Casting3Desc", $Method, NULL), $this);
            $this->Casting4Desc = new clsControl(ccsLabel, "Casting4Desc", "Casting4Desc", ccsText, "", CCGetRequestParam("Casting4Desc", $Method, NULL), $this);
            $this->Estruder1Desc = new clsControl(ccsLabel, "Estruder1Desc", "Estruder1Desc", ccsText, "", CCGetRequestParam("Estruder1Desc", $Method, NULL), $this);
            $this->Estruder2Desc = new clsControl(ccsLabel, "Estruder2Desc", "Estruder2Desc", ccsText, "", CCGetRequestParam("Estruder2Desc", $Method, NULL), $this);
            $this->Estruder3Desc = new clsControl(ccsLabel, "Estruder3Desc", "Estruder3Desc", ccsText, "", CCGetRequestParam("Estruder3Desc", $Method, NULL), $this);
            $this->Estruder4Desc = new clsControl(ccsLabel, "Estruder4Desc", "Estruder4Desc", ccsText, "", CCGetRequestParam("Estruder4Desc", $Method, NULL), $this);
            $this->Texture1Desc = new clsControl(ccsLabel, "Texture1Desc", "Texture1Desc", ccsText, "", CCGetRequestParam("Texture1Desc", $Method, NULL), $this);
            $this->Texture2Desc = new clsControl(ccsLabel, "Texture2Desc", "Texture2Desc", ccsText, "", CCGetRequestParam("Texture2Desc", $Method, NULL), $this);
            $this->Texture3Desc = new clsControl(ccsLabel, "Texture3Desc", "Texture3Desc", ccsText, "", CCGetRequestParam("Texture3Desc", $Method, NULL), $this);
            $this->Texture4Desc = new clsControl(ccsLabel, "Texture4Desc", "Texture4Desc", ccsText, "", CCGetRequestParam("Texture4Desc", $Method, NULL), $this);
            $this->Engobe1Desc = new clsControl(ccsLabel, "Engobe1Desc", "Engobe1Desc", ccsText, "", CCGetRequestParam("Engobe1Desc", $Method, NULL), $this);
            $this->Engobe2Desc = new clsControl(ccsLabel, "Engobe2Desc", "Engobe2Desc", ccsText, "", CCGetRequestParam("Engobe2Desc", $Method, NULL), $this);
            $this->Engobe3Desc = new clsControl(ccsLabel, "Engobe3Desc", "Engobe3Desc", ccsText, "", CCGetRequestParam("Engobe3Desc", $Method, NULL), $this);
            $this->Engobe4Desc = new clsControl(ccsLabel, "Engobe4Desc", "Engobe4Desc", ccsText, "", CCGetRequestParam("Engobe4Desc", $Method, NULL), $this);
            $this->StainOxide1Desc = new clsControl(ccsLabel, "StainOxide1Desc", "StainOxide1Desc", ccsText, "", CCGetRequestParam("StainOxide1Desc", $Method, NULL), $this);
            $this->StainOxide2Desc = new clsControl(ccsLabel, "StainOxide2Desc", "StainOxide2Desc", ccsText, "", CCGetRequestParam("StainOxide2Desc", $Method, NULL), $this);
            $this->StainOxide3Desc = new clsControl(ccsLabel, "StainOxide3Desc", "StainOxide3Desc", ccsText, "", CCGetRequestParam("StainOxide3Desc", $Method, NULL), $this);
            $this->StainOxide4Desc = new clsControl(ccsLabel, "StainOxide4Desc", "StainOxide4Desc", ccsText, "", CCGetRequestParam("StainOxide4Desc", $Method, NULL), $this);
            $this->Glaze1Desc = new clsControl(ccsLabel, "Glaze1Desc", "Glaze1Desc", ccsText, "", CCGetRequestParam("Glaze1Desc", $Method, NULL), $this);
            $this->Glaze2Desc = new clsControl(ccsLabel, "Glaze2Desc", "Glaze2Desc", ccsText, "", CCGetRequestParam("Glaze2Desc", $Method, NULL), $this);
            $this->Glaze3Desc = new clsControl(ccsLabel, "Glaze3Desc", "Glaze3Desc", ccsText, "", CCGetRequestParam("Glaze3Desc", $Method, NULL), $this);
            $this->Glaze4Desc = new clsControl(ccsLabel, "Glaze4Desc", "Glaze4Desc", ccsText, "", CCGetRequestParam("Glaze4Desc", $Method, NULL), $this);
            $this->DesignMat1Desc = new clsControl(ccsLabel, "DesignMat1Desc", "DesignMat1Desc", ccsText, "", CCGetRequestParam("DesignMat1Desc", $Method, NULL), $this);
            $this->DesignMat2Desc = new clsControl(ccsLabel, "DesignMat2Desc", "DesignMat2Desc", ccsText, "", CCGetRequestParam("DesignMat2Desc", $Method, NULL), $this);
            $this->DesignMat3Desc = new clsControl(ccsLabel, "DesignMat3Desc", "DesignMat3Desc", ccsText, "", CCGetRequestParam("DesignMat3Desc", $Method, NULL), $this);
            $this->DesignMat4Desc = new clsControl(ccsLabel, "DesignMat4Desc", "DesignMat4Desc", ccsText, "", CCGetRequestParam("DesignMat4Desc", $Method, NULL), $this);
            $this->ClayDesc = new clsControl(ccsLabel, "ClayDesc", "ClayDesc", ccsText, "", CCGetRequestParam("ClayDesc", $Method, NULL), $this);
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

//Validate Method @2-F7721B5C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->Clay->Validate() && $Validation);
        $Validation = ($this->Casting1->Validate() && $Validation);
        $Validation = ($this->Casting2->Validate() && $Validation);
        $Validation = ($this->Casting3->Validate() && $Validation);
        $Validation = ($this->Casting4->Validate() && $Validation);
        $Validation = ($this->Estruder1->Validate() && $Validation);
        $Validation = ($this->Estruder2->Validate() && $Validation);
        $Validation = ($this->Estruder3->Validate() && $Validation);
        $Validation = ($this->Estruder4->Validate() && $Validation);
        $Validation = ($this->Texture1->Validate() && $Validation);
        $Validation = ($this->Texture2->Validate() && $Validation);
        $Validation = ($this->Texture3->Validate() && $Validation);
        $Validation = ($this->Texture4->Validate() && $Validation);
        $Validation = ($this->Tools1->Validate() && $Validation);
        $Validation = ($this->Tools2->Validate() && $Validation);
        $Validation = ($this->Tools3->Validate() && $Validation);
        $Validation = ($this->Tools4->Validate() && $Validation);
        $Validation = ($this->Engobe1->Validate() && $Validation);
        $Validation = ($this->Engobe2->Validate() && $Validation);
        $Validation = ($this->Engobe3->Validate() && $Validation);
        $Validation = ($this->Engobe4->Validate() && $Validation);
        $Validation = ($this->StainOxide1->Validate() && $Validation);
        $Validation = ($this->StainOxide2->Validate() && $Validation);
        $Validation = ($this->StainOxide3->Validate() && $Validation);
        $Validation = ($this->StainOxide4->Validate() && $Validation);
        $Validation = ($this->Glaze1->Validate() && $Validation);
        $Validation = ($this->Glaze2->Validate() && $Validation);
        $Validation = ($this->Glaze3->Validate() && $Validation);
        $Validation = ($this->Glaze4->Validate() && $Validation);
        $Validation = ($this->DesignMat1->Validate() && $Validation);
        $Validation = ($this->DesignMat2->Validate() && $Validation);
        $Validation = ($this->DesignMat3->Validate() && $Validation);
        $Validation = ($this->DesignMat4->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->Clay->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Casting1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Casting2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Casting3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Casting4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Estruder1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Estruder2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Estruder3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Estruder4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Texture1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Texture2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Texture3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Texture4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Tools1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Tools2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Tools3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Tools4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Engobe1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Engobe2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Engobe3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Engobe4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxide1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxide2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxide3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxide4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Glaze1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Glaze2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Glaze3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Glaze4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat4->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-DA35BD3B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->SampleCode->Errors->Count());
        $errors = ($errors || $this->SampleDescription->Errors->Count());
        $errors = ($errors || $this->ClientCode->Errors->Count());
        $errors = ($errors || $this->ClientDescription->Errors->Count());
        $errors = ($errors || $this->TechDraw->Errors->Count());
        $errors = ($errors || $this->Photo1->Errors->Count());
        $errors = ($errors || $this->Photo2->Errors->Count());
        $errors = ($errors || $this->Photo3->Errors->Count());
        $errors = ($errors || $this->Photo4->Errors->Count());
        $errors = ($errors || $this->Clay->Errors->Count());
        $errors = ($errors || $this->ClayKG->Errors->Count());
        $errors = ($errors || $this->ClayNote->Errors->Count());
        $errors = ($errors || $this->BuildTech->Errors->Count());
        $errors = ($errors || $this->BuildTechNote->Errors->Count());
        $errors = ($errors || $this->Rim->Errors->Count());
        $errors = ($errors || $this->Feet->Errors->Count());
        $errors = ($errors || $this->Casting1->Errors->Count());
        $errors = ($errors || $this->Casting2->Errors->Count());
        $errors = ($errors || $this->Casting3->Errors->Count());
        $errors = ($errors || $this->Casting4->Errors->Count());
        $errors = ($errors || $this->CastingNote->Errors->Count());
        $errors = ($errors || $this->Estruder1->Errors->Count());
        $errors = ($errors || $this->Estruder2->Errors->Count());
        $errors = ($errors || $this->Estruder3->Errors->Count());
        $errors = ($errors || $this->Estruder4->Errors->Count());
        $errors = ($errors || $this->EstruderNote->Errors->Count());
        $errors = ($errors || $this->Texture1->Errors->Count());
        $errors = ($errors || $this->Texture2->Errors->Count());
        $errors = ($errors || $this->Texture3->Errors->Count());
        $errors = ($errors || $this->Texture4->Errors->Count());
        $errors = ($errors || $this->TextureNote->Errors->Count());
        $errors = ($errors || $this->Tools1->Errors->Count());
        $errors = ($errors || $this->Tools2->Errors->Count());
        $errors = ($errors || $this->Tools3->Errors->Count());
        $errors = ($errors || $this->Tools4->Errors->Count());
        $errors = ($errors || $this->ToolsNote->Errors->Count());
        $errors = ($errors || $this->Engobe1->Errors->Count());
        $errors = ($errors || $this->Engobe2->Errors->Count());
        $errors = ($errors || $this->Engobe3->Errors->Count());
        $errors = ($errors || $this->Engobe4->Errors->Count());
        $errors = ($errors || $this->EngobeNote->Errors->Count());
        $errors = ($errors || $this->BisqueTemp->Errors->Count());
        $errors = ($errors || $this->StainOxide1->Errors->Count());
        $errors = ($errors || $this->StainOxide2->Errors->Count());
        $errors = ($errors || $this->StainOxide3->Errors->Count());
        $errors = ($errors || $this->StainOxide4->Errors->Count());
        $errors = ($errors || $this->StainOxideNote->Errors->Count());
        $errors = ($errors || $this->Glaze1->Errors->Count());
        $errors = ($errors || $this->Glaze2->Errors->Count());
        $errors = ($errors || $this->Glaze3->Errors->Count());
        $errors = ($errors || $this->Glaze4->Errors->Count());
        $errors = ($errors || $this->GlazeDensity1->Errors->Count());
        $errors = ($errors || $this->GlazeDensity2->Errors->Count());
        $errors = ($errors || $this->GlazeDensity3->Errors->Count());
        $errors = ($errors || $this->GlazeDensity4->Errors->Count());
        $errors = ($errors || $this->GlazeNote->Errors->Count());
        $errors = ($errors || $this->GlazeTemp->Errors->Count());
        $errors = ($errors || $this->Firing->Errors->Count());
        $errors = ($errors || $this->FiringNote->Errors->Count());
        $errors = ($errors || $this->Width->Errors->Count());
        $errors = ($errors || $this->Height->Errors->Count());
        $errors = ($errors || $this->Length->Errors->Count());
        $errors = ($errors || $this->Diameter->Errors->Count());
        $errors = ($errors || $this->FinalSizeNote->Errors->Count());
        $errors = ($errors || $this->DesignMat1->Errors->Count());
        $errors = ($errors || $this->DesignMat2->Errors->Count());
        $errors = ($errors || $this->DesignMat3->Errors->Count());
        $errors = ($errors || $this->DesignMat4->Errors->Count());
        $errors = ($errors || $this->DesignMatQty1->Errors->Count());
        $errors = ($errors || $this->DesignMatQty2->Errors->Count());
        $errors = ($errors || $this->DesignMatQty3->Errors->Count());
        $errors = ($errors || $this->DesignMatQty4->Errors->Count());
        $errors = ($errors || $this->DesignMatNote->Errors->Count());
        $errors = ($errors || $this->ToolsPic1->Errors->Count());
        $errors = ($errors || $this->ToolsPic2->Errors->Count());
        $errors = ($errors || $this->ToolsPic3->Errors->Count());
        $errors = ($errors || $this->ToolsPic4->Errors->Count());
        $errors = ($errors || $this->Casting1Desc->Errors->Count());
        $errors = ($errors || $this->Casting2Desc->Errors->Count());
        $errors = ($errors || $this->Casting3Desc->Errors->Count());
        $errors = ($errors || $this->Casting4Desc->Errors->Count());
        $errors = ($errors || $this->Estruder1Desc->Errors->Count());
        $errors = ($errors || $this->Estruder2Desc->Errors->Count());
        $errors = ($errors || $this->Estruder3Desc->Errors->Count());
        $errors = ($errors || $this->Estruder4Desc->Errors->Count());
        $errors = ($errors || $this->Texture1Desc->Errors->Count());
        $errors = ($errors || $this->Texture2Desc->Errors->Count());
        $errors = ($errors || $this->Texture3Desc->Errors->Count());
        $errors = ($errors || $this->Texture4Desc->Errors->Count());
        $errors = ($errors || $this->Engobe1Desc->Errors->Count());
        $errors = ($errors || $this->Engobe2Desc->Errors->Count());
        $errors = ($errors || $this->Engobe3Desc->Errors->Count());
        $errors = ($errors || $this->Engobe4Desc->Errors->Count());
        $errors = ($errors || $this->StainOxide1Desc->Errors->Count());
        $errors = ($errors || $this->StainOxide2Desc->Errors->Count());
        $errors = ($errors || $this->StainOxide3Desc->Errors->Count());
        $errors = ($errors || $this->StainOxide4Desc->Errors->Count());
        $errors = ($errors || $this->Glaze1Desc->Errors->Count());
        $errors = ($errors || $this->Glaze2Desc->Errors->Count());
        $errors = ($errors || $this->Glaze3Desc->Errors->Count());
        $errors = ($errors || $this->Glaze4Desc->Errors->Count());
        $errors = ($errors || $this->DesignMat1Desc->Errors->Count());
        $errors = ($errors || $this->DesignMat2Desc->Errors->Count());
        $errors = ($errors || $this->DesignMat3Desc->Errors->Count());
        $errors = ($errors || $this->DesignMat4Desc->Errors->Count());
        $errors = ($errors || $this->ClayDesc->Errors->Count());
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

//Show Method @2-8C131059
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
                $this->SampleDescription->SetValue($this->DataSource->SampleDescription->GetValue());
                $this->ClientCode->SetValue($this->DataSource->ClientCode->GetValue());
                $this->ClientDescription->SetValue($this->DataSource->ClientDescription->GetValue());
                $this->TechDraw->SetValue($this->DataSource->TechDraw->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->Photo2->SetValue($this->DataSource->Photo2->GetValue());
                $this->Photo3->SetValue($this->DataSource->Photo3->GetValue());
                $this->Photo4->SetValue($this->DataSource->Photo4->GetValue());
                $this->ClayKG->SetValue($this->DataSource->ClayKG->GetValue());
                $this->ClayNote->SetValue($this->DataSource->ClayNote->GetValue());
                $this->BuildTech->SetValue($this->DataSource->BuildTech->GetValue());
                $this->BuildTechNote->SetValue($this->DataSource->BuildTechNote->GetValue());
                $this->Rim->SetValue($this->DataSource->Rim->GetValue());
                $this->Feet->SetValue($this->DataSource->Feet->GetValue());
                $this->CastingNote->SetValue($this->DataSource->CastingNote->GetValue());
                $this->EstruderNote->SetValue($this->DataSource->EstruderNote->GetValue());
                $this->TextureNote->SetValue($this->DataSource->TextureNote->GetValue());
                $this->ToolsNote->SetValue($this->DataSource->ToolsNote->GetValue());
                $this->EngobeNote->SetValue($this->DataSource->EngobeNote->GetValue());
                $this->BisqueTemp->SetValue($this->DataSource->BisqueTemp->GetValue());
                $this->StainOxideNote->SetValue($this->DataSource->StainOxideNote->GetValue());
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
                $this->FinalSizeNote->SetValue($this->DataSource->FinalSizeNote->GetValue());
                $this->DesignMatQty1->SetValue($this->DataSource->DesignMatQty1->GetValue());
                $this->DesignMatQty2->SetValue($this->DataSource->DesignMatQty2->GetValue());
                $this->DesignMatQty3->SetValue($this->DataSource->DesignMatQty3->GetValue());
                $this->DesignMatQty4->SetValue($this->DataSource->DesignMatQty4->GetValue());
                $this->DesignMatNote->SetValue($this->DataSource->DesignMatNote->GetValue());
                if(!$this->FormSubmitted){
                    $this->Clay->SetValue($this->DataSource->Clay->GetValue());
                    $this->Casting1->SetValue($this->DataSource->Casting1->GetValue());
                    $this->Casting2->SetValue($this->DataSource->Casting2->GetValue());
                    $this->Casting3->SetValue($this->DataSource->Casting3->GetValue());
                    $this->Casting4->SetValue($this->DataSource->Casting4->GetValue());
                    $this->Estruder1->SetValue($this->DataSource->Estruder1->GetValue());
                    $this->Estruder2->SetValue($this->DataSource->Estruder2->GetValue());
                    $this->Estruder3->SetValue($this->DataSource->Estruder3->GetValue());
                    $this->Estruder4->SetValue($this->DataSource->Estruder4->GetValue());
                    $this->Texture1->SetValue($this->DataSource->Texture1->GetValue());
                    $this->Texture2->SetValue($this->DataSource->Texture2->GetValue());
                    $this->Texture3->SetValue($this->DataSource->Texture3->GetValue());
                    $this->Texture4->SetValue($this->DataSource->Texture4->GetValue());
                    $this->Tools1->SetValue($this->DataSource->Tools1->GetValue());
                    $this->Tools2->SetValue($this->DataSource->Tools2->GetValue());
                    $this->Tools3->SetValue($this->DataSource->Tools3->GetValue());
                    $this->Tools4->SetValue($this->DataSource->Tools4->GetValue());
                    $this->Engobe1->SetValue($this->DataSource->Engobe1->GetValue());
                    $this->Engobe2->SetValue($this->DataSource->Engobe2->GetValue());
                    $this->Engobe3->SetValue($this->DataSource->Engobe3->GetValue());
                    $this->Engobe4->SetValue($this->DataSource->Engobe4->GetValue());
                    $this->StainOxide1->SetValue($this->DataSource->StainOxide1->GetValue());
                    $this->StainOxide2->SetValue($this->DataSource->StainOxide2->GetValue());
                    $this->StainOxide3->SetValue($this->DataSource->StainOxide3->GetValue());
                    $this->StainOxide4->SetValue($this->DataSource->StainOxide4->GetValue());
                    $this->Glaze1->SetValue($this->DataSource->Glaze1->GetValue());
                    $this->Glaze2->SetValue($this->DataSource->Glaze2->GetValue());
                    $this->Glaze3->SetValue($this->DataSource->Glaze3->GetValue());
                    $this->Glaze4->SetValue($this->DataSource->Glaze4->GetValue());
                    $this->DesignMat1->SetValue($this->DataSource->DesignMat1->GetValue());
                    $this->DesignMat2->SetValue($this->DataSource->DesignMat2->GetValue());
                    $this->DesignMat3->SetValue($this->DataSource->DesignMat3->GetValue());
                    $this->DesignMat4->SetValue($this->DataSource->DesignMat4->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->SampleCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SampleDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Clay->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayKG->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayNote->Errors->ToString());
            $Error = ComposeStrings($Error, $this->BuildTech->Errors->ToString());
            $Error = ComposeStrings($Error, $this->BuildTechNote->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Rim->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Feet->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Casting1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Casting2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Casting3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Casting4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CastingNote->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Estruder1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Estruder2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Estruder3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Estruder4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EstruderNote->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Texture1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Texture2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Texture3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Texture4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextureNote->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Tools1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Tools2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Tools3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Tools4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ToolsNote->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Engobe1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Engobe2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Engobe3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Engobe4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EngobeNote->Errors->ToString());
            $Error = ComposeStrings($Error, $this->BisqueTemp->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxide1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxide2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxide3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxide4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxideNote->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Glaze1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Glaze2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Glaze3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Glaze4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazeDensity1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazeDensity2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazeDensity3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazeDensity4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazeNote->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazeTemp->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Firing->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FiringNote->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Width->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Height->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Length->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Diameter->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FinalSizeNote->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMat1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMat2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMat3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMat4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatQty1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatQty2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatQty3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatQty4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatNote->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ToolsPic1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ToolsPic2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ToolsPic3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ToolsPic4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Casting1Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Casting2Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Casting3Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Casting4Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Estruder1Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Estruder2Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Estruder3Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Estruder4Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Texture1Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Texture2Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Texture3Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Texture4Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Engobe1Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Engobe2Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Engobe3Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Engobe4Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxide1Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxide2Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxide3Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxide4Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Glaze1Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Glaze2Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Glaze3Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Glaze4Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMat1Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMat2Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMat3Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMat4Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayDesc->Errors->ToString());
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
        $this->SampleDescription->Show();
        $this->ClientCode->Show();
        $this->ClientDescription->Show();
        $this->TechDraw->Show();
        $this->Photo1->Show();
        $this->Photo2->Show();
        $this->Photo3->Show();
        $this->Photo4->Show();
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
        $this->ToolsPic1->Show();
        $this->ToolsPic2->Show();
        $this->ToolsPic3->Show();
        $this->ToolsPic4->Show();
        $this->Casting1Desc->Show();
        $this->Casting2Desc->Show();
        $this->Casting3Desc->Show();
        $this->Casting4Desc->Show();
        $this->Estruder1Desc->Show();
        $this->Estruder2Desc->Show();
        $this->Estruder3Desc->Show();
        $this->Estruder4Desc->Show();
        $this->Texture1Desc->Show();
        $this->Texture2Desc->Show();
        $this->Texture3Desc->Show();
        $this->Texture4Desc->Show();
        $this->Engobe1Desc->Show();
        $this->Engobe2Desc->Show();
        $this->Engobe3Desc->Show();
        $this->Engobe4Desc->Show();
        $this->StainOxide1Desc->Show();
        $this->StainOxide2Desc->Show();
        $this->StainOxide3Desc->Show();
        $this->StainOxide4Desc->Show();
        $this->Glaze1Desc->Show();
        $this->Glaze2Desc->Show();
        $this->Glaze3Desc->Show();
        $this->Glaze4Desc->Show();
        $this->DesignMat1Desc->Show();
        $this->DesignMat2Desc->Show();
        $this->DesignMat3Desc->Show();
        $this->DesignMat4Desc->Show();
        $this->ClayDesc->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddSampleCeramic Class @2-FCB6E20C

class clsAddSampleCeramicDataSource extends clsDBGayaFusionAll {  //AddSampleCeramicDataSource Class @2-FBB4BE4C

//DataSource Variables @2-4D6A719C
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $SampleCode;
    public $SampleDescription;
    public $ClientCode;
    public $ClientDescription;
    public $TechDraw;
    public $Photo1;
    public $Photo2;
    public $Photo3;
    public $Photo4;
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
    public $ToolsPic1;
    public $ToolsPic2;
    public $ToolsPic3;
    public $ToolsPic4;
    public $Casting1Desc;
    public $Casting2Desc;
    public $Casting3Desc;
    public $Casting4Desc;
    public $Estruder1Desc;
    public $Estruder2Desc;
    public $Estruder3Desc;
    public $Estruder4Desc;
    public $Texture1Desc;
    public $Texture2Desc;
    public $Texture3Desc;
    public $Texture4Desc;
    public $Engobe1Desc;
    public $Engobe2Desc;
    public $Engobe3Desc;
    public $Engobe4Desc;
    public $StainOxide1Desc;
    public $StainOxide2Desc;
    public $StainOxide3Desc;
    public $StainOxide4Desc;
    public $Glaze1Desc;
    public $Glaze2Desc;
    public $Glaze3Desc;
    public $Glaze4Desc;
    public $DesignMat1Desc;
    public $DesignMat2Desc;
    public $DesignMat3Desc;
    public $DesignMat4Desc;
    public $ClayDesc;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-A5957647
    function clsAddSampleCeramicDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddSampleCeramic/Error";
        $this->Initialize();
        $this->SampleCode = new clsField("SampleCode", ccsText, "");
        
        $this->SampleDescription = new clsField("SampleDescription", ccsText, "");
        
        $this->ClientCode = new clsField("ClientCode", ccsText, "");
        
        $this->ClientDescription = new clsField("ClientDescription", ccsText, "");
        
        $this->TechDraw = new clsField("TechDraw", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->Photo2 = new clsField("Photo2", ccsText, "");
        
        $this->Photo3 = new clsField("Photo3", ccsText, "");
        
        $this->Photo4 = new clsField("Photo4", ccsText, "");
        
        $this->Clay = new clsField("Clay", ccsText, "");
        
        $this->ClayKG = new clsField("ClayKG", ccsFloat, "");
        
        $this->ClayNote = new clsField("ClayNote", ccsMemo, "");
        
        $this->BuildTech = new clsField("BuildTech", ccsText, "");
        
        $this->BuildTechNote = new clsField("BuildTechNote", ccsMemo, "");
        
        $this->Rim = new clsField("Rim", ccsText, "");
        
        $this->Feet = new clsField("Feet", ccsText, "");
        
        $this->Casting1 = new clsField("Casting1", ccsInteger, "");
        
        $this->Casting2 = new clsField("Casting2", ccsInteger, "");
        
        $this->Casting3 = new clsField("Casting3", ccsInteger, "");
        
        $this->Casting4 = new clsField("Casting4", ccsInteger, "");
        
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
        
        $this->ToolsPic1 = new clsField("ToolsPic1", ccsText, "");
        
        $this->ToolsPic2 = new clsField("ToolsPic2", ccsText, "");
        
        $this->ToolsPic3 = new clsField("ToolsPic3", ccsText, "");
        
        $this->ToolsPic4 = new clsField("ToolsPic4", ccsText, "");
        
        $this->Casting1Desc = new clsField("Casting1Desc", ccsText, "");
        
        $this->Casting2Desc = new clsField("Casting2Desc", ccsText, "");
        
        $this->Casting3Desc = new clsField("Casting3Desc", ccsText, "");
        
        $this->Casting4Desc = new clsField("Casting4Desc", ccsText, "");
        
        $this->Estruder1Desc = new clsField("Estruder1Desc", ccsText, "");
        
        $this->Estruder2Desc = new clsField("Estruder2Desc", ccsText, "");
        
        $this->Estruder3Desc = new clsField("Estruder3Desc", ccsText, "");
        
        $this->Estruder4Desc = new clsField("Estruder4Desc", ccsText, "");
        
        $this->Texture1Desc = new clsField("Texture1Desc", ccsText, "");
        
        $this->Texture2Desc = new clsField("Texture2Desc", ccsText, "");
        
        $this->Texture3Desc = new clsField("Texture3Desc", ccsText, "");
        
        $this->Texture4Desc = new clsField("Texture4Desc", ccsText, "");
        
        $this->Engobe1Desc = new clsField("Engobe1Desc", ccsText, "");
        
        $this->Engobe2Desc = new clsField("Engobe2Desc", ccsText, "");
        
        $this->Engobe3Desc = new clsField("Engobe3Desc", ccsText, "");
        
        $this->Engobe4Desc = new clsField("Engobe4Desc", ccsText, "");
        
        $this->StainOxide1Desc = new clsField("StainOxide1Desc", ccsText, "");
        
        $this->StainOxide2Desc = new clsField("StainOxide2Desc", ccsText, "");
        
        $this->StainOxide3Desc = new clsField("StainOxide3Desc", ccsText, "");
        
        $this->StainOxide4Desc = new clsField("StainOxide4Desc", ccsText, "");
        
        $this->Glaze1Desc = new clsField("Glaze1Desc", ccsText, "");
        
        $this->Glaze2Desc = new clsField("Glaze2Desc", ccsText, "");
        
        $this->Glaze3Desc = new clsField("Glaze3Desc", ccsText, "");
        
        $this->Glaze4Desc = new clsField("Glaze4Desc", ccsText, "");
        
        $this->DesignMat1Desc = new clsField("DesignMat1Desc", ccsText, "");
        
        $this->DesignMat2Desc = new clsField("DesignMat2Desc", ccsText, "");
        
        $this->DesignMat3Desc = new clsField("DesignMat3Desc", ccsText, "");
        
        $this->DesignMat4Desc = new clsField("DesignMat4Desc", ccsText, "");
        
        $this->ClayDesc = new clsField("ClayDesc", ccsText, "");
        

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

//Open Method @2-FD4BB828
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM sampleceramic {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-09CBD929
    function SetValues()
    {
        $this->SampleCode->SetDBValue($this->f("SampleCode"));
        $this->SampleDescription->SetDBValue($this->f("SampleDescription"));
        $this->ClientCode->SetDBValue($this->f("ClientCode"));
        $this->ClientDescription->SetDBValue($this->f("ClientDescription"));
        $this->TechDraw->SetDBValue($this->f("TechDraw"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->Photo2->SetDBValue($this->f("Photo2"));
        $this->Photo3->SetDBValue($this->f("Photo3"));
        $this->Photo4->SetDBValue($this->f("Photo4"));
        $this->Clay->SetDBValue($this->f("Clay"));
        $this->ClayKG->SetDBValue(trim($this->f("ClayKG")));
        $this->ClayNote->SetDBValue($this->f("ClayNote"));
        $this->BuildTech->SetDBValue($this->f("BuildTech"));
        $this->BuildTechNote->SetDBValue($this->f("BuildTechNote"));
        $this->Rim->SetDBValue($this->f("Rim"));
        $this->Feet->SetDBValue($this->f("Feet"));
        $this->Casting1->SetDBValue(trim($this->f("Casting1")));
        $this->Casting2->SetDBValue(trim($this->f("Casting2")));
        $this->Casting3->SetDBValue(trim($this->f("Casting3")));
        $this->Casting4->SetDBValue(trim($this->f("Casting4")));
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
    }
//End SetValues Method

} //End AddSampleCeramicDataSource Class @2-FCB6E20C

//Initialize Page @1-B8EA4C1E
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
$TemplateFileName = "ShowSampleCeramic.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-606D7DFC
include_once("./ShowSampleCeramic_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-0DF67AFF
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$AddSampleCeramic = new clsRecordAddSampleCeramic("", $MainPage);
$MainPage->AddSampleCeramic = & $AddSampleCeramic;
$AddSampleCeramic->Initialize();

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

//Execute Components @1-4BE58EC3
$AddSampleCeramic->Operation();
//End Execute Components

//Go to destination page @1-906A5B18
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($AddSampleCeramic);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-BB3B69C0
$AddSampleCeramic->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-3A806E66
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($AddSampleCeramic);
unset($Tpl);
//End Unload Page


?>
