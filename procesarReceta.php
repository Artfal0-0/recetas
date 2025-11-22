<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $directorio = "uploads/";
    if (!is_dir($directorio)) mkdir($directorio, 0777, true);
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
    <title><?= $nombre ?> - Receta guardada</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-10">
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
    <div class="bg-orange-500 text-white text-center py-8">
        <h1 class="text-4xl font-bold"><?= $nombre ?></h1>
    </div>

    <div class="p-8 lg:p-12">

        <?php if ($ruta_imagen): ?>
            <img src="<?= $ruta_imagen ?>" class="w-full max-h-96 object-cover rounded-xl shadow mb-8">
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-gray-600 mb-8">
            <p><strong>Categoría:</strong> <?= $categoria ?></p>
            <p><strong>Dificultad:</strong> <?= $dificultad ?></p>
            <p><strong>Tiempo:</strong> <?= $tiempo ?> min</p>
        </div>

        <?php if ($etiquetas !== "Sin etiquetas"): ?>
            <p class="mb-8"><strong>Etiquetas:</strong> <?= $etiquetas ?></p>
        <?php endif; ?>

        <hr class="my-8">

        <h2 class="text-2xl font-bold mb-4">Descripción</h2>
        <p class="text-lg leading-relaxed mb-8"><?= nl2br($descripcion) ?></p>

        <h2 class="text-2xl font-bold mb-4">Ingredientes</h2>
        <div class="bg-gray-50 p-6 rounded-xl mb-8"><?= $ingredientes ?></div>

        <h2 class="text-2xl font-bold mb-4">Preparación</h2>
        <div class="bg-gray-50 p-6 rounded-xl mb-8"><?= $preparacion ?></div>

        <p class="text-gray-600">Por: <strong><?= $email ?></strong> | Fecha: <strong><?= date('d/m/Y', strtotime($fecha)) ?></strong></p>

        <div class="text-center mt-12">
            <a href="index.html" class="bg-orange-500 text-white font-bold py-4 px-10 rounded-lg text-lg inline-block">Volver al inicio</a>
        </div>

        <div class="text-center mt-8 text-green-600 text-2xl font-bold">
            ¡Tu receta se guardó correctamente!
        </div>
    </div>
</div>
</body>
</html>
<?php } ?>