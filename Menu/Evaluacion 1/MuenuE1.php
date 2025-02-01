<?php
include '../../Login/auth.php'; // Protege la página
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enlaces a Interfaces</title>


  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Menu 1.css">
</head>
<body>
  <div class="content-box">
    <h1 class="text-center mb-5 mt-3">1. LA DEDICACIÓN EN LAS ACTIVIDADES DE LA DOCENCIA</h1>
    <div class="list-group text-center">
      
      <div class="dropdown mb-3">
        <button class="btn dropdown-toggle list-group-item list-group-item-action btn btn-success" type="button" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          1.1 PROMOCIÓN CON EL APRENDIZAJE 200
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown1">
        <a class="dropdown-item" href="1.1/1.1View.php">Subir Documentación</a>
          <a class="dropdown-item" href="1.1/formulario/Form.php">Realizar Formulario</a>
        </div>
      </div>
      
      <div class="dropdown mb-3">
        <button class="btn dropdown-toggle list-group-item list-group-item-action btn-info" type="button" id="dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          1.2 APOYO A LA DOCENCIA 150
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown1">
          <a class="dropdown-item" href="1.2/1.2View.php">Subir Documentación</a>
          <a class="dropdown-item" href="1.2/1.2View.php">Realizar Formulario</a>
        </div>
      </div>

      <div class="dropdown mb-3">
        <button class="btn dropdown-toggle list-group-item list-group-item-action btn-info" type="button" id="dropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          1.3 ASESORÍA PARA TITULACIÓN INTEGRAL O DIRECCIÓN DE TESIS 100
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown1">
          <a class="dropdown-item" href="1.3/1.3View.php">Subir Documentación</a>
          <a class="dropdown-item" href="1.3/1.3.html">Realizar Formulario</a>
        </div>
      </div>

      <div class="dropdown mb-3">
        <button class="btn dropdown-toggle list-group-item list-group-item-action btn btn-warning mb-3" type="button" id="dropdown4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          1.4 ACTIVIDADES ACADÉMICAS 150
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown1">
          <a class="dropdown-item" href="1.4/1.4View.php">Subir Documentación</a>
          <a class="dropdown-item" href="1.4/1.4.html">Realizar Formulario</a>
        </div>
      </div>
      
    </div>

    <div class="text-center mt-4">
      <a href="../Menu.php" class="btn btn-light btn-link-style">Volver</a>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</body>
</html>
