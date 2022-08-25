<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
<meta name="description" content="description"/>
<meta name="keywords" content="keywords"/> 
<meta name="author" content="author"/> 
<link rel="stylesheet" type="text/css" href="default.css" media="screen"/>
<title>GAYA FUSION - ADMINISTRATOR</title>
</head>

<body>

<div class="container">
	
	<div class="main">

		<div class="header">
		
			<div class="title">
				<h1>&nbsp;</h1>
			</div>

		</div>
		
		<div class="content">
	
			<?php
$page = $_GET['page'];
$page = str_replace(".html","",$page); //menghilangkan ekstensi .html
$file ="view_$page.php";
if (!file_exists($file)) {
include ("view_adduser.php"); // view_cpass ini,mestinya view_home
} else if ($page=="" || $page=="home"){ 
include ("view_home.php"); //memanggil file yang di-include view_cpass ini,mestinya view_home
} else { // jika file tidak ada
include ("view_$page.php");
}
?>
		</div>

		<div class="sidenav">

			<h1>Administrator Menu </h1>
			<ul>
				<li><a href="A_home.php?page=cpass.html">Home</a></li>
				<li><a href="A_home.php?page=cpass.html">Change Password </a></li>
				<li><a href="A_home.php?page=AddUser.html">Add User </a></li>
				<li><a href="logout.php">Log Out </a></li>
			</ul>

			<h1>&nbsp;</h1>
	  </div>
	
		<div class="clearer"><span></span></div>

	</div>

	<div class="footer">&copy; 2008 By BITS Created For <a href="http://ceramic.gayafusion.com" target="_blank">Gaya Fusion Ceramic</a></div>

</div>

</body>

</html>