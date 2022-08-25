<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php
$ID = $_POST['ID'];
$query = "SELECT * FROM tblAdmin WHERE ID = $ID";
?>
<link rel="stylesheet" type="text/css" href="default.css"/>
<form method="post" action="A_home.php?page=cPass.html">
	<div class="content">
		<div class="item">
		<h1>Change Password </h1>
		

  <table width="500" border="0" cellpadding="0" cellspacing="0" id="tblUser">
    <tr>
      <td width="13" height="14">&nbsp;</td>
      <td background="/Images/horizontal-atas.gif"><img src="/Images/spacer.gif" width="1" height="1"></td>
      <td width="13">&nbsp;</td>
    </tr>
    <tr>
      <td background="/Images/vertikal-kiri.gif">&nbsp;</td>
      <td>
	  	<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="login" id="table_login">
            <tr>
              <td width="130" height="34"><div align="right"><strong>Old Password </strong></div></td>
              <td width="12">:</td>
              <td width="256"><input name="oldpwd" type="text" id="oldpwd" /></td>
            </tr>
            <tr>
              <td height="32"><div align="right"><strong>New Password</strong></div></td>
              <td>:</td>
              <td><input name="newpwd" type="password" id="newpwd" /></td>
            </tr>
            <tr>
              <td height="36">&nbsp;</td>
              <td>&nbsp;</td>
              <td><input name="Submit" type="submit" value="C H A N G E" class="box"/></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
         </table>
        
	  </td>
      <td background="/Images/vertikal-kanan.gif">&nbsp;</td>
    </tr>
    <tr>
      <td height="14">&nbsp;</td>
      <td background="/Images/horizontal-bawah.gif"><img src="Images/spacer.gif" width="1" height="1"></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  	</div>
 	</div>
</form>
