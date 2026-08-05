// historias.js – Carrusel, Micro-interacciones y Modo Lectura Inmersiva
let carouselImages = [];
let currentCarouselIndex = 0;
let currentFontSize = 1.05; // rem

function escapeHtml(str) {
    if (typeof str !== 'string') return '';
    return str
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function fixImageUrl(url) {
    if (!url) return '';
    const basePath = document.documentElement.dataset.basepath || '';
    if (url.startsWith('/mixteco/')) {
        return url.replace('/mixteco', basePath);
    }
    if (url.startsWith('/public/') && basePath !== '') {
        return basePath + url;
    }
    return url;
}

function abrirModal(item) {
    const modal = document.getElementById('modal-historia');
    if (!modal) return;

    // Resetear estado del Modo Lectura
    modal.classList.remove('reading-mode-active');
    currentFontSize = 1.05;
    
    const textElem = document.getElementById('modal-text');
    if (textElem) {
        textElem.style.fontSize = currentFontSize + 'rem';
    }

    // Título del relato
    const titleElem = document.getElementById('modal-title');
    if (titleElem) titleElem.textContent = item.titulo || '';

    // Configurar Controles de Lectura en el Modal Header si no existen
    setupModalHeaderControls();

    // Galería / Carrusel
    const galleryContainer = document.getElementById('modal-gallery');
    if (galleryContainer) {
        galleryContainer.innerHTML = '';
        carouselImages = item.galeria ? item.galeria.filter(url => url && url.trim() !== '').map(url => fixImageUrl(url)) : [];
        currentCarouselIndex = 0;

        if (carouselImages.length > 0) {
            galleryContainer.style.display = 'block';

            let carouselHTML = `<div class="carousel-inner">`;
            carouselImages.forEach((imgUrl, index) => {
                const activeClass = index === 0 ? 'active' : '';
                carouselHTML += `
                    <div class="carousel-slide ${activeClass}" id="slide-${index}">
                        <img src="${escapeHtml(imgUrl)}" alt="Imagen de ${escapeHtml(item.titulo)}">
                    </div>
                `;
            });
            carouselHTML += `</div>`;

            if (carouselImages.length > 1) {
                carouselHTML += `
                    <button class="carousel-prev" onclick="cambiarSlide(-1)" type="button"><i class="fas fa-chevron-left"></i></button>
                    <button class="carousel-next" onclick="cambiarSlide(1)" type="button"><i class="fas fa-chevron-right"></i></button>
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
    }

    // Texto del Relato (Sanitizado con párrafos)
    if (textElem) {
        textElem.innerHTML = '';
        const parrafos = (item.contenido || '').split('\n');
        parrafos.forEach(pText => {
            if (pText.trim() !== '') {
                const p = document.createElement('p');
                p.textContent = pText;
                textElem.appendChild(p);
            }
        });
    }

    // Escuchar Scroll del Modal para Barra de Progreso
    modal.addEventListener('scroll', updateReadingProgress);

    modal.style.display = "block";
    document.body.style.overflow = "hidden";
}

function setupModalHeaderControls() {
    const modalHeader = document.querySelector('.modal-header');
    if (!modalHeader) return;

    let controls = modalHeader.querySelector('.modal-controls');
    if (!controls) {
        controls = document.createElement('div');
        controls.className = 'modal-controls';
        controls.innerHTML = `
            <button type="button" class="btn-reader-ctrl btn-immersive" onclick="toggleModoLectura()" title="Alternar Modo Lectura Inmersiva">
                <i class="fas fa-book-reader"></i> <span>Modo Lectura</span>
            </button>
            <button type="button" class="btn-reader-ctrl" onclick="cambiarTamanoTexto(0.1)" title="Aumentar letra">A+</button>
            <button type="button" class="btn-reader-ctrl" onclick="cambiarTamanoTexto(-0.1)" title="Reducir letra">A-</button>
            <span class="close" onclick="cerrarModal()">&times;</span>
        `;
        // Reemplazar la X existente si la hay
        const oldClose = modalHeader.querySelector('.close');
        if (oldClose && oldClose.parentElement === modalHeader) {
            oldClose.remove();
        }
        modalHeader.appendChild(controls);
    }
}

function toggleModoLectura() {
    const modal = document.getElementById('modal-historia');
    if (!modal) return;
    modal.classList.toggle('reading-mode-active');
}

function cambiarTamanoTexto(delta) {
    currentFontSize = Math.min(1.6, Math.max(0.85, currentFontSize + delta));
    const textElem = document.getElementById('modal-text');
    if (textElem) {
        textElem.style.fontSize = currentFontSize + 'rem';
    }
}

function updateReadingProgress() {
    const modal = document.getElementById('modal-historia');
    let progressBar = document.getElementById('readingProgress');
    
    if (!progressBar && modal) {
        progressBar = document.createElement('div');
        progressBar.id = 'readingProgress';
        progressBar.className = 'reading-progress-bar';
        const modalContent = modal.querySelector('.modal-content');
        if (modalContent) modalContent.insertBefore(progressBar, modalContent.firstChild);
    }

    if (!modal || !progressBar) return;

    const scrollTop = modal.scrollTop;
    const scrollHeight = modal.scrollHeight - modal.clientHeight;
    const progress = scrollHeight > 0 ? (scrollTop / scrollHeight) * 100 : 0;
    progressBar.style.width = Math.min(100, Math.max(0, progress)) + '%';
}

function cambiarSlide(n) {
    irASlide(currentCarouselIndex + n);
}

function irASlide(index) {
    if (carouselImages.length <= 1) return;

    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.carousel-indicators .indicator');

    if (slides[currentCarouselIndex]) {
        slides[currentCarouselIndex].classList.remove('active');
        if (indicators[currentCarouselIndex]) indicators[currentCarouselIndex].classList.remove('active');
    }

    currentCarouselIndex = (index + carouselImages.length) % carouselImages.length;

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
        modal.removeEventListener('scroll', updateReadingProgress);
    }
}

window.addEventListener('click', (event) => {
    const modal = document.getElementById('modal-historia');
    if (event.target === modal) {
        cerrarModal();
    }
});
