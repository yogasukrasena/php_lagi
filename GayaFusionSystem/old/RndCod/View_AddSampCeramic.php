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
<SCRIPT LANGUAGE="JavaScript" src="calendar.js"></SCRIPT>
<title>ADD SAMPLE</title></head>
<link rel="stylesheet" type="text/css" href="../Includes/Style.css">
<body>
<?php
error_reporting(0);
$sid=$_GET['sid'];
//$sid=10;
//$query=;
$result = mysql_query("SELECT * FROM sampleceramic WHERE sID = $sid");
$alldata = mysql_fetch_array($result);
?>
<FORM name="test_form" action="edit.php" id="editform" >
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
    <td class="InLineDataTD" colspan="4"><input type="text" name="ClientDesc" value="<?php echo $alldata['ClientDescription']; ?>" size="50" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Date</td>
    <td class="InLineDataTD" colspan="4"><input type="text" name="DateField" value="<?php echo $alldata['SampleDate']; ?>" size="10" />&nbsp;<A HREF="javascript:void(0)" onClick="showCalendar(test_form.DateField,'yyyy-mm-dd','Choose date')"><img src="../images/DatePicker1.gif" width="17" height="15" border="0"/></A> </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Technical Draw </td>
    <td class="InLineDataTD" colspan="4"><input type="file" name="TechDraw" value="<?php echo $alldata['TechDraw']; ?>" />&nbsp;(600 x 750)</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Photo</td>
    <td class="InLineDataTD" colspan="4"><input type="file" name="Photo1" value="<?php echo $alldata['Photo1']; ?>" />&nbsp;(200 x 200)</td>
  </tr>
  <tr>
    <td class="InLineDataTD">&nbsp;</td>
    <td class="InLineDataTD" colspan="4"><input type="file" name="Photo2" value="<?php echo $alldata['Photo2']; ?>" />&nbsp;(200 x 200);</td>
  </tr>
  <tr>
    <td class="InLineDataTD">&nbsp;</td>
    <td class="InLineDataTD" colspan="4"><input type="file" name="Photo3" value="<?php echo $alldata['Photo3']; ?>" />&nbsp;(200 x 200)</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Sample of reference </td>
    <td class="InLineDataTD" colspan="4">Add</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="refnotes" cols="50" rows="5"><?php echo $alldata['ReferenceNote']; ?></textarea></td>
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
				echo "<a href=\"claypopup.html\">Add</a>";
			}
			else{
				echo "<input type=\"text\" name=\"clay\" value=\"$alldata[Clay]\" />";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InLineDataTD">KG</td>
    <td class="InLineDataTD" colspan="4"><input type="text" name="ClayKG" value="<?php echo $alldata['ClayKG']; ?>" size="50" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Build technique </td>
    <td class="InLineDataTD" colspan="4"><input type="text" name="buildtech" value="<?php echo $alldata['BuildTech']; ?>" size="50" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="buildtechnotes" cols="50" rows="5"><?php echo $alldata['BuildTechNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Rim</td>
    <td class="InLineDataTD" colspan="4"><input type="text" name="rim" <?php echo $alldata['Rim']; ?> size="50" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Feet</td>
    <td class="InLineDataTD" colspan="4"><input type="text" name="feet" value="<?php echo $alldata['Feet']; ?>" size="50" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Casting</td>
    <td class="InLineDataTD" width="17%">
		<?php 
			if (empty($alldata['Casting1'])){
				echo "<a href=\"castingpopup.html\">Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"casting1\" value=\"$alldata[Casting1]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD" width="17%">
	    <?php 
			if (empty($alldata['Casting2'])){
				echo "<a href=\"castingpopup.html\">Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"casting2\" value=\"$alldata[Casting2]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD" width="18%">
	    <?php 
			if (empty($alldata['Casting3'])){
				echo "<a href=\"castingpopup.html\">Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"casting3\" value=\"$alldata[Casting3]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD" width="34%">
    	<?php 
			if (empty($alldata['Casting4'])){
				echo "<a href=\"castingpopup.html\">Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"casting4\" value=\"$alldata[Casting4]\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="castingnotes" cols="50" rows="5"><?php echo $alldata['CastingNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Estruder</td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Estruder1'])){
				echo "<a href=\"estruderpopup.html\">Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Estruder1\" value=\"$alldata[Estruder1]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Estruder2'])){
				echo "<a href=\"estruderpopup.html\">Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Estruder2\" value=\"$alldata[Estruder2]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Estruder3'])){
				echo "<a href=\"estruderpopup.html\">Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Estruder3\" value=\"$alldata[Estruder3]\" />";
			}
		?>
     </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Estruder4'])){
				echo "<a href=\"estruderpopup.html\">Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Estruder4\" value=\"$alldata[Estruder4]\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="estrudernotes" cols="50" rows="5"><?php echo $alldata['EstruderNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Texture</td>
    <td class="InLineDataTD">
	    <?php 
			if (empty($alldata['Texture1'])){
				echo "<a href=\"texturepopup.html\">Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"texture1\" value=\"$alldata[Texture1]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Texture2'])){
				echo "<a href=\"texturepopup.html\">Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"texture2\" value=\"$alldata[Texture2]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Texture3'])){
				echo "<a href=\"texturepopup.html\">Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"texture3\" value=\"$alldata[Texture3]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Texture4'])){
				echo "<a href=\"texturepopup.html\">Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"texture4\" value=\"$alldata[Texture4]\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="texturenotes" cols="50" rows="5"><?php echo $alldata['TextureNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Tools</td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Tools1'])){
				echo "<a href=\"toolspopup.html\">Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"tools1\" value=\"$alldata[Tools1]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Tools2'])){
				echo "<a href=\"toolspopup.html\">Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"tools2\" value=\"$alldata[Tools2]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Tools3'])){
				echo "<a href=\"toolspopup.html\">Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"tools3\" value=\"$alldata[Tools3]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Tools4'])){
				echo "<a href=\"toolspopup.html\">Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"tools4\" value=\"$alldata[Tools4]\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="toolsnote" cols="50" rows="5"><?php echo $alldata['ToolsNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Engobe</td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Engobe1'])){
				echo "<a href=\"engobepopup.html\">Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"engobe1\" value=\"$alldata[Engobe1]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Engobe2'])){
				echo "<a href=\"engobepopup.html\">Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"engobe2\" value=\"$alldata[Engobe2]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Engobe3'])){
				echo "<a href=\"engobepopup.html\">Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"engobe3\" value=\"$alldata[Engobe3]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Engobe4'])){
				echo "<a href=\"engobepopup.html\">Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"engobe4\" value=\"$alldata[Engobe4]\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="engobenotes" cols="50" rows="5"><?php echo $alldata['EngobeNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Bisqure temp </td>
    <td class="InLineDataTD" colspan="4"><input class="InLineInput" type="radio" value="" name="bisquetemp" >None<input class="InLineInput" type="radio" value="960°" name="bisquetemp" >960°&nbsp;</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Stain &amp; Oxide </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['StainOxide1'])){
				echo "<a href=\"stainoxidepopup.html\">Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"stainoxide1\" value=\"$alldata[StainOxide1]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['StainOxide2'])){
				echo "<a href=\"stainoxidepopup.html\">Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"stainoxide2\" value=\"$alldata[StainOxide2]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['StainOxide3'])){
				echo "<a href=\"stainoxidepopup.html\">Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"stainoxide3\" value=\"$alldata[StainOxide3]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['StainOxide4'])){
				echo "<a href=\"stainoxidepopup.html\">Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"stainoxide4\" value=\"$alldata[StainOxide4]\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="stainoxidnotes" cols="50" rows="5"><?php echo $alldata['StainOxidenote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Glaze</td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Glaze1'])){
				echo "<a href=\"glazeepopup.html\">Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Glaze1\" value=\"$alldata[Glaze1]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Glaze2'])){
				echo "<a href=\"glazepopup.html\">Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Glaze2\" value=\"$alldata[Glaze2]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Glaze3'])){
				echo "<a href=\"glazepopup.html\">Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Glaze3\" value=\"$alldata[Glaze3]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['Glaze4'])){
				echo "<a href=\"glazepopup.html\">Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"Glaze4\" value=\"$alldata[Glaze4]\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Density</td>
    <td class="InLineDataTD"><input type="text" name="glazedensity1" value="<?php echo $alldata['GlazeDensity1']; ?>" size="15" /></td>
    <td class="InLineDataTD"><input type="text" name="glazedensity2" value="<?php echo $alldata['GlazeDensity2']; ?>" size="15" /></td>
    <td class="InLineDataTD"><input type="text" name="glazedensity3" value="<?php echo $alldata['GlazeDensity3']; ?>" size="15" /></td>
    <td class="InLineDataTD"><input type="text" name="glazedensity4" value="<?php echo $alldata['GlazeDensity4']; ?>" size="15" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="glazenotes" cols="50" rows="5"><?php echo $alldata['GlazeNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Glaze temp </td>
    <td class="InLineDataTD" colspan="4"><input type="text" name="glazetemp" value="<?php echo $alldata['GlazeTemp']; ?>" size="15" />
      &deg;</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Firing atmosphere </td>
    <td class="InLineDataTD" colspan="4"><input class="InLineInput" type="radio" value="Oxidation" name="firing" />Oxidation <input class="InLineInput" type="radio" value="Reduction" name="firing" />Reduction</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td><!-- untuk yg bagian radio & addlink nti program lagi -->
    <td class="InLineDataTD" colspan="4"><textarea name="firingnotes" cols="50" rows="5"></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Final size </td>
    <td class="InLineDataTD">Ø=<input type="text" name="diameter" value="<?php echo $alldata['Diameter']; ?>" size="15" /></td>
    <td class="InLineDataTD">W=<input type="text" name="weight" value="<?php echo $alldata['Weight']; ?>" size="15" /></td>
    <td class="InLineDataTD">L=<input type="text" name="lenght" value="<?php echo $alldata['Lenght']; ?>" size="15" /></td>
    <td class="InLineDataTD">H=<input type="text" name="height" value="<?php echo $alldata['Height']; ?>" size="12" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="finalsizenotes" cols="50" rows="5"><?php echo $alldata['FinalSizeNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Other material </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['OtherMat1'])){
				echo "<a href=\"OtherMatpopup.html\">Add 1</a>";
			}
			else{
				echo "<input type=\"text\" name=\"OtherMat1\" value=\"$alldata[OtherMat1]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['OtherMat2'])){
				echo "<a href=\"OtherMatpopup.html\">Add 2</a>";
			}
			else{
				echo "<input type=\"text\" name=\"OtherMat2\" value=\"$alldata[OtherMat2]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['OtherMat3'])){
				echo "<a href=\"OtherMatpopup.html\">Add 3</a>";
			}
			else{
				echo "<input type=\"text\" name=\"OtherMat3\" value=\"$alldata[OtherMat3]\" />";
			}
		?>
    </td>
    <td class="InLineDataTD">
    	<?php 
			if (empty($alldata['OtherMat4'])){
				echo "<a href=\"OtherMatpopup.html\">Add 4</a>";
			}
			else{
				echo "<input type=\"text\" name=\"OtherMat4\" value=\"$alldata[OtherMat4]\" />";
			}
		?>
    </td>
  </tr>
  <tr>
    <td class="InLineDataTD">Quantity</td>
    <td class="InLineDataTD"><input type="text" name="qty1" value="<?php echo $alldata['OtherMatQty1']; ?>" size="15" /></td>
<td class="InLineDataTD"><input type="text" name="qty2" value="<?php echo $alldata['OtherMatQty2']; ?>" size="15" /></td>
    <td class="InLineDataTD"><input type="text" name="qty3" value="<?php echo $alldata['OtherMatQty3']; ?>" size="15" /></td>
    <td class="InLineDataTD"><input type="text" name="qty4" value="<?php echo $alldata['OtherMatQty4']; ?>" size="15" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Notes</td>
    <td class="InLineDataTD" colspan="4"><textarea name="othermaterialnotes" cols="50" rows="5"><?php echo $alldata['OtherMatNote']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">History</td>
    <td class="InLineDataTD" colspan="4"><textarea name="history" cols="50" rows="5"><?php echo $alldata['History']; ?></textarea></td>
  </tr>
    <tr>
    <td class="InLineFooterTD" colspan="5" align="center"><input type="hidden" name="tabel" value="sampleceramic"><input type="hidden" value="<?php echo $alldata['sID']; ?>" name="sID"><input type="submit" name="submit" value="SUBMIT" size="30" />&nbsp;
					<a href="javascript:history.back();"><input type="reset" name="cancel" value="CANCEL" size="30" /></a>
	</td>
  </tr>
</table>
</form>
</body>
</html>
