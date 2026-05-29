<?php
date_default_timezone_set('America/Bogota');
require 'vendor/autoload.php';

$error_mongo = null;
$documentos = [];

try {
    $uri = getenv('MONGO_URI');
    if (!$uri) {
        $uri = "mongodb+srv://brayan:5Lp8OEHxZa1ZLBYk@clusterone.xnd3dxa.mongodb.net/?appName=Clusterone"; 
    }
    $cliente = new MongoDB\Client($uri);
    $db = $cliente->prueba;	
    $coleccion = $db->gustos;	
    $documentos = $coleccion->find([], ['sort' => ['registro' => -1]]);
} catch (Exception $e) {
    $error_mongo = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎬 Cine & Cookies | Cartelera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Nunito:wght@400;600;800&family=Righteous&display=swap" rel="stylesheet">
    
    <style>
        :root { --cinema-red: #e50914; --cinema-dark: #2b0a11; --gold: #ffc107; --cookie-cream: #fdf6e3; --cookie-brown: #8b4513; }
        body { background: linear-gradient(135deg, var(--cinema-dark) 0%, #1a060a 100%); color: var(--cookie-cream); font-family: 'Nunito', sans-serif; overflow-x: hidden; min-height: 100vh; position: relative; }
        #magic-canvas { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 0; pointer-events: none; }
        
        .btn-ticket { position: absolute; top: 20px; left: 20px; background: linear-gradient(to bottom, #ffd700, #daa520); color: #4a3000; text-decoration: none; font-family: 'Righteous', cursive; font-size: 1.1rem; padding: 10px 25px; border-radius: 8px; border: 2px dashed #8b6508; box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3); transition: all 0.3s; z-index: 10; }
        .btn-ticket:hover { transform: scale(1.05) rotate(-2deg); box-shadow: 0 8px 20px rgba(255, 215, 0, 0.5); color: #000; }
        
        /* Nuevo botón de soporte flotante a la derecha */
        .btn-soporte { position: absolute; top: 20px; right: 20px; background: linear-gradient(to bottom, #dc3545, #a71d2a); color: #fff; text-decoration: none; font-family: 'Righteous', cursive; font-size: 1.1rem; padding: 10px 20px; border-radius: 8px; border: 2px dashed #ffb3b9; box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3); transition: all 0.3s; z-index: 10; }
        .btn-soporte:hover { transform: scale(1.05) rotate(2deg); box-shadow: 0 8px 20px rgba(220, 53, 69, 0.5); color: #fff; }

        .marquee-container { background: var(--cookie-cream); border: 12px solid var(--cinema-red); border-radius: 25px; padding: 2.5rem; box-shadow: 0 0 0 8px var(--cinema-dark), 0 15px 35px rgba(0,0,0,0.5), inset 0 0 20px rgba(0,0,0,0.1); margin-top: 3rem; position: relative; z-index: 2; color: var(--cinema-dark); }
        .marquee-container::before { content: ''; position: absolute; top: -6px; left: -6px; right: -6px; bottom: -6px; border: 6px dotted var(--gold); border-radius: 20px; pointer-events: none; animation: blink-lights 1.5s infinite alternate; }
        .title-cine { font-family: 'Lobster', cursive; font-size: 4.5rem; color: var(--cinema-red); text-shadow: 3px 3px 0 var(--gold), 6px 6px 0 rgba(0,0,0,0.1); margin-bottom: 0; line-height: 1.2; animation: float-title 3s ease-in-out infinite; }
        .subtitle-cookie { font-family: 'Righteous', cursive; font-size: 1.5rem; color: var(--cookie-brown); letter-spacing: 2px; }
        .film-strip { background: #111; color: #fff; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.2rem; position: relative; border-left: 15px dotted #fff; border-right: 15px dotted #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.2); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); opacity: 0; transform: translateY(30px) scale(0.95); animation: popIn 0.6s forwards; display: flex; align-items: center; }
        .film-strip:hover { transform: translateY(-5px) scale(1.02) !important; box-shadow: 0 15px 25px rgba(0,0,0,0.3); border-left-color: var(--gold); border-right-color: var(--gold); }
        .film-strip::before { content: '★'; position: absolute; left: -35px; color: var(--gold); font-size: 1.5rem; opacity: 0; transition: opacity 0.3s; }
        .film-strip:hover::before { opacity: 1; }
        .film-data-title { font-family: 'Righteous', cursive; color: var(--gold); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 3px; }
        .film-data-value { font-size: 1.1rem; font-weight: 600; }
        .actor-name { font-family: 'Righteous', cursive; font-size: 1.4rem; color: #fff; margin-bottom: 0; }
        .alert-popcorn { background: #fff3cd; border: 2px dashed #ffeeba; color: #856404; border-radius: 15px; font-weight: bold; font-family: 'Nunito', sans-serif; }
        .alert-burnt { background: #f8d7da; border: 2px dashed #f5c6cb; color: #721c24; border-radius: 15px; font-weight: bold; }
        
        @keyframes blink-lights { 0% { border-color: var(--gold); opacity: 1; filter: drop-shadow(0 0 5px var(--gold)); } 100% { border-color: #ff9800; opacity: 0.6; filter: drop-shadow(0 0 0px transparent); } }
        @keyframes float-title { 0%, 100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-10px) rotate(1deg); } }
        @keyframes popIn { to { opacity: 1; transform: translateY(0) scale(1); } }
        .cinema-header { color: var(--cookie-brown); font-family: 'Righteous', cursive; border-bottom: 3px solid var(--cinema-red); padding-bottom: 10px; margin-bottom: 20px; font-size: 1.1rem; }
        .empty-state { text-align: center; padding: 4rem 2rem; animation: pulse 2s infinite alternate; }
        @keyframes pulse { from { transform: scale(1); } to { transform: scale(1.05); } }
    </style>
</head>
<body>

    <canvas id="magic-canvas"></canvas>

    <a href="index.php" class="btn-ticket">
        <i class="bi bi-ticket-perforated-fill me-2"></i> TAQUILLA
    </a>
    
    <!-- Botón de soporte -->
    <a href="soporte.php" class="btn-soporte">
        <i class="bi bi-tools me-2"></i> SOPORTE
    </a>

    <div class="container pb-5" style="padding-top: 5rem;">
        
        <div class="text-center mb-4 position-relative z-2">
            <h1 class="title-cine">Cine & Cookies</h1>
            <p class="subtitle-cookie mt-2">
                <i class="bi bi-stars text-warning"></i> CARTELERA DE ESTRELLAS <i class="bi bi-stars text-warning"></i>
            </p>
        </div>

        <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <div class="alert alert-popcorn text-center py-3 mb-4 position-relative z-2">
                <i class="bi bi-emoji-sunglasses fs-4 me-2"></i> ¡Entrada VIP reservada con éxito! Disfruta la función. 🍿
            </div>
        <?php endif; ?>

        <?php if ($error_mongo): ?>
            <div class="alert alert-burnt text-center py-3 mb-4 position-relative z-2">
                <i class="bi bi-fire fs-4 me-2"></i> ¡Se quemaron las palomitas! Error: <?= htmlspecialchars($error_mongo) ?>
            </div>
        <?php else: ?>
            
            <div class="marquee-container">
                <div class="row cinema-header d-none d-md-flex">
                    <div class="col-3"><i class="bi bi-person-star"></i> Protagonista</div>
                    <div class="col-2"><i class="bi bi-palette"></i> Tono</div>
                    <div class="col-3"><i class="bi bi-cookie"></i> Snack VIP</div>
                    <div class="col-2"><i class="bi bi-film"></i> Género</div>
                    <div class="col-2"><i class="bi bi-clock"></i> Función</div>
                </div>

                <?php 
                $hay_datos = false;
                $delay = 0; 
                foreach ($documentos as $doc): 
                    $hay_datos = true;
                    $delay += 0.15; 
                ?>
                    <div class="row film-strip" style="animation-delay: <?= $delay ?>s;">
                        <div class="col-12 col-md-3 mb-3 mb-md-0">
                            <div class="film-data-title d-md-none">Protagonista</div>
                            <h3 class="actor-name"><?= htmlspecialchars($doc['apellidos'] ?? '') ?></h3>
                            <div class="text-white-50"><?= htmlspecialchars($doc['nombres'] ?? '') ?></div>
                        </div>
                        <div class="col-6 col-md-2 mb-2 mb-md-0">
                            <div class="film-data-title d-md-none">Tono</div>
                            <div class="film-data-value d-flex align-items-center">
                                <span style="display:inline-block; width:15px; height:15px; border-radius:50%; background:<?= htmlspecialchars($doc['color'] ?? '#ccc') ?>; border: 2px solid #fff; margin-right:8px; box-shadow: 0 0 8px rgba(255,255,255,0.5);"></span>
                                <?= htmlspecialchars($doc['color'] ?? '') ?>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-2 mb-md-0">
                            <div class="film-data-title d-md-none">Snack VIP</div>
                            <div class="film-data-value text-warning">
                                <i class="bi bi-bag-heart-fill me-1"></i> <?= htmlspecialchars($doc['comida'] ?? '') ?>
                            </div>
                        </div>
                        <div class="col-6 col-md-2">
                            <div class="film-data-title d-md-none">Género</div>
                            <div class="film-data-value" style="color: #00e5ff;">
                                <?= htmlspecialchars($doc['pelicula'] ?? '') ?>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 text-md-end">
                            <div class="film-data-title d-md-none">Función</div>
                            <span class="badge bg-secondary rounded-pill py-2 px-3 fs-6" style="border: 1px dashed #fff;">
                                <?= htmlspecialchars($doc['registro'] ?? 'N/A') ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (!$hay_datos): ?>
                    <div class="empty-state">
                        <div style="font-size: 4rem;">🍿🎬😴</div>
                        <h3 class="mt-3" style="font-family: 'Righteous', cursive; color: var(--cinema-dark);">El cine está vacío</h3>
                        <p class="text-muted">Ve a taquilla y registra la primera estrella.</p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        const canvas = document.getElementById('magic-canvas');
        const ctx = canvas.getContext('2d');
        let width, height;
        let particles = [];
        const emojis = ['🍪', '🍿', '🎬', '✨', '🎟️', '⭐'];

        function init() {
            width = canvas.width = window.innerWidth; height = canvas.height = window.innerHeight;
            particles = [];
            for (let i = 0; i < 20; i++) particles.push(new EmojiParticle());
        }

        class EmojiParticle {
            constructor() { this.reset(); this.y = Math.random() * height; }
            reset() {
                this.x = Math.random() * width; this.y = height + Math.random() * 100;
                this.size = Math.random() * 20 + 15; this.speed = Math.random() * 1.5 + 0.5;
                this.sway = Math.random() * 2 - 1; this.emoji = emojis[Math.floor(Math.random() * emojis.length)];
                this.rotation = Math.random() * 360; this.rotSpeed = (Math.random() - 0.5) * 2;
            }
            update() {
                this.y -= this.speed; this.x += Math.sin(this.y / 50) * this.sway; this.rotation += this.rotSpeed;
                if (this.y < -50) this.reset();
            }
            draw() {
                ctx.save(); ctx.translate(this.x, this.y); ctx.rotate(this.rotation * Math.PI / 180);
                ctx.font = `${this.size}px Arial`; ctx.textAlign = "center"; ctx.textBaseline = "middle";
                ctx.globalAlpha = 0.6; ctx.fillText(this.emoji, 0, 0); ctx.restore();
            }
        }

        function animate() {
            ctx.clearRect(0, 0, width, height);
            particles.forEach(p => { p.update(); p.draw(); });
            requestAnimationFrame(animate);
        }
        window.addEventListener('resize', init); init(); animate();
    </script>
</body>
</html>
