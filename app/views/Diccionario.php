<main class="diccionario-main">
    <?php
    function buildQuery($extra = []) {
        $query = [];
        if (isset($_GET['q']) && $_GET['q'] !== '') {
            $query['q'] = $_GET['q'];
        }
        if (isset($_GET['categoria']) && $_GET['categoria'] !== '') {
            $query['categoria'] = $_GET['categoria'];
        }
        if (isset($_GET['letra']) && $_GET['letra'] !== '') {
            $query['letra'] = $_GET['letra'];
        }
        if (isset($_GET['page']) && $_GET['page'] !== '') {
            $query['page'] = $_GET['page'];
        }
        foreach ($extra as $key => $value) {
            if ($value === null) {
                unset($query[$key]);
            } else {
                $query[$key] = $value;
            }
        }
        return http_build_query($query);
    }
    ?>
    <div class="container">

        <!-- Encabezado -->
        <div class="diccionario-header">
            <h1 class="diccionario-title">Diccionario mixteco</h1>
            <p class="diccionario-subtitle">variante de San Miguel El Grande, Oaxaca</p>
        </div>

        <!-- Barra de búsqueda con resultados en vivo -->
        <div class="search-container">
            <form action="<?= $basePath ?>/diccionario" method="GET" class="search-box" id="searchForm" autocomplete="off">

                <div class="search-input-wrap">
                    <i class="fas fa-search search-icon"></i>
                    <input
                        type="text"
                        name="q"
                        id="searchInput"
                        placeholder="Escribe en mixteco o español…"
                        class="search-input"
                        value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>"
                    >
                    <?php if (isset($_GET['categoria'])): ?>
                        <input type="hidden" name="categoria" value="<?= htmlspecialchars($_GET['categoria']) ?>">
                    <?php endif; ?>
                    <?php if (isset($_GET['letra'])): ?>
                        <input type="hidden" name="letra" value="<?= htmlspecialchars($_GET['letra']) ?>">
                    <?php endif; ?>

                    <!-- Panel de resultados en vivo -->
                    <div class="live-results" id="liveResults"></div>
                </div>

                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </form>
        </div>

        <!-- Filtros por Categoría -->
        <div class="carousel-wrapper">
            <button class="nav-btn prev" onclick="scrollCarousel('cat-filters', -200)" aria-label="Anterior">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="filter-container" id="cat-filters">
                <div class="category-filters">
                    <a href="<?= $basePath ?>/diccionario?<?= buildQuery(['categoria' => null, 'page' => 1]) ?>"
                       class="cat-link <?= !isset($_GET['categoria']) ? 'active' : '' ?>">
                        Todas las categorías
                    </a>
                    <?php foreach($categorias as $cat): ?>
                        <a href="<?= $basePath ?>/diccionario?<?= buildQuery(['categoria' => $cat['id'], 'page' => 1]) ?>"
                           class="cat-link <?= (isset($_GET['categoria']) && $_GET['categoria'] == $cat['id']) ? 'active' : '' ?>">
                            <?= htmlspecialchars($cat['nombre']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <button class="nav-btn next" onclick="scrollCarousel('cat-filters', 200)" aria-label="Siguiente">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <!-- Barra alfabética -->
        <div class="carousel-wrapper">
            <button class="nav-btn prev" onclick="scrollCarousel('alpha-list', -200)" aria-label="Anterior">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="alphabet-container" id="alpha-list">
                <div class="alphabet-list">
                    <?php
                    $letras = range('A', 'Z');
                    foreach($letras as $l):
                        $activeClass = (isset($_GET['letra']) && $_GET['letra'] == $l) ? 'active' : '';
                    ?>
                        <a href="<?= $basePath ?>/diccionario?<?= buildQuery(['letra' => $l, 'page' => 1]) ?>"
                           class="alphabet-link <?= $activeClass ?>"><?= $l ?></a>
                    <?php endforeach; ?>
                    <a href="<?= $basePath ?>/diccionario?<?= buildQuery(['letra' => null, 'page' => 1]) ?>"
                       class="alphabet-link">Todas</a>
                </div>
            </div>
            <button class="nav-btn next" onclick="scrollCarousel('alpha-list', 200)" aria-label="Siguiente">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <!-- Grid de palabras -->
        <div class="words-container">
            <?php if(count($palabras) > 0): ?>
                <div class="words-grid-list" id="wordsGrid">
                    <?php foreach($palabras as $p): ?>
                        <div class="word-card">
                            <div class="word-header-flex">
                                <span class="word-mixteco"><?= htmlspecialchars($p['mixteco']) ?></span>
                                <span class="category-tag"><?= htmlspecialchars($p['categoria_nombre']) ?></span>
                            </div>
                            <p class="word-espanol"><?= htmlspecialchars($p['espanol']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <p>No se encontraron palabras con esa búsqueda.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Paginación -->
        <?php if (isset($totalPages) && $totalPages > 1): ?>
            <div class="pagination">
                <?php if ($currentPage > 1): ?>
                    <a href="<?= $basePath ?>/diccionario?<?= buildQuery(['page' => $currentPage - 1]) ?>" class="page-link prev">&laquo; Anterior</a>
                <?php endif; ?>

                <?php
                $startPage = max(1, $currentPage - 2);
                $endPage   = min($totalPages, $currentPage + 2);
                if ($startPage > 1): ?>
                    <a href="<?= $basePath ?>/diccionario?<?= buildQuery(['page' => 1]) ?>" class="page-link">1</a>
                    <?php if ($startPage > 2): ?><span class="page-dots">…</span><?php endif; ?>
                <?php endif; ?>

                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <a href="<?= $basePath ?>/diccionario?<?= buildQuery(['page' => $i]) ?>"
                       class="page-link <?= $i === $currentPage ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($endPage < $totalPages): ?>
                    <?php if ($endPage < $totalPages - 1): ?><span class="page-dots">…</span><?php endif; ?>
                    <a href="<?= $basePath ?>/diccionario?<?= buildQuery(['page' => $totalPages]) ?>" class="page-link"><?= $totalPages ?></a>
                <?php endif; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="<?= $basePath ?>/diccionario?<?= buildQuery(['page' => $currentPage + 1]) ?>" class="page-link next">Siguiente &raquo;</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- ═══ Búsqueda en vivo ═══ -->
    <script>
    (function () {
        const input      = document.getElementById('searchInput');
        const panel      = document.getElementById('liveResults');
        const basePath   = '<?= $basePath ?>';
        let   debounce   = null;

        if (!input || !panel) return;

        input.addEventListener('input', function () {
            clearTimeout(debounce);
            const q = this.value.trim();

            if (q.length < 2) {
                panel.innerHTML = '';
                panel.classList.remove('visible');
                return;
            }

            // Debounce: espera 250ms tras la última tecla
            debounce = setTimeout(() => fetchLive(q), 250);
        });

        // Ocultar panel al hacer clic fuera
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.search-box')) {
                panel.classList.remove('visible');
            }
        });

        function fetchLive(q) {
            fetch(basePath + '/diccionario/buscar?q=' + encodeURIComponent(q))
                .then(r => r.json())
                .then(data => renderResults(data, q))
                .catch(() => {
                    // Si no hay endpoint AJAX, mostrar vacío sin error
                    panel.classList.remove('visible');
                });
        }

        function renderResults(data, q) {
            panel.innerHTML = '';

            if (!data || data.length === 0) {
                panel.innerHTML = '<div class="live-results-empty">Sin resultados para "<strong>' + escapeHtml(q) + '</strong>"</div>';
                panel.classList.add('visible');
                return;
            }

            data.slice(0, 10).forEach(function (item) {
                const el = document.createElement('div');
                el.className = 'live-result-item';
                el.innerHTML =
                    '<div>' +
                        '<span class="live-result-mx">' + highlight(item.mixteco, q)  + '</span>' +
                        '<span class="live-result-es"> — ' + highlight(item.espanol, q) + '</span>' +
                    '</div>' +
                    '<span class="live-result-cat">' + escapeHtml(item.categoria_nombre || '') + '</span>';

                el.addEventListener('click', function () {
                    input.value = item.mixteco;
                    panel.classList.remove('visible');
                    document.getElementById('searchForm').submit();
                });

                panel.appendChild(el);
            });

            panel.classList.add('visible');
        }

        function highlight(text, q) {
            if (!text) return '';
            const re = new RegExp('(' + escapeRegex(q) + ')', 'gi');
            return escapeHtml(text).replace(re, '<mark style="background:rgba(155,34,38,0.15);color:inherit;border-radius:2px;">$1</mark>');
        }

        function escapeHtml(s) {
            return String(s).replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
        }

        function escapeRegex(s) {
            return s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }
    })();
    </script>
</main>
