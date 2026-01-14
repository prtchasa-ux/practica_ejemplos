<?php

if (!isset($_POST["nombre"])) {
    die("No se recibió el nombre");
}

$nombre = trim($_POST["nombre"]);

if ($nombre === "") {
    die("Nombre vacío");
}

// Escapar argumento
$nombre_escapado = escapeshellarg($nombre);

// Rutas
$python = "/usr/bin/python3"; // puede variar
$script = __DIR__ . "/python/buscar_persona.py";

// Ejecutar
$comando = "$python $script $nombre_escapado";
$salida = shell_exec($comando);

if ($salida === null) {
    die("Error ejecutando Python");
}

// Decodificar respuesta
$respuesta = json_decode($salida, true);

if (isset($respuesta["error"])) {
    die("Error Python: " . $respuesta["error"]);
}

// Mostrar resultado
if ($respuesta["encontrado"]) {
    echo "Persona encontrada:<br>";
    echo "Nombre: " . htmlspecialchars($respuesta["nombre"]) . "<br>";
    echo "Edad: " . $respuesta["edad"];
} else {
    echo "Persona no encontrada";
}