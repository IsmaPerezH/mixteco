<?php
require_once 'app/config/Database.php';

class LugaresModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getByCategoria($categoria) {
        $sql = "SELECT id, nombre, resumen, origen, ubicacion, como_llegar, categoria, imagen
                FROM lugares
                WHERE categoria = ?
                ORDER BY nombre ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoria]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
