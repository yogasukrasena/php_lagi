<?php
session_start();
include ("../Includes/sql.php");
//include_once("rnd_home.php");
if (!$_SESSION["userlogin"]) {
	//header("location: ../index.php");
	//die;
}	

	$sid = $_POST['sID'];
	//$sid = 4;
	//$Dm1 = $_POST['Dm1'];
	$PicPrefixName = date("Y").date("m").date("j").date("H").date("i").date("s");
	$ClayType = $_POST['ClayType'];
	$ClayKG = $_POST['ClayKG'];
	$ClayPricePerKG = $_POST['ClayPricePerKG'];
	$ClayPreparationMinute = $_POST['ClayPreparationMinute'];
	$WheelMinute = $_POST['WheelMinute'];	
	$SlabMinute = $_POST['SlabMinute'];
	$CastingMinute = $_POST['CastingMinute'];
	$FinishingMinute = $_POST['FinishingMinute'];
	$GlazingMinute   = $_POST['GlazingMinute'];

	$StandardBisqueLoading = $_POST['StandardBisqueLoading'];
	if ($StandardBisqueLoading == 0 || $StandardBisqueLoading == null) {
		$StandardBisqueCost = 0;
	}
	else{
		$StandardBisqueCost = $_POST['StandardBisqueCost'];
	}
	$StandardGlazeLoading = $_POST['StandardGlazeLoading'];
	if ($StandardGlazeLoading == 0 || $StandardGlazeLoading == null){
		$StandardGlazeCost = 0;
	}
	else {
		$StandardGlazeCost = $_POST['StandardGlazeCost'];
	}
	$RakuBisqueLoading = $_POST['RakuBisqueLoading'];
	if ($RakuBisqueLoading == 0 || $RakuBisqueLoading == null) {
		$RakuBisqueCost = 0;
	}
	else {
		$RakuBisqueCost = $_POST['RakuBisqueCost'];	
	}
	$RakuGlazeLoading = $_POST['RakuGlazeLoading'];
	if ($RakuGlazeLoading == 0 || $RakuGlazeLoading == null) {
		$RakuGlazeCost = 0;
	}
	else {
		$RakuGlazeCost = $_POST['RakuGlazeCost'];
	}
	
	$MovementMinute = $_POST['MovementMinute'];
	$PackagingWorkMinute = $_POST['PackagingWorkMinute'];
	$ClayPreparationCPM = $_POST['ClayPreparationCostPerMinute'];
	$WheelCPM = $_POST['WheelCostPerMinute'];
	$SlabCPM = $_POST['SlabCostPerMinute'];
	$CastingCPM = $_POST['CastingCostPerMinute'];
	$FinishingCPM = $_POST['FinishingCostPerMinute'];
	$GlazingCPM = $_POST['GlazingCostPerMinute'];
	$MovementCPM = $_POST['MovementCostPerMinute'];
	$PackagingWorkCPM = $_POST['PackagingWorkCostPerMinute'];
	$ClayPreparationPPH = (!$ClayPreparationMinute == 0 ) ? round(60 / $ClayPreparationMinute) : 0;
	$WheelPPH = (!$WheelMinute == 0) ? round(60 / $WheelMinute) : 0 ;
	$SlabPPH = (!$SlabMinute == 0) ? round(60/$SlabMinute) : 0;
	$CastingPPH = (!$CastingMinute == 0) ? round(60/$CastingMinute) : 0;
	$FinishingPPH = (!$FinishingMinute == 0) ? round(60/$FinishingMinute) : 0;
	$GlazingPPH = (!$GlazingMinute == 0) ? round(60/$GlazingMinute) : 0;
	$MovementPPH = (!$MovementMinute == 0) ? round(60/$MovementMinute) : 0;
	$PackagingWorkPPH = (!$PackagingWorkMinute == 0) ? round(60/$PackagingWorkMinute) : 0;
	$ClayCost = ($ClayKG * $ClayPricePerKG);// $_POST['ClayCost'];
	$ClayPreparationCost = ($ClayPreparationCPM * $ClayPreparationPPH);//$_POST['ClayPreparationCost'];
	$WheelCost = ($WheelCPM * $WheelPPH);
	$SlabCost = ($SlabCPM * $SlabPPH);
	$CastingCost = ($CastingCPM * $CastingPPH);
	$FinishingCost   = ($FinishingCPM * $FinishingPPH);	
	$GlazingCost   = ($GlazingCPM * $GlazingPPH);	
	$MovementCost = ($MovementCPM * $MovementPPH);
	$PackagingWorkCost = ($PackagingWorkCPM * $PackagingWorkPPH);
	$DesignMatCost = $_POST['DesignMatCost'];
	$TotalAllCost = $ClayCost + $ClayPreparationCost + $WheelCost + $SlabCost + $CastingCost + $FinishingCost + $GlazingCost + $StandardBisqueCost + $StandardGlazeCost + $RakuBisqueCost + $RakuGlazeCost + $DesignMatCost + $MovementCost + $PackagingWorkCost;
	$RiskPrice = round($TotalAllCost + ($TotalAllCost * 0.1));
	$HypoSellingPrice = ($RiskPrice * 3);
	$RealSellingPrice = $_POST['RealSellingPrice'];
	
//SampleCeramic.ClayType = '$ClayType',
	//SampleCeramic.ClayCost = '$ClayCost',
$_rs ="UPDATE sampleceramic 
	SET 
	SampleCeramic.ClayType = '$ClayType',
	SampleCeramic.ClayCost = '$ClayCost',	
	SampleCeramic.ClayPreparationMinute = '$ClayPreparationMinute',
	SampleCeramic.ClayPreparationCost = '$ClayPreparationCost',
	SampleCeramic.WheelMinute = '$WheelMinute',	
	SampleCeramic.WheelCost = '$WheelCost',
	SampleCeramic.SlabMinute = '$SlabMinute',
	SampleCeramic.SlabCost  = '$SlabCost',
	SampleCeramic.CastingMinute = '$CastingMinute',
	SampleCeramic.CastingCost = '$CastingCost',
	SampleCeramic.FinishingMinute = '$FinishingMinute',
	SampleCeramic.FinishingCost = '$FinishingCost',
	SampleCeramic.GlazingMinute = '$GlazingMinute',
	SampleCeramic.GlazingCost = '$GlazingCost',	
	SampleCeramic.StandardBisqueLoading = '$StandardBisqueLoading',
	SampleCeramic.StandardBisqueCost = '$StandardBisqueCost',
	SampleCeramic.StandardGlazeLoading = '$StandardGlazeLoading',
	SampleCeramic.StandardGlazeCost = '$StandardGlazeCost',
	SampleCeramic.RakuBisqueLoading = '$RakuBisqueLoading',
	SampleCeramic.RakuBisqueCost = '$RakuBisqueCost',
	SampleCeramic.RakuGlazeLoading = '$RakuGlazeLoading',
	SampleCeramic.RakuGlazeCost = '$RakuGlazeCost',
	SampleCeramic.MovementMinute = '$MovementMinute',
	SampleCeramic.MovementCost = '$MovementCost',	
	SampleCeramic.PackagingWorkMinute = '$PackagingWorkMinute',
	SampleCeramic.PackagingWorkCost = '$PackagingWorkCost',
	SampleCeramic.ClayPreparationPPH = '$ClayPreparationPPH',
	SampleCeramic.WheelPPH = '$WheelPPH',
	SampleCeramic.SlabPPH = '$SlabPPH',
	SampleCeramic.CastingPPH = '$CastingPPH',
	SampleCeramic.FinishingPPH = '$FinishingPPH',
	SampleCeramic.GlazingPPH = '$GlazingPPH',
	SampleCeramic.MovementPPH = '$MovementPPH',
	SampleCeramic.PackagingWorkPPH = '$PackagingWorkPPH',
	SampleCeramic.TotalAllCost = '$TotalAllCost',
	SampleCeramic.RiskPrice = '$RiskPrice',
	SampleCeramic.HypoSellingPrice = '$HypoSellingPrice',
	SampleCeramic.RealSellingPrice = '$RealSellingPrice'
	 WHERE sampleceramic.sID = '$sid';";
	 
	$query=mysql_query($_rs);
	if ($query)

	{
		//$ref = $_SERVER['HTTP_REFERER'];
		//header( 'refresh: 1; url='.$ref);
		header("Location:View_EditCosting.php?sid=$sid");
		//echo "$RakuGlazeLoading"."<br>"."$RakuBisqueLoading"."<br>"."$_rs";
		//echo $Dm1;
	}
	else
	{
		$sala=mysql_error();
		echo $sala;
	}
	//header("Location:index.php");

	?>