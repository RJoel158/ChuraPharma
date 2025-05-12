<?php
    include '../db.php'; // Asegúrate de que 'db.php' configure correctamente la conexión PDO

    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM usuario WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: ../dashboard.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>