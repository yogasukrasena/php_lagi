<?php
session_start();
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<!doctype html public "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>GAFA FUSION - RESEARCH &amp; DEVELOPMENT </title>
<link rel="stylesheet" type="text/css" href="../includes/Stile.css">
</head>
<body>
<!-- <p align="left"><font>&nbsp;</font><img src="../images/blank.jpg" width="160" height="150"><br></p> -->
<p align="center"><font>&nbsp;</font><img src="../images/header.jpg" width="700" height="150"><br></p>
  	<div class="sidenav">
  	<h1>SAMPLE</h1>
	<UL>
		<li><a href="rnd_home.php?page=rndsampCeramic.html">Sample Ceramic</a></li>
		<li><a href="rnd_home.php?page=rndsampPackaging.html">Sample Packaging</a></li>
		<li><a href="rnd_home.php?page=rndsampOther.html">Sample Other</a></li>
	</UL>

	<h1>MASTER</h1>
	<ul>
		<li><a href="rnd_home.php?page=rndClay.html">Clay</a></li>
		<li><a href="rnd_home.php?page=rndCasting.html">Casting</a></li>
		<li><a href="rnd_home.php?page=rndEstruder.html">Estruder</a></li>
		<li><a href="rnd_home.php?page=rndTexture.html">Texture</a></li>
		<li><a href="rnd_home.php?page=rndTools.html">Tools</a></li>
		<li><a href="rnd_home.php?page=rndEngobe.html">Engobe</a></li>
		<li><a href="rnd_home.php?page=rndStainOxide.html">Stain &amp; Oxide</a></li>
		<li><a href="rnd_home.php?page=rndGlaze.html">Glaze</a></li>
		<li><a href="rnd_home.php?page=rndFiring.html">Firing Plan</a></li>
		<li><a href="rnd_home.php?page=rndDesignMat.html">Design Material</a></li>
		<li><a href="rnd_home.php?page=rndSupplier.html">Supplier</a></li>
		<li><a href="rnd_home.php?page=rndUnit.html">Unit</a></li>
	</ul>
	<h1>CODIFICATION</h1>
	<ul>
		<li><a href="index1.html">Design</a></li>
		<li><a href="index1.html">Name</a></li>
		<li><a href="index1.html">Category</a></li>
		<li><a href="index1.html">Info / Size</a></li>
		<li><a href="index1.html">Texture</a></li>
		<li><a href="index1.html">Colour</a></li>
		<li><a href="index1.html">Material</a></li>
	</ul>

	<h1>&nbsp;</h1>
	<ul>
		<li><a href="../logout.php">LogOut</a></li>
	</ul>

	</div>
	<div class="content">
		<?php
		$page = $_GET['page'];
		$page = str_replace(".html","",$page);
		$file = "view_$page.php";
		if (!file_exists($file)){
			include ("view_rndsampceramic.php");
		} else if ($page=="" || $page=="rndsampceramic"){
			include ("view_rndsampceramic.php");
		}
		else {
			include ("view_$page.php");
		}
		?>
		
	</div>

<div class="clearer"><span></span></div>
		<div class="footer">&copy; 2008 By BITS Created For <a href="http://ceramic.gayafusion.com" target="_blank">Gaya Fusion Ceramic</a></div>
</body>
</html>