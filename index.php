<style>
    /* --- ESTILIZACIÓN GENERAL DEL MULTIVERSO --- */
    body {
        background: radial-gradient(circle at center, #111424 0%, #07080f 100%);
        color: #f1f5f9;
        font-family: 'Montserrat', sans-serif;
        overflow-x: hidden;
        position: relative;
        min-height: 100vh;
    }

    /* --- POLVO MÁGICO Y ELEMENTOS DEL MULTIVERSO FLOTANDO --- */
    .multiverse-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
    }

    .floating-hero {
        position: absolute;
        opacity: 0.15;
        animation: floatSlow 12s infinite ease-in-out;
        color: #64ffda;
    }

    @keyframes floatSlow {
        0%, 100% {
            transform: translateY(0) rotate(0deg) scale(1);
        }
        50% {
            transform: translateY(-80px) rotate(180deg) scale(1.2);
        }
    }

    /* --- CABECERA DE MARVEL / DISNEY INSPIRADA --- */
    .marquee-container {
        background: linear-gradient(135deg, #e50914 0%, #9b000e 100%); /* Rojo Marvel */
        border: 6px solid #ffd700; /* Oro Disney */
        border-radius: 24px;
        padding: 2.5rem 1.5rem;
        margin-bottom: 3.5rem;
        box-shadow: 0 10px 40px rgba(229, 9, 20, 0.4), 0 0 25px rgba(255, 215, 0, 0.3);
        position: relative;
        z-index: 1;
        overflow: hidden;
    }

    .marquee-container::before {
        content: '';
        position: absolute;
        top: 0; left: -50%; width: 200%; height: 100%;
        background: linear-gradient(to right, transparent, rgba(255,255,255,0.15), transparent);
        transform: skewX(-25deg);
        animation: shine 4s infinite;
    }

    @keyframes shine {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .main-title {
        font-family: 'Bangers', cursive;
        font-size: 5rem;
        letter-spacing: 4px;
        color: #ffffff;
        text-shadow: 4px 4px 0px #000, -2px -2px 0px #000, 3px -3px 0px #000, -3px 3px 0px #000, 0 0 20px rgba(255,255,255,0.6);
    }

    .sub-title {
        font-family: 'Luckiest Guy', cursive;
        font-size: 1.8rem;
        color: #ffd700; /* Oro mágico Disney */
        letter-spacing: 2px;
        text-shadow: 2px 2px 0px #000;
    }

    /* --- TARJETA DE REGISTRO VIP (FORMULARIO GIGANTE) --- */
    .hero-form-card {
        background: rgba(20, 24, 45, 0.95);
        border: 4px solid #00d2ff; /* Azul Stark */
        border-radius: 30px;
        padding: 3rem 2.2rem;
        box-shadow: 0 15px 45px rgba(0, 210, 255, 0.25);
        position: relative;
        z-index: 2;
        transition: all 0.3s ease;
    }

    .hero-form-card::after {
        content: 'VIP PASS';
        position: absolute;
        top: 20px;
        right: 20px;
        background: #ffd700;
        color: #000;
        font-family: 'Bangers', cursive;
        font-size: 1.2rem;
        padding: 0.3rem 1rem;
        border-radius: 10px;
        transform: rotate(10deg);
        box-shadow: 3px 3px 0px #000;
    }

    .form-section-title {
        font-family: 'Luckiest Guy', cursive;
        font-size: 2.2rem;
        color: #00d2ff;
        text-shadow: 2px 2px 0px #000;
        margin-bottom: 2rem;
        text-align: center;
    }

    .giant-label {
        font-size: 1.2rem;
        font-weight: 900;
        color: #ff007f; /* Rosa Pixie Disney */
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.6rem;
        display: flex;
        align-items: center;
    }

    .giant-input {
        background: rgba(255, 255, 255, 0.08) !important;
        border: 3px solid #3d4a85 !important;
        border-radius: 16px !important;
        color: #ffffff !important;
        padding: 1.1rem 1.4rem !important;
        font-size: 1.15rem !important;
        font-weight: 700;
        transition: all 0.3s ease !important;
    }

    .giant-input::placeholder {
        color: rgba(255, 255, 255, 0.35);
    }

    .giant-input:focus {
        border-color: #ffd700 !important;
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.4) !important;
        transform: scale(1.02);
    }

    .btn-giant-register {
        font-family: 'Bangers', cursive;
        font-size: 2.3rem;
        background: linear-gradient(45deg, #ff007f, #ff5e62);
        color: #fff;
        border: 4px solid #ffffff;
        border-radius: 20px;
        padding: 1rem;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        text-shadow: 3px 3px 0px #000;
        box-shadow: 0 8px 25px rgba(255, 0, 127, 0.4);
    }

    .btn-giant-register:hover {
        transform: translateY(-8px) scale(1.03);
        background: linear-gradient(45deg, #ffbd59, #ff5e62);
        box-shadow: 0 15px 35px rgba(255, 189, 89, 0.6);
        border-color: #ffd700;
        color: #fff;
    }

    /* --- GRID DE TARJETAS DE PERSONAJE (CROMOS) --- */
    .multiverse-grid-title {
        font-family: 'Luckiest Guy', cursive;
        font-size: 3rem;
        color: #ffd700;
        text-shadow: 3px 3px 0px #000;
        margin-bottom: 2.5rem;
        text-align: center;
    }

    /* Estilo tarjeta coleccionable */
    .character-card {
        background: linear-gradient(135deg, #161a36 0%, #0d1024 100%);
        border: 4px solid #ffd700;
        border-radius: 24px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 2;
    }

    .character-card:hover {
        transform: translateY(-15px) rotate(2deg) scale(1.03);
        box-shadow: 0 20px 40px rgba(255, 215, 0, 0.3);
        border-color: #00d2ff;
    }

    /* Sello holográfico de fondo */
    .card-shield-watermark {
        position: absolute;
        bottom: -30px;
        right: -30px;
        font-size: 10rem;
        color: rgba(255, 255, 255, 0.03);
        pointer-events: none;
        transition: all 0.4s ease;
    }

    .character-card:hover .card-shield-watermark {
        color: rgba(0, 210, 255, 0.06);
        transform: scale(1.1) rotate(-15deg);
    }

    .character-avatar {
        width: 85px;
        height: 85px;
        background: radial-gradient(circle, #ff007f 0%, #7b003f 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.8rem;
        border: 4px solid #ffd700;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        margin-bottom: 1.5rem;
    }

    .character-name {
        font-family: 'Luckiest Guy', cursive;
        font-size: 1.8rem;
        color: #ffffff;
        margin-bottom: 0.3rem;
        letter-spacing: 1px;
        line-height: 1.2;
    }

    .character-sub {
        font-family: 'Montserrat', sans-serif;
        font-weight: 800;
        color: #00d2ff;
        text-transform: uppercase;
        font-size: 0.95rem;
        margin-bottom: 1.2rem;
        letter-spacing: 1.5px;
    }

    .info-stat-box {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 14px;
        padding: 0.8rem 1.2rem;
        margin-bottom: 0.8rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .info-stat-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 900;
        color: #ff5e62;
        letter-spacing: 1px;
        margin-bottom: 0.1rem;
    }

    .info-stat-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: #e2e8f0;
    }

    .card-footer-date {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.3);
        font-weight: bold;
        font-family: monospace;
        text-align: right;
        margin-top: 1.2rem;
    }

    /* Contador de héroes espectacular */
    .hero-counter-badge {
        background: linear-gradient(135deg, #ffd700 0%, #ffbd59 100%);
        color: #000;
        font-family: 'Bangers', cursive;
        font-size: 1.8rem;
        padding: 0.5rem 1.8rem;
        border-radius: 50px;
        border: 3px solid #fff;
        box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
        display: inline-block;
    }
</style>


<!-- PARTÍCULAS / ICONOS FLOTANTES DEL MULTIVERSO -->
<div class="multiverse-bg">
    <!-- Escudo / Mickey / Estrella / Lámpara flotando de forma sutil en el fondo -->
    <i class="bi bi-shield-fill floating-hero" style="left: 8%; top: 15%; font-size: 4rem; animation-duration: 14s;"></i>
    <i class="bi bi-stars floating-hero" style="left: 85%; top: 12%; font-size: 5rem; animation-duration: 10s; color: #ffd700;"></i>
    <i class="bi bi-magic floating-hero" style="left: 45%; top: 8%; font-size: 3.5rem; animation-duration: 18s; color: #ff007f;"></i>
    <i class="bi bi-rocket-takeoff-fill floating-hero" style="left: 82%; top: 75%; font-size: 4.5rem; animation-duration: 15s; color: #ff5e62;"></i>
    <i class="bi bi-lightning-charge-fill floating-hero" style="left: 12%; top: 65%; font-size: 5rem; animation-duration: 11s; color: #ffd700;"></i>
    <i class="bi bi-controller floating-hero" style="left: 48%; top: 80%; font-size: 3.8rem; animation-duration: 16s; color: #00d2ff;"></i>
</div>

<div class="container pt-5 pb-5">

    <!-- MARQUESINA CINEMATOGRÁFICA DE DISNEY/MARVEL -->
    <div class="marquee-container text-center shadow-lg">
        <h1 class="main-title mb-1"><i class="bi bi-shield-shaded text-warning me-2"></i>CineConn Atlas<i class="bi bi-shield-shaded text-warning ms-2"></i></h1>
        <p class="sub-title mb-0"><i class="bi bi-star-fill text-white"></i> LA GRAN INICIATIVA CON MONGODB <i class="bi bi-star-fill text-white"></i></p>
    </div>

    <!-- ALERTAS DE ÉXITO ESTILO DISNEY MAGIC -->
    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'success'): ?>
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-5 p-4 shadow-lg" role="alert" style="background: linear-gradient(135deg, #112e21 0%, #1c4b36 100%); border: 3px solid #00ff66; border-radius: 20px; color: #8effbf; z-index: 5; position: relative;">
                <i class="bi bi-check-circle-fill fs-1 me-3 text-success"></i>
                <div>
                    <h4 class="alert-heading font-monospace fw-bold mb-1">¡NUEVO HÉROE REGISTRADO EN EL PORTAL!</h4>
                    <p class="mb-0">El aprendiz ha reclamado su boleto cósmico exitosamente.</p>
                    <span class="small font-monospace text-white-50 d-block mt-1">ID Único de Atlas: <?= htmlspecialchars($_GET['id'] ?? '') ?></span>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif ($_GET['status'] == 'error'): ?>
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-5 p-4 shadow-lg" role="alert" style="background: linear-gradient(135deg, #3d1215 0%, #631f24 100%); border: 3px solid #ff0033; border-radius: 20px; color: #ff9da1; z-index: 5; position: relative;">
                <i class="bi bi-x-octagon-fill fs-1 me-3"></i>
                <div>
                    <h4 class="alert-heading font-monospace fw-bold mb-1">PROYECTOR AVERIADO (ERROR)</h4>
                    <p class="mb-0"><?= htmlspecialchars($_GET['msg'] ?? 'No se pudo registrar en la base de datos.') ?></p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- ALERTA DE ERROR DE CONEXIÓN CON ATLAS -->
    <?php if ($error_mongo): ?>
        <div class="alert alert-warning d-flex align-items-center mb-5 p-4 shadow-lg" role="alert" style="background: linear-gradient(135deg, #382405 0%, #5c3b09 100%); border: 3px solid #ffd700; border-radius: 20px; color: #ffe699; z-index: 5; position: relative;">
            <i class="bi bi-exclamation-triangle-fill fs-1 me-3 text-warning"></i>
            <div>
                <h4 class="alert-heading fw-bold mb-1">¡ALERTA DE CONEXIÓN DE ASGARD!</h4>
                <p class="mb-0">El bifrost de MongoDB Atlas se encuentra cerrado temporalmente: <?= htmlspecialchars($error_mongo) ?></p>
                <small class="font-monospace text-white-50">Por favor, verifica que tu Network Access en MongoDB Atlas tenga habilitada la IP general 0.0.0.0/0.</small>
            </div>
        </div>
    <?php endif; ?>

    <div class="row g-5">
        
        <!-- COLUMNA IZQUIERDA: FORMULARIO VIP (AVENGERS BADGE) -->
        <div class="col-lg-5">
            <div class="hero-form-card shadow-lg">
                <h2 class="form-section-title"><i class="bi bi-shield-lock-fill me-2"></i>CREAR ACCESO VIP</h2>
                
                <form action="logica.php" method="POST">
                    <div class="mb-4">
                        <label class="giant-label"><i class="bi bi-award-fill me-2"></i>Apellidos del Héroe</label>
                        <input type="text" required maxlength="200" name="apellidos" class="form-control giant-input" placeholder="Ej. Stark Rogers">
                    </div>
                    
                    <div class="mb-4">
                        <label class="giant-label"><i class="bi bi-person-fill me-2"></i>Nombres del Héroe</label>
                        <input type="text" required maxlength="200" name="nombres" class="form-control giant-input" placeholder="Ej. Tony Steve">
                    </div>
                    
                    <div class="mb-4">
                        <label class="giant-label"><i class="bi bi-palette-fill me-2"></i>Color del Infinito (Favorito)</label>
                        <input type="text" required maxlength="200" name="color" class="form-control giant-input" placeholder="Ej. Azul Gema, Rojo Rubí">
                    </div>
                    
                    <div class="mb-4">
                        <label class="giant-label"><i class="bi bi-egg-fried me-2"></i>Snack de Marvel / Disney</label>
                        <input type="text" required maxlength="200" name="comida" class="form-control giant-input" placeholder="Ej. Shawarma, Palomitas con Caramelo">
                    </div>
                    
                    <div class="mb-4">
                        <label class="giant-label"><i class="bi bi-film me-2"></i>Género Favorito de Películas</label>
                        <input type="text" required maxlength="200" name="pelicula" class="form-control giant-input" placeholder="Ej. Ciencia Ficción, Animación, Acción">
                    </div>
                    
                    <button type="submit" class="btn btn-giant-register w-100 mt-2">
                        <i class="bi bi-lightning-fill me-2"></i>ACTIVAR INICIATIVA
                    </button>
                </form>
            </div>
        </div>

        <!-- COLUMNA DERECHA: TARJETAS COLECCIONABLES DE APRENDICES -->
        <div class="col-lg-7">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-secondary pb-3" style="position: relative; z-index:2;">
                <h2 class="multiverse-grid-title m-0 text-start">
                    <i class="bi bi-grid-3x3-gap-fill me-2"></i>Héroes Conectados
                </h2>
                <?php if (!$error_mongo && isset($coleccion)): ?>
                    <div class="hero-counter-badge">
                        🦸‍♂️ <?= $coleccion->countDocuments() ?> REGISTRADOS
                    </div>
                <?php endif; ?>
            </div>

            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php 
                if (!$error_mongo && isset($documentos)): 
                    $registrados = false;
                    foreach ($documentos as $doc): 
                        $registrados = true;

                        // Generar emojis genéricos divertidos según el género de su película
                        $genero = mb_strtolower($doc['pelicula'] ?? '');
                        $avatar_emoji = "🎬"; // Default
                        if (str_contains($genero, 'terror') || str_contains($genero, 'suspenso')) {
                            $avatar_emoji = "👻";
                        } elseif (str_contains($genero, 'ciencia') || str_contains($genero, 'acción') || str_contains($genero, 'marvel')) {
                            $avatar_emoji = "🛡️";
                        } elseif (str_contains($genero, 'animación') || str_contains($genero, 'disney') || str_contains($genero, 'infantil')) {
                            $avatar_emoji = "👑";
                        } elseif (str_contains($genero, 'comedia')) {
                            $avatar_emoji = "🤡";
                        }
                ?>
                        <div class="col">
                            <div class="character-card">
                                <!-- Marca de agua de fondo -->
                                <i class="bi bi-shield-shaded card-shield-watermark"></i>
                                
                                <div class="d-flex align-items-center justify-content-between">
                                    <!-- Avatar Animado -->
                                    <div class="character-avatar">
                                        <?= $avatar_emoji ?>
                                    </div>
                                    <span class="badge bg-dark border border-warning text-warning px-3 py-2 font-monospace">LVL 99</span>
                                </div>
                                
                                <div class="character-name text-truncate">
                                    <?= htmlspecialchars($doc['apellidos'] ?? '') ?>
                                </div>
                                <div class="character-sub">
                                    <?= htmlspecialchars($doc['nombres'] ?? '') ?>
                                </div>
                                
                                <!-- Estadísticas / Datos -->
                                <div class="info-stat-box">
                                    <div class="info-stat-label">Color de Energía</div>
                                    <div class="info-stat-value text-capitalize">
                                        <i class="bi bi-palette-fill me-2" style="color: #ffd700;"></i><?= htmlspecialchars($doc['color'] ?? '') ?>
                                    </div>
                                </div>
                                
                                <div class="info-stat-box">
                                    <div class="info-stat-label">Snack de Combate</div>
                                    <div class="info-stat-value">
                                        <i class="bi bi-egg-fried me-2 text-warning"></i><?= htmlspecialchars($doc['comida'] ?? '') ?>
                                    </div>
                                </div>

                                <div class="info-stat-box">
                                    <div class="info-stat-label">Género de Cine</div>
                                    <div class="info-stat-value">
                                        <i class="bi bi-film me-2 text-info"></i><?= htmlspecialchars($doc['pelicula'] ?? '') ?>
                                    </div>
                                </div>

                                <div class="card-footer-date">
                                    <i class="bi bi-calendar-event me-1"></i><?= htmlspecialchars($doc['registro'] ?? '') ?>
                                </div>
                            </div>
                        </div>
                <?php 
                    endforeach; 
                    
                    if (!$registrados):
                ?>
                        <div class="col-12 text-center py-5" style="position: relative; z-index: 2;">
                            <div class="p-5 border-3 border-dashed border-secondary rounded-5 bg-dark">
                                <i class="bi bi-people-fill text-muted" style="font-size: 6rem;"></i>
                                <h3 class="mt-4 text-white-50">LA SALA ESTÁ VACÍA</h3>
                                <p class="text-muted">No hay héroes listados. ¡Reclama el primer pase a la izquierda!</p>
                            </div>
                        </div>
                <?php
                    endif;
                else:
                ?>
                    <div class="col-12 text-center py-5" style="position: relative; z-index: 2;">
                        <div class="p-5 border-3 border-dashed border-danger rounded-5 bg-dark">
                            <i class="bi bi-cone-striped text-danger" style="font-size: 6rem;"></i>
                            <h3 class="mt-4 text-danger">ERROR DE PROYECCIÓN</h3>
                            <p class="text-muted">Revisa la conexión de red con MongoDB en la pestaña de Render.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap Bundle JS con Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
