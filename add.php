<?php require_once('../Connections/su.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO student_data (stu_no, stu_name, stb_1, stb_2, stb_3, stb_4, stb_5, stb_6, total, `comment`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['stu_no'], "int"),
                       GetSQLValueString($_POST['stu_name'], "text"),
                       GetSQLValueString($_POST['stb_1'], "text"),
                       GetSQLValueString($_POST['stb_2'], "text"),
                       GetSQLValueString($_POST['stb_3'], "text"),
                       GetSQLValueString($_POST['stb_4'], "text"),
                       GetSQLValueString($_POST['stb_5'], "text"),
                       GetSQLValueString($_POST['stb_6'], "text"),
                       GetSQLValueString($_POST['total'], "text"),
                       GetSQLValueString($_POST['comment'], "text"));

  mysql_select_db($database_su, $su);
  $Result1 = mysql_query($insertSQL, $su) or die(mysql_error());

  $insertGoTo = "successful.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_su, $su);
$query_rs_add = "SELECT * FROM student_data";
$rs_add = mysql_query($query_rs_add, $su) or die(mysql_error());
$row_rs_add = mysql_fetch_assoc($rs_add);
$totalRows_rs_add = mysql_num_rows($rs_add);
$query_rs_add = "SELECT * FROM student_data";
$rs_add = mysql_query($query_rs_add, $su) or die(mysql_error());
$row_rs_add = mysql_fetch_assoc($rs_add);
$totalRows_rs_add = mysql_num_rows($rs_add);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>اضافة النتيجة</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <div align="center"></div>
  <table width="367" align="center">
    <tr valign="baseline">
      <td width="250" align="right" nowrap><input type="text" name="stu_no" value="" size="32"></td>
      <td width="105">رقم الجلوس</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><input type="text" name="stu_name" value="" size="32"></td>
      <td>اسم الطالب</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><input type="text" name="stb_1" value="" size="32"></td>
      <td> الغة العربية</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><input type="text" name="stb_2" value="" size="32">
      <td>الغة الانجليزية</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><input type="text" name="stb_3" value="" size="32"></td>
      <td>دراسات اجتماعية</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><input type="text" name="stb_4" value="" size="32"></td>
      <td>رياضيات</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><input type="text" name="stb_5" value="" size="32"></td>
      <td>علوم</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><input type="text" name="stb_6" value="" size="32"></td>
      <td>حاسب الالى</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><input type="text" name="total" value="" size="32"></td>
      <td>المجموع</td>
    </tr>
    <tr valign="baseline">
      <td height="41" align="right" nowrap><input name="comment" type="text" size="32"></td>
      <td>ملحوظه</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><input type="submit" value="اضف"></td>
      <td><div align="center"></div></td>
    </tr>
  </table>
  <div align="center">
    <input type="hidden" name="MM_insert" value="form1">
  </div>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_add);
?>
