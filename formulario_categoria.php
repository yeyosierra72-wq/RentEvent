<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <style>
        :root{
            --tinta:#1B2A4A;      /* azul tinta, fondo del header */
            --ambar:#E8A33D;      /* acento, color de "etiqueta" */
            --crema:#F7F5F1;      /* fondo de pagina */
            --pizarra:#2D3142;    /* texto principal */
            --teal:#5B8A72;       /* acento secundario, éxito */
        }

        body{
            background: var(--crema);
            font-family: 'Inter', sans-serif;
            color: var(--pizarra);
        }

        h1, .tag-title{
            font-family: 'Sora', sans-serif;
        }

        /* Encabezado tipo "etiqueta colgante" */
        .tag-header{
            background: var(--tinta);
            color: #fff;
            padding: 2.5rem 1rem 4rem;
            position: relative;
            text-align: center;
        }
        .tag-header .eyebrow{
            letter-spacing: .18em;
            text-transform: uppercase;
            font-size: .75rem;
            color: var(--ambar);
            font-weight: 600;
        }
        .tag-header h1{
            font-weight: 800;
            font-size: 2.1rem;
            margin-top: .4rem;
        }

        /* Tarjeta con forma de etiqueta: esquina cortada + "ojal" perforado */
        .tag-card{
            max-width: 560px;
            margin: -3rem auto 3rem;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 20px 45px rgba(27,42,74,.15);
            padding: 2.5rem 2.5rem 2rem;
            position: relative;
            clip-path: polygon(0 0, calc(100% - 34px) 0, 100% 34px, 100% 100%, 0 100%);
        }
        .tag-card::before{
            content:"";
            position:absolute;
            top: 16px; right: 16px;
            width: 14px; height: 14px;
            background: var(--crema);
            border: 2px solid var(--tinta);
            border-radius: 50%;
        }
        .tag-card .linea-punteada{
            border-top: 2px dashed #d8d3c8;
            margin: 1.75rem 0 1.5rem;
        }

        .form-label{
            font-weight: 600;
            color: var(--pizarra);
            font-size: .92rem;
        }
        .form-control{
            border: 1.5px solid #e2ded2;
            border-radius: 10px;
            padding: .7rem .9rem;
        }
        .form-control:focus{
            border-color: var(--ambar);
            box-shadow: 0 0 0 .2rem rgba(232,163,61,.25);
        }

        .btn-registrar{
            background: var(--tinta);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: .75rem 1rem;
            font-weight: 600;
            letter-spacing: .02em;
            transition: transform .15s ease, background .2s ease;
        }
        .btn-registrar:hover{
            background: var(--ambar);
            color: var(--tinta);
            transform: translateY(-1px);
        }

        .ayuda{
            font-size: .82rem;
            color: #8a8578;
        }

        /* Toast tipo "etiqueta" para confirmaciones */
        .toast-etiqueta{
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 1080;
            min-width: 300px;
            max-width: 380px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(27,42,74,.22);
            padding: 1rem 1.1rem;
            display: flex;
            align-items: flex-start;
            gap: .75rem;
            border-left: 6px solid var(--teal);
            transform: translateX(120%);
            opacity: 0;
            transition: transform .4s ease, opacity .4s ease;
        }
        .toast-etiqueta.mostrar{
            transform: translateX(0);
            opacity: 1;
        }
        .toast-etiqueta.error{
            border-left-color: #C1503E;
        }
        .toast-etiqueta .icono{
            width: 34px; height: 34px;
            border-radius: 50%;
            background: var(--teal);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex: none;
        }
        .toast-etiqueta.error .icono{
            background: #C1503E;
        }
        .toast-etiqueta .titulo{
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: .95rem;
            margin-bottom: .15rem;
        }
        .toast-etiqueta .detalle{
            font-size: .82rem;
            color: #6b6a63;
        }
        .toast-etiqueta .cerrar{
            margin-left: auto;
            background: none;
            border: none;
            color: #b7b3a6;
            font-size: 1.1rem;
            line-height: 1;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<?php
$status = $_GET['status'] ?? null;
$msg    = isset($_GET['msg']) ? htmlspecialchars(urldecode($_GET['msg'])) : '';
?>
<?php if ($status === 'ok'): ?>
<div class="toast-etiqueta" id="toast">
    <div class="icono">&#10003;</div>
    <div>
        <div class="titulo">Categoría guardada</div>
        <div class="detalle">El registro se guardó correctamente.</div>
    </div>
    <button class="cerrar" onclick="document.getElementById('toast').remove()">&times;</button>
</div>
<?php elseif ($status === 'error'): ?>
<div class="toast-etiqueta error" id="toast">
    <div class="icono">&#33;</div>
    <div>
        <div class="titulo">No se pudo guardar</div>
        <div class="detalle"><?php echo $msg ?: 'Ocurrió un error inesperado.'; ?></div>
    </div>
    <button class="cerrar" onclick="document.getElementById('toast').remove()">&times;</button>
</div>
<?php endif; ?>

<div class="tag-header">
    <div class="eyebrow">Gestión de categorías</div>
    <h1>Nueva categoría</h1>
    <p class="mb-0" style="color:#c9d2e0;">Etiqueta y organiza tus productos en segundos</p>
</div>

<div class="tag-card">
    <form action="guardar_categoria.php" method="POST">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la categoría</label>
            <input type="text" id="nombre" name="nombre" class="form-control"
                   placeholder="Ej. Bebidas, Electrónica, Limpieza..." required>
            <div class="ayuda mt-1">Usa un nombre corto y claro, así aparecerá en tus listados.</div>
        </div>

        <div class="linea-punteada"></div>

        <button type="submit" class="btn btn-registrar form-control">Registrar categoría</button>
    </form>
</div>

<script>
    // Anima la entrada del toast (si existe) y limpia el parámetro de la URL
    const toast = document.getElementById('toast');
    if (toast) {
        requestAnimationFrame(() => toast.classList.add('mostrar'));
        setTimeout(() => {
            toast.classList.remove('mostrar');
            setTimeout(() => toast.remove(), 400);
        }, 4000);
        window.history.replaceState({}, document.title, 'formulario_categoria.php');
    }
</script>

</body>
</html>