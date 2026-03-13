<?php
require_once 'app/config/Database.php';

class HistoriasModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getHistoriasConImagenes() {
        $sql = "SELECT h.*, 
                       (SELECT url_imagen FROM historias_imagenes hi WHERE hi.historia_id = h.id LIMIT 1) as imagen_principal,
                       GROUP_CONCAT(hi2.url_imagen SEPARATOR '||') as galeria
                FROM historias h
                LEFT JOIN historias_imagenes hi2 ON h.id = hi2.historia_id
                GROUP BY h.id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);

        $historias = [];
        $leyendas = [];

        foreach ($resultados as $row) {
            $galeriaArray = $row->galeria ? explode('||', $row->galeria) : [];

            $item = [
                'id' => $row->id,
                'titulo' => $row->titulo,
                'tipo' => $row->tipo,
                'resumen' => $row->resumen,
                'contenido' => $row->contenido,
                'etiqueta' => $row->etiqueta,
                'imagen_principal' => $row->imagen_principal,
                'galeria' => $galeriaArray
            ];

            if ($row->tipo === 'historia') {
                $historias[] = $item;
            } else {
                $leyendas[] = $item;
            }
        }

        return [
            'historias' => $historias,
            'leyendas' => $leyendas
        ];
    }
}
?>