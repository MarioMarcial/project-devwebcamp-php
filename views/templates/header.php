<header class="header">
  <div class="header__container">
    <nav class="header__nav">
      <?php if(is_auth()) { ?>
        <a href="<?php echo is_admin() ? '/admin/dashboard' : '/finalizar-registro'; ?>" class="header__link">Administrar</a>
        <form action="/logout" class="header__form" method="POST">
          <input class="header__submit" type="submit" value="Cerrar Sesión">
        </form>
      <?php } else { ?>
        <a href="/registro" class="header__link">Registro</a>
        <a href="/login" class="header__link">Iniciar Sesión</a>
      <?php } ?>
    </nav>
    <div class="header__content">
      <a href="/">
        <h1 class="header__logo">&#60;DevWebCamp/></h1>
        <p class="header__text">Octubre 5-6 - 2023</p>
        <p class="header__text header__text--mode">En Línea - Presencial</p>
        <a href="/registro" class="header__button">Comprar Pase</a>
      </a>
    </div>
  </div>
</header>
<div class="bar">
  <div class="bar__content">
    <a href="" class="bar__link">
      <h2 class="bar__logo">&#60;DevWebCamp/></h2>
    </a>
    <nav class="nav">
      <a href="/devwebcamp" class="nav__link <?php echo current_page('/devwebcamp') ? 'nav__link--selected' : ''; ?>">Evento</a>
      <a href="/paquetes" class="nav__link <?php echo current_page('/paquetes') ? 'nav__link--selected' : ''; ?>">Paquetes</a>
      <a href="/workshops-conferencias" class="nav__link <?php echo current_page('/workshops-conferencias') ? 'nav__link--selected' : ''; ?>">Workshops / Conferencias</a>
      <a href="/registro" class="nav__link">Comprar Pase</a>
    </nav>
  </div>
</div>