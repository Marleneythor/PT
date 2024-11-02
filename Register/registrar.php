<?php
include "../conexion/conexion.php";

// Datos del formulario
$nombres = $_POST['nombres'];
$apellidoPaterno = $_POST['apellidoPaterno'];
$apellidoMaterno = $_POST['apellidoMaterno'];
$gradoEstudio = $_POST['grado'];
$curp = $_POST['curp'];
$sexo = $_POST['sexo'];
$rfc = $_POST['rfc'];
$celular = $_POST['celular'];
$escuelaFacultad = $_POST['escuela'];
$nivelEducativo = $_POST['nivel'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Preparar la llamada al procedimiento almacenado
$stmt = $conexion->prepare("CALL sp_RegistrarDocente(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param(
    "sssssssssssss", 
    $nombres, 
    $apellidoPaterno, 
    $apellidoMaterno, 
    $gradoEstudio, 
    $curp, 
    $sexo, 
    $rfc, 
    $celular, 
    $escuelaFacultad, 
    $nivelEducativo, 
    $correo, 
    $usuario, 
    $contrasena
);

// Ejecutar el procedimiento
if ($stmt->execute()) {
    $result = $stmt->get_result();
    $message = $result->fetch_assoc()['Mensaje'];
    echo $message;
    if ($message === 'Docente registrado exitosamente.') {

        $directorio = "../docentes/" . $curp;

        // Verificar si el directorio ya existe
        if (!is_dir($directorio)) {
            // Intentar crear el directorio
            if (mkdir($directorio, 0777, true)) {
                echo "Directorio '$curp' creado exitosamente.";
        
                // Crear la subcarpeta "RequisitosDeInicio"
                $subdirectorio = $directorio . "/RequisitosDeInicio";
                if (mkdir($subdirectorio, 0777, true)) {
                    echo "Subdirectorio 'RequisitosDeInicio' creado exitosamente.";
                } else {
                    echo "Error al crear el subdirectorio 'RequisitosDeInicio'.";
                }
            } else {
                echo "Error al crear el directorio '$curp'.";
            }
        } else {
            echo "El directorio '$curp' ya existe.";
        
            // Verificar si la subcarpeta "RequisitosDeInicio" existe
            $subdirectorio = $directorio . "/RequisitosDeInicio";
            if (!is_dir($subdirectorio)) {
                // Intentar crear la subcarpeta "RequisitosDeInicio"
                if (mkdir($subdirectorio, 0777, true)) {
                    echo "Subdirectorio 'RequisitosDeInicio' creado exitosamente.";
                } else {
                    echo "Error al crear el subdirectorio 'RequisitosDeInicio'.";
                }
            } else {
                echo "La subcarpeta 'RequisitosDeInicio' ya existe.";
            }
        }

        // Redirigir a otra página en caso de éxito
        header("Location: ../index.php");
        exit();
    } else {
        // Mostrar el mensaje de error
        echo $message;
    }


} else {
    echo "Error al registrar el docente.";
}

// Cerrar conexiones
$stmt->close();
$conexion->close();




?>