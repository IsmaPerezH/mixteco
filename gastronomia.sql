CREATE TABLE IF NOT EXISTS gartronomia (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    resumen TEXT NOT NULL,
    origen VARCHAR(150) NULL,
    categoria ENUM('comida', 'bebida') NOT NULL,
    imagen VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO gartronomia (nombre, resumen, origen, categoria, imagen) VALUES
('Pozole blanco', 'Caldo tradicional con maíz y carne, muy representativo.', 'San Miguel el Grande', 'comida', 'pozole-blanco.jpg'),
('Xtabentún', 'Licor dulce y anisado elaborado con miel de abejas meliponas.', 'Leyenda maya: Se dice que surgió de la tumba de Xtabay, una mujer de noble corazón. En su tumba crecieron flores fragantes, mientras que en la de la aparentemente virtuosa Utz-Colel creció una planta de olor desagradable. En su honor, se creó esta bebida para recordar que la verdadera bondad reside en el corazón. [citation:1][citation:5][citation:7]', 'bebida', 'xtabentun.jpg'),
('Pulque', 'Bebida fermentada del maguey, conocida como la "bebida de los dioses".', 'Leyenda mexica: Quetzalcóatl, al ver a los hombres tristes, buscó a Mayahuel, diosa de la fertilidad. Tras una serie de eventos, Quetzalcóatl enterró los huesos de su amada Mayahuel, de donde surgió el maguey. El pulque que se obtiene de esta planta es un regalo divino para alegrar el corazón de los hombres. [citation:2][citation:6]', 'bebida', 'pulque.jpg'),
('Agua de Obispo', 'Bebida refrescante de Cuaresma hecha con remolacha, frutas y cacahuates.', 'Se originó en el siglo XVI en Zacatecas. Durante la tradición de visitar altares de la Virgen de los Dolores en Cuaresma, los anfitriones ofrecían esta bebida a los visitantes como cortesía después de rezar. Se le conoce también como "Sangre de Cristo" por su característico color rojo. [citation:3]', 'bebida', 'agua-obispo.jpg'),
('Balché', 'Bebida fermentada sagrada para la cultura maya, elaborada con corteza del árbol de balché.', 'Es una bebida ceremonial de origen prehispánico. Los mayas la consideraban sagrada y la utilizaban en rituales para comunicarse con los dioses, quienes según su creencia, fueron los primeros en embriagarse con ella. Los españoles prohibieron su consumo durante la Colonia, pero los mayas solicitaron que se levantara la prohibición argumentando sus beneficios medicinales. [citation:4]', 'bebida', 'balche.jpg'),
('Tequila', 'Destilado del agave azul, la bebida emblemática de México por excelencia.', 'Es una "bebida mestiza" que nació en la región de Tequila, Jalisco. Su origen combina la tradición prehispánica de fermentar el agave con la técnica de destilación traída por los españoles. Durante la Colonia, su producción fue prohibida para favorecer la importación de licores españoles, lo que obligó a su elaboración clandestina hasta que, a mediados del siglo XVII, se autorizó para cobrar impuestos. [citation:6]', 'bebida', 'tequila.jpg');


INSERT INTO gartronomia (nombre, resumen, origen, categoria, imagen) VALUES
('Mole poblano', 'Compleja salsa de chiles, especias y chocolate, servida sobre guajolote o pollo.', 'Leyenda novohispana: En el siglo XVII, Sor Andrea de la Asunción, cocinera del convento de Santa Rosa en Puebla, preparaba una visita para el virrey. Con pocos recursos, decidió "moler" (de ahí "mole") una mezcla de chiles, especias, chocolate y otros ingredientes que tenía a la mano, creando un guiso extraordinario que deleitó al virrey. Otra versión atribuye su creación a Fray Pascual, quien molió más de cien ingredientes en su honor.', 'comida', 'mole-poblano.jpg');

INSERT INTO gartronomia (nombre, resumen, origen, categoria, imagen) VALUES
('Tamales', 'Masa de maíz rellena de carne, chiles, verduras o frutas, envuelta en hojas de maíz o plátano y cocida al vapor.', 'Época prehispánica: Los tamales tienen un origen ritual y sagrado. Eran preparados como ofrenda para los dioses y para acompañar a los guerreros en sus viajes y batallas. Su nombre proviene del náhuatl "tamalli" que significa "envuelto". Hoy, su preparación es un símbolo de unión familiar, especialmente en celebraciones como la Candelaria y el Día de la Independencia, donde reunirse a "tamalear" es una tradición.', 'comida', 'tamales.jpg');

INSERT INTO gartronomia (nombre, resumen, origen, categoria, imagen) VALUES
('Barbacoa de hoyo', 'Carne de borrego envuelta en pencas de maguey, cocida lentamente en un horno subterráneo calentado con piedras y brasas.', 'Tradición prehispánica: Originaria del estado de Hidalgo, su técnica de cocción bajo tierra es heredada de los nativos otomíes y teotihuacanos. La palabra "barbacoa" tiene raíces taínas y significa "hoyo con fuego". Originalmente se cocinaba en agujeros cavados en la tierra donde se colocaban piedras calientes, leña y las pencas de maguey para crear un horno natural. Es un platillo festivo que tradicionalmente se consume los fines de semana y en reuniones familiares.', 'comida', 'barbacoa-borrego.jpg');

INSERT INTO gartronomia (nombre, resumen, origen, categoria, imagen) VALUES
('Tlayuda', 'Tortilla de maíz grande y crujiente, cubierta con frijoles, tasajo, chorizo, queso y salsa.', 'Tradición oaxaqueña: Conocida como la "pizza mexicana", es originaria de los Valles Centrales de Oaxaca. Su preparación es una tradición familiar que se remonta a la época prehispánica, cuando se usaban tortillas grandes como base para transportar y servir alimentos. Hoy es el platillo más representativo de la cocina callejera oaxaqueña.', 'comida', 'tlayuda.jpg');