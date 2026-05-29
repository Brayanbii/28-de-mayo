<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S.H.I.E.L.D. | Ingreso de Operativos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #02040a;
            color: #e2e8f0;
            font-family: 'Segoe UI', system-ui, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-panel {
            background: rgba(10, 15, 25, 0.9);
            border: 1px solid #1a2b4c;
            border-radius: 10px;
            padding: 3rem;
            box-shadow: 0 0 30px rgba(0, 210, 255, 0.15);
            max-width: 500px;
            width: 100%;
        }
        .stark-input {
            background: rgba(0, 0, 0, 0.5) !important;
            border: 1px solid #1a2b4c !important;
            color: #00d2ff !important;
        }
        .stark-input:focus {
            border-color: #00d2ff !important;
            box-shadow: 0 0 10px rgba(0, 210, 255, 0.3) !important;
        }
        .btn-shield {
            background: transparent;
            color: #00d2ff;
            border: 1px solid #00d2ff;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s;
        }
        .btn-shield:hover {
            background: #00d2ff;
            color: #000;
            box-shadow: 0 0 15px rgba(0, 210, 255, 0.5);
        }
    </style>
</head>
<body>
    <div class="login-panel">
        <div class="text-center mb-4">
            <i class="bi bi-shield-shaded text-info" style="font-size: 3rem;"></i>
            <h2 class="text-info mt-2 text-uppercase fw-light" style="letter-spacing: 3px;">Iniciativa Atlas</h2>
            <p class="text-muted small">NUEVO OPERATIVO</p>
        </div>
        
        <?php if(isset($_GET['status']) && $_GET['status'] == 'error'): ?>
            <div class="alert alert-danger bg-dark text-danger border-danger font-monospace text-center small">
                ANOMALÍA DETECTADA: <?= htmlspecialchars($_GET['msg']) ?>
            </div>
        <?php endif; ?>

        <form action="logica.php" method="POST">
            <div class="mb-3">
                <input type="text" required name="apellidos" class="form-control stark-input" placeholder="Apellidos (Ej. Romanoff)">
            </div>
            <div class="mb-3">
                <input type="text" required name="nombres" class="form-control stark-input" placeholder="Nombres (Ej. Natasha)">
            </div>
            <div class="mb-3">
                <input type="text" required name="color" class="form-control stark-input" placeholder="Firma de Color">
            </div>
            <div class="mb-3">
                <input type="text" required name="comida" class="form-control stark-input" placeholder="Suministro / Comida">
            </div>
            <div class="mb-4">
                <input type="text" required name="pelicula" class="form-control stark-input" placeholder="Clasificación / Género">
            </div>
            <button type="submit" class="btn btn-shield w-100 py-2">AUTORIZAR INGRESO</button>
        </form>
    </div>
</body>
</html>
