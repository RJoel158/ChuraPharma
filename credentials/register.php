<?php
session_start();
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $latitude = $_POST['latitud'];
    $longitude = $_POST['longitud'];
    $rol = 'cliente';
    $confirm  = $_POST['confirm'];

    if (strlen($password) < 8 || $password !== $confirm) {
        $error = 'Contraseña no válida o no coincide.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM usuario WHERE nombre = ?");
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            $error = 'El nombre de usuario ya existe.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuario (nombre, contrasenia, latitud, longitud, rol) VALUES (?, ?, ?, ?, ?)");
            if (!isset($error)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare(
                    "INSERT INTO usuario (nombre, contrasenia, latitud, longitud, rol) 
                     VALUES (?, ?, ?, ?, ?)"
                );
                $stmt->execute([
                    $username,
                    $hash,
                    $latitude,
                    $longitude,
                    $rol
                ]);
                header('Location: login.php');
                exit();
            }
            header('Location: login.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">

    <!-- mapa -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body class="container mt-5 d-flex justify-content-center align-items-center">
    <div>
        <h2>Registrarse</h2>
        <div class="card mb-3">
            <div class="card-body">
                <form method="POST" onsubmit="return validateForm()">
                    <div class="mb-3">
                        <label>Usuario</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Confirmar contraseña</label>
                        <input type="password" name="confirm" class="form-control" required>
                    </div>
                    <button type="submit" class="btn">Registrar</button>

                    <div class="mb-3">
                        <label class="form-label">Ubicación en el mapa:</label>
                        <div id="map" style="height: 300px; border-radius: 10px;"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="latitud" class="form-label">Latitud:</label>
                            <input type="text" name="latitud" id="latitud" class="form-control" readonly required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="longitud" class="form-label">Longitud:</label>
                            <input type="text" name="longitud" id="longitud" class="form-control" readonly required>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h5 class="p-0 m-0">¿Ya tienes una cuenta?</h5>
                    <a href="login.php" class="btn btn-link p-0 m-0">Iniciar Sesión</a>
                </div>
            </div>
        </div>

        <!-- Mensaje de error: -->
        <!-- <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?> -->

    <script>
        const map = L.map('map').setView([-17.7833, -63.1821], 13); // Coordenadas iniciales (Santa Cruz)

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let marker;

        map.on('click', function(e) {
            const { lat, lng } = e.latlng;

            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }

            document.getElementById('latitud').value = lat.toFixed(6);
            document.getElementById('longitud').value = lng.toFixed(6);
        });
    </script>


    <script src="js/validation.js"></script>
</body>
</html>