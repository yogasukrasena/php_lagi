<?php session_start();
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

echo "
<html>
<body>
<head>

</head>

<table border=\"0\" width=\"500\">
  <tr>
    <td><img border=\"0\" src=\"../images/customers.gif\" width=\"41\" height=\"33\" valign='top'><font color='#005B7F' size='4'>&nbsp;<b>$lang->Collection</b></font><br>
      <br>
      <font face=\"Verdana\" size=\"2\">$lang->CollectionWelcomeScreen</font>
      <ul><b>Manage Collection :</b>
        <li><font face=\"Verdana\" size=\"2\"><a href=\"Collection.php\">$lang->Collection</a></font></li>
        <li><font face=\"Verdana\" size=\"2\"><a href=\"CollectionGroup.php\">$lang->Collection Group</a></font></li>
      </ul>
	  <ul><b>$lang->Master :</b>
        <li><font face=\"Verdana\" size=\"2\"><a href=\"Design.php\">Design</a></font></li>
        <li><font face=\"Verdana\" size=\"2\"><a href=\"CollectName.php\">Name</a></font></li>
        <li><font face=\"Verdana\" size=\"2\"><a href=\"Category.php\">$lang->Category</a></font></li>
        <li><font face=\"Verdana\" size=\"2\"><a href=\"InfoSize.php\">Info/Size</a></font></li>
		<li><font face=\"Verdana\" size=\"2\"><a href=\"Texture.php\">$lang->Texture</a></font></li>
        <li><font face=\"Verdana\" size=\"2\"><a href=\"Color.php\">Color</a></font></li>
		<li><font face=\"Verdana\" size=\"2\"><a href=\"Material.php\">$lang->Material</a></font></li>
      </ul>
    </td>
  </tr>
</table>
</body>
</html>";

$dbf->closeDBlink();


?>
