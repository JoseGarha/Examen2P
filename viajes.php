<?php virtual('/examen/Connections/examen_con.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Viajeros = 10;
$pageNum_Viajeros = 0;
if (isset($_GET['pageNum_Viajeros'])) {
  $pageNum_Viajeros = $_GET['pageNum_Viajeros'];
}
$startRow_Viajeros = $pageNum_Viajeros * $maxRows_Viajeros;

mysql_select_db($database_examen_con, $examen_con);
$query_Viajeros = "SELECT * FROM viajeros";
$query_limit_Viajeros = sprintf("%s LIMIT %d, %d", $query_Viajeros, $startRow_Viajeros, $maxRows_Viajeros);
$Viajeros = mysql_query($query_limit_Viajeros, $examen_con) or die(mysql_error());
$row_Viajeros = mysql_fetch_assoc($Viajeros);

if (isset($_GET['totalRows_Viajeros'])) {
  $totalRows_Viajeros = $_GET['totalRows_Viajeros'];
} else {
  $all_Viajeros = mysql_query($query_Viajeros);
  $totalRows_Viajeros = mysql_num_rows($all_Viajeros);
}
$totalPages_Viajeros = ceil($totalRows_Viajeros/$maxRows_Viajeros)-1;

$queryString_Viajeros = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Viajeros") == false && 
        stristr($param, "totalRows_Viajeros") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Viajeros = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Viajeros = sprintf("&totalRows_Viajeros=%d%s", $totalRows_Viajeros, $queryString_Viajeros);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table border="1">
  <tr>
    <td>id_viajero</td>
    <td>nombre_viajero</td>
    <td>fecha_viaje</td>
    <td>url_boleto_avion</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Viajeros['id_viajero']; ?></td>
      <td><?php echo $row_Viajeros['nombre_viajero']; ?></td>
      <td><?php echo $row_Viajeros['fecha_viaje']; ?></td>
      <td><?php echo $row_Viajeros['url_boleto_avion']; ?></td>
    </tr>
    <?php } while ($row_Viajeros = mysql_fetch_assoc($Viajeros)); ?>
</table>
<p><a href="/examen/FormulaExamen.php">Insertar registro</a></p>
</body>
</html>
<?php
mysql_free_result($Viajeros);
?>
