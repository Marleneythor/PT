<?php
include "../conexion/conexion.php";

try {
    $nombres = $_POST["nombres"];
    $apellidoMaterno = $_POST["apellidoMaterno"];
    $apellidoPaterno = $_POST["apellidoPaterno"];
    $grado = $_POST["grado"];
    $curp = $_POST["curp"];
    $sexo = $_POST["sexo"];
    $rfc = $_POST["rfc"];
    $celular = $_POST["celular"];
    $escuela = $_POST["escuela"];
    $nacionalidad = $_POST["nacionalidad"];
    $pais = $_POST["pais"];
    $nivelEducativo = $_POST["nivelEducativo"];
    $correo = $_POST["correo"];
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];


    $sql = "INSERT INTO usuario (Nombres, ApellidoPaterno, ApellidoMaterno, GradoEstudio, CURP, Sexo, RFC, Celular, EscuelaFacultad, Nacionalidad, Pais, NivelEducativo, Correo, Usuario, Contrasena) 
    VALUES                       ('$nombres', '$apellidoPaterno',  '$apellidoMaterno', '$grado', '$curp', '$sexo', '$rfc', '$celular', '$escuela', '$nacionalidad', '$pais', '$nivelEducativo', '$correo', '$usuario', '$contrasena')";

   
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado) {
        header("Location: ../index.php");
    } 
} 

catch (Error $error) {
    echo "no fue posible", $error;
}





?>