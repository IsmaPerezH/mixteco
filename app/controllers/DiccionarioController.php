<?php
require_once 'app/config/Database.php';

class DiccionarioController {
    public function index() {
        $database = new Database();
        $db = $database->getConnection();

        // Obtener categorías para el filtro
        $stmtCat = $db->query("SELECT * FROM categorias ORDER BY nombre ASC");
        $categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

        // Obtener filtros de la URL
        $letra = isset($_GET['letra']) ? $_GET['letra'] : null;
        $q = isset($_GET['q']) ? $_GET['q'] : null;
        $cat_id = isset($_GET['categoria']) ? $_GET['categoria'] : null;

        $query = "SELECT d.*, c.nombre as categoria_nombre 
                  FROM diccionario d 
                  LEFT JOIN categorias c ON d.categoria_id = c.id WHERE 1=1";
        
        $params = [];

        if ($letra) {
            $query .= " AND (d.espanol LIKE ? OR d.mixteco LIKE ?)";
            $params[] = $letra . '%';
            $params[] = $letra . '%';
        } 
        
        if ($q) {
            $query .= " AND (d.espanol LIKE ? OR d.mixteco LIKE ?)";
            $params[] = '%' . $q . '%';
            $params[] = '%' . $q . '%';
        }

        if ($cat_id) {
            $query .= " AND d.categoria_id = ?";
            $params[] = $cat_id;
        }

        $query .= " ORDER BY d.espanol ASC";
        
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $palabras = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once 'app/views/layout/header.php';
        require_once 'app/views/Diccionario.php';
        require_once 'app/views/layout/footer.php';
    }
}
?>
