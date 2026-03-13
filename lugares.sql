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


INSERT INTO lugares (nombre, resumen, origen, ubicacion, como_llegar, categoria, imagen) VALUES ( 'Mirador Adan Aparicio', 'Mirador natural con vista panorámica.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d36135.61364334841!2d-97.65652296706615!3d17.037597080027627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d21cb0d027f9%3A0x7a9ab6b541095197!2sMirador%20Adan%20Aparicio!5e1!3m2!1ses!2smx!4v1773411712032!5m2!1ses!2smx', 
'Subir por el camino de terracería, Pasando el tecnologico.', 'naturales', 'cerro-sol.jpg' );

INSERT INTO lugares (nombre, resumen, origen, ubicacion, como_llegar, categoria, imagen) VALUES ( 'Iglesia de San Miguel Arcángel', 'Cultural de San Miguel el Grande.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2184.123621176802!2d-97.62315307238542!3d17.046224640049648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d1f0add4653d%3A0xa7fe0f44d593657e!2sIglesia%20de%20San%20Miguel%20Arc%C3%A1ngel!5e1!3m2!1ses!2smx!4v1773413227122!5m2!1ses!2smx', 'Ha 10 metros del palacio municipal.', 'culturales', 'inglesia.jpg' );

INSERT INTO lugares (nombre, resumen, origen, ubicacion, como_llegar, categoria, imagen) VALUES ( 'Casa de la Cultura', 'La Casa de la Cultura es el corazón cultural de San Miguel el Grande.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2184.123621176802!2d-97.62315307238542!3d17.046224640049648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d1f0add4653d%3A0xa7fe0f44d593657e!2sIglesia%20de%20San%20Miguel%20Arc%C3%A1ngel!5e1!3m2!1ses!2smx!4v1773413227122!5m2!1ses!2smx', 'Ha 10 metros del palacio municipal.', 'culturales', 'casa-cultura.jpg' );


INSERT INTO lugares (nombre, resumen, origen, ubicacion, como_llegar, categoria, imagen) VALUES 
( 'Cascada Esmeralda', 'Impresionante caída de agua de 30 metros con pozas de color turquesa.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.123456789012!2d-97.61234567890123!3d17.02345678901234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d1a1b2c3d4e5%3A0xf6e7d8c9b0a1f2e3!2sCascada%20Esmeralda!5e1!3m2!1ses!2smx!4v1773413227123!5m2!1ses!2smx', '15 minutos en auto desde el centro, luego 10 minutos caminando por sendero.', 'naturales', 'cascada-esmeralda.jpg' );

INSERT INTO lugares (nombre, resumen, origen, ubicacion, como_llegar, categoria, imagen) VALUES ( 'Museo Comunitario', 'Espacio que resguarda piezas arqueológicas y tradiciones de la región.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.234567890123!2d-97.63456789012345!3d17.03456789012345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d1b2c3d4e5f6%3A0xa1b2c3d4e5f6a7b8!2sMuseo%20Comunitario!5e1!3m2!1ses!2smx!4v1773413227124!5m2!1ses!2smx', 'Junto a la plaza principal, a un costado del palacio municipal.', 'culturales', 'museo-comunitario.jpg' );

INSERT INTO lugares (nombre, resumen, origen, ubicacion, como_llegar, categoria, imagen) VALUES 
( 'Mirador del Cerro', 'Punto panorámico con vista de 360 grados del valle y el pueblo.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.345678901234!2d-97.64567890123456!3d17.04567890123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d1c3d4e5f6a7%3A0xb2c3d4e5f6a7b8c9!2sMirador%20del%20Cerro!5e1!3m2!1ses!2smx!4v1773413227125!5m2!1ses!2smx', 'Subir por la calle Independencia hasta el final, luego 200 escalones.', 'naturales', 'mirador-cerro.jpg' );

INSERT INTO lugares (nombre, resumen, origen, ubicacion, como_llegar, categoria, imagen) VALUES 
( 'Mercado de Artesanías', 'Mercado tradicional donde artesanos locales venden textiles, barro y alebrijes.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.456789012345!2d-97.65678901234567!3d17.05678901234567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d1d4e5f6a7b8%3A0xc3d4e5f6a7b8c9d0!2sMercado%20de%20Artesan%C3%ADas!5e1!3m2!1ses!2smx!4v1773413227126!5m2!1ses!2smx', 'Detrás de la iglesia principal, a 5 minutos caminando.', 'culturales', 'mercado-artesanias.jpg' );