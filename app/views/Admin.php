<?php
global $basePath;
$basePath = $basePath ?? '';
$tab = $_GET['tab'] ?? 'dashboard';
$msg = $_GET['msg'] ?? null;

$historias   = is_array($historias ?? null) ? $historias : [];
$diccionario = is_array($diccionario ?? null) ? $diccionario : [];
$categorias  = is_array($categorias ?? null) ? $categorias : [];
$gastronomia = is_array($gastronomia ?? null) ? $gastronomia : [];
$lugares     = is_array($lugares ?? null) ? $lugares : [];
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : "Panel de Administración" ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@500;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    :root {
        --paper:        #F8F6F0;
        --paper-dark:   #EAE4D4;
        --ink:          #2A1F1A;
        --ink-soft:     #635347;
        --red:          #9B2226;
        --red-dark:     #6E1518;
        --turq:         #1F6F6B;
        --gold:         #C98A2B;
        --card-bg:      #FFFFFF;
        --border-color: #E2DAC8;
        --shadow-subtle:0 2px 8px rgba(42,31,26,0.05);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
        font-family: 'Inter', sans-serif;
        background: var(--paper);
        color: var(--ink);
        line-height: 1.5;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* === LAYOUT ESTRUCTURAL === */
    .admin-app {
        display: flex;
        min-height: 100vh;
        position: relative;
    }

    /* Backdrop / Overlay para Móvil */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100vw; height: 100vh;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(2px);
        z-index: 99;
    }
    .admin-app.mobile-open .sidebar-overlay {
        display: block;
    }

    /* Sidebar Colapsable */
    .admin-sidebar {
        width: 250px;
        background: var(--ink);
        color: #D9D2C5;
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
        transition: width 0.3s ease, transform 0.3s ease;
        z-index: 100;
    }

    /* Estado Colapsado en Desktop */
    .admin-app.collapsed .admin-sidebar {
        width: 70px;
    }
    .admin-app.collapsed .brand-name,
    .admin-app.collapsed .brand-role,
    .admin-app.collapsed .menu-item span,
    .admin-app.collapsed .user-details span {
        display: none;
    }
    .admin-app.collapsed .menu-item {
        justify-content: center;
        padding: 0.9rem 0;
        border-left: none;
    }
    .admin-app.collapsed .menu-item i {
        font-size: 1.2rem;
    }
    .admin-app.collapsed .sidebar-brand {
        justify-content: center;
        padding: 1.2rem 0;
    }
    .admin-app.collapsed .sidebar-user {
        justify-content: center;
        padding: 1rem 0;
    }

    .sidebar-brand {
        padding: 1.2rem 1.2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.8rem;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .brand-group {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        min-width: 0;
    }
    .brand-icon { width: 30px; height: 30px; flex-shrink: 0; }
    .brand-name {
        font-family: 'Zilla Slab', serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: #F5EFE4;
        display: block;
        white-space: nowrap;
    }
    .brand-role {
        font-size: 0.68rem;
        color: var(--gold);
        text-transform: uppercase;
        letter-spacing: 1px;
        display: block;
        white-space: nowrap;
    }
    .btn-close-sidebar {
        display: none;
        background: transparent;
        border: none;
        color: #D9D2C5;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 0.3rem 0.5rem;
        border-radius: 4px;
    }
    .btn-close-sidebar:hover { color: #FFF; background: rgba(255,255,255,0.1); }

    .sidebar-menu {
        padding: 1rem 0;
        flex: 1;
    }
    .menu-item {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        padding: 0.85rem 1.3rem;
        color: #D9D2C5;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s;
        border-left: 4px solid transparent;
        white-space: nowrap;
    }
    .menu-item i {
        width: 20px;
        text-align: center;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .menu-item:hover {
        background: rgba(255,255,255,0.05);
        color: #FFF;
    }
    .menu-item.active {
        background: rgba(155, 34, 38, 0.25);
        color: #FFF;
        border-left-color: var(--red);
        font-weight: 600;
    }

    .sidebar-user {
        padding: 1rem 1.2rem;
        border-top: 1px solid rgba(255,255,255,0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .user-details {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 0.88rem;
        color: #F5EFE4;
        white-space: nowrap;
    }
    .btn-logout {
        color: #F87171;
        font-size: 1.1rem;
        padding: 0.3rem 0.5rem;
        border-radius: 4px;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-logout:hover { background: rgba(239,68,68,0.15); }

    /* Área Principal de Contenido */
    .admin-main-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .top-header {
        background: var(--card-bg);
        border-bottom: 1px solid var(--border-color);
        padding: 0.9rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .top-header-left {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        min-width: 0;
        flex: 1;
    }
    .btn-toggle-sidebar {
        background: var(--paper);
        border: 1px solid var(--border-color);
        color: var(--ink);
        width: 38px; height: 38px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.1rem;
        transition: all 0.2s;
        flex-shrink: 0;
    }
    .btn-toggle-sidebar:hover {
        background: var(--paper-dark);
        border-color: var(--ink);
    }
    .page-heading {
        min-width: 0;
    }
    .page-heading h1 {
        font-family: 'Zilla Slab', serif;
        font-size: clamp(1.1rem, 3.5vw, 1.5rem);
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        word-break: break-word;
        line-height: 1.2;
    }
    .btn-site-link {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 0.9rem;
        background: var(--paper);
        border: 1px solid var(--border-color);
        border-radius: 4px;
        color: var(--ink);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.82rem;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .btn-site-link:hover {
        border-color: var(--red);
        color: var(--red);
    }

    .content-wrapper {
        padding: 1.5rem;
        flex: 1;
    }

    /* Notificaciones Banner */
    .alert-banner {
        padding: 0.85rem 1.2rem;
        border-radius: 6px;
        margin-bottom: 1.5rem;
        font-weight: 600;
        font-size: 0.88rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }
    .alert-success { background: #D1E7DD; color: #0F5132; border: 1px solid #BADBCC; }
    .alert-danger  { background: #F8D7DA; color: #842029; border: 1px solid #F5C2C7; }

    /* Tarjetas de Métricas Resumen */
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.2rem;
        margin-bottom: 1.8rem;
    }
    .metric-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 1.2rem 1.4rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: var(--shadow-subtle);
        cursor: pointer;
        transition: transform 0.2s, border-color 0.2s;
    }
    .metric-card:hover {
        transform: translateY(-2px);
        border-color: var(--red);
    }
    .metric-icon {
        width: 44px; height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .bg-red  { background: rgba(155,34,38,0.08); color: var(--red); }
    .bg-turq { background: rgba(31,111,107,0.08); color: var(--turq); }
    .bg-gold { background: rgba(201,138,43,0.08); color: var(--gold); }
    .bg-ink  { background: rgba(42,31,26,0.08);   color: var(--ink); }

    .metric-info .val {
        font-family: 'Zilla Slab', serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--ink);
        line-height: 1;
    }
    .metric-info .lbl {
        font-size: 0.8rem;
        color: var(--ink-soft);
        font-weight: 500;
        margin-top: 0.2rem;
    }

    /* Panel Accesos Rápidos */
    .quick-actions-box {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 1.4rem;
        box-shadow: var(--shadow-subtle);
    }
    .quick-actions-box h2 {
        font-family: 'Zilla Slab', serif;
        font-size: clamp(1.1rem, 3vw, 1.3rem);
        margin-bottom: 0.3rem;
    }
    .quick-actions-box p {
        font-size: 0.88rem;
        color: var(--ink-soft);
        margin-bottom: 1.2rem;
    }
    .actions-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    .action-btn-card {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        background: var(--paper);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 1rem 1.2rem;
        text-align: left;
        cursor: pointer;
        transition: all 0.2s;
    }
    .action-btn-card:hover {
        border-color: var(--red);
        background: var(--card-bg);
    }
    .action-btn-card i {
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    .action-btn-card strong {
        display: block;
        font-size: 0.9rem;
        color: var(--ink);
    }
    .action-btn-card span {
        font-size: 0.78rem;
        color: var(--ink-soft);
    }

    /* Tarjetas de Tablas y Listados */
    .data-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 1.4rem;
        box-shadow: var(--shadow-subtle);
    }
    .table-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.2rem;
        flex-wrap: wrap;
    }
    .search-filter-input {
        position: relative;
        width: 300px;
        max-width: 100%;
    }
    .search-filter-input i {
        position: absolute;
        left: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--ink-soft);
        font-size: 0.85rem;
    }
    .search-filter-input input {
        width: 100%;
        padding: 0.55rem 0.9rem 0.55rem 2.4rem;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        background: var(--paper);
        color: var(--ink);
        font-size: 0.88rem;
    }
    .btn-create-record {
        background: var(--red);
        color: #FFF;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 4px;
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: background 0.2s;
        white-space: nowrap;
    }
    .btn-create-record:hover { background: var(--red-dark); }

    /* Tablas de Datos */
    .table-container { overflow-x: auto; }
    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.88rem;
    }
    .data-table th {
        background: var(--paper);
        color: var(--ink);
        font-weight: 700;
        padding: 0.75rem 0.9rem;
        text-align: left;
        border-bottom: 2px solid var(--border-color);
        white-space: nowrap;
    }
    .data-table td {
        padding: 0.75rem 0.9rem;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }
    .data-table tr:hover { background: rgba(0,0,0,0.01); }

    .tbl-img {
        width: 40px; height: 40px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid var(--border-color);
    }
    .tbl-no-img {
        width: 40px; height: 40px;
        background: var(--paper-dark);
        color: var(--ink-soft);
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
    }
    .cell-title { font-weight: 600; color: var(--ink); word-break: break-word; }
    .cell-desc {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        max-width: 280px;
        font-size: 0.82rem;
        color: var(--ink-soft);
    }
    .cell-mixteco { font-family: 'Zilla Slab', serif; font-size: 1.05rem; font-weight: 700; }
    .empty-row { text-align: center; padding: 2.5rem; color: var(--ink-soft); font-style: italic; }
    .align-right { text-align: right; }

    /* Paginación de Tabla */
    .table-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        margin-top: 0.5rem;
        border-top: 1px solid var(--border-color);
        flex-wrap: wrap;
        gap: 0.8rem;
        font-size: 0.85rem;
        color: var(--ink-soft);
    }
    .pagination-controls {
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .pg-btn {
        background: var(--paper);
        border: 1px solid var(--border-color);
        color: var(--ink);
        padding: 0.35rem 0.75rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.82rem;
        font-weight: 600;
        transition: all 0.15s;
    }
    .pg-btn:hover:not(:disabled) {
        border-color: var(--red);
        color: var(--red);
    }
    .pg-btn:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }
    .pg-num {
        padding: 0.35rem 0.7rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.82rem;
        font-weight: 600;
        background: var(--paper);
        border: 1px solid var(--border-color);
    }
    .pg-num.active {
        background: var(--red);
        color: #FFF;
        border-color: var(--red);
    }

    /* Badges */
    .badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        font-size: 0.72rem;
        font-weight: 700;
        border-radius: 20px;
        white-space: nowrap;
    }
    .badge-red  { background: rgba(155, 34, 38, 0.08); color: var(--red); border: 1px solid var(--red); }
    .badge-turq { background: rgba(31, 111, 107, 0.08); color: var(--turq); border: 1px solid var(--turq); }
    .badge-gold { background: rgba(201, 138, 43, 0.08); color: var(--gold); border: 1px solid var(--gold); }

    /* Acciones */
    .btn-act {
        border: 1px solid transparent;
        background: transparent;
        cursor: pointer;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 0.3rem 0.6rem;
        border-radius: 4px;
        transition: all 0.15s;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        white-space: nowrap;
    }
    .btn-act-edit { color: var(--turq); border-color: rgba(31,111,107,0.3); }
    .btn-act-edit:hover { background: var(--turq); color: #FFF; }
    .btn-act-delete { color: var(--red); border-color: rgba(155,34,38,0.3); }
    .btn-act-delete:hover { background: var(--red); color: #FFF; }

    /* Modales Responsivos */
    .admin-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(3px);
        overflow-y: auto;
        padding: 1.5rem 0.8rem;
    }
    .modal-box {
        background: var(--card-bg);
        max-width: 650px;
        margin: 1rem auto;
        border-radius: 6px;
        border: 1px solid var(--border-color);
        box-shadow: 0 12px 32px rgba(0,0,0,0.2);
        overflow: hidden;
    }
    .modal-head {
        background: var(--paper);
        padding: 1rem 1.4rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border-color);
    }
    .modal-head h2 {
        font-family: 'Zilla Slab', serif;
        font-size: clamp(1.1rem, 3.5vw, 1.3rem);
        color: var(--ink);
        word-break: break-word;
    }
    .modal-close {
        font-size: 1.4rem;
        cursor: pointer;
        color: var(--ink);
        padding: 0.2rem;
    }
    .modal-body { padding: 1.3rem; }
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    .span-2 { grid-column: span 2; }
    .form-field label {
        display: block;
        font-weight: 700;
        font-size: 0.82rem;
        margin-bottom: 0.35rem;
        color: var(--ink);
    }
    .form-field input, .form-field select, .form-field textarea {
        width: 100%;
        padding: 0.55rem 0.8rem;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        background: var(--paper);
        color: var(--ink);
        font-family: 'Inter', sans-serif;
        font-size: 0.88rem;
    }
    .form-field input:focus, .form-field select:focus, .form-field textarea:focus {
        outline: none;
        border-color: var(--red);
    }
    .modal-foot {
        display: flex;
        justify-content: flex-end;
        gap: 0.8rem;
        margin-top: 1.4rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }
    .btn-close-modal {
        padding: 0.55rem 1.1rem;
        background: transparent;
        border: 1px solid var(--border-color);
        color: var(--ink);
        border-radius: 4px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
    }
    .btn-save-record {
        padding: 0.55rem 1.2rem;
        background: var(--red);
        color: #FFF;
        border: none;
        border-radius: 4px;
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .btn-save-record:hover { background: var(--red-dark); }

    /* Layout Móvil Responsivo */
    @media (max-width: 768px) {
        .admin-sidebar {
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            transform: translateX(-100%);
            box-shadow: 4px 0 20px rgba(0,0,0,0.3);
        }
        .admin-app.mobile-open .admin-sidebar {
            transform: translateX(0);
        }
        .btn-close-sidebar {
            display: block;
        }
        .metrics-grid { grid-template-columns: repeat(2, 1fr); }
        .actions-grid { grid-template-columns: 1fr; }
        .top-header { padding: 0.8rem 1rem; }
        .content-wrapper { padding: 1rem; }
        .form-grid { grid-template-columns: 1fr; }
        .span-2 { grid-column: span 1; }
    }
    @media (max-width: 480px) {
        .metrics-grid { grid-template-columns: 1fr; }
        .table-toolbar { flex-direction: column; align-items: stretch; }
        .btn-create-record { width: 100%; justify-content: center; }
    }
    </style>
</head>
<body>

<div class="admin-app" id="adminApp">
    <!-- Overlay / Backdrop para Móvil -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- ═══ NAVEGACIÓN LATERAL COLAPSABLE ═══ -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <div class="brand-group">
                <svg class="brand-icon" viewBox="0 0 28 28" aria-hidden="true">
                    <path d="M2 26 L2 16 L10 16 L10 8 L18 8 L18 2 L26 2" fill="none" stroke="#9B2226" stroke-width="3"/>
                </svg>
                <div>
                    <span class="brand-name">Tu'un Savi</span>
                    <span class="brand-role">Administración</span>
                </div>
            </div>
            <button type="button" class="btn-close-sidebar" onclick="toggleSidebar()" aria-label="Cerrar Menú">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <nav class="sidebar-menu">
            <a href="<?= $basePath ?>/admin?tab=dashboard" class="menu-item <?= $tab === 'dashboard' ? 'active' : '' ?>">
                <i class="fas fa-chart-pie"></i>
                <span>Resumen</span>
            </a>
            <a href="<?= $basePath ?>/admin?tab=historias" class="menu-item <?= $tab === 'historias' ? 'active' : '' ?>">
                <i class="fas fa-book-open"></i>
                <span>Historias y Leyendas</span>
            </a>
            <a href="<?= $basePath ?>/admin?tab=diccionario" class="menu-item <?= $tab === 'diccionario' ? 'active' : '' ?>">
                <i class="fas fa-language"></i>
                <span>Diccionario</span>
            </a>
            <a href="<?= $basePath ?>/admin?tab=gastronomia" class="menu-item <?= $tab === 'gastronomia' ? 'active' : '' ?>">
                <i class="fas fa-utensils"></i>
                <span>Gastronomía</span>
            </a>
            <a href="<?= $basePath ?>/admin?tab=lugares" class="menu-item <?= $tab === 'lugares' ? 'active' : '' ?>">
                <i class="fas fa-map-marked-alt"></i>
                <span>Lugares Turísticos</span>
            </a>
        </nav>

        <div class="sidebar-user">
            <div class="user-details">
                <i class="fas fa-user-circle"></i>
                <span><?= htmlspecialchars($_SESSION['admin_user'] ?? 'Admin') ?></span>
            </div>
            <a href="<?= $basePath ?>/admin/logout" class="btn-logout" title="Cerrar sesión">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </aside>

    <!-- ═══ ÁREA DE CONTENIDO ═══ -->
    <div class="admin-main-area">

        <!-- Top Header del Dashboard -->
        <header class="top-header">
            <div class="top-header-left">
                <button type="button" class="btn-toggle-sidebar" onclick="toggleSidebar()" aria-label="Menu Lateral">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="page-heading">
                    <h1>
                        <?php
                        switch($tab) {
                            case 'historias':   echo '<i class="fas fa-book-open"></i> Historias y Leyendas'; break;
                            case 'diccionario': echo '<i class="fas fa-language"></i> Diccionario Mixteco'; break;
                            case 'gastronomia': echo '<i class="fas fa-utensils"></i> Gastronomía Tradicional'; break;
                            case 'lugares':     echo '<i class="fas fa-map-marked-alt"></i> Lugares Turísticos'; break;
                            default:            echo '<i class="fas fa-chart-pie"></i> Resumen del Sistema'; break;
                        }
                        ?>
                    </h1>
                </div>
            </div>

            <a href="<?= $basePath ?: '/' ?>" target="_blank" class="btn-site-link">
                <i class="fas fa-globe"></i> Ver portal
            </a>
        </header>

        <div class="content-wrapper">

            <!-- Mensajes de Notificación -->
            <?php if ($msg === 'guardado'): ?>
                <div class="alert-banner alert-success">
                    <i class="fas fa-check-circle"></i> Registro guardado correctamente en la base de datos.
                </div>
            <?php elseif ($msg === 'eliminado'): ?>
                <div class="alert-banner alert-danger">
                    <i class="fas fa-trash-alt"></i> Registro eliminado con éxito.
                </div>
            <?php endif; ?>

            <!-- ════ TAB: DASHBOARD OVERVIEW ════ -->
            <?php if ($tab === 'dashboard'): ?>
                <div class="metrics-grid">
                    <div class="metric-card" onclick="window.location.href='<?= $basePath ?>/admin?tab=historias'">
                        <div class="metric-icon bg-red"><i class="fas fa-book-open"></i></div>
                        <div class="metric-info">
                            <div class="val"><?= count($historias) ?></div>
                            <div class="lbl">Historias y Leyendas</div>
                        </div>
                    </div>

                    <div class="metric-card" onclick="window.location.href='<?= $basePath ?>/admin?tab=diccionario'">
                        <div class="metric-icon bg-turq"><i class="fas fa-language"></i></div>
                        <div class="metric-info">
                            <div class="val"><?= count($diccionario) ?></div>
                            <div class="lbl">Palabras Registradas</div>
                        </div>
                    </div>

                    <div class="metric-card" onclick="window.location.href='<?= $basePath ?>/admin?tab=gastronomia'">
                        <div class="metric-icon bg-gold"><i class="fas fa-utensils"></i></div>
                        <div class="metric-info">
                            <div class="val"><?= count($gastronomia) ?></div>
                            <div class="lbl">Platillos y Bebidas</div>
                        </div>
                    </div>

                    <div class="metric-card" onclick="window.location.href='<?= $basePath ?>/admin?tab=lugares'">
                        <div class="metric-icon bg-ink"><i class="fas fa-map-marked-alt"></i></div>
                        <div class="metric-info">
                            <div class="val"><?= count($lugares) ?></div>
                            <div class="lbl">Lugares Turísticos</div>
                        </div>
                    </div>
                </div>

                <div class="quick-actions-box">
                    <h2><i class="fas fa-bolt"></i> Acciones Rápidas</h2>
                    <p>Selecciona una opción para agregar nuevo contenido al portal:</p>

                    <div class="actions-grid">
                        <div class="action-btn-card" onclick="window.location.href='<?= $basePath ?>/admin?tab=historias'; openHistoriaModal();">
                            <i class="fas fa-plus-circle" style="color:var(--red);"></i>
                            <div>
                                <strong>Agregar Historia / Leyenda</strong>
                                <span>Publica relatos tradicionales o mitología mixteca</span>
                            </div>
                        </div>

                        <div class="action-btn-card" onclick="window.location.href='<?= $basePath ?>/admin?tab=diccionario'; openDiccionarioModal();">
                            <i class="fas fa-plus-circle" style="color:var(--turq);"></i>
                            <div>
                                <strong>Agregar Palabra al Diccionario</strong>
                                <span>Amplía el vocabulario mixteco - español</span>
                            </div>
                        </div>

                        <div class="action-btn-card" onclick="window.location.href='<?= $basePath ?>/admin?tab=gastronomia'; openGastronomiaModal();">
                            <i class="fas fa-plus-circle" style="color:var(--gold);"></i>
                            <div>
                                <strong>Agregar Platillo o Bebida</strong>
                                <span>Registra recetas e historia gastronómica</span>
                            </div>
                        </div>

                        <div class="action-btn-card" onclick="window.location.href='<?= $basePath ?>/admin?tab=lugares'; openLugaresModal();">
                            <i class="fas fa-plus-circle" style="color:var(--ink);"></i>
                            <div>
                                <strong>Agregar Lugar Turístico</strong>
                                <span>Registra un atractivo natural o cultural</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- ════ TAB: HISTORIAS Y LEYENDAS ════ -->
            <?php if ($tab === 'historias'): ?>
                <div class="data-card">
                    <div class="table-toolbar">
                        <div class="search-filter-input">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Filtrar por título..." onkeyup="filterTable('tbl-historias', this.value)">
                        </div>
                        <button class="btn-create-record" onclick="openHistoriaModal()">
                            <i class="fas fa-plus"></i> Nueva Leyenda / Historia
                        </button>
                    </div>

                    <div class="table-container">
                        <table class="data-table" id="tbl-historias">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Tipo</th>
                                    <th>Etiqueta</th>
                                    <th>Resumen</th>
                                    <th class="align-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($historias as $item): ?>
                                    <tr>
                                        <td><span class="cell-title"><?= htmlspecialchars($item['titulo']) ?></span></td>
                                        <td>
                                            <span class="badge badge-<?= $item['tipo'] === 'leyenda' ? 'red' : 'turq' ?>">
                                                <?= ucfirst(htmlspecialchars($item['tipo'])) ?>
                                            </span>
                                        </td>
                                        <td><span style="font-size:0.83rem;color:var(--ink-soft);"><?= htmlspecialchars($item['etiqueta'] ?: '-') ?></span></td>
                                        <td><span class="cell-desc"><?= htmlspecialchars($item['resumen']) ?></span></td>
                                        <td class="align-right">
                                            <button class="btn-act btn-act-edit" onclick='editHistoria(<?= json_encode($item, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                                <i class="fas fa-pen"></i> Editar
                                            </button>
                                            <form action="<?= $basePath ?>/admin/historias/eliminar" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro de eliminar este registro?')">
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                <button type="submit" class="btn-act btn-act-delete"><i class="fas fa-trash"></i> Borrar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($historias)): ?>
                                    <tr><td colspan="5" class="empty-row">No hay historias ni leyendas registradas.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-pagination" id="pag-tbl-historias"></div>
                </div>
            <?php endif; ?>

            <!-- ════ TAB: DICCIONARIO ════ -->
            <?php if ($tab === 'diccionario'): ?>
                <div class="data-card">
                    <div class="table-toolbar">
                        <div class="search-filter-input">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Filtrar por palabra..." onkeyup="filterTable('tbl-diccionario', this.value)">
                        </div>
                        <button class="btn-create-record" onclick="openDiccionarioModal()">
                            <i class="fas fa-plus"></i> Nueva Palabra
                        </button>
                    </div>

                    <div class="table-container">
                        <table class="data-table" id="tbl-diccionario">
                            <thead>
                                <tr>
                                    <th>Palabra Mixteco</th>
                                    <th>Traducción Español</th>
                                    <th>Categoría</th>
                                    <th class="align-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($diccionario as $item): ?>
                                    <tr>
                                        <td><span class="cell-mixteco"><?= htmlspecialchars($item['mixteco']) ?></span></td>
                                        <td><?= htmlspecialchars($item['espanol']) ?></td>
                                        <td><span class="badge badge-gold"><?= htmlspecialchars($item['categoria_nombre'] ?: 'General') ?></span></td>
                                        <td class="align-right">
                                            <button class="btn-act btn-act-edit" onclick='editDiccionario(<?= json_encode($item, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                                <i class="fas fa-pen"></i> Editar
                                            </button>
                                            <form action="<?= $basePath ?>/admin/diccionario/eliminar" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro de eliminar esta palabra?')">
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                <button type="submit" class="btn-act btn-act-delete"><i class="fas fa-trash"></i> Borrar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($diccionario)): ?>
                                    <tr><td colspan="4" class="empty-row">No hay palabras registradas en el diccionario.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-pagination" id="pag-tbl-diccionario"></div>
                </div>
            <?php endif; ?>

            <!-- ════ TAB: GASTRONOMÍA ════ -->
            <?php if ($tab === 'gastronomia'): ?>
                <div class="data-card">
                    <div class="table-toolbar">
                        <div class="search-filter-input">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Filtrar platillo..." onkeyup="filterTable('tbl-gastronomia', this.value)">
                        </div>
                        <button class="btn-create-record" onclick="openGastronomiaModal()">
                            <i class="fas fa-plus"></i> Nuevo Platillo / Bebida
                        </button>
                    </div>

                    <div class="table-container">
                        <table class="data-table" id="tbl-gastronomia">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Origen</th>
                                    <th>Resumen</th>
                                    <th class="align-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($gastronomia as $item): ?>
                                    <tr>
                                        <td><span class="cell-title"><?= htmlspecialchars($item['nombre']) ?></span></td>
                                        <td><span class="badge badge-turq"><?= htmlspecialchars($item['categoria']) ?></span></td>
                                        <td><span style="font-size:0.83rem;color:var(--ink-soft);"><?= htmlspecialchars($item['origen'] ?: '-') ?></span></td>
                                        <td><span class="cell-desc"><?= htmlspecialchars($item['resumen']) ?></span></td>
                                        <td class="align-right">
                                            <button class="btn-act btn-act-edit" onclick='editGastronomia(<?= json_encode($item, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                                <i class="fas fa-pen"></i> Editar
                                            </button>
                                            <form action="<?= $basePath ?>/admin/gastronomia/eliminar" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro de eliminar este registro?')">
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                <button type="submit" class="btn-act btn-act-delete"><i class="fas fa-trash"></i> Borrar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($gastronomia)): ?>
                                    <tr><td colspan="5" class="empty-row">No hay registros gastronómicos.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-pagination" id="pag-tbl-gastronomia"></div>
                </div>
            <?php endif; ?>

            <!-- ════ TAB: LUGARES TURÍSTICOS ════ -->
            <?php if ($tab === 'lugares'): ?>
                <div class="data-card">
                    <div class="table-toolbar">
                        <div class="search-filter-input">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Filtrar por lugar..." onkeyup="filterTable('tbl-lugares', this.value)">
                        </div>
                        <button class="btn-create-record" onclick="openLugaresModal()">
                            <i class="fas fa-plus"></i> Nuevo Lugar Turístico
                        </button>
                    </div>

                    <div class="table-container">
                        <table class="data-table" id="tbl-lugares">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Ubicación</th>
                                    <th>Resumen</th>
                                    <th class="align-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lugares as $item): ?>
                                    <tr>
                                        <td><span class="cell-title"><?= htmlspecialchars($item['nombre']) ?></span></td>
                                        <td><span class="badge badge-gold"><?= htmlspecialchars($item['categoria']) ?></span></td>
                                        <td><span style="font-size:0.83rem;color:var(--ink-soft);"><?= htmlspecialchars($item['ubicacion'] ?: '-') ?></span></td>
                                        <td><span class="cell-desc"><?= htmlspecialchars($item['resumen']) ?></span></td>
                                        <td class="align-right">
                                            <button class="btn-act btn-act-edit" onclick='editLugar(<?= json_encode($item, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                                <i class="fas fa-pen"></i> Editar
                                            </button>
                                            <form action="<?= $basePath ?>/admin/lugares/eliminar" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro de eliminar este lugar?')">
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                <button type="submit" class="btn-act btn-act-delete"><i class="fas fa-trash"></i> Borrar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($lugares)): ?>
                                    <tr><td colspan="5" class="empty-row">No hay lugares turísticos registrados.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-pagination" id="pag-tbl-lugares"></div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- ════ MODALES DE CREACIÓN Y EDICIÓN ════ -->

<!-- MODAL 1: HISTORIA / LEYENDA -->
<div id="modal-historia-form" class="admin-modal">
    <div class="modal-box">
        <div class="modal-head">
            <h2 id="modal-historia-title">Nueva Leyenda / Historia</h2>
            <span class="modal-close" onclick="closeAdminModal('modal-historia-form')">&times;</span>
        </div>
        <form action="<?= $basePath ?>/admin/historias/guardar" method="POST" enctype="multipart/form-data" class="modal-body">
            <input type="hidden" name="id" id="h-id">
            
            <div class="form-grid">
                <div class="form-field span-2">
                    <label>Título *</label>
                    <input type="text" name="titulo" id="h-titulo" required placeholder="Ej. El Cimiento del Sol">
                </div>

                <div class="form-field">
                    <label>Tipo *</label>
                    <select name="tipo" id="h-tipo" required>
                        <option value="leyenda">Leyenda</option>
                        <option value="historia">Historia</option>
                    </select>
                </div>

                <div class="form-field">
                    <label>Etiqueta</label>
                    <input type="text" name="etiqueta" id="h-etiqueta" placeholder="Ej. Tradición oral, Origen">
                </div>

                <div class="form-field span-2">
                    <label>Resumen *</label>
                    <textarea name="resumen" id="h-resumen" rows="2" required placeholder="Breve introducción o sinopsis..."></textarea>
                </div>

                <div class="form-field span-2">
                    <label>Contenido Completo *</label>
                    <textarea name="contenido" id="h-contenido" rows="5" required placeholder="Relato completo de la historia o leyenda..."></textarea>
                </div>

                <div class="form-field">
                    <label>Subir Imagen Local</label>
                    <input type="file" name="imagen_archivo" accept="image/*">
                </div>

                <div class="form-field">
                    <label>O URL de Imagen Externa</label>
                    <input type="text" name="imagen_url" id="h-imagen-url" placeholder="https://ejemplo.com/imagen.jpg">
                </div>
            </div>

            <div class="modal-foot">
                <button type="button" class="btn-close-modal" onclick="closeAdminModal('modal-historia-form')">Cancelar</button>
                <button type="submit" class="btn-save-record"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL 2: DICCIONARIO -->
<div id="modal-diccionario-form" class="admin-modal">
    <div class="modal-box">
        <div class="modal-head">
            <h2 id="modal-diccionario-title">Nueva Palabra</h2>
            <span class="modal-close" onclick="closeAdminModal('modal-diccionario-form')">&times;</span>
        </div>
        <form action="<?= $basePath ?>/admin/diccionario/guardar" method="POST" class="modal-body">
            <input type="hidden" name="id" id="d-id">
            
            <div class="form-grid">
                <div class="form-field">
                    <label>Palabra Mixteco *</label>
                    <input type="text" name="mixteco" id="d-mixteco" required placeholder="Ej. Savi">
                </div>

                <div class="form-field">
                    <label>Traducción Español *</label>
                    <input type="text" name="espanol" id="d-espanol" required placeholder="Ej. Lluvia">
                </div>

                <div class="form-field span-2">
                    <label>Categoría</label>
                    <select name="categoria_id" id="d-categoria">
                        <option value="">-- Seleccionar Categoría --</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="modal-foot">
                <button type="button" class="btn-close-modal" onclick="closeAdminModal('modal-diccionario-form')">Cancelar</button>
                <button type="submit" class="btn-save-record"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL 3: GASTRONOMÍA -->
<div id="modal-gastronomia-form" class="admin-modal">
    <div class="modal-box">
        <div class="modal-head">
            <h2 id="modal-gastronomia-title">Nuevo Platillo / Bebida</h2>
            <span class="modal-close" onclick="closeAdminModal('modal-gastronomia-form')">&times;</span>
        </div>
        <form action="<?= $basePath ?>/admin/gastronomia/guardar" method="POST" enctype="multipart/form-data" class="modal-body">
            <input type="hidden" name="id" id="g-id">
            
            <div class="form-grid">
                <div class="form-field">
                    <label>Nombre *</label>
                    <input type="text" name="nombre" id="g-nombre" required placeholder="Ej. Mole Mixteco">
                </div>

                <div class="form-field">
                    <label>Categoría</label>
                    <select name="categoria" id="g-categoria">
                        <option value="Platillos tradicionales">Platillos tradicionales</option>
                        <option value="Bebidas tradicionales">Bebidas tradicionales</option>
                    </select>
                </div>

                <div class="form-field span-2">
                    <label>Origen / Historia</label>
                    <input type="text" name="origen" id="g-origen" placeholder="Ej. Receta ancestral de San Miguel">
                </div>

                <div class="form-field span-2">
                    <label>Resumen / Descripción *</label>
                    <textarea name="resumen" id="g-resumen" rows="3" required placeholder="Ingredientes y modo de preparación..."></textarea>
                </div>

                <div class="form-field">
                    <label>Subir Imagen Local</label>
                    <input type="file" name="imagen_archivo" accept="image/*">
                </div>

                <div class="form-field">
                    <label>O URL de Imagen Externa</label>
                    <input type="text" name="imagen_url" id="g-imagen-url" placeholder="https://ejemplo.com/platillo.jpg">
                </div>
            </div>

            <div class="modal-foot">
                <button type="button" class="btn-close-modal" onclick="closeAdminModal('modal-gastronomia-form')">Cancelar</button>
                <button type="submit" class="btn-save-record"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL 4: LUGARES TURÍSTICOS -->
<div id="modal-lugares-form" class="admin-modal">
    <div class="modal-box">
        <div class="modal-head">
            <h2 id="modal-lugares-title">Nuevo Lugar Turístico</h2>
            <span class="modal-close" onclick="closeAdminModal('modal-lugares-form')">&times;</span>
        </div>
        <form action="<?= $basePath ?>/admin/lugares/guardar" method="POST" enctype="multipart/form-data" class="modal-body">
            <input type="hidden" name="id" id="l-id">
            
            <div class="form-grid">
                <div class="form-field">
                    <label>Nombre del Lugar *</label>
                    <input type="text" name="nombre" id="l-nombre" required placeholder="Ej. El Cimiento del Sol">
                </div>

                <div class="form-field">
                    <label>Categoría</label>
                    <select name="categoria" id="l-categoria">
                        <option value="Sitios naturales">Sitios naturales</option>
                        <option value="Sitios culturales">Sitios culturales</option>
                    </select>
                </div>

                <div class="form-field">
                    <label>Ubicación</label>
                    <input type="text" name="ubicacion" id="l-ubicacion" placeholder="Ej. A 5 km de San Miguel">
                </div>

                <div class="form-field">
                    <label>Cómo Llegar</label>
                    <input type="text" name="como_llegar" id="l-como-llegar" placeholder="Ej. Tomar la desviación a la montaña...">
                </div>

                <div class="form-field span-2">
                    <label>Historia / Significado</label>
                    <input type="text" name="origen" id="l-origen" placeholder="Ej. Sitio sagrado mixteco">
                </div>

                <div class="form-field span-2">
                    <label>Resumen / Descripción *</label>
                    <textarea name="resumen" id="l-resumen" rows="3" required placeholder="Descripción del atractivo turístico..."></textarea>
                </div>

                <div class="form-field">
                    <label>Subir Imagen Local</label>
                    <input type="file" name="imagen_archivo" accept="image/*">
                </div>

                <div class="form-field">
                    <label>O URL de Imagen Externa</label>
                    <input type="text" name="imagen_url" id="l-imagen-url" placeholder="https://ejemplo.com/lugar.jpg">
                </div>
            </div>

            <div class="modal-foot">
                <button type="button" class="btn-close-modal" onclick="closeAdminModal('modal-lugares-form')">Cancelar</button>
                <button type="submit" class="btn-save-record"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleSidebar() {
    const app = document.getElementById('adminApp');
    if (window.innerWidth <= 768) {
        app.classList.toggle('mobile-open');
    } else {
        app.classList.toggle('collapsed');
    }
}

/* ═══ PAGINACIÓN Y FILTRADO ═══ */
const paginationState = {};

function initTablePagination(tableId, pageSize = 5) {
    const table = document.getElementById(tableId);
    if (!table) return;
    const tbody = table.querySelector('tbody');
    const allRows = Array.from(tbody.querySelectorAll('tr'));

    paginationState[tableId] = {
        pageSize: pageSize,
        currentPage: 1,
        filteredRows: allRows
    };

    renderTablePage(tableId);
}

function filterTable(tableId, query) {
    const table = document.getElementById(tableId);
    if (!table) return;
    const tbody = table.querySelector('tbody');
    const allRows = Array.from(tbody.querySelectorAll('tr'));
    const q = query.toLowerCase().trim();

    const filtered = allRows.filter(row => {
        if (row.classList.contains('empty-row')) return false;
        return row.innerText.toLowerCase().includes(q);
    });

    if (!paginationState[tableId]) {
        paginationState[tableId] = { pageSize: 5, currentPage: 1 };
    }
    paginationState[tableId].filteredRows = filtered;
    paginationState[tableId].currentPage = 1;

    renderTablePage(tableId);
}

function renderTablePage(tableId) {
    const state = paginationState[tableId];
    if (!state) return;

    const table = document.getElementById(tableId);
    const tbody = table.querySelector('tbody');
    const allRows = Array.from(tbody.querySelectorAll('tr')).filter(r => !r.classList.contains('empty-row'));

    // Ocultar todas las filas
    allRows.forEach(r => r.style.display = 'none');

    const totalItems = state.filteredRows.length;
    const totalPages = Math.ceil(totalItems / state.pageSize) || 1;

    if (state.currentPage > totalPages) state.currentPage = totalPages;
    if (state.currentPage < 1) state.currentPage = 1;

    const start = (state.currentPage - 1) * state.pageSize;
    const end = start + state.pageSize;

    const pageRows = state.filteredRows.slice(start, end);
    pageRows.forEach(r => r.style.display = '');

    // Renderizar controles de paginación
    const pagContainer = document.getElementById('pag-' + tableId);
    if (!pagContainer) return;

    if (totalItems === 0) {
        pagContainer.innerHTML = '';
        return;
    }

    let html = `<div>Mostrando <strong>${start + 1}</strong> - <strong>${Math.min(end, totalItems)}</strong> de <strong>${totalItems}</strong> registros</div>`;
    html += `<div class="pagination-controls">`;
    html += `<button type="button" class="pg-btn" ${state.currentPage === 1 ? 'disabled' : ''} onclick="changeTablePage('${tableId}', ${state.currentPage - 1})"><i class="fas fa-chevron-left"></i> Ant</button>`;

    for (let i = 1; i <= totalPages; i++) {
        if (i === 1 || i === totalPages || (i >= state.currentPage - 1 && i <= state.currentPage + 1)) {
            html += `<button type="button" class="pg-num ${i === state.currentPage ? 'active' : ''}" onclick="changeTablePage('${tableId}', ${i})">${i}</button>`;
        } else if (i === 2 && state.currentPage > 3) {
            html += `<span style="padding:0 0.2rem;color:var(--ink-soft);">...</span>`;
        } else if (i === totalPages - 1 && state.currentPage < totalPages - 2) {
            html += `<span style="padding:0 0.2rem;color:var(--ink-soft);">...</span>`;
        }
    }

    html += `<button type="button" class="pg-btn" ${state.currentPage === totalPages ? 'disabled' : ''} onclick="changeTablePage('${tableId}', ${state.currentPage + 1})">Sig <i class="fas fa-chevron-right"></i></button>`;
    html += `</div>`;

    pagContainer.innerHTML = html;
}

function changeTablePage(tableId, page) {
    if (paginationState[tableId]) {
        paginationState[tableId].currentPage = page;
        renderTablePage(tableId);
    }
}

// Inicializar paginación al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    ['tbl-historias', 'tbl-diccionario', 'tbl-gastronomia', 'tbl-lugares'].forEach(id => {
        initTablePagination(id, 5);
    });
});

function closeAdminModal(id) {
    document.getElementById(id).style.display = 'none';
}

/* --- HISTORIAS --- */
function openHistoriaModal() {
    document.getElementById('modal-historia-title').textContent = 'Nueva Leyenda / Historia';
    document.getElementById('h-id').value = '';
    document.getElementById('h-titulo').value = '';
    document.getElementById('h-tipo').value = 'leyenda';
    document.getElementById('h-etiqueta').value = '';
    document.getElementById('h-resumen').value = '';
    document.getElementById('h-contenido').value = '';
    document.getElementById('h-imagen-url').value = '';
    document.getElementById('modal-historia-form').style.display = 'block';
}

function editHistoria(item) {
    document.getElementById('modal-historia-title').textContent = 'Editar Leyenda / Historia';
    document.getElementById('h-id').value = item.id;
    document.getElementById('h-titulo').value = item.titulo || '';
    document.getElementById('h-tipo').value = item.tipo || 'leyenda';
    document.getElementById('h-etiqueta').value = item.etiqueta || '';
    document.getElementById('h-resumen').value = item.resumen || '';
    document.getElementById('h-contenido').value = item.contenido || '';
    document.getElementById('h-imagen-url').value = item.imagen_principal || '';
    document.getElementById('modal-historia-form').style.display = 'block';
}

/* --- DICCIONARIO --- */
function openDiccionarioModal() {
    document.getElementById('modal-diccionario-title').textContent = 'Nueva Palabra';
    document.getElementById('d-id').value = '';
    document.getElementById('d-mixteco').value = '';
    document.getElementById('d-espanol').value = '';
    document.getElementById('d-categoria').value = '';
    document.getElementById('modal-diccionario-form').style.display = 'block';
}

function editDiccionario(item) {
    document.getElementById('modal-diccionario-title').textContent = 'Editar Palabra';
    document.getElementById('d-id').value = item.id;
    document.getElementById('d-mixteco').value = item.mixteco || '';
    document.getElementById('d-espanol').value = item.espanol || '';
    document.getElementById('d-categoria').value = item.categoria_id || '';
    document.getElementById('modal-diccionario-form').style.display = 'block';
}

/* --- GASTRONOMÍA --- */
function openGastronomiaModal() {
    document.getElementById('modal-gastronomia-title').textContent = 'Nuevo Platillo / Bebida';
    document.getElementById('g-id').value = '';
    document.getElementById('g-nombre').value = '';
    document.getElementById('g-categoria').value = 'Platillos tradicionales';
    document.getElementById('g-origen').value = '';
    document.getElementById('g-resumen').value = '';
    document.getElementById('g-imagen-url').value = '';
    document.getElementById('modal-gastronomia-form').style.display = 'block';
}

function editGastronomia(item) {
    document.getElementById('modal-gastronomia-title').textContent = 'Editar Platillo / Bebida';
    document.getElementById('g-id').value = item.id;
    document.getElementById('g-nombre').value = item.nombre || '';
    document.getElementById('g-categoria').value = item.categoria || 'Platillos tradicionales';
    document.getElementById('g-origen').value = item.origen || '';
    document.getElementById('g-resumen').value = item.resumen || '';
    document.getElementById('g-imagen-url').value = item.imagen || '';
    document.getElementById('modal-gastronomia-form').style.display = 'block';
}

/* --- LUGARES --- */
function openLugaresModal() {
    document.getElementById('modal-lugares-title').textContent = 'Nuevo Lugar Turístico';
    document.getElementById('l-id').value = '';
    document.getElementById('l-nombre').value = '';
    document.getElementById('l-categoria').value = 'Sitios naturales';
    document.getElementById('l-ubicacion').value = '';
    document.getElementById('l-como-llegar').value = '';
    document.getElementById('l-origen').value = '';
    document.getElementById('l-resumen').value = '';
    document.getElementById('l-imagen-url').value = '';
    document.getElementById('modal-lugares-form').style.display = 'block';
}

function editLugar(item) {
    document.getElementById('modal-lugares-title').textContent = 'Editar Lugar Turístico';
    document.getElementById('l-id').value = item.id;
    document.getElementById('l-nombre').value = item.nombre || '';
    document.getElementById('l-categoria').value = item.categoria || 'Sitios naturales';
    document.getElementById('l-ubicacion').value = item.ubicacion || '';
    document.getElementById('l-como-llegar').value = item.como_llegar || '';
    document.getElementById('l-origen').value = item.origen || '';
    document.getElementById('l-resumen').value = item.resumen || '';
    document.getElementById('l-imagen-url').value = item.imagen || '';
    document.getElementById('modal-lugares-form').style.display = 'block';
}
</script>

</body>
</html>
