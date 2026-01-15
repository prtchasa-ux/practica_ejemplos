<?php
header('Content-Type: application/json; charset=utf-8');

// Obtener el parámetro de búsqueda
$busqueda = isset($_GET['nombre']) ? $_GET['nombre'] : '';

// Leer el archivo JSON
$jsonData = file_get_contents('datos.json');
$lugares = json_decode($jsonData, true);

// Si no hay búsqueda, devolver todo
if (empty($busqueda)) {
    echo json_encode($lugares);
    exit;
}

// Filtrar por nombre (búsqueda parcial, case-insensitive)
$resultados = array_filter($lugares, function($lugar) use ($busqueda) {
    return stripos($lugar['nombre'], $busqueda) !== false;
});

// Resetear índices del array
$resultados = array_values($resultados);

// Devolver resultados
echo json_encode($resultados);
?>