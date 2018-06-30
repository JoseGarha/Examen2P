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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO viajeros (id_viajero, nombre_viajero, fecha_viaje, url_boleto_avion) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_viajero'], "int"),
                       GetSQLValueString($_POST['nombre_viajero'], "text"),
                       GetSQLValueString($_POST['fecha_viaje'], "date"),
                       GetSQLValueString($_POST['url_boleto_avion'], "text"));

  mysql_select_db($database_examen_con, $examen_con);
  $Result1 = mysql_query($insertSQL, $examen_con) or die(mysql_error());

  $insertGoTo = "/examen/formulario_exa.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $insertGoTo));
  $insertGoTo = "/examen/formulario_exa.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
	echo "<script language=javaScript> window.location='/examen/viajes.php' </script>";
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>


<body>
<!doctype html>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre_viajero:</td>
      <td><input type="text" name="nombre_viajero" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha_viaje:</td>
      <td><input type="text" name="fecha_viaje" value="" size="32" /></td>
      
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><?php
	  
	  if(isset($_POST["submit"])){
	echo"Se presiono esa madre</BR>";
	//si presioné el botón submit 
$archivoOrigen = $_FILES["fileToUpload"]["tmp_name"];
$archivoDestino = "fotos/".$_FILES["fileToUpload"]["name"];
	echo "El archivo a subir es: ".$archivoDestino."</BR>";
	//$check = getimagesize($archivoOrigen);
	
	
//PARTE 2.

//Variable que extraiga la extencion del archivo

$check = filetype("");

//Variable que valida que el archivo es tipo imagen
//$check = getimagesize($archivoOrigen);

//echo "Extencion del archivo: ".$imageFileType."</BR>";
	
	/*if($check!==false){
		echo "El archivo es una imagen </BR>";
		move_uploaded_file($archivoOrigen, $archivoDestino);
	}*/
	

if($check!=="gif"){

//si encontroalgo, un archivo de tipo imagen

echo "El archivo es un gif </BR>";

//Transfiriendo el archivo
move_uploaded_file($archivoOrigen,$archivoDestino);
//TRANSFIRIENDO LA URL A LA BD
$query = "INSERT INTO viajeros (id_viajero, nombre_viajero, fecha_viaje, url_boleto_avion ) VALUES (NULL, 'Erickson','2018-04-18', '".$archivoDestino."')";
echo "Query a ejecutar: ".$query."</BR>";

//EJECUTANDO QUERY DE INSERCIC/DN

if($query_a_ejecutar = mysqli_query($conexion, $query)){

echo "Query ejecutando correctamente</br>";
header("Refresh:5; url=FormulaExamen.php");
} else {

echo "Query no ejecutando</br>";

}
}else{echo "El archivo NO es una imagen </BR>";
	 }

}
?>
      <a href="/examen/Formularioex.html">Url_boleto_avion</a>:
      
      </td>
 
      
      <td><input type="text" name="url_boleto_avion" value="" size="32" /></td>
      
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="id_viajero" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
  
</form>
<p>&nbsp;</p>
	</body>
</html>


</body>
</html>