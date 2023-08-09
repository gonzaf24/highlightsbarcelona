// Función para cargar el contenido de las vistas
function loadView(viewName) {
  const contentContainer = document.getElementById("content-container");

  // Realizar una petición AJAX para cargar la vista
  const xhr = new XMLHttpRequest();
  xhr.open("GET", `vistas/${viewName}.php`, true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      contentContainer.innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}

// Manejar los enlaces de navegación
document.addEventListener("DOMContentLoaded", function () {
  const navigationLinks = document.querySelectorAll(".navigation-link");

  navigationLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
      const viewName = link.getAttribute("data-view");
      loadView(viewName);
    });
  });
});
