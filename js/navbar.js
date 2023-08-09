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
    const navbarHeight = parseFloat(navbarStyle.height) + 80;

    // Aplicar el atributo margin-top al elemento de la página
    if (navbarCategories.classList.contains("open-menu")) {
      pageElement.style.marginTop = `${navbarHeight}px`;
    } else {
      console.log("rentro");
      pageElement.style.marginTop = "125px";
    }
  }

  // Ejecutar la función inicialmente y cada vez que la ventana cambie de tamaño
  updateMarginTop();
  window.addEventListener("resize", updateMarginTop);

  openButton.addEventListener("click", function () {
    console.log("click");

    navbarCategories.classList.toggle("open-menu");
    openButton.classList.toggle("open-menu");
    collapseUpIcon.classList.toggle("hidden");
    menuButtonIcon.classList.toggle("hidden");
    setTimeout(() => {
      updateMarginTop();
    }, 450);
  });
});
