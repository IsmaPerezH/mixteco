<?php
require_once 'app/config/Database.php';

class AdminModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /* ═══════════════════════════════════════════════════
       HISTORIAS Y LEYENDAS
       ═══════════════════════════════════════════════════ */
    public function getHistorias() {
        $sql = "SELECT h.*, 
                       (SELECT url_imagen FROM historias_imagenes hi WHERE hi.historia_id = h.id LIMIT 1) as imagen_principal,
                       GROUP_CONCAT(hi2.url_imagen SEPARATOR '||') as galeria
                FROM historias h
                LEFT JOIN historias_imagenes hi2 ON h.id = hi2.historia_id
                GROUP BY h.id
                ORDER BY h.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultados as &$row) {
            $row['galeria'] = $row['galeria'] ? explode('||', $row['galeria']) : [];
        }
        return $resultados;
    }

    public function saveHistoria($id, $titulo, $tipo, $resumen, $contenido, $etiqueta, $imagen_principal = null) {
        if ($id) {
            $sql = "UPDATE historias SET titulo = ?, tipo = ?, resumen = ?, contenido = ?, etiqueta = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$titulo, $tipo, $resumen, $contenido, $etiqueta, $id]);
            $historia_id = $id;
        } else {
            $sql = "INSERT INTO historias (titulo, tipo, resumen, contenido, etiqueta) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$titulo, $tipo, $resumen, $contenido, $etiqueta]);
            $historia_id = $this->db->lastInsertId();
        }

        if ($imagen_principal) {
            // Eliminar imagen anterior si existe y agregar la nueva como principal
            $stmtDel = $this->db->prepare("DELETE FROM historias_imagenes WHERE historia_id = ?");
            $stmtDel->execute([$historia_id]);

            $stmtImg = $this->db->prepare("INSERT INTO historias_imagenes (historia_id, url_imagen) VALUES (?, ?)");
            $stmtImg->execute([$historia_id, $imagen_principal]);
        }

        return $historia_id;
    }

    public function deleteHistoria($id) {
        $stmtImg = $this->db->prepare("DELETE FROM historias_imagenes WHERE historia_id = ?");
        $stmtImg->execute([$id]);

        $stmt = $this->db->prepare("DELETE FROM historias WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /* ═══════════════════════════════════════════════════
       DICCIONARIO
       ═══════════════════════════════════════════════════ */
    public function getDiccionario() {
        $sql = "SELECT d.*, c.nombre as categoria_nombre 
                FROM diccionario d 
                LEFT JOIN categorias c ON d.categoria_id = c.id 
                ORDER BY d.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategorias() {
        $stmt = $this->db->query("SELECT * FROM categorias ORDER BY nombre ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function savePalabra($id, $mixteco, $espanol, $categoria_id) {
        if ($id) {
            $sql = "UPDATE diccionario SET mixteco = ?, espanol = ?, categoria_id = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$mixteco, $espanol, $categoria_id, $id]);
        } else {
            $sql = "INSERT INTO diccionario (mixteco, espanol, categoria_id) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$mixteco, $espanol, $categoria_id]);
        }
    }

    public function deletePalabra($id) {
        $stmt = $this->db->prepare("DELETE FROM diccionario WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /* ═══════════════════════════════════════════════════
       GASTRONOMÍA
       ═══════════════════════════════════════════════════ */
    public function getGastronomia() {
        $sql = "SELECT * FROM gastronomia ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveGastronomia($id, $nombre, $resumen, $origen, $categoria, $imagen = null) {
        if ($id) {
            if ($imagen) {
                $sql = "UPDATE gastronomia SET nombre = ?, resumen = ?, origen = ?, categoria = ?, imagen = ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                return $stmt->execute([$nombre, $resumen, $origen, $categoria, $imagen, $id]);
            } else {
                $sql = "UPDATE gastronomia SET nombre = ?, resumen = ?, origen = ?, categoria = ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                return $stmt->execute([$nombre, $resumen, $origen, $categoria, $id]);
            }
        } else {
            $sql = "INSERT INTO gastronomia (nombre, resumen, origen, categoria, imagen) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$nombre, $resumen, $origen, $categoria, $imagen ?: '']);
        }
    }

    public function deleteGastronomia($id) {
        $stmt = $this->db->prepare("DELETE FROM gastronomia WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /* ═══════════════════════════════════════════════════
       LUGARES
       ═══════════════════════════════════════════════════ */
    public function getLugares() {
        $sql = "SELECT * FROM lugares ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveLugar($id, $nombre, $resumen, $origen, $ubicacion, $como_llegar, $categoria, $imagen = null) {
        if ($id) {
            if ($imagen) {
                $sql = "UPDATE lugares SET nombre = ?, resumen = ?, origen = ?, ubicacion = ?, como_llegar = ?, categoria = ?, imagen = ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                return $stmt->execute([$nombre, $resumen, $origen, $ubicacion, $como_llegar, $categoria, $imagen, $id]);
            } else {
                $sql = "UPDATE lugares SET nombre = ?, resumen = ?, origen = ?, ubicacion = ?, como_llegar = ?, categoria = ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                return $stmt->execute([$nombre, $resumen, $origen, $ubicacion, $como_llegar, $categoria, $id]);
            }
        } else {
            $sql = "INSERT INTO lugares (nombre, resumen, origen, ubicacion, como_llegar, categoria, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$nombre, $resumen, $origen, $ubicacion, $como_llegar, $categoria, $imagen ?: '']);
        }
    }

    public function deleteLugar($id) {
        $stmt = $this->db->prepare("DELETE FROM lugares WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
