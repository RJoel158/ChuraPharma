<?php
// index.php
session_start();
require 'db.php'; // ajusta ruta si es necesario

// Consulta productos desde la tabla 'producto'
$stmt = $pdo->query("SELECT id, nombre, precioActual, imagen, unidadMedida, stock FROM producto");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catálogo de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Mi Tienda</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="register.php">Registrarse</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4 text-center">Nuestros Productos</h1>
        <div class="row">
            <?php if (empty($productos)): ?>
                <p class="text-center">No hay productos registrados.</p>
            <?php else: ?>
                <?php foreach ($productos as $prod): ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card h-100">
                            <?php if (!empty($prod['imagen'])): ?>
                                <?php $imgData = base64_encode($prod['imagen']); ?>
                                <img src="data:image/jpeg;base64,<?= $imgData ?>" class="card-img-top" alt="<?= htmlspecialchars($prod['nombre']) ?>">
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($prod['nombre']) ?></h5>
                                <p class="fw-bold">Precio: $<?= number_format($prod['precioActual'], 2) ?> / <?= htmlspecialchars($prod['unidadMedida']) ?></p>
                                <p>Stock: <?= intval($prod['stock']) ?></p>
                                <a href="detalle.php?id=<?= $prod['id'] ?>" class="btn btn-dark mt-auto">Ver detalle</a>
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
