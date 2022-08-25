<?php session_start();

include ("settings.php");
include("language/$cfg_language");
include ("classes/db_functions.php");
include ("classes/security_functions.php");

$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'Public',$lang);


if(!$sec->isLoggedIn())
{
header ("location: login.php");
exit();
}
$tablename = $cfg_tableprefix.'tbluser';
$auth = $dbf->idToField($tablename,'type',$_SESSION['session_user_id']);
$first_name = $dbf->idToField($tablename,'firstname',$_SESSION['session_user_id']);
$last_name= $dbf->idToField($tablename,'lastname',$_SESSION['session_user_id']);

$name=$first_name.' '.$last_name;
$dbf->optimizeTables();

?>
<HTML>
<head> 

</head>
<body>
<?php 
if($auth=="Admin") 
{ 
?>
<p>
<img border="0" src="images/home_print.gif" width="33" height="29" valign="top"><font color="#005B7F" size="4">&nbsp;<b><?php echo $lang->home ?></b></font></p>
<p><font face="Verdana" size="2"><?php echo "$lang->welcomeTo $cfg_company $lang->adminHomeWelcomeMessage"; ?> </font></p>
<ul>
  <li><font face="Verdana" size="2"><a href="<?php echo "backupDB.php?onlyDB=$cfg_database&StartBackup=complete&nohtml=1"?>" ><?php echo $lang->backupDatabase ?></a></font></li>
  <li><font face="Verdana" size="2"><a href="users/index.php"><?php echo $lang->addRemoveManageUsers ?></a></font></li>
  <li><font face="Verdana" size="2"><a href="RnD/index.php"><?php echo "View R&amp;D" ?></a></font></li>
  <li><font face="Verdana" size="2"><a href="Collection/index.php"><?php echo $lang->ViewCollection ?></a></font></li>
  <li><font face="Verdana" size="2"><a href="Costing/index.php"><?php echo $lang->ViewCosting ?></a></font></li>
  <li><font face="Verdana" size="2"><a href="Administration/index.php"><?php echo $lang->ViewAdministration ?></a></font></li>
  <li><font face="Verdana" size="2"><a href="settings/index.php"><?php echo $lang->configureSettings ?></a></font></li>
</ul>
<?php } elseif($auth=="RnD") { ?>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" 

bordercolor="#111111" width="550" id="AutoNumber1">
  <tr>
    <td width="37">
    <img border="0" src="images/home_print.gif" width="33" height="29"></td>
    <td width="513"><font face="Verdana" size="4" color="#336699"><?php echo "$name 
    $lang->home" ?></font></td>
  </tr>
</table>
<p><font face="Verdana" size="2"><?php echo "$lang->welcomeTo $cfg_company $lang->RndHomeWelcomeMessage"; ?>
<?php } elseif($auth=="Costing") { ?>
<table border=\"0\" width=\"500\">
  <tr>
    <td><img border="0" src="images/costing.gif" width="41" height="33" valign='top'><font color='#005B7F' size='4'>&nbsp;<b>Costing</b></font><br>
      <br>
      <font face="Verdana" size="2"><?php echo "$lang->CostingWelcomeScreen" ?></font>
	  <ul><b>Costing :</b>
	  	<li><a href="costing/SampleCeramic.php">R&amp;D</a></li>
		<li><a href="costing/Collection.php">Collection</a></li>
		<li><a href="costing/Clay.php">Clay</a></li>
	  </ul>
      <ul><b>Cost/Minute :</b>
	  	<li><a href="costing/ClayPrep.php">Clay Preparation</a></li>
		<li><a href="costing/Wheel.php">Wheel</a></li>
		<li><a href="costing/Slab.php">Slab</a></li>
		<li><a href="costing/Casting.php">Casting</a></li>
		<li><a href="costing/Finishing.php">Finishing</a></li>
		<li><a href="costing/Glazing.php">Glazing</a></li>
		<li><a href="costing/Movement.php">Movement</a></li>
		<li><a href="costing/PackagingWork.php">Packaging Work</a></li>
	  </ul>
	  <ul><b>Price for Firing :</b>
	  	<li><a href="costing/StandardBisque.php">Standard Bisque</a></li>
		<li><a href="costing/StandardGlaze.php">Standard Glaze</a></li>
		<li><a href="costing/RakuBisque.php">Raku Bisque</a></li>
		<li><a href="costing/RakuGlaze.php">Raku Glaze</a></li>
	  </ul>
      <ul><b>General Cost Control :</b>
	  	<li><a href="costing/ProductiveHour.php">Productive Hours</a></li>
		<li><a href="costing/TrowWorker.php">Trow Worker</a></li>
		<li><a href="costing/CostBudget.php">Cost Budget Preview</a></li>
	  </ul>	  
    </td>
  </tr>
</table>
<?php
}
else
{
?>
<table border="0" width="500">
  <tr>
    <td><img border="0" src="images/Administration.gif" width="41" height="33" valign='top'><font color='#005B7F' size='4'>&nbsp;<b>Administration</b></font><br>
      <br>
      <font face="Verdana" size="2"><?php echo "$lang->AdministrationWelcomeScreen" ?></font>
<!--	<div id=\"navsite\">
	  <h5><b>$lang->ManageDocument :</b></h5>
      <ul>
        <li><a href=\"View_Doc.php\">$lang->ViewDocument</a></li>
        <li><a href=\"Create_Doc.php\">$lang->CreateDocument</a></li>
      </ul>
	</div>-->
	  <h5><b><?php echo "$lang->Create $lang->Master :" ?></b></h5>
	  <ul>
		<!--<li><a href=\"#\">Rate</a></li>-->
		<li><a href="administration/AddCurrency.php">Currency</a></li>
		<li><a href="administration/DeliveryTime.php">DeliveryTime</a></li>
		<li><a href="administration/DeliveryTerm.php">DeliveryTerm</a></li>
		<li><a href="administration/PaymentTerm.php">PaymentTerm</a></li>
		<li><a href="administration/AddressBook.php">AddressBook</a></li>
		<li><a href="administration/AddClient.php">Client</a></li>
		<li><a href="administration/CollectionGroup.php">View Collection Group</a></li>
	  </ul>
	<div id=\"navsite\">	  
	  <h5><b>Document :</b></h5>
	  <ul>
        <li><a href="administration/RnDPriceList.php">R&D Price List</a></li>
        <li><a href="administration/PriceList.php">Collection Price List</a></li>			  
        <li><a href="administration/Quotation.php">Quotation</a></li>
        <li><a href="administration/Proforma.php">Proforma</a></li>
        <li><a href="administration/POL.php">Production Order List</a></li>		
		<li><a href="administration/Invoice.php">Invoice</a></li>
		<li><a href="administration/PackingList.php">PackingList</a></li>		
		<li><a href="administration/ClientPayment.php">Client Payment</a></li>
		<li><a href="administration/ChooseReceivDoc.php">Client Payment Received</a></li>
		<li><a href="administration/ChooseReport.php">Report</a></li>		
      </ul>
	</div>	  
    </td>
  </tr>
</table>


<?php
}
$dbf->closeDBlink();

?>