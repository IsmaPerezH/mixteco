<?php
require_once 'app/models/AdminModel.php';

class AdminController {
    private $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->model = new AdminModel();
    }

    private function checkAuth() {
        if (empty($_SESSION['admin_logged_in'])) {
            global $basePath;
            header("Location: " . ($basePath ?: '') . "/admin/login");
            exit;
        }
    }

    public function handle($path) {
        global $basePath;

        if ($path === '/admin/login') {
            $this->login();
        } else if ($path === '/admin/logout') {
            $this->logout();
        } else {
            $this->checkAuth();

            if ($path === '/admin/historias/guardar') {
                $this->guardarHistoria();
            } else if ($path === '/admin/historias/eliminar') {
                $this->eliminarHistoria();
            } else if ($path === '/admin/diccionario/guardar') {
                $this->guardarDiccionario();
            } else if ($path === '/admin/diccionario/eliminar') {
                $this->eliminarDiccionario();
            } else if ($path === '/admin/gastronomia/guardar') {
                $this->guardarGastronomia();
            } else if ($path === '/admin/gastronomia/eliminar') {
                $this->eliminarGastronomia();
            } else if ($path === '/admin/lugares/guardar') {
                $this->guardarLugar();
            } else if ($path === '/admin/lugares/eliminar') {
                $this->eliminarLugar();
            } else {
                $this->index();
            }
        }
    }

    public function login() {
        global $basePath;
        $error = null;

        if (!empty($_SESSION['admin_logged_in'])) {
            header("Location: " . ($basePath ?: '') . "/admin");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario  = trim($_POST['usuario'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // Credenciales de administrador por defecto
            if (($usuario === 'admin' || $usuario === 'administrador') && ($password === 'admin' || $password === 'admin123' || $password === 'mixteco2026')) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_user'] = $usuario;
                header("Location: " . ($basePath ?: '') . "/admin");
                exit;
            } else {
                $error = "Usuario o contraseña incorrectos.";
            }
        }

        $pageTitle = "Iniciar Sesión - Administración";
        require_once 'app/views/AdminLogin.php';
    }

    public function logout() {
        global $basePath;
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_user']);
        session_destroy();
        header("Location: " . ($basePath ?: '') . "/admin/login");
        exit;
    }

    public function index() {
        global $basePath;

        $historias   = $this->model->getHistorias();
        $diccionario = $this->model->getDiccionario();
        $categorias  = $this->model->getCategorias();
        $gastronomia = $this->model->getGastronomia();
        $lugares     = $this->model->getLugares();

        $pageTitle = "Dashboard de Administración - Tu'un Savi";

        require_once 'app/views/Admin.php';
    }

    private function uploadImagen($field) {
        if (!isset($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $file = $_FILES[$field];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        if (!in_array($ext, $allowed)) {
            return null;
        }

        $uploadDir = 'public/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = uniqid('img_') . '.' . $ext;
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return '/public/uploads/' . $filename;
        }

        return null;
    }

    /* ═══ ACCIONES DE HISTORIAS Y LEYENDAS ═══ */
    public function guardarHistoria() {
        global $basePath;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id        = $_POST['id'] ?? null;
            $titulo    = trim($_POST['titulo'] ?? '');
            $tipo      = $_POST['tipo'] ?? 'leyenda';
            $resumen   = trim($_POST['resumen'] ?? '');
            $contenido = trim($_POST['contenido'] ?? '');
            $etiqueta  = trim($_POST['etiqueta'] ?? 'Leyenda');

            $imagen = $this->uploadImagen('imagen_archivo');
            if (!$imagen && !empty($_POST['imagen_url'])) {
                $imagen = trim($_POST['imagen_url']);
            }

            if ($titulo !== '') {
                $this->model->saveHistoria($id, $titulo, $tipo, $resumen, $contenido, $etiqueta, $imagen);
            }
        }
        header("Location: " . ($basePath ?: '') . "/admin?tab=historias&msg=guardado");
        exit;
    }

    public function eliminarHistoria() {
        global $basePath;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $this->model->deleteHistoria($id);
            }
        }
        header("Location: " . ($basePath ?: '') . "/admin?tab=historias&msg=eliminado");
        exit;
    }

    /* ═══ ACCIONES DE DICCIONARIO ═══ */
    public function guardarDiccionario() {
        global $basePath;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id           = $_POST['id'] ?? null;
            $mixteco      = trim($_POST['mixteco'] ?? '');
            $espanol      = trim($_POST['espanol'] ?? '');
            $categoria_id = $_POST['categoria_id'] ?? null;

            if ($mixteco !== '' && $espanol !== '') {
                $this->model->savePalabra($id, $mixteco, $espanol, $categoria_id);
            }
        }
        header("Location: " . ($basePath ?: '') . "/admin?tab=diccionario&msg=guardado");
        exit;
    }

    public function eliminarDiccionario() {
        global $basePath;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $this->model->deletePalabra($id);
            }
        }
        header("Location: " . ($basePath ?: '') . "/admin?tab=diccionario&msg=eliminado");
        exit;
    }

    /* ═══ ACCIONES DE GASTRONOMÍA ═══ */
    public function guardarGastronomia() {
        global $basePath;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id        = $_POST['id'] ?? null;
            $nombre    = trim($_POST['nombre'] ?? '');
            $resumen   = trim($_POST['resumen'] ?? '');
            $origen    = trim($_POST['origen'] ?? '');
            $categoria = $_POST['categoria'] ?? 'Platillos tradicionales';

            $imagen = $this->uploadImagen('imagen_archivo');
            if (!$imagen && !empty($_POST['imagen_url'])) {
                $imagen = trim($_POST['imagen_url']);
            }

            if ($nombre !== '') {
                $this->model->saveGastronomia($id, $nombre, $resumen, $origen, $categoria, $imagen);
            }
        }
        header("Location: " . ($basePath ?: '') . "/admin?tab=gastronomia&msg=guardado");
        exit;
    }

    public function eliminarGastronomia() {
        global $basePath;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $this->model->deleteGastronomia($id);
            }
        }
        header("Location: " . ($basePath ?: '') . "/admin?tab=gastronomia&msg=eliminado");
        exit;
    }

    /* ═══ ACCIONES DE LUGARES ═══ */
    public function guardarLugar() {
        global $basePath;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id          = $_POST['id'] ?? null;
            $nombre      = trim($_POST['nombre'] ?? '');
            $resumen     = trim($_POST['resumen'] ?? '');
            $origen      = trim($_POST['origen'] ?? '');
            $ubicacion   = trim($_POST['ubicacion'] ?? '');
            $como_llegar = trim($_POST['como_llegar'] ?? '');
            $categoria   = $_POST['categoria'] ?? 'Sitios naturales';

            $imagen = $this->uploadImagen('imagen_archivo');
            if (!$imagen && !empty($_POST['imagen_url'])) {
                $imagen = trim($_POST['imagen_url']);
            }

            if ($nombre !== '') {
                $this->model->saveLugar($id, $nombre, $resumen, $origen, $ubicacion, $como_llegar, $categoria, $imagen);
            }
        }
        header("Location: " . ($basePath ?: '') . "/admin?tab=lugares&msg=guardado");
        exit;
    }

    public function eliminarLugar() {
        global $basePath;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $this->model->deleteLugar($id);
            }
        }
        header("Location: " . ($basePath ?: '') . "/admin?tab=lugares&msg=eliminado");
        exit;
    }
}
?>
