<!DOCTYPE html>
<html lang="es-MX" data-basepath="<?= $basePath ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Plataforma de preservación cultural y lingüística del Tu'un Savi (Lengua Mixteca) de San Miguel El Grande, Oaxaca. Diccionario, historias, leyendas y gastronomía.">
    <meta name="keywords" content="Mixteco, Tu'un Savi, San Miguel el Grande, Oaxaca, Diccionario Mixteco, Leyendas Mixtecas, Gastronomía">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : "Tu'un Savi - Lengua Mixteca" ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@500;700&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $basePath ?>/public/css/style.css">
<link rel="stylesheet" href="<?php echo $basePath ?>/public/css/components.css">
<link rel="stylesheet" href="<?php echo $basePath ?>/public/css/animations.css">
</head>
<body>
    <header class="main-header glass-header">
        <div class="container navbar">
            <div class="logo">
                <svg class="logo-mark" viewBox="0 0 28 28" aria-hidden="true">
                  <path d="M2 26 L2 16 L10 16 L10 8 L18 8 L18 2 L26 2" fill="none" stroke="#9B2226" stroke-width="3"/>
                </svg>
                <a href="<?= $basePath ?: '/' ?>">San Miguel el Grande</a>
            </div>
            <button class="menu-toggle" id="menuToggle" aria-label="Abrir menú de navegación">
                <i class="fas fa-bars"></i>
            </button>
            <nav class="nav-links" id="navLinks">
                <div class="dropdown">
                    <button class="dropbtn">ES <i class="fas fa-chevron-down"></i></button>
                    <div class="dropdown-content">
                        <a href="#">Mixteco</a>
                    </div>
                </div>
                <a href="<?= $basePath ?>/diccionario">Diccionario</a>
                <div class="dropdown">
                    <button class="dropbtn">Historias <i class="fas fa-chevron-down"></i></button>
                    <div class="dropdown-content">
                        <a href="<?= $basePath ?>/historias">Historias</a>
                        <a href="<?= $basePath ?>/leyendas">Leyendas</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Turismo <i class="fas fa-chevron-down"></i></button>
                    <div class="dropdown-content">
                        <a href="<?= $basePath ?>/lugares">Lugares</a>
                        <a href="<?= $basePath ?>/gastronomia">Gastronomía</a>
                    </div>
                </div>
                <a href="<?= $basePath ?>/admin" class="user-icon" title="Panel de Administración" aria-label="Panel de Administración"><i class="fas fa-cog"></i> Admin</a>
            </nav>
        </div>
    </header>
