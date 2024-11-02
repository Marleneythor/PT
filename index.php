<!DOCTYPE html>
<html lang="es">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>EDD - Iniciar sesión</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/styles/login.css">
</head>
<body>

  <main class="d-flex align-items-center justify-content-center vh-100">
    <section class="login-container p-5 rounded shadow-sm" style="max-width: 400px; width: 100%;">
      <h2 class="text-center mb-4">Iniciar sesión</h2>
      <form method="POST" action="Login/loginB.php">
        <div class="mb-3">
          <label for="username" class="form-label">Usuario</label>
          <input type="text" id="username" name="username" class="form-control" placeholder="Ingresa tu nombre de Usuario" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
          <a href="register/registrarPage.php" class="btn btn-outline-secondary">Registrar</a>
          <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </div>
      </form>
    </section>
  </main>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!-- esto es un comentario -->