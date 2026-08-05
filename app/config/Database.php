<?php
/**
 * Database.php
 * Configuración de conexión a la base de datos MySQL (XAMPP local / .env configurable)
 */
class Database {
    private $host;
    private $port;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        // Cargar variables de un archivo .env local si existe
        $this->loadEnv(__DIR__ . '/../../.env');

        $envHost = getenv('DB_HOST');
        $envPort = getenv('DB_PORT');
        $envDb   = getenv('DB_NAME');
        $envUser = getenv('DB_USER');
        $envPass = getenv('DB_PASS');

        $this->host     = ($envHost !== false && $envHost !== '') ? $envHost : ($_ENV['DB_HOST'] ?? 'localhost');
        $this->port     = ($envPort !== false && $envPort !== '') ? (int)$envPort : (int)($_ENV['DB_PORT'] ?? 3306);
        $this->db_name  = ($envDb   !== false && $envDb   !== '') ? $envDb   : ($_ENV['DB_NAME'] ?? 'mixteco_db');
        $this->username = ($envUser !== false && $envUser !== '') ? $envUser : ($_ENV['DB_USER'] ?? 'root');
        $this->password = ($envPass !== false) ? $envPass : ($_ENV['DB_PASS'] ?? '');
    }

    private function loadEnv($filePath) {
        if (!file_exists($filePath)) {
            return;
        }
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || strpos($line, '#') === 0) {
                continue;
            }
            if (strpos($line, '=') !== false) {
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value, " \t\n\r\0\x0B\"'");
                if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                    putenv(sprintf('%s=%s', $name, $value));
                    $_ENV[$name] = $value;
                    $_SERVER[$name] = $value;
                }
            }
        }
    }

    public function getConnection() {
        $this->conn = null;
        try {
            $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4', $this->host, $this->port, $this->db_name);
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            exit("Error crítico de conexión a MySQL (" . htmlspecialchars($this->host) . ":" . $this->port . "): " . htmlspecialchars($e->getMessage()));
        }
        return $this->conn;
    }
}
?>
