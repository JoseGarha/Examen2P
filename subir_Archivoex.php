<?php

	/*echo "Iniciando transferencia de archivo </br>";
	echo"INSERT INTO usuarios (id_usuario, Nombre, img) VALUES (NULL, 'Cos', 'Cos_pack.jpg');";*/
	echo"</BR>";

		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "viajes";

		//1.2 conectarme a la bd
		$bandera_conexion = true;
		$conexion = mysqli_connect($servername, $username, $password, $database);

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