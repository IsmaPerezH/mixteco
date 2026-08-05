<?php
require_once 'app/config/Database.php';

class DiccionarioModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getCategorias() {
        $stmt = $this->db->query("SELECT * FROM categorias ORDER BY nombre ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPalabrasPaginadas($letra = null, $q = null, $cat_id = null, $currentPage = 1, $perPage = 10) {
        $offset = ($currentPage - 1) * $perPage;

        $baseQuery = "FROM diccionario d LEFT JOIN categorias c ON d.categoria_id = c.id WHERE 1=1";
        $params = [];

        if ($letra) {
            $baseQuery .= " AND (d.espanol LIKE ? OR d.mixteco LIKE ?)";
            $params[] = $letra . '%';
            $params[] = $letra . '%';
        }

        if ($q) {
            $baseQuery .= " AND (d.espanol LIKE ? OR d.mixteco LIKE ?)";
            $params[] = '%' . $q . '%';
            $params[] = '%' . $q . '%';
        }

        if ($cat_id) {
            $baseQuery .= " AND d.categoria_id = ?";
            $params[] = $cat_id;
        }

        // Conteo total
        $countQuery = "SELECT COUNT(*) as total " . $baseQuery;
        $stmtCount = $this->db->prepare($countQuery);
        $stmtCount->execute($params);
        $totalWords = (int) $stmtCount->fetchColumn();
        $totalPages = $totalWords > 0 ? (int) ceil($totalWords / $perPage) : 1;

        // Palabras paginadas
        $query = "SELECT d.*, c.nombre as categoria_nombre " . $baseQuery . " ORDER BY d.espanol ASC LIMIT ? OFFSET ?";
        $stmt = $this->db->prepare($query);

        $bindIndex = 1;
        foreach ($params as $val) {
            $stmt->bindValue($bindIndex, $val);
            $bindIndex++;
        }

        $stmt->bindValue($bindIndex, (int)$perPage, PDO::PARAM_INT);
        $bindIndex++;
        $stmt->bindValue($bindIndex, (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        $palabras = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'palabras' => $palabras,
            'totalWords' => $totalWords,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage
        ];
    }
    public function buscarLive($q, $limit = 10) {
        $term = '%' . $q . '%';
        $sql  = "SELECT d.mixteco, d.espanol, c.nombre AS categoria_nombre
                 FROM diccionario d
                 LEFT JOIN categorias c ON d.categoria_id = c.id
                 WHERE d.espanol LIKE ? OR d.mixteco LIKE ?
                 ORDER BY
                   CASE WHEN d.mixteco LIKE ? THEN 0 ELSE 1 END,
                   d.espanol ASC
                 LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $term);
        $stmt->bindValue(2, $term);
        $stmt->bindValue(3, $q . '%');
        $stmt->bindValue(4, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
