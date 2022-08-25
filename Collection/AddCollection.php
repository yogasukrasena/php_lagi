<?php
//Include Common Files @1-C3B4CF79

define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "AddCollection.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordAddCollect { //AddCollect Class @2-D9822AE0

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

//Class_Initialize Event @2-D911FFF3
    function clsRecordAddCollect($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record AddCollect/Error";
        $this->DataSource = new clsAddCollectDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "AddCollect";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->DesignCode = new clsControl(ccsListBox, "DesignCode", "Design Code", ccsText, "", CCGetRequestParam("DesignCode", $Method, NULL), $this);
            $this->DesignCode->DSType = dsTable;
            $this->DesignCode->DataSource = new clsDBGayaFusionAll();
            $this->DesignCode->ds = & $this->DesignCode->DataSource;
            //$this->DesignCode->DataSource->SQL = "SELECT * \n" . "FROM tblcollect_design {SQL_Where} {SQL_OrderBy}";
			$this->DesignCode->DataSource->SQL = "SELECT * \n" . "FROM tblcollect_design {SQL_Where} ORDER BY DesignName ASC";
            list($this->DesignCode->BoundColumn, $this->DesignCode->TextColumn, $this->DesignCode->DBFormat) = array("DesignCode", "DesignName", "");
            $this->DesignCode->Required = true;
            $this->NameCode = new clsControl(ccsListBox, "NameCode", "Name Code", ccsText, "", CCGetRequestParam("NameCode", $Method, NULL), $this);
            $this->NameCode->DSType = dsTable;
            $this->NameCode->DataSource = new clsDBGayaFusionAll();
            $this->NameCode->ds = & $this->NameCode->DataSource;
            $this->NameCode->DataSource->SQL = "SELECT * \n" . "FROM tblcollect_name {SQL_Where} ORDER BY NameDesc ASC";
            list($this->NameCode->BoundColumn, $this->NameCode->TextColumn, $this->NameCode->DBFormat) = array("NameCode", "NameDesc", "");
            $this->NameCode->Required = true;
            $this->CategoryCode = new clsControl(ccsListBox, "CategoryCode", "Category Code", ccsText, "", CCGetRequestParam("CategoryCode", $Method, NULL), $this);
            $this->CategoryCode->DSType = dsTable;
            $this->CategoryCode->DataSource = new clsDBGayaFusionAll();
            $this->CategoryCode->ds = & $this->CategoryCode->DataSource;
            $this->CategoryCode->DataSource->SQL = "SELECT * \n" . "FROM tblcollect_category {SQL_Where} ORDER BY CategoryName ASC";
            list($this->CategoryCode->BoundColumn, $this->CategoryCode->TextColumn, $this->CategoryCode->DBFormat) = array("CategoryCode", "CategoryName", "");
            $this->CategoryCode->Required = true;
            $this->TextureCode = new clsControl(ccsListBox, "TextureCode", "Texture Code", ccsText, "", CCGetRequestParam("TextureCode", $Method, NULL), $this);
            $this->TextureCode->DSType = dsTable;
            $this->TextureCode->DataSource = new clsDBGayaFusionAll();
            $this->TextureCode->ds = & $this->TextureCode->DataSource;
            $this->TextureCode->DataSource->SQL = "SELECT * \n" . "FROM tblcollect_texture {SQL_Where} ORDER BY TextureName ASC";
            list($this->TextureCode->BoundColumn, $this->TextureCode->TextColumn, $this->TextureCode->DBFormat) = array("TextureCode", "TextureName", "");
            $this->TextureCode->Required = true;
            $this->ColorCode = new clsControl(ccsListBox, "ColorCode", "Color Code", ccsText, "", CCGetRequestParam("ColorCode", $Method, NULL), $this);
            $this->ColorCode->DSType = dsTable;
            $this->ColorCode->DataSource = new clsDBGayaFusionAll();
            $this->ColorCode->ds = & $this->ColorCode->DataSource;
            $this->ColorCode->DataSource->SQL = "SELECT * \n" . "FROM tblcollect_color {SQL_Where} ORDER BY ColorName ASC";
            list($this->ColorCode->BoundColumn, $this->ColorCode->TextColumn, $this->ColorCode->DBFormat) = array("ColorCode", "ColorName", "");
            $this->ColorCode->Required = true;
            $this->MaterialCode = new clsControl(ccsListBox, "MaterialCode", "Material Code", ccsText, "", CCGetRequestParam("MaterialCode", $Method, NULL), $this);
            $this->MaterialCode->DSType = dsTable;
            $this->MaterialCode->DataSource = new clsDBGayaFusionAll();
            $this->MaterialCode->ds = & $this->MaterialCode->DataSource;
            $this->MaterialCode->DataSource->SQL = "SELECT * \n" . "FROM tblcollect_material {SQL_Where} ORDER BY MaterialName ASC";
            list($this->MaterialCode->BoundColumn, $this->MaterialCode->TextColumn, $this->MaterialCode->DBFormat) = array("MaterialCode", "MaterialName", "");
            $this->MaterialCode->Required = true;
            $this->SizeCode = new clsControl(ccsListBox, "SizeCode", "Size Code", ccsText, "", CCGetRequestParam("SizeCode", $Method, NULL), $this);
            $this->SizeCode->DSType = dsTable;
            $this->SizeCode->DataSource = new clsDBGayaFusionAll();
            $this->SizeCode->ds = & $this->SizeCode->DataSource;
            //$this->SizeCode->DataSource->SQL = "SELECT * \n" . "FROM tblcollect_size {SQL_Where} {SQL_OrderBy}";
			$this->SizeCode->DataSource->SQL = "SELECT * \n" . "FROM tblcollect_size {SQL_Where} ORDER BY SizeName ASC";
            list($this->SizeCode->BoundColumn, $this->SizeCode->TextColumn, $this->SizeCode->DBFormat) = array("SizeCode", "SizeName", "");
            $this->SizeCode->Required = true;
            $this->LinkEdit = new clsControl(ccsLink, "LinkEdit", "LinkEdit", ccsText, "", CCGetRequestParam("LinkEdit", $Method, NULL), $this);
            $this->LinkEdit->Page = "EditCollection.php";
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

//Validate Method @2-46AFB30A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->DesignCode->Validate() && $Validation);
        $Validation = ($this->NameCode->Validate() && $Validation);
        $Validation = ($this->CategoryCode->Validate() && $Validation);
        $Validation = ($this->TextureCode->Validate() && $Validation);
        $Validation = ($this->ColorCode->Validate() && $Validation);
        $Validation = ($this->MaterialCode->Validate() && $Validation);
        $Validation = ($this->SizeCode->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->DesignCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->NameCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CategoryCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextureCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ColorCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->MaterialCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SizeCode->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-5DE3E374
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->DesignCode->Errors->Count());
        $errors = ($errors || $this->NameCode->Errors->Count());
        $errors = ($errors || $this->CategoryCode->Errors->Count());
        $errors = ($errors || $this->TextureCode->Errors->Count());
        $errors = ($errors || $this->ColorCode->Errors->Count());
        $errors = ($errors || $this->MaterialCode->Errors->Count());
        $errors = ($errors || $this->SizeCode->Errors->Count());
        $errors = ($errors || $this->LinkEdit->Errors->Count());
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

//Operation Method @2-5DEBB755
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
            $Redirect = "Collection.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "DesignCode", "NameCode", "CategoryCode", "SizeCode", "TextureCode", "ColorCode", "MaterialCode"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "Collection.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "DesignCode", "NameCode", "CategoryCode", "SizeCode", "TextureCode", "ColorCode", "MaterialCode"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "Collection.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "DesignCode", "NameCode", "CategoryCode", "SizeCode", "TextureCode", "ColorCode", "MaterialCode"));
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

//InsertRow Method @2-51AA850E
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->DesignCode->SetValue($this->DesignCode->GetValue(true));
        $this->DataSource->NameCode->SetValue($this->NameCode->GetValue(true));
        $this->DataSource->CategoryCode->SetValue($this->CategoryCode->GetValue(true));
        $this->DataSource->TextureCode->SetValue($this->TextureCode->GetValue(true));
        $this->DataSource->ColorCode->SetValue($this->ColorCode->GetValue(true));
        $this->DataSource->MaterialCode->SetValue($this->MaterialCode->GetValue(true));
        $this->DataSource->SizeCode->SetValue($this->SizeCode->GetValue(true));
        $this->DataSource->LinkEdit->SetValue($this->LinkEdit->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-8C381234
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->DesignCode->SetValue($this->DesignCode->GetValue(true));
        $this->DataSource->NameCode->SetValue($this->NameCode->GetValue(true));
        $this->DataSource->CategoryCode->SetValue($this->CategoryCode->GetValue(true));
        $this->DataSource->TextureCode->SetValue($this->TextureCode->GetValue(true));
        $this->DataSource->ColorCode->SetValue($this->ColorCode->GetValue(true));
        $this->DataSource->MaterialCode->SetValue($this->MaterialCode->GetValue(true));
        $this->DataSource->SizeCode->SetValue($this->SizeCode->GetValue(true));
        $this->DataSource->LinkEdit->SetValue($this->LinkEdit->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-639D3D52
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

        $this->DesignCode->Prepare();
        $this->NameCode->Prepare();
        $this->CategoryCode->Prepare();
        $this->TextureCode->Prepare();
        $this->ColorCode->Prepare();
        $this->MaterialCode->Prepare();
        $this->SizeCode->Prepare();

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
                    $this->DesignCode->SetValue($this->DataSource->DesignCode->GetValue());
                    $this->NameCode->SetValue($this->DataSource->NameCode->GetValue());
                    $this->CategoryCode->SetValue($this->DataSource->CategoryCode->GetValue());
                    $this->TextureCode->SetValue($this->DataSource->TextureCode->GetValue());
                    $this->ColorCode->SetValue($this->DataSource->ColorCode->GetValue());
                    $this->MaterialCode->SetValue($this->DataSource->MaterialCode->GetValue());
                    $this->SizeCode->SetValue($this->DataSource->SizeCode->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        $this->LinkEdit->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->LinkEdit->Parameters = CCAddParam($this->LinkEdit->Parameters, "ID", $this->DataSource->f("ID"));

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->DesignCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->NameCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CategoryCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextureCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ColorCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->MaterialCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SizeCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkEdit->Errors->ToString());
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
        $this->DesignCode->Show();
        $this->NameCode->Show();
        $this->CategoryCode->Show();
        $this->TextureCode->Show();
        $this->ColorCode->Show();
        $this->MaterialCode->Show();
        $this->SizeCode->Show();
        $this->LinkEdit->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddCollect Class @2-FCB6E20C

class clsAddCollectDataSource extends clsDBGayaFusionAll {  //AddCollectDataSource Class @2-AB51F1D4

//DataSource Variables @2-C00921B0
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
    public $DesignCode;
    public $NameCode;
    public $CategoryCode;
    public $TextureCode;
    public $ColorCode;
    public $MaterialCode;
    public $SizeCode;
    public $LinkEdit;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-476C8D64
    function clsAddCollectDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddCollect/Error";
        $this->Initialize();
        $this->DesignCode = new clsField("DesignCode", ccsText, "");
        
        $this->NameCode = new clsField("NameCode", ccsText, "");
        
        $this->CategoryCode = new clsField("CategoryCode", ccsText, "");
        
        $this->TextureCode = new clsField("TextureCode", ccsText, "");
        
        $this->ColorCode = new clsField("ColorCode", ccsText, "");
        
        $this->MaterialCode = new clsField("MaterialCode", ccsText, "");
        
        $this->SizeCode = new clsField("SizeCode", ccsText, "");
        
        $this->LinkEdit = new clsField("LinkEdit", ccsText, "");
        

        $this->InsertFields["DesignCode"] = array("Name" => "DesignCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["NameCode"] = array("Name" => "NameCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["CategoryCode"] = array("Name" => "CategoryCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["TextureCode"] = array("Name" => "TextureCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ColorCode"] = array("Name" => "ColorCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["MaterialCode"] = array("Name" => "MaterialCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["SizeCode"] = array("Name" => "SizeCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignCode"] = array("Name" => "DesignCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["NameCode"] = array("Name" => "NameCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["CategoryCode"] = array("Name" => "CategoryCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["TextureCode"] = array("Name" => "TextureCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ColorCode"] = array("Name" => "ColorCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["MaterialCode"] = array("Name" => "MaterialCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SizeCode"] = array("Name" => "SizeCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @2-AE2DEEE1
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblcollect_master {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-0E29C4B7
    function SetValues()
    {
        $this->DesignCode->SetDBValue($this->f("DesignCode"));
        $this->NameCode->SetDBValue($this->f("NameCode"));
        $this->CategoryCode->SetDBValue($this->f("CategoryCode"));
        $this->TextureCode->SetDBValue($this->f("TextureCode"));
        $this->ColorCode->SetDBValue($this->f("ColorCode"));
        $this->MaterialCode->SetDBValue($this->f("MaterialCode"));
        $this->SizeCode->SetDBValue($this->f("SizeCode"));
    }
//End SetValues Method

//Insert Method @2-43954AF5
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["DesignCode"]["Value"] = $this->DesignCode->GetDBValue(true);
        $this->InsertFields["NameCode"]["Value"] = $this->NameCode->GetDBValue(true);
        $this->InsertFields["CategoryCode"]["Value"] = $this->CategoryCode->GetDBValue(true);
        $this->InsertFields["TextureCode"]["Value"] = $this->TextureCode->GetDBValue(true);
        $this->InsertFields["ColorCode"]["Value"] = $this->ColorCode->GetDBValue(true);
        $this->InsertFields["MaterialCode"]["Value"] = $this->MaterialCode->GetDBValue(true);
        $this->InsertFields["SizeCode"]["Value"] = $this->SizeCode->GetDBValue(true);
        $this->SQL = CCBuildInsert("tblcollect_master", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-2E6A6E59
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["DesignCode"]["Value"] = $this->DesignCode->GetDBValue(true);
        $this->UpdateFields["NameCode"]["Value"] = $this->NameCode->GetDBValue(true);
        $this->UpdateFields["CategoryCode"]["Value"] = $this->CategoryCode->GetDBValue(true);
        $this->UpdateFields["TextureCode"]["Value"] = $this->TextureCode->GetDBValue(true);
        $this->UpdateFields["ColorCode"]["Value"] = $this->ColorCode->GetDBValue(true);
        $this->UpdateFields["MaterialCode"]["Value"] = $this->MaterialCode->GetDBValue(true);
        $this->UpdateFields["SizeCode"]["Value"] = $this->SizeCode->GetDBValue(true);
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

} //End AddCollectDataSource Class @2-FCB6E20C

//Initialize Page @1-89BD009A
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
$TemplateFileName = "AddCollection.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-E6F17E93
include_once("./AddCollection_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A2EE6AE0
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$AddCollect = new clsRecordAddCollect("", $MainPage);
$MainPage->AddCollect = & $AddCollect;
$AddCollect->Initialize();

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

//Execute Components @1-510DF6AF
$AddCollect->Operation();
//End Execute Components

//Go to destination page @1-B1246671
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($AddCollect);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E4447294
$AddCollect->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-77BFBC16
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($AddCollect);
unset($Tpl);
//End Unload Page


?>
