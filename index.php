<?php
// Enrutador Simple
$request = $_SERVER['REQUEST_URI'];
$basePath = '/mixteco';

// Remover el basePath y cualquier query string
$path = parse_url(str_replace($basePath, '', $request), PHP_URL_PATH);

if ($path == '' || $path == '/' || $path == '/index.php') {
    require_once 'app/controllers/HomeController.php';
    $controller = new HomeController();
    $controller->index();
} else if ($path == '/diccionario') {
    require_once 'app/controllers/DiccionarioController.php';
    $controller = new DiccionarioController();
    $controller->index();
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
} else {
    http_response_code(404);
    echo "<h1>404 - Página no encontrada</h1>";
}
?>
