document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.lugares-nav-btn');
    const modal = document.getElementById('lugares-modal');
    const modalTitle = document.getElementById('lugares-modal-title');
    const modalText = document.getElementById('lugares-modal-text');
    const modalMap = document.getElementById('lugares-modal-map');
    const modalComo = document.getElementById('lugares-modal-como');
    const modalImg = document.getElementById('lugares-modal-img');
    const modalClose = document.querySelector('.lugares-modal-close');
    const verMasButtons = document.querySelectorAll('.lugares-ver-mas');

    buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-target');
            const dir = btn.getAttribute('data-dir');
            const track = targetId ? document.getElementById(targetId) : null;

            if (!track) {
                return;
            }

            const card = track.querySelector('.lugares-card');
            const gap = 24;
            const step = card ? card.offsetWidth + gap : 300;
            const amount = dir === 'right' ? step : -step;

            track.scrollBy({ left: amount, behavior: 'smooth' });
        });
    });

    const openModal = (title, text, mapa, como, image) => {
        if (!modal) {
            return;
        }
        if (modalTitle) {
            modalTitle.textContent = title || 'Origen';
        }
        if (modalText) {
            modalText.textContent = text || 'Sin origen disponible.';
        }
        if (modalMap) {
            modalMap.src = mapa || '';
        }
        if (modalComo) {
            modalComo.textContent = como || 'Sin informacion de como llegar.';
        }
        if (modalImg) {
            modalImg.src = image || '/mixteco/public/img/Pozole-blanco.jpg';
            modalImg.alt = title || 'Imagen';
        }
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
    };

    const closeModal = () => {
        if (!modal) {
            return;
        }
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        if (modalMap) {
            modalMap.src = '';
        }
    };

    verMasButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const origen = btn.getAttribute('data-origen') || '';
            const nombre = btn.getAttribute('data-nombre') || 'Origen';
            const mapa = btn.getAttribute('data-mapa') || '';
            const como = btn.getAttribute('data-como') || '';
            const imagen = btn.getAttribute('data-imagen') || '';
            openModal(nombre, origen, mapa, como, imagen);
        });
    });

    if (modalClose) {
        modalClose.addEventListener('click', closeModal);
    }

    if (modal) {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal();
            }
        });
    }

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
});
