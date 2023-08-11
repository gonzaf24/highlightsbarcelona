document.addEventListener("DOMContentLoaded", function () {
  const navbarCategories = document.getElementById("navbar-cotegories");
  const openButton = document.getElementById("open-menu-button");
  const collapseUpIcon = document.getElementById("collapse-up-icon");
  const menuButtonIcon = document.getElementById("menu-button-icon");
  const pageElement = document.querySelector(".page");
  const navbar = document.getElementById("navbar");

  // Función para calcular y aplicar el margen superior
  function updateMarginTop() {
    // Obtener el estilo computado del navbar
    const navbarStyle = getComputedStyle(navbar);
    const navbarHeight = parseFloat(navbarStyle.height) + 100;

    // Aplicar el atributo margin-top al elemento de la página
    if (navbarCategories.classList.contains("open-menu")) {
      pageElement.style.marginTop = `${navbarHeight}px`;
    } else {
      pageElement.style.marginTop = "125px";
    }
  }

  const currentView = new URLSearchParams(window.location.search).get("vista");

  function updateMarginTopByWidth() {
    const screenWidth = window.innerWidth;

    // Determinar el valor de margin-top según el ancho del navegador
    let marginTopValue = `250px`;
    if (screenWidth < 550) {
      marginTopValue = `610px`;
    } else if (screenWidth < 880) {
      marginTopValue = `425px`;
    } else if (screenWidth < 925) {
      marginTopValue = `360px`;
    } else {
      marginTopValue = `325px`;
    }

    if (navbarCategories.classList.contains("open-menu")) {
      pageElement.style.marginTop = `${marginTopValue}`;
    } else {
      pageElement.style.marginTop = "125px";
    }
  }

  // Ejecutar la función inicialmente y cada vez que la ventana cambie de tamaño
  updateMarginTop();
  window.addEventListener("resize", updateMarginTop);

  // Iniciar el menú abierto en versión web
  const screenWidth = window.innerWidth;
  if (screenWidth >= 430) {
    navbarCategories.classList.add("open-menu");
    openButton.classList.add("open-menu");
    updateMarginTopByWidth();
    collapseUpIcon.classList.remove("hidden");
    menuButtonIcon.classList.add("hidden");
  }

  openButton.addEventListener("click", function () {
    navbarCategories.classList.toggle("open-menu");
    openButton.classList.toggle("open-menu");
    updateMarginTopByWidth();
    collapseUpIcon.classList.toggle("hidden");
    menuButtonIcon.classList.toggle("hidden");
  });

  let prevScrollY = window.scrollY;

  // Escuchar el evento scroll en el body
  document.body.addEventListener("scroll", function () {
    const scrollY =
      document.body.scrollTop || document.documentElement.scrollTop;
    const windowHeight = window.innerHeight;
    const scrollThreshold = windowHeight * 0.3; // 10% of the window height

    if (scrollY > prevScrollY) {
      // Scrolling down
      if (
        scrollY > scrollThreshold &&
        navbarCategories.classList.contains("open-menu")
      ) {
        navbarCategories.classList.remove("open-menu");
        openButton.classList.remove("open-menu");
        updateMarginTopByWidth();
        collapseUpIcon.classList.add("hidden");
        menuButtonIcon.classList.remove("hidden");
      }
    } else if (scrollY === 0) {
      // At the top of the page
      navbarCategories.classList.add("open-menu");
      openButton.classList.add("open-menu");
      updateMarginTopByWidth();
      collapseUpIcon.classList.remove("hidden");
      menuButtonIcon.classList.add("hidden");
    }

    prevScrollY = scrollY;
  });

  const exploreLink = document.querySelector(".explore-link");
  exploreLink.addEventListener("click", function (event) {
    event.preventDefault(); // Prevent default anchor behavior
    navbarCategories.classList.add("open-menu");
    openButton.classList.add("open-menu");
    updateMarginTopByWidth();
    collapseUpIcon.classList.remove("hidden");
    menuButtonIcon.classList.add("hidden");
  });

  if (currentView === "home" || currentView === null) {
    menuButtonIcon.classList.add("fa-shake");
    setTimeout(() => {
      menuButtonIcon.classList.remove("fa-shake");
    }, 2500);
  }
});
