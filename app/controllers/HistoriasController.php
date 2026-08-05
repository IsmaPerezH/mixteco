<?php
require_once 'app/models/HistoriasModel.php';

class HistoriasController {
    public function index() {
        global $basePath;
        $pageTitle = "Historias - San Miguel El Grande";
        
        $model = new HistoriasModel();
        $datos = $model->getHistoriasConImagenes();
        $historias = $datos['historias'];

        require_once 'app/views/layout/header.php';
        require_once 'app/views/Historias.php';
        require_once 'app/views/layout/footer.php';
    }

    public function getDatosDinamicos() {
        $model = new HistoriasModel();
        $datos = $model->getHistoriasConImagenes();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($datos);
        exit;
    }
}
?>
