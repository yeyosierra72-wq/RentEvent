<?php
// incluir la conexion de la base de datos
include "conexion.php";

// recibir los datos del formulario
$fk_categoria = intval($_POST['fk_categoria']);
$nombre       = trim($_POST['nombre']);
$descripcion  = trim($_POST['descripcion']);
$precio_renta = trim($_POST['precio_renta']);
$existencia   = intval($_POST['existencia']);
$imagen       = null; // por ahora sin manejo de archivo; ver nota abajo

// preparamos la sentencia para evitar inyección SQL
// 6 columnas -> 6 signos "?"
$sql = $conn->prepare("INSERT INTO producto (fk_categoria, nombre, descripcion, precio_renta, existencia, imagen) VALUES (?, ?, ?, ?, ?, ?)");

// "i s s d i s"  -> fk_categoria(int), nombre(string), descripcion(string),
//                   precio_renta(double), existencia(int), imagen(string)
$sql->bind_param("issdis", $fk_categoria, $nombre, $descripcion, $precio_renta, $existencia, $imagen);

if ($sql->execute()) {
    // Éxito: redirigimos con un parámetro que activa el toast de éxito
    header("Location: formulario_producto.php?status=ok");
} else {
    // Error: redirigimos con el mensaje de error codificado en la URL
    $msg = urlencode($sql->error);
    header("Location: formulario_producto.php?status=error&msg=$msg");
}


$sql->close();
$conn->close(); // Cerramos la conexión
exit;
?>