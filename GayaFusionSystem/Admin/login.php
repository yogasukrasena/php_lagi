<?php
session_start();
include ("../includes/sql.php");
$user_get = $_POST['user'];
$pass_get = $_POST['pass'];
$user_get = mysql_escape_string($user_get); 
$pass_get = mysql_escape_string($pass_get);
$pass_md = md5($pass_get);
$cek_user=mysql_query("select * from tblAdmin where username='$user_get' and passwd='$pass_get'");
//$show_user=mysql_fetch_array($cek_user);
$show_user=mysql_num_rows($cek_user);

if ($show_user >= 1 )
{

$_SESSION['userlogin'] = $user_get;
header("location: A_home.php");

}

else
header("location: index.php");

?>