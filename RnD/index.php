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
<link rel=\"stylesheet\" href=\"interface.css\" type=\"text/css\" />
</head>

<table border=\"0\" width=\"500\">
  <tr>
    <td><img border=\"0\" src=\"../images/RnD.gif\" width=\"41\" height=\"33\" valign='top'><font color='#005B7F' size='4'>&nbsp;<b>$lang->RnD</b></font><br>
      <br>
      <font face=\"Verdana\" size=\"2\">$lang->RnDWelcomeScreen</font>
	  <ul><b>Sample :</b>
	  	<li><a href=\"sampleceramic.php\">$lang->SampleCeramic</a></li>
		<li><a href=\"samplePackaging.php\">Sample Packaging</a></li>
		<li><a href=\"SampleOther.php\">Sample Other</a></li>
	  </ul>	  
      <ul><b>Component :</b>
	  	<li><a href=\"Clay.php\">Clay</a></li>
		<li><a href=\"Casting.php\">Casting</a></li>
		<li><a href=\"Estruder.php\">Estruder</a></li>
		<li><a href=\"Texture.php\">Texture</a></li>
		<li><a href=\"Tools.php\">Tools</a></li>
		<li><a href=\"Engobe.php\">Engobe</a></li>
		<li><a href=\"StainOxide.php\">Stain &amp; Oxide</a></li>
		<li><a href=\"Glaze.php\">Glaze</a></li>
		<li><a href=\"FiringPlan.php\">Firing Plan</a></li>
		<li><a href=\"DesignMat.php\">Design Material</a></li>
		<li><a href=\"Supplier.php\">Supplier</a></li>
		<li><a href=\"Unit.php\">Unit</a></li>		
	  </ul>
    </td>
  </tr>
</table>
</body>
</html>";

$dbf->closeDBlink();


?>
