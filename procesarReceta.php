<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capturar datos del formulario
    $nombre       = htmlspecialchars($_POST['nombre']);
    $descripcion  = htmlspecialchars($_POST['descripcion']);
    $categoria    = htmlspecialchars($_POST['categoria']);
    $dificultad   = htmlspecialchars($_POST['dificultad']);
    $tiempo       = htmlspecialchars($_POST['tiempo']);
    $ingredientes = nl2br(htmlspecialchars($_POST['ingredientes']));
    $preparacion  = nl2br(htmlspecialchars($_POST['preparacion']));
    $email        = htmlspecialchars($_POST['email']);
    $fecha        = htmlspecialchars($_POST['fecha']);
    $etiquetas    = isset($_POST['etiquetas']) ? implode(", ", $_POST['etiquetas']) : "Sin etiquetas";

    // Subida de imagen
    $directorio = "uploads/";
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }
    $ruta_imagen = "";
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $nombre_archivo = time() . "_" . basename($_FILES["imagen"]["name"]);
        $ruta_imagen = $directorio . $nombre_archivo;
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_imagen);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receta registrada - <?= $nombre ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-warning text-white text-center py-4">
                    <h1 class="mb-0 fw-bold"><?= $nombre ?></h1>
                </div>

                <div class="card-body p-5">

                    <?php if ($ruta_imagen): ?>
                        <img src="<?= $ruta_imagen ?>" class="w-100 rounded-4 shadow-sm mb-4" style="max-height: 420px; object-fit: cover;" alt="<?= $nombre ?>">
                    <?php endif; ?>

                    <div class="row text-muted small mb-4">
                        <div class="col-md-4"><strong>Categoría:</strong> <?= $categoria ?></div>
                        <div class="col-md-4"><strong>Dificultad:</strong> <span class="badge bg-warning"><?= $dificultad ?></span></div>
                        <div class="col-md-4"><strong>Tiempo:</strong> <?= $tiempo ?> min</div>
                    </div>

                    <?php if ($etiquetas !== "Sin etiquetas"): ?>
                        <p class="mb-4">
                            <strong>Etiquetas:</strong>
                            <span class="text-muted"><?= $etiquetas ?></span>
                        </p>
                    <?php endif; ?>

                    <hr class="my-4">

                    <h4 class="fw-bold text-warning mb-3">Descripción</h4>
                    <p class="lead"><?= nl2br($descripcion) ?></p>

                    <h4 class="fw-bold text-warning mb-3 mt-5">Ingredientes</h4>
                    <div class="bg-light p-4 rounded-3 mb-4">
                        <?= $ingredientes ?>
                    </div>

                    <h4 class="fw-bold text-warning mb-3 mt-5">Preparación</h4>
                    <div class="bg-light p-4 rounded-3 mb-4">
                        <?= $preparacion ?>
                    </div>

                    <div class="row mt-5 text-muted small">
                        <div class="col-md-6"><strong>Autor:</strong> <?= $email ?></div>
                        <div class="col-md-6"><strong>Fecha:</strong> <?= date('d/m/Y', strtotime($fecha)) ?></div>
                    </div>

                    <div class="text-center mt-5">
                        <a href="index.html" class="btn btn-warning btn-lg px-5 shadow">
                            Volver al inicio
                        </a>
                    </div>

                    <div class="text-center mt-4 text-success fw-bold">
                        Tu receta ha sido registrada correctamente.
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php } ?>