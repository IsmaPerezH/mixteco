<?php
require_once 'app/models/HistoriasModel.php';

class LeyendasController {
    public function index() {
        global $basePath;
        $pageTitle = "Leyendas de la Región - San Miguel El Grande";

        $model = new HistoriasModel();
        $datos = $model->getHistoriasConImagenes();
        $leyendas = $datos['leyendas'];

        require_once 'app/views/layout/header.php';
        require_once 'app/views/Leyendas.php';
        require_once 'app/views/layout/footer.php';
    }
}
?>
