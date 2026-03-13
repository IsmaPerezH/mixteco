<?php
class LugaresController {
    public function index() {
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
