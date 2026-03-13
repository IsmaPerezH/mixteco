<?php
class HistoriasController {
    public function index() {
        require_once 'app/views/layout/header.php';
        require_once 'app/views/Historias.php';
        require_once 'app/views/layout/footer.php';
    }

    public function getDatosDinamicos() {
        require_once 'app/models/historiasModel.php';
        $model = new HistoriasModel();
        $datos = $model->getHistoriasConImagenes();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($datos);
        exit;
    }
}
?>
