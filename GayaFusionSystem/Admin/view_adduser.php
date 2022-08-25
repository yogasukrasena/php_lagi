<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php
//$Add = 'add';
//$UserLogin = 'dora';
//$UserName = 'emon';
//$Pass = 'tututu';
//$Passwd = md5($Pass);
//$DeptID = 1;
$Add = $_POST['add'];
$UserLogin = $_POST['UserLogin'];
$UserName = $_POST['UserName'];
$Pass = $_POST['Passwd'];
$Passwd = md5($Pass);
$DeptID = $_POST['DeptID'];
If (!empty($Add)){
	If (empty($UserLogin)){
		echo "Please Fill User Login First";
	}
	Elseif (empty($UserName)){
		echo "Please Fill User Name First";
	}
	Elseif (empty($Pass)){
		echo "Please Fill User Password First";
	}
	Elseif (empty($DeptID)){
		echo "Please Choose User Department First";
	}
	Else {
		//cek apa user sudah terpakai
		$ceksedia = mysql_query("select UserLogin from tblUser where UserLogin = '$UserLogin'");
		$hasilcek = mysql_num_rows($ceksedia);
		If ($hasilcek < 1){
			$insertdata = "INSERT INTO tblUser (UserLogin, UserName, Passwd, DeptID) 
			VALUE ('$UserLogin', '$UserName', '$Passwd', '$DeptID')";
			$insert = mysql_query($insertdata);
			If ($insert){
				$error = "New User Successfully Saved";
			}else {
				echo mysql_error();
			}
		}
		else{ 
			$error = "User Login Already Use. New User Unsaved.";
			//$kill = die();
		}
	}
}
?>
<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
<link rel="stylesheet" type="text/css" href="default.css"/>
<title>GAYA FUSION - ADMINISTRATOR</title>
</head>

<body>
	<div class="content">
	<div class="item">
	<h1>Add User To System  </h1>
    <table width="500" border="0" cellpadding="0" cellspacing="0" id="tblUser">
    <tr>
      <td width="13" height="14"></td>
      <td></td>
      <td ></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
	  <form method="post" action="A_home.php?page=AddUser.html">
	  	<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3"><?php echo $error ?></td>
			</tr>
            <tr>
              <td width="130" height="34"><div align="right"><strong>User Login  </strong></div></td>
              <td width="12">:</td>
              <td width="256"><input type="hidden" name="add" value="add" /><input name="UserLogin" type="text" id="UserLogin" /></td>
            </tr>
            <tr>
              <td height="32"><div align="right"><strong>User Name </strong></div></td>
              <td>:</td>
              <td><input name="UserName" type="text" id="UserName" /></td>
            </tr>
            <tr>
              <td height="36"><div align="right"><strong>Password </strong></div></td>
              <td>:</td>
              <td><input name="Passwd" type="password" id="newpwd" /></td>
            </tr>
			<tr>
              <td height="36"><div align="right"><strong>Department </strong></div></td>
              <td>:</td>
              <td><select name="DeptID" class="box2">
  					<option value="1">R&amp;D-Codification</option>
  					<option value="2">Costing</option>
					<option value="3">Administration</option>
				  </select>
			  </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input name="Submit" type="submit" value="S U B M I T" class="box"/></td>
            </tr>
        </table>
		</form>
	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  	</table>
  	</div>
 	</div>
</body>
</html>