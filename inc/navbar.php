<?php
  // Obtener la vista actual de la URL
  $vista_actual = isset($_GET['vista']) ? $_GET['vista'] : 'home';

  $categorias = array(
    'tapas' => 'Eat tapas !',
    'terraces' => 'Terraces (drinks and beers)',
    'food' => 'By type of Food',
    'local_life' => 'Local life (Rumba & Flamenco)',
    'mobility' => 'Mobility',
    'tourist_attractions' => 'Tourist attractions',
    'beaches' => 'Beaches',
    'neighborhoods' => 'Neighborhoods',
    'neighborhoods_festivals' => 'Local neighborhood festivals',
    'expensive_places' => 'Expensive and dress-code',
    'nightlife' => 'Typical nightlife',
    'techno_lovers' => 'Techno Lovers'
);

?>
<div id="navbar" class="navbar">
  <div class="navbar-container">
    <span>
        <a href="index.php" class="navbar-title">Highlights</a>

        
    </span>

    <?php 
          if (array_key_exists($vista_actual, $categorias) && $vista_actual != 'home') {
              echo '<span class="categoria-movil">' . $categorias[$vista_actual] . '</span>';
          }
        ?>
    
  </div>
  <div id="navbar-cotegories" class="navbar-cotegories">
    <a href="index.php?vista=tapas" class="item <?php echo $vista_actual === 'tapas' ? 'active' : ''; ?>">Eat tapas !</a>
    <a href="index.php?vista=terraces" class="item <?php echo $vista_actual === 'terraces' ? 'active' : ''; ?>">Terraces (drinks and beers)</a>
    <a href="index.php?vista=food" class="item <?php echo $vista_actual === 'food' ? 'active' : ''; ?>">By type of Food</a>
    <a href="index.php?vista=local_life" class="item <?php echo $vista_actual === 'local_life' ? 'active' : ''; ?>">Local life (Rumba & Flamenco)</a>
    <a href="index.php?vista=mobility" class="item <?php echo $vista_actual === 'mobility' ? 'active' : ''; ?>">Mobility</a>
    <a href="index.php?vista=tourist_attractions" class="item <?php echo $vista_actual === 'tourist_attractions' ? 'active' : ''; ?>">Tourist attractions</a>
    <a href="index.php?vista=beaches" class="item <?php echo $vista_actual === 'beaches' ? 'active' : ''; ?>">Beaches</a>
    <a href="index.php?vista=neighborhoods" class="item <?php echo $vista_actual === 'neighborhoods' ? 'active' : ''; ?>">Neighborhoods</a>
    <a href="index.php?vista=neighborhoods_festivals" class="item <?php echo $vista_actual === 'neighborhoods_festivals' ? 'active' : ''; ?>">Local neighborhood festivals</a>
    <a href="index.php?vista=expensive_places" class="item <?php echo $vista_actual === 'expensive_places' ? 'active' : ''; ?>">Expensive and dress-code</a>
    <a href="index.php?vista=nightlife" class="item <?php echo $vista_actual === 'nightlife' ? 'active' : ''; ?>">Typical nightlife</a>
    <a href="index.php?vista=techno_lovers" class="item <?php echo $vista_actual === 'techno_lovers' ? 'active' : ''; ?>">Techno Lovers</a>
  </div>
  
  <button id="open-menu-button" class="open-menu-button">
      <span class="icon">
        <i id="collapse-up-icon"  class="fa-solid fa-up-long fa-2xl"></i>
        <i id="menu-button-icon"  class="fa-solid fa-bars fa-2xl"></i>
      </span>
  </button>

  <div class="icons-wrapper">
      <span class="icon">
        <a href="https://instagram.com/highlightsbarcelona?igshid=NTc4MTIwNjQ2YQ==" target="_blank"> <i class="fab fa-instagram social-network"></i> </a>
      </span>
      <span class="icon">
        <a href="https://www.tiktok.com/@highlightsbarecelona?_t=8ehi5MQMebQ&_r=1" target="_blank"> <i class="fab fa-brands fa-tiktok"></i> </a>
      </span>
      <span class="icon">
        <a href="https://www.facebook.com/highlightsbarcelona" target="_blank"> <i class="fab fa-brands fa-facebook"></i></a>
      </span>
      <span class="icon">
        <a href="https://twitter.com/highlights_bcn?s=21" target="_blank"> <i class="fab fa-brands fa-twitter"></i> </a>
      </span>
      <span class="icon">
        <a href="https://youtube.com/@highlightsbarcelona" target="_blank"> <i class="fab fa-youtube social-network"></i> </a>
      </span>
    </div>
</div>
