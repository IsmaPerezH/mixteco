# Sa’an sau Ñuu Ia kanu - Sistema Web sobre la Lengua Mixteca

Este proyecto es un sistema web diseñado para el rescate y preservación de la lengua mixteca, específicamente enfocado en el municipio de **San Miguel el Grande**. 

## 📝 Descripción
El sistema utiliza una arquitectura **MVC (Modelo-Vista-Controlador)** base en PHP para mantener una estructura organizada y escalable. El diseño está inspirado en la estética moderna, utilizando tipografía Inter y una paleta de colores profesional.

## 🚀 Características
- **Página Principal:** Información detallada sobre la cultura y lengua mixteca.
- **Diccionario:** Buscador alfabético de palabras en mixteco y español.
- **Historias:** Relatos tradicionales de la comunidad.
- **Leyendas:** Mitos y leyendas narrados mediante un sistema de modales interactivos.
- **Gastronomía:** Catálogo visual de platillos y bebidas típicas con navegación horizontal.

## 🛠️ Tecnologías utilizadas
- **Lenguaje:** PHP 8.x
- **Estilos:** Vanilla CSS
- **Interactividad:** JavaScript (Vanilla)
- **Servidor:** Compatible con Apache (vía XAMPP u otros)

## 📂 Estructura del Proyecto
- `app/`: Contiene la lógica del negocio.
  - `controllers/`: Controladores para cada sección.
  - `views/`: Vistas y plantillas (Layouts).
- `public/`: Archivos públicos accesibles.
  - `css/`: Hojas de estilo modulares.
  - `img/`: Recursos gráficos e imágenes.
  - `js/`: Lógica de interactividad del lado del cliente.
- `index.php`: Enrutador principal del sistema.

## ⚙️ Instalación Local
1. Clona este repositorio o descarga el código.
2. Colócalo en la carpeta `htdocs` de tu servidor XAMPP.
3. Asegúrate de que el módulo `mod_rewrite` de Apache esté activado para soportar las URLs limpias definidas en el archivo `.htaccess`.
4. Accede desde tu navegador en `http://localhost/mixteco`.

---
*Desarrollado para el fortalecimiento de la identidad cultural indígena.*
