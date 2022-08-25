<?php	
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>

<html>
<head>
<SCRIPT LANGUAGE="JavaScript" src="calendar.js"></SCRIPT>
<title>ADD SAMPLE</title></head>
<link rel="stylesheet" type="text/css" href="../Includes/Style.css">
<body>
<script language="JavaScript">
var Nav4 = ((navigator.appName == "Netscape") && (parseInt(navigator.appVersion) == 4))

var dialogWin = new Object()

function openDialog(url, width, height, returnFunc, args) {
	if (!dialogWin.win || (dialogWin.win && dialogWin.win.closed)) {
		dialogWin.returnFunc = returnFunc
		dialogWin.returnedValue_c_col_id = ""
		dialogWin.args = args
		dialogWin.url = url
		dialogWin.width = width
		dialogWin.height = height
		dialogWin.name = (new Date()).getSeconds().toString()

		if (Nav4) {
			dialogWin.left = window.screenX + 
			   ((window.outerWidth - dialogWin.width) / 2)
			dialogWin.top = window.screenY + 
			   ((window.outerHeight - dialogWin.height) / 2)
			var attr = "screenX=" + dialogWin.left + 
			   ",screenY=" + dialogWin.top + ",resizable=no,width=" + 
			   dialogWin.width + ",height=" + dialogWin.height
		} else {
			dialogWin.left = (screen.width - dialogWin.width) / 2
			dialogWin.top = (screen.height - dialogWin.height) / 2
			var attr = "left=" + dialogWin.left + ",top=" + 
			   dialogWin.top + ",resizable=no,width=" + dialogWin.width + 
			   ",height=" + dialogWin.height
		}
		
		dialogWin.win=window.open(dialogWin.url, dialogWin.name, attr)
		dialogWin.win.focus()
	} else {
		dialogWin.win.focus()
	}
}
</script>
<script language="javascript">
	function kali(bil1, bil2)
	
</script>
  <table width="765" border="0" cellpadding="3" cellspacing="0">
    <tr>
      <td width="74%" height="39" class="TopContentTitle">RESEARCH &amp; DEVELOPMENT</td>
      <td width="26%" height="39" align="center" class="TopContentTitleRight">Sample Ceramic</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
	<tr>
      <td colspan="2"><p>&nbsp;</p>
		<?php
			error_reporting(0);
			$sid=$_GET['sid'];
			$result = mysql_query("SELECT * FROM sampleceramic WHERE sID = $sid");
			$alldata = mysql_fetch_array($result);
		?>
		<FORM enctype="multipart/form-data" name="SampCeramicForm" method="POST" action="editsampceramic.php" >
			<table class="InLineFormTABLE" width="850" border="0" cellspacing="0" cellpadding="3">
  				<tr>
    				<td class="InLineDataTD" width="14%">Code</td>
    				<td class="InLineDataTD" colspan="4"><?php echo $alldata['SampleCode'] ?></td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Description</td>
    				<td class="InLineDataTD" colspan="4"><?php echo $alldata['Description'] ?></td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Client Code </td>
    				<td class="InLineDataTD" colspan="4"><input type="text" name="ClientCode" value="<?php echo $alldata['ClientCode']; ?>" size="30" /></td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Client Description </td>
    				<td class="InLineDataTD" colspan="4"><input type="text" name="ClientDescription" value="<?php echo $alldata['ClientDescription']; ?>" size="50" /></td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Date</td>
    				<td class="InLineDataTD" colspan="4"><input type="text" name="DateField" value="<?php echo $alldata['SampleDate']; ?>" size="10" />&nbsp;<A HREF="javascript:void(0)" onClick="showCalendar(SampCeramicForm.DateField,'yyyy-mm-dd','Choose date')"><img src="../images/DatePicker1.gif" width="17" height="15" border="0"/></A> </td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Technical Draw </td>
    				<td class="InLineDataTD" colspan="4">
						<?php 
							if (empty($alldata['TechDraw'])){
								echo "<input type=\"file\" name=\"TechDraw\" value=\"\" />&nbsp;(600 x 750)";
							}
							else{
								echo substr($alldata['TechDraw'],15).".";
								echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelTechDraw\" value=\"$alldata[TechDraw]\" /> ";
							}
						?>
					</td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Photo</td>
    				<td class="InLineDataTD" colspan="4">
						<?php 
							if (empty($alldata['Photo1'])){
				echo "<input type=\"file\" name=\"Photo1\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['Photo1'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto1\" value=\"$alldata[Photo1]\" /> ";
			}
		?>	
	</td>
  </tr>
  <tr>
    <td class="InLineDataTD">&nbsp;</td>
    <td class="InLineDataTD" colspan="4">
		<?php 
			if (empty($alldata['Photo2'])){
				echo "<input type=\"file\" name=\"Photo2\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['Photo2'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto2\" value=\"$alldata[Photo2]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InLineDataTD">&nbsp;</td>
    <td class="InLineDataTD" colspan="4">
		<?php 
			if (empty($alldata['Photo3'])){
				echo "<input type=\"file\" name=\"Photo3\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['Photo3'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto3\" value=\"$alldata[Photo3]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Sample of reference </td>
    <td class="InLineDataTD" colspan="4"><input type="text" name="Reference" value="">Add</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="RefNotes" cols="50" rows="5"><?php echo $alldata['ReferenceNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD"><strong>TECHICAL NOTES </strong></td>
    <td class="InLineDataTD" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Clay</td>
    <td class="InLineDataTD" colspan="4">
		<?php 
			if (empty($alldata['Clay'])){
				echo "<input type=\"text\" name=\"Clay\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('ClayPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Clay\" value=\"$alldata[Clay]\" size=\"10\" />";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InLineDataTD">KG</td>
    <td class="InLineDataTD" colspan="4"><input type="text" name="ClayKG" value="<?php echo $alldata['ClayKG']; ?>" size="10" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Build technique </td>
    <td class="InLineDataTD" colspan="4"><input type="text" name="BuildTech" value="<?php echo $alldata['BuildTech']; ?>" size="50" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="BuildTechNotes" cols="50" rows="5"><?php echo $alldata['BuildTechNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Rim</td>
    <td class="InLineDataTD" colspan="4"><input type="text" name="Rim" value="<?php echo $alldata['Rim']; ?>" size="50" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Feet</td>
    <td class="InLineDataTD" colspan="4"><input type="text" name="Feet" value="<?php echo $alldata['Feet']; ?>" size="10" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Casting</td>
    <td class="InLineDataTD" width="17%">
		<?php 
			if (empty($alldata['Casting1'])){
				echo "<input type=\"hidden\" name=\"Casting\" value=\"Casting1\" /><input type=\"text\" name=\"Casting1\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('CastingPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Casting1\" value=\"$alldata[Casting1]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD" width="17%">
	    <?php 
			if (empty($alldata['Casting2'])){
				echo "<input type=\"hidden\" name=\"Casting\" value=\"Casting1\" /><input type=\"text\" name=\"Casting2\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('CastingPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Casting2\" value=\"$alldata[Casting2]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD" width="18%">
	    <?php 
			if (empty($alldata['Casting3'])){
				echo "<input type=\"text\" name=\"Casting3\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('CastingPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Casting3\" value=\"$alldata[Casting3]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD" width="34%">
    	<?php 
			if (empty($alldata['Casting4'])){
				echo "<input type=\"text\" name=\"Casting4\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('CastingPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Casting4\" value=\"$alldata[Casting4]\" size=\"10\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="CastingNotes" cols="50" rows="5"><?php echo $alldata['CastingNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Estruder</td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Estruder1'])){
				echo "<input type=\"text\" name=\"Estruder1\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('EstruderPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Estruder1\" value=\"$alldata[Estruder1]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Estruder2'])){
				echo "<input type=\"text\" name=\"Estruder2\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('EstruderPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Estruder2\" value=\"$alldata[Estruder2]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Estruder3'])){
				echo "<input type=\"text\" name=\"Estruder3\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('EstruderPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Estruder3\" value=\"$alldata[Estruder3]\" sizw=\"10\" />";
			}
		?>
     </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Estruder4'])){
				echo "<input type=\"text\" name=\"Estruder4\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('EstruderPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Estruder4\" value=\"$alldata[Estruder4]\" size=\"10\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="EstruderNotes" cols="50" rows="5"><?php echo $alldata['EstruderNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Texture</td>
    <td class="InLineDataTD">
	    <?php 
			if (empty($alldata['Texture1'])){
				echo "<input type=\"text\" name=\"Texture1\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('TexturePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Texture1\" value=\"$alldata[Texture1]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Texture2'])){
				echo "<input type=\"text\" name=\"Texture2\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('TexturePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Texture2\" value=\"$alldata[Texture2]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Texture3'])){
				echo "<input type=\"text\" name=\"Texture3\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('TexturePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Texture3\" value=\"$alldata[Texture3]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Texture4'])){
				echo "<input type=\"text\" name=\"Texture4\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('TexturePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Texture4\" value=\"$alldata[Texture4]\" size=\"10\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="TextureNotes" cols="50" rows="5"><?php echo $alldata['TextureNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Tools</td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Tools1'])){
				echo "<input type=\"text\" name=\"Tools1\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('ToolsPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Tools1\" value=\"$alldata[Tools1]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Tools2'])){
				echo "<input type=\"text\" name=\"Tools2\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('ToolsPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Tools2\" value=\"$alldata[Tools2]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Tools3'])){
				echo "<input type=\"text\" name=\"Tools3\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('ToolsPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Tools3\" value=\"$alldata[Tools3]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Tools4'])){
				echo "<input type=\"text\" name=\"Tools4\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('ToolsPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Tools4\" value=\"$alldata[Tools4]\" size=\"10\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="ToolsNotes" cols="50" rows="5"><?php echo $alldata['ToolsNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Engobe</td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Engobe1'])){
				echo "<input type=\"text\" name=\"Engobe1\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('EngobePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Engobe1\" value=\"$alldata[Engobe1]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Engobe2'])){
				echo "<input type=\"text\" name=\"Engobe2\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('EngobePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Engobe2\" value=\"$alldata[Engobe2]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Engobe3'])){
				echo "<input type=\"text\" name=\"Engobe3\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('EngobePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Engobe3\" value=\"$alldata[Engobe3]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Engobe4'])){
				echo "<input type=\"text\" name=\"Engobe4\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('EngobePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Engobe4\" value=\"$alldata[Engobe4]\" size=\"10\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="EngobeNotes" cols="50" rows="5"><?php echo $alldata['EngobeNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Bisque Temp </td>
    <td class="InLineDataTD" colspan="4">
		<?php
			If (empty($alldata['BisqueTemp'])) {
				echo "<input class=\"InLineInput\" type=\"radio\" value=\"\" name=\"BisqueTemp\" checked >None<input class=\"InLineInput\" type=\"radio\" value=\"960°\" name=\"BisqueTemp\" >960°&nbsp;";
			}else{
				echo "<input class=\"InLineInput\" type=\"radio\" value=\"\" name=\"BisqueTemp\">None<input class=\"InLineInput\" type=\"radio\" value=\"960°\" name=\"BisqueTemp\" checked >960°&nbsp;";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Stain &amp; Oxide </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['StainOxide1'])){
				echo "<input type=\"text\" name=\"StainOxide1\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('StainOxidePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"StainOxide1\" value=\"$alldata[StainOxide1]\" size=\"10\"/>";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['StainOxide2'])){
				echo "<input type=\"text\" name=\"StainOxide2\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('StainOxidePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"StainOxide2\" value=\"$alldata[StainOxide2]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['StainOxide3'])){
				echo "<input type=\"text\" name=\"StainOxide3\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('StainOxidePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"StainOxide3\" value=\"$alldata[StainOxide3]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['StainOxide4'])){
				echo "<input type=\"text\" name=\"StainOxide4\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('StainOxidePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"StainOxide4\" value=\"$alldata[StainOxide4]\" size=\"10\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="StainOxideNotes" cols="50" rows="5"><?php echo $alldata['StainOxideNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Glaze</td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Glaze1'])){
				echo "<input type=\"text\" name=\"Glaze1\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('GlazePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Glaze1\" value=\"$alldata[Glaze1]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Glaze2'])){
				echo "<input type=\"text\" name=\"Glaze2\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('GlazePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Glaze2\" value=\"$alldata[Glaze2]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Glaze3'])){
				echo "<input type=\"text\" name=\"Glaze3\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('GlazePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Glaze3\" value=\"$alldata[Glaze3]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Glaze4'])){
				echo "<input type=\"text\" name=\"Glaze4\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('GlazePopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Glaze4\" value=\"$alldata[Glaze4]\" size=\"10\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Density</td>
    <td class="InLineDataTD"><input type="text" name="GlazeDensity1" value="<?php echo $alldata['GlazeDensity1']; ?>" size="15" /></td>
    <td class="InLineDataTD"><input type="text" name="GlazeDensity2" value="<?php echo $alldata['GlazeDensity2']; ?>" size="15" /></td>
    <td class="InLineDataTD"><input type="text" name="GlazeDensity3" value="<?php echo $alldata['GlazeDensity3']; ?>" size="15" /></td>
    <td class="InLineDataTD"><input type="text" name="GlazeDensity4" value="<?php echo $alldata['GlazeDensity4']; ?>" size="15" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="GlazeNotes" cols="50" rows="5"><?php echo $alldata['GlazeNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD"> temp </td>
    <td class="InLineDataTD" colspan="4"><input type="text" name="GlazeTemp" value="<?php echo $alldata['GlazeTemp']; ?>" size="15" />
      &deg;</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Firing atmosphere </td>
    <td class="InLineDataTD" colspan="4">
    	<?php
			If ($alldata['Firing']=="Oxidation") {
				echo "<input class=\"InLineInput\" type=\"radio\" value=\"Oxidation\" name=\"Firing\" checked >Oxidation<input class=\"InLineInput\" type=\"radio\" value=\"Reduction\" name=\"Firing\" >Reduction&nbsp;";
			}elseif ($alldata['Firing']=="Reduction"){
				echo "<input class=\"InLineInput\" type=\"radio\" value=\"Oxidation\" name=\"Firing\">Oxidation<input class=\"InLineInput\" type=\"radio\" value=\"Reduction\" name=\"Firing\" checked >Reduction&nbsp;";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td><!-- untuk yg bagian radio & addlink nti program lagi -->
    <td class="InLineDataTD" colspan="4"><textarea name="FiringNotes" cols="50" rows="5"><?php echo $alldata['FiringNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Final size </td>
    <td class="InLineDataTD">Ø=<input type="text" name="Diameter" value="<?php echo $alldata['Diameter']; ?>" size="15" /></td>
    <td class="InLineDataTD">W=<input type="text" name="Weight" value="<?php echo $alldata['Weight']; ?>" size="15" /></td>
    <td class="InLineDataTD">L=<input type="text" name="Length" value="<?php echo $alldata['Length']; ?>" size="15" /></td>
    <td class="InLineDataTD">H=<input type="text" name="Height" value="<?php echo $alldata['Height']; ?>" size="12" />
							<input type="hidden" name="SampleCeramicVolume" value="" />
	</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="FinalSizeNotes" cols="50" rows="5"><?php echo $alldata['FinalSizeNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Other material </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['OtherMat1'])){
				echo "<input type=\"text\" name=\"OtherMat1\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('OtherMatPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"OtherMat1\" value=\"$alldata[OtherMat1]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['OtherMat2'])){
				echo "<input type=\"text\" name=\"OtherMat2\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('OtherMatPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"OtherMat2\" value=\"$alldata[OtherMat2]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['OtherMat3'])){
				echo "<input type=\"text\" name=\"OtherMat3\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('OtherMatPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"OtherMat3\" value=\"$alldata[OtherMat3]\" size=\"10\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['OtherMat4'])){
				echo "<input type=\"text\" name=\"OtherMat4\" size=\"10\" /><a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('OtherMatPopup.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">&nbsp;Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"OtherMat4\" value=\"$alldata[OtherMat4]\" size=\"10\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Quantity</td>
    <td class="InLineDataTD"><input type="text" name="OtherMatQty1" value="<?php echo $alldata['OtherMatQty1']; ?>" size="15" /></td>
<td class="InLineDataTD"><input type="text" name="OtherMatQty2" value="<?php echo $alldata['OtherMatQty2']; ?>" size="15" /></td>
    <td class="InLineDataTD"><input type="text" name="OtherMatQty3" value="<?php echo $alldata['OtherMatQty3']; ?>" size="15" /></td>
    <td class="InLineDataTD"><input type="text" name="OtherMatQty4" value="<?php echo $alldata['OtherMatQty4']; ?>" size="15" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="OtherMatNotes" cols="50" rows="5"><?php echo $alldata['OtherMatNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">History</td>
    <td class="InLineDataTD" colspan="4"><textarea name="History" cols="50" rows="5"><?php echo $alldata['History']; ?></textarea></td>
  </tr>
    <tr>
    <td class="InLineFooterTD" colspan="5" align="center"><input type="hidden" name="tabel" value="sampleceramic"><input type="hidden" value="<?php echo $alldata['sID']; ?>" name="sID"><input type="submit" name="submit" value="SUBMIT" size="30" />&nbsp;
					<a href="javascript:history.back();"><input type="reset" name="cancel" value="CANCEL" size="30" /></a>
	</td>
  </tr>
</table>
</form></td>
</tr>
</table>
</body>
</html>
