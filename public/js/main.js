document.addEventListener('DOMContentLoaded', () => {
    console.log("Sistema Mixteco Inicializado.");

    // Toggle Menú Móvil
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');

    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            // Cambiar icono
            const icon = menuToggle.querySelector('i');
            if (icon) {
                if (navLinks.classList.contains('active')) {
                    icon.classList.replace('fa-bars', 'fa-times');
                } else {
                    icon.classList.replace('fa-times', 'fa-bars');
                }
            }
        });
    }

    // Dropdowns en Móvil
    const dropdownBtns = document.querySelectorAll('.dropbtn');
    dropdownBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                // Cerrar otros dropdowns abiertos
                dropdownBtns.forEach(otherBtn => {
                    if (otherBtn !== btn) {
                        otherBtn.parentElement.classList.remove('open');
                    }
                });
                // Alternar el dropdown actual
                btn.parentElement.classList.toggle('open');
            }
        });
    });

    // Cerrar modales haciendo clic fuera de ellos (usando addEventListener para no sobreescribir otros escuchadores)
    window.addEventListener('click', (event) => {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = "none";
            document.body.style.overflow = "auto";
        }
    });
});

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "block";
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "none";
    }
}

function scrollCarousel(id, distance) {
    const element = document.getElementById(id);
    if (element) {
        element.scrollBy({
            left: distance,
            behavior: 'smooth'
        });
    }
}
