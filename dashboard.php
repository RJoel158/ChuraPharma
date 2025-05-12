<?php
include 'db.php';

session_start();
// Verifica si la sesión está activa y si la variable 'nombre' está definida
if (!isset($_SESSION['nombre'])) {
    header('Location: credentials/login.php');
    exit();
}

$nombre = $_SESSION['nombre'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/stylesDashboard.css">
</head>
<body class="container my-5">
    <div class="box d-flex justify-content-between align-items-center mb-3">
        <h2>Bienvenido <?php echo htmlspecialchars($nombre); ?></h2>
        <a id="btnLogOut" href="credentials/logout.php" class="btn">Cerrar sesión</a>
    </div>

    <div class="box">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Lista de Usuarios</h3>
            <a href="crud/insert.php" class="btn">Registra Usuario</a>
        </div>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th class="text-center" scope="col">Id</th>
                    <th class="text-center" scope="col">Nombre</th>
                    <th class="text-center" scope="col">Latitud</th>
                    <th class="text-center" scope="col">Longitud</th>
                    <th class="text-center" scope="col">Rol</th>
                    <th class="text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr>
                    <th class="text-center align-middle" scope="row">1</th>
                    <td class="text-center align-middle">Leche Pil</td>
                    <td class="text-center align-middle">7</td>
                    <td class="d-flex justify-content-center"><img class="image-profile" src="" alt=""></td>
                    <td class="text-center align-middle">Mililitros</td>
                    <td class="text-center align-middle">10</td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <a href="update.php?id" class="btn btnUpdate">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="delete.php?id" class="btn btnDelete">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr> -->
                <?php
                include 'db.php';
                // Conexión a la base de datos
                $query = "SELECT id, nombre, latitud, longitud, rol FROM usuario";
                $stmt = $pdo->query($query);

                // Verifica si hay resultados
                if ($stmt->rowCount() > 0) {
                    // Itera sobre cada fila de resultados
                    foreach ($stmt as $row) {
                        echo "<tr>";
                        echo "<th class='text-center align-middle' scope='row'>" . htmlspecialchars($row['id']) . "</th>";
                        echo "<td class='text-center align-middle'>" . htmlspecialchars($row['nombre']) . "</td>";
                        echo "<td class='text-center align-middle'>" . htmlspecialchars($row['latitud']) . "</td>";
                        echo "<td class='text-center align-middle'>" . htmlspecialchars($row['longitud']) . "</td>";
                        echo "<td class='text-center align-middle'>" . htmlspecialchars($row['rol']) . "</td>";
                        echo "<td class='text-center align-middle'>
                                <div class='d-flex justify-content-center'>
                                    <a href='crud/update.php?id=" . htmlspecialchars($row['id']) . "' class='btn btnUpdate'>
                                        <i class='bi bi-pencil-square'></i>
                                    </a>
                                    <a  href='crud/delete.php?id=" . htmlspecialchars($row['id']) . "' class='btn btnDelete'>
                                        <i class='bi bi-trash'></i>
                                    </a>
                                </div>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No hay productos disponibles</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
