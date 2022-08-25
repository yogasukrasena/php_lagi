<?php	
session_start();
include ("../Includes/sql.php");
//include_once("rnd_home.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<!doctype html public "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<link href="../Includes/Style-Oren.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" text="#000000" class="InLinePageBODY">
<table width="165" border="0" cellspacing="0" cellpadding="3">
	<tr>
    	<td><img src="../images/gayacostingkcl.jpg"></td>
  	</tr>
  	<tr>
    	<td>&nbsp;</td>
  	</tr>
  	<tr>
    	<td>
			<form>
			<table class="InLineFormTableNew" width="165" cellspacing="0" cellpadding="3">
				<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="maincosting.php" target="mainFrame">R &amp; D</a></td>
      			</tr>
				<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="maincollection.php" target="mainFrame">Collection</a></td>
      			</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
      			<tr>
        			<td class="InlineTitleTD">MASTER</td>
      			</tr>
	  			<tr>
	  				<td class="InlineLeftTitle">Cost/Minute</td>
				</tr>
				<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_Clay.php" target="mainFrame">Clay</a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_ClayPreparation.php" target="mainFrame">Clay Preparation </a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_Wheel.php" target="mainFrame">Wheel</a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="View_Slab.php" target="mainFrame">Slab</a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_Casting.php" target="mainFrame">Casting</a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_Finishing.php" target="mainFrame">Finishing</a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_Glazing.php" target="mainFrame">Glazing</a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_Movement.php" target="mainFrame">Movement</a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_PackagingWork.php" target="mainFrame">Packaging Work </a></td>
      			</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="InlineLeftTitle">Price For Firing</td>
				</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_StandardBisque.php" target="mainFrame">Standard Bisque </a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_StandardGlaze.php" target="mainFrame">Standard Glaze </a></td>
      			</tr>
      			<tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_RakuBisque.php" target="mainFrame">Raku Bisque </a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="View_RakuGlaze.php" target="mainFrame">Raku Glaze </a></td>
      </tr>
	  <tr>
	  	<td>&nbsp;</td>
	  </tr>
	  <tr>
	  	<td class="InlineLeftTitle">General Cost Control</td>
	  </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="View_ProductiveHours.php" target="mainFrame">Productive Hour </a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_TrowWorker.php" target="mainFrame">Trow Worker </a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_CostBudget.php" target="mainFrame">Cost Budget Preview </a></td>
      </tr>
	  <tr>
        <td ><a class="InLineDataLink" href="../logout.php" target="_top">Logout</a> </td>
      </tr>
    </table></form></td>
  </tr>
</table>
</body>
</html>