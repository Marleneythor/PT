<!DOCTYPE html>
<html lang="es">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>EDD</title>
  <link rel="stylesheet" type="text/css" href="public/styles/login.css">

</head>
<body >

  <main>
    <section>
      <div class="login-form">
        <form method="POST"  action="Login/loginB.php">
          <label for="username">Usuario</label>
          <input type="text" id="username" name="username" placeholder="Ingresa tu nombre de Usuario" required>
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
          <div class="botones">
            <a class="boton" href="register/registrarPage.php">Registrar</a>
            <button type="submit">Iniciar sesion</button>
          </div>

        </form>
      </div>
      
    </section>
  </main>

</body>
</html>