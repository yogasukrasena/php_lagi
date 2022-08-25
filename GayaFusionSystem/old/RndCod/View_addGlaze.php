<?php
session_start();
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Data</title>
</head>

<body>
<SCRIPT LANGUAGE="JavaScript" src="calendar.js"></SCRIPT>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11%">Code</td>
    <td width="89%"><?php echo"code" ?></td>
  </tr>
  <tr>
    <td>Description</td>
    <td><?php echo "desc" ?></td>
  </tr>
  <tr>
    <td>Date</td><FORM name="test_form">
    <td><input type="text" name="DateField" size="10" />&nbsp;<A HREF="javascript:void(0)" onClick="showCalendar(test_form.DateField,'mm/dd/yyyy','Choose date')"><img src="../images/DatePicker1.gif" width="17" height="15" border="0" /></a></td></FORM>
  </tr>
  <tr>
    <td>Technical Draw </td>
    <td><input type="file" name="techdraw" size="50" />&nbsp;(600 x 750)</td>
  </tr>
  <tr>
    <td>Photo 1 </td>
    <td><input type="file" name="photo1" size="50" />&nbsp;(200 x 200)</td>
  </tr>
  <tr>
    <td>Photo 2 </td>
    <td><input type="file" name="photo2" size="50" />&nbsp;(200 x 200)</td>
  </tr>
  <tr>
    <td>Photo 3 </td>
    <td><input type="file" name="photo3" size="50" />&nbsp;(200 x 200)</td>
  </tr>
  <tr>
    <td>Photo 4 </td>
    <td><input type="file" name="photo4" size="50" />&nbsp;(200 x 200)</td>
  </tr>
  <tr>
    <td>Notes</td>
    <td><textarea name="Notes" cols="80" rows="10"></textarea>
    &nbsp;</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="submit" value="SUBMIT" size="30" />&nbsp;<input type="reset" name="cancel" value="CANCEL" size="30" /></td>
  </tr>
</table>
</body>
</html>
