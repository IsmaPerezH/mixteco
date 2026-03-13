<?php
$platillos = isset($platillos) ? $platillos : [];
$bebidas = isset($bebidas) ? $bebidas : [];

function esc_gastro($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function gastro_img($value) {
    $value = $value ?? '';
    if ($value === '') {
        return '/mixteco/public/img/Pozole-blanco.jpg';
    }
    if (preg_match('~^https?://|^/~', $value)) {
        return $value;
    }
    return '/mixteco/public/img/ima_gasgro/' . $value;
}
?>

<main class="historias-main">
    <header class="hero-gastronomia" role="img" aria-label="Pozole blanco">
        <h1 class="hero-title">Gastronomia de San Miguel</h1>
    </header>

    <div class="container container-gastronomia">
        <section class="gastro-section">
            <div class="gastro-section-header">
                <h2 class="gastro-section-title">Platillos Tipicos</h2>
            </div>

            <div class="gastro-carousel">
                <button class="gastro-nav-btn gastro-nav-left" type="button" data-target="gastro-platillos" data-dir="left" aria-label="Desplazar platillos a la izquierda">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="gastro-grid" id="gastro-platillos">
                <?php if (!empty($platillos)) : ?>
                    <?php foreach ($platillos as $item) : ?>
                        <article class="gastro-card">
                            <div class="gastro-img-container">
                                <img src="<?= esc_gastro(gastro_img($item['imagen'] ?? '')) ?>" alt="<?= esc_gastro($item['nombre'] ?? '') ?>">
                            </div>
                            <div class="gastro-content">
                                <h3 class="gastro-card-title"><?= esc_gastro($item['nombre'] ?? '') ?></h3>
                                <p class="gastro-text"><?= esc_gastro($item['resumen'] ?? '') ?></p>
                                <button class="btn-ghost gastro-ver-mas" type="button" data-origen="<?= esc_gastro($item['origen'] ?? '') ?>" data-nombre="<?= esc_gastro($item['nombre'] ?? '') ?>" data-imagen="<?= esc_gastro(gastro_img($item['imagen'] ?? '')) ?>">
                                    Ver mas <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else : ?>
                    <article class="gastro-card">
                        <div class="gastro-img-container">
                            <img src="/mixteco/public/img/Pozole-blanco.jpg" alt="Sin platillos">
                        </div>
                        <div class="gastro-content">
                            <h3 class="gastro-card-title">Sin platillos</h3>
                            <p class="gastro-text">Aun no hay platillos registrados.</p>
                        </div>
                    </article>
                <?php endif; ?>
                </div>
                <button class="gastro-nav-btn gastro-nav-right" type="button" data-target="gastro-platillos" data-dir="right" aria-label="Desplazar platillos a la derecha">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>

        <section class="gastro-section">
            <div class="gastro-section-header">
                <h2 class="gastro-section-title">Bebidas Tradicionales</h2>
            </div>

            <div class="gastro-carousel">
                <button class="gastro-nav-btn gastro-nav-left" type="button" data-target="gastro-bebidas" data-dir="left" aria-label="Desplazar bebidas a la izquierda">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="gastro-grid" id="gastro-bebidas">
                <?php if (!empty($bebidas)) : ?>
                    <?php foreach ($bebidas as $item) : ?>
                        <article class="gastro-card">
                            <div class="gastro-img-container">
                                <img src="<?= esc_gastro(gastro_img($item['imagen'] ?? '')) ?>" alt="<?= esc_gastro($item['nombre'] ?? '') ?>">
                            </div>
                            <div class="gastro-content">
                                <h3 class="gastro-card-title"><?= esc_gastro($item['nombre'] ?? '') ?></h3>
                                <p class="gastro-text"><?= esc_gastro($item['resumen'] ?? '') ?></p>
                                <button class="btn-ghost gastro-ver-mas" type="button" data-origen="<?= esc_gastro($item['origen'] ?? '') ?>" data-nombre="<?= esc_gastro($item['nombre'] ?? '') ?>" data-imagen="<?= esc_gastro(gastro_img($item['imagen'] ?? '')) ?>">
                                    Ver mas <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else : ?>
                    <article class="gastro-card">
                        <div class="gastro-img-container">
                            <img src="/mixteco/public/img/Pozole-blanco.jpg" alt="Sin bebidas">
                        </div>
                        <div class="gastro-content">
                            <h3 class="gastro-card-title">Sin bebidas</h3>
                            <p class="gastro-text">Aun no hay bebidas registradas.</p>
                        </div>
                    </article>
                <?php endif; ?>
                </div>
                <button class="gastro-nav-btn gastro-nav-right" type="button" data-target="gastro-bebidas" data-dir="right" aria-label="Desplazar bebidas a la derecha">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>
    </div>
</main>

<!-- Modal Origen -->
    <div id="gastro-modal" class="gastro-modal" aria-hidden="true">
    <div class="gastro-modal-content" role="dialog" aria-modal="true" aria-labelledby="gastro-modal-title">
        <div class="gastro-modal-header">
            <h2 id="gastro-modal-title">Origen</h2>
            <button class="gastro-modal-close" type="button" aria-label="Cerrar">&times;</button>
        </div>
        <div class="gastro-modal-media">
            <img id="gastro-modal-img" src="/mixteco/public/img/Pozole-blanco.jpg" alt="Imagen del platillo">
        </div>
        <div class="gastro-modal-body">
            <p id="gastro-modal-text"></p>
        </div>
    </div>
</div>

<script src="/mixteco/public/js/gastronomia.js"></script>
