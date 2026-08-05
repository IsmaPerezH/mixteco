<?php
class HomeController {
    public function index() {
        global $basePath;
        $pageTitle = "Tu'un Savi - Lengua y Cultura Mixteca";
        require_once 'app/views/layout/header.php';
        require_once 'app/views/Home.php';
        require_once 'app/views/layout/footer.php';
    }
}
?>
