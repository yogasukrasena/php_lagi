<?php	
session_start();
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
function money_form($money)
{
	return str_replace(",", "." , number_format($money));
	return str_replace(".", "," , number_format($money));
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
function testnumber(x,y){
	var xnumber = isNaN(x);
	var ynumber = isNaN(y);	
	if (xnumber){
		alert("Sorry! Not a number")
		exit;
	}
	else{
		var result = x * y
		return result
	}
}
</script>
  <table width="765" border="0" cellpadding="3" cellspacing="0">
    <tr>
		<td width="74%" height="39" class="TopContentTitle">RESEARCH &amp; DEVELOPMENT</td>
      	<td width="26%" height="39" align="center" class="TopContentTitleRight">Sample Other </td>
    </tr>
    <tr>
      	<td colspan="2">&nbsp;</td>
    </tr>
	<tr>
      	<td colspan="2"><p>&nbsp;</p>
		<?php
			error_reporting(0);
			$id=$_GET['id'];
			$DesMat1 = $_GET['DesMat1'];
			$DesMat2 = $_GET['DesMat2'];
			$DesMat3 = $_GET['DesMat3'];
			$DesMat4 = $_GET['DesMat4'];
			$DesMat5 = $_GET['DesMat5'];
			$result = mysql_query("SELECT * FROM SampleOther WHERE ID = $id");
			$ResultDm1 = mysql_query("SELECT * FROM tblDesMaterial WHERE DmCode = '$DesMat1'");
			$ResultDm2 = mysql_query("SELECT * FROM tblDesMaterial WHERE DmCode = '$DesMat2'");
			$ResultDm3 = mysql_query("SELECT * FROM tblDesMaterial WHERE DmCode = '$DesMat3'");
			$ResultDm4 = mysql_query("SELECT * FROM tblDesMaterial WHERE DmCode = '$DesMat4'");
			$ResultDm5 = mysql_query("SELECT * FROM tblDesMaterial WHERE DmCode = '$DesMat5'");
			$alldata = mysql_fetch_array($result);
			$alldata1 = mysql_fetch_array($ResultDm1);
			$alldata2 = mysql_fetch_array($ResultDm2);			
			$alldata3 = mysql_fetch_array($ResultDm3);
			$alldata4 = mysql_fetch_array($ResultDm4);
			$alldata5 = mysql_fetch_array($ResultDm5);
		?>
		<FORM enctype="multipart/form-data" name="SampPackagingForm" method="POST" action="EditSampOther.php" >
			<table class="InLineFormTABLE" width="850" border="0" cellspacing="0" cellpadding="3">
  				<tr>
    				<td class="InLineDataTD" width="127">Code</td>
    				<td class="InLineDataTD" colspan="5"><input type="text" name="Code" value="<?php echo $alldata['SampleCode'] ?>"/></td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Description</td>
    				<td class="InLineDataTD" colspan="5"><input type="text" name="Description" value="<?php echo $alldata['Description'] ?>" /></td>
  				</tr>
  				<tr>
  				<tr>
    				<td class="InLineDataTD">Date</td>
    				<td class="InLineDataTD" colspan="5"><input type="text" name="DateField" value="<?php echo $alldata['SampleDate']; ?>" size="10" />&nbsp;<A HREF="javascript:void(0)" onClick="showCalendar(SampPackagingForm.DateField,'yyyy-mm-dd','Choose date')"><img src="../images/DatePicker1.gif" width="17" height="15" border="0"/></A> </td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Technical Draw </td>
    				<td class="InLineDataTD" colspan="5">
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
    				<td class="InLineDataTD">Photo 01 </td>
    				<td class="InLineDataTD" colspan="5">
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
    				<td class="InLineDataTD">Photo 02 </td>
    				<td class="InLineDataTD" colspan="5">
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
    				<td class="InLineDataTD">Photo 03 </td>
    				<td class="InLineDataTD" colspan="5">
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
    				<td class="InLineDataTD">Photo 04 </td>
    				<td class="InLineDataTD" colspan="5">
						<?php 
							if (empty($alldata['Photo4'])){
								echo "<input type=\"file\" name=\"Photo4\" value=\"\" />&nbsp;(200 x 200)";
							}
							else{
								echo substr($alldata['Photo4'],15).".";
								echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto4\" value=\"$alldata[Photo4]\" /> ";
							}
						?>
					</td>
  				</tr>
  				<tr><!-- disini, suda pake inner join dengan tbldesmat -->
    				<td class="InLineDataTD" colspan="6"><strong>List of Design Material </strong></td>
  				</tr>
  				<tr>
  					<td class="InLineDataTD" colspan="6">
						<table width="850" border="0" cellpadding="0" cellspacing="0">
							<tr>
    							<th class="InLineDataTD" width="187" align="center">Design Material </th>
    							<th class="InLineDataTD" width="187" align="center">Supplier</th>
    							<th class="InLineDataTD" width="110" align="center">Qty</th>
    							<th class="InLineDataTD" width="110" align="center">Unit</th>
    							<th class="InLineDataTD" width="110" align="center">Unit Price </th>
    							<th class="InLineDataTD" width="110" align="center">Total</th>
  							</tr>
  							<tr>
    							<td class="InLineDataTD">
									<input readonly="yes" type="text" name="DesMat1" value="<?php echo $alldata['DesMat1']?>" />									
									<?php
    									If (empty($alldata['DesMat1'])){
    										//echo "<a href=\"DesignMatPopupPack1.php\">Add";
											echo "<a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('DesignMatPopupPack1.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">Add</a>";
    									}
										else{
											echo "&nbsp; Del <input type=\"checkbox\" name=\"DelDesMat1\" value=\"$alldata[DesMat1]\" /> ";
										}
    								?>
								</td>
    							<td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatSup1" value="<?php echo $alldata1['DmSupplier'] ?>"  /></td>
    							<td class="InLineDataTD" align="center"><input type="text" name="QtyDesMat1"  onKeyUp="SampPackagingForm.TotalDesMat1.value = testnumber(SampPackagingForm.QtyDesMat1.value,SampPackagingForm.DesMatUnitPrice1.value)" value="<?php echo $alldata['QtyDesMat1']?>" size="15" /></td>
    							<td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatUnit1" value="<?php echo $alldata1['DmUnit']?>" size="10" /></td>
   							  <td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatUnitPrice1" value="<?php echo $alldata1['DmUnitPrice'] ?>" size="10" /></td>
   							  <td class="InLineDataTD" align="center"><input align="right" type="text" readonly="yes" name="TotalDesMat1" value="<?php echo $alldata['TotalDesMat1'] ?>" size="10" /></td>
  							</tr>
  							<tr>
    							<td class="InLineDataTD">
									<input readonly="yes" type="text" name="DesMat2" value="<?php echo $alldata['DesMat2']?>" />									
									<?php
    									If (empty($alldata['DesMat2'])){
    										echo "<a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('DesignMatPopupPack2.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">Add</a>";
    									}
										else{
											echo "&nbsp; Del <input type=\"checkbox\" name=\"DelDesMat2\" value=\"$alldata[DesMat2]\" /> ";
										}
    								?>
								</td>
    							<td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatSup2" value="<?php echo $alldata2['DmSupplier'] ?>"  /></td>
    							<td class="InLineDataTD" align="center"><input type="text" name="QtyDesMat2" onKeyUp="SampPackagingForm.TotalDesMat2.value = testnumber(SampPackagingForm.QtyDesMat2.value,SampPackagingForm.DesMatUnitPrice2.value)" value="<?php echo $alldata['QtyDesMat2']?>" size="15" /></td>
    							<td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatUnit2" value="<?php echo $alldata2['DmUnit']?>" size="10" /></td>
   							  <td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatUnitPrice2" value="<?php echo $alldata2['DmUnitPrice'] ?>" size="10" /></td>
   							  <td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="TotalDesMat2" value="<?php echo $alldata['TotalDesMat2'] ?>" size="10" /></td>
  							</tr>
		  					<tr>
   							  <td class="InLineDataTD">
									<input readonly="yes" type="text" name="DesMat3" value="<?php echo $alldata['DesMat3']?>" />								
									<?php
    									If (empty($alldata['DesMat3'])){
    										echo "<a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('DesignMatPopupPack3.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">Add</a>";
    									}
										else{
											echo "&nbsp; Del <input type=\"checkbox\" name=\"DelDesMat3\" value=\"$alldata[DesMat3]\" /> ";
										}
    								?>
								</td>
    							<td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatSup3" value="<?php echo $alldata3['DmSupplier'] ?>"  /></td>
    							<td class="InLineDataTD" align="center"><input type="text" name="QtyDesMat3" onKeyUp="SampPackagingForm.TotalDesMat3.value = testnumber(SampPackagingForm.QtyDesMat3.value,SampPackagingForm.DesMatUnitPrice3.value)" value="<?php echo $alldata['QtyDesMat3']?>" size="15" /></td>
    							<td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatUnit3" value="<?php echo $alldata3['DmUnit']?>" size="10" /></td>
   							  <td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatUnitPrice3" value="<?php echo $alldata3['DmUnitPrice'] ?>" size="10" /></td>
   							  <td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="TotalDesMat3" value="<?php echo $alldata['TotalDesMat3'] ?>" size="10" /></td>
  							</tr>
  							<tr>
    							<td class="InLineDataTD">
									<input readonly="yes" type="text" name="DesMat4" value="<?php echo $alldata['DesMat4']?>" />									
									<?php
    									If (empty($alldata['DesMat4'])){
    										echo "<a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('DesignMatPopupPack4.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">Add</a>";
    									}
										else{
											echo "&nbsp; Del <input type=\"checkbox\" name=\"DelDesMat4\" value=\"$alldata[DesMat4]\" /> ";
										}
    								?>
								</td>
    							<td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatSup4" value="<?php echo $alldata4['DmSupplier'] ?>"  /></td>
    							<td class="InLineDataTD" align="center"><input type="text" name="QtyDesMat4" onKeyUp="SampPackagingForm.TotalDesMat4.value = testnumber(SampPackagingForm.QtyDesMat4.value,SampPackagingForm.DesMatUnitPrice4.value)" value="<?php echo $alldata['QtyDesMat4']?>" size="15" /></td>
    							<td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatUnit4" value="<?php echo $alldata4['DmUnit']?>" size="10" /></td>
   							  <td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatUnitPrice4" value="<?php echo $alldata4['DmUnitPrice'] ?>" size="10" /></td>
   							  <td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="TotalDesMat4" value="<?php echo $alldata['TotalDesMat4'] ?>" size="10" /></td>
  							</tr>
    						<tr>
    							<td class="InLineDataTD">
									<input readonly="yes" type="text" name="DesMat5" value="<?php echo $alldata['DesMat5']?>" />
									<?php
    									If (empty($alldata['DesMat5'])){
    										echo "<a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('DesignMatPopupPack5.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">Add</a>";
    									}
										else{
											echo "&nbsp; Del <input type=\"checkbox\" name=\"DelDesMat5\" value=\"$alldata[DesMat5]\" /> ";
										}
    								?>
								</td>
    							<td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatSup5" value="<?php echo $alldata5['DmSupplier'] ?>"  /></td>
    							<td class="InLineDataTD" align="center"><input type="text" name="QtyDesMat5" onKeyUp="SampPackagingForm.TotalDesMat5.value = testnumber(SampPackagingForm.QtyDesMat5.value,SampPackagingForm.DesMatUnitPrice5.value)" value="<?php echo $alldata['QtyDesMat5']?>" size="15" /></td>
    							<td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatUnit5" value="<?php echo $alldata5['DmUnit']?>" size="10" /></td>
   							  <td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="DesMatUnitPrice5" value="<?php echo $alldata5['DmUnitPrice'] ?>" size="10" /></td>
   							  <td class="InLineDataTD" align="center"><input type="text" readonly="yes" name="TotalDesMat5" value="<?php echo $alldata['TotalDesMat5'] ?>" size="10" /></td>
  							</tr>
							<tr>
    							<td colspan="5" class="InLineDataTD" align="right"><b>Total Design Material</b></td>
    							<td class="InLineDataTD" width="110" align="center"><?php echo money_form($alldata['TotalDesMat']) ?></td>
  							</tr>
						</table>
					</td>
  				<tr>
    				<td class="InLineDataTD" colspan="6"><strong>List of Work Supplier </strong></td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD" colspan="6">
						<table width="850" border="0" cellpadding="1" cellspacing="0">
							<tr>
								<th class="InLineDataTD" width="194" align="left">Supplier</th>
    							<th class="InLineDataTD" colspan="2" align="center">Material</th>
    							<th class="InLineDataTD" colspan="2" align="center">Color</th>
    							<th class="InLineDataTD" width="185" align="center">Cost Price </th>
							</tr>
							<tr>
    							<td class="InLineDataTD">
    								<input type="text" readonly="yes" name="Supplier1" value="<?php echo $alldata['Supplier1']?>" />
							  		<?php
    									If (empty($alldata['Supplier1'])){
											echo "<a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('SupplierPopupPack1.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">Add</a>";
    									}
										else{
											echo "&nbsp; Del <input type=\"checkbox\" name=\"DelSupplier1\" value=\"$alldata[Supplier1]\" /> ";
										}
    								?>
							  </td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Material1" value="<?php echo $alldata['Material1'] ?>" /></td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Color1" value="<?php echo $alldata['Color1']?>" /></td>
   							  <td align="center" class="InLineDataTD"><input name="CostPrice1" value="<?php echo $alldata['CostPrice1']?>" /></td>
  							</tr>
  							<tr>
    							<td class="InLineDataTD">
    								<input type="text" readonly="yes" name="Supplier2" value="<?php echo $alldata['Supplier2']?>" />
							  		<?php
    									If (empty($alldata['Supplier2'])){
    										echo "<a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('SupplierPopupPack2.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">Add</a>";
    									}
										else{
											echo "&nbsp; Del <input type=\"checkbox\" name=\"DelSupplier2\" value=\"$alldata[Supplier2]\" /> ";
										}
    								?>
							  </td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Material2" value="<?php echo $alldata['Material2'] ?>"/></td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Color2" value="<?php echo $alldata['Color2']?>" /></td>
   							  <td align="center" class="InLineDataTD"><input name="CostPrice2" value="<?php echo $alldata['CostPrice2']?>" /></td>
  							</tr>
  							<tr>
    							<td class="InLineDataTD">
    								<input type="text" readonly="yes" name="Supplier3" value="<?php echo $alldata['Supplier3']?>" />
							  		<?php
    									If (empty($alldata['Supplier3'])){
    										echo "<a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('SupplierPopupPack3.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">Add</a>";
    									}
										else{
											echo "&nbsp; Del <input type=\"checkbox\" name=\"DelSupplier3\" value=\"$alldata[Supplier3]\" /> ";
										}
    								?>
							  </td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Material3" value="<?php echo $alldata['Material3'] ?>"/></td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Color3" value="<?php echo $alldata['Color3']?>" /></td>
   							  <td align="center" class="InLineDataTD"><input name="CostPrice3" value="<?php echo $alldata['CostPrice3']?>" /></td>
  							</tr>
  							<tr>
    							<td class="InLineDataTD">
    								<input type="text" readonly="yes" name="Supplier4" value="<?php echo $alldata['Supplier4']?>" />									
							  		<?php
    									If (empty($alldata['Supplier4'])){
    										echo "<a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('SupplierPopupPack4.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">Add</a>";
    									}
										else{
											echo "&nbsp; Del <input type=\"checkbox\" name=\"DelSupplier4\" value=\"$alldata[Supplier3]\" /> ";
										}
    								?>
							  </td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Material4" value="<?php echo $alldata['Material4'] ?>" /></td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Color4" value="<?php echo $alldata['Color4']?>" /></td>
   							  <td align="center" class="InLineDataTD"><input name="CostPrice4" value="<?php echo $alldata['CostPrice4']?>" /></td>
  							</tr>
  							<tr>
    							<td >
    								<input type="text" readonly="yes" name="Supplier5" value="<?php echo $alldata['Supplier5']?>" />									
							  		<?php
    									If (empty($alldata['Supplier5'])){
    										echo "<a onmouseover=\"status='Search Record...';return true\" onclick=\"openDialog('SupplierPopupPack5.php', 500,420);return false\" onmouseout=\"status='';return true\" href=\"#\">Add</a>";
    									}
										else{
											echo "&nbsp; Del <input type=\"checkbox\" name=\"DelSupplier5\" value=\"$alldata[Supplier5]\" /> ";
										}
    								?>
							  </td>
    							<td colspan="2" align="center"><input name="Material5" value="<?php echo $alldata['Material5'] ?>" /></td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Color5" value="<?php echo $alldata['Color5']?>" /></td>
    							<td align="center" class="InLineDataTD"><input name="CostPrice5" value="<?php echo $alldata['CostPrice5']?>" /></td>
  							</tr>
							<tr>
								<td colspan="5" class="InLineDataTD" align="right"><b>Total Supplier Cost</b></td>
    							<td class="InLineDataTD" width="185" align="center"><?php echo money_form($alldata['TotalCostPrice']) ?></td>
							</tr>
						</table>
					</td>
  				</tr>
				<tr>
    				<td class="InLineDataTD">Total Cost </td>
    				<td class="InLineDataTD" colspan="4"><?php echo money_form($alldata['TotalCost']); ?></td>
 	 			<tr>
  				<tr>
    				<td class="InLineDataTD">Final size </td>
    				<td width="175" class="InLineDataTD">
						Ø=<input type="text" name="Diameter" onKeyPress="SampPackagingForm.Width.value = '0';SampPackagingForm.Length.value = '0';" value="<?php echo $alldata['Diameter']; ?>" size="15" />
					</td>
    				<td width="177" class="InLineDataTD">
						W=<input type="text" name="Width" onKeyPress="SampPackagingForm.Diameter.value='0'" value="<?php echo $alldata['Width']; ?>" size="15" />
					</td>
    				<td width="164" class="InLineDataTD">
						L=<input type="text" name="Length" onKeyPress="SampPackagingForm.Diameter.value='0'" value="<?php echo $alldata['Length']; ?>" size="15" />
					</td>
    				<td width="183" class="InLineDataTD">
						H=<input type="text" name="Height" value="<?php echo $alldata['Height']; ?>" size="12" />
					</td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Notes</td>
    				<td class="InLineDataTD" colspan="4">
						<textarea name="Notes" cols="50" rows="5"><?php echo $alldata['Notes']; ?></textarea>
					</td>
  				</tr>
  				<tr>
    				<td class="InLineFooterTD" colspan="5" align="center">
						<input type="hidden" name="tabel" value="SampleOther">
						<input type="hidden" value="<?php echo $alldata['ID']; ?>" name="ID">
						<input type="submit" name="submit" value="SUBMIT" size="30" />&nbsp;
						<a href="javascript:history.back();"><input type="reset" name="cancel" value="CANCEL" size="30" /></a>
					</td>
  				</tr>
			</table>
		</form>
		</td>
	</tr>
</table>
</body>
</html>
