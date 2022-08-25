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



//DetailPOL ReportGroup class @264-9B5FB81F
class clsReportGroupDetailPOL {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $Qty, $_QtyAttributes;
    public $Photo1, $_Photo1Attributes;
    public $CategoryName, $_CategoryNameAttributes;
    public $SizeName, $_SizeNameAttributes;
    public $TextureName, $_TextureNameAttributes;
    public $ColorName, $_ColorNameAttributes;
    public $MaterialName, $_MaterialNameAttributes;
    public $NameDesc, $_NameDescAttributes;
    public $POL_D_ID, $_POL_D_IDAttributes;
    public $POL_H_ID, $_POL_H_IDAttributes;
    public $Label1, $_Label1Attributes;
    public $Label2, $_Label2Attributes;
    public $Label3, $_Label3Attributes;
    public $TotalSum_Qty, $_TotalSum_QtyAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;

    function clsReportGroupDetailPOL(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->Qty = $this->Parent->Qty->Value;
        $this->Photo1 = $this->Parent->Photo1->Value;
        $this->CategoryName = $this->Parent->CategoryName->Value;
        $this->SizeName = $this->Parent->SizeName->Value;
        $this->TextureName = $this->Parent->TextureName->Value;
        $this->ColorName = $this->Parent->ColorName->Value;
        $this->MaterialName = $this->Parent->MaterialName->Value;
        $this->NameDesc = $this->Parent->NameDesc->Value;
        $this->POL_D_ID = $this->Parent->POL_D_ID->Value;
        $this->POL_H_ID = $this->Parent->POL_H_ID->Value;
        $this->Label1 = $this->Parent->Label1->Value;
        $this->Label2 = $this->Parent->Label2->Value;
        $this->Label3 = $this->Parent->Label3->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->TotalSum_Qty = $this->Parent->TotalSum_Qty->GetTotalValue($mode);
        $this->_QtyAttributes = $this->Parent->Qty->Attributes->GetAsArray();
        $this->_Photo1Attributes = $this->Parent->Photo1->Attributes->GetAsArray();
        $this->_CategoryNameAttributes = $this->Parent->CategoryName->Attributes->GetAsArray();
        $this->_SizeNameAttributes = $this->Parent->SizeName->Attributes->GetAsArray();
        $this->_TextureNameAttributes = $this->Parent->TextureName->Attributes->GetAsArray();
        $this->_ColorNameAttributes = $this->Parent->ColorName->Attributes->GetAsArray();
        $this->_MaterialNameAttributes = $this->Parent->MaterialName->Attributes->GetAsArray();
        $this->_NameDescAttributes = $this->Parent->NameDesc->Attributes->GetAsArray();
        $this->_POL_D_IDAttributes = $this->Parent->POL_D_ID->Attributes->GetAsArray();
        $this->_POL_H_IDAttributes = $this->Parent->POL_H_ID->Attributes->GetAsArray();
        $this->_Label1Attributes = $this->Parent->Label1->Attributes->GetAsArray();
        $this->_Label2Attributes = $this->Parent->Label2->Attributes->GetAsArray();
        $this->_Label3Attributes = $this->Parent->Label3->Attributes->GetAsArray();
        $this->_TotalSum_QtyAttributes = $this->Parent->TotalSum_Qty->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->TotalSum_Qty = $this->TotalSum_Qty;
        $Header->_TotalSum_QtyAttributes = $this->_TotalSum_QtyAttributes;
        $this->Qty = $Header->Qty;
        $Header->_QtyAttributes = $this->_QtyAttributes;
        $this->Parent->Qty->Value = $Header->Qty;
        $this->Parent->Qty->Attributes->RestoreFromArray($Header->_QtyAttributes);
        $this->Photo1 = $Header->Photo1;
        $Header->_Photo1Attributes = $this->_Photo1Attributes;
        $this->Parent->Photo1->Value = $Header->Photo1;
        $this->Parent->Photo1->Attributes->RestoreFromArray($Header->_Photo1Attributes);
        $this->CategoryName = $Header->CategoryName;
        $Header->_CategoryNameAttributes = $this->_CategoryNameAttributes;
        $this->Parent->CategoryName->Value = $Header->CategoryName;
        $this->Parent->CategoryName->Attributes->RestoreFromArray($Header->_CategoryNameAttributes);
        $this->SizeName = $Header->SizeName;
        $Header->_SizeNameAttributes = $this->_SizeNameAttributes;
        $this->Parent->SizeName->Value = $Header->SizeName;
        $this->Parent->SizeName->Attributes->RestoreFromArray($Header->_SizeNameAttributes);
        $this->TextureName = $Header->TextureName;
        $Header->_TextureNameAttributes = $this->_TextureNameAttributes;
        $this->Parent->TextureName->Value = $Header->TextureName;
        $this->Parent->TextureName->Attributes->RestoreFromArray($Header->_TextureNameAttributes);
        $this->ColorName = $Header->ColorName;
        $Header->_ColorNameAttributes = $this->_ColorNameAttributes;
        $this->Parent->ColorName->Value = $Header->ColorName;
        $this->Parent->ColorName->Attributes->RestoreFromArray($Header->_ColorNameAttributes);
        $this->MaterialName = $Header->MaterialName;
        $Header->_MaterialNameAttributes = $this->_MaterialNameAttributes;
        $this->Parent->MaterialName->Value = $Header->MaterialName;
        $this->Parent->MaterialName->Attributes->RestoreFromArray($Header->_MaterialNameAttributes);
        $this->NameDesc = $Header->NameDesc;
        $Header->_NameDescAttributes = $this->_NameDescAttributes;
        $this->Parent->NameDesc->Value = $Header->NameDesc;
        $this->Parent->NameDesc->Attributes->RestoreFromArray($Header->_NameDescAttributes);
        $this->POL_D_ID = $Header->POL_D_ID;
        $Header->_POL_D_IDAttributes = $this->_POL_D_IDAttributes;
        $this->Parent->POL_D_ID->Value = $Header->POL_D_ID;
        $this->Parent->POL_D_ID->Attributes->RestoreFromArray($Header->_POL_D_IDAttributes);
        $this->POL_H_ID = $Header->POL_H_ID;
        $Header->_POL_H_IDAttributes = $this->_POL_H_IDAttributes;
        $this->Parent->POL_H_ID->Value = $Header->POL_H_ID;
        $this->Parent->POL_H_ID->Attributes->RestoreFromArray($Header->_POL_H_IDAttributes);
        $this->Label1 = $Header->Label1;
        $Header->_Label1Attributes = $this->_Label1Attributes;
        $this->Parent->Label1->Value = $Header->Label1;
        $this->Parent->Label1->Attributes->RestoreFromArray($Header->_Label1Attributes);
        $this->Label2 = $Header->Label2;
        $Header->_Label2Attributes = $this->_Label2Attributes;
        $this->Parent->Label2->Value = $Header->Label2;
        $this->Parent->Label2->Attributes->RestoreFromArray($Header->_Label2Attributes);
        $this->Label3 = $Header->Label3;
        $Header->_Label3Attributes = $this->_Label3Attributes;
        $this->Parent->Label3->Value = $Header->Label3;
        $this->Parent->Label3->Attributes->RestoreFromArray($Header->_Label3Attributes);
    }
    function ChangeTotalControls() {
        $this->TotalSum_Qty = $this->Parent->TotalSum_Qty->GetValue();
    }
}
//End DetailPOL ReportGroup class

//DetailPOL GroupsCollection class @264-4223EAB3
class clsGroupsCollectionDetailPOL {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectionDetailPOL(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupDetailPOL($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->Qty->Value = $this->Parent->Qty->initialValue;
        $this->Parent->Photo1->Value = $this->Parent->Photo1->initialValue;
        $this->Parent->CategoryName->Value = $this->Parent->CategoryName->initialValue;
        $this->Parent->SizeName->Value = $this->Parent->SizeName->initialValue;
        $this->Parent->TextureName->Value = $this->Parent->TextureName->initialValue;
        $this->Parent->ColorName->Value = $this->Parent->ColorName->initialValue;
        $this->Parent->MaterialName->Value = $this->Parent->MaterialName->initialValue;
        $this->Parent->NameDesc->Value = $this->Parent->NameDesc->initialValue;
        $this->Parent->POL_D_ID->Value = $this->Parent->POL_D_ID->initialValue;
        $this->Parent->POL_H_ID->Value = $this->Parent->POL_H_ID->initialValue;
        $this->Parent->Label1->Value = $this->Parent->Label1->initialValue;
        $this->Parent->Label2->Value = $this->Parent->Label2->initialValue;
        $this->Parent->Label3->Value = $this->Parent->Label3->initialValue;
        $this->Parent->TotalSum_Qty->Value = $this->Parent->TotalSum_Qty->initialValue;
    }

    function OpenPage() {
        $this->TotalPages++;
        $Group = & $this->InitGroup();
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnInitialize", $this->Parent->Page_Header);
        if ($this->Parent->Page_Header->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Page_Header->Height;
        $Group->SetTotalControls("GetNextValue");
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnCalculate", $this->Parent->Page_Header);
        $Group->SetControls();
        $Group->Mode = 1;
        $Group->GroupType = "Page";
        $Group->PageTotalIndex = count($this->Groups);
        $this->mPageCurrentHeaderIndex = count($this->Groups);
        $this->Groups[] =  & $Group;
        $this->Pages[] =  count($this->Groups) == 2 ? 0 : count($this->Groups) - 1;
    }

    function OpenGroup($groupName) {
        $Group = "";
        $OpenFlag = false;
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnInitialize", $this->Parent->Report_Header);
            if ($this->Parent->Report_Header->Visible) 
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Header->Height;
                $Group->SetTotalControls("GetNextValue");
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnCalculate", $this->Parent->Report_Header);
            $Group->SetControls();
            $Group->Mode = 1;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->OpenPage();
        }
    }

    function ClosePage() {
        $Group = & $this->InitGroup();
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnInitialize", $this->Parent->Page_Footer);
        $Group->SetTotalControls("GetPrevValue");
        $Group->SyncWithHeader($this->Groups[$this->mPageCurrentHeaderIndex]);
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnCalculate", $this->Parent->Page_Footer);
        $Group->SetControls();
        $this->RestoreValues();
        $this->CurrentPageSize = 0;
        $Group->Mode = 2;
        $Group->GroupType = "Page";
        $this->Groups[] = & $Group;
    }

    function CloseGroup($groupName)
    {
        $Group = "";
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnInitialize", $this->Parent->Report_Footer);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->Report_Footer->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->Report_Footer->Height;
            if (($this->PageSize > 0) and $this->Parent->Report_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            $Group->SetTotalControls("GetPrevValue");
            $Group->SyncWithHeader($this->Groups[0]);
            if ($this->Parent->Report_Footer->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Footer->Height;
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnCalculate", $this->Parent->Report_Footer);
            $Group->SetControls();
            $this->RestoreValues();
            $Group->Mode = 2;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->ClosePage();
            return;
        }
    }

    function AddItem()
    {
        $Group = & $this->InitGroup(true);
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnInitialize", $this->Parent->Detail);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->Detail->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->Detail->Height;
        if (($this->PageSize > 0) and $this->Parent->Detail->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $this->TotalRows++;
        if ($this->LastDetailIndex)
            $PrevGroup = & $this->Groups[$this->LastDetailIndex];
        else
            $PrevGroup = "";
        $Group->SetTotalControls("", $PrevGroup);
        if ($this->Parent->Detail->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Detail->Height;
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnCalculate", $this->Parent->Detail);
        $Group->SetControls($PrevGroup);
        $this->LastDetailIndex = count($this->Groups);
        $this->Groups[] = & $Group;
    }
}
//End DetailPOL GroupsCollection class

class clsReportDetailPOL { //DetailPOL Class @264-E129159F

//DetailPOL Variables @264-944D286E

    public $ComponentType = "Report";
    public $PageSize;
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $CCSEvents = array();
    public $CCSEventResult;
    public $RelativePath = "";
    public $ViewMode = "Web";
    public $TemplateBlock;
    public $PageNumber;
    public $RowNumber;
    public $TotalRows;
    public $TotalPages;
    public $ControlsVisible = array();
    public $IsEmpty;
    public $Attributes;
    public $DetailBlock, $Detail;
    public $Report_FooterBlock, $Report_Footer;
    public $Report_HeaderBlock, $Report_Header;
    public $Page_FooterBlock, $Page_Footer;
    public $Page_HeaderBlock, $Page_Header;
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
//End DetailPOL Variables

//Class_Initialize Event @264-B2A6B048
    function clsReportDetailPOL($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "DetailPOL";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->Detail = new clsSection($this);
        $MinPageSize = 0;
        $MaxSectionSize = 0;
        $this->Detail->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Detail->Height);
        $this->Report_Footer = new clsSection($this);
        $this->Report_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Report_Footer->Height);
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Footer->Height = 1;
        $MinPageSize += $this->Page_Footer->Height;
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->Errors = new clsErrors();
        $this->DataSource = new clsDetailPOLDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ViewMode = CCGetParam("ViewMode", "Web");
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else if($this->ViewMode == "Print") {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 50;
             else if ($PageSize == "0")
                $this->PageSize = 0;
             else 
                $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 40;
             else if ($PageSize == "0")
                $this->PageSize = 100;
             else 
                $this->PageSize = min(100, $PageSize);
        }
        $MinPageSize += $MaxSectionSize;
        if ($this->PageSize && $MinPageSize && $this->PageSize < $MinPageSize)
            $this->PageSize = $MinPageSize;
        $this->PageNumber = $this->ViewMode == "Print" ? 1 : intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0 ) {
            $this->PageNumber = 1;
        }

        $this->Qty = new clsControl(ccsReportLabel, "Qty", "Qty", ccsInteger, "", "", $this);
        $this->Qty->HTML = true;
        $this->Qty->EmptyText = "&nbsp;";
        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->Photo1->HTML = true;
        $this->CategoryName = new clsControl(ccsReportLabel, "CategoryName", "CategoryName", ccsText, "", "", $this);
        $this->CategoryName->HTML = true;
        $this->CategoryName->EmptyText = "&nbsp;";
        $this->SizeName = new clsControl(ccsReportLabel, "SizeName", "SizeName", ccsText, "", "", $this);
        $this->SizeName->HTML = true;
        $this->SizeName->EmptyText = "&nbsp;";
        $this->TextureName = new clsControl(ccsReportLabel, "TextureName", "TextureName", ccsText, "", "", $this);
        $this->TextureName->HTML = true;
        $this->TextureName->EmptyText = "&nbsp;";
        $this->ColorName = new clsControl(ccsReportLabel, "ColorName", "ColorName", ccsText, "", "", $this);
        $this->ColorName->HTML = true;
        $this->ColorName->EmptyText = "&nbsp;";
        $this->MaterialName = new clsControl(ccsReportLabel, "MaterialName", "MaterialName", ccsText, "", "", $this);
        $this->MaterialName->HTML = true;
        $this->MaterialName->EmptyText = "&nbsp;";
        $this->NameDesc = new clsControl(ccsReportLabel, "NameDesc", "NameDesc", ccsText, "", "", $this);
        $this->NameDesc->HTML = true;
        $this->NameDesc->EmptyText = "&nbsp;";
        $this->POL_D_ID = new clsControl(ccsHidden, "POL_D_ID", "POL_D_ID", ccsInteger, "", CCGetRequestParam("POL_D_ID", ccsGet, NULL), $this);
        $this->POL_D_ID->HTML = true;
        $this->POL_H_ID = new clsControl(ccsHidden, "POL_H_ID", "POL_H_ID", ccsInteger, "", CCGetRequestParam("POL_H_ID", ccsGet, NULL), $this);
        $this->POL_H_ID->HTML = true;
        $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $this);
        $this->Label2 = new clsControl(ccsLabel, "Label2", "Label2", ccsText, "", CCGetRequestParam("Label2", ccsGet, NULL), $this);
        $this->Label3 = new clsControl(ccsLabel, "Label3", "Label3", ccsText, "", CCGetRequestParam("Label3", ccsGet, NULL), $this);
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->TotalSum_Qty = new clsControl(ccsReportLabel, "TotalSum_Qty", "TotalSum_Qty", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), "", $this);
        $this->TotalSum_Qty->HTML = true;
        $this->TotalSum_Qty->TotalFunction = "Sum";
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @264-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @264-ED7175C7
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Qty->Errors->Count());
        $errors = ($errors || $this->Photo1->Errors->Count());
        $errors = ($errors || $this->CategoryName->Errors->Count());
        $errors = ($errors || $this->SizeName->Errors->Count());
        $errors = ($errors || $this->TextureName->Errors->Count());
        $errors = ($errors || $this->ColorName->Errors->Count());
        $errors = ($errors || $this->MaterialName->Errors->Count());
        $errors = ($errors || $this->NameDesc->Errors->Count());
        $errors = ($errors || $this->POL_D_ID->Errors->Count());
        $errors = ($errors || $this->POL_H_ID->Errors->Count());
        $errors = ($errors || $this->Label1->Errors->Count());
        $errors = ($errors || $this->Label2->Errors->Count());
        $errors = ($errors || $this->Label3->Errors->Count());
        $errors = ($errors || $this->TotalSum_Qty->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @264-A1DFA6B2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CategoryName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SizeName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ColorName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MaterialName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->POL_D_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->POL_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalSum_Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @264-8FE0670F
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urlPOL_H_ID"] = CCGetFromGet("POL_H_ID", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $Groups = new clsGroupsCollectionDetailPOL($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->Qty->SetValue($this->DataSource->Qty->GetValue());
            $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
            $this->CategoryName->SetValue($this->DataSource->CategoryName->GetValue());
            $this->SizeName->SetValue($this->DataSource->SizeName->GetValue());
            $this->TextureName->SetValue($this->DataSource->TextureName->GetValue());
            $this->ColorName->SetValue($this->DataSource->ColorName->GetValue());
            $this->MaterialName->SetValue($this->DataSource->MaterialName->GetValue());
            $this->NameDesc->SetValue($this->DataSource->NameDesc->GetValue());
            $this->POL_D_ID->SetValue($this->DataSource->POL_D_ID->GetValue());
            $this->POL_H_ID->SetValue($this->DataSource->POL_H_ID->GetValue());
            $this->TotalSum_Qty->SetValue($this->DataSource->TotalSum_Qty->GetValue());
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            $Groups->AddItem();
            $is_next_record = $this->DataSource->next_record();
        }
        if (!count($Groups->Groups)) 
            $Groups->OpenGroup("Report");
        else
            $this->NoRecords->Visible = false;
        $Groups->CloseGroup("Report");
        $this->TotalPages = $Groups->TotalPages;
        $this->TotalRows = $Groups->TotalRows;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $this->Attributes->Show();
        $ReportBlock = "Report " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;

        if($this->CheckErrors()) {
            $Tpl->replaceblock("", $this->GetErrors());
            $Tpl->block_path = $ParentPath;
            return;
        } else {
            $items = & $Groups->Groups;
            $i = $Groups->Pages[min($this->PageNumber, $Groups->TotalPages) - 1];
            $this->ControlsVisible["Qty"] = $this->Qty->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["CategoryName"] = $this->CategoryName->Visible;
            $this->ControlsVisible["SizeName"] = $this->SizeName->Visible;
            $this->ControlsVisible["TextureName"] = $this->TextureName->Visible;
            $this->ControlsVisible["ColorName"] = $this->ColorName->Visible;
            $this->ControlsVisible["MaterialName"] = $this->MaterialName->Visible;
            $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
            $this->ControlsVisible["POL_D_ID"] = $this->POL_D_ID->Visible;
            $this->ControlsVisible["POL_H_ID"] = $this->POL_H_ID->Visible;
            $this->ControlsVisible["Label1"] = $this->Label1->Visible;
            $this->ControlsVisible["Label2"] = $this->Label2->Visible;
            $this->ControlsVisible["Label3"] = $this->Label3->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->Qty->SetValue($items[$i]->Qty);
                        $this->Qty->Attributes->RestoreFromArray($items[$i]->_QtyAttributes);
                        $this->Photo1->SetValue($items[$i]->Photo1);
                        $this->Photo1->Attributes->RestoreFromArray($items[$i]->_Photo1Attributes);
                        $this->CategoryName->SetValue($items[$i]->CategoryName);
                        $this->CategoryName->Attributes->RestoreFromArray($items[$i]->_CategoryNameAttributes);
                        $this->SizeName->SetValue($items[$i]->SizeName);
                        $this->SizeName->Attributes->RestoreFromArray($items[$i]->_SizeNameAttributes);
                        $this->TextureName->SetValue($items[$i]->TextureName);
                        $this->TextureName->Attributes->RestoreFromArray($items[$i]->_TextureNameAttributes);
                        $this->ColorName->SetValue($items[$i]->ColorName);
                        $this->ColorName->Attributes->RestoreFromArray($items[$i]->_ColorNameAttributes);
                        $this->MaterialName->SetValue($items[$i]->MaterialName);
                        $this->MaterialName->Attributes->RestoreFromArray($items[$i]->_MaterialNameAttributes);
                        $this->NameDesc->SetValue($items[$i]->NameDesc);
                        $this->NameDesc->Attributes->RestoreFromArray($items[$i]->_NameDescAttributes);
                        $this->POL_D_ID->SetValue($items[$i]->POL_D_ID);
                        $this->POL_D_ID->Attributes->RestoreFromArray($items[$i]->_POL_D_IDAttributes);
                        $this->POL_H_ID->SetValue($items[$i]->POL_H_ID);
                        $this->POL_H_ID->Attributes->RestoreFromArray($items[$i]->_POL_H_IDAttributes);
                        $this->Label1->SetValue($items[$i]->Label1);
                        $this->Label1->Attributes->RestoreFromArray($items[$i]->_Label1Attributes);
                        $this->Label2->SetValue($items[$i]->Label2);
                        $this->Label2->Attributes->RestoreFromArray($items[$i]->_Label2Attributes);
                        $this->Label3->SetValue($items[$i]->Label3);
                        $this->Label3->Attributes->RestoreFromArray($items[$i]->_Label3Attributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->Qty->Show();
                        $this->Photo1->Show();
                        $this->CategoryName->Show();
                        $this->SizeName->Show();
                        $this->TextureName->Show();
                        $this->ColorName->Show();
                        $this->MaterialName->Show();
                        $this->NameDesc->Show();
                        $this->POL_D_ID->Show();
                        $this->POL_H_ID->Show();
                        $this->Label1->Show();
                        $this->Label2->Show();
                        $this->Label3->Show();
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                        if ($this->Detail->Visible)
                            $Tpl->parseto("Section Detail", true, "Section Detail");
                        break;
                    case "Report":
                        if ($items[$i]->Mode == 1) {
                            $this->Report_Header->CCSEventResult = CCGetEvent($this->Report_Header->CCSEvents, "BeforeShow", $this->Report_Header);
                            if ($this->Report_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->TotalSum_Qty->SetText(CCFormatNumber($items[$i]->TotalSum_Qty, array(False, 2, Null, Null, False, "", "", 1, True, "")), ccsFloat);
                            $this->TotalSum_Qty->Attributes->RestoreFromArray($items[$i]->_TotalSum_QtyAttributes);
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
                                $this->TotalSum_Qty->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "Page":
                        if ($items[$i]->Mode == 1) {
                            $this->Page_Header->CCSEventResult = CCGetEvent($this->Page_Header->CCSEvents, "BeforeShow", $this->Page_Header);
                            if ($this->Page_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2 && !$this->UseClientPaging || $items[$i]->Mode == 1 && $this->UseClientPaging) {
                            $this->Navigator->PageNumber = $items[$i]->PageNumber;
                            $this->Navigator->TotalPages = $Groups->TotalPages;
                            $this->Navigator->Visible = ("Print" != $this->ViewMode);
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
                                $this->Navigator->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Footer", true, "Section Detail");
                            }
                        }
                        break;
                }
                $i++;
            } while ($i < count($items) && ($this->ViewMode == "Print" ||  !($i > 1 && $items[$i]->GroupType == 'Page' && $items[$i]->Mode == 1)));
            $Tpl->block_path = $ParentPath;
            $Tpl->parse($ReportBlock);
            $this->DataSource->close();
        }

    }
//End Show Method

} //End DetailPOL Class @264-FCB6E20C

class clsDetailPOLDataSource extends clsDBGayaFusionAll {  //DetailPOLDataSource Class @264-340547B3

//DataSource Variables @264-9EE87509
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $Qty;
    public $Photo1;
    public $CategoryName;
    public $SizeName;
    public $TextureName;
    public $ColorName;
    public $MaterialName;
    public $NameDesc;
    public $POL_D_ID;
    public $POL_H_ID;
    public $TotalSum_Qty;
//End DataSource Variables

//DataSourceClass_Initialize Event @264-3C248D8E
    function clsDetailPOLDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report DetailPOL";
        $this->Initialize();
        $this->Qty = new clsField("Qty", ccsInteger, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->CategoryName = new clsField("CategoryName", ccsText, "");
        
        $this->SizeName = new clsField("SizeName", ccsText, "");
        
        $this->TextureName = new clsField("TextureName", ccsText, "");
        
        $this->ColorName = new clsField("ColorName", ccsText, "");
        
        $this->MaterialName = new clsField("MaterialName", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->POL_D_ID = new clsField("POL_D_ID", ccsInteger, "");
        
        $this->POL_H_ID = new clsField("POL_H_ID", ccsInteger, "");
        
        $this->TotalSum_Qty = new clsField("TotalSum_Qty", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @264-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @264-66A2EFED
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlPOL_H_ID", ccsInteger, "", "", $this->Parameters["urlPOL_H_ID"], 0, false);
    }
//End Prepare Method

//Open Method @264-B65797E9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT tbladminist_pol_d.*, Photo1, CategoryName, SizeName, TextureName, ColorName, DesignName, MaterialName, NameDesc \n" .
        "FROM (((((((tblcollect_master INNER JOIN tblcollect_category ON\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tbladminist_pol_d ON\n" .
        "tbladminist_pol_d.CollectID = tblcollect_master.ID";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @264-64360297
    function SetValues()
    {
        $this->Qty->SetDBValue(trim($this->f("Qty")));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->CategoryName->SetDBValue($this->f("CategoryName"));
        $this->SizeName->SetDBValue($this->f("SizeName"));
        $this->TextureName->SetDBValue($this->f("TextureName"));
        $this->ColorName->SetDBValue($this->f("ColorName"));
        $this->MaterialName->SetDBValue($this->f("MaterialName"));
        $this->NameDesc->SetDBValue($this->f("NameDesc"));
        $this->POL_D_ID->SetDBValue(trim($this->f("POL_D_ID")));
        $this->POL_H_ID->SetDBValue(trim($this->f("POL_H_ID")));
        $this->TotalSum_Qty->SetDBValue(trim($this->f("Qty")));
    }
//End SetValues Method

} //End DetailPOLDataSource Class @264-FCB6E20C

//DetailPROF ReportGroup class @291-92E51A70
class clsReportGroupDetailPROF {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $Qty, $_QtyAttributes;
    public $Photo1, $_Photo1Attributes;
    public $NameDesc, $_NameDescAttributes;
    public $CategoryName, $_CategoryNameAttributes;
    public $ColorName, $_ColorNameAttributes;
    public $SizeName, $_SizeNameAttributes;
    public $TextureName, $_TextureNameAttributes;
    public $MaterialName, $_MaterialNameAttributes;
    public $Proforma_D_ID, $_Proforma_D_IDAttributes;
    public $Proforma_H_ID, $_Proforma_H_IDAttributes;
    public $ReportLabelPIN, $_ReportLabelPINAttributes;
    public $ReportLabelRAW, $_ReportLabelRAWAttributes;
    public $TotalSum_Qty, $_TotalSum_QtyAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;

    function clsReportGroupDetailPROF(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->Qty = $this->Parent->Qty->Value;
        $this->Photo1 = $this->Parent->Photo1->Value;
        $this->NameDesc = $this->Parent->NameDesc->Value;
        $this->CategoryName = $this->Parent->CategoryName->Value;
        $this->ColorName = $this->Parent->ColorName->Value;
        $this->SizeName = $this->Parent->SizeName->Value;
        $this->TextureName = $this->Parent->TextureName->Value;
        $this->MaterialName = $this->Parent->MaterialName->Value;
        $this->Proforma_D_ID = $this->Parent->Proforma_D_ID->Value;
        $this->Proforma_H_ID = $this->Parent->Proforma_H_ID->Value;
        $this->ReportLabelPIN = $this->Parent->ReportLabelPIN->Value;
        $this->ReportLabelRAW = $this->Parent->ReportLabelRAW->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->TotalSum_Qty = $this->Parent->TotalSum_Qty->GetTotalValue($mode);
        $this->_QtyAttributes = $this->Parent->Qty->Attributes->GetAsArray();
        $this->_Photo1Attributes = $this->Parent->Photo1->Attributes->GetAsArray();
        $this->_NameDescAttributes = $this->Parent->NameDesc->Attributes->GetAsArray();
        $this->_CategoryNameAttributes = $this->Parent->CategoryName->Attributes->GetAsArray();
        $this->_ColorNameAttributes = $this->Parent->ColorName->Attributes->GetAsArray();
        $this->_SizeNameAttributes = $this->Parent->SizeName->Attributes->GetAsArray();
        $this->_TextureNameAttributes = $this->Parent->TextureName->Attributes->GetAsArray();
        $this->_MaterialNameAttributes = $this->Parent->MaterialName->Attributes->GetAsArray();
        $this->_Proforma_D_IDAttributes = $this->Parent->Proforma_D_ID->Attributes->GetAsArray();
        $this->_Proforma_H_IDAttributes = $this->Parent->Proforma_H_ID->Attributes->GetAsArray();
        $this->_ReportLabelPINAttributes = $this->Parent->ReportLabelPIN->Attributes->GetAsArray();
        $this->_ReportLabelRAWAttributes = $this->Parent->ReportLabelRAW->Attributes->GetAsArray();
        $this->_TotalSum_QtyAttributes = $this->Parent->TotalSum_Qty->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->TotalSum_Qty = $this->TotalSum_Qty;
        $Header->_TotalSum_QtyAttributes = $this->_TotalSum_QtyAttributes;
        $this->Qty = $Header->Qty;
        $Header->_QtyAttributes = $this->_QtyAttributes;
        $this->Parent->Qty->Value = $Header->Qty;
        $this->Parent->Qty->Attributes->RestoreFromArray($Header->_QtyAttributes);
        $this->Photo1 = $Header->Photo1;
        $Header->_Photo1Attributes = $this->_Photo1Attributes;
        $this->Parent->Photo1->Value = $Header->Photo1;
        $this->Parent->Photo1->Attributes->RestoreFromArray($Header->_Photo1Attributes);
        $this->NameDesc = $Header->NameDesc;
        $Header->_NameDescAttributes = $this->_NameDescAttributes;
        $this->Parent->NameDesc->Value = $Header->NameDesc;
        $this->Parent->NameDesc->Attributes->RestoreFromArray($Header->_NameDescAttributes);
        $this->CategoryName = $Header->CategoryName;
        $Header->_CategoryNameAttributes = $this->_CategoryNameAttributes;
        $this->Parent->CategoryName->Value = $Header->CategoryName;
        $this->Parent->CategoryName->Attributes->RestoreFromArray($Header->_CategoryNameAttributes);
        $this->ColorName = $Header->ColorName;
        $Header->_ColorNameAttributes = $this->_ColorNameAttributes;
        $this->Parent->ColorName->Value = $Header->ColorName;
        $this->Parent->ColorName->Attributes->RestoreFromArray($Header->_ColorNameAttributes);
        $this->SizeName = $Header->SizeName;
        $Header->_SizeNameAttributes = $this->_SizeNameAttributes;
        $this->Parent->SizeName->Value = $Header->SizeName;
        $this->Parent->SizeName->Attributes->RestoreFromArray($Header->_SizeNameAttributes);
        $this->TextureName = $Header->TextureName;
        $Header->_TextureNameAttributes = $this->_TextureNameAttributes;
        $this->Parent->TextureName->Value = $Header->TextureName;
        $this->Parent->TextureName->Attributes->RestoreFromArray($Header->_TextureNameAttributes);
        $this->MaterialName = $Header->MaterialName;
        $Header->_MaterialNameAttributes = $this->_MaterialNameAttributes;
        $this->Parent->MaterialName->Value = $Header->MaterialName;
        $this->Parent->MaterialName->Attributes->RestoreFromArray($Header->_MaterialNameAttributes);
        $this->Proforma_D_ID = $Header->Proforma_D_ID;
        $Header->_Proforma_D_IDAttributes = $this->_Proforma_D_IDAttributes;
        $this->Parent->Proforma_D_ID->Value = $Header->Proforma_D_ID;
        $this->Parent->Proforma_D_ID->Attributes->RestoreFromArray($Header->_Proforma_D_IDAttributes);
        $this->Proforma_H_ID = $Header->Proforma_H_ID;
        $Header->_Proforma_H_IDAttributes = $this->_Proforma_H_IDAttributes;
        $this->Parent->Proforma_H_ID->Value = $Header->Proforma_H_ID;
        $this->Parent->Proforma_H_ID->Attributes->RestoreFromArray($Header->_Proforma_H_IDAttributes);
        $this->ReportLabelPIN = $Header->ReportLabelPIN;
        $Header->_ReportLabelPINAttributes = $this->_ReportLabelPINAttributes;
        $this->Parent->ReportLabelPIN->Value = $Header->ReportLabelPIN;
        $this->Parent->ReportLabelPIN->Attributes->RestoreFromArray($Header->_ReportLabelPINAttributes);
        $this->ReportLabelRAW = $Header->ReportLabelRAW;
        $Header->_ReportLabelRAWAttributes = $this->_ReportLabelRAWAttributes;
        $this->Parent->ReportLabelRAW->Value = $Header->ReportLabelRAW;
        $this->Parent->ReportLabelRAW->Attributes->RestoreFromArray($Header->_ReportLabelRAWAttributes);
    }
    function ChangeTotalControls() {
        $this->TotalSum_Qty = $this->Parent->TotalSum_Qty->GetValue();
    }
}
//End DetailPROF ReportGroup class

//DetailPROF GroupsCollection class @291-0D0171B2
class clsGroupsCollectionDetailPROF {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectionDetailPROF(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupDetailPROF($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->Qty->Value = $this->Parent->Qty->initialValue;
        $this->Parent->Photo1->Value = $this->Parent->Photo1->initialValue;
        $this->Parent->NameDesc->Value = $this->Parent->NameDesc->initialValue;
        $this->Parent->CategoryName->Value = $this->Parent->CategoryName->initialValue;
        $this->Parent->ColorName->Value = $this->Parent->ColorName->initialValue;
        $this->Parent->SizeName->Value = $this->Parent->SizeName->initialValue;
        $this->Parent->TextureName->Value = $this->Parent->TextureName->initialValue;
        $this->Parent->MaterialName->Value = $this->Parent->MaterialName->initialValue;
        $this->Parent->Proforma_D_ID->Value = $this->Parent->Proforma_D_ID->initialValue;
        $this->Parent->Proforma_H_ID->Value = $this->Parent->Proforma_H_ID->initialValue;
        $this->Parent->ReportLabelPIN->Value = $this->Parent->ReportLabelPIN->initialValue;
        $this->Parent->ReportLabelRAW->Value = $this->Parent->ReportLabelRAW->initialValue;
        $this->Parent->TotalSum_Qty->Value = $this->Parent->TotalSum_Qty->initialValue;
    }

    function OpenPage() {
        $this->TotalPages++;
        $Group = & $this->InitGroup();
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnInitialize", $this->Parent->Page_Header);
        if ($this->Parent->Page_Header->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Page_Header->Height;
        $Group->SetTotalControls("GetNextValue");
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnCalculate", $this->Parent->Page_Header);
        $Group->SetControls();
        $Group->Mode = 1;
        $Group->GroupType = "Page";
        $Group->PageTotalIndex = count($this->Groups);
        $this->mPageCurrentHeaderIndex = count($this->Groups);
        $this->Groups[] =  & $Group;
        $this->Pages[] =  count($this->Groups) == 2 ? 0 : count($this->Groups) - 1;
    }

    function OpenGroup($groupName) {
        $Group = "";
        $OpenFlag = false;
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnInitialize", $this->Parent->Report_Header);
            if ($this->Parent->Report_Header->Visible) 
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Header->Height;
                $Group->SetTotalControls("GetNextValue");
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnCalculate", $this->Parent->Report_Header);
            $Group->SetControls();
            $Group->Mode = 1;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->OpenPage();
        }
    }

    function ClosePage() {
        $Group = & $this->InitGroup();
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnInitialize", $this->Parent->Page_Footer);
        $Group->SetTotalControls("GetPrevValue");
        $Group->SyncWithHeader($this->Groups[$this->mPageCurrentHeaderIndex]);
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnCalculate", $this->Parent->Page_Footer);
        $Group->SetControls();
        $this->RestoreValues();
        $this->CurrentPageSize = 0;
        $Group->Mode = 2;
        $Group->GroupType = "Page";
        $this->Groups[] = & $Group;
    }

    function CloseGroup($groupName)
    {
        $Group = "";
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnInitialize", $this->Parent->Report_Footer);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->Report_Footer->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->Report_Footer->Height;
            if (($this->PageSize > 0) and $this->Parent->Report_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            $Group->SetTotalControls("GetPrevValue");
            $Group->SyncWithHeader($this->Groups[0]);
            if ($this->Parent->Report_Footer->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Footer->Height;
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnCalculate", $this->Parent->Report_Footer);
            $Group->SetControls();
            $this->RestoreValues();
            $Group->Mode = 2;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->ClosePage();
            return;
        }
    }

    function AddItem()
    {
        $Group = & $this->InitGroup(true);
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnInitialize", $this->Parent->Detail);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->Detail->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->Detail->Height;
        if (($this->PageSize > 0) and $this->Parent->Detail->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $this->TotalRows++;
        if ($this->LastDetailIndex)
            $PrevGroup = & $this->Groups[$this->LastDetailIndex];
        else
            $PrevGroup = "";
        $Group->SetTotalControls("", $PrevGroup);
        if ($this->Parent->Detail->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Detail->Height;
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnCalculate", $this->Parent->Detail);
        $Group->SetControls($PrevGroup);
        $this->LastDetailIndex = count($this->Groups);
        $this->Groups[] = & $Group;
    }
}
//End DetailPROF GroupsCollection class

class clsReportDetailPROF { //DetailPROF Class @291-BF59995C

//DetailPROF Variables @291-944D286E

    public $ComponentType = "Report";
    public $PageSize;
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $CCSEvents = array();
    public $CCSEventResult;
    public $RelativePath = "";
    public $ViewMode = "Web";
    public $TemplateBlock;
    public $PageNumber;
    public $RowNumber;
    public $TotalRows;
    public $TotalPages;
    public $ControlsVisible = array();
    public $IsEmpty;
    public $Attributes;
    public $DetailBlock, $Detail;
    public $Report_FooterBlock, $Report_Footer;
    public $Report_HeaderBlock, $Report_Header;
    public $Page_FooterBlock, $Page_Footer;
    public $Page_HeaderBlock, $Page_Header;
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
//End DetailPROF Variables

//Class_Initialize Event @291-9EDBCBFE
    function clsReportDetailPROF($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "DetailPROF";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->Detail = new clsSection($this);
        $MinPageSize = 0;
        $MaxSectionSize = 0;
        $this->Detail->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Detail->Height);
        $this->Report_Footer = new clsSection($this);
        $this->Report_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Report_Footer->Height);
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Footer->Height = 2;
        $MinPageSize += $this->Page_Footer->Height;
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->Errors = new clsErrors();
        $this->DataSource = new clsDetailPROFDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ViewMode = CCGetParam("ViewMode", "Web");
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else if($this->ViewMode == "Print") {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 50;
             else if ($PageSize == "0")
                $this->PageSize = 0;
             else 
                $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 40;
             else if ($PageSize == "0")
                $this->PageSize = 100;
             else 
                $this->PageSize = min(100, $PageSize);
        }
        $MinPageSize += $MaxSectionSize;
        if ($this->PageSize && $MinPageSize && $this->PageSize < $MinPageSize)
            $this->PageSize = $MinPageSize;
        $this->PageNumber = $this->ViewMode == "Print" ? 1 : intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0 ) {
            $this->PageNumber = 1;
        }

        $this->Qty = new clsControl(ccsReportLabel, "Qty", "Qty", ccsInteger, "", "", $this);
        $this->Qty->HTML = true;
        $this->Qty->EmptyText = "&nbsp;";
        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->Photo1->HTML = true;
        $this->NameDesc = new clsControl(ccsReportLabel, "NameDesc", "NameDesc", ccsText, "", "", $this);
        $this->NameDesc->HTML = true;
        $this->NameDesc->EmptyText = "&nbsp;";
        $this->CategoryName = new clsControl(ccsReportLabel, "CategoryName", "CategoryName", ccsText, "", "", $this);
        $this->CategoryName->HTML = true;
        $this->CategoryName->EmptyText = "&nbsp;";
        $this->ColorName = new clsControl(ccsReportLabel, "ColorName", "ColorName", ccsText, "", "", $this);
        $this->ColorName->HTML = true;
        $this->ColorName->EmptyText = "&nbsp;";
        $this->SizeName = new clsControl(ccsReportLabel, "SizeName", "SizeName", ccsText, "", "", $this);
        $this->SizeName->HTML = true;
        $this->SizeName->EmptyText = "&nbsp;";
        $this->TextureName = new clsControl(ccsReportLabel, "TextureName", "TextureName", ccsText, "", "", $this);
        $this->TextureName->HTML = true;
        $this->TextureName->EmptyText = "&nbsp;";
        $this->MaterialName = new clsControl(ccsReportLabel, "MaterialName", "MaterialName", ccsText, "", "", $this);
        $this->MaterialName->HTML = true;
        $this->MaterialName->EmptyText = "&nbsp;";
        $this->Proforma_D_ID = new clsControl(ccsHidden, "Proforma_D_ID", "Proforma_D_ID", ccsInteger, "", CCGetRequestParam("Proforma_D_ID", ccsGet, NULL), $this);
        $this->Proforma_D_ID->HTML = true;
        $this->Proforma_H_ID = new clsControl(ccsHidden, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", CCGetRequestParam("Proforma_H_ID", ccsGet, NULL), $this);
        $this->Proforma_H_ID->HTML = true;
        $this->ReportLabelPIN = new clsControl(ccsReportLabel, "ReportLabelPIN", "ReportLabelPIN", ccsText, "", "", $this);
        $this->ReportLabelPIN->IsEmptySource = true;
        $this->ReportLabelRAW = new clsControl(ccsReportLabel, "ReportLabelRAW", "ReportLabelRAW", ccsText, "", "", $this);
        $this->ReportLabelRAW->IsEmptySource = true;
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->TotalSum_Qty = new clsControl(ccsReportLabel, "TotalSum_Qty", "TotalSum_Qty", ccsInteger, "", "", $this);
        $this->TotalSum_Qty->HTML = true;
        $this->TotalSum_Qty->TotalFunction = "Sum";
        $this->TotalSum_Qty->EmptyText = "&nbsp;";
        $this->PageBreak = new clsPanel("PageBreak", $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @291-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @291-DDD548AE
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Qty->Errors->Count());
        $errors = ($errors || $this->Photo1->Errors->Count());
        $errors = ($errors || $this->NameDesc->Errors->Count());
        $errors = ($errors || $this->CategoryName->Errors->Count());
        $errors = ($errors || $this->ColorName->Errors->Count());
        $errors = ($errors || $this->SizeName->Errors->Count());
        $errors = ($errors || $this->TextureName->Errors->Count());
        $errors = ($errors || $this->MaterialName->Errors->Count());
        $errors = ($errors || $this->Proforma_D_ID->Errors->Count());
        $errors = ($errors || $this->Proforma_H_ID->Errors->Count());
        $errors = ($errors || $this->ReportLabelPIN->Errors->Count());
        $errors = ($errors || $this->ReportLabelRAW->Errors->Count());
        $errors = ($errors || $this->TotalSum_Qty->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @291-D60F7792
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CategoryName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ColorName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SizeName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MaterialName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Proforma_D_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Proforma_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabelPIN->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabelRAW->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalSum_Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @291-9B4EF9EC
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urlProforma_H_ID"] = CCGetFromGet("Proforma_H_ID", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $Groups = new clsGroupsCollectionDetailPROF($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->Qty->SetValue($this->DataSource->Qty->GetValue());
            $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
            $this->NameDesc->SetValue($this->DataSource->NameDesc->GetValue());
            $this->CategoryName->SetValue($this->DataSource->CategoryName->GetValue());
            $this->ColorName->SetValue($this->DataSource->ColorName->GetValue());
            $this->SizeName->SetValue($this->DataSource->SizeName->GetValue());
            $this->TextureName->SetValue($this->DataSource->TextureName->GetValue());
            $this->MaterialName->SetValue($this->DataSource->MaterialName->GetValue());
            $this->Proforma_D_ID->SetValue($this->DataSource->Proforma_D_ID->GetValue());
            $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
            $this->TotalSum_Qty->SetValue($this->DataSource->TotalSum_Qty->GetValue());
            $this->ReportLabelPIN->SetValue("");
            $this->ReportLabelRAW->SetValue("");
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            $Groups->AddItem();
            $is_next_record = $this->DataSource->next_record();
        }
        if (!count($Groups->Groups)) 
            $Groups->OpenGroup("Report");
        else
            $this->NoRecords->Visible = false;
        $Groups->CloseGroup("Report");
        $this->TotalPages = $Groups->TotalPages;
        $this->TotalRows = $Groups->TotalRows;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $this->Attributes->Show();
        $ReportBlock = "Report " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;

        if($this->CheckErrors()) {
            $Tpl->replaceblock("", $this->GetErrors());
            $Tpl->block_path = $ParentPath;
            return;
        } else {
            $items = & $Groups->Groups;
            $i = $Groups->Pages[min($this->PageNumber, $Groups->TotalPages) - 1];
            $this->ControlsVisible["Qty"] = $this->Qty->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
            $this->ControlsVisible["CategoryName"] = $this->CategoryName->Visible;
            $this->ControlsVisible["ColorName"] = $this->ColorName->Visible;
            $this->ControlsVisible["SizeName"] = $this->SizeName->Visible;
            $this->ControlsVisible["TextureName"] = $this->TextureName->Visible;
            $this->ControlsVisible["MaterialName"] = $this->MaterialName->Visible;
            $this->ControlsVisible["Proforma_D_ID"] = $this->Proforma_D_ID->Visible;
            $this->ControlsVisible["Proforma_H_ID"] = $this->Proforma_H_ID->Visible;
            $this->ControlsVisible["ReportLabelPIN"] = $this->ReportLabelPIN->Visible;
            $this->ControlsVisible["ReportLabelRAW"] = $this->ReportLabelRAW->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->Qty->SetValue($items[$i]->Qty);
                        $this->Qty->Attributes->RestoreFromArray($items[$i]->_QtyAttributes);
                        $this->Photo1->SetValue($items[$i]->Photo1);
                        $this->Photo1->Attributes->RestoreFromArray($items[$i]->_Photo1Attributes);
                        $this->NameDesc->SetValue($items[$i]->NameDesc);
                        $this->NameDesc->Attributes->RestoreFromArray($items[$i]->_NameDescAttributes);
                        $this->CategoryName->SetValue($items[$i]->CategoryName);
                        $this->CategoryName->Attributes->RestoreFromArray($items[$i]->_CategoryNameAttributes);
                        $this->ColorName->SetValue($items[$i]->ColorName);
                        $this->ColorName->Attributes->RestoreFromArray($items[$i]->_ColorNameAttributes);
                        $this->SizeName->SetValue($items[$i]->SizeName);
                        $this->SizeName->Attributes->RestoreFromArray($items[$i]->_SizeNameAttributes);
                        $this->TextureName->SetValue($items[$i]->TextureName);
                        $this->TextureName->Attributes->RestoreFromArray($items[$i]->_TextureNameAttributes);
                        $this->MaterialName->SetValue($items[$i]->MaterialName);
                        $this->MaterialName->Attributes->RestoreFromArray($items[$i]->_MaterialNameAttributes);
                        $this->Proforma_D_ID->SetValue($items[$i]->Proforma_D_ID);
                        $this->Proforma_D_ID->Attributes->RestoreFromArray($items[$i]->_Proforma_D_IDAttributes);
                        $this->Proforma_H_ID->SetValue($items[$i]->Proforma_H_ID);
                        $this->Proforma_H_ID->Attributes->RestoreFromArray($items[$i]->_Proforma_H_IDAttributes);
                        $this->ReportLabelPIN->SetValue($items[$i]->ReportLabelPIN);
                        $this->ReportLabelPIN->Attributes->RestoreFromArray($items[$i]->_ReportLabelPINAttributes);
                        $this->ReportLabelRAW->SetValue($items[$i]->ReportLabelRAW);
                        $this->ReportLabelRAW->Attributes->RestoreFromArray($items[$i]->_ReportLabelRAWAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->Qty->Show();
                        $this->Photo1->Show();
                        $this->NameDesc->Show();
                        $this->CategoryName->Show();
                        $this->ColorName->Show();
                        $this->SizeName->Show();
                        $this->TextureName->Show();
                        $this->MaterialName->Show();
                        $this->Proforma_D_ID->Show();
                        $this->Proforma_H_ID->Show();
                        $this->ReportLabelPIN->Show();
                        $this->ReportLabelRAW->Show();
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                        if ($this->Detail->Visible)
                            $Tpl->parseto("Section Detail", true, "Section Detail");
                        break;
                    case "Report":
                        if ($items[$i]->Mode == 1) {
                            $this->Report_Header->CCSEventResult = CCGetEvent($this->Report_Header->CCSEvents, "BeforeShow", $this->Report_Header);
                            if ($this->Report_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->TotalSum_Qty->SetValue($items[$i]->TotalSum_Qty);
                            $this->TotalSum_Qty->Attributes->RestoreFromArray($items[$i]->_TotalSum_QtyAttributes);
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
                                $this->TotalSum_Qty->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "Page":
                        if ($items[$i]->Mode == 1) {
                            $this->Page_Header->CCSEventResult = CCGetEvent($this->Page_Header->CCSEvents, "BeforeShow", $this->Page_Header);
                            if ($this->Page_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2 && !$this->UseClientPaging || $items[$i]->Mode == 1 && $this->UseClientPaging) {
                            $this->PageBreak->Visible = (($i < count($items) - 1) && ($this->ViewMode == "Print"));
                            $this->Navigator->PageNumber = $items[$i]->PageNumber;
                            $this->Navigator->TotalPages = $Groups->TotalPages;
                            $this->Navigator->Visible = ("Print" != $this->ViewMode);
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
                                $this->PageBreak->Show();
                                $this->Navigator->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Footer", true, "Section Detail");
                            }
                        }
                        break;
                }
                $i++;
            } while ($i < count($items) && ($this->ViewMode == "Print" ||  !($i > 1 && $items[$i]->GroupType == 'Page' && $items[$i]->Mode == 1)));
            $Tpl->block_path = $ParentPath;
            $Tpl->parse($ReportBlock);
            $this->DataSource->close();
        }

    }
//End Show Method

} //End DetailPROF Class @291-FCB6E20C

class clsDetailPROFDataSource extends clsDBGayaFusionAll {  //DetailPROFDataSource Class @291-C7F58061

//DataSource Variables @291-6985AE07
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $Qty;
    public $Photo1;
    public $NameDesc;
    public $CategoryName;
    public $ColorName;
    public $SizeName;
    public $TextureName;
    public $MaterialName;
    public $Proforma_D_ID;
    public $Proforma_H_ID;
    public $TotalSum_Qty;
//End DataSource Variables

//DataSourceClass_Initialize Event @291-2F4E1E24
    function clsDetailPROFDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report DetailPROF";
        $this->Initialize();
        $this->Qty = new clsField("Qty", ccsInteger, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->CategoryName = new clsField("CategoryName", ccsText, "");
        
        $this->ColorName = new clsField("ColorName", ccsText, "");
        
        $this->SizeName = new clsField("SizeName", ccsText, "");
        
        $this->TextureName = new clsField("TextureName", ccsText, "");
        
        $this->MaterialName = new clsField("MaterialName", ccsText, "");
        
        $this->Proforma_D_ID = new clsField("Proforma_D_ID", ccsInteger, "");
        
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        
        $this->TotalSum_Qty = new clsField("TotalSum_Qty", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @291-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @291-E987AFEA
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlProforma_H_ID", ccsText, "", "", $this->Parameters["urlProforma_H_ID"], 0, false);
    }
//End Prepare Method

//Open Method @291-772E4260
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT Proforma_D_ID, Proforma_H_ID, CollectID, Qty, Photo1, NameDesc, CategoryName, ColorName, SizeName, TextureName, DesignName,\n" .
        "MaterialName \n" .
        "FROM (((((((tblcollect_master INNER JOIN tblcollect_category ON\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tbladminist_proforma_d ON\n" .
        "tbladminist_proforma_d.CollectID = tblcollect_master.ID ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @291-3EBDBAB3
    function SetValues()
    {
        $this->Qty->SetDBValue(trim($this->f("Qty")));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->NameDesc->SetDBValue($this->f("NameDesc"));
        $this->CategoryName->SetDBValue($this->f("CategoryName"));
        $this->ColorName->SetDBValue($this->f("ColorName"));
        $this->SizeName->SetDBValue($this->f("SizeName"));
        $this->TextureName->SetDBValue($this->f("TextureName"));
        $this->MaterialName->SetDBValue($this->f("MaterialName"));
        $this->Proforma_D_ID->SetDBValue(trim($this->f("Proforma_D_ID")));
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
        $this->TotalSum_Qty->SetDBValue(trim($this->f("Qty")));
    }
//End SetValues Method

} //End DetailPROFDataSource Class @291-FCB6E20C







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

//Initialize Objects @1-12152935
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Grid = new clsGridGrid("", $MainPage);
$DetailPOL = new clsReportDetailPOL("", $MainPage);
$Report_Print = new clsControl(ccsLink, "Report_Print", "Report_Print", ccsText, "", CCGetRequestParam("Report_Print", ccsGet, NULL), $MainPage);
$Report_Print->HTML = true;
$Report_Print->Page = "ShowPOL.php";
$DetailPROF = new clsReportDetailPROF("", $MainPage);
$MainPage->Grid = & $Grid;
$MainPage->DetailPOL = & $DetailPOL;
$MainPage->Report_Print = & $Report_Print;
$MainPage->DetailPROF = & $DetailPROF;
$Report_Print->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Report_Print->Parameters = CCAddParam($Report_Print->Parameters, "ViewMode", "Print");
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

//Show Page @1-D711CE50
$Grid->Show();
$DetailPOL->Show();
$DetailPROF->Show();
$Report_Print->Show();
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
