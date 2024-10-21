<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDD - Registro de usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/styles/registrar.css">
</head>
<body>

<main class="d-flex align-items-center justify-content-center min-vh-100">
    <section class="container p-4 rounded shadow-sm bg-white border" style="max-width: 800px;">
        <h3 class="text-center mb-4">Registro de usuario</h3>
        <form action="registrar.php" method="post" class="row g-3">
            <div class="col-md-6 col-sm-12">
                <label for="nombres" class="form-label">Nombres</label>
                <input name="nombres" type="text" class="form-control" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
                <input name="apellidoPaterno" type="text" class="form-control" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
                <input name="apellidoMaterno" type="text" class="form-control" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="grado" class="form-label">Grado de estudio</label>
                <input name="grado" type="text" class="form-control" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="curp" class="form-label">CURP</label>
                <input name="curp" type="text" class="form-control" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="sexo" class="form-label">Sexo</label>
                <input name="sexo" type="text" class="form-control" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="rfc" class="form-label">RFC</label>
                <input name="rfc" type="text" class="form-control" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="celular" class="form-label">Celular</label>
                <input name="celular" type="text" class="form-control">
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="escuela" class="form-label">Escuela o facultad</label>
                <input name="escuela" type="text" class="form-control" value="Instituto Tecnológico de Lázaro Cárdenas" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                <input name="nacionalidad" type="text" class="form-control">
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="pais" class="form-label">País</label>
                <input name="pais" type="text" class="form-control">
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="nivelEducativo" class="form-label">Nivel Educativo</label>
                <input name="nivelEducativo" type="text" class="form-control">
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input name="correo" type="email" class="form-control" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="usuario" class="form-label">Usuario</label>
                <input name="usuario" type="text" class="form-control" required>
            </div>
            <div class="col-md-12">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input name="contrasena" type="password" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary">Registrar</button>
                <a href="../index.php" class="btn btn-outline-secondary">Inicio de Sesión</a>
            </div>
        </form>
    </section>
</main>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
