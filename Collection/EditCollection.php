<?php
//Include Common Files @1-4FC1453B
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "EditCollection.php");
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

//Class_Initialize Event @2-613373A9
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
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
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
            $this->FormEnctype = "multipart/form-data";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->CollectCode = new clsControl(ccsTextBox, "CollectCode", "Sample Code", ccsText, "", CCGetRequestParam("CollectCode", $Method, NULL), $this);
            $this->CollectCode->Required = true;
            $this->ClientCode = new clsControl(ccsTextBox, "ClientCode", "Client Code", ccsText, "", CCGetRequestParam("ClientCode", $Method, NULL), $this);
            $this->ClientDescription = new clsControl(ccsTextBox, "ClientDescription", "Client Description", ccsText, "", CCGetRequestParam("ClientDescription", $Method, NULL), $this);
            $this->CollectDate = new clsControl(ccsTextBox, "CollectDate", "Sample Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("CollectDate", $Method, NULL), $this);
            $this->DatePicker_SampleDate = new clsDatePicker("DatePicker_SampleDate", "AddSampleCeramic", "CollectDate", $this);
            $this->Clay = new clsControl(ccsHidden, "Clay", "Clay", ccsInteger, "", CCGetRequestParam("Clay", $Method, NULL), $this);
            $this->ClayKG = new clsControl(ccsTextBox, "ClayKG", "Clay KG", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("ClayKG", $Method, NULL), $this);
            $this->ClayNote = new clsControl(ccsTextArea, "ClayNote", "Clay Note", ccsMemo, "", CCGetRequestParam("ClayNote", $Method, NULL), $this);
            $this->BuildTech = new clsControl(ccsTextBox, "BuildTech", "Build Tech", ccsText, "", CCGetRequestParam("BuildTech", $Method, NULL), $this);
            $this->BuildTechNote = new clsControl(ccsTextArea, "BuildTechNote", "Build Tech Note", ccsMemo, "", CCGetRequestParam("BuildTechNote", $Method, NULL), $this);
            $this->Rim = new clsControl(ccsTextBox, "Rim", "Rim", ccsText, "", CCGetRequestParam("Rim", $Method, NULL), $this);
            $this->Feet = new clsControl(ccsTextBox, "Feet", "Feet", ccsText, "", CCGetRequestParam("Feet", $Method, NULL), $this);
            $this->Casting1 = new clsControl(ccsHidden, "Casting1", "Casting1", ccsInteger, "", CCGetRequestParam("Casting1", $Method, NULL), $this);
            $this->Casting2 = new clsControl(ccsHidden, "Casting2", "Casting2", ccsInteger, "", CCGetRequestParam("Casting2", $Method, NULL), $this);
            $this->Casting3 = new clsControl(ccsHidden, "Casting3", "Casting3", ccsInteger, "", CCGetRequestParam("Casting3", $Method, NULL), $this);
            $this->Casting4 = new clsControl(ccsHidden, "Casting4", "Casting4", ccsInteger, "", CCGetRequestParam("Casting4", $Method, NULL), $this);
            $this->CastingNote = new clsControl(ccsTextArea, "CastingNote", "Casting Note", ccsMemo, "", CCGetRequestParam("CastingNote", $Method, NULL), $this);
            $this->Estruder1 = new clsControl(ccsHidden, "Estruder1", "Estruder1", ccsInteger, "", CCGetRequestParam("Estruder1", $Method, NULL), $this);
            $this->Estruder2 = new clsControl(ccsHidden, "Estruder2", "Estruder2", ccsInteger, "", CCGetRequestParam("Estruder2", $Method, NULL), $this);
            $this->Estruder3 = new clsControl(ccsHidden, "Estruder3", "Estruder3", ccsInteger, "", CCGetRequestParam("Estruder3", $Method, NULL), $this);
            $this->Estruder4 = new clsControl(ccsHidden, "Estruder4", "Estruder4", ccsInteger, "", CCGetRequestParam("Estruder4", $Method, NULL), $this);
            $this->EstruderNote = new clsControl(ccsTextArea, "EstruderNote", "Estruder Note", ccsMemo, "", CCGetRequestParam("EstruderNote", $Method, NULL), $this);
            $this->Texture1 = new clsControl(ccsHidden, "Texture1", "Texture1", ccsInteger, "", CCGetRequestParam("Texture1", $Method, NULL), $this);
            $this->Texture2 = new clsControl(ccsHidden, "Texture2", "Texture2", ccsInteger, "", CCGetRequestParam("Texture2", $Method, NULL), $this);
            $this->Texture3 = new clsControl(ccsHidden, "Texture3", "Texture3", ccsInteger, "", CCGetRequestParam("Texture3", $Method, NULL), $this);
            $this->Texture4 = new clsControl(ccsHidden, "Texture4", "Texture4", ccsInteger, "", CCGetRequestParam("Texture4", $Method, NULL), $this);
            $this->TextureNote = new clsControl(ccsTextArea, "TextureNote", "Texture Note", ccsMemo, "", CCGetRequestParam("TextureNote", $Method, NULL), $this);
            $this->Tools1 = new clsControl(ccsHidden, "Tools1", "Tools1", ccsInteger, "", CCGetRequestParam("Tools1", $Method, NULL), $this);
            $this->Tools2 = new clsControl(ccsHidden, "Tools2", "Tools2", ccsInteger, "", CCGetRequestParam("Tools2", $Method, NULL), $this);
            $this->Tools3 = new clsControl(ccsHidden, "Tools3", "Tools3", ccsInteger, "", CCGetRequestParam("Tools3", $Method, NULL), $this);
            $this->Tools4 = new clsControl(ccsHidden, "Tools4", "Tools4", ccsInteger, "", CCGetRequestParam("Tools4", $Method, NULL), $this);
            $this->ToolsNote = new clsControl(ccsTextArea, "ToolsNote", "Tools Note", ccsMemo, "", CCGetRequestParam("ToolsNote", $Method, NULL), $this);
            $this->Engobe1 = new clsControl(ccsHidden, "Engobe1", "Engobe1", ccsInteger, "", CCGetRequestParam("Engobe1", $Method, NULL), $this);
            $this->Engobe2 = new clsControl(ccsHidden, "Engobe2", "Engobe2", ccsInteger, "", CCGetRequestParam("Engobe2", $Method, NULL), $this);
            $this->Engobe3 = new clsControl(ccsHidden, "Engobe3", "Engobe3", ccsInteger, "", CCGetRequestParam("Engobe3", $Method, NULL), $this);
            $this->Engobe4 = new clsControl(ccsHidden, "Engobe4", "Engobe4", ccsInteger, "", CCGetRequestParam("Engobe4", $Method, NULL), $this);
            $this->EngobeNote = new clsControl(ccsTextArea, "EngobeNote", "Engobe Note", ccsMemo, "", CCGetRequestParam("EngobeNote", $Method, NULL), $this);
            $this->BisqueTemp = new clsControl(ccsRadioButton, "BisqueTemp", "Bisque Temp", ccsText, "", CCGetRequestParam("BisqueTemp", $Method, NULL), $this);
            $this->BisqueTemp->DSType = dsListOfValues;
            $this->BisqueTemp->Values = array(array("960", "960°"), array("0", "0°"));
            $this->BisqueTemp->HTML = true;
            $this->StainOxide1 = new clsControl(ccsHidden, "StainOxide1", "Stain Oxide1", ccsInteger, "", CCGetRequestParam("StainOxide1", $Method, NULL), $this);
            $this->StainOxide2 = new clsControl(ccsHidden, "StainOxide2", "Stain Oxide2", ccsInteger, "", CCGetRequestParam("StainOxide2", $Method, NULL), $this);
            $this->StainOxide3 = new clsControl(ccsHidden, "StainOxide3", "Stain Oxide3", ccsInteger, "", CCGetRequestParam("StainOxide3", $Method, NULL), $this);
            $this->StainOxide4 = new clsControl(ccsHidden, "StainOxide4", "Stain Oxide4", ccsInteger, "", CCGetRequestParam("StainOxide4", $Method, NULL), $this);
            $this->StainOxideNote = new clsControl(ccsTextArea, "StainOxideNote", "Stain Oxide Note", ccsMemo, "", CCGetRequestParam("StainOxideNote", $Method, NULL), $this);
            $this->Glaze1 = new clsControl(ccsHidden, "Glaze1", "Glaze1", ccsInteger, "", CCGetRequestParam("Glaze1", $Method, NULL), $this);
            $this->Glaze2 = new clsControl(ccsHidden, "Glaze2", "Glaze2", ccsInteger, "", CCGetRequestParam("Glaze2", $Method, NULL), $this);
            $this->Glaze3 = new clsControl(ccsHidden, "Glaze3", "Glaze3", ccsInteger, "", CCGetRequestParam("Glaze3", $Method, NULL), $this);
            $this->Glaze4 = new clsControl(ccsHidden, "Glaze4", "Glaze4", ccsInteger, "", CCGetRequestParam("Glaze4", $Method, NULL), $this);
            $this->GlazeDensity1 = new clsControl(ccsTextBox, "GlazeDensity1", "Glaze Density1", ccsText, "", CCGetRequestParam("GlazeDensity1", $Method, NULL), $this);
            $this->GlazeDensity2 = new clsControl(ccsTextBox, "GlazeDensity2", "Glaze Density2", ccsText, "", CCGetRequestParam("GlazeDensity2", $Method, NULL), $this);
            $this->GlazeDensity3 = new clsControl(ccsTextBox, "GlazeDensity3", "Glaze Density3", ccsText, "", CCGetRequestParam("GlazeDensity3", $Method, NULL), $this);
            $this->GlazeDensity4 = new clsControl(ccsTextBox, "GlazeDensity4", "Glaze Density4", ccsText, "", CCGetRequestParam("GlazeDensity4", $Method, NULL), $this);
            $this->GlazeNote = new clsControl(ccsTextArea, "GlazeNote", "Glaze Note", ccsMemo, "", CCGetRequestParam("GlazeNote", $Method, NULL), $this);
            $this->GlazeTemp = new clsControl(ccsTextBox, "GlazeTemp", "Glaze Temp", ccsText, "", CCGetRequestParam("GlazeTemp", $Method, NULL), $this);
            $this->Firing = new clsControl(ccsRadioButton, "Firing", "Firing", ccsText, "", CCGetRequestParam("Firing", $Method, NULL), $this);
            $this->Firing->DSType = dsListOfValues;
            $this->Firing->Values = array(array("Oxidation", "Oxidation"), array("Reduction", "Reduction"));
            $this->Firing->HTML = true;
            $this->FiringNote = new clsControl(ccsTextArea, "FiringNote", "Firing Note", ccsMemo, "", CCGetRequestParam("FiringNote", $Method, NULL), $this);
            $this->Width = new clsControl(ccsTextBox, "Width", "Width", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Width", $Method, NULL), $this);
            $this->FinalSizeNote = new clsControl(ccsTextArea, "FinalSizeNote", "Final Size Note", ccsMemo, "", CCGetRequestParam("FinalSizeNote", $Method, NULL), $this);
            $this->DesignMat1 = new clsControl(ccsHidden, "DesignMat1", "Design Mat1", ccsInteger, "", CCGetRequestParam("DesignMat1", $Method, NULL), $this);
            $this->DesignMat2 = new clsControl(ccsHidden, "DesignMat2", "Design Mat2", ccsInteger, "", CCGetRequestParam("DesignMat2", $Method, NULL), $this);
            $this->DesignMat3 = new clsControl(ccsHidden, "DesignMat3", "Design Mat3", ccsInteger, "", CCGetRequestParam("DesignMat3", $Method, NULL), $this);
            $this->DesignMat4 = new clsControl(ccsHidden, "DesignMat4", "Design Mat4", ccsInteger, "", CCGetRequestParam("DesignMat4", $Method, NULL), $this);
            $this->DesignMatQty1 = new clsControl(ccsTextBox, "DesignMatQty1", "Design Mat Qty1", ccsInteger, "", CCGetRequestParam("DesignMatQty1", $Method, NULL), $this);
            $this->DesignMatQty2 = new clsControl(ccsTextBox, "DesignMatQty2", "Design Mat Qty2", ccsInteger, "", CCGetRequestParam("DesignMatQty2", $Method, NULL), $this);
            $this->DesignMatQty3 = new clsControl(ccsTextBox, "DesignMatQty3", "Design Mat Qty3", ccsInteger, "", CCGetRequestParam("DesignMatQty3", $Method, NULL), $this);
            $this->DesignMatQty4 = new clsControl(ccsTextBox, "DesignMatQty4", "Design Mat Qty4", ccsInteger, "", CCGetRequestParam("DesignMatQty4", $Method, NULL), $this);
            $this->DesignMatNote = new clsControl(ccsTextArea, "DesignMatNote", "Design Mat Note", ccsMemo, "", CCGetRequestParam("DesignMatNote", $Method, NULL), $this);
            $this->History = new clsControl(ccsTextArea, "History", "History", ccsMemo, "", CCGetRequestParam("History", $Method, NULL), $this);
            $this->TechDraw = new clsFileUpload("TechDraw", "TechDraw", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->Photo1 = new clsFileUpload("Photo1", "Photo1", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->Photo2 = new clsFileUpload("Photo2", "Photo2", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->Photo3 = new clsFileUpload("Photo3", "Photo3", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->Photo4 = new clsFileUpload("Photo4", "Photo4", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->Casting1Desc = new clsControl(ccsTextBox, "Casting1Desc", "Casting1Desc", ccsText, "", CCGetRequestParam("Casting1Desc", $Method, NULL), $this);
            $this->Casting2Desc = new clsControl(ccsTextBox, "Casting2Desc", "Casting2Desc", ccsText, "", CCGetRequestParam("Casting2Desc", $Method, NULL), $this);
            $this->Casting3Desc = new clsControl(ccsTextBox, "Casting3Desc", "Casting3Desc", ccsText, "", CCGetRequestParam("Casting3Desc", $Method, NULL), $this);
            $this->Casting4Desc = new clsControl(ccsTextBox, "Casting4Desc", "Casting4Desc", ccsText, "", CCGetRequestParam("Casting4Desc", $Method, NULL), $this);
            $this->Estruder1Desc = new clsControl(ccsTextBox, "Estruder1Desc", "Estruder1Desc", ccsText, "", CCGetRequestParam("Estruder1Desc", $Method, NULL), $this);
            $this->Estruder2Desc = new clsControl(ccsTextBox, "Estruder2Desc", "Estruder2Desc", ccsText, "", CCGetRequestParam("Estruder2Desc", $Method, NULL), $this);
            $this->Estruder3Desc = new clsControl(ccsTextBox, "Estruder3Desc", "Estruder3Desc", ccsText, "", CCGetRequestParam("Estruder3Desc", $Method, NULL), $this);
            $this->Estruder4Desc = new clsControl(ccsTextBox, "Estruder4Desc", "Estruder4Desc", ccsText, "", CCGetRequestParam("Estruder4Desc", $Method, NULL), $this);
            $this->Texture1Desc = new clsControl(ccsTextBox, "Texture1Desc", "Texture1Desc", ccsText, "", CCGetRequestParam("Texture1Desc", $Method, NULL), $this);
            $this->Texture2Desc = new clsControl(ccsTextBox, "Texture2Desc", "Texture2Desc", ccsText, "", CCGetRequestParam("Texture2Desc", $Method, NULL), $this);
            $this->Texture3Desc = new clsControl(ccsTextBox, "Texture3Desc", "Texture3Desc", ccsText, "", CCGetRequestParam("Texture3Desc", $Method, NULL), $this);
            $this->Texture4Desc = new clsControl(ccsTextBox, "Texture4Desc", "Texture4Desc", ccsText, "", CCGetRequestParam("Texture4Desc", $Method, NULL), $this);
            $this->Tools1Desc = new clsControl(ccsTextBox, "Tools1Desc", "Tools1Desc", ccsText, "", CCGetRequestParam("Tools1Desc", $Method, NULL), $this);
            $this->Tools2Desc = new clsControl(ccsTextBox, "Tools2Desc", "Tools2Desc", ccsText, "", CCGetRequestParam("Tools2Desc", $Method, NULL), $this);
            $this->Tools3Desc = new clsControl(ccsTextBox, "Tools3Desc", "Tools3Desc", ccsText, "", CCGetRequestParam("Tools3Desc", $Method, NULL), $this);
            $this->Tools4Desc = new clsControl(ccsTextBox, "Tools4Desc", "Tools4Desc", ccsText, "", CCGetRequestParam("Tools4Desc", $Method, NULL), $this);
            $this->Engobe1Desc = new clsControl(ccsTextBox, "Engobe1Desc", "Engobe1Desc", ccsText, "", CCGetRequestParam("Engobe1Desc", $Method, NULL), $this);
            $this->Engobe2Desc = new clsControl(ccsTextBox, "Engobe2Desc", "Engobe2Desc", ccsText, "", CCGetRequestParam("Engobe2Desc", $Method, NULL), $this);
            $this->Engobe3Desc = new clsControl(ccsTextBox, "Engobe3Desc", "Engobe3Desc", ccsText, "", CCGetRequestParam("Engobe3Desc", $Method, NULL), $this);
            $this->Engobe4Desc = new clsControl(ccsTextBox, "Engobe4Desc", "Engobe4Desc", ccsText, "", CCGetRequestParam("Engobe4Desc", $Method, NULL), $this);
            $this->StainOxide1Desc = new clsControl(ccsTextBox, "StainOxide1Desc", "StainOxide1Desc", ccsText, "", CCGetRequestParam("StainOxide1Desc", $Method, NULL), $this);
            $this->StainOxide2Desc = new clsControl(ccsTextBox, "StainOxide2Desc", "StainOxide2Desc", ccsText, "", CCGetRequestParam("StainOxide2Desc", $Method, NULL), $this);
            $this->StainOxide3Desc = new clsControl(ccsTextBox, "StainOxide3Desc", "StainOxide3Desc", ccsText, "", CCGetRequestParam("StainOxide3Desc", $Method, NULL), $this);
            $this->StainOxide4Desc = new clsControl(ccsTextBox, "StainOxide4Desc", "StainOxide4Desc", ccsText, "", CCGetRequestParam("StainOxide4Desc", $Method, NULL), $this);
            $this->Glaze1Desc = new clsControl(ccsTextBox, "Glaze1Desc", "Glaze1Desc", ccsText, "", CCGetRequestParam("Glaze1Desc", $Method, NULL), $this);
            $this->Glaze2Desc = new clsControl(ccsTextBox, "Glaze2Desc", "Glaze2Desc", ccsText, "", CCGetRequestParam("Glaze2Desc", $Method, NULL), $this);
            $this->Glaze3Desc = new clsControl(ccsTextBox, "Glaze3Desc", "Glaze3Desc", ccsText, "", CCGetRequestParam("Glaze3Desc", $Method, NULL), $this);
            $this->Glaze4Desc = new clsControl(ccsTextBox, "Glaze4Desc", "Glaze4Desc", ccsText, "", CCGetRequestParam("Glaze4Desc", $Method, NULL), $this);
            $this->DesignMat1Desc = new clsControl(ccsTextBox, "DesignMat1Desc", "DesignMat1Desc", ccsText, "", CCGetRequestParam("DesignMat1Desc", $Method, NULL), $this);
            $this->DesignMat2Desc = new clsControl(ccsTextBox, "DesignMat2Desc", "DesignMat2Desc", ccsText, "", CCGetRequestParam("DesignMat2Desc", $Method, NULL), $this);
            $this->DesignMat3Desc = new clsControl(ccsTextBox, "DesignMat3Desc", "DesignMat3Desc", ccsText, "", CCGetRequestParam("DesignMat3Desc", $Method, NULL), $this);
            $this->DesignMat4Desc = new clsControl(ccsTextBox, "DesignMat4Desc", "DesignMat4Desc", ccsText, "", CCGetRequestParam("DesignMat4Desc", $Method, NULL), $this);
            $this->Height = new clsControl(ccsTextBox, "Height", "Height", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Height", $Method, NULL), $this);
            $this->Length = new clsControl(ccsTextBox, "Length", "Length", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Length", $Method, NULL), $this);
            $this->AddClay = new clsControl(ccsLink, "AddClay", "AddClay", ccsText, "", CCGetRequestParam("AddClay", $Method, NULL), $this);
            $this->AddClay->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddClay->Page = "#";
            $this->DelClay = new clsControl(ccsLink, "DelClay", "DelClay", ccsText, "", CCGetRequestParam("DelClay", $Method, NULL), $this);
            $this->DelClay->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelClay->Page = "#";
            $this->ClayDesc = new clsControl(ccsTextBox, "ClayDesc", "ClayDesc", ccsText, "", CCGetRequestParam("ClayDesc", $Method, NULL), $this);
            $this->DelCasting1 = new clsControl(ccsLink, "DelCasting1", "DelCasting1", ccsText, "", CCGetRequestParam("DelCasting1", $Method, NULL), $this);
            $this->DelCasting1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelCasting1->Page = "#";
            $this->AddCasting1 = new clsControl(ccsLink, "AddCasting1", "AddCasting1", ccsText, "", CCGetRequestParam("AddCasting1", $Method, NULL), $this);
            $this->AddCasting1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddCasting1->Page = "";
            $this->AddCasting2 = new clsControl(ccsLink, "AddCasting2", "AddCasting2", ccsText, "", CCGetRequestParam("AddCasting2", $Method, NULL), $this);
            $this->AddCasting2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddCasting2->Page = "";
            $this->DelCasting2 = new clsControl(ccsLink, "DelCasting2", "DelCasting2", ccsText, "", CCGetRequestParam("DelCasting2", $Method, NULL), $this);
            $this->DelCasting2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelCasting2->Page = "#";
            $this->AddCasting3 = new clsControl(ccsLink, "AddCasting3", "AddCasting3", ccsText, "", CCGetRequestParam("AddCasting3", $Method, NULL), $this);
            $this->AddCasting3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddCasting3->Page = "";
            $this->DelCasting3 = new clsControl(ccsLink, "DelCasting3", "DelCasting3", ccsText, "", CCGetRequestParam("DelCasting3", $Method, NULL), $this);
            $this->DelCasting3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelCasting3->Page = "#";
            $this->DelCasting4 = new clsControl(ccsLink, "DelCasting4", "DelCasting4", ccsText, "", CCGetRequestParam("DelCasting4", $Method, NULL), $this);
            $this->DelCasting4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelCasting4->Page = "#";
            $this->AddCasting4 = new clsControl(ccsLink, "AddCasting4", "AddCasting4", ccsText, "", CCGetRequestParam("AddCasting4", $Method, NULL), $this);
            $this->AddCasting4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddCasting4->Page = "#";
            $this->DelEstruder1 = new clsControl(ccsLink, "DelEstruder1", "DelEstruder1", ccsText, "", CCGetRequestParam("DelEstruder1", $Method, NULL), $this);
            $this->DelEstruder1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelEstruder1->Page = "#";
            $this->AddEstruder1 = new clsControl(ccsLink, "AddEstruder1", "AddEstruder1", ccsText, "", CCGetRequestParam("AddEstruder1", $Method, NULL), $this);
            $this->AddEstruder1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddEstruder1->Page = "#";
            $this->DelEstruder2 = new clsControl(ccsLink, "DelEstruder2", "DelEstruder2", ccsText, "", CCGetRequestParam("DelEstruder2", $Method, NULL), $this);
            $this->DelEstruder2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelEstruder2->Page = "#";
            $this->AddEstruder2 = new clsControl(ccsLink, "AddEstruder2", "AddEstruder2", ccsText, "", CCGetRequestParam("AddEstruder2", $Method, NULL), $this);
            $this->AddEstruder2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddEstruder2->Page = "#";
            $this->DelEstruder3 = new clsControl(ccsLink, "DelEstruder3", "DelEstruder3", ccsText, "", CCGetRequestParam("DelEstruder3", $Method, NULL), $this);
            $this->DelEstruder3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelEstruder3->Page = "#";
            $this->AddEstruder3 = new clsControl(ccsLink, "AddEstruder3", "AddEstruder3", ccsText, "", CCGetRequestParam("AddEstruder3", $Method, NULL), $this);
            $this->AddEstruder3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddEstruder3->Page = "#";
            $this->DelEstruder4 = new clsControl(ccsLink, "DelEstruder4", "DelEstruder4", ccsText, "", CCGetRequestParam("DelEstruder4", $Method, NULL), $this);
            $this->DelEstruder4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelEstruder4->Page = "#";
            $this->AddEstruder4 = new clsControl(ccsLink, "AddEstruder4", "AddEstruder4", ccsText, "", CCGetRequestParam("AddEstruder4", $Method, NULL), $this);
            $this->AddEstruder4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddEstruder4->Page = "#";
            $this->AddTexture1 = new clsControl(ccsLink, "AddTexture1", "AddTexture1", ccsText, "", CCGetRequestParam("AddTexture1", $Method, NULL), $this);
            $this->AddTexture1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddTexture1->Page = "#";
            $this->DelTexture1 = new clsControl(ccsLink, "DelTexture1", "DelTexture1", ccsText, "", CCGetRequestParam("DelTexture1", $Method, NULL), $this);
            $this->DelTexture1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelTexture1->Page = "#";
            $this->AddTexture2 = new clsControl(ccsLink, "AddTexture2", "AddTexture2", ccsText, "", CCGetRequestParam("AddTexture2", $Method, NULL), $this);
            $this->AddTexture2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddTexture2->Page = "#";
            $this->DelTexture2 = new clsControl(ccsLink, "DelTexture2", "DelTexture2", ccsText, "", CCGetRequestParam("DelTexture2", $Method, NULL), $this);
            $this->DelTexture2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelTexture2->Page = "#";
            $this->AddTexture3 = new clsControl(ccsLink, "AddTexture3", "AddTexture3", ccsText, "", CCGetRequestParam("AddTexture3", $Method, NULL), $this);
            $this->AddTexture3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddTexture3->Page = "#";
            $this->DelTexture3 = new clsControl(ccsLink, "DelTexture3", "DelTexture3", ccsText, "", CCGetRequestParam("DelTexture3", $Method, NULL), $this);
            $this->DelTexture3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelTexture3->Page = "#";
            $this->DelTexture4 = new clsControl(ccsLink, "DelTexture4", "DelTexture4", ccsText, "", CCGetRequestParam("DelTexture4", $Method, NULL), $this);
            $this->DelTexture4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelTexture4->Page = "#";
            $this->AddTexture4 = new clsControl(ccsLink, "AddTexture4", "AddTexture4", ccsText, "", CCGetRequestParam("AddTexture4", $Method, NULL), $this);
            $this->AddTexture4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddTexture4->Page = "#";
            $this->DelTools1 = new clsControl(ccsLink, "DelTools1", "DelTools1", ccsText, "", CCGetRequestParam("DelTools1", $Method, NULL), $this);
            $this->DelTools1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelTools1->Page = "#";
            $this->DelTools2 = new clsControl(ccsLink, "DelTools2", "DelTools2", ccsText, "", CCGetRequestParam("DelTools2", $Method, NULL), $this);
            $this->DelTools2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelTools2->Page = "#";
            $this->DelTools3 = new clsControl(ccsLink, "DelTools3", "DelTools3", ccsText, "", CCGetRequestParam("DelTools3", $Method, NULL), $this);
            $this->DelTools3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelTools3->Page = "#";
            $this->DelTools4 = new clsControl(ccsLink, "DelTools4", "DelTools4", ccsText, "", CCGetRequestParam("DelTools4", $Method, NULL), $this);
            $this->DelTools4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelTools4->Page = "#";
            $this->AddTools1 = new clsControl(ccsLink, "AddTools1", "AddTools1", ccsText, "", CCGetRequestParam("AddTools1", $Method, NULL), $this);
            $this->AddTools1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddTools1->Page = "#";
            $this->AddTools2 = new clsControl(ccsLink, "AddTools2", "AddTools2", ccsText, "", CCGetRequestParam("AddTools2", $Method, NULL), $this);
            $this->AddTools2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddTools2->Page = "#";
            $this->AddTools3 = new clsControl(ccsLink, "AddTools3", "AddTools3", ccsText, "", CCGetRequestParam("AddTools3", $Method, NULL), $this);
            $this->AddTools3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddTools3->Page = "#";
            $this->AddTools4 = new clsControl(ccsLink, "AddTools4", "AddTools4", ccsText, "", CCGetRequestParam("AddTools4", $Method, NULL), $this);
            $this->AddTools4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddTools4->Page = "#";
            $this->AddEngobe1 = new clsControl(ccsLink, "AddEngobe1", "AddEngobe1", ccsText, "", CCGetRequestParam("AddEngobe1", $Method, NULL), $this);
            $this->AddEngobe1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddEngobe1->Page = "#";
            $this->AddEngobe2 = new clsControl(ccsLink, "AddEngobe2", "AddEngobe2", ccsText, "", CCGetRequestParam("AddEngobe2", $Method, NULL), $this);
            $this->AddEngobe2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddEngobe2->Page = "#";
            $this->AddEngobe3 = new clsControl(ccsLink, "AddEngobe3", "AddEngobe3", ccsText, "", CCGetRequestParam("AddEngobe3", $Method, NULL), $this);
            $this->AddEngobe3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddEngobe3->Page = "#";
            $this->AddEngobe4 = new clsControl(ccsLink, "AddEngobe4", "AddEngobe4", ccsText, "", CCGetRequestParam("AddEngobe4", $Method, NULL), $this);
            $this->AddEngobe4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddEngobe4->Page = "#";
            $this->DelEngobe1 = new clsControl(ccsLink, "DelEngobe1", "DelEngobe1", ccsText, "", CCGetRequestParam("DelEngobe1", $Method, NULL), $this);
            $this->DelEngobe1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelEngobe1->Page = "#";
            $this->DelEngobe2 = new clsControl(ccsLink, "DelEngobe2", "DelEngobe2", ccsText, "", CCGetRequestParam("DelEngobe2", $Method, NULL), $this);
            $this->DelEngobe2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelEngobe2->Page = "#";
            $this->DelEngobe3 = new clsControl(ccsLink, "DelEngobe3", "DelEngobe3", ccsText, "", CCGetRequestParam("DelEngobe3", $Method, NULL), $this);
            $this->DelEngobe3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelEngobe3->Page = "#";
            $this->DelEngobe4 = new clsControl(ccsLink, "DelEngobe4", "DelEngobe4", ccsText, "", CCGetRequestParam("DelEngobe4", $Method, NULL), $this);
            $this->DelEngobe4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelEngobe4->Page = "#";
            $this->AddStainOxide1 = new clsControl(ccsLink, "AddStainOxide1", "AddStainOxide1", ccsText, "", CCGetRequestParam("AddStainOxide1", $Method, NULL), $this);
            $this->AddStainOxide1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddStainOxide1->Page = "#";
            $this->AddStainOxide2 = new clsControl(ccsLink, "AddStainOxide2", "AddStainOxide2", ccsText, "", CCGetRequestParam("AddStainOxide2", $Method, NULL), $this);
            $this->AddStainOxide2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddStainOxide2->Page = "#";
            $this->AddStainOxide3 = new clsControl(ccsLink, "AddStainOxide3", "AddStainOxide3", ccsText, "", CCGetRequestParam("AddStainOxide3", $Method, NULL), $this);
            $this->AddStainOxide3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddStainOxide3->Page = "#";
            $this->AddStainOxide4 = new clsControl(ccsLink, "AddStainOxide4", "AddStainOxide4", ccsText, "", CCGetRequestParam("AddStainOxide4", $Method, NULL), $this);
            $this->AddStainOxide4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddStainOxide4->Page = "#";
            $this->DelStainOxide1 = new clsControl(ccsLink, "DelStainOxide1", "DelStainOxide1", ccsText, "", CCGetRequestParam("DelStainOxide1", $Method, NULL), $this);
            $this->DelStainOxide1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelStainOxide1->Page = "#";
            $this->DelStainOxide2 = new clsControl(ccsLink, "DelStainOxide2", "DelStainOxide2", ccsText, "", CCGetRequestParam("DelStainOxide2", $Method, NULL), $this);
            $this->DelStainOxide2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelStainOxide2->Page = "#";
            $this->DelStainOxide3 = new clsControl(ccsLink, "DelStainOxide3", "DelStainOxide3", ccsText, "", CCGetRequestParam("DelStainOxide3", $Method, NULL), $this);
            $this->DelStainOxide3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelStainOxide3->Page = "#";
            $this->DelStainOxide4 = new clsControl(ccsLink, "DelStainOxide4", "DelStainOxide4", ccsText, "", CCGetRequestParam("DelStainOxide4", $Method, NULL), $this);
            $this->DelStainOxide4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelStainOxide4->Page = "#";
            $this->AddGlaze2 = new clsControl(ccsLink, "AddGlaze2", "AddGlaze2", ccsText, "", CCGetRequestParam("AddGlaze2", $Method, NULL), $this);
            $this->AddGlaze2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddGlaze2->Page = "#";
            $this->AddGlaze3 = new clsControl(ccsLink, "AddGlaze3", "AddGlaze3", ccsText, "", CCGetRequestParam("AddGlaze3", $Method, NULL), $this);
            $this->AddGlaze3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddGlaze3->Page = "#";
            $this->AddGlaze4 = new clsControl(ccsLink, "AddGlaze4", "AddGlaze4", ccsText, "", CCGetRequestParam("AddGlaze4", $Method, NULL), $this);
            $this->AddGlaze4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddGlaze4->Page = "#";
            $this->AddDesignMat1 = new clsControl(ccsLink, "AddDesignMat1", "AddDesignMat1", ccsText, "", CCGetRequestParam("AddDesignMat1", $Method, NULL), $this);
            $this->AddDesignMat1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddDesignMat1->Page = "#";
            $this->AddDesignMat2 = new clsControl(ccsLink, "AddDesignMat2", "AddDesignMat2", ccsText, "", CCGetRequestParam("AddDesignMat2", $Method, NULL), $this);
            $this->AddDesignMat2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddDesignMat2->Page = "#";
            $this->AddDesignMat3 = new clsControl(ccsLink, "AddDesignMat3", "AddDesignMat3", ccsText, "", CCGetRequestParam("AddDesignMat3", $Method, NULL), $this);
            $this->AddDesignMat3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddDesignMat3->Page = "#";
            $this->AddDesignMat4 = new clsControl(ccsLink, "AddDesignMat4", "AddDesignMat4", ccsText, "", CCGetRequestParam("AddDesignMat4", $Method, NULL), $this);
            $this->AddDesignMat4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddDesignMat4->Page = "#";
            $this->DelGlaze1 = new clsControl(ccsLink, "DelGlaze1", "DelGlaze1", ccsText, "", CCGetRequestParam("DelGlaze1", $Method, NULL), $this);
            $this->DelGlaze1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelGlaze1->Page = "#";
            $this->DelDesignMat1 = new clsControl(ccsLink, "DelDesignMat1", "DelDesignMat1", ccsText, "", CCGetRequestParam("DelDesignMat1", $Method, NULL), $this);
            $this->DelDesignMat1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelDesignMat1->Page = "#";
            $this->DelGlaze2 = new clsControl(ccsLink, "DelGlaze2", "DelGlaze2", ccsText, "", CCGetRequestParam("DelGlaze2", $Method, NULL), $this);
            $this->DelGlaze2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelGlaze2->Page = "#";
            $this->DelGlaze3 = new clsControl(ccsLink, "DelGlaze3", "DelGlaze3", ccsText, "", CCGetRequestParam("DelGlaze3", $Method, NULL), $this);
            $this->DelGlaze3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelGlaze3->Page = "#";
            $this->DelGlaze4 = new clsControl(ccsLink, "DelGlaze4", "DelGlaze4", ccsText, "", CCGetRequestParam("DelGlaze4", $Method, NULL), $this);
            $this->DelGlaze4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelGlaze4->Page = "#";
            $this->DelDesignMat2 = new clsControl(ccsLink, "DelDesignMat2", "DelDesignMat2", ccsText, "", CCGetRequestParam("DelDesignMat2", $Method, NULL), $this);
            $this->DelDesignMat2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelDesignMat2->Page = "#";
            $this->DelDesignMat3 = new clsControl(ccsLink, "DelDesignMat3", "DelDesignMat3", ccsText, "", CCGetRequestParam("DelDesignMat3", $Method, NULL), $this);
            $this->DelDesignMat3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelDesignMat3->Page = "#";
            $this->DelDesignMat4 = new clsControl(ccsLink, "DelDesignMat4", "DelDesignMat4", ccsText, "", CCGetRequestParam("DelDesignMat4", $Method, NULL), $this);
            $this->DelDesignMat4->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->DelDesignMat4->Page = "#";
            $this->AddGlaze1 = new clsControl(ccsLink, "AddGlaze1", "AddGlaze1", ccsText, "", CCGetRequestParam("AddGlaze1", $Method, NULL), $this);
            $this->AddGlaze1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->AddGlaze1->Page = "#";
            $this->LinkCopy = new clsControl(ccsLink, "LinkCopy", "LinkCopy", ccsText, "", CCGetRequestParam("LinkCopy", $Method, NULL), $this);
            $this->LinkCopy->Page = "SampleCeramic.php";
            $this->Diameter = new clsControl(ccsTextBox, "Diameter", "Diameter", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Diameter", $Method, NULL), $this);
            $this->GlazeTechnique = new clsControl(ccsTextBox, "GlazeTechnique", "GlazeTechnique", ccsText, "", CCGetRequestParam("GlazeTechnique", $Method, NULL), $this);
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

//Validate Method @2-78E8BF66
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->CollectCode->Validate() && $Validation);
        $Validation = ($this->ClientCode->Validate() && $Validation);
        $Validation = ($this->ClientDescription->Validate() && $Validation);
        $Validation = ($this->CollectDate->Validate() && $Validation);
        $Validation = ($this->Clay->Validate() && $Validation);
        $Validation = ($this->ClayKG->Validate() && $Validation);
        $Validation = ($this->ClayNote->Validate() && $Validation);
        $Validation = ($this->BuildTech->Validate() && $Validation);
        $Validation = ($this->BuildTechNote->Validate() && $Validation);
        $Validation = ($this->Rim->Validate() && $Validation);
        $Validation = ($this->Feet->Validate() && $Validation);
        $Validation = ($this->Casting1->Validate() && $Validation);
        $Validation = ($this->Casting2->Validate() && $Validation);
        $Validation = ($this->Casting3->Validate() && $Validation);
        $Validation = ($this->Casting4->Validate() && $Validation);
        $Validation = ($this->CastingNote->Validate() && $Validation);
        $Validation = ($this->Estruder1->Validate() && $Validation);
        $Validation = ($this->Estruder2->Validate() && $Validation);
        $Validation = ($this->Estruder3->Validate() && $Validation);
        $Validation = ($this->Estruder4->Validate() && $Validation);
        $Validation = ($this->EstruderNote->Validate() && $Validation);
        $Validation = ($this->Texture1->Validate() && $Validation);
        $Validation = ($this->Texture2->Validate() && $Validation);
        $Validation = ($this->Texture3->Validate() && $Validation);
        $Validation = ($this->Texture4->Validate() && $Validation);
        $Validation = ($this->TextureNote->Validate() && $Validation);
        $Validation = ($this->Tools1->Validate() && $Validation);
        $Validation = ($this->Tools2->Validate() && $Validation);
        $Validation = ($this->Tools3->Validate() && $Validation);
        $Validation = ($this->Tools4->Validate() && $Validation);
        $Validation = ($this->ToolsNote->Validate() && $Validation);
        $Validation = ($this->Engobe1->Validate() && $Validation);
        $Validation = ($this->Engobe2->Validate() && $Validation);
        $Validation = ($this->Engobe3->Validate() && $Validation);
        $Validation = ($this->Engobe4->Validate() && $Validation);
        $Validation = ($this->EngobeNote->Validate() && $Validation);
        $Validation = ($this->BisqueTemp->Validate() && $Validation);
        $Validation = ($this->StainOxide1->Validate() && $Validation);
        $Validation = ($this->StainOxide2->Validate() && $Validation);
        $Validation = ($this->StainOxide3->Validate() && $Validation);
        $Validation = ($this->StainOxide4->Validate() && $Validation);
        $Validation = ($this->StainOxideNote->Validate() && $Validation);
        $Validation = ($this->Glaze1->Validate() && $Validation);
        $Validation = ($this->Glaze2->Validate() && $Validation);
        $Validation = ($this->Glaze3->Validate() && $Validation);
        $Validation = ($this->Glaze4->Validate() && $Validation);
        $Validation = ($this->GlazeDensity1->Validate() && $Validation);
        $Validation = ($this->GlazeDensity2->Validate() && $Validation);
        $Validation = ($this->GlazeDensity3->Validate() && $Validation);
        $Validation = ($this->GlazeDensity4->Validate() && $Validation);
        $Validation = ($this->GlazeNote->Validate() && $Validation);
        $Validation = ($this->GlazeTemp->Validate() && $Validation);
        $Validation = ($this->Firing->Validate() && $Validation);
        $Validation = ($this->FiringNote->Validate() && $Validation);
        $Validation = ($this->Width->Validate() && $Validation);
        $Validation = ($this->FinalSizeNote->Validate() && $Validation);
        $Validation = ($this->DesignMat1->Validate() && $Validation);
        $Validation = ($this->DesignMat2->Validate() && $Validation);
        $Validation = ($this->DesignMat3->Validate() && $Validation);
        $Validation = ($this->DesignMat4->Validate() && $Validation);
        $Validation = ($this->DesignMatQty1->Validate() && $Validation);
        $Validation = ($this->DesignMatQty2->Validate() && $Validation);
        $Validation = ($this->DesignMatQty3->Validate() && $Validation);
        $Validation = ($this->DesignMatQty4->Validate() && $Validation);
        $Validation = ($this->DesignMatNote->Validate() && $Validation);
        $Validation = ($this->History->Validate() && $Validation);
        $Validation = ($this->TechDraw->Validate() && $Validation);
        $Validation = ($this->Photo1->Validate() && $Validation);
        $Validation = ($this->Photo2->Validate() && $Validation);
        $Validation = ($this->Photo3->Validate() && $Validation);
        $Validation = ($this->Photo4->Validate() && $Validation);
        $Validation = ($this->Casting1Desc->Validate() && $Validation);
        $Validation = ($this->Casting2Desc->Validate() && $Validation);
        $Validation = ($this->Casting3Desc->Validate() && $Validation);
        $Validation = ($this->Casting4Desc->Validate() && $Validation);
        $Validation = ($this->Estruder1Desc->Validate() && $Validation);
        $Validation = ($this->Estruder2Desc->Validate() && $Validation);
        $Validation = ($this->Estruder3Desc->Validate() && $Validation);
        $Validation = ($this->Estruder4Desc->Validate() && $Validation);
        $Validation = ($this->Texture1Desc->Validate() && $Validation);
        $Validation = ($this->Texture2Desc->Validate() && $Validation);
        $Validation = ($this->Texture3Desc->Validate() && $Validation);
        $Validation = ($this->Texture4Desc->Validate() && $Validation);
        $Validation = ($this->Tools1Desc->Validate() && $Validation);
        $Validation = ($this->Tools2Desc->Validate() && $Validation);
        $Validation = ($this->Tools3Desc->Validate() && $Validation);
        $Validation = ($this->Tools4Desc->Validate() && $Validation);
        $Validation = ($this->Engobe1Desc->Validate() && $Validation);
        $Validation = ($this->Engobe2Desc->Validate() && $Validation);
        $Validation = ($this->Engobe3Desc->Validate() && $Validation);
        $Validation = ($this->Engobe4Desc->Validate() && $Validation);
        $Validation = ($this->StainOxide1Desc->Validate() && $Validation);
        $Validation = ($this->StainOxide2Desc->Validate() && $Validation);
        $Validation = ($this->StainOxide3Desc->Validate() && $Validation);
        $Validation = ($this->StainOxide4Desc->Validate() && $Validation);
        $Validation = ($this->Glaze1Desc->Validate() && $Validation);
        $Validation = ($this->Glaze2Desc->Validate() && $Validation);
        $Validation = ($this->Glaze3Desc->Validate() && $Validation);
        $Validation = ($this->Glaze4Desc->Validate() && $Validation);
        $Validation = ($this->DesignMat1Desc->Validate() && $Validation);
        $Validation = ($this->DesignMat2Desc->Validate() && $Validation);
        $Validation = ($this->DesignMat3Desc->Validate() && $Validation);
        $Validation = ($this->DesignMat4Desc->Validate() && $Validation);
        $Validation = ($this->Height->Validate() && $Validation);
        $Validation = ($this->Length->Validate() && $Validation);
        $Validation = ($this->ClayDesc->Validate() && $Validation);
        $Validation = ($this->Diameter->Validate() && $Validation);
        $Validation = ($this->GlazeTechnique->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->CollectCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClientCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClientDescription->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CollectDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Clay->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClayKG->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClayNote->Errors->Count() == 0);
        $Validation =  $Validation && ($this->BuildTech->Errors->Count() == 0);
        $Validation =  $Validation && ($this->BuildTechNote->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Rim->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Feet->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Casting1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Casting2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Casting3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Casting4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CastingNote->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Estruder1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Estruder2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Estruder3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Estruder4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->EstruderNote->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Texture1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Texture2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Texture3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Texture4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextureNote->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Tools1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Tools2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Tools3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Tools4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ToolsNote->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Engobe1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Engobe2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Engobe3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Engobe4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->EngobeNote->Errors->Count() == 0);
        $Validation =  $Validation && ($this->BisqueTemp->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxide1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxide2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxide3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxide4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxideNote->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Glaze1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Glaze2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Glaze3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Glaze4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GlazeDensity1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GlazeDensity2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GlazeDensity3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GlazeDensity4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GlazeNote->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GlazeTemp->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Firing->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FiringNote->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Width->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FinalSizeNote->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatQty1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatQty2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatQty3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatQty4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatNote->Errors->Count() == 0);
        $Validation =  $Validation && ($this->History->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TechDraw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Photo1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Photo2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Photo3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Photo4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Casting1Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Casting2Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Casting3Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Casting4Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Estruder1Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Estruder2Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Estruder3Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Estruder4Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Texture1Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Texture2Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Texture3Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Texture4Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Tools1Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Tools2Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Tools3Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Tools4Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Engobe1Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Engobe2Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Engobe3Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Engobe4Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxide1Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxide2Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxide3Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->StainOxide4Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Glaze1Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Glaze2Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Glaze3Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Glaze4Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat1Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat2Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat3Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMat4Desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Height->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Length->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClayDesc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Diameter->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GlazeTechnique->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-6CAF23BC
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->CollectCode->Errors->Count());
        $errors = ($errors || $this->ClientCode->Errors->Count());
        $errors = ($errors || $this->ClientDescription->Errors->Count());
        $errors = ($errors || $this->CollectDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_SampleDate->Errors->Count());
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
        $errors = ($errors || $this->History->Errors->Count());
        $errors = ($errors || $this->TechDraw->Errors->Count());
        $errors = ($errors || $this->Photo1->Errors->Count());
        $errors = ($errors || $this->Photo2->Errors->Count());
        $errors = ($errors || $this->Photo3->Errors->Count());
        $errors = ($errors || $this->Photo4->Errors->Count());
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
        $errors = ($errors || $this->Tools1Desc->Errors->Count());
        $errors = ($errors || $this->Tools2Desc->Errors->Count());
        $errors = ($errors || $this->Tools3Desc->Errors->Count());
        $errors = ($errors || $this->Tools4Desc->Errors->Count());
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
        $errors = ($errors || $this->Height->Errors->Count());
        $errors = ($errors || $this->Length->Errors->Count());
        $errors = ($errors || $this->AddClay->Errors->Count());
        $errors = ($errors || $this->DelClay->Errors->Count());
        $errors = ($errors || $this->ClayDesc->Errors->Count());
        $errors = ($errors || $this->DelCasting1->Errors->Count());
        $errors = ($errors || $this->AddCasting1->Errors->Count());
        $errors = ($errors || $this->AddCasting2->Errors->Count());
        $errors = ($errors || $this->DelCasting2->Errors->Count());
        $errors = ($errors || $this->AddCasting3->Errors->Count());
        $errors = ($errors || $this->DelCasting3->Errors->Count());
        $errors = ($errors || $this->DelCasting4->Errors->Count());
        $errors = ($errors || $this->AddCasting4->Errors->Count());
        $errors = ($errors || $this->DelEstruder1->Errors->Count());
        $errors = ($errors || $this->AddEstruder1->Errors->Count());
        $errors = ($errors || $this->DelEstruder2->Errors->Count());
        $errors = ($errors || $this->AddEstruder2->Errors->Count());
        $errors = ($errors || $this->DelEstruder3->Errors->Count());
        $errors = ($errors || $this->AddEstruder3->Errors->Count());
        $errors = ($errors || $this->DelEstruder4->Errors->Count());
        $errors = ($errors || $this->AddEstruder4->Errors->Count());
        $errors = ($errors || $this->AddTexture1->Errors->Count());
        $errors = ($errors || $this->DelTexture1->Errors->Count());
        $errors = ($errors || $this->AddTexture2->Errors->Count());
        $errors = ($errors || $this->DelTexture2->Errors->Count());
        $errors = ($errors || $this->AddTexture3->Errors->Count());
        $errors = ($errors || $this->DelTexture3->Errors->Count());
        $errors = ($errors || $this->DelTexture4->Errors->Count());
        $errors = ($errors || $this->AddTexture4->Errors->Count());
        $errors = ($errors || $this->DelTools1->Errors->Count());
        $errors = ($errors || $this->DelTools2->Errors->Count());
        $errors = ($errors || $this->DelTools3->Errors->Count());
        $errors = ($errors || $this->DelTools4->Errors->Count());
        $errors = ($errors || $this->AddTools1->Errors->Count());
        $errors = ($errors || $this->AddTools2->Errors->Count());
        $errors = ($errors || $this->AddTools3->Errors->Count());
        $errors = ($errors || $this->AddTools4->Errors->Count());
        $errors = ($errors || $this->AddEngobe1->Errors->Count());
        $errors = ($errors || $this->AddEngobe2->Errors->Count());
        $errors = ($errors || $this->AddEngobe3->Errors->Count());
        $errors = ($errors || $this->AddEngobe4->Errors->Count());
        $errors = ($errors || $this->DelEngobe1->Errors->Count());
        $errors = ($errors || $this->DelEngobe2->Errors->Count());
        $errors = ($errors || $this->DelEngobe3->Errors->Count());
        $errors = ($errors || $this->DelEngobe4->Errors->Count());
        $errors = ($errors || $this->AddStainOxide1->Errors->Count());
        $errors = ($errors || $this->AddStainOxide2->Errors->Count());
        $errors = ($errors || $this->AddStainOxide3->Errors->Count());
        $errors = ($errors || $this->AddStainOxide4->Errors->Count());
        $errors = ($errors || $this->DelStainOxide1->Errors->Count());
        $errors = ($errors || $this->DelStainOxide2->Errors->Count());
        $errors = ($errors || $this->DelStainOxide3->Errors->Count());
        $errors = ($errors || $this->DelStainOxide4->Errors->Count());
        $errors = ($errors || $this->AddGlaze2->Errors->Count());
        $errors = ($errors || $this->AddGlaze3->Errors->Count());
        $errors = ($errors || $this->AddGlaze4->Errors->Count());
        $errors = ($errors || $this->AddDesignMat1->Errors->Count());
        $errors = ($errors || $this->AddDesignMat2->Errors->Count());
        $errors = ($errors || $this->AddDesignMat3->Errors->Count());
        $errors = ($errors || $this->AddDesignMat4->Errors->Count());
        $errors = ($errors || $this->DelGlaze1->Errors->Count());
        $errors = ($errors || $this->DelDesignMat1->Errors->Count());
        $errors = ($errors || $this->DelGlaze2->Errors->Count());
        $errors = ($errors || $this->DelGlaze3->Errors->Count());
        $errors = ($errors || $this->DelGlaze4->Errors->Count());
        $errors = ($errors || $this->DelDesignMat2->Errors->Count());
        $errors = ($errors || $this->DelDesignMat3->Errors->Count());
        $errors = ($errors || $this->DelDesignMat4->Errors->Count());
        $errors = ($errors || $this->AddGlaze1->Errors->Count());
        $errors = ($errors || $this->LinkCopy->Errors->Count());
        $errors = ($errors || $this->Diameter->Errors->Count());
        $errors = ($errors || $this->GlazeTechnique->Errors->Count());
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

//Operation Method @2-B8CA3FF4
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
            $Redirect = "Collection.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "Collection.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "Collection.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID"));
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

//InsertRow Method @2-49A7DFA1
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->CollectCode->SetValue($this->CollectCode->GetValue(true));
        $this->DataSource->ClientCode->SetValue($this->ClientCode->GetValue(true));
        $this->DataSource->ClientDescription->SetValue($this->ClientDescription->GetValue(true));
        $this->DataSource->CollectDate->SetValue($this->CollectDate->GetValue(true));
        $this->DataSource->Clay->SetValue($this->Clay->GetValue(true));
        $this->DataSource->ClayKG->SetValue($this->ClayKG->GetValue(true));
        $this->DataSource->ClayNote->SetValue($this->ClayNote->GetValue(true));
        $this->DataSource->BuildTech->SetValue($this->BuildTech->GetValue(true));
        $this->DataSource->BuildTechNote->SetValue($this->BuildTechNote->GetValue(true));
        $this->DataSource->Rim->SetValue($this->Rim->GetValue(true));
        $this->DataSource->Feet->SetValue($this->Feet->GetValue(true));
        $this->DataSource->Casting1->SetValue($this->Casting1->GetValue(true));
        $this->DataSource->Casting2->SetValue($this->Casting2->GetValue(true));
        $this->DataSource->Casting3->SetValue($this->Casting3->GetValue(true));
        $this->DataSource->Casting4->SetValue($this->Casting4->GetValue(true));
        $this->DataSource->CastingNote->SetValue($this->CastingNote->GetValue(true));
        $this->DataSource->Estruder1->SetValue($this->Estruder1->GetValue(true));
        $this->DataSource->Estruder2->SetValue($this->Estruder2->GetValue(true));
        $this->DataSource->Estruder3->SetValue($this->Estruder3->GetValue(true));
        $this->DataSource->Estruder4->SetValue($this->Estruder4->GetValue(true));
        $this->DataSource->EstruderNote->SetValue($this->EstruderNote->GetValue(true));
        $this->DataSource->Texture1->SetValue($this->Texture1->GetValue(true));
        $this->DataSource->Texture2->SetValue($this->Texture2->GetValue(true));
        $this->DataSource->Texture3->SetValue($this->Texture3->GetValue(true));
        $this->DataSource->Texture4->SetValue($this->Texture4->GetValue(true));
        $this->DataSource->TextureNote->SetValue($this->TextureNote->GetValue(true));
        $this->DataSource->Tools1->SetValue($this->Tools1->GetValue(true));
        $this->DataSource->Tools2->SetValue($this->Tools2->GetValue(true));
        $this->DataSource->Tools3->SetValue($this->Tools3->GetValue(true));
        $this->DataSource->Tools4->SetValue($this->Tools4->GetValue(true));
        $this->DataSource->ToolsNote->SetValue($this->ToolsNote->GetValue(true));
        $this->DataSource->Engobe1->SetValue($this->Engobe1->GetValue(true));
        $this->DataSource->Engobe2->SetValue($this->Engobe2->GetValue(true));
        $this->DataSource->Engobe3->SetValue($this->Engobe3->GetValue(true));
        $this->DataSource->Engobe4->SetValue($this->Engobe4->GetValue(true));
        $this->DataSource->EngobeNote->SetValue($this->EngobeNote->GetValue(true));
        $this->DataSource->BisqueTemp->SetValue($this->BisqueTemp->GetValue(true));
        $this->DataSource->StainOxide1->SetValue($this->StainOxide1->GetValue(true));
        $this->DataSource->StainOxide2->SetValue($this->StainOxide2->GetValue(true));
        $this->DataSource->StainOxide3->SetValue($this->StainOxide3->GetValue(true));
        $this->DataSource->StainOxide4->SetValue($this->StainOxide4->GetValue(true));
        $this->DataSource->StainOxideNote->SetValue($this->StainOxideNote->GetValue(true));
        $this->DataSource->Glaze1->SetValue($this->Glaze1->GetValue(true));
        $this->DataSource->Glaze2->SetValue($this->Glaze2->GetValue(true));
        $this->DataSource->Glaze3->SetValue($this->Glaze3->GetValue(true));
        $this->DataSource->Glaze4->SetValue($this->Glaze4->GetValue(true));
        $this->DataSource->GlazeDensity1->SetValue($this->GlazeDensity1->GetValue(true));
        $this->DataSource->GlazeDensity2->SetValue($this->GlazeDensity2->GetValue(true));
        $this->DataSource->GlazeDensity3->SetValue($this->GlazeDensity3->GetValue(true));
        $this->DataSource->GlazeDensity4->SetValue($this->GlazeDensity4->GetValue(true));
        $this->DataSource->GlazeNote->SetValue($this->GlazeNote->GetValue(true));
        $this->DataSource->GlazeTemp->SetValue($this->GlazeTemp->GetValue(true));
        $this->DataSource->Firing->SetValue($this->Firing->GetValue(true));
        $this->DataSource->FiringNote->SetValue($this->FiringNote->GetValue(true));
        $this->DataSource->Width->SetValue($this->Width->GetValue(true));
        $this->DataSource->FinalSizeNote->SetValue($this->FinalSizeNote->GetValue(true));
        $this->DataSource->DesignMat1->SetValue($this->DesignMat1->GetValue(true));
        $this->DataSource->DesignMat2->SetValue($this->DesignMat2->GetValue(true));
        $this->DataSource->DesignMat3->SetValue($this->DesignMat3->GetValue(true));
        $this->DataSource->DesignMat4->SetValue($this->DesignMat4->GetValue(true));
        $this->DataSource->DesignMatQty1->SetValue($this->DesignMatQty1->GetValue(true));
        $this->DataSource->DesignMatQty2->SetValue($this->DesignMatQty2->GetValue(true));
        $this->DataSource->DesignMatQty3->SetValue($this->DesignMatQty3->GetValue(true));
        $this->DataSource->DesignMatQty4->SetValue($this->DesignMatQty4->GetValue(true));
        $this->DataSource->DesignMatNote->SetValue($this->DesignMatNote->GetValue(true));
        $this->DataSource->History->SetValue($this->History->GetValue(true));
        $this->DataSource->TechDraw->SetValue($this->TechDraw->GetValue(true));
        $this->DataSource->Photo1->SetValue($this->Photo1->GetValue(true));
        $this->DataSource->Photo2->SetValue($this->Photo2->GetValue(true));
        $this->DataSource->Photo3->SetValue($this->Photo3->GetValue(true));
        $this->DataSource->Photo4->SetValue($this->Photo4->GetValue(true));
        $this->DataSource->Casting1Desc->SetValue($this->Casting1Desc->GetValue(true));
        $this->DataSource->Casting2Desc->SetValue($this->Casting2Desc->GetValue(true));
        $this->DataSource->Casting3Desc->SetValue($this->Casting3Desc->GetValue(true));
        $this->DataSource->Casting4Desc->SetValue($this->Casting4Desc->GetValue(true));
        $this->DataSource->Estruder1Desc->SetValue($this->Estruder1Desc->GetValue(true));
        $this->DataSource->Estruder2Desc->SetValue($this->Estruder2Desc->GetValue(true));
        $this->DataSource->Estruder3Desc->SetValue($this->Estruder3Desc->GetValue(true));
        $this->DataSource->Estruder4Desc->SetValue($this->Estruder4Desc->GetValue(true));
        $this->DataSource->Texture1Desc->SetValue($this->Texture1Desc->GetValue(true));
        $this->DataSource->Texture2Desc->SetValue($this->Texture2Desc->GetValue(true));
        $this->DataSource->Texture3Desc->SetValue($this->Texture3Desc->GetValue(true));
        $this->DataSource->Texture4Desc->SetValue($this->Texture4Desc->GetValue(true));
        $this->DataSource->Tools1Desc->SetValue($this->Tools1Desc->GetValue(true));
        $this->DataSource->Tools2Desc->SetValue($this->Tools2Desc->GetValue(true));
        $this->DataSource->Tools3Desc->SetValue($this->Tools3Desc->GetValue(true));
        $this->DataSource->Tools4Desc->SetValue($this->Tools4Desc->GetValue(true));
        $this->DataSource->Engobe1Desc->SetValue($this->Engobe1Desc->GetValue(true));
        $this->DataSource->Engobe2Desc->SetValue($this->Engobe2Desc->GetValue(true));
        $this->DataSource->Engobe3Desc->SetValue($this->Engobe3Desc->GetValue(true));
        $this->DataSource->Engobe4Desc->SetValue($this->Engobe4Desc->GetValue(true));
        $this->DataSource->StainOxide1Desc->SetValue($this->StainOxide1Desc->GetValue(true));
        $this->DataSource->StainOxide2Desc->SetValue($this->StainOxide2Desc->GetValue(true));
        $this->DataSource->StainOxide3Desc->SetValue($this->StainOxide3Desc->GetValue(true));
        $this->DataSource->StainOxide4Desc->SetValue($this->StainOxide4Desc->GetValue(true));
        $this->DataSource->Glaze1Desc->SetValue($this->Glaze1Desc->GetValue(true));
        $this->DataSource->Glaze2Desc->SetValue($this->Glaze2Desc->GetValue(true));
        $this->DataSource->Glaze3Desc->SetValue($this->Glaze3Desc->GetValue(true));
        $this->DataSource->Glaze4Desc->SetValue($this->Glaze4Desc->GetValue(true));
        $this->DataSource->DesignMat1Desc->SetValue($this->DesignMat1Desc->GetValue(true));
        $this->DataSource->DesignMat2Desc->SetValue($this->DesignMat2Desc->GetValue(true));
        $this->DataSource->DesignMat3Desc->SetValue($this->DesignMat3Desc->GetValue(true));
        $this->DataSource->DesignMat4Desc->SetValue($this->DesignMat4Desc->GetValue(true));
        $this->DataSource->Height->SetValue($this->Height->GetValue(true));
        $this->DataSource->Length->SetValue($this->Length->GetValue(true));
        $this->DataSource->AddClay->SetValue($this->AddClay->GetValue(true));
        $this->DataSource->DelClay->SetValue($this->DelClay->GetValue(true));
        $this->DataSource->ClayDesc->SetValue($this->ClayDesc->GetValue(true));
        $this->DataSource->DelCasting1->SetValue($this->DelCasting1->GetValue(true));
        $this->DataSource->AddCasting1->SetValue($this->AddCasting1->GetValue(true));
        $this->DataSource->AddCasting2->SetValue($this->AddCasting2->GetValue(true));
        $this->DataSource->DelCasting2->SetValue($this->DelCasting2->GetValue(true));
        $this->DataSource->AddCasting3->SetValue($this->AddCasting3->GetValue(true));
        $this->DataSource->DelCasting3->SetValue($this->DelCasting3->GetValue(true));
        $this->DataSource->DelCasting4->SetValue($this->DelCasting4->GetValue(true));
        $this->DataSource->AddCasting4->SetValue($this->AddCasting4->GetValue(true));
        $this->DataSource->DelEstruder1->SetValue($this->DelEstruder1->GetValue(true));
        $this->DataSource->AddEstruder1->SetValue($this->AddEstruder1->GetValue(true));
        $this->DataSource->DelEstruder2->SetValue($this->DelEstruder2->GetValue(true));
        $this->DataSource->AddEstruder2->SetValue($this->AddEstruder2->GetValue(true));
        $this->DataSource->DelEstruder3->SetValue($this->DelEstruder3->GetValue(true));
        $this->DataSource->AddEstruder3->SetValue($this->AddEstruder3->GetValue(true));
        $this->DataSource->DelEstruder4->SetValue($this->DelEstruder4->GetValue(true));
        $this->DataSource->AddEstruder4->SetValue($this->AddEstruder4->GetValue(true));
        $this->DataSource->AddTexture1->SetValue($this->AddTexture1->GetValue(true));
        $this->DataSource->DelTexture1->SetValue($this->DelTexture1->GetValue(true));
        $this->DataSource->AddTexture2->SetValue($this->AddTexture2->GetValue(true));
        $this->DataSource->DelTexture2->SetValue($this->DelTexture2->GetValue(true));
        $this->DataSource->AddTexture3->SetValue($this->AddTexture3->GetValue(true));
        $this->DataSource->DelTexture3->SetValue($this->DelTexture3->GetValue(true));
        $this->DataSource->DelTexture4->SetValue($this->DelTexture4->GetValue(true));
        $this->DataSource->AddTexture4->SetValue($this->AddTexture4->GetValue(true));
        $this->DataSource->DelTools1->SetValue($this->DelTools1->GetValue(true));
        $this->DataSource->DelTools2->SetValue($this->DelTools2->GetValue(true));
        $this->DataSource->DelTools3->SetValue($this->DelTools3->GetValue(true));
        $this->DataSource->DelTools4->SetValue($this->DelTools4->GetValue(true));
        $this->DataSource->AddTools1->SetValue($this->AddTools1->GetValue(true));
        $this->DataSource->AddTools2->SetValue($this->AddTools2->GetValue(true));
        $this->DataSource->AddTools3->SetValue($this->AddTools3->GetValue(true));
        $this->DataSource->AddTools4->SetValue($this->AddTools4->GetValue(true));
        $this->DataSource->AddEngobe1->SetValue($this->AddEngobe1->GetValue(true));
        $this->DataSource->AddEngobe2->SetValue($this->AddEngobe2->GetValue(true));
        $this->DataSource->AddEngobe3->SetValue($this->AddEngobe3->GetValue(true));
        $this->DataSource->AddEngobe4->SetValue($this->AddEngobe4->GetValue(true));
        $this->DataSource->DelEngobe1->SetValue($this->DelEngobe1->GetValue(true));
        $this->DataSource->DelEngobe2->SetValue($this->DelEngobe2->GetValue(true));
        $this->DataSource->DelEngobe3->SetValue($this->DelEngobe3->GetValue(true));
        $this->DataSource->DelEngobe4->SetValue($this->DelEngobe4->GetValue(true));
        $this->DataSource->AddStainOxide1->SetValue($this->AddStainOxide1->GetValue(true));
        $this->DataSource->AddStainOxide2->SetValue($this->AddStainOxide2->GetValue(true));
        $this->DataSource->AddStainOxide3->SetValue($this->AddStainOxide3->GetValue(true));
        $this->DataSource->AddStainOxide4->SetValue($this->AddStainOxide4->GetValue(true));
        $this->DataSource->DelStainOxide1->SetValue($this->DelStainOxide1->GetValue(true));
        $this->DataSource->DelStainOxide2->SetValue($this->DelStainOxide2->GetValue(true));
        $this->DataSource->DelStainOxide3->SetValue($this->DelStainOxide3->GetValue(true));
        $this->DataSource->DelStainOxide4->SetValue($this->DelStainOxide4->GetValue(true));
        $this->DataSource->AddGlaze2->SetValue($this->AddGlaze2->GetValue(true));
        $this->DataSource->AddGlaze3->SetValue($this->AddGlaze3->GetValue(true));
        $this->DataSource->AddGlaze4->SetValue($this->AddGlaze4->GetValue(true));
        $this->DataSource->AddDesignMat1->SetValue($this->AddDesignMat1->GetValue(true));
        $this->DataSource->AddDesignMat2->SetValue($this->AddDesignMat2->GetValue(true));
        $this->DataSource->AddDesignMat3->SetValue($this->AddDesignMat3->GetValue(true));
        $this->DataSource->AddDesignMat4->SetValue($this->AddDesignMat4->GetValue(true));
        $this->DataSource->DelGlaze1->SetValue($this->DelGlaze1->GetValue(true));
        $this->DataSource->DelDesignMat1->SetValue($this->DelDesignMat1->GetValue(true));
        $this->DataSource->DelGlaze2->SetValue($this->DelGlaze2->GetValue(true));
        $this->DataSource->DelGlaze3->SetValue($this->DelGlaze3->GetValue(true));
        $this->DataSource->DelGlaze4->SetValue($this->DelGlaze4->GetValue(true));
        $this->DataSource->DelDesignMat2->SetValue($this->DelDesignMat2->GetValue(true));
        $this->DataSource->DelDesignMat3->SetValue($this->DelDesignMat3->GetValue(true));
        $this->DataSource->DelDesignMat4->SetValue($this->DelDesignMat4->GetValue(true));
        $this->DataSource->AddGlaze1->SetValue($this->AddGlaze1->GetValue(true));
        $this->DataSource->LinkCopy->SetValue($this->LinkCopy->GetValue(true));
        $this->DataSource->Diameter->SetValue($this->Diameter->GetValue(true));
        $this->DataSource->GlazeTechnique->SetValue($this->GlazeTechnique->GetValue(true));
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

//UpdateRow Method @2-3328ADFA
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->CollectCode->SetValue($this->CollectCode->GetValue(true));
        $this->DataSource->ClientCode->SetValue($this->ClientCode->GetValue(true));
        $this->DataSource->ClientDescription->SetValue($this->ClientDescription->GetValue(true));
        $this->DataSource->CollectDate->SetValue($this->CollectDate->GetValue(true));
        $this->DataSource->Clay->SetValue($this->Clay->GetValue(true));
        $this->DataSource->ClayKG->SetValue($this->ClayKG->GetValue(true));
        $this->DataSource->ClayNote->SetValue($this->ClayNote->GetValue(true));
        $this->DataSource->BuildTech->SetValue($this->BuildTech->GetValue(true));
        $this->DataSource->BuildTechNote->SetValue($this->BuildTechNote->GetValue(true));
        $this->DataSource->Rim->SetValue($this->Rim->GetValue(true));
        $this->DataSource->Feet->SetValue($this->Feet->GetValue(true));
        $this->DataSource->Casting1->SetValue($this->Casting1->GetValue(true));
        $this->DataSource->Casting2->SetValue($this->Casting2->GetValue(true));
        $this->DataSource->Casting3->SetValue($this->Casting3->GetValue(true));
        $this->DataSource->Casting4->SetValue($this->Casting4->GetValue(true));
        $this->DataSource->CastingNote->SetValue($this->CastingNote->GetValue(true));
        $this->DataSource->Estruder1->SetValue($this->Estruder1->GetValue(true));
        $this->DataSource->Estruder2->SetValue($this->Estruder2->GetValue(true));
        $this->DataSource->Estruder3->SetValue($this->Estruder3->GetValue(true));
        $this->DataSource->Estruder4->SetValue($this->Estruder4->GetValue(true));
        $this->DataSource->EstruderNote->SetValue($this->EstruderNote->GetValue(true));
        $this->DataSource->Texture1->SetValue($this->Texture1->GetValue(true));
        $this->DataSource->Texture2->SetValue($this->Texture2->GetValue(true));
        $this->DataSource->Texture3->SetValue($this->Texture3->GetValue(true));
        $this->DataSource->Texture4->SetValue($this->Texture4->GetValue(true));
        $this->DataSource->TextureNote->SetValue($this->TextureNote->GetValue(true));
        $this->DataSource->Tools1->SetValue($this->Tools1->GetValue(true));
        $this->DataSource->Tools2->SetValue($this->Tools2->GetValue(true));
        $this->DataSource->Tools3->SetValue($this->Tools3->GetValue(true));
        $this->DataSource->Tools4->SetValue($this->Tools4->GetValue(true));
        $this->DataSource->ToolsNote->SetValue($this->ToolsNote->GetValue(true));
        $this->DataSource->Engobe1->SetValue($this->Engobe1->GetValue(true));
        $this->DataSource->Engobe2->SetValue($this->Engobe2->GetValue(true));
        $this->DataSource->Engobe3->SetValue($this->Engobe3->GetValue(true));
        $this->DataSource->Engobe4->SetValue($this->Engobe4->GetValue(true));
        $this->DataSource->EngobeNote->SetValue($this->EngobeNote->GetValue(true));
        $this->DataSource->BisqueTemp->SetValue($this->BisqueTemp->GetValue(true));
        $this->DataSource->StainOxide1->SetValue($this->StainOxide1->GetValue(true));
        $this->DataSource->StainOxide2->SetValue($this->StainOxide2->GetValue(true));
        $this->DataSource->StainOxide3->SetValue($this->StainOxide3->GetValue(true));
        $this->DataSource->StainOxide4->SetValue($this->StainOxide4->GetValue(true));
        $this->DataSource->StainOxideNote->SetValue($this->StainOxideNote->GetValue(true));
        $this->DataSource->Glaze1->SetValue($this->Glaze1->GetValue(true));
        $this->DataSource->Glaze2->SetValue($this->Glaze2->GetValue(true));
        $this->DataSource->Glaze3->SetValue($this->Glaze3->GetValue(true));
        $this->DataSource->Glaze4->SetValue($this->Glaze4->GetValue(true));
        $this->DataSource->GlazeDensity1->SetValue($this->GlazeDensity1->GetValue(true));
        $this->DataSource->GlazeDensity2->SetValue($this->GlazeDensity2->GetValue(true));
        $this->DataSource->GlazeDensity3->SetValue($this->GlazeDensity3->GetValue(true));
        $this->DataSource->GlazeDensity4->SetValue($this->GlazeDensity4->GetValue(true));
        $this->DataSource->GlazeNote->SetValue($this->GlazeNote->GetValue(true));
        $this->DataSource->GlazeTemp->SetValue($this->GlazeTemp->GetValue(true));
        $this->DataSource->Firing->SetValue($this->Firing->GetValue(true));
        $this->DataSource->FiringNote->SetValue($this->FiringNote->GetValue(true));
        $this->DataSource->Width->SetValue($this->Width->GetValue(true));
        $this->DataSource->FinalSizeNote->SetValue($this->FinalSizeNote->GetValue(true));
        $this->DataSource->DesignMat1->SetValue($this->DesignMat1->GetValue(true));
        $this->DataSource->DesignMat2->SetValue($this->DesignMat2->GetValue(true));
        $this->DataSource->DesignMat3->SetValue($this->DesignMat3->GetValue(true));
        $this->DataSource->DesignMat4->SetValue($this->DesignMat4->GetValue(true));
        $this->DataSource->DesignMatQty1->SetValue($this->DesignMatQty1->GetValue(true));
        $this->DataSource->DesignMatQty2->SetValue($this->DesignMatQty2->GetValue(true));
        $this->DataSource->DesignMatQty3->SetValue($this->DesignMatQty3->GetValue(true));
        $this->DataSource->DesignMatQty4->SetValue($this->DesignMatQty4->GetValue(true));
        $this->DataSource->DesignMatNote->SetValue($this->DesignMatNote->GetValue(true));
        $this->DataSource->History->SetValue($this->History->GetValue(true));
        $this->DataSource->TechDraw->SetValue($this->TechDraw->GetValue(true));
        $this->DataSource->Photo1->SetValue($this->Photo1->GetValue(true));
        $this->DataSource->Photo2->SetValue($this->Photo2->GetValue(true));
        $this->DataSource->Photo3->SetValue($this->Photo3->GetValue(true));
        $this->DataSource->Photo4->SetValue($this->Photo4->GetValue(true));
        $this->DataSource->Casting1Desc->SetValue($this->Casting1Desc->GetValue(true));
        $this->DataSource->Casting2Desc->SetValue($this->Casting2Desc->GetValue(true));
        $this->DataSource->Casting3Desc->SetValue($this->Casting3Desc->GetValue(true));
        $this->DataSource->Casting4Desc->SetValue($this->Casting4Desc->GetValue(true));
        $this->DataSource->Estruder1Desc->SetValue($this->Estruder1Desc->GetValue(true));
        $this->DataSource->Estruder2Desc->SetValue($this->Estruder2Desc->GetValue(true));
        $this->DataSource->Estruder3Desc->SetValue($this->Estruder3Desc->GetValue(true));
        $this->DataSource->Estruder4Desc->SetValue($this->Estruder4Desc->GetValue(true));
        $this->DataSource->Texture1Desc->SetValue($this->Texture1Desc->GetValue(true));
        $this->DataSource->Texture2Desc->SetValue($this->Texture2Desc->GetValue(true));
        $this->DataSource->Texture3Desc->SetValue($this->Texture3Desc->GetValue(true));
        $this->DataSource->Texture4Desc->SetValue($this->Texture4Desc->GetValue(true));
        $this->DataSource->Tools1Desc->SetValue($this->Tools1Desc->GetValue(true));
        $this->DataSource->Tools2Desc->SetValue($this->Tools2Desc->GetValue(true));
        $this->DataSource->Tools3Desc->SetValue($this->Tools3Desc->GetValue(true));
        $this->DataSource->Tools4Desc->SetValue($this->Tools4Desc->GetValue(true));
        $this->DataSource->Engobe1Desc->SetValue($this->Engobe1Desc->GetValue(true));
        $this->DataSource->Engobe2Desc->SetValue($this->Engobe2Desc->GetValue(true));
        $this->DataSource->Engobe3Desc->SetValue($this->Engobe3Desc->GetValue(true));
        $this->DataSource->Engobe4Desc->SetValue($this->Engobe4Desc->GetValue(true));
        $this->DataSource->StainOxide1Desc->SetValue($this->StainOxide1Desc->GetValue(true));
        $this->DataSource->StainOxide2Desc->SetValue($this->StainOxide2Desc->GetValue(true));
        $this->DataSource->StainOxide3Desc->SetValue($this->StainOxide3Desc->GetValue(true));
        $this->DataSource->StainOxide4Desc->SetValue($this->StainOxide4Desc->GetValue(true));
        $this->DataSource->Glaze1Desc->SetValue($this->Glaze1Desc->GetValue(true));
        $this->DataSource->Glaze2Desc->SetValue($this->Glaze2Desc->GetValue(true));
        $this->DataSource->Glaze3Desc->SetValue($this->Glaze3Desc->GetValue(true));
        $this->DataSource->Glaze4Desc->SetValue($this->Glaze4Desc->GetValue(true));
        $this->DataSource->DesignMat1Desc->SetValue($this->DesignMat1Desc->GetValue(true));
        $this->DataSource->DesignMat2Desc->SetValue($this->DesignMat2Desc->GetValue(true));
        $this->DataSource->DesignMat3Desc->SetValue($this->DesignMat3Desc->GetValue(true));
        $this->DataSource->DesignMat4Desc->SetValue($this->DesignMat4Desc->GetValue(true));
        $this->DataSource->Height->SetValue($this->Height->GetValue(true));
        $this->DataSource->Length->SetValue($this->Length->GetValue(true));
        $this->DataSource->AddClay->SetValue($this->AddClay->GetValue(true));
        $this->DataSource->DelClay->SetValue($this->DelClay->GetValue(true));
        $this->DataSource->ClayDesc->SetValue($this->ClayDesc->GetValue(true));
        $this->DataSource->DelCasting1->SetValue($this->DelCasting1->GetValue(true));
        $this->DataSource->AddCasting1->SetValue($this->AddCasting1->GetValue(true));
        $this->DataSource->AddCasting2->SetValue($this->AddCasting2->GetValue(true));
        $this->DataSource->DelCasting2->SetValue($this->DelCasting2->GetValue(true));
        $this->DataSource->AddCasting3->SetValue($this->AddCasting3->GetValue(true));
        $this->DataSource->DelCasting3->SetValue($this->DelCasting3->GetValue(true));
        $this->DataSource->DelCasting4->SetValue($this->DelCasting4->GetValue(true));
        $this->DataSource->AddCasting4->SetValue($this->AddCasting4->GetValue(true));
        $this->DataSource->DelEstruder1->SetValue($this->DelEstruder1->GetValue(true));
        $this->DataSource->AddEstruder1->SetValue($this->AddEstruder1->GetValue(true));
        $this->DataSource->DelEstruder2->SetValue($this->DelEstruder2->GetValue(true));
        $this->DataSource->AddEstruder2->SetValue($this->AddEstruder2->GetValue(true));
        $this->DataSource->DelEstruder3->SetValue($this->DelEstruder3->GetValue(true));
        $this->DataSource->AddEstruder3->SetValue($this->AddEstruder3->GetValue(true));
        $this->DataSource->DelEstruder4->SetValue($this->DelEstruder4->GetValue(true));
        $this->DataSource->AddEstruder4->SetValue($this->AddEstruder4->GetValue(true));
        $this->DataSource->AddTexture1->SetValue($this->AddTexture1->GetValue(true));
        $this->DataSource->DelTexture1->SetValue($this->DelTexture1->GetValue(true));
        $this->DataSource->AddTexture2->SetValue($this->AddTexture2->GetValue(true));
        $this->DataSource->DelTexture2->SetValue($this->DelTexture2->GetValue(true));
        $this->DataSource->AddTexture3->SetValue($this->AddTexture3->GetValue(true));
        $this->DataSource->DelTexture3->SetValue($this->DelTexture3->GetValue(true));
        $this->DataSource->DelTexture4->SetValue($this->DelTexture4->GetValue(true));
        $this->DataSource->AddTexture4->SetValue($this->AddTexture4->GetValue(true));
        $this->DataSource->DelTools1->SetValue($this->DelTools1->GetValue(true));
        $this->DataSource->DelTools2->SetValue($this->DelTools2->GetValue(true));
        $this->DataSource->DelTools3->SetValue($this->DelTools3->GetValue(true));
        $this->DataSource->DelTools4->SetValue($this->DelTools4->GetValue(true));
        $this->DataSource->AddTools1->SetValue($this->AddTools1->GetValue(true));
        $this->DataSource->AddTools2->SetValue($this->AddTools2->GetValue(true));
        $this->DataSource->AddTools3->SetValue($this->AddTools3->GetValue(true));
        $this->DataSource->AddTools4->SetValue($this->AddTools4->GetValue(true));
        $this->DataSource->AddEngobe1->SetValue($this->AddEngobe1->GetValue(true));
        $this->DataSource->AddEngobe2->SetValue($this->AddEngobe2->GetValue(true));
        $this->DataSource->AddEngobe3->SetValue($this->AddEngobe3->GetValue(true));
        $this->DataSource->AddEngobe4->SetValue($this->AddEngobe4->GetValue(true));
        $this->DataSource->DelEngobe1->SetValue($this->DelEngobe1->GetValue(true));
        $this->DataSource->DelEngobe2->SetValue($this->DelEngobe2->GetValue(true));
        $this->DataSource->DelEngobe3->SetValue($this->DelEngobe3->GetValue(true));
        $this->DataSource->DelEngobe4->SetValue($this->DelEngobe4->GetValue(true));
        $this->DataSource->AddStainOxide1->SetValue($this->AddStainOxide1->GetValue(true));
        $this->DataSource->AddStainOxide2->SetValue($this->AddStainOxide2->GetValue(true));
        $this->DataSource->AddStainOxide3->SetValue($this->AddStainOxide3->GetValue(true));
        $this->DataSource->AddStainOxide4->SetValue($this->AddStainOxide4->GetValue(true));
        $this->DataSource->DelStainOxide1->SetValue($this->DelStainOxide1->GetValue(true));
        $this->DataSource->DelStainOxide2->SetValue($this->DelStainOxide2->GetValue(true));
        $this->DataSource->DelStainOxide3->SetValue($this->DelStainOxide3->GetValue(true));
        $this->DataSource->DelStainOxide4->SetValue($this->DelStainOxide4->GetValue(true));
        $this->DataSource->AddGlaze2->SetValue($this->AddGlaze2->GetValue(true));
        $this->DataSource->AddGlaze3->SetValue($this->AddGlaze3->GetValue(true));
        $this->DataSource->AddGlaze4->SetValue($this->AddGlaze4->GetValue(true));
        $this->DataSource->AddDesignMat1->SetValue($this->AddDesignMat1->GetValue(true));
        $this->DataSource->AddDesignMat2->SetValue($this->AddDesignMat2->GetValue(true));
        $this->DataSource->AddDesignMat3->SetValue($this->AddDesignMat3->GetValue(true));
        $this->DataSource->AddDesignMat4->SetValue($this->AddDesignMat4->GetValue(true));
        $this->DataSource->DelGlaze1->SetValue($this->DelGlaze1->GetValue(true));
        $this->DataSource->DelDesignMat1->SetValue($this->DelDesignMat1->GetValue(true));
        $this->DataSource->DelGlaze2->SetValue($this->DelGlaze2->GetValue(true));
        $this->DataSource->DelGlaze3->SetValue($this->DelGlaze3->GetValue(true));
        $this->DataSource->DelGlaze4->SetValue($this->DelGlaze4->GetValue(true));
        $this->DataSource->DelDesignMat2->SetValue($this->DelDesignMat2->GetValue(true));
        $this->DataSource->DelDesignMat3->SetValue($this->DelDesignMat3->GetValue(true));
        $this->DataSource->DelDesignMat4->SetValue($this->DelDesignMat4->GetValue(true));
        $this->DataSource->AddGlaze1->SetValue($this->AddGlaze1->GetValue(true));
        $this->DataSource->LinkCopy->SetValue($this->LinkCopy->GetValue(true));
        $this->DataSource->Diameter->SetValue($this->Diameter->GetValue(true));
        $this->DataSource->GlazeTechnique->SetValue($this->GlazeTechnique->GetValue(true));
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

//Show Method @2-4D64BBD8
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

        $this->BisqueTemp->Prepare();
        $this->Firing->Prepare();

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
                    $this->CollectCode->SetValue($this->DataSource->CollectCode->GetValue());
                    $this->ClientCode->SetValue($this->DataSource->ClientCode->GetValue());
                    $this->ClientDescription->SetValue($this->DataSource->ClientDescription->GetValue());
                    $this->CollectDate->SetValue($this->DataSource->CollectDate->GetValue());
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
                    $this->TechDraw->SetValue($this->DataSource->TechDraw->GetValue());
                    $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                    $this->Photo2->SetValue($this->DataSource->Photo2->GetValue());
                    $this->Photo3->SetValue($this->DataSource->Photo3->GetValue());
                    $this->Photo4->SetValue($this->DataSource->Photo4->GetValue());
                    $this->Height->SetValue($this->DataSource->Height->GetValue());
                    $this->Length->SetValue($this->DataSource->Length->GetValue());
                    $this->Diameter->SetValue($this->DataSource->Diameter->GetValue());
                    $this->GlazeTechnique->SetValue($this->DataSource->GlazeTechnique->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }
        $this->LinkCopy->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->LinkCopy->Parameters = CCAddParam($this->LinkCopy->Parameters, "ID", $this->DataSource->f("ID"));

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->CollectCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CollectDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_SampleDate->Errors->ToString());
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
            $Error = ComposeStrings($Error, $this->History->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Photo4->Errors->ToString());
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
            $Error = ComposeStrings($Error, $this->Tools1Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Tools2Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Tools3Desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Tools4Desc->Errors->ToString());
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
            $Error = ComposeStrings($Error, $this->Height->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Length->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddClay->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelClay->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayDesc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelCasting1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddCasting1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddCasting2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelCasting2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddCasting3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelCasting3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelCasting4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddCasting4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelEstruder1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddEstruder1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelEstruder2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddEstruder2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelEstruder3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddEstruder3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelEstruder4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddEstruder4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddTexture1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelTexture1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddTexture2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelTexture2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddTexture3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelTexture3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelTexture4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddTexture4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelTools1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelTools2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelTools3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelTools4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddTools1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddTools2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddTools3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddTools4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddEngobe1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddEngobe2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddEngobe3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddEngobe4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelEngobe1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelEngobe2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelEngobe3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelEngobe4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddStainOxide1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddStainOxide2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddStainOxide3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddStainOxide4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelStainOxide1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelStainOxide2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelStainOxide3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelStainOxide4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddGlaze2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddGlaze3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddGlaze4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddDesignMat1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddDesignMat2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddDesignMat3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddDesignMat4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelGlaze1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelDesignMat1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelGlaze2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelGlaze3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelGlaze4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelDesignMat2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelDesignMat3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DelDesignMat4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddGlaze1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkCopy->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Diameter->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazeTechnique->Errors->ToString());
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
        $this->CollectCode->Show();
        $this->ClientCode->Show();
        $this->ClientDescription->Show();
        $this->CollectDate->Show();
        $this->DatePicker_SampleDate->Show();
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
        $this->TechDraw->Show();
        $this->Photo1->Show();
        $this->Photo2->Show();
        $this->Photo3->Show();
        $this->Photo4->Show();
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
        $this->Tools1Desc->Show();
        $this->Tools2Desc->Show();
        $this->Tools3Desc->Show();
        $this->Tools4Desc->Show();
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
        $this->Height->Show();
        $this->Length->Show();
        $this->AddClay->Show();
        $this->DelClay->Show();
        $this->ClayDesc->Show();
        $this->DelCasting1->Show();
        $this->AddCasting1->Show();
        $this->AddCasting2->Show();
        $this->DelCasting2->Show();
        $this->AddCasting3->Show();
        $this->DelCasting3->Show();
        $this->DelCasting4->Show();
        $this->AddCasting4->Show();
        $this->DelEstruder1->Show();
        $this->AddEstruder1->Show();
        $this->DelEstruder2->Show();
        $this->AddEstruder2->Show();
        $this->DelEstruder3->Show();
        $this->AddEstruder3->Show();
        $this->DelEstruder4->Show();
        $this->AddEstruder4->Show();
        $this->AddTexture1->Show();
        $this->DelTexture1->Show();
        $this->AddTexture2->Show();
        $this->DelTexture2->Show();
        $this->AddTexture3->Show();
        $this->DelTexture3->Show();
        $this->DelTexture4->Show();
        $this->AddTexture4->Show();
        $this->DelTools1->Show();
        $this->DelTools2->Show();
        $this->DelTools3->Show();
        $this->DelTools4->Show();
        $this->AddTools1->Show();
        $this->AddTools2->Show();
        $this->AddTools3->Show();
        $this->AddTools4->Show();
        $this->AddEngobe1->Show();
        $this->AddEngobe2->Show();
        $this->AddEngobe3->Show();
        $this->AddEngobe4->Show();
        $this->DelEngobe1->Show();
        $this->DelEngobe2->Show();
        $this->DelEngobe3->Show();
        $this->DelEngobe4->Show();
        $this->AddStainOxide1->Show();
        $this->AddStainOxide2->Show();
        $this->AddStainOxide3->Show();
        $this->AddStainOxide4->Show();
        $this->DelStainOxide1->Show();
        $this->DelStainOxide2->Show();
        $this->DelStainOxide3->Show();
        $this->DelStainOxide4->Show();
        $this->AddGlaze2->Show();
        $this->AddGlaze3->Show();
        $this->AddGlaze4->Show();
        $this->AddDesignMat1->Show();
        $this->AddDesignMat2->Show();
        $this->AddDesignMat3->Show();
        $this->AddDesignMat4->Show();
        $this->DelGlaze1->Show();
        $this->DelDesignMat1->Show();
        $this->DelGlaze2->Show();
        $this->DelGlaze3->Show();
        $this->DelGlaze4->Show();
        $this->DelDesignMat2->Show();
        $this->DelDesignMat3->Show();
        $this->DelDesignMat4->Show();
        $this->AddGlaze1->Show();
        $this->LinkCopy->Show();
        $this->Diameter->Show();
        $this->GlazeTechnique->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddSampleCeramic Class @2-FCB6E20C

class clsAddSampleCeramicDataSource extends clsDBGayaFusionAll {  //AddSampleCeramicDataSource Class @2-FBB4BE4C

//DataSource Variables @2-8652FA67
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
    public $CollectCode;
    public $ClientCode;
    public $ClientDescription;
    public $CollectDate;
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
    public $TechDraw;
    public $Photo1;
    public $Photo2;
    public $Photo3;
    public $Photo4;
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
    public $Tools1Desc;
    public $Tools2Desc;
    public $Tools3Desc;
    public $Tools4Desc;
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
    public $Height;
    public $Length;
    public $AddClay;
    public $DelClay;
    public $ClayDesc;
    public $DelCasting1;
    public $AddCasting1;
    public $AddCasting2;
    public $DelCasting2;
    public $AddCasting3;
    public $DelCasting3;
    public $DelCasting4;
    public $AddCasting4;
    public $DelEstruder1;
    public $AddEstruder1;
    public $DelEstruder2;
    public $AddEstruder2;
    public $DelEstruder3;
    public $AddEstruder3;
    public $DelEstruder4;
    public $AddEstruder4;
    public $AddTexture1;
    public $DelTexture1;
    public $AddTexture2;
    public $DelTexture2;
    public $AddTexture3;
    public $DelTexture3;
    public $DelTexture4;
    public $AddTexture4;
    public $DelTools1;
    public $DelTools2;
    public $DelTools3;
    public $DelTools4;
    public $AddTools1;
    public $AddTools2;
    public $AddTools3;
    public $AddTools4;
    public $AddEngobe1;
    public $AddEngobe2;
    public $AddEngobe3;
    public $AddEngobe4;
    public $DelEngobe1;
    public $DelEngobe2;
    public $DelEngobe3;
    public $DelEngobe4;
    public $AddStainOxide1;
    public $AddStainOxide2;
    public $AddStainOxide3;
    public $AddStainOxide4;
    public $DelStainOxide1;
    public $DelStainOxide2;
    public $DelStainOxide3;
    public $DelStainOxide4;
    public $AddGlaze2;
    public $AddGlaze3;
    public $AddGlaze4;
    public $AddDesignMat1;
    public $AddDesignMat2;
    public $AddDesignMat3;
    public $AddDesignMat4;
    public $DelGlaze1;
    public $DelDesignMat1;
    public $DelGlaze2;
    public $DelGlaze3;
    public $DelGlaze4;
    public $DelDesignMat2;
    public $DelDesignMat3;
    public $DelDesignMat4;
    public $AddGlaze1;
    public $LinkCopy;
    public $Diameter;
    public $GlazeTechnique;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-D7FF7899
    function clsAddSampleCeramicDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddSampleCeramic/Error";
        $this->Initialize();
        $this->CollectCode = new clsField("CollectCode", ccsText, "");
        
        $this->ClientCode = new clsField("ClientCode", ccsText, "");
        
        $this->ClientDescription = new clsField("ClientDescription", ccsText, "");
        
        $this->CollectDate = new clsField("CollectDate", ccsDate, $this->DateFormat);
        
        $this->Clay = new clsField("Clay", ccsInteger, "");
        
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
        
        $this->Estruder1 = new clsField("Estruder1", ccsInteger, "");
        
        $this->Estruder2 = new clsField("Estruder2", ccsInteger, "");
        
        $this->Estruder3 = new clsField("Estruder3", ccsInteger, "");
        
        $this->Estruder4 = new clsField("Estruder4", ccsInteger, "");
        
        $this->EstruderNote = new clsField("EstruderNote", ccsMemo, "");
        
        $this->Texture1 = new clsField("Texture1", ccsInteger, "");
        
        $this->Texture2 = new clsField("Texture2", ccsInteger, "");
        
        $this->Texture3 = new clsField("Texture3", ccsInteger, "");
        
        $this->Texture4 = new clsField("Texture4", ccsInteger, "");
        
        $this->TextureNote = new clsField("TextureNote", ccsMemo, "");
        
        $this->Tools1 = new clsField("Tools1", ccsInteger, "");
        
        $this->Tools2 = new clsField("Tools2", ccsInteger, "");
        
        $this->Tools3 = new clsField("Tools3", ccsInteger, "");
        
        $this->Tools4 = new clsField("Tools4", ccsInteger, "");
        
        $this->ToolsNote = new clsField("ToolsNote", ccsMemo, "");
        
        $this->Engobe1 = new clsField("Engobe1", ccsInteger, "");
        
        $this->Engobe2 = new clsField("Engobe2", ccsInteger, "");
        
        $this->Engobe3 = new clsField("Engobe3", ccsInteger, "");
        
        $this->Engobe4 = new clsField("Engobe4", ccsInteger, "");
        
        $this->EngobeNote = new clsField("EngobeNote", ccsMemo, "");
        
        $this->BisqueTemp = new clsField("BisqueTemp", ccsText, "");
        
        $this->StainOxide1 = new clsField("StainOxide1", ccsInteger, "");
        
        $this->StainOxide2 = new clsField("StainOxide2", ccsInteger, "");
        
        $this->StainOxide3 = new clsField("StainOxide3", ccsInteger, "");
        
        $this->StainOxide4 = new clsField("StainOxide4", ccsInteger, "");
        
        $this->StainOxideNote = new clsField("StainOxideNote", ccsMemo, "");
        
        $this->Glaze1 = new clsField("Glaze1", ccsInteger, "");
        
        $this->Glaze2 = new clsField("Glaze2", ccsInteger, "");
        
        $this->Glaze3 = new clsField("Glaze3", ccsInteger, "");
        
        $this->Glaze4 = new clsField("Glaze4", ccsInteger, "");
        
        $this->GlazeDensity1 = new clsField("GlazeDensity1", ccsText, "");
        
        $this->GlazeDensity2 = new clsField("GlazeDensity2", ccsText, "");
        
        $this->GlazeDensity3 = new clsField("GlazeDensity3", ccsText, "");
        
        $this->GlazeDensity4 = new clsField("GlazeDensity4", ccsText, "");
        
        $this->GlazeNote = new clsField("GlazeNote", ccsMemo, "");
        
        $this->GlazeTemp = new clsField("GlazeTemp", ccsText, "");
        
        $this->Firing = new clsField("Firing", ccsText, "");
        
        $this->FiringNote = new clsField("FiringNote", ccsMemo, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->FinalSizeNote = new clsField("FinalSizeNote", ccsMemo, "");
        
        $this->DesignMat1 = new clsField("DesignMat1", ccsInteger, "");
        
        $this->DesignMat2 = new clsField("DesignMat2", ccsInteger, "");
        
        $this->DesignMat3 = new clsField("DesignMat3", ccsInteger, "");
        
        $this->DesignMat4 = new clsField("DesignMat4", ccsInteger, "");
        
        $this->DesignMatQty1 = new clsField("DesignMatQty1", ccsInteger, "");
        
        $this->DesignMatQty2 = new clsField("DesignMatQty2", ccsInteger, "");
        
        $this->DesignMatQty3 = new clsField("DesignMatQty3", ccsInteger, "");
        
        $this->DesignMatQty4 = new clsField("DesignMatQty4", ccsInteger, "");
        
        $this->DesignMatNote = new clsField("DesignMatNote", ccsMemo, "");
        
        $this->History = new clsField("History", ccsMemo, "");
        
        $this->TechDraw = new clsField("TechDraw", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->Photo2 = new clsField("Photo2", ccsText, "");
        
        $this->Photo3 = new clsField("Photo3", ccsText, "");
        
        $this->Photo4 = new clsField("Photo4", ccsText, "");
        
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
        
        $this->Tools1Desc = new clsField("Tools1Desc", ccsText, "");
        
        $this->Tools2Desc = new clsField("Tools2Desc", ccsText, "");
        
        $this->Tools3Desc = new clsField("Tools3Desc", ccsText, "");
        
        $this->Tools4Desc = new clsField("Tools4Desc", ccsText, "");
        
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
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->AddClay = new clsField("AddClay", ccsText, "");
        
        $this->DelClay = new clsField("DelClay", ccsText, "");
        
        $this->ClayDesc = new clsField("ClayDesc", ccsText, "");
        
        $this->DelCasting1 = new clsField("DelCasting1", ccsText, "");
        
        $this->AddCasting1 = new clsField("AddCasting1", ccsText, "");
        
        $this->AddCasting2 = new clsField("AddCasting2", ccsText, "");
        
        $this->DelCasting2 = new clsField("DelCasting2", ccsText, "");
        
        $this->AddCasting3 = new clsField("AddCasting3", ccsText, "");
        
        $this->DelCasting3 = new clsField("DelCasting3", ccsText, "");
        
        $this->DelCasting4 = new clsField("DelCasting4", ccsText, "");
        
        $this->AddCasting4 = new clsField("AddCasting4", ccsText, "");
        
        $this->DelEstruder1 = new clsField("DelEstruder1", ccsText, "");
        
        $this->AddEstruder1 = new clsField("AddEstruder1", ccsText, "");
        
        $this->DelEstruder2 = new clsField("DelEstruder2", ccsText, "");
        
        $this->AddEstruder2 = new clsField("AddEstruder2", ccsText, "");
        
        $this->DelEstruder3 = new clsField("DelEstruder3", ccsText, "");
        
        $this->AddEstruder3 = new clsField("AddEstruder3", ccsText, "");
        
        $this->DelEstruder4 = new clsField("DelEstruder4", ccsText, "");
        
        $this->AddEstruder4 = new clsField("AddEstruder4", ccsText, "");
        
        $this->AddTexture1 = new clsField("AddTexture1", ccsText, "");
        
        $this->DelTexture1 = new clsField("DelTexture1", ccsText, "");
        
        $this->AddTexture2 = new clsField("AddTexture2", ccsText, "");
        
        $this->DelTexture2 = new clsField("DelTexture2", ccsText, "");
        
        $this->AddTexture3 = new clsField("AddTexture3", ccsText, "");
        
        $this->DelTexture3 = new clsField("DelTexture3", ccsText, "");
        
        $this->DelTexture4 = new clsField("DelTexture4", ccsText, "");
        
        $this->AddTexture4 = new clsField("AddTexture4", ccsText, "");
        
        $this->DelTools1 = new clsField("DelTools1", ccsText, "");
        
        $this->DelTools2 = new clsField("DelTools2", ccsText, "");
        
        $this->DelTools3 = new clsField("DelTools3", ccsText, "");
        
        $this->DelTools4 = new clsField("DelTools4", ccsText, "");
        
        $this->AddTools1 = new clsField("AddTools1", ccsText, "");
        
        $this->AddTools2 = new clsField("AddTools2", ccsText, "");
        
        $this->AddTools3 = new clsField("AddTools3", ccsText, "");
        
        $this->AddTools4 = new clsField("AddTools4", ccsText, "");
        
        $this->AddEngobe1 = new clsField("AddEngobe1", ccsText, "");
        
        $this->AddEngobe2 = new clsField("AddEngobe2", ccsText, "");
        
        $this->AddEngobe3 = new clsField("AddEngobe3", ccsText, "");
        
        $this->AddEngobe4 = new clsField("AddEngobe4", ccsText, "");
        
        $this->DelEngobe1 = new clsField("DelEngobe1", ccsText, "");
        
        $this->DelEngobe2 = new clsField("DelEngobe2", ccsText, "");
        
        $this->DelEngobe3 = new clsField("DelEngobe3", ccsText, "");
        
        $this->DelEngobe4 = new clsField("DelEngobe4", ccsText, "");
        
        $this->AddStainOxide1 = new clsField("AddStainOxide1", ccsText, "");
        
        $this->AddStainOxide2 = new clsField("AddStainOxide2", ccsText, "");
        
        $this->AddStainOxide3 = new clsField("AddStainOxide3", ccsText, "");
        
        $this->AddStainOxide4 = new clsField("AddStainOxide4", ccsText, "");
        
        $this->DelStainOxide1 = new clsField("DelStainOxide1", ccsText, "");
        
        $this->DelStainOxide2 = new clsField("DelStainOxide2", ccsText, "");
        
        $this->DelStainOxide3 = new clsField("DelStainOxide3", ccsText, "");
        
        $this->DelStainOxide4 = new clsField("DelStainOxide4", ccsText, "");
        
        $this->AddGlaze2 = new clsField("AddGlaze2", ccsText, "");
        
        $this->AddGlaze3 = new clsField("AddGlaze3", ccsText, "");
        
        $this->AddGlaze4 = new clsField("AddGlaze4", ccsText, "");
        
        $this->AddDesignMat1 = new clsField("AddDesignMat1", ccsText, "");
        
        $this->AddDesignMat2 = new clsField("AddDesignMat2", ccsText, "");
        
        $this->AddDesignMat3 = new clsField("AddDesignMat3", ccsText, "");
        
        $this->AddDesignMat4 = new clsField("AddDesignMat4", ccsText, "");
        
        $this->DelGlaze1 = new clsField("DelGlaze1", ccsText, "");
        
        $this->DelDesignMat1 = new clsField("DelDesignMat1", ccsText, "");
        
        $this->DelGlaze2 = new clsField("DelGlaze2", ccsText, "");
        
        $this->DelGlaze3 = new clsField("DelGlaze3", ccsText, "");
        
        $this->DelGlaze4 = new clsField("DelGlaze4", ccsText, "");
        
        $this->DelDesignMat2 = new clsField("DelDesignMat2", ccsText, "");
        
        $this->DelDesignMat3 = new clsField("DelDesignMat3", ccsText, "");
        
        $this->DelDesignMat4 = new clsField("DelDesignMat4", ccsText, "");
        
        $this->AddGlaze1 = new clsField("AddGlaze1", ccsText, "");
        
        $this->LinkCopy = new clsField("LinkCopy", ccsText, "");
        
        $this->Diameter = new clsField("Diameter", ccsFloat, "");
        
        $this->GlazeTechnique = new clsField("GlazeTechnique", ccsText, "");
        

        $this->InsertFields["CollectCode"] = array("Name" => "CollectCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ClientCode"] = array("Name" => "ClientCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ClientDescription"] = array("Name" => "ClientDescription", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["CollectDate"] = array("Name" => "CollectDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["Clay"] = array("Name" => "Clay", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["ClayKG"] = array("Name" => "ClayKG", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["ClayNote"] = array("Name" => "ClayNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["BuildTech"] = array("Name" => "BuildTech", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["BuildTechNote"] = array("Name" => "BuildTechNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["Rim"] = array("Name" => "Rim", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Feet"] = array("Name" => "Feet", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Casting1"] = array("Name" => "Casting1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Casting2"] = array("Name" => "Casting2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Casting3"] = array("Name" => "Casting3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Casting4"] = array("Name" => "Casting4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["CastingNote"] = array("Name" => "CastingNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["Estruder1"] = array("Name" => "Estruder1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Estruder2"] = array("Name" => "Estruder2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Estruder3"] = array("Name" => "Estruder3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Estruder4"] = array("Name" => "Estruder4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["EstruderNote"] = array("Name" => "EstruderNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["Texture1"] = array("Name" => "Texture1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Texture2"] = array("Name" => "Texture2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Texture3"] = array("Name" => "Texture3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Texture4"] = array("Name" => "Texture4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["TextureNote"] = array("Name" => "TextureNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["Tools1"] = array("Name" => "Tools1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Tools2"] = array("Name" => "Tools2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Tools3"] = array("Name" => "Tools3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Tools4"] = array("Name" => "Tools4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["ToolsNote"] = array("Name" => "ToolsNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["Engobe1"] = array("Name" => "Engobe1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Engobe2"] = array("Name" => "Engobe2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Engobe3"] = array("Name" => "Engobe3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Engobe4"] = array("Name" => "Engobe4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["EngobeNote"] = array("Name" => "EngobeNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["BisqueTemp"] = array("Name" => "BisqueTemp", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["StainOxide1"] = array("Name" => "StainOxide1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["StainOxide2"] = array("Name" => "StainOxide2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["StainOxide3"] = array("Name" => "StainOxide3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["StainOxide4"] = array("Name" => "StainOxide4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["StainOxideNote"] = array("Name" => "StainOxideNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["Glaze1"] = array("Name" => "Glaze1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Glaze2"] = array("Name" => "Glaze2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Glaze3"] = array("Name" => "Glaze3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Glaze4"] = array("Name" => "Glaze4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["GlazeDensity1"] = array("Name" => "GlazeDensity1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["GlazeDensity2"] = array("Name" => "GlazeDensity2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["GlazeDensity3"] = array("Name" => "GlazeDensity3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["GlazeDensity4"] = array("Name" => "GlazeDensity4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["GlazeNote"] = array("Name" => "GlazeNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["GlazeTemp"] = array("Name" => "GlazeTemp", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Firing"] = array("Name" => "Firing", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["FiringNote"] = array("Name" => "FiringNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["Width"] = array("Name" => "Width", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["FinalSizeNote"] = array("Name" => "FinalSizeNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["DesignMat1"] = array("Name" => "DesignMat1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DesignMat2"] = array("Name" => "DesignMat2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DesignMat3"] = array("Name" => "DesignMat3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DesignMat4"] = array("Name" => "DesignMat4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DesignMatQty1"] = array("Name" => "DesignMatQty1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DesignMatQty2"] = array("Name" => "DesignMatQty2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DesignMatQty3"] = array("Name" => "DesignMatQty3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DesignMatQty4"] = array("Name" => "DesignMatQty4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DesignMatNote"] = array("Name" => "DesignMatNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["History"] = array("Name" => "History", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["TechDraw"] = array("Name" => "TechDraw", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Photo1"] = array("Name" => "Photo1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Photo2"] = array("Name" => "Photo2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Photo3"] = array("Name" => "Photo3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Photo4"] = array("Name" => "Photo4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Height"] = array("Name" => "Height", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Length"] = array("Name" => "Length", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Diameter"] = array("Name" => "Diameter", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["GlazeTechnique"] = array("Name" => "GlazeTechnique", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["CollectCode"] = array("Name" => "CollectCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClientCode"] = array("Name" => "ClientCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClientDescription"] = array("Name" => "ClientDescription", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["CollectDate"] = array("Name" => "CollectDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["Clay"] = array("Name" => "Clay", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClayKG"] = array("Name" => "ClayKG", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClayNote"] = array("Name" => "ClayNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["BuildTech"] = array("Name" => "BuildTech", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["BuildTechNote"] = array("Name" => "BuildTechNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["Rim"] = array("Name" => "Rim", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Feet"] = array("Name" => "Feet", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Casting1"] = array("Name" => "Casting1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Casting2"] = array("Name" => "Casting2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Casting3"] = array("Name" => "Casting3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Casting4"] = array("Name" => "Casting4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["CastingNote"] = array("Name" => "CastingNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["Estruder1"] = array("Name" => "Estruder1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Estruder2"] = array("Name" => "Estruder2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Estruder3"] = array("Name" => "Estruder3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Estruder4"] = array("Name" => "Estruder4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["EstruderNote"] = array("Name" => "EstruderNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["Texture1"] = array("Name" => "Texture1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Texture2"] = array("Name" => "Texture2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Texture3"] = array("Name" => "Texture3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Texture4"] = array("Name" => "Texture4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["TextureNote"] = array("Name" => "TextureNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["Tools1"] = array("Name" => "Tools1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Tools2"] = array("Name" => "Tools2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Tools3"] = array("Name" => "Tools3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Tools4"] = array("Name" => "Tools4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ToolsNote"] = array("Name" => "ToolsNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["Engobe1"] = array("Name" => "Engobe1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Engobe2"] = array("Name" => "Engobe2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Engobe3"] = array("Name" => "Engobe3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Engobe4"] = array("Name" => "Engobe4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["EngobeNote"] = array("Name" => "EngobeNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["BisqueTemp"] = array("Name" => "BisqueTemp", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["StainOxide1"] = array("Name" => "StainOxide1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["StainOxide2"] = array("Name" => "StainOxide2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["StainOxide3"] = array("Name" => "StainOxide3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["StainOxide4"] = array("Name" => "StainOxide4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["StainOxideNote"] = array("Name" => "StainOxideNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["Glaze1"] = array("Name" => "Glaze1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Glaze2"] = array("Name" => "Glaze2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Glaze3"] = array("Name" => "Glaze3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Glaze4"] = array("Name" => "Glaze4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["GlazeDensity1"] = array("Name" => "GlazeDensity1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["GlazeDensity2"] = array("Name" => "GlazeDensity2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["GlazeDensity3"] = array("Name" => "GlazeDensity3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["GlazeDensity4"] = array("Name" => "GlazeDensity4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["GlazeNote"] = array("Name" => "GlazeNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["GlazeTemp"] = array("Name" => "GlazeTemp", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Firing"] = array("Name" => "Firing", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["FiringNote"] = array("Name" => "FiringNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["Width"] = array("Name" => "Width", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["FinalSizeNote"] = array("Name" => "FinalSizeNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMat1"] = array("Name" => "DesignMat1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMat2"] = array("Name" => "DesignMat2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMat3"] = array("Name" => "DesignMat3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMat4"] = array("Name" => "DesignMat4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatQty1"] = array("Name" => "DesignMatQty1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatQty2"] = array("Name" => "DesignMatQty2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatQty3"] = array("Name" => "DesignMatQty3", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatQty4"] = array("Name" => "DesignMatQty4", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatNote"] = array("Name" => "DesignMatNote", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["History"] = array("Name" => "History", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["TechDraw"] = array("Name" => "TechDraw", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Photo1"] = array("Name" => "Photo1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Photo2"] = array("Name" => "Photo2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Photo3"] = array("Name" => "Photo3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Photo4"] = array("Name" => "Photo4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Height"] = array("Name" => "Height", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Length"] = array("Name" => "Length", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Diameter"] = array("Name" => "Diameter", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["GlazeTechnique"] = array("Name" => "GlazeTechnique", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @2-8EF8D22D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT ID, CollectCode, ClientCode, History, DesignMatNote, DesignMatQty4, DesignMatQty3, DesignMatQty2, DesignMatQty1, DesignMat4,\n\n" .
        "DesignMat3, DesignMat2, DesignMat1, FinalSizeNote, SampCeramicVolume, Diameter, Length, Height, Width, FiringNote, Firing,\n\n" .
        "GlazeTemp, GlazeNote, GlazeDensity4, GlazeDensity3, GlazeDensity2, GlazeDensity1, Glaze4, Glaze3, Glaze2, Glaze1, StainOxideNote,\n\n" .
        "StainOxide4, StainOxide3, StainOxide2, StainOxide1, BisqueTemp, EngobeNote, Engobe4, Engobe3, Engobe2, Engobe1, ToolsNote,\n\n" .
        "Tools4, Tools3, Tools2, Tools1, TextureNote, Texture4, Texture3, Texture2, Texture1, EstruderNote, Estruder4, Estruder3,\n\n" .
        "Estruder2, Estruder1, CastingNote, Casting4, Casting3, Casting2, Casting1, Feet, Rim, BuildTechNote, BuildTech, ClayNote,\n\n" .
        "ClayKG, Clay, CollectDate, ClientDescription, TechDraw, Photo1, Photo2, Photo3, Photo4, RefID, GlazeTechnique \n\n" .
        "FROM tblcollect_master {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-98CE9C6C
    function SetValues()
    {
        $this->CollectCode->SetDBValue($this->f("CollectCode"));
        $this->ClientCode->SetDBValue($this->f("ClientCode"));
        $this->ClientDescription->SetDBValue($this->f("ClientDescription"));
        $this->CollectDate->SetDBValue(trim($this->f("CollectDate")));
        $this->Clay->SetDBValue(trim($this->f("Clay")));
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
        $this->Estruder1->SetDBValue(trim($this->f("Estruder1")));
        $this->Estruder2->SetDBValue(trim($this->f("Estruder2")));
        $this->Estruder3->SetDBValue(trim($this->f("Estruder3")));
        $this->Estruder4->SetDBValue(trim($this->f("Estruder4")));
        $this->EstruderNote->SetDBValue($this->f("EstruderNote"));
        $this->Texture1->SetDBValue(trim($this->f("Texture1")));
        $this->Texture2->SetDBValue(trim($this->f("Texture2")));
        $this->Texture3->SetDBValue(trim($this->f("Texture3")));
        $this->Texture4->SetDBValue(trim($this->f("Texture4")));
        $this->TextureNote->SetDBValue($this->f("TextureNote"));
        $this->Tools1->SetDBValue(trim($this->f("Tools1")));
        $this->Tools2->SetDBValue(trim($this->f("Tools2")));
        $this->Tools3->SetDBValue(trim($this->f("Tools3")));
        $this->Tools4->SetDBValue(trim($this->f("Tools4")));
        $this->ToolsNote->SetDBValue($this->f("ToolsNote"));
        $this->Engobe1->SetDBValue(trim($this->f("Engobe1")));
        $this->Engobe2->SetDBValue(trim($this->f("Engobe2")));
        $this->Engobe3->SetDBValue(trim($this->f("Engobe3")));
        $this->Engobe4->SetDBValue(trim($this->f("Engobe4")));
        $this->EngobeNote->SetDBValue($this->f("EngobeNote"));
        $this->BisqueTemp->SetDBValue($this->f("BisqueTemp"));
        $this->StainOxide1->SetDBValue(trim($this->f("StainOxide1")));
        $this->StainOxide2->SetDBValue(trim($this->f("StainOxide2")));
        $this->StainOxide3->SetDBValue(trim($this->f("StainOxide3")));
        $this->StainOxide4->SetDBValue(trim($this->f("StainOxide4")));
        $this->StainOxideNote->SetDBValue($this->f("StainOxideNote"));
        $this->Glaze1->SetDBValue(trim($this->f("Glaze1")));
        $this->Glaze2->SetDBValue(trim($this->f("Glaze2")));
        $this->Glaze3->SetDBValue(trim($this->f("Glaze3")));
        $this->Glaze4->SetDBValue(trim($this->f("Glaze4")));
        $this->GlazeDensity1->SetDBValue($this->f("GlazeDensity1"));
        $this->GlazeDensity2->SetDBValue($this->f("GlazeDensity2"));
        $this->GlazeDensity3->SetDBValue($this->f("GlazeDensity3"));
        $this->GlazeDensity4->SetDBValue($this->f("GlazeDensity4"));
        $this->GlazeNote->SetDBValue($this->f("GlazeNote"));
        $this->GlazeTemp->SetDBValue($this->f("GlazeTemp"));
        $this->Firing->SetDBValue($this->f("Firing"));
        $this->FiringNote->SetDBValue($this->f("FiringNote"));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->FinalSizeNote->SetDBValue($this->f("FinalSizeNote"));
        $this->DesignMat1->SetDBValue(trim($this->f("DesignMat1")));
        $this->DesignMat2->SetDBValue(trim($this->f("DesignMat2")));
        $this->DesignMat3->SetDBValue(trim($this->f("DesignMat3")));
        $this->DesignMat4->SetDBValue(trim($this->f("DesignMat4")));
        $this->DesignMatQty1->SetDBValue(trim($this->f("DesignMatQty1")));
        $this->DesignMatQty2->SetDBValue(trim($this->f("DesignMatQty2")));
        $this->DesignMatQty3->SetDBValue(trim($this->f("DesignMatQty3")));
        $this->DesignMatQty4->SetDBValue(trim($this->f("DesignMatQty4")));
        $this->DesignMatNote->SetDBValue($this->f("DesignMatNote"));
        $this->History->SetDBValue($this->f("History"));
        $this->TechDraw->SetDBValue($this->f("TechDraw"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->Photo2->SetDBValue($this->f("Photo2"));
        $this->Photo3->SetDBValue($this->f("Photo3"));
        $this->Photo4->SetDBValue($this->f("Photo4"));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
        $this->GlazeTechnique->SetDBValue($this->f("GlazeTechnique"));
    }
//End SetValues Method

//Insert Method @2-5313D7B6
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["CollectCode"]["Value"] = $this->CollectCode->GetDBValue(true);
        $this->InsertFields["ClientCode"]["Value"] = $this->ClientCode->GetDBValue(true);
        $this->InsertFields["ClientDescription"]["Value"] = $this->ClientDescription->GetDBValue(true);
        $this->InsertFields["CollectDate"]["Value"] = $this->CollectDate->GetDBValue(true);
        $this->InsertFields["Clay"]["Value"] = $this->Clay->GetDBValue(true);
        $this->InsertFields["ClayKG"]["Value"] = $this->ClayKG->GetDBValue(true);
        $this->InsertFields["ClayNote"]["Value"] = $this->ClayNote->GetDBValue(true);
        $this->InsertFields["BuildTech"]["Value"] = $this->BuildTech->GetDBValue(true);
        $this->InsertFields["BuildTechNote"]["Value"] = $this->BuildTechNote->GetDBValue(true);
        $this->InsertFields["Rim"]["Value"] = $this->Rim->GetDBValue(true);
        $this->InsertFields["Feet"]["Value"] = $this->Feet->GetDBValue(true);
        $this->InsertFields["Casting1"]["Value"] = $this->Casting1->GetDBValue(true);
        $this->InsertFields["Casting2"]["Value"] = $this->Casting2->GetDBValue(true);
        $this->InsertFields["Casting3"]["Value"] = $this->Casting3->GetDBValue(true);
        $this->InsertFields["Casting4"]["Value"] = $this->Casting4->GetDBValue(true);
        $this->InsertFields["CastingNote"]["Value"] = $this->CastingNote->GetDBValue(true);
        $this->InsertFields["Estruder1"]["Value"] = $this->Estruder1->GetDBValue(true);
        $this->InsertFields["Estruder2"]["Value"] = $this->Estruder2->GetDBValue(true);
        $this->InsertFields["Estruder3"]["Value"] = $this->Estruder3->GetDBValue(true);
        $this->InsertFields["Estruder4"]["Value"] = $this->Estruder4->GetDBValue(true);
        $this->InsertFields["EstruderNote"]["Value"] = $this->EstruderNote->GetDBValue(true);
        $this->InsertFields["Texture1"]["Value"] = $this->Texture1->GetDBValue(true);
        $this->InsertFields["Texture2"]["Value"] = $this->Texture2->GetDBValue(true);
        $this->InsertFields["Texture3"]["Value"] = $this->Texture3->GetDBValue(true);
        $this->InsertFields["Texture4"]["Value"] = $this->Texture4->GetDBValue(true);
        $this->InsertFields["TextureNote"]["Value"] = $this->TextureNote->GetDBValue(true);
        $this->InsertFields["Tools1"]["Value"] = $this->Tools1->GetDBValue(true);
        $this->InsertFields["Tools2"]["Value"] = $this->Tools2->GetDBValue(true);
        $this->InsertFields["Tools3"]["Value"] = $this->Tools3->GetDBValue(true);
        $this->InsertFields["Tools4"]["Value"] = $this->Tools4->GetDBValue(true);
        $this->InsertFields["ToolsNote"]["Value"] = $this->ToolsNote->GetDBValue(true);
        $this->InsertFields["Engobe1"]["Value"] = $this->Engobe1->GetDBValue(true);
        $this->InsertFields["Engobe2"]["Value"] = $this->Engobe2->GetDBValue(true);
        $this->InsertFields["Engobe3"]["Value"] = $this->Engobe3->GetDBValue(true);
        $this->InsertFields["Engobe4"]["Value"] = $this->Engobe4->GetDBValue(true);
        $this->InsertFields["EngobeNote"]["Value"] = $this->EngobeNote->GetDBValue(true);
        $this->InsertFields["BisqueTemp"]["Value"] = $this->BisqueTemp->GetDBValue(true);
        $this->InsertFields["StainOxide1"]["Value"] = $this->StainOxide1->GetDBValue(true);
        $this->InsertFields["StainOxide2"]["Value"] = $this->StainOxide2->GetDBValue(true);
        $this->InsertFields["StainOxide3"]["Value"] = $this->StainOxide3->GetDBValue(true);
        $this->InsertFields["StainOxide4"]["Value"] = $this->StainOxide4->GetDBValue(true);
        $this->InsertFields["StainOxideNote"]["Value"] = $this->StainOxideNote->GetDBValue(true);
        $this->InsertFields["Glaze1"]["Value"] = $this->Glaze1->GetDBValue(true);
        $this->InsertFields["Glaze2"]["Value"] = $this->Glaze2->GetDBValue(true);
        $this->InsertFields["Glaze3"]["Value"] = $this->Glaze3->GetDBValue(true);
        $this->InsertFields["Glaze4"]["Value"] = $this->Glaze4->GetDBValue(true);
        $this->InsertFields["GlazeDensity1"]["Value"] = $this->GlazeDensity1->GetDBValue(true);
        $this->InsertFields["GlazeDensity2"]["Value"] = $this->GlazeDensity2->GetDBValue(true);
        $this->InsertFields["GlazeDensity3"]["Value"] = $this->GlazeDensity3->GetDBValue(true);
        $this->InsertFields["GlazeDensity4"]["Value"] = $this->GlazeDensity4->GetDBValue(true);
        $this->InsertFields["GlazeNote"]["Value"] = $this->GlazeNote->GetDBValue(true);
        $this->InsertFields["GlazeTemp"]["Value"] = $this->GlazeTemp->GetDBValue(true);
        $this->InsertFields["Firing"]["Value"] = $this->Firing->GetDBValue(true);
        $this->InsertFields["FiringNote"]["Value"] = $this->FiringNote->GetDBValue(true);
        $this->InsertFields["Width"]["Value"] = $this->Width->GetDBValue(true);
        $this->InsertFields["FinalSizeNote"]["Value"] = $this->FinalSizeNote->GetDBValue(true);
        $this->InsertFields["DesignMat1"]["Value"] = $this->DesignMat1->GetDBValue(true);
        $this->InsertFields["DesignMat2"]["Value"] = $this->DesignMat2->GetDBValue(true);
        $this->InsertFields["DesignMat3"]["Value"] = $this->DesignMat3->GetDBValue(true);
        $this->InsertFields["DesignMat4"]["Value"] = $this->DesignMat4->GetDBValue(true);
        $this->InsertFields["DesignMatQty1"]["Value"] = $this->DesignMatQty1->GetDBValue(true);
        $this->InsertFields["DesignMatQty2"]["Value"] = $this->DesignMatQty2->GetDBValue(true);
        $this->InsertFields["DesignMatQty3"]["Value"] = $this->DesignMatQty3->GetDBValue(true);
        $this->InsertFields["DesignMatQty4"]["Value"] = $this->DesignMatQty4->GetDBValue(true);
        $this->InsertFields["DesignMatNote"]["Value"] = $this->DesignMatNote->GetDBValue(true);
        $this->InsertFields["History"]["Value"] = $this->History->GetDBValue(true);
        $this->InsertFields["TechDraw"]["Value"] = $this->TechDraw->GetDBValue(true);
        $this->InsertFields["Photo1"]["Value"] = $this->Photo1->GetDBValue(true);
        $this->InsertFields["Photo2"]["Value"] = $this->Photo2->GetDBValue(true);
        $this->InsertFields["Photo3"]["Value"] = $this->Photo3->GetDBValue(true);
        $this->InsertFields["Photo4"]["Value"] = $this->Photo4->GetDBValue(true);
        $this->InsertFields["Height"]["Value"] = $this->Height->GetDBValue(true);
        $this->InsertFields["Length"]["Value"] = $this->Length->GetDBValue(true);
        $this->InsertFields["Diameter"]["Value"] = $this->Diameter->GetDBValue(true);
        $this->InsertFields["GlazeTechnique"]["Value"] = $this->GlazeTechnique->GetDBValue(true);
        $this->SQL = CCBuildInsert("tblcollect_master", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-923D4FAE
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["CollectCode"]["Value"] = $this->CollectCode->GetDBValue(true);
        $this->UpdateFields["ClientCode"]["Value"] = $this->ClientCode->GetDBValue(true);
        $this->UpdateFields["ClientDescription"]["Value"] = $this->ClientDescription->GetDBValue(true);
        $this->UpdateFields["CollectDate"]["Value"] = $this->CollectDate->GetDBValue(true);
        $this->UpdateFields["Clay"]["Value"] = $this->Clay->GetDBValue(true);
        $this->UpdateFields["ClayKG"]["Value"] = $this->ClayKG->GetDBValue(true);
        $this->UpdateFields["ClayNote"]["Value"] = $this->ClayNote->GetDBValue(true);
        $this->UpdateFields["BuildTech"]["Value"] = $this->BuildTech->GetDBValue(true);
        $this->UpdateFields["BuildTechNote"]["Value"] = $this->BuildTechNote->GetDBValue(true);
        $this->UpdateFields["Rim"]["Value"] = $this->Rim->GetDBValue(true);
        $this->UpdateFields["Feet"]["Value"] = $this->Feet->GetDBValue(true);
        $this->UpdateFields["Casting1"]["Value"] = $this->Casting1->GetDBValue(true);
        $this->UpdateFields["Casting2"]["Value"] = $this->Casting2->GetDBValue(true);
        $this->UpdateFields["Casting3"]["Value"] = $this->Casting3->GetDBValue(true);
        $this->UpdateFields["Casting4"]["Value"] = $this->Casting4->GetDBValue(true);
        $this->UpdateFields["CastingNote"]["Value"] = $this->CastingNote->GetDBValue(true);
        $this->UpdateFields["Estruder1"]["Value"] = $this->Estruder1->GetDBValue(true);
        $this->UpdateFields["Estruder2"]["Value"] = $this->Estruder2->GetDBValue(true);
        $this->UpdateFields["Estruder3"]["Value"] = $this->Estruder3->GetDBValue(true);
        $this->UpdateFields["Estruder4"]["Value"] = $this->Estruder4->GetDBValue(true);
        $this->UpdateFields["EstruderNote"]["Value"] = $this->EstruderNote->GetDBValue(true);
        $this->UpdateFields["Texture1"]["Value"] = $this->Texture1->GetDBValue(true);
        $this->UpdateFields["Texture2"]["Value"] = $this->Texture2->GetDBValue(true);
        $this->UpdateFields["Texture3"]["Value"] = $this->Texture3->GetDBValue(true);
        $this->UpdateFields["Texture4"]["Value"] = $this->Texture4->GetDBValue(true);
        $this->UpdateFields["TextureNote"]["Value"] = $this->TextureNote->GetDBValue(true);
        $this->UpdateFields["Tools1"]["Value"] = $this->Tools1->GetDBValue(true);
        $this->UpdateFields["Tools2"]["Value"] = $this->Tools2->GetDBValue(true);
        $this->UpdateFields["Tools3"]["Value"] = $this->Tools3->GetDBValue(true);
        $this->UpdateFields["Tools4"]["Value"] = $this->Tools4->GetDBValue(true);
        $this->UpdateFields["ToolsNote"]["Value"] = $this->ToolsNote->GetDBValue(true);
        $this->UpdateFields["Engobe1"]["Value"] = $this->Engobe1->GetDBValue(true);
        $this->UpdateFields["Engobe2"]["Value"] = $this->Engobe2->GetDBValue(true);
        $this->UpdateFields["Engobe3"]["Value"] = $this->Engobe3->GetDBValue(true);
        $this->UpdateFields["Engobe4"]["Value"] = $this->Engobe4->GetDBValue(true);
        $this->UpdateFields["EngobeNote"]["Value"] = $this->EngobeNote->GetDBValue(true);
        $this->UpdateFields["BisqueTemp"]["Value"] = $this->BisqueTemp->GetDBValue(true);
        $this->UpdateFields["StainOxide1"]["Value"] = $this->StainOxide1->GetDBValue(true);
        $this->UpdateFields["StainOxide2"]["Value"] = $this->StainOxide2->GetDBValue(true);
        $this->UpdateFields["StainOxide3"]["Value"] = $this->StainOxide3->GetDBValue(true);
        $this->UpdateFields["StainOxide4"]["Value"] = $this->StainOxide4->GetDBValue(true);
        $this->UpdateFields["StainOxideNote"]["Value"] = $this->StainOxideNote->GetDBValue(true);
        $this->UpdateFields["Glaze1"]["Value"] = $this->Glaze1->GetDBValue(true);
        $this->UpdateFields["Glaze2"]["Value"] = $this->Glaze2->GetDBValue(true);
        $this->UpdateFields["Glaze3"]["Value"] = $this->Glaze3->GetDBValue(true);
        $this->UpdateFields["Glaze4"]["Value"] = $this->Glaze4->GetDBValue(true);
        $this->UpdateFields["GlazeDensity1"]["Value"] = $this->GlazeDensity1->GetDBValue(true);
        $this->UpdateFields["GlazeDensity2"]["Value"] = $this->GlazeDensity2->GetDBValue(true);
        $this->UpdateFields["GlazeDensity3"]["Value"] = $this->GlazeDensity3->GetDBValue(true);
        $this->UpdateFields["GlazeDensity4"]["Value"] = $this->GlazeDensity4->GetDBValue(true);
        $this->UpdateFields["GlazeNote"]["Value"] = $this->GlazeNote->GetDBValue(true);
        $this->UpdateFields["GlazeTemp"]["Value"] = $this->GlazeTemp->GetDBValue(true);
        $this->UpdateFields["Firing"]["Value"] = $this->Firing->GetDBValue(true);
        $this->UpdateFields["FiringNote"]["Value"] = $this->FiringNote->GetDBValue(true);
        $this->UpdateFields["Width"]["Value"] = $this->Width->GetDBValue(true);
        $this->UpdateFields["FinalSizeNote"]["Value"] = $this->FinalSizeNote->GetDBValue(true);
        $this->UpdateFields["DesignMat1"]["Value"] = $this->DesignMat1->GetDBValue(true);
        $this->UpdateFields["DesignMat2"]["Value"] = $this->DesignMat2->GetDBValue(true);
        $this->UpdateFields["DesignMat3"]["Value"] = $this->DesignMat3->GetDBValue(true);
        $this->UpdateFields["DesignMat4"]["Value"] = $this->DesignMat4->GetDBValue(true);
        $this->UpdateFields["DesignMatQty1"]["Value"] = $this->DesignMatQty1->GetDBValue(true);
        $this->UpdateFields["DesignMatQty2"]["Value"] = $this->DesignMatQty2->GetDBValue(true);
        $this->UpdateFields["DesignMatQty3"]["Value"] = $this->DesignMatQty3->GetDBValue(true);
        $this->UpdateFields["DesignMatQty4"]["Value"] = $this->DesignMatQty4->GetDBValue(true);
        $this->UpdateFields["DesignMatNote"]["Value"] = $this->DesignMatNote->GetDBValue(true);
        $this->UpdateFields["History"]["Value"] = $this->History->GetDBValue(true);
        $this->UpdateFields["TechDraw"]["Value"] = $this->TechDraw->GetDBValue(true);
        $this->UpdateFields["Photo1"]["Value"] = $this->Photo1->GetDBValue(true);
        $this->UpdateFields["Photo2"]["Value"] = $this->Photo2->GetDBValue(true);
        $this->UpdateFields["Photo3"]["Value"] = $this->Photo3->GetDBValue(true);
        $this->UpdateFields["Photo4"]["Value"] = $this->Photo4->GetDBValue(true);
        $this->UpdateFields["Height"]["Value"] = $this->Height->GetDBValue(true);
        $this->UpdateFields["Length"]["Value"] = $this->Length->GetDBValue(true);
        $this->UpdateFields["Diameter"]["Value"] = $this->Diameter->GetDBValue(true);
        $this->UpdateFields["GlazeTechnique"]["Value"] = $this->GlazeTechnique->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblcollect_master", $this->UpdateFields, $this);
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

//Delete Method @2-78CC70A3
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tblcollect_master";
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

} //End AddSampleCeramicDataSource Class @2-FCB6E20C

//Initialize Page @1-B5804560
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
$TemplateFileName = "EditCollection.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-2CAFA4F3
include_once("./EditCollection_events.php");
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

//Show Page @1-ED71EC9D
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
