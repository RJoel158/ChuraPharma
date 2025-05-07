<?php
    include '../db.php';

    $id = $_POST['pr_id'];
    $nombre = $_POST['pr_nombre'];
    $precioActual = $_POST['pr_precioActual'];
    $unidadMedida = $_POST['pr_unidadMedida'];
    $stock = $_POST['pr_stock'];

    // Procesamiento de la imagen
    if (isset($_FILES['pr_imagen']) && $_FILES['pr_imagen']['error'] === UPLOAD_ERR_OK) {
        // Imagen nueva subida
        $imagenTmp = $_FILES['pr_imagen']['tmp_name'];
        $imagenNombre = $_FILES['pr_imagen']['name'];
        $imagenExtension = pathinfo($imagenNombre, PATHINFO_EXTENSION);

        // Extensiones permitidas
        $allowedExtensions = ['png', 'jpeg', 'jpg'];
        if (in_array(strtolower($imagenExtension), $allowedExtensions)) {
            // Limitar el tamaño de la imagen a 2MB
            $maxSize = 2 * 1024 * 1024; // 2MB
            if ($_FILES['pr_imagen']['size'] <= $maxSize) {
                // Leer el contenido del archivo
                $imagen = file_get_contents($imagenTmp);

                try {
                    // Actualizar producto en la base de datos con la nueva imagen
                    $stmt = $pdo->prepare("UPDATE producto SET 
                        nombre = :nombre,
                        precioActual = :precioActual,
                        imagen = :imagen,
                        unidadMedida = :unidadMedida,
                        stock = :stock
                        WHERE id = :id");

                    $stmt->bindParam(':nombre', $nombre);
                    $stmt->bindParam(':precioActual', $precioActual);
                    $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
                    $stmt->bindParam(':unidadMedida', $unidadMedida);
                    $stmt->bindParam(':stock', $stock);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                    $stmt->execute();

                    header("Location: ../dashboard.php");
                    exit;
                } catch (PDOException $e) {
                    echo "Error al actualizar: " . $e->getMessage();
                }
            } else {
                echo "El tamaño de la imagen excede el límite permitido (2MB).";
            }
        } else {
            echo "Formato de imagen no permitido. Solo se aceptan .png, .jpeg, .jpg.";
        }
    } else {
        // No se subió imagen nueva, mantener la imagen existente
        $stmt = $pdo->prepare("SELECT imagen FROM producto WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $existing = $stmt->fetch();
        $imagen = $existing['imagen'];
        
        try {
            // Actualizar producto en la base de datos sin cambiar la imagen
            $stmt = $pdo->prepare("UPDATE producto SET 
                nombre = :nombre,
                precioActual = :precioActual,
                imagen = :imagen,
                unidadMedida = :unidadMedida,
                stock = :stock
                WHERE id = :id");

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':precioActual', $precioActual);
            $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
            $stmt->bindParam(':unidadMedida', $unidadMedida);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            header("Location: ../dashboard.php");
            exit;
        } catch (PDOException $e) {
            echo "Error al actualizar: " . $e->getMessage();
        }
    }
?>
