<?php
    include '../db.php';

    $nombre = $_POST['p_nombre'];
    $precioActual = $_POST['p_precioActual'];
    $unidadMedida = $_POST['p_unidadMedida'];
    $stock = $_POST['p_stock'];

    // Validar la imagen
    if (isset($_FILES['p_imagen']) && $_FILES['p_imagen']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['p_imagen']['tmp_name'];
        $fileName = $_FILES['p_imagen']['name'];
        $fileSize = $_FILES['p_imagen']['size'];
        $fileType = $_FILES['p_imagen']['type'];

        // Extensiones permitidas
        $allowedExtensions = ['png', 'jpeg', 'jpg'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            // Limitar el tamaño de la imagen (por ejemplo, 2MB)
            if ($fileSize <= 2 * 1024 * 1024) {
                // Leer el contenido del archivo
                $imagen = file_get_contents($fileTmpPath);

                // Insertar en la base de datos
                $query = "INSERT INTO producto (nombre, precioActual, imagen, unidadMedida, stock) VALUES (:nombre, :precioActual, :imagen, :unidadMedida, :stock)";
                $stmt = $pdo->prepare($query); // Cambiado $dsn por $pdo
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':precioActual', $precioActual);
                $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
                $stmt->bindParam(':unidadMedida', $unidadMedida);
                $stmt->bindParam(':stock', $stock);

                if ($stmt->execute()) {
                    header("Location: ../dashboard.php");
                    exit;
                } else {
                    echo "Error al insertar el registro.";
                }
            } else {
                echo "El tamaño de la imagen excede el límite permitido (2MB).";
            }
        } else {
            echo "Formato de imagen no permitido. Solo se aceptan .png, .jpeg, .jpg.";
        }
    } else {
        echo "Error al subir la imagen.";
    }
?>