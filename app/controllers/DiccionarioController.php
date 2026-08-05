<?php
require_once 'app/models/DiccionarioModel.php';

class DiccionarioController {
    public function index() {
        global $basePath;
        $model = new DiccionarioModel();

        $categorias = $model->getCategorias();

        $letra = isset($_GET['letra']) ? $_GET['letra'] : null;
        $q = isset($_GET['q']) ? $_GET['q'] : null;
        $cat_id = isset($_GET['categoria']) ? $_GET['categoria'] : null;
        $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

        $resultado = $model->getPalabrasPaginadas($letra, $q, $cat_id, $currentPage, 10);

        $palabras = $resultado['palabras'];
        $totalWords = $resultado['totalWords'];
        $totalPages = $resultado['totalPages'];

        $pageTitle = "Diccionario Mixteco - San Miguel El Grande";

        require_once 'app/views/layout/header.php';
        require_once 'app/views/Diccionario.php';
        require_once 'app/views/layout/footer.php';
    }

    public function buscarAjax() {
        header('Content-Type: application/json; charset=utf-8');
        $q = isset($_GET['q']) ? trim($_GET['q']) : '';
        if (strlen($q) < 2) {
            echo json_encode([]);
            exit;
        }
        $model = new DiccionarioModel();
        $resultados = $model->buscarLive($q, 10);
        echo json_encode($resultados);
        exit;
    }
}
?>
