<?php
session_start();
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
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
            $stmt = $pdo->prepare("INSERT INTO usuario (nombre, contrasenia) VALUES (?, ?)");
            $stmt->execute([$username, $hash]);
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
    </div>

    <script src="js/validation.js"></script>
</body>
</html>