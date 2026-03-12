<main class="diccionario-main">
    <div class="container">
        <div class="diccionario-header">
            <h1 class="diccionario-title">Diccionario del mixteco</h1>
            <p class="diccionario-subtitle">variante de San Miguel El Grande</p>
        </div>
        
        <div class="search-container">
            <form action="/mixteco/diccionario" method="GET" class="search-box">
                <input type="text" name="q" placeholder="Buscar palabras en mixteco o español" class="search-input" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
                <button type="submit" class="search-btn">Buscar</button>
            </form>
        </div>

        <!-- Filtro por Categorías -->
        <div class="filter-container">
            <div class="category-filters">
                <a href="/mixteco/diccionario" class="cat-link <?= !isset($_GET['categoria']) ? 'active' : '' ?>">Todas las categorías</a>
                <?php foreach($categorias as $cat): ?>
                    <a href="/mixteco/diccionario?categoria=<?= $cat['id'] ?>" 
                       class="cat-link <?= (isset($_GET['categoria']) && $_GET['categoria'] == $cat['id']) ? 'active' : '' ?>">
                        <?= htmlspecialchars($cat['nombre']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="alphabet-container">
            <div class="alphabet-list">
                <?php 
                $letras = range('A', 'Z');
                foreach($letras as $l): 
                    $activeClass = (isset($_GET['letra']) && $_GET['letra'] == $l) ? 'active' : '';
                ?>
                    <a href="/mixteco/diccionario?letra=<?= $l ?><?= isset($_GET['categoria']) ? '&categoria='.$_GET['categoria'] : '' ?>" 
                       class="alphabet-link <?= $activeClass ?>"><?= $l ?></a>
                <?php endforeach; ?>
                <a href="/mixteco/diccionario" class="alphabet-link">Todas</a>
            </div>
        </div>
        
        <div class="words-container">
            <?php if(count($palabras) > 0): ?>
                <div class="words-grid-list">
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
    </div>
</main>
