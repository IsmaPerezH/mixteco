CREATE TABLE IF NOT EXISTS lugares (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    resumen TEXT NOT NULL,
    origen VARCHAR(150) NULL,
    ubicacion TEXT NULL,
    como_llegar TEXT NULL,
    categoria ENUM('naturales', 'culturales') NOT NULL,
    imagen VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO lugares (nombre, resumen, origen, ubicacion, como_llegar, categoria, imagen) VALUES ( 'Cerro del Sol', 'Mirador natural con vista panorámica.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=...https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18573.05107570581!2d-97.63528402059531!3d17.04271370248135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d21cb0d027f9%3A0x7a9ab6b541095197!2sMirador%20Adan%20Aparicio!5e1!3m2!1ses!2smx!4v1773404165343!5m2!1ses!2smx...', 'Subir por el camino de terracería, 10 min a pie desde el estacionamiento.', 'naturales', 'cerro-sol.jpg' );