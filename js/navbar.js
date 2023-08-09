document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.getElementById("navbar-cotegories");
  const openButton = document.getElementById("open-button");
  const collapseUpIcon = document.getElementById("collapse-up");
  const menuButtonIcon = document.getElementById("menu-button-icon");

  openButton.addEventListener("click", function () {
    navbar.classList.toggle("open-menu");
    openButton.classList.toggle("open-menu");
    collapseUpIcon.classList.toggle("hidden");
    menuButtonIcon.classList.toggle("hidden");
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.getElementById("navbar-cotegories");
  const openButton = document.getElementById("open-button");
  const collapseUpIcon = document.getElementById("collapse-up");
  const menuButtonIcon = document.getElementById("menu-button-icon");

  let lastScrollPosition = 0;
  const scrollThreshold = 0.05; // 5% of the page height

  window.addEventListener("scroll", function () {
    const scrollY = window.scrollY;
    const windowHeight = window.innerHeight;
    const pageHeight = document.body.clientHeight;

    if (
      scrollY > lastScrollPosition &&
      scrollY > windowHeight * scrollThreshold
    ) {
      // Scroll down, and scrolled past the threshold
      navbar.classList.add("collapsed");
      openButton.classList.add("collapsed");
      menuButtonIcon.classList.remove("hidden");
      collapseUpIcon.classList.add("hidden");
    } else {
      // Scroll up, or not past the threshold
      navbar.classList.remove("collapsed");
      openButton.classList.remove("collapsed");
      menuButtonIcon.classList.add("hidden");
      collapseUpIcon.classList.remove("hidden");
    }

    lastScrollPosition = scrollY;
  });
});
