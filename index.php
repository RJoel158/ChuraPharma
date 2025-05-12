<?php
// index.php
session_start();
require 'db.php'; // Asegúrate de que esta ruta es correcta

// Consulta productos desde la tabla 'producto'
$stmt = $pdo->query("SELECT id, nombre, precioActual, imagen, unidadMedida, stock FROM producto");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Catálogo de Productos - ChuraPharma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <style>
    /* Si prefieres, mueve esto a css/styles.css */
    .img-fit {
      object-fit: cover;
      width: 100%;
      height: 100%;
    }
    .card-img-container {
      height: 200px;
      overflow: hidden;
    }
  </style>
</head>
<body class="bg-light">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">ChuraPharma</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="credentials/register.php">Registrarse</a></li>
          <li class="nav-item"><a class="nav-link" href="credentials/login.php">Iniciar Sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <h1 class="mb-4 text-center text-primary">Nuestros Productos</h1>

    <div id="resultado" class="row g-4 pb-5">
      <?php if (empty($productos)): ?>
        <p class="text-center text-secondary">No hay productos registrados.</p>
      <?php else: ?>
        <?php foreach ($productos as $prod): ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm">
              <?php if (!empty($prod['imagen'])): ?>
                <?php $imgData = base64_encode($prod['imagen']); ?>
                <div class="card-img-container">
                  <img src="data:image/jpeg;base64,<?= $imgData ?>"
                       class="card-img-top img-fit"
                       alt="<?= htmlspecialchars($prod['nombre'], ENT_QUOTES) ?>">
                </div>
              <?php endif; ?>
              <div class="card-body d-flex flex-column">
                <h5 class="card-title text-dark fw-semibold">
                  <?= htmlspecialchars($prod['nombre'], ENT_QUOTES) ?>
                </h5>
                <p class="fw-bold text-success mb-1">
                  Precio: $<?= number_format($prod['precioActual'], 2) ?> /
                  <?= htmlspecialchars($prod['unidadMedida'], ENT_QUOTES) ?>
                </p>
                <p class="text-muted mb-3">
                  Stock: <?= intval($prod['stock']) ?>
                </p>
                <a href="detalle.php?id=<?= intval($prod['id']) ?>"
                   class="btn btn-outline-primary mt-auto">
                  Ver detalle
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
