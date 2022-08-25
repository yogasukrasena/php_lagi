<?php session_start();

include ("settings.php");
include ("language/$cfg_language");
include ("classes/db_functions.php");
include ("classes/security_functions.php");

//create 3 objects that are needed in this script.
$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'Public',$lang);

$tablename = $cfg_tableprefix.'tbluser';
$auth = $dbf->idToField($tablename,'type',$_SESSION['session_user_id']);
//$auth = 'Administration';
$userLoginName= $dbf->idToField($tablename,'username',$_SESSION['session_user_id']);

$dbf->closeDBlink();


// Display HTML--
?>

<HTML>
<HEAD>
<SCRIPT LANGUAGE="Javascript">
<!---
//window.onload=montre;
//function montre(id) {
//var d = document.getElementById(id);
	//for (var i = 1; i<=10; i++) {
	//	if (document.getElementById('smenu'+i)) {document.getElementById('smenu'+i).style.display='none';}
//	}
//if (d) {d.style.display='block';}
//}

//function decision(message, url)/
//{
//	if(confirm(message) )
  //{
    //parent.location.href = url;
  //}
//}
-->
</SCRIPT> 

<style type="text/css"> 
 <!-- 
 a.nav:link
 {
 	font-weight:bold;
	 font-size:7pt;
	 font-family:Verdana;
	 color:white;
	

 }
 
 a.nav:visited
 {
 	font-weight:bold;
	 font-size:7pt;
	 font-family:Verdana;
	 color:white;
 }
 
 a.nav:active
 {
 	font-weight:bold;
	 font-size:7pt;
	 font-family:Verdana;
	 color:black;
 }

 a.nav:hover
 {
	 font-size:7pt;
	 font-family:Verdana;
	 color:#CCCCCC;
 }

 //--> 
 </style>
 
<TITLE>Gaya Fusion - Ceramic &amp; Design</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
</HEAD>
<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 background="images/menubar_bg.gif">
<TABLE background="images/menubar_bg.gif" WIDTH=850 BORDER=0 CELLPADDING=0 CELLSPACING=0 style="border-collapse: collapse" bordercolor="#111111">
	<TR>
		<TD width="434" height="78">
			<div align="center">
              <center>
              <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="95%" id="AutoNumber1">
			  	<!--<tr>
                  <td width="100%"><b>
                  <font face="Verdana" color="#FFFFFF" size="4">&nbsp;<?php echo $cfg_company ?></font></b></td>
                </tr>-->
			  	<tr>
                  <td width="100%"><br><img src="images/logoGAYA.gif"></td>
                </tr>
              </table>
              </center>
            </div>
		</TD>
		<?php if($auth=="Admin") { ?>
		<TD background="images/menubar_home.gif" width="70" style="cursor: hand;" onClick="window.open('home.php','MainFrame')">		
		<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="home.php" target="MainFrame" class="nav"><?php echo $lang->home ?></a>
		</TD>
		
		<TD background="images/menubar_RnD.gif" width="70" style="cursor: hand;" onClick="window.open('Rnd/index.php','MainFrame')">
		<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="Rnd/index.php" target="MainFrame" class="nav"><?php echo $lang->RnD ?></a>
		</TD>
		
		<TD background="images/menubar_Collection.gif" width="70" style="cursor: hand;" onClick="window.open('Collection/index.php','MainFrame')">			
		<center><br><br><a href="Collection/index.php" target="MainFrame" class="nav"><?php echo $lang->Collection ?></a></center>
		</TD>
		
		<TD background="images/menubar_Costing.gif" width="70" style="cursor: hand;" onClick="window.open('Costing/index.php','MainFrame')">
		
		<center><br><br><a href="Costing/index.php" target="MainFrame" class="nav"><?php echo $lang->Costing ?></a>
		</center>
		</TD>
		
		<TD background="images/menubar_admin2.gif" width="70" style="cursor: hand;" onClick="window.open('Administration/index.php','MainFrame')">
		
		<center><br><br><a href="Administration/index.php" target="MainFrame" class="nav"><?php echo $lang->Administration ?></a></center>		</TD>
		

		<TD background="images/menubar_Config.gif" width="70" style="cursor: hand;" onClick="window.open('settings/index.php','MainFrame')">
		<center><br><br><a href="settings/index.php" target="MainFrame" class="nav"><?php echo $lang->config ?></a></center>
		</TD>
	</TR>
	<?php } if($auth=="RnD") { ?>
		
		
		<TD background="images/menubar_home.gif" width="70" style="cursor: hand;" onClick="window.open('home.php','MainFrame')">		
		<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="home.php" target="MainFrame" class="nav"><?php echo $lang->home ?></a>
		</TD>
		
		<TD background="images/menubar_Collection.gif" width="70" style="cursor: hand;" onClick="window.open('Collection/index.php','MainFrame')">			
		<center><br><br><a href="Collection/index.php" target="MainFrame" class="nav"><?php echo $lang->Collection ?></a></center>
		</TD>
		
		<TD background="images/menubar_RnD.gif" width="70" style="cursor: hand;" onClick="window.open('Rnd/index.php','MainFrame')">
		<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="Rnd/index.php" target="MainFrame" class="nav"><?php echo $lang->RnD ?></a>
		</TD>
		
		<TD background="images/menubar_Kosong.gif" width="70">
		
		</TD>
		
		<TD background="images/menubar_Kosong.gif" width="70">
		</TD>

	</TR>
	<?php } if($auth=="Costing") { ?>
		<TD background="images/menubar_home.gif" width="70" style="cursor: hand;" onClick="window.open('home.php','MainFrame')">		
		<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="home.php" target="MainFrame" class="nav"><?php echo $lang->home ?></a>
		</TD>
		
		<TD background="images/menubar_Kosong.gif" width="70">			
		</TD>
		
		<TD background="images/menubar_Kosong.gif" width="70">

		</TD>
		
		<TD background="images/menubar_Costing.gif" width="70" style="cursor: hand;" onClick="window.open('Costing/index.php','MainFrame')">
		
		<center><br><br><a href="Costing/index.php" target="MainFrame" class="nav"><?php echo $lang->Costing ?></a>
		</center>
		</TD>
		
		<TD background="images/menubar_Kosong.gif" width="70">
		</TD>
		
	</TR>
	<?php } if($auth=="Administration") { ?>
		<TD background="images/menubar_home.gif" width="70" style="cursor: hand;" onClick="window.open('home.php','MainFrame')">		
		<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="home.php" target="MainFrame" class="nav"><?php echo $lang->home ?></a>
		</TD>
		
		<TD background="images/menubar_Kosong.gif" width="70">			
		</TD>
		
		<TD background="images/menubar_Kosong.gif" width="70">

		</TD>
		
		<TD background="images/menubar_Kosong.gif" width="70">
		
		</TD>
		
		<TD background="images/menubar_admin2.gif" width="70" style="cursor: hand;" onClick="window.open('Administration/index.php','MainFrame')">
		
		<center><br><br><a href="Administration/index.php" target="MainFrame" class="nav"><?php echo $lang->Administration ?></a></center>		</TD>
		
	</TR>
	<?php } ?>
	<TR>
		<TD COLSPAN=4 width="609" bgcolor="#747474" height="22">
			<div align="center">
              <center>
              <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="97%" id="AutoNumber2">
                <tr>
                  <td width="100%"><b>
                  <font face="Verdana" size="1" color="#FFFFFF">
				  <?php echo $lang->welcome ?>
				  <?php echo $userLoginName; ?>!
				  |<a href="logout.php" target="_TOP"><font color="#FFFFFF"><?php echo $lang->logout ?></font></a></font></b></td>
                </tr>
              </table>
              </center>
            </div>        </TD>
		<TD COLSPAN=3 width="141" bgcolor="#747474" height="22">
			<div align="center">
              <center>
              <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="95%" id="AutoNumber3">
                <tr>
                  <td width="100%">
                  <p align="left"><b>
                  <font face="Verdana" size="1" color="#FFFFFF"><?php echo date("F j, Y"); ?></font></b></td>
                </tr>
              </table>
              </center>
            </div>        </TD>
	</TR>
	</TABLE>
</BODY>
</HTML>
