<?php	
session_start();
include ("../Includes/sql.php");
//include_once("rnd_home.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<html>
<head>
<link href="../Includes/Style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" text="#000000" class="InLinePageBODY">
<table width="165" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td><img src="../images/logogayakcl.jpg"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table class="InLineFormTableNew" width="165" cellspacing="0" cellpadding="3">
      <tr>
        <td class="InlineTitleTD">SAMPLE</td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_rndsampceramic.php" target="mainFrame">Sample Ceramic</a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_rndsamppackaging.php" target="mainFrame">Sample Packaging</a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="View_rndsampother.php" target="mainFrame">Sample Other</a></td>
      </tr>
      <tr>
        <td class="InlineTitleTD">&nbsp;</td>
      </tr>
      <tr>
        <td class="InlineTitleTD">MASTER</td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_rndclay.php" target="mainFrame">Clay</a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_rndCasting.php" target="mainFrame">Casting</a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_rndEstruder.php" target="mainFrame">Estruder</a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_rndTexture.php" target="mainFrame">Texture</a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_rndTools.php" target="mainFrame">Tools</a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_rndEngobe.php" target="mainFrame">Engobe</a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_rndStainoxid.php" target="mainFrame">Stain &	Oxide</a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_rndGlaze.php" target="mainFrame">Glaze</a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="View_rndFiringPlan.php" target="mainFrame">Firing Plan</a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="View_rndDesMaterial.php" target="mainFrame">Design Material</a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="view_rndSupplier.php" target="mainFrame">Supplier</a></td>
      </tr>
      <tr>
        <td class="InLineFieldCaptionTD"><a class="InLineDataLink" href="view_rndUnit.php" target="mainFrame">Unit</a> </td>
      </tr>
	  <tr>
        <td class="InlineTitleTD">&nbsp;</td>
      </tr>
	  <tr>
        <td class="InlineTitleTD">CODIFICATION</td>
      </tr>
      <tr>
        <td class="InLineFieldCodifTD"><a class="InLineDataLink" href="c_codifica_list.php" target="mainFrame">Design</a> </td>
      </tr>
      <tr>
        <td class="InLineFieldCodifTD"><a class="InLineDataLink" href="c_codifica_list.php" target="mainFrame">Name</a> </td>
      </tr>
      <tr>
        <td class="InLineFieldCodifTD"><a class="InLineDataLink" href="c_codifica_list.php" target="mainFrame">Category</a> </td>
      </tr>
      <tr>
        <td class="InLineFieldCodifTD"><a class="InLineDataLink" href="c_codifica_list.php" target="mainFrame">Info / Size</a> </td>
      </tr>
      <tr>
        <td class="InLineFieldCodifTD"><a class="InLineDataLink" href="c_codifica_list.php" target="mainFrame">Texture</a> </td>
      </tr>
      <tr>
        <td class="InLineFieldCodifTD"><a class="InLineDataLink" href="c_codifica_list.php" target="mainFrame">Color</a> </td>
      </tr>
      <tr>
        <td class="InLineFieldCodifTD"><a class="InLineDataLink" href="c_codifica_list.php" target="mainFrame">Material</a> </td>
      </tr>
	  <tr>
		<td class="InlineTitleTD">&nbsp;</td>
      </tr>
	  <tr>
        <td ><a class="InLineDataLink" href="../logout.php" target="_top">Logout</a> </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>