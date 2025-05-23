<?php
    include '../db.php'; // Asegúrate de que 'db.php' configure correctamente la conexión PDO

    $id = $_GET['id'];

    try {
        // Consulta para obtener el registro del producto por el id
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Recuperar el producto
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica si el producto fue encontrado
        if (!$producto) {
            echo "Usuario no encontrado.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/stylesCRUD.css">
</head>
<body class="container mt-5 d-flex justify-content-center align-items-center">
    <div>
        <div class="box d-flex justify-content-between align-items-center mb-3">
            <h2>Modificar Producto</h2>
            <a id="btnBack" href="../dashboard.php" class="btn">Volver</a>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <form action="edit.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden"  name="pr_id" value="<?php echo htmlspecialchars($producto['id']); ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <label>Nombre:</label>
                            <input type="text" name="pr_nombre" class="form-control" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label>Latitud:</label>
                            <input type="number" name="pr_precioActual" class="form-control" value="<?php echo htmlspecialchars($producto['latitud']); ?>" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label>Longitud:</label>
                            <input type="number" name="pr_stock" class="form-control" value="<?php echo htmlspecialchars($producto['longitud']); ?>" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label>Rol:</label>
                            <select name="pr_unidadMedida" required class="form-select">
                                <option value="administrador" <?php echo ($producto['rol'] == 'administrador') ? 'selected' : ''; ?>>Administrador</option>
                                <option value="cliente" <?php echo ($producto['rol'] == 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
