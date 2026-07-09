<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Sistema de Rentas</title>
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
        }

        /* HERO con foto de fondo */
        .hero {
            position: relative;
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image:
                linear-gradient(180deg, rgba(30, 10, 40, 0.65), rgba(30, 10, 40, 0.75)),
                url('https://images.unsplash.com/photo-1770805001834-f9ccd734c6fb?fm=jpg&q=80&w=1920&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
            text-align: center;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 20%, rgba(255, 183, 3, 0.25), transparent 40%),
                        radial-gradient(circle at 80% 80%, rgba(123, 47, 247, 0.35), transparent 40%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 720px;
            padding: 2rem;
        }

        .hero h1 {
            font-weight: 800;
            font-size: clamp(2.2rem, 5vw, 3.6rem);
            text-shadow: 0 4px 18px rgba(0,0,0,0.45);
        }

        .hero p.lead {
            font-size: clamp(1.05rem, 2.2vw, 1.35rem);
            text-shadow: 0 2px 10px rgba(0,0,0,0.4);
        }

        .btn-brand {
            background: linear-gradient(135deg, var(--brand-pink), var(--brand-purple));
            border: none;
            color: #fff;
            font-weight: 600;
            padding: .75rem 2rem;
            border-radius: 50px;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn-brand:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(123, 47, 247, 0.35);
            color: #fff;
        }

        .btn-outline-brand {
            border: 2px solid #fff;
            color: #fff;
            font-weight: 600;
            padding: .75rem 2rem;
            border-radius: 50px;
            transition: all .2s ease;
        }

        .btn-outline-brand:hover {
            background: #fff;
            color: var(--brand-purple);
        }

        /* Sección de features */
        .features {
            padding: 4rem 1rem;
            background: #fdf7ff;
        }

        .feature-card {
            border: none;
            border-radius: 18px;
            padding: 2rem 1.5rem;
            height: 100%;
            box-shadow: 0 8px 24px rgba(123, 47, 247, 0.08);
            transition: transform .2s ease, box-shadow .2s ease;
            background: #fff;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 30px rgba(123, 47, 247, 0.15);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 1rem;
            font-size: 1.6rem;
            color: #fff;
            background: linear-gradient(135deg, var(--brand-pink), var(--brand-orange));
        }

        footer {
            background: #1e0a28;
            color: #eee2f5;
            padding: 1.5rem 0;
            text-align: center;
            font-size: .9rem;
        }
    </style>
</head>
<body>


    <!-- HERO -->
    <section class="hero">
        <div class="hero-content">
            <h1>🎈 Bienvenido</h1>
            <p class="lead mb-4">Sistema de gestión para <strong>Rentas de artículos para fiestas</strong> — controla tu inventario, reservas y clientes en un solo lugar.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="formulario_categoria.php" class="btn btn-brand btn-lg">Ver categorías</a>
                <a href="formulario_cliente.php" class="btn btn-outline-brand btn-lg">Nuevo cliente</a>
                <a href="formulario_producto.php" class="btn btn-outline-brand btn-lg">Nuevo producto</a>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="features">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color:var(--brand-purple)">¿Qué puedes hacer aquí?</h2>
                <p class="text-muted">Todo lo que necesitas para administrar tu negocio de renta de artículos para fiestas.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">📦</div>
                        <h5 class="fw-bold">Inventario</h5>
                        <p class="text-muted mb-0">Controla mesas, sillas, inflables, vajilla y decoraciones disponibles para renta.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">📅</div>
                        <h5 class="fw-bold">Reservas</h5>
                        <p class="text-muted mb-0">Agenda eventos, evita cruces de fechas y da seguimiento a cada renta.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">👥</div>
                        <h5 class="fw-bold">Clientes</h5>
                        <p class="text-muted mb-0">Guarda datos de contacto, historial de rentas y pagos pendientes.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        &copy; <?php echo date('Y'); ?> Sistema de Rentas para Fiestas. Todos los derechos reservados.
    </footer>
</body>
</html>