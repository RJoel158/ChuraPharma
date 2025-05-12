<?php
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/stylesCRUD.css">
</head>
<body class="container mt-5 d-flex justify-content-center align-items-center">
    <div>
        <div class="box d-flex justify-content-between align-items-center mb-3">
            <h2>Registrar Nuevo Producto</h2>
            <a id="btnBack" href="dashboard.php" class="btn">Volver</a>
        </div>
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
                
                <!-- <form action="save.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label>Nombre:</label>
                            <input type="text" name="p_nombre" class="form-control" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label>Precio:</label>
                            <input type="number" name="p_precioActual" class="form-control" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label>Stock:</label>
                            <input type="number" name="p_stock" class="form-control" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label>Unidad de Medida:</label>
                            <select name="p_unidadMedida" id="" required class="form-select">
                                <option value="">Seleccionar</option>
                                <option value="kg">Kilogramos</option>
                                <option value="g">Gramos</option>
                                <option value="mg">Miligramos</option>
                                <option value="l">Litros</option>
                                <option value="ml">Mililitros</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Imagen:</label>
                            <input type="file" name="p_imagen" class="form-control" required>
                        </div>
                        <button type="submit" class="btn">Registrar</button>
                    </div>
                </form> -->
            </div>
        </div>
    </div>
</body>
</html>