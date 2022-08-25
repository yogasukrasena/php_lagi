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
<title>Untitled Document</title></head>

<body>
<form action="editsamppackaging.php" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%">Code</td>
    <td colspan="5"><?php echo"code" ?></td>
  </tr>
  <tr>
    <td>Description</td>
    <td colspan="5"><?php echo"code" ?></td>
  </tr>
  <tr>
    <td>Date</td>
    <td colspan="5"><input type="text" name="tanggal" size="50" /> <img src="../images/DatePicker1.gif" width="17" height="15" /></td>
  </tr>
  <tr>
    <td>Technical Draw </td>
    <td colspan="5"><input type="text" name="TechDraw" size="50" />&nbsp;<input type="submit" name="browse1" value="Browse" />&nbsp;(600 x 750)</td>
  </tr>
  <tr>
    <td>Photo 1</td>
    <td colspan="5"><input type="text" name="photo1" size="50" />&nbsp;<input type="submit" name="browse2" value="Browse" />&nbsp;(200 x 200)</td>
  </tr>
  <tr>
    <td>Photo 2</td>
    <td colspan="5"><input type="text" name="photo2" size="50" />&nbsp;<input type="submit" name="browse3" value="Browse" />&nbsp;(200 x 200)</td>
  </tr>
  <tr>
    <td>Photo 3 </td>
    <td colspan="5"><input type="text" name="photo3" size="50" />&nbsp;<input type="submit" name="browse4" value="Browse" />&nbsp;(200 x 200)</td>
  </tr>
  <tr>
    <td>Photo 4 </td>
    <td colspan="5"><input type="text" name="photo4" size="50" />&nbsp;<input type="submit" name="browse5" value="Browse" />&nbsp;(200 x 200)</td>
  </tr>
  <tr>
    <td colspan="6"><strong>List of Design Material </strong></td>
  </tr>
  <tr>
    <th align="center">Design Material </th>
    <th width="17%" align="center">Supplier</th>
    <th width="18%" align="center">Qty</th>
    <th width="16%" align="center">Unit</th>
    <th width="11%" align="center">Unit Price </th>
    <th width="18%" align="center">Total</th>
  </tr>
  <tr>
    <td>Add</td>
    <td><?php echo"supplier1" ?></td>
    <td><input type="text" name="qty1" size="15" /></td>
    <td><?php echo"unitsup1"?></td>
    <td><?php echo"unitpricesup1" ?></td>
    <td><?php echo"hasilkasi" ?></td>
  </tr>
  <tr>
    <td>Add</td>
    <td><?php echo"sup2"?></td>
    <td><input type="text" name="qty2" size="15" /></td>
    <td><?php echo"unitsup2"?></td>
    <td><?php echo"unitpricesup2" ?></td>
    <td><?php echo"hasilkasi" ?></td>
  </tr>
  <tr>
    <td>Add</td>
    <td><?php echo"sup3"?></td>
    <td><input type="text" name="qty3" size="15" /></td>
    <td><?php echo"unitsup3"?></td>
    <td><?php echo"unitpricesup3" ?></td>
    <td><?php echo"hasilkasi" ?></td>
  </tr>
  <tr>
    <td>Add</td>
    <td><?php echo"sup4"?></td>
    <td><input type="text" name="qty4" size="15" /></td>
    <td><?php echo"unitsup4"?></td>
    <td><?php echo"unitpricesup4" ?></td>
    <td><?php echo"hasilkasi" ?></td>
  </tr>
    <tr>
    <td>Add</td>
    <td><?php echo"sup5"?></td>
    <td><input type="text" name="qty5" size="15" /></td>
    <td><?php echo"unitsup5"?></td>
    <td><?php echo"unitpricesup5" ?></td>
    <td><?php echo"hasilkasi" ?></td>
  </tr>
  <tr>
    <td colspan="6"><strong>List of Work Supplier </strong></td>
  </tr>
  <tr>
    <th align="center">Supplier</th>
    <th colspan="2" align="center">Material</th>
    <th colspan="2" align="center">Color</th>
    <th align="center">Cost Price </th>
  </tr>
  <tr>
    <td>Add</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Add</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Add</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Add</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Add</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Inner Quantity </td>
    <td colspan="5"><input type="text" name="innerqty" size="50" /></td>
  </tr>
  <tr>
    <td>Final Size </td>
    <td>Ø=<input type="text" name="diameter" size="15" /></td>
    <td>W=<input type="text" name="weight" size="15" /></td>
    <td>L=<input type="text" name="lenght" size="15" /></td>
    <td colspan="2">H=<input type="text" name="height" size="15" /></td>
  </tr>
  <tr>
    <td>Weight</td>
    <td colspan="5"><input type="text" size="50" name="weight" /></td>
  </tr>
  <tr>
    <td>Notes</td>
    <td colspan="5"><input type="text" name="Notes" size="120" /></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><input type="submit" name="submit" value="SUBMIT" size="30" />&nbsp;
	<input type="submit" name="cancel" value="CANCEL" size="30" /></td>
  </tr>
</table>
</body>
</html>
