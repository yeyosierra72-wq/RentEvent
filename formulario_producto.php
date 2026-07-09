<?php
// ==========================================================
// productos.php
// Formulario para registrar productos (tabla `producto`)
// Ajusta el nombre/ruta de tu archivo de conexión si es distinto.
// ==========================================================
require_once 'conexion.php'; // Debe definir $conn = new mysqli(host, user, pass, bd);

$mensaje = '';
$tipoMensaje = ''; // success | danger

// ---------- Procesar el formulario ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fk_categoria = intval($_POST['fk_categoria'] ?? 0);
    $nombre       = trim($_POST['nombre'] ?? '');
    $descripcion  = trim($_POST['descripcion'] ?? '');
    $precio_renta = $_POST['precio_renta'] ?? 0;
    $existencia   = intval($_POST['existencia'] ?? 0);
    $imagenNombre = null;

    // Validaciones básicas
    if ($fk_categoria <= 0 || $nombre === '' || $precio_renta === '' || $existencia < 0) {
        $mensaje = 'Por favor completa todos los campos obligatorios correctamente.';
        $tipoMensaje = 'danger';
    } else {

        // ---------- Manejo de la imagen (opcional) ----------
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

            $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];
            $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));

            if (in_array($extension, $extensionesPermitidas)) {
                $carpetaDestino = 'uploads/productos/';
                if (!is_dir($carpetaDestino)) {
                    mkdir($carpetaDestino, 0755, true);
                }

                $imagenNombre = uniqid('prod_') . '.' . $extension;
                $rutaDestino  = $carpetaDestino . $imagenNombre;

                if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
                    $imagenNombre = null;
                    $mensaje = 'No se pudo guardar la imagen, pero se intentará registrar el producto.';
                    $tipoMensaje = 'warning';
                }
            } else {
                $mensaje = 'Formato de imagen no permitido (usa jpg, jpeg, png o webp).';
                $tipoMensaje = 'danger';
            }
        }

        // ---------- Insertar en la base de datos ----------
        if ($tipoMensaje !== 'danger') {
            $stmt = $conn->prepare(
                "INSERT INTO producto (nombre, descripcion, precio_renta, existencia, imagen)
                 VALUES (?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param(
                'issdis',
                
                $nombre,
                $descripcion,
                $precio_renta,
                $existencia,
                $imagenNombre
            );

            if ($stmt->execute()) {
                $mensaje = 'Producto registrado correctamente.';
                $tipoMensaje = 'success';
            } else {
                $mensaje = 'Error al registrar el producto: ' . $stmt->error;
                $tipoMensaje = 'danger';
            }
            $stmt->close();
        }
    }
}

// ---------- Obtener categorías para el <select> ----------
$categorias = [];
$resultCategorias = $conn->query("SELECT pk_categoria, nombre FROM categoria ORDER BY nombre");
if ($resultCategorias) {
    while ($fila = $resultCategorias->fetch_assoc()) {
        $categorias[] = $fila;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto | Sistema de Rentas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <style>
        :root {
            --brand-pink: #ff4d94;
            --brand-purple: #7b2ff7;
            --brand-orange: #ffb703;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background-image:
                linear-gradient(180deg, rgba(30, 10, 40, 0.75), rgba(30, 10, 40, 0.85)),
                url('https://images.unsplash.com/photo-1770805001834-f9ccd734c6fb?fm=jpg&q=80&w=1920&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .form-wrapper {
            padding: 3rem 1rem;
        }

        .form-card {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35);
        }

        .form-card h2 {
            font-weight: 800;
            color: var(--brand-purple);
        }

        .form-card .subtitle {
            color: #777;
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #4a1f6f;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--brand-pink);
            box-shadow: 0 0 0 .2rem rgba(255, 77, 148, .18);
        }

        .btn-brand {
            background: linear-gradient(135deg, var(--brand-pink), var(--brand-purple));
            border: none;
            color: #fff;
            font-weight: 600;
            padding: .7rem 2rem;
            border-radius: 50px;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn-brand:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(123, 47, 247, 0.35);
            color: #fff;
        }

        .btn-secondary-outline {
            border: 2px solid var(--brand-purple);
            color: var(--brand-purple);
            font-weight: 600;
            padding: .7rem 2rem;
            border-radius: 50px;
            background: transparent;
        }

        .btn-secondary-outline:hover {
            background: var(--brand-purple);
            color: #fff;
        }

        .preview-imagen {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
            border-radius: 12px;
            margin-top: .75rem;
            display: none;
        }

        footer {
            background: #1e0a28;
            color: #eee2f5;
            padding: 1.2rem 0;
            text-align: center;
            font-size: .85rem;
        }
    </style>
</head>
<body class="d-flex flex-column">

    <?php if (file_exists('menu.php')) { include 'menu.php'; } ?>

    <div class="form-wrapper flex-grow-1 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                    <div class="form-card">
                        <h2 class="text-center">🎉 Registrar Producto</h2>
                        <p class="subtitle text-center">Agrega artículos para renta de fiestas a tu catálogo</p>

                        <?php if ($mensaje): ?>
                            <div class="alert alert-<?= htmlspecialchars($tipoMensaje) ?>" role="alert">
                                <?= htmlspecialchars($mensaje) ?>
                            </div>
                        <?php endif; ?>

                        <form action="guardar_producto.php" method="POST" enctype="multipart/form-data" novalidate>

                            <div class="mb-3">
                                <label for="fk_categoria" class="form-label">Categoría *</label>
                                <select class="form-select" id="fk_categoria" name="fk_categoria" required>
                                    <option value="" selected disabled>Selecciona una categoría</option>
                                    <?php foreach ($categorias as $cat): ?>
                                        <option value="<?= (int) $cat['pk_categoria'] ?>"
                                            <?= (isset($_POST['fk_categoria']) && $_POST['fk_categoria'] == $cat['pk_categoria']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($cat['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (empty($categorias)): ?>
                                    <div class="form-text text-danger">No hay categorías registradas todavía.</div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del producto *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" maxlength="150"
                                       placeholder="Ej. Mesa redonda para 8 personas" required
                                       value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                                          placeholder="Detalles, medidas, color, condiciones de uso..."><?= htmlspecialchars($_POST['descripcion'] ?? '') ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="precio_renta" class="form-label">Precio de renta *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="precio_renta" name="precio_renta"
                                               step="0.01" min="0" placeholder="0.00" required
                                               value="<?= htmlspecialchars($_POST['precio_renta'] ?? '') ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="existencia" class="form-label">Existencia *</label>
                                    <input type="number" class="form-control" id="existencia" name="existencia"
                                           min="0" step="1" placeholder="Cantidad disponible" required
                                           value="<?= htmlspecialchars($_POST['existencia'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="imagen" class="form-label">Imagen del producto</label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept=".jpg,.jpeg,.png,.webp">
                                <div class="form-text">Formatos permitidos: jpg, jpeg, png, webp.</div>
                                <img id="previewImagen" class="preview-imagen" alt="Vista previa">
                            </div>

                            <div class="d-flex justify-content-between mt-4 flex-wrap gap-2">
                                <a href="index.php" class="btn btn-secondary-outline">Cancelar</a>
                                <button type="submit" class="btn btn-brand">Guardar producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Sistema de Rentas para Fiestas. Todos los derechos reservados.
    </footer>

    <script>
        // Vista previa de la imagen seleccionada
        document.getElementById('imagen').addEventListener('change', function (e) {
            const preview = document.getElementById('previewImagen');
            const archivo = e.target.files[0];
            if (archivo) {
                const url = URL.createObjectURL(archivo);
                preview.src = url;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
</body>
</html>