<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDD</title>
    <link rel="stylesheet" type="text/css" href="../public/styles/registrar.css">
</head>
<body>
    <div class="formulario">
        <form action="registrar.php" class="flexCenter" name="formulario" method="post">
            <h3>Registro de usuario</h3>
            <div>
                <span>Nombres</span>
                <input name="nombres" type="text" required>
            </div>
            <div>
                <span>Apellido Materno</span>
                <input name="apellidoMaterno" type="text" required>
            </div>
            <div>
                <span>Apellido Paterno</span>
                <input name="apellidoPaterno" type="text" required>
            </div>
            <div>
                <span>Grado de estudio</span>
                <input name="grado" type="text" required>
            </div>
            <div>
                <span>CURP</span>
                <input name="curp" type="text" required>
            </div>
            <div>
                <span>Sexo</span>
                <input name="sexo" type="text" required>
            </div>
            <div>
                <span>RFC</span>
                <input name="rfc" type="text" required>
            </div>
            <div>
                <span>Celular</span>
                <input name="celular" type="text">
            </div>
            <div>
                <span>Escuela o facultad</span>
                <input name="escuela" type="text" value="Instituto Tecnológico de Lázaro Cárdenas" required>
            </div>
            <div>
                <span>Nacionalidad</span>
                <input name="nacionalidad" type="text">
            </div>
            <div>
                <span>País</span>
                <input name="pais" type="text">
            </div>
            <div>
                <span>Nivel Educativo</span>
                <input name="nivelEducativo" type="text">
            </div>
            <div>
                <span>Correo electrónico</span>
                <input name="correo" type="email" required>
            </div>
            <div>
                <span>Usuario</span>
                <input name="usuario" type="text" required>
            </div>
            <div>
                <span>Contraseña</span>        
                <input name="contrasena" type="text" required></div>
                <button type="submit">Registrar</button>
                <button><a href="../index.php">Inicio de Sesión</a></button>
                
        </form>
    </div>
           
</body>
</html>
