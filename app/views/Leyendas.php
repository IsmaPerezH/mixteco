<main class="historias-main">
    
    <!-- Hero Section -->
    <header class="hero-historias">
        <h1 class="hero-title">Leyendas de la Región</h1>
    </header>

    <div class="container container-historias">
        
        <!-- Leyendas Section -->
        <div id="leyendas-container" class="historias-grid">
            <!-- Leyendas will be loaded here dynamically by JS -->
            <p>Cargando leyendas...</p>
        </div>

    </div>
</main>

<!-- Universal Modal -->
<div id="modal-historia" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modal-title">Título</h2>
            <span class="close" onclick="cerrarModal()">&times;</span>
        </div>
        <div id="modal-gallery" class="modal-gallery">
            <!-- Modal Images load here -->
        </div>
        <div class="modal-body" id="modal-text">
            <!-- Full content loads here -->
        </div>
    </div>
</div>

<link rel="stylesheet" href="/mixteco/public/css/historias.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="/mixteco/public/js/historias.js"></script>
