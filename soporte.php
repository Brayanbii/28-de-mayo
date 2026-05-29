<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🛠️ Soporte | Cine & Cookies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Nunito:wght@400;600;800&family=Righteous&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --cinema-red: #e50914;
            --cinema-dark: #2b0a11;
            --gold: #ffc107;
            --cookie-cream: #fdf6e3;
            --cookie-brown: #8b4513;
        }

        body, html {
            margin: 0; padding: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, var(--cinema-dark) 0%, #1a060a 100%);
            color: var(--cookie-cream);
            font-family: 'Nunito', sans-serif;
            overflow-x: hidden; position: relative;
        }

        #magic-canvas {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; pointer-events: none;
        }

        .main-container {
            position: relative; z-index: 10; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px;
        }

        .ticket-booth {
            background: var(--cookie-cream);
            border: 10px solid #5a3d31; /* Un borde más técnico/marrón */
            border-radius: 25px; padding: 3rem 2.5rem;
            box-shadow: 0 0 0 6px var(--cinema-dark), 0 20px 40px rgba(0,0,0,0.6), inset 0 0 20px rgba(0,0,0,0.05);
            max-width: 500px; width: 100%;
            animation: floatUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            position: relative; color: var(--cinema-dark);
        }

        .ticket-booth::before {
            content: ''; position: absolute; top: -5px; left: -5px; right: -5px; bottom: -5px;
            border: 5px dashed #dc3545; border-radius: 20px; pointer-events: none;
        }

        .ticket-booth::after {
            content: 'SOPORTE TÉCNICO'; position: absolute; top: -25px; left: 50%; transform: translateX(-50%);
            background: #dc3545; color: #fff; font-family: 'Righteous', cursive; padding: 5px 20px;
            border-radius: 20px; border: 3px solid #5a3d31; font-size: 1.2rem; box-shadow: 0 5px 10px rgba(0,0,0,0.3); letter-spacing: 2px;
        }

        .title-cine {
            font-family: 'Lobster', cursive; font-size: 2.8rem; color: #5a3d31; text-align: center; line-height: 1.1; margin-bottom: 5px;
        }

        .subtitle {
            font-family: 'Righteous', cursive; text-align: center; color: #dc3545; margin-bottom: 1.5rem; font-size: 1rem;
        }

        .input-cookie {
            background: #fff !important; border: 2px dashed #5a3d31 !important; color: var(--cinema-dark) !important;
            font-size: 1rem; padding: 12px 15px; border-radius: 12px; transition: all 0.3s ease; font-family: 'Nunito', sans-serif; font-weight: 600;
        }

        .input-cookie:focus {
            background: #fff8f0 !important; border-color: #dc3545 !important; border-style: solid !important;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.2) !important; transform: translateY(-2px);
        }

        .btn-ticket {
            background: linear-gradient(to bottom, #dc3545, #a71d2a); color: #fff; font-family: 'Righteous', cursive; font-size: 1.2rem;
            padding: 12px; border-radius: 12px; border: 2px dashed #ffb3b9; box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
            transition: all 0.3s; width: 100%; margin-top: 1rem; position: relative; overflow: hidden;
        }

        .btn-ticket:hover { transform: scale(1.03); box-shadow: 0 8px 25px rgba(220, 53, 69, 0.6); }

        .btn-volver {
            position: absolute; top: 20px; left: 20px; background: rgba(255,255,255,0.1); color: #fff;
            text-decoration: none; font-family: 'Righteous', cursive; padding: 10px 20px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); z-index: 100; backdrop-filter: blur(5px);
        }
        .btn-volver:hover { background: rgba(255,255,255,0.2); color: #fff; }

        @keyframes floatUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    </style>
</head>
<body>
    <canvas id="magic-canvas"></canvas>

    <a href="index.php" class="btn-volver"><i class="bi bi-arrow-left-circle-fill me-2"></i> Volver al Inicio</a>

    <div class="main-container">
        <div class="ticket-booth">
            
            <h1 class="title-cine">Taller del Proyector</h1>
            <p class="subtitle"><i class="bi bi-tools"></i> ¿Se quemaron las palomitas o falló la web? <i class="bi bi-tools"></i></p>
            
            <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                <div class="alert alert-success text-center fw-bold py-2" style="border-radius: 12px; border: 2px dashed #198754;">
                    <i class="bi bi-check-circle-fill me-2"></i> ¡Reporte enviado! Nuestro técnico lo revisará pronto. 🍿🔧
                </div>
            <?php endif; ?>
            <?php if(isset($_GET['status']) && $_GET['status'] == 'error'): ?>
                <div class="alert alert-danger text-center fw-bold py-2" style="border-radius: 12px; border: 2px dashed #dc3545;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Error al enviar: <?= htmlspecialchars($_GET['msg']) ?>
                </div>
            <?php endif; ?>

            <form action="logica_soporte.php" method="POST" class="position-relative z-3">
                <div class="mb-3">
                    <label class="form-label fw-bold text-muted small mb-1">Datos de Contacto</label>
                    <input type="text" required name="contacto" class="form-control input-cookie" placeholder="Email o Teléfono">
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold text-muted small mb-1">Tipo de Fallo</label>
                    <select required name="tipo_fallo" class="form-control input-cookie form-select">
                        <option value="" disabled selected>Selecciona el problema...</option>
                        <option value="Error visual en la página">Error visual en la página (Pantalla rota)</option>
                        <option value="No carga la cartelera">No carga la cartelera (Proyector atascado)</option>
                        <option value="Problema al reservar entrada">Problema al reservar entrada (Taquilla cerrada)</option>
                        <option value="Otro">Otro (Invasión alienígena)</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-muted small mb-1">Descripción del Problema</label>
                    <textarea required name="descripcion" class="form-control input-cookie" rows="3" placeholder="Cuéntanos qué pasó detalladamente..."></textarea>
                </div>
                
                <button type="submit" class="btn-ticket">
                    <i class="bi bi-send-fill me-2"></i> ENVIAR REPORTE
                </button>
            </form>
        </div>
    </div>

    <script>
        // Lluvia de herramientas y alertas
        const canvas = document.getElementById('magic-canvas');
        const ctx = canvas.getContext('2d');
        let width, height;
        let particles = [];
        const emojis = ['🔧', '⚙️', '🔌', '⚠️', '💻', '🍿'];

        function init() {
            width = canvas.width = window.innerWidth; height = canvas.height = window.innerHeight;
            particles = [];
            for (let i = 0; i < 20; i++) particles.push(new EmojiParticle());
        }

        class EmojiParticle {
            constructor() { this.reset(); this.y = Math.random() * height; }
            reset() {
                this.x = Math.random() * width; this.y = height + Math.random() * 100;
                this.size = Math.random() * 20 + 15; this.speed = Math.random() * 1 + 0.5;
                this.sway = Math.random() * 1.5 - 0.75;
                this.emoji = emojis[Math.floor(Math.random() * emojis.length)];
                this.rotation = Math.random() * 360; this.rotSpeed = (Math.random() - 0.5) * 1.5;
            }
            update() {
                this.y -= this.speed; this.x += Math.sin(this.y / 60) * this.sway; this.rotation += this.rotSpeed;
                if (this.y < -50) this.reset();
            }
            draw() {
                ctx.save(); ctx.translate(this.x, this.y); ctx.rotate(this.rotation * Math.PI / 180);
                ctx.font = `${this.size}px Arial`; ctx.textAlign = "center"; ctx.textBaseline = "middle";
                ctx.globalAlpha = 0.4; ctx.fillText(this.emoji, 0, 0); ctx.restore();
            }
        }

        function animate() {
            ctx.clearRect(0, 0, width, height);
            particles.forEach(p => { p.update(); p.draw(); });
            requestAnimationFrame(animate);
        }

        window.addEventListener('resize', init);
        init(); animate();
    </script>
</body>
</html>
