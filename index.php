<?php
// Configuración de reporte de errores (desactivar pantalla de errores en producción si se desea)
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// Fijar el directorio de trabajo al directorio de este archivo.
chdir(__DIR__);

$request = $_SERVER['REQUEST_URI'];
// Detectar basePath automáticamente
$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$basePath = ($scriptDir === '' || $scriptDir === '/') ? '' : $scriptDir;

// Quitar el basePath de la URI para obtener la ruta relativa
if ($basePath !== '') {
    $path = parse_url(substr($request, strlen($basePath)), PHP_URL_PATH);
} else {
    $path = parse_url($request, PHP_URL_PATH);
}

if ($path == '' || $path == '/' || $path == '/index.php') {
    require_once 'app/controllers/HomeController.php';
    $controller = new HomeController();
    $controller->index();
} else if ($path == '/diccionario') {
    require_once 'app/controllers/DiccionarioController.php';
    $controller = new DiccionarioController();
    $controller->index();
} else if ($path == '/diccionario/buscar') {
    require_once 'app/controllers/DiccionarioController.php';
    $controller = new DiccionarioController();
    $controller->buscarAjax();
} else if ($path == '/historias') {
    require_once 'app/controllers/HistoriasController.php';
    $controller = new HistoriasController();
    $controller->index();
} else if ($path == '/leyendas') {
    require_once 'app/controllers/LeyendasController.php';
    $controller = new LeyendasController();
    $controller->index();
} else if ($path == '/gastronomia') {
    require_once 'app/controllers/GastronomiaController.php';
    $controller = new GastronomiaController();
    $controller->index();
} else if ($path == '/lugares') {
    require_once 'app/controllers/LugaresController.php';
    $controller = new LugaresController();
    $controller->index();
} else if ($path == '/historias/getDatosDinamicos') {
    require_once 'app/controllers/HistoriasController.php';
    $controller = new HistoriasController();
    $controller->getDatosDinamicos();
} else if ($path == '/admin' || strpos($path, '/admin/') === 0) {
    require_once 'app/controllers/AdminController.php';
    $controller = new AdminController();
    $controller->handle($path);
} else {
    http_response_code(404);
    $pageTitle = "404 - Página no encontrada";
    require_once 'app/views/layout/header.php';
    echo '<main class="container" style="padding: 5rem 1rem; text-align: center;">
            <i class="fas fa-exclamation-triangle" style="font-size: 4rem; color: #e11d48; margin-bottom: 1.5rem;"></i>
            <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">404 - Página no encontrada</h1>
            <p style="font-size: 1.1rem; color: #4b5563; margin-bottom: 2rem;">Lo sentimos, la página que buscas no existe o ha sido movida.</p>
            <a href="' . ($basePath ?: '/') . '" class="btn-ghost" style="padding: 0.75rem 1.5rem; display: inline-flex; align-items: center; gap: 0.5rem; border-radius: 0.5rem; text-decoration: none;">
                <i class="fas fa-home"></i> Volver al Inicio
            </a>
          </main>';
    require_once 'app/views/layout/footer.php';
}
?>
