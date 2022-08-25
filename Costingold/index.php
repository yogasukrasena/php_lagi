<?php session_start();
include ("../settings.php");
include("../language/$cfg_language");
include ("../classes/db_functions.php");
include ("../classes/security_functions.php");

$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'Costing',$lang);


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
    <td><img border=\"0\" src=\"../images/customers.gif\" width=\"41\" height=\"33\" valign='top'><font color='#005B7F' size='4'>&nbsp;<b>$lang->customers</b></font><br>
      <br>
      <font face=\"Verdana\" size=\"2\">$lang->CostingWelcomeScreen</font>
	  <ul><b>Costing :</b>
	  	<li><a href=\"MainCosting.php\">R&amp;D</a></li>
		<li><a href=\"MainCollection.php\">Collection</a></li>
		<li><a href=\"View_Clay.php\">Clay</a></li>
	  </ul>
      <ul><b>Cost/Minute :</b>
	  	<li><a href=\"View_ClayPreparation.php\">Clay Preparation</a></li>
		<li><a href=\"View_Wheel.php\">Wheel</a></li>
		<li><a href=\"View_Slab.php\">Slab</a></li>
		<li><a href=\"View_Casting.php\">$lang->Casting</a></li>
		<li><a href=\"View_Finishing.php\">Finishing</a></li>
		<li><a href=\"View_Glazing.php\">Glazing</a></li>
		<li><a href=\"View_Movement.php\">Movement</a></li>
		<li><a href=\"View_PackagingWork.php\">Packaging Work</a></li>
	  </ul>
	  <ul><b>Price for Firing :</b>
	  	<li><a href=\"View_StandardBisque.php\">Standard Bisque</a></li>
		<li><a href=\"View_StandardGlaze.php\">Standard Glaze</a></li>
		<li><a href=\"View_RakuBisque.php\">Raku Bisque</a></li>
		<li><a href=\"View_RakuGlaze.php\">Raku Glaze</a></li>
	  </ul>
      <ul><b>General Cost Control :</b>
	  	<li><a href=\"View_ProductiveHours.php\">Productive Hours</a></li>
		<li><a href=\"View_TrowWorker.php\">Trow Worker</a></li>
		<li><a href=\"View_CostBudget.php\">Cost Budget Preview</a></li>
	  </ul>	  
    </td>
  </tr>
</table>
</body>
</html>";

$dbf->closeDBlink();


?>
