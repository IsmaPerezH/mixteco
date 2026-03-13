document.addEventListener("DOMContentLoaded", () => {
    cargarHistoriasYLeyendas();
});

let historiasData = [];
let leyendasData = [];

// Variables para el carrusel
let carouselImages = [];
let currentCarouselIndex = 0;

async function cargarHistoriasYLeyendas() {
    try {
        const response = await fetch('/mixteco/historias/getDatosDinamicos');
        const data = await response.json();

        historiasData = data.historias;
        leyendasData = data.leyendas;

        renderizarTarjetas('historias-container', historiasData, 'historia');
        renderizarTarjetas('leyendas-container', leyendasData, 'leyenda');
    } catch (error) {
        console.error("Error al cargar los datos:", error);
    }
}

function renderizarTarjetas(containerId, data, tipoTag) {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = '';

    if (data.length === 0) {
        container.innerHTML = '<p>No hay ' + (tipoTag === 'historia' ? 'historias' : 'leyendas') + ' disponibles por el momento.</p>';
        return;
    }

    data.forEach(item => {
        // Fallback en caso de que no tenga imagen principal
        const imgUrl = item.imagen_principal ? item.imagen_principal : '/mixteco/public/img/placeholder.jpg';
        const tagClass = tipoTag === 'historia' ? 'tag-historia' : 'tag-leyenda';
        const tagText = item.etiqueta ? item.etiqueta : (tipoTag === 'historia' ? 'Historia' : 'Leyenda');

        const cardHTML = `
            <div class="historia-card" onclick='abrirModal(${JSON.stringify(item).replace(/'/g, "&apos;")})' style="cursor: pointer;">
                <div class="historia-img-container">
                    <img src="${imgUrl}" alt="${item.titulo}">
                </div>
                <div class="historia-content">
                    <span class="historia-tag ${tagClass}">${tagText}</span>
                    <h3 class="historia-card-title">${item.titulo}</h3>
                    <p class="historia-text">${item.resumen}</p>
                    <button class="btn-ghost">
                        Leer más <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        `;
        container.innerHTML += cardHTML;
    });
}

function abrirModal(item) {
    const modal = document.getElementById('modal-historia');
    if (!modal) return;

    // Set Modal Header
    document.getElementById('modal-title').textContent = item.titulo;

    // Set Modal Gallery / Carousel
    const galleryContainer = document.getElementById('modal-gallery');
    galleryContainer.innerHTML = '';

    // Filtramos para asegurar que no haya URLs vacíos que rompan el carrusel
    carouselImages = item.galeria ? item.galeria.filter(url => url && url.trim() !== '') : [];
    currentCarouselIndex = 0;

    if (carouselImages.length > 0) {
        galleryContainer.style.display = 'block'; // Usamos block para el contenedor del carrusel relativo

        let carouselHTML = `<div class="carousel-inner">`;

        carouselImages.forEach((imgUrl, index) => {
            const activeClass = index === 0 ? 'active' : '';
            carouselHTML += `
                <div class="carousel-slide ${activeClass}" id="slide-${index}">
                    <img src="${imgUrl}" alt="Imagen de ${item.titulo}">
                </div>
            `;
        });

        carouselHTML += `</div>`;

        // Agregar controles solo si hay más de 1 imagen
        if (carouselImages.length > 1) {
            carouselHTML += `
                <button class="carousel-prev" onclick="cambiarSlide(-1)"><i class="fas fa-chevron-left"></i></button>
                <button class="carousel-next" onclick="cambiarSlide(1)"><i class="fas fa-chevron-right"></i></button>
                <div class="carousel-indicators">
            `;

            carouselImages.forEach((_, index) => {
                const activeClass = index === 0 ? 'active' : '';
                carouselHTML += `<span class="indicator ${activeClass}" onclick="irASlide(${index})"></span>`;
            });

            carouselHTML += `</div>`;
        }

        galleryContainer.innerHTML = carouselHTML;
    } else {
        galleryContainer.style.display = 'none';
        carouselImages = [];
    }

    // Set Modal Body Text
    document.getElementById('modal-text').innerHTML = `<p>${item.contenido.replace(/\n/g, '<br>')}</p>`;

    modal.style.display = "block";
    document.body.style.overflow = "hidden"; // Prevent scrolling when modal is open
}

function cambiarSlide(n) {
    irASlide(currentCarouselIndex + n);
}

function irASlide(index) {
    if (carouselImages.length <= 1) return;

    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.carousel-indicators .indicator');

    // Ocultar actual
    if (slides[currentCarouselIndex]) {
        slides[currentCarouselIndex].classList.remove('active');
        if (indicators[currentCarouselIndex]) indicators[currentCarouselIndex].classList.remove('active');
    }

    // Calcular nuevo indice con loop infinito
    currentCarouselIndex = (index + carouselImages.length) % carouselImages.length;

    // Mostrar nuevo
    if (slides[currentCarouselIndex]) {
        slides[currentCarouselIndex].classList.add('active');
        if (indicators[currentCarouselIndex]) indicators[currentCarouselIndex].classList.add('active');
    }
}

function cerrarModal() {
    const modal = document.getElementById('modal-historia');
    if (modal) {
        modal.style.display = "none";
        document.body.style.overflow = "auto";
    }
}

// Close modal if clicked outside
window.onclick = function (event) {
    const modal = document.getElementById('modal-historia');
    if (event.target == modal) {
        cerrarModal();
    }
}
