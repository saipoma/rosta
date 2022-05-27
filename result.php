<?php require_once('Connections/su.php'); ?>
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

$colname_rs_search = "-1";
if (isset($_GET['txt_search'])) {
  $colname_rs_search = $_GET['txt_search'];
}
mysql_select_db($database_su, $su);
$query_rs_search = sprintf("SELECT * FROM student_data WHERE stu_no = %s", GetSQLValueString($colname_rs_search, "int"));
$rs_search = mysql_query($query_rs_search, $su) or die(mysql_error());
$row_rs_search = mysql_fetch_assoc($rs_search);
$totalRows_rs_search = mysql_num_rows($rs_search);$colname_rs_search = "-1";
if (isset($_POST['txt_search'])) {
  $colname_rs_search = $_POST['txt_search'];
}
mysql_select_db($database_su, $su);
$query_rs_search = sprintf("SELECT * FROM student_data WHERE stu_no = %s", GetSQLValueString($colname_rs_search, "int"));
$rs_search = mysql_query($query_rs_search, $su) or die(mysql_error());
$row_rs_search = mysql_fetch_assoc($rs_search);
$totalRows_rs_search = mysql_num_rows($rs_search);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>النتيجة</title>
<style type="text/css">
body {
	margin-left: 100px;
	margin-top: 100px;
	margin-right: 100px;
	margin-bottom: 100px;
	text-align: center;
}
</style>
</head>



<body>

  <table width="428" border="1" align="center">
    <tbody>
      <tr>
        <td width="207"><div align="center"><strong><?php echo $row_rs_search['stu_no']; ?></strong></div></td>
        <td width="205"><div align="center"><strong>رقم الطالب</strong></div></td>
      </tr>
      <tr>
        <td><div align="center"><strong><?php echo $row_rs_search['stu_name']; ?></strong></div></td>
        <td><div align="center"><strong>اسم الطالب</strong></div></td>
      </tr>
      <tr>
        <td><div align="center"><strong><?php echo $row_rs_search['stb_1']; ?></strong></div></td>
        <td><div align="center"><strong>الغة العربية</strong></div></td>
      </tr>
      <tr>
        <td><div align="center"><strong><?php echo $row_rs_search['stb_2']; ?></strong></div></td>
        <td><div align="center"><strong>الغة الانجليزية</strong></div></td>
      </tr>
      <tr>
        <td><div align="center"><strong><?php echo $row_rs_search['stb_3']; ?></strong></div></td>
        <td align="center"><div align="center"><strong>دراسات اجتماعية</strong></div></td>
      </tr>
      <tr>
        <td><div align="center"><strong><?php echo $row_rs_search['stb_4']; ?></strong></div></td>
        <td><div align="center"><strong>رياضيات</strong></div></td>
      </tr>
      <tr>
        <td><div align="center"><strong><?php echo $row_rs_search['stb_5']; ?></strong></div></td>
        <td><div align="center"><strong>علوم</strong></div></td>
      </tr>
      <tr>
        <td><div align="center"><strong><?php echo $row_rs_search['stb_6']; ?></strong></div></td>
        <td><div align="center"><strong>حاسب الالى</strong></div></td>
      </tr>
      <tr>
        <td><div align="center"><strong><?php echo $row_rs_search['total']; ?></strong></div></td>
        <td><div align="center"><strong>المجموع</strong></div></td>
      </tr>
      <tr>
        <td><div align="center"><strong><?php echo $row_rs_search['comment']; ?></strong></div></td>
        <td><div align="center"><strong>ملحوظه</strong></div></td>
      </tr>
    </tbody>
  </table>
      

    <div>
	  <h3><strong style="color: #FF0004">نتمنى لكم النجاح والتوفيق</strong></h3>
</div>
<form action="search.php" method="post" name="back_form" id="back_form" title="back_form">
  <input name="submit" type="submit" id="submit" formaction="search.php" value="رجوع">
</form>
</body>
</html>
<?php
mysql_free_result($rs_search);
?>
