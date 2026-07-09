<?php

include 'conexion.php';

$sql = "SELECT * FROM cliente";

$resultado = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <style>
        /* Estilos personalizados para mejorar la legibilidad en adultos */
        body {
            font-size: 1.1rem; /* Letra un poco más grande que el estándar */
            background-color: #f4f6f9;
        }
        .table th {
            font-size: 1.15rem;
            letter-spacing: 0.5px;
            background-color: #1e3a8a !important; /* Azul marino elegante */
            color: #ffffff !important;
            padding: 15px 10px !important;
        }
        .table td {
            padding: 18px 10px !important; /* Filas más espaciadas para facilitar la lectura */
            vertical-align: middle;
        }
        .titulo-principal {
            background-color: #ffffff;
            border-left: 6px solid #1e3a8a; /* Detalle visual elegante a la izquierda */
            font-weight: 700;
            color: #1e3a8a;
        }
        .icono-dato {
            font-size: 1.25rem;
            margin-right: 8px;
            color: #4b5563;
        }
    </style>
</head>
<body>
     <?php include 'menu.php'; ?>

    <div class="container mt-5">
        <div class="titulo-principal p-4 shadow-sm rounded mb-4 d-flex align-items-center justify-content-between">
            <h1 class="m-0 h2"><i class="bi bi-people-fill text-primary me-2"></i> Listado de Clientes Activos</h1>
            <span class="badge bg-success p-2 fs-6"><i class="bi bi-shield-check me-1"></i> Vista de Empleados</span>
        </div>

        <div class="card shadow border-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 10%;">Código</th>
                            <th scope="col" style="width: 35%;">Nombre Completo</th>
                            <th scope="col" style="width: 25%;">Teléfono de Contacto</th>
                            <th scope="col" style="width: 30%;">Correo Electrónico</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                    while ($fila = $resultado->fetch_assoc()){
                        ?>
                        <tr>
                            <td class="text-center fw-bold text-secondary bg-light">
                                #<?php echo $fila['pk_cliente']; ?>
                            </td>
                            
                            <td class="fw-bold text-dark">
                                <?php echo $fila['nombre']; ?>
                            </td>
                            
                            <td>
                                <?php if (!empty($fila['telefono'])): ?>
                                    <i class="bi bi-telephone-fill icono-dato text-success"></i>
                                    <span class="fw-semibold"><?php echo $fila['telefono']; ?></span>
                                <?php else: ?>
                                    <span class="text-muted fs-6 shadow-sm px-2 py-1 bg-body-secondary rounded">
                                        <i class="bi bi-slash-circle me-1"></i>No disponible
                                    </span>
                                <?php endif; ?>
                            </td>
                            
                            <td>
                                <?php if (!empty($fila['correo'])): ?>
                                    <i class="bi bi-envelope-fill icono-dato text-primary"></i>
                                    <a href="mailto:<?php echo $fila['correo']; ?>" class="text-decoration-none text-primary fw-semibold">
                                        <?php echo $fila['correo']; ?>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted fs-6 shadow-sm px-2 py-1 bg-body-secondary rounded">
                                        <i class="bi bi-slash-circle me-1"></i>No disponible
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mb-5"></div> </body>
</html>