<?php
$leyendas = isset($leyendas) ? $leyendas : [];

function esc_leyenda($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function leyenda_img_url($url, $basePath = '') {
    if (!$url) return $basePath . '/public/img/hero_mixteca.jpg';
    if (strpos($url, '/mixteco/') === 0) {
        return $basePath . substr($url, 8);
    }
    if (strpos($url, '/public/') === 0) {
        return $basePath . $url;
    }
    return $url;
}
?>
<main class="historias-main">
    <header class="hero-historias">
        <h1 class="hero-title">Leyendas de la Región</h1>
    </header>

    <div class="container container-historias">
        <div id="leyendas-container" class="historias-grid">
            <?php if (!empty($leyendas)): ?>
                <?php foreach ($leyendas as $item): ?>
                    <article class="historia-card" style="cursor: pointer;" onclick='abrirModal(<?= json_encode($item, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                        <div class="historia-img-container">
                            <img src="<?= esc_leyenda(leyenda_img_url($item['imagen_principal'], $basePath)) ?>" alt="<?= esc_leyenda($item['titulo']) ?>">
                        </div>
                        <div class="historia-content">
                            <span class="historia-tag tag-leyenda"><?= esc_leyenda($item['etiqueta'] ?: 'Leyenda') ?></span>
                            <h3 class="historia-card-title"><?= esc_leyenda($item['titulo']) ?></h3>
                            <p class="historia-text"><?= esc_leyenda($item['resumen']) ?></p>
                            <button class="btn-ghost" type="button">
                                Leer más <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay leyendas disponibles por el momento.</p>
            <?php endif; ?>
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
            <!-- Modal Images -->
        </div>
        <div class="modal-body" id="modal-text">
            <!-- Full content -->
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= $basePath ?>/public/css/historias.css">
<script src="<?= $basePath ?>/public/js/historias.js"></script>
