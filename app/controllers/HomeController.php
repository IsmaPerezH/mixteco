<?php
class HomeController {
    public function index() {
        // Cargar las vistas en el orden correcto usando la estructura MVC
        require_once 'app/views/layout/header.php';
        require_once 'app/views/home/index.php';
        require_once 'app/views/layout/footer.php';
    }
}
?>
