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
<link href="../Includes/Style-collect.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" text="#000000" class="InLinePageBODY">
<table width="165" border="0" cellspacing="0" cellpadding="3">
	<tr>
    	<td><img src="../images/gayacollectionkcl.jpg"></td>
  	</tr>
  	<tr>
    	<td>&nbsp;</td>
  	</tr>
  	<tr>
    	<td>
			<form>
			<table class="InLineFormTableNew" width="165" cellspacing="0" cellpadding="3">
				<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="MainCollection.php" target="mainFrame">Main Collection </a></td>
      			</tr>
				<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="CollectionGroup.php" target="mainFrame">Collection in Group</a></td>
      			</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
      			<tr>
        			<td>MASTER</td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="View_Design.php" target="mainFrame">Design</a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="View_Name.php" target="mainFrame">Name</a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="View_Category.php" target="mainFrame">Category</a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="View_Size.php" target="mainFrame">Info/Size</a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="View_Texture.php" target="mainFrame">Texture</a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="View_Color.php" target="mainFrame">Color</a></td>
      			</tr>
      			<tr>
        			<td class="InLineFieldCaptionTDNew"><a class="InLineDataLink" href="View_Material.php" target="mainFrame">Material</a></td>
      			</tr>
	  			<tr>
        			<td ><a class="InLineDataLink" href="../logout.php" target="_top">Logout</a> </td>
      			</tr>
    		</table>
			</form>
		</td>
  </tr>
</table>
</body>
</html>