<?php
require '../db.php';

/* $stmt = $pdo->prepare("UPDATE usuario SET 
nombre = :nombre,
latitud = :precioActual,
rol = :unidadMedida,
longitud = :stock
WHERE id = :id");*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['pr_id'];
    $nombre = $_POST['pr_nombre'];
    $precioActual = $_POST['pr_precioActual'];
    $unidadMedida = $_POST['pr_unidadMedida'];
    $stock = $_POST['pr_stock'];

    try {
        // Actualizar producto en la base de datos sin imagen
        $stmt = $pdo->prepare("UPDATE usuario SET 
            nombre = :nombre,
            latitud = :precioActual,
            rol = :unidadMedida,
            longitud = :stock
            WHERE id = :id");

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':precioActual', $precioActual);
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
