<?php
session_start();
include ("includes/sql.php");
$user_get = $HTTP_POST_VARS['userlogin'];
$pass_get = $HTTP_POST_VARS['passwd'];
$user_get = mysql_escape_string($user_get); 
$pass_get = mysql_escape_string($pass_get);
//$user_get = costing; 
//$pass_get = costing;
$passmd = md5($pass_get);
$cek_user=mysql_query("select * from tblUser where userlogin='$user_get' and passwd='$passmd'");
//$show_user=mysql_fetch_array($cek_user);
$show_user=mysql_num_rows($cek_user);
$data = mysql_fetch_array($cek_user);
if ($show_user >= 1){
	$Dept = $data['DeptID'];
	$_SESSION['userlogin'] = $user_get;
	if ($Dept == '1'){
		header("location: RndCod/index.php");
	}
	elseif ($Dept == '2'){
		header("location: Costing/index.php");
	}
	else {
		header("location: Administration/newhome.php");
	}
}
else
header("location: index.php");
?>