<?php
class GastronomiaController {
    public function index() {
        require_once 'app/models/GastronomiaModel.php';

        $model = new GastronomiaModel();
        $platillos = $model->getByCategoria('comida');
        $bebidas = $model->getByCategoria('bebida');

        require_once 'app/views/layout/header.php';
        require_once 'app/views/Gastronomia.php';
        require_once 'app/views/layout/footer.php';
    }
}
?>
