<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎬 Taquilla | Cine & Cookies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Nunito:wght@400;600;800&family=Righteous&display=swap" rel="stylesheet">
    
    <style>
        :root { --cinema-red: #e50914; --cinema-dark: #2b0a11; --gold: #ffc107; --cookie-cream: #fdf6e3; --cookie-brown: #8b4513; }
        body, html { margin: 0; padding: 0; width: 100%; height: 100%; background: linear-gradient(135deg, var(--cinema-dark) 0%, #1a060a 100%); color: var(--cookie-cream); font-family: 'Nunito', sans-serif; overflow: hidden; position: relative; }
        #magic-canvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; pointer-events: none; }
        .main-container { position: relative; z-index: 10; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .ticket-booth { background: var(--cookie-cream); border: 10px solid var(--cinema-red); border-radius: 25px; padding: 3rem 2.5rem; box-shadow: 0 0 0 6px var(--cinema-dark), 0 20px 40px rgba(0,0,0,0.6), inset 0 0 20px rgba(0,0,0,0.05); max-width: 450px; width: 100%; transform: translateY(30px); opacity: 0; animation: floatUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; position: relative; color: var(--cinema-dark); }
        .ticket-booth::before { content: ''; position: absolute; top: -5px; left: -5px; right: -5px; bottom: -5px; border: 5px dotted var(--gold); border-radius: 20px; pointer-events: none; animation: blink-lights 1.5s infinite alternate; }
        .ticket-booth::after { content: 'TAQUILLA'; position: absolute; top: -25px; left: 50%; transform: translateX(-50%); background: var(--gold); color: var(--cinema-dark); font-family: 'Righteous', cursive; padding: 5px 20px; border-radius: 20px; border: 3px solid var(--cinema-red); font-size: 1.2rem; box-shadow: 0 5px 10px rgba(0,0,0,0.3); letter-spacing: 2px; }
        .title-cine { font-family: 'Lobster', cursive; font-size: 3.5rem; color: var(--cinema-red); text-shadow: 2px 2px 0 var(--gold); text-align: center; line-height: 1.1; margin-bottom: 5px; }
        .subtitle { font-family: 'Righteous', cursive; text-align: center; color: var(--cookie-brown); margin-bottom: 1.5rem; font-size: 1.1rem; }
        .input-cookie { background: #fff !important; border: 2px dashed var(--cookie-brown) !important; color: var(--cinema-dark) !important; font-size: 1.1rem; padding: 12px 15px; border-radius: 12px; transition: all 0.3s ease; font-family: 'Nunito', sans-serif; font-weight: 600; }
        .input-cookie::placeholder { color: #a88b7d; font-weight: 600; }
        .input-cookie:focus { background: #fff8f0 !important; border-color: var(--cinema-red) !important; border-style: solid !important; box-shadow: 0 5px 15px rgba(229, 9, 20, 0.2) !important; transform: translateY(-2px); }
        .btn-ticket { background: linear-gradient(to bottom, #ffd700, #daa520); color: #4a3000; font-family: 'Righteous', cursive; font-size: 1.3rem; padding: 12px; border-radius: 12px; border: 2px dashed #8b6508; box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4); transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); width: 100%; margin-top: 1rem; position: relative; overflow: hidden; }
        .btn-ticket:hover { transform: scale(1.03); box-shadow: 0 8px 25px rgba(255, 215, 0, 0.6); color: #000; }
        .alert-burnt { background: #f8d7da; border: 2px dashed #f5c6cb; color: #721c24; border-radius: 12px; font-weight: bold; font-family: 'Nunito', sans-serif; box-shadow: 0 5px 15px rgba(0,0,0,0.05); animation: shake 0.5s; }
        
        .links-container { display: flex; justify-content: space-between; margin-top: 1.5rem; }
        .link-bot { color: var(--cookie-brown); font-family: 'Righteous', cursive; text-decoration: none; font-size: 0.9rem; transition: color 0.3s; }
        .link-bot:hover { color: var(--cinema-red); text-decoration: underline; }
        
        @keyframes floatUp { to { transform: translateY(0); opacity: 1; } }
        @keyframes blink-lights { 0% { border-color: var(--gold); opacity: 1; filter: drop-shadow(0 0 5px var(--gold)); } 100% { border-color: #ff9800; opacity: 0.5; filter: drop-shadow(0 0 0px transparent); } }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-5px); } 50% { transform: translateX(5px); } 75% { transform: translateX(-5px); } }
    </style>
</head>
<body>
    <canvas id="magic-canvas"></canvas>

    <div class="main-container">
        <div class="ticket-booth">
            <h1 class="title-cine">Cine & Cookies</h1>
            <p class="subtitle"><i class="bi bi-stars text-warning"></i> RESERVA TU ASIENTO VIP <i class="bi bi-stars text-warning"></i></p>
            
            <?php if(isset($_GET['status']) && $_GET['status'] == 'error'): ?>
                <div class="alert alert-burnt text-center small mb-4 py-2">
                    <i class="bi bi-exclamation-octagon-fill fs-5"></i><br>
                    ¡Ups! Ocurrió un problema:<br>
                    <?= htmlspecialchars($_GET['msg']) ?>
                </div>
            <?php endif; ?>

            <form action="logica.php" method="POST" class="position-relative z-3">
                <div class="mb-3">
                    <input type="text" required name="apellidos" class="form-control input-cookie" placeholder="Apellidos (Ej. Pérez)">
                </div>
                <div class="mb-3">
                    <input type="text" required name="nombres" class="form-control input-cookie" placeholder="Nombres (Ej. Ana)">
                </div>
                <div class="mb-3">
                    <input type="text" required name="color" class="form-control input-cookie" placeholder="Color Favorito (Ej. Rojo)">
                </div>
                <div class="mb-3">
                    <input type="text" required name="comida" class="form-control input-cookie" placeholder="Snack Favorito (Ej. Palomitas)">
                </div>
                <div class="mb-4">
                    <input type="text" required name="pelicula" class="form-control input-cookie" placeholder="Género (Ej. Comedia)">
                </div>
                
                <button type="submit" class="btn-ticket">
                    <i class="bi bi-ticket-detailed-fill me-2"></i> OBTENER ENTRADA
                </button>

                <div class="links-container">
                    <a href="soporte.php" class="link-bot text-danger">
                        <i class="bi bi-tools"></i> Ayuda Técnica
                    </a>
                    <a href="dashboard.php" class="link-bot">
                        <i class="bi bi-eye"></i> Ver Cartelera
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('magic-canvas');
        const ctx = canvas.getContext('2d');
        let width, height;
        let particles = [];
        const emojis = ['🍪', '🍿', '🎬', '✨', '🎟️', '🍩'];

        function init() {
            width = canvas.width = window.innerWidth; height = canvas.height = window.innerHeight;
            particles = [];
            for (let i = 0; i < 15; i++) particles.push(new EmojiParticle());
        }

        class EmojiParticle {
            constructor() { this.reset(); this.y = Math.random() * height; }
            reset() {
                this.x = Math.random() * width; this.y = height + Math.random() * 100;
                this.size = Math.random() * 25 + 15; this.speed = Math.random() * 1.2 + 0.3;
                this.sway = Math.random() * 1.5 - 0.75; this.emoji = emojis[Math.floor(Math.random() * emojis.length)];
                this.rotation = Math.random() * 360; this.rotSpeed = (Math.random() - 0.5) * 1.5;
            }
            update() {
                this.y -= this.speed; this.x += Math.sin(this.y / 60) * this.sway; this.rotation += this.rotSpeed;
                if (this.y < -50) this.reset();
            }
            draw() {
                ctx.save(); ctx.translate(this.x, this.y); ctx.rotate(this.rotation * Math.PI / 180);
                ctx.font = `${this.size}px Arial`; ctx.textAlign = "center"; ctx.textBaseline = "middle";
                ctx.globalAlpha = 0.5; ctx.fillText(this.emoji, 0, 0); ctx.restore();
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
