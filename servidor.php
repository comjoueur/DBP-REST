<?php
function actualizar($id,$campo,$valor,$conexion){
	$sql="UPDATE Clientes SET ".$campo."=".$valor." WHERE id=".$id;
	$r=mysqli_query($conexion,$sql);
	return $r;
}
function borrar($id,$conexion){
	$sql="DELETE FROM Clientes WHERE id=".$id;
	$r=mysqli_query($conexion,$sql);
	return $r;
}
function insertar($usuario,$password,$nombre,$apellidos,$gustos,$deportes,$edu,$conexion){
	$sql="INSERT INTO Clientes VALUES(";
	$sql=$sql."NULL,";
	$sql=$sql.$usuario.",";
	$sql=$sql.$password.",";
	$sql=$sql.$nombre.",";
	$sql=$sql.$apellidos.",";
	$sql=$sql.$gustos.",";
	$sql=$sql.$deportes.",";
	$sql=$sql.$edu.")";
	$r=mysqli_query($conexion,$sql);
        return $r;
} 
function datos($id,$conexion){
	$sql="SELECT * FROM Clientes WHERE id=".$id;
	$resultado = mysqli_query($conexion,$sql);
	$arr=mysqli_fetch_array($resultado);
	return $arr;
}

function verificar($usuario,$password,$conexion){
	$sql="SELECT * FROM Clientes WHERE usuario=".$usuario;
	$sql=$sql." and Password=".$password;
	$resultado = mysqli_query($conexion,$sql);
	$arr=mysqli_fetch_array($resultado);
	return $arr["id"];
}

$usuario = "root";
$password = "";
$servidor = "localhost";
$base_de_datos = "DBP";

$conexion=mysqli_connect($servidor,$usuario,$password);
$data_base=mysqli_select_db($conexion,$base_de_datos);



$accion=$_GET["acc"];

if($accion=='"login"'){
	$usuario = $_GET["usu"];
	$password = $_GET["password"];
	$id = verificar($usuario,$password,$conexion);
	if(isset($id)){
		echo "{result:YES,id:".$id." id}";
	}
	else{
		echo "{result:NO}";
	}
}
else if($accion=='"consulta"'){
	$id = $_GET["id"];
	$data = datos($id,$conexion);
	if(isset($data)){
		echo json_encode($data);
	}
	else{
		echo "{result:NO}";
	}
}
else if($accion=='"insertar"'){
	$usuario = $_GET["usu"];
	$password = $_GET["pass"];
	$nombre = $_GET["nom"];
	$apellidos = $_GET["apell"];
	$gustos = $_GET["gus"];
	$deportes = $_GET["depor"];
	$edu = $_GET["edu"];
	if(insertar($usuario,$password,$nombre,$apellidos,$gustos,$deportes,$edu,$conexion)){
		echo "{result:YES}";
	}
	else{
		echo "{result:NO}";
	}
}
else if($accion=='"eliminar"'){
	$id = $_GET["id"];
	if(borrar($id,$conexion)){
		echo "{result:YES}";
	}
	else{
		echo "{result:NO}";
	}
}
else if($accion='"actualizar"'){
	$id = $_GET["id"];
	$campo = $_GET["campo"];
	$valor = $_GET["valor"];
	if(actualizar($id,$campo,$valor,$conexion)){
		echo "{result:YES}";
	}
	else{
		echo "{result:NO}";
	}
}
mysqli_close($conexion);
?>
