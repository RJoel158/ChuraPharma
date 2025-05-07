<?php
session_start();
require '../db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $contrasenia = $_POST['contrasenia'];

    $stmt = $pdo->prepare("SELECT id, contrasenia FROM usuario WHERE nombre = ?");
    $stmt->execute([$nombre]);
    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($contrasenia, $user['contrasenia'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['nombre'] = $nombre;
            header('Location: ../dashboard.php');
            exit();
        } else {
            echo "Contraseña incorrecta.";
            $error = 'Contraseña incorrecta.';
        }
    } else {
        $error = 'Usuario no encontrado.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="container mt-5 d-flex justify-content-center align-items-center">
    <div>
        <h2>Iniciar Sesión</h2>
        <div class="card mb-3">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="contrasenia" class="form-control" required>
                    </div>
                    <button type="submit" class="btn">Iniciar Sesión</button>
                </form>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h5 class="p-0 m-0">¿No tienes cuenta?</h5>
                    <a href="../credentials/register.php" class="btn btn-link p-0 m-0">Regístrate aquí</a>
                </div>
            </div>
        </div>
        <!-- Mensaje de error: -->
        <!-- <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?> -->
    </div>
</body>
</html>