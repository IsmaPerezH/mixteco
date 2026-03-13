<?php
$lugaresNaturales = isset($lugaresNaturales) ? $lugaresNaturales : [];
$lugaresCulturales = isset($lugaresCulturales) ? $lugaresCulturales : [];

function esc_lugares($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function lugares_img($value) {
    $value = $value ?? '';
    if ($value === '') {
        return '/mixteco/public/img/ima_lugares/san%20miguel.jpeg';
    }
    if (preg_match('~^https?://|^/~', $value)) {
        return $value;
    }
    return '/mixteco/public/img/ima_lugares/' . $value;
}
?>

<main class="historias-main">
    <header class="hero-lugares" role="img" aria-label="Lugares de San Miguel">
        <h1 class="hero-title">Lugares de San Miguel</h1>
    </header>

    <div class="container container-lugares">
        <section class="lugares-section">
            <div class="lugares-section-header">
                <h2 class="lugares-section-title">Lugares Naturales</h2>
            </div>

            <div class="lugares-carousel">
                <button class="lugares-nav-btn lugares-nav-left" type="button" data-target="lugares-naturales" data-dir="left" aria-label="Desplazar lugares naturales a la izquierda">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="lugares-grid" id="lugares-naturales">
                    <?php if (!empty($lugaresNaturales)) : ?>
                        <?php foreach ($lugaresNaturales as $item) : ?>
                            <article class="lugares-card">
                                <div class="lugares-img-container">
                                    <img src="<?= esc_lugares(lugares_img($item['imagen'] ?? '')) ?>" alt="<?= esc_lugares($item['nombre'] ?? '') ?>">
                                </div>
                                <div class="lugares-content">
                                    <h3 class="lugares-card-title"><?= esc_lugares($item['nombre'] ?? '') ?></h3>
                                    <p class="lugares-text"><?= esc_lugares($item['resumen'] ?? '') ?></p>
                                    <button class="btn-ghost lugares-ver-mas" type="button" data-origen="<?= esc_lugares($item['origen'] ?? '') ?>" data-mapa="<?= esc_lugares($item['ubicacion'] ?? '') ?>" data-como="<?= esc_lugares($item['como_llegar'] ?? '') ?>" data-nombre="<?= esc_lugares($item['nombre'] ?? '') ?>" data-imagen="<?= esc_lugares(lugares_img($item['imagen'] ?? '')) ?>">
                                        Ver mas <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <article class="lugares-card">
                            <div class="lugares-img-container">
                                <img src="/mixteco/public/img/ima_lugares/san%20miguel.jpeg" alt="Sin lugares naturales">
                            </div>
                            <div class="lugares-content">
                                <h3 class="lugares-card-title">Sin lugares naturales</h3>
                                <p class="lugares-text">Aun no hay lugares naturales registrados.</p>
                            </div>
                        </article>
                    <?php endif; ?>
                </div>
                <button class="lugares-nav-btn lugares-nav-right" type="button" data-target="lugares-naturales" data-dir="right" aria-label="Desplazar lugares naturales a la derecha">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>

        <section class="lugares-section">
            <div class="lugares-section-header">
                <h2 class="lugares-section-title">Lugares Culturales</h2>
            </div>

            <div class="lugares-carousel">
                <button class="lugares-nav-btn lugares-nav-left" type="button" data-target="lugares-culturales" data-dir="left" aria-label="Desplazar lugares culturales a la izquierda">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="lugares-grid" id="lugares-culturales">
                    <?php if (!empty($lugaresCulturales)) : ?>
                        <?php foreach ($lugaresCulturales as $item) : ?>
                            <article class="lugares-card">
                                <div class="lugares-img-container">
                                    <img src="<?= esc_lugares(lugares_img($item['imagen'] ?? '')) ?>" alt="<?= esc_lugares($item['nombre'] ?? '') ?>">
                                </div>
                                <div class="lugares-content">
                                    <h3 class="lugares-card-title"><?= esc_lugares($item['nombre'] ?? '') ?></h3>
                                    <p class="lugares-text"><?= esc_lugares($item['resumen'] ?? '') ?></p>
                                    <button class="btn-ghost lugares-ver-mas" type="button" data-origen="<?= esc_lugares($item['origen'] ?? '') ?>" data-mapa="<?= esc_lugares($item['ubicacion'] ?? '') ?>" data-como="<?= esc_lugares($item['como_llegar'] ?? '') ?>" data-nombre="<?= esc_lugares($item['nombre'] ?? '') ?>" data-imagen="<?= esc_lugares(lugares_img($item['imagen'] ?? '')) ?>">
                                        Ver mas <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <article class="lugares-card">
                            <div class="lugares-img-container">
                                <img src="/mixteco/public/img/ima_lugares/san%20miguel.jpeg" alt="Sin lugares culturales">
                            </div>
                            <div class="lugares-content">
                                <h3 class="lugares-card-title">Sin lugares culturales</h3>
                                <p class="lugares-text">Aun no hay lugares culturales registrados.</p>
                            </div>
                        </article>
                    <?php endif; ?>
                </div>
                <button class="lugares-nav-btn lugares-nav-right" type="button" data-target="lugares-culturales" data-dir="right" aria-label="Desplazar lugares culturales a la derecha">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>
    </div>
</main>

<!-- Modal Origen -->
<div id="lugares-modal" class="lugares-modal" aria-hidden="true">
    <div class="lugares-modal-content" role="dialog" aria-modal="true" aria-labelledby="lugares-modal-title">
        <div class="lugares-modal-header">
            <h2 id="lugares-modal-title">Origen</h2>
            <button class="lugares-modal-close" type="button" aria-label="Cerrar">&times;</button>
        </div>
        <div class="lugares-modal-media">
            <img id="lugares-modal-img" src="/mixteco/public/img/ima_lugares/san%20miguel.jpeg" alt="Imagen del lugar">
        </div>
        <div class="lugares-modal-body">
            <div class="lugares-modal-field">
                <span class="lugares-modal-label">Origen</span>
                <p id="lugares-modal-text"></p>
            </div>
            <div class="lugares-modal-field">
                <span class="lugares-modal-label">Ubicacion (Mapa)</span>
                <div class="lugares-modal-map">
                    <iframe id="lugares-modal-map" title="Mapa de ubicacion" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="lugares-modal-field">
                <span class="lugares-modal-label">Como llegar</span>
                <p id="lugares-modal-como"></p>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="/mixteco/public/css/lugares.css">
<script src="/mixteco/public/js/lugares.js"></script>
