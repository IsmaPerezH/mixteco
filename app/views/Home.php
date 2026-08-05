<main>

<!-- ═══ HERO: 2 columnas ═══ -->
<section class="hero hero-bg">
  <div class="container hero-grid">

    <!-- Columna izquierda: texto -->
    <div class="hero-text">
      <span class="eyebrow">Tu'un Savi · Lengua mixteca</span>
      <h1 class="hero-title">Sa'an sau <span>Ñuu Ia kanu</span></h1>
      <p class="hero-subtitle">La palabra de la lluvia del pueblo del dios grande. Un espacio vivo para aprender, escuchar y preservar la lengua y la cultura de San Miguel el Grande.</p>
      <div class="hero-ctas">
        <a href="<?php echo $basePath ?>/diccionario" class="btn-primary">Explorar el diccionario</a>
        <a href="<?php echo $basePath ?>/historias"  class="btn-ghost">Escuchar historias</a>
      </div>
    </div>

    <!-- Columna derecha: Palabra del día -->
    <div class="word-plaque">
      <span class="word-plaque-label">Palabra del día</span>
      <p class="word-plaque-word" id="word-mx">Savi</p>
      <p class="word-plaque-es"  id="word-es">— lluvia</p>
      <span class="word-plaque-cat" id="word-cat">Clima</span>
      <div class="word-plaque-nav">
        <button onclick="cambiarPalabra(-1)" aria-label="Palabra anterior">‹</button>
        <button onclick="cambiarPalabra(1)"  aria-label="Palabra siguiente">›</button>
        <span class="word-plaque-note">conectado con el diccionario</span>
      </div>
    </div>

  </div>
</section>

<!-- ═══ Divider greca ═══ -->
<div class="greca-divider" aria-hidden="true"></div>

<!-- ═══ ACCESOS RÁPIDOS ═══ -->
<section class="quick-access">
  <div class="container">
    <h2 class="quick-title">Recorre el sistema</h2>
    <p class="quick-sub">Cuatro puertas de entrada a la cultura de San Miguel el Grande</p>
    <div class="quick-grid">

      <a href="<?php echo $basePath ?>/diccionario" class="quick-card">
        <svg class="quick-icon" viewBox="0 0 40 40" aria-hidden="true">
          <path d="M6 30 L6 10 L34 10 L34 24 L20 24 L14 32 L14 24 L6 24 Z" fill="none" stroke="#9B2226" stroke-width="2"/>
        </svg>
        <h3>Diccionario</h3>
        <p>Busca palabras en mixteco y español por categoría o letra.</p>
      </a>

      <a href="<?php echo $basePath ?>/historias" class="quick-card">
        <svg class="quick-icon" viewBox="0 0 40 40" aria-hidden="true">
          <path d="M20 4 C10 4 8 14 14 18 C6 20 6 32 18 34 C10 28 12 20 20 20 C28 20 30 28 22 34 C34 32 34 20 26 18 C32 14 30 4 20 4 Z" fill="none" stroke="#1F6F6B" stroke-width="2"/>
        </svg>
        <h3>Historias y leyendas</h3>
        <p>Relatos orales del pueblo, con galería de imágenes.</p>
      </a>

      <a href="<?php echo $basePath ?>/lugares" class="quick-card">
        <svg class="quick-icon" viewBox="0 0 40 40" aria-hidden="true">
          <path d="M4 32 L14 12 L20 22 L24 16 L36 32 Z" fill="none" stroke="#C98A2B" stroke-width="2"/>
        </svg>
        <h3>Lugares</h3>
        <p>Sitios naturales y culturales, cómo llegar y ubicación.</p>
      </a>

      <a href="<?php echo $basePath ?>/gastronomia" class="quick-card">
        <svg class="quick-icon" viewBox="0 0 40 40" aria-hidden="true">
          <path d="M10 18 C10 12 15 8 20 8 C25 8 30 12 30 18 L30 20 L10 20 Z M12 20 C12 28 16 32 20 32 C24 32 28 28 28 20" fill="none" stroke="#9B2226" stroke-width="2"/>
        </svg>
        <h3>Gastronomía</h3>
        <p>Platillos y bebidas tradicionales, con su origen.</p>
      </a>

    </div>
  </div>
</section>

<!-- ═══ Divider greca ═══ -->
<div class="greca-divider" aria-hidden="true"></div>

<!-- ═══ EDITORIAL ═══ -->
<section class="editorial">
  <div class="container">

    <div class="info-block">
      <div class="info-text">
        <h2>Cultura mixteca</h2>
        <p>La región ocupada por la cultura mixteca abarca parte de los estados de Guerrero, Puebla y Oaxaca.</p>
        <p>La Mixteca está dividida en tres subregiones naturales diferenciadas en lo ecológico y lo cultural: la alta, la costa y la baja.</p>
        <p>En el estado de Oaxaca, la Mixteca comprende 189 municipios de los distritos de Silacayoapan, Huajuapan, Juxtlahuaca, Coixtlahuaca, Nochixtlán, Teposcolula, Tlaxiaco, Putla y Jamiltepec.</p>
        <p style="font-size:0.82rem;color:var(--ink-soft);font-style:italic;margin-top:0.8rem;">Mixtecos – Etnografía – Atlas de los Pueblos Indígenas de México. INPI</p>
      </div>
      <div class="info-image">
        <img src="<?= $basePath ?>/public/img/cultura.jpg" alt="Territorio Mixteco">
      </div>
    </div>

    <div class="info-block reverse">
      <div class="info-text">
        <h2>Lengua mixteca</h2>
        <p>En el estado de Oaxaca existen 16 lenguas indígenas. El mixteco pertenece a la familia otomangue y tiene variantes por región.</p>
        <p>En San Miguel el Grande, el mixteco es hablado por <strong>2,009 habitantes</strong> de 5 años y más, según el Censo de Población y Vivienda 2020.</p>
      </div>
      <div class="info-image">
        <img src="<?= $basePath ?>/public/img/reloj.jpg" alt="Lengua y Población">
      </div>
    </div>

  </div>
</section>

<!-- ═══ JS: Palabra del día ═══ -->
<script>
const palabras = [
  {mx:"Savi",  es:"lluvia",        cat:"Clima"},
  {mx:"Ñuu",  es:"pueblo / tierra",cat:"Lugares"},
  {mx:"Kuii", es:"agua",           cat:"Naturaleza"},
  {mx:"Yaa",  es:"uno",            cat:"Números"},
  {mx:"Nuu",  es:"cara / rostro",  cat:"Cuerpo"},
  {mx:"Ita",  es:"flor",           cat:"Naturaleza"},
];
let idx = 0;
function cambiarPalabra(dir) {
  idx = (idx + dir + palabras.length) % palabras.length;
  document.getElementById('word-mx').textContent  = palabras[idx].mx;
  document.getElementById('word-es').textContent  = '— ' + palabras[idx].es;
  document.getElementById('word-cat').textContent = palabras[idx].cat;
}
</script>

</main>
