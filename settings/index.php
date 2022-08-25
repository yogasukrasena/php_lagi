<?php session_start();
include ("../settings.php");
include ("../language/$cfg_language");
include ("../classes/db_functions.php");
include ("../classes/security_functions.php");
include ("../classes/display.php");

// Gets current values from settings.php
function getFormFields() 
{
	global $cfg_company;
	global $cfg_address;
	global $cfg_phone;
	global $cfg_email;
	global $cfg_fax;
	global $cfg_website;
	global $cfg_other;
	global $cfg_DocNotes;
	global $cfg_currency_symbol;
	global $cfg_theme;
	global $cfg_language;
	global $cfg_numberForBarcode;


	$formFields[0]=$cfg_company;
	$formFields[1]=$cfg_address;
	$formFields[2]=$cfg_phone;
	$formFields[3]=$cfg_email;
	$formFields[4]=$cfg_fax;
	$formFields[5]=$cfg_website;
	$formFields[6]=$cfg_other;
	$formFields[7]=$cfg_DocNotes;
	$formFields[8]=$cfg_currency_symbol;
	$formFields[9]=$cfg_numberForBarcode;
	$formFields[10]=$cfg_language;

	return $formFields;
}


function displayUpdatePage($defaultValuesAsArray) 
{

global $hDisplay;
global $cfg_theme;
global $cfg_numberForBarcode;

$themeRowColor1=$hDisplay->rowcolor1;
$themeRowColor2=$hDisplay->rowcolor2;
$lang=new language();

?>
<?php
echo "
<html>
<head>
</head>
<body>

<table border=\"0\" width=\"550\">
  <tr>
    <td>
      <p align=\"left\"><img border=\"0\" src=\"../images/config.gif\" width=\"21\" height=\"28\" valign='top'><font color='#005B7F' size='4'>&nbsp;<b>$lang->config</b></font><br>
      <br>
      <font face=\"Verdana\" size=\"2\">$lang->configurationWelcomeMessage</font></p>
      <div align=\"center\">
        <center>
        <form action=\"index.php\" method=\"post\">
        <div align=\"left\">
        <table border=\"0\" width=\"349\" bgcolor=\"#FFFFFF\">
          <tr>
            <td width=\"122\" align=\"left\" bgcolor=\"$themeRowColor1\">
              <p align=\"center\"><font face=\"Verdana\" size=\"2\"><b>$lang->companyName</b></font></p>
            </td>
            <td width=\"214\" bgcolor=\"$themeRowColor1\">
              <p align=\"center\"><input type=\"text\" name=\"companyName\" size=\"29\" value=\"".$defaultValuesAsArray[0]."\" style=\"border-style: solid; border-width: 1\"></p>
            </td>
          </tr>
          <tr>
            <td width=\"122\" align=\"left\" bgcolor=\"$themeRowColor2\">
              <p align=\"center\"><font face=\"Verdana\" size=\"2\">$lang->address:</font></p>
            </td>
            <td width=\"214\" bgcolor=\"$themeRowColor2\">
              <p align=\"center\"><textarea name=\"companyAddress\" rows=\"4\" cols=\"26\" style=\"border-style: solid; border-width: 1\">$defaultValuesAsArray[1]</textarea></p>
            </td>
          </tr>
          <tr>
            <td width=\"122\" align=\"left\" bgcolor=\"$themeRowColor1\">
              <p align=\"center\"><font face=\"Verdana\" size=\"2\"><b>$lang->phoneNumber:</b></font></p>
            </td>
            <td width=\"214\" bgcolor=\"$themeRowColor1\">
              <p align=\"center\"><input type=\"text\" name=\"companyPhone\" size=\"29\" value=\"".$defaultValuesAsArray[2]."\" style=\"border-style: solid; border-width: 1\"></p>
            </td>
          </tr>
          <tr>
            <td width=\"122\" align=\"left\" bgcolor=\"$themeRowColor2\">
              <p align=\"center\"><font face=\"Verdana\" size=\"2\">$lang->email:</font></p>
            </td>
            <td width=\"214\" bgcolor=\"$themeRowColor2\">
              <p align=\"center\"><input type=\"text\" name=\"companyEmail\" size=\"29\" value=\"".$defaultValuesAsArray[3]."\" style=\"border-style: solid; border-width: 1\"></p>
            </td>
          </tr>
          <tr>
            <td width=\"122\" align=\"left\" bgcolor=\"$themeRowColor1\">
              <p align=\"center\"><font face=\"Verdana\" size=\"2\">$lang->fax:</font></p>
            </td>
            <td width=\"214\" bgcolor=\"$themeRowColor1\">
              <p align=\"center\"><input type=\"text\" name=\"companyFax\" size=\"29\" value=\"".$defaultValuesAsArray[4]."\" style=\"border-style: solid; border-width: 1\"></p>
            </td>
          </tr>
          <tr>
            <td width=\"122\" align=\"left\" bgcolor=\"$themeRowColor2\">
              <p align=\"center\"><font face=\"Verdana\" size=\"2\">$lang->website:</font></p>
            </td>
            <td width=\"214\" bgcolor=\"$themeRowColor2\">
              <p align=\"center\"><input type=\"text\" name=\"companyWebsite\" size=\"29\" value=\"".$defaultValuesAsArray[5]."\" style=\"border-style: solid; border-width: 1\"></p>
            </td>
          </tr>
          <tr>
            <td width=\"122\" align=\"left\" bgcolor=\"$themeRowColor1\">
              <p align=\"center\"><font face=\"Verdana\" size=\"2\">$lang->other:</font></p>
            </td>
            <td width=\"214\" bgcolor=\"$themeRowColor1\">
              <p align=\"center\"><input type=\"text\" name=\"companyOther\" size=\"29\" value=\"".$defaultValuesAsArray[6]."\" style=\"border-style: solid; border-width: 1\"></p>
            </td>
          </tr>
          <tr>
            <td width=\"122\" align=\"left\" bgcolor=\"$themeRowColor1\">
              <p align=\"center\"><font face=\"Verdana\" size=\"2\"><b>Document Notes:</b><br>
              </font></p>
            </td>
            <td width=\"214\" bgcolor=\"$themeRowColor1\">
              <p align=\"center\"><textarea name=\"taxRate\" rows=\"4\" cols=\"26\" style=\"border-style: solid; border-width: 1\">$defaultValuesAsArray[7]</textarea></p>
            </td>
          </tr>"
			?>
       <?php   
        echo "</table>
        </div>
        </center>
        <p align=\"left\">
        <input type=\"submit\" name=\"submitChanges\" style=\"border-style: solid; border-width: 1\"><Br>
        </form>
      </div>
    </td>
  </tr>
</table>
</body>
</html>";

}

function updateSettings($companyname,$companyaddress,$companyphone,$companyemail,$companyfax,$companywebsite,$companyother,$taxrate) {
 
include("../settings.php");
$lang=new language();
$writeConfigurationFile="<?php
\$cfg_company=\"$companyname\";
\$cfg_address=\"$companyaddress\";
\$cfg_phone=\"$companyphone\";
\$cfg_email=\"$companyemail\";
\$cfg_fax=\"$companyfax\";
\$cfg_website=\"$companywebsite\";
\$cfg_other=\"$companyother\";
\$cfg_server=\"$cfg_server\";
\$cfg_database=\"$cfg_database\";
\$cfg_username=\"$cfg_username\";
\$cfg_password=\"$cfg_password\";
\$cfg_tableprefix=\"$cfg_tableprefix\";
\$cfg_DocNotes=\"$taxrate\";
\$cfg_currency_symbol=\"Rp\";
\$cfg_theme=\"serious\";
\$cfg_language=\"english.php\";
?>";	
        
	@unlink("../settings.php");
	$hWriteConfiguration = @fopen("../settings.php", "w+" ) or die ("<br><center><img src='config_updated_failed.gif'><br><br><b>$lang->configUpdatedUnsucessfully</b></center>");
	fputs( $hWriteConfiguration, $writeConfigurationFile);
	fclose( $hWriteConfiguration );
}

// --------------------- Code starts here -----------------------//
$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'Admin',$lang);
$hDisplay=new display($dbf,$cfg_theme,$cfg_currency_symbol,$lang);

if(!$sec->isLoggedIn())
{
	header ("location: ../login.php");
	exit();
}

if(isset($_POST['submitChanges'])) {
	if($_POST['companyName']!="" && $_POST['companyPhone']!="" && $_POST['taxRate']!="") 
	{
		
		updateSettings($_POST['companyName'],$_POST['companyAddress'],$_POST['companyPhone'],
			$_POST['companyEmail'],$_POST['companyFax'],$_POST['companyWebsite'],$_POST['companyOther'],$_POST['taxRate']);
		echo "<br><center><img src='config_updated_ok.gif'><br><br><b>$lang->configUpdatedSuccessfully</b></center>";
	} 
	else 
	{
		echo "$lang->forgottenFields";
	}
} 
elseif (isset($_POST['cancelChanges'])) 
{
	header("Location: ../home.php");
} 
else 
{
	displayUpdatePage(getFormFields());
}

$dbf->closeDBlink();
?>