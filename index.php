<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S.H.I.E.L.D. | Portal de Ingreso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --neon-blue: #00f3ff;
            --deep-blue: #0a1128;
            --alert-red: #ff2a2a;
        }

        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-color: #02040a;
            color: #e2e8f0;
            font-family: 'Rajdhani', sans-serif;
            overflow: hidden;
        }

        /* Canvas para partículas de fondo */
        #bg-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .main-container {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Contenedor Glassmorphism */
        .login-panel {
            background: rgba(10, 17, 40, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 243, 255, 0.2);
            border-radius: 20px;
            padding: 3.5rem;
            box-shadow: 0 0 40px rgba(0, 243, 255, 0.1), inset 0 0 20px rgba(0, 243, 255, 0.05);
            max-width: 480px;
            width: 100%;
            transform: translateY(30px);
            opacity: 0;
            animation: floatUp 1s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            position: relative;
            overflow: hidden;
        }

        /* Efecto de escaneo en el panel */
        .login-panel::before {
            content: '';
            position: absolute;
            top: -100%;
            left: 0;
            width: 100%;
            height: 50%;
            background: linear-gradient(to bottom, rgba(0,243,255,0), rgba(0,243,255,0.1), rgba(0,243,255,0));
            animation: scanline 6s linear infinite;
            pointer-events: none;
        }

        h2 {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-blue);
            text-shadow: 0 0 15px rgba(0, 243, 255, 0.5);
            letter-spacing: 4px;
        }

        .stark-input {
            background: rgba(0, 0, 0, 0.6) !important;
            border: none !important;
            border-bottom: 2px solid rgba(0, 243, 255, 0.3) !important;
            color: var(--neon-blue) !important;
            font-size: 1.1rem;
            padding: 12px 15px;
            border-radius: 5px 5px 0 0;
            transition: all 0.4s ease;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 500;
        }

        .stark-input::placeholder {
            color: rgba(255, 255, 255, 0.4);
            font-weight: 400;
        }

        .stark-input:focus {
            background: rgba(0, 243, 255, 0.05) !important;
            border-bottom: 2px solid var(--neon-blue) !important;
            box-shadow: 0 10px 20px -10px rgba(0, 243, 255, 0.5) !important;
            transform: translateY(-2px);
        }

        .btn-shield {
            background: linear-gradient(45deg, transparent 5%, var(--neon-blue) 5%);
            color: #000;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            border: none;
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 0 15px rgba(0, 243, 255, 0.4);
            margin-top: 1rem;
        }

        .btn-shield::after {
            content: 'AUTORIZAR INGRESO';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(45deg, transparent 5%, #00c3cc 5%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn-shield:hover {
            box-shadow: 0 0 30px rgba(0, 243, 255, 0.8);
            transform: scale(1.02);
            color: #000;
        }

        .btn-shield:hover::after {
            opacity: 1;
        }

        .shield-icon {
            font-size: 4rem;
            color: var(--neon-blue);
            filter: drop-shadow(0 0 15px rgba(0, 243, 255, 0.6));
            animation: pulse-glow 2s infinite alternate;
        }

        .alert-cyber {
            background: rgba(255, 42, 42, 0.1);
            border: 1px solid var(--alert-red);
            color: var(--alert-red);
            font-family: 'Orbitron', sans-serif;
            text-shadow: 0 0 5px rgba(255, 42, 42, 0.5);
            animation: glitch 0.3s cubic-bezier(.25, .46, .45, .94) both infinite;
        }

        /* Animaciones Keyframes */
        @keyframes floatUp {
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes scanline {
            0% { top: -100%; }
            100% { top: 200%; }
        }
        @keyframes pulse-glow {
            from { filter: drop-shadow(0 0 10px rgba(0, 243, 255, 0.4)); transform: scale(1); }
            to { filter: drop-shadow(0 0 25px rgba(0, 243, 255, 0.9)); transform: scale(1.05); }
        }
        @keyframes float-input {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }
    </style>
</head>
<body>
    
    <canvas id="bg-canvas"></canvas>

    <div class="main-container">
        <div class="login-panel">
            <div class="text-center mb-4">
                <i class="bi bi-shield-shaded shield-icon"></i>
                <h2 class="mt-3 text-uppercase fw-bold">Iniciativa Atlas</h2>
                <p class="text-info opacity-75 fw-semibold" style="letter-spacing: 2px;">REGISTRO DE NUEVO OPERATIVO</p>
            </div>
            
            <?php if(isset($_GET['status']) && $_GET['status'] == 'error'): ?>
                <div class="alert alert-cyber text-center small mb-4 py-2">
                    <i class="bi bi-exclamation-triangle-fill"></i> ANOMALÍA DETECTADA: <br>
                    <?= htmlspecialchars($_GET['msg']) ?>
                </div>
            <?php endif; ?>

            <form action="logica.php" method="POST" class="position-relative z-3">
                <div class="mb-4 input-group-cyber">
                    <input type="text" required name="apellidos" class="form-control stark-input" placeholder="Apellidos (Ej. Romanoff)">
                </div>
                <div class="mb-4">
                    <input type="text" required name="nombres" class="form-control stark-input" placeholder="Nombres (Ej. Natasha)">
                </div>
                <div class="mb-4">
                    <input type="text" required name="color" class="form-control stark-input" placeholder="Firma de Color">
                </div>
                <div class="mb-4">
                    <input type="text" required name="comida" class="form-control stark-input" placeholder="Suministro / Comida">
                </div>
                <div class="mb-5">
                    <input type="text" required name="pelicula" class="form-control stark-input" placeholder="Clasificación / Género">
                </div>
                <button type="submit" class="btn btn-shield w-100 py-3 fs-5">AUTORIZAR INGRESO</button>
            </form>
        </div>
    </div>

    <!-- Script para partículas interactivas estilo S.H.I.E.L.D -->
    <script>
        const canvas = document.getElementById('bg-canvas');
        const ctx = canvas.getContext('2d');
        let width, height, particles;

        function init() {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
            particles = [];
            for (let i = 0; i < 60; i++) {
                particles.push(new Particle());
            }
        }

        class Particle {
            constructor() {
                this.x = Math.random() * width;
                this.y = Math.random() * height;
                this.vx = (Math.random() - 0.5) * 0.5;
                this.vy = (Math.random() - 0.5) * 0.5;
                this.radius = Math.random() * 1.5 + 0.5;
            }
            update() {
                this.x += this.vx;
                this.y += this.vy;
                if (this.x < 0 || this.x > width) this.vx *= -1;
                if (this.y < 0 || this.y > height) this.vy *= -1;
            }
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(0, 243, 255, 0.5)';
                ctx.fill();
            }
        }

        function animate() {
            ctx.clearRect(0, 0, width, height);
            
            // Dibujar cuadrícula sutil
            ctx.strokeStyle = 'rgba(0, 243, 255, 0.03)';
            ctx.lineWidth = 1;
            for(let i=0; i<width; i+=50) {
                ctx.beginPath(); ctx.moveTo(i, 0); ctx.lineTo(i, height); ctx.stroke();
            }
            for(let i=0; i<height; i+=50) {
                ctx.beginPath(); ctx.moveTo(0, i); ctx.lineTo(width, i); ctx.stroke();
            }

            // Conectar partículas
            for (let i = 0; i < particles.length; i++) {
                particles[i].update();
                particles[i].draw();
                for (let j = i + 1; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < 120) {
                        ctx.beginPath();
                        ctx.strokeStyle = `rgba(0, 243, 255, ${0.2 - dist/600})`;
                        ctx.lineWidth = 0.5;
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.stroke();
                    }
                }
            }
            requestAnimationFrame(animate);
        }

        window.addEventListener('resize', init);
        init();
        animate();
    </script>
</body>
</html>
