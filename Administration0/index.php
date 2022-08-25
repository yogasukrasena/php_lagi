<?php session_start();
include ("../settings.php");
include("../language/$cfg_language");
include ("../classes/db_functions.php");
include ("../classes/security_functions.php");

$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'Sales Clerk',$lang);


if(!$sec->isLoggedIn())
{
	header ("location: ../login.php");
	exit();
}

echo "
<html>

<head>
<link rel=\"stylesheet\" href=\"interface.css\" type=\"text/css\" />
</head>
<body>
<table border=\"0\" width=\"500\">
  <tr>
    <td><img border=\"0\" src=\"../images/Administration.gif\" width=\"41\" height=\"33\" valign='top'><font color='#005B7F' size='4'>&nbsp;<b>$lang->Administration</b></font><br>
      <br>
      <font face=\"Verdana\" size=\"2\">$lang->AdministrationWelcomeScreen</font>
<!--	<div id=\"navsite\">
	  <h5><b>$lang->ManageDocument :</b></h5>
      <ul>
        <li><a href=\"View_Doc.php\">$lang->ViewDocument</a></li>
        <li><a href=\"Create_Doc.php\">$lang->CreateDocument</a></li>
      </ul>
	</div>-->
	  <h5><b>$lang->Create $lang->Master :</b></h5>
	  <ul>
		<!--<li><a href=\"#\">$lang->Rate</a></li>-->
		<li><a href=\"AddCurrency.php\">$lang->Currency</a></li>
		<li><a href=\"DeliveryTime.php\">$lang->DeliveryTime</a></li>
		<li><a href=\"DeliveryTerm.php\">$lang->DeliveryTerm</a></li>
		<li><a href=\"PaymentTerm.php\">$lang->PaymentTerm</a></li>
		<li><a href=\"AddressBook.php\">$lang->AddressBook</a></li>
		<li><a href=\"AddClient.php\">Client</a></li>
	  </ul>
	<div id=\"navsite\">	  
	  <h5><b>Document :</b></h5>
	  <ul>
        <li><a href=\"PriceList.php\">Price List</a></li>			  
        <li><a href=\"Quotation.php\">Quotation</a></li>
        <li><a href=\"Proforma.php\">Proforma</a></li>
        <li><a href=\"POL.php\">Production Order List</a></li>		
		<li><a href=\"Invoice.php\">Invoice</a></li>
		<li><a href=\"PackingList.php\">PackingList</a></li>		
		<li><a href=\"ClientPayment.php\">Client Payment</a></li>
		<li><a href=\"ChooseReceivDoc.php\">Client Payment Received</a></li>
		<li><a href=\"ChooseReport.php\">Report</a></li>		
      </ul>
	</div>	  
    </td>
  </tr>
</table>
</body>
</html>";

$dbf->closeDBlink();


?>
