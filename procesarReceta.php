<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capturar datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $categoria = htmlspecialchars($_POST['categoria']);
    $dificultad = htmlspecialchars($_POST['dificultad']);
    $tiempo = htmlspecialchars($_POST['tiempo']);
    $ingredientes = nl2br(htmlspecialchars($_POST['ingredientes']));
    $preparacion = nl2br(htmlspecialchars($_POST['preparacion']));
    $email = htmlspecialchars($_POST['email']);
    $fecha = htmlspecialchars($_POST['fecha']);

    $etiquetas = isset($_POST['etiquetas']) ? implode(", ", $_POST['etiquetas']) : "Sin etiquetas";

    // Subida de imagen
    $directorio = "uploads/";
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }
    // Procesar imagen si se ha subido
    $ruta_imagen = "";
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $nombre_archivo = time() . "_" . basename($_FILES["imagen"]["name"]);
        $ruta_imagen = $directorio . $nombre_archivo;
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_imagen);
    }

    // Mostrar resultado
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Receta registrada - $nombre</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #fff8f0;
                color: #2d3436;
                padding: 40px;
                line-height: 1.6;
            }
            .receta {
                background: white;
                padding: 30px;
                border-radius: 16px;
                max-width: 800px;
                margin: 0 auto;
                box-shadow: 0 8px 24px rgba(255, 107, 53, 0.15);
                border: 2px solid #ffe4d6;
            }
            h1 {
                color: #ff6b35;
                text-align: center;
                margin-bottom: 20px;
            }
            img {
                width: 100%;
                max-height: 400px;
                object-fit: cover;
                border-radius: 12px;
                margin-bottom: 20px;
            }
            .info {
                font-weight: 600;
                color: #636e72;
            }
            .footer {
                text-align: center;
                margin-top: 40px;
                font-size: 13px;
                color: #b2bec3;
            }
        </style>
    </head>
    <body>
        <div class='receta'>
            <h1>$nombre</h1>";

    if ($ruta_imagen) {
        echo "<img src='$ruta_imagen' alt='Imagen de $nombre'>";
    }
    // Mostrar en pantalla los detalles de la receta
    echo "
            <p class='info'><strong>Categoría:</strong> $categoria | <strong>Dificultad:</strong> $dificultad | <strong>Tiempo:</strong> $tiempo min</p>
            <p class='info'><strong>Etiquetas:</strong> $etiquetas</p>
            <h3>Descripción:</h3>
            <p>$descripcion</p>
            <h3>Ingredientes:</h3>
            <p>$ingredientes</p>
            <h3>Preparación:</h3>
            <p>$preparacion</p>
            <p><strong>Autor:</strong> $email</p>
            <p><strong>Fecha de publicación:</strong> $fecha</p>
            <div style='text-align: center; margin-top: 30px;'>
                <a href='index.html' style='
                    background-color: #ff6b35;
                    color: white;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 8px;
                    font-weight: bold;
                '>Regresar</a>
        </div>
        <p class='footer'>🍽️ Tu receta ha sido registrada correctamente.</p>
    </body>
    </html>";
}
