document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.gastro-nav-btn');
    const modal = document.getElementById('gastro-modal');
    const modalTitle = document.getElementById('gastro-modal-title');
    const modalText = document.getElementById('gastro-modal-text');
    const modalImg = document.getElementById('gastro-modal-img');
    const modalClose = document.querySelector('.gastro-modal-close');
    const verMasButtons = document.querySelectorAll('.gastro-ver-mas');

    buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-target');
            const dir = btn.getAttribute('data-dir');
            const track = targetId ? document.getElementById(targetId) : null;

            if (!track) {
                return;
            }

            const card = track.querySelector('.gastro-card');
            const gap = 24;
            const step = card ? card.offsetWidth + gap : 300;
            const amount = dir === 'right' ? step : -step;

            track.scrollBy({ left: amount, behavior: 'smooth' });
        });
    });

    const openModal = (title, text, image) => {
        if (!modal) {
            return;
        }
        if (modalTitle) {
            modalTitle.textContent = title || 'Origen';
        }
        if (modalText) {
            modalText.textContent = text || 'Sin origen disponible.';
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
    };

    verMasButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const origen = btn.getAttribute('data-origen') || '';
            const nombre = btn.getAttribute('data-nombre') || 'Origen';
            const imagen = btn.getAttribute('data-imagen') || '';
            openModal(nombre, origen, imagen);
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
