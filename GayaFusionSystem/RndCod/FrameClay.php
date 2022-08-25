
<HTML>
<HEAD>

<TITLE>Search Record.....</TITLE>
<SCRIPT LANGUAGE="JavaScript">
var Nav4 = ((navigator.appName == "Netscape") && (parseInt(navigator.appVersion) >= 4))

// Close the dialog
function closeme() {
	window.close()
}

// Handle click of OK button
function handleOK() {
	if (opener && !opener.closed) {
		top.dlogBody.transferData()
		opener.dialogWin.returnFunc()
	} else {
		alert("You have closed the main window.\n\nNo action will be taken on the choices in this dialog box.")
	}
	closeme()
	return false
}

// Handle click of OK button
function handleColor(param) {
	if (opener && !opener.closed) {
		top.opener.dialogWin.returnedValue_$alldata['Clay']=param
		opener.dialogWin.returnFunc()
	} else {
		alert("You have closed the main window.\n\nNo action will be taken on the choices in this dialog box.")
	}
	closeme()
	return false
}

// Handle click of Cancel button
function handleCancel() {
	closeme()
	return false
}

</SCRIPT>

</HEAD>

<FRAMESET FRAMEBORDER=no FRAMESPACING=0 ROWS="*,0" BORDER=0 onLoad="if (opener) opener.blockEvents()" onUnload="if (opener) opener.unblockEvents()">
	<FRAME NAME="dlogButtons" SRC="ClayPopup.php" FRAMEBORDER=no SCROLLING=yes>
</FRAMESET>
</HTML>