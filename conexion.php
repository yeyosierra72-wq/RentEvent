<?php  //inicia php

//Datos de conexion a la base de datos

$servidor = "localhost"; //servidor de la base de datos
$usuario = "root"; //usuario de la base de datos
$contrasena = ""; //contraseña de la base de datos
$bases_datos = "rentevent"; //nombre de la base de datos

//creamos la conexion a la base de datos
$conn = new mysqli($servidor, $usuario, $contrasena, $bases_datos);
//New mysqli es una clase de PHP que se utiliza para crear una conexión a una base de datos MySQL.
//que es una clase: Una clase es una plantilla o un molde que define las propiedades y comportamientos de un objeto.

//verificamos la conexion a la base de datos`
if ($conn -> connect_error) { //si la conexion falla
    die("Conexion fallida: " . $conn -> connect_error); //muestra un mensaje de error y termina la ejecucion del script
} 


?> <!--termina php-->