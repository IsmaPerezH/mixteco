<?php
class LugaresController {
    public function index() {
        global $basePath;
        $pageTitle = "Lugares Turísticos - San Miguel El Grande";
        require_once 'app/models/LugaresModel.php';

        $model = new LugaresModel();
        $lugaresNaturales = $model->getByCategoria('naturales');
        $lugaresCulturales = $model->getByCategoria('culturales');

        require_once 'app/views/layout/header.php';
        require_once 'app/views/Lugares.php';
        require_once 'app/views/layout/footer.php';
    }
}
?>
