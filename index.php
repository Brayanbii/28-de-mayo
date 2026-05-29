<style>
    /* --- ESTILIZACIÓN GENERAL (SALA DE CINE) --- */
    body {
        background-color: #0d0e15; /* Fondo ultra oscuro estilo sala de cine */
        color: #e2e8f0;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        overflow-x: hidden;
        position: relative;
    }

    /* --- EFECTO DE PALOMITAS FLOTANTES ANIMADAS --- */
    .popcorn-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
    }

    .popcorn {
        position: absolute;
        bottom: -60px;
        font-size: 1.8rem;
        user-select: none;
        animation: floatUp 9s linear infinite;
        opacity: 0;
    }

    @keyframes floatUp {
        0% {
            transform: translateY(0) rotate(0deg) translateX(0);
            opacity: 0;
        }
        10% {
            opacity: 0.65;
        }
        90% {
            opacity: 0.65;
        }
        100% {
            transform: translateY(-115vh) rotate(360deg) translateX(80px);
            opacity: 0;
        }
    }

    /* --- MARQUESINA DE NEÓN ANIMADA (TÍTULO DE CONEXIÓN) --- */
    .marquee-box {
        background: #161925;
        border: 4px solid #ff0055;
        border-radius: 15px;
        padding: 2rem 1rem;
        margin-bottom: 2.5rem;
        position: relative;
        box-shadow: 0 0 15px #ff0055, inset 0 0 10px #ff0055;
        z-index: 1;
    }

    .marquee-title {
        font-family: 'Limelight', cursive;
        font-size: 3.5rem;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 20px #ff0055, 0 0 30px #ff0055;
        animation: neonPulse 1.5s ease-in-out infinite alternate;
    }

    .marquee-sub {
        font-family: 'Bungee', cursive;
        color: #ffbd59;
        font-size: 1.1rem;
        letter-spacing: 3px;
        text-shadow: 0 0 5px #ffbd59;
    }

    @keyframes neonPulse {
        from {
            text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 20px #ff0055, 0 0 30px #ff0055;
        }
        to {
            text-shadow: 0 0 10px #fff, 0 0 20px #ff0055, 0 0 35px #ff3f80, 0 0 50px #ff3f80, 0 0 10px #ffbd59;
        }
    }

    /* --- BOLETO DE CINE RETRO (FORMULARIO) --- */
    .cinema-ticket {
        background: #fffdf0; /* Color papel viejo de ticket */
        color: #1a1a1a;
        border: 3px dashed #b22222;
        border-radius: 16px;
        position: relative;
        padding: 2.5rem 1.8rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
        z-index: 2;
    }

    /* Cortes circulares típicos de los tickets en los lados */
    .cinema-ticket::before, .cinema-ticket::after {
        content: '';
        position: absolute;
        width: 36px;
        height: 36px;
        background-color: #0d0e15; /* Mismo color del fondo de la sala */
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
    }

    .cinema-ticket::before {
        left: -18px;
        border-right: 3px dashed #b22222;
    }

    .cinema-ticket::after {
        right: -18px;
        border-left: 3px dashed #b22222;
    }

    .ticket-title {
        font-family: 'Special Elite', cursive;
        font-size: 1.8rem;
        text-align: center;
        border-bottom: 2px solid #b22222;
        padding-bottom: 0.8rem;
        color: #b22222;
    }

    .form-label-ticket {
        font-family: 'Special Elite', cursive;
        font-weight: bold;
        color: #4a4a4a;
        font-size: 0.95rem;
    }

    .form-control-ticket {
        background-color: transparent;
        border: none;
        border-bottom: 2px solid #b22222;
        border-radius: 0;
        font-family: 'Special Elite', cursive;
        color: #1a1a1a;
        padding: 0.4rem 0.2rem;
    }

    .form-control-ticket:focus {
        background-color: rgba(178, 34, 34, 0.05);
        outline: none;
        box-shadow: none;
        border-bottom-color: #ff0055;
    }

    .btn-ticket {
        font-family: 'Bungee', cursive;
        background-color: #b22222;
        color: #fff;
        border: none;
        padding: 0.8rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(178, 34, 34, 0.4);
    }

    .btn-ticket:hover {
        background-color: #ff0055;
        color: #fff;
        transform: scale(1.03);
        box-shadow: 0 6px 15px rgba(255, 0, 85, 0.5);
    }

    /* Código de barras del ticket */
    .ticket-barcode {
        text-align: center;
        margin-top: 1.5rem;
        border-top: 1px dashed #b22222;
        padding-top: 1rem;
    }

    .barcode-lines {
        height: 35px;
        background: repeating-linear-gradient(
            90deg,
            #1a1a1a,
            #1a1a1a 2px,
            transparent 2px,
            transparent 6px,
            #1a1a1a 6px,
            #1a1a1a 10px,
            transparent 10px,
            transparent 14px
        );
        width: 80%;
        margin: 0 auto 0.3rem auto;
    }

    /* --- CARTELERA DE ESTRENOS (TABLA DE REGISTROS) --- */
    .billboard-container {
        background: #161925;
        border: 4px solid #ffbd59; /* Contorno dorado de cartelera */
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(255, 189, 89, 0.15), 0 5px 15px rgba(0, 0, 0, 0.5);
        z-index: 2;
        position: relative;
    }

    .billboard-header {
        font-family: 'Bungee', cursive;
        color: #ffbd59;
        text-shadow: 0 0 5px rgba(255, 189, 89, 0.5);
        border-bottom: 2px dashed #ffbd59;
        padding-bottom: 1rem;
    }

    /* Bordes estilo rollo de película (Film Strip) para las tablas */
    .film-strip-table {
        background: #0f111a;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .film-strip-table thead th {
        font-family: 'Bungee', cursive;
        background-color: #1e2235 !important;
        color: #ffbd59 !important;
        border: none;
        padding: 1rem;
    }

    .film-strip-table tbody tr {
        background-color: #1a1d2e;
        transition: all 0.2s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
    }

    .film-strip-table tbody tr:hover {
        background-color: #242942;
        transform: scale(1.01);
    }

    .film-strip-table td {
        color: #e2e8f0;
        padding: 1.2rem 1rem;
        border: none;
    }

    .film-strip-table td:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
        border-left: 4px solid #ffbd59;
    }

    .film-strip-table td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    /* Detalles estéticos */
    .badge-genre {
        font-family: 'Special Elite', cursive;
        background-color: #ff0055;
        color: #fff;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        box-shadow: 0 0 8px rgba(255, 0, 85, 0.3);
    }

    .badge-popcorn {
        background-color: #ffbd59;
        color: #111;
        font-weight: bold;
    }
</style>


<!-- CONTENEDOR DE PALOMITAS DE MAÍZ FLOTANTES -->
<div class="popcorn-container">
    <!-- Creamos palomitas flotantes con diferentes retrasos y ubicaciones -->
    <span class="popcorn" style="left: 5%; animation-delay: 0s;">🍿</span>
    <span class="popcorn" style="left: 15%; animation-delay: 2.5s; font-size: 1.5rem;">🍿</span>
    <span class="popcorn" style="left: 25%; animation-delay: 5s;">🍿</span>
    <span class="popcorn" style="left: 40%; animation-delay: 1.2s; font-size: 2.2rem;">🍿</span>
    <span class="popcorn" style="left: 55%; animation-delay: 6s;">🍿</span>
    <span class="popcorn" style="left: 70%; animation-delay: 3.5s; font-size: 1.4rem;">🍿</span>
    <span class="popcorn" style="left: 85%; animation-delay: 0.8s;">🍿</span>
    <span class="popcorn" style="left: 95%; animation-delay: 4.2s; font-size: 2rem;">🍿</span>
</div>

<div class="container pt-5 pb-5">

    <!-- MARQUESINA CINEMATOGRÁFICA -->
    <div class="marquee-box text-center shadow-lg">
        <h1 class="marquee-title"><i class="bi bi-film me-2 text-warning"></i>CineConn Atlas<i class="bi bi-film ms-2 text-warning"></i></h1>
        <p class="marquee-sub mb-0"><i class="bi bi-star-fill text-warning me-1"></i> La Gran Conexión con MongoDB <i class="bi bi-star-fill text-warning ms-1"></i></p>
    </div>

    <!-- NOTIFICACIONES DE ENTRADA / TICKET PROCESADO -->
    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'success'): ?>
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4 shadow" role="alert" style="background-color: #1a3d2e; color: #76e2b1; border-color: #2e6d51; z-index:3; position:relative;">
                <i class="bi bi-ticket-perforated-fill fs-3 me-3"></i>
                <div>
                    <strong class="font-monospace">¡BOLETO EMITIDO CON ÉXITO!</strong> El aprendiz ha tomado su butaca en Atlas.
                    <span class="d-block small font-monospace text-white-50">Código Ticket (ID): <?= htmlspecialchars($_GET['id'] ?? '') ?></span>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif ($_GET['status'] == 'error'): ?>
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4 shadow" role="alert" style="background-color: #3d1a1d; color: #e2767a; border-color: #6d2e33; z-index:3; position:relative;">
                <i class="bi bi-exclamation-octagon-fill fs-3 me-3"></i>
                <div>
                    <strong class="font-monospace">ERROR EN TAQUILLA:</strong> <?= htmlspecialchars($_GET['msg'] ?? 'No se pudo emitir la entrada.') ?>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- NOTIFICACIÓN DE BASE DE DATOS CAÍDA -->
    <?php if ($error_mongo): ?>
        <div class="alert alert-warning d-flex align-items-center mb-4 shadow" role="alert" style="background-color: #3d321a; color: #e2c076; border-color: #6d582e; z-index:3; position:relative;">
            <i class="bi bi-camera-video-off-fill fs-3 me-3"></i>
            <div>
                <strong>Proyector Apagado (Fallo de BD):</strong> <?= htmlspecialchars($error_mongo) ?><br>
                <small class="font-monospace">Asegúrate de que la whitelist de Atlas esté en "0.0.0.0/0" para habilitar las cámaras de Render.</small>
            </div>
        </div>
    <?php endif; ?>

    <div class="row g-5">
        
        <!-- COLUMNA IZQUIERDA: BOLETO DE REGISTRO (FORMULARIO) -->
        <div class="col-lg-4">
            <div class="cinema-ticket">
                <h2 class="ticket-title"><i class="bi bi-ticket-detailed me-2"></i>ADMIT ONE</h2>
                <p class="text-center text-muted small font-monospace mt-1 mb-4">GUSTOS & PREFERENCIAS</p>
                
                <form action="logica.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label form-label-ticket">Apellidos del Espectador:</label>
                        <input type="text" required maxlength="200" name="apellidos" class="form-control form-control-ticket" placeholder="Escriba aquí">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label form-label-ticket">Nombres del Espectador:</label>
                        <input type="text" required maxlength="200" name="nombres" class="form-control form-control-ticket" placeholder="Escriba aquí">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label form-label-ticket">Color de Película:</label>
                        <input type="text" required maxlength="200" name="color" class="form-control form-control-ticket" placeholder="Ej. Azul de Neon, Rojo Pasión">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label form-label-ticket">Snack/Comida Favorito:</label>
                        <input type="text" required maxlength="200" name="comida" class="form-control form-control-ticket" placeholder="Ej. Palomitas, Hot Dog">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label form-label-ticket">Género Favorito Cine/Lit:</label>
                        <input type="text" required maxlength="200" name="pelicula" class="form-control form-control-ticket" placeholder="Ej. Terror, Ciencia Ficción">
                    </div>
                    
                    <button type="submit" class="btn btn-ticket w-100 mt-3">
                        <i class="bi bi-ticket-perforated-fill me-2"></i>OBTENER ENTRADA
                    </button>
                </form>

                <!-- Código de barras representativo del ticket -->
                <div class="ticket-barcode">
                    <div class="barcode-lines"></div>
                    <span class="small font-monospace text-muted">SENA-CINEMA-ATLAS-2026</span>
                </div>
            </div>
        </div>

        <!-- COLUMNA DERECHA: CARTELERA DE ESTRENOS (CONSULTA DE DOCUMENTOS) -->
        <div class="col-lg-8">
            <div class="billboard-container">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary">
                    <h2 class="billboard-header h4 m-0">
                        <i class="bi bi-projector-fill me-2"></i>Cartelera de Respuestas
                    </h2>
                    <?php if (!$error_mongo && isset($coleccion)): ?>
                        <span class="badge badge-popcorn rounded-pill px-3 py-2">
                            🍿 <?= $coleccion->countDocuments() ?> Espectador(es)
                        </span>
                    <?php endif; ?>
                </div>

                <div class="table-responsive">
                    <table class="table film-strip-table align-middle">
                        <thead>
                            <tr>
                                <th>Espectador / Aprendiz</th>
                                <th>Color Favorito</th>
                                <th>Snack Ideal</th>
                                <th>Género Cine/Libros</th>
                                <th>Fecha de Emisión</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (!$error_mongo && isset($documentos)): 
                                $registrados = false;
                                foreach ($documentos as $doc): 
                                    $registrados = true;
                            ?>
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-white"><?= htmlspecialchars($doc['apellidos'] ?? '') ?></div>
                                            <small class="text-warning font-monospace"><?= htmlspecialchars($doc['nombres'] ?? '') ?></small>
                                        </td>
                                        <td>
                                            <span class="badge badge-genre" style="background-color: #03a9f4; box-shadow: 0 0 8px rgba(3, 169, 244, 0.4);">
                                                <?= htmlspecialchars($doc['color'] ?? '') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <i class="bi bi-egg-fried text-warning me-1"></i><?= htmlspecialchars($doc['comida'] ?? '') ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-genre">
                                                <?= htmlspecialchars($doc['pelicula'] ?? '') ?>
                                            </span>
                                        </td>
                                        <td class="text-muted small font-monospace">
                                            <?= htmlspecialchars($doc['registro'] ?? '') ?>
                                        </td>
                                    </tr>
                            <?php 
                                endforeach; 
                                
                                if (!$registrados):
                            ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="bi bi-camera-reels-fill fs-1 d-block mb-3 text-secondary"></i>
                                            SALA VACÍA. ¡No hay respuestas registradas todavía!
                                        </td>
                                    </tr>
                            <?php
                                endif;
                            else:
                            ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-danger">
                                        <i class="bi bi-cone-striped fs-2 d-block mb-3 text-danger"></i>
                                        Error al intentar proyectar los datos de la base de datos de MongoDB.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap Bundle JS con Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
